<?
session_start();

//���� � ���� �����


$_classPath="../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("inwords");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System']=$PHPShopSystem->getArray();






if($org_name=="") $org_name=$name_person;

// ���������� ���������
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];


if(isset($_GET['tip']) and isset($_GET['orderId']) and isset($_GET['datas'])){
$orderId=PHPShopSecurity::TotalClean($_GET['orderId'],5);
$datas=PHPShopSecurity::TotalClean($_GET['datas'],5);
$PHPShopOrder = new PHPShopOrder($orderId);

$UsersId=PHPShopSecurity::TotalClean($_SESSION['UsersId'],1);

if($_GET['tip']==2)
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and datas=".$datas;

if($_GET['tip']==1 and isset($_SESSION['UsersId']))
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and user=$UsersId";
$n=1;
@$result=mysql_query($sql);
$row = mysql_fetch_array(@$result);
$n=mysql_num_rows(@$result);
if($n==0) exit("���������������� ������������!");
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);

 foreach($order['Cart']['cart'] as $val){
 @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>".$val['name']."</td>
		<td class=tablerow align=center>��.&nbsp;</td>
		<td align=right class=tablerow>".$val['num']."</td>
		<td align=right class=tablerow nowrap>".$PHPShopOrder->returnSummaBeznal($val['price'],$order['Person']['discount'])."</td>
		<td class=tableright>
		".$PHPShopOrder->returnSummaBeznal($val['price']*$val['num'],$order['Person']['discount'])."</td>
	</tr>
  ";

//����������� � ������������ ����
 $goodid=$val['id'];
 $goodnum=$val['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //���� �� ������� ����� ������� ���!
 $weight+=$cweight;


  @$sum+=$val['price']*$val['num'];
  @$num+=$val['num'];
  $n++;
 }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0;}


 $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
 $deliveryPrice=$PHPShopDelivery->getPrice($sum,$weight);

  @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>�������� - ".$PHPShopDelivery->getCity()."</td>
		<td class=tablerow align=center>��.&nbsp;</td>
		<td align=right class=tablerow>1</td>
		<td align=right class=tablerow nowrap>".$deliveryPrice."</td>
		<td class=tableright>".$deliveryPrice."</td>
	</tr>
  ";
  if($LoadItems['System']['nds_enabled']){
 //@$nds=number_format($sum*18/118,"2",".","");
 $nds=$LoadItems['System']['nds'];
 @$nds=number_format($sum*$nds/(100+$nds),"2",".","");
 }
 @$sum=number_format($sum,"2",".","");
 $name_person=$order['Person']['name_person'];
 $org_name=$order['Person']['org_name'];
}
// ���� ���������� �����
else
if(count(@$cart)>0)// ����� �������
  {
$cid=array_keys($cart);
for ($i=0,$n=1; $i<count($cid); $i++,$n++)
  {
  $j=$cid[$i];

  @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>".$cart[$j]['name']."</td>
		<td class=tablerow align=center>��.&nbsp;</td>
		<td align=right class=tablerow>".$cart[$j]['num']."</td>
		<td align=right class=tablerow nowrap>".$PHPShopOrder->returnSummaBeznal($cart[$j]['price'],$order['Person']['discount'])."</td>
		<td class=tableright>
	".$PHPShopOrder->returnSummaBeznal($cart[$j]['price']*$cart[$j]['num'],$order['Person']['discount'])."
		</td>
	</tr>
  ";
   @$sum+=$cart[$j]['price']*$cart[$j]['num'];
   @$num+=$cart[$j]['num'];

//����������� � ������������ ����
 $goodid=$cart[$j]['id'];
 $goodnum=$cart[$j]['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //���� �� ������� ����� ������� ���!
 $weight+=$cweight;

   
  }
  $num++;

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0;}

  
   $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
   $deliveryPrice=$PHPShopDelivery->getPrice($sum,$weight);
  
   @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>�������� - ".$PHPShopDelivery->getCity()."</td>
		<td class=tablerow align=center>��.&nbsp;</td>
		<td align=right class=tablerow>1</td>
		<td align=right class=tablerow nowrap>".$deliveryPrice."</td>
		<td class=tableright>".$deliveryPrice."</td>
	</tr>
  ";
 
 
 
 if($LoadItems['System']['nds_enabled']){
 //@$nds=number_format($sum*18/118,"2",".","");
 $nds=$LoadItems['System']['nds'];
 @$nds=number_format($sum*$nds/(100+$nds),"2",".","");
 }
 @$sum=number_format($sum,"2",".","");
 
 // ������
 //$ChekDiscount=ChekDiscount($sum);
 //$ChekDiscount2=ChekDiscount($nds);
 //$order['Person']['discount']=$ChekDiscount[0];
  }
if(!$datas) $datas=date("d-m-y");
else $datas=PHPShopDate::dataV($datas);

if(!$_SESSION['sid']) {header("Location: /");exit();};
?>
<head>
<title>���� � ���� ����� � <?=@$ouid?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="../style.css" type=text/css rel=stylesheet>
<style media="print" type="text/css">
<!-- 
.nonprint {
	display: none;
}
 -->
</style>
<script>
window.resizeTo(650, 600);
</script>
</head>
<body onload="window.focus()" bgcolor="#FFFFFF" text="#000000" marginwidth=5 leftmargin=5 style="padding: 2px;">
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" style="color: #0078BD;"><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$_SERVER[SERVER_NAME].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif">�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;" style="color: #0078BD;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src=http://<?=$_SERVER[SERVER_NAME].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif></a><br><br></div>
<p align=left><?=$SysValue['bank']['org_name']?></p>
<table cellpadding=3 cellspacing=0 width=99%>
	<tr>
		<td>����������� �����:</td>
		<td><?=$SysValue['bank']['org_ur_adres']?></td>
	</tr>
	<tr>
		<td>�������� �����:</td>
		<td><?=$SysValue['bank']['org_adres']?></td>
	</tr>
</table>
<h4 align=center>�������&nbsp;����������&nbsp;����������&nbsp;���������</h4>
<table cellpadding=0 cellspacing=1 bgcolor=#BBBBBB width=99% border=0 align=center>
	<tr>
		<td nowrap>���&nbsp;<?=$SysValue['bank']['org_inn']?></td>
		<td nowrap>���&nbsp;<?=$SysValue['bank']['org_kpp']?></td>
		<td rowspan=2 valign=bottom>��.�</td>
		<td rowspan=2 valign=bottom><?=$SysValue['bank']['org_schet']?>
</td>
	</tr>
	<tr>
		<td colspan=2>����������<br /><?=$SysValue['bank']['org_name']?></td>
	</tr>
	<tr>
		<td rowspan=2 colspan=2 valign=top>���� ����������<br /><?=$SysValue['bank']['org_bank']?>
</td>
		<td>���</td>
		<td nowrap rowspan=2><?=$SysValue['bank']['org_bic']?><br><?=$SysValue['bank']['org_bank_schet']?></td>
	</tr>
	<tr>
		<td>��.�</td>
	</tr>
</table>
<h2 align=center>����&nbsp;�&nbsp;<?= $ouid?>&nbsp;��&nbsp;<?=$datas?></h2>
<br />
<table cellpadding=0 cellspacing=2>
	<tr>
		<td>��������:</td>
		<td><?=@$name_person?></td>
	</tr>
	<tr>
		<td>����������:</td>
		<td><?=@$org_name?></td>
	</tr>
</table>
<table width=99% cellpadding=2 cellspacing=0 align=center>
	<tr class=tablerow>
		<td class=tablerow>�</td>
		<td width=50% class=tablerow>������������</td>
		<td class=tablerow>������� ���������&nbsp;</td>
		<td class=tablerow>����������</td>
		<td class=tablerow>����</td>
		<td class=tableright>�����</td>
	</tr>
	<?
  echo @$dis;
 $my_total=$PHPShopOrder->returnSummaBeznal($sum,$order['Person']['discount'])+$deliveryPrice;
 $my_nds=number_format($my_total*$LoadItems['System']['nds']/(100+$LoadItems['System']['nds']),"2",".","");
  ?>
       <tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">������:</td>
			<td class=tableright nowrap><b><?= @$order['Person']['discount']?>%</b></td>
		</tr>
		<tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">�����:</td>
			<td class=tableright nowrap><b><?=$my_total." ".$PHPShopOrder->default_valuta_code?></b></td>
		</tr>
	<?if($LoadItems['System']['nds_enabled']){?>
		<tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">� �.�. ���: <?=$LoadItems['System']['nds']?>%</td>
			<td class=tableright nowrap><b><?=$my_nds." ".$PHPShopOrder->default_valuta_code?></b></td>
		</tr>
	<?}?>
	<tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
</table>
<p><b>����� ������������ <?=$n?>, �� ����� <?=($PHPShopOrder->returnSummaBeznal($sum,$order['Person']['discount'])+$deliveryPrice)." ".$PHPShopOrder->default_valuta_code?>
<br />
<?
$iw=new inwords;  
$s=$iw->get($PHPShopOrder->returnSumma($sum,$order['Person']['discount'])+$deliveryPrice); 
$v=$PHPShopOrder->default_valuta_code;
if (eregi("���", $v)) echo $s;
?>
</b></p><br>
<p>������������ �����������<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<p>������� ���������<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
</body>
</html>
<?
if(isset($cart))
{
$cart_raz=count($cart)*40+550;
echo"
<script language=\"JavaScript\"> 
window.resizeTo(600, $cart_raz);
</script>
";
}
session_unregister('cart');
?>