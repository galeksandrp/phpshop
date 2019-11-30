<?php

/**
 * SEO ��������� ��� ��������, ��� �������
 */
function index_seourl_hook($obj, $row, $rout) {
    global $seourl_option;

    if ($rout == 'START') {

        // ��������� �������� ��� ��������
        $seo_name = explode(".", str_replace("/page/", "", $obj->PHPShopNav->objNav['truepath']));


        // ���������� ������ .html.html
        if (count($seo_name) > 2) {
            $obj->setError404();
            return true;
        }

        if (!empty($seo_name[0])) {

            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->objBase = $GLOBALS['SysValue']['base']['page_categories'];
            $PHPShopOrm->mysql_error = false;

            $result = $PHPShopOrm->select(array('id, name, page_cat_seo_name'), array('page_cat_seo_name' => "='" . PHPShopSecurity::TotalClean($seo_name[0]) . "'"));

            // �������
            if ($result['id']) {
                
                // ��������� SEO
                $obj->navigation_seourl_array[$result['id']]=$result['page_cat_seo_name'];
                $obj->category_name = $result['name'];
                $obj->category = $result['id'];
                $obj->PHPShopCategory = new PHPShopPageCategory($obj->category);
                $obj->PHPShopNav->objNav['id'] = $result['id'];

                $PHPShopOrm->objBase = $GLOBALS['SysValue']['base']['page'];
                $dataArray = $obj->PHPShopOrm->select(array('*'), array('category' => '=' . $obj->category, 'enabled' => "='1'"), array('order' => 'num'), array('limit' => 100));
                if (count($dataArray) != 1 || empty($dataArray)) {
                    $PHPShopOrm->objBase = $GLOBALS['SysValue']['base']['page_categories'];
                    $obj->CID();

                    return true;
                } else {
                    // ��������
                    displayPage($obj, $dataArray[0]['link']);

                    return true;
                }
            }
        }
    }

    if ($rout == 'END')
        navigation_seourl($obj, $row['name']);
}

/**
 * SEO ��������� ��� ������ ������� 
 */
function ListPage_seourl_hook($obj, $row, $rout) {


    // ��������� ������ �� ����
    if ($_SESSION['Memory']['PHPShopSeourlOption']['seo_page_enabled'] != 2)
        return false;

    // �������� ������������ SEO ������
    if ($rout == 'START') {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
        $seoURL = $PHPShopOrm->select(array("page_cat_seo_name"), array("id=" => $obj->PHPShopNav->getId()));

        $url = $obj->PHPShopNav->getName(true);
        if (!empty($seoURL['page_cat_seo_name']))
            $url_true = $seoURL['page_cat_seo_name'];
        else
            $url_true = $GLOBALS['PHPShopSeoPro']->setLatin($obj->category_name);

        $url_pack = 'CID_' . $obj->PHPShopNav->getId();

        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->setError404();
            return true;
        } elseif ($url == $url_pack) {

            header('Location: ' . $url_true . '.html', true, 301);
            return true;
        }
    }

    if ($rout == 'END') {
        navigation_seourl($obj, $obj->category_name);
        // ���� ������ Mobile
        if (!empty($_GET['mobile']) and $_GET['mobile'] == 'true' and !empty($GLOBALS['SysValue']['base']['mobile']['mobile_system'])) {
            header('Location: ' . $obj->getValue('dir.dir') . '/page/CID_' . $obj->PHPShopNav->getId() . '.html', true, 302);
            return true;
        }
    }
}

/**
 * SEO ��������� ������ ���������
 */
function ListCategory_seourl_hook($obj, $dataArray, $rout) {

    // �������� ������������ SEO ������
    if ($rout == 'END') {
        $dis = null;

        // ��������� ������ �� ����
        if ($_SESSION['Memory']['PHPShopSeourlOption']['seo_page_enabled'] != 2)
            return false;

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
        $seoURL = $PHPShopOrm->select(array("page_cat_seo_name"), array("id=" => $obj->PHPShopNav->getId()));

        $url = $obj->PHPShopNav->getName(true);
        if (!empty($seoURL['page_cat_seo_name']))
            $url_true = $seoURL['page_cat_seo_name'];
        else
            $url_true = $GLOBALS['PHPShopSeoPro']->setLatin($obj->category_name);

        $url_pack = 'CID_' . $obj->PHPShopNav->getId();

        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->setError404();
            return true;
        } elseif ($url == $url_pack) {

            header('Location: ' . $url_true . '.html', true, 301);
            return true;
        }

        if (is_array($dataArray))
            foreach ($dataArray as $row) {
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
                $result = $PHPShopOrm->select(array("page_cat_seo_name"), array("id=" => $row['id']));
                if (!empty($result['page_cat_seo_name']))
                    $seoURL = $result['page_cat_seo_name'];
                else {
                    $seoURL = $GLOBALS['PHPShopSeoPro']->setLatin($row['name']);
                    $PHPShopOrm->update(array('page_cat_seo_name_new' => "$seoURL"), array('id=' => $row['id']));
                }
                $dis.=PHPShopText::li($row['name'], '/page/' . $seoURL . '.html');
            }

        $disp = PHPShopText::ul($dis);
        $obj->set('pageContent', $disp);

        // SEO ������� ������
        navigation_seourl($obj, $obj->category_name);
        if (!empty($_GET['mobile']) and $_GET['mobile'] == 'true' and !empty($GLOBALS['SysValue']['base']['mobile']['mobile_system'])) {
            header('Location: ' . $obj->getValue('dir.dir') . '/page/CID_' . $obj->PHPShopNav->getId() . '.html', true, 302);
            return true;
        }
    }
}

class PHPShopSeoPageCategoryArray extends PHPShopArray {

    function __construct($sql = false) {

        // ����������
        if (defined("HostID"))
            $sql['servers'] = " REGEXP 'i" . HostID . "i'";

        $this->objSQL = $sql;

        $this->objBase = $GLOBALS['SysValue']['base']['page_categories'];
        $this->order = array('order' => 'num');
        parent::__construct("id", "name", "parent_to","page_cat_seo_name");
    }

}

/**
 * SEO ��������� ������� ������
 */
function navigation_seourl($obj, $name) {
    
    $dis = null;
    
    $PHPShopSeoPageCategoryArray = new PHPShopSeoPageCategoryArray();

    // ��������� ������ �� ����
    if ($_SESSION['Memory']['PHPShopSeourlOption']['seo_page_enabled'] != 2)
        return false;

    // ������� ����������� ���������
    $spliter = ParseTemplateReturn($obj->getValue('templates.breadcrumbs_splitter'));
    $home = ParseTemplateReturn($obj->getValue('templates.breadcrumbs_home'));

    // ���� ��� ������� ������������
    if (empty($spliter))
        $spliter = ' / ';
    if (empty($home))
        $home = PHPShopText::a('/', __('�������'));

    if (is_array($obj->navigation_array))
        $arrayPath = array_reverse($obj->navigation_array);
   
   

    if (is_array($arrayPath)) {
        foreach ($arrayPath as $v) {
            $seo = $PHPShopSeoPageCategoryArray->getParam($v['id'].'.page_cat_seo_name');
            if(empty($seo))
            $dis.= $spliter . PHPShopText::a('/page/' . $GLOBALS['PHPShopSeoPro']->setLatin($v['name']) . '.html', $v['name']);
            else $dis.= $spliter . PHPShopText::a('/page/' . $seo . '.html', $v['name']);
        }
    }

    $dis = $home . $dis . $spliter . PHPShopText::b($name);
    $obj->set('breadCrumbs', $dis);
}

function displayPage($obj, $link) {

    // ��������� ������ �� ����
    if ($_SESSION['Memory']['PHPShopSeourlOption']['seo_page_enabled'] != 2)
        return false;

    // ������������
    if (empty($link))
        $link = PHPShopSecurity::TotalClean($obj->PHPShopNav->getName(true), 2);

    // �������� ������ ��� �������������
    if (isset($_SESSION['UsersId'])) {
        $sort = " and ((secure !='1') OR (secure ='1' AND secure_groups='') OR (secure ='1' AND secure_groups REGEXP 'i" . $_SESSION['UsersStatus'] . "-1i')) ";
    } else {
        $sort = " and (secure !='1') ";
    }


    // ����������
    if (defined("HostID")) {
        $sort.= " and servers REGEXP 'i" . HostID . "i'";
    } elseif (defined("HostMain"))
        $sort.= " and (servers = '' or servers REGEXP 'i1000i')";

    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->debug = $obj->debug;
    $result = $PHPShopOrm->query("select * from " . $obj->objBase . " where link='$link' and enabled='1' $sort limit 1");
    $row = mysqli_fetch_array($result);

    // ���������� �������� �� �����
    if ($row['category'] == 2000)
        return $obj->setError404();
    elseif (empty($row['id']))
        return $obj->setError404();

    $obj->category = $row['category'];
    $obj->PHPShopCategory = new PHPShopPageCategory($obj->category);
    $obj->category_name = $obj->PHPShopCategory->getName();

    // ���������� ����������
    $obj->set('pageContent', Parser(stripslashes($row['content'])));
    $obj->set('pageTitle', $row['name']);
    $obj->set('catalogCategory', $obj->category_name);
    $obj->set('catalogId', $obj->category);
    $obj->PHPShopNav->objNav['id'] = $row['id'];

    // �������� ���� �������
    $obj->set('NavActive', $row['link']);

    // ���������� ������
    $obj->odnotip($row);

    // ����
    if (empty($row['title']))
        $title = $row['name'] . " - " . $obj->PHPShopSystem->getValue("name");
    else
        $title = $row['title'];

    $obj->title = $title;
    $obj->description = $row['description'];
    $obj->keywords = $row['keywords'];
    $obj->lastmodified = $row['datas'];

    // ��������� ������� ������
    navigation_seourl($obj, $obj->category_name);

    // ���������� ������
    $obj->parseTemplate($obj->getValue('templates.page_page_list'));
}

$addHandler = array(
    'ListCategory' => 'ListCategory_seourl_hook',
    'ListPage' => 'ListPage_seourl_hook',
    'index' => 'index_seourl_hook'
);
?>
