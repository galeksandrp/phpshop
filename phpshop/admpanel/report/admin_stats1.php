<?

function ReturnSumma($sum,$disc){
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}


function Stats1($pole1,$pole2,$vid,$productID)
{
global $table_name1;

if($vid=='getStat1'){
if(empty($pole1)) $pole1=date("U")-86400;
 else $pole1=GetUnicTime($pole1)-86400;
if(empty($pole2)) $pole2=date("U");
 else $pole2=GetUnicTime($pole2)+86400;
$sql="select * from $table_name1 where datas<'$pole2' and datas>'$pole1' order by id desc";
$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$uid=$row['uid'];
    $datas=$row['datas'];
	$order=unserialize($row['orders']);
    @$display.=('

	<tr bgcolor="ffffff"  onmouseover="show_on(\'r'.$id.'\')" id="r'.$id.'" onmouseout="show_out(\'r'.$id.'\')" class=row onclick="miniWin(\'order/adm_visitorID.php?visitorID='.$id.'\',650,500)">
	<td class=forma >
	'.dataV($datas,"shot").'
	</td>
	<td class=forma>
	'.$order['Cart']['num'].' ��.
	</td>
	<td class=forma >
	'.ReturnSumma($order['Cart']['sum'],$order['Person']['discount']).' 
	</td>
    </tr>

	');
	//$sum+=$order['Cart']['sum'];
	@$sum+=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	$num+=$order['Cart']['num'];
	@$i++;
    }
if($i>30)$razmer="height:600;";
return '
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td width="70%" style="padding-left:5px">
<div align="left" style="width:100%;'.@$razmer.';overflow:auto"> 
<table width="100%"  cellpadding="0" cellspacing="0" style="border: 1px;
	border-style: inset;">
<tr>
	<td valign="top" width="50%">
<table cellpadding="0" cellspacing="1" width="100%" border="0" bgcolor="#808080" class="sortable" id="sort">
<tr>
    <td width="20%" id=pane align=center><span name=txtLangs id=txtLangs>����</span></td>
	<td width="20%" id=pane align=center><span name=txtLangs id=txtLangs>���-��</span></td>
	<td width="20%" id=pane align=center><span name=txtLangs id=txtLangs>�����</span> '.GetIsoValutaOrder().'</td>
</tr>
	'.$display.'
	<tr bgcolor="#C0D2EC">
	<td id=pane align=center>�����:</td>
	<td class=forma >
	'.$num.'
	</td>
	<td class=forma >
	'.number_format($sum,"2",".","").'
	</td>
    </tr>
</table>
</div>
</td>
</tr>
</table>
<div align="right" style="padding-top:10">
<BUTTON style="width: 20em; height: 2.2em; margin-left:5"  onclick="DoReload(\'stats1\')"><img src="img/icon-setup2.gif"  width="16" height="16" border="0" align="absmiddle"> <span name=txtLangs id=txtLangs>��������� � ������ ������</span></BUTTON>
</div>
</td>
<td valign="top" width="30%">

<FIELDSET id=fldLayout style="width: 30em; height: 8em;">
<table cellpadding="10">
<tr>
	<td >
	<BUTTON style="width: 20em; height: 2.2em; margin-left:5"  onclick="miniWin(\'export/adm_csv.php?DO=stats1&pole1='.$pole1.'&pole2='.$pole2.'\',300,300);"><img src="img/action_save.gif"  width="16" height="16" border="0" align="absmiddle" hspace="5"><span name=txtLangs id=txtLangs> ��������� � Excel</span></BUTTON>
<br><br>
	*<span name=txtLangs id=txtLangs>�������� ������ �������������� � ������ CSV</span>
	</td>
	<td>
	</td>
</tr>
</table>
</FIELDSET>

</td>

</tr>
</table>
';
}
// ����� �� �������
if($vid=='getStat2'){
if(empty($pole1)) $pole1=date("U")-86400;
 else $pole1=GetUnicTime($pole1)-86400;
if(empty($pole2)) $pole2=date("U");
 else $pole2=GetUnicTime($pole2)+86400;
$sql="select * from $table_name1 where datas<'$pole2' and datas>'$pole1' order by id desc";
$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$uid=$row['uid'];
    $datas=$row['datas'];
	$order=unserialize($row['orders']);
	$cart=$order['Cart']['cart'];
	
  foreach(@$cart as $val)
  if($val['id']==$productID){
  
    @$display.=('

	<tr bgcolor="ffffff"  onmouseover="show_on(\'r'.$id.'\')" id="r'.$id.'" onmouseout="show_out(\'r'.$id.'\')" class=row onclick="miniWin(\'order/adm_visitor.php?visitorID='.$id.'\',650,500)">
    <td class=forma align="center">
	'.$uid.'
	</td>
	<td class=forma align="center">
	'.dataV($datas).' '.$order['Person']['time'].'
	</td>
	<td>
	'.$val['name'].'
	</td>
	<td>
	'.$val['num'].'
	</td>
	<td class=forma>
	'.$order['Cart']['num'].' ��.
	</td>
	<td>
	'.$order['Person']['discount'].'%
	</td>
	<td class=forma >
	'.@$sum+=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']).'
	</td>
    </tr>

	');
	@$sum+=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	$num+=$order['Cart']['num'];
	@$i++;
	}
    }
if($i>30)$razmer="height:600;";
return '
<div align="left" style="width:100%;".@$razmer.";overflow:auto"> 
<table width="100%"  cellpadding="0" cellspacing="0" style="border: 1px;
	border-style: inset;">
<tr>
	<td valign="top" width="100%">
<table cellpadding="0" cellspacing="1" width="100%" border="0" bgcolor="#808080" class="sortable" id="sort">
<tr>
    <td width="100" id=pane align=center><span name=txtLang2 id=txtLang2>� ������</span></td>
    <td width="100" id=pane align=center><span name=txtLang2 id=txtLang2>�����������</span></td>
	<td  id=pane align=center><span name=txtLang2 id=txtLang2>������������</span></td>
	<td width="50" id=pane align=center><span name=txtLang2 id=txtLang2>���-��</span></td>
	<td width="100" id=pane align=center><span name=txtLang2 id=txtLang2>� ������</span></td>
	<td width="100" id=pane align=center><span name=txtLang2 id=txtLang2>������</span></td>
	<td width="100" id=pane align=center><span name=txtLang2 id=txtLang2>�����</span> '.GetIsoValutaOrder().'</td>
</tr>
	'.$display.'
	
</table>
</div>
</td>
</tr>
</table>
<div align="right" style="padding-top:10">
<BUTTON style="width: 20em; height: 2.2em; margin-left:5"  onclick="DoReload(\'stats1\')"><img src="img/icon-setup2.gif"  width="16" height="16" border="0" align="absmiddle"> <span name=txtLang2 id=txtLang2>��������� � ������ ������</span></BUTTON>
</div>

';
}
else
return'
<div align="center">
<h4 align="center"><span name=txtLang id=txtLang>������ �������� �������</span></h4>
	<FIELDSET id=fldLayout style="width: 60em;">
	
	<form method="post" name=calendar>
<table cellpadding="10">

<tr><td><br><h4>1.</h4></td>
	<td align="left" width="150">
	
	<span name=txtLang id=txtLang>�������� ��� ������</span><br>
    <select name="stattip">
	<option value="1" SELECTED id=txtLang>����� ������� �� ����</option>
    </select>
	</td>
	<td>
	<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>� ����</span></td>
	<td></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>�� ����</span></td>
	<td></td>
</tr>
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.date("d-m-Y").'"></td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="'.date("d-m-Y").'" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
</tr>
</table>

	</td>
	<td>
	<input type="button" name="getStat1" value="OK" class=but onclick="DoReload(\'stats1\',calendar.pole1.value,calendar.pole2.value,\'getStat1\')">

	</td>
</tr>

<tr>
    <td colspan="4"><hr></td>
</tr>
</table>
</form>
<form method="post" name="calendar2" onsubmit="javascript: if(calendar2.productID.value==\'\') return false;">
<table cellpadding="10">
 <tr>
    <td><br><h4>2.</h4></td>
	<td align="left">
	
	<span name=txtLang id=txtLang>ID ������</span><br>
<input type="text" style="width:135" name="productID" id="productID">
	</td>
	<td>
	<table>
<tr>
	<td>&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>� ����</span></td>
	<td></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>�� ����</span></td>
	<td></td>
</tr>
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.date("d-m-Y").'">
	</td><td>
	<IMG onclick="popUpCalendar(this, calendar2.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="'.date("d-m-Y").'" name="pole2">
<IMG onclick="popUpCalendar(this, calendar2.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
</tr>
</table>
	</td>
	<td>
	<input type="button" name="getStat1" value="OK" class=but onclick="DoReload(\'stats1\',calendar2.pole1.value,calendar2.pole2.value,\'getStat2\',document.getElementById(\'productID\').value)">
	</td>
</tr> 

</table>
</form>
';

}
?>
