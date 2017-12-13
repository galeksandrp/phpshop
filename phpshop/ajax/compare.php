<?php

/**
 * ��������� �������
 * @package PHPShopAjaxElements
 */
session_start();

$_classPath = "../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("compare");

// ���������� ���������� ���������.
require_once $_classPath . "lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");

// �������� ������.
$q = $_REQUEST['q'];
$xid = intval($_REQUEST['xid']);
$_num = $_REQUEST['num'];

//�������� �������� ���������� ������� ��� ���������
$compar = count($_SESSION['compare']);

// ����� ���������
$PHPShopCompare = new PHPShopCompare();

// �������� �����
$PHPShopCompare->add($xid);

if ($compar == $PHPShopCompare->getNum()) {
    $same = '1';
} else {
    $same = '0';
}

// ��������� ���������
$_RESULT = array(
    "q" => $q,
    "num" => $PHPShopCompare->getNum(),
    "same" => $same,
    "message" => $PHPShopCompare->getMessage(),
);
?>