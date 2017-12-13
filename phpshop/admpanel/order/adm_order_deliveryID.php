<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("delivery");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = __("�������������� ��������");
$PHPShopGUI->reload = "top";
$PHPShopGUI->addJSFiles('/phpshop/lib/JsHttpRequest/JsHttpRequest.js');
$PHPShopGUI->addJSFiles('gui/tab_cart.gui.js');

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    // �� ��������
    $deliveryID = intval($_GET['deliveryID']);

    // �� ������
    $orderID = intval($_GET['orderID']);

    // �������
    $data = $PHPShopOrm->select(array('*'), array('is_folder' => "='1'"), array('order' => 'city'), array('limit' => 1000));

    $PHPShopGUI->dir = "../";

    // ��� ������
    if (!is_array($data)) {
        $PHPShopGUI->setFooter($PHPShopGUI->setInput("button", "", "�������", "center", 100, "return onCancel();", "but"));
        return true;
    }

    // ����� ������ ��������
    $PHPShopDelivery = new PHPShopDeliveryArray();
    $PHPShopDeliveryArray = $PHPShopDelivery->getArray();
    $PHPShopDeliveryPidArray = $PHPShopDelivery->getKey('PID.id', true);
    
    //unset($PHPShopDeliveryPidArray[0]);
    $delivery_price = null;

    // �������� ��������
    if (is_array($data))
        foreach ($data as $row) {
            $delivery_group_value = array();
            if (is_array($PHPShopDeliveryPidArray[$row['id']])) {
                foreach ($PHPShopDeliveryPidArray[$row['id']] as $value) {

                    $delivery_group_value[] = array($PHPShopDeliveryArray[$value]['city'], $value, $deliveryID);
                    $delivery_price.=$PHPShopGUI->setInput('hidden', $value, $PHPShopDeliveryArray[$value]['price']);
                }
                $delivery_value[] = array($row['city'], $delivery_group_value);
            }
        }


    // �������� ��� ��������
    $data_root[0] = array(
        'id' => 0,
        'city' => '��������',
        'is_folder' => 1
    );
    
    if (is_array($data_root))
        foreach ($data_root as $row) {
            $delivery_group_value = array();
            if (is_array($PHPShopDeliveryPidArray[$row['id']])) {
                foreach ($PHPShopDeliveryPidArray[$row['id']] as $value) {
                    if (empty($PHPShopDeliveryArray[$value]['PID']) and empty($PHPShopDeliveryArray[$value]['is_folder'])){
                    $delivery_group_value[] = array($PHPShopDeliveryArray[$value]['city'], $value, $deliveryID);
                    $delivery_price.=$PHPShopGUI->setInput('hidden', $value, $PHPShopDeliveryArray[$value]['price']);
                    }
                }
                $delivery_value[] = array($row['city'], $delivery_group_value);
            }
        }


    // ���������
    $Tab1 = $PHPShopGUI->setDiv(false, $delivery_price, 'display:none');

    // ����� ��������
    $Tab1.= $PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setSelect('delivery', $delivery_value, 250, false, false, 'javascript:document.getElementById(\'sum\').innerHTML=document.getElementById(this.value).value'), 'left');

    // �����
    $Tab1.=$PHPShopGUI->setField(__("����� ") . '(' . $PHPShopSystem->getDefaultValutaCode() . ')', $PHPShopGUI->setDiv('center', $PHPShopDeliveryArray[$deliveryID]['price'], 'font-size:25px;font-weight:bold', 'sum'), 'left');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 150));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "editID", "���������", "right", 70, "DoUpdateDeliveryFromOrder(delivery.value,$orderID)", "but");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if (CheckedRules($UserStatus["cat_prod"], 0) == 1) {

    // ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['orderID'], 'actionStart', 'none');

    // ��������� �������
    $PHPShopGUI->getAction();
} else {

    // ������ ��������������
    $UserChek->BadUserFormaWindow();
}
?>