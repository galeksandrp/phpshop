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

    /**
     * ����������� _GET ����������
     * @var array
     */
    var $true_get_params=array('skin','logout','partner','debug','mobile','fullversion');

    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['table_name11'];
        $this->debug = false;
        $this->template = 'templates.index';
        parent::__construct();
    }

    function index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ������ �� SEO ��������
        //$this->seoguard();

        // ������� ������
        $row = parent::getFullInfoItem(array('id,name,content'), array('category' => "=2000", 'enabled' => "='1'"));

        // ���������� ����������
        $this->set('mainContent', Parser($row['content']));
        $this->set('mainContentTitle', Parser($row['name']));
        $this->PHPShopNav->objNav['id']=$row['id'];

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
    }

    /*
     * ������ �� ������ /?������
     */
    function seoguard() {
        if ($this->PHPShopNav->index()) {
            parse_str($_SERVER['QUERY_STRING'],$val);
            $keys=array_keys($val);
            if (!empty($_GET) and array_diff($keys,$this->true_get_params)) {
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