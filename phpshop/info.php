<?php
session_start();

// ���������� ���������� ���������.
//require_once "./lib/config.php";
require_once "./lib/Subsys/JsHttpRequest/Php.php";
// ������� ������� ������ ����������.
// ��������� ��������� �������� (�����������!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// ��������� ������������ ����
$SysValue=parse_ini_file("./inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");

function DispSystems()// ����� ��������
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
foreach($row as $k=>$v)
$array[$k]=$v;
return $array;
}
$DispSystems=DispSystems();

function dataV($nowtime){
$Months = array("01"=>"������","02"=>"�������","03"=>"�����", 
 "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
 "08"=>"�������","09"=>"��������",  "10"=>"�������",
 "11"=>"������","12"=>"�������");
$curDateM = date("m",$nowtime); 
$t=date("d",$nowtime).".".$curDateM.".".date("Y",$nowtime); 
return $t;
}

// ����� �����
function GetFile($dir){
global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "lic")
		  return $SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
}


@$fp = fopen("../index.php", "r");
if($fp)
{
$fstat = fstat($fp);
fclose($fp);
$FileDate=dataV($fstat['mtime']);
}


// ���� �������� ���. ���������
$GetFile=GetFile("../license/");
@$License=parse_ini_file("../".$GetFile,1);

$TechPodUntilUnixTime = $License['License']['SupportExpires'];
if(is_int($TechPodUntilUnixTime))
$TechPodUntil=dataV($TechPodUntilUnixTime);
  else $TechPodUntil=" - ";

$LicenseUntilUnixTime = $License['License']['Expires'];
if(is_int($LicenseUntilUnixTime))
$LicenseUntil=dataV($LicenseUntilUnixTime);
  else  $LicenseUntil=" - ";

//@$mem = @memory_get_usage();
//$_MEM=round(@$mem/1024,2)." Kb";
@$_MEM=" - ";


$Info="PHPShop System Info 2.01
---------------------------------------------

������: ".$SysValue['license']['product_name']."
������: ".@$_MEM." 
�����������: ".$SysValue['cache']['cache_mod']."
���� ���������: ".$SysValue['cache']['last_modified']."
������: ".$DispSystems['skin']."
GZIP: ".$SysValue['my']['gzip']."; ������: ".$SysValue['my']['gzip_level']."
�����������: $FileDate 
��������� ���������: ".$TechPodUntil."
��������� ��������: ".$LicenseUntil."
GEOIP: ".$SysValue['geoip']['geoip']."; Zone: ".$SysValue['geoip']['geoip_zone']."

---------------------------------------------

��� ����� ��������. 2003-".date("Y")."
Copyright � www.phpshop.ru";

// ��������� ��������� ����� � ���� PHP-�������!
$_RESULT = array(
  "info"     => $Info,
  'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
?>