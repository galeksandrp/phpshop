<?php
/**
 * ������ �������� ����� ������
 * @package PHPShopCoreDepricated
 */

// ������� ������ ��� ������
include_once($SysValue['file']['print']);

if($SysValue['nav']['nav']=="UID") DispPrint($SysValue['nav']['id']);
else include("pages/error.php");
?>	