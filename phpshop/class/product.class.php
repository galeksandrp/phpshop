<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__)."/obj.class.php");
    require_once(dirname(__FILE__)."/array.class.php");
}

/**
 * ���������� ������ �� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopProduct extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ������
     */
    function PHPShopProduct($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name2'];

        // ���� �������� ��� ������� �� ��������
        if(PHPShopProductFunction::true_parent($objID)) $var='uid';
        else {
            $objID = PHPShopSecurity::TotalClean($objID,1);
            $var='id';
        }

        parent::PHPShopObj($var);
    }

    /**
     * ��� ������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    /**
     * �� ������ ������
     * @return int
     */
    function getValutaID() {
        return parent::getParam("baseinputvaluta");
    }
}

/**
 * ������ ������ �� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopProductArray extends PHPShopArray {

    /**
     * �����������
     * @param string $sql SQL ������� �������
     */
    function PHPShopProductArray($sql="") {
        $this->objSQL=$sql;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name2'];
        parent::PHPShopArray('id','uid','name','category','price','price_n','sklad','odnotip','vendor','title_enabled',
                'datas','page','user','descrip_enabled','keywords_enabled','pic_small','pic_big','parent','baseinputvaluta');
    }
}

/**
 * ���������� ������� �� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopProductFunction {

    /**
     * �������� �� ������ ������ �� 1�
     * @param string $str ������ ������
     * @return bool
     */
    function true_parent($str) {
        return preg_match("/^[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}$/",$str);
    }

    /**
     * ���� � ������ ������
     * @param int $id �� ������
     * @param float $price ��������� ������
     * @param int $formats ���-�� ������ ����� ������� � ���������
     * @param int $baseinputvaluta �� ������ ������
     * @param bool $order �������� ������� ������ [true/false]
     * @return format
     */
    function GetPriceValuta($id,$price,$formats=0,$baseinputvaluta=false,$order=false) {
        global $SysValue,$LoadItems,$PHPShopValutaArray,$PHPShopSystem;

        if(!$LoadItems) {
            $LoadItems['Valuta']=$PHPShopValutaArray->getArray();
            $LoadItems['System']=$PHPShopSystem->getArray();
        }

        // ���� ������� ������ ������
        $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");

        // ������� �� ���� ������ ������� ���� ��� �����. ������������
        if(!empty($_SESSION['UsersStatus'])) {
            $PHPShopUser = new PHPShopUserStatus($_SESSION['UsersStatus']);
            $GetUsersStatusPrice=$PHPShopUser->getPrice();
            if($GetUsersStatusPrice>1) {
                $pole="price".$GetUsersStatusPrice;
                $PHPShopProduct = new PHPShopProduct($id);

                $user_price=$PHPShopProduct->getParam($pole);
                if(!empty($user_price)) $price=$user_price;

            }
        }

        // ���� ������ ������
        if ($baseinputvaluta) { //���� �������� ���. ������
            if ($baseinputvaluta!==$LoadItems['System']['dengi']) {//���� ���������� ������ ���������� �� �������
                $price=$price/$LoadItems['Valuta'][$baseinputvaluta]['kurs']; //�������� ���� � ������� ������
            }
        }

        // ���� ������� ������ ������, order - ���� ��� ������� ������� ������ � ���. ������
        if($order) $valuta=$LoadItems['System']['dengi'];
        elseif (isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
        else $valuta=$LoadItems['System']['dengi'];

        // ������ �� ����
        $price=$price*$LoadItems['Valuta'][$valuta]['kurs'];

        // �������
        $price=($price+(($price*$LoadItems['System']['percent'])/100));
        return number_format($price,$format,'.','');
    }
}
?>