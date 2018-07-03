<?php

// ��������� ������
PHPShopObj::loadClass("array");

class PHPShopYandexkassaArray extends PHPShopArray {

    function __construct() {
        $this->objType = 3;
        $this->objBase = $GLOBALS['SysValue']['base']['yandexkassa']['yandexkassa_system'];
        parent::__construct("status", "title", 'title_end', 'merchant_id', 'merchant_sig', 'pay_variants', 'merchant_scid', 'test');
    }

    function get_pay_variants_array($arr = null, $forDoneCore = null) {
        $pay_variants_array['PC'] = array('������ �� �������� � ������.�������', 'PC', '');
        $pay_variants_array['AC'] = array('������ � ������������ ���������� �����', 'AC', '');
        $pay_variants_array['MC'] = array('������ �� ����� ���������� ��������', 'MC', '');
        $pay_variants_array['GP'] = array('������ ��������� ����� ����� � ���������', 'GP', '');
        $pay_variants_array['WM'] = array('������ �� �������� � ������� WebMoney', 'WM', '');
        $pay_variants_array['SB'] = array('������ ����� ��������: ������ �� SMS ��� �������� ������', 'SB', '');
//        $pay_variants_array['MP'] = array('������ ����� ��������� �������� (mPOS).', 'MP', '');
        $pay_variants_array['AB'] = array('������ ����� �����-����', 'AB', '');
        $pay_variants_array['��'] = array('������ ����� MasterPass', '��', '');
        $pay_variants_array['PB'] = array('������ ����� �������������', 'PB', '');
        $pay_variants_array['QW'] = array('QIWI Wallet', 'QW', '');
        $pay_variants_array['KV'] = array('�����������', 'KV', '');

        if (is_array($arr))
            foreach ($arr as $key => $value) {
                $pay_variants_array[$value][2] = $value;
                if ($forDoneCore) {
                    $pay_variants_arrayDone[$value][0] = $pay_variants_array[$value][0];
                    $pay_variants_arrayDone[$value][1] = $pay_variants_array[$value][1];
                    $pay_variants_arrayDone[$value][2] = $pay_variants_array[$value][2];
                }
            }
        if ($forDoneCore)
            return $pay_variants_arrayDone;
        return $pay_variants_array;
    }

    /**
     * ������ ����
     * @param array $message ���������� ������� � �� ��� ���� �������
     * @param string $order_id ����� ������
     * @param string $status ������ ������
     * @param string $type request
     */
    function log($message, $order_id, $status, $type) {

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['yandexkassa']['yandexkassa_log']);
        $log = array(
            'message_new' => serialize($message),
            'order_id_new' => $order_id,
            'status_new' => $status,
            'type_new' => $type,
            'date_new' => time()
        );
        $PHPShopOrm->insert($log);
    }

}

?>
