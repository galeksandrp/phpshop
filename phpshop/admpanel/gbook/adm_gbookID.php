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
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));
    extract($data);

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    $PHPShopGUI->dir = "../";
    $PHPShopGUI->size = "630,530";
    $PHPShopGUI->addJSFiles('../java/popup_lib.js', '../java/dateselector.js');
    $PHPShopGUI->addCSSFiles('../css/dateselector.css');

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_account_properties_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('otvet_new');
    $oFCKeditor->Height = '320';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $otvet;

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����:", $PHPShopGUI->setInput("text", "datas_new", PHPShopDate::dataV($datas, false), "left", 70) .
            $PHPShopGUI->setCalendar('datas_new') .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setCheckbox('flag_new', '1', '�����', $flag)
            , "left");

    $Tab1.=$PHPShopGUI->setField("�����:", $PHPShopGUI->setText("���:&nbsp;&nbsp;", "left") .
                    $PHPShopGUI->setInput("text", "name_new", $name, "none", 300) . $PHPShopGUI->setText("E-mail:", "left") . $PHPShopGUI->setInput("text", "mail_new", $mail, "none", 300), "none", 5) .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("����:", $PHPShopGUI->setTextarea("tema_new", $tema, "left", '97%', '50px'), "none") .
            $PHPShopGUI->setField("�����:", $PHPShopGUI->setTextarea("otsiv_new", $otsiv, "left", '97%', '80px'), "none");

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("�����", $Tab2, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.gbook.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.gbook.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.gbook.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� �������� �����
function sendMail($name, $mail) {
    global $PHPShopSystem, $PHPShopBase;

    // ���������� ���������� �������� �����
    PHPShopObj::loadClass("mail");

    $zag = "��� ����� �������� �� ���� " . $PHPShopSystem->getValue('name');
    $message = "��������� " . $name . ",

��� ����� �������� �� ���� �� ������: http://" . $PHPShopBase->getSysValue('dir.dir') . $_SERVER['SERVER_NAME'] . "/gbook/

������� �� ����������� �������.";
    new PHPShopMail($PHPShopSystem->getValue('admin_mail'), $mail, $zag, $message);
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

    $_POST['datas_new'] = PHPShopDate::GetUnixTime($_POST['datas_new']);
    if (empty($_POST['flag_new']))
        $_POST['flag_new'] = 0;
    else if (!empty($_POST['mail_new']))
        sendMail($_POST['name_new'], $_POST['mail_new']);

    // �������� ��� ��������� default
    if (isset($_POST['EditorContent1']))
        $_POST['otvet_new'] = $_POST['EditorContent1'];

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