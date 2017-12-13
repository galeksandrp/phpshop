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
PHPShopObj::loadClass("text");

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
$PHPShopGUI->addJSFiles('../java/sorttable.js');
$PHPShopGUI->addJSFiles('../java/javaMG.js');
$PHPShopGUI->dir = $_classPath . "admpanel/";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ���������� ������
 */
function updateDiscount($data) {
    global $PHPShopSystem, $PHPShopBase, $_classPath;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();

    //���� ����� ����������� ������������ ������ ������������
    //if ($GetOrderStatusArray[$_POST['statusi_new']]['cumulative_action'] == 1) {

        //������ ������� ������������
        $sql_st = "SELECT * FROM `".$GLOBALS['SysValue']['base']['table_name27']."` WHERE `id` =".$data['user']." ";
        $query_st = mysql_query($sql_st);
        $row_st = mysql_fetch_array($query_st);
        $status_user = $row_st['status'];


        //������ ��������� ������� ������������ ������
        $sql_d = "SELECT * FROM `".$GLOBALS['SysValue']['base']['table_name28']."` WHERE `id` =".$status_user." ";
        $query_d = mysql_query($sql_d);
        $row_d = mysql_fetch_array($query_d);
        $cumulative_array = unserialize($row_d['cumulative_discount']);
        $cumulative_array_check = $row_d['cumulative_discount_check'];
        if($cumulative_array_check==1) {
            //������ �������
            $sql_order = "SELECT ".$GLOBALS['SysValue']['base']['table_name1'].".* FROM `".$GLOBALS['SysValue']['base']['table_name1']."` 
            LEFT JOIN `".$GLOBALS['SysValue']['base']['table_name32']."` ON ".$GLOBALS['SysValue']['base']['table_name1'].".statusi=".$GLOBALS['SysValue']['base']['table_name32'].".id 
            WHERE ".$GLOBALS['SysValue']['base']['table_name1'].".user =  ".$data['user']." 
            AND ".$GLOBALS['SysValue']['base']['table_name32'].".cumulative_action='1' ";
            $query_order = mysql_query($sql_order);
            $row_order = mysql_fetch_array($query_order);
            $sum = '0'; //������� �����
            do {
                $orders = unserialize($row_order['orders']);
                $sum += $orders['Cart']['sum'];
            }
            while ($row_order = mysql_fetch_array($query_order));

            //������ ������
            $q_cumulative_discount = '0'; //������� ������
            foreach ($cumulative_array as $key => $value) {
                if($sum>=$value['cumulative_sum_ot'] and $sum<=$value['cumulative_sum_do']) {
                    $q_cumulative_discount = $value['cumulative_discount'];
                    break;
                }
            }
            //��������� ������
            $sql_update = "UPDATE  `".$GLOBALS['SysValue']['base']['table_name27']."` SET `cumulative_discount` =  '".$q_cumulative_discount."' WHERE `id` =".intval($data['user'])." ";
            mysql_query($sql_update);
        }
        else {
            $sql_update = "UPDATE  `".$GLOBALS['SysValue']['base']['table_name27']."` SET `cumulative_discount` =  '0' WHERE `id` =".intval($data['user'])." ";
            mysql_query($sql_update);
        }
    //}
}

/**
 * ���������� �� ������
 */
function updateStore($data) {
    global $PHPShopSystem, $PHPShopBase, $_classPath;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();


    // SMS ���������� ������������ � ����� ������� ������
    if ($data['statusi'] != $_POST['statusi_new'] and $PHPShopSystem->ifSerilizeParam('admoption.sms_status_order_enabled')) {

        $phone = $_POST['tel_new'];
        $msg = strtoupper($_SERVER['SERVER_NAME']) . ': ' . $PHPShopBase->getParam('lang.sms_user') . $data['uid'] . " - " . $GetOrderStatusArray[$_POST['statusi_new']]['name'];

        // �������� �� ������ 7 ��� 8
        $first_d = substr($phone, 0, 1);
        if ($first_d != 8)
            $phone = '7' . $phone;

        $lib = str_replace('./phpshop/', $_classPath, $PHPShopBase->getParam('file.sms'));
        include_once $lib;
        SendSMS($msg, $phone);
    }


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
    $PHPShopGUI->setHeader(__('����� � ') . $data['uid'] . ' / ' . PHPShopDate::dataV($data['datas']) . $update_date, __(""), $PHPShopGUI->dir . "img/i_commercemanager_med[1].gif");

    // ��� ������
    if (!is_array($data)) {
        $PHPShopGUI->setFooter($PHPShopGUI->setInput("button", "", "�������", "center", 100, "return onCancel();", "but"));
        return true;
    }

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

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

        $allOrderLink = "<p><a href='' onclick=\"DoReloadMainWindow('orders','','','".$order['Person']['mail']."'); return false;\">���������� ��� ������</a></p>";


    $Tab1 .= PHPShopText::div(PHPShopText::b("����������:" . "<br>") . PHPShopText::p($userLink . "  " . PHPShopText::b($data['fio'] . $order['Person']['name_person']) . PHPShopText::b("<br>".$allOrderLink) ), "left", "float:left;padding:5px;margin-left:0px;height:39px; width:200px;");

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
    if ($data['tel'] or $order['Person']['tel_code'] or $order['Person']['tel_name'])
        $adr_info .= ", ���.: " . $data['tel'] . $order['Person']['tel_code'] . $order['Person']['tel_name'];
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
    $Tab1_3=$PHPShopGUI->setField(__("������� ��������� (����� ��������� � ��)"), $PHPShopGUI->setTextarea('status[maneger]', $status['maneger'], 'none', '290px'), 'left') . $PHPShopGUI->setLine();

    // ��������� ���������
    $PHPShopInterface = new PHPShopInterface('_pretab2_');
    $PHPShopInterface->setTab(array(__("�������� ������"), $Tab1_1, 75), array(__("�������������"), $Tab1_2, 75),array(__("�����������"), $Tab1_3, 75));
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
            $PHPShopGUI->setInput("hidden", "order_num", $data['uid'], "right", 70, "", "but") .
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
//        $title = $PHPShopSystem->getValue('name') . ' - ������ ������ ' . $data['uid'] . ' �������';
        $title = 'C����� ������ ' . $data['uid'] . ' �������';
        $order = unserialize($data['orders']);

        PHPShopParser::set('mail', $order['Person']['mail']);
        PHPShopParser::set('user_name', $order['Person']['name_person']);
        
        
        $PHPShopMail = new PHPShopMail($order['Person']['mail'], $PHPShopSystem->getValue('adminmail2'), $title, '', true, true);
        $content = PHPShopParser::file('../../lib/templates/order/status.tpl', true);
        if (!empty($content)) {
            $PHPShopMail->sendMailNow($content);
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
    
    // �������� � 1� ��� ������ ������
    if(empty($_POST['statusi_new']))
        $_POST['seller_new']=0;

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['visitorID']));
    $PHPShopOrm->clean();

    // ������������ ������
    updateDiscount($data);

    $_SESSION['editOrderId'] = $_POST['visitorID'];

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