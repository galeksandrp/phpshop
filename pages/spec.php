<?php

/**
 * ������ ������ ���������������
 * @package PHPShopCoreDepricated
 */

// ������� ���������������
include_once($SysValue['file']['spec']);

$SysValue['other']['DispShop']=DispSpecKratko();

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>