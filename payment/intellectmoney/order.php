<?php
/**
 * ���������� ������ ������ ����� IntellectMoney
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopPayment
 */
if (empty($GLOBALS['SysValue']))
    exit(header("Location: /"));


// ��������������� ����������
$LMI_PAYEE_PURSE = $SysValue['intellectmoney']['LMI_PAYEE_PURSE'];    //�������
//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0] . "" . $mrh_ouid[1];     //����� �����
//�������� �������
$inv_desc = "������ ������ �$inv_id";
$out_summ = $GLOBALS['SysValue']['other']['total'] * $SysValue['webmoney']['kurs']; //����� �������


$url = ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
$success_url = "$url/success/?LMI_PAYMENT_NO=" . $inv_id . '&payment=intellectmoney';
$fail_url = "$url/fail/";


// ����� HTML �������� � ������� ��� ������
$disp = "
<div align='center'>
	<p><img src='https://eshop.intellectmoney.ru/common/img/uploaded/banners/intellectmoney_logo_117x75.png' width='117' height='75' border='0'></p>
	<p><br></p>
	
	<form id=pay name=pay method='POST' action='https://merchant.intellectmoney.ru/ru/' name='pay'>
		<input type=hidden name=LMI_PAYMENT_AMOUNT value='$out_summ'>
		<input type=hidden name=LMI_PAYMENT_DESC value='$inv_desc'>
		<input type=hidden name=LMI_PAYMENT_NO value='$inv_id'>
		<input type=hidden name=LMI_PAYEE_PURSE value='$LMI_PAYEE_PURSE'>
		<input type=hidden name=LMI_SIM_MODE value='0'>
		<input type=hidden name=LMI_SUCCESS_URL value='$success_url'>
		<input type=hidden name=LMI_FAIL_URL value='$fail_url'>
		<table>
			<tr>
				<td>
					<img src='images/shop/icon-client-new.gif' alt='' width='16' height='16' border='0' align='left'>
					<a href='javascript:pay.submit();'>�������� ����� ��������� �������</a>
				</td>
			</tr>
		</table>
	</form>
</div>";
?>