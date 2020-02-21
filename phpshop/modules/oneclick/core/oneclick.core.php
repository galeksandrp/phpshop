<?php

class PHPShopOneclick extends PHPShopCore {

    /** @var array */
    var $system;

    /**
     * �����������
     */
    function __construct() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['oneclick']['oneclick_jurnal'];

        // �������
        $this->debug = false;

        // ���������
        $this->system();

        // ������ �������
        $this->action = array(
            'post' => 'oneclick_mod_product_id',
            'name' => 'done',
            'nav' => 'index'
        );
        parent::__construct();

        // ������� ������
        $this->navigation(null, __('������� �����'));

        // ����
        $this->title = $this->system['title'] . " - " . $this->PHPShopSystem->getValue("name");
    }

    /**
     * ���������
     */
    function system() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['oneclick']['oneclick_system']);
        $this->system = $PHPShopOrm->select();
    }

    /**
     * ��������� �� ������� ������
     */
    function done() {
        $message = $this->system['title_end'];
        if (empty($message))
            $message = $GLOBALS['SysValue']['lang']['oneclick_done'];
        $this->set('pageTitle', $this->system['title']);
        $this->set('pageContent', $message);
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ��������� � ��������� ������
     */
    function error($message) {
        $this->set('pageTitle', __('������'));
        $this->set('pageContent', $message);
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� �� ���������, ����� ����� ������
     */
    function index($message = false) {
        if (!empty($message))
            $this->error($message);
        else
            return $this->setError404();
    }

    /**
     * �������� �����
     * @param array $option ��������� �������� [url/captcha]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true, 'referer' => true)) {
        global $PHPShopRecaptchaElement;
        return $PHPShopRecaptchaElement->security($option);
    }

    /**
     * ����� ������ ��� ��������� $_POST[returncall_mod_send]
     */
    function oneclick_mod_product_id() {

        if ($this->security(array('url' => false, 'captcha' => (bool) $this->system['captcha'], 'referer' => true))) {
            $product = new PHPShopProduct((int) $_POST['oneclick_mod_product_id']);

            if ($this->system['write_order'] == 0)
                $this->write($product);
            else
                $this->write_main_order($product);

            $this->sendMail($product);

            // SMS ��������������
            $this->sms($product);

            header('Location: ./done.html');
            exit();
        }

        $message = __($GLOBALS['SysValue']['lang']['oneclick_error']);

        $this->index($message);
    }

    /**
     * SMS ����������
     * @param PHPShopProduct $product
     */
    function sms($product) {

        if ($this->PHPShopSystem->ifSerilizeParam('admoption.sms_enabled')) {

            $msg = substr($this->lang('mail_title_adm'), 0, strlen($this->lang('mail_title_adm')) - 1) . ' ' . $product->getName();

            include_once($this->getValue('file.sms'));
            SendSMS($msg);
        }
    }

    /**
     * @param PHPShopProduct $product
     */
    function write($product) {
        global $PHPShopPromotions;

        $insert = array();
        $insert['name_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2);
        $insert['tel_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2);
        $insert['date_new'] = time();
        $insert['message_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2);
        $insert['ip_new'] = $_SERVER['REMOTE_ADDR'];
        $insert['product_name_new'] = $product->getName();
        $insert['product_image_new'] = $product->getImage();
        $insert['product_id_new'] = $product->objID;
        $insert['product_price_new'] = $product->getPrice();

        // ����������
        $promotions = $PHPShopPromotions->getPrice($product->objRow);
        if (is_array($promotions)) {
            $insert['product_price_new'] = $promotions['price'];
        }

        // ������ � ����
        $this->PHPShopOrm->insert($insert);
    }

    /**
     * @param PHPShopProduct $product
     */
    function write_main_order($product) {
        global $PHPShopPromotions;

        if (empty($_POST['oneclick_mod_name']))
            $name = '��� �� �������';
        else
            $name = PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2);

        if (empty($_POST['oneclick_mod_tel']))
            $phone = '���. �� ������';
        else
            $phone = PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2);

        $mail = PHPShopSecurity::TotalClean($_POST['oneclick_mod_mail'], 2);
        $comment = PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2);

        // ������� �������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $qty = 1;
        
        $price = $product->getPrice();
        
        // ����������
        $promotions = $PHPShopPromotions->getPrice($product->objRow);
        if (is_array($promotions)) {
            $price = $promotions['price'];
        }

        $order['Cart']['cart'][$product->objID]['id'] = $product->getParam('id');
        $order['Cart']['cart'][$product->objID]['uid'] = $product->getParam("uid");
        $order['Cart']['cart'][$product->objID]['name'] = $product->getName();
        $order['Cart']['cart'][$product->objID]['price'] = $price;
        $order['Cart']['cart'][$product->objID]['num'] = $qty;
        $order['Cart']['cart'][$product->objID]['weight'] = '';
        $order['Cart']['cart'][$product->objID]['ed_izm'] = '';
        $order['Cart']['cart'][$product->objID]['pic_small'] = $product->getImage();
        $order['Cart']['cart'][$product->objID]['parent'] = 0;
        $order['Cart']['cart'][$product->objID]['user'] = 0;

        $order['Cart']['num'] = $qty;
        $order['Cart']['sum'] = $price * $qty;
        $order['Cart']['weight'] = $product->getParam('weight');
        $order['Cart']['dostavka'] = '';

        $order['Person']['ouid'] = $this->order_num();
        $order['Person']['data'] = time();
        $order['Person']['time'] = '';
        $order['Person']['mail'] = $mail;
        $order['Person']['name_person'] = $name;
        $order['Person']['org_name'] = '';
        $order['Person']['org_inn'] = '';
        $order['Person']['org_kpp'] = '';
        $order['Person']['tel_code'] = '';
        $order['Person']['tel_name'] = '';
        $order['Person']['adr_name'] = '';
        $order['Person']['dostavka_metod'] = '';
        $order['Person']['discount'] = 0;
        $order['Person']['user_id'] = '';
        $order['Person']['dos_ot'] = '';
        $order['Person']['dos_do'] = '';
        $order['Person']['order_metod'] = '';
        $insert['dop_info_new'] = $comment;

        // ������ ��� ������ � ��
        $insert['datas_new'] = time();
        $insert['uid_new'] = $this->order_num();
        $insert['orders_new'] = serialize($order);
        $insert['fio_new'] = $name;
        $insert['tel_new'] = $phone;
        $insert['statusi_new'] = $this->system['status'];

        // ������ � ����
        $PHPShopOrm->insert($insert);
    }

    // ����� ������
    function order_num() {
        // ������������ ����� ������
        $PHPShopOrm = new PHPShopOrm();
        $res = $PHPShopOrm->query("select uid from " . $GLOBALS['SysValue']['base']['orders'] . " order by id desc LIMIT 0, 1");
        $row = mysqli_fetch_array($res);
        $last = $row['uid'];
        $all_num = explode("-", $last);
        $ferst_num = $all_num[0];

        if ($ferst_num < 100)
            $ferst_num = 100;
        $order_num = $ferst_num + 1;

        // ����� ������
        $ouid = $order_num . "-" . substr(abs(crc32(uniqid(session_id()))), 0, 3);
        return $ouid;
    }

    /**
     * @param PHPShopProduct $product
     */
    public function sendMail($product) {
        PHPShopObj::loadClass("mail");

        $zag = $this->PHPShopSystem->getValue('name') . " - " . __('������� �����') . " - " . PHPShopDate::dataV();
        $message = "{������� �������}!
                ---------------

                {� �����} " . $this->PHPShopSystem->getValue('name') . " {������ ������� �����}

                {������ � ������������}:
                ----------------------

                {���}:                " . PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2) . "
                {�������}:            " . PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2) . "
                {�����}:              " . $product->getName() . " / ID " . $product->objID . " / " . $product->getPrice() . " " . $this->PHPShopSystem->getDefaultValutaCode() . "
                {���������}:          " . PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2) . "
                {����}:               " . PHPShopDate::dataV(time()) . "
                IP:                   " . $_SERVER['REMOTE_ADDR'] . "

                ---------------

                http://" . $_SERVER['SERVER_NAME'];

        new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $this->PHPShopSystem->getValue('adminmail2'), $zag, Parser($message));
    }

}

?>