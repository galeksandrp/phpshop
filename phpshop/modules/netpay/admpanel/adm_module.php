<?php

PHPShopObj::loadClass('order');

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.netpay.netpay_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=netpay');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
	
	$Tab1.=$PHPShopGUI->setField('����� ������', 
		$PHPShopGUI->setRadio('work_new', 1, '�������', $data['work']) . 
        $PHPShopGUI->setRadio('work_new', 0, '��������', $data['work'])
		);
	
    $Tab1.=$PHPShopGUI->setField('Api Key', $PHPShopGUI->setInputText(false, 'apikey_new', $data['apikey'], 210));
    $Tab1.=$PHPShopGUI->setField('Auth signature', $PHPShopGUI->setInputText(false, 'auth_new', $data['auth'], 100));
    $Tab1.=$PHPShopGUI->setField('������������ ������ ������', $PHPShopGUI->setInputText(false, 'expiredtime_new', $data['expiredtime'], 100,'����'));
	
	// �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['status']);

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('��������� ������ ��� ������� ������', $PHPShopGUI->setSelect('status_new', $order_status_value, 210));
	
	$Tab1.= $PHPShopGUI->setField('��������� �� ���������� ������', $PHPShopGUI->setTextarea('title_sub_new', $data['title_sub']));
	
    $Tab1.=$PHPShopGUI->setField('�������������� ���������� �������� �������� ������', 
		$PHPShopGUI->setRadio('autosubmit_new', 2, '���.', $data['autosubmit']) . 
        $PHPShopGUI->setRadio('autosubmit_new', 1, '����.', $data['autosubmit'])
		);

    $Tab1.= $PHPShopGUI->setField('��������� ����� �������', $PHPShopGUI->setTextarea('title_new', $data['title']));
	
	/*foreach ($order_status_value as $i => $v) $order_status_value[$i][2] = $data['status_paid'];
	$Tab1.= $PHPShopGUI->setField('������ ����������� ������', $PHPShopGUI->setSelect('status_paid_new', $order_status_value, 210));*/
	
	foreach ($order_status_value as $i => $v) $order_status_value[$i][2] = $data['status_refund'];
	$Tab1.= $PHPShopGUI->setField('������ ������ � ��������� ������', $PHPShopGUI->setSelect('status_refund_new', $order_status_value, 210));
    
	$Tab1.=$PHPShopGUI->setField('��������� ������-��� ����� ������� Net Pay', 
		$PHPShopGUI->setRadio('online_bill_new', 1, '���.', $data['online_bill']) . 
        $PHPShopGUI->setRadio('online_bill_new', 0, '����.', $data['online_bill'])
		);
		
	$Tab1.=$PHPShopGUI->setField('��� ��� ������-����', $PHPShopGUI->setInputText(false, 'inn_new', $data['inn'], 210));
	
	$nds_arr = array(
		array('��� ���', 'none','none'), 
		array('��� �� ������ 0%', 'vat0','none'), 
		array('��� ���� �� ������ 10%', 'vat10','none'), 
		array('��� ���� �� ������ 18%', 'vat18','none'), 
		array('��� ���� �� ��������� ������ 10/110', 'vat110','none'), 
		array('��� ���� �� ��������� ������ 18/118', 'vat118','none'),
		);
	foreach ($nds_arr as $i => $v) $nds_arr[$i][2] = $data['tax'];
	$Tab1.= $PHPShopGUI->setField('������ ��� ��� ������-����', $PHPShopGUI->setSelect('tax_new', $nds_arr, 210));
	
	$Tab1.=$PHPShopGUI->setField('������������ ����� "������������"', 
		$PHPShopGUI->setRadio('hold_new', 1, '���.', $data['hold']) . 
        $PHPShopGUI->setRadio('hold_new', 0, '����.', $data['hold'])
		);
		
	foreach ($order_status_value as $i => $v) $order_status_value[$i][2] = $data['status_hold'];
	$Tab1.= $PHPShopGUI->setField('������ ������ � ������������ ������ ��� ������������', $PHPShopGUI->setSelect('status_hold_new', $order_status_value, 210));
    
    $info = '<h4>��������� ������</h4>
       <ol>
        <li>������������������ �� ����� <a href="http://net2pay.ru/" target="_blank">Net2pay.ru</a>.
        <li>"API Key" � "Auth signature" (�������� ��� ����������� � Net2pay.ru) ����������� � ����������� ���� �������� ������.
        <li>�������� ������������ Net2pay.ru ����� ���������� � �������: <code>http://'.$_SERVER['SERVER_NAME'].'/phpshop/modules/netpay/payment/result.php</code>
        </ol>
        
';

    $Tab2 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $Tab2), array("� ������", $Tab3));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>