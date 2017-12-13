<?php

function sendSmsfly($data) {
    
    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();

    include "../../modules/smsfly/hook/mod_option.hook.php";
    
    // SMS ���������� ������������ � ����� ������� ������
    if (intval($data['statusi']) != intval($_POST['statusi_new'])) {
        
        // ��������� ������
        $PHPShopSmsfly = new PHPShopSmsfly();

        // ���������
        $msg = '����� ������ ������ �' . $_POST['order_num'] . ' - ' . $GetOrderStatusArray[$_POST['statusi_new']]['name'];
        $phone=$_POST['tel_new'];
        $PHPShopSmsfly->send($msg,$phone);
    }
}

$addHandler = array(
    'actionStart' => false,
    'actionDelete' => false,
    'actionUpdate' => 'sendSmsfly'
);
?>