<?php

$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.forumlastpost.ipboard_system"));


// ������� ����������
function actionUpdate(){
global $PHPShopOrm;


if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;

$PHPShopOrm->debug=false;
$action = $PHPShopOrm->update($_POST);
return $action;
}




function actionStart(){
global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


$PHPShopGUI->dir=$_classPath."admpanel/";
$PHPShopGUI->title="��������� ������ IP.Board";
$PHPShopGUI->size="500,450";


// �������
$data = $PHPShopOrm->select();
@extract($data);

if ($enabled==1) $enabled="checked"; else $enabled="";
if($flag==1) $s2="selected";
  else $s1="selected";


$Select[]=array("�����",0,$s1);
$Select[]=array("������",1,$s2);

// ����������� ��������� ����
$PHPShopGUI->setHeader("��������� ������ 'Forum Last Post'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

// ������� ������� ��� �����
$ContentField2=$PHPShopGUI->setText("�����: ").$PHPShopGUI->setInput("text","path_new",$path,$float="left",$size=300);
$ContentField2.=$PHPShopGUI->setText("/lastpost.php");
$ContentField2.=$PHPShopGUI->setLine() ;
$ContentField2.=$PHPShopGUI->setText("������: ").$PHPShopGUI->setInput("text","width_new",$width,$float="none",$size=50);
$ContentField2.=$PHPShopGUI->setText("������: ").$PHPShopGUI->setInput("text","height_new",$height,$float="none",$size=50);
$ContentField2.=$PHPShopGUI->setText("���������: ").$PHPShopGUI->setInput("text","title_new",$title,$float="none",$size=300);
$ContentField3=$PHPShopGUI->setField("������������:",$PHPShopGUI->setSelect("flag_new",$Select,100,1),"left",5);
$ContentField4=$PHPShopGUI->setField("��������� �� �������:",$PHPShopGUI->setInput("text","num_new",$num,$float="left",$size=50),"left",5);

// ���������� �������� 1
$Tab1=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("enabled_new",1,"����� ����� �� �����",$enabled),$ContentField2).
        $ContentField3.$ContentField4;




// ���������� �������� 2
$Info='��� ������ ������ ��������� ��������� � �������� ���������� ������ ���� lastpost.php � ������ ����������.
    
����� �������� �� ������: http://'.$_SERVER['SERVER_NAME'].'/phpshop/modules/forumlastpost/code/
    
��� ��������� ����� "����� ����� �� �����" ��������� � ��������� ��������� � ������ ����� ������������ ��������� � ����� ��� ������
��������� ���� ������������� � ����� ������.

��� ������������� ��������� ����� ������ ��������� ����� ����� ������� "����� ����� �� �����" � � �������� ��������� @forumlastpost@
� ������ ����� �������� index.tpl � shop.tpl.
';
$Load=$PHPShopGUI->setInput("button","","������� ����� ��� ������","left",300,"return window.open('/phpshop/modules/forumlastpost/code/');","but");
$Tab2=$PHPShopGUI->setTextarea("",$Info,"left",450,200).$Load;

// ����� �����������
$Tab3=$PHPShopGUI->setPay($serial,false);

// ����� ����� ��������
$PHPShopGUI->setTab(array("��������",$Tab1,270),array("��������",$Tab2,270),array("� ������",$Tab3,270));

// ����� ������ ��������� � ����� � �����
$ContentFooter=
$PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
$PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
$PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

$PHPShopGUI->setFooter($ContentFooter);
return true;
}

if($UserChek->statusPHPSHOP < 2){

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'],'actionStart');

// ��������� ������� 
$PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>