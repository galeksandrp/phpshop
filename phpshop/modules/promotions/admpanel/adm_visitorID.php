<?php

function addCartPromotions($data) {
    global $PHPShopGUI;

    //������, �������� �� ��������
    $orders = unserialize($data['orders']);
    $promocode = $orders['Person']['promocode'];
    
    if($promocode=='*'):
        // �������
        $Tab5 = $PHPShopGUI->loadLib('tab_cart_newo', $data, '../../phpshop/modules/promotions/admpanel/');
        $PHPShopGUI->addTab(array("�������",$Tab5,350));
    elseif($promocode!=''):
	    // �������
	    $Tab5 = $PHPShopGUI->loadLib('tab_cart_new', $data, '../../phpshop/modules/promotions/admpanel/');
	    $PHPShopGUI->addTab(array("������� �����-�����",$Tab5,350));
    endif;
}


$addHandler=array(
        'actionStart'=>'addCartPromotions',
        'actionDelete'=>false,
        'actionUpdate'=>false
);

?>