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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sortbrand.sort_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug=false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

/**
 * ����� ��������������
 */
function getSortValue($n) {
    global $PHPShopGUI;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),array('filtr'=>"='1'",'goodoption'=>"!='1'"),array('order'=>'num'),array('limit'=>100));
    if(is_array($data))
        foreach($data as $row) {

            if($n == $row['id']) $sel='selected';
            else $sel=false;

            $value[]=array($row['name'],$row['id'],$sel);
        }

    return $PHPShopGUI->setSelect('sort_new',$value,300);
}

function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������ ������ �� ����������";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    // �����
    switch($enabled) {
        case 0: $s0='selected';
            break;
        case 1: $s1='selected';
            break;
        case 2: $s2='selected';
            break;
    }

    $e_value[]=array('�� ��������',0,$s0);
    $e_value[]=array('�����',1,$s1);
    $e_value[]=array('������',2,$s2);

    switch($flag) {
        case 1: $s3='selected';
            break;
        case 2: $s4='selected';
            break;
    }

    $f_value[]=array('���������� ������',1,$s3);
    $f_value[]=array('������',2,$s4);




    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '������ �� ����������'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('���������',$PHPShopGUI->setInputText(false,'title_new', $title));
    $Tab1.=$PHPShopGUI->setField('��������������',getSortValue($sort));
    $Tab1.=$PHPShopGUI->setField('����� ������',$PHPShopGUI->setSelect('enabled_new',$e_value,150));
    $Tab1.=$PHPShopGUI->setField('������ ������',$PHPShopGUI->setSelect('flag_new',$f_value,150));

    $info='��� ������������ ������� �������� ������� ������� �������� ������ "�� ��������" � � ������ ������ �������� ����������
        <b>@brand@</b> � ���� ������.
        <p>��� �������������� ����� ������ �������������� ������� phpshop/modules/sortbrand/templates/</p>
';

    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');

    // ����� �����������
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