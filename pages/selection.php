<?php

/**
 * ������ ������� ������� �� ����������
 * @package PHPShopCoreDepricated
 */

// ������� ������� ������
include_once($SysValue['file']['selection']);

// ���������� ���������
$SysValue['other']['DispShop']=DispSelection($_REQUEST['v']);


// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>