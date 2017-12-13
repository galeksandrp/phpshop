<?php

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
PHPShopObj::loadClass("user");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = __("����� �����");
$PHPShopGUI->reload = "top";
$PHPShopGUI->addJSFiles('/phpshop/lib/Subsys/JsHttpRequest/Js.js', '/phpshop/lib/JsHttpRequest/JsHttpRequest.js');

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ��������� ������ ������
 */
function setNum() {
    global $PHPShopBase;

    // ���-�� ������ � ��������� ������ �_XX, �� ��������� 2
    $format = $PHPShopBase->getParam('my.order_prefix_format');
    if (empty($format))
        $format = 2;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $row = $PHPShopOrm->select(array('uid'), false, array('order' => 'id desc'), array('limit' => 1));
    $last = $row['uid'];
    $all_num = explode("-", $last);
    $ferst_num = $all_num[0];
    $order_num = $ferst_num + 1;
    $order_num = $order_num . "-" . substr(abs(crc32(uniqid(session_id()))), 0, $format);
    return $order_num;
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

    // ������� ����� ������
    if (!empty($_REQUEST['orderAdd'])) {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $PHPShopOrm->debug = false;
        $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['orderAdd'])));
        $data['id'] = null;
        $order = unserialize($data['orders']);
        unset($order['Person']['discount']);
        unset($order['Cart']);
        $data['orders'] = serialize($order);
    } elseif (!empty($_REQUEST['userAdd'])) {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
        $PHPShopOrm->debug = false;
        $user_row = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['userAdd'])));
        $data['user'] = $user_row['id'];
        $order['Person']['org_name'] = $user_row['company'];
        $order['Person']['adr_name'] = $user_row['adres'];
        $order['Person']['name_person'] = $user_row['name'];
        $order['Person']['tel_code'] = $user_row['tel_code'];
        $order['Person']['tel_name'] = $user_row['tel'];
        $order['Person']['org_inn'] = $user_row['inn'];
        $order['Person']['org_kpp'] = $user_row['kpp'];

        // ���������� ������������� ��� ������� ������
        $PHPShopUser = new PHPShopUser($user_row['id'], $user_row);
        $order['Person']['discount'] = $PHPShopUser->getDiscount();
        $data['orders'] = serialize($order);
    }

    // ������ ������ ������
    $data['datas'] = time();
    $data['uid'] = setNum();
    $data['statusi'] = 0;

    // ������ ������� ������ ��� ��������� �������������� ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $PHPShopOrm->insert($data, '');
    $_REQUEST['visitorID'] = mysql_insert_id();

    // ������� ������ �� ������ ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['visitorID'])));


    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "700,650";
    // ���������� ������
    $PHPShopOrder = new PHPShopOrderFunction($_REQUEST['visitorID'], $data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader(__('����� ����� � ') . $data['uid'] . ' / ' . PHPShopDate::dataV(), __("������� ������ ��� ������ � ����."), $PHPShopGUI->dir . "img/i_commercemanager_med[1].gif");

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

    // ����� ��������� �������
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

    // ��������� ���������
    $Tab1.= $PHPShopGUI->setField(__("���������"), $PHPShopGUI->loadLib('tab_print', $data));

    // �������
    $Tab2 = $PHPShopGUI->loadLib('tab_cart', $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 350), array(__("�������"), $Tab2, 350));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "visitorID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.visitor.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.visitor.edit");

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

        $PHPShopOrm->clean();

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
$PHPShopGUI->setLoader($_POST['visitorID'], 'actionStart');

// ��������� �������
$PHPShopGUI->getAction();
?>