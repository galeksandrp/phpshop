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
	<title>�������� ��������� ������������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,600,410);
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
	<b><span name=txtLang id=txtLang>�������� ������ ��������� ������������</span></b><br>
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

	<FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������� ���������</span></LEGEND>
	<div style="padding:10">
	<input type=text name="Subject_new"  style="width: 100%" value="">
	</FIELDSET>
</TD>
<TD>
	<FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>��� ���������</span></LEGEND>
	<div style="padding:10">
	<input type=HIDDEN name="DateTime_new" value="<?=date("Y-m-d H:i:s")?>">
	<input readonly disabled type=text style="width: 100%" value="<?=date("Y-m-d H:i:s")?>">
	</FIELDSET>

</TD>
</TR><TR>     <TD colspan=2>

	<FIELDSET style="width:100%; height:80px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>���� ���������</span></LEGEND>
<div style="padding:10">
<textarea cols="" rows="" name="Message_new" style="width:100%;height:100px;">
</textarea>

<?
/*
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
	echo "<script language=JavaScript src='../editor3/scripts/editor.js'></script>";
else
	echo "<script language=JavaScript src='../editor3/scripts/moz/editor.js'></script>";


$GetSystems=GetSystems();
$systems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$MyStyle=$SysValue['dir']['dir'].chr(47)."phpshop".chr(47)."templates".chr(47).$systems['skin'].chr(47).$SysValue['css']['default'];
if($option['editor_enabled']  == 1){
echo'
<pre id="idTemporary" name="idTemporary" style="display:none">
'.$kratko.'
</pre>
	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
		oEdit1.cmdAssetManager="modalDialogShow(\'../../editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit1.width=610;
		oEdit1.height=200;
		oEdit1.btnStyles=true;
		oEdit1.css="'.$MyStyle.'";
		oEdit1.RENDER(document.getElementById("idTemporary").innerHTML);
	</script>
	<input type="hidden" name="EditorContent" id="EditorContent">
</div>
	';}
	else{
echo '
<textarea name="EditorContent" id="EditorContent" style="width:100%;height:100px">'.$kratko.'</textarea>
';
}

//*/

?>


</div>
</FIELDSET>



	</td>
</tr>


</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
    <td align="left" style="padding:10">
	<?
if(isset($UID)) {//�������� ��������� ������������
$UsersId=$UID;
$sql="select * from ".$SysValue['base']['table_name27']." where id=$UsersId LIMIT 0, 1";
$result=mysql_query($sql);
@$row = mysql_fetch_array($result);
$id=$row['id'];
$login=$row['login'];
$password=$row['password'];
$status=$row['status'];
$mail=$row['mail'];
$name=$row['name'];
$company=$row['company'];
$inn=$row['inn'];
$tel=$row['tel'];
$adres=$row['adres'];
}
echo "<BUTTON style=\"width: 11em; height: 2.2em; margin-left:5\"  onclick=\"GetMailTo('".$mail."','Re: ".$GetSystems['name']."');return false;\"> <img src=\"../img/icon_email.gif\"  border=\"0\" align=\"absmiddle\" hspace=\"5\">E-mail</BUTTON>";
?>
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

if(isset($UID) and !empty($Message_new))// ������ ��������������
{
if(CheckedRules($UserStatus["delivery"],2) == 1){
/*
echo 'q'.$EditorContent.'q<BR>';
print_r($_POST).'SD';
//*/


$sql='INSERT INTO '.$SysValue['base']['table_name37'].'
VALUES ("",0,'.$UID.','.$_SESSION['idPHPSHOP'].',\''.$DateTime_new.'\',\''.$Subject_new.'\',\''.$Message_new.'\',"1")';
$result=mysql_query($sql)or @die("".mysql_error()."");

  
	  

$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$LoadItems['System']['adminmail2'].">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." -  ��������� �� ��������������";
$content_adm="
������� �������!
--------------------------------------------------------

��������� ��������� �������������� � ��������-�������� '".$LoadItems['System']['name']."'
---------------------------------------------------------

".TotalClean($Message_new,2)."

����/�����: ".date("d-m-y H:i a")."
---------------------------------------------------------

�� ������ ������ ����������� ���� ���������
��-���� ����� '������ �������' -> '����� � ����������' 
��� �� ������ http://".$SERVER_NAME.$SysValue['dir']['dir']."/users/message.html

Powered & Developed by www.PHPShop.ru";
mail($mail,$zag_adm, $content_adm, $header_adm);



echo'
<script>
CLREL("right");
</script>
	   ';
//*/

}else $UserChek->BadUserFormaWindow();
}
?>



