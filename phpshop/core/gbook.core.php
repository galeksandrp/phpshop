<?php
/**
 * ���������� �������� �����
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopGbook extends PHPShopCore {
    
    /**
     * �����������
     */
    function PHPShopGbook() {
        
        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['table_name7'];
        
        // ���� ��� ���������
        $this->objPath="/gbook/gbook_";
        
        // �������
        $this->debug=false;
        
        // ������ �������
        $this->action=array("post"=>"send_gb","nav"=>"index","nav"=>"ID","get"=>"add_forma");
        parent::PHPShopCore();
    }
    
    /**
     * ����� �� ���������, ����� �������
     */
    function index() {

        // ��������� � ������ ������
        if(!empty($_GET['write']))
        $this->set('Error',"��������� ������� ���������.");
        
        // ������� ������
        $this->dataArray=parent::getListInfoItem(array('*'),array('flag'=>"='1'"),array('order'=>'id DESC'));
        
        // 404
        if(!isset($this->dataArray)) return $this->setError404();
        
        if(is_array($this->dataArray))
            foreach($this->dataArray as $row) {
                
                // ������ �� ������
                if(!empty($row['mail']))  $d_mail="<a href=\"mailto:$row[mail]\"><b>$row[name]</b></a>";
                else  $d_mail="<b>$row[name]</b>";
                
                // ���������� ���������
                $this->set('gbookData',PHPShopDate::dataV($row['datas']));
                $this->set('gbookName',$row['name']);
                $this->set('gbookTema',$row['tema']);
                $this->set('gbookMail',$d_mail);
                $this->set('gbookOtsiv',$row['otsiv']);
                $this->set('gbookOtvet',$row['otvet']);
                $this->set('gbookId',$row['id']);
                
                // ���������� ������
                $this->addToTemplate($this->getValue('templates.main_gbook_forma'));
            }
        
        // ���������
        $this->setPaginator();
        
        
        // ���������� ������
        $this->parseTemplate($this->getValue('templates.gbook_page_list'));
        
        // ������ �� ����� �����
        $this->add($this->attachLink());
    }
    
    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� ID
     * @return string 
     */
    function ID() {
        
        // ������������
        if(!PHPShopSecurity::true_num($this->PHPShopNav->getId())) return $this->setError404();
        
        // ������� ������
        $row=parent::getFullInfoItem(array('*'),array('id'=>'='.$this->PHPShopNav->getId()));
        
        // 404
        if(!isset($row)) return $this->setError404();
        
        // ������ �� ������
        if(!empty($row['mail']))  $d_mail="<a href=\"mailto:$row[mail]\"><b>$row[name]</b></a>";
        else  $d_mail="<b>$row[name]</b>";
        
        
        // ���������� ���������
        $this->set('gbookData',PHPShopDate::dataV($row['datas']));
        $this->set('gbookName',$row['name']);
        $this->set('gbookTema',$row['tema']);
        $this->set('gbookMail',$d_mail);
        $this->set('gbookOtsiv',$row['otsiv']);
        $this->set('gbookOtvet',$row['otvet']);
        $this->set('gbookId',$row['id']);
        
        // ���������� ������
        $this->addToTemplate($this->getValue('templates.main_gbook_forma'));
        
        // ����
        $this->title=$row['tema']." - ".$this->PHPShopSystem->getValue("name");
        $this->description=strip_tags($row['otsiv']);
        $this->lastmodified=PHPShopDate::GetUnicTime($row['datas']);
        
        
        // ���������� ������
        $this->parseTemplate($this->getValue('templates.gbook_page_list'));
    }
    
    /**
     * ������ �� ����� �����
     * @return string 
     */
    function attachLink() {
        return PHPShopText::div(PHPShopText::a('/gbook/?add_forma=tru','�������� �����'),'center','padding:20');
    }
    
    /**
     * ����� �����
     */
    function add_forma() {
        $this->parseTemplate($this->getValue('templates.gbook_forma_otsiv'));
    }
    
    /**
     * ����� ������ ������ ��� ��������� $_POST[send_gb]
     */
    function send_gb() {
        if(!empty($_SESSION['text']) and $_POST['key']==$_SESSION['text']) {
            $this->write();
            header("Location: ../gbook/?write=ok");
        }else {
            $this->set('Error',"������ �����, ��������� ������� ����� �����");
            $this->parseTemplate($this->getValue('templates.gbook_forma_otsiv'));
        }
    }
    
    /**
     * ������ ������ � ����
     */
    function write() {
        
        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");
        
        if(isset($_POST['send_gb'])) {
            if(!preg_match("/@/",$_POST['mail_new']))//�������� �����
            {
                $_POST['mail_new']="";
            }
            if(!empty($_POST['name_new']) and !empty($_POST['otsiv_new']) and !empty($_POST['tema_new'])) {
                $name_new=PHPShopSecurity::TotalClean($_POST['name_new'],2);
                $otsiv_new=PHPShopSecurity::TotalClean($_POST['otsiv_new'],2);
                $tema_new=PHPShopSecurity::TotalClean($_POST['tema_new'],2);
                $mail_new=addslashes($_POST['mail_new']);
                $date = date("U");
                $ip=$_SERVER['REMOTE_ADDR'];
                
                // ������ � ����
                $this->PHPShopOrm->insert(array('datas'=>$date,'name'=>$name_new,'mail'=>$mail_new,'tema'=>$tema_new,'otsiv'=>$otsiv_new),
                        $prefix='');
                
                $zag=$this->PHPShopSystem->getValue('name')." - ����������� � ��������� ������ / ".$date;
                $message="
������� �������!
---------------

� ����� ".$this->PHPShopSystem->getValue('name')." ������ ����������� � ��������� ������
� �������� �����.

������ � ������������:
----------------------

���:                ".$name_new."
E-mail:             ".$mail_new."
���� ���������:     ".$tema_new."
���������:          ".$otsiv_new."
����:               ".date("d-m-y")."
IP:                 ".$ip."

---------------

� ���������,
http://".$_SERVER['SERVER_NAME'];
                
                $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'),$mail_new,$zag,$message);
                
                
            }
        }
    }
    
}
?>