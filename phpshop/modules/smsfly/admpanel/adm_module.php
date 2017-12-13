<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("payment");
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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.smsfly.smsfly_system"));

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
    $PHPShopGUI->title = "��������� ������ Sms Fly";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Sms Fly'", "��������� �����������", $PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField('� �������� ��� SMS', $PHPShopGUI->setInputText(false, 'phone_new', $phone,false,' * � ������� 380631234567'));
    $Tab1.=$PHPShopGUI->setField('������������', $PHPShopGUI->setInputText(false, 'merchant_user_new', $merchant_user, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(false, 'merchant_pwd_new', $merchant_pwd, 210), 'left');
     $Tab1.=$PHPShopGUI->setField('����������� (Alfaname)', $PHPShopGUI->setInputText(false, 'alfaname_new', $alfaname, 210), 'left');
    
    
    // Sandbox
    $sandbox_value[] = array('�������', 1, $sandbox);
    $sandbox_value[] = array('��������', 2, $sandbox);
    $Tab1.= $PHPShopGUI->setField('�������� �����', $PHPShopGUI->setSelect('sandbox_new', $sandbox_value), 'left');
   
 
    $Tab2 = $PHPShopGUI->setPay();

   
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("�����������", $Tab1, 270), array("� ������", $Tab2, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
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