<?php
/**
 * ���������� ������ ������ ����� Robox
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

$_classPath = "../../phpshop/";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("system");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopSystem = new PHPShopSystem();


if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

define('USERNAME', urlencode($SysValue['alfabank']['alf_login']));
define('PASSWORD', $SysValue['alfabank']['alf_pass']);
define('GATEWAY_URL', $SysValue['alfabank']['alf_gateway_url']);
define('RETURN_URL', $SysValue['alfabank']['alf_return_url']);


function gateway($method, $data) {
  $curl = curl_init(); // �������������� ������
  curl_setopt_array($curl, array(
        CURLOPT_URL => GATEWAY_URL.$method, // ������ ����� ������
        CURLOPT_RETURNTRANSFER => true, // ���������� �����
        CURLOPT_POST => true, // ����� POST
        CURLOPT_POSTFIELDS => http_build_query($data) // ������ � �������
  ));
  $response = curl_exec($curl); // ����������� ������
  $response = json_decode($response, true); // ���������� �� JSON � ������
  curl_close($curl); // ��������� ����������
  return $response; // ���������� �����
}


//if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
$data = array(
'userName' => USERNAME,
'password' => PASSWORD,
'orderNumber' => urlencode($_POST['orderNumber']),
'amount' => urlencode($_POST['amount']),
'returnUrl' => RETURN_URL
);


/**
* ������ ����������� �������������� ������� � ��������� �����
* register.do
*
* ���������
* userName ����� ��������.
* password ������ ��������.
* orderNumber ���������� ������������� ������ � ��������.
* amount ����� ������ � ��������.
* returnUrl �����, �� ������� ���� ������������� ������������ � ������ �������� ������.
*
* �����
* � ������ ������:
* errorCode ��� ������. ������ ��������� �������� �������� � ������� ����.
* errorMessage �������� ������.
*
* � ������ �������� �����������:
* orderId ����� ������ � ��������� �������. �������� � �������� �������.
* formUrl URL ��������� �����, �� ������� ���� ������������� ������� �������.
*
* ��� ������ ��������
* 0 ��������� ������� ������ ��� ��������� ������.
* 1 ����� � ����� ������� ��� ��������������� � �������.
* 3 ����������� (�����������) ������.
* 4 ����������� ������������ �������� �������.
* 5 ������ �������� ��������� �������.
* 7 ��������� ������.
*/

//$data =  json_encode($data);

    $response = gateway('register.do', $data); 
/**
* ������ ����������� �������������� ������� � ��������� �����
* registerPreAuth.do
*
* ��������� � ����� ����� ����� ��, ��� � � ���������� ������.
* ���������� �������� ���� register.do, ���� registerPreAuth.do.
*/
// $response = gateway('registerPreAuth.do', $data);

    if (isset($response['errorCode'])) { // � ������ ������ ������� ��
      echo '������ #' . $response['errorCode'] . ': ' . $response['errorMessage'];
    } else { // � ������ ������ ������������� ������������ �� �������� �����
      header('Location: ' . $response['formUrl']);
      die();
    }
	
	
//} 
exit();
?>