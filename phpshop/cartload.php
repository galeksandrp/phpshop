<?php
session_start();

/**
 * �������
 * @package PHPShopAjaxElements
 */

$_classPath="./";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
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
require_once "./lib/Subsys/JsHttpRequest/Php.php";

$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");


// ������ �����
$PHPShopValutaArray= new PHPShopValutaArray();
$LoadItems['Valuta']=$PHPShopValutaArray->getArray();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();
$LoadItems['System']=$PHPShopSystem->getArray();

// �������
$PHPShopCart = new PHPShopCart();

// �������� �����
$PHPShopCart->add($_REQUEST['xid'],$_REQUEST['num']);


// ��������� ���������
$_RESULT = array(
  "num"   => $PHPShopCart->getNum(),
  "sum" => $PHPShopCart->getSum(),
); 

?>