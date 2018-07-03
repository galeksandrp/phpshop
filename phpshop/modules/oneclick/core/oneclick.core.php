<?php


class PHPShopOneclick extends PHPShopCore {

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
        if(!empty($message)) 
            $this->error($message);
        else 
        return $this->setError404();
    }
    
     /**
     * �������� �����
     * @param array $option ��������� �������� [url/captcha]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true,'referer' => true)) {
        global $PHPShopRecaptchaElement;
        
        return $PHPShopRecaptchaElement->security($option);
        
    }

    /**
     * ����� ������ ��� ��������� $_POST[returncall_mod_send]
     */
    function oneclick_mod_product_id() {

        if ($this->security()) {
            $this->write();
            header('Location: ./done.html');
            exit();
        } else {
            $message = __($GLOBALS['SysValue']['lang']['oneclick_error']);
        }
        $this->index($message);
    }

    /**
     * ������ � ����
     */
    function write() {

        $PHPShopProduct = new PHPShopProduct(intval($_POST['oneclick_mod_product_id']));

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");
        $insert = array();
        $insert['name_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_name'], 2);
        $insert['tel_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_tel'], 2);
        $insert['date_new'] = time();
        $insert['message_new'] = PHPShopSecurity::TotalClean($_POST['oneclick_mod_message'], 2);
        $insert['ip_new'] = $_SERVER['REMOTE_ADDR'];
        $insert['product_name_new'] = $PHPShopProduct->getName();
        $insert['product_id_new'] = intval($_POST['oneclick_mod_product_id']);
        $insert['product_price_new'] = $PHPShopProduct->getPrice() . ' ' . $this->PHPShopSystem->getDefaultValutaCode();

        // ������ � ����
        $this->PHPShopOrm->insert($insert);

        $zag = $this->PHPShopSystem->getValue('name') . " - ".__('������� �����')." - " . PHPShopDate::dataV();
        $message = "{������� �������}!
---------------

{� �����} " . $this->PHPShopSystem->getValue('name') . " {������ ������� �����}

{������ � ������������}:
----------------------

{���}:                " . $insert['name_new'] . "
{�������}:            " . $insert['tel_new'] . "
{�����}:              " . $insert['product_name_new'] . " / ID " . $insert['product_id_new'] . " / " . $insert['product_price_new'] . "
{���������}:          " . $insert['message_new'] . "
{����}:               " . PHPShopDate::dataV($insert['date_new']) . "
IP:                 " . $_SERVER['REMOTE_ADDR'] . "

---------------

http://" . $_SERVER['SERVER_NAME'];

        new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $this->PHPShopSystem->getValue('adminmail2'), $zag, $message);
    }

}

?>