<?php

/**
 * ������ ������ �������
 * @package PHPShopCoreDepricated
 */

// ������� ������
include_once($SysValue['file']['search']);

// ���������� ���������
$SysValue['other']['DispShop']=DisSearch($_REQUEST['words'],$_REQUEST['cat']);

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>