<?php

/**
 * ��������� ����� ������� � ����������������
 * @param array $obj ������
 * @param array $row ������ ������
 * @param string $rout ������ ����� ������ ������ [START|MIDDLE|END]
 */
function v_selection_hook($obj, $row, $rout) {

    if ($rout == 'START') {
        $obj->cell = 2;
    }
}

$addHandler = array
    (
    'v' => 'v_selection_hook',
);
?>