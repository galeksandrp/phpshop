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
	<title>�������������� ��������</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang; ?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang; ?>/language_interface.js"></script>
<script>
function DoSet(){
var sum=document.getElementById('taxa').value;
if (sum>0) {document.getElementById('taxa_enabled').checked=true;} else {document.getElementById('taxa_enabled').checked=false;}
}
function newfolder() {
window.top.frame2.location.reload('admin_delivery_content.php?act=newfolder');
}
function newdelivery() {
window.top.frame2.location.reload('admin_delivery_content.php?act=newdelivery');
}
function Cancel() {
window.top.frame2.location.reload('admin_delivery_content.php');
}
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
// �������������� ������� 
	$sql="select * from ".$SysValue['base']['table_name30']." where id='$id'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);

	$sqlf="select * from ".$SysValue['base']['table_name30']." where PID='$id'";
	$resultf=mysql_query($sqlf);
	$numf=mysql_num_rows($resultf);


	  $id=$row['id'];
	  $PID=$row['PID'];
	  $city=$row['city'];
	  $price=$row['price'];
	  $is_folder=$row['is_folder'];
	  if ($numf>0) {$is_folder=1;}
	  if (!($row['taxa'])) {$taxa=0; $taxaenabled='';} else {$taxa=$row['taxa'];$taxaenabled='checked';}
	  if($row['enabled']==1) $fl="checked";
	    else $fl2="checked";
	       if($row['flag']==1) $f3="checked";
	  $price_null=$row['price_null'];
      if($row['price_null_enabled']==1) $f4="checked";
?>
<table cellpadding="0" cellspacing="0" width="100%" height="17" id="title">
<tr>
	<td id="but1"  class="butoff" style="text-align:center;"  onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="newfolder();"><img name="imgLang" src="../icon/folder_add.gif" alt="����� �������" width="16" height="16" border="0">�������&nbsp;�����</td>
   <td width="3"></td>
	<td id="but2"  class="butoff" style="text-align:center;"  onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="newdelivery();"><img name="imgLang" src="../icon/page_new.gif" alt="����� �������" width="16" height="16" border="0">�������&nbsp;�������</td>

</tr>
</table>
<?
//�������� ������� ����������

if (isset($id) || isset($act)) {
?>


<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
<?
if (isset($id)) {
	$create='�������������� �������� "'.$city.'"';
} else {
	if ($act=="newdelivery") {
		$create='�������� ����� ��������';
		$is_folder=0;
	} else {
		$create='�������� ����� ��������';
		$is_folder=1;
	}
}

?>
	<b><span name=txtLang id=txtLang><?=$create?></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="../img/i_mail_forward_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
<tr>
	<td>



	<FIELDSET style="height:50px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>������� ��������</span></LEGEND>
<div style="padding:10">
<textarea cols="" rows="" name="city_new" style="width:160px"><?=$city?></textarea> 
<input type="checkbox" name="flag_new" value="1"  <?=@$f3?>><span name=txtLang id=txtLang>�������� �� ���������</span>
</div>
</FIELDSET>

	<FIELDSET style="height:20px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>������� ��������</span></LEGEND>
<div style="padding:10">

<select name="NPID">
<option value="0" selected>[������]</option>
<?
// �������
function DelivSelList ($cid,$PID,$nPID=0,$lvl=0) {
global $SysValue;

$sql='select * from '.$SysValue['base']['table_name30'].' where ((PID='.$nPID.') AND is_folder=1) order by city';
//$display=$sql;
$result=mysql_query($sql);
$lvl++;
while ($row = mysql_fetch_array($result))
    {
	$nid=$row['id'];
	if ($nid==$cid) {continue;}

	$nPID=$row['PID'];
	$city=$row['city'];
	$spacer='';
	for ($ii=1;$ii<$lvl;$ii++) {
		$spacer.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	if ($lvl>1) {$pointer='|&ndash;>&nbsp;';} else {$pointer='';}
        if ($nid==$PID) {$sel='selected';} else {$sel='';}
	@$display.='<option value="'.$nid.'" '.$sel.'>'.$spacer.$pointer.$city.'</option>';
        $display.=DelivSelList ($cid,$PID,$nid,$lvl);
	}

return $display;

} //����� DelivList
	echo DelivSelList ($id,$PID);
?>


</select>
</div>
</FIELDSET>

	</td>
	<td style="vertical-align:top;">
<? if ($is_folder==0 || $act=="newdelivery") { ?>
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span> </LEGEND>
<div style="padding:10">
<input type="text" name="price_new" value="<?=$price?>" style="width:50px;" > <?=GetIsoValutaOrder()?>
</div>
</FIELDSET>

<? }?>
	</td>
	<td style="vertical-align:top;">
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" <?=@$fl?>><span name=txtLang id=txtLang>��</span><br>
<input type="radio" name="enabled_new" value="0" <?=@$fl2?>><font color="#FF0000"><span name=txtLang id=txtLang>���</span></font>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
  <td colspan="3">
<? if ($is_folder==0 || $act=="newdelivery") { ?>
  <FIELDSET>
<LEGEND><input type="checkbox" name="price_null_enabled_new" value="1"  <?=@$f4?>> <span name=txtLang id=txtLang><u>�</u>��������� ��������</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>�����</span> <input type="text" name="price_null_new" value="<?=$price_null?>" style="width:100px;" > <?=GetIsoValutaOrder()?> <span name=txtLang id=txtLang>�������� ���������</span>
</div>
</FIELDSET>
<? }?>
  </td>
</tr>


<tr>
  <td colspan="3">
<? if ($is_folder==0 || $act=="newdelivery") { ?>
  <FIELDSET>
<LEGEND><input type="checkbox" id="taxa_enabled" name="taxa_enabled" value="1" <?=$taxaenabled?> disabled> <span name=txtLang id=txtLang>������������ <u>�</u>���� �� ������ 0.5�� ����. (����� <B>��������</B> ���������� �������� � ���� ������ 0)</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>������������ ��� ������� �������������� ����������� (��������, ��� "����� ������")<BR>������ �������������� 0.5 �� ����� ������� 0.5�� ����� ������ </span> <input type="text" name="taxa_new" id="taxa" value="<?=$taxa?>" style="width:100px;" onChange="DoSet();"> <?=GetIsoValutaOrder()?> 
</div>
</FIELDSET>
<? }?>
  </td>
</tr>

</table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50" >
<tr>
	<td align="right" style="padding:10">
<input type="hidden" name="id" value="<?=$id?>" >
<? if (isset($id)) {?>
	<input type="submit" name="editID" value="OK" class=but>
	<input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
    <input type="hidden" class=but  name="productDELETE" id="productDELETE">
<? } else { ?>
	<input type="submit" name="newID" value="OK" class=but>
<? }?>
	<input type="button" name="btnLang" class=but value="������" onClick="Cancel();">
	</td>
</tr>
</table>
</form>
<?
} //���� ��� ID � ��������, �� ���������� �����

if(isset($newID) and !empty($city_new))// ������ ��������������
{
if(CheckedRules($UserStatus["delivery"],1) == 1) {
	if ($act=="newfolder") {$is_folder=1;} else {$is_folder=0;}
	$sql="INSERT INTO ".$SysValue['base']['table_name30']."
	VALUES ('','$city_new','$price_new','$enabled_new','$flag_new','$price_null_new','$price_null_enabled_new','$NPID','$taxa_new',$is_folder)";
	$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
<script>
	  window.top.frame1.location.reload();
	  window.top.frame2.location.reload('admin_delivery_content.php');	
</script>";
}else {$UserChek->BadUserFormaWindow();}
}// ������ ��������������



if(isset($editID) and !empty($city_new))// ������ ��������������
{
if(CheckedRules($UserStatus["delivery"],1) == 1){
$sql="UPDATE ".$SysValue['base']['table_name30']."
SET
city='$city_new',
price='$price_new',
enabled='$enabled_new',
flag='$flag_new',
price_null='$price_null_new',
price_null_enabled='$price_null_enabled_new',
taxa='$taxa_new',
PID='$NPID'
where id='$id'";

$result=mysql_query($sql)or @die("".mysql_error()."");
echo"
<script>
	  window.top.frame1.location.reload();
	  window.top.frame2.location.reload('admin_delivery_content.php');	
</script>";
}else {$UserChek->BadUserFormaWindow();}
}// ������ ��������������


//������� ������������ ��������
function deleter($id=0) {
global $SysValue;
if (!$id) return 0;

$sqlf="select id from ".$SysValue['base']['table_name30']." where PID='$id'";
$resultf=mysql_query($sqlf);
$numf=mysql_num_rows($resultf);

if ($numf>0) {
	while ($row = mysql_fetch_array($resultf)) {
		deleter($row['id']);
	}
}

$sql="delete from ".$SysValue['base']['table_name30']."	where id='$id'";
$result=mysql_query($sql)or @die("���������� �������� ������");
return;

}//����� �������

if(@$productDELETE=="doIT")// ��������
{
if(CheckedRules($UserStatus["delivery"],1) == 1){
deleter($id);
echo"
	  <script>
	  window.top.frame1.location.reload();
	  window.top.frame2.location('admin_delivery_content.php').reload();	
</script>
	   ";
}else {$UserChek->BadUserFormaWindow();}
} //��������
?>