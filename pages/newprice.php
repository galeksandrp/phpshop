<?php

/**
 * ������ ���������
 * @package PHPShopCoreDepricated
 */

// ������� ������ ���������
include_once($SysValue['file']['newprice']);

$SysValue['other']['DispShop']=DispNewpriceKratko();

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>	