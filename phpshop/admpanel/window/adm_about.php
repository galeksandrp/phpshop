<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");

require("../enter_to_admin.php");
require("../class/xml.class.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");



// ����� �����
function GetFile($dir){
global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "lic")
		  return $SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
}

// ���� �������� ���. ���������
$GetFile=GetFile("../../../license/");
@$License=parse_ini_file("../../../".$GetFile,1);
$TechPodUntilUnixTime = $License['License']['SupportExpires'];
$TechPodUntil=dataV($TechPodUntilUnixTime,"update");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>� ���������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,670,530);
</script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">

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

<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>� ���������</span> <?= $ProductName?></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������ ������� � ������������ ����������</span>.
	</td>
	<td align="right">
	<img src="../img/i_addremove_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table cellSpacing=0 cellPadding=0 width="100%">
<tr>
	<td>

<TABLE cellSpacing=0 cellPadding=0 width="100%">
<TR>
<TD vAlign=top >
<table width="100%" cellpadding="0" cellspacing="1" height="100%">
<tr>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>������</span></td>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>������</span></td>
</tr>
<tr bgcolor="#ffffff">
	<td>AdminPanel</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Engen</td>
	<td>2.1.6</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Parser</td>
	<td>2.1.6</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Baner</td>
	<td>2.1.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Order</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Links</td>
	<td>2.0.5</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Map</td>
	<td>2.0.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Search</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Catalog</td>
	<td>2.0.5</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Cache</td>
	<td>2.1.8</td>
</tr>
<tr bgcolor="#ffffff">
	<td>News</td>
	<td>2.0.3</td>
</tr>
<tr bgcolor="#ffffff">
	<td>Display</td>
	<td>2.1.8</td>
</tr>
<tr>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>���������</span></td>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>����</span></td>
</tr>
<tr bgcolor="#ffffff">
	<td><span name=txtLang id=txtLang>���������</span></td>
	<td>
	<?=$TechPodUntil;?>
	</td>
</tr>
</table>
<div align="center" style="padding:10">
<a href="http://www.phpshop.ru/docs/techpod.html" target="_blank" style="color:blue" title="������� �� ���� ������������ ��� ��������� ����������"><span name=txtLang id=txtLang>����������� ����������� ���������</span></a>
</div>
</td>
	<td valign="top">
<table cellSpacing=0 cellPadding=0 width="100%">
<tr>
   <td id=pane align=center>
   <img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>������������ ����������</span>:
   </td>
</tr>
<tr>
	<td>
	<div style="width:98%;HEIGHT: 290;overflow:auto;background-color:#ffffcc;padding:5px">
	<span id=license>
	<P>��������� ������������ ���������� (�����, ����������) �������� ��������� ����� ���� � ��������� �PHPShop� (�����, �����). ���������� ��������� �� ���� ����������� ���������������� ������� � ������������ ������������ �������� PHPShop. 
<P>1. ����������� ������� PHPShop (�����, �������) ������������ ����� ��� ��������� �������� ��������, ���������������� � ������ ��� �� ������, ������� ����������� ��� ������������� ������������, � ����� ����� ������� ����������. 
<P>2. ������� �������� ��������������� � ���, ��� �� ������������ � ����������� ����������, ���������� ��� ���������, � ������ ������������ ������� �� �������� ������� ����������. 
<P>3. ���������� �������� � �������� ���� ��������������� � ������ ������� ��������, �.�. ��������� ���� �������� ����������� ����������� ������� �������� ������ ���� �� ���������� ���������, �� ���������� ������. 
<P>4. ��� ��������� ����� �� ������� ����������� ������. ������� � ����� ��� �� ����������� �������� �������� ���������� ����� � �������� ������ �������� ����������� � �������������� ���������������� �� ��������� ������������� � ��������������� ����������� ��������� ��� ��� "PHPShop" � 2006614274. <b>����� ��������� �� ����� ����� ��������� ���������� �������� ������<SUP style="font-weight:normal">(1)</SUP> � ��������� ���������� ����� �� �����, ��� ������������ �������</b>. ������������� �������� � ���������� ������� ������� ����������, �������� ���������� ������� �� ��������� �����, � ����� �������������� � ������������ � ����������� �����������������. <b>����� �� ���������� �������� ������ � ��������� ���������� ����� �������� ���������� ���������� � ������������ ������� � �������������� ����������� ��������� �������.</b>
<P>5. ������� ������������ �� �������� "��� ����" ("AS IS") ��� �������������� �������� ������������������, ������������� �����������, ����������� ������, � ����� ���� ���� ���������� ��� �������������� ��������. ����� �� ����� �����-���� ��������������� �� ���������� ��� ����������� ���������� ����� ���, ����� ���������� ��� ������ ������� ���������� ������������� ��� ������������� ������������� ��������. 
<P>6. <B>������ ���������� ���� ��� ����� �� ������������� ���������������<SUP style="font-weight:normal">(2)</SUP> ����������  ����� ��������  �� ����� web-������� � �������� <br>
������ ������<SUP style="font-weight:normal">(3)</SUP>. ��� ������ ����� ��������� �������� �� ������ ����� web-�������  ������ ���� ����������� ��������� ��������. ����� ��������������� �������� ��� ���������������� �������� ������, ������� ��������������, �������� ���������� ������� ���������� � ������ ��������������� �������� ������������ ����������������.</B> ����������� ����������� �������� � ������������� ���� �������������� ����� �������� ������������� � ����� ������������ ��� �������� ��������� � �������� ���, ��� �������, ��� ����� ����� �� ����� �������� ������� �����. 
<P>7. �� ������ ������� ����� ��������� � �������� ��� �������� �� ������ ����������. ��� ���� ����������� ������������� �������� ������ �������������� � ������������ � ������ ����������� � ��� ������� ���������� ���� ��������� ����. ����� �� ����� ��������������� �� ����������������� �������� � ������ �������� ���� ����� �� �� �� ���� ���������. 
<P>8. ����� �� ����� ���������������, ��������� � ������������ ��� � ���������������� ��� ��������� ��������������� �� ������������� �������� � ��������������� ����� (�������, �� �� �������������, �������� ����� �������� ������� ��������, ������� �� ������� ��� ������� ���������� �����, ��������������� ��� ���������� ���������� ��� ��������������� ������; � �.�.). 
<P>9. ����������� �������� ������� ���������� ����������� � ������ �������� ���� ���� ���������� ������ � ������������, � ��� �� �� �����. ����������� �������� ������� ���������� �� ��������� ������ ���������� ��������, ����������� ���� �� ������������ ��������. 
<p>10. ������ ������������� �������� <?=$ProductName?> �� ������� <?=$SERVER_NAME?> �������� "<?if(!empty($License['License']['RegisteredTo'])) echo $License['License']['RegisteredTo'];
 else echo "Trial NoName";
?>"</p>

<p>
<strong>���������:</strong><br><br>
1.	��� ������ � ���������� ������ �������� �������, ��� ������ �� ��������� ���������. � ����� ���������� ������������ � ������������ �������� �������� ��������� ����� ������ (�������� ���������). <strong>��� ����������� ��������� �������� ������� �������� ��� ���������� ������</strong>. ������ � ����� ������ ����������� � ������������ � ������� ���������� � ������� ��� ��� ����� ������ �������� �����. �������� ��� ���������� ������ �������������� ��������, ��������� ����� �������� ����������� �����������.
<p>
2. ������ ������ Enterprise � Enterprise Pro ������������ ���������� � ���������� ����������. ������ Start � Catalog, Catalog Pro ������������ ���������� ������ � �������� ����� ��� ���������.
</p>
<p>3. ������� � ���� ���������� � �������� ������ ������ seamply.ru. 
�������� ��������� ���������� ���� seamply.ru/market1/, seamply.ru/market2/ � �.�.<br>
���������� ���� market1.seamply.ru � �.�. ������� ������� ��������� ��������. ����������� ��������� ���������������� ������ �� ���� ����� ��������, ������������ ���������� ��� ����������� ��������� � �������� ����������. ��� ������� ������ ���������� �������� ��������� ������� ����� ����������� ��������� �� �������.</p>
</p>

</span></div>
<br>
<input type="checkbox" checked disabled><span name=txtLang id=txtLang>� �������� ������� ������������� ����������</span>
	</td>
</tr>
</table>
</td>
</tr>
</table>
<hr>
<table width="100%" cellpadding="0" cellpadding="0">
<tr>
   <td style="padding-left:10px">
   <?
   if($License['License']['RegisteredTo']=="Trial NoName"){
   ?>
   <BUTTON style="width: 15em; height: 2.2em; margin-top:5" type=submit onClick="window.open('http://www.phpshop.ru/order/2.html','_blank');" name="btnLang"><img src="../icon/key_add.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">������ ��������</BUTTON>
<?}?>
</td>
	<td align="right" style="padding:10">	<BUTTON style="width: 7em; height: 2.2em; margin-top:5" type=submit onClick="return onCancel();" name="btnLang">�������</BUTTON></td>
</tr>
</table>

</body>
</html>
