<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__)."/obj.class.php");
}
require_once(dirname(__FILE__)."/array.class.php");

/**
 * ���������� �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopValuta extends PHPShopObj {

    /**
     * ������������
     * @param int $objID �� ������
     */
    function PHPShopValuta($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name24'];
        parent::PHPShopObj();
    }

    /**
     * ����� ����� ������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    /**
     * ����� ISO ������
     * @return string
     */
    function getIso() {
        return parent::getParam("iso");
    }

    /**
     * ����� ����� ������
     * @return float
     */
    function getKurs() {
        return parent::getParam("kurs");
    }

    /**
     * ����� ���� ������
     * @return string
     */
    function getCode() {
        return parent::getParam("code");
    }


    /**
     * ������ ���� �������� �� ����� ISO
     * ������: PHPShopValuta::getAll()
     * @return array
     */
    function getAll() {
        $sql="select * from ".$GLOBALS['SysValue']['base']['table_name24'];
        $result=mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
            $id=$row['id'];
            $iso=$row['iso'];
            $array[$iso]=$iso;
        }

        return $array;
    }

    function getArray() {
        return $this->getAll();
    }
}

/**
 * ������ ������ �� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopValutaArray extends PHPShopArray {

    function PHPShopValutaArray() {
        $this->objBase=$GLOBALS['SysValue']['base']['table_name24'];
        parent::PHPShopArray('id',"name",'code','iso','kurs');
    }
}
?>