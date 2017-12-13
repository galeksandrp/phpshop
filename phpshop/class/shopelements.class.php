<?php

/**
 * ����� �������� ��������� �������
 * ������� ������������� ��������� � ����� phpshop/inc/
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopProductElements
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopProductElements extends PHPShopElements {

    /**
     * @var bool �����������
     */
    var $cache = false;

    /**
     * @var array ������ ��������� ����
     */
    var $cache_format = array('content');

    /**
     * @var bool ����������� ����� ��������
     */
    var $grid = false;

    /**
     * @var bool ����������� ��������� ���������� ������� � �������
     * ��� �������������� ������� � ����� ������� ��������� ������ [false]
     */
    var $memory = false;

    /**
     * ��� ����������� ��������
     * @var string 
     */
    var $no_photo = 'images/shop/no_photo.gif';
    var $total = 0;
    var $product_grid;

    /**
     * �����������
     */
    function PHPShopProductElements() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];

        // ���������� ��������� �������
        PHPShopObj::loadClass('product');
        parent::PHPShopElements();

        // ������ ������
        $this->dengi = $this->PHPShopSystem->getParam('dengi');
    }

    /**
     * ������
     * @return string
     */
    function currency($name = 'code') {

        if (isset($_SESSION['valuta']))
            $currency = $_SESSION['valuta'];
        else
            $currency = $this->dengi;

        $row = $this->select(array($name), array('id' => '=' . intval($currency)), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.currency'), 'cache' => 'true'));

        return $row[$name];
    }

    /**
     * ����� ���������
     */
    function seamply() {

        // ���������� ����� ��� ������ ������
        $cell = 2;

        // ���-�� ������� �� ��������
        $limit = 4;

        $this->dataArray = $this->select(array('*'), array('enabled' => "='1'"), array('order' => 'RAND()'), array('limit' => $limit), __FUNCTION__);

        // ��������� � ������ ������ � ��������
        $this->product_grid($this->dataArray, $cell);

        // �������� � ���������� ������� � ��������
        $this->compile();
    }

    /**
     * ������ ���������� ������ �������
     * @param int $limit ���-�� ������� ��� ������
     * @return array
     */
    function setramdom($limit) {

        // ���� �� ��������� � ����
        if (empty($_SESSION['max_item'])) {
            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug = $this->debug;
            $PHPShopOrm->cache = false;
            $PHPShopOrm->sql = 'SELECT MAX(id) as max_item FROM ' . $GLOBALS['SysValue']['base']['products'];
            $data = $PHPShopOrm->select();

            if (is_array($data[0]))
                $this->max_item = $data[0]['max_item'];
            else
                $this->max_item = 0;

            // ��������� � ��� ����� ���-�� �������
            $_SESSION['max_item'] = $this->max_item;
        }
        else
            $this->max_item = $_SESSION['max_item'];

        $limit_start = rand(1, $this->max_item / rand(1, 7));
        return ' BETWEEN ' . $limit_start . ' and ' . round($limit_start + $limit + $this->max_item / 3);
    }

    /**
     * ������� �� ��
     */
    function select($select, $where, $order = false, $option = array('limit' => 1), $function_name = false, $from = false) {

        $cache_format = null;

        if (is_array($from)) {
            $base = $from['base'];
            $cache = $from['cache'];

            if (!empty($from['cache_format']))
                $cache_format = $from['cache_format'];
        }
        else {
            $base = $this->objBase;
            $cache = $this->cache;
            $cache_format = $this->cache_format;
        }

        $PHPShopOrm = new PHPShopOrm($base);
        $PHPShopOrm->objBase = $base;
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->cache = $cache;
        $PHPShopOrm->cache_format = $cache_format;
        $result = $PHPShopOrm->select($select, $where, $order, $option, __CLASS__, $function_name);

        return $result;
    }

    /**
     * ���� ������ �� ������� � �������
     * @return string
     */
    function compile() {
        $table = '<table cellpadding="0" cellspacing="0" border="0">' . $this->product_grid . '</table>';
        $this->product_grid = null;
        return $table;
    }

    /**
     * �������� ������ Multibase
     */
    function checkMultibase($pic_small) {

        $base_host = $this->PHPShopSystem->getSerilizeParam('admoption.base_host');
        if ($this->PHPShopSystem->getSerilizeParam('admoption.base_enabled') == 1 and !empty($base_host))
            $this->set('productImg', eregi_replace("/UserFiles/", "http://" . $base_host . "/UserFiles/", $pic_small));
    }

    /**
     * �������� �������������� ������ ������ �� ������
     * @param array $row ����� ������ �� ������
     */
    function checkStore($row) {

        // ���������� ��������� ������
        if ($this->PHPShopSystem->getSerilizeParam('admoption.sklad_enabled') == 1 and $row['items'] > 0)
            $this->set('productSklad', $this->lang('product_on_sklad') . " " . $row['items'] . " " . $this->lang('product_on_sklad_i'));
        else
            $this->set('productSklad', '');

        // ���� ����� �� ������
        if (empty($row['sklad'])) {

            $this->set('Notice', '');
            $this->set('ComStartCart', '');
            $this->set('ComEndCart', '');
            $this->set('ComStartNotice', '<!--');
            $this->set('ComEndNotice', '-->');

            // ���� ��� ����� ����
            if (empty($row['price_n'])) {
                $this->set('productPrice', $this->price($row));
                $this->set('productPriceRub', '');
            }

            // ���� ���� ����� ����
            else {
                $productPrice = $this->price($row);
                $productPriceNew = $this->price($row, true);
                $this->set('productPrice', $productPrice);
                $this->set('productPriceRub', PHPShopText::strike($productPriceNew));
            }
        }

        // ����� ��� �����
        else {
            $this->set('productPrice', $this->price($row));
            $this->set('productPriceRub', $this->lang('sklad_mesage'));
            $this->set('ComStartNotice', '');
            $this->set('ComEndNotice', '');
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));
            $this->set('productNotice', $this->lang('product_notice'));
        }

        // ���� ���� ���������� ������ ����� ����������
        if ($this->PHPShopSystem->getSerilizeParam('admoption.user_price_activate') == 1 and empty($_SESSION['UsersId'])) {
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));
            $this->set('productPrice', PHPShopText::comment('<'));
            $this->set('productValutaName', PHPShopText::comment('>'));
        }


        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $row);
            if ($hook) {
                return $hook;
            } else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }
    }

    /**
     * ��������� ������
     * @param array $row ������ ������ ������
     * @param bool $newpric ���������� ����
     * @return float
     */
    function price($row, $newprice = false) {

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $row);
            if ($hook) {
                return $hook;
            } else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }

        // ���� ���� ����� ����
        if (empty($newprice))
            $price = $row['price'];
        else
            $price = $row['price_n'];

        return PHPShopProductFunction::GetPriceValuta($row['id'], array($price, $row['price2'], $row['price3'], $row['price4'], $row['price5']), $row['baseinputvaluta']);
    }

    /**
     * ��������� ����� �������
     * @param array $dataArray ������ ������
     * @param int $cell ������ ����� [1-5]
     * @param string $template ���� �������
     * @param bool $line ���������� ����� �����������
     * @return string
     */
    function product_grid($dataArray, $cell, $template = false, $line = true) {

        if (!empty($line))
            $this->grid = true;
        else
            $this->grid = false;

        if (empty($cell))
            $cell = 2;
        $this->cell = $cell;
        $this->setka_footer = true;

        $table = null;
        $j = 1;
        $item = 1;

        $this->set('productInfo', $this->lang('productInfo'));
        $this->set('productSale', $this->lang('productSale'));
        $this->set('productValutaName', $this->currency());

        $d1 = $d2 = $d3 = $d4 = $d5 = $d6 = $d7 = null;
        if (is_array($dataArray)) {
            $this->total = count($dataArray);
            foreach ($dataArray as $row) {

                // ���������� ����������
                $this->set('productName', $row['name']);
                $this->set('productArt', $row['uid']);
                $this->set('productDes', $row['description']);
                $this->set('productPageThis', $this->PHPShopNav->getPage());

                // ������ ��������
                if (empty($row['pic_small']))
                    $this->set('productImg', $this->no_photo);
                else
                    $this->set('productImg', $row['pic_small']);

                // �������� ������ Multibase
                $this->checkMultibase($row['pic_small']);

                $this->set('productImgBigFoto', $row['pic_big']);
                $this->set('productPriceMoney', $this->PHPShopSystem->getValue('dengi'));

                $this->set('productUid', $row['id']);
                $this->set('catalog', $this->lang('catalog'));

                // ����� ������
                $this->checkStore($row);

                // ������ ������ ������
                if (empty($template))
                    $template = 'main_product_forma_' . $this->cell;


                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row);

                // ���������� ������ ������ ������
                $dis = ParseTemplateReturn($this->getValue('templates.' . $template));


                // ������� ��������� ����������� � �����
                if ($item == $this->total)
                    $this->setka_footer = false;

                $cell_name = 'd' . $j;
                $$cell_name = $dis;

                if ($j == $this->cell) {
                    $table.=$this->setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
                    $d1 = $d2 = $d3 = $d4 = $d5 = $d6 = $d7 = null;
                    $j = 0;
                } elseif ($item == $this->total) {
                    $table.=$this->setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
                }

                $j++;
                $item++;
            }
        }
        $this->product_grid = $table;

        return $table;
    }

    /**
     * ����� ����� � ��������
     * @return string
     */
    function setCell() {

        // ���������� ����������� �����
        if ($this->grid)
            $this->grid_style = 'class="setka"';
        else
            $this->grid_style = '';

        $Arg = func_get_args();
        $item = 1;
        $tr = '<tr>';

        foreach ($Arg as $key => $value)
            if ($key < $this->cell and $this->total >= $this->cell)
                $args[] = $value;
            elseif (!empty($value))
                $args[] = $value;

        $num = count($args);

        // ������ CSS ������ ����� ������
        switch ($num) {

            // ����� � 1 ������
            case 1:
                $panel = array('panel_l panel_1_1');
                break;

            // ����� � 2 ������
            case 2:
                $panel = array('panel_l panel_2_1', 'panel_r panel_2_2');
                break;

            // ����� � 3 ������
            case 3:
                $panel = array('panel_l panel_3_1', 'panel_r panel_3_2', 'panel_l panel_3_2');
                break;

            // ����� � 4 ������
            case 4:
                $panel = array('panel_l panel_4_1', 'panel_r panel_4_2', 'panel_l panel_4_3', 'panel_r panel_4_4',);
                break;

            // ����� � 5 ������
            case 5:
                $panel = array('panel_l panel_5_1', 'panel_r panel_5_2', 'panel_l panel_5_3', 'panel_l panel_5_4', 'panel_l panel_5_5');
                break;

            default: $panel = array('panel_l', 'panel_r', 'panel_l', 'panel_r', 'panel_l', 'panel_r', 'panel_l');
        }

        if (is_array($args))
            foreach ($args as $key => $val) {
                $tr.='<td class="' . $panel[$key] . '" valign="top">' . $val . '</td>';

                if ($item < $num and $num <= $this->cell)
                    $tr.='<td ' . $this->grid_style . '><img src="images/spacer.gif" width="1"></td>';

                $item++;
            }
        $tr.='</tr>';

        if (!empty($this->setka_footer))
            $tr.='<tr><td ' . $this->grid_style . ' colspan="' . ($this->cell * 2) . '" height="1"><img height="1" src="images/spacer.gif"></td></tr>';

        return $tr;
    }

}

?>