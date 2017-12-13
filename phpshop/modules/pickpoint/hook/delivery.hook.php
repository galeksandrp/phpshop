<?php

/**
 * ��������� ������
 */
function pickpoin_option() {
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['pickpoint']['pickpoint_system']);
    return $PHPShopOrm->select();
    
}

/**
 * ����� �������� �� �����
 */
function search_pickpoin_delivery($city) {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
    $data = $PHPShopOrm->select(array('id'),array('city'=>'="'.$city.'"'),false,array('limit'=>1));
    if(is_array($data))
        return $data['id'];
}

/**
 * ���
 */
function delivery_hook($_RESULT,$xid) {
    
    $option=pickpoin_option();
    
    // �� �������� pickpoin
    $title_id=search_pickpoin_delivery($option['city']);

    if(is_numeric($title_id))
        if($xid == $title_id) {

            $button='<a onclick="PickPoint.open(pickpoint_phpshop); return false" href="#">'.$option['name'].'</a>';

            $_RESULT['dellist']='<table collspan="0" rowspan="0"><tr><td>'.$_RESULT['dellist'].'</td><td style="padding-left:10px">'.$button.'</td></tr></table>';
            return $_RESULT;
        }
}


$addHandler=array
        (
        'delivery'=>'delivery_hook'
);

?>
