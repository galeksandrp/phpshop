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
        $this->title = "����� ����� - " . $this->PHPShopSystem->getValue("name");

        // ���������� ����������
        $this->set('pageTitle', '����� �����');

        // ��������� ������� ������
        $this->navigation(null, '����� �����');

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
     * ����� �������� ����� ��� ��������� $_POST[content]
     */
    function content() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST))
            return true;

        if (!empty($_SESSION['text']) and strtoupper($_POST['key']) == strtoupper($_SESSION['text'])) {
            $this->send();
        }
        else
            $this->set('Error', "������ �����, ��������� ������� ����� �����");
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

            $zag = $_POST['tema'] . " - " . $this->PHPShopSystem->getValue('name');

            $message = "��� ������ ��������� � ����� " . $this->PHPShopSystem->getValue('name') . "

������ � ������������:
----------------------
";

            // ���������� �� ���������
            foreach ($_POST as $key => $val)
                $message.=$val . "
";

            $message.="
����:               " . date("d-m-y H:s a") . "
IP:
" . $_SERVER['REMOTE_ADDR'] . "
---------------

� ���������,
http://" . $_SERVER['SERVER_NAME'];

            new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $_POST['mail'], $zag, $message, $f=false);
            $this->set('Error', "��������� ������� ����������");
        }
        else
            $this->set('Error', "�� ��������� ������������ ����");
    }

}

?>