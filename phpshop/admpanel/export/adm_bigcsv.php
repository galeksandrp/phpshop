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

// �������������� ������� 
if (!isset($editID) or empty($link_new)) {
	  $sql="select * from phpshop_bigcsv where id='1'";
      $result=@mysql_query($sql);
	  if(@$row = mysql_fetch_array($result)){
	      $num = $row['num'];
	      $num_new = $row['num_new'];
	      $num_upd = $row['num_upd'];
		  $status =$row['status'];
		  $file = $row['file'];
		  $aoption = unserialize($row['aoption']);		  
	  }
	  
	  $sql = "select id,name FROM phpshop_valuta WHERE enabled='1'";
	  $result1 = mysql_query($sql);
	  while ($row1 = mysql_fetch_array($result1)) {
	  	if($aoption['valuta'] == $row1['id']) $t="selected";
	  	else $t="";
	  	$valuta .="
	  	<option value=$row1[id] $t>$row1[name]</option>
	  	";
	  }
	  $valuta = "
	  <select name=valuta_new> $valuta </select>
	  ";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������� CSV ������ �������� ������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>




<script>
DoResize(<? echo $GetSystems['width_icon']?>,600,600);
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
	<b><span name=txtLang id=txtLang>�������� CSV ������ �������� ������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_crontab_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<!-- begin tab pane -->
<div class="tab-pane" id="article-tab" style="margin-top:5px;">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>

<!-- begin intro page -->
<div class="tab-page" id="intro-page" style="height:410px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>


<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "intro-page" ) );
</script>


<table>
<tr>
	<td>
	<FIELDSET>
<LEGEND><span name=txtLang id=txtLang>����� �����:</span> </LEGEND>
<div style="padding:10">
<input type="text" name="file_new" value="<?php echo $file?>"  style="width:350px"><br><br>
<img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> ���� ������ ������������� � /priceManager/csv/, ��� ���� ��������� ����� ����� ����� csv/sample_bigcsv.csv
</div>
</FIELDSET>
</td>
  <td>
  <div style="padding:10">
  <BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin('sample_bigcsv.csv',500,370)">
<img src="../img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
<span name=txtLang id=txtLang>������ ����� CSV</span>
</BUTTON></div>
  </td>
</tr>
<tr>
	<td>
	<FIELDSET style="height:80px">
	<LEGEND><span name=txtLang id=txtLang>������������ �� ���� ������:</span> </LEGEND>
	<div style="padding:10">
	<input type="text" name="num_n" value="<?php echo $num?>"  style="width:50px"> ����� (������������� 300-500)
	</div>
	</FIELDSET>
	</td>
	<td>
	<FIELDSET style="height:80px">
	<LEGEND><span name=txtLang id=txtLang>������������� ������� ��:</span> </LEGEND>
	<div style="padding:10">
	<input type="radio" name="ident" value="0" <? echo$aoption['ident0']?>> �� ID <br>
    <input type="radio" name="ident" value="1" <? echo$aoption['ident1']?>> �� �������� <br>
	</div>
	</FIELDSET>
	</td>
</tr>
<tr>
	<td>
	<FIELDSET style="height:80px">
	<LEGEND><span name=txtLang id=txtLang>������:</span> </LEGEND>
	<div style="padding:10">
	<?php echo $valuta ?>
	</div>
	</FIELDSET>
	</td>
	<td>
	<FIELDSET style="height:80px">
	<LEGEND><span name=txtLang id=txtLang>�����:</span> </LEGEND>
	<div style="padding:10">
	<select name=sklad_new>
<option value=0 <?php echo $aoption['sklad0']?>>������������</option>
<option value=1 <?php echo $aoption['sklad1']?>>������ � ������</option>
<option value=2 <?php echo $aoption['sklad2']?>>������ ��� �����</option>
</select>
	</div>
	</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan="2">
	<FIELDSET >
<LEGEND>������</LEGEND>
<div style="padding:10">
<?php
if ($status == 0) 
	echo "<input type=checkbox name=status_new value='1'> ������ �������� <br>";
	
if ($status == 1) 
	echo "<input type=checkbox name=status_new value='11'> �������� ��������<br>
	<div style=\"background-color:White;padding:10px;border: 1px;border-style: inset;\">������: �������� � ��������! ������� $num_new, ��������� $num_upd �������.
	";
	
if ($status == 2) 
	echo "<input type=checkbox name=status_new value='11'> ������������� � ����� ��������<br>
	<div style=\"background-color:White;padding:10px;border: 1px;border-style: inset;\">������: �������� ���������! ������� $num_new, ��������� $num_upd �������.
	";
if ($aoption["error"] !="") {
   echo "<br><font color=#FF0000>������: $aoption[error]</font></div>";	
}

?>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<div class="tab-page" id="option" style="height:410px">
<h2 class="tab"><span name=txtLang id=txtLang>��������� Cron</span></h2>


<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "option" ) );
</script>

<table>
<tr>
	<td >
	<div style="background-color:White;padding:10px;border: 1px;border-style: inset;">
	<strong>��������:</strong>
<p>��� ������� ����� �� ���������� ����� ������� <a href="http://ru.wikipedia.org/wiki/Cron" target="_blank">Cron</a> ������� ������� ���� � ����������� php � �����-����������� priceManager/loadbigcsv.php � ��������� <a href="http://ru.wikipedia.org/wiki/Cron" target="_blank">Cron</a>.</p>
    <p><strong>������ ������� ������ 30 �����:</strong></p>
	<p><table border="1">
<tr>
	<td>������</td>
	<td>����</td>
	<td>���� � �����</td>
	<td>�����</td>
	<td>���� � ������</td>
	<td>�������</td>
</tr>
<tr>
	<td>*/30</td>
	<td>*</td>
	<td>*</td>
	<td>*</td>
	<td>*</td>
	<td>/usr/local/bin/php -q /home/shop.ru/priceManager/loadbigcsv.php >/dev/null 2>&1</td>
</tr>
</table>

	
	</p>
    </div>
	</td>
</tr>
</table>

<p><img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> ���������� �� ������� Cron: <a href="http://ru.wikipedia.org/wiki/Cron" target="_blank">http://ru.wikipedia.org/wiki/Cron</a></p>

</div>

</div>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
    <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent('export_bigcsv')">�������</BUTTON>
	</td>
	<td align="right" style="padding:10">
	<input type="submit" name="editID" value="OK" class=but>  
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?

if(isset($editID) && !empty($file_new))// ������ ��������������
{
//if(CheckedRules($UserStatus["rsschanels"],1) == 1){
if(1){
	
	$file_new = mysql_escape_string($file_new);	
	$num_n = intval($num_n);
	


	
	$aoption['ident'] = $ident;
	$aoption['ident0'] = "";
	$aoption['ident1'] = "";
	$aoption["ident$ident"] = "checked";
	
	$aoption["valuta"] = $valuta_new;
	
	$aoption['sklad0'] = "";
	$aoption['sklad1'] = "";
	$aoption['sklad1'] = "";
	$aoption['sklad'.$sklad_new] = "selected";
	$aoption['sklad'] = $sklad_new;
	
	$aoption = serialize($aoption);
	
	if ($status_new == 1) 
		$temp = "status = '1', seek='0', num_new='0', num_upd='0', ";
	elseif ($status_new == 11)
		$temp = "status = '0', ";
	else 
		$temp = "";
	
	$sql="UPDATE phpshop_bigcsv
	SET 
	$temp
	file='$file_new', 
	num='$num_n', 
	aoption = '$aoption' 
	where id='1'";
	
	$result=mysql_query($sql)or @die("".mysql_error()."");
	echo('
<script>
self.close()
</script>
	   ');
	
	}
	else $UserChek->BadUserFormaWindow();
}

?>



