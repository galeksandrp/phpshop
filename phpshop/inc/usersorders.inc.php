<?

function GetOrderStatusArray(){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name32'];
$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	$array=array(
	"id"=>$row['id'],
	"name"=>$row['name'],
	"color"=>$row['color'],
	"sklad"=>$row['sklad_action']
	);
	$Status[$row['id']]=$array;
	}
return @$Status;
}


// ����� �������
function GetUsersOrdersList($n,$tip){
global $SysValue,$_GET;
$n=TotalClean($n,1);
if($tip==2) $sql="select * from ".$SysValue['base']['table_name1']." where uid='".htmlspecialchars($n)."'";
if($tip==1) $sql="select * from ".$SysValue['base']['table_name1']." where user='$n' order by datas desc";
$result=mysql_query($sql) or die("����� ��� �����, ���������...<br>����������� ���������: <A href=\"mailto:support@phpshop.ru\">support@phpshop.ru</A>");
while(@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$statusi=$row['statusi'];
	if($tip==1) $link="?orderId=$uid#PphpshopOrder";
	else $link="/users/register.html";
	
	$GetOrderStatusArray=GetOrderStatusArray();
	if($statusi==0){ 
	$bg="C0D2EC";
	$status_name="����� �����";
	}
	else{
	$bg=$GetOrderStatusArray[$statusi]['color'];
	$status_name=$GetOrderStatusArray[$statusi]['name'];
	}
	
	
	$docsLink2='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/2/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_dialog.gif" alt="��������� ���������" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
	$docsLink1='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/1/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_browser.gif" alt="���� � ����" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
    if($order['Person']['order_metod']==3)  $docsLink="";
	
	$SummaOrder=ReturnSummaNal($order['Cart']['sum'],$order['Person']['discount']);
	
@$dis.='

<tr>
	<td id=allspecwhite>
	<a href="'.$link.'" class="b" title="���������� � ������ � '.$uid.'"><img src="images/shop/icon-setup.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">'.$uid.'</a>
	</td>
	<td id=allspecwhite>
	'.dataV($datas).'
	</td>
	<td id=allspecwhite>
	'.(0+$order['Cart']['num']).'
	</td>
	<td id=allspecwhite>
	'.$order['Person']['discount'].'
	</td>
	<td id=allspecwhite>
	'.($SummaOrder+$order['Cart']['dostavka']).' '.GetValutaOrder().'
	</td>
	<td  bgcolor="'.$bg.'">
	'.$status_name.'
	</td>
';
}
$dis='
<table width="100%" id=allspecwhite cellpadding=3>
<tr>
	<td id=allspec>
	<b>� ������</b>
	</td>
	<td id=allspec>
	<b>����</b>
	</td>
	<td id=allspec>
	<b>���-��</b>
	</td>
	<td id=allspec>
	<b>������ %</b>
	</td>
	<td id=allspec>
	<b>�����</b>
	</td>
	<td id=allspec>
	<b>������</b>
	</td>
</tr>
'.$dis.'
</table>';
return $dis;
}


// ����� ������� ����
function GetUsersOrdersInfo($n,$tip=1){
global $SysValue,$_GET,$LoadItems;
$n=TotalClean($n,1);
$sql="select * from ".$SysValue['base']['table_name1']." where uid=$n";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
$row = mysql_fetch_array(@$result);
	$id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$statusi=$row['statusi'];
	$GetOrderStatusArray=GetOrderStatusArray();
	if($statusi==0){ 
	$bg="C0D2EC";
	$status_name="����� �����";
	}
	else{
	$bg=$GetOrderStatusArray[$statusi]['color'];
	$status_name=$GetOrderStatusArray[$statusi]['name'];
	}
	
$cart=$order['Cart']['cart'];
  if(sizeof($cart)!=0)
  foreach(@$cart as $val){
  $disCart.="
<tr>
  <td id=allspecwhite><a href=\"/shop/UID_".$val['id'].".html\" target=\"_blank\" class=b title=\"".$val['name']."\">".$val['name']."</a></td>
  <td id=allspecwhite>".$val['num']."</td>
  <td id=allspecwhite>".ReturnSummaNal($val['price']*$val['num'],$order['Person']['discount'])." 
 ".GetValutaOrder()."</td>
</tr>
";
@$num+=$val['num'];
@$sum+=$val['price']*$val['num'];
}

// �������� �����
$TotalSumOrder = (ReturnSummaNal($sum,$order['Person']['discount'])+$order['Cart']['dostavka']);

$disCart.="
<tr>
  <td id=allspecwhite>�������� -  ".GetDeliveryBase($order['Person']['dostavka_metod'],"city")."</td>
  <td id=allspecwhite>1</td>
  <td id=allspecwhite>".$order['Cart']['dostavka']." 
 ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite>����� � ������ ������ <b>".$order['Person']['discount']."</b>%</td>
  <td id=allspecwhite><b>".$num."</b> ��.</td>
  <td colspan=\"2\" id=allspecwhite><b>".$TotalSumOrder."</b> ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite><img src=\"images/shop/icon_clock.gif\" alt=\"����� ��������� ������� ������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5>����� ��������� ������: ".$status['time']."</td>
  <td colspan=\"3\" bgcolor=".$bg.">
	".$status_name."
	</td>
</tr>
<tr>
  <td id=allspec><strong>���������������</strong> ".$status['time']."</td>
  <td colspan=\"3\" id=allspecwhite>
  <table cellpadding=1 cellspacing=1>
</td>
</tr>
";

  $option=unserialize($LoadItems['System']['admoption']);
  if($option['oplata_2'] == 1)
  $disCart.="<tr>
	<td><a href=\"javascript:void(0)\"  class=b  title=\"��������� ���������\" onclick=\"miniWinFull('phpshop/forms/2/forma.html?orderId=$id&tip=$tip&datas=$datas',650,550);\" ><img src=\"images/shop/interface_dialog.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5 alt=\"��������� ���������\">��������� ���������</a></td>
</tr>";
  if($option['oplata_1'] == 1)
  $disCart.="<tr>
	<td><a href=\"javascript:void(0)\" class=b title=\"���� � ����\" onclick=\"miniWinFull('phpshop/forms/1/forma.html?orderId=$id&tip=$tip&datas=$datas',650,550);\" ><img src=\"images/shop/interface_browser.gif\" alt=\"���� � ����\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" vspace=3  hspace=5>���� � ����</a></td>
</tr>";
  if($option['oplata_5'] == 1){
  
 // ��������������� ����������
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
$mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // ������1

//��������� ��������
$inv_id    = $uid;       //����� �����

//�������� �������
$inv_desc  = "PHPShopPaymentService";
$out_summ  = $TotalSumOrder*$SysValue['roboxchange']['mrh_kurs']; //����� �������
$shp_item = 2;                //��� ������

// ������������ �������
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_item=$shp_item");
  
  $disCart.="<tr>
	<td>
	 <form action='https://www.roboxchange.com/ssl/calc.asp' method=POST name=\"payrobots\">
      <input type=hidden name=mrh value=$mrh_login>
      <input type=hidden name=out_summ value=$out_summ>
      <input type=hidden name=inv_id value=$inv_id>
      <input type=hidden name=inv_desc value=$inv_desc>
	<a href=\"javascript:void(0)\" class=b title=\"�������� ROBOXchange\" onclick=\"javascript:payrobots.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"�������� ����� ROBOXchange\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>�������� ����� ROBOXchange</a></form></td>
</tr>";
}
  if($option['oplata_6'] == 1){ // WebMoney
   
   // ��������������� ����������
   $LMI_PAYEE_PURSE = $SysValue['webmoney']['LMI_PAYEE_PURSE'];    //�������
   $wmid = $SysValue['webmoney']['wmid'];    //��������
   
   //��������� ��������
   $inv_id    = $uid;       //����� �����
   
    //�������� �������
    $inv_desc  = "������ ������ �$inv_id";
    $out_summ  = $TotalSumOrder*$SysValue['webmoney']['kurs']; //����� �������
	
   $disCart.="<tr>
	<td>
	 <form id=pay name=paywebmoney method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" name=\"paywebmoney\">
    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
	<input type=hidden name=LMI_SIM_MODE value=\"0\">
	<a href=\"javascript:void(0)\" class=b title=\"�������� WebMoney\" onclick=\"javascript:paywebmoney.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"WebMoney\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>WebMoney</a>
</form>
</td>
</tr>";
   }

$disCart.="  </table></td>
</tr>";

$disCart='<table width="100%" id=allspecwhite cellpadding=3>
<tr>
  <td id=allspec><b>������������</b></td>
  <td id=allspec><b>���-��</b></td>
  <td id=allspec><b>�����</b></td>
</tr>
'.$disCart.'
</table>';

if(!empty($status['maneger']))
$disCart.='
<div id=allspec>
<img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�������������� ����������</b>
</div>
<p>
<img src="images/shop/icon_user.gif" alt="��������" width="16" height="16" border="0" hspace="5" align="absmiddle"><a href="/users/message.html" title="����� � ����������" class="b">��������</a>: '.$status['maneger'].'
</p>
';

if($num>0) return $disCart;
else return "<font color=#FF0000>������������ ����� ������</font>";
}

// ����� ������� �������������
function UsersOrders($UsersId){
global $SysValue,$_POST,$_GET;
$UsersId=TotalClean($UsersId,1);
$dis='
<div id=allspec>
<img src="images/shop/date.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>����� �������</b>
</div>
<p>
'.GetUsersOrdersList($UsersId,1).'
</p>';
if(!empty($_GET['orderId']))
$dis.='
<div id=allspec>
<A id="PphpshopOrder"></A>
<img src="images/shop/icon_info.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>���������� �� ������ � '.TotalClean($_GET['orderId'],1).'</b>
</div>
<p>
'.GetUsersOrdersInfo($_GET['orderId']).'
</p>
';
return $dis;
}
?>