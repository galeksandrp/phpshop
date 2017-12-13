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
$PHPShopGUI->title = "�������� ������ �������";
$PHPShopGUI->ajax = "'banner','','','core'";
$PHPShopGUI->alax_lib = true;
$PHPShopSystem = new PHPShopSystem();

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name15']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopModules;

    $PHPShopGUI->dir = "../";

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ������ ������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");

    $Field1 = $PHPShopGUI->setInput("text", "name_new", "������", "none", 300) .
            $PHPShopGUI->setRadio("flag_new", 1, "���������� �����") .
            $PHPShopGUI->setRadio("flag_new", 0, "������ �����", false);

    $Field2 = $PHPShopGUI->setInput("text", "limit_all_new", 10000000000, "none", 100);

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("������������:", $Field1, "none") .
            $PHPShopGUI->setField("�������� � ��������:", $PHPShopGUI->setInput("text", "dir_new", null, "left", '550') .
                    $PHPShopGUI->setLine(__('* ������: /,/page/,/shop/UID_1.html. ����� ������� ��������� ������� ����� ������� ��� �������')), "none");


    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = '';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("����������", $Tab2, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, null);

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



