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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.pickpoint.pickpoint_system"));


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
    $PHPShopGUI->title="��������� ������ PickPoint";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    if($type_service =='STD')
        $s0='selected';
    else $s1='selected';

    $type_service_value[]=array('STD - ��������, �������� ��������������� ������ ��� ������ ������ �� �����','STD',$s0);
    $type_service_value[]=array('STDCOD - �������� � ������� ������ �� �����, �.�. ���������� ������','STDCOD',$s1);


    switch($type_reception){
        case "CUR":
            $s2='selected';
        break;
        case "WIN":
            $s3='selected';
        break;
        case "APTCON":
            $s4='selected';
        break;
        case "APT":
            $s5='selected';
        break;
    }

    $type_reception_value[]=array('CUR � ���� ����������� �������� PickPoint','CUR',$s2);
    $type_reception_value[]=array('WIN � ��������������� ������ ����������� � ���� ������ �� ������������� ����� PickPoint','WIN',$s3);
    $type_reception_value[]=array('APTCON � ����� ����������� ��������������� � 1 ������ � ��������� �����','APTCON',$s4);
    $type_reception_value[]=array('APT � ��������������� ������ ����������� �� ����������','APT',$s4);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'PickPoint'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('��� �������� PickPoint',$PHPShopGUI->setInputText(false,'city_new', $city,300,'<br>* �������� ������ ���� �������
        � ���� � � ��������� ��������� � �� ������.'));
    $Tab1.=$PHPShopGUI->setField('����� ������',$PHPShopGUI->setInputText(false,'name_new', $name,300));
   
    $Tab1.=$PHPShopGUI->setField('���� �����',$PHPShopGUI->setSelect('type_service_new',$type_service_value,400));
    $Tab1.=$PHPShopGUI->setField('��� ������',$PHPShopGUI->setSelect('type_reception_new',$type_reception_value,400));


    $info='���������� ������� ����� ��������, � ������ ������� ���� ����� \'PickPoint\'. ���� ��� ��c����� ��������� ��������, ��
        ����� ���-������� ��������� ����� ������� � ���������� ����� ������ � ���� \'��� �������� PickPoint\'. ��� �������, ��� �������� �����
        PickPoint, ����� ������ �������� �������� � ���� ��������, � ������� ����� PickPoint ���������� � ����� ��������. ��� ������� �� ��������� �
        ������ �������� ��������.
<p>
����� ������ �� ����� �������������� ������ ������ � ��������� XML ������ �������� ������ � ������ ���������� ������� <a href="http://
PickPoint.ru?from=phpshop_mod" target="_blank">PickPoint<a>.
</p> ';

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