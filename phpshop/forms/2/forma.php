<?
session_start();

// ��������

$_classPath="../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("security");
//PHPShopObj::loadClass("inwords");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System']=$PHPShopSystem->getArray();

// ���������� ������
include("../../inc/order.inc.php");           





// ���������� ���������
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];

if($org_name=="") $org_name=$name_person;

if(isset($_GET['tip']) and isset($_GET['orderId']) and isset($_GET['datas'])){
$orderId=PHPShopSecurity::TotalClean($_GET['orderId'],5);
$datas=PHPShopSecurity::TotalClean($_GET['datas'],5);
$PHPShopOrder = new PHPShopOrder($orderId);

$UsersId=PHPShopSecurity::TotalClean($_SESSION['UsersId'],1);

if($_GET['tip']==2)
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and datas=".$datas;

if($_GET['tip']==1 and isset($_SESSION['UsersId']))
$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderId' and user=$UsersId";

@$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
@$num=mysql_num_rows(@$result);
if($num==0) exit("���������������� ������������!");
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	@$sum=number_format($order['Cart']['sum'],"2",".","");
	 $name_person=$order['Person']['name_person'];
	$ChekDiscount=ChekDiscount($sum);
	
	$PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
    $deliveryPrice=$PHPShopDelivery->getPrice($sum,$weight);

    //$Summa=GetPriceOrder($ChekDiscount[1])+$deliveryPrice;
	$Summa=($PHPShopOrder->returnSummaBeznal($sum,$order['Person']['discount'])+$deliveryPrice);
 sscanf(number_format($Summa,"2",".",""), "%d.%s", $sum_rub, $sum_kop); // �������� �������
}
// ����������� ����
else
if(count(@$cart)>0)// ����� �������
  {
$cid=array_keys($cart);
for ($i=0,$n=1; $i<count($cid); $i++,$n++)
  {
  $j=$cid[$i];
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

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0;}


 @$nds=number_format($sum*18/118,"2",".","");
 @$sum=number_format($sum,"2",".","");
 
 // ������
 $ChekDiscount=ChekDiscount($sum);
 
 // ��������
 $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
 $deliveryPrice=$PHPShopDelivery->getPrice($sum,$weight);
 
 // �������� �������
 $Summa=($PHPShopOrder->returnSummaBeznal($sum,$ChekDiscount[0])+$deliveryPrice);
 sscanf(number_format($Summa,"2",".",""), "%d.%s", $sum_rub, $sum_kop); 
  }
if(!$_SESSION['sid']) header("Location: /");
$GetIsoValutaOrder=$PHPShopOrder->default_valuta_code;


if(!$datas) $datas=date("d-m-y");
else $datas=PHPShopDate::dataV($datas);
?>
<html>
<head>
<title>��������� ��������� ����� � <?=@$ouid?></title>
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
//window.resizeTo(650, 550);
</script>
</head>
<body  onload="window.focus()" bgcolor="#FFFFFF" text="#000000">
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" style="color: #0078BD;"><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$_SERVER[SERVER_NAME].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif" >�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;" style="color: #0078BD;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$_SERVER[SERVER_NAME].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>
<table cellpadding=2 cellspacing=0>
	<col style="padding-bottom: 5px;" width=30% height=50%>
	<col width=70% height=50%>
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" valign=top height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr><td width=100% height=100% valign=top align=right>���������</td></tr>
			<tr><td width=100% align=left valign=bottom>������</td></tr>
		</table></td>
		<td style="border-bottom: 1px solid #000000; padding-right: 0px;" height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr>
				<td class=data align=center width=100%><div style="width: 100%;"><?=$SysValue['bank']['org_name']?></div></td>
			</tr>
			<tr>
				<td align=center class=comment>(������������ ���������� �������)</td>
			</tr>
			<tr>
				<td width=100%><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td></td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_inn']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>�</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2 class=comment>(��� ���������� �������)</td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(����� ����� ���������� �������)</td>
					</tr>
					<tr>
						<td colspan=6><?=$SysValue['bank']['org_bank']?></td>
					</tr>
					<tr>
						<td>���</td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_bic']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>�</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_bank_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2></td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(����� ���./� ����� ���������� �������)</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 16px;">����������</td>
					<td class=data width=100%><?=@$name_person?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 5px;" nowrap>���������� �������</td>
					<td class=data width=100%>������ ������ � <?=@$ouid?> �� <?=$datas?></td>
				</table></td>
			</tr>
<?

?>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>����� �������</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>���.</td>
						<td width=100%></td>
					</tr>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>�����</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>���.</td>
						<td width=100%></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><div height=20>&nbsp;</div></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<td style="padding-right: 4px;">����������</td>
					<td width=80 class=data><div width=80>&nbsp;</div></td>
					<td style="padding-left: 2px;">(�������)</td>
					<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
					<td class=data width=85><div width=85>&nbsp;</div></td>
					<td>200&nbsp;&nbsp;�.</td>
				</table></td>
			</tr>
			<tr>
				<td align=left>� �������� ������ ������ �����, ��������� � ��������� ���������, </td>
			</tr>
			<tr>
				<td><table cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td>���������� � ��������.</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>200&nbsp;&nbsp;�.</td>
					</tr>
					<tr>
						<td colspan=2 align=right style="padding-right: 10px;" class=comment>(������� �����������)</td>
						<td></td>
						<td class=comment align=center>(����)</td>
						<td></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
	
	<tr>
		<td style="border-bottom: 1px solid #000000; border-right: 1px solid #000000;" valign=top height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr><td width=100% height=100% valign=bottom align=right>���������</td></tr>
			<tr><td width=100% align=left valign=bottom>������</td></tr>
		</table></td>
		<td style="border-bottom: 1px solid #000000; padding-right: 0px;" height=50%><table width=100% height=100% cellpadding=0 cellspacing=0>
			<tr>
				<td class=data align=center width=100%><div style="width: 100%;"><?=$SysValue['bank']['org_name']?></div></td>
			</tr>
			<tr>
				<td align=center class=comment>(������������ ���������� �������)</td>
			</tr>
			<tr>
				<td width=100%><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td></td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_inn']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>�</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2 class=comment>(��� ���������� �������)</td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(����� ����� ���������� �������)</td>
					</tr>
					<tr>
						<td colspan=6><?=$SysValue['bank']['org_bank']?></td>
					</tr>
					<tr>
						<td>���</td>
						<td class=data width=90><div width=90><?=$SysValue['bank']['org_bic']?></div></td>
						<td style="padding-left: 75px;"></td>
						<td>�</td>
						<td class=data width=145><div width=145><?=$SysValue['bank']['org_bank_schet']?></div></td>
						<td width=*></td>
					</tr>
					<tr class=comment>
						<td colspan=2></td>
						<td style="padding-left: 75px;"></td>
						<td colspan=3 class=comment>(����� ���./� ����� ���������� �������)</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 16px;">����������</td>
					<td class=data width=100%><?=@$name_person?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100%>
					<td style="padding-right: 5px;" nowrap>���������� �������</td>
					<td class=data width=100%>������ ������ � <?=@$ouid?> �� <?=$datas?></td>
				</table></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>����� �������</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>���.</td>
						<td width=100%></td>
					</tr>
					<tr>
						<td style="padding-left: 90px;"></td>
						<td>�����</td>
						<td width=65 class=data nowrap><div width=65><?=@$sum_rub?></div></td>
						<td><?=$GetIsoValutaOrder?></td>
						<td width=65 class=data><div width=65><?= $sum_kop?></div></td>
						<td>���.</td>
						<td width=100%></td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td><div height=20>&nbsp;</div></td>
			</tr>
			<tr>
				<td><table width=100% cellpadding=0 cellspacing=0>
					<td style="padding-right: 4px;">����������</td>
					<td width=80 class=data><div width=80>&nbsp;</div></td>
					<td style="padding-left: 2px;">(�������)</td>
					<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
					<td class=data width=85><div width=85>&nbsp;</div></td>
					<td>200&nbsp;&nbsp;�.</td>
				</table></td>
			</tr>
			<tr>
				<td align=left>� �������� ������ ������ �����, ��������� � ��������� ���������, </td>
			</tr>
			<tr>
				<td><table cellpadding=0 cellspacing=0 width=100%>
					<tr>
						<td>���������� � ��������.</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>&nbsp;&nbsp;&quot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;&nbsp;&nbsp;</td>
						<td class=data width=85><div width=85>&nbsp;</div></td>
						<td>200&nbsp;&nbsp;�.</td>
					</tr>
					<tr>
						<td colspan=2 align=right style="padding-right: 10px;" class=comment>(������� �����������)</td>
						<td></td>
						<td class=comment align=center>(����)</td>
						<td></td>
					</tr>
				</table></td>
			</tr>
		</table></td>
	</tr>
</table>
<?
//session_unregister('cart');
?>
</body>
</html>