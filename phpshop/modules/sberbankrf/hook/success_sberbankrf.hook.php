<?php

include_once dirname(__DIR__) . '/class/Sberbank.php';

/**
 * ������� ���, ��������� ���������� ���������� �������
 * @param object $obj ������ �������
 * @param array $value ������ � ������
 */
function success_mod_sberbankrf_hook($obj, $value) {
    if (isset($_REQUEST['uid'])) {

        // ����� ������
        if(strstr($_REQUEST['uid'], "#")){
            $orderArray = explode ("#", $_REQUEST['uid']);
            $orderNum = $orderArray[0];
        }
        else  $orderNum = $_REQUEST['uid'];

        // �������� ������ ������ � ����� ��� ������
        $status = sberbankrf_check($obj, $orderNum, $_REQUEST['orderId']);

        if($status == 2){
            $obj->order_metod = 'modules" and id="10010';

            $mrh_ouid = explode("-", $orderNum);
            $obj->inv_id = $mrh_ouid[0] . $mrh_ouid[1];

            $obj->ofd();

            $obj->message();

            return true;
        } else
            $obj->error();
    }
}

/**
 * ������� �������� ������� ������� � ������� �������� ������
 * @param object $obj ������ �������
 * @param string $id ����� ������
 */
function sberbankrf_check($obj, $id, $merchant_order_id){

    $PHPShopOrm = new PHPShopOrm();
    $Sberbank = new Sberbank();

    // �������� �������
    $params = array(
        "orderId" => $merchant_order_id,
        "userName" => $Sberbank->options["login"],
        "password" => $Sberbank->options["password"],
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Sberbank->getApiUrl() . 'getOrderStatus.do' . "?" . http_build_query($params));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    $r = json_decode(curl_exec($ch), true); // run the whole process
    curl_close($ch);

    // ������ �������
    if($r['ErrorCode'] != 0) {
        $r['errorMessage'] = PHPShopString::utf8_win1251($r['errorMessage']);
        $Sberbank->log($r, $id, '������ ���������� �������', '������ ��������� ������');

        return $r['OrderStatus'];

        // ������ ���������� �������
    }elseif($r['OrderStatus'] != 2){

        $code_description = PHPShopString::utf8_win1251($r['actionCodeDescription']);
        $Sberbank->log($r, $id, $code_description, '������ ��������� ������');

        return $r['OrderStatus'];
    }else{
        $order_status = $obj->set_order_status_101();
        $PHPShopOrm->query("UPDATE `phpshop_orders` SET `statusi`='$order_status', `paid` = 1 WHERE `uid`='$id'");

        $Sberbank->log($r, $id, '������ ��������', '������ ��������� ������');

        return $r['OrderStatus'];
    }

}
$addHandler = array('index' => 'success_mod_sberbankrf_hook');
?>