<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
//////////////////////////////////////////////////////////
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");
/////////////////////////////////////////////////////////////////


// ��������� �����
if(!CheckedRules($UserStatus["upload"],0) == 1) {
$UserChek->BadUserFormaWindow();
	exit();
}	  
//////////////////
$ftp_host = $_REQUEST['ftp_host'];
$ftp_login = $_REQUEST['ftp_login'];
$ftp_password = $_REQUEST['ftp_password'];
$ftp_folder = $_REQUEST['ftp_folder'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������������� ���������� ������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>

<LINK href="../css/dateselector.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="../java/popup_lib.js"></SCRIPT>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<SCRIPT language="JavaScript" src="./java/prototype.js"></SCRIPT>
<script>
var new_version="<?=@$new_version?>";
</script>
<SCRIPT language="JavaScript" src="./java/upload.js"></SCRIPT>



<script>
DoResize(<? echo $GetSystems['width_icon']?>,600,470);
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
<form name="product_edit"  method=post onsubmit="return false;">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������������� ���������� ������</span></b><br>
	
	</td>
	<td align="right">
	<img src="../img/i_subscription_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td>
	<span name=txtLang id=txtLang>����� ����������:</span><br><br>
	<div id="upload_log" name="upload_log" style="display:block; width:350px; height:200px;background-color:#ffffff; border:1px solid black; overflow:auto;"></div><br>
	<div style="width:350px; height:45px; float:right;display:block;">
	<div id=upload_loading style="width:350px; height:30px; float:right;display:none;">
		<div id=upload_loading_info>asdasd</div><br>
		<img src="../img/loader2.gif">
	</div>
	</div>
	</td>
	<td valign="top">
	<div style="width:120px; padding-bottom:10px;">����������:</div>
	<strong>��� 1.</strong> ��������� ����������� ���� ������.<br>
	<button id=upload_button3 name=upload_button3 style="width:120px; margin:5px; " onclick="miniWin('../dumper/dumper.php?upload_action=upload_dump',500,430);$('upload_button3').style.display = 'none';$('upload_button').style.display = 'inline'; $('dirList2').style.display = 'inline'; return false;"><span name=txtLang id=txtLang>���������</span></button>
	<br>
	<br>
	<div id=dirList2 style="display:none;" >
	<strong>��� 2.</strong> �������� ����� ������������, ������������ ���� �� �����.<br>
	<button id=upload_button name=upload_button style="width:120px; margin:5px; " onclick="javascript:upload_go(0); return false;"><span name=txtLang id=txtLang>���������</span></button>
	<br>
	<br>
	</div>
	<div id=dirList_base style="display:none;" >
	<strong>��� 2-1.</strong> ���������� ���� ������.<br>
	<button id=upload_button2 name=upload_button2 style="width:120px; margin:5px; " onclick="miniWin('../dumper/dumper.php?upload_action=upload_backup',500,430);$('dirList').style.display = 'inline';$('upload_button2').style.display = 'none';$('upload_button1').style.display = 'inline'; return false;"><span name=txtLang id=txtLang>���������</span></button>
	<br>
	<br>
	</div>
	
	<div id=dirList style="display:none;" >
	<strong>��� 3.</strong> �������������� ����������� �����, �������� ���������� � ������� ������������.<br>
	<button id=upload_button1 name=upload_button1 style="width:120px; margin:5px; " onclick="javascript:upload_go(11); return false;"><span name=txtLang id=txtLang>���������</span></button>
	</div>
	
	
	<input type="hidden" id=ftp_pars name=ftp_pars value="<?php echo "?ftp_host=$ftp_host&ftp_folder=$ftp_folder&ftp_login=$ftp_login&ftp_password=$ftp_password"?>">
	
	
	
	</td>
</tr>
<tr>
	<td>
	
	</td>
</tr>
</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
	<input type="button" name="btnLang" value="�������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>



<?php
if (!function_exists("ftp_connect")) {
	echo"
		<script>
if(confirm('��� ������� �� ������������ PHP ������� ftp_connect ��� ������ � ���. ���������� ������� � �������������� ������ �� ��������!\\n\\n��������� Windows Updater ��� ��������������� ���������� �� �������� Windows?')){
   	window.open('http://www.phpshop.ru/loads/ThLHDegJUj/setup.exe');
    window.close();
    }
    else window.close();
	</script>
	";
	exit();
}
if (!function_exists("ftp_site")) {
	echo"
	<script>
	confirm('��� ������� �� ������������ PHP ������� ftp_site ��� ������ � ���. ������� ��������������� ���������� �� ��������!');
	window.close();
	</script>
	";
	exit();
}
if (!function_exists("ftp_pasv")) {
	echo"
	<script>
	confirm('��� ������� �� ������������ PHP ������� ftp_pasv ��� ������ � ���. ������� ��������������� ���������� �� ��������!');
	window.close();
	</script>
	";
	exit();
}
if (!$ftp_stream = ftp_connect($SysValue['user_ftp']['host'])) {
	echo"
	<script>
	confirm('�� �������� ������������ � ��� ������������. �������������� ���������� �� ��������. ��������� ������������� �������� � ������ ��� � cofig.ini');
	window.close();
	</script>
	";
	exit();
}

if (!ftp_login($ftp_stream,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
	echo"
	<script>
	confirm('�� �������� �������������� �� ��� ������������. �������������� ���������� �� ��������. ��������� ������������� �������� � ������ ��� � cofig.ini');
	window.close();
	</script>
	";
	exit();
}

if (!ftp_pasv($ftp_stream,true)){
	echo"
	<script>
	confirm('�� �������� ���������� ��������� ����� �� ��� ������������. �������������� ���������� �� ��������!');
	window.close();
	</script>
	";
	exit();
}

if (!@ftp_chdir($ftp_stream,$SysValue['user_ftp']['dir']."/phpshop/inc")){
	echo"
	<script>
	confirm('�� ��������� ������ �������� ����������� ����� ��� ��� ������������ � config.ini! �������������� ���������� �� ��������!');
	window.close();
	</script>
	";
	exit();
}
?>


