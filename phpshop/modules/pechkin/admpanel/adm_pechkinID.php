<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("string");


$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window=true;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','pechkin'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

include("../class/PHPechkin.php");
//������
    $PHPechkinL = new PHPechkin();
    $PHPechkinL->__construct($_SESSION['pechkinLogin'],$_SESSION['pechkinPass']);

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.pechkin.pechkin_forms"));


// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm,$PHPechkinL;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="�������������� �����-�����";
    $PHPShopGUI->size="650,540";


    // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    @extract($data);

    $PHPShopGUI->addJSFiles('../../../admpanel/java/popup_lib.js');


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ����-��������","",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    //����������� � �������
    $lists_get = $PHPechkinL->lists_get($list_id);
    $base_name = PHPShopString::utf8_win1251($lists_get['row']['name']);


    $Tab1=$PHPShopGUI->setField('�������� ����: <b>'.$base_name.'</b> (ID: '.$list_id.')',
        $PHPShopGUI->setText($PHPShopGUI->setRadio("enabled_new", 1, "��������", $enabled) .
        $PHPShopGUI->setRadio("enabled_new", 0, "���������",$enabled),'left')
    );

    $param_ar = explode('::', $param);
    foreach ($param_ar as $par) {
        if($par!='0') {
            if($par=='name') {
                $html_param .= '���,';
            }
            if($par=='datas') {
                $html_param .= '���� �������� ������������,';
            }
            if($par=='tel') {
                $html_param .= '�������,';
            }
            if($par=='tel_new') {
                $html_param .= '�������,';
            }
            if($par=='country_new') {
                $html_param .= '������,';
            }
            if($par=='state_new') {
                $html_param .= '������,';
            }
            if($par=='city_new') {
                $html_param .= '�����,';
            }
            if($par=='index_new') {
                $html_param .= '������,';
            }
            if($par=='house_new_new') {
                $html_param .= '���,';
            }
            if($par=='porch_new') {
                $html_param .= '�������,';
            }
            if($par=='flat_new') {
                $html_param .= '��������,';
            }

        }
    }

    
    $Tab1.=$PHPShopGUI->setField('������',
        $PHPShopGUI->setText(
            '<u>��� �������� ����:</u> <b>'.$base_name.'</b><br>' .
            '<u>ID �������� ����:</u> <b>'.$list_id.'</b><br>' .
            '<u>���:</u> <b>'.($type==1 ? '����������' : '������������').'</b><br>' .
            '<u>�������������� ����:</u> <b>'.$html_param.'</b><br>' .
            '<u>���� ��������:</u> <b>'.$date_create.'</b><br>'
        ,'left')
    );
    
                            
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,405));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","delID","�������","right",70,"","but","actionDelete").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

//������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;

    $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id'=>'='.$_POST['newsID']));
    return $action;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'],'actionStart','none');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>


