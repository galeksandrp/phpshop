<?php
 /*
 ***** 
 * ������ "�����-������" ��� PHPShop Enterprise 3.6
 * Copyright � WEB for ALL, 20010-2014 
 * @author "WEB for ALL" (www.web4.su) 
 * @version 1.0
 *****
 */
 /*
 * HOOK - ���������� ������� �� �����-������
 */
function cid_product_w4asmartfilter_hook($obj, $dataArray, $rout) {
	
	if($rout=='END'){
		$disp = '<div style="padding:5px 0 10px 10px; width:140px;"><a href="/smart/">����������� ������</a></div>';

        // ������������ ���������� �������
        $obj->set('vendorSelectDisp',$disp.$GLOBALS['SysValue']['other']['vendorSelectDisp']);
	}
}

$addHandler = array
    (
    'CID_Product' => 'cid_product_w4asmartfilter_hook'
);
?>
