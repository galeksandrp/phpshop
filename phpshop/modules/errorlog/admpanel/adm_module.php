<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->reload='none';

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.errorlog.errorlog_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";


    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Error Log'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    switch($enabled) {
        case 0: $enabled_chek_0='selected';
            break;
        case 1: $enabled_chek_1='selected';
            break;
        default: $enabled_chek_2='selected';
        
    }
    
    $option[]=array('����������� ����� ���� ������',0,$enabled_chek_0);
    $option[]=array('���������� ������ � �������',1,$enabled_chek_1);
    $option[]=array('���������� ���',2,$enabled_chek_2);
    $Tab1=$PHPShopGUI->setSelect('enabled_new',$option,200,$float="none",$caption='������� ������');

    $Info='
��� �������� ���������������� ���������� ���������� � ����� ��� ���������� ������� ��������� ��� � ����� ������� ����� �������:

trigger_error("����� �������", E_USER_NOTICE);


';
    $Tab2=$PHPShopGUI->setTextarea("",$Info,"left",'98%',250);

    // ���������� �������� 2
    $Tab3=$PHPShopGUI->setPay($serial,false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270),array("����������",$Tab2,270),array("� ������",$Tab3,270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

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


