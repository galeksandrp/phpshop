<?php

function send_to_order_mod_yandexmoney_hook($obj, $value, $rout) {
    global $PHPShopSystem;

    if ($rout == 'MIDDLE' and $value['order_metod'] == 10002) {
        
       
        // ��������� ������
        include_once(dirname(__FILE__) . '/mod_option.hook.php');
        $PHPShopYandexmoneyArray = new PHPShopYandexmoneyArray();
        $option = $PHPShopYandexmoneyArray->getArray();

        // �������� ������ �� ������� ������
        if (empty($option['status'])) {

            // ����� �����
            $mrh_ouid = explode("-", $value['ouid']);
            $inv_id = $mrh_ouid[0] . $mrh_ouid[1];

            // ����� �������
            $out_summ = $obj->get('total');

            // ��������� �����
            $payment_forma = PHPShopText::setInput('hidden', 'receiver', trim($option['merchant_id']), false, 10);
            $payment_forma.= PHPShopText::setInput('hidden', 'formcomment', $PHPShopSystem->getParam('name') . ': ����� ' . $value['ouid'], false, 10);
            $payment_forma.= PHPShopText::setInput('hidden', 'short-dest', $PHPShopSystem->getParam('name') . ': ����� ' . $value['ouid'], false, 10);
            // ��� ������
            $v[]=array('������ �� ����� � ������.�������','PC',false);
            $v[]=array('������ � ���������� �����','AC',false);
            //$v[]=array('������ �� ���� ����� ��������','GP',false);
            //$v[]=array('������ �� ����� ���������� ��������','MC',false);
            $v[]=array('������ �� ����� � Webmoney','WM',false);
            $payment_forma.=PHPShopText::select('paymentType', $v, 250, 'left').' ';
            
            $payment_forma.=PHPShopText::setInput('hidden', 'writable-targets', "false", false, 10);
            
            $payment_forma.=PHPShopText::setInput('hidden', 'comment-needed', "false", false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'label', $inv_id, false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'quickpay-form', 'shop');
            $payment_forma.=PHPShopText::setInput('hidden', 'targets', $PHPShopSystem->getParam('name') . ': ����� ' . $value['ouid'], false, 10);
            $payment_forma.=PHPShopText::setInput('hidden', 'sum', $out_summ, false, 10);
            $payment_forma.=PHPShopText::setInput('submit', 'send', $option['title'], $float = "left; margin-left:10px;", 250);
            $payment_forma.=PHPShopText::setInput('hidden', 'cms_name', 'phpshop', false, 10);

            $obj->set('payment_forma', PHPShopText::form($payment_forma, 'yandexpay', 'post', 'https://money.yandex.ru/quickpay/confirm.xml','_blank'));
            $obj->set('payment_info', $option['title_end']);
            $forma = ParseTemplateReturn($GLOBALS['SysValue']['templates']['yandexmoney']['yandexmoney_payment_forma'], true);
        } else {

            $clean_cart = "
<script>
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
            $obj->set('mesageText', $option['title_end'] . $clean_cart);
            $forma = ParseTemplateReturn($GLOBALS['SysValue']['templates']['order_forma_mesage']);

            // ������� �������
            unset($_SESSION['cart']);
        }

        $obj->set('orderMesage', $forma);
    }
}

$addHandler = array
    (
    'send_to_order' => 'send_to_order_mod_yandexmoney_hook'
);
?>