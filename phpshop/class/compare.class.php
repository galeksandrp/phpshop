<?
/*
+-------------------------------------+
|  ���: PHPShopCompare                |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ���������              |
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

class PHPShopCompare{
	 var $_COMPARE;

     function PHPShopCompare(){
	 $this->_COMPARE=&$_SESSION['compare'];
	 }
	 
	 // ����������
	 function add($objID){
	 $objID = PHPShopSecurity::TotalClean($objID,1);
	 $objProduct = new PHPShopProduct($objID);
	 $new=array(
     "id"=>$objID,
     "name"=>PHPShopSecurity::CleanStr($objProduct->getParam("name")),
     "category"=>$objProduct->getParam("category"));
	 $this->_COMPARE[$objID]=$new;
	 }
	 
	 function getNum(){
	 return count($this->_COMPARE);
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
