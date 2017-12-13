<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__)."/product.class.php");
    require_once(dirname(__FILE__)."/security.class.php");
}

/**
 * ���������� ������� � ���������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopCompare {
    var $_COMPARE;

    /**
     * �����������
     */
    function PHPShopCompare() {
        $this->_COMPARE=&$_SESSION['compare'];
    }

    /**
     * ���������� � ��������� ������
     * @param int $objID �� ������
     */
    function add($objID) {
        $objID = PHPShopSecurity::TotalClean($objID,1);
        $objProduct = new PHPShopProduct($objID);
        $new=array(
                "id"=>$objID,
                "name"=>PHPShopSecurity::CleanStr($objProduct->getParam("name")),
                "category"=>$objProduct->getParam("category"));
        $this->_COMPARE[$objID]=$new;
    }

    /**
     * ������� ���������� ������� � ���������
     * @return <type>
     */
    function getNum() {
        return count($this->_COMPARE);
    }
}
?>