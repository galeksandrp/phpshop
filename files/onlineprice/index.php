<?php
$_classPath="../../phpshop/";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");

// ������ �������
$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini",false);

// ���� �������� ������-����� �� 1�
$c_file='../../UserFiles/Files/price.xls';

if(is_file($c_file)) {
    header('Location: '.$c_file);
    exit();
}
else {
    // ��� ����� ��� ��������������
    
    if($PHPShopBase->getParam('dir.dir') == '')
            $filename=$_SERVER['SERVER_NAME'].'.exe';
    else $filename=$_SERVER['SERVER_NAME'].'#'.str_replace('/','#',$PHPShopBase->getParam('dir.dir')).'.exe';

    $file='price.exe';
    if(file_exists($file)) {
        header("Content-Description: File Transfer");
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename='.$filename);
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '.filesize($file));
        readfile($file);
    }
}
?>