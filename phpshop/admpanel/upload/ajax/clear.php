<?php
require_once "../../../../phpshop/lib/Subsys/JsHttpRequest/Php.php";
// ������� ������� ������ ����������.
// ��������� ��������� �������� (�����������!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");


require("../../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
//////////////////////////////////////////////////////////
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../../enter_to_admin.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../../language/".$Lang."/language.php");
require("log_save.php");
/////////////////////////////////////////////////////////////////


// ��������� �����
if(!CheckedRules($UserStatus["upload"],0) == 1) {
	$GLOBALS['_RESULT']['stat']=  "������������ ����";	
	$GLOBALS['_RESULT']['susses']=  "error";	
	exit();
}	


// ����������� ���� ������� �������
$map = @parse_ini_file("../../../../backup/temp/upd_conf.txt",1);
if(empty($map)){
	$GLOBALS['_RESULT']['stat'] = "upload_modul_error:5 - �� ������ �������� ������ ������� ����������";
	log_write("�� ������ �������� ������ ������� ����������");
	exit();
}

// ��������� ������ �����, � ������� ����� �������� ����� �������. ���� �������� ������ ����� ���������.
$temp1 = "";

/////// ������������ � ��� ������������
if (!$ftp_stream = ftp_connect($SysValue['user_ftp']['host'])) {
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������");
	exit();
}

if (!ftp_login($ftp_stream,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">������ ����������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("upload_modul_error:2 - ������ ����������� � �������� ������������");
	exit();
}

if (!ftp_pasv($ftp_stream,true)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���������� ���������� ��������� �����</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("���������� ���������� ��������� �����");
	exit();
}





////// ��������� config.ini/////////////////////////////////////
	
	if (1){
	  $f = fopen("../../../inc/config.ini","w");
	 $config = @parse_ini_file("../../../../backup/temp/config_update.txt",1);
	 foreach ($config as $k=>$v) 
	 	foreach ($config[$k] as $key => $value) {
	 		$SysValue[$k][$key] = $value;	 		
	 	}
	 
foreach ($SysValue as $kk=>$vv) {

		  if ($kk != "Lang"){
		           $s .="[$kk]\n";
		           //fwrite($f,"[$kk]\\n");
		         
		           foreach ($SysValue[$kk] as $kk1=>$vv1) {
		                     $s .= "$kk1 = \"$vv1\";\n";
		                     //fwrite($f,"$kk1 = \"$vv1\"");
		                     //fwrite($f,"\\n");
		                }     
		             
		                $s .= "\n";
		                //fwrite($f,"\\n");
		}
      }

	 fwrite($f,$s);
	 fclose($f);
	// ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['re_chmod']." ".$SysValue['user_ftp']['dir']."/backup/temp/config_update.txt");
	 $temp2 .= "<br>config.ini  �������...";
	}
//////////////////////////////////////////////////






log_write("======= ����� ����� ====");
foreach ($map as $k=>$v) {
	$temp1 .= upload_folder_create($k, $temp,$ftp_stream);
}

	
		if(ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['re_chmod']." ".$SysValue['user_ftp']['dir']."/phpshop/inc/config.ini")) $temp11 = " - ����� ����������� �������������!";
		
	log_write("/phpshop/inc/config.ini  -  $temp11");	
	$temp1 .=  "/phpshop/inc/config.ini  -  $temp11<br>";


$temp1 = "======= ����� ����� ====<br>$temp1======================";


$GLOBALS['_RESULT'] = array(
'stat' => $temp,
'susses' => "dirList"
);







	$GLOBALS['_RESULT']['stat']=  " <span style=\"color:green\">���������� ������� ���������!<br> $temp</span><br> $temp1 <br> $temp2";	
	$GLOBALS['_RESULT']['susses']=  "end";	
	log_write("���������� ������� ���������!");
	
	
	
	
	
	
	
	
	
function upload_folder_create($str,$mask,$ftp_stream){
	global $SysValue;
	
	$str= str_replace(" ","",$str);
	if($str == "/") {
		if(ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['re_chmod']." ".$SysValue['user_ftp']['dir']."/"))
			$temp1 = " - ����� ����������� �������������!";
			
		log_write("/  - �� �������� ����� ����� $temp1");				
		return "/  - �� �������� ����� ����� $temp1<br>";
	}


	$str = explode("/",$str);
	
	
	for ($i=count($str)-1;$i>=0;$i--){
		$folder = $str[0];
		for ($c=1;$c<=$i;$c++) 
		{
			$folder .= "/".$str[$c];		
			
		}
		if (is_dir("../../../../$folder")) {
			if(!stristr($mask,$folder."<br>")){
				$temp .= $folder;
				if(ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['re_chmod']." ".$SysValue['user_ftp']['dir']."/$folder")) $temp .= " - ����� ����������� �������������!";
				$temp .= "<br>";
				log_write($temp);
			}
			return $temp;
			
		}
		
	}
	return $temp;

}
?>