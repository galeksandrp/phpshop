<?
if (!defined("OBJENABLED")) define("OBJENABLED", dirname(__FILE__));

class PHPShopObj {
     var $objID;
	 var $objBase;
	 var $objRow;
	 var $objDebug=true;
	 
     function PHPShopObj(){
	 $this->setRow();
	 }
	 
	 // ����� ������� ������
	 function setRow(){
	 $sql="select * from ".$this->objBase." where id=".$this->objID." limit 1";
	 $result=mysql_query($sql) or die($this->debug($sql));
	 $this->objRow=mysql_fetch_array($result);
	 }
     
	 function debug($sql){
     if($this->objDebug == true)
	 exit("��� ���������� ��� �������  ".$this->objBase."<br>".$sql);
	   else exit(" :( ");
	 }
	 
	 
	 // ����� ���������
	 function getParam($paramName){
	 return $this->objRow[$paramName];
	 }
	 
	 function getArray(){
	 return $this->objRow;
	 }
	 
	 // �������� ������
	 function loadClass($class_name){
	 $class_path=OBJENABLED."/".$class_name.".class.php";
	 if(file_exists($class_path)) include_once($class_path);
	   else echo "��� ����� ".$class_path;
	 }
	 
	 // �������������� ���������
	 function unserializeParam($paramName){
	 return unserialize($this->getParam($paramName));
	 }
}

?>