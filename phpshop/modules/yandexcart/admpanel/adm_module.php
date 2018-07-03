<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexcart.yandexcart_system"));

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

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;
    
    PHPShopObj::loadClass("order");

    // �������
    $data = $PHPShopOrm->select();

    $payment_delivery_value[] = array('�������� ������ + ���������� ������', 1, $data['payment_delivery']);
    $payment_delivery_value[] = array('�������� ������ ��� ���������', 2, $data['payment_delivery']);


    $Tab1 = '<hr>'.$PHPShopGUI->setField('����� ��� ������ � ��������', $PHPShopGUI->setInputText(false, 'token_new', $data['token'],400));
    $Tab1.= $PHPShopGUI->setField('ID �������� � �������', $PHPShopGUI->setInputText(false, 'campaign_new', $data['campaign'],400));
    $Tab1.= $PHPShopGUI->setField('������ ����������� ������� ��������', $PHPShopGUI->setInputText(false, 'password_new', $data['password'],400));
    $Tab1.= $PHPShopGUI->setField('������� ������', $PHPShopGUI->setSelect('payment_delivery_new', $payment_delivery_value));
    $Tab1.=$PHPShopGUI->setLine();

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();

    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status){
            $status_processing_value[] = array($order_status['name'], $order_status['id'], $data['status_processing']);
            $status_cancelled_value[] = array($order_status['name'], $order_status['id'], $data['status_cancelled']);
            $status_delivery_value[] = array($order_status['name'], $order_status['id'], $data['status_delivery']);
        }

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ����������� �� ��������', $PHPShopGUI->setSelect('status_processing_new', $status_processing_value));
    $Tab1.= $PHPShopGUI->setField('������ �������', $PHPShopGUI->setSelect('status_cancelled_new', $status_cancelled_value));
    $Tab1.= $PHPShopGUI->setField('������ ������� � ������ ��������', $PHPShopGUI->setSelect('status_delivery_new', $status_delivery_value));

    $Info = '<p><h4>��������� ������ ����������</h4>
        <ol>
        <li>�������������� � �������.
        <li>������� �� ������  <a target="_blank" href="https://oauth.yandex.ru/authorize?response_type=token&client_id=5b5057ed29784d83a5ba85c7c2cae9b9">https://oauth.yandex.ru</a>.
        <li>��������� ���������� <b>PHPShop ������.�����</b> �������� ������ � ����� ������ �� �������.
        <li>���������� ����� ����������� � ���� ��������� ������ "����� ��� ������ � ��������".
        </ol>
        
      <h4>��������� API ������</h4>
        <ol>
        <li>� ���� "URL API" �������: <b>https://'.$_SERVER['SERVER_NAME'].'/phpshop/modules/yandexcart/api.php</b>.
        <li>� ���� "SHA1 fingerprint" ������� SHA1 ������� ������ SSL �����������.
        <li>� ���� "��������������� �����" ������������� ����� � ������� � ���� ��������� ������ "������ ����������� ������� ��������".
        <li>� ���� "��� �����������" ������� ������� "URL"
        <li>� ���� "������ ������" ������� ������� "JSON"
        </ol>
        </p>';

    $Tab2 = $PHPShopGUI->setInfo($Info, 280, '98%');

    $Tab3 = $PHPShopGUI->setPay(false, false, $data['version'], false);

    // ������� ���������
    $Tab3.= $PHPShopGUI->setLine('<br>') . $PHPShopGUI->setHistory();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 320), array("����������", $Tab2, 320), array("� ������", $Tab3, 320),array("������ ��������", null,'?path=modules.dir.yandexcart'));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>