<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ ���������                   |
+-------------------------------------+
*/

// �������� �� �����
function mySubstr($str,$a){

if(empty($str)) return $str;

$str = htmlspecialchars(strip_tags($str));
for ($i = 1; $i <= $a; $i++) {
	if($str{$i} == ".") $T=$i;
}

if($T<1) return substr($str, 0, $a)."...";
  else return substr($str, 0, $T+1);
}


// ������� ������� ��� ��� ������� ������������
function GetUsersStatusPrice($n){
global $SysValue;
$sql="select price from ".$SysValue['base']['table_name28']." where id=$n";
$result=mysql_query($sql);
$row = mysql_fetch_array(@$result);
return $row['price'];
}

// ������� �� ���� ������ ������� ����
function ReturnTruePriceUser($n,$price)
{
global $SysValue,$LoadItems,$_SESSION;
if(session_is_registered('UsersStatus')){
$GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
$pole="price".$GetUsersStatusPrice;
$sql="select $pole from ".$SysValue['base']['table_name2']." where id='$n'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
if(!empty($row[$pole])) return $row[$pole];
  else return $price;
} else return $price;
}


// ��������������
function Sorts()
 {
global $SysValue;
$sql="select id,name from ".$SysValue['base']['table_name21'];
$result=mysql_query($sql) or  die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$array=array(
	"id"=>$id,
	"name"=>$name
	);
	$Sorts[$id]=$array;
	}
@$SysValue['sql']['num']++;
return $Sorts;
 }
 
// �������� �������������
function CatalogSorts()
 {
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name20'];
@$result=mysql_query($sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$category=$row['category'];
	$array=array(
	"id"=>$id,
	"name"=>$name,
	"category"=>$category
	);
	$Sorts[$id]=$array;
	}
@$SysValue['sql']['num']++;
return $Sorts;
 }

// ������� ������
function CatalogPage()
 {
global $SysValue;
$sql="select id,name,parent_to from ".$SysValue['base']['table_name29'];
$result=mysql_query($sql) or  die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$parent_to=$row['parent_to'];
	$array=array(
	"id"=>$id,
	"name"=>$name,
	"parent_to"=>$parent_to
	);
	$Catalog[$id]=$array;
	}
@$SysValue['sql']['num']++;
return $Catalog;
 }

// ����� ��������� �������
function  CatalogPageKeys()
 {
global $SysValue;
$sql="select id,parent_to  from ".$SysValue['base']['table_name29']." order by num";
$result=mysql_query($sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$parent_to=$row['parent_to'];
	$Catalog[$id]=$parent_to;
	}
@$SysValue['sql']['num']++;
return $Catalog;
 }
 
// ����� ���������
function  CatalogKeys()
 {
global $SysValue;
$sql="select id,parent_to,num  from ".$SysValue['base']['table_name'];
$result=mysql_query($sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$parent_to=$row['parent_to'];
	$Catalog[$id]=$parent_to;
	}
@$SysValue['sql']['num']++;
return $Catalog;
 }
 
// ����� ���������
function  Catalog()
 {
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name'];
$result=mysql_query($sql);
while (@$row = mysql_fetch_array(@$result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$parent_to=$row['parent_to'];
	$num_row=$row['num_row'];
	$num_cow=$row['num_cow'];
	$sort=$row['sort'];
	$servers=$row['servers'];
	$title_enabled=$row['title_enabled'];
	$descrip_enabled=$row['descrip_enabled'];
	$keywords_enabled=$row['keywords_enabled'];
	$skin_enabled=$row['skin_enabled'];
	$skin=$row['skin'];
	$array=array(
	"id"=>$id,
	"name"=>$name,
	"parent_to"=>$parent_to,
	"num_row"=>$num_row,
	"num_cow"=>$num_cow,
	"sort"=>$sort,
	"title_enabled"=>$title_enabled,
	"descrip_enabled"=>$descrip_enabled,
	"keywords_enabled"=>$keywords_enabled,
	"skin_enabled"=>$skin_enabled,
	"skin"=>$skin,
	"order_by"=>$row['order_by'],
	"order_to"=>$row['order_to'],
	"parent_len"=>$row['parent_len'],
	"vid"=>$row['vid'],
	"servers"=>$servers
	);
	$Catalog[$id]=$array;
	}
@$SysValue['sql']['num']++;
return $Catalog;
 }
 

// ����� ���������
function  Product($str="")
 {
global $SysValue,$LoadItems,$_SESSION;

if($str != "none"){

$System=DispSystems();
$sql="select id,uid,name,category,price,price_n,sklad,odnotip,vendor,title_enabled,datas,page,user,descrip_enabled,keywords_enabled,pic_small,pic_big,parent,price2,price3,price4,price5  from ".$SysValue['base']['table_name2'].$str;
$result=mysql_query($sql);
while (@$row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$uid=$row['uid'];
	$name=$row['name'];
	$category=$row['category'];
	$price=$row['price'];
    $sklad=$row['sklad'];
	$priceNew=$row['price_n'];
	$price=($price+(($price*$System['percent'])/100));
	$title_enabled=$row['title_enabled'];
	$descrip_enabled=$row['descrip_enabled'];
	$keywords_enabled=$row['keywords_enabled'];
	$datas=$row['datas'];
	$page=explode(",",$row['page']);
	$user=$row['user'];
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
	
	
	// ������� �� ���� ������ ������� ����
	if(session_is_registered('UsersStatus')){
    $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
	  if($GetUsersStatusPrice>1){
	   $pole="price".$GetUsersStatusPrice;
	   $pricePersona=$row[$pole];
	   if(!empty($pricePersona)) 
	     $price=($pricePersona+(($pricePersona*$System['percent'])/100));
	   }
	}
	
	// ���� ���� ����� ����
	if($priceNew>0){
	$priceNew=($priceNew+(($priceNew*$System['percent'])/100));
	$priceNew=number_format($priceNew,"2",".","");
	//$priceNew=$priceNew." ".$System['dengi'];
	}
	
	// �������� �� ������� ����
	if(!is_numeric($row['price']))
	$sklad = 1;
	
	$uid=$row['uid'];
	$odnotip=explode(",",$row['odnotip']);
	$parent=explode(",",$row['parent']);
	$vendor=$row['vendor'];
	
	
	$array=array(
	"category"=>$category,
	"id"=>$id,
    "name"=>$name,
	"price"=>$price,
    "priceNew"=>$priceNew,
    "priceSklad"=>$sklad,
	"odnotip"=>$odnotip,
	"parent"=>$parent,
	"vendor"=>$vendor,
    "uid"=>$uid,
	"pic_small"=>$pic_small,
	"pic_big"=>$pic_big,
	"title_enabled"=>$title_enabled,
	"descrip_enabled"=>$descrip_enabled,
	"keywords_enabled"=>$keywords_enabled,
	"datas"=>$datas,
	"page"=>$page,
	"user"=>$user
	);
	$Products[$id]=$array;
	}
@$SysValue['sql']['num']++;
return @$Products;
}
 }
 


 
// ����� ���-��
function NumFrom($from_base,$query) 
{
global $SysValue;
$sql="select COUNT('id') as count from ".$SysValue['base'][$from_base]." ".$query;
@$result=mysql_query(@$sql);
@$row = mysql_fetch_array(@$result);
@$num=$row['count'];
return @$num;
}

function DispSystems()// ����� ��������
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
if(is_array($row))
foreach($row as $k=>$v)
$array[$k]=$v;

// ������ �� ���������
//$array['dengi']=4;

@$SysValue['sql']['num']++;
return $array;
}

function DispValuta()// ����� �����
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name24']." where enabled='1' order by num";
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
	"name"=>"$name",
	"code"=>"$code",
	"iso"=>"$iso",
	"kurs"=>"$kurs"
	);
	$Valuta[$id]=$array;
	}
@$SysValue['sql']['num']++;
return $Valuta;
}

function Open($page)// �������� ������������� �����
{
global $SysValue;
$page=$page.".php";
$handle=@opendir($SysValue['my']['default_page_dir']) or die("".PHPSHOP_error(103,$SysValue['my']['error_tracer'])."");;
while ($file = readdir($handle))
    {
	if($file==$page)
	  {
		return $page;
		exit;
	   }
	 }
return "404";
}


function Vivod_mini_cart()// ����� ���� �������
{
global $SysValue,$LoadItems,$_SESSION;
$cart=@$_SESSION['cart'];
if(count($cart)>0)
{
if(is_array($cart))
foreach($cart as $j=>$v)
  {
   @$sum+=$cart[$j]['price']*$cart[$j]['num'];
   @$sum=number_format($sum,"2",".","");
   @$sum_r=@$sum*$LoadItems['System']['kurs'];
   @$sum_r=number_format($sum_r,"2",".","");
   @$num+=$cart[$j]['num'];
  }
$SysValue['other']['orderEnabled']= "block";
}
 else
     {
	 $sum="--";
	 $num="--";
	 $SysValue['other']['orderEnabled']= "none";
	 }

// ���������� ���������
$SysValue['other']['tovarNow']= $SysValue['lang']['cart_tovar_now'];
$SysValue['other']['num']= $num;
$SysValue['other']['sum']= GetPriceValuta($sum);
$SysValue['other']['summaNow']= $SysValue['lang']['cart_summa_now'];
$SysValue['other']['money']= GetValuta();
$SysValue['other']['orderNow']= $SysValue['lang']['cart_order_now'];

// ���������� ������
@$disp=ParseTemplateReturn($SysValue['templates']['menu_cart']);
return $disp;
}



function Vivod_menu_left()// ����� ������ ����
{
global $SysValue,$REQUEST_URI;
$sql="select * from ".$SysValue['base']['table_name14']." where flag='1' and element='0' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
 if(empty($row['dir'])){
  // ���������� ���������
  $SysValue['other']['leftMenuName']= $row['name'];
  $SysValue['other']['leftMenuContent']= stripslashes($row['content']);
  // ���������� ������
  @$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
   }else{
        $dirs= explode(",",$row['dir']);
        foreach($dirs as $dir)
          if(strpos($REQUEST_URI, $dir) or $REQUEST_URI==$dir){
            // ���������� ���������
            $SysValue['other']['leftMenuName']= $row['name'];  
            $SysValue['other']['leftMenuContent']= $row['content'];
			// ���������� ������
            @$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
          }
        }

}

@$SysValue['sql']['num']++;
return @$dis;
}

function Vivod_forma_valuta()// ����� ����� ������
{
global $SysValue,$LoadItems,$_SESSION;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];
  
if(is_array($LoadItems['Valuta']))
foreach($LoadItems['Valuta'] as $k=>$v){
  if($valuta == $LoadItems['Valuta'][$k]['id']) $sel="selected";
    else $sel="";
@$name.= '<option value="'.$LoadItems['Valuta'][$k]['id'].'" '.$sel.' >'.$LoadItems['Valuta'][$k]['name'].'</option>';
}
// ���������� ���������
$SysValue['other']['leftMenuName']= "������";
$SysValue['other']['leftMenuContent']="
<form name=ValutaForm method=post>
<select name=\"valuta\" onchange=\"ChangeValuta()\">
".@$name."
</select>
</form>
";

// ���������� ������
if(!ParseTemplateReturn($SysValue['templates']['valuta_forma']))
@$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
else @$dis.=ParseTemplateReturn($SysValue['templates']['valuta_forma']);

return @$dis;
}


function Vivod_menu_right()// ����� ������ ����
{
global $SysValue,$REQUEST_URI;
$sql="select * from ".$SysValue['base']['table_name14']." where flag='1' and element='1' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
if(empty($row['dir'])){
// ���������� ���������
$SysValue['other']['leftMenuName']= $row['name'];
$SysValue['other']['leftMenuContent']= stripslashes($row['content']);
// ���������� ������
if(!ParseTemplateReturn($SysValue['templates']['right_menu']))
@$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
else @$dis.=ParseTemplateReturn($SysValue['templates']['right_menu']);
}
else{
$dirs= explode(",",$row['dir']);
foreach($dirs as $dir)
if(strpos($REQUEST_URI, $dir) or $REQUEST_URI==$dir){
// ���������� ���������
$SysValue['other']['leftMenuName']= $row['name'];
$SysValue['other']['leftMenuContent']= stripslashes($row['content']);
// ���������� ������
if(!ParseTemplateReturn($SysValue['templates']['right_menu']))
@$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
else @$dis.=ParseTemplateReturn($SysValue['templates']['right_menu']);
}}
}
@$SysValue['sql']['num']++;
return @$dis;
}


function Vivod_menu_top()// ����� �������� ����
{
global $SysValue,$_SESSION;

// �������� ������ ��� �������������
if(isset($_SESSION['UsersId'])) $sort=" ";
 else $sort=" and secure !='1' ";
$sql="select * from ".$SysValue['base']['table_name11']." where category='1000' and enabled='1' $sort order by num";

$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
// ���������� ���������
$SysValue['other']['topMenuName']= $row['name'];
$SysValue['other']['topMenuLink']= $row['link'];

// ���������� ������
@$dis.=ParseTemplateReturn($SysValue['templates']['top_menu']);
}
@$SysValue['sql']['num']++;
return @$dis;
}


function Skin_select($skin)// ����� ����� ����
{
global $SysValue,$LoadItems;

$Options=unserialize($LoadItems['System']['admoption']);

if($Options['user_skin'] == 1){
$dir=$SysValue['dir']['templates'].chr(47);
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		
		    if($skin == $file)
			$sel="selected";
			  else $sel="";
		
		    if($file!="." and $file!=".." and $file!="index.html")
            @$name.= "<option value=\"$file\" $sel>������ $file</option>";
        }
        closedir($dh);
    }
}
$SysValue['other']['leftMenuContent']="

<div style=\"padding:10px\"><form name=SkinForm method=post>
<select name=\"skin\" onchange=\"ChangeSkin()\">
".@$name."
</select>
</form>
</div>

";

// ���������� ���������
$SysValue['other']['leftMenuName']= "������� ������";

// ���������� ������
@$dis=ParseTemplateReturn($SysValue['templates']['left_menu']);

return @$dis;
}}



// ����� ���������� �������
function Open_from_base($name,$str="none")
{
global $SysValue;
$name=TotalClean($name,2);
if($str=="none") $sql="select * from ".$SysValue['base']['table_name11']." where link='$name'";
else $sql="select * from ".$SysValue['base']['table_name11']." $str";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
@$SysValue['sql']['num']++;
$names=$row['name'];
$content=stripslashes($row['content']);
$link=$row['link'];
$ar=array($names,$content,$link);
return $ar;
}


function Vivod_cat_all_num($n)// ����� ���-�� ������� �� ������� �����������
{
global $SysValue;
$n=TotalClean($n,1);
$sql="select id from ".$SysValue['base']['table_name2']." where category=$n and enabled=1";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return $num;
}


// ������ ��� �����������
function ImgParser($img){
$array=split("\"",$img);
while (list($key, $value) = each($array))
    //if (preg_match("/\//",$value))
  if (preg_match("/Image/",$value))
    return $array[$key];
return "images/shop/no_photo.gif";
}   

// ����������� ��������
function Vivod_page_products($productID)
{
global $SysValue,$REQUEST_URI;
$sql="select * from ".$SysValue['base']['table_name1']." where flag='1' and element='1' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
if(empty($row['dir'])){
// ���������� ���������
$SysValue['other']['leftMenuName']= $row['name'];
$SysValue['other']['leftMenuContent']= $row['content'];
// ���������� ������
if(!ParseTemplateReturn($SysValue['templates']['right_menu']))
@$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
else @$dis.=ParseTemplateReturn($SysValue['templates']['right_menu']);
}
else{
$dirs= explode(",",$row['dir']);
foreach($dirs as $dir)
if(strpos($REQUEST_URI, $dir)){
// ���������� ���������
$SysValue['other']['leftMenuName']= $row['name'];
$SysValue['other']['leftMenuContent']= $row['content'];
// ���������� ������
if(!ParseTemplateReturn($SysValue['templates']['right_menu']))
@$dis.=ParseTemplateReturn($SysValue['templates']['left_menu']);
else @$dis.=ParseTemplateReturn($SysValue['templates']['right_menu']);
}}


}
return @$dis;
}

//������ ��������
function GetDeliveryList($deliveryID,$PID=0){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PID."') order by city";
$result=mysql_query($sql);
$i=mysql_num_rows($result);

///*
//�������������� ����� ���������, ���� ��� �����������.
if ($i<2) {  //���� ����������� � ������� �������� - ���, ��
	$row = mysql_fetch_array($result);
	//�������� ���������� ��������
	$sqlq="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$row['id']."') order by city";
	$resultq=mysql_query($sqlq);
	$iq=mysql_num_rows($resultq);
	if ($iq) { //���� ������� ����, �� ����� ������� ��
		return GetDeliveryList($deliveryID,$row['id']);
	} else {//� ���� ���, �� ������ �������� ������, ����� ��� ���� ��������
		$sql="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PID."') order by city";
		$result=mysql_query($sql);
	}
}
//*/

//������ �������� �� ������� ����
if ($PID>0) { //���� ������ �� �������� �����, �� 
	//�������� ��������
	$sqlp="select PID from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$PID."') order by city";
	$resultp=mysql_query($sqlp);
	$rowp = mysql_fetch_array($resultp);
	//�������� ���������� �����������
	$sqlpp="select id from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$rowp['PID']."') order by city";
	$resultpp=mysql_query($sqlpp);
	$ipp=mysql_num_rows($resultpp);
	if ($ipp>1) { //��������� ����� �� ����� ���������� ������� �� ������� ���� (����� �� ��� ������ ������ ������)
		@$dis.='<OPTION value='.$PID.'>[��������� �� ������� ����]</OPTION>';
	}
}

$PIDpr=$PID;
//�������� ������ ��� ���������
$predok='';
while ($PIDpr!=0) {
	$sqlpr="select city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$PIDpr."') order by city";
	$resultpr=mysql_query($sqlpr);
	$rowpr = mysql_fetch_array($resultpr);
	$PIDpr=$rowpr['PID'];
	$predok=$rowpr['city'].' > '.$predok;
}



while($row = mysql_fetch_array($result)){
     if(!empty($deliveryID)){
       if($row['id'] == $deliveryID) {$chk="selected";} else {$chk="";}
     } else{
       if($row['flag']==1) {$chk="selected";} else {$chk="";}
     }
     @$dis.='<OPTION value='.$row['id'].' '.$chk.'>'.$predok.$row['city'].'</OPTION>';
}

return $dis;

}

// ����� ������� ��������
function GetDelivery($deliveryID,$PID=0){

//������ �������
/*
$disp='<DIV id="seldelivery">
<SELECT onchange="UpdateDelivery(this.value)" name="dostavka_metod">'.GetDeliveryList($deliveryID,$PID).'</SELECT>
</DIV>';
return $disp;
*/

global $SysValue;


$sqlp="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$deliveryID."') order by city";
$resultp=mysql_query($sqlp);
$rowp = mysql_fetch_array($resultp);
$i=mysql_num_rows($resultp);

//���� �� ������� � ��������
$sqlpot="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$deliveryID."') order by city";
$resultpot=mysql_query($sqlpot);
$ipot=mysql_num_rows($resultpot);


$PID=$rowp['PID'];
$id=$deliveryID;


//�������� �������
$sqlsos="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PID."') order by city";
$resultsos=mysql_query($sqlsos);
$rowsos = mysql_fetch_array($resultsos);
$isos=mysql_num_rows($resultsos);

if ($isos<2) {//���� ������� ���, �� ����� �������� �� ������� ����
     $rowpot = mysql_fetch_array($resultpot); //������ ������� �������!!!
     $PID=$rowpot['PID'];
     $id=$rowpot['id'];
}


$PIDpr=$id;
//�������� ������ ��� ���������
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

	if (($ii>1) && (($ipot) || ($num>1))) { //���������� ������ "�����" ���� ������ 1 ������� ������ � �������� � (���� ���� ������� ���� ������� �������� ������ �������)
//	if (($ii>1) && ($num>1)) { //������� ������ "�����" ���� 1.������ ���� ������� ������ 2.������ ���� �� ������
		$pred='�������: '.$city.' <BR><BUTTON style="" onClick="UpdateDelivery('.$PIDpr.')" value="">����� �����</BUTTON> <BR> '.$pred;
	}
}

if (strlen($pred)) {$br='<BR>';} else {$br='';}
$disp='<DIV id="seldelivery">'.$pred.$br.'
<SELECT onchange="UpdateDelivery(this.value)" name="dostavka_metod">'.$makechoise;

$sql="select id,city,PID from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$id."') order by city";
$result=mysql_query($sql);
$i=mysql_num_rows($result);

if ($i>1) {$PID=$id; $disp.='<OPTION value="'.$id.'" id="makeyourchoise">�������� ��������</OPTION>'; $alldone='';
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



$disp.='</SELECT></DIV>';
return $disp;

}

// ����� ��������� ��������
function GetDeliveryPrice($deliveryID,$sum,$weight=0){
global $SysValue;

$deliveryID=TotalClean($deliveryID,1);
if(!empty($deliveryID)){
	$sql="select * from ".$SysValue['base']['table_name30']." where id='$deliveryID' and enabled='1'";
	$result=mysql_query($sql);
	$num=mysql_numrows($result);
	$row = mysql_fetch_array($result);
	if($num == 0){
		$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
		$result=mysql_query($sql);
		$row = mysql_fetch_array($result);
	}
} else {
	$sql="select * from ".$SysValue['base']['table_name30']." where flag='1' and enabled='1'";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
}

@$SysValue['sql']['num']++;

if($row['price_null_enabled'] == 1 and $sum>=$row['price_null']) {
	return 0;
} else {
	if ($row['taxa']>0) {
		$addweight=$weight-500;
		if ($addweight<0) {
			$addweight=0; 
			$at='';
		} else {
			$at='';
//			$at='���: '.$weight.' ��. ����������: '.$addweight.' ��. ���������:'.ceil($addweight/500).' = ';
		}
		$addweight=ceil($addweight/500)*$row['taxa'];
		$endprice=$row['price']+$addweight;
		return $at.$endprice;
	} else {
		return $row['price'];
	}
}
}//endfunct

// ����� ��������
function GetDeliveryBase($deliveryID,$name){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name30']." where id='$deliveryID'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row[$name];
}

// ����� ������� ������
function GetOplataMetod(){
global $LoadItems;
$option=unserialize($LoadItems['System']['admoption']);
if($option['oplata_3'] == 1)
@$dis.='<option value="3" >�������� ������ �������</option>';
if($option['oplata_2'] == 1)
@$dis.='<option value="2" >��������� ���������</option>';
if($option['oplata_1'] == 1)
@$dis.='<option value="1" >���� � ����</option>';
if($option['oplata_4'] == 1)
@$dis.='<option value="4" >��������� ��������</option>';
if($option['oplata_5'] == 1)
@$dis.='<option value="5" >�������� ����� ROBOXchange</option>';
if($option['oplata_6'] == 1)
@$dis.='<option value="6" >WebMoney</option>';
if($option['oplata_7'] == 1)
@$dis.='<option value="7" >Z-Payment</option>';
if($option['oplata_8'] == 1)
@$dis.='<option value="8" >��������� ����� Visa, MasterCard</option>';

$disp='<select name="order_metod" style="width:220px;">
'.@$dis.'
</select>';
return $disp;
}

// ����� ������� �������
function GetSelectPage(){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name11']." order by name";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){
@$dis.='<OPTION value="'.$row['link'].'.html">'.$row['name'];
}
return @$dis;
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
?>