<?
// ��������� ������������ ����
$SysValue=parse_ini_file("../../phpshop/inc/config.ini",1);

// ������� ��
@extract($_GET);
@extract($_POST);
@extract($_FORM);
@extract($_FILES);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<title><?= $SysValue['license']['product_name']?> -> ��������� ����������</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<LINK href="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/css/texts.css" type=text/css rel=stylesheet>
<script>
function Warning(){
return alert("��������!\n�� ������� �������� �������� ��� ������ � ������������ ����� config.ini");
}

function InstallOk(){
window.opener.location.replace("/");
window.close();
}

function Readonlys(){
return alert("��������!\n������ ��������������� ������ � ����� config.ini");
}

function ChekRegLic(){
var s1=window.document.forms.regForma.selectLic.checked;
if(s1 == false){
  if(confirm("��������!\n��  �������� �  ������������ �����������?"))
     window.document.forms.regForma.selectLic.checked = true;
	 }
         else document.regForma.submit();
}

</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b>���������� ��������-�������� <?= $SysValue['license']['product_name']?></b><br>
	&nbsp;&nbsp;&nbsp;������ ���������� (������ 0.1).
	</td>
	<td align="right">
	<img src="<?=$SysValue['dir']['dir']?>/phpshop/admpanel/img/i_server_info_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<?


// ���������� ������
include("../../".$SysValue['file']['error']);            // ������ ������

// ����� �����
function GetFile($dir){
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "sql")
		 $fileBase=$file;
        }
        closedir($dh);
    }
return "./".$dir."/".$fileBase;
}

function GetUpdate($skin){
global $SysValue;
$dir="./";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and is_dir($file))
            @$name.= "<option value=\"$file\" $sel>$file</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"update_dir\">
".@$name."
</select>
";
return @$disp;
}

// ������������� ����
if(@$install == 2){


// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");


$fileBase=GetFile($update_dir);
$lines=file($update_dir."/file.txt");
@$fp = fopen($fileBase, "r");

  if ($fp) {
  stream_set_write_buffer($fp, 0);
  $fstat = fstat($fp);
  $CsvContent=fread($fp,$fstat['size']);
  $CsvContent=eregi_replace("phpshop_",$prefix,$CsvContent);
  fclose($fp);
  }
$IdsArray2=split(";",$CsvContent);
array_pop($IdsArray2);
while (list($key, $val) = each($IdsArray2))
$result=mysql_query($val);
if(@$result){
$disp= "<h4>���������� ���� ������ �������.</h4>
$fileInstr
";
foreach ($lines as $line_num => $line) {
    @$disp2.=htmlspecialchars($line) . "<br>\n";
}
$d="";
}
else {
$disp="<h4>������ ���������: ".mysql_error()." </h4>";
$d="disabled";
}
?>
<TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR>
<TD vAlign=top>
<TABLE cellSpacing=1 cellPadding=5 width="50%" align=center border=0>
<FORM method=post>
<TBODY>
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<div align="center" style="padding:10">
<?=@$disp?>
</div>
</FIELDSET>
<br>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<LEGEND id=lgdLayout ><u>�</u>��������� ������:</LEGEND>
<div style="padding:10;WIDTH:100%;height:250px;overflow:auto">
<?=@$disp2?>
</div>
</FIELDSET>
</TD>
</TR></FORM></TBODY></TABLE></TD></TR></TBODY></TABLE>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:50">
<tr>
   <td><hr></td>
</tr>
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="&laquo; �����" onclick="history.back(1)"> 
<INPUT class=but type=button id="close" value="������" onclick="InstallOk()" <?=$d?>> 
	</td>
</tr>
</form>
</table>
<?
}

elseif(@$install==1){
?>
<div style="padding:5">
<FIELDSET id=fldLayout style="WIDTH: 545;">
<LEGEND id=lgdLayout ><u>M</u>ySQL</LEGEND>
<br>
<table cellSpacing=1 cellPadding=5  border=0 width="100%">
<FORM method="post" name="install">
<tr>
	<td align="right" width="100">����:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly value="<?= $SysValue['connect']['host']?>" name="host"></td>
</tr>
<tr>
	<td align="right">������������:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="user_db" value="<?= $SysValue['connect']['user_db']?>"></td>
</tr>
<tr>
	<td align="right">������ ����:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="pass_db" value="<?= $SysValue['connect']['pass_db']?>"></td>
</tr>
<tr>
	<td align="right">��� ����:</td>
	<td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="dbase" value="<?= $SysValue['connect']['dbase']?>"></td>
</tr>
<tr>
	<td align="right">�������:</td>
	<td align="left"><input type="text" style="width:300" name="prefix" value="phpshop_" onchange="Warning()"></td>
</tr>
</table>
<br>
</FIELDSET>
<br>
<FIELDSET id=fldLayout style="WIDTH: 545;">
<LEGEND id=lgdLayout ><u>�</u>�������� ���������� �� ��� ������:</LEGEND>
<div style="padding:10px">
<? echo GetUpdate("123")?><br><br>
�������� ���� ������� ������ ��.<br>
���� ����� ������ ��� � ������, �� �������������� ������������  � ����� <a href="Update.txt" target="_blank">Update.txt</a> ��� ������� ���������� ���� MySQL.<br><br>
<b>�����: ������� ��������� ����� ���� ����� �������� ����������.</b>
</div>

</FIELDSET>

</div>
<table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:60">
<tr>
   <td><hr></td>
</tr>
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="&laquo; �����" onclick="history.back(1)"> 
<INPUT class=but type=button value="������" onclick="window.close()"> 
<INPUT class=but type="Submit" value="����� &raquo;"> 
<input type="hidden" name="install" value="2">
	</td>
</tr>
</form>
</table>


<?
}
else{

while (list($val) = each($SysValue['base']))
@$bases.=$SysValue['base'][$val].", ";

$bases=substr($bases,0,strlen($bases)-2);
$bases2=ereg_replace("phpshop_system","",$bases);
?>

<TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
<FORM method="post" name="regForma">
<TR class=adm vAlign=top align=middle>
<TD align=left>
<FIELDSET id=fldLayout style="WIDTH: 100%;"><LEGEND id=lgdLayout><u>�</u>����������� ����������</LEGEND>
<DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">
<textarea style="width=99%;height:320">
��������� ������������ ���������� (�����, ����������) �������� ��������� ����� ���� � ��������� �PHPSHOP� (�����, �����). ���������� ��������� �� ���� ����������� ���������������� ������� � ������������ ������������ �������� PHP SHOP. 


1. ����������� ������� PHP SHOP (�����, �������) ������������ ����� �������� ��� ��������� �������� ��������, ���������������� � ������ ��� �� ������, ������� ����������� ��� ������������� ������������, � ����� ����� ������� ����������. 


2. ������� �������� ��������������� � ���, ��� �� ������������ � ����������� ����������, ���������� ��� ���������, � ������ ������������ ������� �� �������� ������� ����������. 


3. ���������� �������� � �������� ���� ��������������� � ������ ������� ��������, �.�. ��������� ���� �������� ����������� ����������� ������� �������� ������ ���� �� ���������� ���������, �� ���������� ������. 


4. ��� ��������� ����� �� ������� ����������� ������. ������� � ����� ��� �� ����������� �������� �������� ���������� ����� � �������� ������ �������� ����������� � �������������� ����������������. ������������� �������� � ���������� ������� ������� ����������, �������� ���������� ������� �� ��������� �����, � ����� �������������� � ������������ � ����������� �����������������. 


5. ������� ������������ �� �������� "��� ����" ("AS IS") ��� �������������� �������� ������������������, ������������� �����������, ����������� ������, � ����� ���� ���� ���������� ��� �������������� ��������. ����� �� ����� �����-���� ��������������� �� ���������� ��� ����������� ���������� ����� ���, ����� ���������� ��� ������ ������� ���������� ������������� ��� ������������� ������������� ��������. 


6. ������ ���������� ���� ��� ����� �� ������������� ������ ����� ����� �������� ��� ����������� ������ ������ �������� �������� �� ����� web-�������. ��� ������ ����� ��������� �������� ������ ���� ����������� ��������� ��������. ����� ��������������� �������� ��� ���������������� �������� ������, ������� ��������������, �������� ���������� ������� ���������� � ������ ��������������� �������� ������������ ����������������. ����������� ����������� �������� � ������������� ���� �������������� ����� �������� ������������� � ����� ������������ ��� �������� ��������� � �������� ���, ��� �������, ��� ����� ����� �� ����� �������� ������� �����. 


7. �� ������ ������� ����� ��������� � �������� ��� �������� �� ������ ����������. ��� ���� ����������� ������������� �������� ������ �������������� � ������������ � ������ ����������� � ��� ������� ���������� ���� ��������� ����. ����� �� ����� ��������������� �� ����������������� �������� � ������ �������� ���� ����� �� �� �� ���� ���������. 


8. ����� �� ����� ���������������, ��������� � ������������ ��� � ���������������� ��� ��������� ��������������� �� ������������� �������� � ��������������� ����� (�������, �� �� �������������, �������� ����� �������� ������� ��������, ������� �� ������� ��� ������� ���������� �����, ��������������� ��� ���������� ���������� ��� ��������������� ������; � �.�.). 


9. ����������� �������� ������� ���������� ����������� � ������ �������� ���� ���� ���������� ������ � ������������, � ��� �� �� �����. ����������� �������� ������� ���������� �� ��������� ������ ���������� ��������, ����������� ���� �� ������������ ��������. 
</textarea>

</FIELDSET> </TD>
</TR>
</TABLE><br>
&nbsp;&nbsp;<input type="checkbox" name="selectLic">� �������� ������� ������������� ����������
</DIV>
<br>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
<INPUT class=but type=button value="������" onclick="window.close()"> 
<INPUT class=but type="button" value="����� &raquo;" onclick="ChekRegLic()"> 
<input type="hidden" name="install" value="1">
	</td>
</tr>
</form>
</table>
<?}?>


</body>
</html>
