<?php

/**
 * ��������
 * @package PHPShopAjaxElements
 */
session_start();
$_classPath = "../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("lang");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini",true,true);

// ����������
$PHPShopBase->checkMultibase("../../");

// ������� ��� ������
$PHPShopSystem = new PHPShopSystem();
$PHPShopOrder = new PHPShopOrderFunction();

$PHPShopLang = new PHPShopLang(array('locale'=>$_SESSION['lang'],'path'=>'shop'));

// ������
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// ���������� ���������� ���������.
if ($_REQUEST['type'] != 'json') {
    require_once $_classPath . "lib/Subsys/JsHttpRequest/Php.php";
    $JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");
}

// ���������� ���������� ��������
require_once $_classPath . "core/order.core/delivery.php";

function GetDeliveryPrice($deliveryID, $sum, $weight = 0) {
    global $SysValue,$link_db;

    if (!empty($deliveryID)) {
        $sql = "select * from " . $SysValue['base']['delivery'] . " where id='$deliveryID' and enabled='1'";
        $result = mysqli_query($link_db,$sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        if ($num == 0) {
            $sql = "select * from " . $SysValue['base']['delivery'] . " where flag='1' and enabled='1'";
            $result = mysqli_query($link_db,$sql);
            $row = mysqli_fetch_array($result);
        }
    } else {
        $sql = "select * from " . $SysValue['base']['delivery'] . " where flag='1' and enabled='1'";
        $result = mysqli_query($link_db,$sql);
        $row = mysqli_fetch_array($result);
    }

    if ($row['price_null_enabled'] == 1 and $sum >= $row['price_null']) {
        return 0;
    } else {
        if ($row['taxa'] > 0) {
            $addweight = $weight - 500;
            if ($addweight < 0) {
                $addweight = 0;
                $at = '';
            } else {
                $at = '';
                //$at='���: '.$weight.' ��. ����������: '.$addweight.' ��. ���������:'.ceil($addweight/500).' = ';
            }
            $addweight = ceil($addweight / 500) * $row['taxa'];
            $endprice = $row['price'] + $addweight;
            return $at . $endprice;
        } else {
            return $row['price'];
        }
    }
}

$GetDeliveryPrice = GetDeliveryPrice(intval($_REQUEST['xid']), $_REQUEST['sum'], floatval($_REQUEST['wsum']));
$GetDeliveryPrice = $GetDeliveryPrice*$PHPShopSystem->getDefaultValutaKurs(true);
$totalsumma = $_REQUEST['sum'];
$deliveryArr = delivery(false, intval($_REQUEST['xid']),$_REQUEST['sum']);
$dellist = $deliveryArr['dellist'];
$adresList = $deliveryArr['adresList'];
$format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");

// ���������
$_RESULT = array(
    'delivery' => number_format($GetDeliveryPrice, $format, '.', ' '),
    'dellist' => $dellist,
    'discount'=>$PHPShopOrder->ChekDiscount($_REQUEST['sum']),
    'adresList' => $adresList,
    'total' => $PHPShopOrder->returnSumma($totalsumma,$PHPShopOrder->ChekDiscount($_REQUEST['sum']),' ',$GetDeliveryPrice),
    'wsum' => floatval($_REQUEST['wsum']),
    'success' => 1
);

// �������� ������ � ������ �������
$hook = $PHPShopModules->setHookHandler('delivery', 'delivery', false, array($_RESULT, $_REQUEST['xid']));
if(is_array($hook))
    $_RESULT = $hook;

if ($_REQUEST['type'] == 'json'){
    $_RESULT['dellist']=PHPShopString::win_utf8($_RESULT['dellist'],false);
    $_RESULT['adresList']=PHPShopString::win_utf8($_RESULT['adresList'],false);

    echo json_encode($_RESULT);
}
?>