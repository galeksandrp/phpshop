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
$PHPShopGUI->title = "�������������� �������";
$PHPShopGUI->ajax = "'banner','','','core'";
$PHPShopGUI->alax_lib = true;

$PHPShopSystem = new PHPShopSystem();

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['banner']);

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
    $PHPShopGUI->setHeader("�������������� �������", "", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");


    $Field1 = $PHPShopGUI->setInput("text", "name_new", $name, "none", 300) .
            $PHPShopGUI->setRadio("flag_new", 1, "���������� �����", $flag) .
            $PHPShopGUI->setRadio("flag_new", 0, "������ �����", $flag);

    $Field2 = $PHPShopGUI->setInput("text", "limit_all_new", $limit_all, "none", 100) .
            $PHPShopGUI->setCheckbox("clean_st", 1, "�������� �������� " . @$count_today . " / " . $count_all, false);

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("������������:", $Field1, "none") .
            $PHPShopGUI->setField("�������� � ��������:", $PHPShopGUI->setInput("text", "dir_new", $dir, "left", '550') .
                    $PHPShopGUI->setLine(__('* ������: /,/page/,/shop/UID_1.html. ����� ������� ��������� ������� ����� ������� ��� �������')), "none");


    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $content;
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("����������", $Tab2, 350));

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

    if ($_POST['clean_st'] == 1) {
        $_POST['count_all_new'] = '0';
        $_POST['count_today_new'] = '0';
    }

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>
