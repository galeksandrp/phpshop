<?php

$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->reload="parent";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_job"));


// ������� ����������
function actionInsert() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->insert($_POST);
    return $action;
}



// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$_classPath;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="�������� ����� ������";
    $PHPShopGUI->size="500,450";


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� ����� ������ Cron","������� ������ ��� ������ � ����.",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

     $work[]=array('�������','');
     $work[]=array('����� ��','phpshop/modules/cron/sample/dump.php');
     $work[]=array('����� �����','phpshop/modules/cron/sample/currency.php');
    
    $Tab1=$PHPShopGUI->setField("�������� ������:",$PHPShopGUI->setInput("text","name_new",'����� ������',"left",400));
    $Tab1.=$PHPShopGUI->setField("����������� ����:".$PHPShopGUI->setCheckbox("enabled_new",1,"��������",1),$PHPShopGUI->setInput("text","path_new",false,"left",400).$PHPShopGUI->setSelect('work', $work, 100, 'left', false, 'document.getElementById(\'path_new\').value=this.value').$PHPShopGUI->setLine("* phpshop/modules/cron/sample/testcron.php"));
    $Tab1.=$PHPShopGUI->setSelect('execute_day_num_new',$PHPShopGUI->setSelectValue(false),50,1,'���������� �������� � ����:');
    
    

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270));

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