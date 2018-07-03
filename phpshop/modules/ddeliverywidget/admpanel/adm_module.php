<?php

PHPShopObj::loadClass("order");
PHPShopObj::loadClass("delivery");

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.ddeliverywidget.ddeliverywidget_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopModules;


    // ��������
    if (isset($_POST['delivery_id_new'])) {
        if (is_array($_POST['delivery_id_new'])) {
            foreach ($_POST['delivery_id_new'] as $val) {
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
                $PHPShopOrm->update(array('is_mod_new' => 2), array('id' => '=' . intval($val)));
            }
            $_POST['delivery_id_new'] = @implode(',', $_POST['delivery_id_new']);
        }
    }

    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.ddeliverywidget.ddeliverywidget_system"));
    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);

    header('Location: ?path=modules&id=' . $_GET['id']);

    return $action;
}

function getLinkOption($key) {
    global $_classPath;
    include($_classPath . 'modules/ddeliverywidget/class/ddeliverywidget.class.php');
    $DDeliveryHelper = new DDeliveryHelper();
    $result = $DDeliveryHelper->request($key . '/pam.json', false);

    return $result['data']['url'];
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $PHPShopGUI->addJSFiles('../modules/ddeliverywidget/admpanel/gui/ddeliverywidget.gui.js');

    $link = getLinkOption($data['key']);

    // ��������
    $PHPShopDeliveryArray = new PHPShopDeliveryArray(array('is_folder' => "!='1'", 'enabled' => "='1'"));

    $DeliveryArray = $PHPShopDeliveryArray->getArray();
    if (is_array($DeliveryArray))
        foreach ($DeliveryArray as $delivery) {

            // ������� ������������
            if (strpos($delivery['city'], '.')) {
                $name = explode(".", $delivery['city']);
                $delivery['city'] = $name[0];
            }

            if (in_array($delivery['id'], @explode(",", $data['delivery_id'])))
                $delivery_id = $delivery['id'];
            else
                $delivery_id = null;

            $delivery_value[] = array($delivery['city'], $delivery['id'], $delivery_id);
        }


    $Tab1 = $PHPShopGUI->setField('API ����', $PHPShopGUI->setInputText(false, 'key_new', $data['key'], 300));
    $Tab1.=$PHPShopGUI->setField('ID ��������', $PHPShopGUI->setInputText(false, 'shop_id_new', $data['shop_id'], 300, '<a id="link-activate-ddelivery" data-key="' . $data['key'] . '" href="#">������������</a>'));
    $Tab1.=$PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('delivery_id_new[]', $delivery_value, 300, null, false, $search = false, false, $size = 1, $multiple = true));

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();

    $status[] = array('����� �����', 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status) {
            $status[] = array($order_status['name'], $order_status['id'], $data['status']);
        }

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ��� ��������', $PHPShopGUI->setSelect('status_new', $status, 300));

    $Tab2 = $PHPShopGUI->setFrame('seopult', $link, '99%', '700', 'none', 0);


    $info = '<h4>��������� API �����</h4>
       <ol>
        <li>������������������ � <a href="https://ddelivery.ru/" target="_blank">Ddelivery.ru</a>.
        <li>������� �� ������  <a target="_blank" href="https://cabinet.ddelivery.ru/user2/#/shops">������ � ��������</a>.
        <li>"API ����" ����������� � ����������� ���� �������� ������.
        <li>"ID ��������" ����������� �� ���������� �������������� �������� (���������� �� ���������� ����) � ���� 5-������� �����.
        </ol>
        
       <h4>��������� ������</h4>
        <ol>
        <li>�������� ������ �������� ������ �� ������ "������������".
        <li>������� ��� �������� ��� ��������� ������.
        <li>������� ������ ������ ��� �������������� �������� ������ �� ������ Ddelivery.ru.
        </ol>
        
       <h4>��������� ��������</h4>
        <ol>
        <li>� �������� �������������� �������� � �������� <kbd>DDelivery</kbd> ��������� �������������� �������� ���������� ��������� �������� ��� ������. ����� "�� �������� ���������" ������ ���� �������.
        </ol>

';

    $Tab3 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab4 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("������ ��������", $Tab2), array("����������", $Tab3), array("� ������", $Tab4));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>