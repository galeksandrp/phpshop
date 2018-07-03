<?php

/**
 * ���������� jss
 */
function order_ddeliverywidget_hook($obj, $row, $rout) {

    if ($rout == 'MIDDLE') {

        // API
        include_once 'phpshop/modules/ddeliverywidget/class/ddeliverywidget.class.php';
        $ddeliverywidget = new ddeliverywidget();
        $option = $ddeliverywidget->option();

        // ������ �������
        $PHPShopCart = new PHPShopCart();
        $cart = $PHPShopCart->getArray();
        $weight = $PHPShopCart->getWeight();

        if (is_array($cart))
            foreach ($cart as $val) {
                $list[] = array('id' => $val['id'], 'name' => PHPShopString::win_utf8($val['name']), 'price' => $val['price'], 'count' => $val['num'], 'vendorCode' => $val['uid']);
            }


        $obj->set('order_action_add', '
            <script src="https://ddelivery.ru/front/widget-cart/public/api.js"></script>
            <script src="phpshop/modules/ddeliverywidget/js/ddeliverywidget.js?5"></script>
            
        <input class="cartListJson" type="hidden" value=\'' . json_encode($list) . '\'/>
        <input id="ddeliveryId" type="hidden" value="' . $option['shop_id'] . '">
        <input id="ddweight" type="hidden" value="' . floatval($weight/1000) .'">
            
        <!-- ��������� ���� ddeliverywidget -->
        <div class="modal fade bs-example-modal" id="ddeliverywidgetModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">��������</h4>
                    </div>
                    <div class="modal-body" style="width:100%">
                        
                         <div id="dd-widget"></div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="ddelivery-close">�������</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ddeliverywidget -->
            
', true);
    }
}

$addHandler = array
    (
    'order' => 'order_ddeliverywidget_hook'
);
?>