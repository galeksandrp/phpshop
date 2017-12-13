<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("admgui");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������������� ������";
$PHPShopGUI->debug_close_window=false;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','blog'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.blog.blog_log"));

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $_GET['id']));
    extract($data);

    $MyStyle = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->size = "630,530";
    $PHPShopGUI->addJSFiles($PHPShopGUI->dir.'/java/popup_lib.js', $PHPShopGUI->dir.'/java/dateselector.js');
    $PHPShopGUI->addCSSFiles($PHPShopGUI->dir.'/skins/' . $_SESSION['theme'] . '/dateselector.css');

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_balance_med[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"), true);
    $oFCKeditor = new Editor('description_new',true);
    $oFCKeditor->Height = '230';
    $oFCKeditor->Config['EditorAreaCSS'] = $MyStyle;
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $description;
    $oFCKeditor->Mod = 'textareas';

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����:", $PHPShopGUI->setInput("text", "date_new", $date, "left", 70) .
                    $PHPShopGUI->setCalendar('date_new',false,$PHPShopGUI->dir.'/icon/date.gif'), "left") .
            $PHPShopGUI->setField("���������:", $PHPShopGUI->setInput("text", "title_new", $title, "left", 400), "none", 5);

    $Tab1.=$PHPShopGUI->setField("�����:", $oFCKeditor->AddGUI());

    // �������� 2
    $oFCKeditor = new Editor('content_new',true );
    $oFCKeditor->Height = '320';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Config['EditorAreaCSS'] = $MyStyle;
    $oFCKeditor->Value = $content;
    $oFCKeditor->Mod = 'textareas';

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("��������", $Tab2, 350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "blogID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionSave() {
    global $PHPShopGUI, $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['blogID']));
    $PHPShopOrm->clean();

    $_GET['id'] = $_POST['blogID'];
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['blogID']));
    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['blogID']));
    return $action;
}

if ($UserChek->statusPHPSHOP < 2) {

// ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� ������� 
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>



