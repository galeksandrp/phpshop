<?php

function startPbrf($data) {
	global $PHPShopGUI;
	// ���������� ������
  //$PHPShopOrder = new PHPShopOrderFunction($data['id']);

	//$order = unserialize($data['orders']);
	//$Person = $order['Person'];
	//$Cart = $order['Cart'];



  $Tab5 = $PHPShopGUI->loadLib('tab_pbrf_new', $data, '../../modules/pbrf/admpanel/');
  $PHPShopGUI->addTab(array("�������� ������",$Tab5,270));




}

$addHandler=array(
        'actionStart'=>'startPbrf',
        'actionDelete'=>false,
        'actionUpdate'=>false
);

?>