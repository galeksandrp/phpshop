<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ OrderFunction ���� � ����   |
+-------------------------------------+
*/


if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

$sql="select message,message_header  from ".$SysValue['base']['table_name48']." where id=".$_POST['order_metod'];
$result=mysql_query(@$sql);
$row = mysql_fetch_array(@$result);

$message=$row['message'];
$message_header=$row['message_header'];
   
   
// ���������� ���������
$SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$message_header."</B></FONT><BR>".$message;
   
// ���������� ������
@$disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);

// ���� �������� ���. �������� ����������, ������� ��������� �����
if($LoadItems['System']['1c_load_accounts']!=1){
   @$disp.="
<script language=\"JavaScript1.2\">
//miniWinFull('phpshop/forms/1/forma.php?name_person=".$_POST['name_person']."&org_name=".$_POST['org_name']."&ouid=".$_POST['ouid']."&delivery=".$_POST['dostavka_metod']."',650,600);
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
session_unregister('cart');
     }else {
	 @$disp.="
<script language=\"JavaScript1.2\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>";
     session_unregister('cart');
     }


?>