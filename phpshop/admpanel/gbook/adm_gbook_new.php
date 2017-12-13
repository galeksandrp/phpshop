<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������������� ������";
$PHPShopGUI->ajax = "'gbook','','','core'";
$PHPShopGUI->alax_lib = true;

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['gbook']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopModules;

    // �������
    $data['datas'] = PHPShopDate::get();
    $data['tema'] = __('����� �� ') . $data['datas'];
    $data['name'] = __('�������������');

    $PHPShopGUI->dir = "../";
    $PHPShopGUI->size = "630,530";
    $PHPShopGUI->addJSFiles('../java/popup_lib.js', '../java/dateselector.js');
    $PHPShopGUI->addCSSFiles('../css/dateselector.css');

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ������", "", $PHPShopGUI->dir . "img/i_account_properties_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('otvet_new');
    $oFCKeditor->Height = '320';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = null;

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����:", $PHPShopGUI->setInput("text", "datas_new", PHPShopDate::dataV($datas, false), "left", 70) .
            $PHPShopGUI->setCalendar('datas_new') .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setCheckbox('flag_new', '1', '�����', true)
            , "left");

    $Tab1.=$PHPShopGUI->setField("�����:", $PHPShopGUI->setText("���:&nbsp;&nbsp;", "left") .
                    $PHPShopGUI->setInput("text", "name_new", $data['name'], "none", 300) . $PHPShopGUI->setText("E-mail:", "left") . $PHPShopGUI->setInput("text", "mail_new", $mail, "none", 300), "none", 5) .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("����:", $PHPShopGUI->setTextarea("tema_new", $data['tema'], "left", '97%', '50px'), "none") .
            $PHPShopGUI->setField("�����:", $PHPShopGUI->setTextarea("otsiv_new", '����� � ��������', "left", '97%', '80px'), "none");

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("�����", $Tab2, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, null);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.gbook.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    $_POST['datas_new'] = time();

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