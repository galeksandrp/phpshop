<?

/* ����� ������ ������� �� ������� ��������

$Disp = new DispSpec(); // ��������� �����
$Disp->sql=""; // sql ������
$Disp->setka_num=""; // ��� ����� (1-3)
$Disp->setka_style=""; // ����� ����� (setka)
$Disp->template=""; // ��� ������� ������
$Disp->Engen(); // ��������� ��������
$Return=$Disp->disp; // ���������� ���������� ��� ������

*/

class DispSpec {
      var $sql;
	  var $setka_num;
      var $disp;
      var $template;
	  var $setka_style;


      function Engen(){
      global $SysValue,$LoadItems;

$Options=unserialize($LoadItems['System']['admoption']);

$sql=$this->sql;
$result=mysql_query($sql);
@$num=mysql_numrows(@$result);
if($num>0){
$SysValue['my']['setka_spe�_num']=$this->setka_num;
if($SysValue['my']['setka_spe�_num'] == 2) $j=0;
if($SysValue['my']['setka_spe�_num'] == 3) $j=5;

while(@$row = mysql_fetch_array(@$result))
    {
    $id=$row['id'];
	$uid=$row['uid'];
	$name=stripslashes($row['name']);
	$category=$row['category'];
	$price=$row['price'];
	$priceNew=$row['price_n'];
	$price=($price+(($price*$LoadItems['System']['percent'])/100));
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
	$description=stripslashes($row['description']);
	$sklad=$row['sklad'];
	$items=$row['items'];
	$baseinputvaluta=$row['baseinputvaluta'];		

// �������
if($row['parent']!=""){
$SysValue['other']['ComStartCart']="<!--";
$SysValue['other']['ComEndVart']="-->";

}else{
$SysValue['other']['ComStart']="";
$SysValue['other']['ComEnd']="";
}
	
	// ������� �� ���� ������ ������� ����
	if(session_is_registered('UsersStatus')){
    $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
	  if($GetUsersStatusPrice>1){
	   $pole="price".$GetUsersStatusPrice;
	   $pricePersona=$row[$pole];
	   if(!empty($pricePersona)) 
	     $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
	   }
	}
	
	
	// ���� ���� ����� ����
	if($priceNew>0){
	$priceNew=($priceNew+(($priceNew*$LoadItems['System']['percent'])/100));
	$priceNew=number_format($priceNew,"2",".","");
	}
	
	// �������� �� ������� ����
	if(!is_numeric($row['price']))
	$sklad = 1;
	
	$uid=$row['uid'];
	$odnotip=explode(",",$row['odnotip']);
	$parent=explode(",",$row['parent']);
	$vendor=$row['vendor'];
	$vendor_array=$row['vendor_array'];

// ����� Multibase
$admoption=unserialize($LoadItems['System']['admoption']);
if($admoption['base_enabled'] == 1 and !empty($admoption['base_host']))
$pic_small=eregi_replace("/UserFiles/","http://".$admoption['base_host']."/UserFiles/",$pic_small);


// ������ ��������
if(empty($pic_small))
$pic_small="images/shop/no_photo.gif";

// ���������� ���������
$SysValue['other']['productPriceMoney']= $LoadItems['System']['dengi'];
$SysValue['other']['productSale']= $SysValue['lang']['product_sale'];
$SysValue['other']['productInfo']= $SysValue['lang']['product_info'];
@$SysValue['other']['productName']= $name;
$SysValue['other']['productDes']= $description;
$SysValue['other']['productValutaName']= GetValuta();
@$SysValue['other']['productArt']= $uid;
$SysValue['other']['productImg']= $pic_small;
$SysValue['other']['productImgBigFoto']= $pic_big;
@$SysValue['other']['productId']= $category;
@$SysValue['other']['productUid']= $id;


// ���������� ��������� ������
if($admoption['sklad_enabled'] == 1 and $items>0)
$SysValue['other']['productSklad']= $SysValue['lang']['product_on_sklad']." ".$items." ".$SysValue['lang']['product_on_sklad_i'];
 else $SysValue['other']['productSklad']="";


// and $items>0
if($sklad==0 ){// ���� ����� �� ������

// �������
$SysValue['other']['Notice']="";
$SysValue['other']['ComStartCart']="";
$SysValue['other']['ComEndCart']="";
$SysValue['other']['ComStartNotice']="<!--";
$SysValue['other']['ComEndNotice']="-->";

// ���� ��� ����� ����
if(empty($priceNew)){
$SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
$SysValue['other']['productPriceRub']= "";
}else{// ���� ���� ����� ����
$SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
$SysValue['other']['productPriceRub']= "<strike>".GetPriceValuta($priceNew,"",$baseinputvaluta)." ".GetValuta()."</strike>";
}}else{ // ����� ��� �����
$SysValue['other']['productPrice']=GetPriceValuta($price,"",$baseinputvaluta);
$SysValue['other']['productPriceRub']=$SysValue['lang']['sklad_mesage'];
$SysValue['other']['ComStartNotice']="";
$SysValue['other']['ComEndNotice']="";
$SysValue['other']['ComStartCart']="<!--";
$SysValue['other']['ComEndCart']="-->";
$SysValue['other']['productNotice']=$SysValue['lang']['product_notice'];
}

// ���� ���� ���������� ������ ����� ����������
if($admoption['user_price_activate']==1 and !$_SESSION['UsersId']){
    $SysValue['other']['ComStartCart']="<!--";
    $SysValue['other']['ComEndCart']="-->";
    $SysValue['other']['productPrice']="";
	$SysValue['other']['productValutaName']="";
}


// ����� ����� ��� �������
$DispCatOptionsTest=DispCatOptionsTest($category);
if($DispCatOptionsTest == 1){
  $SysValue['other']['ComStartCart']="<!--";
  $SysValue['other']['ComEndCart']="-->";
  }

// ���������� ������ ������������� �� �����
@$dis=ParseTemplateReturn($this->template);


// ����� 1*1
if($SysValue['my']['setka_spe�_num'] == 1){

 $td="<tr><TD class=".$this->setka_style." colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
 $td.="<tr><td valign=\"top\">"; @$j++; $td2="</td>";

 @$disp.=$td.$dis;

}


// ����� 2*2
if($SysValue['my']['setka_spe�_num'] == 2){

 if($j==1){ $td="<td valign=\"top\"  class=\"panel_r\">"; $j=0; $td2="</td><tr>";}
 else {
 $td="<TD class=".$this->setka_style." colspan=3 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
 $td.="<tr><td valign=\"top\"  class=\"panel_l\">"; $j++; $td2="</td>";
 $td2.="<TD width=1 class=".$this->setka_style."><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
 }
 
 @$disp.=$td.$dis.$td2;

}

// ����� 3*3
if($SysValue['my']['setka_spe�_num'] == 3){

 if($j==3){
$td="<td valign=\"top\" class=\"panel_t\">"; $j++; $td2="</td></tr>";
@$disp.=$td.$dis.$td2;
}

if($j==2){
$td="<td  valign=\"top\" class=\"panel_t\">"; $j++; $td2="</td>";
$td2.="<TD width=1 class=".$this->setka_style."><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
@$disp.=$td.$dis.$td2;
}

if($j==1){

$td="<tr><TD class=".$this->setka_style." colspan=5 height=1><IMG height=1 src=\"images/spacer.gif\" width=1></TD></tr>";
$td.="<tr><td   valign=\"top\" class=\"panel_t\">"; $j++; $td2="</td>";
$td2.="
<TD width=1 class=".$this->setka_style."><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
@$disp.=$td.$dis.$td2;
}

if($j==4){
$j=1;
}

if($j==5){

$td="<tr><td   valign=\"top\">"; $j=2; $td2="</td>";
$td2.="
<TD width=1 class=".$this->setka_style."><IMG height=1 src=\"images/spacer.gif\" width=1></TD>";
@$disp.=$td.$dis.$td2;
}

}}


$disp="<table cellpadding=0 cellspacing=0 width=\"100%\">".@$disp."</table>";
@$SysValue['sql']['num']++;

$this->disp = @$disp;
       }
  }
}

?>
