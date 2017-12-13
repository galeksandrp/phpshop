<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__)."/obj.class.php");
}

/**
 * ���������� ������ ���������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopUser extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ��������������
     */
    function PHPShopUser($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name27'];
        parent::PHPShopObj();
    }

    /**
     * ����� ����� ������������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

}

/**
 * ���������� ������ �������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopUserStatus extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ������� ������������
     */
    function PHPShopUserStatus($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name28'];
        parent::PHPShopObj();
    }

    /**
     * ����� ������� ������ � ������������
     * @return int
     */
    function getPrice() {
        return parent::getParam("price");
    }

    /**
     * ����� ������ � ������������
     * @return float
     */
    function getDiscount() {
        return parent::getParam("discount");
    }

}

/**
 * ���������� ������� ��� �������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopUserFunction {

    /**
     * �������� ��������� ������ � ������������
     * @param float $mysum ��������� ������
     * @return array
     */
    function ChekDiscount($mysum) {
        global $PHPShopSystem;

        $maxsum=0;
        $userdiscount=0;
        $maxdiscount=0;

        $sql="select * from ".$GLOBALS['SysValue']['base']['table_name23']." where sum < '$mysum' and enabled='1'";
        $result=mysql_query($sql);
        while($row = mysql_fetch_array($result)) {
            $sum=$row['sum'];
            if($sum>$maxsum) {
                $maxsum=$sum;
                $maxdiscount=$row['discount'];
            }
        }

        if(!empty($_SESSION['UsersStatus'])) {
            $PHPShopUserStatus = new PHPShopUserStatus($_SESSION['UsersStatus']);
            $userdiscount = $PHPShopUserStatus->getDiscount();
        } else $userdiscoun=0;

        if($userdiscount>$maxdiscount) $maxdiscount=$userdiscount;

        $sum=$mysum-($mysum*@$maxdiscount/100);
        $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");
        $array=array(0+@$maxdiscount,number_format($sum,$format,".",""));

        return $array;
    }
}
?>