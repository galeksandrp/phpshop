<?php

function userorderpaymentlink_mod_netpay_hook($obj, $PHPShopOrderFunction) {

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');
    include_once('phpshop/modules/netpay/class/netpay.request.php');
    $PHPShopDeltaArray = new PHPShopNetPayArray();
    $option = $PHPShopDeltaArray->getArray();


//var_dump($PHPShopOrderFunction->getSerilizeParam('orders.Cart'));exit;
    // �������� ������ �� ������� ������
    if ($PHPShopOrderFunction->order_metod_id == 10017)
    if ($PHPShopOrderFunction->getParam('statusi') == $option['status'] or empty($option['status'])) {
        // ����� �����
        $mrh_ouid = explode("-", $PHPShopOrderFunction->objRow['uid']);
        $inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];

        // ����� �������
        $out_summ = $PHPShopOrderFunction->getTotal();
		
		// �������� ����� ��� �������
		$is_test = ($option['work'] != 1); 
		
		$CART = $PHPShopOrderFunction->getSerilizeParam('orders.Cart');
		$products = $CART['cart'];
				
		$person = $PHPShopOrderFunction->getSerilizeParam('orders.Person');
		$discount = $person['discount'];
		
		$delivery_price = $CART['dostavka'];
		
		$submitval = '�������� ������';

		$NetpayRequest = new NetpayRequest(
			$option['apikey'], $option['auth'],
			$inv_id, $out_summ, $option['hold'], $is_test, 
			$option['online_bill'], $option['inn'], $option['tax'], $products,
			$discount, $delivery_price, '��������',
			$option['expiredtime'], $option['autosubmit'], $submitval
			);
		$link = $NetpayRequest->getButton();
        $return = $link;//PHPShopText::a($link,$submitval,$submitval, false, false, '_blank', 'btn btn-success pull-right');
        

    } elseif ($PHPShopOrderFunction->getSerilizeParam('orders.Person.order_metod') == 10017)
        $return = ', ����� �������������� ����������';

    return $return;
}

$addHandler = array('userorderpaymentlink' => 'userorderpaymentlink_mod_netpay_hook');
?>