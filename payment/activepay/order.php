<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ OrderFunction Activepay     |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

$cart_list=Summa_cart();
$ChekDiscount=ChekDiscount($cart_list[1]);
$GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
$sum_pol=(ReturnSummaNal($cart_list[1],$ChekDiscount[0])+$GetDeliveryPrice);
$sum_pol = number_format($sum_pol,2,".","");


// ��������������� ����������
$secret_key=$SysValue['activepay']['secret_key'];
$merchant_contract=$SysValue['activepay']['merchant_contract'];

$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

$OrderId=$inv_id;
$amount=$sum_pol;
$currency="RUB";

// ���������� � ���������
include_once("payment/activepay/lib.php");


// �������� �����
$ReturnUrl="http://".$_SERVER['SERVER_NAME']."/success/";
$FailedUrl="http://".$_SERVER['SERVER_NAME']."/fail/";


// �������
$SecurityKey=sign("GET", 'activepay.ru', "/merchant_pages/create/", $secret_key,array(
        "merchant_contract" => $merchant_contract,
        "merchant_data" => $Order."-".$amount,
        "amount" => $amount,
        "currency" => $currency,
        "merchant_description" => $OrderId,
        "redirect_url_failed"=>$FailedUrl,
        "redirect_url_ok"=>$ReturnUrl,
        "commission_included"=>"false"
));


// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">

 <p><br></p>
 
 <img src=\"images/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"images/bank/mastercard.gif\" border=\"0\" hspace=5>
  <p><br></p>

<p>�� ������ �������� ���� ������ � ������ ��-���� ��������� ������� (VISA, MasterCard, DCL, JCB, AmEx). ��������� �������� �������������� �������������� ������� <b>Activepay</b>. </p>

<form name=\"PaymentForm\" action=\"http://activepay.ru/merchant_pages/create/\" method=\"GET\" target=\"_top\" >
<input type=\"hidden\" name=\"merchant_data\"  value=\"$Order-$amount\">
<input type=\"hidden\" name=\"merchant_description\"  value=\"$OrderId\">
<input type=\"hidden\" name=\"amount\"  value=\"$amount\">
<input type=\"hidden\" name=\"merchant_contract\" value=\"$merchant_contract\">
<input type=\"hidden\" name=\"currency\" value=\"$currency\">
<input type=\"hidden\" name=\"commission_included\" value=\"false\">
<input type=\"hidden\" name=\"redirect_url_ok\" value=\"$ReturnUrl\">
<input type=\"hidden\" name=\"redirect_url_failed\" value=\"$FailedUrl\">
<input type=\"hidden\" name=\"signature\" value=\"$SecurityKey\">

	<table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:PaymentForm.submit();\">�������� ����� ��������� �������</a></td>
</tr>
</table>
</form>

</div>";

?>