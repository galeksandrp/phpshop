<?php
/**
 * ���������� ������ ������ ����� Robox
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

// ��������������� ����������
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // ������1

//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//�������� �������
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $GLOBALS['SysValue']['other']['total']*$SysValue['roboxchange']['mrh_kurs']; //����� �������

// ������������ �������
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">
<img src=\"images/bank/robot.gif\"  width=\"350\" height=\"72\" border=\"0\">
<p>
<b>ROBOXchange</b> �������� � ��������� ���������� ��������� ������ � ����� ����.
���� ������ �� ��������� �� �������� � ���������. � ������� ������� ROBOXchange ����� ����������� ����� WM - ����� WMZ, ����� WMR, ����� ������ ��������� ������ WebMoney , ����� e-gold, ������ ������, Money Mail, E-Bullion, Pecunix � ������ ����������� �����. ��� �������� �������� �������������� � �������������� ������ ��������� � ������� ������������ ������� ������������. ��������� ROBOXchange, �� ������ ���� �������, ��� ���� ������ ������� ��������. 
</p>
<DIV class=buttons>
<A href=\"http://webmoney.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_WebMoney.gif\" border=0></A> <A href=\"http://money.yandex.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_Yandex.gif\" border=0></A> <A href=\"http://rupay.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_RuPay.gif\" border=0></A> <A href=\"https://www.moneymail.ru/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_MoneyMail.gif\" border=0></A> <BR><A href=\"http://www.e-gold.com/\" target=_blank><IMG alt=\"\" src=\"images/bank/ban_Egold.gif\" border=0></A> <A href=\"http://www.ukrmoney.com/\" target=_blank><IMG  src=\"images/bank/ban_UkrMoney.gif\" border=0></A> <A href=\"http://www.emoney.md/\" target=_blank><IMG src=\"images/bank/ban_EmoneyMD.gif\" border=0></A> </DIV>
 <p><br></p>



<form action='https://www.roboxchange.com/ssl/calc.asp' method=POST name=\"pay\">
       <input type=hidden name=MrchLogin  value=$mrh_login>
       <input type=hidden name=OutSum  value=$out_summ>
       <input type=hidden name=InvId  value=$inv_id>
       <input type=hidden name=Desc  value=$inv_desc>
           <input type=hidden name=SignatureValue value=$crc>
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