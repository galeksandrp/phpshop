<?php

/**
 * ���������� ����������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopClass
 */
class PHPShopPromotions {

    /**
     * �����������
     */
    function __construct() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['promotion']);
        $PHPShopOrm->debug = false;
        $where['enabled'] = '="1"';
        $this->promotionslist = $PHPShopOrm->select(array('*'), $where, array('order' => 'id'), array('limit' => 1000), __CLASS__, __FUNCTION__);
    }

    /**
     * ���������� ���� ������ ���� �������� ��� 0
     */
    function promotion_conv_date($date) {
        $arr = explode('-', $date);
        $date_new = $arr[2] . $arr[1] . $arr[0];
        if (is_numeric($date_new)) {
            return intval($date_new);
        } else {
            return 0;
        }
    }

    /**
     * ��������� ���������� ����������, ���������� 1 - ������� ��� 0 - ���������
     */
    function promotion_check_activity($active, $start, $end) {

        // ��-��������� ��������
        $result = 1;
        $now = intval(date('Ymd'));

        // ���� ����� ��������� ������ � �������� ����
        if ($active == 1) {
            $date_start = $this->promotion_conv_date($start);
            $date_end = $this->promotion_conv_date($end);

            if (!empty($date_start) || !empty($date_end)) {
                // ���� ������� ���� ������ ���� ��������� ����������
                if ($now > $date_end && !empty($date_end)) {
                    $result = 0;
                }
                // ���� ������� ���� ������ ���� ������ ����������
                if ($now < $date_start) {
                    $result = 0;
                }
            }
        }
        // ���������� ��������
        return $result;
    }

    /**
     * ��������� ������� ������� ���������� � ���������� � ����������
     */
    function promotion_check_userstatus($statuses) {

        $result = true;
        if (is_array($statuses)) {

            if (isset($_SESSION['UsersStatus'])) {
                $us = $_SESSION['UsersStatus'];
            } else {
                $us = 0;
            }
            $result = in_array($us, $statuses);
        }
        return $result;
    }

    /**
     * ��������� ������� ���������� � �������
     */
    function promotion_check_cart($num_check, $num=0) {
        if (!empty($num_check) and $num < $num_check)
            $result = false;
        else
            $result = true;

        return $result;
    }

    /**
     * ���������� ���������� � ������� �� ����������� �����������
     */
    function promotion_get_discount($row) {

        $data = $this->promotionslist;
        $promo_discount = $promo_discountsum = 0;
        $lab = null;
        $labels = $descriptions = $hidePrices = array();

        if (isset($data)) {
            foreach ($data as $pro) {

                // �������� ���������� ����������
                $date_act = $this->promotion_check_activity($pro['active_check'], $pro['active_date_ot'], $pro['active_date_do']);

                // ��������� ������ ������������
                $user_act = $this->promotion_check_userstatus(unserialize($pro['statuses']));

                if ($date_act == 1 && $user_act) {
                    
                    $id = $pro['id'];

                    $sum_order_check = $pro['sum_order_check'];
                    $num_check = $pro['num_check'];

                    // ������ ���������
                    if ($pro['categories_check'] == 1)
                        $category_ar = explode(',', $pro['categories']);

                    // ������ �������
                    if ($pro['products_check'] == 1)
                        $products_ar = explode(',', $pro['products']);

                    $sumche = $sumchep = 0;

                    // �� ������� ���� ��� �������� ����� �������� ������� ����
                    if (empty($row['price_n']) or empty($pro['block_old_price'])) {

                        // ������ �� ����� ����������
                        if (isset($category_ar)) {
                            foreach ($category_ar as $val_c) {
                                if ($val_c == $row['category']) {
                                    $sumche = 1;
                                    break;
                                } else {
                                    $sumche = 0;
                                }
                            }
                        }

                        // ������ �� ����� �������
                        if (isset($products_ar)) {
                            foreach ($products_ar as $val_p) {
                                if ($val_p == $row['id']) {
                                    $sumchep = 1;
                                    break;
                                } else {
                                    $sumchep = 0;
                                }
                            }
                        }

                        // �������� ��������� � ������
                        unset($category_ar);
                        unset($products_ar);

                        if ($sumche == 1 || $sumchep == 1) {

                            // ���� �������
                            if ($pro['discount_tip'] == 1) {

                                $discount[] = $pro['discount'];
                                $labels[$pro['discount']] = $pro['label'];
                                $hidePrices[$pro['discount']] = $pro['hide_old_price'];
                            }
                            // ���� ������
                            else {

                                $discountsum[] = $pro['discount'];
                                $labels[$pro['discount']] = $pro['label'];
                                $hidePrices[$pro['discount']] = $pro['hide_old_price'];
                            }
                        }
                    }
                }
            }

            // ����� ����� ������� ������
            if (isset($discount)) {
                $promo_discount = max($discount) / 100;
                $lab = $labels[$promo_discount * 100];
                $hidePrice = $hidePrices[$promo_discount * 100];
            }

            if (isset($discountsum)) {
                $promo_discountsum = max($discountsum);
                $lab = $labels[$promo_discountsum];
                $hidePrice = $hidePrices[$promo_discountsum];
            }
        }

        return array('status' => $sum_order_check, 'percent' => $promo_discount, 'sum' => $promo_discountsum, 'label' => $lab, 'hidePrice' => $hidePrice, 'num_check' => $num_check, 'id'=>$id);
    }

    /**
     * ����� ���� � ���� ����������
     * @param array $row ������ ������ ������
     * @param bool ��������� ���������� ������ � �������
     * @return array
     */
    function getPrice($row, $cart_act = false) {

        // �������� ���������� � ������� �� ����������� �����������
        $discount_info = $this->promotion_get_discount($row);

        // ��������� ���������� � �������
        if (!$cart_act)
            $cart_act = $this->promotion_check_cart($discount_info['num_check']);

        $discount = $discount_info['percent'];
        $discountsum = $discount_info['sum'];
        $status = $discount_info['status'];

        // ���� ���� ������
        if (!empty($discount) || !empty($discountsum) and $cart_act) {

            // ������
            if ($status == 0) {

                $priceDiscount[] = $row['price'] - ($row['price'] * $discount);
                $priceDiscount[] = $row['price'] - $discountsum;
                $priceDiscounItog = min($priceDiscount);
                $priceDiscount = $priceDiscounItog;

                // �������� ���� � ����� ������
                if ($priceDiscount < 0) {
                    $priceDiscount = 0;
                }
            }
            // �������
            else {

                $priceDiscount[] = $row['price'] + ($row['price'] * $discount);
                $priceDiscount[] = $row['price'] + $discountsum;
                $priceDiscounItog = max($priceDiscount);
                $priceDiscount = $priceDiscounItog;
            }

            $productPrice = $priceDiscount;
            $productPriceNew = $row['price'];

            // �� ���������� ������ ����
            if ($discount_info['hidePrice'] == 1) {
                $productPriceNew = 0;
            }

            return array('price' => $productPrice, 'price_n' => $productPriceNew, 'label' => $discount_info['label'],'num_check'=>$discount_info['num_check'],'id'=>$discount_info['id']);
        }
    }

}

?>