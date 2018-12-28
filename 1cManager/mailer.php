<?php

// ���������� ������ � ������
include_once('../phpshop/class/system.class.php');
include_once('../phpshop/class/mail.class.php');

// ����� ������ ��� ����-�������
function GetNumOrders($cid) {
    global $link_db;

    $sql = "select uid,datas from " . $GLOBALS['SysValue']['base']['1c_docs'] . " where cid='$cid'";
    $result = mysqli_query($link_db, $sql);
    @$row = mysqli_fetch_array(@$result);
    return $row['uid'];
}

// ��������� ������������
function SendMailUser($id, $flag, $datas = false) {
    global $link_db, $PHPShopSystem;

    // ����-�������, ����� ������ ������
    if ($flag == "invoice") {
        $order_info = GetNumOrders($id);
        $id = $order_info['id'];
        $datas = $order_info['datas'];
        $name_doc = "����-�������";
    }
    else
        $name_doc = "����� �� ������";

    $sql = "select * from " . $GLOBALS['SysValue']['base']['orders'] . " where id=" . intval($id);
    $result = mysqli_query($link_db, $sql);
    @$row = mysqli_fetch_array(@$result);
    $order = unserialize($row['orders']);
    $mail = $order['Person']['mail'];
    $name = $order['Person']['name_person'];
    $uid = $row['uid'];

    $PHPShopSystem = new PHPShopSystem();
    if ($PHPShopSystem->ifSerilizeParam('1c_option.1c_load_status_email')) {

        $content = "���������(��) ������������ " . $name . ", �� ������ �" . $uid . " ����� �������� �������� ����� \"" . $name_doc . "\".

�� ������ ��������� ������ ������, ��������� �����, ����������� ��������� ��������� ��-���� � \"������ ��������\" ��� ������� �� ������: http://" . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . "/files/docsSave.php?orderId=" . $id . "&list=" . $flag . "&datas=" . $datas . "&user=" . $row['user'] . "
       
����: " . date("d-m-y H:s a") . "
    
";

        // ����������� ���������
        new PHPShopMail($mail, $PHPShopSystem->getParam('adminmail2'), "������������� ��������� �� ������ �" . $row['uid'], $content);
    }
}

?>