<?php

/**
 * ���������� ���������� � ������� Robokassa
 */
session_start();

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("file");
PHPShopObj::loadClass("xml");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("payment");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("system");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini", true, true);

$PHPShopModules = new PHPShopModules($_classPath . "modules/");
$PHPShopModules->checkInstall('robokassa');

class Payment extends PHPShopPaymentResult {

    function __construct() {

        $this->option();
        parent::__construct();
    }

    /**
     * ��������� ������ 
     */
    function option() {
        $this->payment_name = 'Robokassa';
        include_once('../hook/mod_option.hook.php');
        $this->PHPShopRobokassaArray = new PHPShopRobokassaArray();
        $this->option = $this->PHPShopRobokassaArray->getArray();
    }

    /**
     * �������� �������
     * @return boolean 
     */
    function check() {
        $data_return = $_REQUEST;

        $this->my_crc = strtoupper(md5($data_return['out_summ'] . ':' . $data_return['inv_id'] . ':' . $this->option['merchant_skey']));
        $this->crc = strtoupper($data_return['crc']);
        $this->out_summ = $data_return['out_summ'];
        $this->inv_id = $data_return['inv_id'];

        if ($this->my_crc == $this->crc) {
            return true;
        }
    }

    function updateorder() {

        if ($this->check()) {

            // ��������� ���. ������
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
            $PHPShopOrm->debug = $this->debug;
            $row = $PHPShopOrm->select(array('uid'), array('uid' => "='" . $this->true_num($this->inv_id) . "'"), false, array('limit' => 1));
            if (!empty($row['uid'])) {

                // ��� �����
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment']);
                $PHPShopOrm->insert(array('uid_new' => $this->inv_id, 'name_new' => $this->payment_name,
                    'sum_new' => $this->out_summ, 'datas_new' => time()));

                // ��������� ������� �������
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
                $PHPShopOrm->debug = $this->debug;

                $PHPShopOrm->update(array('statusi_new' => $this->set_order_status_101()), array('uid' => '="' . $this->true_num($this->inv_id) . '"'));

                // ������ � ���
                $this->PHPShopRobokassaArray->log($_REQUEST, $this->inv_id, '����� ������, ������ ������, ������ � ��� ����������� �������� ��������', '������ Result c ������� ���������');

                // ��������� ��
                $this->done();
            } else {

                // ������ � ���
                $this->PHPShopRobokassaArray->log($_REQUEST, $this->inv_id, '������ �������, ������ �� ����������', '������ Result c ������� ���������');

                $this->error();
            }
        } else {

            // ������ � ���
            $this->PHPShopRobokassaArray->log($_REQUEST, $this->inv_id, '������ �������� md5', '������ Result c ������� ���������');

            $this->error(2);
        }
    }

}

new Payment();
?>
