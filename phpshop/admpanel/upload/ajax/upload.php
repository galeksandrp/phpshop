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
log_clear();
/////////////////////////////////////////////////////////////////


// ��������� �����
if(!CheckedRules($UserStatus["upload"],0) == 1) {
	$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������������ ����</span>";	
	$GLOBALS['_RESULT']['susses']=  "error";	
	log_write("������������ ����");
	exit();
}	
			//$upload_type = "script";
     		$ftp_host = $_REQUEST['ftp_host'];
     		$ftp_login = $_REQUEST['ftp_login'];
     		$ftp_password = $_REQUEST['ftp_password'];
     		$ftp_folder = $_REQUEST['ftp_folder'];
			

// ��������� ������ �� ���� ����
	if (!file_exists("../../dumper/backup/upload_dump.sql.gz")){
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">�� ������ backup ���� ������! ��������� ��������� ����������� ���� ������!</span><br>==============<br>";
		$GLOBALS['_RESULT']['susses']=  "error_reload";	
		log_write("�� ������ backup ���� ������! ��������� ��������� ����������� ���� ������!");
		exit();
	}


if (!$ftp_stream = ftp_connect($ftp_host)) {
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:1 - �� ������ ��������� � ��������</span>";
	log_write("�� ������ ��������� � ��������");
	exit();
}

if (!ftp_login($ftp_stream,$ftp_login,$ftp_password)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:2 - ������ �����������</span>";
	log_write("������ �����������");
	exit();
}

if (!ftp_pasv($ftp_stream,true)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���������� ���������� ��������� �����</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("���������� ���������� ��������� �����");
	exit();
}

if (!ftp_chdir($ftp_stream,$ftp_folder)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:4 - �� ������ ����� ��������� ������ ����������</span>";
	log_write("�� ������ ����� ��������� ������ ����������");
	exit();
}


if (!ftp_get($ftp_stream,'../../../../backup/temp/upd_conf.txt','upd_conf.txt',FTP_BINARY)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:3 - ������ �������� ����� ������������ ����������</span>";
	log_write("������ �������� ����� ������������ ����������");
	exit();
	}
	
if (ftp_get($ftp_stream,'../../../../backup/temp/base_update.sql.gz','base_update.sql.gz',FTP_BINARY)){
	 $temp = "�������� ���� ���������� ���� ������...";
	 log_write("�������� ���� ���������� ���� ������...");
	}
	

// ��������� ������, ���� ������� config_update.txt
if (ftp_get($ftp_stream,'../../../../backup/temp/config_update.txt','config_update.txt',FTP_BINARY)){
	 $temp .= "<br>�������� ���� ���������� config.ini ...";
	 log_write("�������� ���� ���������� config.ini");
	 /*
	 if (!$ftp_stream = ftp_connect($SysValue['user_ftp']['host'])){
		$GLOBALS['_RESULT']['stat'] = "�� ������ ��������� � ����� FTP ��������";
		$GLOBALS['_RESULT']['susses']=  "connect_error";
		exit();
	}
	
	if (!ftp_login($ftp_stream,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
		$GLOBALS['_RESULT']['stat'] = "������ ����������� �� ����� FTP �������";
		$GLOBALS['_RESULT']['susses']=  "connect_error";
		exit();
	}
	
	if (!ftp_pasv($ftp_stream,true)){
		$GLOBALS['_RESULT']['stat'] = "���������� ���������� ��������� ����� �� ����� FTP �������";
		$GLOBALS['_RESULT']['susses']=  "connect_error";
		exit();
	}
	*/

	}

	


$temp =  " $temp  �������� ����� ������������ ���������� ��������! ";
log_write("�������� ����� ������������ ���������� ��������!");
$GLOBALS['_RESULT'] = array(
'stat' => $temp,
'susses' => "susses",
);


?>