<?php

function userorderpaymentlink_mod_yandexkassa_hook($obj, $PHPShopOrderFunction) {
    global $PHPShopSystem;

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');
    $PHPShopYandexkassaArray = new PHPShopYandexkassaArray();
    $option = $PHPShopYandexkassaArray->getArray();


    // �������� ������ �� ������� ������
    if ($PHPShopOrderFunction->order_metod_id == 10004)
        if ($PHPShopOrderFunction->getParam('statusi') == $option['status'] or empty($option['status'])) {

            // ����� �����
            $mrh_ouid = explode("-", $PHPShopOrderFunction->objRow['uid']);
            $inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];

            // ����� �������
            $out_summ = floatval(number_format($PHPShopOrderFunction->getTotal(), 2, '.', ''));

            // ��������� �����
            $payment_forma .= PHPShopText::setInput('hidden', 'shopId', trim($option['merchant_id']), false, 10);
            $payment_forma .= PHPShopText::setInput('hidden', 'scid', trim($option['merchant_scid']), false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'sum', $out_summ, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'orderNumber', $inv_id, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'cps_email', $PHPShopOrderFunction->getMail(), false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'cms_name', 'phpshop', false, 10);

            // ���
            $ym_merchant_receipt['customerContact'] = $PHPShopOrderFunction->getMail();

            // ���
            if ($PHPShopSystem->getParam('nds_enabled') == '') {
                $tax = $tax_delivery = 2;
            } else {

                switch ($PHPShopSystem->getParam('nds')) {
                    case 0:
                        $tax = 2;
                        break;
                    case 10:
                        $tax = 3;
                        break;
                    case 18:
                        $tax = 4;
                        break;
                    default: $tax = 2;
                }
            }

            $order = $PHPShopOrderFunction->unserializeParam('orders');

            // �������
            if (is_array($order['Cart']['cart'])) {


                foreach ($order['Cart']['cart'] as $product) {

                    // ������
                    if ($order['Person']['discount'] > 0)
                        $price = $product['price'] - ($product['price'] * $order['Person']['discount'] / 100);
                    else
                        $price = $product['price'];

                    $ym_merchant_receipt['items'][] = array('text' => $product['name'], 'quantity' => floatval(number_format($product['num'], 3, '.', '')), 'price' => array('amount' => floatval(number_format($price, 2, '.', ''))), 'tax' => $tax);
                }
            }

            // ��������
            if (!empty($order['Cart']['dostavka'])) {

                PHPShopObj::loadClass('delivery');
                $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);

                switch ($PHPShopDelivery->getParam('ofd_nds')) {
                    case 0:
                        $tax_delivery = 2;
                        break;
                    case 10:
                        $tax_delivery = 3;
                        break;
                    case 18:
                        $tax_delivery = 4;
                        break;
                    default: $tax_delivery = $tax;
                }

                $ym_merchant_receipt['items'][] = array('text' => '��������', 'quantity' => floatval(number_format(1, 3, '.', '')), 'price' => array('amount' => floatval(number_format($order['Cart']['dostavka'], 2, '.', ''))), 'tax' => $tax_delivery);
            }
            
            $payment_forma.="<input type='hidden' name='ym_merchant_receipt' value='" . PHPShopString::json_safe_encode($ym_merchant_receipt) . "'>";

            // ��� ������
            $v = $PHPShopYandexkassaArray->get_pay_variants_array(unserialize($option['pay_variants']), true);
            $payment_forma.=PHPShopText::select('paymentType', $v, 250, 'left', false, false, false, 1, false, 'form-control') . ' ';

            $payment_forma.=PHPShopText::setInput('submit', 'send', $option['title'], $float = "none", 250);

            if ($option['test'])
                $action = 'https://demomoney.yandex.ru/eshop.xml';
            else
                $action = 'https://money.yandex.ru/eshop.xml';

            // ������ � ���
            $PHPShopYandexkassaArray->log(array('action' => $action, 'shopId' => $option['merchant_id'], 'scid' => trim($option['merchant_scid']), 'sum' => $out_summ, 'customerNumber' => $PHPShopOrderFunction->getMail(), 'orderNumber' => $inv_id, 'ym_merchant_receipt' => $ym_merchant_receipt), $inv_id, '����� ������ � ��������', '������ ����� ��� �������� �� ������');

            $return = PHPShopText::form($payment_forma, 'yandexpay', 'post', $action, '_blank');
        } elseif ($PHPShopOrderFunction->getSerilizeParam('orders.Person.order_metod') == 10004)
            $return = ', ����� �������������� ����������';

    return $return;
}

$addHandler = array
    (
    'userorderpaymentlink' => 'userorderpaymentlink_mod_yandexkassa_hook'
);
?>