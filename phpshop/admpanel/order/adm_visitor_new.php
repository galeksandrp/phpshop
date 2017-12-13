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
PHPShopObj::loadClass("text");

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
        $order['Person']['mail'] = $user_row['mail'];
        $order['Person']['org_name'] = $user_row['company'];
        $order['Person']['adr_name'] = $user_row['adres'];
        $order['Person']['name_person'] = $user_row['name'];
        $order['Person']['tel_code'] = $user_row['tel_code'];
        $order['Person']['tel_name'] = $user_row['tel'];
        $order['Person']['org_inn'] = $user_row['inn'];
        $order['Person']['org_kpp'] = $user_row['kpp'];

        // ������ ��� ����� ��������� ������� �������. ��������� ��������� ������ �������.
        $data_adres = unserialize($user_row['data_adres']);
        if (is_array($data_adres) AND is_array($data_adres['list'][$data_adres['main']]))
            foreach ($data_adres['list'][$data_adres['main']] as $key => $value) {
                $key = str_replace("_new", "", $key);
                switch ($key) {
                    case "fio":
                        if (empty($value))
                            $value .= $user_row['name'];
                        else
                            $order['Person']['name_person'] = "";
                        break;
                    case "street":
                        $value .= $user_row['adres'];
                        break;
                    case "org_name":
                        $value .= $user_row['company'];
                        break;
                    case "tel":
                        $value .= $user_row['tel_code'] . $user_row['tel'];
                        break;
                    case "org_inn":
                        $value .= $user_row['inn'];
                        break;
                    case "org_kpp":
                        $value .= $user_row['kpp'];
                        break;

                    default:
                        break;
                }
                $data[$key] = $value;
            }
        // ���������� ������������� ��� ������� ������
        $PHPShopUser = new PHPShopUser($user_row['id'], $user_row);
        if ($discount = $PHPShopUser->getDiscount())
            $order['Person']['discount'] = $discount;
        else
            $order['Person']['discount'] = 0;
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
    $PHPShopGUI->setHeader(__('����� ����� � ') . $data['uid'] . ' / ' . PHPShopDate::dataV(), __(""), $PHPShopGUI->dir . "img/i_commercemanager_med[1].gif");

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


    // ������ ������������ - ���, email
    if (!empty($data['user']))
        $userLink = "<a href='' onclick=\"return miniWin('../shopusers/adm_userID.php?id=" . $data['user'] . "',550,580)\">" . $order['Person']['mail'] . "</a>";
    else
        $userLink = $order['Person']['mail'];

    $Tab1 .= PHPShopText::div(PHPShopText::b("����������:" . "<br>") . PHPShopText::p($userLink . "<br>" . PHPShopText::b($data['fio'] . $order['Person']['name_person'])), "left", "float:left;padding:5px;margin-left:0px;height:39px; width:200px;");

    // �������������� ���������� �� ������������ � ������
    $Tab1 .= $PHPShopGUI->setField(__("�������������� ���������� � ������ �� ������������:"), $PHPShopGUI->setTextarea('dop_info_new', $data['dop_info'], 'none', '393px'), "left", 'left');

    // ������ ������
    $Tab1.= $PHPShopGUI->setField(__("������ ������"), $PHPShopGUI->setSelect('statusi_new', $order_status_value, 288), 'left');

    // �������� ���� �����
    $PHPShopPaymentArray = new PHPShopPaymentArray();
    $PaymentArray = $PHPShopPaymentArray->getArray();
    if (is_array($PaymentArray))
        foreach ($PaymentArray as $payment)
            $payment_value[] = array($payment['name'], $payment['id'], $order['Person']['order_metod']);

    // ��� ������
    $Tab1.= $PHPShopGUI->setField(__("������ ������"), $PHPShopGUI->setSelect('person[order_metod]', $payment_value, 291), 'left') . $PHPShopGUI->setLine();

    // ����� �������� ��� ������ ������ ������ � ������
    if (!empty($order['Person']['dos_ot']) OR !empty($order['Person']['dos_do']))
        $dost_ot = " ��: " . $order['Person']['dos_ot'] . ", ��: " . $order['Person']['dos_do'];

    // ������� ���������������� ������ ������������
    if ($data['fio'] OR $order['Person']['name_person'])
        $adr_info .= ", ���: " . $data['fio'] . $order['Person']['name_person'];
    if ($data['tel'] or $_POST['person']['tel_code'] or $_POST['person']['tel_name'])
        $adr_info .= ", ���.: " . $data['tel'] . $_POST['person']['tel_code'] . $_POST['person']['tel_name'];
    if ($data['country'])
        $adr_info .= ", ������: " . $data['country'];
    if ($data['state'])
        $adr_info .= ", ������/����: " . $data['state'];
    if ($data['city'])
        $adr_info .= ", �����: " . $data['city'];
    if ($data['index'])
        $adr_info .= ", ������: " . $data['index'];
    if ($data['street'] OR $order['Person']['adr_name'])
        $adr_info .= ", �����: " . $data['street'] . $order['Person']['adr_name'];
    if ($data['house'])
        $adr_info .= ", ���: " . $data['house'];
    if ($data['porch'])
        $adr_info .= ", �������: " . $data['porch'];
    if ($data['door_phone'])
        $adr_info .= ", ��� ��������: " . $data['door_phone'];
    if ($data['flat'])
        $adr_info .= ", ��������: " . $data['flat'];
    if ($data['delivtime'])
        $adr_info .= ", ����� ��������: " . $data['delivtime'] . $dost_ot;

    $adr_info = substr($adr_info, 2);
    $Tab1.= $PHPShopGUI->setField(__("������ ����������"), PHPShopText::div($adr_info, "left", "float:left;padding:5px;margin-left:0px;height:60px; width:288px; background-color:white;overflow:auto"), "left");

    // ������� ��������������� ��. ������ ������������.
    if ($data['org_name'] OR $order['Person']['org_name'])
        $yur_info .= ", ������������ �����������:" . $data['org_name'] . $order['Person']['org_name'];
    if ($data['org_inn'])
        $yur_info .= ", ���:" . $data['org_inn'];
    if ($data['org_kpp'])
        $yur_info .= ", ���" . $data['org_kpp'];
    if ($data['org_yur_adres'])
        $yur_info .= ", ����������� �����:" . $data['org_yur_adres'];
    if ($data['org_fakt_adres'])
        $yur_info .= ", ����������� �����:" . $data['org_fakt_adres'];
    if ($data['org_ras'])
        $yur_info .= ", ��������� ����:" . $data['org_ras'];
    if ($data['org_bank'])
        $yur_info .= ", ������������ �����:" . $data['org_bank'];
    if ($data['org_kor'])
        $yur_info .= ", ����������������� ����:" . $data['org_kor'];
    if ($data['org_bik'])
        $yur_info .= ", ���:" . $data['org_bik'];
    if ($data['org_city'])
        $yur_info .= ", �����:" . $data['org_city'];
    $yur_info = substr($yur_info, 2);
    $Tab1.= $PHPShopGUI->setField(__("��. ������ ����������:"), PHPShopText::div($yur_info, "left", "float:left;padding:5px;margin-left:0px;height:60px; width:291px; background-color:white;overflow:auto"), "left") . $PHPShopGUI->setLine();



    // �������� ������
    $Tab1_1 = $PHPShopGUI->loadLib('tab_print', $data);

    // �������������� �����
    $Tab1_2 = $PHPShopGUI->loadLib('tab_advance', $data);

    // ������� ���������
    $Tab1_2 .=$PHPShopGUI->setField(__("������� ��������� (����� ��������� � ��)"), $PHPShopGUI->setTextarea('status[maneger]', $status['maneger'], 'none', '290px'), 'left') . $PHPShopGUI->setLine();

    // ��������� ���������
    $PHPShopInterface = new PHPShopInterface('_pretab2_');
    $PHPShopInterface->setTab(array(__("�������� ������"), $Tab1_1, 75), array(__("�������������"), $Tab1_2, 75));
    $Tab1.=$PHPShopGUI->setDiv('left', $PHPShopInterface->getContent(), 'float:left;padding-left:0px; width:630px;');

    // �������
    $Tab2 = $PHPShopGUI->loadLib('tab_cart', $data);


    // ������ ����������
    $Tab3 = $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'fio_new', $data['fio'] . $order['Person']['name_person'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'tel_new', $data['tel'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'country_new', $data['country'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������/����"), $PHPShopGUI->setInputText('', 'state_new', $data['state'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'city_new', $data['city'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'index_new', $data['index'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'street_new', $data['street'] . $order['Person']['adr_name'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'house_new', $data['house'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'porch_new', $data['porch'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��� ��������"), $PHPShopGUI->setInputText('', 'door_phone_new', $data['door_phone'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText('', 'flat_new', $data['flat'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setInputText('', 'delivtime_new', $data['delivtime'] . $dost_ot, '190', false, 'left'), 'left');

    // ��. ������ ����������
    $Tab4 = $PHPShopGUI->setField(__("������������ ����������� "), $PHPShopGUI->setInputText('', 'org_name_new', $data['org_name'] . $order['Person']['org_name'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��� "), $PHPShopGUI->setInputText('', 'org_inn_new', $data['org_inn'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'org_kpp_new', $data['org_kpp'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText('', 'org_yur_adres_new', $data['org_yur_adres'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText('', 'org_fakt_adres_new', $data['org_fakt_adres'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��������� ����"), $PHPShopGUI->setInputText('', 'org_ras_new', $data['org_ras'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������������ �����"), $PHPShopGUI->setInputText('', 'org_bank_new', $data['org_bank'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������������� ����"), $PHPShopGUI->setInputText('', 'org_kor_new', $data['org_kor'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'org_bik_new', $data['org_bik'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'org_city_new', $data['org_city'], '190', false, 'left'), 'left');

//            .
//            $PHPShopGUI->setField(__(""), 
//            $PHPShopGUI->setInputText('', '_new', $data[''], '190', false, 'left'), 'left')
    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 350), array(__("�������"), $Tab2, 350), array(__("�������� ������ ����������"), $Tab3, 350), array(__("�������� ��. ������ ����������"), $Tab4, 350));

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
    $_POST['seller_new'] = 0;

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