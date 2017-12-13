<?php

if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

/**
 * ������� �������
 */
PHPShopObj::loadClass('order');

class ProductLastView extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function ProductLastView() {

        $this->option();

        if ($this->option['num'] == 0)
            $this->option['num'] = 1;

        $this->_PRODUCT = &$_SESSION['product'];

        // ���� ������
        if ($this->option['memory'] == 1)
            $this->init();

        parent::PHPShopElements();
    }

    /**
     * ������������� ����� ������
     */
    function init() {
        if (empty($_COOKIE['productlastview_memory']))
            $this->memory = md5(session_id());
        else
            $this->memory = $_COOKIE['productlastview_memory'];

        $this->get_memory();
    }

    /**
     * ���������
     */
    function option() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['productlastview']['productlastview_system']);
        $PHPShopOrm->debug = $this->debug;
        $this->option = $PHPShopOrm->select();
    }

    /**
     * �������� ������
     * @param int $xid �� ������
     */
    function del($xid) {
        if (is_numeric($xid)) {
            $this->PHPShopCart->del($xid);
            $this->clean_memory();
        }
    }

    /**
     * ��������� ������ ������
     */
    function clean_memory() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['productlastview']['productlastview_memory']);
        $PHPShopOrm->delete(array('memory' => "='" . $this->memory . "'"));
    }

    function add($objID) {

        // ������ �� ������
        $objProduct = new PHPShopProduct(intval($objID));

        // ������ �������
        $array = array(
            "id" => $objProduct->getParam("id"),
            "name" => PHPShopSecurity::CleanStr($objProduct->getParam("name")),
            "price" => PHPShopProductFunction::GetPriceValuta($objID, $objProduct->getParam("price"), $objProduct->getParam("baseinputvaluta"), true),
            "uid" => $objProduct->getParam("uid"),
            "pic_small" => $objProduct->getParam("pic_small"),
            "parent" => intval($parentID)
        );


        $this->_PRODUCT[$array["id"]] = $array;

        // ������� �����
        $this->first_remove();
    }

    /**
     * ������� ������ ������� �� ������
     * @return boolean
     */
    function first_remove() {
        $i = 0;
        if (count($this->_PRODUCT) > $this->option['num']) {
            foreach ($this->_PRODUCT as $key => $v) {
                if (empty($i)) {
                    unset($this->_PRODUCT[$key]);
                    $i++;
                }
                else
                    return true;
            }
        }
    }

    /**
     * ������ ������� � ��
     */
    function add_memory() {
        $insert = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['productlastview']['productlastview_memory']);
        $insert['memory_new'] = $this->memory;
        $insert['date_new'] = time();
        $insert['user_new'] = $_SESSION['UsersId'];
        $insert['product_new'] = serialize($this->_PRODUCT);
        $insert['ip_new'] = $_SERVER["REMOTE_ADDR"];
        $PHPShopOrm->insert($insert);
    }

    /**
     * ����� ������ ������ � �����
     */
    function add_cookie() {
        setcookie("productlastview_memory", $this->memory, time() + 60 * 60 * 24 * 90, "/", $_SERVER['SERVER_NAME'], 0);
    }

    /**
     * �������� ����� ���������
     */
    function true_key($str) {
        return preg_match("/^[a-zA-Z0-9_]{4,35}$/", $str);
    }

    function get_memory() {
        if ($this->true_key($_COOKIE['productlastview_memory'])) {
            $this->memory = $_COOKIE['productlastview_memory'];
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['productlastview']['productlastview_memory']);
            $data = $PHPShopOrm->select(array('product'), array('memory' => "='" . $this->memory . "'"), false, array('limit' => 1));
            if (is_array($data)) {

                $this->_PRODUCT = unserialize($data['product']);
            }
        }
    }

    function display($function, $option = false) {
        global $PHPShopOrder;
        $list = null;

        // ������ ������ � ������ ������ ��� ������
        if (is_array($this->_PRODUCT)) {
            foreach ($this->_PRODUCT as $key => $val) {
                $cart[$key]['price'] = $PHPShopOrder->ReturnSumma($val['price'], 0);
                $cart[$key]['total'] = $PHPShopOrder->ReturnSumma($val['price'] * $val['num'], 0);
            }
        }

        if (is_array($this->_PRODUCT))
            foreach ($this->_PRODUCT as $k => $v)
                if (function_exists($function)) {
                    $option['xid'] = $k;
                    $list.= call_user_func_array($function, array($v, $option));
                }

        return $list;
    }

    function lastview() {

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system']))
            PHPShopObj::loadClass('string');

        $GLOBALS['PHPShopOrder'] = new PHPShopOrderFunction();

        // ������
        $this->currency = $GLOBALS['PHPShopOrder']->default_valuta_code;


        $this->set('productlastview_pic_width', $this->option['pic_width']);

        // ���� ���� ������ � �������
        if (count($this->_PRODUCT) > 0) {
            $list = $this->display('productlastviewform', array('currency' => $this->currency));
            $this->set('productlastview_list', '<table>' . $list . '</table>', true);



            $product = parseTemplateReturn($GLOBALS['SysValue']['templates']['productlastview']['productlastview_forma'], true);


            $this->set('leftMenuContent', $product);
            $this->set('leftMenuName', $this->option['title']);

            // ���������� ������
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));


            // ��������� ���������� �������
            switch ($this->option['enabled']) {

                case 1:
                    $this->set('leftMenu', $dis, true);
                    break;

                case 2:
                    $this->set('rightMenu', $dis, true);
                    break;

                default: $this->set('productlastview', $product);
            }
        }
    }

}

/**
 * ������ ������ ������� �������
 */
PHPShopObj::loadClass('parser');

function productlastviewform($val, $option) {
    global $SysValue;

    // �������� ������� ������, ������ ������ �������� ������
    if (empty($val['parent'])) {
        PHPShopParser::set('productlastview_product_id', $val['id']);

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
            PHPShopParser::set('productlastview_product_seo', '_' . PHPShopString::toLatin($val['name']));
        }
        // ���� ������ SEOURLPRO
        elseif (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {

            //������ � ���� �������
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
            $url = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($val['id'])), false, array('limit' => 1));

            if($GLOBALS['PHPShopSeoPro']) {
                if (!empty($url['prod_seo_name'])) {
                    $GLOBALS['PHPShopSeoPro']->setMemory($row['id'], $url['prod_seo_name'], 2, false);
                }
                else{
                    $GLOBALS['PHPShopSeoPro']->setMemory($val['id'], $val['name'], 2);
                }
                
            }

            PHPShopParser::set('productlastview_product_seo', null);
        }
    } else {
        PHPShopParser::set('productlastview_product_id', $val['parent']);
        PHPShopParser::set('productlastview_product_seo', null);
    }

    PHPShopParser::set('productlastview_product_xid', $val['id']);
    PHPShopParser::set('productlastview_product_name', $val['name']);
    PHPShopParser::set('productlastview_product_pic_small', $val['pic_small']);
    PHPShopParser::set('productlastview_product_price', $val['price']);
    PHPShopParser::set('productlastview_product_currency', $option['currency']);

    $dis = parseTemplateReturn($SysValue['templates']['productlastview']['productlastview_product'], true);
    return $dis;
}

// ��������� � ������ �������
if ($PHPShopNav->notPath(array('order', 'done'))) {
    $GLOBALS['ProductLastView'] = new ProductLastView();
    $GLOBALS['ProductLastView']->lastview();
}
?>