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

function DelivList ($UID=0) {
global $SysValue;

if ($UID!=="ALL") {$wh=' where (UID='.$UID.')';} else {$wh='';}
$sql='select * from '.$SysValue['base']['table_name37'].$wh.' order by DateTime';
$result=mysql_query($sql);
//$display=$sql;
$lvl++;
while ($row = mysql_fetch_array($result))
    {
	$id=$row['ID'];
	$UID=$row['UID'];
	$AID=$row['AID'];

	if ($AID) { //Получаем имя администратора, если сообщение от админа
		$sqlad='select * from '.$SysValue['base']['table_name19'].' WHERE id='.$AID;
		$resultad=mysql_query($sqlad);
                $rowad = mysql_fetch_array($resultad);
		$name=$rowad['login'];
		$color='style="background:#c0d2ec;"';
	} else {
		$sqlus='select * from '.$SysValue['base']['table_name27'].' WHERE id='.$UID;
		$resultus=mysql_query($sqlus);
                $rowus = mysql_fetch_array($resultus);

		$name=$rowus['name'].' ('.$rowus['login'].'/'.$rowus['mail'].')';
		$color='';
	}

	$DataTime=$row['DateTime'];
	$Subject=$row['Subject'];
	$Message=$row['Message'];
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('adm_messagesID.php?id=$id',400,270)\">
	<td class=forma ".$color.">
	$DataTime<BR>
	От: <B>$name</B>
	</td>
	<td class=forma>
        <B>$Subject</B><BR>
	$Message
	</td>
    </tr>
	";
	}

return $display;

} //Конец DelivList


$display= DelivList($id);

$sql="select * from ".$SysValue['base']['table_name30'];
$result=mysql_query($sql);
$i=mysql_num_rows($result);


if($i>30)$razmer="height:600;";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Обзор сообщение пользователей</title>
<META http-equiv=Content-Type content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?=$Lang?>/language_windows.js"></script>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../java/sorttable.js"></script>
<? if (isset($id)) {?>

</head>
<body style="background: threedface; color: windowtext;" topmargin="0" rightmargin="3" leftmargin="3"  onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0)">
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
<table cellpadding="0" cellspacing="1" width="100%" border="0" bgcolor="#808080" class="sortable" id="sort">
<tr>
	<td width="20%" id=pane align=><span name=txtLang id=txtLang>Дата</span></td>
	<td width="80%" id=pane align=><span name=txtLang id=txtLang>Сообщение</span></td>
</tr>
	<?=$display?>
    </table>




<input type="hidden" value="<?=$id?>" id="catal" name="catal">
<input type="hidden" name="id" value="<?=$id?>" >



<? }

if(@$productDELETE=="doIT")// Удаление
{
if(CheckedRules($UserStatus["delivery"],1) == 1){
$sql="delete from ".$SysValue['base']['table_name37']." where UID='$id'";
$result=mysql_query($sql)or @die("Невозможно изменить запись");

echo"
	  <script>

	  window.top.frame2.location.reload;	
</script>
	   ";


}else $UserChek->BadUserFormaWindow();



}


?>