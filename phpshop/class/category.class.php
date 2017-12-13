<?php

if (!defined("OBJENABLED")){
require_once(dirname(__FILE__)."/obj.class.php");
require_once(dirname(__FILE__)."/array.class.php");
}

/**
 * ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopCategory extends PHPShopObj {
    /**
     * �����������
     * @param int $objID �� ���������
     */
    function PHPShopCategory($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name'];
        $this->cache=false;
        $this->debug=false;
        parent::PHPShopObj('id');
    }
    /**
     * ������ ����� ���������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }
    /**
     * ������ �������� ���������
     * @return string
     */
    function getContent() {
        return parent::getParam("content");
    }
    /**
     * �������� �� �������������
     * @return bool
     */
    function init() {
        $id=parent::getParam("id");
        if(!empty($id)) return true;
    }

}

/**
 * ��������
 * ���������� ������ � ���������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopPages extends PHPShopObj {

    /**
     * �����������
     * @param int $objID �� ��������
     */
    function PHPShopPages($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name11'];
        parent::PHPShopObj();
    }
    /**
     * ������ ����� ��������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    /**
     * ������ ����������
     * @return string
     */
    function getContent() {
        return parent::getParam("content");
    }
}

/**
 * ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopPageCategory extends PHPShopObj {
    /**
     * �����������
     * @param int $objID �� ���������
     */
    function PHPShopPageCategory($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['page_categories'];
        $this->cache=true;
        $this->debug=false;
        parent::PHPShopObj('id');
    }
    /**
     * ������ ����� ���������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }
    /**
     * ������ �������� ���������
     * @return string
     */
    function getContent() {
        return parent::getParam("content");
    }
    /**
     * �������� �� �������������
     * @return bool
     */
    function init() {
        $id=parent::getParam("id");
        if(!empty($id)) return true;
    }

}

/**
 * ������ ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopCategoryArray extends PHPShopArray {

    function PHPShopCategoryArray() {
        $this->cache=false;
        $this->order=array('order'=>'num');
        $this->objBase=$GLOBALS['SysValue']['base']['categories'];
        parent::PHPShopArray("id","name","parent_to");
    }
}
?>