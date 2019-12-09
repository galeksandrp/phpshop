<?php

class PHPShopOneclick extends PHPShopCore {

    /**
     * Конструктор
     */
    function __construct() {

        // Имя Бд
        $this->objBase = $GLOBALS['SysValue']['base']['oneclick']['oneclick_jurnal'];

        // Отладка
        $this->debug = false;

        // Настройка
        $this->system();

        // Список экшенов
        $this->action = array(
            'post' => 'oneclick_mod_product_id',
            'name' => 'done',
            'nav' => 'index'
        );
        parent::__construct();

        // Хлебные крошки
        $this->navigation(null, __('Быстрый заказ'));

        // Мета
        $this->title = $this->system['title'] . " - " . $this->PHPShopSystem->getValue("name");
    }

    /**
     * Настройка
     */
    function system() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['oneclick']['oneclick_system']);
        $this->system = $PHPShopOrm->select();
    }

    /**
     * Сообщение об удачной заявке
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
     * Сообщение о неудачной заявке
     */
    function error($message) {
        $this->set('pageTitle', __('Ошибка'));
        $this->set('pageContent', $message);
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * Экшен по умолчанию, вывод формы звонка
     */
    function index($message = false) {
        if (!empty($message))
            $this->error($message);
        else
            return $this->setError404();
    }

    /**
     * Проверка ботов
     * @param array $option параметры проверки [url/captcha]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true, 'referer' => true)) {
        global $PHPShopRecaptchaElement;
        return $PHPShopRecaptchaElement->security($option);
    }

    /**
     * Экшен записи при получении $_POST[returncall_mod_send]
     */
    function oneclick_mod_product_id() {

        if ($this->security(array('url' => false, 'captcha' => (bool) $this->system['captcha'], 'referer' => true))) {


            if ($this->system['write_order'] == 0)
                $result = $this->write();
            else
                $result = $this->write_main_order();

            // SMS администратору
            $this->sms($result);

            header('Location: ./done.html');
            exit();
        } else {
            $message = __($GLOBALS['SysValue']['lang']['oneclick_error']);
        }
        $this->index($message);
    }

    /**
     * SMS оповещение
     */
    function sms($text) {

        if ($this->PHPShopSystem->ifSerilizeParam('admoption.sms_enabled')) {

            $msg = substr($this->lang('mail_title_adm'), 0, strlen($this->lang('mail_title_adm')) - 1) . ' ' . $text['product_name_new'];

            include_once($this->getValue('file.sms'));
            SendSMS($msg);
        }
    }

    /**
     * Запись в базу модуля
     */
    function write() {

        $PHPShopProduct = new PHPShopProduct(intval($_POST['oneclick_mod_product_id']));

        // Подключаем библиотеку отправки почты
        PHPShopObj::loadClass("mail");
        $insert = array();
        $insert['name_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2);
        $insert['tel_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2);
        $insert['date_new'] = time();
        $insert['message_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2);
        $insert['ip_new'] = $_SERVER['REMOTE_ADDR'];
        $insert['product_name_new'] = $PHPShopProduct->getName();
        $insert['product_image_new'] = $PHPShopProduct->getImage();
        $insert['product_id_new'] = intval($_POST['oneclick_mod_product_id']);
        $insert['product_price_new'] = $PHPShopProduct->getPrice();

        // Запись в базу
        $this->PHPShopOrm->insert($insert);

        $zag = $this->PHPShopSystem->getValue('name') . " - " . __('Быстрый заказ') . " - " . PHPShopDate::dataV();
        $message = "{Доброго времени}!
---------------

{С сайта} " . $this->PHPShopSystem->getValue('name') . " {пришел быстрый заказ}

{Данные о пользователе}:
----------------------

{Имя}:                " . $insert['name_new'] . "
{Телефон}:            " . $insert['tel_new'] . "
{Товар}:              " . $insert['product_name_new'] . " / ID " . $insert['product_id_new'] . " / " . $insert['product_price_new'] . " " . $this->PHPShopSystem->getDefaultValutaCode() . "
{Сообщение}:          " . $insert['message_new'] . "
{Дата}:               " . PHPShopDate::dataV($insert['date_new']) . "
IP:                   " . $_SERVER['REMOTE_ADDR'] . "

---------------

http://" . $_SERVER['SERVER_NAME'];

        new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $this->PHPShopSystem->getValue('adminmail2'), $zag, Parser($message));

        return $insert;
    }

    /**
     * Запись в базу заказов
     */
    function write_main_order() {

        if (empty($_POST['oneclick_mod_name']))
            $name = 'Имя не указано';
        else
            $name = PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2);

        if (empty($_POST['oneclick_mod_tel']))
            $phone = 'тел. не указан';
        else
            $phone = PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2);

        $mail = PHPShopSecurity::TotalClean($_POST['oneclick_mod_mail'], 2);
        $comment = PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2);

        // товар
        $PHPShopProduct = new PHPShopProduct(intval($_POST['oneclick_mod_product_id']));

        // таблица заказов
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $price = $PHPShopProduct->getParam('price');
        $qty = 1;

        $order['Cart']['cart'][$id]['id'] = $PHPShopProduct->getParam('id');
        $order['Cart']['cart'][$id]['uid'] = $PHPShopProduct->getParam("uid");
        $order['Cart']['cart'][$id]['name'] = $PHPShopProduct->getName();
        $order['Cart']['cart'][$id]['price'] = $price;
        $order['Cart']['cart'][$id]['num'] = $qty;
        $order['Cart']['cart'][$id]['weight'] = '';
        $order['Cart']['cart'][$id]['ed_izm'] = '';
        $order['Cart']['cart'][$id]['pic_small'] = $PHPShopProduct->getImage();
        $order['Cart']['cart'][$id]['parent'] = 0;
        $order['Cart']['cart'][$id]['user'] = 0;

        $order['Cart']['num'] = $qty;
        $order['Cart']['sum'] = ($price) * $qty;
        $order['Cart']['weight'] = $PHPShopProduct->getParam('weight');
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

        // данные для записи в БД
        $insert['datas_new'] = time();
        $insert['uid_new'] = $this->order_num();
        $insert['orders_new'] = serialize($order);
        $insert['fio_new'] = $name;
        $insert['tel_new'] = $phone;
        $insert['statusi_new'] = $this->system['status'];

        // Запись в базу
        $PHPShopOrm->insert($insert);
    }

    // номер заказа
    function order_num() {
        // Рассчитываем номер заказа
        $PHPShopOrm = new PHPShopOrm();
        $res = $PHPShopOrm->query("select uid from " . $GLOBALS['SysValue']['base']['orders'] . " order by id desc LIMIT 0, 1");
        $row = mysqli_fetch_array($res);
        $last = $row['uid'];
        $all_num = explode("-", $last);
        $ferst_num = $all_num[0];

        if ($ferst_num < 100)
            $ferst_num = 100;
        $order_num = $ferst_num + 1;

        // Номер заказа
        $ouid = $order_num . "-" . substr(abs(crc32(uniqid(session_id()))), 0, 3);
        return $ouid;
    }

}

?>