<?php
/**
 * ���������� ������ ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopFail extends PHPShopCore {
    
    /**
     * �����������
     */
    function PHPShopFail() {
        parent::PHPShopCore();
    }
    /**
     * �����
     */
    function index() {
        
        $this->set('orderNum',__('Abort Payment'));

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__);

        $this->parseTemplate("error/error_payment.tpl");
    }
}

?>