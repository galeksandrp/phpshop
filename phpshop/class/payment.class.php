<?php

/**
 * ���������� ������ �� ������� ������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopObj
 */
class PHPShopPayment extends PHPShopObj {

    var $debug = false;

    /**
     * �����������
     * @param int $objID �� ������ ������
     */
    function PHPShopPayment($objID) {
        $this->objID = $objID;
        $this->order = array('order' => 'num');
        $this->objBase = $GLOBALS['SysValue']['base']['payment_systems'];
        parent::PHPShopObj();
    }

    /**
     * ��� ������ ������
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    function getPath() {
        return parent::getParam("path");
    }

    /**
     * �� ������
     * @return int
     */
    function getId() {
        return parent::getParam("id");
    }

}

/**
 * ������ �������� �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopPaymentArray extends PHPShopArray {

    function PHPShopPaymentArray() {
        $this->order = array('order' => 'num');
        $this->objBase = $GLOBALS['SysValue']['base']['payment_systems'];
        parent::PHPShopArray('id', "name", 'path', 'enabled', 'yur_data_flag','icon');
    }

}

/**
 * ���������� ������ �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopPaymentResult {

    /**
     * �������
     * @var bool 
     */
    var $debug = false;
    /**
     * ������ ������� ������
     * @var bool 
     */
    var $log = false;

    function PHPShopPaymentResult() {
        global $_classPath;

        // ����� ��� �����
        $this->log_file = dirname(__FILE__) . $_classPath . 'payment/paymentlog.log';

        // ���������
        //$this->option();

        $this->updateorder();
    }

    /**
     * ��������� ������ 
     */
    function option() {
        $this->payment_name = 'Liqpay';
        include_once(dirname(__FILE__) . '/../hook/mod_option.hook.php');
        $this->option = new PHPShopLiqpayArray();
    }

    /**
     * �������� �������
     * @return boolean 
     */
    function check() {
        $xml = base64_decode($_REQUEST['operation_xml']);
        $this->result_var = readDatabase($xml, 'response', false);

        // ������ ��������
        if ($this->result_var['status'] == 'success') {
            $this->out_summ = $this->result_var['amount'];
            $this->inv_id = $this->true_num($this->result_var['order_id']);
            $this->crc = $_REQUEST['signature'];
            $this->my_crc = base64_encode(sha1($this->option['merchant_sign'] . $_REQUEST['operation_xml'] . $this->option['merchant_sign'], 1));
            return true;
        }
    }

    /**
     * ������� ���������� ������� 
     */
    function done() {
        echo "OK" . $this->inv_id . "\n";
        $this->log();
    }

    /**
     * ������ 
     */
    function error($type = 1) {
        if ($type == 1)
            echo "bad order num\n";
        else
            echo "bad sign\n";
        $this->log();
    }

    /**
     * �������� ������� ����������� ������ ����� ��������� �����
     */
    function set_order_status_101() {

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['order_status']);
        $PHPShopOrm->debug = $this->debug;
        $data = $PHPShopOrm->select(array('id'), array('id' => '=101'), false, array('limit' => 1));

        if (!is_array($data)) {
            $PHPShopOrm->clean();
            $PHPShopOrm->insert(array('id_new' => 101, 'name_new' => __('�������� ���������� ���������'), 'color_new' => '#ccff00'));
        }
        return 101;
    }

    /**
     * ���������� ������ �� ������ 
     */
    function updateorder() {

        if ($this->check()) {

            // ��������� ���. ������
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
            $PHPShopOrm->debug = $this->debug;
            $row = $PHPShopOrm->select(array('uid'), array('uid' => "='" . $this->inv_id . "'"), false, array('limit' => 1));
            if (!empty($row['uid'])) {

                // ��� �����
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment']);
                $PHPShopOrm->insert(array('uid_new' => $this->result_var['order_id'], 'name_new' => $this->payment_name,
                    'sum_new' => $this->out_summ, 'datas_new' => time()));

                // ��������� ������� �������
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
                $PHPShopOrm->debug = $this->debug;
                $PHPShopOrm->update(array('statusi_new' => $this->set_order_status_101()), array('uid' => '="' . $this->true_num($this->inv_id) . '"'));

                // ��������� ��
                $this->done();
            }
            else
                $this->error();
        }
        else
            $this->error(2);
    }

    /**
     * ������ ���� � ���� 
     */
    function log() {

        if (empty($this->log))
            return '������ ������� ����� ���������';

        if (!empty($this->inv_id)) {
            $content = "
  " . $this->payment_name . " Payment Start ------------------
  date=" . date("F j, Y, g:i a") . "
  out_summ=" . $this->out_summ . "
  inv_id=" . $this->inv_id . "
  crc=" . $this->crc . "
  my_crc=" . $this->my_crc . "
  REQUEST_URI=" . $_SERVER['REQUEST_URI'] . "
  IP=" . $_SERVER['REMOTE_ADDR'] . "
  " . $this->payment_name . " Payment End --------------------
  ";
        } else {
            // ������ �������

            if (is_array($_REQUEST))
                foreach ($_REQUEST as $k => $v) {
                    $content.=$k . '=' . $v . '
';
                }

            $content = "
  " . $this->payment_name . " Payment Start ------------------
  " . $content . " 
  " . $this->payment_name . " Payment End --------------------
  ";
        }

        PHPShopFile::chmod($this->log_file, false);
        PHPShopFile::write($this->log_file, $content, 'a+', true);
    }

    /**
     * �������������� ������ ������
     * @param Int $uid
     * @return string 
     */
    function true_num($uid) {
        $last_num = substr($uid, -2);
        $total = strlen($uid);
        $first_num = substr($uid, 0, ($total - 2));
        return $first_num . "-" . $last_num;
    }

}

?>