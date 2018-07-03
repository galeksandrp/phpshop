<?php

/**
 * ���������� ����� ��������� � �����
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopForma
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopForma extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;

        // ������ �������
        $this->action = array("post" => "content", "post" => "name", "nav" => "index");
        parent::__construct();
    }

    /**
     * ����� �� ���������, ����� ����� �����
     */
    function index() {

        // ����
        $title = __('����� �����');
        $this->title = $title . $this->PHPShopSystem->getValue("name");

        // ���������� ����������
        $this->set('pageTitle', $title);

        // ��������� ������� ������
        $this->navigation(null, $title);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__);

        // ���������� ������
        $this->addToTemplate("forma/page_forma_list.tpl");

        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� �������� ����� ��� ��������� $_POST[name]
     */
    function name() {
        $this->content();
    }

        /**
     * �������� �����
     * @param array $option ��������� �������� [url|captcha|referer]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true, 'referer' => true)) {
        global $PHPShopRecaptchaElement;

        return $PHPShopRecaptchaElement->security($option);
    }
    /**
     * ����� �������� ����� ��� ��������� $_POST[content]
     */
    function content() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST))
            return true;

        // ������������
        if ($this->security()) {
            $this->send();
        }
        else
            $this->set('Error', __("������ �����, ��������� ������� ����� �����"));
        
        $this->index();
    }

    /**
     * ��������� ���������
     */
    function send() {

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST))
            return true;

        if (!empty($_POST['tema']) and !empty($_POST['name']) and !empty($_POST['content'])) {
            $subject = $_POST['tema'] . " - " . $this->PHPShopSystem->getValue('name');
            $message = "{��� ������ ��������� � �����} " . $this->PHPShopSystem->getValue('name') . "

{������ � ������������}:
----------------------
";
            unset($_POST['g-recaptcha-response']);

            // ���������� �� ���������
            foreach ($_POST as $k => $val) {
                $message.=$val . "
";
                unset($_POST[$k]);
            }

            $message.="
{����}: " . date("d-m-y H:s a") . "
IP: " . $_SERVER['REMOTE_ADDR'];

            new PHPShopMail($this->PHPShopSystem->getEmail(), $this->PHPShopSystem->getEmail(), $subject, Parser($message), false, false, array('replyto' => $_POST['mail']));

            $this->set('Error', __("��������� ������� ����������"));
        }
        else
            $this->set('Error', __("�� ��������� ������������ ����"));
    }
}
?>