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
	<title>�������������� ������</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,630,570);
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
<?
function Disp_num($uid)// ����� ��������� � ������
{
global $table_name17;
$sql="select num from $table_name17 where id=$uid";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$num=$row['num'];
for($i=1;$i<=10;$i++)
  {
	if ($i==$num)
	   {
	   $sel="selected";
	   }
	   else
	      {
		  $sel="";
		  }
    @$dis.="<option value=\"$i\" $sel>$i</option>";
  }
@$disp="
<select name=num_new size=1 class=s>
$dis
</select>
";
return @$disp;
}

if(isset($id))// �������������� ������� �����
	  {
	  $sql="select * from $table_name17 where id='$id'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	$id=$row['id'];
	$name=$row['name'];
	$image=$row['image'];
	$opis=$row['opis'];
	$link=$row['link'];
	$num=$row['num'];
	if ($row['enabled']==1)
	   {
	   $sel="checked";
	   }
	   else
	      {
		  $sel2="checked";
		  }
	  ?>
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������������� ������</span> "<?=$name?>"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_register_domain_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr valign="top">
	<td>
	<FIELDSET >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
<div style="padding:10">
	<textarea name="name_new" style="width: 590;height:30"><?=@$name?></textarea><br><br>
	<span name=txtLang id=txtLang>������</span>:<br>
	<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" name="link_new" value="<?=@$link?>" style="width: 430;"></td>
	<td width="10">&nbsp;</td>
	<td><input type="button" name="btnLang" value="������� �� ������" onclick="javascript:window.open('<?=@$link?>','_blank')"></td>
</tr>
</table>

	
	<br>
	<table>
<tr>
	<td width="150">
<input type="radio" name="enabled_new" value="1" <?=@$sel?>><span name=txtLang id=txtLang>����������</span><br>
<input type="radio" name="enabled_new" value="0" <?=@$sel2?>><span name=txtLang id=txtLang>�� ����������</span>
	</td>
	<td valign="top">
	<span name=txtLang id=txtLang><u>�</u>������ ������</span>: <?echo Disp_num($id);?> * <span name=txtLang id=txtLang>������� ������ �� ������������������ ������������ ������</span>
	</td>
</tr>
</table>

</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="3">
	<FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
<div style="padding:10">
<textarea name="opis_new" class=s style="width:590; height:50"><?=$opis?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="3">
	<table>
<tr>
	<td>
<FIELDSET id=fldLayout style="width: 10em;height: 8em;">
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
<div style="padding:10">
<?=@$image?>
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET id=fldLayout style="height: 8em;">
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�� ������</span></LEGEND>
<div style="padding:10">
<textarea name="image_new" class=s style="width:460; height:50"><?=@$image?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
</table>

	
	</td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
	<input type="hidden" name="id" value="<?=$id?>" >
	<input type="submit" name="editID" value="OK" class=but>
	<input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
    <input type="hidden" class=but  name="productDELETE" id="productDELETE">
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?
      }
if(isset($editID))// ������ ��������������
{
if(CheckedRules($UserStatus["links"],1) == 1){
$sql="UPDATE $table_name17
SET
name='$name_new',
image='$image_new',
opis='$opis_new',
link='$link_new',
num='$num_new',
enabled='$enabled_new'
where id='$id'";
$result=mysql_query($sql)or @die("".mysql_error()."".$sql);
echo"
	  <script>
DoReloadMainWindow('links');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// �������� ������
{
if(CheckedRules($UserStatus["links"],1) == 1){
$sql="delete from $table_name17
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('links');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
} 
?>



