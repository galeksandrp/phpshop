<?
/*
+-------------------------------------+
|  ���: PHPShopSystem                 |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ��������� ���������    |
|  ������: 1.0                        |
|  ���: Extends class                 |
|  �����������: ���                   |
|  �����: Object                      |
+-------------------------------------+
*/

if (!defined("OBJENABLED"))
require_once(dirname(__FILE__)."/obj.class.php");



class PHPShopSystem extends PHPShopObj{
     
	 function PHPShopSystem(){
	 $this->objID=1;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name3'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 // ����� ���������������� �������� [param.val]
	 function getSerilizeParam($param){
	 $param=explode(".",$param);
	 $val=parent::unserializeParam($param[0]);
	 return $val[$param[1]];
	 }
	 
	 
	 function getDefaultValutaId(){
     return parent::getParam("dengi");
	 }
	 
	 function getDefaultOrderValutaId(){
     return parent::getParam("kurs");
	 }
	 
	 // ���� ������ �� ��������, order - ������ � ������ (true)
	 function getDefaultValutaKurs($order=false){
	 if(!class_exists("phpshopvaluta")) parent::loadClass("phpshopvaluta");
	   if($order) $valuta_id = $this->getDefaultOrderValutaId();
         else $valuta_id = $this->getDefaultValutaId();
	 $PV = new PHPShopValuta($valuta_id);
	 return $PV->getKurs();
	 }
	 
	 // Iso ������ �� ��������, order - ������ � ������ (true)
	 function getDefaultValutaIso($order=false){
	 if(!class_exists("phpshopvaluta")) parent::loadClass("valuta");
       if($order) $valuta_id = $this->getDefaultOrderValutaId();
         else $valuta_id = $this->getDefaultValutaId();
	 $PV = new PHPShopValuta($valuta_id);
	 return $PV->getIso();
	 }
	 
	 // ��� ������ �� ��������, order - ������ � ������ ������ � ������ ��� ������ (true)
	 function getDefaultValutaCode($order=false){
	 if(!class_exists("phpshopvaluta")) parent::loadClass("valuta");
	 
	 if($order) $valuta_id = $this->getDefaultOrderValutaId();
	  elseif(isset($_SESSION['valuta'])) $valuta_id=$_SESSION['valuta'];
	       else $valuta_id = $this->getDefaultValutaId();
	 
	 $PV = new PHPShopValuta($valuta_id);
	 return $PV->getCode();
	 }
	 
	 function getLogo(){
	 $logo = parent::getParam("logo");
	 if(empty($logo)) return "../../img/phpshop_logo.gif";
       else return $logo;
	 }
	 
	 function getArray(){
	 $array = $this->objRow;
	 foreach($array as $key=>$v)
	      if(is_string($key)) $newArray[$key]=$v;
	 return $newArray;
	 }
}
?>