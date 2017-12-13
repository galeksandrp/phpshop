<?php

function payonlinesystem_users_repay($obj,$PHPShopOrderFunction) {
    global $PHPShopBase;

    // ��������������� ����������
    $PrivateSecurityKey=$PHPShopBase->getParam('payonlinesystem.PrivateSecurityKey');
    $MerchantId=$PHPShopBase->getParam('payonlinesystem.MerchantId');
    $Currency=$PHPShopBase->getParam('payonlinesystem.currency');

    // ��������� ��������
    $mrh_ouid = explode("-", $row['uid']);
    $OrderId = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����
    $Amount=number_format($TotalSumOrder,2,".","");
    $Amount = $PHPShopOrderFunction->getTotal(); //����� �������

    // ����������� ����
    $SecurityKey=md5("MerchantId=$MerchantId&OrderId=$OrderId&Amount=$Amount&Currency=$Currency&PrivateSecurityKey=$PrivateSecurityKey");
    
    // ���� ����� �� �������
    if($PHPShopOrderFunction->getParam('statusi') != 101)
        $disp="<form name=\"PaymentForm\" action=\"https://secure.payonlinesystem.com/ru/payment/\" method=\"get\" target=\"_top\" >
<input type=\"hidden\" name=\"OrderId\" id=\"OrderId\" value=\"$OrderId\">
<input type=\"hidden\" name=\"Amount\" id=\"Amount\" value=\"$Amount\">
<input type=\"hidden\" name=\"MerchantId\" value=\"$MerchantId\">
<input type=\"hidden\" name=\"Currency\" value=\"$Currency\">
<input type=\"hidden\" name=\"SecurityKey\" value=\"$SecurityKey\">
	<a href=\"javascript:void(0)\" class=b title=\"".__('��������')." ".$PHPShopOrderFunction->getOplataMetodName()."\" onclick=\"javascript:PaymentForm.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"��������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>".$PHPShopOrderFunction->getOplataMetodName()."</a>
            </form>";
    else $disp=PHPShopText::b($PHPShopOrderFunction->getOplataMetodName());

    return $disp;
}
?>