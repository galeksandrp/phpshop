<?php

function payment_mod_liqpay_hook($obj,$value) {
    
    // ��������� ������
    include_once(dirname(__FILE__).'/mod_option.hook.php');
    $option = new PHPShopLiqpayArray();

    $value[]=array($option->getParam('title'),10001,false);
    $obj->set('orderOplata',PHPShopText::select('order_metod',$value,250));;
    return true;
}


$addHandler=array
        (
        'payment'=>'payment_mod_liqpay_hook'
);
?>