<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// Load JsHttpRequest backend.
require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest =& new JsHttpRequest("windows-1251");

function ReturnSumma($sum,$disc){
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}


// ������ �������
function ViewCart($CART,$PERSON){
global $SysValue,$_REQUEST;
$cart=$CART['cart'];
$kurs=$CART['kurs'];
$n=1;
  if(sizeof($cart)!=0)
  foreach(@$cart as $val){
  $disCart.="
<tr class=row3 onmouseover=\"show_on('r".$val['id']."')\" id=\"r".$val['id']."\" onmouseout=\"show_out('r".$val['id']."')\" onclick=\"miniWin('adm_order_productID.php?orderId=".$_REQUEST['uid']."&xid=".$val['id']."',400,300,event)\">
 <td style=\"padding:3\">$n</td> 
  <td style=\"padding:3\">".$val['uid']."</td>
  <td style=\"padding:3\">".$val['name']."</td>
  <td style=\"padding:3\">".$val['num']."</td>
  <td style=\"padding:3\">".ReturnSumma($val['price']*$val['num'],0)."</td>
  
</tr>
";

$n++;
@$num+=$val['num'];
@$sum+=$val['price']*$val['num'];
}
$GetDeliveryPrice=GetDeliveryPrice($PERSON['dostavka_metod'],$sum);
 $disCart.="
<tr class=row3 onclick=\"miniWin('adm_order_deliveryID.php?deliveryId=".GetDelivery($PERSON['dostavka_metod'],"id")."&orderId=".$_REQUEST['uid']."',400,270,event)\" onmouseover=\"show_on('r".$n."')\" id=\"r".$n."\" onmouseout=\"show_out('r".$n."')\">
  <td style=\"padding:3\">$n</td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\">�������� - ".GetDelivery($PERSON['dostavka_metod'],"city")."</td>
  <td style=\"padding:3\">1</td>
   <td style=\"padding:3\">".GetDeliveryPrice($PERSON['dostavka_metod'],$sum)
."</td>
  
</tr>
";
$n++;
while($n<11){
 $disCart.="
 <tr bgcolor=\"ffffff\">
  <td style=\"padding:3\" height=\"20\">$n</td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
</tr>
 ";
 $n++;
 }

$disCart.="
<tr bgcolor=\"#C0D2EC\">
  <td style=\"padding:3\" colspan=\"3\" id=pane align=center>����� � ������ ������ ".$PERSON['discount']."%</td>
  <td style=\"padding:3\"><b>".($num+1)."</b> ��.</td>
  <td style=\"padding:3\" colspan=\"2\" align=\"center\"><b>".(ReturnSumma($sum,$PERSON['discount'])+$DeliveryPrice)."</b> ".GetIsoValutaOrder()."</td>
</tr>
";
 
return $disCart;
}



function GetProductInfo($productID){
global $table_name2;
$sql="select * from $table_name2 where id=$productID";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$num=mysql_num_rows($result);
$cart=array(
"id"=>$productID,
"name"=>CleanStr($row['name']),
"price"=>$row['price'],
"priceBox"=>$row['priceBox'],
"numBox"=>$row['numBox'],
"uid"=>$row['uid'],
"num"=>"1");
if($num!=0) return $cart;
  else return "False";
}


function UpdateSummaOrder($cart){
if(sizeof($cart)!=0)
  foreach(@$cart as $val){
  @$sum+=$val['price']*$val['num'];
  }
return $sum;
}

switch($do){

      case("discount"):
	  if(CheckedRules($UserStatus["visitor"],1) == 1){
	  $sql="select * from $table_name1 where id='".$_REQUEST['uid']."'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
      $order=unserialize($row['orders']);
	  $order['Person']['discount']=$_REQUEST['xid'];
	  $sql="UPDATE $table_name1
      SET
      orders='".serialize($order)."'
      where id='".$_REQUEST['uid']."'";
      $result2=mysql_query($sql);
	  $interfaces="
	  <table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
	<td id=pane align=center width=\"10\"><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5></td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>���-��</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����� ".GetIsoValutaOrder()."</td>
</tr>
".ViewCart($order['Cart'],$order['Person'])."
</table>";
      }
	  break;


      case("add"):
	  if(CheckedRules($UserStatus["visitor"],1) == 1){
	  $sql="select * from $table_name1 where id='".$_REQUEST['uid']."'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
      $order=unserialize($row['orders']);
	  $GetProductInfo=GetProductInfo($_REQUEST['xid']);
	  if($GetProductInfo!="False"){
	  $order['Cart']['cart'][$_REQUEST['xid']]=$GetProductInfo;
	  $order['Cart']['sum']=UpdateSummaOrder($order['Cart']['cart']);
	  $sql="UPDATE $table_name1
      SET
      orders='".serialize($order)."'
      where id='".$_REQUEST['uid']."'";
      $result2=mysql_query($sql);
	  }
	  $interfaces="
	  <table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
	<td id=pane align=center width=\"10\"><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5></td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>���-��</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����� ".GetIsoValutaOrder()."</td>
</tr>
".ViewCart($order['Cart'],$order['Person'])."
</table>";
}
	  break;


      case("delivery"):
	  if(CheckedRules($UserStatus["visitor"],1) == 1){
	  $sql="select * from $table_name1 where id='".$_REQUEST['uid']."'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
      $order=unserialize($row['orders']);
	  $order['Person']['dostavka_metod']=$_REQUEST['xid'];
	  $sql="UPDATE $table_name1
      SET
      orders='".serialize($order)."'
      where id='".$_REQUEST['uid']."'";
      $result2=mysql_query($sql);
	  $interfaces="
	  <table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
	<td id=pane align=center width=\"10\"><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5></td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>���-��</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����� ".GetIsoValutaOrder()."</td>
</tr>
".ViewCart($order['Cart'],$order['Person'])."
</table>";
}
	  break;


      case("del"):// �������
	  if(CheckedRules($UserStatus["visitor"],2) == 1){
	  $sql="select * from $table_name1 where id='".$_REQUEST['uid']."'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
      $order=unserialize($row['orders']);
	  $num=mysql_num_rows($result);
	  unset($order['Cart']['cart'][$_REQUEST['xid']]);
	  $order['Cart']['sum']=UpdateSummaOrder($order['Cart']['cart']);
	  $sql="UPDATE $table_name1
      SET
      orders='".serialize($order)."'
      where id='".$_REQUEST['uid']."'";
      $result2=mysql_query($sql);
	  $interfaces="
	  <table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
	<td id=pane align=center width=\"10\"><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5></td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>���-��</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����� ".GetIsoValutaOrder()."</td>
</tr>
".ViewCart($order['Cart'],$order['Person'])."
</table>
	  ";
	  }
	  break;
	  
	  case("update"):// ������
	  if(CheckedRules($UserStatus["visitor"],1) == 1){
	  $sql="select * from $table_name1 where id='".$_REQUEST['uid']."'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
      $order=unserialize($row['orders']);
	  $num=mysql_num_rows($result);
	  $order['Cart']['cart'][$_REQUEST['xid']]['name']=$_REQUEST['name'];
	  $order['Cart']['cart'][$_REQUEST['xid']]['num']=$_REQUEST['num'];
	  $kurs=GetKursOrder();
	  $order['Cart']['cart'][$_REQUEST['xid']]['price']=$_REQUEST['price']/$kurs;
	  $order['Cart']['sum']=UpdateSummaOrder($order['Cart']['cart']);
	  $sql="UPDATE $table_name1
      SET
      orders='".serialize($order)."'
      where id='".$_REQUEST['uid']."'";
      $result2=mysql_query($sql);
	  $interfaces="
	  <table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\">
<tr>
	<td id=pane align=center width=\"10\"><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5></td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>���-��</td>
	<td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����� ".GetIsoValutaOrder()."</td>
</tr>
".ViewCart($order['Cart'],$order['Person'])."
</table>
	  ";
	  }
	  break;
}




if(CheckedRules($UserStatus["visitor"],1) == 1){
$_RESULT = array(
  "interfaces"=> @$interfaces
  ); 
}
?>