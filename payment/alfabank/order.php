<?php
/**
 * ���������� ������ ������ ����� Robox
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));


	$out_summ = $GLOBALS['SysValue']['other']['total']*$SysValue['roboxchange']['mrh_kurs']; //����� �������
	$out_summ = number_format($out_summ, 2, '', '');

	// ����� HTML �������� � ������� ��� ������
	$disp= '
	<div align="center">
<h4>
����� ������ �������� ����, �� ��������� � ���� ������ ����������� ������, ��� ��� ����� ���������� �������� ����� ������� Visa, MasterCard.
</h4>

	<form method="post" action="/payment/alfabank/result.php">
	<input type="hidden" name="orderNumber" value="'.$_POST['ouid'].'">
	<input type="hidden" name="amount" value="'.$out_summ.'">
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-credit-card"></span> �������� ������</button>
	</form>
	';


?>