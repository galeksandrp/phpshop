<?php

/**
 * ���������� ������� ������� �� ���������������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopSelection
 * @version 1.2
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
    var $max_item = 250;

    /**
     * ����, �������� � �������� ������� �������� ��� ����� ��������������. True - �������������. False - ��������.
     * @var bool
     */
    var $descrFlag = false;

    /**
     * �����������
     */
    function PHPShopSelection() {

        PHPShopObj::loadClass("sort");

        // ������ �������
        $this->action = array("get" => "v", 'nav' => 'index');
        parent::PHPShopShopCore();
        $this->PHPShopOrm->cache_format = $this->cache_format;
    }

    function index() {
        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, null, 'START'))
            return true;

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
        if (empty($this->cell) and isset($_GET['gridChange']))
            $this->cell = $this->calculateCell("selection", $this->PHPShopSystem->getValue('num_vitrina'));
        elseif (empty($this->cell))
            $this->cell = 1;

        // ������ ����������
        $order = $this->query_filter();

        if (!is_array($order)) {
            $this->PHPShopOrm->sql = $order;
            $this->PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
            $this->dataArray = $this->PHPShopOrm->select();
        }

        // ��������� � ������ ������ � ��������
        $grid = $this->product_grid($this->dataArray, $this->cell);
        if (empty($grid))
            $grid = PHPShopText::h2($this->lang('empty_product_list'));
        $this->add($grid, true);

        // ID ��������������
        foreach ($_GET['v'] as $key => $val) {
            if ($this->descrFlag)
                $v = intval($key);
            else
                $v = intval($val);
        }

        // �������� �������� ��������������
        $PHPShopOrm = new PHPShopOrm();
        $result = $PHPShopOrm->query('SELECT a.*, b.content FROM ' . $this->getValue("base.sort") . ' AS a JOIN ' . $this->getValue("base.page") . ' AS b ON a.page = b.link where a.id = ' . $v . ' limit 1');
        $row = mysql_fetch_array($result);
        if (is_array($row)) {

            // ��������
            $this->set('sortDes', stripslashes($row['content']));

            // ��������
            $this->set('sortName', $row['name']);

            // ���������
            $this->title = __('������ �������') . " - " . $row['name'] . " - " . $this->PHPShopSystem->getParam('title');
            $this->description = __('������ �������') . " - " . $row['name'];
            $this->keywords = $row['name'];
        }
        else
            $this->title = __('������ �������') . " - " . $this->PHPShopSystem->getParam('title');

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_selection_list'));
    }

}

?>