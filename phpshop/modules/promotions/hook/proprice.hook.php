<?php

/**
 * ����������� �������� ������ �� 250 �������� � �����
 * @param array $obj ������
 */
function product_grid_hook($obj, $row) {
    
    // �������� ���������� � ������� �� ����������� �����������
    $discount_info = promotion_get_discount($row);
    $discount = $discount_info['percent'];
    $discountsum = $discount_info['sum'];

    //���� ���� ������
    if (!empty($discount) || !empty($discountsum)) {

        $priceDiscount[] = $obj->price($row) - ($obj->price($row) * $discount);
        $priceDiscount[] = $obj->price($row) - $discountsum;
        $priceDiscounItog = min($priceDiscount);
        $priceDiscount = $priceDiscounItog;
        //�������� ���� � ����� ������
        if ($priceDiscount < 0) {
            $priceDiscount = 0;
        }
        $productPrice = $priceDiscount;
        $productPriceNew = $obj->price($row);

        if ($productPrice < $productPriceNew) {
            $obj->set('productPrice', $productPrice);
            $obj->set('productPriceRub', PHPShopText::strike($productPriceNew . " " . $obj->currency()));
        }

        if ($productPrice < $productPriceNew||$discount==0||$discountsum==0) {
            //������ �����
            $obj->set('promotionsIcon', $discount_info['label']);
        }
    } else {
        $obj->set('promotionsIcon', '');
    }
}

$addHandler = array
    (
    'product_grid' => 'product_grid_hook'
);
?>