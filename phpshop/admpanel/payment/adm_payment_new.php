<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������� ������� ������";
$PHPShopGUI->ajax = "'payment','','','core'";
$PHPShopGUI->alax_lib = true;

$PHPShopSystem = new PHPShopSystem();

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment_systems']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm, $PHPShopModules;

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size="630,530";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ������� ������", "", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");


    $Field1 = $PHPShopGUI->setInput("text", "name_new", "����� ������ ������", "none", 280) .
            $PHPShopGUI->setRadio("enabled_new", 1, "����������", 1) .
            $PHPShopGUI->setRadio("enabled_new", 0, "������",1);

    $Field2 = $PHPShopGUI->setSelect("path_new", $PHPShopGUI->loadLib(GetTipPayment, false), 280, "left") . $PHPShopGUI->setLine() .
            $PHPShopGUI->setInputText('����������:', "num_new", 0, '50px', false, "left") .
            $PHPShopGUI->setCheckbox("yur_data_flag_new", 1, "��������� ��. ������", 0, "left");

    $Field3 = $PHPShopGUI->setInput("text", "message_header_new", false, "none", 280);
    $Field4 = $PHPShopGUI->setInputText(false, "icon_new", false, '165px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;");



    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('message_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = null;
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];

    // ���������� �������� 2
    $editor = $oFCKeditor->AddGUI();

// ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("������������:", $Field1, "left") .
            $PHPShopGUI->setField("��� �����������:", $Field2, "left") .
            $PHPShopGUI->setField("��������� ��������� ����� ������:", $Field3, "left") .
            $PHPShopGUI->setField("������:", $Field4, "left");

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("���������", $editor, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.baner.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
$PHPShopGUI->getAction();
?>



