<?php

// ���������
$TitlePage = __("������");

// ���������� JS ����������
//$addJS = null;

function actionStart() {
    $PHPShopIframePanel = new PHPShopIframePanel(array('modules/tree.php', 300, 530, 'frame1'), array('modules/admin_modules_content.php?pid='.$_REQUEST['var2'], '100%', 570, 'frame2'));
    $PHPShopIframePanel->title = __('������');
    $PHPShopIframePanel->Compile();
}

?>