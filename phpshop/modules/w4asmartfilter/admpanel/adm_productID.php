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
 * ���������� ���������� ������ � ���� �����-�������
 */
	function w4a_smart_filter($data) {
		global $PHPShopGUI;
		
		$Tab10 = '<input type="hidden" name="w4a_prod_id" value="'.$data['id'].'">';
		$w4a_info='			
		<div style="padding: 0 0 15px 0; font-size: 20px; color:#63b6e6; text-align:center;">
								���������� ���������� ���-�������:<br/>
			</div>
			<div style="text-align:center;">
			<a href="http://www.web4.su" target="_blank"  tabindex="1000" title="������� �� ���� ������������"><img style="border:0;width: 180px;" src="http://web4.su/UserFiles/logo_02.png"></a>
			</div>
			<div style="padding: 15px 0 0 0; font-size: 12px;text-align:center;">
								����������� ������������� PHPShop <br/>
			<span style="color:#63b6e6;"> ������, �������, ������, ���������� �<br/>
								��������� ������ ������ ���������  ��� PHPShop</span><br/>
								<a href="http://www.web4.su" target="_blank"  tabindex="1000">������� �� ���� ������������</a>
			</div>
	'; 
		$PHPShopGUI->addTab(array("Smart Filter", $Tab10.$w4a_info, 450));
	}

include_once('../../modules/w4asmartfilter/w4a/w4asmartfilter.free.php');
	
$addHandler = array(
    'actionStart' => 'w4a_smart_filter',
    'actionDelete' => false,
    'actionUpdate' => 'w4a_smart_filter_update'
);
?>