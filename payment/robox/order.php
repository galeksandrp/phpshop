<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ OrderFunction Robox         |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

$cart_list=Summa_cart();
$ChekDiscount=ChekDiscount($cart_list[1]);
$GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
$sum_pol=(ReturnSummaNal($cart_list[1],$ChekDiscount[0])+$GetDeliveryPrice);
$sum_pol = number_format($sum_pol,2,".","");
	 
// ��������������� ����������
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // ������1

//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//�������� �������
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $sum_pol*$SysValue['roboxchange']['mrh_kurs']; //����� �������
$shp_item = 2;                //��� ������

// ������������ �������
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_item=$shp_item");

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
      <input type=hidden name=mrh value=$mrh_login>
      <input type=hidden name=out_summ value=$out_summ>
      <input type=hidden name=inv_id value=$inv_id>
      <input type=hidden name=inv_desc value=$inv_desc>
	  <input type=hidden name=crc value=$crc>
	  <input type=hidden name=shp_item value=$shp_item>
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