<?php

/**
 * ���������� SEO ������ � �������� �� �������
 */
function index_newselement_seourl_hook($obj,$row,$rout) {
    if($rout == 'END')
    $obj->set('nameLat',$GLOBALS['seourl_pref'].PHPShopString::toLatin($row['zag']));
}

$addHandler=array
        (
        'index'=>'index_newselement_seourl_hook'
);


?>