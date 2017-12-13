<?php
/**
 * ���������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopCategory extends PHPShopObj {
    /**
     * �����������
     * @param int $objID �� ���������
     */
    function PHPShopCategory($objID) {
        $this->objID=$objID;
        $this->objBase=$GLOBALS['SysValue']['base']['table_name'];
        parent::PHPShopObj();
    }
    /**
     * ������ ����� ���������
     * @return string 
     */
    function getName() {
        return parent::getParam("name");
    }
    /**
     * ������ �������� ���������
     * @return string 
     */
    function getContent() {
        return parent::getParam("content");
    }
    /**
     * �������� �� �������������
     * @return bool
     */
    function init() {
        $id=parent::getParam("id");
        if(!empty($id)) return true;
    }

}

/**
 * ��������
 * ���������� ������ � ���������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopPages extends PHPShopObj{

         /**
          * �����������
          * @param int $objID �� ��������
          */
	 function PHPShopPages($objID){
	 $this->objID=$objID;
	 $this->objBase=$GLOBALS['SysValue']['base']['table_name11'];
	 parent::PHPShopObj();
	 }
         /**
          * ������ ����� ��������
          * @return string
          */
	 function getName(){
	 return parent::getParam("name");
	 }

         /**
          * ������ ����������
          * @return string
          */
	 function getContent(){
	 return parent::getParam("content");
	 }
}
?>