<?php

/**
 * ��������� ����� ������ � ������ �����
 * @param array $obj ������
 * @param array $row ������ ������
 * @param string $rout ������ ����� ������ ������ [START|MIDDLE|END]
 */
function index_hook($obj,$row,$rout) {
    if($rout == 'START')
    $obj->color='0x0089c0';
}



$addHandler=array
        (
        'index'=>'index_hook',
);

?>
