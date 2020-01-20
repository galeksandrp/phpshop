<?php

/**
 * ���������� ��������� � �������� � ������
 */
function mail_yndexcart_hook($obj, $row, $rout) {

    if ($rout == 'MIDDLE') {

        // �������� ������� ��� ����� ��� YML
        if (is_array($obj->PHPShopCart->_CART)) {
            $message_type = 1;
            foreach ($obj->PHPShopCart->_CART as $val) {

                // ������ �� ������
                $objProduct = new PHPShopProduct($val['id']);
                if ($objProduct->getParam('p_enabled') == 0)
                    $message_type = 2;
            }
        }

        // ������ ���� �������� @dataFrom@ � @dataTo@
        $yandex_day_min = $obj->PHPShopDelivery->getParam('yandex_day_min');
        $yandex_day = $obj->PHPShopDelivery->getParam('yandex_day');
        $yandex_order_before = $obj->PHPShopDelivery->getParam('yandex_order_before');

        $hour = date("H");
        $time = time();

        // ��� ������� ��������
        if ($hour < $yandex_order_before) {
            //dataFrom = 05.09 + 1 ���� = 06.09
            //dateTo = 05.09 + 2 ��� = 07.09
        } else {
            //dataFrom = ������� (05.09) + 1 ���� (���� ��) + 1 ���� (��� ��� ����� ����� "����� ����������") = 07.09
            //dateTo = ������� (05.09) + 2 ��� (���� ��) + 1 ���� (��� ��� ����� ����� "����� ����������") = 08.09
            $yandex_day_min++;
            $yandex_day++;
        }

       // $dataFrom = PHPShopDate::setDeliveryDate_hook($time, $yandex_order_before, array("+" . intval($yandex_day) . " day", "+" . intval($yandex_day_min) . " day"));
    //    $dataTo = PHPShopDate::setDeliveryDate_hook($time, 0, array("+" . intval($yandex_day) . " day", "+" . intval($yandex_day_min) . " day"));

    $dataFrom = PHPShopDate::setDeliveryDate_hook($time, $yandex_order_before, array("+" . intval($yandex_day_min) . " day", "+" . intval($yandex_day_min + 1) . " day"));
    $dataTo = PHPShopDate::setDeliveryDate_hook($time, 0, array("+" . intval($yandex_day) . " day", "+" . intval($yandex_day + 1) . " day"));



        if ($dataFrom == $dataTo) {
            $dataTo =  strtotime("+1 day",$dataTo);
        }

        PHPShopParser::set('dataFrom', date("d.m",$dataFrom));
        PHPShopParser::set('dataTo', date("d.m",$dataTo));

        // ���������
        if ($message_type == 1)
            $mail_message = $obj->PHPShopDelivery->getParam('yandex_mail_instock');
        else
            $mail_message = $obj->PHPShopDelivery->getParam('yandex_mail_outstock');

        $mail_message = preg_replace_callback("/@([a-zA-Z0-9_]+)@/", 'PHPShopParser::SysValueReturn', $mail_message);

        if (!empty($mail_message))
            $obj->set('deliveryInfo', PHPShopText::p($mail_message), true);
    }

}

$addHandler = array
    (
    'mail' => 'mail_yndexcart_hook'
);
?>