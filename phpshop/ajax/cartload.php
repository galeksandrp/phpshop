<?php

/**
 * �������
 * @package PHPShopAjaxElements
 */
session_start();

$_classPath = "../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("cart");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("user");


// ���������� ���������� ���������.
require_once $_classPath . "/lib/Subsys/JsHttpRequest/Php.php";

$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");

// ������ �����
$PHPShopValutaArray = new PHPShopValutaArray();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������
$PHPShopCart = new PHPShopCart();

// �������� �����
if (PHPShopSecurity::true_param($_REQUEST['xid'], $_REQUEST['num'])) {
    $productData = $PHPShopCart->add($_REQUEST['xid'], $_REQUEST['num'], $_REQUEST['xxid']);
}

// ���� ���������� �������
setcookie("cart_update_time", time(), 0, "/", $_SERVER['SERVER_NAME'], 0);

// ��������� ���������
$_RESULT = array(
    "num" => $PHPShopCart->getNum(),
    "sum" => $PHPShopCart->getSum(),
    "message" => $PHPShopCart->getMessage(),
);
?>