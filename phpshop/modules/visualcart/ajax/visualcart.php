<?php
session_start();
$_classPath = "../../../";

include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

PHPShopObj::loadClass("array");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("cart");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("user");
PHPShopObj::loadClass('order');
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("parser");
PHPShopObj::loadClass("text");
PHPShopObj::loadClass("lang");

// ���������� ���������� ���������.
if ($_REQUEST['type'] != 'json') {
    require_once $_classPath . "/lib/Subsys/JsHttpRequest/Php.php";
    $JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");
}

// ������ �����
$PHPShopValutaArray = new PHPShopValutaArray();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

$PHPShopModules = new PHPShopModules('../../');

class AddToTemplateVisualCartAjax {

    var $debug = false;

    /**
     * �����������
     */
    function __construct() {

        $this->option();

        // ���� ������
        if ($this->option['memory'] == 1)
            $this->init();

        $this->PHPShopCart = new PHPShopCart();
    }

    /**
     * ������������� ����� ������
     */
    function init() {
        if (empty($_COOKIE['visualcart_memory']))
            $this->memory = md5(session_id());
        else
            $this->memory = $_COOKIE['visualcart_memory'];

        if (empty($_SESSION['cart_sig'])) {
            $this->get_memory();
        }
    }

    /**
     * ���������
     */
    function option() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['visualcart']['visualcart_system']);
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
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['visualcart']['visualcart_memory']);
        $PHPShopOrm->delete(array('memory' => "='" . $this->memory . "'"));
    }

    /**
     * ������ ������� � ��
     */
    function add_memory() {
        $insert = array();
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['visualcart']['visualcart_memory']);
        $insert['memory_new'] = $this->memory;
        $insert['date_new'] = time();
        $insert['user_new'] = $_SESSION['UsersId'];
        $insert['cart_new'] = serialize($_SESSION['cart']);
        $insert['ip_new'] = $_SERVER["REMOTE_ADDR"];

        if (isset($_COOKIE['ps_referal']))
            $insert['referal_new'] = base64_decode($_COOKIE['ps_referal']);

        $PHPShopOrm->insert($insert);
    }

    /**
     * ����� ������ ������ � �����
     */
    function add_cookie() {
        setcookie("visualcart_memory", $this->memory, time() + 60 * 60 * 24 * 90, "/", $_SERVER['SERVER_NAME'], 0);
    }

    /**
     * �������� ����� ���������
     */
    function true_key($str) {
        return preg_match("/^[a-zA-Z0-9_]{4,35}$/", $str);
    }

    function get_memory() {
        if ($this->true_key($_COOKIE['visualcart_memory'])) {
            $this->memory = $_COOKIE['visualcart_memory'];
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['visualcart']['visualcart_memory']);
            $data = $PHPShopOrm->select(array('cart'), array('memory' => "='" . $this->memory . "'"), false, array('limit' => 1));
            if (is_array($data)) {
                $_SESSION['cart'] = unserialize($data['cart']);
            }
        }
    }

    /**
     * ����� �������
     * @return string
     */
    function visualcart() {

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system']))
            PHPShopObj::loadClass('string');

        $GLOBALS['PHPShopOrder'] = new PHPShopOrderFunction();

        // ������
        $this->currency = $GLOBALS['PHPShopOrder']->default_valuta_code;

        PHPShopParser::set('visualcart_pic_width', $this->option['pic_width']);

        // ���� ���� ������ � �������
        if ($this->PHPShopCart->getNum() > 0) {
            $list = $this->PHPShopCart->display('visualcartform', array('currency' => $this->currency));

            // ����������� �������
            if ($_SESSION['cart_sig'] != md5($list)) {
                $_SESSION['cart_sig'] = md5($list);

                // ������
                $this->clean_memory();

                // ������ � ��
                $this->add_memory();

                // ���� ������ � ����
                $this->add_cookie();
            }

            return $list;
        }
    }

}

/**
 * ������ ������ ������� �������
 */
function visualcartform($val, $option) {
    global $_classPath;

    // �������� ������� ������, ������ ������ �������� ������
    if (empty($val['parent'])) {
        PHPShopParser::set('visualcart_product_id', $val['id']);

        // ���� ������ SEOURL
        if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
            PHPShopParser::set('visualcart_product_seo', '_' . PHPShopString::toLatin($val['name']));
        }
    } else {
        PHPShopParser::set('visualcart_product_id', $val['parent']);
        PHPShopParser::set('visualcart_product_seo', null);
    }

    PHPShopParser::set('visualcart_product_xid', $val['id']);
    PHPShopParser::set('visualcart_product_name', $val['name']);
    PHPShopParser::set('visualcart_product_pic_small', $val['pic_small']);
    PHPShopParser::set('visualcart_product_price', $val['price'] * $val['num']);
    PHPShopParser::set('visualcart_product_currency', $option['currency']);
    PHPShopParser::set('visualcart_product_num', $val['num']);

    // �������� ������������� ������� ������
    $path='../templates/product.tpl';
   $path_template =$_classPath. 'templates/'. $_SESSION['skin'].'/modules/visualcart/templates/product.tpl';
    if (is_file($path_template))
        $path = $path_template;

    $dis = PHPShopParser::file($path, true, true, true);
    return $dis;
}

$AddToTemplateVisualCartAjax = new AddToTemplateVisualCartAjax();

// ��������
if (!empty($_REQUEST['xid'])) {
    $AddToTemplateVisualCartAjax->del($_REQUEST['xid']);
}

// �������
$visualcart = $AddToTemplateVisualCartAjax->visualcart();


// ��������� ���������
if (!empty($_SESSION['cart']))
    $_RESULT = array(
        "visualcart" => $visualcart,
        "sum" => $AddToTemplateVisualCartAjax->PHPShopCart->getSum(true,' '),
        "num" => $AddToTemplateVisualCartAjax->PHPShopCart->getNum()
    );
elseif (!empty($_REQUEST['xid']) and empty($_SESSION['cart'])) {

    $_RESULT = array(
        "visualcart" => "<tr><td>" . $GLOBALS['SysValue']['lang']['visualcart_empty'] . "</td></tr>",
        "sum" => $AddToTemplateVisualCartAjax->PHPShopCart->getSum(true,' '),
        "num" => $AddToTemplateVisualCartAjax->PHPShopCart->getNum()
    );
}

// ��������� ���� ���������� �������
setcookie("cart_update_time", '', 0, "/", $_SERVER['SERVER_NAME'], 0);

if ($_REQUEST['type'] == 'json') {
    $_RESULT['success'] = 1;
    $_RESULT['visualcart'] = PHPShopString::win_utf8($_RESULT['visualcart']);
    
    if(!isset($_REQUEST['load']))
      echo json_encode($_RESULT);
}
?>