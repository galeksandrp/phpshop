<?
require("../../../phpshop/admpanel/connect.php");
require("../../lib/forms.lib.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
@mysql_query("SET NAMES 'cp1251'");


$LoadItems['System']=GetSystems();

function GetValutaOrder(){ // ������ ��������
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['code'];
}


function ReturnSumma($sum,$disc){ // �������� �� �����
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

function DoZero($price){
if(empty($price)) return 0;
 else return $price;
}


// ���������� ���������
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];

$orderID=TotalClean($orderID,5);
$datas=TotalClean($datas,1);

$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderID' and datas='$datas'";
$n=1;
@$result=mysql_query($sql) or die($sql);
$row = mysql_fetch_array(@$result);
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);

 if(is_array($order['Cart']['cart']))
 foreach($order['Cart']['cart'] as $val){
 @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>".$val['name']."</td>
		<td align=right class=tablerow nowrap>".ReturnSumma($val['price'],0)."</td>
		<td align=right class=tablerow>".$val['num']."</td>
		<td class=tableright>".ReturnSumma($val['price']*$val['num'],0)."</td>
	</tr>
  ";
  @$sum+=$val['price']*$val['num'];
  @$num+=$val['num'];
  $n++;
//����������� � ������������ ����
 $goodid=$val['id'];
 $goodnum=$val['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //���� �� ������� ����� ������� ���!
 $weight+=$cweight;


 }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0;}


 $deliveryPrice=GetDeliveryPrice($order['Person']['dostavka_metod'],$sum,$weight);
  @$dis.="
  <tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>�������� - ".GetDelivery($order['Person']['dostavka_metod'],"city")."</td>
        <td align=right class=tablerow nowrap>".DoZero($deliveryPrice)."</td>
		<td align=right class=tablerow>1</td>
		<td class=tableright>".DoZero($deliveryPrice)."</td>
	</tr>
  ";
  if($LoadItems['System']['nds_enabled']){
 $nds=$LoadItems['System']['nds'];
 @$nds=number_format($sum*$nds/(100+$nds),"2",".","");
 }
 @$sum=number_format($sum,"2",".","");
 $summa_nds_dos=number_format($deliveryPrice*$nds/(100+$nds),"2",".","");
 
 $name_person=$order['Person']['name_person'];
 $org_name=$order['Person']['org_name'];
 $datas=dataV($datas,"false");
 
 function OplataMetod($tip){
if($tip==1) return "���� � ����";
if($tip==2) return "���������";
if($tip==3) return "�������� ������";
}


// ������� ����� ��������� ����
$chek_num=substr(abs(crc32(uniqid(rand(),true))),0,5);
$LoadBanc=unserialize($LoadItems['System']['bank']);
?>
<head>
<title>�������� ��� � <?=@$chek_num?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<style type="text/css">
body {text-decoration: none;font: normal 11px x-small/normal Verdana, Arial, Helvetica, sans-serif;text-transform: none}
TABLE {font: normal 11px Verdana, Arial, Helvetica, sans-serif;}
p {font: normal 11px Verdana, Arial, Helvetica, sans-serif;word-spacing: normal;white-space: normal;margin: 5px 5px 5px 5px;letter-spacing : normal;} 
TD {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	background: #FFFFFF;
}
H4 {
	font: Verdana, Arial, Helvetica, sans-serif;
	background: #FFFFFF;
}
.tablerow {
	border: 0px;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
}
.tableright {
	border: 0px;
	border-top: 1px solid #000000;
	border-left: 1px solid #000000;
	border-right: 1px solid #000000;
	text-align: right;
}
</style>
<style media="print" type="text/css">
<!-- 
.nonprint {
	display: none;
}
 -->
</style>
</head>
<body onload="window.focus()" bgcolor="#FFFFFF" text="#000000" marginwidth=5 leftmargin=5 style="padding: 2px;">
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" ><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif">�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>

<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
<TR>
<TH scope=row align=middle width="50%" rowSpan=3></TH>
<TD align=right>
<BLOCKQUOTE>
<P>�������� ��� <SPAN class=style4><?=@$chek_num?> �� <?=dataV(date("U"),"update")?></SPAN> </P></BLOCKQUOTE></TD></TR>
<TR>
<TD align=right>
<BLOCKQUOTE>
<P><SPAN class=style4><?=$LoadBanc['org_adres']?>, ������� <?=$LoadItems['System']['tel']?> </SPAN></P></BLOCKQUOTE></TD></TR>
<TR>
<TD align=right>
<BLOCKQUOTE>
<P class=style4>���������: <?=$LoadItems['System']['company']?></P></BLOCKQUOTE></TD></TR></TBODY></TABLE>



<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
<TR>
<TH scope=row align=middle width="50%">
<P class=style4>����������: <?=@$order['Person']['name_person']?></P></TH>
<TH scope=row align=middle><b>����� �<?=$ouid?> </b></TH></TR></TBODY></TABLE>



<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
<TR>
<TH class=style2 scope=row align=left>
<BLOCKQUOTE>
<P class=style4>���������� ������������ � ������� ��� ������ �� ����� ��� ���������!</P></BLOCKQUOTE></TH></TR>
<TR>
<TH class=style4 scope=row align=left>
<BLOCKQUOTE>
<P>���������� �������������� ����� ��������������� �� ������� ��� � ������������ ������ ����� ������ ��� �� ��������.</P></BLOCKQUOTE></TH></TR></TBODY></TABLE>







<p><br></p>
<table width=99% cellpadding=2 cellspacing=0 align=center>
	<tr class=tablerow>
		<td class=tablerow>�</td>
		<td width=50% class=tablerow>������������</td>
		<td class=tablerow>����</td>
		<td class=tablerow>����������</td>
		<td class=tableright>��������� (<?=GetIsoValutaOrder()?>)</td>
	</tr>
	<?
  echo @$dis;
 $my_total=ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice;
 $my_nds=number_format($my_total*$LoadItems['System']['nds']/(100+$LoadItems['System']['nds']),"2",".","");
  ?>
		<tr>
			<td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">�����:
			<?=$my_total?>
<?if($LoadItems['System']['nds_enabled']){?> 
� �.�. ���:  <?=$my_nds?>
<?}?>

</td>
		</tr>
	
	<tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
</table>
<p><b>����� ������������ <?=($num+1)?>, �� ����� <?=(ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice)." ".GetIsoValutaOrder()?>
<br />
<?
$iw=new inwords;  
$s=$iw->get(ReturnSumma($sum,$order['Person']['discount'])+$deliveryPrice); 
$v=GetIsoValutaOrder();
if (eregi("���", $v)) echo $s;
?>
</b></p><br>


<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
<TR>
<TH scope=row align=middle width="50%">
<P>&nbsp;</P>
<P class=style4>��������: ________________ �.�. </P>
<P>&nbsp;</P></TH>
<TD vAlign=center align=left><SPAN class=style5>����������� ������������ ������� �������������� � �������������� ��������� ������ ������������. ��� ���������� ���������������� ���������� ������ ����������� ������������ �������������� � ��������. </SPAN></TD></TR></TBODY></TABLE>
<?=$LoadItems['System']['promotext']?>
</body>
</html>