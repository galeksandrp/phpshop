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
<div align=\"center\">

 <p><br></p>
 
 <img src=\"images/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"images/bank/mastercard.gif\" border=\"0\" hspace=5>
  <p><br></p>

<p>�� ������ �������� ���� ������ � ������ ��-���� ��������� ������� (VISA, MasterCard, DCL, JCB, AmEx). ��������� �������� �������������� �������������� ������� <b>PayOnline System</b>. </p>

<form name=\"PaymentForm\" action=\"https://secure.payonlinesystem.com/ru/payment/\" method=\"get\" target=\"_top\" >
<input type=\"hidden\" name=\"OrderId\" id=\"OrderId\" value=\"$OrderId\">
<input type=\"hidden\" name=\"Amount\" id=\"Amount\" value=\"$Amount\">
<input type=\"hidden\" name=\"MerchantId\" value=\"$MerchantId\">
<input type=\"hidden\" name=\"Currency\" value=\"$Currency\">
<input type=\"hidden\" name=\"SecurityKey\" value=\"$SecurityKey\">
<input type=\"hidden\" name=\"FailUrl\" value=\"".urlencode($FailUrl)."\">
<input type=\"checkbox\" id=\"agreement\" value=\"1\">� ��������(��) � <a href=\"/page/agreement.html\" target=\"_blank\">��������� ������</a>
	<table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
        
	<a href=\"javascript:CheckAgreement();\">�������� ����� ��������� �������</a></td>
</tr>
</table>
</form>

</div>";

?>