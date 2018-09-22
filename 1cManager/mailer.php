<?php

// ���������� ������ � ������
include_once('../phpshop/class/system.class.php');
include_once('../phpshop/class/mail.class.php');

// ����� ������ ��� ����-�������
function GetNumOrders($cid) {
    global $link_db;

    $sql = "select uid from " . $GLOBALS['SysValue']['base']['table_name9'] . " where cid='$cid'";
    $result = mysqli_query($link_db, $sql);
    @$row = mysqli_fetch_array(@$result);
    return $row['uid'];
}

// ��������� ������������
function SendMailUser($id, $flag = "accounts") {
    global $link_db, $PHPShopSystem;

    // ����-�������, ����� ������ ������
    if ($flag == "invoice")
        $id = GetNumOrders($id);

    $sql = "select * from " . $GLOBALS['SysValue']['base']['table_name1'] . " where id=" . intval($id);
    $result = mysqli_query($link_db, $sql);
    @$row = mysqli_fetch_array(@$result);
    $order = unserialize($row['orders']);
    $mail = $order['Person']['mail'];
    $name = $order['Person']['name_person'];
    $uid = $row['uid'];

    $PHPShopSystem = new PHPShopSystem();
    if ($PHPShopSystem->ifSerilizeParam('1c_option.1c_load_status_email')) {

        $content = "���������(��) ������������ " . $name . ", �� ������ �" . $uid . " ����� �������� ������������� ��������� � ������ ��������.

�� ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� ����� '������ �������' ��� �� ������ http://" . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . "/users/
    
����: " . date("d-m-y H:s a") . "
    
";

        // ����������� ���������
        new PHPShopMail($mail, $PHPShopSystem->getParam('adminmail2'), "������������� ��������� �� ������ �" . $row['uid'], $content);
    }
}

?>