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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexmoney.yandexmoney_system"));

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
    $PHPShopGUI->title = "��������� ������ ������.������";
    $PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '������.������'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField('������������ ���� ������', $PHPShopGUI->setInputText(false, 'title_new', $title));
    $Tab1.=$PHPShopGUI->setField('���� �', $PHPShopGUI->setInputText(false, 'merchant_id_new', $merchant_id, 210), 'left');
    $Tab1.=$PHPShopGUI->setField('��������� �����', $PHPShopGUI->setInputText(false, 'merchant_sig_new', $merchant_sig, 210), 'left');

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $status);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $status);

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ��� �������', $PHPShopGUI->setSelect('status_new', $order_status_value, 210));

    $Tab1.=$PHPShopGUI->setField('�������� ������', $PHPShopGUI->setTextarea('title_end_new', $title_end));


    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);
    
            $info='��� ������ ������ ��������� ��������� ����� HTTP-����������� �� ������: <a href="https://sp-money.yandex.ru/myservices/online.xml" target="_blank">https://sp-money.yandex.ru/myservices/online.xml</a>. � �������� ������ ��� ����������� ����� ������� <b>http://'.$_SERVER['SERVER_NAME'].'/phpshop/modules/yandexmoney/payment/result.php</b>. 
                <p>
� ���� "������" ����� ������� ���� ����� �������� ��� �������� ������������ ��������. ���� ������ ����� ����������� � �������� "��������" ��������� ������ � ����������� ����.</p>';

    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("����������", $Tab2, 270), array("� ������", $Tab3, 270));

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