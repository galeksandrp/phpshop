<?php

function query_multibase($obj) {

    $multi_cat = null;

    // ����������
    if (defined("HostID") or defined("HostMain")) {

        // �������� ��������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['servers'] = ' ="" or servers REGEXP "i1000i"';

        $multi_cat = array();
        $multi_dop_cat = null;
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
        $PHPShopOrm->debug = $obj->debug;
        $data = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 10000));

        if (is_array($data)) {
            foreach ($data as $row) {
                $multi_cat[] = $row['id'];
                $multi_dop_cat.=" or dop_cat REGEXP '#" . $row['id'] . "#'";
            }
        }

        $multi_select = ' and ( category IN (' . @implode(',', $multi_cat) . ')' . $multi_dop_cat . ')';

        return $multi_select;
    }
}

/**
 * ����������� SQL ������� ��� ������ ������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @return mixed
 */
function query_filter($obj) {
    global $SysValue;

    if (!empty($_REQUEST['v']))
        $v = $_REQUEST['v'];
    else
        $v = null;

    if (!empty($_REQUEST['pole']))
        $pole = intval($_REQUEST['pole']);
    else
        $pole = $obj->PHPShopSystem->getSerilizeParam('admoption.search_pole');
    
    if(empty($pole))
        $pole=1;

    if (!empty($_REQUEST['p']))
        $p = intval($_REQUEST['p']);
    else
        $p = 1;

    $cat = intval($_REQUEST['cat']);
    $words = trim(PHPShopSecurity::true_search($_REQUEST['words']));
    $num_row = $obj->num_row;
    $num_ot = $q = 0;

    $sortV = $sort = null;

    // ���������� �� ���������������
    if (empty($_POST['v']))
        @$v = $SysValue['nav']['query']['v'];
    if (is_array($v))
        foreach ($v as $key => $value) {
            if (!empty($value)) {
                $hash = $key . "-" . $value;
                $sortV.=" and vendor REGEXP 'i" . $hash . "i' ";
            }
        }

    // ������ ������� Secure Fix
    $words = PHPShopSecurity::true_search(PHPShopSecurity::TotalClean($words, 2));

    // ��������� �����
    $_WORDS = explode(" ", $words);

    // Ajax �����        
    if (!empty($_POST['ajax'])) {
        foreach ($_WORDS as $w)
            $sort.="(name REGEXP '\x20*$w' or uid REGEXP '^$w' or keywords REGEXP '$w') or ";
    }
    // ������� �����
    else {
        foreach ($_WORDS as $w)
            $wrd .= '%' . $w;

        $wrd .='%';

        switch ($pole) {
            case(1):
                $sort.="(name LIKE '$wrd' or keywords LIKE '$wrd' or id LIKE '$wrd') and ";
                break;

            case(2):
                $sort.="(name LIKE '$wrd' or content LIKE '$wrd' or description LIKE '$wrd' or keywords LIKE '$wrd' or uid LIKE '$wrd') and ";
                break;
        }
    }

    $sort = substr($sort, 0, strlen($sort) - 4);

    // �� ����������
    if (!empty($cat) and !defined("HostID"))
        $string = " category=$cat and";
    else
        $string = null;

    // ��������������� ������
    $prewords = search_base($obj, $words);

    // ����������
    $multibase = query_multibase($obj);

    // ��� ��������
    if ($p == "all") {
        $sql = "select * from " . $SysValue['base']['products'] . " where $sort $prewords $multibase and enabled='1' and parent_enabled='0' order by num desc, items desc";
    }
    else
        while ($q < $p) {

            $sql = "select * from " . $SysValue['base']['products'] . " where  $string ($sort) $prewords $sortV $multibase and enabled='1' and parent_enabled='0' order by num desc, items desc LIMIT $num_ot, $num_row";
            $q++;
            $num_ot = $num_ot + $num_row;
        }

    // SQL ��� ������� �� id �������, ��������� ������.�������. ���� ��� ������������� ������.
    if($obj->isYandexSearch && empty($prewords)) {
        $sql = getYandexSearchSql($obj, $words, $p, $multibase, $cat);
    }

    $obj->search_order = array(
        'words' => $words,
        'pole' => $pole,
        'cat' => $cat,
        'string' => $string,
        'sort' => $sort,
        'prewords' => $prewords,
        'sortV' => $sortV
    );

    $obj->set('searchString', $words);

    if ($pole == 1)
        $obj->set('searchSetC', 'checked');
    else
        $obj->set('searchSetD', 'checked');
    
    // ���������� SQL ������
    return $sql;
}

/**
 * ������.�����
 * @param PHPShopSearch $obj
 * @param string $search
 * @param int $p
 * @param string $multibase
 * @param int $cat
 */
function getYandexSearchSql($obj, $search, $p, $multibase = null, $cat = 0)
{
    global $SysValue;

    if(isset($_REQUEST['ajax'])) {
        $_WORDS = explode(" ", $search);

        // ������� ������������ ����� �� ������ ���������.
        $wordsCount = count($_WORDS);
        if($wordsCount > 1) {
            $search = '';
            for($i = 0; $i < $wordsCount / 2; $i++) {
                $search .= ' ' . $_WORDS[$i];
            }
        }
    }

    $params = array(
        'apikey' => $obj->yandexSearchAPI,
        'searchid' => $obj->yandexSearchId,
        'text' => PHPShopString::win_utf8($search),
        'page' => $p - 1,
        'per_page' => $obj->num_row
    );

    if((int) $cat > 0) {
        $params['category_id'] = $cat;
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, PHPShopSearch::YANDEX_SEARCH_API_URL . '?' . http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = json_decode(curl_exec($ch),1);

    $obj->set('hideSearchType', 'hidden');
    if(is_array($data['misspell']['misspell'])) {
        $obj->set('searchMisspell', __('����� ����, �� ������: ') . '�<a href="/search?words=' . PHPShopString::utf8_win1251($data['misspell']['misspell']['text']) . '">' . PHPShopString::utf8_win1251($data['misspell']['misspell']['text']) . '</a>�.');
    } else {
        $obj->set('searchMisspell', '');
    }

    if(is_array($data['documents'])) {
        $ids = array();
        foreach ($data['documents'] as $document) {
            $ids[] = $document['id'];
        }

        return "select * from " . $SysValue['base']['products'] . " where id IN (" . implode(',', $ids) . ") $multibase and enabled='1' and parent_enabled='0' order by num desc, items desc";
    }

    return null;
}

/**
 * ������ ������������� ������ �� ��
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @param string $words ������ ������
 * @return string 
 */
function search_base($obj, $words) {
    $string = null;

    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->mysql_error = false;
    $PHPShopOrm->debug = $obj->debug;
    $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['search_base'] . " where name REGEXP 'i" . PHPShopSecurity::true_search($words) . "i'  and enabled='1' limit 1");
    $row = mysqli_fetch_array($result);

    // ������������� �� ������
    if (!empty($row['uid'])) {

        $uid = $row['uid'];
        if (strstr($row['uid'], ','))
            $uids = explode(",", $uid);
        else
            $uids[] = $uid;

        if (is_array($uids))
            $string = ' or id IN (' . @implode(",", $uids) . ') ';

        return $string;
    }
    // ������������� �� ���������
    else if (!empty($row['category'])) {
        header('Location: /' . $GLOBALS['dir']['dir'] . 'shop/CID_' . $row['category'] . '.html');
    } else if (!empty($row['link'])) {
        header('Location: ' . $row['link']);
    }
}

?>