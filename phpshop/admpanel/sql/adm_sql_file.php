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
	<title>������ � �����</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,500,430);
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
echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>������ � �����</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������� ��� MySQL</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_databases_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
<br>
";
if(@$sql_file){
if(CheckedRules($UserStatus["sql"],1) == 1){
@copy("$csv_file","../csv/$csv_file_name");
@$fp = fopen("../csv/$csv_file_name", "r");

  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  //$CsvContent=addslashes($CsvContent);
  //$CsvContent=str_replace("`", "", $CsvContent);
  //$CsvContent=str_replace("\"", "", $CsvContent);
  //$CsvContent=addslashes($CsvContent);
  //$CsvContent=str_replace("\r\n","", $CsvContent);
  //$CsvContent=addcslashes($CsvContent,"\0..\37");
  fclose($fp);
  }
$IdsArray2=split(";\r",$CsvContent);
array_pop($IdsArray2);
while (list($key, $val) = each($IdsArray2))
$result=mysql_query($val);

if(@$result) $disp= "><strong> MySQL: ������ ��������.</strong>";
else $disp="<strong>> MySQL: </strong>".mysql_error()."";
echo ('
<div align="left" style="width:100%;height:250;overflow:auto;">
<table bgcolor="white" style="border: 2px;
	border-style: inset;" width="100%"  cellpadding="0" cellspacing="0" height="250">
<tr>
	<td style="padding:5" valign="top">
	'.@$disp.'
	</td>
</tr>
</table>

</div>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50">
<tr>
	<td align="right" style="padding:10">
<input type=submit value=��������� class=but onClick="history.back(1);" name="btnLang2">
<input type=submit value=������� class=but onClick="return onCancel();" name="btnLang2">
	</td>
</tr>
</table>

');
}else $UserChek->BadUserFormaWindow();
}
else{

while (list($val) = each($SysValue['base']))
@$bases.=$SysValue['base'][$val].", ";

$bases=substr($bases,0,strlen($bases)-2);
$bases2=ereg_replace("phpshop_system","",$bases);
?>
<TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
<FORM method="post" name="sql_forma2" id="sql_forma2" encType="multipart/form-data">
<TBODY>
<TR class=adm vAlign=top align=middle>
<TD align=left>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
	<FIELDSET><LEGEND id=lgdLayout><span name=txtLang id=txtLang>�������� SQL</span></LEGEND>
<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 185px; PADDING-TOP: 10px"><span name=txtLang id=txtLang>�������� ���� � �����������</span> *.sql&nbsp;&nbsp; <INPUT type=file size=70 name=csv_file  id=csv_file>
</DIV></FIELDSET>

	</td>
</tr>
</table>
</TD>
</TR>
</TABLE>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50">
<tr>
  <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent('sql_file')">�������</BUTTON></BUTTON>
	</td>
	<td align="right" style="padding:10">
<INPUT class=but onclick="SqlSend2()" type=button value=OK> 
<INPUT class=but type=reset value=����� name="btnLang"> 
<input type="hidden" name="sql_file" value="ok">
<input type=submit value=������ class=but onClick="return onCancel();" name="btnLang">
	</td>
</tr>
</table>
</FORM>
<?}
?>
</body>
</html>

