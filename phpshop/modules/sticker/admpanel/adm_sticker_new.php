<?

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");


$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->ajax = "'modules','sticker'";
$PHPShopGUI->addJSFiles('../../../lib/Subsys/JsHttpRequest/Js.js');
$PHPShopGUI->dir = $_classPath . "admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sticker.sticker_forms"));

// ������� ������
function actionInsert() {
    global $PHPShopOrm;

    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;

    // ��������
    if (isset($_POST['EditorContent1']))
        $_POST['content_new'] = $_POST['EditorContent1'];

    $action = $PHPShopOrm->insert($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $_classPath;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "�������� ������ �������";
    $PHPShopGUI->size = "630,530";


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ������ �������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField('��������:', $PHPShopGUI->setInputText(false, 'name_new', '����� ������', '98%'));
    $Tab1.=$PHPShopGUI->setField('������:', $PHPShopGUI->setInputText('@sticker_', 'path_new', 'example', 100,'@'));
    $Tab1.=$PHPShopGUI->setField('�����:', $PHPShopGUI->setCheckbox('enabled_new', '1', '����� �� �����', 1));
    $Tab1.=$PHPShopGUI->setField('�������� � ���������:', $PHPShopGUI->setInputText(false, 'dir_new', '', '98%', ' * ������: /page/about.html,/page/company.html'));


    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"), true);
    $oFCKeditor = new Editor('content_new', true);
    $oFCKeditor->Height = '320';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $content;

    $Tab2 = $oFCKeditor->AddGUI();


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("����������", $Tab2, 350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}else
    $UserChek->BadUserFormaWindow();
?>


