<?php


function index_nt_hook($obj, $dataArray, $rout) {

    if ($rout == 'START') {
        $obj->set('UidLeftColHide','span12');
    }
}

/**
 * ���������� � ������ ��������� ��������������� ������� � 3 ������, ����� 3
 */
$addHandler = array
    (
    'index' => 'index_nt_hook'
);
?>