<?php

/**
 * ������ �������� ����
 * @param array $row ������ ������
 * @return string 
 */
function tab_print($data) {
    global $PHPShopGUI;

    $disp = null;

    // ����� ������
    $disp.=$PHPShopGUI->setButton(__('����� ������'), 'print', 'btn-print-order','./order/forms/order.php?orderID=' . $data['id']);

    // �������� ���
    $disp.=$PHPShopGUI->setButton(__('�������� ���'), 'bookmark', 'btn-print-order','./order/forms/receipt.php?orderID=' . $data['id']);

    // ����
    $disp.=$PHPShopGUI->setButton(__('���� � ����'), 'credit-card', 'btn-print-order','../../../phpshop/forms/account/forma.html?orderId='.$data['id'].'&tip=2&datas='.$data['datas']);

    // ���� � ��������
    $disp.=$PHPShopGUI->setButton(__('��������'), 'list-alt', 'btn-print-order','../../../phpshop/forms/receipt/forma.html?orderId='.$data['id'].'&tip=2&datas='.$data['datas']);
    
    // ����-�������
    $disp.=$PHPShopGUI->setButton(__('����-�������'), 'barcode', 'btn-print-order','./order/forms/invoice.php?orderID=' . $data['id'] );
    
        // ����-12
    $disp.=$PHPShopGUI->setButton(__('����-12'), 'qrcode', 'btn-print-order','./order/forms/torg-12.php?orderID=' . $data['id']);
    
     // ��������
    $disp.=$PHPShopGUI->setButton(__('��������'), 'briefcase', 'btn-print-order','./order/forms/warranty.php?orderID=' . $data['id']);

    return $disp;
}

?>
