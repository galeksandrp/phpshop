<?php

/**
 * ���������� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopPage
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopPage extends PHPShopCore {

    /**
     * ������� ��� ��������� ������� ������
     * @var string
     */
    var $navigationBase = 'base.page_categories';

    /**
     * ����� �������
     * @var bool
     */
    var $debug = false;

    /**
     * �����������
     */
    function PHPShopPage() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['page'];

        // ������ �������
        $this->action = array("nav" => "CID");
        parent::PHPShopCore();
    }

    /**
     * ����� ������������� �������
     * @param array $row ������ �������
     */
    function odnotip($row) {
        global $PHPShopProductIconElements;

        $disp = null;
        $odnotipList = null;
        if (!empty($row['odnotip'])) {
            if (strpos($row['odnotip'], ','))
                $odnotip = explode(",", $row['odnotip']);
            else
                $odnotip[] = trim($row['odnotip']);
        }

        // ������ ��� �������
        if (!empty($odnotip) and is_array($odnotip))
            foreach ($odnotip as $value) {
                $odnotipList.=' id=' . trim($value) . ' OR';
            }

        $odnotipList = substr($odnotipList, 0, strlen($odnotipList) - 2);

        if (!empty($odnotipList)) {
            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug = $this->debug;
            $result = $PHPShopOrm->query("select * from " . $this->getValue('base.products') . " where (" . $odnotipList . " and enabled='1') order by num");
            while ($row = mysql_fetch_assoc($result))
                $data[] = $row;
        }

        if (!empty($data) and is_array($data)) {

            // ������� � ����������� �����
            if (PHPShopParser::check($this->getValue('templates.main_product_odnotip_list'), 'productOdnotipList')) {
                $this->set('productOdnotipList', $PHPShopProductIconElements->seamply_forma($data, 2, 'main_spec_forma_icon'));
                $this->set('productOdnotip', __('������������� ������'));
            } else {
                // ������� � ������ �������
                $this->set('specMainTitle', __('������������� ������'));
                $this->set('specMainIcon', $PHPShopProductIconElements->seamply_forma($data, 1, 'main_spec_forma_icon'));
            }
        }
    }

    /**
     * ����� �� ���������, ����� ������ �� ��������
     * @return string
     */
    function index($link = false) {

        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ������������
        if (empty($link))
            $link = PHPShopSecurity::TotalClean($this->PHPShopNav->getName(true), 2);

        // �������� ������ ��� �������������
        if (isset($_SESSION['UsersId'])) {
            $sort = " and ((secure !='1') OR (secure ='1' AND secure_groups='') OR (secure ='1' AND secure_groups REGEXP 'i" . $_SESSION['UsersStatus'] . "-1i')) ";
        } else {
            $sort = " and (secure !='1') ";
        }

        $PHPShopOrm = new PHPShopOrm();
        $PHPShopOrm->debug = $this->debug;
        $result = $PHPShopOrm->query("select * from " . $this->objBase . " where link='$link' and enabled='1' $sort limit 1");
        $row = mysql_fetch_array($result);

        // ���������� �������� �� �����
        if ($row['category'] == 2000)
            return $this->setError404();
        elseif (empty($row['id']))
            return $this->setError404();

        $this->category = $row['category'];
        $this->PHPShopCategory = new PHPShopPageCategory($this->category);
        $this->category_name = $this->PHPShopCategory->getName();

        // ���������� ����������
        $this->set('pageContent', Parser(stripslashes($row['content'])));
        $this->set('pageTitle', $row['name']);
        $this->set('catalogCategory', $this->category_name);
        $this->set('catalogId', $this->category);

        // �������� ���� �������
        $this->set('NavActive', $row['link']);

        // ���������� ������
        $this->odnotip($row);

        // ����
        if (empty($row['title']))
            $title = $row['name'] . " - " . $this->PHPShopSystem->getValue("name");
        else
            $title = $row['title'];
        $this->title = $title;
        $this->description = $row['description'];
        $this->keywords = $row['keywords'];
        $this->lastmodified = $row['datas'];

        // ��������� ������� ������
        $this->navigation($row['category'], $row['name']);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� CID
     */
    function CID() {

        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        // ID ���������
        $this->category = PHPShopSecurity::TotalClean($this->PHPShopNav->getId(), 1);
        $this->PHPShopCategory = new PHPShopPageCategory($this->category);
        $this->category_name = $this->PHPShopCategory->getName();

        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
        $PHPShopOrm->debug = $this->debug;
        $row = $PHPShopOrm->select(array('id,name'), array('parent_to' => "=" . $this->category), false, array('limit' => 1));

        // ���� ��������
        if (empty($row['id'])) {

            $this->ListPage();
        }
        // ���� ��������
        else {

            $this->ListCategory();
        }
    }

    /**
     * ����� ������ �������
     * @return string
     */
    function ListPage() {
        $dis = null;
        $lastmodified = 0;

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // 404
        if (empty($this->category_name))
            return $this->setError404();

        // ������� ������
        $dataArray = $this->PHPShopOrm->select(array('*'), array('category' => '=' . $this->category, 'enabled' => "='1'"), array('order' => 'num'), array('limit' => 100));
        if (is_array($dataArray)) {

            if (count($dataArray) > 1)
                foreach ($dataArray as $row) {
                    $dis.=PHPShopText::li($row['name'], '/page/' . $row['link'] . '.html');

                    // ������������ ���� ���������
                    if ($row['datas'] > $lastmodified)
                        $lastmodified = $row['datas'];
                }
            else {
                return $this->index($dataArray[0]['link']);
            }
        }


        $disp = PHPShopText::ul($dis);

        // �������� ��������
        $this->set('catContent', $this->PHPShopCategory->getContent());
        $this->set('pageContent', $disp);
        $this->set('pageTitle', $this->category_name);

        // ������ ������������ ���������
        $cat = $this->PHPShopCategory->getValue('parent_to');
        if (!empty($cat)) {
            $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
            $PHPShopOrm->cache = true;
            $PHPShopOrm->debug = $this->debug;
            $parent_category_row = $PHPShopOrm->select(array('id,name'), array('id' => '=' . $cat), false, array('limit' => 1), __FUNCTION__);
        } else {
            $parent_category_row['name'] = $this->lang('catalog');
        }
        $this->set('catalogCategory', $parent_category_row['name']);
        $this->set('catalogId', $cat);

        // ����
        $this->title = $this->category_name . " - " . $this->PHPShopSystem->getValue("name");
        $this->lastmodified = $lastmodified;

        // ��������� ������� ������
        $this->navigation($cat, $this->category_name);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� ������ ���������
     */
    function ListCategory() {
        $dis = null;

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // 404
        if (empty($this->category_name))
            return $this->setError404();

        // ������� ������
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
        $PHPShopOrm->debug = $this->debug;
        $dataArray = $PHPShopOrm->select(array('name', 'id'), array('parent_to' => '=' . $this->category), array('order' => 'num'), array('limit' => 100));
        if (is_array($dataArray))
            foreach ($dataArray as $row) {

                $dis.=PHPShopText::li($row['name'], '/page/CID_' . $row['id'] . '.html');
            }

        // ������ ������������
        $disp = PHPShopText::ul($dis);

        // �������� ��������
        $this->set('catContent', $this->PHPShopCategory->getContent());
        $this->set('catName', $this->category_name);
        $this->set('pageContent', $disp);
        $this->set('pageTitle', $this->category_name);

        // ����
        $this->title = $this->category_name . " - " . $this->PHPShopSystem->getValue("name");

        // ��������� ������� ������
        $this->navigation($this->PHPShopCategory->getParam('parent_to'), $this->category_name);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_catalog_list'));
    }

}

?>