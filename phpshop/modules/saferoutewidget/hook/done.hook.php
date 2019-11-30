<?php

function send_to_order_saferoutewidget_hook($obj, $row, $rout) {

    // API
    include_once 'phpshop/modules/saferoutewidget/class/saferoutewidget.class.php';
    $saferoutewidget = new saferoutewidget();
    $option = $saferoutewidget->option();
    $sessionId = $_POST['saferouteToken'];
    $apiKey = $option['key'];

    // ����������
    $helper = new SaferouteHelper($apiKey);

    if (in_array($_POST['d'], @explode(",", $option['delivery_id'])) and !empty($_POST['saferouteSum'])) {

        if ($rout == 'START') {

            $obj->delivery_mod = number_format($_POST['saferouteSum'], 0, '.', ' ');

            // Token
            $_POST['saferoute_token_new'] = $sessionId;
            
            $ddelivery_info = json_fix_utf(json_decode(PHPShopString::win_utf8($_POST['saferouteData']), true)); //echo '<pre>'; print_r($ddelivery_info); echo '</pre>'; die(0);
            if(is_array($ddelivery_info)) {
                
                // �����
                $_POST['city_new'] = str_replace('�. ', '', $ddelivery_info['city']['name']);
                
                // ��������
                if(!isset($ddelivery_info['delivery']['point'])) {
                    $_POST['street_new'] = $ddelivery_info['contacts']['address']['street'];
                    $_POST['flat_new'] = $ddelivery_info['contacts']['address']['flat'];
                    $_POST['house_new'] = $ddelivery_info['contacts']['address']['house'];
                }
                // Point
                else {
                    $_POST['street_new'] = $ddelivery_info['delivery']['point']['address'];
                }
                
                //$_POST['ddelivery_data'] = serialize($ddelivery_info);

            }
            
            // ���������� �� �������� � ����������� ������
            $obj->manager_comment = $_POST['saferouteReq'];
            $obj->set('deliveryInfo', $_POST['saferouteReq']);
        }


        if ($rout == 'MIDDLE' and $option['status'] == 0) {

            $params = array(
                'id' => $sessionId,
                'cms_id' => $obj->ouid,
                'payment_method' => PHPShopString::win_utf8($obj->get('payment'))
            );
            
            $result = $helper->sendOrder($params);
            if($result['status'] == 'ok')
                $_POST['saferoute_token_new']=0;
            
        }
    }
}

$addHandler = array
    (
    'send_to_order' => 'send_to_order_saferoutewidget_hook'
);
?>