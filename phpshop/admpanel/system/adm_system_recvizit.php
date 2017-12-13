<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "��������� ����������";
$PHPShopGUI->reload = "none";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select();

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    // ���������
    $bank = unserialize($data['bank']);

    $PHPShopGUI->dir = "../";
    $PHPShopGUI->size = "500,600";

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ����������", "", $PHPShopGUI->dir . "img/i_website_statistics_med[1].gif");


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField(__("�������� ��������"), $PHPShopGUI->setInputText(null, "name_new", $data['name'], '97%'), "none");
    $Tab1 .= $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText(null, "company_new", $data['company'], '97%'), "none");
    $Tab1 .= $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText(null, "tel_new", $data['tel'], '97%'), "none");
    $Tab1 .= $PHPShopGUI->setField(__("����� ��� �������"), $PHPShopGUI->setInputText(null, "adminmail2_new", $data['adminmail2'], '97%', __('<br>* ����� ������� ��������� ������� ����� �������')), "none");

    // ���������� �������� 2
    $Tab2 .= $PHPShopGUI->setField(__("������������ �����������"), $PHPShopGUI->setInputText(null, "bank_new[org_name]", $bank['org_name'], '97%'), "none");
    $Tab2 .= $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText(null, "bank_new[org_ur_adres]", $bank['org_ur_adres'], '97%'), "none");
    $Tab2 .= $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText(null, "bank_new[org_adres]", $bank['org_adres'], '97%'), "none");
    $Tab2 .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank_new[org_inn]", $bank['org_inn'], '97%'), "left");
    $Tab2 .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank_new[org_kpp]", $bank['org_kpp'], '97%'), "left");
    $Tab2 .= $PHPShopGUI->setField(__("� ����� �����������"), $PHPShopGUI->setInputText(null, "bank_new[org_schet]", $bank['org_schet'], '97%'), "none");
    $Tab2 .= $PHPShopGUI->setLine().$PHPShopGUI->setField(__("������������ ����"), $PHPShopGUI->setInputText(null, "bank_new[org_bank]", $bank['org_bank'], '97%'), "none");
    $Tab2 .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank_new[org_bic]", $bank['org_bic'], '150'), "left");
    $Tab2 .= $PHPShopGUI->setField(__("� ����� �����"), $PHPShopGUI->setInputText(null, "bank_new[org_bank_schet]", $bank['org_bank_schet'], '250'), "left");

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 330), array("���������", $Tab2, 330));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "thisID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.option.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.option.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    $PHPShopGUI->setAction($_POST['thisID'], 'actionStart', 'none');
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    $_POST['bank_new'] = serialize($_POST['bank_new']);

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['thisID']));
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['thisID'], 'actionStart');

// ��������� ������� 
$PHPShopGUI->getAction();
?>