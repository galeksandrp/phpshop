<?php

/**
 * ���� �������� ��� ������ ������
 * @author PHPShop Software
 * @version 1.6
 * @package PHPShopXML
 */
$_classPath = "../phpshop/";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("modules");

// ������
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 *  ����� ������������� �� �����
 *  @example $search=PHPShopSortSearch('�����','vendor'); $search->search($vendor_aray);
 */
class PHPShopSortSearch {

    /**
     * ������� ������������ �� �����
     * @param string $name ��� ��������������
     * @param string $tag ��� ����������
     */
    function PHPShopSortSearch($name, $tag) {

        $this->tag = $tag;
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name20']);
        $PHPShopOrm->debug = false;
        $data = $PHPShopOrm->select(array('id'), array('name' => '="' . $name . '"', 'category' => "!=0"), false, array('limit' => 1));
        if (is_array($data)) {

            $sort_category = $data['id'];
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name21']);
            $PHPShopOrm->debug = false;
            $data = $PHPShopOrm->select(array('id,name'), array('category' => '=' . $sort_category), false, array('limit' => 100));
            if (is_array($data)) {
                foreach ($data as $val)
                    $this->sort_array[$val['id']] = $val['name'];
            }
        }
    }

    /**
     * ����� � ������� ������������� ������ ������ ��������������
     * @param array $row ������ ������������� ������
     * @return string ��� �������������� � ����
     */
    function search($row) {

        // �������� �� ������� ��������
        if (strstr($this->tag, ' ')) {
            $tag_array = explode(" ", $this->tag);
            $tag_start = $this->tag;
            $tag_end = $tag_array[0];
        } else {
            $tag_start = $tag_end = $this->tag;
        }

        if (is_array($row))
            foreach ($row as $val) {
                if (!empty($this->sort_array[$val[0]])) {



                    return '
                        <' . $tag_start . '>' . $this->sort_array[$val[0]] . '</' . $tag_end . '>';
                }
            }


        return '
                        <' . $tag_start . '></' . $tag_end . '>';
    }

}

/**
 * �������� YML ��� ������ �������
 * @author PHPShop Software
 * @version 1.2
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
     * ������ �������� ���/��� ��������������
     * @var array 
     */
    var $vendor_name = array('vendor' => '�����');

    /**
     * ������ ������� �������
     * @var bool 
     */
    var $memory = true;

    /**
     * �����������
     */
    function PHPShopYml() {
        global $PHPShopModules;

        $this->PHPShopSystem = new PHPShopSystem();
        $PHPShopValuta = new PHPShopValutaArray();
        $this->PHPShopValuta = $PHPShopValuta->getArray();

        // ������
        $this->PHPShopModules = &$PHPShopModules;

        // ������� ��������
        $this->percent = $this->PHPShopSystem->getValue('percent');

        // ������ �� ���������
        $this->defvaluta = $this->PHPShopSystem->getValue('dengi');
        $this->defvalutaiso = $this->PHPShopValuta[$this->defvaluta]['iso'];
        $this->defvalutacode = $this->PHPShopValuta[$this->defvaluta]['code'];

        // ���-�� ������ ����� ������� � ����
        $this->format = $this->PHPShopSystem->getSerilizeParam('admoption.price_znak');

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
                }
                else
                    return $_SESSION['Memory'][__CLASS__][$param[0]][$param[1]];
            }
            elseif (!empty($check))
                return true;
        }
        else
            return true;
    }

    /**
     * ������ �� ���������
     * @return array ������ ���������
     */
    function category() {
        $Catalog = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
        $data = $PHPShopOrm->select(array('id,name,parent_to'), false, false, array('limit' => 1000));

        if (is_array($data))
            foreach ($data as $row) {
                if ($row['id'] != $row['parent_to']) {
                    $Catalog[$row['id']]['id'] = $row['id'];
                    $Catalog[$row['id']]['name'] = $row['name'];
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

        $result = $PHPShopOrm->query("select * from " . $GLOBALS['SysValue']['base']['products'] . " where $where enabled='1' and parent_enabled='0'");
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $name = htmlspecialchars($row['name'], null, 'windows-1251');
            $category = $row['category'];
            $uid = $row['uid'];
            $price = $row['price'];

            if ($row['p_enabled'] == 1)
                $p_enabled = "true";
            else
                $p_enabled = "false";

            $description = htmlspecialchars(trim(PHPShopString::mySubstr($row['description'], 300)), null, 'windows-1251');
            $content = htmlspecialchars(trim(strip_tags($row['content'])), null, 'windows-1251');
            $baseinputvaluta = $row['baseinputvaluta'];

            if ($baseinputvaluta) {
                //���� ������ ���������� �� �������
                if ($baseinputvaluta !== $this->defvaluta) {
                    $vkurs = $this->PHPShopValuta[$baseinputvaluta]['kurs'];

                    // ���� ���� ������� ��� ������ �������
                    if (empty($vkurs))
                        $vkurs = 1;

                    // �������� ���� � ������� ������
                    $price = $price / $vkurs;
                }
            }

            $price = ($price + (($price * $this->percent) / 100));
            $price = round($price, $this->format);

            $array = array(
                "id" => $id,
                "category" => $category,
                "name" => $name,
                "picture" => $row['pic_small'],
                "price" => $price,
                "p_enabled" => $p_enabled,
                "yml_bid_array" => unserialize($row['yml_bid_array']),
                "uid" => $uid,
                "description" => $description,
                "content" => $content,
                "prod_seo_name" => $row['prod_seo_name']
            );

            // �������� ����������
            if (!empty($this->vendor))
                $array['vendor_array'] = unserialize($row['vendor_array']);

            $Products[$id] = $array;
        }
        return $Products;
    }

    /**
     * ��������� 
     */
    function setHeader() {
        $this->xml.='<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="' . date('Y-m-d H:m') . '">
<shop>
<name>' . $this->PHPShopSystem->getName() . '</name>
<company>' . $this->PHPShopSystem->getValue('company') . '</company>
<url>http://' . $_SERVER['SERVER_NAME'] . '</url>';
    }

    /**
     * ������ 
     */
    function setCurrencies() {
        $this->xml.='<currencies>';
        $this->xml.='<currency id="' . $this->PHPShopValuta[$this->PHPShopSystem->getValue('dengi')]['iso'] . '" rate="1"/>';
        $this->xml.='</currencies>';
    }

    /**
     * ��������� 
     */
    function setCategories() {
        $this->xml.='<categories>';
        $category = $this->category();
        foreach ($category as $val) {
            if (empty($val['parent_to']))
                $this->xml.='<category id="' . $val['id'] . '">' . $val['name'] . '</category>';
            else
                $this->xml.='<category id="' . $val['id'] . '" parentId="' . $val['parent_to'] . '">' . $val['name'] . '</category>';
        }

        $this->xml.='</categories>';
    }

    /**
     * ��������
     */
    function setDelivery() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name30']);
        $data = $PHPShopOrm->select(array('price'), array('flag' => "='1'", 'is_folder' => "='0'"), false, array('limit' => 1));
        if (is_array($data))
            $this->xml.='<local_delivery_cost>' . $data['price'] . '</local_delivery_cost>';
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
        $this->xml.='<offers>';
        $product = $this->product($vendor = true);

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
            $seourl_enabled = true;
        }


        // ���� ������ SEOURLPRO
        if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
            $seourlpro_enabled = true;
        }

        // ����� �������������� �� �����
        if ($this->vendor) {
            if (is_array($this->vendor_name))
                foreach ($this->vendor_name as $vendor_tag => $vendor_name)
                    $PHPShopSortSearch[] = new PHPShopSortSearch($vendor_name, $vendor_tag);
        }

        $seourl = null;


        foreach ($product as $val) {

            $bid_str = null;
            $bid_str = null;
            $vendor = $param = null;


            // ��� ��������������
            if ($this->vendor) {

                if (is_array($PHPShopSortSearch))
                    foreach ($PHPShopSortSearch as $SortSearch) {

                        // ��������� ���� vendor
                        if ($SortSearch->tag == 'vendor')
                            $vendor.= $SortSearch->search($val['vendor_array']);
                        else
                            $param.= $SortSearch->search($val['vendor_array']);
                    }
            }

            // ���� ���� bid
            if (!empty($val['yml_bid_array']['bid']))
                $bid_str = '  bid="' . $val['yml_bid_array']['bid'] . '" ';



            // ���� ���� cbid
            if (!empty($val['yml_bid_array']['cbid']))
                $bid_str.='  cbid="' . $val['yml_bid_array']['cbid'] . '" ';

            // ����������� ���
            $url = '/shop/UID_' . $val['id'];

            // SEOURL
            if (!empty($seourl_enabled))
                $url.= '_' . PHPShopString::toLatin($val['name']);

            // SEOURLPRO
            if (!empty($seourlpro_enabled)) {
                if (empty($val['prod_seo_name']))
                    $url = '/id/' . str_replace("_", "-", PHPShopString::toLatin($val['name'])) . '-' . $val['id'];
                else
                    $url = '/id/' . $val['prod_seo_name'] . '-' . $val['id'];
            }

            $xml = '
<offer id="' . $val['id'] . '" available="' . $val['p_enabled'] . '" ' . $bid_str . '>
 <url>http://' . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . $url . '.html?from=yml</url>
      <price>' . $val['price'] . '</price>
      <currencyId>' . $this->defvalutaiso . '</currencyId>
      <categoryId>' . $val['category'] . '</categoryId>
      <picture>http://' . $_SERVER['SERVER_NAME'] . $val['picture'] . '</picture>
      <name>' . $this->cleanStr($val['name']) . '</name>' .
                    $vendor . '
      <description>' . $this->cleanStr($val['description']) . '</description>' .
                    $param . '
';

            $cart_min = $this->PHPShopSystem->getSerilizeParam('admoption.cart_minimum');
            if (!empty($cart_min))
                $xml.= '<sales_notes>����������� ����� ������ ' . $cart_min . ' ' . $this->defvalutacode . '</sales_notes>';

            $xml.='</offer>';

            // �������� ������, ��������� � ������ ������� ������ ��� �����������
            if ($this->memory_get(__CLASS__ . '.' . __FUNCTION__, true)) {
                $hook = $this->setHook(__CLASS__, __FUNCTION__, array('xml' => $xml, 'val' => $val));
                if ($hook) {
                    $this->xml.= $hook;
                } else {
                    $this->xml.= $xml;
                    $this->memory_set(__CLASS__ . '.' . __FUNCTION__, 0);
                }
            }
            else
                $this->xml.= $xml;
        }
        $this->xml.='
        </offers>
        ';
    }

    /**
     * ������ 
     */
    function serFooter() {
        $this->xml.='</shop></yml_catalog>';
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
header("Content-Type: application/xml");
$PHPShopYml = new PHPShopYml();
$PHPShopYml->compile();
?>