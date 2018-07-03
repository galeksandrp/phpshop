<?php

include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/application/bootstrap.php');
include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/mrozk/IntegratorShop.php' );

function addDDeliveryPanel($data) {

    global $PHPShopGUI;

    // �������� ������ PHP
    if (substr(phpversion(), 0, 3) < 5.3)
        return true;

    try {

        $IntegratorShop = new IntegratorShop();
        $ddeliveryUI = new \DDelivery\DDeliveryUI($IntegratorShop, true);
        $ddOrder = $ddeliveryUI->getOrderByCmsID($data['uid']);   // ( $_REQUEST['visitorID'] ) ;
        // �������� ������ � ���� DDelivery � �������
        if (empty($ddOrder))
            return true;

        $getPoint = $ddOrder->getPoint();
        if ($ddOrder !== null) {
            $ddeliveryPrice = $ddeliveryUI->getOrderClientDeliveryPrice($ddOrder);
            $ddID = (empty($ddOrder->ddeliveryID) ? '������ �� DDelivery.ru �� �������' : 'ID ������ �� DDelivery.ru - ' . $ddOrder->ddeliveryID);
            $Tab1 = $PHPShopGUI->setField(__("DDelivery"), '��������� �������� - ' . $ddeliveryPrice . '<br /> ' . $ddID, 'left');
            $Tab1 .= $PHPShopGUI->setField(__("���������� � ������"), '��� �������� - ' . (($ddOrder->type == 1) ? '���������' : '��������') . '<br /> ' .
                    '���� - ' . $getPoint['delivery_time_avg'] . ' ���' . '<br /> ' .
                    '�������� - ' . iconv('UTF-8', 'windows-1251', $getPoint['delivery_company_name']));

            //$PHPShopGUI->addTab(array("��������",$Tab1,350));

            if (file_exists(__DIR__ . '/gui/tab_cart.gui.php')) {
                require_once(__DIR__ . '/gui/tab_cart.gui.php');
            } else {
                return 'file not exist';
            }
            $Tab2 = tab_cart_ddelivery($data);

            $PHPShopGUI->addTab(array(__("DDelivery"), $Tab1 . $Tab2, 350));
        }
    } catch (\DDelivery\DDeliveryException $e) {
        $ddeliveryUI->logMessage($e);
    }
}

function checkCreateDDelivery($post) {
    global $PHPShopModules, $PHPShopOrm;

    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_POST['rowID'])));

    try {
        //DDelivery
        $IntegratorShop = new IntegratorShop();
        $ddeliveryUI = new \DDelivery\DDeliveryUI($IntegratorShop, true);
        $ddOrder = $ddeliveryUI->getOrderByCmsID($data['uid']);   // ( $_REQUEST['visitorID'] ) ;

        if ($ddOrder !== null) {
            echo $ddeliveryUI->onCmsChangeStatus($data['uid'], $post['statusi_new']);
        }
    } catch (\DDelivery\DDeliveryException $e) {
        $ddeliveryUI->logMessage($e);
        echo iconv('UTF-8', 'windows-1251', $e->getMessage());
    }
}

$addHandler = array(
    'actionStart' => 'addDDeliveryPanel',
    'actionDelete' => false,
    'actionUpdate' => 'checkCreateDDelivery'
);
?>