<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__) . "/product.class.php");
    require_once(dirname(__FILE__) . "/security.class.php");
}

/**
 * ������� �������
 * @author PHPShop Software
 * @version 1.9
 * @package PHPShopClass
 */
class PHPShopCart {

    var $_CART = array();
    var $message;

    /**
     * ����� �������� �������� �� ������
     */
    var $store_check = true;

    var $PHPShopModules;

    /**
     * �����������
     */
    function __construct($import_cart = false) {
        global $PHPShopSystem, $PHPShopValutaArray, $PHPShopModules;

        if (!is_array($_SESSION['cart']))
            unset($_SESSION['cart']);

        // ����� �������� �������� �� ������
        if ($PHPShopSystem->getSerilizeParam('admoption.sklad_status') == 1)
            $this->store_check = false;

        if (!class_exists('PHPShopProduct')) {
            PHPShopObj::loadClass('array');
            PHPShopObj::loadClass('product');
            PHPShopObj::loadClass('promotions');
        }

        if (!class_exists('PHPShopValutaArray')) {
            PHPShopObj::loadClass('array');
            PHPShopObj::loadClass('valuta');
            $PHPShopValutaArray = new PHPShopValutaArray();
        }


        $this->Valuta = $PHPShopValutaArray->getArray();
        $this->format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");

        if ($import_cart)
            $this->_CART = $import_cart;
        else
            $this->_CART = &$_SESSION['cart'];

        $this->PHPShopModules = &$PHPShopModules;
    }

    /**
     * ���������� � ������� ������
     * @param int $objID �� ������
     */
    function add($objID, $num, $parentID = false, $var = false) {

        // ������ �� ������
        $objProduct = new PHPShopProduct($objID, $var);

        // ���� ������� ������
        if (!empty($_REQUEST['addname'])) {
            $xid = $objID . '-' . $_REQUEST['addname'];
        } else
            $xid = $objID;

        if ($parentID == 'undefined')
            $parentID = false;

        // ��� ������
        $name = PHPShopSecurity::CleanStr($objProduct->getParam("name"));

        // �������� �� ������������� ������
        if (!empty($name)) {

            // ������ �������
            $cart = array(
                "id" => $objProduct->getParam("id"),
                "name" => $name,
                "price" => $this->getCartProductPrice($objProduct),
                "price_n" => $this->getCartProductPrice($objProduct, 'price_n'),
                "uid" => $objProduct->getParam("uid"),
                "num" => abs($this->_CART[$xid]['num'] + $num),
                "ed_izm" => $objProduct->getParam("ed_izm"),
                "pic_small" => $objProduct->getParam("pic_small"),
                "weight" => $objProduct->getParam("weight"),
                "categories" => $objProduct->getParam("categories")
            );

            $weight = $objProduct->getParam("weight");
            if (!empty($weight))
                $cart['weight'] = $weight;

            if (!empty($parentID)) {
                $objID = $cart['parent'] = intval($parentID);
            }

            // ����������� �������� ������
            if (empty($cart['pic_small'])) {
                $objProductParent = new PHPShopProduct($cart['parent']);
                $cart['pic_small'] = $objProductParent->getImage();
                $cart['parent_uid'] = $objProductParent->getParam('uid');
            }


            // �������� ���-�� ������ �� ������
            if ($this->store_check) {
                if ($cart['num'] > PHPShopSecurity::TotalClean($objProduct->getParam("items"), 1))
                    $cart['num'] = PHPShopSecurity::TotalClean($objProduct->getParam("items"), 1);
            }

            // ���� ������� ������
            if (!empty($_REQUEST['addname']))
                $cart['name'] = $cart['name'] . '-' . $_REQUEST['addname'];

            if (!empty($cart['num']))
                $this->_CART[$xid] = $cart;

            // ��������� ��� ������ �� ����������� ����
            $this->message = __("�� ������� ��������") . " <a href='" . $GLOBALS['SysValue']['dir']['dir'] . "/shop/UID_$objID.html'>$name</a> 
            " . __("� ����") . " <a href='" . $GLOBALS['SysValue']['dir']['dir'] . "/order/'>" . __("�������") . "</a>";

            return true;
        }
    }

    /**
     * ��������� ��������� ��� ������������ ����
     */
    function getMessage() {
        return $this->message;
    }

    /**
     * �������� �� ������� ������
     * @param int $objID �� ������
     */
    function del($objID) {
        unset($this->_CART[$objID]);
    }

    /**
     * ������� ���� �������
     */
    function clean() {
        unset($this->_CART);
        $_SESSION['cart'] = array();
        unset($_SESSION['cart']);
    }

    /**
     * ����� ���������� �������
     * @return int
     */
    function getNum() {
        $num = 0;
        if (is_array($this->_CART))
            foreach ($this->_CART as $val)
                $num += $val['num'];
        return $num;
    }

    /**
     * �������� ����������
     */
    function checkPromo() {
        $PHPShopPromotions = new PHPShopPromotions();
        
        // ����� ������� �� �����
        foreach ($this->_CART as $k => $row) {
            $promotions_info = $PHPShopPromotions->getPrice($row, true);
            $promotions_num[$promotions_info['id']]+=$row['num'];
        }
        
        // �������� ���
        foreach ($this->_CART as $k => $row) {

            $PHPShopProduct = new PHPShopProduct($row['id']);
            $promotions = $PHPShopPromotions->getPrice($PHPShopProduct->getArray(), true);


            if (is_array($promotions)) {
                
                // ��������� ������
                if (empty($this->_CART[$k]['promo_check']) and $PHPShopPromotions->promotion_check_cart($promotions['num_check'],$promotions_num[$promotions['id']])) {

                    $this->_CART[$k]['price'] = $promotions['price'];
                    $this->_CART[$k]['price_n'] = $promotions['price_n'];
                    $this->_CART[$k]['promo_check'] = true;
                }
                // ������� ������
                else if (!$PHPShopPromotions->promotion_check_cart($promotions['num_check'],$promotions_num[$promotions['id']])) {
                    $this->_CART[$k]['price'] = $promotions['price_n'];
                    unset($this->_CART[$k]['price_n']);
                    unset($this->_CART[$k]['promo_check']);
                }
            }
        }
    }

    /**
     * ��� �������
     * @return float
     */
    function getWeight() {
        $weight = 0;
        foreach ($this->_CART as $val)
            $weight += $val['num'] * $val['weight'];
        return $weight;
    }

    /**
     * �������������� ���������� ������ � �������
     * @param int $objID �� ������
     * @param int $num ���������� ������
     * @return int
     */
    function edit($objID, $num, $action = null) {

        // ������ �� ������
        $objProduct = new PHPShopProduct(abs($objID));

        // ���� ������� �� �����
        if (is_array($this->_CART)) {
            $num = abs($num);
            // ���� �������� ���������, �����������|��������� ���-�� �� �������, ����� �� ��������� ��������.
            if ($num == $this->_CART[$objID]['num'])
                if ($action == "minus")
                    $this->_CART[$objID]['num'] --;
                else
                    $this->_CART[$objID]['num'] ++;
            else
                $this->_CART[$objID]['num'] = $num;

            if (empty($this->_CART[$objID]['num']))
                unset($this->_CART[$objID]);

            // �������� ���-�� ������ �� ������
            if ($this->store_check) {
                if ($this->_CART[$objID]['num'] > $objProduct->getParam("items"))
                    $this->_CART[$objID]['num'] = $objProduct->getParam("items");
            }

            return $num;
        }
    }

    /**
     * ����� �������
     * @param bool $order �������� ������
     * @param string $format ����������� ��������
     * @return float
     */
    function getSum($order = true, $format = '') {
        global $PHPShopSystem;

        $sum = 0;
        if (is_array($this->_CART))
            foreach ($this->_CART as $val)
                $sum += $val['num'] * $val['price'];

        // ���� ������� ������ ������
        if ($order and isset($_SESSION['valuta'])) {
            $valuta = $_SESSION['valuta'];
            $kurs = $this->Valuta[$valuta]['kurs'];
        } else
            $kurs = $PHPShopSystem->getDefaultValutaKurs();

        // �������� �� �����
        return number_format($sum * $kurs, $this->format, '.', $format);
    }

    /**
     * ����� ��� ������ �������
     * @param bool $order �������� ������
     * @return float
     */
    function getSumNoDiscount($order = true) {
        global $PHPShopSystem;

        $sum_n = 0;
        if (is_array($this->_CART))
            foreach ($this->_CART as $val) {
                if ((float) $val['price_n'] > 0)
                    $sum_n += $val['num'] * $val['price_n'];
                else
                    $sum_n += $val['num'] * $val['price'];
            }

        // ���� ������� ������ ������
        if ($order && isset($_SESSION['valuta'])) {
            $valuta = $_SESSION['valuta'];
            $kurs = $this->Valuta[$valuta]['kurs'];
        } else
            $kurs = $PHPShopSystem->getDefaultValutaKurs();

        // �������� �� �����
        return number_format($sum_n * $kurs, $this->format, '.', '');
    }

    /**
     * ������������ ������ ������ ������� � �������
     * @global obj $PHPShopOrder
     * @param string $function ��� ������� ������� ������
     * @param array $option ����� �������������� ������
     * @return string
     */
    function display($function, $option = false) {
        global $PHPShopOrder;
        $list = null;

        // ������ ������ � ������ ������ ��� ������
        if (is_array($this->_CART)) {
            foreach ($this->_CART as $key => $val) {
                $product = new PHPShopProduct($val['id']);
                $name = PHPShopSecurity::CleanStr($product->getParam("name"));
                if(!empty($name)) {
                    $this->_CART[$key]['price'] = $this->getCartProductPrice($product);
                    $this->_CART[$key]['total'] = $PHPShopOrder->ReturnSumma($this->_CART[$key]['price'] * $val['num'], 0);

                    if ($this->store_check) {
                        if ($this->_CART[$key]['num'] > PHPShopSecurity::TotalClean($product->getParam("items"), 1)) {
                            if(PHPShopSecurity::TotalClean($product->getParam("items"), 1) > 0) {
                                $this->_CART[$key]['num'] = PHPShopSecurity::TotalClean($product->getParam("items"), 1);
                            } else {
                                unset($this->_CART[$key]);
                            }
                        }
                    }
                } else {
                    unset($this->_CART[$key]);
                }
            }
        }

        if (is_array($this->_CART))
            foreach ($this->_CART as $k => $v)
                if (function_exists($function)) {
                    $option['xid'] = $k;
                    $option['format'] = $this->format;
                    $list .= call_user_func_array($function, array($v, $option));
                }

        return $list;
    }

    /**
     * ����� ����� ������� � ���������
     * @global obj $PHPShopOrder
     * @return float
     */
    function getTotal() {
        global $PHPShopOrder;
        return $PHPShopOrder->ReturnSumma($this->getSum(), $PHPShopOrder->ChekDiscount($this->getSum()));
    }

    /**
     * ������ �������
     * @return array
     */
    function getArray() {
        return $this->_CART;
    }

    /**
     * @param PHPShopProduct $product
     * @param bool $var
     * @param string $column
     * @return format
     */
    public function getCartProductPrice($product, $column = 'price')
    {
        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, array('product' => $product, 'column' => $column));
        if ($hook)
            return $hook;

        // ����������
        $PHPShopPromotions = new PHPShopPromotions();
        $promotions = $PHPShopPromotions->getPrice($product->objRow);
        if (is_array($promotions)) {
            $price = $promotions[$column];
        } else {
            $price = $product->getParam($column);
        }

        return PHPShopProductFunction::GetPriceValuta($product->objID, $price, $product->getParam("baseinputvaluta"), true);
    }

    public function setHook($class_name, $function_name, $data = false, $rout = false) {
        if(!empty($this->PHPShopModules))
            return $this->PHPShopModules->setHookHandler($class_name, $function_name, array(&$this), $data, $rout);
    }
}

?>