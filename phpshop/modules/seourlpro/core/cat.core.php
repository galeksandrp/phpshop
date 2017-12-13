<?php

include_once("phpshop/core/shop.core.php");

class PHPShopSeoProCore extends PHPShopShop {

    function __construct() {

        // �������
        $this->debug = false;

        $this->path = '/shop';

        // ������ �������
        $this->action = array("nav" => "index");

        parent::PHPShopShopCore();
    }

    function index() {

        $this->page = $GLOBALS['PHPShopNav']->objNav['page'];
        $this->PHPShopNav->objNav['nav'] = 'CID';
        $GLOBALS['SysValue']['nav']['nav'] = 'CID';

        if (!empty($GLOBALS['PHPShopNav']->objNav['id']))
            parent::CID();
        else
            parent::setError404();
    }

    function query_filter($where = false) {

        // �������� ������
        if ($this->setHook(get_parent_class(), __FUNCTION__, $row))
            return true;

        return parent::doLoadFunction(__CLASS__, __FUNCTION__, false, 'shop');
    }

    function set_meta($row) {
        global $seourl_option;

        // �������� ������
        if ($this->setHook(get_parent_class(), __FUNCTION__, $row))
            return true;

        parent::doLoadFunction(__CLASS__, __FUNCTION__, $row, 'shop');

        if ($seourl_option['paginator'] == 2) {
            if ($this->PHPShopNav->getPage() > 1) {
                $this->doLoadFunction('PHPShopShop', 'set_meta', $row);
                $this->description.= ' ����� ' . $this->PHPShopNav->getPage();
                $this->title.=' �������� ' . $this->PHPShopNav->getPage();
                return true;
            } elseif ($this->PHPShopNav->getPage() == 'ALL') {
                $this->doLoadFunction('PHPShopShop', 'set_meta', $row);
                $this->title.=' ��� ��������';
                $this->set('catalogCategory', ' - ��� ��������', true);
                return true;
            }
        }
    }

}

class PHPShopCat extends PHPShopCore {

    function __construct() {

        // ��������� ������� ������ ���������
        //$GLOBALS['PHPShopSeoPro']->catCacheToMemory();
        $GLOBALS['PHPShopSeoPro']->true_dir = 'cat';
        $GLOBALS['PHPShopSeoPro']->setRout();

        $PHPShopSeoProCore = new PHPShopSeoProCore();
        $PHPShopSeoProCore->loadActions();
    }

}

?>