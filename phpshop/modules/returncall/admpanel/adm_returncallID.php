<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window = false;
$PHPShopGUI->reload = 'top';
$PHPShopGUI->ajax = "'modules','returncall'";
$PHPShopGUI->includeJava = '<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir = $_classPath . "admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "�������������� ������";
    $PHPShopGUI->size = "630,450";


    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $_GET['id']));
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader('�������������� ������ �� "' . $name . '" ����� ' . $tel, "", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");



    $Tab1 = $PHPShopGUI->setField('����� ������: ' . PHPShopDate::dataV($date), $PHPShopGUI->setInputText('���: ', 'name_new', $name, '300', false, 'left') .
            $PHPShopGUI->setInputText('�: ', 'tel_new', $tel, '200', false, 'left') .
            $PHPShopGUI->setInputText('�����: ', 'time_start_new', $time_start, '50', false, 'left') .
            $PHPShopGUI->setInputText('��', 'time_end__new', $time_end, '50', false, 'left').
             $PHPShopGUI->setText('IP: '.$ip));

    $Tab1.=$PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('message_new', $message));

    $status_atrray[] = array('�����', 1, $status);
    $status_atrray[] = array('������� �����������', 2, $status);
    $status_atrray[] = array('����c�����', 3, $status);
    $status_atrray[] = array('��������', 4, $status);

    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setSelect('status_new', $status_atrray, 150));


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "delID", "�������", "right", 70, "", "but", "actionDelete") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['newsID']));
    return $action;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

    // ��������� �������
    $PHPShopGUI->getAction();
}else
    $UserChek->BadUserFormaWindow();
?>


