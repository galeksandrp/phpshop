<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ���� ���������� ������             |
+-------------------------------------+
*/

// ������� �������
function Chek($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) $stroka="0";
return abs($stroka);
}

function Chek2($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) $stroka="0";
return number_format(abs($stroka),"2",".","");
}


// ������� �������
if(@$SysValue['nav']['query']['cart']=="clean"){
session_unregister('cart');
unset($cart);
}


function ReturnNum($cart){
while (list($key, $value) = @each($cart)) @$num+=$cart[$key]['num'];
return @$num;
}

if(isset($id_edit))// �������������� ���-��
  {
  $cart[Chek($id_edit)]['num']=abs($num_new);
  session_register('cart');
  }
if(isset($id_delet))// �������� ������
  {
  unset($cart[Chek(@$id_delet)]);
  session_register('cart');
  }
if(@$cart[@$id_edit]['num']=="0")// �������� ������ � ������� ���-��
  {
  unset($cart[$id_edit]);
  session_register('cart');
  }
  
  /*
if(isset($xid))// ������ � ������
 {
 $count=count($cart);
 $id=$LoadItems['Product'][$xid]['id'];
 $name=$LoadItems['Product'][$xid]['name'];
 $price=$LoadItems['Product'][$xid]['price'];
 $uid=$LoadItems['Product'][$xid]['uid'];
 $cart_new=array(
"id"=>"$id",
"name"=>"$name",
"price"=>$LoadItems['Product'][$xid]['price'],
"priceBox"=>$LoadItems['Product'][$xid]['priceBox'],
"numBox"=>$LoadItems['Product'][$xid]['numBox'],
"uid"=>"$uid",
"num"=>"1"
	);
$cart[$xid]=$cart_new;
  }
*/
  
$option=unserialize($LoadItems['System']['admoption']);

  
if(count(@$cart)>0)// ����� �������
  {
if(is_array($cart))
foreach($cart as $j=>$v)
  {
 $price_now=ReturnSummaNal($cart[$j]['price']*$cart[$j]['num'],0);
 $priceOrder=$cart[$j]['price']*$cart[$j]['num'];
 
 //$CatId=$LoadItems['Product'][$cart[$j]['id']]['category'];
 //$Catname=$LoadItems['Podcatalog'][$CatId]['name'];
 
 @$display_cart.='
<form name="forma_cart" method="post">
<tr>
	<td>
	<a href="/shop/UID_'.$cart[$j]['id'].'.html" title="'.$cart[$j]['name'].'"><img src="images/shop/action_forward.gif" border=\"0\" hspace="5" align="absmiddle">'.$cart[$j]['name'].'</a></td>
	<td><input type=text value='.$cart[$j]['num'].' size=3 maxlength=3 name="num_new"></td>
	<td>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="image" name="edit_num" src="images/shop/cart_add.gif" value="edit" alt="�����������" hspace="5" >
<input type=hidden name="id_edit" value='.$cart[$j]['id'].'></td>
	<td>
	<table cellpadding="0" cellspacing="0">
</form>
<form name="forma_cart" method="post">
<tr>
	<td>
	
	<input type="image" name="edit_del" src="images/shop/cart_delete.gif" value="delet" alt="�������" hspace="5">
	<input type=hidden name="id_delet" value='.$cart[$j]['id'].'>
	</td>
</tr>
</form>
</table>
	</td>
</tr>
</table>
	</td>
	<td align=right class=red>'.$price_now.' '.GetValutaOrder().'</td>
	</td>
</tr>

 ';

//����������� � ������������ ����
 $goodid=$cart[$j]['id'];
 $goodnum=$cart[$j]['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //���� �� ������� ����� ������� ���!
 $weight+=$cweight;

 @$sum+=$price_now;
 @$sumOrder+=$priceOrder;
 @$sum=number_format($sum,"2",".","");
 @$num+=$cart[$j]['num'];
 }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0; $we=' &ndash; �� ������';} else {$we='&nbsp;��.';}

if(count(@$cart)>0){
$ChekDiscount=ChekDiscount($sumOrder);
//$GetDeliveryPrice=$weight;
$GetDeliveryPrice=GetDeliveryPrice("",$sum,$weight);
@$display='
<table border=0 width=99% cellpadding=0 cellspacing=3 class=style1>
<tr>
	<td ><strong>������������</strong></td>
	<td width=50><strong>���-��</strong></td>
	<td width=50><strong>��������</strong></td>
	<td width=70 align="right" colspan=""><strong>����</strong></td>
</tr>
<tr>
	<td colspan="4">
	<img src="images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
'.@$display_cart.'

<tr>
	<td colspan="4">
	<img src="images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
<tr style="padding-top:10">
   <td ><b>�����:</b></td>
   <td class=style2>
<strong>'.ReturnNum($cart).'</strong> (��.)
	</td>
	<td></td>
   <td class=red align="right">
   '.Chek2($sum).' '.GetValutaOrder().'<br>
</td>
</tr>
<tr>
	<td colspan="4">
	<img src="../images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
</table>
<table border=0 width=99% cellpadding=0 cellspacing=3 class=style1 align="center">
<!-- <tr style="padding-top:0">
   <td colspan="3" valign="top">����:</td>
   <td class=red align="right"><span>'.GetKursOrder().' </span></td>
</tr> -->
<tr style="padding-top:0" style="visibility:hidden;display:none;">
   <td colspan="3" valign="top">��� �������:</td>
   <td class=red align="right"><span id="WeightSumma">'.$weight.'</span>'.$we.'</td>
</tr>


<tr style="padding-top:0">
   <td colspan="3" valign="top">������:</td>
   <td class=red align="right"><span id="SkiSumma">'.$ChekDiscount[0].'</span>&nbsp;%</td>
</tr>
<tr style="padding-top:0">
   <td colspan="3" valign="top">��������:</td>
   <td class=red align="right"><span id="DosSumma">0'.$GetDeliveryPrice.'</span>&nbsp; '.GetValutaOrder().'</td>
</tr>
<tr>
    <td>
  � ������ � ������ ������:
	</td>
	<td class=style2>
	</td>
	<td colspan=2 align="right" class=red>
	<b><span id="TotalSumma">'.(ReturnSummaOrder($sum,$ChekDiscount[0])+$GetDeliveryPrice).'</span></b> '.GetValutaOrder().'</td>
</tr>
</table>
<input type="hidden" id="OrderSumma" name="OrderSumma"  value="'.ReturnSummaOrder($sum,$ChekDiscount[0]).'">
';
@$display.="
<script>
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='".ReturnNum(@$cart)."';
window.document.getElementById('sum').innerHTML='".Chek2(@$sum)."';
}
</script>
";
}


// ������� ����������� �����������
if(isset($_SESSION['UsersId'])){
$SysValue['other']['ComStartReg']="<!--";
$SysValue['other']['ComEndReg']="-->";
}



// ������� ����� ������
$sql="select uid from ".$SysValue['base']['table_name1']." order by uid desc LIMIT 0, 1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$last=$row['uid'];
$all_num=explode("-",$last);
$ferst_num=$all_num[0];
if($ferst_num<100) $ferst_num=100;
$order_num = $ferst_num + 1;
$order_num=$order_num."-".substr(abs(crc32(uniqid($sid))),0,2);

if(isset($_SESSION['UsersId'])){
$GetUsersInfo=GetUsersInfo($_SESSION['UsersId']);
// ���������� ���������
$SysValue['other']['UserMail']= $GetUsersInfo['mail'];
$SysValue['other']['UserName']= $GetUsersInfo['name'];
$SysValue['other']['UserTel']= $GetUsersInfo['tel'];
$SysValue['other']['UserTelCode']= $GetUsersInfo['tel_code'];
$SysValue['other']['UserAdres']= $GetUsersInfo['adres'];
$SysValue['other']['UserComp']= $GetUsersInfo['company'];
$SysValue['other']['UserInn']= $GetUsersInfo['inn'];
$SysValue['other']['UserKpp']= $GetUsersInfo['kpp'];
$SysValue['other']['formaLock']="readonly=1";
}
else{
/*
// ���������� ���������
$SysValue['other']['UserMail']= $_COOKIE['UserMail'];
$SysValue['other']['UserName']= $_COOKIE['UserName'];
$SysValue['other']['UserTel']= $_COOKIE['UserTel'];
$SysValue['other']['UserAdres']= $_COOKIE['UserAdres'];
$SysValue['other']['UserComp']= $_COOKIE['UserComp'];
$SysValue['other']['UserInn']= $_COOKIE['UserInn'];
*/
}

$SysValue['other']['orderNum']= $order_num;
$SysValue['other']['orderWeight']= ReturnNum($cart);
$SysValue['other']['catalogCat']= "���������� ������";
$SysValue['other']['catalogCategory']= "������";
$SysValue['other']['orderContentCart']=@$display;
$SysValue['other']['orderDate']=date("d-m-y");
$SysValue['other']['orderDelivery']=GetDelivery(@$_GET['d']);
$SysValue['other']['orderOplata']=GetOplataMetod();
$SysValue['other']['deliveryId']= @$_GET['d'];


// ���� ������� ������ ����� ���������� ������
if($option['cart_minimum'] < $sum){

// ���������� ������
$SysValue['other']['orderContent']=ParseTemplateReturn($SysValue['templates']['main_order_forma']);

}else{

     // ���������� ���������
   $SysValue['other']['orderContent']="<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['cart_minimum']." ".$option['cart_minimum']." </B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2']."
";

    
     }
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['main_order_list']);


}

else{
 // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_cart_1']."</B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2']."
<script language=\"JavaScript\">
document.getElementById('num').innerHTML = '--';
document.getElementById('sum').innerHTML = '';
document.getElementById('order').style.display = 'none';
</script>
";

   // ���������� ������
 $SysValue['other']['orderMesage']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
// ���������� ���������
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);
   
}

// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
?>
