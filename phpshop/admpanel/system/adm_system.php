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
	<title>��������� ���������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript">
DoResize(<? echo $GetSystems['width_icon']?>,550,430);
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
function GetLang($skin){
global $SysValue;
$dir="../language";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and $file!="index.html")
            @$name.= "<option value=\"$file\" $sel>$file</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"lang_new\">
".@$name."
</select>
";
return @$disp;
}

// ����� �����
function GetSkins($skin){
global $SysValue;
$dir="../../templates";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and $file!="index.html")
            @$name.= "<option value=\"$file\" $sel>$file</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"skin_new\" style=\"height:200px;width:280px\" size=5 onchange=\"GetSkinIcon(this.value)\">
".@$name."
</select>
";
return @$disp;
}


// ����� ������ �����
function GetSkinsIcon($skin){
global $SysValue;
$dir="../../templates";
$filename=$dir.'/'.$skin.'/icon/icon.gif';
if (file_exists($filename))
$disp='<img src="'.$filename.'" alt="'.$skin.'" width="150" height="120" border="1" id="icon">';
else $disp='<img src="../img/icon_non.gif" alt="����������� �� ��������" width="150" height="120" border="1" id="icon">';
return @$disp;
}

function GetValuta($n,$tip){ // ����� ������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name24']." where enabled='1' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=$row['name'];
	$sel="";
	if ($id == $n) $sel="selected";
    @$dis.="<option value=".$id." ".$sel." >".$name."</option>\n";
	}
@$disp="
<select name='$tip' size=1>
$dis
</select>
";
return @$disp;
}

function GetUsersStatus($n){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name28']." order by discount";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$discount=$row['discount'];
	$sel="";
	if($n==$id) $sel="selected";
	@$dis.="<option value=".$id." ".$sel." >".$name." - ".$discount."%</option>\n";
	}
@$disp="
<select name=user_status_new size=1>
<option value=0 id=txtLang>�������������� ������������</option>
$dis
</select>
";
return @$disp;
}


$sql="select * from $table_name3";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
	$num_row=$row['num_row'];
	$num_row_adm=$row['num_row_adm'];
	$dengi=$row['dengi'];
	$percent=$row['percent'];
	$title=$row['title'];
	$keywords=$row['keywords'];
	$skin=$row['skin'];
	$kurs=$row['kurs'];
	$kurs_beznal=$row['kurs_beznal'];
	$spec_num=$row['spec_num'];
	$new_num=$row['new_num'];
	$dostavka=$row['dostavka'];
	$nds=$row['nds'];
	if($row['nds_enabled']==1) $nds_enabled="checked";
	 else $nds_enabled="";
	
	switch($row['num_vitrina']){
	case(1): $rowl="selected"; break;
	case(2): $row2="selected"; break;
	case(3): $row3="selected"; break;
	}
	$width_icon =$row['width_icon'];
	$option=unserialize($row['admoption']);
	
	if($option['message_enabled']==1) $message_enabled="checked";
	 else $message_enabled="";
	
	if($option['desktop_enabled']==1) $desktop_enabled="checked";
	 else $desktop_enabled="";
	
	if($option['base_enabled']==1) $base_enabled="checked";
	 else $base_enabled="";
	
	if($option['editor_enabled']==1) $editor_enabled="checked";
	 else $editor_enabled="";
	 
	if($option['sklad_enabled']==1) $sklad_enabled="checked";
	 else $sklad_enabled="";
	 
	if($option['sms_enabled']==1) $sms_enabled="checked";
	 else $sms_enabled="";
	 
	if($option['notice_enabled']==1) $notice_enabled="checked";
	 else $notice_enabled="";
	
		if($option['update_enabled']==1) $update_enabled="checked";
	 else $update_enabled="";
	
	if($option['oplata_1']==1) $oplata_1="checked";
	if($option['oplata_2']==1) $oplata_2="checked";
	if($option['oplata_3']==1) $oplata_3="checked";
	if($option['oplata_4']==1) $oplata_4="checked";
	if($option['oplata_5']==1) $oplata_5="checked";
	if($option['oplata_6']==1) $oplata_6="checked";
	if($option['oplata_7']==1) $oplata_7="checked";
	if($option['oplata_8']==1) $oplata_8="checked";
	if($option['seller_enabled']==1) $seller_enabled="checked";
	if($option['user_mail_activate']==1) $user_mail_activate="checked";
	if($option['user_skin']==1) $user_skin="checked";
	
echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>��������� ���������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>��������� ��� ��������-��������</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_display_settings_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>

<!-- begin tab pane -->
<div class=\"tab-pane\" id=\"article-tab\" style=\"margin-top:5px;height:250px\">

<script type=\"text/javascript\">
tabPane = new WebFXTabPane( document.getElementById( \"article-tab\" ), true );
</script>



<!-- begin intro page -->
<div class=\"tab-page\" id=\"intro-page\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>������� ���</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"intro-page\" ) );
</script>

	<table >
	<tr class=adm2>
<form action=\"$PHP_SELF\" method=\"post\" name=\"system_forma\">
	  <td align=left>
	  ".GetSkins($skin)."
	  </td>
	  <td style=\"padding-left:5px\" valign=top>
	  <FIELDSET >
	  <LEGEND ><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
	  <div align=\"center\" style=\"padding:10px\">".GetSkinsIcon($skin)."</div>
	  </FIELDSET>
	  </td>
	</tr>

</table>

</div>
<div class=\"tab-page\" id=\"vetrina\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>�������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"vetrina\" ) );
</script>
<table>


	<tr>
	  <td align=right>
	   <span name=txtLang id=txtLang>���������� ������� ��<br>
	  �������� � ��������</span>:
	  </td>
	   <td align=left >
	  <input type=text name=num_row_new size=9 value=\"$num_row\" >
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>���������� �������<br>
	  � ���������������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=spec_num_new size=9 value=\"$spec_num\" maxlength=9>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	 <span name=txtLang id=txtLang> ���������� ������� <br>
	  � ��������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=new_num_new size=9 value=\"$new_num\" maxlength=9>
	  </td>
	</tr>
	<tr>
	  <td align=right>
	  <span name=txtLang id=txtLang>������� � �����<br>
	  ��� ������� ������� ��������</span>:
	  </td>
	  <td align=left>
	  <select name=num_vitrina_new>
			<option value=1 $rowl>1</option>
			<option value=2 $row2>2</option>
			<option value=3 $row3>3</option>
</select> ��.
	  </td>
	</tr>
		<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>������ �������� ����<br>
	  ��������� ��</span>:
	  </td>
	  <td align=left>
	  <input type=text name=width_icon_new size=3 value=\"$width_icon\"> %.
	   <span style=\"border: 1px;border-style: inset; padding: 3px\">������������, ���� ���������� �� ��������� �� ��������</span>
	  </td>
	</tr>
	</table>
	</td>
</tr>



</table>
</div>
<!-- begin usage page -->
<div class=\"tab-page\" id=\"usage-page\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>����</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"usage-page\" ) );
</script>

<table>
<tr>
	<td>


<table>
<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>������ �� ���������</span>:
	  </td>
	  <td align=left>
	".GetValuta($dengi,"dengi_new")."
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>������ � �����</span>:
	  </td>
	  <td align=left>
	  ".GetValuta($kurs,"kurs_new")."
	  </td>
	</tr> 
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>������ ��� ������������<br>
	   �������</span>:
	  </td>
	  <td align=left>
	  ".GetValuta($kurs_beznal,"kurs_beznal_new")."
	  </td>
	</tr> 
	<tr class=adm2>
	  <td align=right>
	 <span name=txtLang id=txtLang> �������� ����</span> %:
	  </td>
	  <td align=left>
	  <input type=text name=percent_new size=9 value=\"$percent\" maxlength=9>
	  </td>
	</tr>
   <tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>��������� ���</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"nds_enabled_new\" $nds_enabled>
	  </td>
	</tr>
    <tr>
	  <td align=right>
	<span name=txtLang id=txtLang>���</span>
	  </td>
	  <td align=left>
	  <input type=text name=nds_new size=3 value=\"$nds\"> %
	  </td>
	</tr>
		<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>���������� ���������<br>
	������</span>:
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"sklad_enabled_new\" $sklad_enabled>
	  </td>
	</tr> 
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>
	���-�� ������ �����<br> �������
	 � ����
	</span>:
	  </td>
	  <td align=left>
	  <input type=text name=price_znak_new size=3 value=\"".$option['price_znak']."\">
	  </td>
	</tr> 
</table>

</td>
    <td width=30></td>
	<td valign=top>
	<table>
	  <tr>
	  <td align=right>
	<span>
	����������� ����� ������
	</span>:
	  </td>
	  <td align=left>
	  <input type=text name=cart_minimum_new size=10 value=\"".$option['cart_minimum']."\">
	  </td>
	</tr> 
	</table>
	</td>
</tr>
</table>
</div>
<div class=\"tab-page\" id=\"message\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>���������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"message\" ) );
</script>
<table>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>����������� ����������� <br>
	� ������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"message_enabled_new\" $message_enabled>
	  <span style=\"border: 1px;border-style: inset; padding: 3px\">����� ��������� � ���������� ������ �����������������</span>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>����� ����������<br>
	�����������</span>
	  </td>
	  <td align=left>
	  <input type=text name=message_time_new size=3 value=\"".$option['message_time']."\"> ���.
	  </td>
	</tr>
	<!-- <tr class=adm2>
	  <td align=right>
<span name=txtLang id=txtLang>�������� ������� ��<br>
	������� �����</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"desktop_enabled_new\" $desktop_enabled>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>����� ����������<br>
	�������� �������</span>
	  </td>
	  <td align=left>
	  <input type=text name=desktop_time_new size=3 value=\"".$option['desktop_time']."\"> ���.
	  </td>
	</tr> -->
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>SMS ����������� � ������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"sms_enabled_new\" $sms_enabled>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>SMS �����������<br>
	 � ������� ������ �������������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"notice_enabled_new\" $notice_enabled>
	   <span style=\"border: 1px;border-style: inset; padding: 3px\">������ ��� �������������� �������������</span>
	  </td>
	</tr> 
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>�������������� ��������<br>
	����������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"update_enabled_new\" $update_enabled>

	  </td>
	</tr> 
</table>
</div>
<div class=\"tab-page\" id=\"oplata\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"oplata\" ) );
</script>
<table>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>�������� ������ �������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_3_new\" $oplata_3>
	  </td>
	</tr>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>��������� ���������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_2_new\" $oplata_2>
	  </td>
	</tr>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>���� � ���� ��� �����������</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_1_new\" $oplata_1>
	  </td>
	</tr>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>Visa, Mastercard (CyberPlat)</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_4_new\" $oplata_4>
      <a href=\"http://www.CyberPlat.ru\" target=\"_blank\"><img src=\"../icon/icon_info.gif\" alt=\"�����������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"></a>
	  </td>
	</tr>
<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>ROBOXchange</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_5_new\" $oplata_5>
	  <a href=\"http://www.roboxchange.com/Index.aspx\" target=\"_blank\"><img src=\"../icon/icon_info.gif\" alt=\"�����������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"></a>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>WebMoney</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_6_new\" $oplata_6>
	  <a href=\"http://www.webmoney.ru\" target=\"_blank\"><img src=\"../icon/icon_info.gif\" alt=\"�����������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"></a>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>Z-Payment</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_7_new\" $oplata_7>
	  <a href=\"https://z-payment.ru\" target=\"_blank\"><img src=\"../icon/icon_info.gif\" alt=\"�����������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"></a>
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	<span name=txtLang id=txtLang>Visa, Mastercard (PBC)</span>
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"oplata_8_new\" $oplata_8>
	  <a href=\"https://engine.paymentgate.ru/bpcservlet/BPC/index.jsp\" target=\"_blank\"><img src=\"../icon/icon_info.gif\" alt=\"�����������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"></a>
	  </td>
	</tr>
</table>
</div>
<div class=\"tab-page\" id=\"regim\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"regim\" ) );
</script>
<table>
    <tr>
	  <td align=right>
	<span name=txtLang id=txtLang>���������� ��������</span>:
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"editor_enabled_new\" $editor_enabled>
 <span style=\"border: 1px;border-style: inset; padding: 3px\">���������� �������� ������ �� �������� ������</span>
	  </td>
	</tr>
<!-- 	<tr>
	  <td align=right>
	<span name=txtLang id=txtLang>����� ���������</span>:
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"seller_enabled_new\" $seller_enabled>
	  </td>
	</tr> -->
	<tr>
	  <td align=right>
	<span name=txtLang id=txtLang>����� Multibase</span>:
	  </td>
	  <td align=left>
	  <input type=\"checkbox\" value=\"1\" name=\"base_enabled_new\" $base_enabled> 
	  </td>
	</tr>
	<tr>
	  <td align=right>
	Multibase ID:
	  </td>
	  <td align=left>
	  <input type=text name=base_id_new size=5 value=\"".$option['base_id']."\">
	 <font style=\"font-size:9px\"> * <span name=txtLang id=txtLang>������������� � ������� Multibase �������� ������</span>.</font>
	  </td>
	</tr>
	<tr>
	  <td align=right>
	Multibase Host:
	  </td>
	  <td align=left>
	  <input type=text value=\"http://\" readonly size=3 disabled>
	  <input type=text name=\"base_host_new\" size=30 value=\"".$option['base_host']."\">
	  </td>
	</tr>
</table>
</div>
<div class=\"tab-page\" id=\"lang\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>����</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"lang\" ) );
</script>
<table>
<tr>
	<td><span name=txtLang id=txtLang>���������������� ������</span>:</td>
	<td>".GetLang($option['lang'])."</td>
</tr>
</table>

</div>
<div class=\"tab-page\" id=\"user\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>������������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"user\" ) );
</script>
<table>
<tr>
	<td><span name=txtLang id=txtLang>��������� ����� e-mail</span>:</td>
	<td><input type=\"checkbox\" value=\"1\" name=\"user_mail_activate_new\" $user_mail_activate> </td>
</tr>
<tr>
	<td><span name=txtLang id=txtLang>������ ����� ���������</span>:</td>
	<td>".GetUsersStatus($option['user_status'])." </td>
</tr>
<tr>
	<td><span name=txtLang id=txtLang>����� �������</span>:</td>
	<td><input type=\"checkbox\" value=\"1\" name=\"user_skin_new\" $user_skin> </td>
</tr>
</table>

</div>
<div class=\"tab-page\" id=\"img\" style=\"height:250px\">
<h2 class=\"tab\"><span name=txtLang id=txtLang>�����������</span></h2>

<script type=\"text/javascript\">
tabPane.addTabPage( document.getElementById( \"img\" ) );
</script>


	<FIELDSET id=fldLayout>
	<LEGEND id=lgdLayout><u>�</u>������������� ������� ����������� (���������): </LEGEND>
	<div style=\"padding:10\">
	
	<table>
<tr>
	<td>
	
	<table>
<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>����. ������ ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=img_w size=3 value=\"".$option['img_w']."\"> px
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>����. ������ ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=img_h size=3 value=\"".$option['img_h']."\"> px
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>�������� ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=width_podrobno size=3 value=\"".$option['width_podrobno']."\"> %
	  </td>
	</tr>
</table>
	
	</td>
	<td>
	
	<table>
<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>����. ������ ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=img_tw size=3 value=\"".$option['img_tw']."\"> px
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>����. ������ ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=img_th size=3 value=\"".$option['img_th']."\"> px
	  </td>
	</tr>
	<tr class=adm2>
	  <td align=right>
	  <span name=txtLang id=txtLang>�������� ���������</span>:
	  </td>
	  <td align=left>
	  <input type=text name=width_kratko size=3 value=\"".$option['width_kratko']."\"> %
	  </td>
	</tr>
</table>
	
	</td>
<tr>

  <td colspan=2>
  Watermark: <input type=\"text\" style=\"width: 300px\" name=img_wm value=\"".$option['img_wm']."\">
  </td>
</tr>
</tr>
</table>

	
	
	
	
</div>
</FIELDSET>
</div>
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

  if($_SESSION['skin'] != $skin_new){
  $skin=$skin_new;
  session_register('skin');
  }
  
$option=array(
"img_wm"=>$img_wm,
"img_w"=>$img_w,
"img_h"=>$img_h,
"img_tw"=>$img_tw,
"img_th"=>$img_th,
"width_podrobno"=>$width_podrobno,
"width_kratko"=>$width_kratko,
"message_enabled"=>$message_enabled_new,
"message_time"=>$message_time_new,
"desktop_enabled"=>$desktop_enabled_new,
"desktop_time"=>$desktop_time_new,
"oplata_1"=>$oplata_1_new,
"oplata_2"=>$oplata_2_new,
"oplata_3"=>$oplata_3_new,
"oplata_4"=>$oplata_4_new,
"oplata_5"=>$oplata_5_new,
"oplata_6"=>$oplata_6_new,
"oplata_7"=>$oplata_7_new,
"oplata_8"=>$oplata_8_new,
"seller_enabled"=>$seller_enabled_new,
"base_enabled"=>$base_enabled_new,
"sms_enabled"=>$sms_enabled_new,
"notice_enabled"=>$notice_enabled_new,
"update_enabled"=>$update_enabled_new,
"base_id"=>$base_id_new,
"base_host"=>$base_host_new,
"lang"=>$lang_new,
"sklad_enabled"=>$sklad_enabled_new,
"price_znak"=>$price_znak_new,
"user_mail_activate"=>$user_mail_activate_new,
"user_status"=>$user_status_new,
"user_skin"=>$user_skin_new,
"cart_minimum"=>$cart_minimum_new,
"editor_enabled"=>$editor_enabled_new
);
$option_new=serialize($option);

$sql="UPDATE $table_name3
SET
num_row='$num_row_new',
num_row_adm='$num_row_adm_new',
dengi='$dengi_new',
percent='$percent_new',
skin='$skin_new',
kurs='$kurs_new',
new_num='$new_num_new',
spec_num ='$spec_num_new',
num_vitrina='$num_vitrina_new',
width_icon='$width_icon_new',
nds='$nds_new',
nds_enabled='$nds_enabled_new',
admoption='$option_new',
kurs_beznal='$kurs_beznal_new' ";
$result=mysql_query($sql)or @die("���������� �������� ������".$sql.mysql_error());
$UpdateWrite=UpdateWrite();// ��������� LastModified
echo"
	 <script>
	 CL();
	 </script>
	   ";
}else $UserChek->BadUserFormaWindow();
  }
   
?>


