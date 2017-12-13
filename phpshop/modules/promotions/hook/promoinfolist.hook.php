<?php

/**
 * ���� ������
 */
function UID_odnotip_hook($obj, $row, $rout) {
    // ���� ��� ����� ����
    global $PHPShopModules, $promotionslist, $SysValue;

    $category = $row['category'];
    $uid = $row['id'];



    if ($rout == "MIDDLE") {


        //������ �����
        $data = $promotionslist;

        //��������� ������ ���� ������ ����
        if ($data[0]['code'] == '') {
            $data[0] = $data;
        }


        if (isset($data)) {
            foreach ($data as $key => $pro) {

                //������ ��������� ��� ����� ����
                if ($pro['categories_check'] == 1):
                    //��������� ������
                    $category_ar = explode(',', $pro['categories']);
                endif;

                if ($pro['products_check'] == 1):
                    //��������� ������
                    $products_ar = explode(',', $pro['products']);
                endif;


                $sumche = 0;
                $sumchep = 0;

                //������ �� ����� ����������
                if (isset($category_ar)) {
                    foreach ($category_ar as $val_c) {
                        if ($val_c == $category) {
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
                        if ($val_p == $uid) {
                            $sumchep = 1;
                            break;
                        } else {
                            $sumchep = 0;
                        }
                    }
                }
                //�������� ��������� � ������
                unset($category_ar);
                unset($products_ar);

                if ($sumche == 1 or $sumchep == 1):
                    //���� �������
                    if ($pro['discount_tip'] == 1) {
                        $pro['discount'];
                        $discount[] = $pro['discount'];
                    }
                    if ($pro['discount_tip'] == 0) {
                        $pro['discount'];
                        $discountsum[] = $pro['discount'];
                    }
                endif;
            }
            //����� ����� ������� ������
            if (isset($discount))
                $discount = max($discount) / 100;

            if (isset($discountsum))
                $discountsum = max($discountsum);
        }

        //���� ���� ������
        if ($discount != '' or $discountsum != '') {

            $priceDiscount[] = $obj->price($row) - ($obj->price($row) * $discount);
            $priceDiscount[] = $obj->price($row) - $discountsum;
            $priceDiscounItog = min($priceDiscount);
            $priceDiscount = $priceDiscounItog;
            //�������� ���� � ����� ������
            if ($priceDiscount < 0) {
                $priceDiscount = 0;
            }

            $productPrice = $priceDiscount;
            $productPriceNew = $obj->price($row, true);
            $obj->set('productPrice', $productPrice);
            $obj->set('productPriceRub', PHPShopText::strike($obj->price($row) . " " . $obj->currency()));

            //������ �����
            $obj->set('promotionsIcon', '<span class="sale-icon" style="background-color: rgba(115, 41, 2, 0.29) !important;">�����-�����</span>');
        }




        //������� ���������� � �������
        $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));
        $PHPShopOrm->debug = false;
        $where['enabled'] = '="1"';
        $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'id'), array('limit' => 500));

        if (isset($data)) {
            foreach ($data as $value) {
                //������ ������� �����-�����
                if ($value['categories_check'] == 1):
                    //��������� ������
                    $category_ar = explode(',', $value['categories']);
                    //������� ������ ��� �������� ������� ������� �� ID ���������
                    if (isset($category_ar)):
                        $sqlyou = '';
                        $val_cat = '';
                        foreach ($category_ar as $val_cat) {
                            if ($val_cat != '') {
                                if ($sqlyou == '') {
                                    $sqlyou = '="' . $val_cat . '" ';
                                } else {
                                    $sqlyou .= 'OR category="' . $val_cat . '" ';
                                }
                            }
                        }
                    endif;
                    //������ ID ������� �� ID ���������
                    $PHPShopOrmN = new PHPShopOrm($SysValue['base']['products']);
                    $PHPShopOrmN->debug = false;
                    $whereN['enabled'] = '="1"';
                    if ($sqlyou != '') {
                        $whereN['category'] = $sqlyou;
                    }
                    $data_prod = $PHPShopOrmN->select(array('id'), $whereN, array('order' => 'id'), array('limit' => 500));
                    if (isset($data_prod)) {
                        foreach ($data_prod as $val_prod) {
                            if ($row['id'] == $val_prod['id']) {
                                //������ � ��������� �����
                                $inf_text_code[$value['id']] = '<div>' . $value['description'] . '</div>';
                            }
                        }
                    }
                endif;
                //������ ��������� �����-�����
                if ($value['products_check'] == 1):
                    //��������� ������
                    $products_ar = explode(',', $value['products']);
                    foreach ($products_ar as $prod_id) {
                        if ($row['id'] == $prod_id) {
                            //������ � ��������� �����
                            $inf_text_code[$value['id']] = '<div>' . $value['description'] . '</div>';
                        }
                    }
                endif;
            }
        }
        if (isset($inf_text_code)):
            foreach ($inf_text_code as $value_text) {
                $inf_text_code_all .= $value_text;
            }
        endif;

        $obj->set('promotionInfo', $inf_text_code_all);
    }
}

/**
 * ����������� �������� ������ �� 250 �������� � �����
 * @param array $obj ������
 */
function product_grid_n_hook($obj, $row) {

    global $PHPShopModules, $promotionslist;

    $category = $row['category'];
    $uid = $row['id'];


    //������ �����
    $data = $promotionslist;

    //��������� ������ ���� ������ ����
    if ($data[0]['code'] == '') {
        $data[0] = $data;
    }



    if (isset($data)) {
        foreach ($data as $key => $pro) {
            //������ ��������� ��� ����� ����
            if ($pro['categories_check'] == 1):
                //��������� ������
                $category_ar = explode(',', $pro['categories']);
            endif;

            if ($pro['products_check'] == 1):
                //��������� ������
                $products_ar = explode(',', $pro['products']);
            endif;

            $sumche = 0;
            $sumchep = 0;

            //������ �� ����� ����������
            if (isset($category_ar)) {
                foreach ($category_ar as $val_c) {
                    if ($val_c == $category) {
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
                    if ($val_p == $uid) {
                        $sumchep = 1;
                        break;
                    } else {
                        $sumchep = 0;
                    }
                }
            }
            //�������� ��������� � ������
            unset($category_ar);
            unset($products_ar);

            if ($sumche == 1 or $sumchep == 1):
                //���� �������
                if ($pro['discount_tip'] == 1) {
                    $pro['discount'];
                    $discount[] = $pro['discount'];
                }
                if ($pro['discount_tip'] == 0) {
                    $pro['discount'];
                    $discountsum[] = $pro['discount'];
                }
            endif;
        }
        //����� ����� ������� ������
        if (isset($discount))
            $discount = max($discount) / 100;

        if (isset($discountsum))
            $discountsum = max($discountsum);
    }

    //���� ���� ������
    if ($discount != '' or $discountsum != '') {

        $priceDiscount[] = $obj->price($row) - ($obj->price($row) * $discount);
        $priceDiscount[] = $obj->price($row) - $discountsum;
        $priceDiscounItog = min($priceDiscount);
        $priceDiscount = $priceDiscounItog;
        //�������� ���� � ����� ������
        if ($priceDiscount < 0) {
            $priceDiscount = 0;
        }

        $productPrice = $priceDiscount;
        $productPriceNew = $obj->price($row, true);
        $obj->set('productPrice', $productPrice);
        $obj->set('productPriceRub', PHPShopText::strike($obj->price($row) . " " . $obj->currency()));

        //������ �����
        $obj->set('promotionsIcon', '<span class="sale-icon" style="background-color: rgba(115, 41, 2, 0.29) !important;">�����-�����</span>');
    }
}

$addHandler = array
    (
    'UID' => 'UID_odnotip_hook',
    'product_grid' => 'product_grid_n_hook'
);
?>