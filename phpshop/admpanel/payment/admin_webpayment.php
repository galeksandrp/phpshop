<?

function OrderPayment($pole1,$pole2,$words)// ����� ��������
{
global $SysValue;

if(empty($pole1)) $pole1=date("U")-86400;
 else $pole1=GetUnicTime($pole1)-86400;
if(empty($pole2)) $pole2=date("U");
 else $pole2=GetUnicTime($pole2)+86400;


 
if(!empty($words)){
$sql="select * from ".$SysValue['base']['table_name33']." where uid=".$words;
}
else 
$sql="select * from ".$SysValue['base']['table_name33']." where datas<'$pole2' and datas>'$pole1' ".@$seller." order by uid desc";
@$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	$id=$row['uid'];
    $name=$row['name'];
	$sum=$row['sum'];
	$datas=$row['datas'];

	$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
    $mrh_pass2 = $SysValue['roboxchange']['mrh_pass2'];    // ������2
    $mrh_crc = strtoupper(md5("$mrh_login:$id:$mrh_pass2"));
	
	if(preg_match("/ROBOX/i",$name))
	  $edit='<a href="javascript:RoboxStatus(\''.$mrh_login.'\',\''.$id.'\',\''.$mrh_crc.'\')"><img src="icon/accept.png" alt="��������� ������ �������" width="16" height="16" border="0" align="absmiddle" hspace="3"></a>';
      else $edit="";
 
	
	@$disp.='
	<tr valign="top" bgcolor="ffffff" onmouseover="show_on(\'r'.$id.'\')" id="r'.$id.'" onmouseout="show_out(\'r'.$id.'\')"  onclick="" class="row">
    <td class=forma valign="middle" align="center">'.$id.'</td>
	<td class=forma valign="middle" align="center" >'.dataV($datas,"shot").' </td>
    <td class=forma valign="middle" align="center">'.$edit.$name.'</td>
	<td class=forma valign="middle" align="center" >'.$sum.' </td>
</tr>
	';
    @$i++;
    }
if($i>30)$razmer="height:600;";
$_Return=('
<div id=interfacesWin name=interfacesWin align="left" style="width:100%;'.@$razmer.';overflow:auto"> 
<table width="100%"  cellpadding="0" cellspacing="0"
<tr>
	<td valign="top" style="padding-left:10px">

<table cellpadding="0" cellspacing="1" width="100%" border="0" class="sortable" id="sort">
<tr>
    <td width="100" id="pane" align="center">
	<img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>� ������</span></td>
    <td width="15" id="pane" align="center">
	<img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>�����������</span></td>
	<td width="200" id="pane" align="center">
	<img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>������� ��������</span></td>
	<td id="pane" align="center"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>����� '.GetIsoValutaOrder().'</span></td>
</tr>
'.@$disp.'
</table>
</table>
</div>
 ');
return $_Return;
}
?>