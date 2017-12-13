<?php

if (!defined("OBJENABLED"))
    require_once(dirname(__FILE__)."/obj.class.php");

/**
 * ���������� ��������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopDelivery extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ��������
     */
    function PHPShopDelivery($objID=false) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['delivery'];
        parent::PHPShopObj();
    }

    /**
     * ������ ��������� ��������
     * @param float $sum ����� ������
     * @param float $weight ��� ������
     * @return float
     */
    function getPrice($sum,$weight=0) {
        $row = $this->objRow;
        if($row['price_null_enabled'] == 1 and $sum>=$row['price_null']) {
            return 0;
        } else {
            if ($row['taxa']>0) {
                $addweight=$weight-500;
                if ($addweight<0) {
                    $addweight=0;
                }
                $addweight=ceil($addweight/500)*$row['taxa'];
                $endprice=$row['price']+$addweight;
                return $at.$endprice;
            } else {
                return $row['price'];
            }
        }
    }

    /**
     * ����� ������ ��������
     * @return string
     */
    function getCity() {
        return parent::getParam("city");
    }

    function getPriceDefault() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
        $row=$PHPShopOrm->select(array('price'),array('flag'=>"='1'",'enabled'=>"='1'"),false,array('limit'=>1));
        return $row['price'];
    }
}
?>