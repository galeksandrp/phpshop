<?
/*
+-------------------------------------+
|  PHPShop Enterprise 2.1             |
|  ���������� ������                  |
+-------------------------------------+
*/
function Summa_cart()
{
global $cart,$LoadItems,$SysValue;
$cid=array_keys($cart);
for ($i=0; $i<count($cid); $i++)
  {
 $j=$cid[$i];
 @$in_cart.="
".$cart[$j]['name']." (".TotalClean($cart[$j]['num'],1)." ��.), ";
 @$sum+=$cart[$j]['price']*$cart[$j]['num'];
 }
$dis=array(@$in_cart,@$sum);
return @$dis;
}

function Order()
{
global $SysValue,$LoadItems,$_POST,$SERVER_NAME,$sid,$cart;
if(isset($_POST['send_to_order']))
{
 
   // �������� ������
    if(@$_POST['mail'] and @$_POST['name_person'
 ] and @$_POST['tel_name'] and @$_POST['adr_name'] and @$cart)
   {
   
   // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // ���������� ������
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
       $disp.="
<script language=\"JavaScript1.2\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
   session_unregister('cart');
   }
   else
      {
	  // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2'];
   
   // ���������� ������
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
	  $disp.="
	  <table>
<tr>
	<td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td>
</tr>
</table>
	   ";
	  }
}
elseif(!@$cart)
     {
	 // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_cart_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
   
   // ���������� ������
   @$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
	 }
return @$disp;
}

// ���������� ���������
$SysValue['other']['orderMesage']=Order();
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);
$SysValue['other']['catalogCat']= "���������� ������";
$SysValue['other']['catalogCategory']= "����� ��������";

// ���������� ������ 
@ParseTemplate($SysValue['templates']['index']);
?>

	