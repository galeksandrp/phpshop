<?php
/**
 * ���������� �����
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopCore
 */
class PHPShopBlog extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {
        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['blog']['blog_log'];

        // ���� ��� ���������
        $this->objPath="/blog/blog_";

        // �������
        $this->debug=false;

        // ������ �������
        $this->action=array("nav"=>"ID");
        parent::__construct();
        
    }

    /**
     * ����� �� ���������
     */
  /**
     * ����� �� ���������
     */
    function index() {
        global $PHPShopModules;

        // ������� ������
       $this->dataArray=parent::getListInfoItem(array('*'),false,array('order'=>'id DESC'));

        // 404
        if(!isset($this->dataArray)) return $this->setError404();

        if(is_array($this->dataArray))
            foreach($this->dataArray as $row) {

                // ���������� ����������
                $this->set('blogId',$row['id']);
                $this->set('blogData',$row['date']);
                $this->set('blogZag',$row['title']);
                                
                                // ��������� ����
                $this->set('blogKratko',$row['description']);

                if(!empty($row['content'])){
                $this->set('blogComStart','');
                $this->set('blogComEnd','');
                }
                else {
                       $this->set('blogComStart','<!--');
                       $this->set('blogComEnd','-->');
                         }
                // �������� ������
                $PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $row);

                // ���������� ������
                $this->addToTemplate($GLOBALS['SysValue']['templates']['blog']['main_blog_forma'],true);
            }

        // ���������
        $this->setPaginator();

        // ����
        $this->title="���� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($GLOBALS['SysValue']['templates']['blog']['blog_page_list'],true);
    }


    /**
     * ��������� � ��������� ��������
     * @return string
     */
    function setPaginatorContent() {

        // ������ �������
        $curId = $this->PHPShopNav->getId();
        $prevId = $curId-1;
        $nextId = $curId+1;

        // �������� �������
        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->Option['where'] = ' or ';
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->sql = 'select id from '.$this->objBase.' where id='.$prevId.' or id='.$nextId;
        $row = $PHPShopOrm->select();

        // �������� �� ��������� ������
        if(count($row) == 1) $data[0] = $row;
        else $data = $row;

        if(is_array($data)) {

            if($data[0]['id'] == $prevId) $navigat='<a href="./ID_'.$prevId.'.html" title="'.$this->getValue('lang.prev_page').'">'.
                        $this->getValue('lang.prev_page').'</a>';
            else $navigat='';

            if($data[1]['id'] == $nextId) $navigat.=' | <a href="./ID_'.$nextId.'.html" title="'.$this->getValue('lang.next_page').'">'.
                        $this->getValue('lang.next_page').'</a>';
            else $navigat.='';
        }
        return $navigat;
    }


    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� ID
     * @return string
     */
    function ID() {
        global $PHPShopModules;

        // ������������
        if(!PHPShopSecurity::true_num($this->PHPShopNav->getId())) return $this->setError404();

        // ������� ������
        $row=parent::getFullInfoItem(array('*'),array('id'=>'='.$this->PHPShopNav->getId()));

        // 404
        if(!is_array($row)) return $this->setError404();

        // ���������� ���������
        $this->set('blogData',$row['date']);
        $this->set('blogZag',$row['title']);
        $this->set('blogKratko',$row['description']);
        $this->set('blogPodrob',$row['content']);

        // ���������
        $this->set('paginatorContent',$this->setPaginatorContent());

        // �������� ������
        $PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $row);

        // ���������� ������
        $this->addToTemplate($GLOBALS['SysValue']['templates']['blog']['main_blog_forma_full'],true);

        // ����
        $this->title=$row['title']." - ".$this->PHPShopSystem->getValue("name");
        $this->description=strip_tags($row['description']);
        $this->lastmodified=PHPShopDate::GetUnixTime($row['date']);

        // ���������� ������
        $this->parseTemplate($GLOBALS['SysValue']['templates']['blog']['blog_page_full'],true);
    }


    function meta() {
        global $PHPShopModules;
        parent::meta();

        // �������� ������
        $PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this);
    }
}
?>