<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("cart");
PHPShopObj::loadClass("delivery");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

/*
  // ������������
  $_GET['do']='add';
  $_POST['name']='�������� �����';
  $_POST['uid']='53';
  $_POST['xid']='1';
  $_POST['num']=10;
 */

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();
$PHPShopValutaArray = new PHPShopValutaArray();
$PHPShopDelivery = new PHPShopDelivery();

// Load JsHttpRequest backend.
require_once $_classPath . "lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest = new JsHttpRequest("windows-1251");

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
$PHPShopOrm->debug = false;

// �� ������
$productID = $_POST['xid'];

// �� ������
$orderID = intval($_POST['uid']);

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

switch ($_GET['do']) {

    // ���������� ��������
    case 'delivery':
        if (CheckedRules($UserStatus["visitor"], 1) == 1) {
            $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
            if (is_array($data)) {
                $order = unserialize($data['orders']);

                $order['Person']['dostavka_metod'] = $productID;

                // ������������ ������ ������
                $update['orders_new'] = serialize($order);
                $PHPShopOrm->clean();
                $PHPShopOrm->update($update, array('id' => '=' . $orderID));
            }
        }
        break;

    // ���������� ������
    case 'discount':
        if (CheckedRules($UserStatus["visitor"], 1) == 1) {
            $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
            if (is_array($data)) {
                $order = unserialize($data['orders']);

                $order['Person']['discount'] = $productID;

                // ������������ ������ ������
                $update['orders_new'] = serialize($order);
                $PHPShopOrm->clean();
                $PHPShopOrm->update($update, array('id' => '=' . $orderID));
            }
        }
        break;


    // ���������� ������ � ������� �� ���� ��� ��������
    case 'add':
        if (CheckedRules($UserStatus["visitor"], 1) == 1) {
            $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
            if (is_array($data)) {
                $order = unserialize($data['orders']);

                // ���������� ������ �� ID
                if (!empty($productID)) {

                    // ���������� �������
                    $PHPShopCart = new PHPShopCart($order['Cart']['cart']);

                    // ��������� ����� ����� 1 �� �� ID
                    if ($PHPShopCart->add($productID, 1)) {

                        // ���������� ������ ���������� �������
                        $order['Cart']['cart'] = $PHPShopCart->getArray();
                        $order['Cart']['num'] = $PHPShopCart->getNum();
                        $order['Cart']['sum'] = $PHPShopCart->getSum(false);
                    } else {
                        // ��������� ����� ����� 1 �� �� ��������
                        $PHPShopCart->add($productID, 1, false, 'uid');
                    }

                        // ���������� ������ ���������� �������
                        $order['Cart']['cart'] = $PHPShopCart->getArray();
                        $order['Cart']['num'] = $PHPShopCart->getNum();
                        $order['Cart']['sum'] = $PHPShopCart->getSum(false);
                    $order['Cart']['weight'] = $PHPShopCart->getWeight();
                    $order['Cart']['dostavka'] = $PHPShopDelivery->getPrice($PHPShopCart->getSum(false), $PHPShopCart->getWeight());
                    }

                // ������������ ������ ������
                $update['orders_new'] = serialize($order);
                $PHPShopOrm->clean();
                $PHPShopOrm->update($update, array('id' => '=' . $orderID));
            }
        }
        break;

    // �������� ������ �� �������
    case 'delete':
        if (CheckedRules($UserStatus["visitor"], 2) == 1) {
            $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
            if (is_array($data)) {
                $order = unserialize($data['orders']);

                // �������� ������ �� �������
                unset($order['Cart']['cart'][$productID]);

                // ���������� �������
                $PHPShopCart = new PHPShopCart($order['Cart']['cart']);

                $order['Cart']['num'] = $PHPShopCart->getNum();
                $order['Cart']['sum'] = $PHPShopCart->getSum(false);
                $order['Cart']['weight'] = $PHPShopCart->getWeight();
                $order['Cart']['dostavka'] = $PHPShopDelivery->getPrice($PHPShopCart->getSum(false), $PHPShopCart->getWeight());

                // ������������ ������ ������
                $update['orders_new'] = serialize($order);
                $PHPShopOrm->clean();
                $PHPShopOrm->update($update, array('id' => '=' . $orderID));
            }
        }
        break;

    // ���������� ������ � �������
    case 'update':
        if (CheckedRules($UserStatus["visitor"], 1) == 1) {
            $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $orderID), false, array('limit' => 1));
            if (is_array($data)) {
                $order = unserialize($data['orders']);

                // ��� ������
                if (!empty($_POST['name']))
                    $order['Cart']['cart'][$productID]['name'] = $_POST['name'];

                // ����������
                if (!empty($_POST['num']))
                    $order['Cart']['cart'][$productID]['num'] = $_POST['num'];

                // ����
                if (!empty($_POST['price']))
                    $order['Cart']['cart'][$productID]['price'] = $_POST['price'];

                // ���������� �������
                $PHPShopCart = new PHPShopCart($order['Cart']['cart']);

                $order['Cart']['sum'] = $PHPShopCart->getSum(true);
                $order['Cart']['weight'] = $PHPShopCart->getWeight();
                $order['Cart']['dostavka'] = $PHPShopDelivery->getPrice($PHPShopCart->getSum(false), $PHPShopCart->getWeight());

                // ������������ ������ ������
                $update['orders_new'] = serialize($order);
                $PHPShopOrm->clean();
                $PHPShopOrm->update($update, array('id' => '=' . $orderID));
            }
            break;
        }
}
if (CheckedRules($UserStatus["visitor"], 1) == 1) {

    // ������� ������� �� �������� �����
    $interfaces = $PHPShopGUI->loadLib('tab_cart', $data, '../', 'ajax');


    $_RESULT = array(
        "interfaces" => $interfaces
    );
}
?>