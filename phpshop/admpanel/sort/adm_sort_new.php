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
	<title>�������� ������ �������������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,500,400);
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
	<b><span name=txtLang id=txtLang>�������� ����� ��������������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>�����������</span> </LEGEND>
<div style="padding:10">
<input type="text" name="name_new" class="full">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
<div style="padding:10">
<textarea class=full name=description_new style="height:40px"><?=$description?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td>
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>���� </span></LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" name="flag_new"> <span name=txtLang id=txtLang>���������� 3-�� ������</span>&nbsp;&nbsp;&nbsp;
<input type="checkbox" value="1" name="filtr_new"><span name=txtLang id=txtLang>������</span>
<input type="checkbox" value="1" name="goodoption_new"><span name=txtLang id=txtLang>�������� �����</span>
<input type="checkbox" value="1" name="optionname_new"><span name=txtLang id=txtLang>���������� �������� ����� � �������</span>
</div>
</FIELDSET>
	</td>
	</td>
	<td>
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>������</span> </LEGEND>
<div style="padding:10">
<input type="text" name="num_new" class="full">
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
if(isset($editID) and !empty($name_new))// ������ ��������������
{
if(CheckedRules($UserStatus["cat_prod"],2) == 1){
$sql="INSERT INTO ".$SysValue['base']['table_name20']." VALUES ('','$name_new','$flag_new','$num_new','-1','$filtr_new','$description_new','$goodoption_new','$optionname_new')";
//goodoption='$goodoption_new',
$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
	 <script>
DoReloadMainWindow('sort');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



