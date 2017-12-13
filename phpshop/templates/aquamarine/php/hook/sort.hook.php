<?php

/**
 * ����� �������� ��������������
 */
function UID_addseamplysort_hook($obj, $row, $rout) {

    if ($rout == 'MIDDLE') {
        PHPShopObj::loadClass('sort');
        $search = new PHPShopSortSearch('��� ��������');
        $obj->set('addseamplysort', $search->search(unserialize($row['vendor_array'])));
    }
}

/**
 * ����� ������������� � ������� ��������  ������
 */
function checkStore_add_sorttable_hook($obj, $row) {
    if (empty($obj->category)) {
        $obj->PHPShopCategory = new PHPShopCategory($row['category']);
    }
    $obj->doLoadFunction('PHPShopShop', 'sort_table', $row, 'shop');
    return true;
}

$addHandler = array
    (
    '#UID' => 'UID_addseamplysort_hook',
    'checkStore' => 'checkStore_add_sorttable_hook'
);
?>
