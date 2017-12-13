<?php
/**
 * ���������� ������ ������ ����� WebMoney
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));


// ��������������� ����������
$LMI_PAYEE_PURSE = $SysValue['webmoney']['LMI_PAYEE_PURSE'];    //�������
$wmid = $SysValue['webmoney']['wmid'];    //��������


//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//�������� �������
$inv_desc  = "������ ������ �$inv_id";
$out_summ  = $GLOBALS['SysValue']['other']['total']*$SysValue['webmoney']['kurs']; //����� �������


// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">
<p>
<img src=\"images/bank/webmoney_logo.gif\" width=\"307\" height=\"63\" border=\"0\">
</p>


<!-- begin WebMoney Transfer : attestation label --> 
<a href=\"https://passport.webmoney.ru/asp/certview.asp?wmid=$wmid\" target=_blank><IMG SRC=\"images/bank/attestated10.gif\" title=\"����� ��������� �������� ������ WM �������������� $wmid\" border=\"0\"><br><font size=1>��������� ��������</font></a>
<!-- end WebMoney Transfer : attestation label --> 

 <p><br></p>

      <form id=pay name=pay method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" name=\"pay\">
    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
	<input type=hidden name=LMI_SIM_MODE value=\"0\">
	  <table>
<tr><td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td>
	<td width=\"20\"></td>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\">�������� ����� ��������� �������</a></td>
</tr>
</table>
      </form>
</div>";
?>