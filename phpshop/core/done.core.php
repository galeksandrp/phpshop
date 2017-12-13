<?php

PHPShopObj::loadClass('order');
PHPShopObj::loadClass('mail');
$PHPShopOrder = new PHPShopOrderFunction();

/**
 * ���������� ������ ������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopDone
 * @version 1.3
 * @package PHPShopCore
 */
class PHPShopDone extends PHPShopCore {
    
    /**
     * ������� ������� ����� ������
     * @var bool 
     */
    public $cart_clean_enabled=true;

    /**
     * �����������
     */
    function PHPShopDone() {
        global $PHPShopOrder;

        // �������
        $this->debug = false;

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['orders'];

        // ������ �������
        $this->action = array('nav' => 'index', "post" => 'send_to_order');
        parent::PHPShopCore();

        PHPShopObj::loadClass('cart');
        $this->PHPShopCart = new PHPShopCart();

        $this->PHPShopOrder = $PHPShopOrder;

        // ���������� ��������
        if (PHPShopSecurity::true_num($_POST['d'])) {
            PHPShopObj::loadClass('delivery');
            $this->PHPShopDelivery = new PHPShopDelivery($_POST['d']);
        }

        // ���������� ��������� ������
        if (PHPShopSecurity::true_num($_POST['order_metod'])) {
            PHPShopObj::loadClass('payment');
            $this->PHPShopPayment = new PHPShopPayment($_POST['order_metod']);
        }
    }

    /**
     * ����� �� ��������
     */
    function index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        $this->set('mesageText', $this->message($this->lang('bad_cart_1'), $this->lang('bad_order_mesage_2')));
        $disp = ParseTemplateReturn($this->getValue('templates.order_forma_mesage'));
        $this->set('orderMesage', $disp);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, false, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.order_forma_mesage_main'));
    }

    /**
     * ���������
     * @param string $title ���������
     * @param string $content ����������
     * @return string
     */
    function message($title, $content) {

        // �������� ������
        $Arg = func_get_args();
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $Arg);
        if ($hook)
            return $hook;

        $message = PHPShopText::b(PHPShopText::notice($title, false, '14px')) . PHPShopText::br();
        $message.=PHPShopText::message($content, false, '12px', 'black');

        return $message;
    }

    /**
     * ����� ������ ������
     */
    function send_to_order() {
        global $SysValue;

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST, 'START'))
            return true;

        if ($this->PHPShopCart->getNum() > 0) {
            if (PHPShopSecurity::true_param($_POST['mail'], $_POST['name_person'], $_POST['tel_name'], $_POST['adr_name'])) {

                $this->ouid = $_POST['ouid'];

                $order_metod = PHPShopSecurity::TotalClean($_POST['order_metod'], 1);
                $PHPShopOrm = new PHPShopOrm($this->getValue('base.payment_systems'));
                $row = $PHPShopOrm->select(array('path'), array('id' => '=' . $order_metod, 'enabled' => "='1'"), false, array('limit' => 1));
                $path = $row['path'];

                // ��������� ������� API
                $LoadItems['System'] = $this->PHPShopSystem->getArray();

                $this->sum = $this->PHPShopCart->getSum(false);
                $this->num = $this->PHPShopCart->getNum();
                $this->weight = $this->PHPShopCart->getWeight();

                // ������
                $this->currency = $this->PHPShopOrder->default_valuta_code;

                // ��������� ��������
                $this->delivery = $this->PHPShopDelivery->getPrice($this->PHPShopCart->getSum(false), $this->PHPShopCart->getWeight());

                // ������
                $this->discount = $this->PHPShopOrder->ChekDiscount($this->PHPShopCart->getSum());

                // �����
                $this->total = $this->PHPShopOrder->returnSumma($this->sum, $this->discount) + $this->delivery;

                // ��������� �� e-mail
                $this->mail();

                // ������� ������ � �������� �������
                $this->setHook(__CLASS__, __FUNCTION__, $_POST, 'MIDDLE');

                // ����������� ������ ������ �� ������
                if (file_exists("./payment/$path/order.php"))
                    include_once("./payment/$path/order.php");
                elseif ($order_metod < 1000)
                    exit("��� ����� ./payment/$path/order.php");

                // ������ �� ������� ������
                if (!empty($disp))
                    $this->set('orderMesage', $disp);

                // ������ ������ � ��
                $this->write();

                // SMS ��������������
                $this->sms();

                // ��������� �������� �������
                $PHPShopCartElement = new PHPShopCartElement(true);
                $PHPShopCartElement->init('miniCart');
            }
            else {
                $this->set('mesageText', $this->message($this->lang('bad_order_mesage_1'), $this->lang('bad_order_mesage_2')));

                // ���������� ������
                $disp = ParseTemplateReturn($this->getValue('templates.order_forma_mesage'));
                $disp.=PHPShopText::notice(PHPShopText::a('javascript:history.back(1)', $this->lang('order_return')), 'images/shop/icon-setup.gif');
                $this->set('orderMesage', $disp);
            }
        } else {

            $this->set('mesageText', $this->message($this->lang('bad_cart_1'), $this->lang('bad_order_mesage_2')));
            $disp = ParseTemplateReturn($this->getValue('templates.order_forma_mesage'));
            $this->set('orderMesage', $disp);
        }

        // ������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $_POST, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.order_forma_mesage_main'));
    }

    /**
     *  ��������� �� �������� ������
     */
    function mail() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST, 'START'))
            return true;

        $this->set('cart', $this->PHPShopCart->display('mailcartforma', array('currency' => $this->currency)));
        $this->set('sum', $this->sum);
        $this->set('currency', $this->currency);
        $this->set('discount', $this->discount);
        $this->set('deliveryPrice', $this->delivery);
        $this->set('total', $this->total);
        $this->set('shop_name', $this->PHPShopSystem->getName());
        $this->set('ouid', $this->ouid);
        $this->set('date', date("d-m-y"));
        $this->set('name_person', $_POST['name_person']);
        $this->set('tel', @$_POST['tel_code'] . "-" . @$_POST['tel_name']);
        $this->set('adr_name', PHPShopSecurity::CleanStr(@$_POST['adr_name']));
        $this->set('dos_ot', @$_POST['dos_ot']);
        $this->set('dos_do', @$_POST['dos_do']);
        $this->set('deliveryCity', $this->PHPShopDelivery->getCity());
        $this->set('mail', $_POST['mail']);
        $this->set('payment', $this->PHPShopPayment->getName());
        $this->set('company', $this->PHPShopSystem->getParam('name'));
        $content = ParseTemplateReturn('./phpshop/lib/templates/order/usermail.tpl', true);

        // ��������� ������ ����������
        $title = $this->PHPShopSystem->getName() . $this->lang('mail_title_user_start') . $_POST['ouid'] . $this->lang('mail_title_user_end');

        // �������� ������ � �������� �������
        if ($this->setHook(__CLASS__, __FUNCTION__, $content, 'MIDDLE'))
            return true;

        // �������� ������ ����������
        $PHPShopMail = new PHPShopMail($_POST['mail'], $this->PHPShopSystem->getParam('adminmail2'), $title, $content);

        $this->set('shop_admin', "http://" . $_SERVER['SERVER_NAME'] . $this->getValue('dir.dir') . "/phpshop/admpanel/");
        $this->set('time', date("d-m-y H:i a"));
        $this->set('ip', $_SERVER['REMOTE_ADDR']);
        $content_adm = ParseTemplateReturn('./phpshop/lib/templates/order/adminmail.tpl', true);

        // ��������� ������ ��������������
        $title_adm = $this->PHPShopSystem->getName() . ' - ' . $this->lang('mail_title_adm') . $_POST['ouid'] . "/" . date("d-m-y");

        // �������� ������ � ����� �������
        if ($this->setHook(__CLASS__, __FUNCTION__, $content_adm, 'END'))
            return true;

        // �������� ������ ��������������
        $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getParam('adminmail2'), $_POST['mail'], $title_adm, $content_adm);
    }

    /**
     * SMS ����������
     */
    function sms() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        if ($this->PHPShopSystem->ifSerilizeParam('admoption.sms_enabled')) {

            $msg = $this->lang('mail_title_adm') . $this->ouid . " - " . $this->sum . $this->currency;
            $phone = $this->getValue('sms.phone');

            include_once($this->getValue('file.sms'));
            SendSMS($msg, $phone);
        }
    }

    /**
     * ������ ������ � ��
     */
    function write() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST, 'START'))
            return true;

        // ������ ����������
        $person = array(
            "ouid" => $this->ouid,
            "data" => date("U"),
            "time" => date("H:s a"),
            "mail" => PHPShopSecurity::TotalClean($_POST['mail'],3),
            "name_person" => PHPShopSecurity::TotalClean(@$_POST['name_person']),
            "org_name" => PHPShopSecurity::TotalClean(@$_POST['org_name']),
            "org_inn" => PHPShopSecurity::TotalClean(@$_POST['org_inn']),
            "org_kpp" => PHPShopSecurity::TotalClean(@$_POST['org_kpp']),
            "tel_code" => PHPShopSecurity::TotalClean(@$_POST['tel_code']),
            "tel_name" => PHPShopSecurity::TotalClean(@$_POST['tel_name']),
            "adr_name" => PHPShopSecurity::TotalClean(@$_POST['adr_name']),
            "dostavka_metod" => intval(@$_POST['dostavka_metod']),
            "discount" => $this->discount,
            "user_id" => intval($_SESSION['UsersId']),
            "dos_ot" => PHPShopSecurity::TotalClean(@$_POST['dos_ot']),
            "dos_do" => PHPShopSecurity::TotalClean(@$_POST['dos_do']),
            "order_metod" =>intval(@$_POST['order_metod']));

        // ������ �� �������
        $cart = array(
            "cart" => $this->PHPShopCart->getArray(),
            "num" => $this->num,
            "sum" => $this->sum,
            "weight" => $this->weight,
            "dostavka" => $this->delivery);

        // ������ ������
        $this->status = array(
            "maneger" => "",
            "time" => "");

        // ��������������� ������ ������
        $this->order = serialize(array("Cart" => $cart, "Person" => $person));

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST, 'END'))
            return true;

        // ������ ��� ������
        $insert = $_POST;
        $insert['datas_new'] = time();
        $insert['uid_new'] = $this->ouid;
        $insert['orders_new'] = $this->order;
        $insert['status_new'] = serialize($this->status);
        $insert['user_new'] = intval($_SESSION['UsersId']);

        // ������ ������ � ��
        $result = $this->PHPShopOrm->insert($insert);

        // �������� ������ ��� ������ ������
        $this->error_report($result, array("Cart" => $cart, "Person" => $person, 'insert' => $insert));

        // �������������� ������� �������
        if ($this->cart_clean_enabled)
           $this->PHPShopCart->clean();
    }

    /**
     * ����� �������������� �� ������
     * @param mixed $result ��������� ���������� ������ ������ � ��
     * @param array $var ������ ������
     * @return boolean 
     */
    function error_report($result, $var) {

        if (!is_bool($result)) {

            // ��������� ������ ��������������
            $title = '������ ������ ������ �' . $_POST['ouid'] . ' �� ' . $this->PHPShopSystem->getName() . "/" . date("d-m-y");

            $content = '������� ������ ������: ' . $result . '
����:
';
            ob_start();
            print_r($var);
            $content.= ob_get_clean();

            // �������� ������ � ����� �������
            if ($this->setHook(__CLASS__, __FUNCTION__, $content))
                return true;

            // �������� ������ � ������� ��������������
            new PHPShopMail($this->PHPShopSystem->getParam('adminmail2'), $_POST['mail'], $title, $content);
        }
    }

}

/**
 * ������ ������ ������� �������
 */
function mailcartforma($val, $option) {
    global $PHPShopModules;

    // �������� ������
    $hook = $PHPShopModules->setHookHandler(__FUNCTION__, __FUNCTION__, $val, $option);
    if ($hook)
        return $hook;

    $dis =
            $val['uid'] . "  " . $val['name'] . " (" . $val['num'] . " " . $val['ed_izm'] . " * " . $val['price'] . ") -- " . ($val['price'] * $val['num']) . " " . $option['currency'] . "
";
    return $dis;
}

?>