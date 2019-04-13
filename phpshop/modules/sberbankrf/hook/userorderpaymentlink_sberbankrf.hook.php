<?php
/**
 * ������� ���, ����� ������ ������ � �� � ����������� ����������� ������ � ��������� ����� ��������� ���������� ���������
 * @param object $obj ������ �������
 * @param array $PHPShopOrderFunction ������ � ������
 */
function userorderpaymentlink_mod_sberbankrf_hook($obj, $PHPShopOrderFunction) {
    global $PHPShopSystem;

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');
    $PHPShopSberbankRFArray = new PHPShopSberbankRFArray();
    $option = $PHPShopSberbankRFArray->getArray();

    // ������
    if($_REQUEST["paynow"] == "Y"){

        // ����� ������
        $uid = $PHPShopOrderFunction->objRow['uid'];

        // �������
        $order_pref = sberbank_log_check($uid);

        // ���
        if ($PHPShopSystem->getParam('nds_enabled') == 1){
            if ($PHPShopSystem->getParam('nds') == 0)
                $tax = 1;
            elseif ($PHPShopSystem->getParam('nds') == 10)
                $tax = 2;
            elseif ($PHPShopSystem->getParam('nds') == 18)
                $tax = 3;
            elseif ($PHPShopSystem->getParam('nds') == 20)
                $tax = 6;
        } else
            $tax = 0;

        $orderNum = $uid;

        if (!empty($order_pref))
            $orderNum = $uid . '#' . $order_pref;

        $order = $PHPShopOrderFunction->unserializeParam('orders');

        // ���������� �������
        $i = 0;
        $total = 0;
        foreach ($order['Cart']['cart'] as $key => $arItem) {

            // ������
            if ($order['Person']['discount'] > 0)
                $price = ($arItem['price'] - ($arItem['price'] * $order['Person']['discount'] / 100)) * 100;
            else
                $price = $arItem['price'] * 100;

            $price = round($price);
            $amount = $price * (int) $arItem['num'];

            $aItem[] = array(
                "positionId"     => $i,
                "name"           => PHPShopString::win_utf8($arItem['name']),
                "itemPrice"      => $price,
                "quantity"       => array ("value" => $arItem['num'], "measure" => PHPShopString::win_utf8($arItem['ed_izm'])),
                "itemAmount"     => $amount,
                "itemCode"       => $arItem['id'],
                "tax"            => array("taxType" => $tax),
                "itemAttributes" => array(
                    "attributes" => array(
                        array(
                            "name"  => "paymentMethod",
                            "value" => 1
                        ),
                        array(
                            "name"  => "paymentObject",
                            "value" => 1
                        )
                    )
                )
            );
            $i++;
            $total = $total + $amount;
        }

        // ��������
        if (!empty($order['Cart']['dostavka'])) {

            PHPShopObj::loadClass('delivery');
            $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);

            switch ($PHPShopDelivery->getParam('ofd_nds')) {
                case 0:
                    $tax_delivery = 1;
                    break;
                case 10:
                    $tax_delivery = 2;
                    break;
                case 18:
                    $tax_delivery = 3;
                    break;
                case 20:
                    $tax_delivery = 6;
                    break;
                default: $tax_delivery = $tax;
            }

            $delivery_price = (int) $order['Cart']['dostavka'] * 100;

            $aItem[] = array(
                "positionId"     => $i + 1,
                "name"           => PHPShopString::win_utf8('��������'),
                "itemPrice"      => $delivery_price,
                "quantity"       => array ("value" => 1, "measure" => PHPShopString::win_utf8('��.')),
                "itemAmount"     => $delivery_price,
                "itemCode"       => $i + 1,
                "tax"            => array("taxType" => $tax_delivery),
                "itemAttributes" => array(
                    "attributes" => array(
                        array(
                            "name"  => "paymentMethod",
                            "value" => 1
                        ),
                        array(
                            "name"  => "paymentObject",
                            "value" => 4
                        )
                    )
                )
            );
            $total = $total + $delivery_price;
        }

        $array = array(
            "customerDetails" => array("email" => $_POST["mail"]),
            "cartItems" => array("items" => $aItem));

        $orderBundle = json_encode($array);

        // ����������� ������ � ��������� �����
        $params = array(
            "userName" => $option["login"],
            "password" => $option["password"],
            "orderNumber" => $orderNum,
            "amount" => $total,
            "returnUrl" => 'http://' . $_SERVER['HTTP_HOST'] . '/success/?uid=' . $uid,
            "failUrl"   => 'http://' . $_SERVER['HTTP_HOST'] . '/success/?uid=' . $uid,
            "orderBundle" => $orderBundle,
            "taxSystem" => intval($option["taxationSystem"])
        );
       
        // ����� ���������� � ������ �����
        if($option["dev_mode"] == 1)
            $url ='https://3dsec.sberbank.ru/payment/rest/register.do';
        else
            $url ='https://securepayments.sberbank.ru/payment/rest/register.do';

        $rbsCurl = curl_init();
        curl_setopt_array($rbsCurl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params, '', '&')
        ));

        $result =json_decode(curl_exec($rbsCurl), true);

        curl_close($rbsCurl);

        // ������ ����
        if(isset($result["formUrl"]))
            $PHPShopSberbankRFArray->log($result, $uid, '����� ���������������', 'register');
        else {
            $result['errorMessage'] = PHPShopString::utf8_win1251($result['errorMessage']);
            $PHPShopSberbankRFArray->log($result, $uid, '������ ����������� ������', 'register');
        }

        header('Location: '. $result["formUrl"]);
    }

    // �������� ������ �� ������� ������
    if ($PHPShopOrderFunction->order_metod_id == 10010)

        if ($PHPShopOrderFunction->getParam('statusi') == $option['status'] or empty($option['status'])) {

            $order_uid = $PHPShopOrderFunction->objRow['uid'];

            $return = PHPShopText::a("/users/order.html?order_info=$order_uid&paynow=Y#Order", '�������� ������', '�������� ������', false, false, '_blank', 'btn btn-success pull-right');
        } elseif ($PHPShopOrderFunction->getSerilizeParam('orders.Person.order_metod') == 10010)
            $return = ', ����� �������������� ����������';

    return $return;
}

/**
 * ����� ������� �������� ������
 * @param string $order_id
 * @return int
 */
function sberbank_log_check($order_id) {
    $PHPShopOrm = new PHPShopOrm("phpshop_modules_sberbankrf_log");
    $result = $PHPShopOrm->select(array('id'), array('order_id' => '="' . $order_id . '"', 'type' => '="register"'), array('order' => 'id desc'), array('limit' => 1));
    if (is_array($result))
        return $result['id']++;
}

$addHandler = array('userorderpaymentlink' => 'userorderpaymentlink_mod_sberbankrf_hook');
?>