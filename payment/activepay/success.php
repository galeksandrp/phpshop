<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  Success Function Activepay         |
+-------------------------------------+
*/

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));





if(isset($_GET['merchant_data'])){
$order_metod="Activepay";
$success_function=true; // �������� ������� ���������� ������� ������

// ��������������� ����������
$secret_key=$SysValue['activepay']['secret_key'];
$merchant_contract=$SysValue['activepay']['merchant_contract'];
$merchant_data=explode("-",$_GET['merchant_data']);

// ����� ������
$inv_id = $merchant_data[0];

// ����� ������
$out_summ = $merchant_data[1];


// ���������� � ���������
include_once("payment/activepay/lib.php");

$crc = $_GET["signature"];

// �������
$my_crc=sign("GET", $_SERVER['SERVER_NAME'], "/success/", $secret_key,array(
        "result" => "success",
        "merchant_data" => $_GET['merchant_data'],
        "payment_id" => $_GET['payment_id'],
));

}
?>