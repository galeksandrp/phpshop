<?php

function saferoutewidgetSend($data) {
    global $_classPath;

    if ($data['statusi'] != $_POST['statusi_new'] or !empty($_POST['saferoute_send_now'])) {
        // Rest 
        include_once($_classPath . 'modules/saferoutewidget/class/saferoutewidget.class.php');
        $saferoutewidget = new saferoutewidget();
        $option = $saferoutewidget->option();

        if ($_POST['statusi_new'] == $option['status'] or !empty($_POST['saferoute_send_now'])) {

			$apiKey = $option['key'];
            $sessionId = $data['saferoute_token']; 
            $helper = new SaferouteHelper($apiKey);

            $order = unserialize($data['orders']);
            $del_id = $order['Person']['order_metod'];
            $PHPShopPayment = new PHPShopPayment($del_id);

            $params = array(
                'id' => $sessionId,
                'cms_id' => $data['uid'],
                'payment_method' => PHPShopString::win_utf8($PHPShopPayment->getName())
            );

            $result=$helper->sendOrder($params); //print_r($result);

            if($result['status'] == 'ok')
                $_POST['saferoute_token_new']=0;
        }
    }
	
}

function addSaferoutewidgetTab($data) {
    global $PHPShopGUI;


    if (!empty($data['saferoute_token'])) {
        $Tab1 = $PHPShopGUI->setField(__('Синхронизация заказа'), $PHPShopGUI->setCheckbox('saferoute_send_now', 1, 'Отправить заказ в Saferoute.ru сейчас', 0));
        $PHPShopGUI->addTab(array("Saferoute", $Tab1, true));
    }
}

$addHandler = array(
    'actionStart' => 'addSaferoutewidgetTab',
    'actionDelete' => false,
    'actionUpdate' => 'saferoutewidgetSend'
);
?>