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
        $this->cache=true;
        $this->objBase=$GLOBALS['SysValue']['base']['currency'];
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
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['currency']);
        $PHPShopOrm->cache=true;
        $data=$PHPShopOrm->select(array('*'),false,false,array('limit'=>100));
        if(is_array($data))
            foreach($data as $row) {
                $id=$row['id'];
                $iso=$row['iso'];
                $array[$iso]=$iso;
            }

        return $data;
    }

    function getArray() {
        return $this->getAll();
    }
}

/**
 * ������ ������ �� �������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopArray
 */
class PHPShopValutaArray extends PHPShopArray {

    function PHPShopValutaArray() {
        $this->objBase=$GLOBALS['SysValue']['base']['currency'];
        $this->objSQL=array('enabled'=>"='1'");
        parent::PHPShopArray('id',"name",'code','iso','kurs');
    }
}
?>