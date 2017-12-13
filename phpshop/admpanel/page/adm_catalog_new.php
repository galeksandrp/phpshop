<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������� ������ ��������";
$PHPShopGUI->reload = "left";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function Disp_cat($parent_to) {// ����� ��������� � ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);

    if (PHPShopSecurity::true_num($parent_to)) {
        $data = $PHPShopOrm->select(array('name'), array('id' => '=' . $parent_to));
        if (is_array($data))
            extract($data);
        return "$name => ";
    } else
        return "";
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopModules;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    if (empty($_GET['id']))
        $_GET['id'] = 0;

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "650,630";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ������ ��������", "", $PHPShopGUI->dir . "img/i_filemanager_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '420';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = '';

    // ���������� �������� 1
    $Tab1 =
            $PHPShopGUI->setField("��������:", $PHPShopGUI->setInput("text", "name_new", '����� �������', "left", 450), "none") .
            $PHPShopGUI->setField("�������:", $PHPShopGUI->setInput("text", "parent_name", Disp_cat($_GET['id']), "left", 450) .
                    $PHPShopGUI->setInput("hidden", "parent_to_new", $_GET['id'], "left", 450) .
                    $PHPShopGUI->setButton("�������", "../icon/folder_edit.gif", "100px", "�������", "none", "miniWin('" . $dot . "./page/adm_cat.php?category=" . $category . "',300,400);return false;"), "none") .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("����������:", $PHPShopGUI->setInput("text", "num_new", 0, "left", 100), "left");

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 450), array("����������", $Tab2, 450));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.page_site.create");

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