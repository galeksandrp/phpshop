<?php

/**
 * ���������� ������ ������ ����� Robox
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */
$_classPath = "../../phpshop/";
include($_classPath . "class/obj.class.php");

if (empty($GLOBALS['SysValue']))
    exit(header("Location: /"));

define('USERNAME', $SysValue['alfabank']['alf_login']);
define('PASSWORD', $SysValue['alfabank']['alf_pass']);
define('GATEWAY_URL', $SysValue['alfabank']['alf_gateway_url']);
define('RETURN_URL', $SysValue['alfabank']['alf_return_url']);

function gateway($method, $data) {
    $curl = curl_init(); // �������������� ������
    curl_setopt_array($curl, array(
        CURLOPT_URL => GATEWAY_URL . $method, // ������ ����� ������
        CURLOPT_RETURNTRANSFER => true, // ���������� �����
        CURLOPT_POST => true, // ����� POST
        CURLOPT_POSTFIELDS => http_build_query($data) // ������ � �������
    ));
    $response = curl_exec($curl); // ����������� ������
    $response = json_decode($response, true); // ���������� �� JSON � ������

    curl_close($curl); // ��������� ����������
    return $response; // ���������� �����
}

if (empty($GLOBALS['SysValue']))
    exit(header("Location: /"));

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['orderId'])) {


    $data = array(
        'userName' => USERNAME,
        'password' => PASSWORD,
        'orderId' => $_GET['orderId']
    );

    $response = gateway('getOrderStatus.do', $data);



    if ($response['ErrorCode'] == 0 and $response['OrderStatus'] == 2) {
        $order_metod = "Alfabank";
        $success_function = true; // �������� ������� ���������� ������� ������
        $crc = $_GET['orderId'];
        $my_crc = $_GET['orderId'];
        $inv_id = preg_replace("/[^0-9]/", '', $response['OrderNumber']);
        $out_summ = substr($response['Amount'], 0, -2);
    }
}
?>
