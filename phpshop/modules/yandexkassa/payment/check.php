<?php

/**
 * ���������� ���������� � ������� ������.�����
 * @author PHPShop Software
 * @version 1.1
 */
session_start();

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
include_once($_classPath . "modules/yandexkassa/class/YandexKassa.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("lang");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("file");
PHPShopObj::loadClass("xml");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("payment");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("system");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

$PHPShopModules = new PHPShopModules($_classPath . "modules/");
$PHPShopModules->checkInstall('yandexkassa');

class Payment extends PHPShopPaymentResult {

    /** @var YandexKassa */
    private $YandexKassa;

    function __construct() {
        $this->option();
        parent::__construct();
    }

    /**
     * ��������� ������ 
     */
    function option() {

        $this->payment_name = 'Yandexkassa';
        $this->log = true;

        $this->YandexKassa = new YandexKassa();
    }

    /**
     * ���������� ������ �� ������ 
     */
    function updateorder() {

        // �� �������� ����������� ����������� (� ����� api ��� �������) � ������ ��������� ������ � ������.
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $order = $this->YandexKassa->getOrderStatus($requestBody['object']['id']);
        $log = $this->YandexKassa->findLogDataByYandexId($order['id']);

        if(isset($order['paid']) && ($order['paid'] == true || $order['paid'] == 1)) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
            $PHPShopOrm->debug = false;
            $row = $PHPShopOrm->getOne(array('id', 'uid'), array('id' => "='" . $log['order_id'] . "'"));
            if (!empty($row['id'])) {
                // ��� �����
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment']);
                $PHPShopOrm->insert(array('uid_new' => str_replace('-', '', $row['uid']), 'name_new' => $this->payment_name,
                    'sum_new' => $order['amount']['value'], 'datas_new' => time()));

                // ��������� ������� �������
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
                $PHPShopOrm->debug = false;
                $PHPShopOrm->update(array('statusi_new' => $this->set_order_status_101(), 'paid_new' => 1), array('id' => '="' . $row['id'] . '"'));

                $this->YandexKassa->log($order, $row['id'], '����� �������, ������ ������ �������', '����������� ������.�����');
            } else {
                $this->YandexKassa->log($order, $log['order_id'], '����� �� ������', '����������� ������.�����');
            }
        } else {
            $this->YandexKassa->log($order, $log['order_id'], '����� �� �������', '����������� ������.�����');
        }

        header("HTTP/1.0 200");
        exit();
    }
}

new Payment();

?>