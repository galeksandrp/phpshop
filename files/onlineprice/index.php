<?php
// ���� �������� ������-����� �� 1�
$c_file='../../UserFiles/Files/price.xls';

if(is_file($c_file)) {
    header('Location: '.$c_file);
    exit();
}
else {
    // ��� ����� ��� ��������������
    $file='price.exe';
    if(file_exists($file)) {
        header("Content-Description: File Transfer");
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename='.$_SERVER['SERVER_NAME'].'.exe');
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '.filesize($file));
        readfile($file);
    }
}
?>