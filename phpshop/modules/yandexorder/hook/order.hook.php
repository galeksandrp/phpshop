<?php

/**
 * �����
 */
function order_hook_full_adres() {
    $Arg=func_get_args();
    $str=null;
    foreach($Arg as $val) {
        if(!empty($val)) $str.=$val.', ';
    }
    return substr($str,0,strlen($str)-2);
}


/**
 * ���������� ������ �������� ������
 */
function order_hook($obj,$row,$rout) {

    if($rout =='MIDDLE') {
        $callback=urlencode('http://'.$_SERVER['SERVER_NAME'].$obj->getValue('dir.dir').'/order/');
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['yandexorder']['yandexorder_system']);
        $data = $PHPShopOrm->select();

        if(empty($data['button']))
        $button_img='http://cards2.yandex.net/hlp-get/4412/png/4.png';
        else $button_img=$data['button'];

        $button='<a href="http://market.yandex.ru/addresses.xml?callback='.$callback.'"><img src="'.$button_img.'" border="0" /></a>';
        
        $order_action_add='
<script>
    // YandexOrder PHPShop Module
    $(document).ready(function() {
        $(\''.$button.'\').insertAfter("#dop_info");
    });            
</script>';
        
        

        // ����� ������ ���������� �� ������
        $cart_min=$obj->PHPShopSystem->getSerilizeParam('admoption.cart_minimum');
        if($cart_min <= $obj->PHPShopCart->getSum(false)) {
            
            // ��������� JS � ����� ������
            $obj->set('order_action_add',$order_action_add,true);
            

            // ��������� ������� �� �������
            if(isset($_POST['operation_id'])) {
                $adres=order_hook_full_adres($_POST['city'],$_POST['street'],'�.'.$_POST['building'],'������ '.$_POST['suite'],'������� '.$_POST['entrance'],'�������� '.$_POST['flat'],'���� '.$_POST['floor'],'����� '. $_POST['metro'],$_POST['comment']);
                $obj->set('UserTel',$_POST['phone']);
                $obj->set('UserTelCode',$_POST['phone-extra']);
                $obj->set('UserName',PHPShopString::utf8_win1251($_POST['firstname'].' '.$_POST['lastname']));
                $obj->set('UserMail',$_POST['email']);
                $obj->set('UserAdres',PHPShopString::utf8_win1251($adres));
            }

            //$obj->set('orderContent',parseTemplateReturn('phpshop/modules/yandexorder/templates/main_order_forma.tpl',true));
        }
    }
}

$addHandler=array
        (
        'order'=>'order_hook'
);
?>