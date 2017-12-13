<?php

/**
 * ���������� �������
 * @author PHPShop Software
 * @version 1.6
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopShop
 * @package PHPShopShopCore
 */
class PHPShopShop extends PHPShopShopCore {

    /**
     * ����� �������
     * @var bool
     */
    var $debug = false;

    /**
     * ����� ����������� ������� ��, ������������� ��� ����� ����� true
     * @var bool
     */
    var $cache = true;

    /**
     * ����� ����� ��, ��������� �� ���� ��� ����������� ������, �������������  array('content','yml_bid_array')
     * @var array
     */
    var $cache_format = array('content', 'yml_bid_array');

    /**
     * ������������ ����� ������ �������/��������� �� �������� ��� ����������� ������, ������������� �� ����� 100
     * @var int
     */
    var $max_item = 200;

    /**
     * ��� ������� ������� ������ �������� ������������� ������
     * @var string 
     */
    var $sort_template = null;
    var $ed_izm = null;

    /**
     * �����������
     */
    function PHPShopShop() {

        // ����������
        $this->path = '/' . $GLOBALS['SysValue']['nav']['path'];

        // ������ �������
        $this->action = array("nav" => array("CID", "UID"));
        parent::PHPShopShopCore();

        $this->PHPShopOrm->cache_format = $this->cache_format;

        $this->page = $this->PHPShopNav->getPage();
        if (strlen($this->page) == 0)
            $this->page = 1;
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
            } else
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }

        return parent::setCell($d1, $d2, $d3, $d4, $d5, $d6, $d7);
    }

    /**
     * ��������� �������� �������� � ����
     */
    function setActiveMenu() {

        $this->set('thisCat', $this->PHPShopCategory->getParam('parent_to'));

        // ������� ������� ��������
        $cat = $this->get('thisCat');
        if (empty($cat))
            $this->set('thisCat', intval($this->PHPShopNav->getId()));

        // ���� 3� ����������� ��������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
        $PHPShopOrm->cache = $this->cache;
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->cache_format = array('content', 'description');
        $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($this->get('thisCat'))), false, array('limit' => 1));
        $ParentTest = $data['parent_to'];

        if (!empty($ParentTest)) {
            $this->set('thisCat', $ParentTest);
            $this->set('thisPodCat', $this->PHPShopCategory->getParam('parent_to'));
        }

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $data);
    }

    /**
     * ������������� ����� ������
     * @param array $files
     */
    function file($row) {

        $files = unserialize($row['files']);
        if ($this->PHPShopSystem->getSerilizeParam('admoption.digital_product_enabled') != 1) {
            if (is_array($files)) {
                $this->set('productFiles', '');
                foreach ($files as $cfile) {
                    $this->set('productFiles', PHPShopText::img('images/shop/action_save.gif', 3, 'absmiddle'), true);
                    $this->set('productFiles', PHPShopText::a($cfile, basename($cfile), basename($cfile), false, false, '_blank'), true);
                    $this->set('productFiles', PHPShopText::br(), true);
                }
            } else {
                $this->set('productFiles', __("��� ������"));
            }
        } else
            $this->set('productFiles', __("����� ����� �������� ������ ����� ������"));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ������ �����
     * @param array $row ������ ������
     */
    function cloud($row) {
        global $PHPShopCloudElement;

        $disp = $PHPShopCloudElement->index($row);
        $this->set('cloud', $disp);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ������������� ������ ������
     * @param string $pages
     */
    function article($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row, 'START'))
            return true;

        $dis = null;
        if (strstr($row['page'], ','))
            $pages = explode(",", $row['page']);

        if (!empty($pages) and is_array($pages)) {
            foreach ($pages as $val) {

                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name11']);
                $row = $PHPShopOrm->select(array('name'), array('link' => "='" . $val . "'"));

                $this->set('pageLink', $val);
                $this->set('pageName', $row['name']);

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $dis.=ParseTemplateReturn($this->getValue('templates.product_pagetema_forma'));
            }

            if (!empty($dis)) {
                $this->set('temaContent', $dis);
                $this->set('temaTitle', __('������ �� ����'));

                // ��������� ��������� � ������
                $this->set('pagetemaDisp', ParseTemplateReturn($this->getValue('templates.product_pagetema_list')));
            }
        }

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
    }

    /**
     * ����� �������� �������
     * ������� �������� � ��������� ���� rating.php
     * @return mixed
     */
    function rating($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ����� �������� �����������
     * ������� �������� � ��������� ���� image_gallery.php
     * @return mixed
     */
    function image_gallery($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ����� ����� �������
     * ������� �������� � ��������� ���� option_select.php
     * @return mixed
     */
    function option_select($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� UID
     */
    function UID() {

        // �������� ������ � ������ �������
        if ($this->setHook(__CLASS__, __FUNCTION__, null, 'START'))
            return true;

        // ������������
        if (!PHPShopSecurity::true_num($this->PHPShopNav->getId()))
            return $this->setError404();

        // ������� ������
        $row = parent::getFullInfoItem(array('*'), array('id' => "=" . $this->PHPShopNav->getId(), 'enabled' => "='1'", 'parent_enabled' => "='0'"), __CLASS__, __FUNCTION__);

        // 404 ������
        if (empty($row['id']))
            return $this->setError404();

        // ���������
        $this->category = $row['category'];
        $this->PHPShopCategory = new PHPShopCategory($this->category);
        $this->category_name = $this->PHPShopCategory->getName();

        // 404 ������ ����������
        if ($this->errorMultibase($this->category))
            return $this->setError404();

        // ������� ���������
        if (empty($row['ed_izm']))
            $ed_izm = $this->ed_izm;
        else
            $ed_izm = $row['ed_izm'];

        // ������������� �����
        $this->file($row);

        // ������ �����
        $this->cloud($row);

        // �����������
        $this->image_gallery($row);

        // ������� �������������
        $this->sort_table($row);

        // ����� ������
        $this->option_select($row);

        // �������
        $this->rating($row);

        // �������� ������ Multibase
        $this->checkMultibase($row['pic_small']);

        $this->set('productName', $row['name']);
        $this->set('productArt', $row['uid']);
        $this->set('productDes', $row['content']);
        $this->set('productPriceMoney', $this->dengi);
        $this->set('productBack', $this->lang('product_back'));
        $this->set('productSale', $this->lang('product_sale'));
        $this->set('productValutaName', $this->currency());
        $this->set('productUid', $row['id']);
        $this->set('productId', $row['id']);

        // ����� ������
        $this->checkStore($row);

        // ������ �� ����
        $this->article($row);

        // �������
        $this->parent($row);

        // �������� ������ � �������� �������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

        // ���������� ������
        $this->add(ParseTemplateReturn($this->getValue('templates.main_product_forma_full')), true);

        // ���������� ������
        $this->odnotip($row);

        // ������ ������������ ���������
        $cat = $this->PHPShopCategory->getValue('parent_to');
        if (!empty($cat)) {
            $parent_category_row = $this->select(array('id,name,parent_to'), array('id' => '=' . $cat), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.categories'), 'cache' => 'true'));
        } else {
            $cat = 0;
            $parent_category_row = array(
                'name' => '�������',
                'id' => 0
            );
        }

        $this->set('catalogCat', $parent_category_row['name']);
        $this->set('catalogId', $parent_category_row['id']);
        $this->set('catalogUId', $cat);
        $this->set('pcatalogId', $this->category);
        $this->set('productName', $row['name']);
        $this->set('catalogCategory', $this->PHPShopCategory->getName());
        $this->set('pcatalogId', $this->category);

        // ��������� �������� �������� � ����
        $this->setActiveMenu();

        // ��������� ������� ������ ��� ����� ��������
        $this->navigation($this->category, $row['name']);

        // ���� ���������
        $this->set_meta(array($row, $this->PHPShopCategory->getArray(), $parent_category_row));
        $this->lastmodified = $row['datas'];

        // �������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_page_full'));
    }

    /**
     * ����-����
     * @param array $row ������
     */
    function set_meta($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ���������� ������
     * @param array $row ������ ������
     */
    function odnotip($row) {
        global $PHPShopProductIconElements;

        $this->odnotip_setka_num = 1;
        $this->line = false;
        $this->template_odnotip = 'main_spec_forma_icon';

        // �������� ������ � ������ �������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $row, 'START');
        if ($hook)
            return true;

        $disp = null;
        $odnotipList = null;
        if (!empty($row['odnotip'])) {
            if (strpos($row['odnotip'], ','))
                $odnotip = explode(",", $row['odnotip']);
            elseif (is_numeric(trim($row['odnotip'])))
                $odnotip[] = trim($row['odnotip']);
        }

        // ������ ��� �������
        if (is_array($odnotip))
            foreach ($odnotip as $value) {
                if (!empty($value))
                    $odnotipList.=' id=' . trim($value) . ' OR';
            }

        $odnotipList = substr($odnotipList, 0, strlen($odnotipList) - 2);

        // ����� �������� �������� �� ������
        if ($this->PHPShopSystem->getSerilizeParam('admoption.sklad_status') == 2)
            $chek_items = ' and items>0';
        else
            $chek_items = null;

        if (!empty($odnotipList)) {

            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug = $this->debug;
            $result = $PHPShopOrm->query("select * from " . $this->objBase . " where (" . $odnotipList . ") " . $chek_items . " and  enabled='1' and parent_enabled='0' and sklad!='1' order by num");
            while ($row = mysql_fetch_assoc($result))
                $data[] = $row;

            // ����� �������
            if (!empty($data) and is_array($data))
                $disp = $PHPShopProductIconElements->seamply_forma($data, $this->odnotip_setka_num, $this->template_odnotip, $this->line);
        }


        if (!empty($disp)) {
            // ������� � ����������� �����
            if (PHPShopParser::check($this->getValue('templates.main_product_odnotip_list'), 'productOdnotipList')) {
                $this->set('productOdnotipList', $disp);
                $this->set('productOdnotip', __('������������� ������'));
            } else {
                // ������� � ������ �������
                $this->set('specMainTitle', __('������������� ������'));
                $this->set('specMainIcon', $disp);
            }

            // �������� ������ � �������� �������
            $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

            $odnotipDisp = ParseTemplateReturn($this->getValue('templates.main_product_odnotip_list'));
            $this->set('odnotipDisp', $odnotipDisp);
        }
        // ������� ��������� �������
        else {
            $this->set('specMainIcon', $PHPShopProductIconElements->specMainIcon(true, $this->category));
        }

        // �������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
    }

    /**
     * ����� �������� �������
     * @param array $row ������ ��������
     */
    function parent($row) {

        // �������� ������ � ������ �������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row, 'START'))
            return true;

        $select_value = array();
        $row['parent'] = PHPShopSecurity::CleanOut($row['parent']);

        if (!empty($row['parent'])) {
            $parent = explode(",", $row['parent']);

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
            if (!empty($row['price'])) {
                $select_value[] = array($row['name'] . " -  (" . $this->price($row) . "
                    " . $this->get('productValutaName') . ')', $row['id'], false);
            }


            // ���������� ������ �������
            if (is_array($Product))
                foreach ($Product as $p) {
                    if (!empty($p)) {

                        // ���� ����� �� ������
                        if (empty($p['priceSklad'])) {
                            $price = $this->price($p);
                            $select_value[] = array($p['name'] . ' -  (' . $price . ' ' . $this->get('productValutaName') . ')', $p['id'], false);
                        }
                    }
                }

            $this->set('parentList', PHPShopText::select('parentId', $select_value, false));
            $this->set('productParentList', ParseTemplateReturn("product/product_odnotip_product_parent.tpl"));
            $this->set('productPrice', '');
            $this->set('productPriceRub', '');
            $this->set('productValutaName', '');

            // �������� ������ � ����� �������
            $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');
        }
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� CID
     */
    function CID() {

        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ID ���������
        $this->category = PHPShopSecurity::TotalClean($this->PHPShopNav->getId(), 1);
        $this->PHPShopCategory = new PHPShopCategory($this->category);
        $this->category_name = $this->PHPShopCategory->getName();

        // ������ �� �����������
        $parent_category_row = $this->select(array('*'), array('parent_to' => '=' . $this->category), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.categories')));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $parent_category_row, 'MIDDLE');

        // ���� ������
        if (empty($parent_category_row['id'])) {

            $this->CID_Product();
        }
        // ���� ��������
        else {

            $this->CID_Category();
        }
    }

    /**
     * ��������� SQL ������� �� �������� ��������� � ���������
     * ������� �������� � ��������� ���� query_filter.php
     * @return mixed
     */
    function query_filter() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if (!empty($hook))
            return $hook;

        return $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

    /**
     * ����� ������� ������������� ������
     * ������� �������� � ��������� ���� sort_table.php
     * @param array $row ������ ��������
     * @return mixed
     */
    function sort_table($row) {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $row))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $row);
    }

    /**
     * ����� ������ �������
     * @param integer $category �� ���������
     */
    function CID_Product($category = null) {

        if (!empty($category))
            $this->category = intval($category);

        // �������� ������ � ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ���� ��� ���������
        $this->objPath = './CID_' . $this->category . '_';

        // ������
        $this->set('productValutaName', $this->currency());

        // ���������� ����� ��� ������ ������
        $cell = $this->PHPShopCategory->getParam('num_row');

        // ������ ����������
        $order = $this->query_filter();

        // ���-�� ������� �� ��������
        $num_cow = $this->PHPShopCategory->getParam('num_cow');
        if (!empty($num_cow))
            $this->num_row = $num_cow;

        // ������� ������
        if (is_array($order)) {

            $this->dataArray = parent::getListInfoItem(false, false, false, __CLASS__, __FUNCTION__, $order['sql']);

            // ���������
            $this->setPaginator(count($this->dataArray), $order['sql']);
        } else {
            // ������� ������
            $this->PHPShopOrm->sql = 'select * from ' . $this->SysValue['base']['products'] . ' where ' . $order;
            $this->PHPShopOrm->debug = $this->debug;
            $this->PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
            $this->dataArray = $this->PHPShopOrm->select();
            $this->PHPShopOrm->clean();

            // ���������
            $this->setPaginator(count($this->dataArray), $order);
        }

        // ��������� � ������ ������ � ��������
        $grid = $this->product_grid($this->dataArray, $cell);
        if (empty($grid))
            $grid = PHPShopText::h2($this->lang('empty_product_list'));
        $this->add($grid, true);

        // ������������ ���������
        $cat = $this->PHPShopCategory->getParam('parent_to');

        // ������ ������������ ���������
        if (!empty($cat)) {
            $parent_category_row = $this->select(array('id,name,parent_to'), array('id' => '=' . $cat), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.categories'), 'cache' => 'true'));
        } else {
            $cat = 0;
            $parent_category_row = array();
        }

        $this->set('catalogCat', $parent_category_row['name']);
        $this->set('catalogCategory', $this->PHPShopCategory->getName());
        $this->set('productId', $this->category);
        $this->set('catalogId', $cat);
        $this->set('pcatalogId', $this->category);

        // ������ �������
        PHPShopObj::loadClass('sort');
        $PHPShopSort = new PHPShopSort($this->category, $this->PHPShopCategory->getParam('sort'), true, $this->sort_template);
        $this->set('vendorDisp', $PHPShopSort->display());

        // ��������� �������� ������� � ����
        $this->setActiveMenu();

        // ���� ���������
        $this->set_meta(array($this->PHPShopCategory->getArray(), $parent_category_row));

        // ����������� ���������
        $this->other_cat_navigation($cat);

        // ��������� ������� ������ ��� ����� ��������
        $this->navigation($cat, $this->PHPShopCategory->getName());

        // �������� ��������
        $this->set('catalogContent', Parser($this->PHPShopCategory->getContent()));

        // ������ �����
        $this->cloud($this->dataArray);

        // �������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_page_list'));
    }

    /**
     * �������������� ��������� ��������� � ������ �������
     * @param Int $parent �� �������� ���������
     */
    function other_cat_navigation($parent) {

        // �������� ������ � ������ �������
        $this->setHook(__CLASS__, __FUNCTION__, $parent, 'START');

        // ��� ��������
        $dis = PHPShopText::h1($this->get('catalogCat'));

        $dataArray = array();
        $dis = null;

        // ������������� ����������� ����
        foreach ($GLOBALS['Cache'][$GLOBALS['SysValue']['base']['categories']] as $val) {
            if ($val['parent_to'] == $parent)
                $dataArray[] = $val;
        }

        if (count($dataArray) > 1) {
            foreach ($dataArray as $row) {

                if ($row['id'] == $this->category)
                    $class = 'activ_catalog';
                else
                    $class = null;

                $dis.=PHPShopText::a($this->path . '/CID_' . $row['id'] . '.html', $row['name'], false, false, false, false, $class);
                $dis.=' | ';
            }
        }
        // ������� ������ �� �� ��� ���������� ������ � ����
        else {
            $PHPShopOrm = new PHPShopOrm($this->getValue('base.categories'));
            $PHPShopOrm->debug = $this->debug;
            $PHPShopOrm->cache = false;
            $dataArray = $PHPShopOrm->select(array('*'), array('parent_to' => '=' . $parent), array('order' => 'num'), array('limit' => 100));
            if (is_array($dataArray))
                foreach ($dataArray as $row) {

                    if ($row['id'] == $this->category)
                        $class = 'activ_catalog';
                    else
                        $class = null;

                    $dis.=PHPShopText::a($this->path . '/CID_' . $row['id'] . '.html', $row['name'], false, false, false, false, $class);
                    $dis.=' | ';
                }
        }

        // �������� ������ � ����� �������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $parent, 'END');
        if ($hook)
            return true;

        $this->set('DispCatNav', $dis);
    }

    /**
     * ����� ������ ���������
     */
    function CID_Category() {

        // �������� ������ � ������ �������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, false, 'START');
        if ($hook)
            return true;

        // ID ���������
        $this->category = PHPShopSecurity::TotalClean($this->PHPShopNav->getId(), 1);
        $this->PHPShopCategory = new PHPShopCategory($this->category);

        // ������� �������
        if ($this->PHPShopCategory->getParam('skin_enabled') == 1)
            return $this->setError404();

        // �������� ���������
        $this->category_name = $this->PHPShopCategory->getName();

        // ������� �������
        $where = array('parent_to' => '=' . $this->category, 'skin_enabled' => "!='1'");

        // ����������
        if ($this->PHPShopSystem->ifSerilizeParam('admoption.base_enabled')) {
            $where['servers'] = " REGEXP 'i" . $this->PHPShopSystem->getSerilizeParam('admoption.base_id') . "i'";
        }


        // ������� ������
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.categories'));
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->cache = $this->cache;
        $dis = null;
        $dataArray = $PHPShopOrm->select(array('*'), $where, array('order' => 'num'), array('limit' => $this->max_item));
        if (is_array($dataArray))
            foreach ($dataArray as $row) {
                $dis.=PHPShopText::li($row['name'], $this->path . '/CID_' . $row['id'] . '.html');
            }

        $this->set('catalogContent', Parser($this->PHPShopCategory->getContent()));
        $disp = PHPShopText::ul($dis);
        $this->set('catalogName', $this->category_name);
        $this->set('catalogList', $disp);
        $this->set('thisCat', $this->PHPShopNav->getId());

        // ������ ������������ ��������� ��� meta
        $cat = $this->PHPShopCategory->getValue('parent_to');
        if (!empty($cat)) {
            $parent_category_row = $this->select(array('id,name,parent_to'), array('id' => '=' . $cat), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.categories'), 'cache' => 'true'));
        } else {
            $cat = 0;
            $parent_category_row = array(
                'name' => '�������',
                'id' => 0
            );
        }

        // ��������� �������� ������� � ����
        $this->setActiveMenu();

        // ���� ���������
        $this->set_meta(array($this->PHPShopCategory->getArray(), $parent_category_row));

        // ��������� ������� ������ ��� ����� ��������
        $this->navigation($this->PHPShopCategory->getParam('parent_to'), $this->category_name);

        // �������� ������ � ����� �������
        $this->setHook(__CLASS__, __FUNCTION__, $dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.catalog_info_forma'));
    }

    /**
     * ����� 404 ������ �� ������ /shop/
     */
    function index() {
        $this->setError404();
    }

}

?>