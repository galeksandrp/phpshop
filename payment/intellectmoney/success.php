<?php

if (empty($GLOBALS['SysValue']))
    exit(header("Location: /"));

// ����������� ��������� ������� �� $_GET['payment']
if (!empty($_REQUEST['payment']))
    if ($_REQUEST['payment'] == 'intellectmoney') {
        $order_metod = "IntellectMoney";
        $success_function = false; // ��������� ������� ���������� ������� ������, �������� ��� ��������� � result.php
        $my_crc = "NoN";
        $crc = "NoN";
        $inv_id = $_GET['LMI_PAYMENT_NO'];
    }
?>