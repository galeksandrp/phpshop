<?php
/**
 * ���������� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */

class PHPShopOpros extends PHPShopCore {
    
    /**
     * �����������
     */
    function PHPShopOpros() {
        global $PHPShopOprosElement;
        
        // �������
        $this->debug=false;
        
        // �������� ������
        $this->element=$PHPShopOprosElement;
        
        // ������ �������
        $this->action=array("post"=>"getopros","nav"=>"index","get"=>"add_forma");
        parent::PHPShopCore();
    }
    
    /**
     * ����� �� ���������, ����� ���������� ������
     */
    function index() {
        
        // ������� ������
        $PHPShopOrm = &new PHPShopOrm($this->getValue('base.opros_categories'));
        $PHPShopOrm->debug=$this->debug;
        $dataArray=$PHPShopOrm->select(array('*'),array('flag'=>"='1'"),array('order'=>'id DESC'),array('limit'=>10));
        $content='';
        if(is_array($dataArray))
            foreach($dataArray as $row) {
                
                // ���������� ����������
                $content.=PHPShopText::h1($row['name']);
                $content.="<table>".$this->element->getOprosValue($row['id'],"RESULT")."<table>";
                $content.=PHPShopText::p();
                
            }
        

        // ����
        $this->title="����� - ".$this->PHPShopSystem->getValue("name");

        $this->set('oprosName',false);
        $this->set('oprosContent',$content);
        
        // ���������� ������
        $this->parseTemplate($this->getValue('templates.opros_page_list'));
    }
    
    /**
     * ����� ���������� ������ ��� ������� ���������� $_POST[getopros]
     */
    function getopros() {
        
        if(!empty($_COOKIE['opros']))
            $this->update($_POST['getopros'],false);
        else {
            // ����� ����
            setcookie("opros", $_POST['getopros'], time()+60*60*24*1, "/opros/", $_SERVER['SERVER_NAME'], 0);
            $this->update($_POST['getopros'],true);
        }
    }
    
    /**
     * ������ ������
     * @param int $valueID �� ������
     * @param Bool $flag �������� �� ����� �����
     */
    function update($valueID,$flag) {
        $valueID=PHPShopSecurity::TotalClean($valueID,1);
        
        // ����� �����
        if($flag) {
            
            $PHPShopOrm = &new PHPShopOrm($this->getValue('base.opros'));
            $dataArray=$PHPShopOrm->select(array('total'),array('id'=>"=$valueID"),false,array('limit'=>1));
            $total=$dataArray['total']+1;
            $PHPShopOrm->update(array('total'=>$total),array('id'=>"=$valueID"),$prefix='');
            
            
            // ���������� ����������
            $this->set('mesageText','<FONT style="font-size:14px;color:red"><B>'.$this->getValue('lang.good_opros_mesage_1').'</B></FONT>
            <BR>'.$this->getValue('lang.good_opros_mesage_2'));
            
        }
        
        // ������ �����
        else {
            
            // ���������� ����������
            $this->set('mesageText','<FONT style="font-size:14px;color:red"><B>'.$this->getValue('lang.bad_opros_mesage_1').'</B></FONT>
            <BR>'.$this->getValue('lang.bad_opros_mesage_2'));
            
        }
        
        $this->parseTemplate($this->getValue('templates.news_forma_mesage'));
    }
    
}
?>