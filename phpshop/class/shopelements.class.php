<?php

/**
 * ����� �������� ��������� �������
 * ������� ������������� ��������� � ����� phpshop/inc/
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopProductElements
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopProductElements extends PHPShopElements {

    /**
     * @var bool �����������
     */
    var $cache = false;
    var $template_debug = true;

    /**
     * @var array ������ ��������� ����
     */
    var $cache_format = array('content');

    /**
     * @var bool ����������� ����� ��������
     */
    var $grid = false;

    /**
     * @var int ���-�� ������ �� ��������, ���� �� ������ ��������� �����������.
     */
    var $num_row = 9;

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
     * ��� ������� ������ ������� [default | li | div]
     * @var string  
     */
    var $cell_type = 'default';

    /**
     * ����� �������� ������
     * @var string 
     */
    var $cell_type_class = 'product-element-block';

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];

        // ���������� ��������� �������
        PHPShopObj::loadClass('product');
        parent::__construct();

        // ������ ������
        $this->dengi = $this->PHPShopSystem->getParam('dengi');
        $this->currency = $this->currency();

        // ���������
        $this->user_price_activate = $this->PHPShopSystem->getSerilizeParam('admoption.user_price_activate');
        $this->format = intval($this->PHPShopSystem->getSerilizeParam("admoption.price_znak"));
        $this->sklad_enabled = $this->PHPShopSystem->getSerilizeParam('admoption.sklad_enabled');

        // HTML ����� �������
        $this->setHtmlOption(__CLASS__);
    }

    function __call($name, $arguments) {
        if ($name == __CLASS__) {
            self::__construct();
        }
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

        $row = $this->select(array('*'), array('id' => '=' . intval($currency)), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.currency'), 'cache' => 'true'));

        if ($name == 'code' and ($row['iso'] == 'RUR' or $row['iso'] == "RUB"))
            return 'p';

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
     * �������� ���� �������� ������ Multibase
     * @return string 
     */
    function queryMultibase() {
        global $queryMultibase;

        // ����������
        if (defined("HostID") or defined("HostMain")) {

            // ������
            if (!empty($queryMultibase))
                return $queryMultibase;

            $multi_cat = array();
            $multi_dop_cat = null;

            // �� �������� ������� ��������
            $where['skin_enabled '] = "!='1'";

            if (defined("HostID"))
                $where['servers'] = " REGEXP 'i" . HostID . "i'";
            elseif (defined("HostMain"))
                $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
            $PHPShopOrm->debug = $this->debug;
            $data = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 10000), __CLASS__, __FUNCTION__);
            if (is_array($data)) {
                foreach ($data as $row) {
                    $multi_cat[] = $row['id'];
                    $multi_dop_cat.=" or dop_cat REGEXP '#" . $row['id'] . "#'";
                }
            }

            if (count($multi_cat) > 0)
                $queryMultibase = $multi_select = ' and ( category IN (' . @implode(',', $multi_cat) . ') ' . $multi_dop_cat . ')';

            return $multi_select;
        }
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

        if ($this->cell_type == 'default' or $this->cell_type == 'table')
            $table = '<table cellpadding="0" cellspacing="0" border="0">' . $this->product_grid . '</table>';
        else
            $table = $this->product_grid;

        $this->product_grid = null;
        return $table;
    }

    /**
     * �������� �������������� ������ ������ �� ������
     * @param array $row ����� ������ �� ������
     */
    function checkStore($row = array()) {

        // ������
        $this->set('productValutaName', $this->currency);

        // ������� ���������
        if (empty($row['ed_izm']))
            $row['ed_izm'] = $this->lang('product_on_sklad_i');
        $this->set('productEdIzm', $row['ed_izm']);

        // ���������� ��������� ������
        if ($this->sklad_enabled == 1 and $row['items'] > 0)
            $this->set('productSklad', $this->lang('product_on_sklad') . " " . $row['items'] . " " . $row['ed_izm']);
        else
            $this->set('productSklad', '');

        $price = $this->price($row);

        // ������ ����������� � ������������ ����
        if ($price > $this->price_max)
            $this->price_max = $price;

        if (empty($this->price_min))
            $this->price_min = $price;

        if ($price < $this->price_min)
            $this->price_min = $price;

        // ��������������
        $price = number_format($price, $this->format, '.', ' ');

        // ���� ����� �� ������
        if (empty($row['sklad'])) {

            $this->set('Notice', '');
            $this->set('ComStartCart', '');
            $this->set('ComEndCart', '');
            $this->set('ComStartNotice', PHPShopText::comment('<'));
            $this->set('ComEndNotice', PHPShopText::comment('>'));
            $this->set('elementCartHide', null);
            $this->set('elementNoticeHide', 'hide hidden');

            // ���� ��� ����� ����
            if (empty($row['price_n'])) {

                $this->set('productPrice', $price);
                $this->set('productPriceRub', '');
            }

            // ���� ���� ����� ����
            else {
                $productPrice = $price;
                $productPriceNew = $this->price($row, true);
                $this->set('productPrice', $productPrice);
                $this->set('productPriceRub', PHPShopText::strike($productPriceNew . " " . $this->currency, $this->format));
            }
        }

        // ����� ��� �����
        else {
            $this->set('productPrice', $price);
            $this->set('productPriceRub', $this->lang('sklad_mesage'));
            $this->set('ComStartNotice', '');
            $this->set('ComEndNotice', '');
            $this->set('elementCartHide', 'hide hidden');
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));
            $this->set('productNotice', $this->lang('product_notice'));
            $this->set('elementCartHide', 'hide hidden');
            $this->set('elementNoticeHide', null);
            $this->set('elementCartOptionHide', 'hide hidden');
        }

        // �������� �� ������� ���� 
        if (empty($row['price'])) {
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));
        }

        // �������� �������
        if (!empty($row['parent'])) {
            $this->set('elementCartHide', 'hide hidden');
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));

            if (empty($row['sklad']))
                $this->set('elementCartOptionHide', null);
        }
        else
            $this->set('elementCartOptionHide', 'hide hidden');

        // ���� ���� ���������� ������ ����� �����������
        if ($this->user_price_activate == 1 and empty($_SESSION['UsersId'])) {
            $this->set('ComStartCart', PHPShopText::comment('<'));
            $this->set('ComEndCart', PHPShopText::comment('>'));
            $this->set('productPrice', null);
            $this->set('productValutaName', null);
            $this->set('productPriceRub', null);
            $this->set('elementCartHide', 'hide hidden');
            $this->set('elementCartOptionHide', 'hide hidden');
        }

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $row);
            if ($hook) {
                return $hook;
            }
            else
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
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $row, $newprice);
            if ($hook) {
                return $hook;
            }
            else
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
     * ����� �������� �������
     * @param array $row ������ ��������
     */
    function parent($row) {

    // �������� ������ � ������ �������
    if($this->setHook(__CLASS__, __FUNCTION__, $row, 'START'))
        return true;

    $this->select_value = array();
    $row['parent'] = PHPShopSecurity::CleanOut($row['parent']);

    if (!empty($row['parent'])) {
        $parent = explode(",", $row['parent']);

        // ���� ������
        $sklad_status = $this->PHPShopSystem->getSerilizeParam('admoption.sklad_status');

        // ������� ���������� � ������� �������� ������
        $this->set('ComStartCart', '<!--');
        $this->set('ComEndCart', '-->');

        // �������� ������ �������
        if (is_array($parent))
            foreach ($parent as $value) {
                if (PHPShopProductFunction::true_parent($value))
                    $Product[$value] = $this->select(array('*'), array('uid' => '="' . $value . '"', 'enabled' => "='1'", 'sklad' => "!='1'"), false, false, __FUNCTION__);
                else
                    $Product[intval($value)] = $this->select(array('*'), array('id' => '=' . intval($value), 'enabled' => "='1'"), false, false, __FUNCTION__);
            }

        // ���� �������� ������
        if (!empty($row['price']) and empty($row['priceSklad']) and (!empty($row['items']) or (empty($row['items']) and $sklad_status == 1))) {
            $this->select_value[] = array($row['name'] . " -  (" . $this->price($row) . "
                    " . $this->get('productValutaName') . ')', $row['id'], false);
        } else {
            $this->set('ComStartNotice', PHPShopText::comment('<'));
            $this->set('ComEndNotice', PHPShopText::comment('>'));
        }

        // ���������� ������ �������
        if (is_array($Product))
            foreach ($Product as $p) {
                if (!empty($p)) {

                    // ���� ����� �� ������
                    if (empty($p['priceSklad']) and (!empty($p['items']) or (empty($p['items']) and $sklad_status == 1))) {
                        $price = $this->price($p);
                        $this->select_value[] = array($p['name'] . ' -  (' . $price . ' ' . $this->get('productValutaName') . ')', $p['id'], false);
                    }
                }
            }

        if (count($this->select_value) > 0) {
            $this->set('parentList', PHPShopText::select('parentId', $this->select_value, "; max-width:300px;"));
            $this->set('productParentList', ParseTemplateReturn("product/product_odnotip_product_parent.tpl"));
        }

        $this->set('productPrice', '');
        $this->set('productPriceRub', '');
        $this->set('productValutaName', '');

        // �������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
    }
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
    $this->set('productSaleReady', $this->lang('productSaleReady'));

    $d1 = $d2 = $d3 = $d4 = $d5 = $d6 = $d7 = null;
    if (is_array($dataArray)) {
        $this->total = count($dataArray);
        foreach ($dataArray as $row) {

            // ����� ������
            $this->checkStore($row);

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

            $this->set('productImgBigFoto', $row['pic_big']);
            $this->set('productPriceMoney', $this->PHPShopSystem->getValue('dengi'));

            $this->set('productUid', $row['id']);
            $this->set('catalog', $this->lang('catalog'));

            // ����������� ������� ������ ������� ������ ������ �� ������� �������������
            $this->doLoadFunction(__CLASS__, 'comment_rate', array("row" => $row, "type" => "CID"), 'shop');


            // ������ ������ ������
            if (empty($template))
                $template = 'main_product_forma_' . $this->cell;

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, $row);

            // ���������� ������ ������ ������
            $dis = ParseTemplateReturn($this->getValue('templates.' . $template), false, $this->template_debug);


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
function setCell($d1, $d2 = null, $d3 = null, $d4 = null, $d5 = null, $d6 = null, $d7 = null) {

    // ���������� ����������� �����
    if ($this->grid)
        $this->grid_style = 'class="setka"';
    else
        $this->grid_style = '';

    $Arg = func_get_args();
    $item = 1;

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


    switch ($this->cell_type) {

        // ������
        case 'li':
            if (is_array($args))
                foreach ($args as $key => $val) {
                    $tr.='<li class="' . $this->cell_type_class . '">' . $val . '</li>';
                    $item++;
                }
            break;

        // �����
        case 'div':
            if (is_array($args))
                foreach ($args as $key => $val) {
                    $tr.='<div class="' . $this->cell_type_class . '">' . $val . '</div>';
                    $item++;
                }
            //$this->cell = 1;
            break;


        // Bootstrap
        case 'bootstrap':
            $tr = '<div class="row">';
            if (is_array($args))
                foreach ($args as $key => $val) {
                    $tr.=$val;
                    $item++;
                }
            $tr.='</div>';
            break;

        // ���������
        default:

            $tr = '<tr>';
            if (is_array($args))
                foreach ($args as $key => $val) {
                    $tr.='<td class="' . $panel[$key] . '" valign="top">' . $val . '</td>';

                    if ($item < $num and $num == $this->cell)
                        $tr.='<td ' . $this->grid_style . '><img src="images/spacer.gif" width="1"></td>';

                    $item++;
                }
            $tr.='</tr>';

            if (!empty($this->setka_footer))
                $tr.='<tr><td ' . $this->grid_style . ' colspan="' . ($this->cell * 2) . '" height="1"><img height="1" src="images/spacer.gif"></td></tr>';
    }


    return $tr;
}

}

?>