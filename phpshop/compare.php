<?
session_start();

require_once "./lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// �������� ������.
$q = $_REQUEST['q'];
$xid = $_REQUEST['xid'];
$_num = $_REQUEST['num'];

//�������� �������� ���������� ������� ��� ���������
$compare= $_SESSION['compare'];
$compar=count($compare);

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
@mysql_query("SET NAMES cp1251");

$SysValue['nav']['nav'] = $NAV;

// ���������� ������
include("./inc/engine.inc.php");            // ������ ������
include("./inc/cache.inc.php");

// ���������� ���
$LoadItems=CacheReturnBase("compare");

/////////////////////////////////////////////////�������������� �������
function Chek($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) 
 {
 $stroka="0";
 }
return abs($stroka);
}

function Chek2($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) 
 {
 $stroka="0";
 }
return number_format(abs($stroka),"2",".","");
}
function CleanStr($str){
	  $str=str_replace("/","",$str);
	  $str=str_replace("\"","",$str);
	  $str=str_replace("'","",$str);
	  return $str;
}
/////////////////////////////////////////////////�������������� �������

$xid=Chek($xid);
$sql="select * from ".$SysValue['base']['table_name2']." where id=$xid";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=CleanStr($row['name']);
$category=$row['category'];
$id=$row['id'];

$compare_new=array(
"id"=>"$id",
"name"=>"$name",
"category"=>"$category"
	);
$compare[$xid]=$compare_new;



// ���������� ������ ���������
if(is_array($compare)) {
$_SESSION['compare'] = $compare;
}



if ($compar==count($compare)) {$same='1';} else {$same='0';}

// ��������� ��������� ����� � ���� PHP-�������!
$_RESULT = array(
  "q"     => $q,
  "md5"   => md5($q),
  "num"   => count($compare),
  "same"   => $same
); 
?>