<?

session_start();

require_once "./lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// �������� ������.
$q = $_REQUEST['q'];
$xid = $_REQUEST['xid'];
$_num = $_REQUEST['num'];
$addname = $_REQUEST['addname'];
$cart = $_SESSION['cart'];


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
$LoadItems=CacheReturnBase("cart");

function Chek($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) {$stroka="0";}
return abs($stroka);
}

function Chek2($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) {$stroka="0";}
return number_format(abs($stroka),"2",".","");
}


function CleanStr($str){
	  $str=str_replace("/","",$str);
	  $str=str_replace("\"","",$str);
	  $str=str_replace("'","",$str);
	  return $str;
}

$xid=Chek($xid);


$sql="select * from ".$SysValue['base']['table_name2']." where id=$xid";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=CleanStr($row['name']);
$name.=" ".$addname;
$price=$row['price'];
$baseinputvaluta=$row['baseinputvaluta'];
$defvaluta=$LoadItems['System']['dengi'];

//�������� �������� ����
if ($baseinputvaluta) { //���� �������� ���. ������
	if ($baseinputvaluta!==$defvaluta) {//���� ���������� ������ ���������� �� �������
		$vkurs=$LoadItems['Valuta'][$baseinputvaluta]['kurs'];
		$price=$price/$vkurs; //�������� ���� � ������� ������
	}
} //���� �������� ���. ������
//�������� �������� ����
$price=($price+(($price*$LoadItems['System']['percent'])/100));
$uid=$row['uid'];
$id=$row['id'];
$user=$row['user'];
$weight=$row['weight'];



// ������� �� ���� ������ ������� ����
	if(session_is_registered('UsersStatus')){
    $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
	  if($GetUsersStatusPrice>1){
	   $pole="price".$GetUsersStatusPrice;
	   $pricePersona=$row[$pole];

	//�������� �������� ����
	if ($baseinputvaluta) { //���� �������� ���. ������
		if ($baseinputvaluta!==$defvaluta) {//���� ���������� ������ ���������� �� �������
			$vkurs=$LoadItems['Valuta'][$baseinputvaluta]['kurs'];
			$pricePersona=$pricePersona/$vkurs; //�������� ���� � ������� ������
		}
	} //���� �������� ���. ������
	//�������� �������� ����




	   if(!empty($pricePersona)) 
	     $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
	   }
	}


//��������� ��� ����� ����������� ������
$same=0;
if (isset($cart[$xid])) {
	if ($cart[$xid]['name']!==$name) { //���� ����� ����� ���� � � ���� ���� ������ ���, ������� ��� �������������� ���������!
		$same=1;
	}
}


$num=@$cart[$xid]['num']+$_num;
$cart_new=array(
"id"=>"$id",
"name"=>"$name",
"price"=>$price,
"uid"=>"$uid",
"num"=>"$num",
"weight"=>$weight,
"user"=>$user
	);
$cart[$xid]=$cart_new;

// ���������� �������
if(is_array($cart)){
$_SESSION['cart']= $cart;
}


if(is_array($cart))// ����� �������
foreach($cart as $j=>$v)
  {
 $price=$cart[$j]['price']*$cart[$j]['num'];
 @$sum+=$price_now;
 @$sum=number_format($sum,"2",".","");
 @$num+=$cart[$j]['num'];
 }

function ReturnNum($cart)
{
while (list($key, $value) = @each($cart)) @$num+=$cart[$key]['num'];
return @$num;
}

function ReturnSumma($sum){ // �������� �� �����
global $LoadItems;
$formatPrice = unserialize($LoadItems['System']['admoption']);
$format=$formatPrice['price_znak'];
$kurs=GetKursOrder();
$sum*=$kurs;
return number_format($sum,$format,"."," ");
}

function GetKursOrder(){ // ����
global $LoadItems;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];
  
return  $LoadItems['Valuta'][$valuta]['kurs'];
}


function ReturnSum($cart)
{
while (list($key, $value) = @each($cart)) @$sum+=$cart[$key]['price']*$cart[$key]['num'];
$sum=ReturnSumma($sum);
return @$sum;
}

function GetValuta(){ // ������
global $LoadItems,$_SESSION;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];

return  $LoadItems['Valuta'][$valuta]['code'];
}

// ��������� ���������
$_RESULT = array(
  "num"   => ReturnNum($cart),
  "sum" => ReturnSum($cart)
); 
?>