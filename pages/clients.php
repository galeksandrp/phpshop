<?php

/**
 * ���������� ������
 * @package PHPShopCoreDepricated
 */

if($_REQUEST['order'] and $_REQUEST['mail']) {

    // ������� �������� ������ ������������
    include_once($SysValue['file']['clients']);
    include_once($SysValue['file']['usersorders']);

    $SysValue['other']['formaContent']=ClientsCheck($_REQUEST['order'],$_REQUEST['mail']);
}
else {
    $SysValue['other']['formaContent']=ParseTemplateReturn($SysValue['templates']['clients_forma']);
}

$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['clients_page_list']);

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>