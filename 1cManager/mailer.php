<?
/*
+-------------------------------------+
|  PHPShop Enterprise Pro 1C          |
|  ������ ���������                   |
+-------------------------------------+
*/

PHPShopObj::loadClass("mail");


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
$uid=$row['uid'];

$zag="�������������� ��������� �� ������ �".$row['uid'];
$from="robot@".str_replace("www.","",$_SERVER['SERVER_NAME']);
$content="
������� �������!
--------------------------------------------------------

���������(��) ������������ ".$name.", �� ������ �".$uid." ����� �������� 
�������������� ��������� � ������ ��������.";

if($row['user']==1){
$content.="

�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� ����� '������ �������' ��� �� ������ http://".$_SERVER['SERVER_NAME'].$GLOBALS['SysValue']['dir']['dir']."/users/";
}
else {
$content.="
�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� �� ������ http://".$_SERVER['SERVER_NAME'].$GLOBALS['SysValue']['dir']['dir']."/clients/?mail=".@$mail."&order=".$uid."
E-mail: ".$mail."
� ������: ".$uid;
}

$content.="

����: ".date("d-m-y H:s a")."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$GLOBALS['SysValue']['license']['product_name'];

$PHPShopMail = new PHPShopMail($mail,$from,$zag,$content);
}
?>
