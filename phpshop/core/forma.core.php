<?php

/**
 * ���������� ����� ��������� � �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopForma extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopForma() {
        $this->debug=false;
        
        // ������ �������
        $this->action=array("post"=>"message","nav"=>"index");
        parent::PHPShopCore();
    }


    /**
     * ����� �� ���������, ����� ����� �����
     */
    function index() {

        // ����
        $this->title="����� ����� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ����������
        $this->set('pageTitle','����� �����');

        // ���������� ������
        $this->addToTemplate("forma/page_forma_list.tpl");
        $this->parseTemplate($this->getValue('templates.page_page_list'));

    }

    /**
     * ����� �������� ����� ��� ��������� $_POST[message]
     */
    function message() {
        if(!empty($_SESSION['text']) and $_POST['key']==$_SESSION['text']) {
            $this->send();
            $this->set('Error',"��������� ������� ����������");
        }else $this->set('Error',"������ �����, ��������� ������� ����� �����");
    }


    /**
     * ��������� ���������
     */
    function send() {

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");

        if( !empty($_POST['nameP']) and !empty($_POST['subject']) and !empty($_POST['message']) and !empty($_POST['mail'])) {

            $zag=$this->$_POST['subject']." - ".$this->PHPShopSystem->getValue('name');
            
            $message="��� ������ ��������� � ����� ".$this->PHPShopSystem->getValue('name')."

������ � ������������:
----------------------
";

            // ���������� �� ���������
            foreach($_POST as $key=>$val)
$message.=$val."
";

            $message.="
����:               ".date("d-m-y H:s a")."
IP:
".$_SERVER['REMOTE_ADDR']."
---------------

� ���������,
http://".$_SERVER['SERVER_NAME'];

            $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'),$_POST['mail'],$zag,$message);
        }
    }

}
?>