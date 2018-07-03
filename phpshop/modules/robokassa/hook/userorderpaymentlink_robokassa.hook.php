<?php

function userorderpaymentlink_mod_robokassa_hook($obj, $PHPShopOrderFunction) {
    global $PHPShopSystem;

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');

    $PHPShopRobokassaArray = new PHPShopRobokassaArray();
    $option = $PHPShopRobokassaArray->getArray();

    // �������� ������ �� ������� ������
    if ($PHPShopOrderFunction->order_metod_id == 10020)
        if ($PHPShopOrderFunction->getParam('statusi') == $option['status'] or empty($option['status'])) {

            // ����� �����
            $mrh_ouid = explode("-", $PHPShopOrderFunction->objRow['uid']);
            $inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];

            // ����� �������
            $out_summ = $PHPShopOrderFunction->getTotal();

            // ��������� �����
            $payment_forma .= PHPShopText::setInput('hidden', 'MrchLogin', trim($option['merchant_login']), false, 10);
            $payment_forma .= PHPShopText::setInput('hidden', 'OutSum', $out_summ, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'InvId', $inv_id, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'Desc', 'PHPShopPay', false, 10);

            // ���
            $order = $PHPShopOrderFunction->unserializeParam('orders');

            // ���
            if ($PHPShopSystem->getParam('nds_enabled') == '') {
                $tax = $tax_delivery = 'none';
            } else {
                $tax = 'vat' . $PHPShopSystem->getParam('nds');

                // ��� ��������
                if (!empty($order['Cart']['dostavka'])) {
                    PHPShopObj::loadClass('delivery');
                    $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);

                    $tax_delivery = $PHPShopDelivery->getParam('ofd_nds');
                    if ($tax_delivery == '')
                        $tax_delivery = $tax;
                    else
                        $tax_delivery = 'vat' . $PHPShopDelivery->getParam('ofd_nds');
                }
            }

            // �������
            if (is_array($order['Cart']['cart'])) {

                foreach ($order['Cart']['cart'] as $product) {
                    $ym_merchant_receipt['items'][] = array('name' => $product['name'], 'quantity' => floatval(number_format($product['num'], 3, '.', '')), 'sum' => floatval(number_format($product['price'], 2, '.', '')), 'tax' => $tax);
                }
            }

            // ��������
            if (!empty($order['Cart']['dostavka'])) {

                $ym_merchant_receipt['items'][] = array('name' => '��������', 'quantity' => floatval(number_format(1, 3, '.', '')), 'sum' => floatval(number_format($order['Cart']['dostavka'], 2, '.', '')), 'tax' => $tax_delivery);
            }


            $Receipt = urlencode(PHPShopString::json_safe_encode($ym_merchant_receipt));

            // �������
            $crc = md5(trim($option['merchant_login']) . ':' . $out_summ . ':' . $inv_id . ':' . $Receipt . ':' . trim($option['merchant_key']));

            $payment_forma.=PHPShopText::setInput('hidden', 'Receipt', $Receipt, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'SignatureValue', $crc, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'Encoding', 'utf-8', false, 10);
            $payment_forma.=PHPShopText::setInput('submit', 'send', $option['title'], false, 250);

            // ������ � ���
            $PHPShopRobokassaArray->log(array('action' => 'user', 'MrchLogin' => trim($option['merchant_login']), 'sum' => $out_summ, 'Email' => $_POST['mail'], 'orderNumber' => $inv_id, 'Receipt' => $Receipt), $inv_id, '����� ������ � ��������', '������ ����� ��� �������� �� ������');

            $return = PHPShopText::form($payment_forma, 'pay', 'post', 'https://merchant.roboxchange.com/Index.aspx');
        } elseif ($PHPShopOrderFunction->getSerilizeParam('orders.Person.order_metod') == 10020)
            $return = ', ����� �������������� ����������';

    return $return;
}

$addHandler = array('userorderpaymentlink' => 'userorderpaymentlink_mod_robokassa_hook');
?>