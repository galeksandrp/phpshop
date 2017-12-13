<?php

/**
 * ���������� ��������������� ��������� �� ������� ��������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopCore
 */
class PHPShopIndex extends PHPShopCore {

    /**
     * ����������� ����� ������� �� 404 �����.
     * @var bool 
     */
    var $default_server_error_page = false;

    function PHPShopIndex() {
        $this->objBase = $GLOBALS['SysValue']['base']['table_name11'];
        $this->debug = false;
        $this->template = 'templates.index';
        parent::PHPShopCore();
    }

    function index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ������ �� SEO ��������
        $this->seoguard();

        // ������� ������
        $row = parent::getFullInfoItem(array('name,content'), array('category' => "=2000", 'enabled' => "='1'"));

        // ���������� ����������
        $this->set('mainContent', Parser($row['content']));
        $this->set('mainContentTitle', Parser($row['name']));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
    }

    /*
     * ������ �� ������ /?������
     */
    function seoguard() {
        if ($this->PHPShopNav->index()) {
            if (!empty($_GET) and empty($_GET['skin']) and empty($_GET['logout']) and empty($_GET['partner']) and empty($_GET['debug'])) {
                $this->setError404();
                if ($this->default_server_error_page)
                    exit();
            } elseif (!empty($_GET['skin']) and $this->PHPShopSystem->getSerilizeParam("admoption.user_skin") != 1) {
                $this->setError404();
                if ($this->default_server_error_page)
                    exit();
            }
        }
    }

}
?>