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

$map1 = @parse_ini_file("../../../../backup/upd_black_list.txt",1);



			//$upload_type = "script";
     		$ftp_host = $_REQUEST['ftp_host'];
     		$ftp_login = $_REQUEST['ftp_login'];
     		$ftp_password = $_REQUEST['ftp_password'];
     		$ftp_folder = $_REQUEST['ftp_folder'];
			



////// ���������� � ��� ������� /////////////////////////////////////////
if (!$ftp_stream = ftp_connect($ftp_host)) {
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:1 - �� ������ ��������� � ��������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("upload_modul_error:1 - �� ������ ��������� � ��������");
	exit();
}

if (!ftp_login($ftp_stream,$ftp_login,$ftp_password)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:2 - ������ �����������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("upload_modul_error:2 - ������ �����������");
	exit();
}

if (!ftp_pasv($ftp_stream,true)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���������� ���������� ��������� �����</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("���������� ���������� ��������� �����");
	exit();
}
////////////////////////////////////////////


////////////���������� � ��� ������������ /////////////////////////
if (!$ftp_stream_user = ftp_connect($SysValue['user_ftp']['host'])) {
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("upload_modul_error:1 - �� ������ ������� ��� ���������� � �������� ������������");
	exit();
}

if (!ftp_login($ftp_stream_user,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">������ ����������� � �������� ������������</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("upload_modul_error:2 - ������ ����������� � �������� ������������");
	exit();
}

if (!ftp_pasv($ftp_stream_user,true)){
	$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���������� ���������� ��������� �����</span>";
	$GLOBALS['_RESULT']['susses']=  "connect_error";
	log_write("���������� ���������� ��������� �����");
	exit();
}
/////////////////////////////////////////////////////




$sql = "select * from ".$SysValue['base']['table_name46']." WHERE backup = '1' and backup_flag != '2' LIMIT 1";
$result = mysql_query($sql);
if(mysql_num_rows($result) > 0){
	$row = mysql_fetch_array($result);

	//��������� ����������� config.ini
	if($row[name] != "config.ini"){
	@chmod("../../../../".$row['dir'],0777);
	if (!ftp_chdir($ftp_stream,$ftp_folder."/update/".$row['dir'])){
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:7 - ������������ ����� $row[dir] �� �������<br>������ ����� ����������, ���������� � ������������.</span><br><br>";
		$GLOBALS['_RESULT']['susses']=  "folder_error";
		log_write("������������ ����� $row[dir] �� �������. ������ ����� ����������, ���������� � ������������.");
		@chmod("../../../../".$row['dir'],0755);
	exit();
	}
	
	
	if (!empty($map1) && (stristr( $map1[$row['dir']]['files'],$row[name]) != false)) {
		
		//if ($row['backup_flag'] == 0)
			$sql = "DELETE FROM ".$SysValue['base']['table_name46']." WHERE id = $row[id]";
		//else
		//	$sql = "UPDATE ".$SysValue['base']['table_name46']." SET backup_flag = '2' WHERE id = $row[id]";
				
		mysql_query($sql);
			
		@chmod("../../../../".$row['dir'],0755);
	
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���� $row[dir]/$row[name] �������� ��� ���������� �������������...</span>";
		$GLOBALS['_RESULT']['susses']=  "copy";
		log_write("���� $row[dir]/$row[name] �������� ��� ���������� �������������...");
				
	}
	else {
		
		
		if (!ftp_get($ftp_stream,"../../../../backup/cache/$row[name]",$row['name'],FTP_BINARY)){
			
			$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">upload_modul_error:6 - ������ �������� ����� � �������. <br> ���� ���� �� ����������, <br>���� �� ����������� ����� 777 �� ����� backup/cache.<br>������ ����� ����������, ���������� � ������������.</span><br>";			
			$GLOBALS['_RESULT']['susses']=  "load_error";
			log_write("������ �������� ����� � �������. ���� ���� �� ����������, ���� �� ����������� ����� 777 �� ����� backup/cache, ���� ������ ����� ����������, ���������� � ������������.");
			@chmod("../../../../".$row['dir'],0755);
			exit();
		}
		else {
			
			if ($row['backup_flag'] == 0)
				$sql = "DELETE FROM ".$SysValue['base']['table_name46']." WHERE id = $row[id]";
			else
				$sql = "UPDATE ".$SysValue['base']['table_name46']." SET backup_flag = '2' WHERE id = $row[id]";
				
			mysql_query($sql);
			
			@chmod("../../../../".$row['dir'],0755);
		    
			if(!ftp_put($ftp_stream_user,$SysValue['user_ftp']['dir']."/$row[dir]/$row[name]","../../../../backup/cache/$row[name]",FTP_BINARY)){
				$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">������ ����������� ����� $row[name] � ����� $row[dir] �� ��������� �����!</span><br>";			
				$GLOBALS['_RESULT']['susses']=  "load_error";
				log_write("������ ����������� ����� $row[name] � ����� $row[dir] �� ��������� �����!");
				exit();
			}
			unlink("../../../../backup/cache/$row[name]");
			
			$GLOBALS['_RESULT']['stat'] = "���� ��������: $row[dir]/$row[name]";
			$GLOBALS['_RESULT']['susses']=  "copy";
			log_write("���� ��������: $row[dir]/$row[name]");
		}

	}
	
}
else{
	$sql = "UPDATE ".$SysValue['base']['table_name46']." SET backup_flag = '2' WHERE id = $row[id]";
	mysql_query($sql);
	@chmod("../../../../".$row['dir'],0755);
	$GLOBALS['_RESULT']['stat'] = "";
	$GLOBALS['_RESULT']['susses']=  "copy";
}
	
	

}
else{


	$GLOBALS['_RESULT']['stat']=  " ���������� ������ ���������!";	
	$GLOBALS['_RESULT']['susses']=  "continue";	
	log_write("���������� ������ ���������!");
		
}




?>