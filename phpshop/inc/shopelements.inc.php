<?php

/**
 * ������� ������� �� �������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopBrandsElement extends PHPShopElements {

    /**
     * @var int  ���-�� �������
     */
    var $limitOnLine = 5;
    var $firstClassName = 'span-first-child';
    var $debug = false;

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * �����
     * @return string
     */
    function index() {

        $arrayVendorValue = array();

        // ���� ������ SEOURLPRO
        if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
            $PHPShopOrmSeo = new PHPShopOrm($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system']);
            $seourlpro = $PHPShopOrmSeo->select();
        }

        // ����������
        if (defined("HostID"))
            $sql_add .= " and servers REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $sql_add .= ' and (servers ="" or servers REGEXP "i1000i")';

        // ������ ���� �������������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->mysql_error = false;
        $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['sort_categories'] . " where brand='1' " . $sql_add . " order by num");
        while (@$row = mysqli_fetch_assoc($result)) {
            $arrayVendor[$row['id']] = $row;
        }
        if (is_array($arrayVendor))
            foreach ($arrayVendor as $k => $v) {
                if (is_numeric($k))
                    $sortValue.=' category=' . $k . ' OR';
            }
        $sortValue = substr($sortValue, 0, strlen($sortValue) - 2);

        if (!empty($sortValue)) {

            // ������ �������� 
            $i = 0;
            $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['sort'] . " where $sortValue order by num,name");

            while (@$row = mysqli_fetch_array($result)) {
                $arrayVendorValue[$row['name']][] = array('name' => $row['name'], 'id' => $row['id'], 'category' => $row['category'], 'icon' => $row['icon'], 'seo' => $row['sort_seo_name']);
            }

            // �������� �� ����������� �����
            if (is_array($arrayVendorValue)) {
                foreach ($arrayVendorValue as $k => $v) {

                    if ($i % $this->limitOnLine == 0) {
                        $this->set('brandFirstClass', $this->firstClassName);
                    } else {
                        $this->set('brandFirstClass', '');
                    }
                    $i++;

                    if (is_array($v[1])) {
                        $link = null;
                        $this->set('brandIcon', null);
                        foreach ($v as $val) {
                            $link.='v[' . $val['category'] . ']=' . $val['id'] . '&';

                            if (!empty($val['icon']))
                                $this->set('brandIcon', $val['icon']);
                        }
                        $this->set('brandName', $v[0]['name']);


                        if ($seourlpro['seo_brands_enabled'] == 2) {
                            if (empty($v[0]['sort_seo_name']))
                                $this->set('brandPageLink', $GLOBALS['SysValue']['dir']['dir'] . '/selection/?' . substr($link, 0, strlen($link) - 1));
                            else
                                $this->set('brandPageLink', '/brand/' . $v[0]['sort_seo_name'] . '.html');
                        }
                        else
                            $this->set('brandPageLink', $GLOBALS['SysValue']['dir']['dir'] . '/selection/?' . substr($link, 0, strlen($link) - 1));

                        $this->set('brandsList', ParseTemplateReturn('brands/top_brands_one.tpl'), true);
                    } else {

                        $this->set('brandIcon', $v[0]['icon']);
                        $this->set('brandName', $v[0]['name']);

                        if ($seourlpro['seo_brands_enabled'] == 2) {
                            if (empty($v[0]['sort_seo_name']))
                                $this->set('brandPageLink', $GLOBALS['SysValue']['dir']['dir'] . '/selection/?v[' . $v[0]['category'] . ']=' . $v[0]['id']);
                            else
                                $this->set('brandPageLink', '/brand/' . $v[0]['sort_seo_name'] . '.html');
                        }
                        else
                            $this->set('brandPageLink', $GLOBALS['SysValue']['dir']['dir'] . '/selection/?v[' . $v[0]['category'] . ']=' . $v[0]['id']);
                        $this->set('brandsList', ParseTemplateReturn('brands/top_brands_one.tpl'), true);
                    }

                    // ��� ���������� ����
                    $this->set('brandsListMobile', PHPShopText::li($this->get('brandName'), $this->get('brandPageLink'), false), true);
                }
            }
        }
        if ($this->get('brandsList'))
            return ParseTemplateReturn('brands/top_brands_main.tpl');
    }

}

/**
 * ������� ������������� �������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopSortElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * ����� ������ �������������� ��� ������
     * @param string $var ��� ���������� � �������������
     * @param int $n �� �������������� ��� ������ ��������
     * @param string $title ��������� �����
     * @param string $target ���� ����� [/selection/  |  /selectioncat/]
     */
    function brand($var, $n, $title, $target = '/selection/') {

        // �� �������������� ��� ������ ��������
        $this->n = $n;

        // ���������� ����������
        PHPShopObj::loadClass('sort');

        $PHPShopSort = new PHPShopSort();
        $value = $PHPShopSort->value($n, $title);
        $forma = PHPShopText::p(PHPShopText::form($value . PHPShopText::button('OK', 'SortSelect.submit()'), 'SortSelect', 'get', $target, false, 'ok'));
        $this->set('leftMenuContent', $forma);
        $this->set('leftMenuName', $title);

        // ���������� ������
        $dis = $this->parseTemplate($this->getValue('templates.left_menu'));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $value);

        // ��������� ���������� �������
        $this->set($var, $dis);
    }

}

/**
 * ������� ���������� ������ ������� � �������
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopElements
 */
class PHPShopProductIconElements extends PHPShopProductElements {

    /**
     * �������
     * @var bool
     */
    var $debug = false;

    /**
     * ������ �������
     * @var bool
     */
    var $memory = true;

    /**
     * ������ ������
     * @var string 
     */
    var $template = 'main_spec_forma_icon';

    /**
     * ����������� �� �����
     * @var string 
     */
    var $limitspec;

    /**
     * ����� ������ [1-5]
     * @var int 
     */
    var $cell;

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];
        $this->template_debug = true;
        parent::__construct();

        // HTML ����� �������
        $this->setHtmlOption(__CLASS__);
    }

    function __call($name, $arguments) {
        if ($name == __CLASS__) {
            self::__construct();
        }
    }

    /**
     * ������� "���������������-�������" ��� ���� �������
     * @param bool $force �������� ����������� ��� ���������� �������� ������
     * @param int $category �� ��������� ��� �������
     * @param int $cell ����� ������ [1-5]
     * @param int $limit ����������� �� �����
     * @return string
     */
    function specMainIcon($force = false, $category = null, $cell = null, $limit = null, $line = false) {

        $this->limitspec = $limit;

        if (!empty($cell))
            $this->cell = $cell;

        elseif (empty($this->cell))
            $this->cell = 1;

        // ������� ������ 
        $this->new_enabled = $this->PHPShopSystem->getSerilizeParam("admoption.new_enabled");

        switch ($GLOBALS['SysValue']['nav']['nav']) {

            // ������ ������ �������
            case "CID":

                if (!empty($category))
                    $where['category'] = '=' . $category;

                elseif (PHPShopSecurity::true_num($this->PHPShopNav->getId())) {

                    $category = $this->PHPShopNav->getId();
                    if (!$this->memory_get('product_enabled.' . $category, true))
                        $where['category'] = '=' . $category;
                }
                break;

            // ������ ���������� ��������
            case "UID":

                if (!empty($category))
                    $where['category'] = '=' . $category;

                $where['id'] = '!=' . $this->PHPShopNav->getId();

                break;
        }

        // ��������� SeoUrlPro
        if ($GLOBALS['PHPShopNav']->objNav['name'] == 'UID') {
            $where['id'] = '!=' . $GLOBALS['PHPShopNav']->objNav['id'];
        }

        // ���-�� ������� �� ��������
        if (empty($this->limitspec))
            $this->limitspec = $this->PHPShopSystem->getParam('new_num');

        if (!$this->limitspec)
            $this->limitspec = $this->num_row;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook)
            return $hook;

        // ���������� ���� �������� �����
        if (empty($this->limitspec))
            return false;

        // ��������� ������� ����� ������ � �������� � �������
        $where['newtip'] = "='1'";
        $where['enabled'] = "='1'";
        $where['parent_enabled'] = "='0'";

        // �������� �� ��������� �������
        if ($limit == 1 || $this->limitspec == 1) {
            $array_pop = true;
            $limit++;
            $this->limitspec++;
        }

        // ������ ������ ������� ������� �� ���������
        //$memory_spec = $this->memory_get('product_spec.' . $category);
        // ����������
        $queryMultibase = $this->queryMultibase();
        if (!empty($queryMultibase))
            $where['enabled'].= ' ' . $queryMultibase;
        else {
            // �������� ������ ��� ������� ���
            $where['id'] = $this->setramdom($limit);
        }

        // ������� �������
        //if ($memory_spec != 2 and $memory_spec != 3)
        $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limitspec), __FUNCTION__);

        // �������� �� ��������� �������
        if (!empty($array_pop) and is_array($this->dataArray)) {
            array_pop($this->dataArray);
        }

        // ������ ������� �������, ����������� RAND ��������
        $count = @count($this->dataArray);
        if ($count < $this->limitspec) {
            unset($where['id']);
            $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limitspec), __FUNCTION__);
        }

        if (is_array($this->dataArray)) {
            $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
            $this->set('specMainTitle', $this->lang('newprod'));

            // ������� � ������
            //$this->memory_set('product_spec.' . $category, 1);
        }
        // ��������������� ���� ��� �������
        elseif ($this->new_enabled == 1) {

            // ������� ���������������
            unset($where['newtip']);
            $where['spec'] = "='1'";

            //if ($memory_spec != 1 and $memory_spec != 3)
            $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limitspec), __FUNCTION__);

            // �������� �� ��������� �������
            if (!empty($array_pop) and is_array($this->dataArray)) {
                array_pop($this->dataArray);
            }

            if (!empty($this->dataArray) and is_array($this->dataArray)) {
                $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
                $this->set('specMainTitle', $this->lang('specprod'));

                // ������� � ������
                //$this->memory_set('product_spec.' . $category, 2);
            }
        }
        // ��������� ���������� ������ ���� ��� �������
        elseif ($this->new_enabled == 2) {

            // ������� ��������� ����������� �������
            unset($where['id']);
            unset($where['spec']);
            unset($where['newtip']);
            $this->dataArray = $this->select(array('*'), $where, array('order' => 'id DESC'), array('limit' => $this->limitspec), __FUNCTION__);

            // �������� �� ��������� �������
            if (!empty($array_pop) and is_array($this->dataArray)) {
                array_pop($this->dataArray);
            }

            if (is_array($this->dataArray)) {
                $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
                $this->set('specMainTitle', $this->lang('newprod'));

                // ������� � ������
                //$this->memory_set('product_spec.' . $category, 3);
            }
        }

        // �������� � ���������� ������� � ��������
        return $this->compile();
    }

    /**
     * ������� ������� ����� ������ ������� (���������)
     * @param array $row ������ ������ �������
     * @param int $cell ����������� ����� [1|2|3|4|5]
     * @param string $template ������ ������
     * @param bool $line ������� ����������� ����� �������
     * @return string
     */
    function seamply_forma($row, $cell = false, $template = 'main_spec_forma_icon', $line = false, $mod = false) {

        // ���������� ����� ��� ������ ������
        if (empty($cell))
            $this->cell = $this->PHPShopSystem->getParam('num_vitrina');
        else
            $this->cell = $cell;

        $this->set('productInfo', $this->lang('productInfo'));

        // ��������� � ������ ������ � ��������
        $this->product_grid($row, $this->cell, $template, $line, $mod);

        // �������� � ���������� ������� � ��������
        return $this->compile();
    }

    /**
     * ����� ����� � ��������
     * @return string
     */
    function setCell($d1, $d2 = null, $d3 = null, $d4 = null, $d5 = null, $d6 = null, $d7 = null) {

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $Arg = func_get_args();
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $Arg);
            if ($hook) {
                return $hook;
            }
            else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }

        return parent::setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
    }

    /**
     * ���� ������ �� ������� � �������
     * @return string
     */
    function compile() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook) {
            return $hook;
        }

        return parent::compile();
    }

}

/**
 * ������� ���������� ������ �������
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopElements
 */
class PHPShopProductIndexElements extends PHPShopProductElements {

    /**
     * �������
     * @var bool
     */
    var $debug = false;

    /**
     * ����� ������
     * @var int
     */
    var $cell;

    /**
     * ������ �������
     * @var bool
     */
    var $memory = true;

    /**
     * ������ ������
     * @var string 
     */
    var $template = '';
    var $check_index = false;

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];
        parent::__construct();

        // HTML ����� �������
        $this->setHtmlOption(__CLASS__);
    }

    function __call($name, $arguments) {
        if ($name == __CLASS__) {
            self::__construct();
        }
    }

    /**
     * ������ ����������� ������ "������ ��������"
     * @param array $row ������ ������
     * @return string
     */
    function template_nowbuy($row) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $row);
        if ($hook)
            return $hook;

        return PHPShopText::li($row['name'], 'shop/UID_' . $row['id'] . '.html');
    }

    /**
     * ������� "������ ��������" ��� ������� ��������
     * @return string
     */
    function nowBuy() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        // �������� ������� ������� ��������
        if ($this->PHPShopNav->index($this->check_index)) {
            $i = 1;

            if (!$this->limitpos)
                $this->limitpos = 10; // ���������� ��������� �������

            if (!$this->limitorders)
                $this->limitorders = 10; // ���������� ������������� �������
            $disp = $li = null;

            if (!$this->enabled)
                $this->enabled = $this->PHPShopSystem->getSerilizeParam('admoption.nowbuy_enabled');

            $sort = null;

            // ���������� �����
            if (empty($this->cell))
                $this->cell = $this->PHPShopSystem->getValue('num_vitrina');

            if ($this->enabled > 0) {

                // ��������� ������
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
                $PHPShopOrm->debug = $this->debug;
                $data = $PHPShopOrm->select(array('orders'), false, array('order' => 'id desc'), array('limit' => $this->limitorders));

                if (is_array($data)) {
                    foreach ($data as $row) {
                        $order = unserialize($row['orders']);
                        $cart = $order['Cart']['cart'];
                        if (is_array($cart))
                            foreach ($cart as $good) {
                                if ($i > $this->limitpos)
                                    break;
                                // �������� ������������ ������
                                if (!empty($good['parent']))
                                    $good['id'] = $good['parent'];

                                $sort.=' id=' . intval($good['id']) . ' OR';
                            }
                    }
                    $sort = substr($sort, 0, strlen($sort) - 2);

                    // ���� ���� ������
                    if (!empty($sort)) {
                        $PHPShopOrm = new PHPShopOrm();
                        $PHPShopOrm->debug = $this->debug;
                        $PHPShopOrm->sql = "select * from " . $this->objBase . " where (" . $sort . ") and enabled='1' LIMIT 0," . $this->limitpos;
                        $PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
                        $dataArray = $PHPShopOrm->select();

                        if (is_array($dataArray)) {

                            // ������ ��������
                            if ($this->enabled == 2) {

                                // ���������� ����� ��� ������ ������
                                if (empty($this->cell))
                                    $this->cell = $this->PHPShopSystem->getParam('num_vitrina');
                                $this->set('productInfo', $this->lang('productInfo'));

                                // ��������� � ������ ������ � ��������
                                $this->product_grid($dataArray, $this->cell, $this->template);

                                // �������� � ���������� ������� � ��������
                                $disp = $this->compile();
                            }
                            // ������ �������
                            else {
                                foreach ($dataArray as $row) {
                                    $li.=$this->template_nowbuy($row);
                                    $i++;
                                }

                                $disp = PHPShopText::ol($li);
                            }

                            // �������� ������
                            $this->setHook(__CLASS__, __FUNCTION__, $dataArray, 'END');

                            if (!empty($disp)) {
                                $this->set('now_buying', $this->lang('now_buying'));
                                return $disp;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * ������� "���������������" �� ������� ��������
     * @return string
     */
    function specMain() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook)
            return $hook;

        // �������� ������� ������� ��������
        if ($this->PHPShopNav->index($this->check_index)) {


            // ���������� ����� ��� ������ ������
            if (empty($this->cell))
                $this->cell = $this->PHPShopSystem->getParam('num_vitrina');

            // ���-�� ������� �� ��������
            $this->limit = $this->PHPShopSystem->getParam('spec_num');

            if (!$this->limit)
                $this->limit = $this->num_row;

            // ���������� ���� �������� �����
            if ($this->limit < 1)
                return false;

            $this->set('productInfo', $this->lang('productInfo'));

            // ��������� ������� ����� ������ � ��������������� � �������
            $where['spec'] = "='1'";
            $where['enabled'] = "='1'";
            $where['parent_enabled'] = "='0'";

            // ����������
            $queryMultibase = $this->queryMultibase();
            if (!empty($queryMultibase))
                $where['enabled'].= ' ' . $queryMultibase;
            else {
                // ��������� ������
                $where['id'] = $this->setramdom($this->limit);
            }

            // �������
            if ($this->limit > 1)
                $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limit), __FUNCTION__);
            else
                $this->dataArray[] = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limit), __FUNCTION__);

            // ������ ������� ������� ���������������, ����������� RAND ��������
            $count = count($this->dataArray);
            if ($count < $this->limit) {
                unset($where['id']);
                $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limit), __FUNCTION__);
            }

            // ��������� � ������ ������ � ��������
            $this->product_grid($this->dataArray, $this->cell, $this->template);

            // �������� � ���������� ������� � ��������
            return $this->compile();
        }
    }

    /**
     * ����� ����� � ��������
     * @return string
     */
    function setCell($d1, $d2 = null, $d3 = null, $d4 = null, $d5 = null, $d6 = null, $d7 = null) {

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $Arg = func_get_args();
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $Arg);
            if ($hook) {
                return $hook;
            }
            else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }

        return parent::setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
    }

    /**
     * ���� ������ �� ������� � �������
     * @return string
     */
    function compile() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook) {
            return $hook;
        }

        return parent::compile();
    }

}

/**
 * ������� ���������� ������ ��������� �������
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopElements
 */
class PHPShopShopCatalogElement extends PHPShopProductElements {

    /**
     * �������
     * @var bool
     */
    var $debug = false;

    /**
     * ������ ����� ��� ������� � ���� ��� ����������� ����. �������� �������� �������� � YML ���������.
     * @var array
     */
    var $cache_format = array('content', 'yml_bid_array');
    var $memory = true;

    /**
     * ���������� �������� ��������� [num|name]
     * @var string 
     */
    var $root_order = 'num, name';
    var $grid = true;

    /**
     * ����������� ���������� ������ ���������
     * @var bool 
     */
    var $multimenu = false;

    /**
     * �����������
     */
    function __construct() {

        parent::__construct();
        $this->objBase = $GLOBALS['SysValue']['base']['categories'];

        // HTML ����� �������
        $this->setHtmlOption(__CLASS__);
    }

    function __call($name, $arguments) {
        if ($name == __CLASS__) {
            self::__construct();
        }
    }

    /**
     * ������ ������ ��������� ��������� � ��������
     * @param array $val ������ ������
     * @return string
     */
    function template_cat_table($val) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $val);
        if ($hook)
            return $hook;

        return PHPShopText::a('/shop/CID_' . $val['id'] . '.html', $val['name'], $val['name']) . ' | ';
    }

    /**
     * ����� ����� ��� leftCatalTable
     * @return string
     */
    function setCell($d1, $d2 = null, $d3 = null, $d4 = null, $d5 = null, $d6 = null, $d7 = null) {

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $Arg = func_get_args();
            $hook = $this->setHook(__CLASS__, __FUNCTION__, $Arg);
            if ($hook) {
                return $hook;
            }
            else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }

        return parent::setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
    }

    /**
     * ������� ��������� � ��������
     * @return string
     */
    function leftCatalTable() {

        // ���������� ������ � Index
        if ($this->PHPShopNav->index()) {

            // ���������� �����
            if (empty($this->cell))
                $this->cell = $this->PHPShopSystem->getValue('num_vitrina');

            $table = null;
            $j = 1;
            $item = 1;

            // �������� ������
            $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
            if ($hook)
                return $hook;

            if (is_array($this->tree_array[0]['sub']))
                foreach ($this->tree_array[0]['sub'] as $k => $v) {

                    $dis = $podcatalog = null;
                    $this->set('catalogId', $k);
                    $this->set('catalogTitle', $v);
                    $this->set('catalogName', $v);

                    $this->set('catalogIcon', $this->CategoryArray[$k]['icon']);
                    $this->set('catalogContent', null);

                    // �����������
                    if (is_array($this->tree_array[$k]['sub']))
                        foreach ($this->tree_array[$k]['sub'] as $key => $val) {
                            $podcatalog.=$this->template_cat_table(array('name' => $val, 'id' => $key));
                        }

                    $this->set('catalogPodcatalog', $podcatalog);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $this->CategoryArray[$k], 'END');

                    // ���������� ������
                    $dis.= ParseTemplateReturn("catalog/catalog_table_forma.tpl");

                    // ������ � ���������� (1-7)
                    if ($j < $this->cell) {
                        $cell_name = 'd' . $j;
                        $$cell_name = $dis;
                        $j++;
                        if ($item == count($this->tree_array[0]['sub'])) {
                            $table.=$this->setCell($d1, @$d2, @$d3, @$d4, @$d5, @$d6, @$d7);
                        }
                    } else {
                        $cell_name = 'd' . $j;
                        $$cell_name = $dis;
                        $table.=$this->setCell($d1, @$d2, @$d3, @$d4, @$d5, @$d6, @$d7);
                        $d1 = $d2 = $d3 = $d4 = $d5 = $d6 = $d7 = null;
                        $j = 1;
                    }
                    $item++;
                }

            $this->product_grid = $table;
            return $this->compile();
        }
    }

    // ���������� ������������ ������ ���������
    function treegenerator($array) {
        $tree_select = $check = false;

        if (is_array($array['sub'])) {
            foreach ($array['sub'] as $k => $v) {

                if ($this->multimenu and $this->tree_array[$k]['vid'] != 1)
                    $check = $this->treegenerator($this->tree_array[$k]);
                else
                    $check = false;

                $this->set('catalogName', $v);
                $this->set('catalogUid', $k);
                $this->set('catalogId', $k);

                // ������
                if (empty($this->CategoryArray[$k]['icon']))
                    $this->CategoryArray[$k]['icon'] = $this->no_photo;
                $this->set('catalogIcon', $this->CategoryArray[$k]['icon']);

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $this->CategoryArray[$k]);

                if (empty($check)) {
                    $tree_select.=$this->parseTemplate($this->getValue('templates.podcatalog_forma'));
                } else {
                    $this->set('catalogPodcatalog', $check);

                    $tree_select.=$this->parseTemplate($this->getValue('templates.catalog_forma'));
                }
            }
        }
        return $tree_select;
    }

    /**
     * ����� ��������� ���������
     * @param array $replace ������ ������ ������
     * @param array $where ������ ���������� �������, ������������ ��� ������ ������������� ��������
     * PHPShopShopCatalogElement::leftCatal(false,$where['id']=1);
     * @return string
     */
    function leftCatal($replace = null, $where = null) {

        $this->set('thisCat', $this->PHPShopNav->getId());


        // ����� ������������ ������
        if ($this->getValue('sys.multimenu') == 'true')
            $this->multimenu = true;
        else
            $this->multimenu = false;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $where, 'START');
        if ($hook)
            return $hook;

        // �� �������� ������� ��������
        $where['skin_enabled'] = "!='1' and (vid !='1' or parent_to =0)";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';


        $PHPShopCategoryArray = new PHPShopCategoryArray($where);
        $PHPShopCategoryArray->order = array('order' => $this->root_order);

        $this->CategoryArray = $PHPShopCategoryArray->getArray();
        $CategoryArrayKey = $PHPShopCategoryArray->getKey('parent_to.id', true);

        if (is_array($CategoryArrayKey))
            foreach ($CategoryArrayKey as $k => $v) {
                foreach ($v as $cat) {
                    $this->tree_array[$k]['sub'][$cat] = $this->CategoryArray[$cat]['name'];

                    // ��� ��������
                    if (strstr($this->CategoryArray[$cat]['dop_cat'], "#")) {

                        $dop_cat_array = explode("#", $this->CategoryArray[$cat]['dop_cat']);

                        if (is_array($dop_cat_array)) {
                            foreach ($dop_cat_array as $vc) {
                                $this->tree_array[$vc]['sub'][$cat] = $this->CategoryArray[$cat]['name'];
                            }
                        }
                    }

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $this->CategoryArray[$cat], 'MIDDLE');
                }

                $this->tree_array[$k]['name'] = $this->CategoryArray[$k]['name'];
                $this->tree_array[$k]['id'] = $k;
                $this->tree_array[$k]['icon'] = $this->CategoryArray[$k]['icon'];
                $this->tree_array[$k]['vid'] = $this->CategoryArray[$k]['vid'];
            }


        if (is_array($this->tree_array[0]['sub'])) {

            // ������� ������������ � ������������ ��� ������ ���� ���� ��������
            if (defined("HostID") and count($this->tree_array[0]['sub']) == 1) {

                $parent = array_keys($this->tree_array[0]['sub']);

                foreach ($this->tree_array[$parent[0]]['sub'] as $k => $v) {
                    $this->tree_array_host[0]['sub'][$k] = $this->CategoryArray[$k]['name'];
                }

                $this->tree_array[0] = $this->tree_array_host[0];
            }


            foreach ($this->tree_array[0]['sub'] as $k => $v) {

                if ($this->tree_array[$k]['vid'] != 1)
                    $check = $this->treegenerator($this->tree_array[$k]);

                $this->set('catalogName', $v);
                $this->set('catalogUid', $k);
                $this->set('catalogId', $k);

                // ������
                if (empty($this->CategoryArray[$k]['icon']))
                    $this->CategoryArray[$k]['icon'] = $this->no_photo;
                $this->set('catalogIcon', $this->CategoryArray[$k]['icon']);

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $this->CategoryArray[$k], 'END');

                if (empty($check) or $this->tree_array[$k]['vid'] == 1)
                    $tree_select.=$this->parseTemplate($this->getValue('templates.catalog_forma_3'));
                else {
                    $this->set('catalogPodcatalog', $check);
                    $tree_select.=$this->parseTemplate($this->getValue('templates.catalog_forma'));
                }
            }
        }

        // ������ ������
        if (is_array($replace)) {
            foreach ($replace as $key => $val)
                $tree_select = str_replace($key, $val, $tree_select);
        }

        return $tree_select;
    }

    /**
     * �������� ������������
     * @param Int $id �� ��������
     * @return bool
     */
    function chek($n) {
        if (!is_array($this->tree_array[$n]['sub']))
            return true;
    }

    /**
     * ����� ��������� � �������� �������������� ����
     * @return string
     */
    function topcatMenu() {
        $dis = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        $where['skin_enabled'] = "!='1'";
        $where['menu'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug = false;
        $data = $PHPShopOrm->select(array('id', 'name'), $where, array('order' => 'num,name'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ��������� ������
                if (PHPShopParser::checkFile($this->getValue('templates.catalog_top_menu'))) {

                    $this->set('catalogName', $row['name']);
                    $this->set('catalogUid', $row['id']);
                    $this->set('catalogIcon', $row['icon']);

                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_top_menu'));
                }
                // ���������� ������ ����
                else {

                    // ���������� ����������
                    $this->set('topMenuName', $row['name']);
                    $this->set('topMenuLink', $row['id']);

                    $dis.=str_replace('page/', 'shop/CID_', $this->parseTemplate($this->getValue('templates.top_menu')));
                }
            }

        return $dis;
    }

}

/**
 * ������� ������� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopCartElement extends PHPShopElements {

    /**
     * �����������
     * @param bool $order ����� ������� � ������
     */
    function __construct($order = false) {

        PHPShopObj::loadClass('cart');
        $this->PHPShopCart = new PHPShopCart();
        $this->order = $order;

        parent::__construct();
    }

    /**
     *  ���� �������
     */
    function miniCart() {

        // ���� ����� �� � �������� ��������� ������
        if ($this->PHPShopNav->notPath(array('order', 'done')) or !empty($this->order)) {

            if (!empty($_SESSION['compare']))
                $compare = $_SESSION['compare'];
            else
                $compare = array();
            $numcompare = 0;

            // ���� ���� ������ � �������
            if ($this->PHPShopCart->getNum() > 0) {
                $this->set('orderEnabled', 'block');

                // ���������� ������ ���� ��������� ��� �������� ������� ��� ������ �� ����
                $this->setValue("cache.last_modified", false);
            }
            else
                $this->set('orderEnabled', 'none');

            // ���� ���� ���������
            if (count($compare) > 0) {
                if (is_array($compare)) {
                    foreach ($compare as $j => $v) {
                        $numcompare = count($compare);
                    }
                }
                $this->set('compareEnabled', 'block');
            } else {
                $numcompare = "0";
                $this->set('compareEnabled', 'none');
            }

            // �����������
            $this->set('tovarNow', $this->getValue('lang.cart_tovar_now'));
            $this->set('summaNow', $this->getValue('cart_summa_now'));
            $this->set('orderNow', $this->getValue('cart_order_now'));

            // ���������
            $this->set('numcompare', $numcompare);

            // �������
            $this->set('num', $this->PHPShopCart->getNum());

            // �����
            $this->set('sum', $this->PHPShopCart->getSum(true, ' '));
        } else {
            $this->set('productValutaName', $this->PHPShopSystem->getDefaultValutaCode(true));
            // �������
            $this->set('num', 0);
            // �����
            $this->set('sum', 0);
        }

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__);
    }

}

/**
 * ������� ����� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopCurrencyElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        global $PHPShopValutaArray;
        parent::__construct();
        $this->PHPShopValuta = $PHPShopValutaArray->getArray();
        $this->setAction(array('post' => 'valuta'));
    }

    /**
     * ��������������� ����� ����� ������
     */
    function valuta() {
        $currency = intval($_POST['valuta']);
        if (!empty($this->PHPShopValuta[$currency])) {
            $_SESSION['valuta'] = $currency;
            header("Location: " . $_SERVER['REQUEST_URI']);
        }
    }

    /**
     * ����� ������ ������
     * @return string
     */
    function valutaDisp() {

        if ($this->PHPShopNav->notPath('order')) {

            if (isset($_SESSION['valuta']))
                $valuta = $_SESSION['valuta'];
            else
                $valuta = $this->PHPShopSystem->getParam('dengi');

            if (is_array($this->PHPShopValuta))
                foreach ($this->PHPShopValuta as $v) {
                    if ($valuta == $v['id'])
                        $sel = "selected";
                    else
                        $sel = false;
                    $value[] = array($v['name'], $v['id'], $sel);
                }

            // ���������� ����������
            $this->set('leftMenuName', '������');
            $select = PHPShopText::select('valuta', $value, 100, "none", false, "ChangeValuta()");
            $this->set('leftMenuContent', PHPShopText::form($select, 'ValutaForm'));

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, $this->PHPShopValuta);

            // ���������� ������
            $dis = $this->parseTemplate($this->getValue('templates.valuta_forma'));
            return $dis;
        }
    }

}

/**
 * ������� ������ �����
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopCloudElement extends PHPShopElements {

    var $debug = false;

    /**
     * ����� ������� ��� �������
     * @var int
     */
    var $page_limit = 100;

    /**
     * ����� ���� ��� ������
     * @var int
     */
    var $word_limit = 20;

    /**
     * ���� ������ ������ �����
     * @var string
     */
    var $color = "0x518EAD";

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];
        parent::__construct();
    }

    /**
     * ������ �����
     * @param array $row ������ ������
     * @return string
     */
    function index($row = null) {
        $disp = $dis = $CloudCount = $ArrayWords = $CloudCountLimit = null;
        $ArrayLinks = array();

        // �������� ������ � ������ �������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $row, 'START');
        if ($hook)
            return $hook;

        if ($this->PHPShopSystem->ifSerilizeParam('admoption.cloud_enabled')) {
            switch ($GLOBALS['SysValue']['nav']['nav']) {

                case(""):
                    $tip = "search";
                    $str = array('enabled' => "='1'", 'keywords' => " !=''");
                    break;

                case("CID"):
                    $tip = "words";
                    if (empty($row))
                        return false;
                    else
                        $data = $row;
                    break;

                case("UID"):
                    $tip = "words";
                    if (empty($row))
                        return false;
                    else
                        $data[] = $row;
                    break;

                default:
                    $tip = "search";
                    $str = array('enabled' => "='1'", 'keywords' => " !=''");
                    break;
            }

            if (empty($row))
                $data = $this->PHPShopOrm->select(array('keywords', 'id'), $str, false, array("limit" => $this->page_limit), __CLASS__, __FUNCTION__);

            if (is_array($data))
                foreach ($data as $row) {
                    $explode = explode(", ", $row['keywords']);
                    foreach ($explode as $ev)
                        if (!empty($ev)) {
                            $ArrayWords[] = $ev;
                            $ArrayLinks[$ev] = $row['id'];
                        }
                }
            if (is_array($ArrayWords))
                foreach ($ArrayWords as $k => $v) {
                    $count = array_keys($ArrayWords, $v);
                    $CloudCount[$v]['size'] = count($count);
                }

            // ������� ������ ��������
            $i = 0;
            if (is_array($CloudCount))
                foreach ($CloudCount as $k => $v) {
                    if ($i < $this->word_limit)
                        $CloudCountLimit[$k] = $v;
                    $i++;
                }


            //!!!!!! ������ ������, ���� ����� ����� � ���� �����, ��� ���� � ���������� �������!!!!
            $tip = "words";

            if (is_array($CloudCountLimit))
                foreach ($CloudCountLimit as $key => $val) {

                    // ������ ����
                    $key = str_replace('"', '', $key);
                    $key = str_replace("'", '', $key);
                    if ($tip == "words")
                        $disp.='<div><a href="/search/?words=' . urlencode($key) . '">' . $key . '</a></div>';
                    else
                        $disp.="<a href='/search/?words=" . urlencode($key) . "' style='font-size:12pt;'>$key</a>";
                }

            // ������ ����
            $disp = str_replace('\n', '', $disp);

            if ($tip == "search" and !empty($disp))
                $disp = '
<div id="wpcumuluscontent">�������� ����...</div><script type="text/javascript">
var dd=new Date();
var spath = "' . $this->get('dir.dir') . 'phpshop/lib/templates";
var so = new SWFObject(spath+"/tagcloud/tagcloud.swf?rnd="+dd.getTime(), "tagcloudflash", "180", "180", "9", "' . $this->color . '");
so.addParam("wmode", "transparent");
so.addParam("allowScriptAccess", "always");
so.addVariable("tcolor", "' . $this->color . '");
so.addVariable("tspeed", "150");
so.addVariable("distr", "true");
so.addVariable("mode", "tags");
so.addVariable("tagcloud", "<tags>' . $disp . '</tags>");
so.write("wpcumuluscontent");</script>
';

            // ������ ����������
            $disp = str_replace('\n', '', $disp);
            $disp = str_replace(chr(13), '', $disp);
            $disp = str_replace(chr(10), '', $disp);

            // ���������� ����������
            if (!empty($disp)) {
                $this->set('leftMenuName', __("������ �����"));
                $this->set('leftMenuContent', '<div class="product-tags">' . $disp . '</div>');

                // �������� ������ � ����� �������
                $this->setHook(__CLASS__, __FUNCTION__, $disp, 'END');

                // ���������� ������
                $dis.=$this->parseTemplate($this->getValue('templates.left_menu'));
            }
            return $dis;
        }
    }

}

?>