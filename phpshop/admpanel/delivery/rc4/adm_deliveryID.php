<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Редактирование Доставки</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang; ?>/language_windows.js"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang; ?>/language_interface.js"></script>
<script>
DoResize(<? echo $GetSystems['width_icon']?>,600,500);

function DoSet(){
var sum=document.getElementById('taxa').value;
if (sum>0) {document.getElementById('taxa_enabled').checked=true;} else {document.getElementById('taxa_enabled').checked=false;}
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
// Редактирование записей 
	  $sql="select * from ".$SysValue['base']['table_name30']." where id='$id'";
      $result=mysql_query($sql);
	  $row = mysql_fetch_array($result);
	  $id=$row['id'];
	  $PID=$row['PID'];
	  $city=$row['city'];
	  $price=$row['price'];
	  if (!($row['taxa'])) {$taxa=0; $taxaenabled='';} else {$taxa=$row['taxa'];$taxaenabled='checked';}
	  if($row['enabled']==1) $fl="checked";
	    else $fl2="checked";
	       if($row['flag']==1) $f3="checked";
	  $price_null=$row['price_null'];
      if($row['price_null_enabled']==1) $f4="checked";
?>
<form name="product_edit"  method=post>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>Редактирование Доставки</span> "<?=$city?>"</b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>Укажите данные для записи в базу</span>.
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


	<FIELDSET style="height:20px">
<LEGEND><span name=txtLang id=txtLang><u>К</u>аталог</span></LEGEND>
<div style="padding:10">

<select name="NPID">
<option value="0" selected>Список доставок</option>
<?
// Выборка
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

} //Конец DelivList
	echo DelivSelList ($id,$PID);
?>


</select>
</div>
</FIELDSET>

	<FIELDSET style="height:50px">
<LEGEND><span name=txtLang id=txtLang><u>Н</u>азвание</span></LEGEND>
<div style="padding:10">
<input name="city_new" style="width:100%" value="<?=$city?>"><BR>
<input type="checkbox" name="flag_new" value="1"  <?=@$f3?>><span name=txtLang id=txtLang>Доставка по умолчанию</span>
</div>
</FIELDSET>


	</td>
	<td style="vertical-align:top;">
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>С</u>тоимость</span> </LEGEND>
<div style="padding:10">
<input type="text" name="price_new" value="<?=$price?>" style="width:50px;" > <?=GetIsoValutaOrder()?>
</div>
</FIELDSET>
	</td>
	<td style="vertical-align:top;">
	<FIELDSET style="height:90px">
<LEGEND><span name=txtLang id=txtLang><u>У</u>читывать</span></LEGEND>
<div style="padding:10">
<input type="radio" name="enabled_new" value="1" <?=@$fl?>><span name=txtLang id=txtLang>Да</span><br>
<input type="radio" name="enabled_new" value="0" <?=@$fl2?>><font color="#FF0000"><span name=txtLang id=txtLang>Нет</span></font>
</div>
</FIELDSET>
	</td>
</tr>
<tr>
  <td colspan="3">
  <FIELDSET>
<LEGEND><input type="checkbox" name="price_null_enabled_new" value="1"  <?=@$f4?>> <span name=txtLang id=txtLang><u>Б</u>есплатная доставка</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>Свыше</span> <input type="text" name="price_null_new" value="<?=$price_null?>" style="width:100px;" > <?=GetIsoValutaOrder()?> <span name=txtLang id=txtLang>доставка бесплатна</span>
</div>
</FIELDSET>
  </td>
</tr>


<tr>
  <td colspan="3">
  <FIELDSET>
<LEGEND><input type="checkbox" id="taxa_enabled" name="taxa_enabled" value="1" <?=$taxaenabled?> disabled> <span name=txtLang id=txtLang>Рассчитывать <u>т</u>аксу за каждые 0.5кг веса. (Чтобы <B>ВКЛЮЧИТЬ</B> установите значение в поле больше 0)</span></LEGEND>
<div style="padding:10">
<span name=txtLang id=txtLang>Используется для задания дополнительной тарификации (например, для "Почта России")<BR>Каждые дополнительные 0.5 кг свыше базовых 0.5кг будут стоить </span> <input type="text" name="taxa_new" id="taxa" value="<?=$taxa?>" style="width:100px;" onChange="DoSet();"> <?=GetIsoValutaOrder()?> 
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
	<input type="button" name="btnLang" class=but value="Удалить" onClick="PromptThis();">
    <input type="hidden" class=but  name="productDELETE" id="productDELETE">
	<input type="button" name="btnLang" value="Отмена" onClick="return onCancel();" class=but>
	</td>
</tr>
</table>
</form>
	  <?

if(isset($editID) and !empty($city_new))// Запись редактирования
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

//echo $sql;

///*
echo'
	  <script>
CLREL("right");
</script>
	   ';
//*/
}else $UserChek->BadUserFormaWindow();
}
if(@$productDELETE=="doIT")// Удаление
{
if(CheckedRules($UserStatus["delivery"],1) == 1){
$sql="delete from ".$SysValue['base']['table_name30']."
where id='$id'";
$result=mysql_query($sql)or @die("Невозможно изменить запись");
echo'
	  <script>
CLREL("right");
</script>
	   ';
}else $UserChek->BadUserFormaWindow();
}
?>



