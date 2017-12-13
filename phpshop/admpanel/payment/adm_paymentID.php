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
$PHPShopGUI->title = "�������������� ������� ������";
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

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $_GET['id']));
    extract($data);

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);


    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size="630,530";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ������� ������", "", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");


    $Field1 = $PHPShopGUI->setInput("text", "name_new", $name, "none", 280) .
            $PHPShopGUI->setRadio("enabled_new", 1, "����������", $enabled) .
            $PHPShopGUI->setRadio("enabled_new", 0, "������", $enabled);

    $Field2 = $PHPShopGUI->setSelect("path_new", $PHPShopGUI->loadLib(GetTipPayment, $path), 280, "left") . $PHPShopGUI->setLine() .
            $PHPShopGUI->setInputText('����������:', "num_new", $num, '50px', false, "left") .
            $PHPShopGUI->setCheckbox("yur_data_flag_new", 1, "��������� ��. ������", $yur_data_flag, "left");

    $Field3 = $PHPShopGUI->setInput("text", "message_header_new", $message_header, "none", 280);
    $Field4 = $PHPShopGUI->setInputText(false, "icon_new", $icon, '165px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;");



    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('message_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $message;
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
            $PHPShopGUI->setInput("hidden", "newsID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.baner.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.baner.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.baner.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);


    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['newsID']));
    return $action;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    $_GET['id'] = $_POST['newsID'];
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>
