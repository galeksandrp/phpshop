<?php

if (!$ftp_stream_user = ftp_connect($SysValue['user_ftp']['host'])) {
	$GLOBALS['_RESULT']['stat'] = "�� ������ ��������� � �������� ��� ������������!";
	exit();
}

if (!ftp_login($ftp_stream_user,$SysValue['user_ftp']['login'],$SysValue['user_ftp']['password'])){
	$GLOBALS['_RESULT']['stat'] = "������ ����������� � ��� ������������!";
	exit();
}

function user_ftp_chmod($ftp, $dir){
	global $SysValue;
	if(!ftp_chmod($ftp, $SysValue['user_ftp']['chmod'], $SysValue['user_ftp']['dir']."/".$dir)){
		$GLOBALS['_RESULT']['stat'] = "�� ������ ��������� ����� ������� �� ����� $dir";
		exit();
	}
	
}
?>