<?php
session_start();
// Подключаем библиотеку поддержки.
//require_once "./lib/config.php";
require_once "./lib/Subsys/JsHttpRequest/Php.php";
// Создаем главный объект библиотеки.
// Указываем кодировку страницы (обязательно!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// Парсируем установочный файл
$SysValue=parse_ini_file("./inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// Подключаем базу MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
mysql_query( 'set names cp1251' );


// Вывод стоимости доставки
function GetDeliveryPrice($deliveryID,$sum,$weight=0){
global $SysValue;

if(!empty($deliveryID)){
$sql="select * from ".$SysValue['base']['table_name30']." where id='$deliveryID' and enabled='1'";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$row = mysql_fetch_array($result);

if($num == 0){
$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
}}

else
{
$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
}

if($row['price_null_enabled'] == 1 and $sum>=$row['price_null']) {
	return 0;
} else {
	if ($row['taxa']>0) {
		$addweight=$weight-500;
		if ($addweight<0) {
			$addweight=0; $at='';
		} else {
			$at='';
			//$at='Вес: '.$weight.' гр. Превышение: '.$addweight.' гр. Множитель:'.ceil($addweight/500).' = ';
		}
		$addweight=ceil($addweight/500)*$row['taxa'];
		$endprice=$row['price']+$addweight;
		return $at.$endprice;
	} else {
		return $row['price'];
	}
}

}

//Список доставок
function GetDeliveryList2($deliveryID,$PID=0){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PID."') order by city";
$result=mysql_query($sql);
$i=mysql_num_rows($result);



while($row = mysql_fetch_array($result)){
     if(!empty($deliveryID)){
       if($row['id'] == $deliveryID) {$chk="selected";} else {$chk="";}
     } else{
       if($row['flag']==1) {$chk="selected";} else {$chk="";}
     }
     @$dis.='<OPTION value='.$row['id'].' '.$chk.'>'.$pred.$row['city'].'</OPTION>';
}

return $dis;

}


// Вывод городов доставки
function GetDelivery($deliveryID){
global $SysValue,$_SESSION;

// путь до шаблона
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];

$sqlp="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$deliveryID."') order by city";
$resultp=mysql_query($sqlp);
$rowp = mysql_fetch_array($resultp);
$i=mysql_num_rows($resultp);

//Есть ли потомки у доставки
$sqlpot="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$deliveryID."') order by city";
$resultpot=mysql_query($sqlpot);
$ipot=mysql_num_rows($resultpot);


$PID=$rowp['PID'];
$id=$deliveryID;

$PIDpr=$id;
//Получаем предка для вариантов
$pred='';
$ii=0;
$num=0;
while ($PIDpr!=0) {
	$num++;
	$sqlpr="select id,PID,city from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$PIDpr."') order by city";
	$resultpr=mysql_query($sqlpr);
	$rowpr = mysql_fetch_array($resultpr);

	$PIDpr=$rowpr['PID'];
	$city=$rowpr['city'];

	$sqlprr="select id,PID,city from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PIDpr."') order by city";
	$resultprr=mysql_query($sqlprr);
	$ii=mysql_num_rows($resultprr);

	if (($ii>1) && (($ipot) || ($num>1))) { //Показывать кнопку "снять" если больше 1 вариант выбора у верхнего И (либо есть потомки либо уровень доставки больше первого)
//	if (($ii>1) && ($num>1)) { //Прятать кнопку "снять" если 1.только один вариант выбора 2.кнопка того же уровня
		$pred='Выбрано: '.$city.' <A href="javascript:UpdateDelivery('.$PIDpr.')" title="Выбрать другой способ доставки"><img src="../'.$pathTemplate.'/images/shop/icon-activate.gif" alt=""  border="0" align="absmiddle">Снять выбор</A> <BR> '.$pred;
	}
}
if (strlen($pred)) {$br='<BR>';} else {$br='';}
$disp='<DIV id="seldelivery">'.$pred.$br.'
<SELECT onchange="UpdateDelivery(this.value)" name="dostavka_metod" id="dostavka_metod">'.$makechoise;

$sql="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$id."') order by city";
$result=mysql_query($sql);
$i=mysql_num_rows($result);

if ($i>1) {$PID=$id; $disp.='<OPTION value='.$id.' id="makeyourchoise">Выберите доставку</OPTION>'; $alldone='';
} else {
$alldone.='<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
}

$PIDpr=$PID;
$predok='';
while ($PIDpr!=0) {
	$sqlpr="select city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$PIDpr."') order by city";
	$resultpr=mysql_query($sqlpr);
	$rowpr = mysql_fetch_array($resultpr);
	$PIDpr=$rowpr['PID'];
	$predok=$rowpr['city'].' > '.$predok;
}


$sql="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PID."') order by city";
$result=mysql_query($sql);

while($row = mysql_fetch_array($result)){
     if(!empty($deliveryID)){
       if($row['id'] == $deliveryID) {$chk="selected";} else {$chk="";}
     } else{
       if($row['flag']==1) {$chk="selected";} else {$chk="";}
     }
     $disp.='<OPTION value='.$row['id'].' '.$chk.'>'.$predok.$row['city'].'</OPTION>';
}



$disp.='</SELECT>'.$alldone.'</DIV>';
return $disp;
}


$GetDeliveryPrice=GetDeliveryPrice($_REQUEST['xid'],$_REQUEST['sum'],$_REQUEST['wsum']);
$totalsumma=$GetDeliveryPrice+$_REQUEST['sum'];
$dellist=GetDelivery($_REQUEST['xid']);

$_RESULT = array(
  'delivery' => $GetDeliveryPrice,
  'dellist'=> $dellist,
  'total' => $totalsumma
); 
?>