<?php

class PHPShopIndex extends PHPShopCore {

    function PHPShopIndex() {
        $this->objBase=$GLOBALS['SysValue']['base']['table_name11'];
        $this->debug=false;
        $this->template='templates.index';
        parent::PHPShopCore();
    }


    function index() {

        // ������� ������
        $row=parent::getFullInfoItem(array('name,content'),array('category'=>"=2000",'enabled'=>"='1'"));

        // ���������� ���������
        $this->set('mainContent',Parser($row['content']));
        $this->set('mainContentTitle',$row['name']);

    }
}
?>