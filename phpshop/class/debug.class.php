<?
/*
+-------------------------------------+
|  ���: PHPShopDebug                  |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: �������                |
|  ������: 1.0                        |
|  ���: class                         |
|  �����������: ���                   |
|  �����: Function                    |
+-------------------------------------+
*/

class PHPShopDebug{

     // ������ ��������� �������
	 function printArray($array,$hr=false,$title=false){
	 if($title) echo "<h4>$title</h4>";
	 if($hr) echo "<hr>";
	 echo "<pre>";
	 print_r($array);
	 echo "<pre>";
	 }
	 
	 // ������ config.ini
	 function getIni($hr=false,$title=false){
	 $this->printArray($GLOBALS['SysValue']);
	 }
	 
	 function printStr($str,$title=false){
	 if($title) echo "<h4>$title'</h4>";
	 if($thr) echo "<hr>";
	 echo $str;
	 }
	 
	 // ���������� ������
	 function E_OFF($function=false,$param=false){
	 if($function==false) error_reporting(0);
	    else {
		error_reporting(0);
	    call_user_func($function,$param);
		error_reporting(7);
		}
	 }
	 
	 // ��������� �������
	 function E_ON(){
	 error_reporting(7);
	 }
	 
}


?>
