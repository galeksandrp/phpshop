<?php

/**
 * ��������� ���� ��������
 * @param array $obj ������
 */
function index_flash_hook($obj) {
    $obj->background=false;
}





$addHandler=array
        (
        'index'=>'index_flash_hook'
);

?>
