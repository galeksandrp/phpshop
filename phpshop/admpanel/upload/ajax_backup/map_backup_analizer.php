<?php
require_once "../../../../phpshop/lib/Subsys/JsHttpRequest/Php.php";
// ������� ������� ������ ����������.
// ��������� ��������� �������� (�����������!).
$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");


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
log_clear();
/////////////////////////////////////////////////////////////////


// ��������� �����
if(!CheckedRules($UserStatus["upload"],0) == 1) {
	$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������������ ����</span>";	
	$GLOBALS['_RESULT']['susses']=  "error";	
	log_write("������������ ����");
	exit();
}	


// ��������� �������� ����� ������
$sql = "SELECT  folder FROM ".$SysValue['base']['table_name47']." WHERE date = (SELECT MAX(date) FROM ".$SysValue['base']['table_name47'].")";
$row = mysql_fetch_array(mysql_query($sql));
$folder = $row['folder'];
//$GLOBALS['_RESULT']['stat'] = $row['folder'];
//exit();


	
// ����������� ���� ������� �������
$map = @parse_ini_file("$folder/upd_conf.txt",1);
if(empty($map)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:5 - �� ������ �������� ������ ������� ��������������</span>";
	log_write("�� ������ �������� ������ ������� ��������������");
	exit();
}


// ��������� ������ �����, � ������� ����� �������� ����� �������. ���� �������� ������ ����� ���������.
$temp = "";

////////////���������� � ��� ������������ /////////////////////////
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
/////////////////////////////////////////////////////


log_write("======= ����� ����� ====");
foreach ($map as $k=>$v) {
	$temp .= upload_folder_create($k, $temp,$ftp_stream);
}


$temp = "======= ����� ����� ====<br>$temp======================";


$GLOBALS['_RESULT'] = array(
'stat' => $temp,
'susses' => "dirList_backup"
);


// ������ ��������� ������ �����, �� ������� ���������� ���������� �����.


function upload_folder_create($str,$mask,$ftp_stream){
	global $SysValue;
	
	$str= str_replace(" ","",$str);
	if($str == "/") {
		if(ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['chmod']." ".$SysValue['user_ftp']['dir']."/$folder")) $temp1 = " - ����� ����������� �������������!";
		
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
				if(ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['chmod']." ".$SysValue['user_ftp']['dir']."/$folder")) $temp .= " - ����� ����������� �������������!";
				$temp .= "<br>";
				log_write($temp);
			}
			return $temp;
			
		}
		
	}
	return $temp;

}

?>