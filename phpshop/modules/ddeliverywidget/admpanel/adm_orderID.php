<?php

function ddeliverywidgetSend($data) {
    global $_classPath, $link_db;

    if ($data['statusi'] != $_POST['statusi_new'] or !empty($_POST['ddelivery_send_now'])) {

        // Rest 
        include_once($_classPath . 'modules/ddeliverywidget/class/ddeliverywidget.class.php');
        $ddeliverywidget = new ddeliverywidget();
        $option = $ddeliverywidget->option();

        if ($_POST['statusi_new'] == $option['status'] or !empty($_POST['ddelivery_send_now'])) {
            $apiKey = $option['key'];
            $sessionId = $data['ddelivery_token']; 
            $helper = new DDeliveryHelper($apiKey);

            $order = unserialize($data['orders']);
            $del_id = $order['Person']['order_metod'];
            $PHPShopPayment = new PHPShopPayment($del_id);

            $params = array(
                'id' => $sessionId,
                'cms_id' => $data['uid'],
                'payment_method' => PHPShopString::win_utf8($PHPShopPayment->getName())
            );

            $result=$helper->sendOrder($params);

            if($result['status'] == 'ok')
                $_POST['ddelivery_token_new']=0;
        }
    }
}

function addDdeliveryTab($data) {
    global $PHPShopGUI;
    if (!empty($data['ddelivery_token'])) {
        $Tab1 = $PHPShopGUI->setField(__('������������� ������'), $PHPShopGUI->setCheckbox('ddelivery_send_now', 1, '��������� ����� � DDelivery.ru ������', 0));
        $PHPShopGUI->addTab(array("Ddelivery", $Tab1, true));
    }
}

$addHandler = array(
    'actionStart' => 'addDdeliveryTab',
    'actionDelete' => false,
    'actionUpdate' => 'ddeliverywidgetSend'
);
?>