<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ ��������� XML Mixmarket     |
+-------------------------------------+
*/

//vendor
$vendor = 11;

//model
$model = 12;

// ��������� ������������ ����
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);


// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
@mysql_query("SET NAMES 'cp1251'");

// ���������
function Systems()// ����� ��������
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
foreach($row as $k=>$v)
$array[$k]=$v;
return $array;
}

// Promo - ��������������
function NameToLatin($str){
$str=strtolower($str);
$str=str_replace("/", "", $str);
$str=str_replace("\\", "", $str);
$str=str_replace("(", "", $str);
$str=str_replace(")", "", $str);
$str=str_replace(":", "", $str);
$str=str_replace("-", "", $str);
$str=str_replace(" ", "", $str);

$_Array=array(
"�"=>"a",
"�"=>"b",
"�"=>"v",
"�"=>"g",
"�"=>"d",
"�"=>"e",
"�"=>"e",
"�"=>"gh",
"�"=>"z",
"�"=>"i",
"�"=>"i",
"�"=>"k",
"�"=>"l",
"�"=>"m",
"�"=>"n",
"�"=>"o",
"�"=>"p",
"�"=>"r",
"�"=>"s",
"�"=>"t",
"�"=>"u",
"�"=>"f",
"�"=>"h",
"�"=>"c",
"�"=>"ch",
"�"=>"sh",
"�"=>"sh",
"�"=>"i",
"�"=>"yi",
"�"=>"i",
"�"=>"a",
"�"=>"u",
"�"=>"ya",
"�"=>"a",
"�"=>"b",
"�"=>"v",
"�"=>"g",
"�"=>"d",
"�"=>"e",
"�"=>"gh",
"�"=>"z",
"�"=>"i",
"�"=>"i",
"�"=>"k",
"�"=>"l",
"�"=>"m",
"�"=>"n",
"�"=>"o",
"�"=>"�",
"�"=>"r",
"�"=>"s",
"�"=>"t",
"�"=>"u",
"�"=>"f",
"�"=>"h",
"�"=>"c",
"�"=>"ch",
"�"=>"sh",
"�"=>"sh",
"�"=>"a",
"�"=>"u",
"�"=>"ya",
"."=>"_",
"$"=>"i",
"%"=>"i",
"&"=>"and"
);

$chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

foreach($chars as $val)
if(empty($_Array[$val])) @$new_str.=$val;

return @$new_str;
}

// ����� ���������
function  Catalog()
 {
global $SysValue;
$sql="select id,name from ".$SysValue['base']['table_name']." where parent_to=0 and yml='1' order by id";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$array=array(
	"id"=>"$id",
	"name"=>"$name"
	);
	$Catalog[$id]=$array;
	}
return $Catalog;
 }

// ����� ������������
function  Podcatalog()
 {
global $SysValue;
$sql="select id,name,parent_to from ".$SysValue['base']['table_name']." where parent_to!=0 and yml='1' order by id";
$result=mysql_query($sql);
$FROM=split(",",$SysValue['yml']['catalog']);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$parent_to=$row['parent_to'];
	$array=array(
	"id"=>"$id",
	"name"=>"$name",
	"parent_to"=>"$parent_to"
	);
	$Catalog[$id]=$array;
	}
return $Catalog;
 }

// ������ ��� �����������
function ImgParser($img){
$array=split("\"",$img);
while (list($key, $value) = each($array))
    //if (preg_match("/\//",$value))
  if (preg_match("/Image/",$value))
    return $array[$key];
}

function Vendor($vendor)// �������� ������ ������� ��� ����� ��������
{
global $SysValue;
$sql="select name from ".$SysValue['base']['table_name4']." where id='$vendor'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=$row['name'];
return $name;
}

function DispValuta($n)// ����� �����
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name24']." where id=$n";
$result=mysql_query($sql);
while (@$row = mysql_fetch_array($result))
    {
    $id=$row['id'];
	$name=$row['name'];
	$code=$row['code'];
	$iso=$row['iso'];
	$kurs=$row['kurs'];
	$array=array(
	"id"=>$id,
	"name"=>$name,
	"code"=>$code,
	"iso"=>$iso,
	"kurs"=>$kurs
	);
	$Valuta[$id]=$array;
	}
return $Valuta;
}

function STR($d1){
$length=strlen($d1);
	for($i=$length; $i>0; $i--)
	{
		if($d1[$i]==";" and (($i-$length)<7))
		return substr($d1,0,$i+1);
	}
return $d1;
}
 
// ����� ���������
function  Product()
 {
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name2']." where enabled='1' and yml='1' order by id";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=htmlspecialchars($row['name']);
	$category=$row['category'];
    $uid=$row['uid'];
	$vendor_array=$row['vendor_array'];
	$price=$row['price'];
	
	if($row['p_enabled'] == 1) $p_enabled="true";
	else $p_enabled="false";
	$description=$row['description'];
	$d1=substr(htmlspecialchars(strip_tags($description)),0,200);
	$array=array(
	"id"=>"$id",
	"category"=>"$category",
	"name"=>"$name",
	"picture"=>$row['pic_small'],
	"price"=>"$price",
	"p_enabled"=>"$p_enabled",
	"yml_bid_array"=>unserialize($row['yml_bid_array']),
	"uid"=>"$uid",
	"vendor_array"=>"$vendor_array",
	"description"=>STR($d1)
	);
	$Products[$id]=$array;
	}
return $Products;
 }

 
function GetVendor($n){
global $SysValue;
$vendor=$SysValue['nav']['query']['v'];
$sql="select name from ".$SysValue['base']['table_name21']." where id='$n'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row['name'];
}

 
$CATALOG=Catalog();
$PODCATALOG=Podcatalog();
$PRODUCT=Product();
$SYSTEM=Systems();
$VALUTA=DispValuta($SYSTEM['dengi']);

$XML=('<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="'.date('Y-m-d H:m').'">

<shop>
<name>'.$SYSTEM['name'].'</name>
<company>'.$SYSTEM['company'].'</company>
<url>http://'.$SERVER_NAME.'</url>

<currencies>
');
  foreach($VALUTA as $v)
  $XML.='<currency id="'.$v['iso'].'" rate="1"/>';
$XML.=('
</currencies>

<categories>');
while (list($key, $val) = @each($CATALOG)) 
$XML.= ('
<category id="'.$key.'">'.$CATALOG[$key]['name'].'</category>');

while (list($key, $val) = @each($PODCATALOG)) 
$XML.= ('
<category id="'.$key.'" parentId="'.$PODCATALOG[$key]['parent_to'].'">'.$PODCATALOG[$key]['name'].'</category>');

$XML.=('</categories>
<offers>');
while (list($key, $val) = @each($PRODUCT)) {
    
$sort = unserialize($PRODUCT[$key]['vendor_array']);

   
$XML.= ('
<offer id="'.$PRODUCT[$key]['id'].'" type="vendor.model">
 <url>http://'.$SERVER_NAME.'/shop/UID_'.$PRODUCT[$key]['id'].'_'.NameToLatin($PRODUCT[$key]['name']).'.html?from=yml</url>
      <price>'.$PRODUCT[$key]['price'].'</price>
      <currencyId>'.$VALUTA[$SYSTEM['dengi']]['iso'].'</currencyId>
      <categoryId>'.$PRODUCT[$key]['category'].'</categoryId>
      <picture>http://'.$SERVER_NAME.$PRODUCT[$key]['picture'].'</picture>
      <typePrefix>'.$PRODUCT[$key]['name'].'</typePrefix>
	  <vendor>'.GetVendor($sort[11]).'</vendor> 
      <model>'.GetVendor($sort[12]).'</model>
      <description>'.$PRODUCT[$key]['description'].'</description>
    </offer>
');
}
$XML.= ('</offers>
</shop>
</yml_catalog>');

echo $XML;
?>
