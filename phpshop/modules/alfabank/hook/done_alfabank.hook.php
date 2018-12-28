<?php
/**
 * ������� ���, ����������� ������ � ��������� ����� ����������, ������������� �� ��������� �����
 * @param object $obj ������ �������
 * @param array $value ������ � ������
 * @param string $rout ����� ��������� ����
 */
function send_alfabank_hook($obj, $value, $rout) {

    if ($rout == 'MIDDLE' and $value['order_metod'] == 10021) {
        global $PHPShopSystem;
       
        // ��������� ������
        include_once(dirname(__FILE__) . '/mod_option.hook.php');

        $PHPShopAlfabankArray = new PHPShopAlfabankArray();
        $option = $PHPShopAlfabankArray->getArray();

        $aCart = $obj->PHPShopCart->getArray();

        // ���
        if ($PHPShopSystem->getParam('nds_enabled') == 1){
            if ($PHPShopSystem->getParam('nds') == 0)
                $tax = 1;
            elseif ($PHPShopSystem->getParam('nds') == 10)
                $tax = 2;
            elseif ($PHPShopSystem->getParam('nds') == 18)
                $tax = 3;
            elseif ($PHPShopSystem->getParam('nds') == 20)
                $tax = 3;
        } else
            $tax = 0;

        // �������� ������ �� ������� ������
        if (empty($option['status'])) {

            // ����� �������
            $out_summ = number_format($obj->get('total'), 2, '.', '') * 100;

            // ���������� �������
            $i = 0;
            foreach ($aCart as $key => $arItem) {
                // ������
                if($obj->discount > 0)
                    $price = ($arItem['price']  - ($arItem['price']  * $obj->discount  / 100)) * 100;
                else
                    $price = $arItem['price'] * 100;

                $amount = (floatval($price) * intval($arItem['num']));

                $aItem[] = array(
                    "positionId"    => $i,
                    "name"          => PHPShopString::win_utf8($arItem['name']),
                    "itemPrice"     => $price,
                    "quantity"      => array ("value" => $arItem['num'], "measure" => PHPShopString::win_utf8($arItem['ed_izm'])),
                    "itemAmount"    => $amount,
                    "itemCode"      => $arItem['id'],
                    "tax"           => array("taxType" => $tax),
                    "itemAttributes" => array(
                        "paymentMethod" => 1,
                        "paymentObject" => 1
                    )
                );
                $i++;
            }

            // ��������
            if ($obj->delivery > 0) {

                switch ($obj->PHPShopDelivery->getParam('ofd_nds')) {
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
                        $tax_delivery = 3;
                        break;
                    default: $tax_delivery = $tax;
                }

                $cartSum = $obj->PHPShopCart->getSum();

                $delivery_price = floatval($out_summ) - (floatval($cartSum) * 100);

                $aItem[] = array(
                    "positionId"     => $i + 1,
                    "name"           => PHPShopString::win_utf8('��������'),
                    "itemPrice"      => floatval($delivery_price),
                    "quantity"       => array ("value" => 1, "measure" => PHPShopString::win_utf8('��.')),
                    "itemAmount"     => floatval($delivery_price),
                    "itemCode"       => $i + 1,
                    "tax"            => array("taxType" => $tax_delivery),
                    "itemAttributes" => array(
                        "paymentMethod" => 1,
                        "paymentObject" => 4
                    )
                );

            }
            $array = array(
                "customerDetails" => array("email" => $_POST["mail"]),
                "cartItems" => array("items" => $aItem));

            $orderBundle = json_encode($array);

            // �������
            $order_pref = alfabank_log_check($value['ouid']);
            $orderNum = $value['ouid'];

            if (!empty($order_pref))
                $orderNum = $value['ouid'] . '#' . $order_pref;

            // ����������� ������ � ��������� �����
            $params = array(
                "userName"  => $option["login"],
                "password"  => $option["password"],
                "orderNumber" => $orderNum,
                "amount"    => $out_summ,
                "returnUrl" => 'http://' . $_SERVER['HTTP_HOST'] . '/success/?uid=' . $value['ouid'],
                "failUrl"   => 'http://' . $_SERVER['HTTP_HOST'] . '/success/?uid=' . $value['ouid'],
                "orderBundle" => $orderBundle,
                "taxSystem" => intval($option["taxationSystem"])
            );

            // ����� ���������� � ������ �����
            if($option["dev_mode"] == 0)
                $url ='https://pay.alfabank.ru/payment/rest/register.do';
            else
                $url ='https://web.rbsuat.com/ab/rest/register.do';

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
                $PHPShopAlfabankArray->log($result, $value['ouid'], '����� ���������������', 'register');
            else {
               $result['errorMessage'] = PHPShopString::utf8_win1251($result['errorMessage']);
               $PHPShopAlfabankArray->log($result, $value['ouid'], '������ ����������� ������', 'register');
            }

            header('Location: '. $result["formUrl"]);
        }else{

            $obj->set('mesageText', $option['title_sub'] );

            $forma = ParseTemplateReturn($GLOBALS['SysValue']['templates']['order_forma_mesage']);

            $obj->set('orderMesage', $forma);
        }
    }
}

/**
 * ����� ������� �������� ������
 * @param string $order_id
 * @return int
 */
function alfabank_log_check($order_id) {
    $PHPShopOrm = new PHPShopOrm("phpshop_modules_alfabank_log");
    $result = $PHPShopOrm->select(array('id'), array('order_id' => '="' . $order_id . '"', 'type' => '="register"'), array('order' => 'id desc'), array('limit' => 1));
    if (is_array($result))
        return $result['id']++;
}

$addHandler = array('send_to_order' => 'send_alfabank_hook');
?>