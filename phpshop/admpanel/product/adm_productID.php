<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// ����������� ������
$GetSystems=GetSystems();
$Admoption=unserialize($GetSystems['admoption']);
$Lang=$Admoption['lang'];
$systems=GetSystems();
require("../language/".$Lang."/language.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>�������������� ������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<meta http-equiv="MSThemeCompatible" content="Yes">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/tab.winclassic.css" type=text/css rel=stylesheet>
<?
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE"))
	echo "<script language=JavaScript src='../editor3/scripts/editor.js'></script>";
else
	echo "<script language=JavaScript src='../editor3/scripts/moz/editor.js'></script>";
?>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" src="../java/tabpane.js"></script>
<script type="text/javascript" language="JavaScript" src="../language/<? 
echo $Lang;?>/language_windows.js"></script>
<script> 
DoResize(<? echo $GetSystems['width_icon']?>,700,630);
</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">
<?

function DellFotoGal($n){// ������� �������� ��� �������� ������
global $SysValue,$DOCUMENT_ROOT;
$sql="select * from ".$SysValue['base']['table_name35']." where parent=$n";
$result=mysql_query($sql);

while($row = mysql_fetch_array($result)){
    $name=$row['name'];
	$id=$row['id'];

$pathinfo=pathinfo($name);
$oldWD = getcwd();
$dirWhereRenameeIs=$DOCUMENT_ROOT.$pathinfo['dirname'];
$oldFilename=$pathinfo['basename'];

@chdir($dirWhereRenameeIs);
@unlink($oldFilename);
$oldFilename_s=str_replace(".","s.",$oldFilename);
@unlink($oldFilename_s);
@chdir($oldWD); 
}

mysql_query("delete from ".$SysValue['base']['table_name35']." where parent=$n");
}



if((isset($productSAVE)) and $name_new!="")// ������ � ����
{
if(CheckedRules($UserStatus["cat_prod"],3) == 1 or $user == $_SESSION['idPHPSHOP']){
if(CheckedRules($UserStatus["cat_prod"],1) == 1){




if(is_array($vendor_new))
foreach($vendor_new as $k=>$v){
       if(is_array($v)){
	     foreach($v as $o=>$p)
	     @$vendor.="i".$k."-".$p."i";
	     }
		 else @$vendor.="i".$k."-".$v."i";
}


if(is_array($page_new))
foreach($page_new as $value)
@$page.=$value.",";


$yml_bid_array_new=array(
"bid_enabled"=>$yml_bid_enabled,
"bid"=>$yml_bid_new,
"cbid_enabled"=>$yml_cbid_enabled,
"cbid"=>$yml_cbid_new
);


// �����<br>
$option=unserialize($systems['admoption']);
switch($option['sklad_status']){
  
       case(3):
	   if($items_new<1) {
	      $sklad=1;
		  $enabled=1;
		  }
	     else {
		 $sklad=0;
		 $enabled=1;
		 }
	   break;
	   
	   case(2):
	   if($items_new<1) {
	     $enabled=0;
		 $sklad=0;
		 }
	     else {
		 $enabled=1;
		 $sklad=0;
		 }
	   break;
	   
	   default: 
	   $sklad=$numBox;
	   $enabled=$enabled_new;
	   break;
  }



$sql="UPDATE $table_name2
SET
category='$category_new',
name='".CleanStr(trim(addslashes($name_new)))."',
content='".addslashes($EditorContent2)."',
description='".addslashes($EditorContent)."',
price='$priceOne',
price_n='$priceBox',
sklad='$sklad',
p_enabled='$p_enabled_new',
enabled='$enabled',
uid='$uid_new',
spec='$spec_new',
odnotip='$odnotip_new',
vendor='$vendor',
vendor_array='".serialize($vendor_new)."',
yml='$yml_new',
num='$num_new',
newtip='$newtip_new',
title='$title_new',
title_enabled='$title_enabled_new',
datas='".date("U")."',
page='$page',
descrip='$descrip_new',
descrip_enabled='$descrip_enabled_new',
title_shablon='$title_shablon_new',
descrip_shablon='$descrip_shablon_new',
keywords='$keywords_new',
keywords_enabled='$keywords_enabled_new',
keywords_shablon='$keywords_shablon_new',
pic_small='$pic_small_new', 
pic_big='$pic_big_new',
yml_bid_array='".serialize($yml_bid_array_new)."',
parent_enabled='$parent_enabled_new',
parent='$parent_new', 
items='$items_new', 
weight='$weight_new', 
price2='$price2', 
price3='$price3',
price4='$price4', 
price5='$price5',
files='".serialize($filenum)."',
baseinputvaluta='$baseinputvaluta_new',
ed_izm='$edizm_new',
dop_cat='$dop_cat_new' 
where id='$productID'";
$result=mysql_query($sql)or @die("".mysql_error()."");


echo('
<table width="100%" height="100%">
<tr>
	<td valign="middle" align="center">
	<FIELDSET style="width: 300px">
<div style="padding:30">
	<input type="submit" value="������� ����" onclick="self.close()">
</div>
</FIELDSET>
	</td>
</tr>
</table>
<script>
CLREL("right");
self.close()
</script>
	   ');
   }} else $UserChek->BadUserFormaWindow();
}
elseif(@$productDELETE=="doIT")// �������� ������
{
if(CheckedRules($UserStatus["cat_prod"],4) == 1){
	$sql="delete from $table_name2
    where id='$productID'";
    $result=mysql_query($sql)or @die("���������� ������� ������");
	
	// ������� ��������
	DellFotoGal($productID);
	
echo('
<table width="100%" height="100%">
<tr>
	<td valign="middle" align="center">
	<FIELDSET style="width: 300px">
<div style="padding:30">
	<input type="submit" value="������� ����" onclick="self.close()">
</div>
</FIELDSET>
	</td>
</tr>
</table>
<script>
CLREL("right");
</script>
	   ');
   } else $UserChek->BadUserFormaWindow();
}
else{
?>
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
function Disp_cat_pod($category)// ����� ��������� � ������ ������������
{
global $table_name;
if($category==1000003) $name="��������� �����";
 else{
$sql="select name from $table_name where id=$category";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=$row['name'];
}
return @$name." -> ";
}

function Disp_cat($category)// ����� ��������� � ������
{
global $table_name;
$sql="select name,parent_to from $table_name where id=$category";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$name=$row['name'];
$parent_to=$row['parent_to'];
$dis=Disp_cat_pod($parent_to).$name;
return @$dis;
}


function dispValue($n,$vendor_array){ // ����� �������������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name21']." where category='$n' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=substr($row['name'],0,35);
	$sel="";
	if(is_array($vendor_array))
	foreach($vendor_array as $k=>$v){
	       if(is_array($v)){
		     foreach($v as $o=>$p){
			        if ($id == $p) $sel="selected";
			 }
		   }
		   
	if ($id == $v) $sel="selected";
	}
    @$dis.="<option value=".$id." ".$sel." >".$name."</option>\n";
	}
@$disp='
<TABLE>
<TR><TD>
<select name=vendor_new['.$n.'][] id="list'.$n.'" size=1 style="width: 300; height: 50" multiple>
<option>��� ������</option>
'.$dis.'
</select>
</TD><TD style="vertical-align:top;">
�������� � ������������ ����� �������� ��������������:<BR>
<INPUT TYPE="TEXT" id="addval'.$n.'" VALUE="">&nbsp; <BUTTON style="height:20px;width:40px; font-size:12px;" onClick="enterchar('.$n.')">��</BUTTON><B id="sta'.$n.'"></B>
</TD></TR>
</TABLE>
';
return @$disp;
}


function dispValueOLD($n,$vendor_array){ // ����� �������������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name21']." where category='$n' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=substr($row['name'],0,35);
	$sel="";
	if(is_array($vendor_array))
	foreach($vendor_array as $k=>$v){
	       if(is_array($v)){
		     foreach($v as $o=>$p){
			        if ($id == $p) $sel="selected";
			 }
		   }
		   
	if ($id == $v) $sel="selected";
	}
    @$dis.="<option value=".$id." ".$sel." >".$name."</option>\n";
	}
@$disp="
<select name=vendor_new[".$n."][] size=1 style=\"width: 300; height: 50\" multiple>
<option>��� ������</option>
$dis
</select>
";
return @$disp;
}


function dispPage($array){ // ����� ������ �� ����
global $SysValue;
$array=explode(",",$array);
$sql="select * from ".$SysValue['base']['table_name11']." where enabled='1' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $link=$row['link'];
    $name=substr($row['name'],0,100);
	$sel="";
	if(is_array($array))
	foreach($array as $v){
	if ($link == $v) $sel="selected";
	}
    @$dis.="<option value=".$link." ".$sel." >".$name."</option>\n";
	}
@$disp="
<select name=page_new[] size=28 style=\"width: 590;\" multiple>
$dis
</select>
";
return @$disp;
}

function DispCatSort($category,$vendor_array){
global $SysValue;
$sql="select sort from ".$SysValue['base']['table_name']." where id=$category";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$sort=unserialize($row["sort"]);
if(is_array($sort))
foreach($sort as $v){
$sql="select * from ".$SysValue['base']['table_name20']." where (id=$v AND goodoption!='1') order by name";
$result=mysql_query($sql);
while (@$row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
@$disp.= '
<div style="padding-top:7">
<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout>'.$name.'</LEGEND>
<div style="padding:10">
'.dispValue($id,$vendor_array).'
</div>
</FIELDSET>
</div>
';
}
}
$dis='
<tr>
    <td align=left>

'.@$disp.'

</td>
</tr>
';
return @$dis;
}


function ListFotoGal($n){// ����� ��������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name35']." where parent=$n order by num desc";
$result=mysql_query($sql);
$i=1;
while($row = mysql_fetch_array($result))
    {
    $name=$row['name'];
    $id=$row['id'];
	$num=$row['num'];
    @$dis.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWinFull('adm_galeryID.php?n=$id',650,500)\">
	<td align=center>$i</td>
	   <td>$name</td>
	</tr>
	";
	$i++;
	}
return @$dis;
}



$sql="select * from $table_name2 where id=$productID";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
	$category=$row['category'];
    $name=stripslashes($row['name']);
	$content=stripslashes($row['content']);
	$description=stripslashes($row['description']);
	$price=$row['price'];
	$price_n=$row['price_n'];
	$sklad=$row['sklad'];
	$enabled=$row['enabled'];
	$p_enabled=$row['p_enabled'];
	$uid=$row['uid'];
	$spec=$row['spec'];
	$newtip=$row['newtip'];
	$odnotip=$row['odnotip'];
	$vendor=$row['vendor'];
	$vendor_array=unserialize($row['vendor_array']);
	$yml=$row['yml'];
	$num=$row['num'];
	$title=$row['title'];
	$title_enabled=$row['title_enabled'];
	$title_shablon=$row['title_shablon'];
	$descrip=$row['descrip'];
	$descrip_enabled=$row['descrip_enabled'];
	$descrip_shablon=$row['descrip_shablon'];
	$keywords=$row['keywords'];
	$keywords_enabled=$row['keywords_enabled'];
	$keywords_shablon=$row['keywords_shablon'];
	$page=$row['page'];
	$user=$row['user'];
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
	$yml_bid_array=unserialize($row['yml_bid_array']);
	$parent=$row['parent'];
	$parent_enabled=$row['parent_enabled'];
	$files=unserialize($row['files']);
	$ed_izm=$row['ed_izm'];
	$dop_cat=$row['dop_cat'];
	
	if($parent_enabled == 0) { $p1="checked"; }
	  else {$p2="checked"; $p3="visibility:hidden";}
	
	
	if($title_enabled == 0) {
	   $t1="checked"; 
	   $t2_enabled="none";
	   $t3_enabled="none";
	   }elseif($title_enabled == 1) {
	   $t2="checked";
	   $t2_enabled="block";
	   $t3_enabled="none";
	   }
	   elseif($title_enabled == 2) {
	   $t3="checked";
	   $t3_enabled="block";
	   $t2_enabled="none";
	   }
	 
	 if($descrip_enabled == 0) {
	   $d1="checked"; 
	   $d2_enabled="none";
	   $d3_enabled="none";
	   }elseif($descrip_enabled == 1) {
	   $d2="checked";
	   $d2_enabled="block";
	   $d3_enabled="none";
	   }
	   elseif($descrip_enabled == 2) {
	   $d3="checked";
	   $d3_enabled="block";
	   $d2_enabled="none";
	   }
	   
	  if($keywords_enabled == 0) {
	   $k1="checked"; 
	   $k2_enabled="none";
	   $k3_enabled="none";
	   }elseif($keywords_enabled == 1) {
	   $k2="checked";
	   $k2_enabled="block";
	   $k3_enabled="none";
	   }
	   elseif($keywords_enabled == 2) {
	   $k3="checked";
	   $k3_enabled="block";
	   $k2_enabled="none";
	   }
	   
	   $items=$row['items'];
	   $weight=$row['weight'];
	   $price2=$row['price2'];
	   $price3=$row['price3'];
	   $price4=$row['price4'];
	   $price5=$row['price5'];

	   $baseinputvaluta=$row['baseinputvaluta'];

	   $ed_izm=$row['ed_izm'];
	   
	   // ������� �������� ��� ������ ������
	   //if($pic_small!="")
	   //AddFotoGalUpdate($pic_small,$pic_big,$id);
	   
	echo ('
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang onmouseover="GetNumName(this)">�������������� ������</span> "'.$name.'"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_actionlog_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<form name=product_edit  method=post onsubmit="Save()">
<!-- begin tab pane -->
<div class="tab-pane" id="article-tab" style="margin-top:5px;height:250px">

<script type="text/javascript">
tabPane = new WebFXTabPane( document.getElementById( "article-tab" ), true );
</script>

<!-- begin intro page -->
<div class="tab-page" id="intro-page" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "intro-page" ) );
</script>

<table cellpadding=2 width="100%">
<tr>
    <td align=left>
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������</span>:</LEGEND>
<div style="padding:10">
	
<input type=text id="myName"  style="width: 500" value="'.Disp_cat($category).'">
<input type="hidden" value="'.$category.'" name="category_new" id="myCat">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'adm_cat.php?category='.$category.'\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
	
</div>
</FIELDSET>
	</td>
	
</tr>

<tr>
	<td>
	<table width="100%">
<tr>
	<td>
	<FIELDSET id=fldLayout >

');
                                               

$sql="select dengi from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$defvaluta=$row['dengi'];


$sql="select * from ".$SysValue['base']['table_name24']." WHERE enabled=\"1\" order by num";
$result=mysql_query($sql);
$valselected=0;
$valler='';
while ($row = mysql_fetch_array($result))
    {
	$vid=$row['id'];
	$vname=$row['name'];
	$vcode=$row['code'];
	$viso=$row['iso'];
	$vkurs=$row['kurs'];
	$venabled=$row['enabled'];
	$vchecked='';
	if ($baseinputvaluta==$vid) {$valselected=1; $vchecked='checked';$cvalname=$vname;}
	if (!$valselected) {
		if($defvaluta==$vid) {
			$vchecked='checked';
			$cvalname=$vname;
		}
	}
	$valler.= '<INPUT TYPE=RADIO name="baseinputvaluta_new" value="'.$vid.'" '.$vchecked.'>'.$viso;
}

echo ('

<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>���</span> ('.$cvalname.'): </LEGEND>
<div style="padding:10">
<input type=text id="priceOne" name="priceOne" size=10 value="'.($price*1).'">
<input type="hidden" name="priceBox" id="priceBox" value="'.$price_n.'">
<input type="hidden" name="numBox" id="numBox" value="'.$sklad.'">
<input type="hidden" name="price2" id="price2" value="'.$price2.'">
<input type="hidden" name="price3" id="price3" value="'.$price3.'">
<input type="hidden" name="price4" id="price4" value="'.$price4.'">
<input type="hidden" name="price5" id="price5" value="'.$price5.'">
<input type="hidden" name="lang" value="'.$Lang.'" id="lang">
<BUTTON onclick="miniModalPrice(\'adm_price.php\',300,280);return false;" class="option"><span name=txtLang id=txtLang>���������</span></BUTTON>
<BR>
');
echo $valler;
echo ('
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������</span>: </LEGEND>
<div style="padding:10"># <input type=text name=uid_new size=17 value="'.$uid.'">
</div>
</FIELDSET>
	</td>
	<td align=left colspan="2">
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>����</span>: </LEGEND>
<div style="padding:10">
<BUTTON class="option" onclick="miniModalSpec(\'adm_spec.php\',300,130);return false;"><span name=txtLang id=txtLang>���������</span></BUTTON>
<input type="hidden" name="spec_new" id="spec_new" value="'.$spec.'">
<input type="hidden" name="newtip_new" id="newtip_new" value="'.$newtip.'">
<input type="hidden" name="enabled_new" id="enabled_new" value="'.$enabled.'">
<input type="hidden" name="num_new" id="num_new" value="'.$num.'">
</div>
</FIELDSET>
	</td>
	<td>
	<FIELDSET id=fldLayout>
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>Y</u>ML �����</span>: </LEGEND>
<div style="padding:10">
<BUTTON class="option"  onclick="miniModalYML(\'adm_yml.php\',300,180);return false;"><span name=txtLang id=txtLang>���������</span></BUTTON>
<input type="hidden" name="yml_new" id="yml_new" value="'.$yml.'">
<input type="hidden" name="p_enabled_new" id="p_enabled" value="'.$p_enabled.'">
<input type="hidden" name="yml_bid_new" id="yml_bid" value="'.$yml_bid_array['bid'].'">
<input type="hidden" name="yml_cbid_new" id="yml_cbid" value="'.$yml_bid_array['cbid'].'">
<input type="hidden" name="yml_bid_enabled" id="yml_bid_enabled" value="'.$yml_bid_array['bid_enabled'].'">
<input type="hidden" name="yml_cbid_enabled" id="yml_cbid_enabled" value="'.$yml_bid_array['cbid_enabled'].'">
</div>
</FIELDSET>
	</td>
</tr>
</table>
	</td>
</tr>
<tr>
    <td align=left >
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>����������� ������</span> #<b>'.$id.'</b>: </LEGEND>
<div style="padding:10">
<input type=text name=name_new class=full value="'.$name.'">
</div>
</FIELDSET>
	</td>
</tr>
<tr>
    <td align=left >
	
	<table cellpadding="0" cellspacing="0" width="100%">
<tr>
   <td align=left >
<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������������ ������ ��� ���������� �������</span>:</LEGEND>
<div style="padding:10">
	<textarea class=full  name=odnotip_new style="height:40px">'.$odnotip.'</textarea>
	<img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <span name=txtLang id=txtLang>������� ID ������� � ������� 1,2,3</span>
</div>
</FIELDSET>
	</td>
	<td style="padding-left:5px" valign="top" width="300">
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�������������  ��������</span>:</LEGEND>
<div style="padding:10">
<textarea class=full  name="dop_cat_new" style="height:40px">'.$dop_cat.'</textarea>
<img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> ������� ID ��������� � ������� #1#2#3#
</div>
</FIELDSET>
   </td>
</tr>
</table>
	</td>
</tr>
<tr>
    <td align=left >
	<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="200" valign="top">
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>����</span>:</LEGEND>
<div style="padding:10">
<input type=text name="items_new"  value="'.$items.'"> ��.
</FIELDSET>
</div>
	</td>
	<td style="padding-left:5px" valign="top">
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>��</span>:</LEGEND>
<div style="padding:10">
<input type=text name="weight_new"  value="'.$weight.'"> ��.
</FIELDSET>
</div>
	</td>

	<td style="padding-left:5px" valign="top">
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������ ���������</span>:</LEGEND>
<div style="padding:10">
<input type=text name="edizm_new"  value="'.$ed_izm.'">
</FIELDSET>
</div>
	</td>
	


</tr>
</table>

	
	

	</td>
</tr>



</table>
</div>
');

echo '

<div class="tab-page" id="files" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>�����</span></h2>
<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "files" ) );
</script>
<div style="height:420px;overflow:auto">
<table width="100%">
<tr>
  <td>

';
?>

<SCRIPT language=JavaScript>
var numb;
numb = <? echo count($files)-1;?>;
function add_new_row() {
    var currrow;
    currow = document.all.tbl.rows.length; // ��������� ���������� ����� � �������
    numb++;
    document.all.tbl.insertRow(currow); // ��������� ������ � �������
    document.all.tbl.rows[currow].insertCell(0); // ��������� ������
    document.all.tbl.rows[currow].insertCell(1);
    document.all.tbl.rows[currow].insertCell(2);

    document.all.tbl.rows[currow].cells[0].className="";
    document.all.tbl.rows[currow].cells[1].className="";
    document.all.tbl.rows[currow].cells[2].className="";
	
    document.all.tbl.rows[currow].cells[0].style.padding="5px";
    document.all.tbl.rows[currow].cells[0].innerHTML = '<INPUT TYPE=TEXT style="width:90%;" name=\"filenum[]\" id="filenum'+numb+'"><BUTTON style="width: 50px;" onclick="ReturnPic(\'filenum'+numb+'\',0);return false;"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>';
    document.all.tbl.rows[currow].cells[1].innerHTML = '<BUTTON onclick="remove_row();"><img src="../icon/wand.gif"  width="16" height="16" border="0" align="absmiddle"> -</BUTTON>';
}

function remove_row() {
    var currrow;
    numb--;
    currow = document.all.tbl.rows.length-1; // ��������� ���������� ����� � �������
    document.all.tbl.deleteRow(currow); // ��������� ������ � �������
}
</SCRIPT>
<?

echo '

<TABLE id=tbl style="width:100%; border:1px solid gray; background:#ffffff;" CELLPADDING="0" CELLSPACING=0>
<TR>
<TD id=pane style="width: 90%;">����</TD>
<TD><BUTTON  
onclick="add_new_row();return false;">
<img src="../icon/wand.gif"  width="16" height="16" border="0" align="absmiddle"> +</BUTTON>
</TD>
</TR>
';

if (is_array($files))
foreach ($files as $num=>$cfile) {
	echo '
<TR><TD style="padding:5px">
<INPUT TYPE=TEXT style="width:90%;" name="filenum[]" id="filenum'.$num.'" value="'.$cfile.'">
<BUTTON style="width: 50px;" 
onclick="ReturnPic(\'filenum'.$num.'\',0);return false;">
<img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
</TD><TD>
<BUTTON 
onclick="remove_row();return false;">
<img src="../icon/wand.gif"  width="16" height="16" border="0" align="absmiddle"> -</BUTTON>
</TD></TR>
';
} //������� ����� �����
echo '
</TABLE>

  </td>
</tr>
</table>

</div>
</div>
';


echo ('
<div class="tab-page" id="gal" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>�����������</span></h2>
<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "gal" ) );
</script>
<table width="100%">
<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
	<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������� ����������� � �������:</span></LEGEND>
<div style="padding:10">
	<input type="text" name="pic_resize" id="pic_resize" style="width: 500">
	<BUTTON style="width: 3em; height: 2.2em; margin-left:5" onclick="ReturnPicResize('.$id.');return false;"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
<br><br><span name=txtLang id=txtLang>
* �������<a href="javascript:miniWin(\'../system/adm_system.php\',500,380)"><img src="../img/i_eraser[1].gif" alt="���������" width="16" height="16" border="0" align="absmiddle" title="���������" hspace="3">���������</a>: ������� �������� (W='.$Admoption['img_w'].'px; H='.$Admoption['img_h'].'px), ��������� �������� (W='.$Admoption['img_tw'].'px; H='.$Admoption['img_th'].'px) ������.</span><br>
</div>
</FIELDSET>
	</td>
</tr>


<tr>
	<td colspan=3>
	
	<!-- begin tab pane -->
<div class="tab-pane" id="article-tab-2" style="margin-top:5px;">

<script type="text/javascript">
tabPane2 = new WebFXTabPane( document.getElementById( "article-tab-2" ), true );
</script>


<!-- begin page -->
<div class="tab-page" id="image1">
<h2 class="tab"><span name=txtLang id=txtLang>�����������</span></h2>

<script type="text/javascript">
tabPane2.addTabPage( document.getElementById( "image1" ) );
</script>


<div align="left"> 
<table cellpadding="0" cellspacing="1"  border="0" >
<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
	<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>��������</span>: </LEGEND>
<div style="padding:10">
	<input type="text" name="pic_small_new" id="pic_small" style="width: 500" value="'.$pic_small.'">
	<BUTTON style="width: 3em; height: 2.2em; margin-left:5" onclick="ReturnPic(\'pic_small\');return false;"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
	<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������</span>: </LEGEND>
<div style="padding:10">
	<input type="text" name="pic_big_new" id="pic_big" style="width: 500" value="'.$pic_big.'">
	<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="ReturnPic(\'pic_big\');return false;"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
</div>
</FIELDSET>
	</td>
</tr>
</table>
</div>
</div>


<!-- begin page -->
<div class="tab-page" id="image2">
<h2 class="tab"><span name=txtLang id=txtLang>�����������</span></h2>

<script type="text/javascript">
tabPane2.addTabPage( document.getElementById( "image2" ) );
</script>


<div align="left" style="height:200;overflow:auto" id="fotolist"> 
<table cellpadding="0" cellspacing="1"  border="0" bgcolor="#808080" width="100%">
<tr>
    <td width="20" id=pane align=center>�</td>
	<td width="400 "id=pane align=center>����������</td>
</tr>
    '.ListFotoGal($id).'
    </table>
</div>
</div>







</div>
	
	
	


	</td>
</tr>
</table>

</div>
<div class="tab-page" id="description" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>������� ��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "description" ) );
</script>

<table width="100%">

<tr>
	<td colspan=3>
	<FIELDSET id=fldLayout>
<div style="padding:10">
	');

$option=unserialize($systems['admoption']);
if($option['editor_enabled']  == 1){
$MyStyle=$SysValue['dir']['dir'].chr(47)."phpshop".chr(47)."templates".chr(47).$systems['skin'].chr(47).$SysValue['css']['default'];
echo'
<pre id="idTemporary" name="idTemporary" style="display:none">
'.$description.'
</pre>
	<script>
		var oEdit1 = new InnovaEditor("oEdit1");
	oEdit1.cmdAssetManager="modalDialogShow(\''.$SysValue['dir']['dir'].'/phpshop/admpanel/editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit1.width=600;
		oEdit1.height=380;
		oEdit1.btnStyles=true;
	    oEdit1.css="'.$MyStyle.'";
		oEdit1.RENDER(document.getElementById("idTemporary").innerHTML);
	</script>
	<input type="hidden" name="EditorContent" id="EditorContent">';
}
else{
echo '
<textarea name="EditorContent" id="EditorContent" style="width:100%;height:380px">'.$description.'</textarea>
';
}

echo('
</div>
</FIELDSET>
	</td>
</tr>

</table>
</div>
<div class="tab-page" id="content" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>��������� ��������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "content" ) );
</script>
<table width="100%">
<tr>
	<td colspan=3>
	<FIELDSET>
<div style="padding:10">
	');
if($option['editor_enabled']  == 1){
echo'
<pre id="idTemporary2" name="idTemporary2" style="display:none">
'.$content.'
</pre>
	<script>
		var oEdit2 = new InnovaEditor("oEdit2");
	oEdit2.cmdAssetManager="modalDialogShow(\''.$SysValue['dir']['dir'].'/phpshop/admpanel/editor3/assetmanager/assetmanager.php\',640,500)";
		oEdit2.width=600;
		oEdit2.height=380;
		oEdit2.btnStyles=true;
	    oEdit2.css="'.$MyStyle.'";
		oEdit2.RENDER(document.getElementById("idTemporary2").innerHTML);
	</script>
	<input type="hidden" name="EditorContent2" id="EditorContent2">';
	
}
else{
echo '
<textarea name="EditorContent2" id="EditorContent2" style="width:100%;height:380px">'.$content.'</textarea>
';
}
echo('
</div>
</FIELDSET>
<input type="hidden" class=but  name="fullDisp" value="Edit">
	</td>
</tr>
</table>
</div>
<div class="tab-page" id="pages" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "pages" ) );
</script>
<table><tr>
    <td align=left valign="top">
	
	<FIELDSET id=fldLayout >
<div style="padding:10">
'.dispPage($page).'
</div>
</FIELDSET>

	</td>
</tr></table>
</div>

<div class="tab-page" id="twer" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>���������</span></h2>

<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "twer" ) );
</script>
<table width="100%">
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>T</u>itle:</LEGEND>
<div style="padding:10;width: 100%">
<input type="radio" value="0" name="title_enabled_new" onclick="document.getElementById(\'titleForma\').style.display=\'none\';document.getElementById(\'titleShablon\').style.display=\'none\'" '.$t1.'> <span name=txtLang id=txtLang>�������������� ���������</span>&nbsp;&nbsp;&nbsp;
<input type="radio" value="2" name="title_enabled_new" onclick="document.getElementById(\'titleShablon\').style.display=\'block\';document.getElementById(\'titleForma\').style.display=\'none\'" '.$t3.'> <span name=txtLang id=txtLang>��� ������</span> &nbsp;&nbsp;&nbsp;
<input type="radio" value="1" name="title_enabled_new"  onclick="document.getElementById(\'titleForma\').style.display=\'block\';document.getElementById(\'titleShablon\').style.display=\'none\'" '.$t2.'> <span name=txtLang id=txtLang>������ ���������</span><br>
<div id="titleShablon" style="display:'.$t3_enabled.'">
<textarea style="width: 100%; height: 5em;" name="title_shablon_new" id="Shablon">'.$title_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'Shablon\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'Shablon\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'Shablon\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'Shablon\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'Shablon\')" class="buttonSh">
</div>
<div id="titleForma" style="display:'.$t2_enabled.'">
<textarea style="width: 100%; height: 5em;" name="title_new">'.$title.'</textarea>
</div>
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>D</u>escription:</LEGEND>
<div style="padding:10;width: 100%">
<input type="radio" value="0" name="descrip_enabled_new" onclick="document.getElementById(\'titleFormaD\').style.display=\'none\';document.getElementById(\'titleShablonD\').style.display=\'none\'" '.$d1.'> <span name=txtLang id=txtLang>�������������� ���������</span>&nbsp;&nbsp;&nbsp;
<input type="radio" value="2" name="descrip_enabled_new" onclick="document.getElementById(\'titleShablonD\').style.display=\'block\';document.getElementById(\'titleFormaD\').style.display=\'none\'" '.$d3.'> <span name=txtLang id=txtLang>��� ������</span> &nbsp;&nbsp;&nbsp;
<input type="radio" value="1" name="descrip_enabled_new"  onclick="document.getElementById(\'titleFormaD\').style.display=\'block\';document.getElementById(\'titleShablonD\').style.display=\'none\'" '.$d2.'> <span name=txtLang id=txtLang>������ ���������</span><br>
<div id="titleShablonD" style="display:'.$d3_enabled.'">
<textarea style="width: 100%; height: 5em;" name="descrip_shablon_new" id="ShablonD">'.$descrip_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonD\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonD\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'ShablonD\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="������ �����" onclick="ShablonPromt(\'ShablonD\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonD\')" class="buttonSh">
</div>
<div id="titleFormaD" style="display:'.$d2_enabled.'">
<textarea style="width: 100%; height: 5em;" name="descrip_new">'.$descrip.'</textarea>
</div>
</div>
</FIELDSET>
  </td>
</tr>
<tr>
  <td width="100%">
  <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>K</u>eywords:</LEGEND>
<div style="padding:10;width: 100%">
<input type="radio" value="0" name="keywords_enabled_new" onclick="document.getElementById(\'titleFormaK\').style.display=\'none\';document.getElementById(\'titleShablonK\').style.display=\'none\'" '.$k1.'> <span name=txtLang id=txtLang>�������������� ���������</span>&nbsp;&nbsp;&nbsp;
<input type="radio" value="2" name="keywords_enabled_new" onclick="document.getElementById(\'titleShablonK\').style.display=\'block\';document.getElementById(\'titleFormaK\').style.display=\'none\'" '.$k3.'> <span name=txtLang id=txtLang>��� ������</span> &nbsp;&nbsp;&nbsp;
<input type="radio" value="1" name="keywords_enabled_new"  onclick="document.getElementById(\'titleFormaK\').style.display=\'block\';document.getElementById(\'titleShablonK\').style.display=\'none\'" '.$k2.'> <span name=txtLang id=txtLang>������ ���������</span><br>
<div id="titleShablonK" style="display:'.$k3_enabled.'">
<textarea style="width: 100%; height: 5em;" name="keywords_shablon_new" id="ShablonK">'.$keywords_shablon.'</textarea>
<input type="button" name="btnLang" value="�������" onclick="ShablonAdd(\'@Catalog@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="����������" onclick="ShablonAdd(\'@Podcatalog@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@Product@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonAdd(\'@System@\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="���������" onclick="ShablonAdd(\'@Generator@\',\'ShablonK\')" class="buttonSh">
<input type="button" value="," onclick="ShablonAdd(\',\',\'ShablonK\')" class="buttonSh">
<input type="button" value="-" onclick="ShablonAdd(\'-\',\'ShablonK\')" class="buttonSh">
<input type="button" value="/" onclick="ShablonAdd(\'/\',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="������" onclick="ShablonAdd(\' \',\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="�����" onclick="ShablonPromt(\'ShablonK\')" class="buttonSh">
<input type="button" name="btnLang" value="��������" onclick="ShablonDell(\'ShablonK\')" class="buttonSh">
</div>
<div id="titleFormaK" style="display:'.$k2_enabled.'">
<textarea style="width: 100%; height: 5em;" name="keywords_new">'.$keywords.'</textarea>
</div>
</div>
</FIELDSET>
  </td>
</tr>
</table>
</div>
<div class="tab-page" id="har" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>��������������</span></h2>
<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "har" ) );
</script>
<div style="height:420px;overflow:auto">
<table width="100%">'.DispCatSort($category,$vendor_array).'
</table>

</div>
</div>
<div class="tab-page" id="har2" style="height:450px">
<h2 class="tab"><span name=txtLang id=txtLang>�������</span></h2>
<script type="text/javascript">
tabPane.addTabPage( document.getElementById( "har2" ) );
</script>

<table width="100%">
<tr>
	<td>
	
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout> <span name=txtLang id=txtLang><u>�</u>����</span></LEGEND>
<div style="padding:10">
<input type="radio" value="0" name="parent_enabled_new" '.$p1.' onclick="ShowPodtipOption(this.value)"> <span name=txtLang id=txtLang>������� �����</span>
<input type="radio" value="1" name="parent_enabled_new" '.$p2.' onclick="ShowPodtipOption(this.value)"> <span name=txtLang id=txtLang>���������� ����� ��� �������� ������</span>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
	<td id="podtip_list" style="'.$p3.'">
	
	<FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>������ ������</span></LEGEND>
<div style="padding:10">
<textarea class=full name=parent_new style="height:40px">'.$parent.'</textarea><br><br>
<img src="../icon/icon_info.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <span name=txtLang id=txtLang>������� �������������� (ID) ������� ����� ������� ��� �������</span> (100,101).
</div>
</FIELDSET>
	</td>
</tr>

</table>
</div>

<hr>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
    <td align="left" style="padding:10">
    <BUTTON class="help" onclick="helpWinParent(\'productID\')">�������</BUTTON>
	</td>
	<td align="right" style="padding:10">
<input type=submit name=productSAVE value="��" style="width: 7em; height: 2.2em; ">
<input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
<input type="hidden"  class=but  name="productDELETE" id="productDELETE">
<input type="hidden" name="user" value="'.$user.'">
<input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
<input type=hidden name="productID" id="productID" value='.$id.'>
	</td>
</tr>
</table>
</form>
	');
	}
	}
?>
</body>
</html>
