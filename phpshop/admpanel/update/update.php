<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");


// ����� �����
function GetFile($dir){
global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "lic")
		  return $SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
}

// ���� �������� ���. ���������
$GetFile=GetFile("../../../license/");
@$License=parse_ini_file("../../../".$GetFile,1);
$SupportExpires=$License['License']['SupportExpires'];
$date=date("U");
if($SupportExpires>$date){
$LoadsName=$SysValue['update']['path']."/download.php";
header("Location: ".$LoadsName);
exit();
}
else{header("Location: http://www.phpshop.ru?error=expires&date=".dataV($SupportExpires,"update")."&server=".$SERVER_NAME);
exit();
}
?>