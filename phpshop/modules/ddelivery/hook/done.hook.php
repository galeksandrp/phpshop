<?php

include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/application/bootstrap.php');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/mrozk/IntegratorShop.php' );

function send_to_order_ddelivery_hook($obj, $row, $rout) {

    if ($rout == 'START' && !empty($_POST['ddelivery_id'])) {
        if ($obj->PHPShopCart->getNum() > 0) {

            // ������ ������ ������������, ��� ���������� �������
            if (!class_exists('PHPShopUsers'))
                PHPShopObj::importCore('users');
            $PHPShopUsers = new PHPShopUsers();
            $obj->userId = $PHPShopUsers->add_user_from_order($row['mail']);

            if (isset($_SESSION['UsersLogin']) AND !empty($_SESSION['UsersLogin']))
                $_POST['mail'] = ($_SESSION['UsersLogin']);

            if (PHPShopSecurity::true_email($_POST['mail']) AND $obj->userId) {
                $obj->ouid = $_POST['ouid'];

                $order_metod = PHPShopSecurity::TotalClean($_POST['order_metod'], 1);
                $PHPShopOrm = new PHPShopOrm($obj->getValue('base.payment_systems'));
                $row = $PHPShopOrm->select(array('path'), array('id' => '=' . $order_metod, 'enabled' => "='1'"), false, array('limit' => 1));
                $path = $row['path'];

                // ��������� ������� API
                $LoadItems['System'] = $obj->PHPShopSystem->getArray();

                $obj->sum = $obj->PHPShopCart->getSum(false);
                $obj->num = $obj->PHPShopCart->getNum();
                $obj->weight = $obj->PHPShopCart->getWeight();

                // ������
                $obj->currency = $obj->PHPShopOrder->default_valuta_code;

                /*
                  // ��������� ��������
                  $obj->delivery = $this->PHPShopDelivery->getPrice($this->PHPShopCart->getSum(false), $this->PHPShopCart->getWeight());

                  // ������
                  $obj->discount = $this->PHPShopOrder->ChekDiscount($this->PHPShopCart->getSum());

                  // �����
                  $obj->total = $this->PHPShopOrder->returnSumma($this->sum, $this->discount) + $this->delivery;
                 */

                $id = $_POST['ddelivery_id'];

                try {
                    // ������������� ���������� ��������
                    $IntegratorShop = new IntegratorShop();
                    $ddeliveryUI = new \DDelivery\DDeliveryUI($IntegratorShop, true);
                    $order = $ddeliveryUI->initOrder($id);
                    $obj->delivery = $ddeliveryUI->getOrderClientDeliveryPrice($order);
                    $obj->total = $obj->PHPShopOrder->returnSumma($obj->sum, $obj->discount) + $obj->delivery;
                    // ��������� ID
                    $cmsID = $obj->ouid;
                    $ddeliveryUI->onCmsOrderFinish($id, $cmsID, 0, @$_POST['order_metod']);
                } catch (\DDeliveryException $e) {
                    $ddeliveryUI->logMessage($e);
                }

                // ��������� �� e-mail
                $obj->mail();

                // ������� ������ � �������� �������
                $obj->setHook(__CLASS__, __FUNCTION__, $_POST, 'MIDDLE');

                // ����������� ������ ������ �� ������
                if (file_exists("./payment/$path/order.php"))
                    include_once("./payment/$path/order.php");
                elseif ($order_metod < 1000)
                    exit("��� ����� ./payment/$path/order.php");

                // ������ �� ������� ������
                if (!empty($disp))
                    $obj->set('orderMesage', $disp);

                // ������ ������ � ��
                $obj->write();

                // SMS ��������������
                $obj->sms();

                // ��������� �������� �������
                $PHPShopCartElement = new PHPShopCartElement(true);
                $PHPShopCartElement->init('miniCart');
            }
            else {
                $obj->set('mesageText', $obj->message($obj->lang('bad_order_mesage_1'), $obj->lang('bad_order_mesage_2')));

                // ���������� ������
                $disp = ParseTemplateReturn($obj->getValue('templates.order_forma_mesage'));
                $disp.=PHPShopText::notice(PHPShopText::a('javascript:history.back(1)', $obj->lang('order_return')), 'images/shop/icon-setup.gif');
                $obj->set('orderMesage', $disp);
            }
        } else {

            $obj->set('mesageText', $obj->message($obj->lang('bad_cart_1'), $obj->lang('bad_order_mesage_2')));
            $disp = ParseTemplateReturn($obj->getValue('templates.order_forma_mesage'));
            $obj->set('orderMesage', $disp);
        }

        // ������� ������ � ����� �������
        $obj->setHook(__CLASS__, __FUNCTION__, $_POST, 'END');

        // ���������� ������
        $obj->parseTemplate($obj->getValue('templates.order_forma_mesage_main'));
        return true;
    }
}

/**
 * ��������� ������
 */
function search_ddelivery_delivery() {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['ddelivery']['ddelivery_system']);
    $data = $PHPShopOrm->select(array('settings'), array('id' => '=1'));
    if (!isset($data['settings']) || empty($data['settings'])) {
        $settings = array('self_way' => array(), 'courier_way' => array());
    } else {
        $settings = json_decode($data['settings'], true);
    }
    $dd = array_merge($settings['self_way'], $settings['courier_way']);
    return $dd;
}

function write_ddelivery_hook($obj, $row, $rout) {
    if ($rout == 'START') {

        $id = $_POST['ddelivery_id'];

        $dd = search_ddelivery_delivery();
        $xid = $_POST['d'];

        if (is_array($dd) && in_array($xid, $dd)) {
            try {
                
                // ������������� ���������� ��������
                $IntegratorShop = new IntegratorShop();
                $ddeliveryUI = new \DDelivery\DDeliveryUI($IntegratorShop, true);
                $order = $ddeliveryUI->initOrder($id);
                $obj->delivery = $ddeliveryUI->getOrderClientDeliveryPrice($order);
                $obj->total = $obj->PHPShopOrder->returnSumma($obj->sum, $obj->discount) + $obj->delivery;

                // ��������� ID
                $cmsID = $obj->ouid;
                $ddeliveryUI->onCmsOrderFinish($id, $cmsID, 0, @$_POST['order_metod']);
            } catch (\DDeliveryException $e) {
                $ddeliveryUI->logMessage($e);
            }
        }
    }
}

$addHandler = array
    (
    '#send_to_order' => 'send_to_order_ddelivery_hook',
    'write' => 'write_ddelivery_hook'
);
?>