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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

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
    $PHPShopGUI->title="��������� ������ ��������� ������";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    // �����
    $e_value[]=array('�� ��������',0,$enabled);
    $e_value[]=array('�����',1,$enabled);
    $e_value[]=array('������',2,$enabled);
    
    // ��� ������
    $w_value[]=array('�����',0,$windows);
    $w_value[]=array('����������� ����',1,$windows);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '�������� ������'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('���������',$PHPShopGUI->setInputText(false,'title_new', $title));
    $Tab1.=$PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('title_end_new', $title_end));
    $Tab1.=$PHPShopGUI->setField('����� ������',$PHPShopGUI->setSelect('enabled_new',$e_value,150),'left');
    $Tab1.=$PHPShopGUI->setField('��� ������',$PHPShopGUI->setSelect('windows_new',$w_value,150),'left');
    
    $info='��� ������������ ������� �������� ������� ������� ������� ������ "�� ��������" � � ������ ������ �������� ����������
        <b>@returncall@</b> � ���� ������.
        <p>��� �������������� ����� ������ �������������� ������� phpshop/modules/returncall/templates/</p>
        <p>��� ��������� �������� ������ ����������� <b>@returncall_captcha@</b> � ����� ��������� ������ 
        phpshop/modules/returncall/templates/returncall_forma.tpl</p>
';

    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);

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