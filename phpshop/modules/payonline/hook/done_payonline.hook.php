<?php

/**
 * Функция хук, регистрация заказа в платежном шлюзе
 * @param object $obj объект функции
 * @param array $value данные о заказе
 * @param string $rout место внедрения хука
 */
function send_payonline_hook($obj, $value, $rout) {
    include_once 'phpshop/modules/payonline/class/PayOnline.php';

    if ($rout === 'MIDDLE' and $value['order_metod'] == PayOnline::PAYMENT_ID) {

        $PayOnline = new PayOnline();

        // Контроль оплаты от статуса заказа
        if (empty($PayOnline->option['status'])) {

            $PayOnline->setAmount(number_format($obj->get('total'), 2, '.', ''));
            $PayOnline->setOrderId($value['ouid']);

            $PayOnline->log(array('form' => $PayOnline->getForm()), $PayOnline->getOrderId(), 'Форма подготовлена для отправки', 'Регистрация заказа');

            $obj->set('payment_forma', PHPShopText::form($PayOnline->getForm(), 'payonlinepay', 'get', PayOnline::FORM_ACTION, '_blank'));

            $forma = ParseTemplateReturn($GLOBALS['SysValue']['templates']['payonline']['payonline_payment_forma'], true);

        } else {

            $clean_cart = "
            <script>
                if(window.document.getElementById('num')){
                    window.document.getElementById('num').innerHTML='0';
                    window.document.getElementById('sum').innerHTML='0';
                }
            </script>";
            $obj->set('mesageText', $PayOnline->option['title_sub'] . $clean_cart);
            $forma = ParseTemplateReturn($GLOBALS['SysValue']['templates']['order_forma_mesage']);

            // Очищаем корзину
            unset($_SESSION['cart']);
        }

        $obj->set('orderMesage', $forma);
    }
}

$addHandler = array('send_to_order' => 'send_payonline_hook');
?>

