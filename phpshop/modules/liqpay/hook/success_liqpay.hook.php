<?php

function success_mod_liqpay_hook($obj, $value) {
  
    // ����������� ������ � ����������
    parse_str(base64_decode($value['payment']), $value);
	
    if ($value['payment'] == 'liqpay') {
        
        $return=array();
        $return['order_metod']='modules';
        $return['success_function']=false;// �������� ������� ���������� ������� ������
        $return['crc'] = null;
        $return['my_crc'] = null;
        $return['inv_id'] = $value['inv_id'];
        $return['out_summ'] = false;

        return $return;
    }
}

$addHandler = array
    (
    'index' => 'success_mod_liqpay_hook'
);
?>