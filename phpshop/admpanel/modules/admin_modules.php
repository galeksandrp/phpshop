<?php

// ���������
$TitlePage = __("������");

// ���������� JS ����������
//$addJS = null;

function actionStart() {
    $PHPShopIframePanel = new PHPShopIframePanel(array('modules/tree.php', 300, "90%", 'frame1'), array('modules/admin_modules_content.php?pid='.$_REQUEST['var2'], '100%', "95%", 'frame2'));
    $PHPShopIframePanel->title = __('������');
    $PHPShopIframePanel->button_tree_control = false;
    $PHPShopIframePanel->Compile();
}

?>