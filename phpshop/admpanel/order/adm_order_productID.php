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
PHPShopObj::loadClass("product");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = __("�������������� ������");
$PHPShopGUI->reload = "top";
$PHPShopGUI->addJSFiles('/phpshop/lib/JsHttpRequest/JsHttpRequest.js');
$PHPShopGUI->addJSFiles('gui/tab_cart.gui.js');

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;
    
    // �� ������
    $orderID=intval($_GET['orderID']);
    
    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID));

    $PHPShopGUI->dir = "../";

    // ��� ������
    if (!is_array($data)) {
        $PHPShopGUI->setFooter($PHPShopGUI->setInput("button", "", "�������", "center", 100, "return onCancel();", "but"));
        return true;
    }

    // ���������� ������
    $PHPShopOrder = new PHPShopOrderFunction($orderID);

    $order = unserialize($data['orders']);

    // �� ������
    $productID = intval($_GET['productID']);
    
    if(empty($order['Cart']['cart'][$productID]['id'])){ 
        foreach($order['Cart']['cart'] as $key=>$val)
            if($val['id'] == $productID){
                $productID=$key;
            }
    }
    
    // ������������
    $Tab1 = $PHPShopGUI->setField(__("������������"), $PHPShopGUI->setInputText(false, 'name_new', $order['Cart']['cart'][$productID]['name'], '100%')) . $PHPShopGUI->setLine();

    // ������
    $PHPShopProduct = new PHPShopProduct($productID);
    $productIcon=$PHPShopProduct->getParam('pic_small');
    $productEdIzm=$PHPShopProduct->getParam('ed_izm');
    if (!empty($productIcon)) {
        $img_width = $PHPShopSystem->getSerilizeParam('admoption.img_tw');
        $Tab1.=$PHPShopGUI->setDiv('left', $PHPShopGUI->setFrame('img', $productIcon, $img_width + 20, $img_width, 'none', 0, 'No'), 'width:' . ($img_width + 50) . 'px;float:left');
    }
    
    // �����
    if (empty($productEdIzm))
        $ed_izm = '��.';
    else
        $ed_izm = $productEdIzm;
    
    // ����������
    $Tab1.=$PHPShopGUI->setField(__("����������"), "<div style=\"padding:5px\"><input type=\"text\" style=\"width: 50px;\" value=\"" . $order['Cart']['cart'][$productID]['num']. "\" id=\"num\" onchange=\"DoUpdateOrderProductSum()\"> ".$ed_izm, 'left');
   
    // �����
    $productSum=$PHPShopOrder->ReturnSumma($order['Cart']['cart'][$productID]['price'] * $order['Cart']['cart'][$productID]['num'],0);
    $Tab1.=$PHPShopGUI->setField(__("����� ") . '(' . $PHPShopSystem->getDefaultValutaCode() . ')', $PHPShopGUI->setDiv('center', $productSum, 'font-size:25px;font-weight:bold', 'sum'), 'left');

    // ����
    $Tab1.=$PHPShopGUI->setField(__("���� ") . '(' . $PHPShopSystem->getDefaultValutaCode() . ')', "<div style=\"padding:5px\"><input type=\"text\" style=\"width: 70px;\" value=\"" . $PHPShopOrder->ReturnSumma($order['Cart']['cart'][$productID]['price'], 0) . "\" id=\"price\" onchange=\"DoUpdateOrderProductSum()\"> ", 'left');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 200));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "DoDelFromOrder('" . $productID . "', $orderID)", "but") .
            $PHPShopGUI->setInput("button", "editID", "���������", "right", 70, "DoUpdateFromOrder('" . $productID . "',$orderID, this.form.name_new.value,this.form.num.value,this.form.price.value)", "but");

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