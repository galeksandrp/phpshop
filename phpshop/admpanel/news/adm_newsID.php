<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("admgui");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������������� �������";
$PHPShopGUI->ajax = "'news','','','core'";
$PHPShopGUI->alax_lib = true;

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopBase, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    $PHPShopGUI->dir = "../";
    $PHPShopGUI->addJSFiles('../java/popup_lib.js', '../java/dateselector.js');
    $PHPShopGUI->addCSSFiles('../css/dateselector.css');

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� �������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_balance_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('kratko_new');
    $oFCKeditor->Height = '270';
    $oFCKeditor->Config['EditorAreaCSS'] = $PHPShopBase->getParam('dir.dir') . chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $data['kratko'];
    $oFCKeditor->Mod = 'textareas';

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����:", $PHPShopGUI->setInput("text", "datas_new", $data['datas'], "left", 70) .
                    $PHPShopGUI->setImage("../icon/date.gif", 16, 16, 'absmiddle', "5", $style = 'float:left', $onclick = "popUpCalendar(this, product_edit.datas_new, 'dd-mm-yyyy');"), "left") .
            $PHPShopGUI->setField("���������:", $PHPShopGUI->setInput("text", "zag_new", $data['zag'], "left", 450), "none", 5);

    $Tab1.=$PHPShopGUI->setField("�����:", $oFCKeditor->AddGUI());


    // �������� 2
    $oFCKeditor = new Editor('podrob_new');
    $oFCKeditor->Height = '350';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Config['EditorAreaCSS'] = $PHPShopBase->getParam('dir.dir') . chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditor->Value = $data['podrob'];
    $oFCKeditor->Mod = 'textareas';

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 370), array("��������", $Tab2, 370));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.news.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.news.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.news.edit");

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

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;


    // �������� ��� ��������� default
    if (isset($_POST['EditorContent1']))
        $_POST['kratko_new'] = $_POST['EditorContent1'];
    if (isset($_POST['EditorContent2']))
        $_POST['podrob_new'] = $_POST['EditorContent2'];

    $_POST['datau_new'] = time();

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    $PHPShopOrm->clean();
    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['newsID']));
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();

?>