<?php

/**
 * SEO ������ � ����������
 */
function setPaginator_seourl_hook($obj, $nav, $rout) {
    static $count;
    if ($rout == 'END' and $obj->PHPShopNav->getPath() == 'shop' and empty($count)) {
        $nav = str_replace('.html', $GLOBALS['seourl_pref'] . PHPShopString::toLatin($obj->PHPShopCategory->getName()) . '.html', $nav);
        $obj->set('productPageNav', $nav);
        $count++;
    }
}

/**
 * ���������� SEO ������ � �������
 */
function product_grid_seourl_hook($obj, $row) {
    return $obj->set('nameLat', $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']));
}

$addHandler = array
    (
    'product_grid' => 'product_grid_seourl_hook',
    'setPaginator' => 'setPaginator_seourl_hook'
);
?>