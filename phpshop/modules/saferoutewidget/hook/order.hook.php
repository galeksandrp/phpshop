<?php

/**
 * Добавление jss
 */
function order_saferoutewidget_hook($obj, $row, $rout) {

    if ($rout == 'MIDDLE') {

        // API
        include_once 'phpshop/modules/saferoutewidget/class/saferoutewidget.class.php';
        $saferoutewidget = new saferoutewidget();
        $option = $saferoutewidget->option();

        // Список товаров
        $PHPShopCart = new PHPShopCart();
        $cart = $PHPShopCart->getArray();
        $weight = $PHPShopCart->getWeight();

        if (is_array($cart))
            foreach ($cart as $val) {
                $list[] = array('id' => $val['id'], 'name' => PHPShopString::win_utf8($val['name']), 'price' => $val['price'], 'count' => $val['num'], 'vendorCode' => $val['uid']);
            }


        $obj->set('order_action_add', '
            <script src="https://widgets.saferoute.ru/cart/api.js"></script>
            <script src="phpshop/modules/saferoutewidget/js/saferoutewidget.js"></script>
            
        <input class="cartListJson" type="hidden" value=\'' . json_encode($list) . '\'/>
        <input id="ddweight" type="hidden" value="' . floatval($weight/1000) .'">
            
        <!-- Модальное окно saferoutewidget -->
        <div class="modal fade bs-example-modal" id="saferoutewidgetModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Доставка</h4>
                    </div>
                    <div class="modal-body" style="width:100%">
                        
                         <div id="saferoute-widget"></div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="saferoute-close">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Модальное окно saferoutewidget -->
            
', true);
    }
}

$addHandler = array
    (
    'order' => 'order_saferoutewidget_hook'
);
?>