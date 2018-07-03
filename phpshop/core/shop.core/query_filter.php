<?php

/**
 * C��������� �������
 * @author PHPShop Software
 * @version 1.4
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @return mixed
 */
function query_filter($obj) {

    $sort = null;
    $n = $obj->category;

    $v = @$_REQUEST['v'];
    $s = intval($_REQUEST['s']);
    $f = intval($_REQUEST['f']);

    if ($obj->PHPShopNav->isPageAll())
        $p = PHPShopSecurity::TotalClean($p, 1);

    // ���-�� ������� �� ��������
    $num_row = $obj->PHPShopCategory->getParam('num_row');
    if (!empty($num_row))
        $num_row = $num_row;
    else // ���� 0 ������ �� ������� ���-�� ������� * 2 ������.
        $num_row = (6 - $obj->cell) * $obj->cell;

    // ���������� �� ���������������
    if (is_array($v)) {
        foreach ($v as $key => $value) {

            // ������������� ����� [][]
            if (is_array($value)) {
                $sort.=" and (";
                foreach ($value as $v) {
                    if (PHPShopSecurity::true_num($key) and PHPShopSecurity::true_num($v)) {
                        $hash = $key . "-" . $v;
                        $sort.=" vendor REGEXP 'i" . $hash . "i' or";
                    }
                }
                $sort = substr($sort, 0, strlen($sort) - 2);
                $sort.=")";
            }
            // ������� ����� []
            elseif (PHPShopSecurity::true_num($key) and PHPShopSecurity::true_num($value)) {
                $hash = $key . "-" . $value;
                $sort.=" and vendor REGEXP 'i" . $hash . "i' ";
            }
        }
    }

    // ����������� ���������� �� �������� ��������. ������ ����� ������ � sort.class.php
    if (empty($f))
        switch ($obj->PHPShopCategory->getParam('order_to')) {
            case(1): $order_direction = "";
                $obj->set('productSortImg', 1);
                break;
            case(2): $order_direction = " desc";
                $obj->set('productSortImg', 2);
                break;
            default: $order_direction = "";
                $obj->set('productSortImg', 1);
                break;
        }


    // ���������� �� �������� ��������. ������ ����� ������ � sort.class.php
    if (empty($s))
        switch ($obj->PHPShopCategory->getParam('order_by')) {
            case(1): $order = array('order' => 'name' . $order_direction);
                $obj->set('productSortA', 'sortActiv');
                break;
            case(2):
                // ���������� �� ���� ����� �������������� �������
                if ($obj->multi_currency_search)
                    $order = array('order' => 'price_search,price' . $order_direction);
                else
                    $order = array('order' => 'price' . $order_direction);

                $obj->set('productSortB', 'sortActiv');
                break;
            case(3): $order = array('order' => 'num' . $order_direction . ", items desc");
                $obj->set('productSortC', 'sortActiv');
                break;
            default: $order = array('order' => 'num' . $order_direction . ", items desc");
                $obj->set('productSortC', 'sortActiv');
                break;
        }

    // ���������� �������������� �������������
    if ($s or $f) {
        switch ($f) {
            case(1): $order_direction = "";

                break;
            case(2): $order_direction = " desc";
                break;
            default: $order_direction = "";
                break;
        }
        switch ($s) {
            case(1): $order = array('order' => 'name' . $order_direction);
                break;
            case(2):
                // ���������� �� ���� ����� �������������� �������
                if ($obj->multi_currency_search)
                    $order = array('order' => 'price_search,price' . $order_direction);
                else
                    $order = array('order' => 'price' . $order_direction);
                break;
            case(3): $order = array('order' => 'num' . $order_direction);
                break;
            default: $order = array('order' => 'num, name' . $order_direction);
        }
    }

    // ���� ���������� ���������
    $catt = '(category=' . $n . ' OR dop_cat LIKE \'%#' . $n . '#%\') ';

    // ����������� ������ ������ ���������� � ������
    foreach ($order as $key => $val)
        $string = $key . ' by ' . $val;

    // ��� ��������
    if ($obj->PHPShopNav->isPageAll()) {
        $sql = " ($catt and enabled='1' and parent_enabled='0') " . $sort . " " . $string . ' limit ' . $obj->max_item;
    }


    // ����� �� ����
    if (PHPShopSecurity::true_param($_REQUEST['min'], $_REQUEST['max'])) {

        $priceOT = intval($_REQUEST['min']) - 1;
        $priceDO = intval($_REQUEST['max']) + 1;

        $percent = $obj->PHPShopSystem->getValue('percent');

        if (empty($priceDO))
            $priceDO = 1000000000;


        // ���� � ������ ��������� ������
        $priceOT/=$obj->currency('kurs');
        $priceDO/=$obj->currency('kurs');

        // ���������� �� ������ ����� �������������� �������
        if ($obj->multi_currency_search)
            $sort.= " and (price_search BETWEEN " . ($priceOT / (100 + $percent) * 100) . " AND " . ($priceDO / (100 + $percent) * 100) . ") ";
        else
            $sort.= " and (price BETWEEN " . ($priceOT / (100 + $percent) * 100) . " AND " . ($priceDO / (100 + $percent) * 100) . ") ";
    }


    return array('sql' => $catt . " and enabled='1' and parent_enabled='0' " . $sort . $string);
}

?>