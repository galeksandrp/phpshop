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

    /**
     * �����������
     * @param int $objID �� ������ ������
     */
    function PHPShopPayment($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name48'];
        parent::PHPShopObj();
    }

    /**
     * ��� ������ ������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    /**
     * �� ������
     * @return int
     */
    function getId() {
        return parent::getParam("id");
    }
}
?>