<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("file");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("valuta");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.moysklad.moysklad_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ ��������";
    //$PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '��� �����'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1.=$PHPShopGUI->setField('������������', $PHPShopGUI->setInputText(false, 'merchant_user_new', $merchant_user, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInput('password', 'merchant_pwd_new', $merchant_pwd, 210), 'left');

    // ����� �������������
    $stock_value[] = array('��� ������', 'ALL_STOCK', $stock_option);
    $stock_value[] = array('������ ������������� �������', 'POSITIVE_ONLY', $stock_option);
    $stock_value[] = array('������ ������������� �������, � ������ �������', 'POSITIVE_INCLUDING_RESERVE_ONLY', $stock_option);
    $stock_value[] = array('������ ������������� ��������', 'NEGATIVE_ONLY', $stock_option);
    $stock_value[] = array('������������� � ������������� ��������', 'NON_EMPTY', $stock_option);
    $stock_value[] = array('���� ������������ �������', 'UNDER_MINIMUM_BALANCE_ONLY', $stock_option);
    $stock_value[] = array('� ������ �������', 'USE_RESERVES', $stock_option);

    $Tab1.=$PHPShopGUI->setField('��� ����������� � ��������', $PHPShopGUI->setInputText(false, 'org_code_new', $org_code, 210), 'left');

    // ���
    $Tab1.=$PHPShopGUI->setField('���', $PHPShopGUI->setInputText(false, 'nds_new', $nds, 30, '%'), 'left');
    
    // ������
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInput("button", "", "��������� �������", "right", 160, "return window.open('../cron/stock.php');", "but"), 'left');
    
     // ����� �������������
    $Tab1.= $PHPShopGUI->setField('������������� ������', $PHPShopGUI->setSelect('stock_option_new', $stock_value, 310).$PHPShopGUI->setLine().$PHPShopGUI->setImage($_classPath.'admpanel/icon/icon_info.gif', 16, 16) .'����� ������ �� �������� � ����� ������ ��� ������������� ������.', 'none');
    
    
    
      $Info = "��� �������������� ������������� ��������� ���������� ������ 'PHPShop Cron' � �������� � ���� ����� ������ � �������
        ������������ �����:  <b>phpshop/modules/moysklad/cron/stock.php</b>.<p> ��� �������� ����� ������ � 'Unix Cron' ����������� �������:  <b>wget http://".$_SERVER['SERVER_NAME']."/phpshop/modules/moysklad/cron/stock.php</b></p>";
      
    $Tab1.= $PHPShopGUI->setInfo($Info, 100, '97%');

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 320), array("� ������", $Tab3, 320));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>