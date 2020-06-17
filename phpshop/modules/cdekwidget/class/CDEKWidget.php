<?php

/**
 * API version 2.0
 */
class CDEKWidget {

    const TEST_ACCOUNT = 'z9GRRu7FxmO53CQ9cFfI6qiy32wpfTkd';
    const TEST_PASSWORD = 'w24JTCv4MnAcuRTx0oHjHLDtyt3I6IBq';
    const STATUS_ORDER_PREPARED = 'prepared';
    const STATUS_ORDER_PROCESS_SENT = 'process_sent';
    const STATUS_ORDER_ERROR = 'error';
    const STATUS_ORDER_SENT = 'sent';
    const STATUS_ORDER_DELIVERED = 'delivered';
    const STATUS_ORDER_CANCELED = 'canceled';

    public $isTest = false;
    private $testDomain = 'https://api.edu.cdek.ru/';
    private $domain = 'https://api.cdek.ru/';
    private $authUrl = 'v2/oauth/token';
    private $orderUrl = 'v2/orders';
    private $token;
    private $orderId;

    public function __construct() {

        $PHPShopOrm = new PHPShopOrm('phpshop_modules_cdekwidget_system');

        /* ����� ������ */
        $this->option = $PHPShopOrm->select();

        (int) $this->option['test'] === 1 ? $this->isTest = true : $this->isTest = false;
    }

    /**
     * @param array $cart
     * @param int $discount
     * @param int $paymentStatus
     * @return array
     */
    public function getProducts($cart = array(), $discount = 0, $paymentStatus = 0)
    {
        $products = array();
        $cartWeight = 0;
        foreach ($cart as $product) {
            if($discount > 0)
                $price = $product['price']  - ($product['price']  * $discount  / 100);
            else
                $price = $product['price'];

            if(empty($product['weight']))
                $weight = $this->option['weight'];
            else
                $weight = $product['weight'];

            $products[] = array(
                'name' => PHPShopString::win_utf8($product['name']),
                'ware_key' => !empty($product['uid']) ? PHPShopString::win_utf8($product['uid']) : $product['id'],
                'payment' => array(
                    'value' => (int) $paymentStatus === 1 ? 0 : $price
                ),
                'cost' => $price,
                'weight' => $weight,
                'amount' => $product['num']
            );
           $cartWeight += $weight;
        }

        return array('items' => $products, 'weight' => $cartWeight);
    }

    public function getCart($cart)
    {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

        $list = array();
        foreach ($cart as $cartItem) {
            $product = $PHPShopOrm->select(array('cdek_length', 'cdek_width', 'cdek_height'), array('`id`=' => '"' . $cartItem['id'] . '"'));

            for($i = 1; $i <= $cartItem['num']; $i++) {
                $list[] = array(
                    'length' => (!empty($product['cdek_length']) ? (float) $product['cdek_length'] : (float) $this->option['length']),
                    'width'  => (!empty($product['cdek_width'])  ? (float) $product['cdek_width']  : (float) $this->option['width']),
                    'height' => (!empty($product['cdek_height']) ? (float) $product['cdek_height'] : (float) $this->option['height']),
                    'weight' => (!empty($cartItem['weight']) ? $cartItem['weight'] / 1000 : $this->option['weight'] / 1000),
                );
            }
        }

        return $list;
    }

    /**
     * ������ ����
     * @param array $message ���������� ������� � �� ��� ���� �������
     * @param string $order_id ����� ������
     * @param string $status ������ ��������
     * @param string $type request
     */
    public function log($message, $order_id, $status, $type, $status_code = 'succes') {

        $PHPShopOrm = new PHPShopOrm('phpshop_modules_cdekwidget_log');
        $id = explode("-", $order_id);

        $log = array(
            'message_new'     => serialize($message),
            'order_id_new'    => $id[0],
            'status_new'      => $status,
            'type_new'        => $type,
            'date_new'        => time(),
            'status_code_new' => $status_code
        );

        $PHPShopOrm->insert($log);
    }

    public function send($order)
    {
        $cdek_data = unserialize($order['cdek_order_data']);
        $cart = unserialize($order['orders']);

        if($this->isOrderSend($cdek_data['status'])) {
            return;
        }

        $this->orderId = $order['id'];

        if(!is_array($cdek_data)) {
            $this->log(
                array('error' => '�� ������ ����� �������� � ������� ����'),
                $this->orderId,
                '������ �������� ������',
                '�������� ������ ������ �������� ����',
                'error'
            );
        }

        if($cdek_data['type'] === 'courier') {
            $address = PHPShopString::win_utf8($order['street']);
            if(!empty($order['house'])) {
                $address .= ', ' . PHPShopString::win_utf8($order['house']);
            }
            if(!empty($order['flat'])) {
                $address .= ', ' . PHPShopString::win_utf8($order['flat']);
            }
        }

        if(empty($order['fio']))
            $name = $cart['Person']['name_person'];
        else
            $name = $order['fio'];

        $products = $this->getProducts($cart['Cart']['cart'], $cart['Person']['discount'], (int) $order['paid']);

        $parameters = array(
            'type' => 1,
            'number' => $order['uid'],
            'tariff_code' => $cdek_data['tariff'],
            'delivery_point' => $cdek_data['type'] === 'pvz' ? $cdek_data['cdek_pvz_id'] : null,
            'delivery_recipient_cost' => array(
                'value' => (int) $order['paid'] === 1 ? 0 : $cart['Cart']['dostavka']
            ),
            'recipient' => array(
                'name' => PHPShopString::win_utf8($name),
                'email' => $cart['Person']['mail'],
                'phones' => array(
                    array('number' => str_replace(array('(', ')', ' ', '+', '-', '&#43;'), '', $order['tel']))
                )
            ),
            'from_location' => array(
                'country_code' => 'RU',
                'code' => $this->option['city_from_code'],
                'postal_code' => $this->option['index_from'],

            ),
            'to_location' => array(
                'code' => $cdek_data['city_id'],
                'country_code' => 'RU',
                'address' => $cdek_data['type'] === 'pvz' ? PHPShopString::win_utf8('���: ') . $cdek_data['cdek_pvz_id'] : $address
            ),
            'packages' => array(
                array(
                    'number' => $order['uid'],
                    'weight' => $products['weight'],
                    'items' => $products['items']
                )
            )
        );

        $result = $this->request($this->orderUrl, $parameters);

        if(!isset($result['entity']['uuid'])) {
            $this->log(
                array('response' => $result, 'parameters' => $parameters),
                $this->orderId,
                '������ �������� ������',
                '�������� ������ ������ �������� ����',
                'error'
            );
        } else {
            $orm = new PHPShopOrm('phpshop_orders');
            $cdek_data['status'] = self::STATUS_ORDER_PROCESS_SENT;
            $cdek_data['uuid'] = $result['entity']['uuid'];

            $orm->update(array('cdek_order_data_new' => serialize($cdek_data)), array('id' => "='" . $this->orderId . "'"));

            $this->log(
                array('response' => $result, 'parameters' => $parameters),
                $this->orderId,
                '�������� �������� ������',
                '�������� ������ ������ �������� ����',
                'success'
            );
        }
    }

    /**
     * @param array $request
     * @throws Exception
     */
    public function changeAddress($request)
    {
        $orm = new PHPShopOrm('phpshop_orders');
        $order = $this->getOrderById($request['orderId']);

        $cart = unserialize($order['orders']);
        $cart['Cart']['dostavka'] = (float) $request['cost'];
        $sum = $cart['Cart']['sum'] + $cart['Cart']['dostavka'];

        $cdekOrderData = serialize(array(
            'type'           => $request['type'],
            'city_id'        => $request['city'],
            'delivery_info'  => PHPShopString::utf8_win1251($request['info']),
            'cdek_pvz_id'    => $request['pvz'],
            'tariff'         => $request['tariff'],
            'status'         => CDEKWidget::STATUS_ORDER_PREPARED,
            'status_text'    => '������� �������� � ����'
        ));

        $orm->update(array('cdek_order_data_new' => $cdekOrderData, 'orders_new' => serialize($cart), 'sum_new' => $sum), array('id' => "='" . $order['id'] . "'"));
    }

    public function buildInfoTable($order)
    {
        global $PHPShopGUI, $PHPShopSystem;

        $disabledPayment = '';
        $cdek = unserialize($order['cdek_order_data']);

        if(!is_array($cdek)) {
            // �������� ������ �������� �� ����.
            $template = dirname(__DIR__) . '/templates/order_error.tpl';
        } else {
            $isSend = $this->isOrderSend($cdek['status']);
            $isClosed = $this->isOrderClosed($cdek['status']);
            if($isSend) {
                PHPShopParser::set('cdek_hide_actions', 'display: none;');
                $disabledPayment = 'disabled="disabled"';
            }

            if($isClosed || empty($cdek['uuid'])) {
                PHPShopParser::set('cdek_statuses_hidden', 'display: none;');
            } else {
                $statuses = $this->getOrderStatuses($cdek['uuid']);
                $statusesTable = '';
                foreach ($statuses as $status) {
                    $statusesTable .= '<tr><td>' . PHPShopString::utf8_win1251($status['name']) . '</td><td>' . date('d-m-Y h:i:s', strtotime($status['date_time'])) . '</td></tr>';
                }
                PHPShopParser::set('cdek_statuses', $statusesTable);
            }

            PHPShopParser::set('cdek_status', $cdek['status_text']);
            PHPShopParser::set('cdek_delivery_info_type', $cdek['type'] === 'pvz' ? '��������� �� ���' : '���������� ��������');
            PHPShopParser::set('cdek_payment_status', $PHPShopGUI->setCheckbox("payment_status", 1, "����� �������", $order['paid'], $disabledPayment));
            PHPShopParser::set('cdek_delivery_info', $cdek['delivery_info']);

            if(is_array($cdek['errors'])) {
                PHPShopParser::set('cdek_errors', '<tr><td>������</td><td>' . implode('<br>', $cdek['errors']) . '</td></tr>');
            } else {
                PHPShopParser::set('cdek_errors', '');
            }

            $template = dirname(__DIR__) . '/templates/order_info.tpl';
        }

        PHPShopParser::set('cdek_order_id', $order['id']);

        $cart = unserialize($order['orders']);

        $products = $this->getCart($cart['Cart']['cart']);

        if (empty($this->option['default_city']))
            $defaultCity = 'auto';
        else
            $defaultCity = $this->option['default_city'];

        // ������.�����
        $yandex_apikey = $PHPShopSystem->getSerilizeParam("admoption.yandex_apikey");
        if (empty($yandex_apikey))
            $yandex_apikey = 'cb432a8b-21b9-4444-a0c4-3475b674a958';

        PHPShopParser::set('cdek_city_from', $this->option['city_from']);
        PHPShopParser::set('cdek_default_city', $defaultCity);
        PHPShopParser::set('cdek_cart', json_encode($products));
        PHPShopParser::set('cdek_ymap_key', $yandex_apikey);
        PHPShopParser::set('cdek_admin', 1);
        PHPShopParser::set('cdek_scripts', '<script type="text/javascript" src="../modules/cdekwidget/js/widjet.js" /></script><script type="text/javascript" src="../modules/cdekwidget/js/cdekwidget.js" /></script>');

        PHPShopParser::set('cdek_popup', ParseTemplateReturn(dirname(__DIR__) . '/templates/template.tpl', true) , true);

        return ParseTemplateReturn($template, true);
    }

    /**
     * @param $orderId
     * @throws Exception
     */
    public function getOrderById($orderId)
    {
        $orm = new PHPShopOrm('phpshop_orders');

        $order = $orm->getOne(array('*'), array('id' => "='" . (int) $orderId . "'"));
        if(!$order) {
            throw new \Exception('����� �� ������');
        }

        return $order;
    }

    /**
     * @param $order
     */
    public function checkTracking($order)
    {
        $cdek = unserialize($order['cdek_order_data']);

        if(empty($cdek['uuid'])) {
            return;
        }

        $status = $this->request($this->orderUrl, array($cdek['uuid']), false);

        if(isset($status['entity']['cdek_number'])) {
            $orm = new PHPShopOrm('phpshop_orders');
            $orm->update(array('tracking_new' => $status['entity']['cdek_number']), array('id' => "='" . $order['id'] . "'"));
        }
    }

    public function updateOrderStatus($order)
    {
        $cdek = unserialize($order['cdek_order_data']);

        $isClosed = $this->isOrderClosed($cdek['status']);

        if(empty($cdek['uuid']) || $isClosed) {
            return $order;
        }

        $statuses = $this->getOrderStatuses($cdek['uuid']);

        $currentStatus = array_pop($statuses);
        if(isset($currentStatus['name'])) {
            $currentStatus['name'] = PHPShopString::utf8_win1251($currentStatus['name']);

            if($currentStatus['code'] === 'INVALID') {
                $cdek['status'] = self::STATUS_ORDER_ERROR;
                $cdek['errors'] = $this->getOrderErrors($cdek['uuid']);
            }

            $cdek['status_text'] = $currentStatus['name'];
            $order['cdek_order_data'] = serialize($cdek);

            $orm = new PHPShopOrm('phpshop_orders');
            $orm->update(array('cdek_order_data_new' => serialize($cdek)), array('id' => "='" . $order['id'] . "'"));
        }

        return $order;
    }

    public function getOrderStatuses($uuid)
    {
        $status = $this->request($this->orderUrl, array($uuid), false);

        return $status['entity']['statuses'];
    }

    private function getOrderErrors($uuid)
    {
        $order = $this->request($this->orderUrl, array($uuid), false);

        if(is_array($order['requests'][0]['errors'])) {
            $errors = array();
            foreach ($order['requests'][0]['errors'] as $error) {
                $errors[] = PHPShopString::utf8_win1251($error['message']);
            }
        }

        return $errors;
    }

    // ����� ��������������� ��� � �������� �����������.
    private function isOrderSend($status)
    {
        return $status !== self::STATUS_ORDER_PREPARED && $status !== self::STATUS_ORDER_ERROR;
    }

    // ����� "������" ���� ��������� ��� �������. � ���� �������� �� ����������� ������ ������ � ����.
    private function isOrderClosed($status)
    {
        return $status === self::STATUS_ORDER_DELIVERED || $status === self::STATUS_ORDER_CANCELED;
    }

    /**
     * @param $method
     * @param array $params
     * @param bool $post
     * @return array
     */
    private function request($method, $params = array(), $post = true)
    {
        if(empty($this->token)) {
            $this->getToken();
        }

        $this->isTest ? $domain = $this->testDomain : $domain = $this->domain;

        $ch = curl_init();
        $headers = array(
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json'
        );
        if($post) {
            $headers[2] = 'Content-Length: ' . strlen(json_encode($params));
            curl_setopt($ch, CURLOPT_URL, $domain . $method);
        } else {
            curl_setopt($ch, CURLOPT_URL, $domain . $method . '/' . $params[0]);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    private function getToken()
    {
        if($this->isTest) {
            $domain = $this->testDomain;
            $account = self::TEST_ACCOUNT;
            $password = self::TEST_PASSWORD;
        } else {
            $domain = $this->domain;
            $account = $this->option['account'];
            $password = $this->option['password'];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domain . $this->authUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'grant_type' => 'client_credentials',
            'client_id' => $account,
            'client_secret' => $password
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        $token = json_decode($result, true);

        $this->token = $token['access_token'];
    }
}
