<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������� ����� ������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������� ����� ������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_subscription_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td>
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>����</span> </LEGEND>
<div style="padding:10">
<input type="text" name="sum_new"   style="width:100px"> <?=GetIsoValuta()?><br><br>* <span name=txtLang id=txtLang>����� �������� �</span> <?=GetIsoValuta()?>
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>�����</span> </LEGEND>
<div style="padding:10">
<input type="text" name="discount_new"  maxlength="3" style="width:50px;" > %
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" checked><span name=txtLang id=txtLang>��</span><br>
<input type="radio" name="enabled_new" value="0"><font color="#FF0000"><span name=txtLang id=txtLang>���</span></font>
</div>
</FIELDSET>
	</td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
    <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent('discount')">�������</BUTTON></BUTTON>
	</td>
	<td align="right" style="padding:10">
	<input type="submit" name="editID" value="OK" class=but>
	<input type="reset" name="btnLang" class=but value="��������">
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
 <?
if(isset($editID) and !empty($sum_new))// ������ ��������������
{
if(CheckedRules($UserStatus["discount"],2) == 1){
$sql="INSERT INTO ".$SysValue['base']['table_name23']." VALUES ('','$sum_new','$discount_new','$enabled_new')";
$result=mysql_query($sql)or @die("".mysql_error()."");
//$UpdateWrite=UpdateWrite();// ��������� LastModified
echo"
	  <script>
DoReloadMainWindow('discount');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



