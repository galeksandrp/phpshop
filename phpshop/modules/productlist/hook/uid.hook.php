<?php

class PHPShopProductListElement extends PHPShopElements {

    function __construct() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['productlist']['productlist_system'];
        $this->option();
        parent::__construct();
    }

    function option() {
        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $this->data = $PHPShopOrm->select();
        if ($this->data['num'] < 1)
            $this->data['num'] = 1;
    }

    // �����
    function element($category) {
        $dis = null;

        // ���� ������ SEOURLPRO
        if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system']))
            $seourlpro = true;
        else
            $seourlpro = false;


        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug = $this->debug;

        $data = $PHPShopOrm->select(array('*'), array('category' => '=' . intval($category), 'enabled' => "='1'", 'parent_enabled' => "='0'", 'id' => '!=' . $this->PHPShopNav->getId()), array('order' => 'datas desc'), array('limit' => $this->data['num']));
        if (is_array($data)) {
            foreach ($data as $row) {

                $this->set('productlist_product_id', $row['id']);
                $this->set('productlist_product_name', $row['name']);
                $this->set('productlist_product_pic_small', $row['pic_small']);
                $this->set('productlist_product_pic_big', $row['pic_big']);
                $this->set('productlist_product_price', $row['price']);

                // ���� ������ SEOURLPRO
                if ($seourlpro) {

                    if (empty($row['prod_seo_name']))
                        $url = '/id/' . str_replace("_", "-", PHPShopString::toLatin($row['name'])) . '-' . $row['id'];
                    else
                        $url = '/id/' . $row['prod_seo_name'] . '-' . $row['id'];

                    PHPShopParser::set('productlist_product_url', $url);
                }
                else {
                    $url = '/shop/UID_' . $row['id'];
                    PHPShopParser::set('productlist_product_url', $url);
                }


                $dis.= PHPShopParser::file($GLOBALS['SysValue']['templates']['productlist']['productlist_product'], true, false, true);
  
            }

             $this->set('productlist_list', $dis, true);

            // ��������� ���������� �������
            switch ($this->data['enabled']) {

                case 1:
                    $this->set('leftMenuName', $this->data['title']);
                    $product = PHPShopParser::file($GLOBALS['SysValue']['templates']['productlist']['productlist_forma'], true, false, true);
                    $this->set('leftMenuContent', $product);
                    $this->set('leftMenu', parseTemplateReturn("main/left_menu.tpl"), true);
                    break;

                case 2:
                    $this->set('rightMenuName', $this->data['title']);
                    $product = PHPShopParser::file($GLOBALS['SysValue']['templates']['productlist']['productlist_forma'], true, false, true);
                    $this->set('rightMenuContent', $product);
                    $this->set('rightMenu', parseTemplateReturn("main/left_menu.tpl"), true);
                    break;

                default: $this->set('productlist', $dis);
            }
        }
    }

}

function uid_productlist_hook($obj, $row, $rout) {
    if ($rout == 'MIDDLE') {

        $PHPShopProductListElement = new PHPShopProductListElement();
        $PHPShopProductListElement->element($row['category']);
    }
}

$addHandler = array
    (
    'UID' => 'uid_productlist_hook'
);
?>