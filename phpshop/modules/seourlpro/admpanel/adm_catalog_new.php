<?php

// ��������� ������
class PHPShopSeourlOption extends PHPShopArray {

    function __construct() {
        $this->objType = 3;
        $this->checkKey = true;

        // ������ ��������
        $this->memory = __CLASS__;

        $this->objBase = $GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'];
        parent::__construct('redirect_enabled');
    }

}

// ��������� �������� � ������� actionStart
function addSeoUrlPro($data) {
    global $PHPShopGUI;

    $PHPShopNav = new PHPShopNav();
    $PHPShopSeourlOption = new PHPShopSeourlOption();

    // �������� �������
    if ($PHPShopNav->objNav['query']['path'] == 'catalog') {

        // ���������� /cat/ ��� ������� ������
        $true_link = str_replace('cat/', '', $data['cat_seo_name']);
        if (stristr($true_link, '/')) {
            $data['cat_seo_name'] = 'cat/' . $true_link;
        }

        $Tab3 = $PHPShopGUI->setField("SEO ������:", $PHPShopGUI->setInput("text", "cat_seo_name_new", $data['cat_seo_name'], "left", false, false, false, false, '/', '.html'), 1, '����� ������������ ��������� ������ /sony/plazma/televizor');

        if ($PHPShopSeourlOption->getParam('redirect_enabled') == 2)
            $Tab3.= $PHPShopGUI->setField("������ ������:", $PHPShopGUI->setInput("text", "cat_seo_name_old_new", $data['cat_seo_name_old'], "left", false, false, false,false), 1, '������ ������ ��� 301 ���������');

        $PHPShopGUI->addTab(array("SEO", $Tab3, 450));
    }
    // �������� �������
    elseif ($PHPShopNav->objNav['query']['path'] == 'page.catalog') {

        if (empty($data['page_cat_seo_name']))
            $data['news_seo_name'] = PHPShopString::toLatin($data['name']);

        $Tab3 = $PHPShopGUI->setField("SEO ������:", $PHPShopGUI->setInput("text", "page_cat_seo_name_new", $data['page_cat_seo_name'], "left", false, false, false, false, $_SERVER['SERVER_NAME'].'/', '.html'), 1);

        if ($PHPShopSeourlOption->getParam('redirect_enabled') == 2)
            $Tab3.= $PHPShopGUI->setField("������ ������:", $PHPShopGUI->setInput("text", "cat_seo_name_old_new", $data['cat_seo_name_old'], "left", false, false, false,false), 1, '������ ������ ��� 301 ���������');

        $PHPShopGUI->addTab(array("SEO", $Tab3, 450));
    }
}

$addHandler = array(
    'actionStart' => 'addSeoUrlPro',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>