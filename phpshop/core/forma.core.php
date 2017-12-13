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
        $this->action=array("post"=>"content","nav"=>"index");
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

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__);

        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� �������� ����� ��� ��������� $_POST[content]
     */
    function content() {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,$_POST))
                return true;

        if(!empty($_SESSION['text']) and $_POST['key']==$_SESSION['text']) {
            $this->send();
            $this->set('Error',"��������� ������� ����������");
        }else $this->set('Error',"������ �����, ��������� ������� ����� �����");
        $this->index();
    }


    /**
     * ��������� ���������
     */
    function send() {

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,$_POST))
                return true;

		if( !empty($_POST['tema']) and !empty($_POST['name']) and !empty($_POST['content'])) {

            $zag=$_POST['tema']." - ".$this->PHPShopSystem->getValue('name');
            
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