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
	$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������������ ����</span>";	
	$GLOBALS['_RESULT']['susses']=  "error";	
	log_write("������������ ����");
	exit();
}	


////////////���������� � ��� ������������ /////////////////////////
if (!$ftp_stream_user = ftp_connect($SysValue['user_ftp']['host'])) {
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������");
	exit();
}

if (!ftp_login($ftp_stream_user,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">������ ����������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("upload_modul_error:2 - ������ ����������� � �������� ������������");
	exit();
}

if (!ftp_pasv($ftp_stream_user,true)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���������� ���������� ��������� �����</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error_user";
	log_write("���������� ���������� ��������� �����");
	exit();
}
/////////////////////////////////////////////////////

// ��������� �������� ����� ������
$sql = "SELECT  folder FROM ".$SysValue['base']['table_name47']." WHERE date = (SELECT MAX(date) FROM ".$SysValue['base']['table_name47'].")";
$row = mysql_fetch_array(mysql_query($sql));
$folder = $row['folder'];

$sql = "select * from ".$SysValue['base']['table_name46']." WHERE backup_flag = '2' LIMIT 1";
$result = mysql_query($sql);
if(mysql_num_rows($result) > 0){
	$row = mysql_fetch_array($result);


		//if (!copy("$folder/$row[dir]/$row[name]","../../../../".$row['dir']."/".$row['name']))$flag = 1;		
		if (!ftp_put($ftp_stream_user,$SysValue['user_ftp']['dir']."/$row[dir]/$row[name]","$folder/$row[dir]/$row[name]",FTP_BINARY))$flag = 1;		
		if ($flag){
			$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������ �����������: $row[dir]/$row[name]</span>";	
			log_write("������ �����������: $row[dir]/$row[name]");
		}
		else{
			$GLOBALS['_RESULT']['stat']=  "������������: $row[dir]/$row[name]";	
			log_write("������������: $row[dir]/$row[name]");
		}
	

	$sql = "UPDATE ".$SysValue['base']['table_name46']." SET backup_flag = '3' WHERE id = $row[id]";
	mysql_query($sql);

	

	$GLOBALS['_RESULT']['susses']=  "backup_backup";
}
else{

	$GLOBALS['_RESULT']['stat']=  " ����������� ������ ���������";	
	$GLOBALS['_RESULT']['susses']=  "clear_backup";	
	log_write("�������������� ������ ���������");
		
}




?>