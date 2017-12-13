<?php

/**
 * ������ �������� ����
 * @param array $row ������ ������
 * @return string 
 */
function tab_print($data) {
    global $PHPShopGUI, $PHPShopSystem;

    $disp = null;

    // ����� ������
    $disp.=$PHPShopGUI->setButton(__('����� ������'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('forms/forma.php?orderID=" . $data['id'] . "'); return false;");

    // �������� ���
    $disp.=$PHPShopGUI->setButton(__('�������� ���'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('forms/forma2.php?orderID=" . $data['id'] . "'); return false;");

    // ��������
    $disp.=$PHPShopGUI->setButton(__('��������'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('forms/forma3.php?orderID=" . $data['id'] . "'); return false;");

    // ����
    $disp.=$PHPShopGUI->setButton(__('����'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('../../../phpshop/forms/account/forma.html?orderId=".$data['id']."&tip=2&datas=".$data['datas']."'); return false;");

    // ���� � ��������
    $disp.=$PHPShopGUI->setButton(__('��������'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('../../../phpshop/forms/receipt/forma.html?orderId=".$data['id']."&tip=2&datas=".$data['datas']."'); return false;");
    // ����-�������
    $disp.=$PHPShopGUI->setButton(__('����-�������'), '../img/action_print.gif', 130, 30, $float = "left", $onclick = "DoPrint('forms/forma4.php?orderID=" . $data['id'] . "'); return false;");

    // �����
    $order = unserialize($data['orders']);
    $mail = $order['Person']['mail'];
    $mail_title = "Re: " . $PHPShopSystem->getParam('name') . " - ����� �" . $data['uid'];
    $disp.=$PHPShopGUI->setButton(__('E-mail'), '../img/icon_email.gif', 130, 30, $float = "left", $onclick = "window.open('mailto:" . $mail . "?subject=" . $mail_title . "'); return false;");

    return $disp;
}

?>
