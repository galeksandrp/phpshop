<?php
/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 4/28/14
 * Time: 11:43 AM
 */
session_start();

$_classPath="../../../../";
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
PHPShopObj::loadClass("modules");
// Массив валют
$PHPShopValutaArray= new PHPShopValutaArray();

// Системные настройки
$PHPShopSystem = new PHPShopSystem();



include_once(implode(DIRECTORY_SEPARATOR, array(__DIR__, '..', 'application', 'bootstrap.php')));


include_once('IntegratorShop.php');
// Turn off all error reporting
try{
    header("Content-Type: text/html; charset=windows-1251");
    $IntegratorShop = new IntegratorShop( $_GET );
    $ddeliveryUI = new \DDelivery\DDeliveryUI($IntegratorShop);
    // В зависимости от параметров может выводить полноценный html или json
    $ddeliveryUI->render(isset($_REQUEST) ? $_REQUEST : array());
}catch (\DDelivery\DDeliveryException $e){
    $ddeliveryUI->logMessage($e);
    echo  $e->getMessage();
}




