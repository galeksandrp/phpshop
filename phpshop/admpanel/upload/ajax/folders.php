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
/////////////////////////////////////////////////////////////////


// ��������� �����
if(!CheckedRules($UserStatus["upload"],0) == 1) {
	$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������������ ����</span>";	
	$GLOBALS['_RESULT']['susses']=  "error";	
	log_write("������������ ����");
	exit();
}	


if (($_SESSION['base_update'] != "susses")&&($_REQUEST['update_base'] == "yes")) {	
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">��� 2-1 ����� ��������!!!</span>";
	$GLOBALS['_RESULT']['susses']=  "error_upd";	
	log_write("��� 2-1 ����� ��������!!!");
	exit();
}
$_SESSION['base_update'] = "";

$map = @parse_ini_file("../../../../backup/temp/upd_conf.txt",1);
if(empty($map)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:5 - �� ������ �������� ������ ������� ����������</span>";
	log_write("�� ������ �������� ������ ������� ����������");
	exit();
}



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

// ������ ����� ������
//$name = "../../../../backup/backups/".date("Y-m-d--h-i-s");	
	$name = "/backup/backups/".date("Y-m-d--h-i-s");		
	ftp_mkdir($ftp_stream,$SysValue['user_ftp']['dir']."$name");
	ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['chmod']." ".$SysValue['user_ftp']['dir']."$name");	
	ftp_mkdir($ftp_stream,$SysValue['user_ftp']['dir']."/$name/sql");
	ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['chmod']." ".$SysValue['user_ftp']['dir']."$name/sql");
	
	//mkdir($name,0777);
	//mkdir($name."/sql",0777);
	
	
// ������� ���� �������� ����� �����������...
$sql = "TRUNCATE TABLE  ".$SysValue['base']['table_name46'];
mysql_query($sql);

$errors = "";
foreach ($map as $k=>$v) {
	$errors .= upload_folder_create($k,$name,$ftp_stream);
		
	if (isset($map[$k]['files'])){
		$tt = str_replace(" ","",$map[$k]['files']);
		if($tt!=""){			
			$tt = explode(";",$tt);
			foreach ($tt as $ttt => $t){
				$sql = "INSERT INTO ".$SysValue['base']['table_name46']." SET dir='".$k."', name = '".$t."' ";
				mysql_query($sql);
			}
		}
	}
	
}


if ($errors != ""){
	$GLOBALS['_RESULT']['stat'] = $errors;	
	exit();
}


	if (!file_exists("../../../../backup/temp/upload_backup.sql.gz")){
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">�� ������ backup ���� ������! ��������� ��������� ����������� ���� ������! </span>";
		log_write("�� ������ backup ���� ������! ��������� ��������� ����������� ���� ������! ");
		exit();
	}
	if (!copy("../../../../backup/temp/upload_backup.sql.gz","../../../..$name/sql/upload_backup.sql.gz")) {
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">�� ������ ����������� phpshop/admpanel/dumper/backup/upload_backup.sql</span>";
		log_write("�� ������ ����������� phpshop/admpanel/dumper/backup/upload_backup.sql");
		exit();		
	}
	if (!unlink("../../../../backup/temp/upload_backup.sql.gz")){
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">�� ������ ������� /backup/temp/upload_backup.sql.gz</span>";
		log_write("�� ������ ������� /backup/temp/upload_backup.sql.gz");
		exit();
	}
	

$temp =  " �������� ����� ���������� ���������<br> �������������� ����� ������ �������";
log_write("�������� ����� ���������� ���������, �������������� ����� ������ �������");

$GLOBALS['_RESULT'] = array(
'stat' => $temp,
'susses' => "gobackup",
'folder' => "../../../..".$name
);


function upload_folder_create($str,$name,$ftp_stream){
	global $SysValue;
	$temp = "";
	$str = explode("/",$str);	
	for ($i=0;$i<count($str);$i++){
		$folder = $str[0];
		for ($c=1;$c<=$i;$c++) $folder .= "/".$str[$c];
		
		//  ������ ������ � ����� ������
		
		if (!ftp_mkdir($ftp_stream,$SysValue['user_ftp']['dir']."$name/$folder")) {
			$temp .= "<span style=\"color:red\">$folder - ���������� ������� ����� � ����� ������.</span><br><br>";
			log_write("$folder - ���������� ������� ����� � ����� ������.");
		}
		
		if (!ftp_site($ftp_stream,"CHMOD ".$SysValue['user_ftp']['chmod']." ".$SysValue['user_ftp']['dir']."$name/$folder")) {
			$temp .= "<span style=\"color:red\">$folder - ���������� ���������� ����� �� ����� � ����� ������.</span><br><br>";
			log_write("$folder - ���������� ���������� ����� �� ����� � ����� ������.");
		}
		
		
		// ���� ����� ��������� � ����� ��� � ������� - ������ ��.
		//if (!is_dir("../../../../$folder")) {
		//	if (!mkdir("../../../../$folder",0777)) {
		//		$temp .= "<span style=\"color:red\">$folder - ���������� ������� ����� � �������. ��������� ��� �� ��������� ���������� ����� ������� �� �����!</span><br><br>";
		//		log_write("$folder - ���������� ������� ����� � �������. ��������� ��� �� ��������� ���������� ����� ������� �� �����!");
		//	}
		//}
		
	}

}

?>