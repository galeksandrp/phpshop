<?php

session_start();

$_classPath = "../../../";
include_once($_classPath . "class/obj.class.php");
include_once($_classPath . "modules/cdekwidget/class/CDEKWidget.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");

$PHPShopBase->chekAdmin();

$CDEKWidget = new CDEKWidget();

if(isset($_REQUEST['operation']) && strlen($_REQUEST['operation']) > 2) {
    $result = array();
    try {
        switch ($_REQUEST['operation']) {
            case 'paymentStatus':
                $CDEKWidget->changePaymentStatus((int) $_REQUEST['orderId'], (int) $_REQUEST['value']);
                break;
            case 'changeAddress':
                $CDEKWidget->changeAddress($_REQUEST);
                break;
            case 'send':
                $order = $CDEKWidget->getOrderById((int) $_REQUEST['orderId']);
                $CDEKWidget->send($order);
                break;
        }

        $result['success'] = true;
    } catch (\Exception $exception) {
        $result = array('success' => false, 'error' => PHPShopString::win_utf8($exception->getMessage()));
    }
} else {
    $result = array('success' => false, 'error' => PHPShopString::win_utf8('Не найден параметр operation'));
}

echo (json_encode($result)); exit;