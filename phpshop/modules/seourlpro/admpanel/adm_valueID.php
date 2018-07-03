<?php

function addSeoBrandURL($data) {
    global $PHPShopGUI;

    // ��������� SEO ������ �� �����
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
    $vendorCategory = $PHPShopOrm->select(array("*"), array("id=" => $data["category"]));

    if($vendorCategory["brand"] == 1){
        if(empty($data["sort_seo_name"])) {
            PHPShopObj::loadClass("string");
            $data["sort_seo_name"]=PHPShopString::toLatin($data["name"]);
            $data["sort_seo_name"] = str_replace("_", "-", $data["sort_seo_name"]);
        }

        $PHPShopGUI->_CODE.=$PHPShopGUI->setField("������:", $PHPShopGUI->setInput("text", "sort_seo_name_value", $data['sort_seo_name'], "left", false,false,"form-control",false,'/brand/', '.html'), 1);
    }

}

$addHandler = array(
    'actionValueEdit' => 'addSeoBrandURL',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>