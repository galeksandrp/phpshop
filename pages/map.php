<?php
/**
 * ������ ����� �����
 * @package PHPShopCoreDepricated
 */

// ������� ����� �����
include_once($SysValue['file']['map']);

// ���������� ���������
$SysValue['other']['DispShop']=Vivod_map();

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>