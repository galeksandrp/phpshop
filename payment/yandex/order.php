<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ OrderFunction Yandex        |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

$cart_list=Summa_cart();
$ChekDiscount=ChekDiscount($cart_list[1]);
$GetDeliveryPrice=GetDeliveryPrice($_POST['dostavka_metod'],$cart_list[1],$cart_list[2]);
$sum_pol=(ReturnSummaNal($cart_list[1],$ChekDiscount[0])+$GetDeliveryPrice);
$sum_pol = number_format($sum_pol,2,".","");
	 
// ��������������� ����������
$scid = $SysValue['yandex']['scid'];   
$ShopID = $SysValue['yandex']['ShopID'];  

// ��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

// �������� �������
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $sum_pol; //����� �������

// �������
$disCart='';
if(is_array($_SESSION['cart']))
foreach($_SESSION['cart'] as $j=>$v){
$disCart.=$_SESSION['cart'][$j]['uid']."  ".$_SESSION['cart'][$j]['name']." (".$_SESSION['cart'][$j]['num']." ��. * ".ReturnSummaNal($_SESSION['cart'][$j]['price'],0).") -- ".ReturnSummaNal($_SESSION['cart'][$j]['price']*$_SESSION['cart'][$j]['num'],0)."
";
}

// ����� HTML �������� � ������� ��� ������
$disp= '
<div align="center">
<p>
<b>������.������</b> � ��������� �������, ������� ��������� ��������� � ������ ���������� ������ � ������ � ���������.
</p>
 <p><br></p>
 
<form method="POST" name="pay" id="pay" action="https://demomoney.yandex.ru/eshop.xml">
<input class="wide" name="scid" value="'.$scid.'" type="hidden">
<input type="hidden" name="ShopID" value="'.$ShopID.'">
<input type=hidden name="CustomerNumber" size="20" value="����� N'.$inv_id.'">
<input type=hidden name="Sum" size="10" value="'.$out_summ.'">
<input type=hidden name="CustName" value="'.$_POST['name_person'].'">
<input type=hidden name="CustAddr" value="'.$_POST['adr_name'].'">
<input type=hidden name="CustEMail" value="'.$_POST['mail'].'">
<input type=hidden name="OrderDetails" value="'.$disCart.'">
	  <table>
<tr><td><img src="images/shop/icon-setup.gif" width="16" height="16" border="0"></td>
	<td align="center"><a href=\"javascript:history.back(1)"><u>
	��������� � ����������<br>
	�������</u></a></td>
	<td width="20"></td>
	<td><img src="images/shop/icon-client-new.gif"  width="16" height="16" border="0" align="left">
	<a href="javascript:pay.submit();">�������� ����� ��������� �������</a></td>
</tr>
</table>
      </form>
</div>';

?>