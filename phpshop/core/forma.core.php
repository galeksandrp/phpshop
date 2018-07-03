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
        
        preg_match_all('/http:?/', $_POST['content'], $url, PREG_SET_ORDER);

        if (!empty($_SESSION['text']) and strtoupper($_POST['key']) == strtoupper($_SESSION['text']) and strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']) and count($url)==0) {
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

            $subject = $_POST['tema'] . " - " . $this->PHPShopSystem->getValue('name');

            $message = "��� ������ ��������� � ����� " . $this->PHPShopSystem->getValue('name') . "

������ � ������������:
----------------------
";

            // ���������� �� ���������
            foreach ($_POST as $k=>$val){
                $message.=$val . "
";
            unset($_POST[$k]);   

            }

            $message.="
����: " . date("d-m-y H:s a") . "
IP: " . $_SERVER['REMOTE_ADDR'];
            
            new PHPShopMail($this->PHPShopSystem->getEmail(), $this->PHPShopSystem->getEmail(), $subject, $message, false, false, array('replyto'=>$_POST['mail']));
            
            $this->set('Error', "��������� ������� ����������");
        }
        else
            $this->set('Error', "�� ��������� ������������ ����");
    }

}

?>