<?php

/**
 * Библиотека бонусов
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class BonusCount {

    function __construct() {
        
    }

    function percentCount($cart, $totalsummainput, $id, $bonus) {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['bonus']);
        $maxPercent = $PHPShopOrm->select(array('max_percent'), array('id=' => '1'), false, array('limit' => 1));
        $maxPercent = $maxPercent['max_percent'];

        if (intval($maxPercent) == 0) {
            $maxPercent = 50;
        }

        $halftotalsumma = $totalsummainput * $maxPercent / 100;
        $maxPercent = 100 - $maxPercent;

        $PHPShopUser = new PHPShopUser($id);
        $bonusid = intval($PHPShopUser->getParam('bonus'));

        if (empty($bonus)) {
            $bonus = $bonusid;
        }

        if ($bonus <= $halftotalsumma) {

            $bonusPercent = $bonus * 100 / $totalsummainput;
            $bonusPercent = 100 - $bonusPercent;
            $totalsumm = 0;
            foreach ($cart as $row => $product) {
                $oneprice = $product['price'] * $bonusPercent / 100;
                $cart[$row]['price'] = round($oneprice, 2);
                $oneprice = $oneprice * $product['num'];
                $totalsumm = $totalsumm + $oneprice;
            }


            $totalsumm = round($totalsumm);
            $spentbonus = $bonus;
            $userbonus = $bonusid - $bonus;
        } else {

            $totalsumm = $totalsummainput;
        }

        return array('totalsumm' => $totalsumm, 'userbonus' => $userbonus, 'spentbonus' => $spentbonus, 'cart' => $cart);
    }

    function amountBonus($idArray) {
        if (is_array($idArray))
            foreach ($idArray as $id) {
                $PHPShopProduct = new PHPShopProduct($id['id']);
                $bonusP += intval($PHPShopProduct->getParam('bonus')) * $id['num'];
            }
        return intval($bonusP);
    }

}

?>