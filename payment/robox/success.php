<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Success Function ROBOXchange       |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

if(isset($_GET['crc'])){
$order_metod="Robox";
$success_function=true; // �������� ������� ���������� ������� ������
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
$mrh_pass2 = $SysValue['roboxchange']['mrh_pass2'];    // ������2
$crc = strtoupper($_GET['crc']); 
$my_crc = strtoupper(md5("$_GET[out_summ]:$_GET[inv_id]:$mrh_pass2"));
$inv_id = $_GET['inv_id'];
$out_summ = $_GET['out_summ'];
}
?>
