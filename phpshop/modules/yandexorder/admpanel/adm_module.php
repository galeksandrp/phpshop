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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexorder.yandexorder_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug=false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}




function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������ ������ ������� �����";
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
    $PHPShopGUI->setHeader("��������� ������ '������ ������� �����'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

// ���������� ��������
    $Info='��� ������ ������ ��������� ���������������� ���� ������� � ��������� "������� �����", ��� ����� ��������� �� ������
        <a href="http://partner.market.yandex.ru/delivery-registration.xml" target="_blank">
        http://partner.market.yandex.ru/delivery-registration.xml</a> � ������� � �������� ����� ����� �����
        <p><b>http://'.$_SERVER['SERVER_NAME'].$SysValue['dir']['dir'].'/order/</b></p>
';
    $Tab1=$PHPShopGUI->setInfo($Info,false,'96%');
    $Tab1.=$PHPShopGUI->setLine('<br>');
    $Tab1.=$PHPShopGUI->setField('������:',$PHPShopGUI->setInputText(false,'img_new',$img));

// ����� �����������
    $Tab2=$PHPShopGUI->setPay($serial,false);


// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270),array("� ������",$Tab2,270));

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