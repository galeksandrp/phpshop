<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__) . "/obj.class.php");
    require_once(dirname(__FILE__) . "/array.class.php");
}

/**
 * ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopObj
 */
class PHPShopCategory extends PHPShopObj {

    /**
     * �����������
     * @param int $objID �� ���������
     */
    function __construct($objID) {
        $this->objID = $objID;
        $this->objBase = $GLOBALS['SysValue']['base']['categories'];
        $this->cache = false;
        $this->debug = false;
        parent::__construct('id');
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
        if (empty($this->cache))
            return parent::getParam("content");
        else {
            $PHPShopOrm = new PHPShopOrm($this->objBase);
            $data = $PHPShopOrm->select(array('content'), array('id' => '=' . intval($this->objID)), false, array('limit' => 1));
            return $data['content'];
        }
    }

    /**
     * �������� �� �������������
     * @return bool
     */
    function init() {
        $id = parent::getParam("id");
        if (!empty($id))
            return true;
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
    function __construct($objID) {
        $this->objID = $objID;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name11'];
        parent::__construct();
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
    function __construct($objID) {
        $this->objID = $objID;
        $this->objBase = $GLOBALS['SysValue']['base']['page_categories'];
        $this->cache = true;
        $this->debug = false;
        parent::__construct('id');
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
        $id = parent::getParam("id");
        if (!empty($id))
            return true;
    }

}

/**
 * ������ ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopArray
 */
class PHPShopCategoryArray extends PHPShopArray {

    /**
     * �����������
     * @param string $sql SQL ������� �������
     */
    function __construct($sql = false) {

        // ����������
        if (defined("HostID"))
            $sql['servers'] = " REGEXP 'i" . HostID . "i'";

        // ��������������� ������
        //$this->objArray = new SplFixedArray(count($data)+1);

        $this->objSQL = $sql;
        $this->cache = false;
        $this->debug = false;
        $this->ignor = false;
        $this->order = array('order' => 'num,name');
        $this->objBase = $GLOBALS['SysValue']['base']['categories'];
        parent::__construct("id", "name", "parent_to", "skin_enabled", "parent_title", "icon", "dop_cat", "vid", "num_row");
        //parent::__construct("content","sort","title","title_enabled","name_rambler","servers","title_shablon","descrip","descrip_enabled","descrip_shablon","keywords","keywords_enabled","keywords_shablon","order_by","order_to","skin","secure_groups","icon_description","sort_cache","sort_cache_created_at","yml");
    }

}

/**
 * ��������� �����������
 * ���������� ������ � ���������� ����������� 
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopPhotoCategory extends PHPShopObj {

    /**
     * �����������
     * @param int $objID �� ���������
     */
    function __construct($objID) {
        $this->objID = $objID;
        $this->objBase = $GLOBALS['SysValue']['base']['photo_categories'];
        $this->cache = true;
        $this->debug = false;
        parent::__construct('id');
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
        $id = parent::getParam("id");
        if (!empty($id))
            return true;
    }

}

/**
 * ������ ��������� �����������
 * ���������� ������ � ����������� �����������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopArray
 */
class PHPShopPhotoCategoryArray extends PHPShopArray {

    /**
     * �����������
     * @param string $sql SQL ������� �������
     */
    function __construct($sql = false) {
        $this->objSQL = $sql;
        $this->cache = false;
        $this->order = array('order' => 'num');
        $this->objBase = $GLOBALS['SysValue']['base']['photo_categories'];
        parent::__construct("id", "name", "parent_to", "link");
    }

}

?>