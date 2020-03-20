<?php

/**
 * ���� �������� ��� ������ ������
 * @author PHPShop Software
 * @version 2.6
 * @package PHPShopXML
 * @example ?ssl [bool] SSL
 * @example ?getall [bool] �������� ���� ������� ��� ����� ����� YML
 * @example ?from [bool] ����� � ������ ������ from
 * @example ?amount [bool] ���������� ������ � ��� amount ��� CRM
 * @example ?search [bool] ������ ������� �� �������� (��� ������.����� �� �����).
 */
$_classPath = "../phpshop/";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini", true, true);
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("file");
PHPShopObj::loadClass("promotions");

// ��������
$PHPShopSystem = new PHPShopSystem();

// ���������
$PHPShopBase->checkMultibase();

// ����������
$PHPShopPromotions = new PHPShopPromotions();

// ������
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * �������� YML ��� ������ �������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopClass
 */
class PHPShopYml {

    var $xml = null;

    /**
     * ����� �������������
     * @var bool
     */
    var $vendor = false;

    /**
     * ����� ����������
     * @var bool
     */
    var $param = false;
    var $option = false;

    /**
     * ������ �������
     * @var array
     */
    var $brand_array = array();

    /**
     * ������ ����������
     * @var array
     */
    var $param_array = array();

    /**
     * ������ �������� ���/��� ��������������
     * @var array
     */
    var $vendor_name = array('vendor' => '�����');

    /**
     * ������ ������� �������
     * @var bool
     */
    var $memory = true;
    var $ssl = 'http://';
    var $image_source = false;

    /**
     * �����������
     */
    function __construct() {
        global $PHPShopModules, $PHPShopSystem, $PHPShopPromotions;

        $this->PHPShopSystem = $PHPShopSystem;
        $PHPShopValuta = new PHPShopValutaArray();
        $this->PHPShopValuta = $PHPShopValuta->getArray();

        // ������
        $this->PHPShopModules = &$PHPShopModules;

        // ����������
        $this->PHPShopPromotions = $PHPShopPromotions;

        // ������� ��������
        $this->percent = $this->PHPShopSystem->getValue('percent');

        // ������ �� ���������
        $this->defvaluta = $this->PHPShopSystem->getValue('dengi');
        $this->defvalutaiso = $this->PHPShopValuta[$this->defvaluta]['iso'];
        $this->defvalutacode = $this->PHPShopValuta[$this->defvaluta]['code'];

        // ���-�� ������ ����� ������� � ����
        $this->format = $this->PHPShopSystem->getSerilizeParam('admoption.price_znak');

        //������� ����� � �������� ����� �������� � �������
        $this->parent_price_enabled = $this->PHPShopSystem->getSerilizeParam('admoption.parent_price_enabled');

        // CRM
        $this->option = $this->PHPShopSystem->ifSerilizeParam('1c_option.update_option');

        // SSL
        if (isset($_GET['ssl']))
            $this->ssl = 'https://';

        // �������� �����������
        $this->image_source = $this->PHPShopSystem->ifSerilizeParam('admoption.image_save_source');

        $this->setHook(__CLASS__, __FUNCTION__);
    }

    /**
     * ���������� ��������� ������� ���������� �������
     * @param string $class_name ��� ������
     * @param string $function_name ��� ������
     * @param mixed $data ������ ��� ���������
     * @param string $rout ������� ������ � ������� [END | START | MIDDLE], �� ��������� END
     * @return bool
     */
    function setHook($class_name, $function_name, $data = false, $rout = false) {
        return $this->PHPShopModules->setHookHandler($class_name, $function_name, array(&$this), $data, $rout);
    }

    /**
     * ������ � ������
     * @param string $param ��� ��������� [catalog.param]
     * @param mixed $value ��������
     */
    function memory_set($param, $value) {
        if (!empty($this->memory)) {
            $param = explode(".", $param);
            $_SESSION['Memory'][__CLASS__][$param[0]][$param[1]] = $value;
            $_SESSION['Memory'][__CLASS__]['time'] = time();
        }
    }

    /**
     * ������� �� ������
     * @param string $param ��� ��������� [catalog.param]
     * @param bool $check �������� � �����
     * @return
     */
    function memory_get($param, $check = false) {
        if (!empty($this->memory)) {
            $param = explode(".", $param);
            if (isset($_SESSION['Memory'][__CLASS__][$param[0]][$param[1]])) {
                if (!empty($check)) {
                    if (!empty($_SESSION['Memory'][__CLASS__][$param[0]][$param[1]]))
                        return true;
                } else
                    return $_SESSION['Memory'][__CLASS__][$param[0]][$param[1]];
            }
            elseif (!empty($check))
                return true;
        } else
            return true;
    }

    /**
     * �������� ���� �������� ������ Multibase
     * @return string
     */
    function queryMultibase() {

        // ����������
        if (defined("HostID") or defined("HostMain")) {


            $multi_cat = array();

            // �� �������� ������� ��������
            $where['skin_enabled '] = "!='1'";

            if (defined("HostID"))
                $where['servers'] = " REGEXP 'i" . HostID . "i'";
            elseif (defined("HostMain"))
                $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
            $PHPShopOrm->debug = $this->debug;
            $data = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 1000), __CLASS__, __FUNCTION__);
            if (is_array($data)) {
                foreach ($data as $row) {
                    $multi_cat[] = $row['id'];
                }
            }

            $multi_select = ' category IN (' . @implode(',', $multi_cat) . ') and ';

            return $multi_select;
        }
    }

    /**
     * ������ �� ���������
     * @return array ������ ���������
     */
    function category() {
        $Catalog = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

        // �� �������� ������� ��������
        $where['skin_enabled'] = "!='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['skin_enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $data = $PHPShopOrm->select(array('id,name,parent_to'), $where, false, array('limit' => 1000));
        if (is_array($data))
            foreach ($data as $row) {
                if ($row['id'] != $row['parent_to']) {
                    $Catalog[$row['id']]['id'] = $row['id'];
                    $Catalog[$row['id']]['name'] = '<![CDATA[' . $row['name'] . ']]>';
                    $Catalog[$row['id']]['parent_to'] = $row['parent_to'];
                }
            }

        return $Catalog;
    }

    /**
     * ������ �� �������. ��������������.
     * @return array ������ �������
     */
    function product() {
        $Products = array();

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

        if (isset($_GET['getall']))
            $where = null;
        else
            $where = "yml='1' and";


        // ����������
        $queryMultibase = $this->queryMultibase();
        if (!empty($queryMultibase))
            $where .= ' ' . $queryMultibase;

        $wherePrice = 'and price>0';
        if($_GET['search']) {
            $wherePrice = '';
        }

        $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['products'] . " where $where enabled='1' and parent_enabled='0' $wherePrice");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $name = trim(strip_tags($row['name']));
            $category = $row['category'];
            $uid = $row['uid'];
            $price = $row['price'];
            $oldprice = $row['price_n'];

            // ����������
            $promotions = $this->PHPShopPromotions->getPrice($row);
            if (is_array($promotions)) {
                $price = $promotions['price'];
                $oldprice = $promotions['price_n'];
            }

            if (empty($row['description']))
                $row['description'] = $row['content'];

            if ($row['p_enabled'] == 1)
                $p_enabled = "true";
            else
                $p_enabled = "false";

            $description = '<![CDATA[' . trim(strip_tags($row['description'], '<p><h3><ul><li><br>')) . ']]>';
            $content = '<![CDATA[' . $row['content'] . ']]>';
            $baseinputvaluta = $row['baseinputvaluta'];

            //���� ������ ���������� �� �������
            if ($baseinputvaluta !== $this->defvaluta) {
                $vkurs = $this->PHPShopValuta[$baseinputvaluta]['kurs'];

                // ���� ���� ������� ��� ������ �������
                if (empty($vkurs))
                    $vkurs = 1;

                // �������� ���� � ������� ������
                $price = $price / $vkurs;
                $oldprice = $oldprice / $vkurs;
            }


            $price = ($price + (($price * $this->percent) / 100));
            $price = round($price, intval($this->format));
            $oldprice = round($oldprice, intval($this->format));

            $array = array(
                "id" => $id,
                "category" => $category,
                "name" => str_replace(array('&#43;', '&#43'), '+', $name),
                "picture" => $row['pic_big'],
                "price" => $price,
                "oldprice" => $oldprice,
                "weight" => $row['weight'],
                "p_enabled" => $p_enabled,
                "yml_bid_array" => unserialize($row['yml_bid_array']),
                "uid" => $uid,
                "vkurs" => $vkurs,
                "description" => $description,
                "content" => $content,
                "prod_seo_name" => $row['prod_seo_name'],
                "manufacturer_warranty" => $row['manufacturer_warranty'],
                "sales_notes" => $row['sales_notes'],
                "country_of_origin" => $row['country_of_origin'],
                "adult" => $row['adult'],
                "rec" => $row['odnotip'],
                "delivery" => $row['delivery'],
                "pickup" => $row['pickup'],
                "store" => $row['store'],
                "yandex_min_quantity" => $row['yandex_min_quantity'],
                "yandex_step_quantity" => $row['yandex_step_quantity'],
                "vendor_code" => $row['vendor_code'],
                "vendor_name" => $row['vendor_name'],
                "condition" => $row['yandex_condition'],
                "condition_reason" => $row['yandex_condition_reason'],
                "items" => $row['items'],
                "gift" => $row['gift'],
                "gift_check"=>$row['gift_check'],
                "gift_items"=>$row['gift_items'],
            );

            // �������� ����������
            if (!empty($this->vendor))
                $array['vendor_array'] = unserialize($row['vendor_array']);

            // ����-������
            if($_GET['search']) {
                $row['parent'] = null;
                $array['parent'] = null;
            }
            if (!empty($row['parent'])) {
                $parent = @explode(",", $row['parent']);

                $Parents = $this->parent($parent, $array);
                if (is_array($Parents)) {
                    $array['parent'] = 1;
                    $Products = array_merge($Products, $Parents);
                }
            }

            $Products[$id] = $array;
        }
        return $Products;
    }

    /**
     * ������ �� ������� ��������.
     * @return array ������ �������
     */
    function parent($parent, $parent_array) {

    $PHPShopOrm = new  PHPShopOrm($GLOBALS['SysValue']['base']['products']);

    // ������� �� 1�
    if ($this->option)
        $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['products'] . " where uid IN (\"" . @implode('","', $parent) . "\") and enabled='1' and parent_enabled='1' and price>0");
    else
        $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['products'] . " where id IN (\"" . @implode('","', $parent) . "\") and enabled='1' and parent_enabled='1' and price>0");

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = trim(strip_tags($row['name']));
        $uid = $row['uid'];
        $price = $row['price'];
        $oldprice = $row['price_n'];

        // ����������
        $promotions = $this->PHPShopPromotions->getPrice($row);
        if (is_array($promotions)) {
            $price = $promotions['price'];
            $oldprice = $promotions['price_n'];
        }

        $baseinputvaluta = $row['baseinputvaluta'];

        if ($baseinputvaluta) {

            //���� ������ ���������� �� �������
            if ($baseinputvaluta !== $this->defvaluta) {

                // �������� ���� � ������� ������
                $price = $price / $parent_array['vkurs'];
                $oldprice = $oldprice / $parent_array['vkurs'];
            }
        }

        $price = ($price + (($price * $this->percent) / 100));
        $price = round($price, intval($this->format));
        $oldprice = round($oldprice, intval($this->format));

        $array = array(
            "id" => $id,
            "group_id" => $parent_array['id'],
            "parent_name" => $parent_array['name'],
            "size" => $row['parent'],
            "color" => $row['parent2'],
            "category" => $parent_array['category'],
            "name" => str_replace(array('&#43;', '&#43'), '+', $name),
            "picture" => $parent_array['picture'],
            "price" => $price,
            "oldprice" => $oldprice,
            "weight" => $parent_array['weight'],
            "p_enabled" => $parent_array['p_enabled'],
            "yml_bid_array" => $parent_array['yml_bid_array'],
            "uid" => $uid,
            "description" => $parent_array['description'],
            "prod_seo_name" => $parent_array['prod_seo_name'],
            "fee" => $parent_array['fee'],
            "cpa" => $parent_array['cpa'],
            "manufacturer_warranty" => $parent_array['manufacturer_warranty'],
            "sales_notes" => $parent_array['sales_notes'],
            "country_of_origin" => $parent_array['country_of_origin'],
            "adult" => $parent_array['adult'],
            "rec" => $parent_array['odnotip'],
            "delivery" => $parent_array['delivery'],
            "pickup" => $parent_array['pickup'],
            "store" => $parent_array['store'],
            "yandex_min_quantity" => $parent_array['yandex_min_quantity'],
            "yandex_step_quantity" => $parent_array['yandex_step_quantity'],
            "vendor_array" => $parent_array['vendor_array'],
            "items" => $row['items'],
            "gift" => $row['gift'],
            "gift_check"=>$row['gift_check'],
            "gift_items"=>$row['gift_items'],
        );

        $Products[$id] = $array;
    }
    return $Products;
}

/**
 * ���������
 */
function setHeader() {
    $this->xml .= '<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="' . date('Y-m-d H:m') . '">
<shop>
<name>' . $this->PHPShopSystem->getName() . '</name>
<company>' . $this->PHPShopSystem->getValue('company') . '</company>
<url>' . $this->ssl . $_SERVER['SERVER_NAME'] . '</url>
<platform>PHPShop</platform>
<version>' . $GLOBALS['SysValue']['upload']['version'] . '</version>';
}

/**
 * ������
 */
function setCurrencies() {
    $this->xml .= '<currencies>';
    $this->xml .= '<currency id="' . $this->PHPShopValuta[$this->PHPShopSystem->getValue('dengi')]['iso'] . '" rate="1"/>';
    $this->xml .= '</currencies>';
}

/**
 * ���������
 */
function setCategories() {
    $this->xml .= '<categories>';
    $category = $this->category();
    foreach ($category as $val) {
        if (empty($val['parent_to']))
            $this->xml .= '<category id="' . $val['id'] . '">' . $val['name'] . '</category>';
        else
            $this->xml .= '<category id="' . $val['id'] . '" parentId="' . $val['parent_to'] . '">' . $val['name'] . '</category>';
    }

    $this->xml .= '</categories>';
}

/**
 * ��������
 */
function setDelivery() {

    $xml = '<delivery-options/>';

    // �������� ������, ��������� � ������ ������� ������ ��� �����������
    if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
        $hook = $this->setHook(__CLASS__, __FUNCTION__, array('xml' => $xml));
        if ($hook) {
            $this->xml .= $hook;
        } else {
            $this->xml .= $xml;
            $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
        }
    } else
        $this->xml .= $xml;
}

/**
 * ������� ������������
 */
function cleanStr($string) {
    $string = html_entity_decode($string, ENT_QUOTES, 'windows-1251');
    return str_replace('&#43;', '+', $string);
}

/**
 * ������
 */
function setProducts() {
    $vendor = null;
    $this->xml .= '<offers>';
    $product = $this->product($vendor = true);

    // ���� ������ SEOURL
    if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
        $seourl_enabled = true;
    }

    // ���� ������ SEOURLPRO
    if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
        $seourlpro_enabled = true;
    }

    // ���������� ��������
    if (isset($_GET['from']))
        $from = '?from=yml';
    else
        $from = null;

    foreach ($product as $val) {

        $bid_str = null;
        $vendor = $param = null;
        $id = $val['id'];

        // ���� ���� bid
        if (!empty($val['yml_bid_array']['bid']))
            $bid_str = '  bid="' . $val['yml_bid_array']['bid'] . '" ';

        // ���� ���� cbid
        if (!empty($val['yml_bid_array']['cbid']))
            $bid_str .= '  cbid="' . $val['yml_bid_array']['cbid'] . '" ';

        // ����������� ���
        $url = '/shop/UID_' . $val['id'];

        // SEOURL
        if (!empty($seourl_enabled))
            $url .= '_' . PHPShopString::toLatin($val['name']);

        // SEOURLPRO
        if (!empty($seourlpro_enabled)) {
            if (empty($val['prod_seo_name']))
                $url = '/id/' . str_replace("_", "-", PHPShopString::toLatin($val['name'])) . '-' . $val['id'];
            else
                $url = '/id/' . $val['prod_seo_name'] . '-' . $val['id'];
        }

        // ������
        if (!empty($val['group_id'])) {
            $val['id'] = $id;
            $group_id = ' group_id="' . $val['group_id'] . '"';
            $group_postfix = '?option=' . $id;

            if (!empty($seourlpro_enabled)) {

                if (!empty($val['prod_seo_name']))
                    $url = '/id/' . $val['prod_seo_name'] . '-' . $val['group_id'];
                else
                    $url = '/id/' . str_replace("_", "-", PHPShopString::toLatin($val['parent_name'])) . '-' . $val['group_id'];
            } else
                $url = '/shop/UID_' . $val['group_id'];
        }
        // ��������
        elseif (!empty($val['parent']))
            $group_postfix = '?option=' . $id;
        else
            $group_id = $group_postfix = null;

        // ������� ����� � �������� ����� �������� � �������
        if ($this->parent_price_enabled == 0 and ! empty($val['parent']))
            continue;

        // �����������
        if (!empty($val['picture'])) {
            if (!strstr('http:', $val['picture'])) {

                if (!empty($this->image_source))
                    $val['picture'] = str_replace(".", "_big.", $val['picture']);

                $picture = $this->ssl . $_SERVER['SERVER_NAME'] . $val['picture'];
            } else
                $picture = $val['picture'];
        } else
            $picture = null;


        $xml = '
<offer id="' . $val['id'] . '" available="' . $val['p_enabled'] . '" ' . $bid_str . $group_id . '>
 <url>' . $this->ssl . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . $url . '.html' . $group_postfix . '</url>
      <price>' . $val['price'] . '</price>';

        // ������ ����
        if ($val['price_n'] > $val['price'])
            $xml .= '<oldprice>' . $val['price_n'] . '</oldprice>';

        // �����
        if (isset($_GET['amount']))
            $xml .= '<amount>' . $val['items'] . '</amount>';


        $xml .= '<currencyId>' . $this->defvalutaiso . '</currencyId>
      <categoryId>' . $val['category'] . '</categoryId>
      <picture>' . $picture . '</picture>
      <name><![CDATA[' . $this->cleanStr($val['name']) . ']]></name>
      <description>' . $this->cleanStr($val['description']) . '</description>
</offer>';

        // �������� ������, ��������� � ������ ������� ������ ��� �����������
        if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
            $hook = $this->setHook(__CLASS__, __FUNCTION__, array('xml' => $xml, 'val' => $val));
            if ($hook) {
                $this->xml .= $hook;
            } else {
                $this->xml .= $xml;
                $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
            }
        } else
            $this->xml .= $xml;
    }
    $this->xml .= '
        </offers>
        ';
}

/**
 * ������
 */
function serFooter() {

    // �������� ������
    $hook = $this->setHook(__CLASS__, __FUNCTION__);
    if ($hook) {
        $this->xml .= $hook;
    }


    $this->xml .= '</shop></yml_catalog>';
}

/**
 * ���������� ���������, ����� ����������
 */
function compile() {
    $this->setHeader();
    $this->setCurrencies();
    $this->setCategories();
    $this->setDelivery();
    $this->setProducts();
    $this->serFooter();
    echo $this->xml;
}

}

header("HTTP/1.1 200");
header("Content-Type: application/xml; charset=cp1251");
$PHPShopYml = new PHPShopYml();
$PHPShopYml->compile();
?>