<?php

/**
 * ������ �������
 * @package PHPShopCoreDepricated
 */

// ������� ������ �������
include_once($SysValue['file']['newtip']);

$SysValue['other']['DispShop']=DispNewKratko();

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>	