<?
/*
+-------------------------------------+
|  ���: PHPShopBase                   |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ����������� � MySQL    |
|  � config.ini                       |
|  ������: 1.0                        |
|  ���: class                         |
|  �����������: ���                   |
|  �����: Object                      |
+-------------------------------------+
*/



class PHPShopBase {
      var $iniPath;
	  var $SysValue;
	  var $codBase="cp1251";
	  var $debug="true";
	  
	  function PHPShopBase($iniPath){
	  $this->iniPath=$iniPath;
	  $this->SysValue=parse_ini_file($this->iniPath,1);
	  $GLOBALS['SysValue']=$this->SysValue;
	  $this->connect();
	  }
	  
      function getSysValue(){
	  return $this->SysValue;
	  }
	  
	  function getParam($param){
	  $param=explode(".",$param);
	  return $this->SysValue[$param[0]][$param[1]];
	  }
	  
	  
	  function errorConnect(){
	  echo "��� ���������� � �����!<br>";
	  if($this->debug == "true") echo "������: ".mysql_error();
	  exit();
	  }
	  
      function connect(){
	  $SysValue=$this->SysValue;
	  mysql_connect($this->getParam("connect.host"),$this->getParam("connect.user_db"),$this->getParam("connect.pass_db")) or die( $this->errorConnect());
      mysql_select_db($SysValue['connect']['dbase']);
      @mysql_query("SET NAMES '".$this->codBase."'");
	  }
	  
	  // �������� ���� ������
	  function chekAdmin($require=true){
	  global $UserChek,$UserStatus;
      $adminPath = explode("../",$this->iniPath);
      $i=2;
      while(count($adminPath) > $i){
           @$aPath.="../";
           $i++;
           }
	  $loadPath=$aPath."enter_to_admin.php";
	  if($require) require_once($loadPath);
	  else return $loadPath;
	  }
	  
	  // ���-�� �������
	  function getNumRows($from_base,$query) {
      global $SysValue;
	  $num=0;
      $sql="select COUNT('id') as count from ".$this->SysValue['base'][$from_base]." ".$query;
      $result=mysql_query($sql);
      $row = mysql_fetch_array(@$result);
      $num=$row['count'];
      return $num;
      }

}
?>