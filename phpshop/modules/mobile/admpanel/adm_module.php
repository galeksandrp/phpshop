<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.mobile.mobile_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Mobile'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField(__('���������'), $PHPShopGUI->setTextarea('message_new', $data['message']));

    // ������
    $Tab1.= $PHPShopGUI->setField(__('����������� � �����'), $PHPShopGUI->setInputText(false, "logo_new", $data['logo'], '330px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), $PHPShopGUI->dir . "img/icon-move-banner.gif", "100px", '25px', "right", "miniWin('".$PHPShopGUI->dir."/editor3/assetmanager/assetmanager.php?name=".$data['logo']."&tip=logo_new', 680, 500);return false;"));
    
    // ���������
    $returncall_value[] = array('�������', 1, $data['returncall']);
    $returncall_value[] = array('�������� ������', 2, $data['returncall']);
    $Tab1.=$PHPShopGUI->setField(__("���������:"), $PHPShopGUI->setSelect('returncall_new', $returncall_value, 120), 'left');

    $Tab2 = $PHPShopGUI->setPay($data['serial'], false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab2, 270));

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


