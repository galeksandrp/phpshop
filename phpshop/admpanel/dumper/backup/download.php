<?
if(isset($backup)){
require("../../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../../enter_to_admin.php");
header('Content-Type: application/force-download'); 
header('Content-Disposition: attachment; filename="'.$backup.'"'); 
header('Content-Length: '.filesize($backup));
readfile($backup); 
}
else header("Location ./");
?>
