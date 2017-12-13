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
$PHPShopGUI->title = "�������������� ��������";
$PHPShopGUI->reload = "left";


// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function Disp_cat($parent_to, $n) {// ����� ��������� � ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
    $data = $PHPShopOrm->select(array('name'), array('id' => '=' . $parent_to));
    if (is_array($data))
        extract($data);
    return "$name => $n";
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm, $PHPShopModules;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));
    extract($data);

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "650,630";

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ��������", "", $PHPShopGUI->dir . "img/i_filemanager_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '420';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $content;

    // ���������� �������� 1
    $Tab1 =
            $PHPShopGUI->setField("��������:", $PHPShopGUI->setInput("text", "name_new", $name, "left", 450), "none") .
            $PHPShopGUI->setField("�������:", $PHPShopGUI->setInput("text", "parent_name", Disp_cat($parent_to, $name), "left", 450) .
                    $PHPShopGUI->setInput("hidden", "parent_to_new", $parent_to, "left", 450) .
                    $PHPShopGUI->setButton("�������", "../icon/folder_edit.gif", 100, false, "none", "miniWin('" . $dot . "./page/adm_cat.php?category=" . $parent_to . "',300,400);return false;"), "none") .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("����������:", $PHPShopGUI->setInput("text", "num_new", $num, "left", 100), "left");

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 450), array("����������", $Tab2, 450));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.page_site.edit") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate.page_site.edit").
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.page_site.edit");

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
    $_GET['id'] = $_POST['newsID'];
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

        // �������� ������
        $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

        $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['newsID']));
        return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

        // �������� ������
        $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);
        $PHPShopOrm->debug = false;
        $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
        return $action;
}


    // ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

    // ��������� �������
    $PHPShopGUI->getAction();

?>
