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
$PHPShopGUI->title = "�������� ������ ����������� ��� ��������";
$PHPShopGUI->ajax = "'slider','','','core'";
$PHPShopGUI->alax_lib = true;
$PHPShopSystem = new PHPShopSystem();

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['slider']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopModules;

    $PHPShopGUI->dir = "../";

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ������ ����������� ��� ��������", "", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");

    $Field1 = $PHPShopGUI->setInput("text", "image_new", $image, "left", 300) .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "left", "ReturnPic('image_new');return false;") .
            $PHPShopGUI->setRadio("enabled_new", 1, "���������� �����������", $enabled) . "<br>" .
            $PHPShopGUI->setRadio("enabled_new", 0, "������ �����������", $enabled);

    $Field2 = $PHPShopGUI->setInput("text", "link_new", $link, "none", 300) . $PHPShopGUI->setLine("������: /pages/info.html ��� http://google.com");
    $Field3 = $PHPShopGUI->setInputText(false, 'num_new', $num, '50px') . "<br>";
    $Field4 = $PHPShopGUI->setTextarea("alt_new", $alt);


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField(__("�����������:"), $Field1, "none") .
            $PHPShopGUI->setField(__("������ �������� ��� ����� �� �����������:"), $Field2, "left") .
            $PHPShopGUI->setField(__("����� �� �������:"), $Field3, "left") .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField(__("�������� � �����������:"), $Field4);


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, null);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
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



