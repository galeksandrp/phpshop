<?php

// ��������� �������� � ������� actionStart
function addSeoUrlPro($data) {
    global $PHPShopGUI;

    // �������� �������
    if (isset($data['cat_seo_name'])) {

        if (empty($data['cat_seo_name'])) {
            PHPShopObj::loadClass("string");
            $data['cat_seo_name'] = PHPShopString::toLatin($data['name']);
            $data['cat_seo_name'] = str_replace("_", "-", $data['cat_seo_name']);
        }

        // ���������� /cat/ ��� ������� ������
        $true_link = str_replace('cat/', '', $data['cat_seo_name']);
        if (stristr($true_link, '/')) {
            $data['cat_seo_name'] = 'cat/' . $true_link;
        }


        $Tab3 = $PHPShopGUI->setField("SEO ������:", $PHPShopGUI->setInput("text", "cat_seo_name_new", $data['cat_seo_name'], "left", false, false, false, false, '/',  '.html'), 1, '����� ������������ ��������� ������ /sony/plazma/televizor');

        $PHPShopGUI->addTab(array("SEO", $Tab3, 450));
    }
    // ������� �������
    elseif (isset($data['page_cat_seo_name'])){

        if (empty($data['page_cat_seo_name']))
            $data['news_seo_name'] = PHPShopString::toLatin($data['name']);

        $Tab3 = $PHPShopGUI->setField("SEO ������:", $PHPShopGUI->setInput("text", "page_cat_seo_name_new", $data['page_cat_seo_name'], "left", false, false, false, false, '/',  '.html'), 1);

        $PHPShopGUI->addTab(array("SEO", $Tab3, 450));
    }
}

$addHandler = array(
    'actionStart' => 'addSeoUrlPro',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>