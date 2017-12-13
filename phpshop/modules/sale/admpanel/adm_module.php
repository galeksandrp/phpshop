<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sale.sale_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$LoadItems;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $price = ($price + (($price * $LoadItems['System']['percent']) / 100));
    $pr = $_POST['mod_sale_price'] / 100;

    switch($_POST['mod_sale_old']){
        case "null":
            $price_n='price=0 ';
            break;
        case "price":
            $price_n='price=price'.$_POST['mod_sale_opt'].'(price*'.$pr.') ';
            break;
        default:
            $price_n=null;
    }
    

    $PHPShopOrm->sql = 'update ' . $GLOBALS['SysValue']['base']['products'] . ' set 
    '.$price_n.'
    price=price' . $_POST['mod_sale_opt'] . '(price*' . $pr . ')'; 
    $action=$PHPShopOrm->update();

    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ ����������";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '����������'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $sel_value[] = array('+', '+', false);
    $sel_value[] = array('-', '-', 'selected');
    $sel = $PHPShopGUI->setSelect('mod_sale_opt', $sel_value, 40);
    $Tab1 = $PHPShopGUI->setField('����� ����', $PHPShopGUI->setInputText('�������� ���� � ���� ������� �� ' . $sel, 'mod_sale_price', "", '30', '%'));

    $sel_value2[]=array('�������','none');
    $sel_value2[]=array('��������','null');
    $sel_value2[]=array('��������� �������� ��������� ���� �� ���������','price');

    $Tab1.=$PHPShopGUI->setField('������ ����', $PHPShopGUI->setSelect('mod_sale_old', $sel_value2, 300));

 $Info = '
��� ������� ������ ����������� �������� ����������� �������� "����������" � �������� �������������� ���������� �������� �������.
<p>��� ������ ������ �������� �������� ������� (+) � ����� "��������" ������ ����.
';
    $Tab1.= $PHPShopGUI->setInfo($Info,50,'95%');
    
    $Tab2 = $PHPShopGUI->setPay($serial, false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab2, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}else
    $UserChek->BadUserFormaWindow();
?>