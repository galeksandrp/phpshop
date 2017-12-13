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

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexkassa.yandexkassa_system"));

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

    if (is_array($_POST['pay_variants_new']))
        $_POST['pay_variants_new'] = serialize($_POST['pay_variants_new']);
    if (!isset($_POST['test_new']))
        $_POST['test_new'] = 0;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ ������.������";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '������.�����'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField('������������ ���� ������', $PHPShopGUI->setInputText(false, 'title_new', $title));
    $Tab1 .= $PHPShopGUI->setField('�������� �����', $PHPShopGUI->setCheckbox('test_new', 1, '��������/��������� �������� �����', $test), 'left');
    $Tab1.=$PHPShopGUI->setField('ShopID', $PHPShopGUI->setInputText(false, 'merchant_id_new', $merchant_id, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('Scid', $PHPShopGUI->setInputText(false, 'merchant_scid_new', $merchant_scid, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('��������� �����', $PHPShopGUI->setInputText(false, 'merchant_sig_new', $merchant_sig, 210), 'left');

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $status);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $status);

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ��� �������', $PHPShopGUI->setSelect('status_new', $order_status_value, 210), 'left');

    $Tab1.=$PHPShopGUI->setField('�������� ������', $PHPShopGUI->setTextarea('title_end_new', $title_end, "left", "209px", "30px"), 'left');

    // ��������� ������
    require_once(dirname(__FILE__) . '/../hook/mod_option.hook.php');
    $PHPShopYandexkassaArray = new PHPShopYandexkassaArray();
    $value = $PHPShopYandexkassaArray->get_pay_variants_array(unserialize($pay_variants));

    $Tab1.=$PHPShopGUI->setField('������� ������ (������� ����� Ctrl)', $PHPShopGUI->setSelect('pay_variants_new[]', $value, '450px', false, FALSE, false, "50px", false, true),"left");


    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);

    $info = '����������� ������ ����������� ��� ����������� � ����������� � ������.�����:
            <p>CheckOrder URL: <ins>https://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/yandexkassa/payment/check.php</ins>. <br>
            PaymentAviso URL: <ins>https://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/yandexkassa/payment/aviso</ins>.php. <br>
            SuccessURL: <ins>http://' . $_SERVER['SERVER_NAME'] . '/yandexkassa/?act=success</ins>. <br>
            FailURL URL: <ins>http://' . $_SERVER['SERVER_NAME'] . '/yandexkassa/?act=fail</ins>. </p>
                <p>����������� �������� ����� �� ������� "��������" ��� ���������� �������� ��������. ���� "��������� �����" ����������� ������� ���������� � ���� "shopPassword" ��� ����������� � �������. ���� "ShopID" � "Scid" ��� ������� ��������� ������.����� ����� �����������.</p>
                <p>� ��������� "������ ��� �������" �������� ������ ������, ��� ������� ������������ ������ ��������� ����������� �������� ����� ������ ��������. ���� ������ ������ "����� �����", ������������ ������ �������� ����� ����� ����� ����������. ��������� �������� � ���� "�������� ������" ��������� ����� ���������� ������ � ������, ����� ������ ������ �� ��������� �� �������� ��������� � ��������� "������ ��� �������".</p>
                <p>� ������ "������� ������" �������� ��, ������� ������ ������������ �� ����� �����.</p>
                <p>������ ������ ���������� � �������� ������� ����� ���������: phpshop/modules/yandexkassa/templates/payment_forma.tpl</p>
                <p>������ ��������� �� �������� ������: phpshop/modules/yandexkassa/templates/success_forma.tpl</p>
                <p>������ ��������� �� �������� ������: phpshop/modules/yandexkassa/templates/fail_forma.tpl</p>
    ';

    $Tab2 .= $PHPShopGUI->setButton("������� � ��������� ���������� �� ����������� ������.�����", "../templates/logo.png", "440px", "50px",null,"window.open('http://faq.phpshop.ru/page/yandex-kassa.html','_blank');");
    $Tab2 .= $PHPShopGUI->setInfo($info, 200, '96%');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 302), array("����������", $Tab2, 302), array("� ������", $Tab3, 302));

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