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
	<title>�������������� ��������������</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,500,370);
</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<?

function Disp_cat($n)// ����� ��������� � ������
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name20']." order by name";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=substr($row['name'],0,35);
	if ($id==$n)
	   {
	   $sel="selected";
	   }
	   else
	      {
		  $sel="";
		  }
    @$dis.="<option value=\"$id\" $sel>$name</option>\n";
	}
@$disp="
<select name=category_new size=1>
$dis
</select>
";
return @$disp;
}


// �������������� �������
	  $sql="select * from ".$SysValue['base']['table_name21']." where id='$id'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  $id=$row['id'];
	  $name=$row['name'];
	  $category=$row['category'];
	  $num=$row['num'];
	  ?>
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b>�������������� �������������� "<?=$name?>"</b><br>
	&nbsp;&nbsp;&nbsp;������� ������ ��� ������ � ����.
	</td>
	<td align="right">
	<img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><u>�</u>�������������</LEGEND>
<div style="padding:10">
<input type="text" name="name_new" value="<?=$name?>" class="full">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="2">
	<FIELDSET>
<LEGEND><u>�</u>��������</LEGEND>
<div style="padding:10">
<?=Disp_cat($category);?>
</div>
</FIELDSET>
	</td>
</tr>
</tr>
<tr>
  <td>
    <FIELDSET>
<LEGEND><u>�</u>������ �� �������</LEGEND>
<div style="padding:10">
<input type="text" name="num_new" value="<?=$num?>" class="full">
</div>
</FIELDSET>
  </td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
<input type="hidden" name="id" value="<?=$id?>" >
	<input type="submit" name="editID" value="OK" class=but>
	<input type="button" class=but value="�������" onClick="PromptThis();">
    <input type="hidden" class=but  name="productDELETE" id="productDELETE">
	<input type="button" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?
if(isset($editID) and !empty($name_new))// ������ ��������������
{
if(CheckedRules($UserStatus["cat_prod"],1) == 1){
$sql="UPDATE ".$SysValue['base']['table_name21']."
SET
category='$category_new',
name='$name_new',
num='$num_new'
where id='$id'";
$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
<script>
CLREL();
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// ��������
{
if(CheckedRules($UserStatus["cat_prod"],1) == 1){
$sql="delete from ".$SysValue['base']['table_name21']."
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
CLREL();
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>


