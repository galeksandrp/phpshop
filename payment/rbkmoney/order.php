<?php
/**
 * ���������� ������ ������ ����� RBKMoney
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if (empty($GLOBALS['SysValue'])) exit(header("Location: /"));

// ��������������� ����������
$MerchantId = $SysValue['rbk']['eshopId'];
$serviceName = $SysValue['rbk']['serviceName'];
$Currency = $SysValue['rbk']['Currency'];

$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];     //����� �����

$OrderId = $inv_id;
$Amount = $GLOBALS['SysValue']['other']['total'];

// �������� �����
$ReturnUrl = urlencode("http://" . $_SERVER['SERVER_NAME'] . "/success/?rbk");
$FailUrl = urlencode("http://" . $_SERVER['SERVER_NAME'] . $SysValue['dir']['dir'] . "/fail/");

// ����� HTML �������� � ������� ��� ������
$disp = "
<div align=\"center\">

 <p><br></p>
 
 <img src=\"images/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"images/bank/mastercard.gif\" border=\"0\" hspace=5>
  <p><br></p>

<p>�� ������ �������� ���� ������ � ������ ��-���� ���������� ������� � ������� ��������� ������. ��������� �������� �������������� �������������� ������� <b>RBK money</b>. </p>

                <form name=\"PaymentForm\" action=\"https://rbkmoney.ru/acceptpurchase.aspx\" method=post>
                   <input type=\"hidden\" name=\"eshopId\" value=\"$MerchantId\">
                   <input type=\"hidden\" name=\"user_email\" value=\"" . $_POST['mail'] . "\">
                   <input type=\"hidden\" name=\"orderId\" value=\"$OrderId\">
                   <input type=\"hidden\" name=\"serviceName\" value=\"$serviceName\">
                   <input type=\"hidden\" name=\"recipientAmount\" value=\"$Amount\">
                   <input type=\"hidden\" name=\"recipientCurrency\" value=\"$Currency\">
                   <input type=\"hidden\" name=\"version\" value=\"2\">
                   <input type=\"hidden\" name=\"successUrl\" value=\"$ReturnUrl\">
                   <input type=\"hidden\" name=\"failUrl\" value=\"$FailUrl\">
	<table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:PaymentForm.submit();\">�������� ����� ��������� ������� RBK money</a></td>
</tr>
</table>
</form>

</div>";
?>