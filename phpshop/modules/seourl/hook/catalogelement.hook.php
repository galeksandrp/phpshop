<?php

/**
 * SEO ������ ��� ������� ���������
 */
function template_cat_table_seourl_hook($obj, $val) {
    return PHPShopText::a('/shop/CID_' . $val['id'] . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($val['name']) . '.html', $val['name'], $val['name']) . ' | ';
}

/**
 * SEO ������ ��� �������� ��������� ��������
 */
function leftCatal_seourl_hook($obj, $row, $rout) {
    if ($rout == 'END') {
        $obj->set('nameLat', $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']));
    }
}

/**
 * SEO ������ ��� �������� ��������� �����������
 */
function subcatalog_seourl_hook($obj, $row) {
        $obj->set('nameLat', $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']));

}

$addHandler = array
    (
    'template_cat_table' => 'template_cat_table_seourl_hook',
    'leftCatalTable' => 'leftCatal_seourl_hook',
    'leftCatal' => 'leftCatal_seourl_hook',
    'subcatalog'=>'subcatalog_seourl_hook'
);
?>