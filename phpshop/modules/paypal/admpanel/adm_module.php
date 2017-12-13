<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("payment");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("valuta");


$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.paypal.paypal_system"));

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

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ PayPal";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'PayPal'", "��������� �����������", "../install/logo_header.png");

    $Tab1 = $PHPShopGUI->setField('������������ ���� ������', $PHPShopGUI->setInputText(false, 'title_new', $title));
    $Tab1.=$PHPShopGUI->setField('������������', $PHPShopGUI->setInputText(false, 'merchant_id_new', $merchant_id, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(false, 'merchant_pwd_new', $merchant_pwd, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('�������', $PHPShopGUI->setInputText(false, 'merchant_sig_new', $merchant_sig, 210), 'left');

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $status);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $status);

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ��� �������', $PHPShopGUI->setSelect('status_new', $order_status_value, 210), 'left');

    // ������
    $Tab1.= $PHPShopGUI->setLine() . $PHPShopGUI->setField('����� ������ �� ������', $PHPShopGUI->setInputText(null, 'link_new', $link, 210), 'left');

    // Sandbox
    $sandbox_value[] = array('�������', 1, $sandbox);
    $sandbox_value[] = array('��������', 2, $sandbox);
    $Tab1.= $PHPShopGUI->setField('�������� �����', $PHPShopGUI->setSelect('sandbox_new', $sandbox_value), 'left');

    // �������
    $logo_value[] = array('�����', 1, $logo_enabled);
    $logo_value[] = array('������', 2, $logo_enabled);
    $logo_value[] = array('��������', 3, $logo_enabled);
    $Tab1.= $PHPShopGUI->setField('������� PayPal', $PHPShopGUI->setSelect('logo_enabled_new', $logo_value), 'left');

    // ������
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    $valuta_area = null;
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            if ($data['currency_id'] == $val['id']) {
                $check = 'checked';
                $valuta_def_name = $val['code'];
            }
            else
                $check = false;
            $valuta_area.=$PHPShopGUI->setRadio('currency_id_new', $val['id'], $val['name'], $check);
        }
    $Tab1.= $PHPShopGUI->setLine().$PHPShopGUI->setField('������ �������',$valuta_area);    

    $Tab4 = $PHPShopGUI->setField('��������� �� ���������� �������', $PHPShopGUI->setTextarea('title_end_new', $title_end));
    $Tab4.=$PHPShopGUI->setField('��������� ��������� ����� ������', $PHPShopGUI->setInputText(null, 'message_header_new', $message_header, '100%'));
    $Tab4.=$PHPShopGUI->setField('C�������� ����� ������', $PHPShopGUI->setTextarea('message_new', $message));


    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay(false, false, $version, true);

    $info = '��� ������ ������ ��������� ������������������ � PayPal �� ������: <a href="https://www.paypal.com/ru/webapps/mpp/solutions" target="_blank">https://www.paypal.com/ru/webapps/mpp/solutions</a>. 
                <p>
� ���� "������������", "������" � "�������" ������ ����������� ������, ���������� ����� ����������� ������ �������� � PayPal.</p> <p>
��� ������������ ������ ����������� ����� "�������� �����" � �������� "�����������". ��� ����������� ������� ������� ������� ������ ������ ������ � �������� "�����������". </p><p>����� "������� PayPal" ���������� ������������ ������� ��������� �������. ������ �������� ��������� � ����� phpshop/modules/paypal/templates/paypal_logo.tpl. �������������� ������������ �������� �������� �� ������: <a href="https://www.paypal.com/ru/webapps/mpp/logos" target="_blank">https://www.paypal.com/ru/webapps/mpp/logos</a>.</p> <p> ������ �������� ��������� �������: phpshop/modules/paypal/templates/paypal_forma.tpl</p><p>IPN ���������� ������: http://'.$_SERVER['SERVER_NAME'].'/phpshop/modules/paypal/payment/ipn.php</p>';

    $Tab2 = $PHPShopGUI->setInfo($info, 230, '96%');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("�����������", $Tab1, 270), array("���������", $Tab4, 270), array("����������", $Tab2, 270), array("� ������", $Tab3, 270));

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
}
else
    $UserChek->BadUserFormaWindow();
?>