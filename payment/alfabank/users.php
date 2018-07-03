<?php
/**
 * ���������� ������ ������ ����� Alfabank
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

function alfabank_users_repay($obj, $PHPShopOrderFunction) {

    //�������� �������
    $inv_desc = 'PHPShopPaymentService';
    $out_summ = $PHPShopOrderFunction->getTotal(); //����� �������
    $out_summ = number_format($out_summ, 2, '.', '');

    // ���� ����� �� �������
    if ($PHPShopOrderFunction->getParam('statusi') != 101){
        $disp= '
	<form method="post" action="/payment/alfabank/result.php" name="payrobots">
	<input type="hidden" name="orderNumber" value="'.$PHPShopOrderFunction->objRow['uid'].'">
	<input type="hidden" name="amount" value="'.$out_summ.'">
        <a href="javascript:void(0)" class=b title="' . __('��������') . " " . $PHPShopOrderFunction->getOplataMetodName() . '" onclick="javascript:payrobots.submit();" >' .$PHPShopOrderFunction->getOplataMetodName() . '</a>
	</form>
	';
    }
    else
        $disp = PHPShopText::b($PHPShopOrderFunction->getOplataMetodName());

    return $disp;
}

?>