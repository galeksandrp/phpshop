<?php

/**
 * ������ ������� ������� �� ���������� � ���������
 * @package PHPShopCoreDepricated
 */

// ������� ������� ������
include_once($SysValue['file']['selection']);

// ���������� ���������
$SysValue['other']['DispShop']=DispSelectionCat();


// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>