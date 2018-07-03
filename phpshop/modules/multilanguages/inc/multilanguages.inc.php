<?php

/**
 * ������� ��������� ������ �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

class PHPShopMultilanguagesElement extends PHPShopElements {

    /**
     * @var bool  ���������� ������ �� �������
     */
    var $disp_only_index = false;

    /**
     * @var Int ���-�� �������
     */
    var $limit = 3;

    /**
     * ���������� �������� ��������� [num|name]
     * @var string 
     */
    var $root_order = 'num, name';

    /**
     * �����������
     */
    function __construct() {

        // �������
        $this->debug = false;

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['categories'];
        parent::__construct();
    }

    /**
     * ����� ��������� ����������
     * @return string
     */
    function lastForma() {
        $ini = $_SERVER['DOCUMENT_ROOT'] . "/phpshop/modules/multilanguages/inc/lang" . $_SESSION['lang_prefix'] . ".ini";



        if (file_exists($ini)) {
            $SysValue = parse_ini_file($ini, 1);

            if (!empty($SysValue['lang']) and is_array($SysValue['lang'])) {
                foreach ($SysValue['lang'] as $k => $v) {
                    if (!strstr($k, '#'))
                        $GLOBALS['SysValue']['multilanguages'][$k] = $v;
                }
            }
            else
                $SysValue['lang'] = null;
        }


        foreach ($GLOBALS['SysValue']['multilanguages'] as $key => $value) {
            $this->set($key, $value);
        }

        global $link_db;
        $sql = 'SELECT * FROM `phpshop_modules_multilanguages` WHERE enabled="1"';
        $query = mysqli_query($link_db, $sql);
        $multilanguages = mysqli_fetch_array($query);
        do {
            $multilanguages_new[] = $multilanguages;
            if ($_SESSION['lang_prefix'] == '_' . $multilanguages['prefix']) {
                $selected_prefix = $multilanguages['prefix'];
            }
        } while ($multilanguages = mysqli_fetch_array($query));

        if ($selected_prefix == '') {
            $selected_prefix = 'ru';
        }

        $m_menu = '<li><a href="?lang_prefix=ru">�������</a></li>';
        if (is_array($multilanguages_new)) {

            foreach ($multilanguages_new as $key => $value) {
                $m_menu .= '<li><a href="?lang_prefix=' . $value['prefix'] . '">' . $value['name'] . '</a></li>';
            }
        }

        $lang_menu = '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-angle-down" aria-hidden="true"></i> ' . $selected_prefix . '</a>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            ' . $m_menu . '
                        </ul>';

        $this->set('lang_panel_menu_top', $lang_menu);
    }

    /**
     * ����� ��������� ���������
     * @param array $replace ������ ������ ������
     * @param array $where ������ ���������� �������, ������������ ��� ������ ������������� ��������
     * PHPShopShopCatalogElement::leftCatal(false,$where['id']=1);
     * @return string
     */
    function leftCatalMulti($replace = null, $where = null) {
        $dis = null;
        $i = 0;

        $this->set('thisCat', $this->PHPShopNav->getId());

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $where, 'START');
        if ($hook)
            return $hook;

        // �������� �������
        if (empty($where))
            $where['parent_to'] = '=0';

        // �� �������� ������� ��������
        $where['skin_enabled '] = "!='1'";

        // ����������
        if (defined("HostID"))
           $where['servers'] = " REGEXP 'i" . HostID . "i'";

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->cache_format = $this->cache_format;
        $PHPShopOrm->cache = $this->cache;
        $PHPShopOrm->debug = $this->debug;

        $this->data = $PHPShopOrm->select(array('*'), $where, array('order' => $this->root_order), array("limit" => 100), __CLASS__, __FUNCTION__);
        if (is_array($this->data))
            foreach ($this->data as $row) {

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                $multilanguages = unserialize($row['multilanguages']);


                // ���������� ����������
                $this->set('catalogId', $row['id']);
                $this->set('catalogI', $i);
                $this->set('catalogTemplates', $this->getValue('dir.templates') . chr(47) . $this->PHPShopSystem->getValue('skin') . chr(47));
                $this->set('catalogPodcatalog', $this->subcatalog($row));
                $this->set('catalogTitle', $row['title']);

                //���
                if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                    $this->set('catalogName', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                else
                    $this->set('catalogName', $row['name']);

                // ������
                if (empty($row['icon']))
                    $row['icon'] = $this->no_photo;
                $this->set('catalogIcon', $row['icon']);
                $this->set('catalogIconDesc', $row['icon_description']);

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                // ���� ��� ������������
                if ($this->chek($row['id'])) {
                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_forma_3'));
                }
                // ���� ���� �����������
                else {
                    if ($row['vid'] == 1) {
                        $dis.=$this->parseTemplate($this->getValue('templates.catalog_forma_2'));
                    } else {
                        $dis.=$this->parseTemplate($this->getValue('templates.catalog_forma'));
                    }
                }
                $i++;
            }

        // ������ ������
        if (is_array($replace)) {
            foreach ($replace as $key => $val)
                $dis = str_replace($key, $val, $dis);
        }

        $this->set('leftCatalMulti', $dis);
    }

    /**
     * ����� ������������
     * @param int $n �� ��������
     * @return string
     */
    function subcatalog($parent_data) {

        // ID ��������
        $n = $parent_data['id'];
        $i = 1;

        $dis = null;

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->cache_format = $this->cache_format;
        $PHPShopOrm->cache = $this->cache;
        $PHPShopOrm->debug = $this->debug;

        $where['parent_to'] = '=' . $n;

        // �� �������� ������� �������� � �������������� ��������
        $where['skin_enabled'] = "!='1' or dop_cat LIKE '%#$n#%'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif(defined("HostMain"))
            $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';
        
        // ���������� ��������
        switch ($parent_data['order_to']) {
            case(1): $order_direction = "";
                break;
            case(2): $order_direction = " desc";
                break;
            default: $order_direction = "";
                break;
        }
        switch ($parent_data['order_by']) {
            case(1): $order = array('order' => 'name' . $order_direction);
                break;
            case(2): $order = array('order' => 'name' . $order_direction);
                break;
            case(3): $order = array('order' => 'num' . $order_direction);
                break;
            default: $order = array('order' => 'num' . $order_direction);
                break;
        }

        $data = $PHPShopOrm->select(array('*'), $where, $order, array('limit' => 100), __CLASS__, __FUNCTION__);


        if (is_array($data))
            foreach ($data as $row) {

                $multilanguages = unserialize($row['multilanguages']);
                // ���������� ����������
                //���
                if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                    $this->set('catalogName', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                else
                    $this->set('catalogName', $row['name']);

                $this->set('catalogUid', $row['id']);
                $row['i'] = $i;

                // ������
                if (empty($row['icon']))
                    $row['icon'] = $this->no_photo;
                $this->set('catalogIcon', $row['icon']);
                $this->set('catalogIconDesc', $row['icon_description']);

                $PHPShopCategory = new PHPShopCategory($n);
                $this->set('catalogTitle', $PHPShopCategory->getName());

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row);

                // ���������� ������
                $dis.=ParseTemplateReturn($this->getValue('templates.podcatalog_forma'));
                $i++;
            }
        return $dis;
    }

    /**
     * ����� �������� �������������� ����
     * @return string
     */
    function topMenuMulti() {
        $dis = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        $where['category'] = "=1000";
        $where['enabled'] = "='1'";

        
        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif(defined("HostMain"))
            $where['enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $objBase = $GLOBALS['SysValue']['base']['page'];
        $PHPShopOrm = new PHPShopOrm($objBase);
        $PHPShopOrm->debug=false;

        $data = $PHPShopOrm->select(array('name', 'link', 'multilanguages'), $where, array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {
                $multilanguages = unserialize($row['multilanguages']);
                // ���������� ����������
                //���
                if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                    $this->set('topMenuName', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                else
                    $this->set('topMenuName', $row['name']);


                // ���������� ����������
                $this->set('topMenuLink', $row['link']);

                // �������� ��������
                if ($row['link'] == $this->PHPShopNav->getName(true))
                    $this->set('topMenuActive', 'active');
                else
                    $this->set('topMenuActive', '');

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $dis.=$this->parseTemplate($this->getValue('templates.top_menu'));
            }

        $this->set('topMenuMulti', $dis);
    }

    /**
     * ����� ��������� ���������
     * @return string
     */
    function pageCatalMulti() {
        $dis = null;
        $i = 0;

        $this->PHPShopOrm->cache = true;
        $data = $this->PHPShopOrm->select(array('*'), array('parent_to' => '=0'), array('order' => 'num'), array("limit" => 100));

        // �������� ������ � ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $data, 'START');
        if ($hook)
            return $hook;

        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $this->set('catalogId', $row['id']);
                $this->set('catalogI', $i);
                $this->set('catalogTemplates', $this->getValue('dir.templates') . chr(47) . $this->PHPShopSystem->getValue('skin') . chr(47));

                // ���� ���� ��������
                if ($this->chek($row['id'])) {

                    $multilanguages = unserialize($row['multilanguages']);
                    // ���������� ����������
                    //���
                    if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                        $this->set('catalogName', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                    else
                        $this->set('catalogName', $row['name']);

                    $this->set('catalogId', $row['id']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_page_forma_2'));
                } else {
                    $this->set('catalogPodcatalog', $this->subcatalog($row['id']));

                    $multilanguages = unserialize($row['multilanguages']);
                    // ���������� ����������
                    //���
                    if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                        $this->set('catalogName', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                    else
                        $this->set('catalogName', $row['name']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_page_forma'));
                }

                $i++;
            }
        $this->set('pageCatalMulti', $dis);
    }

    /**
     * ����� ��������� ��������
     * @return string
     */
    function miniNewsMulti() {
        $dis = null;

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, false, 'START');

        if ($this->PHPShopNav->index())
            $view = true;
        else
            $view = false;

        if (!empty($view)) {

            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);
            $result = $PHPShopOrm->select(array('id', 'zag', 'datas', 'kratko', 'multilanguages'), false, array('order' => 'id DESC'), array("limit" => 5));

            // �������� �� �������� ������
            if ($this->limit > 1)
                $data = $result;
            else
                $data[] = $result;


            if (is_array($data))
                foreach ($data as $row) {

                    $multilanguages = unserialize($row['multilanguages']);
                    // ���������� ����������
                    //���
                    if ($multilanguages['multilanguages_name'][$_SESSION['lang_id']] != '')
                        $this->set('newsZag', $multilanguages['multilanguages_name'][$_SESSION['lang_id']]);
                    else
                        $this->set('newsZag', $row['zag']);


                    if ($multilanguages['multilanguages_content'][$_SESSION['lang_id']] != '')
                        $this->set('newsKratko', $multilanguages['multilanguages_content'][$_SESSION['lang_id']]);
                    else
                        $this->set('newsKratko', $row['kratko']);

                    // ���������� ����������
                    $this->set('newsId', $row['id']);
                    //$this->set('newsZag', $row['zag']);
                    $this->set('newsData', $row['datas']);
                    //$this->set('newsKratko', $row['kratko']);
                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    // ���������� ������
                    $dis.=$this->parseTemplate($this->getValue('templates.news_main_mini'));
                }
            $this->set('miniNewsMulti', $dis);
        }
    }

}

$PHPShopMultilanguagesElement = new PHPShopMultilanguagesElement();

// ������ � ���������
$PHPShopMultilanguagesElement->lastForma();
$PHPShopMultilanguagesElement->leftCatalMulti();
$PHPShopMultilanguagesElement->topMenuMulti();
$PHPShopMultilanguagesElement->pageCatalMulti();
$PHPShopMultilanguagesElement->miniNewsMulti();

if ($_GET['lang_prefix']) {
    global $link_db;
    $sql = 'SELECT * FROM `phpshop_modules_multilanguages` WHERE prefix="' . $_GET['lang_prefix'] . '" LIMIT 1';
    $query = mysqli_query($link_db, $sql);
    $multilanguages = mysqli_fetch_array($query);


    $_SESSION['lang_prefix'] = '_' . $_GET['lang_prefix'];
    $_SESSION['lang_id'] = $multilanguages['id'];
}

if ($_GET['lang_prefix'] == 'ru') {
    $_SESSION['lang_prefix'] = '';
    $_SESSION['lang_id'] = '';
}


if ($_GET['lang_prefix'] != '') {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL']);
    exit();
}
?>