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

function Disp_num($uid)// ����� ��������� � ������
{
global $table_name14;
$sql="select * from $table_name14 where id='$uid'";
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
    @$dis.="
	<option value=\"$i\" $sel >$i</option>
    ";
  }
@$disp="
<select name=num_new size=1 class=s>
$dis
</select>
";
return @$disp;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������������� ����</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<?
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
	echo "<script language=JavaScript src='../editor3/scripts/editor.js'></script>";
else
	echo "<script language=JavaScript src='../editor3/scripts/moz/editor.js'></script>";
?>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,630,610);
</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">
<?
	  // �������������� ������� �����
	  $sql="select * from $table_name14 where id=$id";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  $id=$row['id'];
	  $name=$row['name'];
	  $content=stripslashes($row['content']);
	  $num=$row['num'];
	  $dir=$row['dir'];
	  $element=$row['element'];
	if($row['flag']==1){
	$fl="checked";
	}else{
	$fl2="checked";}
	
	if($row['element']==0){
	$s1="selected";
	}else{
	$s2="selected";}
	  ?>
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
<form name="product_edit"  method=post onsubmit="Save()">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������������� �����</span> "<?=$name?>"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_select_another_account_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">

  <td colspan="2">
 <FIELDSET >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������� ����</span></LEGEND>
<div style="padding:10"> 
<table>
<tr>
<td>

<input type="text" name="name_new" value="<?=$name?>" size="50">

	</td>
	<td width="10"></td>
	<td>
	<span name=txtLang id=txtLang><u>�</u>������</span>: 
<?echo Disp_num($id);?>
	</td>
	<td width="10"></td>
	<td>
		<span name=txtLang id=txtLang><u>�</u>�����������</span>: 
<select name=element_new size=1 class=s>
<option value="0" <?=$sl?> id=txtLang>�����</option>
<option value="1" <?=$s2?> id=txtLang>������</option>
</select>
	</td>
</tr>
</table>

<input type="radio" name="flag_new" value="1" <?=@$fl?>><span name=txtLang id=txtLang>���������� ����</span>&nbsp;&nbsp;&nbsp;
<input type="radio" name="flag_new" value="0" <?=@$fl2?>><span name=txtLang id=txtLang>������ ����</span>
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td colspan="2">
  <FIELDSET >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������� � ��������</span></LEGEND>
<div style="padding:10">
<input type="text" name="dir_new" value="<?=$dir?>" style="width:100%"><br>
<span name=txtLang id=txtLang>* ������: page/,news/. ����� ������� ��������� ������� ����� �������.</span>
</FIELDSET>
  </td>
</tr>
<tr>
<tr>
	<td colspan="3">
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>������</span></LEGEND>
<div style="padding:10">
<?
$systems=GetSystems();
$option=unserialize($systems['admoption']);
if($option['editor_enabled']  == 1){
$MyStyle=$SysValue['dir']['dir'].chr(47)."phpshop".chr(47)."templates".chr(47).$systems['skin'].chr(47).$SysValue['css']['default'];
echo'
<pre id="idTemporary" name="idTemporary" style="display:none">
'.$content.'
</pre>
	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	oEdit1.cmdAssetManager="modalDialogShow(\''.$SysValue['dir']['dir'].'/phpshop/admpanel/editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit1.width=600;
		oEdit1.height=200;
		oEdit1.btnStyles=true;
	    oEdit1.css="'.$MyStyle.'";
		oEdit1.RENDER(document.getElementById("idTemporary").innerHTML);
	</script>
	<input type="hidden" name="EditorContent" id="EditorContent">
	';
	}
else{
echo '
<textarea name="EditorContent" id="EditorContent" style="width:100%;height:200px">'.$content.'</textarea>
';
}
	?>
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
if(CheckedRules($UserStatus["page_menu"],1) == 1){
$sql="UPDATE $table_name14
SET
name='$name_new',
content='".addslashes($EditorContent)."',
flag='$flag_new',
num='$num_new',
dir='$dir_new',
element='$element_new'
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('page_menu');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// �������� ������
{
if(CheckedRules($UserStatus["page_menu"],1) == 1){
$sql="delete from $table_name14
where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('page_menu');
</script>
	   ";
}else $UserChek->BadUserFormaWindow();
}
?>



