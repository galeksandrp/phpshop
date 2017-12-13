<?php

if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

class PHPShopOneclick extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopOneclick() {

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
        parent::PHPShopCore();

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
     * ����� �� ���������, ����� ����� ������
     */
    function index($message = false) {

        return $this->setError404();
    }

    /**
     * ����� ������ ��� ��������� $_POST[returncall_mod_send]
     */
    function oneclick_mod_product_id() {
        if (PHPShopSecurity::true_param($_POST['oneclick_mod_name'], $_POST['oneclick_mod_tel'])) {
            $this->write();
            header('Location: ./done.html');
            exit();
        } else {
            $message = $GLOBALS['SysValue']['lang']['oneclick_error'];
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

        $zag = $this->PHPShopSystem->getValue('name') . " - ������� ����� - " . PHPShopDate::dataV($date);
        $message = "
������� �������!
---------------

� ����� " . $this->PHPShopSystem->getValue('name') . " ������ ������� �����

������ � ������������:
----------------------

���:                " . $insert['name_new'] . "
�������:            " . $insert['tel_new'] . "
�����:              " . $insert['product_name_new'] . " / ID " . $insert['product_id_new'] . " / " . $insert['product_price_new'] . "
���������:          " . $insert['message_new'] . "
����:               " . PHPShopDate::dataV($insert['date_new']) . "
IP:                 " . $_SERVER['REMOTE_ADDR'] . "

---------------

� ���������,
http://" . $_SERVER['SERVER_NAME'];

        new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $this->PHPShopSystem->getValue('adminmail2'), $zag, $message);
    }

}

?>