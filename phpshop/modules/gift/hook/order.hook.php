<?php

/**
 * ���������� ��������
 */
function order_gift_hook($obj, $row, $rout) {

    if ($rout == 'START') {

        $cart = $obj->PHPShopCart->getArray();

        foreach ($cart as $prod)
            $id[] = $prod['id'];
        $where = array('id' => ' IN (' . implode(',', $id) . ')');

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $data_product = $PHPShopOrm->select(array('id', 'category', 'price_n', 'gift', 'gift_check', 'gift_items'), $where, false, array('limit' => 300));

        if (is_array($data_product))
            foreach ($data_product as $row) {
                $gift_array = $GLOBALS['PHPShopGift']->getGift($row);

                // ���� �������
                if (is_array($gift_array)) {

                    // ��������� ��������
                    if (strpos($row['gift'], ',')) {
                        $gift_prod_array = explode(",", $row['gift']);
                    } else
                        $gift_prod_array[] = $row['gift'];

                    // A+B
                    if ($gift_array['gift'] == 0) {

                        // ��������� � ������� �������
                        if (is_array($gift_prod_array))
                            foreach ($gift_prod_array as $val) {

                                $PHPShopProduct = new PHPShopProduct($val);
                                if ($PHPShopProduct->getParam('items') > 0 or $obj->PHPShopSystem->getSerilizeParam("admoption.sklad_status") == 1) {
                                    $obj->PHPShopCart->add($val, 1);

                                    // ��������� �������
                                    $obj->PHPShopCart->_CART[$val]['price_n'] = $obj->PHPShopCart->_CART[$val]['price'];
                                    $obj->PHPShopCart->_CART[$val]['price'] = 0;
                                    $obj->PHPShopCart->_CART[$val]['gift'] = $row['id'];
                                    $obj->PHPShopCart->_CART[$val]['num'] = $obj->PHPShopCart->_CART[$row['id']]['num'];
                                }
                            }
                    }
                    // NA+MA
                    else {

                        $int_div = int_div($obj->PHPShopCart->_CART[$row['id']]['num'], $row['gift_check']);
                        if ($int_div > $obj->PHPShopCart->_CART[$row['id']]['gift_check']) {

                            $num = $obj->PHPShopCart->_CART[$row['id']]['num'] + $int_div * $row['gift_items'];
                            $price = $obj->PHPShopCart->_CART[$row['id']]['price'];
                            $sum = $num * $price;

                            $sum_new = $sum - $int_div * $price;
                            $price_new = $sum_new / $num;

                            $obj->PHPShopCart->_CART[$row['id']]['num'] = $num;
                            $obj->PHPShopCart->_CART[$row['id']]['price'] = $price_new;

                            if (empty($obj->PHPShopCart->_CART[$row['id']]['gift_check']))
                                $obj->PHPShopCart->_CART[$row['id']]['price_n'] = $price;

                            $obj->PHPShopCart->_CART[$row['id']]['gift_check'] = int_div($num, $row['gift_check']);
                            $obj->PHPShopCart->_CART[$row['id']]['gift_items'] = $row['gift_check'];
                        }
                    }
                }
            }
    }
}

// ������������� �������
function int_div($a, $b) {
    return ($a - $a % $b) / $b;
}

// �������� ������� ��� �������� ������ � ��������
function id_delete_gift_hook($obj, $row, $rout) {

    foreach ($obj->PHPShopCart->_CART as $k => $v) {

        // A+B
        if (!empty($v['gift']) and ! $obj->PHPShopCart->_CART['gift']) {
            unset($obj->PHPShopCart->_CART[$k]);
        }
    }
}

// �������� ������� ��� ������ ������ � ��������
function id_edit_gift_hook($obj, $row, $rout) {

    
    if (!empty($_POST['edit_num'])) {
        if ($_POST['edit_num'] == 'minus')
            $_POST['num_new']--;
        else
            $_POST['num_new']++;
    } 
    
    // ���� ����� � ����� gift_check
    if(!empty($obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_items']) and $_POST['num_new'] % $obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_items'] == 0 and $_POST['edit_num'] == 'minus')
           $_POST['num_new']=$_POST['num_new'] - $obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_check'];

    // NA+MA
    if ($_POST['num_new'] <= $obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_items'] * $obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_check']) {
        $obj->PHPShopCart->_CART[$_POST['id_edit']]['price'] = $obj->PHPShopCart->_CART[$_POST['id_edit']]['price_n'];
        unset($obj->PHPShopCart->_CART[$_POST['id_edit']]['price_n']);
        unset($obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_check']);
        unset($obj->PHPShopCart->_CART[$_POST['id_edit']]['gift_items']);
    }
    
}

$addHandler = array
    (
    'order' => 'order_gift_hook',
    'id_delete' => 'id_delete_gift_hook',
    'id_edit' => 'id_edit_gift_hook',
);
?>