<?
/*
+-------------------------------------+
|  PHPShop Enterprise Pro 1C          |
|  ������ ���������                   |
+-------------------------------------+
*/


// ����� ������ ��� ����-�������
function GetNumOrders($cid){
$sql="select uid from ".$GLOBALS['SysValue']['base']['table_name9']." where cid='$cid'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
return $row['uid'];
}


// ��������� ������������
function SendMailUser($id,$flag="accounts"){

// ����-�������
if($cid=="invoice") $id = GetNumOrders($id);

$sql="select * from ".$GLOBALS['SysValue']['base']['table_name1']." where id=$id";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$order=unserialize($row['orders']);
$mail=$order['Person']['mail'];
$name=$order['Person']['name_person'];

$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <donotreply@".str_replace("www.","",$_SERVER['SERVER_NAME']).">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm="�������������� ��������� �� ������ �".$row['uid'];
$content="
������� �������!
--------------------------------------------------------

���������(��) ������������ ".$name.", �� ������ �".$row['uid']." ����� �������� 
�������������� ��������� � ������ ��������.";

if($row['user']>0)
$content.="

�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� ����� '������ �������' ��� �� ������ http://".$_SERVER['SERVER_NAME'].$GLOBALS['SysValue']['dir']['dir']."/users/";

else $content.="
�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� �� ������ http://".$_SERVER['SERVER_NAME'].$GLOBALS['SysValue']['dir']['dir']."/clients/?mail=".@$mail."&order=".@$uid."
E-mail: ".@$mail."
� ������: ".@$uid;


$content.="

����: ".date("d-m-y H:s a")."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$GLOBALS['SysValue']['license']['product_name'];
mail($mail,$zag_adm, $content, $header_adm);
}
?>
