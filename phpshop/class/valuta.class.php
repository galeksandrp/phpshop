<?

if (!defined("OBJENABLED"))
require_once(dirname(__FILE__)."/obj.class.php");

class PHPShopValuta extends PHPShopObj{
     
	 function PHPShopValuta($objID){
	 $this->objID=$objID;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name24'];
	 parent::PHPShopObj();
	 }
	 
	 function getName(){
	 return parent::getParam("name");
	 }
	 
	 function getIso(){
	 return parent::getParam("iso");
	 }
	 
	 function getKurs(){
	 return parent::getParam("kurs");
	 }
	 
	 function getCode(){
	 return parent::getParam("code");
	 }
}

?>