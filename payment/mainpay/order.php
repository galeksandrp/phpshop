<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ OrderFunction MainPay       |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

$cart_list=Summa_cart();
$ChekDiscount=ChekDiscount($cart_list[1]);
$GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
$sum_pol=(ReturnSummaNal($cart_list[1],$ChekDiscount[0])+$GetDeliveryPrice);
$sum_pol = number_format($sum_pol,2,".","");
	 

// ��������������� ����������
$Key=$SysValue['mainpay']['Key'];   //���� �������

//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//��������� ������
$Name = "������ ������ �$inv_id";
$OrderId=$inv_id;
$Amount=$sum_pol;



// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">

 <p><br></p>
 
 <img src=\"images/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"images/bank/mastercard.gif\" border=\"0\" hspace=5>
  <p><br></p>

<p>�� ������ �������� ���� ������ � ������ ��-���� ���������� ������� (VISA, MasterCard, DCL, JCB, AmEx). ��������� �������� �������������� �������������� ������� <b>MainPay</b>. </p>

<form name=\"PaymentForm\" action=\"http://partner.mainpay.ru/a1lite/input/\" method=\"GET\" target=\"_top\" >
<input type=\"hidden\" name=\"key\" id=\"Key\" value=\"$Key\">
<input type=\"hidden\" name=\"cost\" id=\"Amount\" value=\"$Amount\">
<input type=\"hidden\" name=\"order_id\"  value=\"0\">
<input type=\"hidden\" name=\"name\"  value=\"$Name\">
<input type=\"hidden\" name=\"comment\"  value=\"$OrderId\">
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