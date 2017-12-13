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
            $out_summ = $PHPShopOrderFunction->getTotal();

            // ��������� �����
            $payment_forma .= PHPShopText::setInput('hidden', 'shopId', trim($option['merchant_id']), false, 10);
            $payment_forma .= PHPShopText::setInput('hidden', 'scid', trim($option['merchant_scid']), false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'sum', $out_summ, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'customerNumber', $value['mail'], false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'orderNumber', $inv_id, false, 10);

            // ��� ������
            $v = $PHPShopYandexkassaArray->get_pay_variants_array(unserialize($option['pay_variants']), true);
            $payment_forma.=PHPShopText::select('paymentType', $v, 250, 'left') . ' ';

            $payment_forma.=PHPShopText::setInput('submit', 'send', $option['title'], $float = "none", 250);

            if ($option['test'])
                $action = 'https://demomoney.yandex.ru/eshop.xml';
            else
                $action = 'https://money.yandex.ru/eshop.xml';
            
            // ������ � ���
            $PHPShopYandexkassaArray->log(array('action' => $action, 'shopId' => $option['merchant_id'], 'scid' => trim($option['merchant_scid']), 'sum' => $out_summ, 'customerNumber' => $value['mail'], 'orderNumber' => $inv_id), $inv_id, '����� ������ � ��������', '������ ����� ��� �������� �� ������');

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