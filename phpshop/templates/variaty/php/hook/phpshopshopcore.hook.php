<?php

/**
 * ������ ����� ��� li � ����� ������ ������ � ����������
 */
function product_grid_changeClass_hook($obj) {
    $obj->cell_type_class = 'span3 clearfix';
}

$addHandler = array
    (
    'product_grid' => 'product_grid_changeClass_hook',
);
?>