<?
/*
+-------------------------------------+
|  ���: PHPShopProduct                |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ���� �������           |
|  ������: 1.0                        |
|  ���: Extends class                 |
|  �����������: PHPShopUser                   |
|  �����: Object                      |
+-------------------------------------+
*/


if (!defined("OBJENABLED")){
require_once(dirname(__FILE__)."/obj.class.php");
require_once(dirname(__FILE__)."/array.class.php");
}

class PHPShopProduct extends PHPShopObj{
	 
	 function PHPShopProduct($objID){
	 $this->objID=$objID;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name2'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 
	 function getValutaID(){
	 return parent::getParam("baseinputvaluta");
	 }
}


class PHPShopProductArray extends PHPShopArray{
	 
	 function PHPShopProductArray($sql=""){
	 $this->objSQL=$sql;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name2'];
	 parent::PHPShopArray('id','uid','name','category','price','price_n','sklad','odnotip','vendor','title_enabled',
	 'datas','page','user','descrip_enabled','keywords_enabled','pic_small','pic_big','parent','baseinputvaluta');
	 }
}


class PHPShopProductFunction{
     
	 // ���� � ������ ������
     function GetPriceValuta($id,$price,$formats=0,$baseinputvaluta=false,$order=false){ 
     global $SysValue,$LoadItems,$PHPShopValutaArray,$PHPShopSystem;
	 
	 if(!$LoadItems){
	 $LoadItems['Valuta']=$PHPShopValutaArray->getArray();
	 $LoadItems['System']=$PHPShopSystem->getArray();
	 }
	 
	 // ���� ������� ������ ������
	 
     $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");
     
	 // ������� �� ���� ������ ������� ���� ��� �����. ������������
	 if(!empty($_SESSION['UsersStatus'])){
	 $PHPShopUser = new PHPShopUserStatus($_SESSION['UsersStatus']);
     $GetUsersStatusPrice=$PHPShopUser->getPrice();
	  if($GetUsersStatusPrice>1){
	   $pole="price".$GetUsersStatusPrice;
	   $PHPShopProduct = new PHPShopProduct($id);
	   
	   $user_price=$PHPShopProduct->getParam($pole);
	   if(!empty($user_price)) $price=$user_price;
	   
	 }}
	 
	 
	 // ���� ������ ������
     if ($baseinputvaluta) { //���� �������� ���. ������
	   if ($baseinputvaluta!==$LoadItems['System']['dengi']) {//���� ���������� ������ ���������� �� �������
		$price=$price/$LoadItems['Valuta'][$baseinputvaluta]['kurs']; //�������� ���� � ������� ������
	   }
     }

	 // ���� ������� ������ ������, order - ���� ��� ������� ������� ������ � ���. ������
	 if($order) $valuta=$LoadItems['System']['dengi'];
	  elseif (isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
        else $valuta=$LoadItems['System']['dengi'];
     
	 
	 // ������ �� ����
     $price=$price*$LoadItems['Valuta'][$valuta]['kurs'];
	 
	 // �������
	 $price=($price+(($price*$LoadItems['System']['percent'])/100));
     return number_format($price,$format,'.','');
     }
}
?>