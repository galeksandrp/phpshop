<?php
session_start();

// ����������
include("../../class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("inwords");
PHPShopObj::loadClass("parser");
PHPShopObj::loadClass("text");
PHPShopObj::loadClass("cart");

// ����������� � ��
$PHPShopBase = new PHPShopBase("../../inc/config.ini");
$PHPShopSystem = new PHPShopSystem();
$PHPShopOrder = new PHPShopOrder();
$PHPShopCart = new PHPShopCart();

/**
 * ������ ������ ������� �������
 * �������� ������ �������� ����� ���������� � phpshop/lib/templates/print/cart.tpl
 */
function printforma($val) {
    static $n;
    $dis=PHPShopText::tr($n+1,$val['name'],'��.&nbsp;',$val['num'],$val['price'],$val['total']);
    @$n++;
    return $dis;
}

// ������� ���� � �����
$iw = new inwords;

PHPShopParser::set('total',$PHPShopCart->getTotal());
PHPShopParser::set('discount',$PHPShopOrder->ChekDiscount($PHPShopCart->getSum()));
PHPShopParser::set('date',date("d-m-y"));
PHPShopParser::set('logo',$PHPShopSystem->getLogo());
PHPShopParser::set('cart',$PHPShopCart->display('printforma'));
PHPShopParser::set('item',$PHPShopCart->getNum());
PHPShopParser::set('totaltext',$iw->get($PHPShopCart->getTotal()));
PHPShopParser::set('currency',$PHPShopOrder->default_valuta_code);
PHPShopParser::file('../../lib/templates/print/cart.tpl');
?>