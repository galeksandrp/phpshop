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

function Zero($a){
if($a!=1) return 0;
else return 1;
}

function CleachPassword($pas){
$num=strlen(base64_decode($pas));
$i=0;
while($i<$num){
@$str.="X";
$i++;
}
return $str;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������������� ������������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,645,500);
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
if(isset($id))
	  {
	  $sql="select * from $table_name19 where id=\"$id\"";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  $id=$row['id'];
	  $login=$row['login'];
	  $password=$row['password'];
	  $status=unserialize($row['status']);
	  $mail=$row['mail'];
	  $skin=$row['skin'];
	  $name=$row['name'];
	  $content=$row['content'];
	  if($row['enabled']==1){
	$fl="checked";
	}else{
	$fl2="checked";}
	
	 if($row['skin_enabled']==1)
	$f3="checked";
	
	 if($row['name_enabled']==1)
	$f4="checked";
	
	
	function Checked($a,$b){
$array=explode("-",$a);
if($array[$b]==1) return "checked";
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
else $disp='<img src="../img/icon_non.gif"  width="150" height="120" border="1" id="icon">';
return @$disp;
}
	  ?>
	 
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������������� ������������</span> "<?=$login?>"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_groups_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<!-- begin tab pane -->
<div class="tab-pane" id="article-tab" style="margin-top:5px;">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>

<!-- begin intro page -->
<div class="tab-page" id="intro-page" style="height:320px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "intro-page" ) );
</script>
<table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<form name="product_edit" method="post">
<tr>
  <td colspan="2">
  <FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>�</u>��</span></LEGEND>
<div style="padding:10">
<input type="text" name="name_new" value="<?=$name?>" class=full><!-- <br><br>
<input type="checkbox" value="1" name="name_enabled_new" <?=@$f4?>> ��������� ������������ �������� �������� ��� ������ ������ -->
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td>
  <FIELDSET>
<LEGEND><u>E</u>-mail</LEGEND>
<div style="padding:10">
<input type="text" name="mail_new" value="<?=$mail?>" class=full>
</div>
</FIELDSET>
  </td>
  <td>
  <FIELDSET>
<LEGEND><span name=txtLang id=txtLang><u>C</u>�����</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" <?=@$fl?>><span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;&nbsp;
<input type="radio" name="enabled_new" value="0" <?=@$fl2?>><font color="#FF0000"><span name=txtLang id=txtLang>����������������</span></font>
</div>
</FIELDSET>
  </td>
</tr>
<tr>
	<td colspan="3">
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������� ������</span></LEGEND>
<div style="padding:10">
<table>
<tr>
	<td>Login</td>
	<td width="10"></td>
	<td><input type="text" name="login_new" value="<?=$login?>" size="20" onclick="password_new.value='';flag.checked=true"></td>
	<td rowspan="2" valign="top" style="padding-left:10">
	<img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <span name=txtLang id=txtLang>����� ����� ������ ����������� ������� ��� ����� � ������ �������.</span> <br>
	 <input type="checkbox" name="flag" value="1""> <span name=txtLang id=txtLang>�� �������, ��� ������ ��������</span><strong> Login & Password</strong>?
	</td>
</tr>
<tr>
	<td>Password *</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new" onclick="this.value='';;flag.checked=true" size="20" value="<?=CleachPassword($password); ?>"></td>
</tr>
</table>

</div>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<!-- begin intro page -->
<div class="tab-page" id="content" style="height:320px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "content" ) );
</script>
<table width="100%">

<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
<div style="padding:10">
<textarea style="width:100%;height:260px" name="EditorContent" id="EditorContent">

</textarea>
</div>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<!-- begin intro page -->
<div class="tab-page" id="rules" style="height:320px;overflow:auto">
<h2 class="tab"><span name=txtLang id=txtLang>�����</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "rules" ) );
</script>

<table width="100%" cellpadding="0" cellspacing="1" height="100%">
<tr>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>������</span></td>
	<td id=pane align=center><img src="../img/arrow_d.gif" alt="" width="7" height="7" border="0" hspace="5"><span name=txtLang id=txtLang>������</span></td>
</tr>
<form name="product_edit">
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="gbook_rul_1" <?=Checked($status['gbook'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="gbook_rul_2" <?=Checked($status['gbook'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="gbook_rul_3" <?=Checked($status['gbook'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>�������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="news_rul_1" <?=Checked($status['news'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="news_rul_2" <?=Checked($status['news'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="news_rul_3" <?=Checked($status['news'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="visitor_rul_1" <?=Checked($status['visitor'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="visitor_rul_2" <?=Checked($status['visitor'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="visitor_rul_3" <?=Checked($status['visitor'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="visitor_rul_4" <?=Checked($status['visitor'],3)?>> <span name=txtLang id=txtLang>��� ������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>��������������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="users_rul_1" <?=Checked($status['users'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="users_rul_2" <?=Checked($status['users'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="users_rul_3" <?=Checked($status['users'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" name="users_rul_4" <?=Checked($status['users'],3)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="shopusers_rul_1" <?=Checked($status['shopusers'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="shopusers_rul_2" <?=Checked($status['shopusers'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="shopusers_rul_3" <?=Checked($status['shopusers'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>�������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="cat_prod_rul_1" <?=Checked($status['cat_prod'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="cat_prod_rul_2" <?=Checked($status['cat_prod'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="cat_prod_rul_3" <?=Checked($status['cat_prod'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" name="cat_prod_rul_5" <?=Checked($status['cat_prod'],4)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" name="cat_prod_rul_4" <?=Checked($status['cat_prod'],3)?>> <span name=txtLang id=txtLang>��� ������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="stats1_rul_1" <?=Checked($status['stats1'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="stats1_rul_2" <?=Checked($status['stats1'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="stats1_rul_3" <?=Checked($status['stats1'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<!-- <tr class="row">
	<td >Rupay</td>
	<td align="center">
	<input type="checkbox" value="1" name="rupay_rul_1" <?=Checked($status['rupay'],0)?>> �����&nbsp;&nbsp;
	</td>
</tr> -->
<tr class="row">
	<td ><span name=txtLang id=txtLang>����������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="news_writer_rul_1" <?=Checked($status['news_writer'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="news_writer_rul_2" <?=Checked($status['news_writer'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="news_writer_rul_3" <?=Checked($status['news_writer'],2)?>><span name=txtLang id=txtLang> ��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>��������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="page_site_rul_1" <?=Checked($status['page_site'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="page_site_rul_2" <?=Checked($status['page_site'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="page_site_rul_3" <?=Checked($status['page_site'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>�����</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="page_menu_rul_1" <?=Checked($status['page_menu'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="page_menu_rul_2" <?=Checked($status['page_menu'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="page_menu_rul_3" <?=Checked($status['page_menu'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="baner_rul_1" <?=Checked($status['baner'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="baner_rul_2" <?=Checked($status['baner'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="baner_rul_3" <?=Checked($status['baner'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="links_rul_1" <?=Checked($status['links'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="links_rul_2" <?=Checked($status['links'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="links_rul_3" <?=Checked($status['links'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������ � �������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="csv_rul_1" <?=Checked($status['csv'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="csv_rul_2" <?=Checked($status['csv'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="csv_rul_3" <?=Checked($status['csv'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>�����</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="opros_rul_1" <?=Checked($status['opros'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="opros_rul_2" <?=Checked($status['opros'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="opros_rul_3" <?=Checked($status['opros'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������ � ��</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="sql_rul_2" <?=Checked($status['sql'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="sql_rul_3" <?=Checked($status['sql'],2)?>> <span name=txtLang id=txtLang>���������� BackUp</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>��������� ��</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="option_rul_2" <?=Checked($status['option'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="discount_rul_1" <?=Checked($status['discount'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="discount_rul_2" <?=Checked($status['discount'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="discount_rul_3" <?=Checked($status['discount'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="valuta_rul_1" <?=Checked($status['valuta'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="valuta_rul_2" <?=Checked($status['valuta'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="valuta_rul_3" <?=Checked($status['valuta'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>��������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="delivery_rul_1" <?=Checked($status['delivery'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="delivery_rul_2" <?=Checked($status['delivery'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="delivery_rul_3" <?=Checked($status['delivery'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>��������-�����</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="servers_rul_1" <?=Checked($status['servers'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="servers_rul_2" <?=Checked($status['servers'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="servers_rul_3" <?=Checked($status['servers'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
<tr class="row">
	<td ><span name=txtLang id=txtLang>RSS ������</span></td>
	<td align="center">
	<input type="checkbox" value="1" name="rss_rul_1" <?=Checked($status['rsschanels'],0)?>> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="rss_rul_2" <?=Checked($status['rsschanels'],1)?>> <span name=txtLang id=txtLang>��������������</span>&nbsp;&nbsp;
	<input type="checkbox" value="1" name="rss_rul_3" <?=Checked($status['rsschanels'],2)?>> <span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
	</td>
</tr>
</table>
</div>
<!-- begin intro page -->

<!-- <div class="tab-page" id="skin" style="height:320px">
<h2 class="tab">������</h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "skin" ) );
</script>

	<table >
	<tr class=adm2>
	  <td align=left>
	  <?=GetSkins($skin)?>
	  </td>
	  <td style=\"padding-left:5px\" valign=top>
	  <FIELDSET >
	  <LEGEND ><u>�</u>�������</LEGEND>
	  <div align="center" style="padding:10px"> <?=GetSkinsIcon($skin)?></div>
	  </FIELDSET>
	  <br>
	  <input type="checkbox" value="1" name="skin_enabled_new" <?=@$f3?>> ������������ ������
	  </td>
	</tr>

</table>
</div> -->
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
    <input type="hidden" name="userID" value="<?=$id?>" >
	<input type="submit" name="editID" value="OK" class=but>
	<input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
    <input type="hidden" class=but  name="productDELETE" id="productDELETE">
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?
      }
if(isset($editID) and @$login_new!="")
{
if(CheckedRules($UserStatus["users"],3) == 1){

$statusUser=array(
"gbook"=>Zero($gbook_rul_1)."-".Zero($gbook_rul_2)."-".Zero($gbook_rul_3),
"news"=>Zero($news_rul_1)."-".Zero($news_rul_2)."-".Zero($news_rul_3),
"visitor"=>Zero($visitor_rul_1)."-".Zero($visitor_rul_2)."-".Zero($visitor_rul_3)."-".Zero($visitor_rul_4),
"users"=>Zero($users_rul_1)."-".Zero($users_rul_2)."-".Zero($users_rul_3)."-".Zero($users_rul_4),
"shopusers"=>Zero($shopusers_rul_1)."-".Zero($shopusers_rul_2)."-".Zero($shopusers_rul_3),
"cat_prod"=>Zero($cat_prod_rul_1)."-".Zero($cat_prod_rul_2)."-".Zero($cat_prod_rul_3)."-".Zero($cat_prod_rul_4)."-".Zero($cat_prod_rul_5),
"stats1"=>Zero($stats1_rul_1)."-".Zero($stats1_rul_2)."-".Zero($stats1_rul_3),
"rupay"=>Zero($rupay_rul_1)."-".Zero($rupay_rul_2)."-".Zero($rupay_rul_3),
"news_writer"=>Zero($news_writer_rul_1)."-".Zero($news_writer_rul_2)."-".Zero($news_writer_rul_3),
"page_site"=>Zero($page_site_rul_1)."-".Zero($page_site_rul_2)."-".Zero($page_site_rul_3),
"page_menu"=>Zero($page_menu_rul_1)."-".Zero($page_menu_rul_2)."-".Zero($page_menu_rul_3),
"baner"=>Zero($baner_rul_1)."-".Zero($baner_rul_2)."-".Zero($baner_rul_3),
"links"=>Zero($links_rul_1)."-".Zero($links_rul_2)."-".Zero($links_rul_3),
"csv"=>Zero($csv_rul_1)."-".Zero($csv_rul_2)."-".Zero($csv_rul_3),
"opros"=>Zero($opros_rul_1)."-".Zero($opros_rul_2)."-".Zero($opros_rul_3),
"sql"=>Zero($sql_rul_1)."-".Zero($sql_rul_2)."-".Zero($sql_rul_3),
"option"=>Zero($option_rul_1)."-".Zero($option_rul_2),
"discount"=>Zero($discount_rul_1)."-".Zero($discount_rul_2)."-".Zero($discount_rul_3),
"valuta"=>Zero($valuta_rul_1)."-".Zero($valuta_rul_2)."-".Zero($valuta_rul_3),
"delivery"=>Zero($delivery_rul_1)."-".Zero($delivery_rul_2)."-".Zero($delivery_rul_3),
"servers"=>Zero($servers_rul_1)."-".Zero($servers_rul_2)."-".Zero($servers_rul_3),
"rsschanels"=>Zero($rss_rul_1)."-".Zero($rss_rul_2)."-".Zero($rss_rul_3)
);
$sql="UPDATE $table_name19
SET
status='".serialize($statusUser)."'
where id='$userID'";
$result=mysql_query($sql)or @die("���������� �������� ������");
}


if(CheckedRules($UserStatus["users"],1) == 1){

$sql="UPDATE $table_name19
SET
mail='$mail_new',
enabled='$enabled_new',
content='$EditorContent',
skin='$skin_new',
skin_enabled='$skin_enabled_new',
name='$name_new',
name_enabled='$name_enabled_new' 
where id='$userID'";
$result=mysql_query($sql)or @die("���������� �������� ������");
if(isset($flag)){
$sql="UPDATE $table_name19
SET
login='$login_new',
password='".base64_encode($password_new)."'
where id='$userID'";
$result=mysql_query($sql)or @die("���������� �������� ������");
}
echo"
<script>
DoReloadMainWindow('users');
</script>
	   ";
	   }else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// ��������
{
if(CheckedRules($UserStatus["users"],1) == 1){
$sql="delete from $table_name19
where id='$userID'";
$result=mysql_query($sql)or @die("���������� �������� ������");
echo"
	  <script>
DoReloadMainWindow('users');
</script>
	   ";
	    }else $UserChek->BadUserFormaWindow();
}
?>



