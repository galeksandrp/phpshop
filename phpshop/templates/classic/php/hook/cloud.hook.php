<?php

/**
 * ��������� ����� ������ � ������ �����
 * @param array $obj ������
 * @param array $row ������ ������
 * @param string $rout ������ ����� ������ ������ [START|MIDDLE|END]
 */
function index_hook($obj,$row,$rout) {
    if($rout == 'START')
    $obj->color='0x2D485A';
}



$addHandler=array
        (
        'index'=>'index_hook',
);

?>
