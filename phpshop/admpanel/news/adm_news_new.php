<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("admgui");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������� �������";
$PHPShopGUI->ajax = "'news','','','core'";
$PHPShopGUI->alax_lib = true;

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopModules,$PHPShopSystem;

    // �������
    $data['datas'] = PHPShopDate::get();
    $data['zag'] = __('������� �� ') . $data['datas'];

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    //$PHPShopGUI->size = "630,530";
    $PHPShopGUI->addJSFiles('../java/popup_lib.js', '../java/dateselector.js');
    $PHPShopGUI->addCSSFiles('../css/dateselector.css');


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� �������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_balance_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('kratko_new');
    $oFCKeditor->Height = '270';
    $oFCKeditor->Config['EditorAreaCSS'] = $MyStyle;
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
    $oFCKeditor->Config['EditorAreaCSS'] = $MyStyle;
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
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.news.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    $_POST['datau_new'] = time();

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
