<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");


$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window=false;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','formgenerator'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.formgenerator.formgenerator_forms"));


// ������� ������
function actionInsert() {
    global $PHPShopOrm;
    if(empty($_POST['user_mail_copy_new'])) $_POST['user_mail_copy_new']=0;
    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;

    $action = $PHPShopOrm->insert($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="�������� ����� �����";
    $PHPShopGUI->size="630,530";


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ����� �����","������� ������ ��� ������ � ����.",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    if(is_file('../templates/formgenerator.tpl'))
        $content=file_get_contents('../templates/formgenerator.tpl');

    $Tab1=$PHPShopGUI->setField('��������:',$PHPShopGUI->setInputText(false,'name_new','����� �����','98%'));
    $Tab1.=$PHPShopGUI->setField('������:',$PHPShopGUI->setInputText('http://'.$_SERVER['SERVER_NAME'].'/formgenerator/','path_new','example',100),'left');
    $Tab1.=$PHPShopGUI->setField('E-mail:',$PHPShopGUI->setInputText(false,'mail_new',$PHPShopSystem->getParam("admin_mail"),'97%'));
    $Tab1.=$PHPShopGUI->setline().$PHPShopGUI->setField('�����:',$PHPShopGUI->setCheckbox('enabled_new','1','����� �� �����',1).
            $PHPShopGUI->setCheckbox('user_mail_copy_new','1','������� ����� ������������ �� e-mail',1));
    $Tab1.=$PHPShopGUI->setField('��������� ����� ��������:',$PHPShopGUI->setTextarea('success_message_new','������ �������, ���� ��������� �������� � ����.',false,'97%'));
    $Tab1.=$PHPShopGUI->setField('��������� � ���������� ������������ �����:',$PHPShopGUI->setTextarea('error_message_new','������ ���������� �����. ��������� ��� ����, ���������� ����������� (*).',false,'97%'));
    

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"),true);

    if(class_exists('Editor')) {

        $oFCKeditor = new Editor('content_new') ;
        $oFCKeditor->Height = '320';
        $oFCKeditor->Config['EditorAreaCSS'] = $_classPath."templates".chr(47).$PHPShopSystem->getParam("skin").chr(47).$SysValue['css']['default'];

        // ��������� ������ ���������
        $oFCKeditor->BasePath=$PHPShopGUI->dir.'editors/'.$oFCKeditor->BasePath;
        $oFCKeditor->ToolbarSet = 'Normal';
        $oFCKeditor->Value = $content;

        $Tab2=$oFCKeditor->AddGUI();

    } else $Tab2=$PHPShopGUI->setTextarea('content_new', $content, 'none', '97%', '300px');

    $Tab3=$PHPShopGUI->setField('�������� � ���������:',$PHPShopGUI->setInputText(false,'dir_new','','98%',' * ������: /page/about.html,/page/company.html'));

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,350),array("����������",$Tab2,350),array("�����",$Tab3,350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionInsert");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'],'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>


