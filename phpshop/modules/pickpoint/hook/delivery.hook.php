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
function search_pickpoin_delivery($city, $xid) {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
    $data = $PHPShopOrm->select(array('id'), array('city' => " REGEXP '" . $city . "'", 'id' => '=' . $xid,'is_folder'=>"!='1'"), false, array('limit' => 1));
    if (is_array($data))
        return $data['id'];
}

/**
 * ���
 */
function delivery_hook($obj, $data) {
    
    $_RESULT=$data[0];
    $xid=$data[1];

    $option = pickpoin_option();

    // �� �������� pickpoin
    $title_id = search_pickpoin_delivery($option['city'], $xid);

    if (is_numeric($title_id))
        if ($xid == $title_id) {
            
         
            $button = '<img src="'.$GLOBALS['SysValue']['dir']['dir'].chr(47).$GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47).'images/shop/icon-activate.gif" alt="" align="absmiddle" border="0"> <a onclick="PickPoint.open(pickpoint_phpshop); return false" href="#">' . $option['name'] . '</a>';
            $hook['dellist'] = '<table collspan="0" rowspan="0"><tr><td>' . $_RESULT['dellist'] . '</td><td style="padding-left:10px">' . $button . '</td></tr></table>';
            $hook['delivery']=$_RESULT['delivery'];
            $hook['total']=$_RESULT['total'];
            
            return  $hook;
        }
}

$addHandler = array
    (
    'delivery' => 'delivery_hook'
);
?>
