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
	<title>��������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,300,220);
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
$Name=$SysValue['Lang']['Window'];


function GetInfoUsers($n){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name27']." where id=$n";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row;
}

function GetInfoProduct($n){
global $SysValue;
$sql="select name, sklad, uid, price, datas from ".$SysValue['base']['table_name2']." where id=$n";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row;
}

function dispPage(){ // ����� ������ �� ����
global $SysValue;
$array=explode(",",$array);
$sql="select * from ".$SysValue['base']['table_name11']." order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $link=$row['link'];
    $name=substr($row['name'],0,200);
    @$dis.="<option value=".$link.">".$name."</option>\n";
	}
@$disp="
<select name=page_new[] size=5 style=\"width: 280;\" multiple>

$dis
</select>
";
return @$disp;
}


function dispValue($n){ // ����� �������������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name21']." where category='$n' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=substr($row['name'],0,35);
    @$dis.="<option value=".$id.">".$name."</option>\n";
	}
@$disp="
<select name=vendor_new[".$n."] size=1 style=\"width: 250;\">
<option>��� ������</option>
$dis
</select>
";
return @$disp;
}

function DispCatSort($category,&$h){
global $SysValue;
$sql="select sort from ".$SysValue['base']['table_name']." where id=$category";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$sort=unserialize($row["sort"]);
if(is_array($sort))
foreach($sort as $v){
$sql="select * from ".$SysValue['base']['table_name20']." where id=$v order by name";
$result=mysql_query($sql);
while (@$row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
@$disp.= '
<div style="padding-top:7">
<FIELDSET id=fldLayout >
<LEGEND><input type="checkbox" name="vendor_cat['.$id.']" value="1"> '.$name.'</LEGEND>
<div style="padding:10">
'.dispValue($id).'
</div>
</FIELDSET>
</div>
';
@$n++;
}
}
$h=$h+(30*$n);
return @$disp;
}


if($do==14){
echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	<span name=txtLang id=txtLang><u>�</u>�������� � �������</span><br>
	<input type=text id="myName"  style="width: 230" value="">
<input type="hidden" name="category_new" id="myCat">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'../catalog/adm_cat.php\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
	<td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
if($do==37){ // �������� ������ �������
$sql="select * from ".$SysValue['base']['table_name32'];
$result=mysql_query($sql);
while(@$row = mysql_fetch_array(@$result))
    {
	if($n==$row['id'])  $sel2="selected";
	 else $sel2="";
	@$dis.="<option value='".$row['id']."' $sel2>".$row['name']."</option>";
	}

echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	������:<br>
<select name=statusi_new>
<option value=0>����� �����</option>
'.@$dis.'
</select>
	<br>
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
	<td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
elseif($do==34){ // �������� ���������� � �������
echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	<span name=txtLang id=txtLang><u>�</u>�������� � �������</span><br>
	<input type=text id="myName"  style="width: 230" value="">
<input type="hidden" name="category_new" id="myCat">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'../page/adm_cat.php\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
	<td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
elseif($do==15){
echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	<span name=txtLang id=txtLang><u>�</u>����� ��� ��������� ������</span><br>
	<input type=text name="uid_new"  style="width: 280"><br>
	<span name=txtLang id=txtLang>* ������� �������������� (ID) ������� ����� �������</span> (100,101). 
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
	<td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
elseif($do==35){ // ��������������� ������ ��� �������
echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	<span name=txtLang id=txtLang><u>�</u>����� ��� ������������</span><br>
	<input type=text name="uid_new"  style="width: 280"><br>
	<span name=txtLang id=txtLang>* ������� �������������� (ID) ������� ����� �������</span> (100,101). ������ ����� ��������� ��������.
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
	<td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
elseif($do==23){
echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
	<td>
	'.dispPage().'
	</td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="30" >
<tr>
	<td align="right" style="padding-right:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
elseif($do==24){
$h=220;
echo'
<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<table width="100%">
<tr>
	<td>
	'.DispCatSort($catal,&$h).'
	</td>
</tr>
</table>
<script>
DoResize('.$GetSystems['width_icon'].',300,'.$h.');
</script>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="30" >
<tr>
	<td align="right" style="padding-right:10">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
	<input type=hidden name=IDS value="'.$ids.'">
	<input type=hidden name=DO value="'.$do.'">
	</td>
</tr>
</table>
</form>
';
}
else{
echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>��������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_documentation_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
<br>
<form action=\"$PHP_SELF\" method=\"post\">
	<div style=\"padding:10\" align=\"center\">
	";
	if($action == "wait") echo "���� ��������� �������...";
	else echo "
	<span name=txtLang id=txtLang>�� �������, ��� ������</span> <b>".$SysValue['Lang']['Window'][$do]."</b>? <br>
";
    echo "
	</div>
<hr>
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" >
<tr>
	<td align=\"right\" style=\"padding:10\">
<input type=submit value=�� class=but name=productSAVE>
	<input type=submit name=btnLang value=������ class=but onClick=\"return onCancel();\">
	<input type=hidden name=IDS value='$ids'>
	<input type=hidden name=DO value='$do'>
	<input type=hidden name=action value='wait'>
	</td>
</tr>
</table>
</form>
";
}
if(CheckedRules($UserStatus["cat_prod"],1) == 1){
if(isset($productSAVE))// ������ ��������������
{
$IdsArray=split(",",$IDS);

if($DO==1){// ������� �����
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from $table_name2 
    where id='0' $string;";
$pageReload="cat_prod";
}
elseif($DO==2){// � ����������������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
spec='1'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==3){// �� ���������������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
spec='0'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==4){// �� �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
enabled='0'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==5){// � �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
enabled='1'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==6){// �� ������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
yml='0'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==7){// � �����

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
yml='1'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==8){// � CSV

$sql="--";
echo"
<script>
window.open('../export/adm_csv.php?IDS=".$IDS."');
</script>
";
$pageReload="cat_prod";
}
elseif($DO==10){// � �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
newtip='1'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==11){// �� �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
newtip='0'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==12){// �������� �����

$sql="UPDATE $table_name5
SET
total='0'
where category='$IDS'";
$pageReload="opros";
}
elseif($DO==14 and !empty($category_new)){// ��������� � �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE $table_name2
SET
category='$category_new'
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO==34 and !empty($category_new)){// ��������� � �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
category='$category_new'
where id='0' $string";
$pageReload="page_site_catalog";
}
elseif($DO==37){// �������� ������� �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name1']."
SET
statusi='$statusi_new'
where id='0' $string";
$pageReload="orders";
}
elseif($DO==41){// ������� �����������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";
   
$sql="delete from ".$SysValue['base']['table_name36']."
    where id='0' $string";
$pageReload="comment";
}
elseif($DO==35 and !empty($uid_new)){// ��������������� ������ ��� �������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
odnotip='$uid_new'
where id='0' $string";
$pageReload="page_site_catalog";
}
elseif($DO==15){// ��������� ����� � ���� ������

foreach ($IdsArray as $v) 
   @$string.="i".$v."i";
$sql="INSERT INTO ".$SysValue['base']['table_name26']." 
VALUES ('','$string','$uid_new','1')";
$pageReload="search_pre";
}
elseif($DO==16){// ������� �� �������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name18']."
    where id='0' $string";
$pageReload="search_jurnal";
}
elseif($DO==17){// ������� �� ���� ������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name26']."
    where id='0' $string";
$pageReload="search_pre";
}
elseif($DO==18){// �� ��������� ��� ������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";
$pageReload="search_pre";
$sql="UPDATE ".$SysValue['base']['table_name26']."
SET
enabled='0'
where id='0' $string";
$pageReload="search_pre";
}
elseif($DO==19){// �������������� ��� ������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name26']."
SET
enabled='1'
where id='0' $string";
$pageReload="search_pre";
}
elseif($DO==20){// ������������� �������������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name27']."
SET
enabled='0'
where id='0' $string";
$pageReload="shopusers";
}
elseif($DO==21){// �������������� �������������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name27']."
SET
enabled='1'
where id='0' $string";
$pageReload="shopusers";
}
elseif($DO==22){// ������� �������������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name27']."
    where id='0' $string";
$pageReload="shopusers";
}
elseif($DO==23){// ������������ ������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

if(is_array($page_new))
foreach($page_new as $value)
@$page.=$value.",";
   
$sql="UPDATE $table_name2
SET
page='$page' 
where id='0' $string";
$pageReload="cat_prod";
}
elseif($DO == 25){// ��������� �����������
require_once "../../lib/sms/smsapi.php";
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";
   
$sql="select * from ".$SysValue['base']['table_name34']." where id='0' $string";
@$result=mysql_query(@$sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
    $datas=$row['datas'];
	$datas_start=$row['datas_start'];
	$user_id=$row['user_id'];
    $product_id=$row['product_id'];
	
	$User=GetInfoUsers($user_id);
	$Product=GetInfoProduct($product_id);
	
	
// ���� ������
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$GetSystems['adminmail2'].">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$GetSystems['name']." - ��������� ����������� � ������, ������ �$id ";

$content_adm="
������� �������!
--------------------------------------------------------

��������� ����������� �$id � ��������-�������� '".$GetSystems['name']."' ��� ������������ ".$User['name']."

�����: ".$Product['name']."
���: ".$Product['uid']."
������� ���������: ".$Product['price']."
���� ��������� ���������� �� ������: ".dataV($Product['datas'])."
����: http://".$SERVER_NAME."/shop/UID_".$product_id.".html
���� ����������� ������: ".dataV($datas_start)."
���������� ������ ��: ".dataV($datas)."

---------------------------------------------------------

Powered & Developed by www.PHPShop.ru";
mail($User['mail'],$zag_adm, $content_adm, $header_adm) or die("�� ���� ��������� �����������");

// ��������� �����������
mysql_query("UPDATE ".$SysValue['base']['table_name34']." SET enabled='1' where id=$id");

// �������� SMS
if($option['notice_enabled'] == 1){
 $msg = "����� �������� � �������, �����������: http://$SERVER_NAME/shop/UID_$product_id.html";
 $phone = $User['tel_code']."".$User['tel'];
 SendSMS($msg,$phone);
 }
 
}
	
$pageReload="shopusers_notice";
}
elseif($DO==26){// ������� �����������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name34']."
    where id='0' $string";
$pageReload="shopusers_notice";
}
elseif($DO==39){// ������� ��������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name11']."
    where id='0' $string";
$pageReload="page_site_catalog";
}
elseif($DO==40){// ������� ����������� � ������ ��� ����� ������
$sql="delete from ".$SysValue['base']['table_name35']." where parent=$IDS";
$pageReload="";
}
elseif($DO==27){// �������� ��� ��� � �������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name2']."
SET
sklad='1'
where id='0' $string";
	
$pageReload="cat_prod";
}
elseif($DO==28){// �������� ��� ���� � �������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name2']."
SET
sklad='0'
where id='0' $string";
	
$pageReload="cat_prod";
}

elseif($DO==30){// �������� ������� ��� ������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
enabled='1'
where id='0' $string";
	
$pageReload="page_site_catalog";
}
elseif($DO==31){// �������� ������� ��� ������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
enabled='0'
where id='0' $string";
	
$pageReload="page_site_catalog";
}
elseif($DO==32){// �������� ������� ������������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
secure='1'
where id='0' $string";
	
$pageReload="page_site_catalog";
}
elseif($DO==33){// �������� ������� ������������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="UPDATE ".$SysValue['base']['table_name11']."
SET
secure='0'
where id='0' $string";
	
$pageReload="page_site_catalog";
}
elseif($DO==29){// ������������� ��������� �����������


$sql="select * from ".$SysValue['base']['table_name34']." where datas>'".date("U")."' and enabled='0'";

$result=mysql_query($sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
    $datas=$row['datas'];
	$datas_start=$row['datas_start'];
	$user_id=$row['user_id'];
    $product_id=$row['product_id'];
	
	$User=GetInfoUsers($user_id);
	$Product=GetInfoProduct($product_id);
	
	if($Product['sklad'] == 0){
	
// ���� ������
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$GetSystems['adminmail2'].">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$GetSystems['name']." - ��������� ����������� � ������, ������ �$id ";

$content_adm="
������� �������!
--------------------------------------------------------

��������� ����������� �$id � ��������-�������� '".$GetSystems['name']."' ��� ������������ ".$User['name']."

�����: ".$Product['name']."
���: ".$Product['uid']."
������� ���������: ".$Product['price']."
���� ��������� ���������� �� ������: ".dataV($Product['datas'])."
����: http://".$SERVER_NAME."/shop/UID_".$product_id.".html
���� ����������� ������: ".dataV($datas_start)."
���������� ������ ��: ".dataV($datas)."

---------------------------------------------------------

Powered & Developed by www.PHPShop.ru";
mail($User['mail'],$zag_adm, $content_adm, $header_adm);

// ��������� �����������
mysql_query("UPDATE ".$SysValue['base']['table_name34']." SET enabled='1' where id=$id");


// �������� SMS
if($option['notice_enabled'] == 1){
 $msg = "����� �������� � �������, �����������: http://$SERVER_NAME/shop/UID_$product_id.html";
 $phone = $User['tel_code']."".$User['tel'];
 SendSMS($msg,$phone);
 }

}

}
	
$pageReload="shopusers_notice";
}
elseif($DO==36){// ������� �� �������
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="delete from ".$SysValue['base']['table_name1']."
    where id='0' $string";
$pageReload="orders";
}
elseif($DO==24){// ��������������

foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";

$sql="select vendor_array from $table_name2 where id='0' $string";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){
$vendor_array=unserialize($row['vendor_array']);
   
if(is_array($vendor_new))
foreach($vendor_new as $k=>$v){
      if($vendor_cat[$k] == 1){
      @$vendor.="i".$k."-".$v."i";
	  $vendor_new[$k]=$v;
	  }
	    else {
		@$vendor.="i".$k."-".$vendor_array[$k]."i";
		$vendor_new[$k]=$vendor_array[$k];
		}
}
}

$sql="UPDATE $table_name2
SET
vendor='$vendor',
vendor_array='".serialize($vendor_new)."' 
where id='0' $string";
$pageReload="cat_prod";

//echo($vendor);

}

$result=mysql_query($sql);
echo"
	 <script>
	 DoReloadMainWindow('$pageReload');
	 </script>
	   ";
	   
}
}else $UserChek->BadUserFormaWindow();
?>
</body>
</html>

