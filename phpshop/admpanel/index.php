<?
require("bin.php");
require("connect.php");

// Secure Fix 6.0
function RequestSearch($search){
global $PHP_SELF;
$pathinfo=pathinfo($PHP_SELF);
$f=$pathinfo['basename'];
if($f != "adm_sql.php" and $f != "adm_sql_file.php" and $f != "action.php"){
$com=array("union","select","insert","update","delete");
$mes='
<html>
<head>
	<title>Secure Fix 6.0</title>
<LINK href="css/texts.css" type=text/css rel=stylesheet>
</head>

<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
	<td style="padding:10">
	<b><span name=txtLang id=txtLang>����������� ��� �������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
	</td>
	<td align="right">
	<img src="img/i_domainmanager_med[1].gif" border="0" hspace="10">
	</td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7" width="100%" height="100%">
<tr>
	<td>
	
	

<h4 style="color:red">��������!!!</h4><br>������ ������� '.$PHP_SELF.' �������� ��-�� ������������� ���������� �������';
$mes2="<br>������� ��� ��������� ���� ������� � ������� ����������.";
foreach($com as $v)
      if(@preg_match("/".$v."/i", $search)){
	   $search=eregi_replace($v,"!!!$v!!!",$search);
	   exit($mes." ".strtoupper($v).$mes2."<br><br><br><textarea style='width: 100%;height:50%'>".$search."</textarea><p>������� � ������ �������� ������� !!! � ����� ������</p>
<hr>
<div align=right>
<input type=button value=��������� onclick=\"history.back(1)\">
<input type=button value=������� onclick=\"self.close()\">
</div>
</td>
</tr>
</table>
");
	   }}
}

foreach($_REQUEST as $val) RequestSearch($val);


// ��������� ������
error_reporting(0);
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");

function CheckBlackList($n){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name22']." where ip='$n'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return $num;
}



// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("./language/".$Lang."/language.php");


if(@$do=="out"){
session_destroy();
setcookie("PHPSESSID", "", (time()-1000), "/phpshop/admpanel/", $SERVER_NAME, 0);
}

// �������� ������
if($SysValue['geoip']['geoip'] == "true")
if($_SERVER["SERVER_ADDR"] != "127.0.0.1"){
include("geoip/geoip.inc");

$FlagProxy=1;
$gi = geoip_open("geoip/GeoIP.dat",GEOIP_STANDARD);
$PROXY=geoip_country_code_by_addr($gi, $REMOTE_ADDR);
$MyPROXY=explode(",",$SysValue['geoip']['geoip_zone']);

foreach($MyPROXY as $value)
       if($PROXY == $value) $FlagProxy=0;

$MyList=CheckBlackList($REMOTE_ADDR);
if($MyList > 0) $FlagProxy=1;
}

if($FlagProxy == 1) {
header("Location: /?status=lock&ip=$REMOTE_ADDR&proxy=$PROXY");
exit("������������� ��� ".$REMOTE_ADDR);
}


if(isset($pas_to_mail))
 {
$log=htmlspecialchars(stripslashes($log));
$sql="select password,mail from $table_name19 where login='$log'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){
$OLDpassword=$row['password'];
$OLDmail=$row['mail'];
}
  if($OLDmail!=""){
$content="
������� �������!
---------------

��������� $log, �� ��������� ������� �� ��� ����� ������ ��� ������� 
� ������ ����������������� PHPShop �� ����� ".$SERVER_NAME."

���� ������
---------------
������������: $log
������: ".base64_decode($OLDpassword)."
����: ".date("d-m-y H:s a")."
IP �����������:".$REMOTE_ADDR."

---------------
� ���������,
�������� PHPSHOP
http://www.phpshop.ru";

$codepage  = "windows-1251";              
$header  = "MIME-Version: 1.0\n";
$header .= "From: \"admin@".eregi_replace("www.","",$SERVER_NAME)."\" <\"MAIL PHPSHOP\">\n";
$header .= "Content-Type: text/plain; charset=$codepage\n";
$header .= "X-Mailer: PHP/";
$zag="������ � ������ ����������������� PHPSHOP";
mail($OLDmail,$zag,$content,$header);
$SendMailStatus="
 <br><br>
<table style=\"border: 1px;border-style:inset;\" >
<tr>
	<td>
	<font color=#FF0000>
	��� ������ ��� ������� ������� �� ������ ".$OLDmail."</font>
	</td>
</tr>
</table>
";
}
 }

elseif(isset($send_avtor))
{
$sql="select * from $table_name19 where enabled='1'";
$result=mysql_query($sql);
$pas=base64_encode($_POST['pas']);
while (@$row = mysql_fetch_array($result)){
	if($row['login']==$log and $row['password']==$pas)
	  {
	   $logPHPSHOP=$log;
	   $pasPHPSHOP=$pas;
	   $idPHPSHOP=$row['id'];
	   session_start();
	   session_register('logPHPSHOP');
	   session_register('pasPHPSHOP');
	   session_register('idPHPSHOP');
	   
// ����� � ������
$sql="INSERT INTO ".$SysValue['base']['table_name10']."
VALUES ('','$logPHPSHOP','".date("U")."','0','$REMOTE_ADDR')";
$result=mysql_query($sql);

	   if($_POST['pas_to_cookies'] == 1){
	   setcookie("mylog", $_POST['log'], time()+60*60*24*30, "/phpshop/admpanel/", $SERVER_NAME, 0);
       setcookie("mypas", base64_encode($_POST['pas']), time()+60*60*24*30, "/phpshop/admpanel/", $SERVER_NAME, 0);
       
	   }
	   if(isset($log) and isset($pas))
	   $_id=session_id();
	    setcookie("win_e", $_POST['win_e'], time()+60*60*24*30, "/phpshop/admpanel/", $SERVER_NAME, 0);
       $_Path='
function WO(){
var URL = "admin.php";
var win_e='.$_POST['win_e'].'-0;
if(win_e != 1){
if(!window.open(URL,"admin'.$_id.'","toolbar=0; location=0; menubar=0; status=1; directories=0; resizable=1;")){
if(confirm("��������!\n� ����� �������� "+navigator.appName+" ��������� ����������� ����.\n��� ��������� << '.$ProductName.' - ������ ���������� >>\n��������� ��������� ����������� ����.\n\n���������� ������ � ������������ ������������ ������? "))
window.location.replace(URL);
}}
else{ window.location.replace(URL);}
}
tmr = setTimeout("WO();",100);
';
	   //header("Location: admin.php");
	  }
	  }
	  if(!@$logPHPSHOP){
	  // ����� � ������
$sql="INSERT INTO ".$SysValue['base']['table_name10']."
VALUES ('','".htmlspecialchars(stripslashes($log."@".base64_decode($pas)))."','".date("d-m-y H:s a")."','1','$REMOTE_ADDR')";
$result=mysql_query($sql);
}
	}
	
	
	// ����� �����
function GetLang($skin){
global $SysValue;
$dir="./language";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and $file!="index.html")
            @$name.= "<option value=\"$file\" $sel>".ucfirst($file)."</option>";
        }
        closedir($dh);
    }
}
$disp="
<select name=\"LangIn\" onchange=\"ReloadLang(this.value)\">
".@$name."
</select>
";
return @$disp;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title><?=$SysValue['Lang']['Title']['index']." -> ".$ProductName?></title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<META name="copyright" content="<?=$RegTo?>">
<META name="engine-copyright" content="PHPSHOP.RU, <?=$ProductName;?>">
<LINK href="css/texts.css" type="text/css" rel="stylesheet">
<script type="text/javascript" language="JavaScript" src="language/<?=$Lang?>/language_interface.js"></script>
<script language="JavaScript">
<?=@$_Path;?>

function ReloadLang(my_lang){
location.replace("./?lang="+my_lang)
}

function CookiesFlash(){
if(confirm("��������!\n�� ������������� ������ ������� �����������������\n������ (Cookies) � ����� ����������?")){
SetCookie('mylog', '', -1000);
SetCookie('mypas', '', -1000);
document.getElementById("log").value='';
document.getElementById("pas").value='';
document.getElementById("cookiesflash").checked=false;
}else document.getElementById("cookiesflash").checked=false;
}

function SetCookie(name, value, days){
var today = new Date();
expires = new Date(today.getTime() + days*24*60*60*1000);
document.cookie = name + "=" + escape(value) +"; expires=" + expires.toGMTString();
}

function GetCookie(cookieName){
var cookieValue = '';
	var posName = document.cookie.indexOf(escape(cookieName) + '=');
	if (posName != -1) {
		var posValue = posName + (escape(cookieName) + '=').length;
		var endPos = document.cookie.indexOf(';', posValue);
		if (endPos != -1) cookieValue = unescape(document.cookie.substring(posValue, endPos));
		else cookieValue = unescape(document.cookie.substring(posValue));
	}
return cookieValue;
}

window.status="Powered & Developed by PHPShop.ru";
</script>
</head>
<!-- ENDscript -->
<body onload="DoCheckInterfaceLang('index',1)">
<?
echo"
<table width=\"100%\" height=\"100%\">
<tr>
	<td valign=\"middle\">

<form method=\"post\">
<table align=\"center\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\" style=\"border: 2px;border-style:outset;\" width=\"330\">
<tr align=\"center\" >
<td colspan=3 >
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>���� � ���������������� ������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������������ � ������</span>.
	</td>
	<td align=\"right\">
	<img src=\"img/i_users_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
<br>
</td>
</tr>
<tr>
<td align=\"left\" style=\"padding:5\">
<FIELDSET style=\"width: 20em; height: 5em;\">
<LEGEND ><span name=txtLang id=txtLang>������������</span></LEGEND>
<div style=\"padding:10\">
<input type=\"text\" name=\"log\" size=\"33\" maxlength=\"20\" value=\"".$_COOKIE['mylog']."\" id=log>
</div>
</FIELDSET>
</td>
<td rolspan=\"2\" valign=\"top\" style=\"padding:5\">
<input type=submit value=OK class=but name=send_avtor><br>
<input type=button value=����� name=btnLang class=but onclick=\"location.replace('../../')\"  title=\"��� ����� ��� ������ ������������� ��������\n��� ���� �������� � ������� ������!\">
</td>
</tr>
<tr>
<td style=\"padding:5\">
<FIELDSET style=\"width: 20em; height: 5em;\">
<LEGEND ><span name=txtLang id=txtLang>������</span></LEGEND>
<div style=\"padding:10\">
<input type=\"password\" name=\"pas\" id=pas size=\"33\" maxlength=\"20\" value=\"".base64_decode($_COOKIE['mypas'])."\" >
</div>
</FIELDSET>
</td>
</tr>
<tr>
 <td colspan=1 style=\"padding:5\">";
 if(!$_COOKIE['win_e'])
 echo "<input type=checkbox name=win_e value=1 ><span name=txtLang id=txtLang>������� � ������� ����</span><br>";
 else  echo "<input type=checkbox name=win_e value=1 checked><span name=txtLang id=txtLang>������� � ������� ����</span><br>";
 if(!$_COOKIE['mylog'] and !$_COOKIE['mypas'])
 echo "<input type=checkbox name=pas_to_cookies value=1><span name=txtLangs id=txtLangs>��������� ����� � ������</span>.<br>";
 else echo"<input type=checkbox  id=\"cookiesflash\" onclick=\"CookiesFlash()\"><span name=txtLang2 id=txtLang2>�� ���������� ����� � ������</span>.<br>";
 echo"<input type=checkbox name=pas_to_mail value=1><span name=txtLang id=txtLang>������� ������ �� E-mail ������������</span>.
 ".$SendMailStatus."
 </td>
 <td valign=top>


 </td>
</tr>

</table>
</form>
</td>
</tr>
</table>
";
?>
</body>
</html>

