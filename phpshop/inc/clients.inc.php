<?
function dataV($nowtime){
$Months = array("01"=>"������","02"=>"�������","03"=>"�����", 
 "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
 "08"=>"�������","09"=>"��������",  "10"=>"�������",
 "11"=>"������","12"=>"�������");
$curDateM = date("m",$nowtime); 
$t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime).""; 
return $t;
}

// ������ �������
function ViewCart($CART){
global $SysValue;
$cart=$CART['cart'];
$kurs=$CART['kurs'];
$n=1;
  if(sizeof($cart)!=0)
  foreach(@$cart as $val){
  $disCart.="
<tr bgcolor=\"ffffff\">
  <td style=\"padding:3\">".$n."</td>
  <td style=\"padding:3\"><a href=\"/shop/UID_".$val['id'].".html\">".$val['name']."</a></td>
  <td style=\"padding:3\">".$val['num']."</td>
  <td style=\"padding:3\">".$val['price']*$kurs."</td>
  <td style=\"padding:3\">".substr($val['price'],0,strlen($val['price'])-2)."</td>
</tr>
";
$n++;
@$num+=$val['num'];
@$sum+=$val['price'];
}
while($n<6){
 $disCart.="
 <tr bgcolor=\"ffffff\">
  <td style=\"padding:3\" height=\"20\">".$n."</td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
  <td style=\"padding:3\"></td>
</tr>
 ";
 $n++;
 }
$ChekDiscount=ChekDiscount($sum*$kurs);
$disCart.="
<tr bgcolor=\"#C0D2EC\">
  <td style=\"padding:3\" colspan=\"2\" id=pane align=center>����� � ������ ������ ".$ChekDiscount[0]."%</td>
  <td style=\"padding:3\"><b>".$num."</b> ��.</td>
  <td style=\"padding:3\" colspan=2 align=\"center\"><b>".$ChekDiscount[1]."</b> ���.</td>
</tr>
";
 
return $disCart;
}

function ClientsCheck($order,$mail){
global $SysValue,$_POST,$LoadItems,$REMOTE_ADDR;
$order=TotalClean($order,1);
$sql="select * from ".$SysValue['base']['table_name1']." where uid='$order'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$id=$row['id'];
$datas=$row['datas'];
$uid=$row['uid'];
$order=unserialize($row['orders']);
$status=unserialize($row['status']);

if($mail==$order['Person']['mail']){
if($status['status']=="����� �����") {$forma="black";}
elseif($status['status']=="�����������") {$forma="green";}
elseif($status['status']=="��������") {$forma="red";}

// ���� ���� ���������
if($_POST['message']){
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$mail.">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." - �������� ������ �� ������  �".@$uid."/".$datas;
$content_adm="
������� �������!
--------------------------------------------------------

�������� ������ � ��������-�������� '".$LoadItems['System']['name']."'
�� ������ �".@$uid." �� ".dataV($datas)."

��������� �� ".@$order['Person']['name_person']."
---------------------------------------------------------

".TotalClean($_POST['message'],2)."

����/�����: ".date("d-m-y H:i a")."
IP:".$REMOTE_ADDR."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($LoadItems['System']['adminmail2'],$zag_adm, $content_adm, $header_adm);
$statusMail='
<div id=allspecwhite>
<img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><font color="#008000"><b>��������� ��������� ����������</b></font></div>
';
}



$disp='
<div id=allspec>
<img src="images/shop/date.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>����� �������</b>
</div>
<p>
'.GetUsersOrdersList($_REQUEST['order'],2).'
</p>
<div id=allspec>
<img src="images/shop/icon_info.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>����������</b>
</div>
<p>
'.GetUsersOrdersInfo($_REQUEST['order'],2).'
</p>
<div id=allspec>
<img src="images/shop/icon_user.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������ ������ ���������</b>
</div>
<p>

<table width="100%">
<tr>
  <td >
  <form method="post" name="forma_message">
  <textarea style="width:100%;height:100px;" name="message" id="message"></textarea>
  '.@$statusMail.'<br>
  <div>
  <input type="button" value="������ ������ ���������" onclick="CheckMessage()">
  <input type="hidden" value="'.$_REQUEST['order'].'" name="order">
  <input type="hidden" value="'.$_REQUEST['mail'].'" name="mail">
  </div>
  </form>
  </td>
</tr>
</table>
  <div  id=allspecwhite><img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">
<a href="/users/register.html" class="b">�����������������</a> � �������� �������������� ����������� � <b>������</b> � ����� ��������.
</div>
<p><br></p>
';
return $disp;
}
else return "������ � ������ ������� �� ���������� � ����.<br>
<a href=\"/clients/\" class=\"b\">����������� ��� ���</a>";
}
?>