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
	<title>�������������� ������� ������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,630,580);
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


// ����� �����
function GetTipPayment($dir){

$path="../../../payment/";

    if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
		     if ($file != "." && $file != "..") {
			   
			   if(is_dir($path.$file)){
			     if($dir == $file) $s="SELECTED"; 
			       else $s="";
			   @$dis.="<option value=$file $s>".TipPayment($file)."</option>";
                 }
			   }
					}
        closedir($dh);
    }

$dis="
<select name=\"path_new\">
$dis
</select>
";
return $dis;
}



// �������������� ������� �����
	  $sql="select * from ".$GLOBALS['SysValue']['base']['table_name48']." where id=$id";
      $result=mysql_query($sql);
	  @$row = mysql_fetch_array(@$result);
	  $id=$row['id'];
      $name=$row['name'];
	  $path=$row['path'];
      $num=$row['num'];
	  if($row['enabled']==1){
	  $fl="checked";
	  }else{
	  $fl2="checked";}
	  $message_header=$row['message_header'];
	  $message=$row['message'];
	  ?>
<form name="product_edit"  method=post onsubmit="Save()">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������������� ������� ������</span> "<?=$name?>"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_visa_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
  <td>
  <FIELDSET>
<LEGEND><span name=txtLang id=txtLang>������������</span></LEGEND>
<div style="padding:10">
<input type="text" name="name_new" value="<?=$name?>" style="width: 100%; "><br><br>
<input type="radio" name="enabled_new" value="1" <?=@$fl?>><span name=txtLang id=txtLang>����������</span>&nbsp;&nbsp;&nbsp;
<input type="radio" name="enabled_new" value="0" <?=@$fl2?>><span name=txtLang id=txtLang>������</span>
</div>
</FIELDSET>
  </td>
  <td valign="top">
  <FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang>��� �����������</span></LEGEND>
<div style="padding:10">
<?=GetTipPayment($path)?><br><br>
����������: <input type="text" name="num_new" value="<?=$num?>" style="width: 30px; ">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td colspan="2">
  <FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������� ��������� ����� ������</span></LEGEND>
<div style="padding:10">
<input type="text" name="message_header_new" value="<?=$message_header?>" style="width:100%"><br>

</FIELDSET>
  </td>
</tr>
<tr>
  <td colspan="2">
  <FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>C</u>�������� ����� ������</span></LEGEND>
<div style="padding:10">
<textarea name="message_new" style="width:100%;height: 150px"><?=$message?></textarea>

</FIELDSET>
  </td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
    <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent('payment')">�������</BUTTON></BUTTON>
	</td>
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
if(isset($editID) and @$name_new!="")// ������ ��������������
{
if(CheckedRules($UserStatus["visitor"],1) == 1){
$sql="UPDATE ".$GLOBALS['SysValue']['base']['table_name48']."
SET
name='$name_new',
path='$path_new',
num='$num_new',
enabled='$enabled_new',
message='$message_new',
message_header='$message_header_new'
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('payment');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// �������� ������
{
if(CheckedRules($UserStatus["visitor"],2) == 1){
$sql="delete from ".$GLOBALS['SysValue']['base']['table_name48']."
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('payment');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



