<?php

function promotions_write($obj, $data, $rout) {

    if ($rout == 'START' and !empty($_SESSION['promocode'])) {

        // ���������� ��������� ������������
        if ($_SESSION['codetip'] == 1) {
            if ($_SESSION['multicodes'] == 1) {
                $PHPShopOrm = new PHPShopOrm($obj->PHPShopModules->getParam("base.promotions.promotions_codes"));
            } else {
                $PHPShopOrm = new PHPShopOrm($obj->PHPShopModules->getParam("base.promotions.promotions_forms"));
            }
            $PHPShopOrm->debug = false;
            $PHPShopOrm->update(array('enabled_new' => 0), array('code' => '="' . $_SESSION['promocode'] . '"'));
        }

        // �����
        $PHPShopOrm = new PHPShopOrm($obj->PHPShopModules->getParam("base.promotions.promotions_forms"));
        $data_promo = $PHPShopOrm->select(array('header_mail', 'content_mail'), array('code' => '="' . $_SESSION['promocode'] . '"'), false, array('limit' => 1));

        // �����
        if (!empty($data_promo['header_mail']) and !empty($data_promo['content_mail'])) {
            $PHPShopMail = new PHPShopMail($_POST['mail'], $obj->adminmail, $data_promo['header_mail'], '', true, true);
            $obj->set('message', $data_promo['content_mail']);
            $PHPShopMail->sendMailNow(ParseTemplateReturn('./phpshop/lib/templates/order/blank.tpl', true));
        }
    }
}

function promotions_mail($obj, $data, $rout) {

    if ($rout == 'START') {

        // ���������� ��������
        if ($_SESSION['freedelivery'] == 0) {
            $obj->delivery = 0;
        }


        // ���������� ��� � �������
        $sum = $sum_promo = 0;
        $sum_check = false;
        foreach ($_SESSION['cart'] as $key => $product) {

            // �����
            if (!empty($product['promo_sum']) and !$sum_check) {

                // ���� ��� ������
                $_SESSION['cart'][$key]['promo_price'] = $product['price'];

                if ($product['price'] > $product['promo_sum']) {
                    $_SESSION['cart'][$key]['price'] = $product['price'] - $product['promo_sum'] / $product['num'];
                    $_SESSION['cart'][$key]['name'].=' ['.__('������').' ' . $product['promo_sum'] / $product['num'] . ' ' . $obj->currency . ']';
                    $sum_check = true;
                    
                    $sum_promo+=$product['num'] * $_SESSION['cart'][$key]['price'];
                }
                
                
            }
            // ������� �� �����
            else if (!empty($product['promo_percent'])) {

                // ���� ��� ������
                $_SESSION['cart'][$key]['promo_price'] = $product['price'];

                $_SESSION['cart'][$key]['price'] = $product['price'] - ($product['price'] * $product['promo_percent'] / 100);
                $_SESSION['cart'][$key]['name'].=' ['.__('������').' ' . $product['promo_percent'] . '%]';

                $sum_promo+=$product['num'] * $_SESSION['cart'][$key]['price'];
            }
            
            // ���������
            else {
                 $sum+=$product['num'] * $product['price'];
            }
        }
        
        // �������� �������� ���������
        $obj->sum = $obj->PHPShopOrder->returnSumma($sum_promo)+$obj->PHPShopOrder->returnSumma($sum, $obj->discount);
        $obj->total = $obj->sum + $obj->delivery;
        
        unset($_SESSION['totalsummainput']);
    }
}

$addHandler = array
    (
    'write' => 'promotions_write',
    'mail' => 'promotions_mail',
);
?>