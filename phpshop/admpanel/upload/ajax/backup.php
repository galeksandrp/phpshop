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


$dir = $_REQUEST['dir'];
chmod("$dir",0777);

$backup_code = time();

$sql = "select * from ".$SysValue['base']['table_name46']." WHERE backup = '0' LIMIT 1";
$result = mysql_query($sql);
if(mysql_num_rows($result) > 0){
	$row = mysql_fetch_array($result);
	if (file_exists("../../../../".$row['dir']."/".$row['name'])){
		$backup_flag = ",backup_flag = '1'";
		if (!copy("../../../../".$row['dir']."/".$row['name'],"$dir/$row[dir]/$row[name]"))$flag = 1;		
		if ($flag){
			$GLOBALS['_RESULT']['stat']=  "<span style=\"color:red\">������ �����������: $row[dir]/$row[name] </span>";	
			log_write("������ �����������: $row[dir]/$row[name]");
		}
		else{
			$GLOBALS['_RESULT']['stat']=  "���������� � ������: $row[dir]/$row[name] ";	
			log_write("���������� � ������: $row[dir]/$row[name]");
		}
	}
	else {
		$GLOBALS['_RESULT']['stat'] = "<span style=\"color:red\">���� � ������� �����������: $row[dir]/$row[name] </span>";
		log_write("���� � ������� �����������: $row[dir]/$row[name]");
	}
	

	$sql = "UPDATE ".$SysValue['base']['table_name46']." SET backup = '1' $backup_flag WHERE id = $row[id]";
	mysql_query($sql);

	

	$GLOBALS['_RESULT']['susses']=  "backup";
}
else{
	// ������ ������ � ������
	$sql = "INSERT INTO ".$SysValue['base']['table_name47']." SET folder='".mysql_real_escape_string($dir)."', date = ".time();
	mysql_query($sql);
	// �������� ������ � ����� ������
	copy("../../../../backup/temp/upd_conf.txt","$dir/upd_conf.txt");
	//	if (!unlink("../../../../backup/temp/upd_conf.txt","$dir/upd_conf.txt")){
	//	$GLOBALS['_RESULT']['stat'] = "�� ������ ������� /backup/temp/upd_conf.txt";
	//	exit();
	//}
	// ��������������� ���� �����
	chmod("$dir",0775);
	
	$GLOBALS['_RESULT']['stat']=  " �������������� ��������� �������";	
	$GLOBALS['_RESULT']['susses']=  "copy";	
	log_write("�������������� ��������� �������");
		
}




?>