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
	<title>Promo ���������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,650,630);
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

$sql="select * from $table_name3";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
	$title=$row['title'];
	$keywords=$row['keywords'];
	$title_shablon=$row['title_shablon'];
	$descrip=$row['descrip'];
	$descrip_shablon=$row['descrip_shablon'];
	$keywords_shablon=$row['keywords_shablon'];
	$title_shablon2=$row['title_shablon2'];
    $descrip_shablon2=$row['descrip_shablon2'];
	$keywords_shablon2=$row['keywords_shablon2'];
	$title_shablon3=$row['title_shablon3'];
    $descrip_shablon3=$row['descrip_shablon3'];
	$keywords_shablon3=$row['keywords_shablon3'];
echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>Promo ���������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>��������� ��� ���������� ������������</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_website_statistics_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
<br>";
echo('
<!-- begin tab pane -->

<div class="tab-pane" id="article-tab" style="margin-top:5px;height:250px">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>

<!-- begin intro page -->
<div class="tab-page" id="content" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "content" ) );
</script>
<form method="post">
<table width="100%">

<tr>
  <td>
  <FIELDSET >
	<LEGEND >Title</LEGEND>
	<div style="padding:10">
	 <textarea  name="title_new" style="width:100%;height: 6em;">'.$title.'</textarea>
	 
</div>
</FIELDSET>
  </td>
</tr>
<tr>
   <td>
   <FIELDSET >
	<LEGEND >Description</LEGEND>
	<div style="padding:10" align="center">
	 <textarea  name="descrip_new" style="width:100%;height: 7em;">'.$descrip.'</textarea>
	  
</div>
</FIELDSET>
   </td>
</tr>
<tr>
   <td>
   <FIELDSET >
	<LEGEND >Keywords</LEGEND>
	<div style="padding:10" align="center">
	 <textarea  name="keywords_new" style="width:100%;height: 7em;">'.$keywords.'</textarea>
	  
</div>
</FIELDSET>
   </td>
</tr>
</table>
</div>
<div class="tab-page" id="catal" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>������ ��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "catal" ) );
</script>

<table width="100%">
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>T</u>itle:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="title_shablon3_new" id="Shablon3" readonly>'.$title_shablon3.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'Shablon3\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'Shablon3\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'Shablon3\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'Shablon3\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'Shablon3\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'Shablon3\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'Shablon3\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'Shablon3\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>D</u>escription:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="descrip_shablon3_new" id="ShablonD3" readonly>'.$descrip_shablon3.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonD3\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonD3\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonD3\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'ShablonD3\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'ShablonD3\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonD3\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonD3\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonD3\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>K</u>eywords:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="keywords_shablon3_new" id="ShablonK3" readonly>'.$keywords_shablon3.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonK3\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonK3\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Generator@\',\'ShablonK\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonK3\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonK3\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonK3\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonK3\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
</table>
</div>
<div class="tab-page" id="catalog" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>������ �����������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "catalog" ) );
</script>

<table width="100%">
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>T</u>itle:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="title_shablon_new" id="Shablon" readonly>'.$title_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'Shablon\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'Shablon\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'Shablon\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'Shablon\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>D</u>escription:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="descrip_shablon_new" id="ShablonD" readonly>'.$descrip_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonD\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonD\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'ShablonD\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonD\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>K</u>eywords:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="keywords_shablon_new" id="ShablonK" readonly>'.$keywords_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Generator@\',\'ShablonK\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonK\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
</table>
</div>
<div class="tab-page" id="product" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>������ ������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "product" ) );
</script>

<table width="100%">
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>T</u>itle:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="title_shablon2_new" id="Shablon2" readonly>'.$title_shablon2.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'Shablon2\')" class="buttonSh">
<input type="button"  value="," onclick="ShablonAdd(\',\',\'Shablon2\')" class="buttonSh">
<input type="button"  value="-" onclick="ShablonAdd(\'-\',\'Shablon2\')" class="buttonSh">
<input type="button"  value="/" onclick="ShablonAdd(\'/\',\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'Shablon2\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'Shablon2\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>D</u>escription:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="descrip_shablon2_new" id="ShablonD2" readonly>'.$descrip_shablon2.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonD2\')" class="buttonSh">
<input type="button" name="btnLang"  value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonD2\')" class="buttonSh">
<input type="button"  name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'ShablonD2\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonD2\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonD2\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'ShablonD2\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'ShablonD2\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonD2\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonD2\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonD2\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>K</u>eywords:</LEGEND>
<div style="padding:10;width: 100%">
<textarea style="width: 100%; height: 5em;" name="keywords_shablon2_new" id="ShablonK2" readonly>'.$keywords_shablon2.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="���������" onclick="ShablonAdd(\'@Generator@\',\'ShablonK2\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="C����" onclick="ShablonPromt(\'ShablonK2\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonK2\')" class="buttonSh">
</div>
</FIELDSET>
  </td>
</tr>
</table>
</div>
');
echo"

<hr>
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" >
<tr>
	<td align=\"right\" style=\"padding:10\">
<input type=submit value=�� class=but name=optionsSAVE>
	<input type=submit name=btnLang value=������ class=but onClick=\"return onCancel();\">
	</td>
</tr>
</form>
</table>
";

if(isset($optionsSAVE))
{
if(CheckedRules($UserStatus["option"],1) == 1){
$sql="UPDATE $table_name3
SET
title='$title_new',
keywords='$keywords_new',
descrip='$descrip_new',
descrip_shablon='$descrip_shablon_new',
keywords_shablon ='$keywords_shablon_new',
title_shablon ='$title_shablon_new',
descrip_shablon2='$descrip_shablon2_new',
keywords_shablon2 ='$keywords_shablon2_new',
title_shablon2 ='$title_shablon2_new',
descrip_shablon3='$descrip_shablon3_new',
keywords_shablon3 ='$keywords_shablon3_new',
title_shablon3 ='$title_shablon3_new'";
$result=mysql_query($sql)or @die(mysql_error());
$UpdateWrite=UpdateWrite();// ��������� LastModified
echo"
	 <script>
	 CL();
	 </script>
	   ";
} else $UserChek->BadUserFormaWindow();
   }
?>


