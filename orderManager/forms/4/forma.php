<?
require("../../../phpshop/admpanel/connect.php");
require("../../lib/forms.lib.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");

$LoadItems['System']=GetSystems();

function GetValutaOrder(){ // ������ ��������
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['code'];
}

function ReturnLogo(){
global $LoadItems;
if(empty($LoadItems['System']['logo'])) return "../../img/phpshop_logo.gif";
 else return $LoadItems['System']['logo'];
}

function ReturnSumma($sum,$disc){ // �������� �� �����
if(empty($disc) or $disc=="") $disc=0;
$kurs=GetKursOrder();
$sum*=$kurs;
@$sum=@$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

function DoZero($price){
if(empty($price)) return 0;
 else return $price;
}


// ���������� ���������
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];


$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderID'";
$n=1;
@$result=mysql_query($sql) or die($sql);
$row = mysql_fetch_array(@$result);
    $id=$row['id'];
    $datas=$row['datas'];
	$ouid=$row['uid'];
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
 $nds=$LoadItems['System']['nds'];
 foreach($order['Cart']['cart'] as $val){
 $this_price=(ReturnSumma(number_format($val['price'],"2",".",""),$order['Person']['discount']));
 $this_nds=number_format($this_price*$nds/(100+$nds),"2",".","");
 $this_price_bez_nds=($this_price-$this_nds)*$val['num'];
 $this_price_c_nds=number_format($this_price*$val['num'],"2",".","");
 @$this_nds_summa+=$this_nds*$val['num'];

 @$dis.="
  <tr>
    <td >".$val['name']."</td>
    <td align=\"center\">��</td>
    <td align=\"right\">".$val['num']."</td>
    <td align=\"right\">".$this_price."</td>
    <td align=\"right\">".$this_price_bez_nds."</td>
    <td align=\"right\">--</td>
    <td align=\"right\">".$LoadItems['System']['nds']."%</td>
    <td align=\"right\">".$this_nds*$val['num']."</td>
    <td align=\"right\">".$this_price_c_nds."</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
  </tr>
  ";
  @$total_summa_nds+=$summa_nds;
  @$total_summa+=ReturnSumma(($val['price']*$val['num']),$order['Person']['discount']);
  @$sum+=$val['price']*$val['num'];
  @$num+=$val['num'];
  $n++;
 }
 
 $deliveryPrice=GetDeliveryPrice($order['Person']['dostavka_metod'],$sum);
 $summa_nds_dos=number_format($deliveryPrice*$nds/(100+$nds),"2",".","");

 @$dis.="
  <tr>
    <td >�������� ".GetDelivery($order['Person']['dostavka_metod'],"city")."</td>
    <td align=\"center\">��</td>
    <td align=\"right\">1</td>
    <td align=\"right\">".$deliveryPrice."</td>
    <td align=\"right\">".$deliveryPrice."</td>
    <td align=\"right\">--</td>
    <td align=\"right\">".$LoadItems['System']['nds']."%</td>
    <td align=\"right\">".$summa_nds_dos."</td>
    <td align=\"right\">".$deliveryPrice."</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
  </tr>
  ";
 
  if($LoadItems['System']['nds_enabled']){
 $nds=$LoadItems['System']['nds'];
 @$nds=number_format($sum*($nds/(100+$nds)),"2",".","");
 }
 @$sum=number_format($sum,"2",".","");

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
<title>���� - ������� �<?=@$ouid?></title>
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
#d1 {
	display: inline;
	float: right;
	width: 600px;
	font-size: 10px;
	margin-top: 100px;
	margin-bottom: 10px;
}

#d2 {
	font-size:18px;
	text-transform:uppercase;
	font-weight: bold;
	
}

#d3 {
	font-size:10px;
	
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
<div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" ><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif">�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;" style="color: #0078BD;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$SERVER_NAME.$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>
<table align="center" width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="right">
	<?
	$GetIsoValutaOrder=GetIsoValutaOrder();
	if(preg_match("/���/",$GetIsoValutaOrder)) {
	echo '
	<div id="d1">���������� �1<br />
� �������� ������� �������� ����� ���������� � ������������ ������-������,<br />
 ���� ������� � ���� ������ ��� �������� �� ������ �� ����������� ���������,<br />

 ������������ �������������� ������������� ���������� ���������  �� 2 ������� 2000 �. N 9</div>
';}?>
</td>
  </tr>
  <tr>
    <td valign="top" id="d2">����-������� �<?=@$ouid?> �� <?=$datas?></td>
  </tr>
  <tr>
    <td valign="top" >��������: <?=$LoadItems['System']['company']?><br />					
�����: <?=$LoadBanc['org_adres']?>, <?=$LoadItems['System']['tel']?> <br />							
����������������� ����� �������� (���) <?=$LoadBanc['org_inn']?>\<?=$LoadBanc['org_kpp']?> <br />							
���������������� � ��� �����: �� ��	<br />						
��������������� � ��� �����:  <?=@$order['Person']['adr_name']?>	<br />						
� ��������-���������� ���������       <br />							
����������: <?=@$order['Person']['org_name']?>	<br />						
�����: <?=@$order['Person']['adr_name']?> <br />							
����������������� ����� ���������� (���) <?=@$order['Person']['org_inn']?>/<?=@$order['Person']['org_kpp']?> <br />							
</td>
  </tr>
  <tr>
  <td align="right"><b>������: <?=$GetIsoValutaOrder?></b></td>
  </tr>
  <tr>
    <td valign="top" ><table style="margin-top:10px;" bordercolor="#000000"  width="998" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="122" align="center">������������ ������ (�������� ����������� �����, ��������� �����)</td>
    <td width="68" align="center">������� ����-
	�����</td>
    <td width="55" align="center">����-
������</td>
    <td width="113" align="center">���� (�����) �� ������� ���������</td>
    <td width="92" align="center">��������� ������� (�����, �����), ����� ��� ������</td>
    <td width="98" align="center">� ���
�����
�����</td>
    <td width="97" align="center">��������� ������</td>
    <td width="80" align="center">����� ������</td>
    <td width="97" align="center">��������� ������� (�����, �����), ����� � ������ ������</td>
    <td width="76" align="center">������
��������-
�����</td>
    <td width="76" align="center">�����
��������
����������
����������</td>
  </tr>
  <tr>
    <td align="center">1</td>
    <td align="center">2</td>
    <td align="center">3</td>
    <td align="center">4</td>
    <td align="center">5</td>
    <td align="center">6</td>
    <td align="center">7</td>
    <td align="center">8</td>
    <td align="center">9</td>
    <td align="center">10</td>
   <td align="center">11</td>
  </tr>
 <? echo @$dis;?>
  <tr>
    <td colspan="7"  ><b>����� � ������</b></td>
   
    <td align="right"><? echo $this_nds_summa+$summa_nds_dos; ?></td>
    <td align="right"><? echo $total_summa+$deliveryPrice; ?></td>
    <td colspan="2">&nbsp;</td>
    
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td valign="top" >&nbsp;</td>


  </tr>
   <tr>
    <td valign="top" >&nbsp;</td>


  </tr>
  <tr>
    <td valign="top" ><table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="487"><table width="423" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="417">������������ ����������� ____________________ </td>
  </tr>
  <tr>
    <td height="29">(�������������� ���������������)</td>
  </tr>
  <tr>
    <td height="27" align="right"> �.�.</td>
  </tr>
  <tr>
    <td height="30">�����</td>
  </tr>
  <tr>
    <td id="d3">����������. ������  ���������  -  ����������,  ������   ��������� - ��������</td>
  </tr>
</table></td>
    <td width="513" valign="top" align="right"><table width="374" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>������� ��������� ____________________ </td>
  </tr>
  <tr>
    <td height="29">(��������� ������������� � ���������������<br /> 
����������� ��������������� ���������������)</td>
  </tr>
  <tr>
    <td height="59" valign="bottom">________________________________________</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td valign="top">(������� �������������� ���� �� ��������)</td>
  </tr>
</table>
</td>
  </tr>
</table>
</td>
  </tr>
</table>

</body>
</html>