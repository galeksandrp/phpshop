<?php

/**
 * ���������� ������� ������� �� ���������������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopShopCore
 */
class PHPShopSelection extends PHPShopShopCore {

    /**
     * �������
     * @var bool
     */
    var $debug = false;
    /*
     * �����������
     */
    var $cache = false;

    /**
     * ����� ������ �������
     * @var int
     */
    var $max_item = 100;

    /**
     * �����������
     */
    function PHPShopSelection() {

        // ������ �������
        $this->action = array("get" => "v", 'nav' => 'index');
        parent::PHPShopShopCore();
        $this->PHPShopOrm->cache_format = $this->cache_format;
    }

    function index() {
        $this->setError404();
    }

    /**
     * ����� ������ �������
     */
    function v() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, null, 'START'))
            return true;

        // ������
        $this->set('productValutaName', $this->currency());

        // ���������� �����
        $cell = $this->PHPShopSystem->getValue('num_vitrina');

        // ������ ����������
        $order = $this->query_filter();

        if (!is_array($order)) {
            $this->PHPShopOrm->sql = $order;
            $this->PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
            $this->dataArray = $this->PHPShopOrm->select();
        }

        // ��������� � ������ ������ � ��������
        $grid = $this->product_grid($this->dataArray, $cell);
        if (empty($grid))
            $grid = PHPShopText::h2($this->lang('empty_product_list'));
        $this->add($grid, true);

        // ���������
        $this->title = __('����� �� ��������������') . " - " . $this->PHPShopSystem->getParam('title');

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_selection_list'));
    }

}

?>