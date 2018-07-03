<?php

function sendSmsgate($data)
{

    // SMS ���������� ������������ � ����� ������� ������
    if ($data['statusi'] != $_POST['statusi_new']) {

        // ������� �������
        $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
        $GetOrderStatusArray = $PHPShopOrderStatusArray->getArray();

        // ��������� ������
        include_once(dirname(__FILE__) . '/mod_option.php');
        $PHPShopSmsgate = new PHPShopSmsgate();

        // ��������� �������
        $statusOrderTpl = $PHPShopSmsgate->getTplStatusOrder();

        if ($PHPShopSmsgate->getCascadeEnabled()) {
            $statusOrderTpl = $PHPShopSmsgate->getTplStatusOrderViber();
        }


        $PHPShopSystem = new PHPShopSystem();
        $nameShop = $PHPShopSystem->objRow['name'];

        // ������ ������ ��� ������� ��� �������� ������
        $datainsert = array(
            '@NameShop@' => $nameShop,
            '@OrderNum@' => $data['uid'],
            '@OrderStatus@' => $_POST['statusi_new'] ? $GetOrderStatusArray[$_POST['statusi_new']]['name'] : '�����������'
        );

        // ������� �� ������� ������������ ���������
        $phone = array($PHPShopSmsgate->true_num($data['tel']));

        // ���������
        $msg = $PHPShopSmsgate->parseString($statusOrderTpl, $datainsert);


        if ($PHPShopSmsgate->getCascadeEnabled()) {
            $PHPShopSmsgate->sendSmsgate($phone, $msg, 'change_status_order_template_viber');
        } else {
            $PHPShopSmsgate->sendSmsgate($phone, $msg);
        }



    }

}

$addHandler = array(
    'actionStart' => false,
    'actionDelete' => false,
    'actionUpdate' => 'sendSmsgate'
);

?>