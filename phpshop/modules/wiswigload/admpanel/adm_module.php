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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.wiswigload.wiswigload_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST);
    return $action;
}


function actionStart() {
    global $PHPShopGUI,$_classPath,$PHPShopOrm;
    
    
    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";
    
    
    // �������
    $data = $PHPShopOrm->select();
    @extract($data);
    
    
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'WISWIG Load'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");
     
    $Info='
     ��� ����������� �������� ����� ���������� ���������� ���������� ���������� ����� CHMOD 775 �� ����� /phpshop/admpanel/editors
     ��� ������������� ������������ ��������� PHPShop EasyControl "��� ����" ��� ������ ������� ������������ ������� ��� �� Windows
     ����� CHMOD �� ����� ����������� �� �����.
     ';
     
    $Tab1.=$PHPShopGUI->setLine('<br>');
    $Tab1.=$PHPShopGUI->setInfo($Info,150,'97%');
    $Tab2=$PHPShopGUI->setPay($serial,false);

    $Lib='� ������ ������������ �������� ����������:
<p>
<a href="http://http://www.tinymce.com/" target="_blank">TinyMCE</a>, Copyright (C) Moxiecode Systems AB.<br>
<a href="http://http://www.fckeditor.net/" target="_blank">FCKeditor</a>, Copyright (C) Frederico Caldeira Knabben<br>
</p>
        ';
    $Tab2.=$PHPShopGUI->setInfo($Lib,70,'95%');
    
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270),array("� ������",$Tab2,270));
    
    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","�������","right",70,"return onCancel();","but");
    
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


