<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__) . "/product.class.php");
    require_once(dirname(__FILE__) . "/security.class.php");
}

/**
 * ���������� ������� � ���������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopCompare {

    var $_COMPARE;
    var $message;

    /**
     * �����������
     */
    function PHPShopCompare() {
        $this->_COMPARE = &$_SESSION['compare'];
    }

    /**
     * ���������� � ��������� ������
     * @param int $objID �� ������
     */
    function add($objID) {
        $objID = PHPShopSecurity::TotalClean($objID, 1);
        $objProduct = new PHPShopProduct($objID);
        $name = PHPShopSecurity::CleanStr($objProduct->getParam("name"));
        if (!is_array($this->_COMPARE[$objID])) {
            $new = array(
                "id" => $objID,
                "name" => $name,
                "category" => $objProduct->getParam("category"));
            $this->_COMPARE[$objID] = $new;

            // ��������� ��� ������ �� ����������� ����
            $this->message = "�� ������� �������� <a href='/shop/UID_$objID.html' title='��������� ��������'>$name</a> 
            �  <a href='/compare/' title='������� � ���� �������'>���������</a>";
        } else {
            // ��������� ��� ������ �� ����������� ����
            $this->message = "����� <a href='/shop/UID_$objID.html' title='��������� ��������'>$name</a> 
            ��� �������� � <a href='/compare/' title='������� � ���� �������'>���������</a>";
        }
    }

    /**
     * ��������� ��������� ��� ������������ ����
     */
    function getMessage($objID) {
        return $this->message;
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