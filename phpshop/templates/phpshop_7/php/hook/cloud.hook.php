<?php

/**
 * ��������� ����� ������ � ������ �����
 * @param array $obj ������
 * @param array $row ������ ������
 * @param string $rout ������ ����� ������ ������ [START|MIDDLE|END]
 */
function index_hook($obj,$row,$rout) {
    if($rout == 'START')
    $obj->color='0x9A4DE1';
}



$addHandler=array
        (
        'index'=>'index_hook',
);

?>
