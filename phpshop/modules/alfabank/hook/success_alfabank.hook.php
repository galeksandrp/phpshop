<?php
/**
 * ������� ���, ��������� ���������� ���������� �������
 * @param object $obj ������ �������
 * @param array $value ������ � ������
 */
function success_mod_alfabank_hook($obj, $value) {

    if (isset($_REQUEST['uid'])) {

        // ����� ������
        if(strstr($_REQUEST['uid'], "#")){
            $orderArray = explode ("#", $_REQUEST['uid']);
            $orderNum = $orderArray[0];
        }
        else  $orderNum = $_REQUEST['uid'];

        // �������� ������ ������ � ����� ��� ������
        $status = alfabank_check($obj, $orderNum, $_REQUEST['orderId']);

        if($status == 2){
            $obj->order_metod = 'modules" and id="10021';

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
 * ������� �������� ������� ������� � ������� ��������� ������
 * @param object $obj ������ �������
 * @param string $id ����� ������
 */
function alfabank_check($obj, $id, $merchant_order_id){

    $PHPShopOrm = new PHPShopOrm();

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');
    $PHPShopAlfabankArray = new PHPShopAlfabankArray();
    $conf = $PHPShopAlfabankArray->getArray();

    // �������� �������
    $params = array(
        "orderId" => $merchant_order_id,
        "userName" => $conf["login"],
        "password" => $conf["password"],
    );

    // ����� ���������� � ������ �����
    if($conf["dev_mode"] == 1)
        $url ='https://web.rbsuat.com/ab/rest/getOrderStatusExtended.do';
    else
        $url ='https://pay.alfabank.ru/payment/rest/getOrderStatusExtended.do';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($params)); // set url to post to
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
    $r = json_decode(curl_exec($ch), true); // run the whole process
    curl_close($ch);

    // ������ �������
    if(isset($r['ErrorCode'])) {
        $r['errorMessage'] = PHPShopString::utf8_win1251($r['errorMessage']);
        $PHPShopAlfabankArray->log($r, $id, '������ ���������� �������', '������ ��������� ������');

        return $r['orderStatus'];

    // ������ ���������� �������
    }elseif($r['orderStatus'] != 2){

        $code_description = PHPShopString::utf8_win1251($r['actionCodeDescription']);
        $PHPShopAlfabankArray->log($r, $id, $code_description, '������ ��������� ������');

        return $r['orderStatus'];
    }else{
        $order_status = $obj->set_order_status_101();
        $PHPShopOrm->query("UPDATE `phpshop_orders` SET `statusi`='$order_status', `paid` = 1 WHERE `uid`='$id'");

        $PHPShopAlfabankArray->log($r, $id, '������ ��������', '������ ��������� ������');

        return $r['orderStatus'];
    }

}
$addHandler = array('index' => 'success_mod_alfabank_hook');
?>