<?php

/**
 * ���������� js
 * param obj $obj
 * param array $row
 * param string $rout
 */
function order_cdek_hook($obj, $row, $rout) {
    global $PHPShopSystem;

    if ($rout == 'MIDDLE') {

        include_once 'phpshop/modules/cdekwidget/class/CDEKWidget.php';
        $CDEKWidget = new CDEKWidget();

        $PHPShopCart = new PHPShopCart();

        $cart = $CDEKWidget->getCart($PHPShopCart->getArray());

        if (empty($CDEKWidget->option['default_city']))
            $defaultCity = 'auto';
        else
            $defaultCity = $CDEKWidget->option['default_city'];

        // ������.�����
        $yandex_apikey = $PHPShopSystem->getSerilizeParam("admoption.yandex_apikey");
        if (empty($yandex_apikey))
            $yandex_apikey = 'cb432a8b-21b9-4444-a0c4-3475b674a958';

        $obj->set('order_action_add', '
 <!-- ��������� ���� cdekwidget -->
        <div class="modal fade bs-example-modal" id="cdekwidgetModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">��������</h4>
                    </div>
                    <div class="modal-body" style="width:100%;">
                        
                         <div id="forpvz" style="height: 600px"></div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="ddelivery-close">�������</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� cdekwidget -->
        
        <input type="hidden" id="cdekwidgetCityFrom" value="' . $CDEKWidget->option[city_from] . '">
        <input type="hidden" id="cdekwidgetdefaultCity" value="' . $defaultCity . '">
        <input class="cdekProducts" type="hidden" value=\'' . json_encode($cart) . '\'/>
        <script>var APIKEY = "'.$yandex_apikey.'";</script>
<script type="text/javascript" src="phpshop/modules/cdekwidget/js/widjet.js" /></script><script type="text/javascript" src="phpshop/modules/cdekwidget/js/cdekwidget.js" /></script>
', true);
    }
}

$addHandler = array
    (
    'order' => 'order_cdek_hook'
);
?>