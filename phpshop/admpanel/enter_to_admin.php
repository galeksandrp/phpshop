<?
// ������� ����������� �� ����������
if($SysValue['my']['time_limit_enabled']=="true"){
$is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
if (!$is_safe_mode) @set_time_limit(TIME_LIMIT);
}

// ����� �������� ������������
class UserChek {
      var $logPHPSHOP;
	  var $pasPHPSHOP;
	  var $idPHPSHOP;
	  var $statusPHPSHOP;
	  var $mailPHPSHOP;
	  var $OkFlag=0;
	  var $DIR;
	  
	  function ChekBase($table_name){
	  $sql="select * from ".$table_name." where enabled='1'";
      @$result=mysql_query(@$sql);
      while (@$row = mysql_fetch_array(@$result)){
      if($this->logPHPSHOP==$row['login']){
	    if($this->pasPHPSHOP==$row['password']){
           $this->OkFlag=1;
		   $this->idPHPSHOP=$row['id'];
	       $this->statusPHPSHOP=unserialize($row['status']);
	       $this->mailPHPSHOP=$row['mail'];
		   }
      }}}
	  
	  function BadUser(){
	  if($this->OkFlag == 0){
	  header("Location: ".$this->$DIR."/phpshop/admpanel/");
	  exit("Login Error");}
	  }
	  
	  function UserChek($logPHPSHOP,$pasPHPSHOP,$table_name,$DIR){
	  $this->logPHPSHOP=$logPHPSHOP;
	  $this->pasPHPSHOP=$pasPHPSHOP;
	  $this->ChekBase($table_name);
	  $this->BadUser();
	  }
	  
	  function BadUserForma(){
	  $disp='
	  <table width="100%" height="100%" style="Z-INDEX:2;">
<tr>
	<td valign="middle" align="center">
		<div style="width:400px;height:100px;BACKGROUND: #C0D2EC;padding:10px;border: solid;border-width: 1px; border-color:#4D88C8;FILTER: alpha(opacity=80);" align="left">
<table width="100%" height="100%">
<tr>
	<td width="35" vAlign=center ><IMG 
            hspace=0 src="img/i_support_med[1].gif" align="absmiddle" 
            border=0 ></td>
	<td ><b>��������, '.$this->logPHPSHOP.'!</b><br>� ��� ������������ ���� ��� ���������� ������ ��������.<br>���������� � �������������� �������.</td>
</tr>
</table>

		</div>
</td>
</tr>
</table>
	  
	  ';
	  return $disp;
      }
	  
	  function BadUserFormaWindow(){
	  echo'
	  <script>
	  if(confirm("�������� '.$this->logPHPSHOP.'!\n� ��� ������������ ���� ��� ���������� ������ ��������.\n������� ��� ����?"))
	  window.close();
	  </script>';
      }
}

session_start();
@mysql_query("SET NAMES 'cp1251'");
$UserChek = new UserChek(@$_SESSION['logPHPSHOP'],@$_SESSION['pasPHPSHOP'],$table_name19,$SysValue['dir']['dir']);
$UserStatus = $UserChek->statusPHPSHOP;

// �������� ����
function CheckedRules($a,$b){
$array=explode("-",$a);
return $array[$b];
}

// Secure Fix 4.0
function RequestSearch($search){
global $PHP_SELF;
$pathinfo=pathinfo($PHP_SELF);
if($pathinfo['basename'] != "adm_sql.php" or $pathinfo['basename'] != "adm_sql_file.php"){
$com=array("union","select","insert","update","delete");
$mes="��������!!!<br>������ ������� �������� ��-�� ������������� ���������� �������";
$mes2="<br>������� ��� ��������� ���� ������� � ������� ����������.";
foreach($com as $v)
      if(eregi($v,$search)){
	   $search=eregi_replace($v,"!!!$v!!!",$search);
	   exit($mes." ".strtoupper($v).$mes2."<br><textarea style='width: 100%;height:50%'>".$search."</textarea><br>������� � ������ �������� ������� !!!<br>");
	   } 
}}

foreach($_REQUEST as $val) RequestSearch($val);

?>
