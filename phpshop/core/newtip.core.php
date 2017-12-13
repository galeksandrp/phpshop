<?php

/**
 * ���������� ������� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopNewtip
 * @version 1.2
 * @package PHPShopShopCore
 */
class PHPShopNewtip extends PHPShopShopCore {

    var $debug = false;
    var $cache = true;
    var $cache_format = array('content', 'yml_bid_array');
    var $cell;

    /**
     * �����������
     */
    function PHPShopNewtip() {

        parent::PHPShopShopCore();
        $this->PHPShopOrm->cache_format = $this->cache_format;
    }

    /**
     * ����� ������ �������
     */
    function index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ���� ��� ���������
        $this->objPath = './newtip_';

        // ������
        $this->set('productValutaName', $this->currency());

        $this->set('catalogCategory', $this->lang('newprod'));

        // ���������� �����
        if (empty($this->cell))
            $this->cell = $this->calculateCell("newtip", $this->PHPShopSystem->getValue('num_vitrina'));

        // ������ ����������
        $order = $this->query_filter("newtip='1'");

        // ���-�� ������� �� ��������
        // ���� 0 ������ �� ������� ���-�� ������� * 2 ������.
        if (!$this->num_row)
            $this->num_row = (6 - $this->cell) * $this->cell;

        // ������� ������
        if (is_array($order)) {
            $this->dataArray = parent::getListInfoItem(array('*'), array('newtip' => "='1'", 'enabled' => "='1'"), $order, __CLASS__, __FUNCTION__);
        } else {
            // ������� ������
            $this->PHPShopOrm->sql = $order;
            $this->PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
            $this->dataArray = $this->PHPShopOrm->select();
            $this->PHPShopOrm->clean();
        }


        // ���������
        if (is_array($order))
            $this->setPaginator(count($this->dataArray));

        // ��������� � ������ ������ � ��������
        $grid = $this->product_grid($this->dataArray, $this->cell);
        if (empty($grid))
            $grid = PHPShopText::h2($this->lang('empty_product_list'));
        $this->add($grid, true);

        // ���������
        $this->title = $this->lang('newprod') . " - " . $this->PHPShopSystem->getParam('title');

        // ��������� ������� ������
        $this->navigation(null, __('�������'));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_page_spec_list'));
    }

    /**
     * ��������� SQL ������� �� �������� ��������� � ���������
     * @return mixed
     */
    function query_filter($where = false) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $where);
        if (!empty($hook))
            return $hook;

        return parent::query_filter($where);
    }

}

?>