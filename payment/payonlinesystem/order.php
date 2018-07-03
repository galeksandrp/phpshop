<?php
/**
 * ���������� ������ ������ ����� PayOnline
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));


// ��������������� ����������
$PrivateSecurityKey=$SysValue['payonlinesystem']['PrivateSecurityKey'];
$MerchantId=$SysValue['payonlinesystem']['MerchantId'];

$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

$OrderId=$inv_id;
$Amount=number_format($GLOBALS['SysValue']['other']['total'], 2, '.', '');
$Currency="RUB";

$SecurityKey=md5("MerchantId=$MerchantId&OrderId=$OrderId&Amount=$Amount&Currency=$Currency&PrivateSecurityKey=$PrivateSecurityKey");


// �������� �����
$FailUrl="http://".$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']."/fail/";


// ����� HTML �������� � ������� ��� ������
$disp= "
<script>
function CheckAgreement(){
if(document.getElementById('agreement').checked)
  PaymentForm.submit();
else alert('���������� ����������� � ��������� ������');
}
</script>
<div align=\"center\" width=\"400\">

 <p><br></p>
 
 <img src=\"phpshop/lib/templates/icon/bank/visa.png\" border=\"0\" hspace=\"5\">
  <img src=\"phpshop/lib/templates/icon/bank/mastercard.png\" border=\"0\" hspace=\"5\">
  <p><br></p>

<h4>�� ������ �������� ����� � ������ online ���������� ������� VISA, MasterCard. ��������� �������� �������������� �������������� ������� <b>PayOnline System</b>. </h4>

<form name=\"PaymentForm\" action=\"https://secure.payonlinesystem.com/ru/payment/\" method=\"get\" target=\"_top\" >
<input type=\"hidden\" name=\"OrderId\" id=\"OrderId\" value=\"$OrderId\">
<input type=\"hidden\" name=\"Amount\" id=\"Amount\" value=\"$Amount\">
<input type=\"hidden\" name=\"MerchantId\" value=\"$MerchantId\">
<input type=\"hidden\" name=\"Currency\" value=\"$Currency\">
<input type=\"hidden\" name=\"SecurityKey\" value=\"$SecurityKey\">
<input type=\"hidden\" name=\"FailUrl\" value=\"".urlencode($FailUrl)."\">
<input type=\"checkbox\" id=\"agreement\" value=\"1\"> � �������� <a href=\"/page/agreement.html\" target=\"_blank\">������� ������</a>
	<table>
<tr>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
        
	<a href=\"javascript:CheckAgreement();\">�������� ������</a></td>
</tr>
</table>
</form>

</div>";

?>