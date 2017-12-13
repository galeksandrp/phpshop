<?php

function yescredit_send($obj, $option) {

    // ���� ������� � �������
    $term = $_POST['yescredit_term'];

    // ����������� �����
    $start_summ = ($obj->get('total') * $_POST['yescredit_start_summ']) / 100;

    // ������
    $region = $_POST['yescredit_region'];

    // ������������� � �������
    $MERCHANTID = $option['MERCHANT_ID'];

    // �������
    $cart = null;
    if (is_array($_SESSION['cart']))
        foreach ($_SESSION['cart'] as $val) {
            $cart.='ITEMS[]=MODEL:' . urlencode(PHPShopString::win_utf8($val['name'])) . '|COUNT:' . $val['num'] . '|PRICE:' . $val['price'] . '&';
        }

    // ����� ������
    $post = 'term=' . $term . '&start_summ=' . $start_summ . '&region=' . $region . '&PersonProfit=35000&Email=' . $_POST['mail'] . '&Name=' . $_POST['name_person'] . '&' . $cart . 'MERCHANTID=' . $MERCHANTID . '&PHONE_CODE=' . $_POST['tel_code'] . '&PHONE_NUMBER=' . $_POST['tel_name'] . '&ORDERID=' . $_POST['ouid'];
    $post = PHPShopString::win_utf8($post);

    //echo $post;

    if (function_exists('curl_init')) { ## ��������, �������������� �� ������ curl (�������� ������� ����������)
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml; charset=windows-1251'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CRLF, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_URL, "http://yes-credit.su/receiver/postReceiver.aspx");

        $res = curl_exec($ch);

        if (curl_error($ch) != '' || $res == false) {
            echo "Error: " . curl_error($ch);
            curl_close($ch);
            die;
        }

        curl_close($ch);

        # ������ �������, ��������� � ���������� $res
    } else { # ���� ������ curl �� ����������, �������� �� �������� fsockopen

        $fp = fsockopen("yes-credit.su", 80, $errno, $errstr, 30);
        if (!$fp) {
            echo "��������� ������. ����������, ���������� �����!";
        } else {

            $out = "POST /receiver/postReceiver.aspx    HTTP/1.1\r\n";
            $out .= "Host: yes-credit.su\r\n";
            $out .= "Content-Length: " . strlen($post) . "\r\n";
            $out .= "Connection: Close\r\n\r\n";
            $out .= $post . "\r\n";

            fwrite($fp, $out);
            $res = null;
            while (!feof($fp)) {
                $res.=fgets($fp, 128);
            }
            fclose($fp);
        }


        $response = split("\r\n\r\n", $res);
        $header = $response[0];
        $responsecontent = $response[1];
        if (!(strpos($header, "Transfer-Encoding: chunked") === false)) {
            $aux = split("\r\n", $responsecontent);
            for ($i = 0; $i < count($aux); $i++)
                if ($i == 0 || ($i % 2 == 0))
                    $aux[$i] = "";
            $responsecontent = implode("", $aux);
        }
        $res = chop($responsecontent);

        # ������ ������, ��������� � $res
    }

    return $res;
}

/**
 * ������ ������� � �����
 */
function mail_yescredit_hook($obj, $row, $rout) {
    global $PHPShopModules;

    // ��������� ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['yescredit']['yescredit_system']);
    $option = $PHPShopOrm->select();

    if ($rout == 'END' and $_POST['order_metod'] == $option['payment_id']) {

        if ($PHPShopModules->checkKeyBase('yescredit'))
            return false;

        // �������� ������ ���������� �������
        $result = yescredit_send($obj, $option);
    }
}

$addHandler = array
    (
    'mail' => 'mail_yescredit_hook'
);


// ��������� ������� ��������� ����������
$setHandlerDoneMemory = array
    (
    'mail_yescredit_hook' => 'true'
);
?>