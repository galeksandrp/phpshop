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

function GetLastId()// ����� ������
{
global $SysValue;
$sql="select id from ".$SysValue['base']['table_name11']." order by id desc limit 0, 1";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return "page".($row['id']+1);
}

function Disp_cat_pod($category)// ����� ��������� � ������ ������������
{
global $SysValue;
$sql="select name from ".$SysValue['base']['table_name29']." where id='$category'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
@$name=$row['name'];
return @$name." -> ";
}

function Disp_cat($category)// ����� ��������� � ������
{
global $SysValue;
$sql="select name,parent_to from ".$SysValue['base']['table_name29']." where id=$category";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
@$num = mysql_num_rows(@$result);
if($num>0){
$name=$row['name'];
$parent_to=$row['parent_to'];
$dis=Disp_cat_pod($parent_to).$name;
}
elseif($category == 1000) $dis=$SysValue['Lang']['Category'][12];
elseif($category == 2000) $dis=$SysValue['Lang']['Category'][13];
return @$dis;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>�������� ����� ��������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<?
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
	echo "<script language=JavaScript src='../editor3/scripts/editor.js'></script>";
else
	echo "<script language=JavaScript src='../editor3/scripts/moz/editor.js'></script>";
?>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang;?>/language_windows.js"></script>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,650,600);
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
<form name="product_edit"  method=post onsubmit="Save()">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>�������� ����� ��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_website_tab[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<!-- begin tab pane -->
<div class="tab-pane" id="article-tab" style="margin-top:5px;height:250px">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>


<!-- begin intro page -->
<div class="tab-page" id="intro-page" style="height:420px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "intro-page" ) );
</script>

<table width="100%">
<tr>
	<td>
	<FIELDSET>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������</span>: <?$categoryID?></LEGEND>
	<div style="padding:10">
	<?echo '
<input type=text id="myName"  style="width: 550" value="'.Disp_cat($categoryID).'">
<input type="hidden" value="'.$categoryID.'" name="category_new" id="myCat">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'adm_cat.php?category='.$categoryID.'\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>';
	?>
	</FIELDSET>
	</td>
	
</tr>
<tr>
	<td>
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
<div style="padding:10">
<input type="text" style="width:100%;" value="<?=$name?>" name="name_new">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
   <td valign="top">
   <table>
   <tr>
   <td width="200"><FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
<div style="padding:10">
<input type="text" name="link_new" style="width:150" value="<?=GetLastId()?>">.html
</div>
</FIELDSET>
</td>
	<td>
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������ ��� ������</span>:</LEGEND>
<div style="padding:10">
<input type=text name=num_new  style="width:100%" value="<?=$num?>">
</div>
</FIELDSET>
	</td>
	<td>
	</td>
   </tr>
   </table>
   </td>
   
	
</tr>
<tr>
    <td align=left >
	
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������������ ������ ��� ���������� �������</span>:</LEGEND>
<div style="padding:10">
<textarea class=full name="odnotip_new" style="height:50px"><?=$odnotip;?></textarea>
<table width="570">
<tr>
	<td><img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <span name=txtLang id=txtLang>������� �������������� (ID) ������� ����� �������</span> (100,101).</td>
	
</tr>
</table>



</div>
</FIELDSET>

	</td>
</tr>
</table>
</div>




<div class="tab-page" id="content" style="height:420px">
<h2 class="tab"><span name=txtLang id=txtLang>����������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "content" ) );
</script>
<table width="100%">
<tr>
	<td colspan="3">
	<FIELDSET id=fldLayout>
<div style="padding:10">
<?
$systems=GetSystems();
$option=unserialize($systems['admoption']);
if($option['editor_enabled']  == 1){
$MyStyle=$SysValue['dir']['dir'].chr(47)."phpshop".chr(47)."templates".chr(47).$systems['skin'].chr(47).$SysValue['css']['default'];
echo'
<pre id="idTemporary" name="idTemporary" style="display:none">
'.$content.'
</pre>
	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	oEdit1.cmdAssetManager="modalDialogShow(\''.$SysValue['dir']['dir'].'/phpshop/admpanel/editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit1.width=400;
		oEdit1.height=360;
		oEdit1.btnStyles=true;
	    oEdit1.css="'.$MyStyle.'";
		oEdit1.RENDER(document.getElementById("idTemporary").innerHTML);
	</script>
	<input type="hidden" name="EditorContent" id="EditorContent">
</div>
	';
	}
else{
echo '
<textarea name="EditorContent" id="EditorContent" style="width:100%;height:360px">'.$content.'</textarea>
';
}
	?>
</FIELDSET>
	</td>
</tr>
</table>
</div>
<!-- begin intro page -->
<div class="tab-page" id="promo" style="height:420px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>
<table width="100%">
<tr>
	 <td  valign="top">
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>��������</span> (Title)</LEGEND>
<div style="padding:10">
<textarea  name="title_new" style="width:100%; height:70px"><?=$title?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td valign="top">
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������</span> (Description)</LEGEND>
<div style="padding:10">
<textarea  name="description_new" style="width:100%; height:70px"><?=$description?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	 <td  valign="top">
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������� �����</span> (Keywords)</LEGEND>
<div style="padding:10">
<textarea  name="keywords_new" style="width:100%; height:70px"><?=$keywords?></textarea>
</div>
</FIELDSET>
	</td>
</tr>
</table>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "promo" ) );
</script>
</div>
<div class="tab-page" id="security" style="height:420px">
<h2 class="tab"><span name=txtLang id=txtLang>������������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "security" ) );
</script>
<table width="100%">
<tr>
<td width="100%">

<SCRIPT>
function enable_div1() {
if (document.getElementById('secure_new').checked) {
	document.getElementById('allreg').disabled=false;
	document.getElementById('allusers').checked=true;
} else {
	document.getElementById('allreg').disabled=true;
}
}


function enable_div2() {
if (document.getElementById('allusers').checked) {
	document.getElementById('regsel').disabled=true;
} else {
	document.getElementById('regsel').disabled=false;
}
}

</SCRIPT>
	<FIELDSET id=fldLayout >
<div style="padding:10">
<input type="checkbox" name="enabled_new" value="1" checked> <span name=txtLang id=txtLang>��������</span>
<BR>
<input type="checkbox" id="secure_new" name="secure_new" onClick="enable_div1()" value="1" <?=$sel4?>> <span name=txtLang id=txtLang>���������� ������ ������������������ �������������</span><BR>
<?
$sql='select id,name from '.$SysValue['base']['table_name28'].' WHERE enabled="1"';
$result=mysql_query($sql);
$num = mysql_num_rows($result);
if ($num) { ?>

<DIV <? if ($sel4!=="checked") echo "disabled";?>  id="allreg">
<span name=txtLang id=txtLang>�� �������������������� ����������:</span><BR>
&nbsp;&nbsp;&nbsp;
<input type="HIDDEN" name="9999" value="0">
<?
if (strlen($secure_groups)) {$che='';} else {$che='checked';}

?>
<input type="checkbox" onClick="enable_div2()" id="allusers" name="seq[9999]" <?=$che?> value="1"><span name=txtLang id=txtLang>���� ������������� (������� �������, ����� ������� ������������ ������)</span><BR>

<DIV <?if (!(strlen($secure_groups))) echo "disabled";?> id="regsel" style="overflow-y:auto; height:280px;">
<BR>
<?
	while ($row = mysql_fetch_array($result)) {
		if (strlen($secure_groups)) {
			$string='i'.$row['id'].'-1i';
			if (strpos($secure_groups,$string) !==false) {$che='checked';} else {$che='';}
		} else {$che='';}
		echo '&nbsp;&nbsp;&nbsp;
			<input type="HIDDEN" name="seq['.$row['id'].']" value="0">
			<input type="checkbox" name="seq['.$row['id'].']" '.$che.' value="1">'.$row['name'].'<BR>';
	}
?>
</DIV>
</DIV>
<?
} //����� ���� ���� �������
?>
</div>
</FIELDSET>


</td>
</tr>
</table>
</div>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
    <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent('page_site_catalog')">�������</BUTTON></BUTTON>
	</td>
	<td align="right" style="padding:10">
	<input type="hidden" name="id" value="<?=$id?>">
	<input type="submit" name="editID" value="OK" class=but>
	<input type="reset" name="btnLang" class=but value="��������">
	<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?

if(isset($editID) and $link_new!="")// ������ ��������������
{
if(CheckedRules($UserStatus["page_site"],2) == 1){


foreach ($seq as $crid =>$value) {
	$sq_new.='i'.$crid.'-'.$value.'i';
	if (isset($seq['9999'])) {$sq_new=''; break;}
}


$sql="INSERT INTO ".$SysValue['base']['table_name11']."
VALUES ('','$name_new','$link_new','$category_new','$keywords_new','$description_new','".addslashes($EditorContent)."','$flag_new','$num_new','".date("U")."','$odnotip_new','$title_new','$enabled_new','$secure_new','$sq_new')";
$result=mysql_query($sql) or die("".$sql.mysql_error()."");
echo('
<script>
CLREL("right");
</script>
	   ');
}else $UserChek->BadUserFormaWindow();
}
?>



