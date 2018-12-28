<?php
/**
 * Redirect �� seo �������� �������
 */
function v_hook($obj, $data, $rout){

    if($rout == "START"){

        // ��������� ������
        include_once(dirname(__FILE__) . '/mod_option.hook.php');
        $PHPShopSeourlOption = new PHPShopSeourlOption();
        $seourl_option = $PHPShopSeourlOption->getArray();

        if($seourl_option["seo_brands_enabled"] == 2){

            if (!empty($_REQUEST['v'])){

                foreach ($_REQUEST['v'] as $key => $value) {

                    if (PHPShopSecurity::true_num($key) and PHPShopSecurity::true_num($value)) {

                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                        $vendorCategory = $PHPShopOrm->select(array("*"), array("id=" => $key));

                        if($vendorCategory["brand"] == 1) {

                            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                            $vendor = $PHPShopOrm->select(array("*"), array("id=" => $value));

                            if(!empty($vendor["sort_seo_name"])){
                                header('Location: ' . $obj->getValue('dir.dir') . "/brand/" . $vendor["sort_seo_name"] . '.html', true, 301);

                                return true;

                            } else {
                                $seoUrl = $GLOBALS['PHPShopSeoPro']->setLatin($vendor['name']);
                                $PHPShopOrm->update(array("sort_seo_name_new" => "$seoUrl"), array('id' => '=' . $vendor['id']));
                            }
                        }
                    }
                }
                header('Location: ' . $obj->getValue('dir.dir') . "/brand/". $seoUrl . '.html', true, 301);

                return true;
            }
        }
    }
}

$addHandler = array('v' => 'v_hook');