<?php

/**
 * ���������� ����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopPromotions{

    /**
     * �����������
     */
    function __construct() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['promotion']);
        $PHPShopOrm->debug = false;
        //$where['code'] = '="' . PHPShopSecurity::TotalClean(trim('*')) . '"';
        $where['enabled'] = '="1"';
        $this->promotionslist = $PHPShopOrm->select(array('*'), $where, array('order' => 'id'),array('limit'=>1000),__CLASS__,__FUNCTION__);
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
    function promotion_check_userstatus($active, $statuses) {

        $result = true;
        if ($active == 1 && is_array($statuses)) {

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
     * ���������� ���������� � ������� �� ����������� �����������
     * $with_desc - ���������� �������� (��� �������� ������)
     */
    function promotion_get_discount($row, $with_desc = false) {
 
        $data = $this->promotionslist;
        $promo_discount = $promo_discountsum = 0;
        $description = $lab = '';
        $labels = $descriptions = $hidePrices = array();

        if (isset($data)) {
            foreach ($data as $pro) {
                // �������� ���������� ����������
                $date_act = $this->promotion_check_activity($pro['active_check'], $pro['active_date_ot'], $pro['active_date_do']);
                $user_act = $this->promotion_check_userstatus($pro['status_check'], unserialize($pro['statuses']));

                if ($date_act == 1 && $user_act) {
                    //������ ��������� ��� ����� ����
                    if ($pro['categories_check'] == 1):
                        //��������� ������
                        $category_ar = explode(',', $pro['categories']);
                    endif;

                    if ($pro['products_check'] == 1):
                        //��������� ������
                        $products_ar = explode(',', $pro['products']);
                    endif;

                    $sumche = $sumchep = 0;
                    
                    // �� ������� ���� ��� �������� ����� �������� ������� ����
                    if (empty($row['price_n']) or empty($pro['block_old_price'])) {

                        //������ �� ����� ����������
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

                        //������ �� ����� �������
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
                    }

                    //�������� ��������� � ������
                    unset($category_ar);
                    unset($products_ar);

                    if ($sumche == 1 || $sumchep == 1) {
                        //���� �������
                        if ($pro['discount_tip'] == 1) {
                            if ($with_desc && $pro['code_check'] == 1)
                                $discount[] = 0;
                            else {
                                $discount[] = $pro['discount'];
                                $labels[$pro['discount']] = $pro['label'];
                            }
                            if ($with_desc)
                                $descriptions[$pro['id']] = '<div>' . $pro['description'] . '</div>';

                            $hidePrices[$pro['discount']] = $pro['hide_old_price'];
                        }
                        if ($pro['discount_tip'] == 0) {
                            if ($with_desc && $pro['code_check'] == 1)
                                $discountsum[] = 0;
                            else {
                                $discountsum[] = $pro['discount'];
                                $labels[$pro['discount']] = $pro['label'];
                            }
                            if ($with_desc)
                                $descriptions[$pro['id']] = '<div>' . $pro['description'] . '</div>';

                            $hidePrices[$pro['discount']] = $pro['hide_old_price'];
                        }
                    }
                }
            }

            //����� ����� ������� ������
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

            if ($with_desc && !empty($descriptions))
                $description = implode('', $descriptions);
            else
                $description = null;
        }

        return array('percent' => $promo_discount, 'sum' => $promo_discountsum, 'label' => $lab, 'description' => $description, 'hidePrice' => $hidePrice);
    }

    
    /**
     * ����� ���� � ���� ����������
     * @param integer $id �� ������
     * @param float $price ���� ������
     * @return float
     */
    function getPrice($row) {

        // �������� ���������� � ������� �� ����������� �����������
        $discount_info = $this->promotion_get_discount($row);
        
        $discount = $discount_info['percent'];
        $discountsum = $discount_info['sum'];

        //���� ���� ������
        if (!empty($discount) || !empty($discountsum)) {

            $priceDiscount[] = $row['price'] - ($row['price'] * $discount);
            $priceDiscount[] = $row['price'] - $discountsum;
            $priceDiscounItog = min($priceDiscount);
            $priceDiscount = $priceDiscounItog;

            //�������� ���� � ����� ������
            if ($priceDiscount < 0) {
                $priceDiscount = 0;
            }

            $productPrice = $priceDiscount;
            $productPriceNew = $row['price'];

            if ($productPrice < $productPriceNew) {

                // �� ���������� ������ ����
                if ($discount_info['hidePrice'] == 1) {
                    $productPriceNew = 0;
                }
                
                return array('price'=>$productPrice,'price_n'=>$productPriceNew,'label'=>$discount_info['label']);
            }
        }

    }

}

?>