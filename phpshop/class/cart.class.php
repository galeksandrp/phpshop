<?
/*
+-------------------------------------+
|  ���: PHPShopCart                   |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: �������                |
|  ������: 1.0                        |
|  ���: class                         |
|  �����������: PHPShopProduct        |
|  PHPShopSecurity                    |
|  �����: Object                      |
+-------------------------------------+
*/

if (!defined("OBJENABLED")){
require_once(dirname(__FILE__)."/product.class.php");
require_once(dirname(__FILE__)."/security.class.php");
}

class PHPShopCart{
	 var $_CART;

     function PHPShopCart(){
	 $this->_CART=&$_SESSION['cart'];
	 }
	 
	 // ���������� � �������
	 function add($objID){
	 $objID = PHPShopSecurity::TotalClean($objID,1);
	 $objProduct = new PHPShopProduct($objID);
     
	 
	 $cart_new=array(
     "id"=>$objID,
     "name"=>PHPShopSecurity::CleanStr($objProduct->getParam("name")),
 "price"=>PHPShopProductFunction::GetPriceValuta($objID,$objProduct->getParam("price"),0,$objProduct->getParam("baseinputvaluta"),true),
     "uid"=>$objProduct->getParam("uid"),
     "num"=>$num=$this->_CART[$objID]['num']+$_REQUEST['num'],
     "weight"=>$objProduct->getParam("weight"),
     "user"=>$objProduct->getParam("user"));
	 $this->_CART[$objID]=$cart_new;
	 }
	 
	 // �������� �� �������
	 function del($objID){
	 unset($this->_CART[$objID]);
	 }
	 
	 // ������� �������
	 function clean(){
     unset($this->_CART);
	 $_SESSION['cart']=false;
     }
	 
	 // ���-�� �������
     function getNum(){
	 $num=0;
	 foreach($this->_CART as $val) $num+=$val['num'];
     return $num;
	 }
	 
	 // �������������� ���-��
	 function edit($objID,$num){
	 $this->_CART[$objID]['num']=abs($num);
	 if(empty($this->_CART[$objID]['num'])) unset($this->_CART[$objID]);
     return $num;
	 }
	 
	 // ����� �������
	 function getSum($order=true){
	 global $PHPShopSystem,$LoadItems;
	 $sum=0;
	 foreach($this->_CART as $val) $sum+=$val['num']*$val['price'];
	 $format=$PHPShopSystem->getSerilizeParam("admoption.price_znak");
	 
	 // ���� ������� ������ ������
     if($order and isset($_SESSION['valuta'])){
	    $valuta=$_SESSION['valuta'];
		$kurs=$LoadItems['Valuta'][$valuta]['kurs'];
		}
       else $kurs=$PHPShopSystem->getDefaultValutaKurs();
	   
	 // �������� �� �����
	 //$sum*=$kurs;
     return number_format($sum*$kurs,$format,'.','');
	 }
}



/*
session_start();
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("user");
$PHPShopBase = new PHPShopBase("../inc/config.ini");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// ������ �����
$PHPShopValutaArray = new PHPShopValutaArray();

$PHPShopCart = new PHPShopCart();
$PHPShopCart->add(30);
$PHPShopCart->add(31);
$PHPShopCart->add(36);
$PHPShopCart->del(30);

echo "<pre>";
print_r($cart);
echo "��-��: ".$PHPShopCart->getNum();
*/
?>
