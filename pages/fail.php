<?php
/**
 * ����� ��������� ������ ������ ������
 * @package PHPShopCoreDepricated
 */
$SysValue['other']['orderNum']="Abort Payment";
$SysValue['other']['DispShop']= ParseTemplateReturn("error/error_payment.tpl");

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>