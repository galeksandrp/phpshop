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
	  $sql="select * from ".$SysValue['base']['table_name38']." where id='$id'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  $id=$row['id'];
	  $link_new = $row['link'];
	  ${"day_num_new_".$row['day_num']} = "selected";
	  $news_num_new = $row['news_num'];
	  $start_date_new = $row['start_date'];
	  $end_date_new = $row['end_date'];	  
	  
	  if($row['enabled']==1){
		$fl="checked";
	  }else{
		$fl2="checked";
	  }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������������� ������ ������ RSS</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>

<LINK href="../css/dateselector.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="../java/popup_lib.js"></SCRIPT>
<SCRIPT language="JavaScript" src="../java/dateselector.js"></SCRIPT>

<script>
DoResize(<? echo $GetSystems['width_icon']?>,400,450);
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
	<b><span name=txtLang id=txtLang>�������������� ������ RSS</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
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
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang>����� �����</span> </LEGEND>
<div style="padding:10">
<input type="text" name="link_new" value="<?php echo $link_new?>"  style="width:200px"><br><br>

<span name=txtLang id=txtLang>�������� �������</span> 
<select name="day_num_new">
				<option value="1" <?php echo $day_num_new_1?>>1</option>
				<option value="2" <?php echo $day_num_new_2?>>2</option>
				<option value="3" <?php echo $day_num_new_3?>>3</option>
				<option value="4" <?php echo $day_num_new_4?>>4</option> 
				<option value="5" <?php echo $day_num_new_5?>>5</option> 
</select> <span name=txtLang id=txtLang>��� � ����</span>.<br>

<span name=txtLang id=txtLang>�������� </span>
<input type="text" name="news_num_new" value="<?php echo $news_num_new; ?>"  style="width:20px" value="10">
<span name=txtLang id=txtLang>�������(��) �� ��� (�� ��������� - 10)</span>. 

</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td>
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang>���� ������ (dd-mm-yyyy)</span> </LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>�&nbsp;&nbsp;</span>
<input type="text" name="start_date_new" id="start_date_new"  maxlength="10" value="<?php echo date( "d-m-Y",$start_date_new);?>" style="width:80px;">
<IMG onclick="popUpCalendar(this, product_edit.start_date_new, 'dd-mm-yyyy');" height=16 hspace=3 src="../icon/date.gif" width=16 border=0 align="absmiddle">
<span name=txtLang id=txtLang>��</span>
<input type="text" name="end_date_new"  maxlength="10" value="<?php echo date( "d-m-Y",$end_date_new);?>" style="width:80px;" >
<IMG onclick="popUpCalendar(this, product_edit.end_date_new, 'dd-mm-yyyy');" height=16 hspace=3 src="../icon/date.gif" width=16 border=0 align="absmiddle">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td>
	<FIELDSET style="height:80px">
<LEGEND><span name=txtLang id=txtLang>������</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" <?php echo $fl;?>><span name=txtLang id=txtLang>�������</span><br>
<input type="radio" name="enabled_new" value="0" <?php echo $fl2;?>><font color="#FF0000"><span name=txtLang id=txtLang>���������</span></font>
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

if(isset($editID) && !empty($link_new))// ������ ��������������
{
if(CheckedRules($UserStatus["rsschanels"],1) == 1){
	
	$link_new = mysql_escape_string($link_new)	;
	$news_num_new = intval($news_num_new);
	if ($news_num_new == "" || $news_num_new == 0) {
		$news_num_new=1;		
	}
	$tm_date = explode("-",ereg_replace("[^0-9\-]","",$start_date_new));
	$start_date_new = strtotime("$tm_date[2]-$tm_date[1]-$tm_date[0]");
	$tm_date = explode("-",ereg_replace("[^0-9\-]","",$end_date_new));
	$end_date_new = strtotime("$tm_date[2]-$tm_date[1]-$tm_date[0]");
	
	
	$sql="UPDATE ".$SysValue['base']['table_name38']."
	SET
	link='$link_new',
	day_num = '$day_num_new',
	news_num = '$news_num_new',
	start_date = '$start_date_new',
	end_date = '$end_date_new',
	enabled='$enabled_new' 
	where id='$id'";
	//echo $sql."<br>";
	$result=mysql_query($sql)or @die("".mysql_error()."");
	echo"
		  <script>
			DoReloadMainWindow('rssgraber_chanels');
		  </script>
	   ";
	}
	else $UserChek->BadUserFormaWindow();
}
if (@$productDELETE) {
	if (CheckedRules($UserStatus['rsschanels'],1)==1) {
			$sql = "DELETE FROM ".$SysValue['base']['table_name38']." WHERE id='$id'";
			$result=mysql_query($sql)or @die("���������� �������� ������");
			echo"
	  <script>
DoReloadMainWindow('rssgraber_chanels');
</script>
	   ";
	}
	else $UserChek->BadUserFormaWindow();
}
?>



