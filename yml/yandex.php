<?php

/**
 * ���� �������� ��� ������ ������
 * @package PHPShopCore
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
        $data = $PHPShopOrm->select(array('id'), array('name' => '="' . $name . '"'), false, array('limit' => 1));
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
     * ����� � ������� ������������ ������ ������ ��������������
     * @param array $row ������ ������������� ������
     * @return string ��� �������������� � ����
     */
    function search($row) {
        if (is_array($row))
            foreach ($row as $val) {
                if (!empty($this->sort_array[$val[0]])) {
                    return '<' . $this->tag . '>' . $this->sort_array[$val[0]] . '</' . $this->tag . '>';
                }
            }
    }

}

class PHPShopYml {

    var $xml = null;

    /**
     * @var bool ����� ����������
     */
    var $vendor = false;

    /**
     * @var string ��� ����
     */
    var $vendor_tag = 'vendor';

    /**
     * @var string ��� ��������������
     */
    var $vendor_name = '�����';

    function PHPShopYml() {
        $this->PHPShopSystem = new PHPShopSystem();
        $PHPShopValuta = new PHPShopValutaArray();
        $this->PHPShopValuta = $PHPShopValuta->getArray();

        // ������� ��������
        $this->percent = $this->PHPShopSystem->getValue('percent');

        // ������ �� ��������
        $this->defvaluta = $this->PHPShopSystem->getValue('dengi');
        $this->defvalutaiso = $this->PHPShopValuta[$this->defvaluta]['iso'];
        $this->defvalutacode = $this->PHPShopValuta[$this->defvaluta]['code'];

        // ���-�� ������ ����� ������� � ����
        $this->format = $this->PHPShopSystem->getSerilizeParam('admoption.price_znak');
    }

    // ����� ���������
    function category() {
        $Catalog = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
        $data = $PHPShopOrm->select(array('id,name,parent_to'), false, false, array('limit' => 1000));

        if (is_array($data))
            foreach ($data as $row) {
                $Catalog[$row['id']]['id'] = $row['id'];
                $Catalog[$row['id']]['name'] = $row['name'];
                $Catalog[$row['id']]['parent_to'] = $row['parent_to'];
            }

        return $Catalog;
    }

    /**
     * ������ �� �������
     * @return array ������ �������
     */
    function product() {
        $Products = array();

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $data = $PHPShopOrm->select(array('*'), array('yml' => "='1'", 'enabled' => "='1'"), false, array('limit' => 1000000));
        if (is_array($data))
            foreach ($data as $row) {
                $id = $row['id'];
                $name = htmlspecialchars($row['name']);
                $category = $row['category'];
                $uid = $row['uid'];
                $price = $row['price'];

                if ($row['p_enabled'] == 1)
                    $p_enabled = "true";
                else
                    $p_enabled = "false";

                $description = trim(PHPShopString::mySubstr($row['description'], 300));
                $baseinputvaluta = $row['baseinputvaluta'];

                if ($baseinputvaluta) {
                    if ($baseinputvaluta !== $this->defvaluta) {//���� ������ ���������� �� �������
                        $vkurs = $this->PHPShopValuta[$baseinputvaluta]['kurs'];

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
                    "description" => $description
                );

                // �������� ����������
                if (!empty($this->vendor))
                    $array['vendor_array'] = unserialize($row['vendor_array']);

                $Products[$id] = $array;
            }
        return $Products;
    }

    function setHeader() {
        $this->xml.='<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="' . date('Y-m-d H:m') . '">

<shop>
<name>' . $this->PHPShopSystem->getName() . '</name>
<company>' . $this->PHPShopSystem->getValue('company') . '</company>
<url>http://' . $_SERVER['SERVER_NAME'] . '</url>';
    }

    function setCurrencies() {
        $this->xml.='<currencies>';
        $this->xml.='<currency id="' . $this->PHPShopValuta[$this->PHPShopSystem->getValue('dengi')]['iso'] . '" rate="1"/>';
        $this->xml.='</currencies>';
    }

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

    function setDelivery() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name30']);
        $data = $PHPShopOrm->select(array('price'), array('flag' => "='1'"), false, array('limit' => 1));
        if (is_array($data))
            $this->xml.='<local_delivery_cost>' . $data['price'] . '</local_delivery_cost>';
    }

    function setProducts() {
        
        $this->xml.='<offers>';
        $product = $this->product($vendor = true);

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
            $seourl_enabled = true;
        }

        // ����� �������������� �� �����
        if ($this->vendor) {
            $PHPShopSortSearch = new PHPShopSortSearch($this->vendor_name, $this->vendor_tag);
        }

        $seourl = null;

        foreach ($product as $val) {

            $bid_str = null;
            $bid_str = null;
            $vendor = null;

            // ��� ��������������
            if ($this->vendor)
                $vendor = $PHPShopSortSearch->search($val['vendor_array']);

            // ���� ���� bid
            if (!empty($val['yml_bid_array']['bid_enabled']))
                $bid_str = '  bid="' . $val['yml_bid_array']['bid'] . '" ';

            // ���� ���� cbid
            if (!empty($val['yml_bid_array']['cbid_enabled']))
                $bid_str.='  cbid="' . $val['yml_bid_array']['cbid'] . '" ';

            if (!empty($seourl_enabled))
                $seourl = '_' . PHPShopString::toLatin($val['name']);

            $this->xml.='<offer id="' . $val['id'] . '" available="' . $val['p_enabled'] . '" ' . $bid_str . '>
 <url>http://' . $_SERVER['SERVER_NAME'] . '/shop/UID_' . $val['id'] . $seourl . '.html?from=yml</url>
      <price>' . $val['price'] . '</price>
      <currencyId>' . $this->defvalutaiso . '</currencyId>
      <categoryId>' . $val['category'] . '</categoryId>
      <picture>http://' . $_SERVER['SERVER_NAME'] . $val['picture'] . '</picture>
      <name>' . $val['name'] . '</name>
      <description>' . $val['description'] . '</description>' .
                    $vendor . '
';
            $cart_min = $this->PHPShopSystem->getSerilizeParam('admoption.cart_minimum');
            if (!empty($cart_min))
                $this->xml.= '<sales_notes>����������� ����� ������ ' . $cart_min . ' ' . $this->defvalutacode . '</sales_notes>';

            $this->xml.='</offer>';
        }
        $this->xml.='</offers>';
    }

    function serFooter() {
        $this->xml.='</shop></yml_catalog>';
    }

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

$PHPShopYml = new PHPShopYml();
$PHPShopYml->compile();
?>