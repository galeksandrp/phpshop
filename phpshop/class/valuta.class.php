<?
/*
+-------------------------------------+
|  ���: PHPShopValuta                 |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ���� �����             |
|  ������: 1.0                        |
|  ���: Extends class                 |
|  �����������: ���                   |
|  �����: Object, function            |
+-------------------------------------+
*/


if (!defined("OBJENABLED")){
require_once(dirname(__FILE__)."/obj.class.php");
}
require_once(dirname(__FILE__)."/array.class.php");

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
	 
	 // ������ ���� �������� �� ����� ISO
	 // ����� PHPShopValuta::getAll()
	 function getAll(){
	 $sql="select * from ".$GLOBALS['SysValue']['base']['table_name24'];
     $result=mysql_query($sql);
     while ($row = mysql_fetch_array($result))
         {
         $id=$row['id'];
         $iso=$row['iso'];
         $array[$iso]=$id;
	     }
     return $array;
	 }
}

class PHPShopValutaArray extends PHPShopArray{
	 
	 function PHPShopValutaArray(){
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name24'];
	 parent::PHPShopArray('id',"name",'code','iso','kurs');
	 }
}
?>