<?php
/**
 * ���������� �������� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */

class PHPShopLinks extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {
        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['links'];

        // ���� ��� ���������
        $this->objPath="/links/links_";

        // �������
        $this->debug=false;

        // ������ �������
        $this->action=array("nav"=>"index","get"=>"add_forma","post"=>"send_gb");
        parent::__construct();
    }


    /**
     * ����� �� ���������
     */
    function index() {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,false,'START'))
            return true;

        // ������� ������
        $this->dataArray=parent::getListInfoItem(array('*'),array('enabled'=>"='1'"),array('order'=>'num DESC'));

        // 404
        if(!isset($this->dataArray)) return $this->setError404();


        if(is_array($this->dataArray))
            foreach($this->dataArray as $row) {

                // ���������� ���������
                $this->set('linksImage',$row['image']);
                $this->set('linksName',$row['name']);
                $this->set('linksOpis',$row['opis']);
                $this->set('linksLink',$row['link']);

                // �������� ������
                $this->setHook(__CLASS__,__FUNCTION__,$row,'MIDDLE');

                // ���������� ������
                $this->addToTemplate($this->getValue('templates.main_links_forma'));
            }

        // ���������
        $this->setPaginator();

        // ����
        $this->title="�������� ������ - ".$this->PHPShopSystem->getValue("name");
        
        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,$this->dataArray,'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.links_page_list'));
    }

}
?>