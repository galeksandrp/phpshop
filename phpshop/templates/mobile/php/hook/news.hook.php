<?php

/**
 * ��������� ���-�� �������� �� ������� ��������
 * @param array $obj ������
 * @param array $row ������ ������
 * @param string $rout ������ ����� ������ ������ [START|MIDDLE|END]
 */
function index_hook($obj,$row,$rout) {

    if($rout == 'START')
    $obj->num_row=300;
}



$addHandler=array
        (
        'index'=>'index_hook',
);

?>