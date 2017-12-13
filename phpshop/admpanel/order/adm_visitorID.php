<?php

// ��������� ������ �� �������
if (!empty($_GET['id']))
    $_GET['visitorID'] = $_REQUEST['visitorID'] = $_GET['id'];

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("payment");
PHPShopObj::loadClass("delivery");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = __("�������������� ������");
$PHPShopGUI->reload = "top";
$PHPShopGUI->ajax = "'orders','" . PHPShopDate::dataV($_REQUEST['pole1'], false) . "','" . PHPShopDate::dataV($_REQUEST['pole2'], false) . "','core'";
$PHPShopGUI->debug_close_window = false;
$PHPShopGUI->debug = false;
$PHPShopGUI->addJSFiles('/phpshop/lib/Subsys/JsHttpRequest/Js.js', '/phpshop/lib/JsHttpRequest/JsHttpRequest.js');
$PHPShopGUI->dir = $_classPath . "admpanel/";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ���������� �� ������
 */
function updateStore($data) {
    global $PHPShopSystem;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();

    // ���� ����� ������ �����������, � ��� ������ �� ����� �����, �� �� �� ���������, � ��������� �������
    if ($data['statusi'] != 0 && $_POST['statusi_new'] == 1) {
        if (is_array($data)) {
            $order = unserialize($data['orders']);
            if (is_array($order['Cart']['cart']))
                foreach ($order['Cart']['cart'] as $val) {

                    // ������ �� ������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                    $product_row = $PHPShopOrm->select(array('items'), array('id' => '=' . $val['id']), false, array('limit' => 1));
                    if (is_array($product_row)) {

                        // �����
                        $product_update['items_new'] = $product_row['items'] + $val['num'];
                        $product_update['sklad_new'] = 0;
                        $product_update['enabled_new'] = 1;

                        // ��������� ������ 
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                        $PHPShopOrm->debug = false;
                        $PHPShopOrm->update($product_update, array('id' => '=' . $val['id']));
                    }
                }
        }
    } else if ($GetOrderStatusArray[$_POST['statusi_new']]['sklad_action'] == 1 and $GetOrderStatusArray[$data['statusi']]['sklad_action'] != 1) {
        if (is_array($data)) {
            $order = unserialize($data['orders']);
            if (is_array($order['Cart']['cart']))
                foreach ($order['Cart']['cart'] as $val) {

                    // ������ �� ������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                    $product_row = $PHPShopOrm->select(array('items'), array('id' => '=' . $val['id']), false, array('limit' => 1));
                    if (is_array($product_row)) {

                        // �����
                        $product_update['items_new'] = $product_row['items'] - $val['num'];

                        // ���������� �� ������
                        switch ($PHPShopSystem->getSerilizeParam('admoption.sklad_status')) {

                            case(3):
                                if ($product_update['items_new'] < 1) {
                                    $product_update['sklad_new'] = 1;
                                    $product_update['enabled_new'] = 1;
                                } else {
                                    $product_update['sklad_new'] = 0;
                                    $product_update['enabled_new'] = 1;
                                }
                                break;

                            case(2):
                                if ($product_update['items_new'] < 1) {
                                    $product_update['enabled_new'] = 0;
                                    $product_update['sklad_new'] = 0;
                                } else {
                                    $product_update['enabled_new'] = 1;
                                    $product_update['sklad_new'] = 0;
                                }
                                break;

                            default:
                                break;
                        }

                        // ��������� ������ 
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                        $PHPShopOrm->debug = false;
                        $PHPShopOrm->update($product_update, array('id' => '=' . $val['id']));
                    }
                }
        }
    }
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['visitorID'])));

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "700,650";
    // ���������� ������
    $PHPShopOrder = new PHPShopOrderFunction($_REQUEST['visitorID'], $data);

    $update_date = $PHPShopOrder->getStatusTime();
    if (!empty($update_date))
        $update_date = __(' / ��������� ') . $update_date;

    // ����������� ��������� ����
    $PHPShopGUI->setHeader(__('����� � ') . $data['uid'] . ' / ' . PHPShopDate::dataV($data['datas']) . $update_date, __("������� ������ ��� ������ � ����."), $PHPShopGUI->dir . "img/i_commercemanager_med[1].gif");

    // ��� ������
    if (!is_array($data)) {
        $PHPShopGUI->setFooter($PHPShopGUI->setInput("button", "", "�������", "center", 100, "return onCancel();", "but"));
        return true;
    }

    $order = unserialize($data['orders']);
    $status = unserialize($data['status']);

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['statusi']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['statusi']);

    // ����� ��������� ������
    if (empty($status['time']))
        $status['time'] = PHPShopDate::dataV($data['datas'], true, false, ' ', true);


    // ��������
    $Tab1 = $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setTextarea('person[org_name]', $order['Person']['org_name'], 'none', 200), 'left');

    // �������������� ���������� �� ������
    $Tab1.=$PHPShopGUI->setField(__("�������������� ����������"), $PHPShopGUI->setTextarea('status[maneger]', $status['maneger'], 'none', '370px'), 'left') . $PHPShopGUI->setLine();

    // ����� ��������
    $Tab1.=$PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setTextarea('person[adr_name]', $order['Person']['adr_name'], 'none', 200, 60), 'left');

    // ��� ����������
    $Tab1.=$PHPShopGUI->setField(__("����������"), $PHPShopGUI->setTextarea('person[name_person]', $order['Person']['name_person'], 'none', '370px', '30px') . $PHPShopGUI->setLine() .
                    $PHPShopGUI->setInputText(__("����� �������� ��"), 'person[dos_ot]', $order['Person']['dos_ot'], 50, false, 'left') .
                    $PHPShopGUI->setInputText(__("��"), 'person[dos_do]', $order['Person']['dos_do'], 50, false, 'left'), 'left') . $PHPShopGUI->setLine();

    // ������ ������
    $Tab1.= $PHPShopGUI->setField(__("��������� ������"), $PHPShopGUI->setSelect('statusi_new', $order_status_value, 170), 'left');

    // �������
    $Tab1.= $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText(false, 'person[tel_code]', $order['Person']['tel_code'], 50, false, 'left') .
            $PHPShopGUI->setInputText('-', 'person[tel_name]', $order['Person']['tel_name'], 100, false, 'left'), 'left');

    // �������� ���� �����
    $PHPShopPaymentArray = new PHPShopPaymentArray();
    $PaymentArray = $PHPShopPaymentArray->getArray();
    if (is_array($PaymentArray))
        foreach ($PaymentArray as $payment)
            $payment_value[] = array($payment['name'], $payment['id'], $order['Person']['order_metod']);

    // ��� ������
    $Tab1.= $PHPShopGUI->setField(__("������"), $PHPShopGUI->setSelect('person[order_metod]', $payment_value, 200), 'left') . $PHPShopGUI->setLine();

    // �������� ������
    $Tab1_1 = $PHPShopGUI->loadLib('tab_print', $data);

    // �������������� �����
    $Tab1_2 = $PHPShopGUI->loadLib('tab_advance', $data);

    // ��������� ���������
    $PHPShopInterface = new PHPShopInterface('_pretab2_');
    $PHPShopInterface->setTab(array(__("�������� ������"), $Tab1_1, 70), array(__("�������������"), $Tab1_2, 70));
    $Tab1.=$PHPShopGUI->setDiv('left', $PHPShopInterface->getContent(), 'float:left;padding-left:5px');

    // �������
    $Tab2 = $PHPShopGUI->loadLib('tab_cart', $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 350), array(__("�������"), $Tab2, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "visitorID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("hidden", "pole1", $_GET['pole1'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("hidden", "pole2", $_GET['pole2'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.visitor.all") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.visitor.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.visitor.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    $PHPShopGUI->setAction($_POST['visitorID'], 'actionStart', 'none');
}

/**
 * ���������� ������������ � ����� �������
 * @param array $data ������ ������ ������
 */
function sendUserMail($data) {
    global $PHPShopSystem;

    if ($data['statusi'] != $_POST['statusi_new']) {
        PHPShopObj::loadClass("parser");
        PHPShopObj::loadClass("mail");
        PHPShopParser::set('ouid', $data['uid']);
        PHPShopParser::set('date', PHPShopDate::dataV($data['datas']));

        // ��������� ������� �������
        $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
        PHPShopParser::set('status', $PHPShopOrderStatusArray->getParam($_POST['statusi_new'] . '.name'));
        PHPShopParser::set('user', $data['user']);
        PHPShopParser::set('company', $PHPShopSystem->getParam('name'));
        $title = $PHPShopSystem->getValue('name') . ' - ������ ������ ' . $data['uid'] . ' �������';
        $order = unserialize($data['orders']);

        PHPShopParser::set('mail', $order['Person']['mail']);
        $content = PHPShopParser::file('../../lib/templates/order/status.tpl', true);
        if (!empty($content)) {
            new PHPShopMail($order['Person']['mail'], $PHPShopSystem->getValue('adminmail2'), $title, $content);
        }
    }
}

/**
 * ����� ����������
 * @return bool 
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopOrm;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    // ������ �� ������
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_POST['visitorID'])));
    $order = unserialize($data['orders']);

    // ����� ������
    if (is_array($_POST['person']))
        foreach ($_POST['person'] as $k => $v)
            $order['Person'][$k] = $v;

    // ������������ ������ ������
    $_POST['orders_new'] = serialize($order);

    // ����������� � ����� ���������
    $_POST['status']['time'] = PHPShopDate::dataV();
    $_POST['status_new'] = serialize($_POST['status']);
    $_POST['admin_new'] = $_SESSION['idPHPSHOP'];

    $PHPShopOrm->clean();

    // ���������� �� ������ �� �������
    updateStore($data);

    // ���������� ������������ � ����� �������
    sendUserMail($data);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['visitorID']));
    $PHPShopOrm->clean();

    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);
    $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['visitorID'])));

    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['visitorID'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>