<?php
/**
 * ���������� ������ ������ ����� Z-Payment
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));


// ��������������� ����������
$LMI_PAYEE_PURSE = $SysValue['z-payment']['LMI_PAYEE_PURSE'];    //�������
$LMI_ID = $SysValue['z-payment']['LMI_ID']; 
//$wmid = $SysValue['webmoney']['wmid'];    //��������

//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//�������� �������
$inv_desc  = "������ ������ �$inv_id";
$out_summ  = $GLOBALS['SysValue']['other']['total']*$SysValue['z-payment']['kurs']; //����� �������



// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">

<!-- �������� Z-PAYMENT --> 
<a href=\"http://www.z-payment.ru/info.php?zp=$LMI_ID\" target=_blank><IMG SRC=\"phpshop/lib/templates/icon/bank/attestat.gif\" alt=\"���������� �������� Z-PAYMENT \" border=\"0\" align=\"left\" hspace=\"5\" vspace=\"5\"></a>
<!-- end �������� Z-PAYMENT --> 
<strong>Z-PAYMENT</strong> - ��� ������������� �������������� �������, ������������� ��������� ����� ������ � ������ ��������������� ��������. �� ���������� ����� �������� ������ � �������� ���������� ��� <strong>on-line ��������</strong>, ������ �������� �� ������, ������ ��������� ����� � �������. 
 <p><br></p>
      <form id=pay name=pay method=\"POST\" action=\"https://z-payment.ru/merchant.php\" name=\"pay\">
    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
    <input type=hidden name=CLIENT_MAIL value=\"".$_POST['mail']."\">
	  
	  <table>
<tr>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:pay.submit();\">�������� ����� ��������� �������</a></td>
</tr>
</table>
      </form>
</div>";
?>