<?
/*
+-------------------------------------+
|  ���: PHPShopPage                   |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ���� �����             |
|  ������: 1.0                        |
|  ���: Extends class                 |
|  �����������: ���                   |
|  �����: Object                      |
+-------------------------------------+
*/


if (!defined("OBJENABLED")){
require_once(dirname(__FILE__)."/obj.class.php");
require_once(dirname(__FILE__)."/array.class.php");
}


class PHPShopPageCategoryArray extends PHPShopArray{
	 
	 function PHPShopPageCategoryArray(){
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name29'];
	 parent::PHPShopArray("id","name","parent_to");
	 }
}
?>