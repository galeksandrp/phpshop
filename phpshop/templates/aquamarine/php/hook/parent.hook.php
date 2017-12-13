<?php

/**
 * ��������� ���� ����������� �������
 */
function parent_table_hook($obj, $row, $rout) {

    if ($rout == 'START') {
        $dis = null;

        if (!empty($row['parent'])) {
            $parent = explode(",", $row['parent']);

            // ������� ���������� � ������� �������� ������
            $obj->set('ComStartCart', '<!--');
            $obj->set('ComEndCart', '-->');

            // �������� ������ �������
            if (is_array($parent))
                foreach ($parent as $value) {
                    if (PHPShopProductFunction::true_parent($value))
                        $Product[$value] = $obj->ReturnProductData(array('*'), array('id' => '=' . $value, 'enabled' => "='1'", 'sklad' => "!='1'"));
                    else
                        $Product[$value] = $obj->select(array('*'), array('id' => '=' . $value, 'enabled' => "='1'"), false, false, __FUNCTION__);
                }

            // ����������� �������� � ������� ������� �����
            //$dis.=PHPShopText::tr($row['name'], $obj->price($row) . ' ' . $obj->get('productValutaName'), PHPShopText::a('javascript:AddToCart(' . $row['id'] . ');', $obj->lang('product_sale')));

            // ���������� ������ �������
            if (is_array($Product))
                foreach ($Product as $p) {
                    if (!empty($p)) {

                        // ���� ����� �� ������
                        if (empty($p['priceSklad'])) {
                            $price = $obj->price($p);
                            $dis.=PHPShopText::tr($p['name'], $price . ' ' . $obj->get('productValutaName'), PHPShopText::a('javascript:AddToCartParentHook(' . $p['id'] . ',' . $row['id'] . ');', $obj->lang('product_sale')));
                        }
                    }
                }

            $js_function = '
<script> 
 // ���������� ������������ ������ � ������� N ��.
function AddToCartParentHook(xid,xxid) {
    var num=1;
    if(confirm("�������� ��������� ����� ("+num+" ��.) � �������?")){
        ToCart(xid,num,xxid);
        initialize();
        setTimeout("initialize_off()",3000);
        if(document.getElementById("order")) document.getElementById("order").style.display="block";
    }
}
</script>
';

            $obj->set('productParentList', $js_function . PHPShopText::table($dis));
            $obj->set('productPrice', '');
            $obj->set('productPriceRub', '');
            $obj->set('productValutaName', '');

            return true;
        }
    }
}

$addHandler = array
    (
    'parent' => 'parent_table_hook'
);
?>
