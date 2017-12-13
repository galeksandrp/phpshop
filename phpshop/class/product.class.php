<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__) . "/obj.class.php");
    require_once(dirname(__FILE__) . "/array.class.php");
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
     * @param string $var �������� ������ ������ [id|uid]
     */
    function PHPShopProduct($objID, $var = 'id') {
        $this->objID = $objID;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name2'];
        $this->cache = true;
        $this->debug = false;
        $this->cache_format = array('content');

        // ���� �������� ��� ������� �� ��������
        if (empty($var)) {
            if (PHPShopProductFunction::true_parent($objID))
                $var = 'uid';
            else {
                $objID = PHPShopSecurity::TotalClean($objID, 1);
                $var = 'id';
            }
        }
        // ������������� ����� ������ ������
        else
            $this->objID=PHPShopSecurity::true_search($objID);

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

    /**
     * ���� ������
     * @return float 
     */
    function getPrice() {
        $price_array = array($this->objRow['price'], $this->objRow['price2'], $this->objRow['price3'], $this->objRow['price4'], $this->objRow['price5']);
        return PHPShopProductFunction::GetPriceValuta($this->objID, $price_array, $this->objRow['baseinputvaluta']);
    }

    /**
     * ����������� ������
     * @return string 
     */
    function getImage() {
        return parent::getParam("pic_small");
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
    function PHPShopProductArray($sql = false) {
        $this->objSQL = $sql;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name2'];
        parent::PHPShopArray('id', 'uid', 'name', 'category', 'price', 'price_n', 'sklad', 'odnotip', 'vendor', 'title_enabled', 'datas', 'page', 'user', 'descrip_enabled', 'keywords_enabled', 'pic_small', 'pic_big', 'parent', 'baseinputvaluta');
    }

}

/**
 * ���������� ������� �� �������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopProductFunction {

    static function getLink() {
        $Arg = func_get_args();
        $link = '/shop/UID_' . $Arg[0] . '.html';
        return $link;
    }

    /**
     * �������� �� ������ ������ �� 1�
     * @param string $str ������ ������
     * @return bool
     */
    static function true_parent($str) {
        if (strstr($str, '-'))
            return preg_match("/^[a-zA-Z0-9]{8}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{4}-[a-zA-Z0-9]{12}$/", $str);
        else
            return preg_match("/^[a-zA-Z0-9]{36}$/", $str);
    }

    /**
     * ���� � ������ ������
     * @param int $id �� ������
     * @param float $price ��������� ������
     * @param int $baseinputvaluta �� ������ ������
     * @param bool $order �������� ������� ������ [true/false]
     * @param bool $check_user_price ��������������������� ������� ��� ������������ [true/false]
     * @return format
     */
    static function GetPriceValuta($id, $price_array, $baseinputvaluta = false, $order = false, $check_user_price = true) {
        global $PHPShopValutaArray, $PHPShopSystem;

        if (!is_array($price_array))
            $price = $price_array;
        else
            $price = $price_array[0];

        $LoadItems['Valuta'] = $PHPShopValutaArray->getArray();
        $LoadItems['System'] = $PHPShopSystem->getArray();


        // �������������� ����
        $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");
        if (empty($format))
            $format = 0;

        if (!empty($_SESSION['UsersStatus']) and !empty($check_user_price)) {

            if (empty($_SESSION['UsersStatusPice'])) {

                // ������� �� ���� ������ ������� ���� ��� �����. ������������
                $PHPShopUser = new PHPShopUserStatus($_SESSION['UsersStatus']);
                $GetUsersStatusPrice = $PHPShopUser->getPrice();
                $_SESSION['UsersStatusPice'] = $GetUsersStatusPrice;
            }
            else
                $GetUsersStatusPrice = $_SESSION['UsersStatusPice'];

            if ($GetUsersStatusPrice > 1) {
                $pole = "price" . $GetUsersStatusPrice;

                // ���� �� �������� ������ ������� ���
                if (!is_array($price_array)) {
                    $PHPShopProduct = new PHPShopProduct($id);
                    $user_price = $PHPShopProduct->getParam($pole);
                } else {
                    // ����� ���� �� �������
                    $user_price = $price_array[$GetUsersStatusPrice - 1];
                }
                if (!empty($user_price))
                    $price = $user_price;
            }
        }
        
        

        // ���� ������ ������
        if ($baseinputvaluta) { //���� �������� ���. ������
            if ($baseinputvaluta !== $LoadItems['System']['dengi']) {//���� ���������� ������ ���������� �� �������
                if ($LoadItems['Valuta'][$baseinputvaluta]['kurs']>0)
                    $price = $price / $LoadItems['Valuta'][$baseinputvaluta]['kurs']; //�������� ���� � ������� ������
            }
        }

        // ���� ������� ������ ������, order - ���� ��� ������� ������� ������ � ���. ������
        if ($order)
            $valuta = $LoadItems['System']['dengi'];
        elseif (isset($_SESSION['valuta']))
            $valuta = $_SESSION['valuta'];
        else
            $valuta = $LoadItems['System']['dengi'];

        // ������ �� ����
        if(!empty($valuta))
        $price = $price * $LoadItems['Valuta'][$valuta]['kurs'];

        // �������
        $price = ($price + (($price * $LoadItems['System']['percent']) / 100));
        return number_format($price, $format, '.', '');
    }

}

?>