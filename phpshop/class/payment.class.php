<?php

if (!defined("OBJENABLED"))
    require_once(dirname(__FILE__)."/obj.class.php");

/**
 * ���������� ������ �� ������� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopPayment extends PHPShopObj {
    var $debug=false;

    /**
     * �����������
     * @param int $objID �� ������ ������
     */
    function PHPShopPayment($objID) {
        $this->objID=$objID;
        $this->order=array('order'=>'num');
        $this->objBase=$GLOBALS['SysValue']['base']['payment_systems'];
        parent::PHPShopObj();
    }

    /**
     * ��� ������ ������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    function getPath() {
        return parent::getParam("path");
    }

    /**
     * �� ������
     * @return int
     */
    function getId() {
        return parent::getParam("id");
    }
}

/**
 * ������ �������� �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopPaymentArray extends PHPShopArray {

    function PHPShopPaymentArray() {
        $this->order=array('order'=>'num');
        $this->objBase=$GLOBALS['SysValue']['base']['payment_systems'];
        parent::PHPShopArray('id',"name",'path','enabled');
    }
}
?>