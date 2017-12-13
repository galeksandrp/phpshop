<?php
/**
 * ���������� ��������������� ��������� �� ������� ��������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopIndex extends PHPShopCore {

    function PHPShopIndex() {
        $this->objBase=$GLOBALS['SysValue']['base']['table_name11'];
        $this->debug=false;
        $this->template='templates.index';
        parent::PHPShopCore();
    }


    function index() {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,false,'START'))
                return true;

        // ������� ������
        $row=parent::getFullInfoItem(array('name,content'),array('category'=>"=2000",'enabled'=>"='1'"));

        // ���������� ���������
        $this->set('mainContent',Parser($row['content']));
        $this->set('mainContentTitle',$row['name']);

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,$row,'END');
    }
}
?>