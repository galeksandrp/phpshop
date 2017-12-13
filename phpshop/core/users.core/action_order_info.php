<?php

/**
 * ����� ������ ���������� �� ������ ������������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @param Int $tip ���� ������ [1 - ������ �������], [2 - ������ �������� ������]
 */
function action_order_info($obj, $tip) {

    // �������� ������ ������� 
    if ($tip == 1) {
        $order_info = $_GET['order_info'];
        $where = array('uid' => '="' . $order_info . '"');
    }
    // ��-���� �������� ������
    elseif ($tip == 2) {
        $order_info = $_REQUEST['order'];
        $where = array('uid' => '="' . $order_info . '"', 'user' => '=0', 'datas' => '<' . time("U") - ($obj->order_live * 2592000));
    }
    if (PHPShopSecurity::true_order($order_info)) {

        $PHPShopOrm = new PHPShopOrm($obj->getValue('base.orders'));
        $PHPShopOrm->debug = $obj->debug;
        $row = $PHPShopOrm->select(array('*'), $where, false, array('limit' => 1));

        // ���������� ������ � �������
        $PHPShopOrderFunction = new PHPShopOrderFunction(false);

        // ������
        $currency = $PHPShopOrderFunction->default_valuta_code;

        // ������� �������
        $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();


        if (is_array($row)) {

            // ����������� ������
            $PHPShopOrderFunction->import($row);

            // �������� ��-���� ������
            if ($tip == 2) {
                if (PHPShopSecurity::true_email($_REQUEST['mail']))
                    if ($_REQUEST['mail'] != $PHPShopOrderFunction->getMail())
                        return $obj->action_index();
            }

            // ������ �������
            $cart = $PHPShopOrderFunction->cart('usercartforma', array('obj' => $obj, 'currency' => $currency));

            // �������� �������
            if ($PHPShopOrderStatusArray->getParam($row['statusi'] . '.sklad_action') == 1 and $obj->PHPShopSystem->getSerilizeParam('admoption.digital_product_enabled') == 1) {
                $files = $obj->tr('<b>' . __('�����') . '</b>', $PHPShopOrderFunction->cart('userfiles', array('obj' => $obj)), '-');
            }


            // ���������
//            $title = PHPShopText::div(PHPShopText::b(__('���������� �� ������ �') . $row['uid']) . __('��') . PHPShopDate::dataV($row['datas']), $align = "left", $style = false, $id = 'allspec');
            $title = PHPShopText::div(PHPShopText::img('images/shop/icon_info.gif', 5, 'absmiddle') . PHPShopText::b(__('���������� �� ������ �') . $row['uid'] . __(' �� ') . PHPShopDate::dataV($row['datas'])), $align = "left", $style = false, $id = 'allspec');


            // ��������
            $delivery = $PHPShopOrderFunction->delivery('userdeleveryforma', array('obj' => $obj, 'currency' => $currency, 'row' => $row));

            // ��. ������
            $yurData = $PHPShopOrderFunction->yurData($row);

            // �����
            $total = $obj->tr(PHPShopText::b(__('����� � ������ ������ ') . $PHPShopOrderFunction->getDiscount() . '%'), PHPShopText::b($PHPShopOrderFunction->getNum() + 1) . ' ' . __('��.'), PHPShopText::b($PHPShopOrderFunction->getTotal()) . ' ' . $currency);

            // ����������� �� ������
            if ($PHPShopOrderFunction->getSerilizeParam('status.maneger') != '')
                $comment = PHPShopText::p(PHPShopText::message($PHPShopOrderFunction->getSerilizeParam('status.maneger'), 'images/shop/icon_info.gif'));
            else
                $comment = null;



            // ���������������
            $docs = userorderdoclink($row, $obj);

            // �������
            $slide = PHPShopText::slide('Order');
            $slide .= PHPShopText::slide('checkout');
            $table = $slide . $title;


            $editTime = $PHPShopOrderFunction->getStatusTime();
            if (!$editTime)
                $editTime = "�� ���������";
            // ����� ��������� ������
            $time = PHPShopText::b($PHPShopOrderFunction->getStatus($PHPShopOrderStatusArray), 'color:' . $PHPShopOrderFunction->getStatusColor($PHPShopOrderStatusArray)) .
                    PHPShopText::br() . PHPShopText::b(__('����� ��������� ������:')) . ' ' .
                    $editTime . $comment;
            // ������ ������
            $payment = userorderpaymentlink($obj, $PHPShopOrderFunction, $tip, $row);
            // �������� ��������
            $caption = $obj->caption(__('������ ������'), __('������ ������'));
            $table .= PHPShopText::p(PHPShopText::table($caption . $payment = $obj->tr($time, $payment), 3, 1, 'center', '99%', false, 0, 'allspecwhite', 'list'));

            // �������� ��������
            if (!empty($yurData)) {
                $caption = $obj->caption(__('������� ��������'), __('����� ��������'), __('����������� ������'));
                $temp = $obj->tr($delivery['name'], $delivery['adres'], $yurData);
            } else {
                $caption = $obj->caption(__('������� ��������'), __('����� ��������'));
                $temp = $obj->tr($delivery['name'], $delivery['adres']);
            }

            $table .= PHPShopText::p(PHPShopText::table($caption . $temp, 3, 1, 'center', '99%', false, 0, 'allspecwhite', 'list'));

            // ���������� ������.
            // �������� ��������
            $caption = $obj->caption(__('������������'), __('���-��'), __('�����'));
            $table .= PHPShopText::p(PHPShopText::table($caption . $cart . $delivery['tr'] . $total . $docs . $files, 3, 1, 'center', '99%', false, 0, 'allspecwhite', 'list'));


            $obj->set('formaContent', $table, true);
        }
        else
            $obj->action_index();
    }
}

/**
 * �������� �������
 */
function userfiles($val, $option) {
    global $PHPShopModules;

    $dis = null;

    // �������� ������ � ������ �������
    $hook = $PHPShopModules->setHookHandler(__FUNCTION__, __FUNCTION__, $val, $option, 'START');
    if ($hook)
        return $hook;


    $PHPShopOrm = new PHPShopOrm($option['obj']->getValue('base.products'));
    $row = $PHPShopOrm->select(array('files'), array('id' => '=' . $val['id']), false, array('limit' => 1));
    if (is_array($row)) {
        $files = unserialize($row['files']);
        if (is_array($files)) {
            foreach ($files as $cfile) {
                $dis.=PHPShopText::img('images/shop/action_save.gif', 3, 'absmiddle');
                $F = $option['obj']->link_encode($cfile);
                $link = '../files/filesSave.php?F=' . $F;
                $dis.=PHPShopText::a($link, basename($cfile), basename($cfile), false, false, '_blank');
                $dis.=PHPShopText::br();
            }
        }
    }

    return $dis;
}

/**
 * ������� ������� � ������
 */
function usercartforma($val, $option) {
    global $PHPShopModules;

    // �������� ������ � ������ �������
    $hook = $PHPShopModules->setHookHandler(__FUNCTION__, __FUNCTION__, $val, $option, 'START');
    if ($hook)
        return $hook;

    // �������� ������� ������, ������ ������ �������� ������
    if (empty($val['parent']))
        $link = '/shop/UID_' . $val['id'] . '.html';
    else
        $link = '/shop/UID_' . $val['parent'] . '.html';

//    $icon = PHPShopText::img('phpshop/lib/templates/icon/accept.png', $hspace = 5, 'absmiddle');
    $dis = $option['obj']->tr(PHPShopText::a($link, $icon . $val['name'], $val['name'], false, false, '_blank', 'b'), $val['num'], $val['total']);
    return $dis;
}

/**
 * ��������
 */
function userdeleveryforma($val, $option) {
    global $PHPShopModules;

    // �������� ������ � ������ �������
    $hook = $PHPShopModules->setHookHandler(__FUNCTION__, __FUNCTION__, $val, $option, 'START');
    if ($hook)
        return $hook;

    $data_fields = unserialize($val['data_fields']);
    if (is_array($data_fields)) {
        $num = $data_fields[num];
        asort($num);
        $enabled = $data_fields[enabled];
        foreach ($num as $key => $value) {
            if ($enabled[$key]['enabled'] == 1) {
                $adres .= PHPShopText::b($enabled[$key][name] . ": ") . $option['row'][$key] . "<br>";
            }
        }
    }

    if (!$adres)
        $adres = "�� ���������";

    $icon = PHPShopText::img('phpshop/lib/templates/icon/lorry.gif', $hspace = 5, 'absmiddle');
    $dis = $option['obj']->tr($icon . __('��������') . ' - ' . $val['name'], 1, $val['price'] . ' ' . $option['currency']);
    return array('tr' => $dis, 'name' => $val['name'], 'adres' => $adres);
    ;
}

/**
 * ���������������
 */
function userorderdoclink($val, $obj) {

    $PHPShopOrm = new PHPShopOrm($obj->getValue('base.1c_docs'));
    $PHPShopOrm->debug = $obj->debug;
    $data = $PHPShopOrm->select(array('*'), array('uid' => '=' . $val['id']), false, array('limit' => 1000));

    if (is_array($data)) {

        // �������� ��������
        $dis = $obj->caption(__('���������������'), __('����'), __('��������'));
        $n = $val['id'];
        foreach ($data as $row) {

            // �����
            if ($obj->PHPShopSystem->ifValue('1c_load_accounts')) {
                $link_def = '../files/docsSave.php?orderId=' . $n . '&list=accounts&datas=' . $row['datas'];
                $link_html = '../files/docsSave.php?orderId=' . $n . '&list=accounts&tip=html&datas=' . $row['datas'];
                $link_doc = '../files/docsSave.php?orderId=' . $n . '&list=accounts&tip=doc&datas=' . $row['datas'];
                $link_xls = '../files/docsSave.php?orderId=' . $n . '&list=accounts&tip=xls&datas=' . $row['datas'];
                $dis.=$obj->tr(PHPShopText::a($link_def, __('���� �� ������'), false, false, false, '_blank', 'b'), PHPShopDate::dataV($row['datas']), PHPShopText::a($link_html, __('HTML'), __('������ Web'), false, false, '_blank', 'b') . ' ' .
                        PHPShopText::a($link_doc, __('DOC'), __('������ Word'), false, false, '_blank', 'b') . ' ' .
                        PHPShopText::a($link_xls, __('XLS'), __('������ Excel'), false, false, '_blank', 'b'));
            }

            // �����-�������
            if (!empty($row['datas_f']) and $obj->PHPShopSystem->ifValue('1c_load_invoice')) {
                $link_def = '../files/docsSave.php?orderId=' . $n . '&list=invoice&datas=' . $row['datas'];
                $link_html = '../files/docsSave.php?orderId=' . $n . '&list=invoice&tip=html&datas=' . $row['datas'];
                $link_doc = '../files/docsSave.php?orderId=' . $n . '&list=invoice&tip=doc&datas=' . $row['datas'];
                $link_xls = '../files/docsSave.php?orderId=' . $n . '&list=invoice&tip=xls&datas=' . $row['datas'];
                $dis.=$obj->tr(PHPShopText::a($link_def, __('����-�������'), false, false, false, '_blank', 'b'), PHPShopDate::dataV($row['datas_f']), PHPShopText::a($link_html, __('HTML'), __('������ Web'), false, false, '_blank', 'b') . ' ' .
                        PHPShopText::a($link_doc, __('DOC'), __('������ Word'), false, false, '_blank', 'b') . ' ' .
                        PHPShopText::a($link_xls, __('XLS'), __('������ Excel'), false, false, '_blank', 'b'));
            }
        }

        // �������� ������
        $hook = $obj->setHook(__FUNCTION__, __FUNCTION__, array('row' => $data, 'val' => $val));
        if ($hook) {
            return $hook;
        }

        return $dis;
    }
}

/**
 * ������ �� ������
 */
function userorderpaymentlink($obj, $PHPShopOrderFunction, $tip, $row) {
    global $PHPShopSystem, $PHPShopBase;

    $disp = null;
    PHPShopObj::loadClass('payment');
    $PHPShopPayment = new PHPShopPayment($PHPShopOrderFunction->order_metod_id);
    $path = $PHPShopPayment->getPath();
    $name = $PHPShopPayment->getName();
    $id = $row['id'];
    $datas = $row['datas'];

    // ������ �� ������
    switch ($path) {

        // ���������
        case("message"):
            $disp.=PHPShopText::b($name);
            break;

        // ���� � ����
        case("bank"):
            if (!$PHPShopSystem->ifValue('1c_load_accounts')) {
                $icon = PHPShopText::img('images/shop/interface_browser.gif', $hspace = 5, $align = 'absmiddle');
                $disp = PHPShopText::a("phpshop/forms/account/forma.html?orderId=$id&tip=$tip&datas=$datas", $icon . $name, $name, false, false, '_blank', 'b');
            } else {
                $disp.=PHPShopText::b($name) . '.<br>' . __('�������� �����, ����� ���������� ���������<br> �� ������������� �������� � ������ �������<br> ������� ��������.');
            }
            break;

        // ��������� ���������
        case("sberbank"):
            $icon = PHPShopText::img('images/shop/interface_dialog.gif', $hspace = 5, $align = 'absmiddle');
            $disp.=PHPShopText::a("phpshop/forms/receipt/forma.html?orderId=$id&tip=$tip&datas=$datas", $icon . $name, $name, false, false, '_blank', 'b');
            break;

        /*
         * ������� ���������� ������� ���������� [name]_users_repay() �� ����� � ������ ��������� ������� /payment/[name]/users.php
         * ������ ���������� /payment/webmoney/users.php
         */
        default:
            $users_file = './payment/' . $path . '/users.php';
            $users_function = $path . '_users_repay';
            if (is_file($users_file)) {
                include_once($users_file);
                if (function_exists($users_function)) {
                    $disp = call_user_func_array($users_function, array(&$obj, $PHPShopOrderFunction));
                }
            }
            else
                $disp.=PHPShopText::b($name);
            break;
    }

    // �������� ������
    $hook = $obj->setHook(__FUNCTION__, __FUNCTION__, $PHPShopOrderFunction);
    if ($hook) {
        $disp.=$hook;
    }

    return $disp;
}

?>