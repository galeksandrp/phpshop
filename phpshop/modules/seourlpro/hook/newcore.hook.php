<?php

/**
 * ���������� SEO ������ � �������� � ������
 */
function index_seourl_hook($obj,$row,$rout) {
    if($rout == 'MIDDLE')
    $obj->set('nameLat',$GLOBALS['seourl_pref'].PHPShopString::toLatin($row['zag']));
}

/**
 * �������� ������������ SEO �������
 */
function ID_seourl_hook($obj, $row, $rout) {
    if ($rout == 'END') {
        $url = $obj->PHPShopNav->getName(true);

        $url_true = '/news/ID_' . $obj->PHPShopNav->getId() . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['zag']);
        $url_pack = '/news/ID_' . $obj->PHPShopNav->getId();

        
        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->set('newsZag', __('������ 404'));
            $obj->setError404();
        }
        elseif($url == $url_pack){
            header('Location: ' . $obj->getValue('dir.dir') . $url_true. '.html', true, 301);
            return true;
        }
    }
}


$addHandler = array(
    'ID' => 'ID_seourl_hook',
    'index'=>'index_seourl_hook'
);
?>
