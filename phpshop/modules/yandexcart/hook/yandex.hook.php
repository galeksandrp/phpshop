<?php

function setProducts_yandexcart_hook($obj, $data) {
    $add = $list = $vemdorSort = null;

    // ��������������
    if (!empty($obj->vendor) or !empty($obj->param)) {

        if (is_array($data['val']['vendor_array']))
            foreach ($data['val']['vendor_array'] as $v) {

                // Vendor
                if ($obj->brand_array[$v[0]] != "") {
                    $add.='<vendor>' . $obj->brand_array[$v[0]] . '</vendor>';
                    $vemdorSort = true;
                }

                // Param
                if ($obj->param_array[$v['name']] != "" and $obj->param_array[$v[0]]['yandex_param_unit'] != "")
                    $add.='<param name="' . $obj->param_array[$v[0]]['param'] . '" unit="' . $obj->param_array[$v[0]]['yandex_param_unit'] . '">' . $obj->param_array[$v[0]]['name'] . '</param>';
                elseif ($obj->param_array[$v[0]]['param'] != "")
                    $add.='<param name="' . $obj->param_array[$v[0]]['param'] . '">' . $obj->param_array[$v[0]]['name'] . '</param>';
            }
    }

    // Vendor �� �������� ������
    if (empty($vemdorSort) and !empty($data['val']['vendor_name']))
        $add.='<vendor>' . $data['val']['vendor_name'] . '</vendor>';

    // ������
    if (!empty($data['val']['group_id'])) {

        // ������
        if (!empty($data['val']['size']))
            $add.='<param name="������" unit="RU">' . $data['val']['size'] . '</param>';

        // ����
        if (!empty($data['val']['color']))
            $add.='<param name="����">' . $data['val']['color'] . '</param>';
    }

    // Oldprice
    if (!empty($data['val']['oldprice']))
        $data['xml'] = str_replace('<price>' . $data['val']['price'] . '</price>', '<price>' . $data['val']['price'] . '</price><oldprice>' . $data['val']['oldprice'] . '</oldprice>', $data['xml']);


    // ��������
    if ($data['val']['delivery'] == 1)
        $add.='<delivery>true</delivery>';
    else
        $add.='<delivery>false</delivery>';

    $i = 0;
    $delivery = $GLOBALS['delivery'];
    if (is_array($delivery)) {
        foreach ($delivery as $row) {
            if ($i < 5) {
                if ($data['val']['p_enabled'] == 'true')
                    $list.='<option cost="' . $row['price'] . '" days="' . $row['yandex_day_min'] . '-' . $row['yandex_day'] . '" order-before="' . $row['yandex_order_before'] . '"/>';
                else
                    $list.='<option cost="' . $row['price'] . '" days=""/>';
            }
            else
                continue;
            $i++;
        }
    }

    if (!empty($list))
        $add.='<delivery-options>' . $list . '</delivery-options>';

    // Pickup
    if ($data['val']['pickup'] == 1)
        $add.='<pickup>true</pickup>';
    else
        $add.='<pickup>false</pickup>';

    // Store
    if ($data['val']['store'] == 1)
        $add.='<store>true</store>';
    else
        $add.='<store>false</store>';

    // Notes
    if (!empty($data['val']['sales_notes']))
        $add.='<sales_notes>' . $data['val']['sales_notes'] . '</sales_notes>';

    // ��������
    if ($data['val']['manufacturer_warranty'] == 1)
        $add.='<manufacturer_warranty>true</manufacturer_warranty>';

    // ������
    if (!empty($data['val']['country_of_origin']))
        $add.='<country_of_origin>' . $data['val']['country_of_origin'] . '</country_of_origin>';

    // Adult
    if ($data['val']['adult'] == 1)
        $add.='<adult>true</adult>';

    // min-quantity
    if (!empty($data['val']['yandex_min_quantity']))
        $add.='<min-quantity>' . $data['val']['yandex_min_quantity'] . '</min-quantity>';

    // step-quantity
    if (!empty($data['val']['yandex_step_quantity']))
        $add.='<step-quantity>' . $data['val']['yandex_step_quantity'] . '</step-quantity>';

    // weight
    if (!empty($data['val']['weight']))
        $add.='<weight>' . round($data['val']['weight'] / 1000, 3) . '</weight>';

    // rec
    if (!empty($data['val']['rec']))
        $add.='<rec>' . $data['val']['rec'] . '</rec>';

    // vendorCode
    if (!empty($data['val']['vendor_code']))
        $add.='<vendorCode>' . $data['val']['vendor_code'] . '</vendorCode>';
    
    // condition
    if ($data['val']['condition'] > 1 and !empty($data['val']['condition_reason'])){
        
        if($data['val']['condition'] == 2)
            $condition='likenew';
        else $condition='used';
        
        $add.='<condition type="'.$condition.'"><reason>'.$data['val']['condition_reason'].'</reason></condition>';
    }
    

    if (!empty($add))
        $data['xml'] = str_replace('</offer>', $add . '</offer>', $data['xml']);

    return $data['xml'];
}

function setDelivery_yandexcart_hook($obj, $data) {

    // ��������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
    $delivery = $PHPShopOrm->select(array('price', 'yandex_day', 'yandex_day_min', 'yandex_order_before'), array('enabled' => "='1'", 'is_folder' => "!='1'", 'yandex_enabled' => "='2'", 'yandex_check' => "='2'", 'yandex_type' => "='1'"), false, array('limit' => 300));
    $GLOBALS['delivery'] = $delivery;

    /*
      if (!empty($delivery))
      $data['xml'] = str_replace('<local_delivery_cost>' . $data['val']['price'] . '</local_delivery_cost>', '<delivery-options/>', $data['xml']); */

    // ������
    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->sql = 'SELECT b.id, b.name FROM ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a LEFT JOIN ' . $GLOBALS['SysValue']['base']['sort'] . ' AS b ON a.id = b.category where a.brand="1" limit 1000';
    $vendor = $PHPShopOrm->select();
    if (is_array($vendor)) {
        $obj->vendor = true;
        foreach ($vendor as $brand) {
            $obj->brand_array[$brand['id']] = $brand['name'];
        }
    }

    // ���������
    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->sql = 'SELECT a.yandex_param_unit,a.name as param, b.id, b.name FROM ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a LEFT JOIN ' . $GLOBALS['SysValue']['base']['sort'] . ' AS b ON a.id = b.category where a.yandex_param="2" and a.brand!="1" limit 1000';
    $param = $PHPShopOrm->select();
    if (is_array($param)) {
        $obj->param = true;
        foreach ($param as $par) {
            $obj->param_array[$par['id']] = $par;
        }
    }

    return $data['xml'];
}

function PHPShopYml_yandexcart_hook($obj) {

        // ��������� ������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['yandexcart']['yandexcart_system']);
        $option = $PHPShopOrm->select();

        // ������
        if (!empty($option['password']))
            if ($_GET['pas'] != $option['password'])
                exit('Login error!');
    }

$addHandler = array
    (
    'setProducts' => 'setProducts_yandexcart_hook',
    'setDelivery' => 'setDelivery_yandexcart_hook',
    '__construct' => 'PHPShopYml_yandexcart_hook'
);
?>