<?php

$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("text");
PHPShopObj::loadClass("array");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/",'yescredit');


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yescredit.yescredit_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug=false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function payment($id) {
    PHPShopObj::loadClass('payment');
    $PHPShopPayment = new PHPShopPaymentArray();
    $Payment=$PHPShopPayment->getArray();
    if(is_array($Payment))
        foreach($Payment as $val)
            if(!empty($val['enabled'])){
                if($id == $val['id']) $sel='selected';
                else $sel=null;
                $value[]=array($val['name'],$val['id'],$sel);
            }

    return PHPShopText::select('payment_id_new',$value,250);
}

function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm,$PHPShopModules;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������ Yes Credit";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Yes Credit'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('��� ������',payment($data['payment_id']));
    $Tab1.=$PHPShopGUI->setField('MERCHANT ID',$PHPShopGUI->setInputText(false,'MERCHANT_ID_new',$data['MERCHANT_ID'],100,' * �������� ��� ����������� ������'));

    $info='��������� �� ������������� <a href="http://www.yes-credit.ru/?from=phpshop_mod" target="_blank">YesCredit</a> �� �������� +7 (495) 640-38-28 ��� �������� ������ �� <a href="mailto:info@webfinance.ru">info@webfinance.ru</a> ��� ������������
������ ����������, ������ ������ � ������������ �� ����������� �������� �����������.

<p>����� ���������� �������� ��� ����� ������������� ����������� ����� ������������, ������� ����� ����� ������ � ������ � ������� ��������,
� ������� �� ������� ����������� ������� ��������� ��������� ������, ������ ������� � ������� ������, ��������
������������� ����� �� ��������� �������.
';

    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');

    // ����� �����������
    $Tab3=$PHPShopGUI->setPay($data['serial'],true);

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