<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������� ��������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,600,500);
function DoSet(){
var sum=document.getElementById('taxa').value;
if (sum>0) {document.getElementById('taxa_enabled').checked=true;} else {document.getElementById('taxa_enabled').checked=false;}
}


</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">
<table id="loader">
<tr>
	<td valign="middle" align="center">
		<div id="loadmes" onclick="preloader(0)">
<table width="100%" height="100%">
<tr>
	<td id="loadimg"></td>
	<td ><b><?=$SysValue['Lang']['System']['loading']?></b><br><?=$SysValue['Lang']['System']['loading2']?></td>
</tr>
</table>
		</div>
</td>
</tr>
</table>
<SCRIPT language=JavaScript type=text/javascript>preloader(1);</SCRIPT>
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������� ������ ������ ��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_mail_forward_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td>
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>���� ��������</span></LEGEND>
<div style="padding:10">
<textarea cols="" rows="" name="city_new" style="width:160px"></textarea><br>
<input type="checkbox" name="flag_new" value="1"><span name=txtLang id=txtLang>�������� �� ���������</span>
</div>
</FIELDSET>

	<FIELDSET style="height:20px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>������� ��������</span></LEGEND>
<div style="padding:10">

<select name="NPID">
<option value="0" selected>[������]</option>
<?
// �������
function DelivSelList ($cid,$PID,$nPID=0,$lvl=0) {
global $SysValue;

$sql='select * from '.$SysValue['base']['table_name30'].' where PID='.$nPID.' order by city';
//$display=$sql;
$result=mysql_query($sql);
$lvl++;
while ($row = mysql_fetch_array($result))
    {
	$nid=$row['id'];
	if ($nid==$cid) {continue;}

	$nPID=$row['PID'];
	$city=$row['city'];
	$spacer='';
	for ($ii=1;$ii<$lvl;$ii++) {
		$spacer.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	if ($lvl>1) {$pointer='|&ndash;>&nbsp;';} else {$pointer='';}
        if ($nid==$PID) {$sel='selected';} else {$sel='';}
	@$display.='<option value="'.$nid.'" '.$sel.'>'.$spacer.$pointer.$city.'</option>';
        $display.=DelivSelList ($cid,$PID,$nid,$lvl);
	}

return $display;

} //����� DelivList
	echo DelivSelList ($id,$PID);
?>


</select>
</div>
</FIELDSET>


	</td>
	<td>
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span> </LEGEND>
<div style="padding:10">
<input type="text" name="price_new"  style="width:50px;" > <?=GetIsoValutaOrder()?>
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" checked><span name=txtLang id=txtLang>��</span><br>
<input type="radio" name="enabled_new" value="0"><font color="#FF0000"><span name=txtLang id=txtLang>���</span></font>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
  <td colspan="3">
  <FIELDSET>
<LEGEND><input type="checkbox" name="price_null_enabled_new" value="1"  <?=@$f4?>> <span name=txtLang id=txtLang><u>�</u>��������� ��������</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>�����</span> <input type="text" name="price_null_new" value="<?=$price_null?>" style="width:100px;" > <?=GetIsoValutaOrder()?> <span name=txtLang id=txtLang>�������� ���������</span>
</div>
</FIELDSET>
  </td>
</tr>

<tr>
  <td colspan="3">
  <FIELDSET>
<LEGEND><input type="checkbox" id="taxa_enabled" name="taxa_enabled" value="1" disabled> <span name=txtLang id=txtLang>������������ <u>�</u>���� �� ������ 0.5�� ����. (����� <B>��������</B> ���������� �������� � ���� ������ 0)</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>������������ ��� ������� �������������� ����������� (��������, ��� "����� ������")<BR>������ �������������� 0.5 �� ����� ������� 0.5�� ����� ������ </span> <input type="text" name="taxa_new" id="taxa" value="0" style="width:100px;" onChange="DoSet();"> <?=GetIsoValutaOrder()?> 
</div>
</FIELDSET>
  </td>
</tr>


</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
	<input type="submit" name="editID" value="OK" class=but>
	<input type="reset" name="btnLang" class=but value="��������">
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?

if(isset($editID) and !empty($city_new))// ������ ��������������
{
if(CheckedRules($UserStatus["delivery"],2) == 1){
$sql="INSERT INTO ".$SysValue['base']['table_name30']."
VALUES ('','$city_new','$price_new','$enabled_new','$flag_new','$price_null_new','$price_null_enabled_new','$NPID','$taxa_new')";
$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
	  <script>
DoReloadMainWindow('delivery');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



