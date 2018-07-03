<?php

/**
 * ������� ����������� ��������� ����������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopCoreElement
 * @version 1.2
 * @package PHPShopElements
 */
class PHPShopCoreElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * ���������� �������� �������
     * @return string
     */
    function skin() {
        if (empty($_SESSION['skin']))
            $_SESSION['skin'] = $this->PHPShopSystem->getValue('skin');
        return $_SESSION['skin'];
    }

    /**
     * �������� ������������� �������,
     * ����� �� ������ ��������� ������ ��� �������������� ����� � ��������
     * @return string
     */
    function checkskin() {
        if (!file_exists("phpshop/templates/" . $_SESSION['skin'] . "/main/index.tpl")) {
            $dir = $this->getValue('dir.templates') . chr(47);
            if (is_dir($dir)) {
                if (@$dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file . chr(47) . 'main/index.tpl')) {
                            $_SESSION['skin'] = $file;
                            header('Location: /?status=template_error');
                        }
                    }
                    closedir($dh);
                }
            }
            exit('Template error!');
        }
    }

    /**
     * ����������� ����������� ��������� ���������� ��� ��������
     * (���, �������, ����� ��������������, ����, �������)
     */
    function setdefault() {

        // �������
        $tel = $this->PHPShopSystem->getValue('tel');
        $this->set('telNum', $tel);

        // ������� ��� �������
        if (strstr($tel, ","))
            $tel_xs = explode(" ", $tel);
        else
            $tel_xs[] = $tel;

        $this->set('telNumMobile', $tel_xs[0]);


        $this->set('name', $this->PHPShopSystem->getValue('name'));
        $this->set('company', $this->PHPShopSystem->getValue('company'));
        $this->set('streetAddress', $this->PHPShopSystem->getSerilizeParam('bank.org_adres'));
        $this->set('descrip', $this->PHPShopSystem->getValue('descrip'));
        $this->set('adminMail', $this->PHPShopSystem->getValue('adminmail2'));
        $this->set('pathTemplate', $this->getValue('dir.templates') . chr(47) . $_SESSION['skin']);
        $this->set('serverName', $_SERVER['SERVER_NAME']);
        $this->set('serverShop', $_SERVER['SERVER_NAME']);
        if (!empty($_SESSION['UserLogin']))
            $this->set('UserLogin', $_SESSION['UserLogin']);
        $this->set('ShopDir', $this->getValue('dir.dir'));
        $this->set('date', date("d-m-y H:i a"));
        $this->set('year', date("Y"));
        $this->set('user_ip', $_SERVER['REMOTE_ADDR']);
        $this->set('NavActive', $this->PHPShopNav->getPath());
        $v = $this->getValue('upload.version');
        $this->set('version', substr($v, 0, 1) . '.' . substr($v, 1, 1));
        $this->set('hcs', '<!--');
        $this->set('hce', '-->');

        // �������� ���� �������
        $theme = $this->PHPShopSystem->getSerilizeParam('admoption.' . $_SESSION['skin'] . '_theme');
        if (!empty($theme))
            $this->set($_SESSION['skin'] . '_theme', $theme);

        $theme2 = $this->PHPShopSystem->getSerilizeParam('admoption.' . $_SESSION['skin'] . '_theme2');
        if (!empty($theme2))
            $this->set($_SESSION['skin'] . '_theme2', $theme2);

        $theme3 = $this->PHPShopSystem->getSerilizeParam('admoption.' . $_SESSION['skin'] . '_theme3');
        if (!empty($theme3))
            $this->set($_SESSION['skin'] . '_theme3', $theme3);

        // �������
        $this->set('logo', $this->PHPShopSystem->getLogo());
    }

    /**
     * ����� ������� �������
     * @return string
     */
    function pageCss() {
        $this->set('pathTemplate', $this->getValue('dir.templates') . chr(47) . $_SESSION['skin']);
        return $this->getValue('dir.templates') . chr(47) . $_SESSION['skin'] . chr(47) . $this->getValue('css.default');
    }

}

/**
 * ������� ����� ����������� ������������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopUserElement
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopUserElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['shopusers'];
        parent::__construct();

        // ���� ���� �������� from, ����� ��������� ����������� �������� � ������� �� ��� ������������ ����� �����������, �����������.
        if ($_REQUEST['from'] AND !$_REQUEST['fromSave'])
            $this->set('fromSave', $_SERVER['HTTP_REFERER']);
        else
            $this->set('fromSave', $_REQUEST['fromSave']);

        // ������
        $this->setAction(array('post' => array('user_enter', 'user_register'), 'get' => 'logout'));
    }

    /**
     * ����������� ������
     * @param string $str ������
     * @return string ������������ ������
     */
    function encode($str) {
        return base64_encode(trim($str));
    }

    /**
     * ����� ������ ������������
     */
    function logout() {
        unset($_SESSION['UsersId']);
        unset($_SESSION['UsersStatus']);
        unset($_SESSION['UsersId']);
        unset($_SESSION['UsersLogin']);
        unset($_SESSION['UsersName']);
        unset($_SESSION['UsersMail']);
        unset($_SESSION['UsersStatus']);
        unset($_SESSION['UsersStatusPice']);
        $url_user = str_replace("?logout=true", "", $_SERVER['REQUEST_URI']);
        header("Location: " . $url_user);
    }

    /**
     * ������ �� ������� � ���-��� � �� ������
     */
    function wishlist() {
        if (!empty($_SESSION['UsersId']) and PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $this->set('wishlistCount', $_SESSION['wishlistCount']);
            $dis = $this->parseTemplate('users/wishlist/wishlist_top_enter.tpl');
        } else {
            $this->set('wishlistCount', count($_SESSION['wishlist']));
            $dis = $this->parseTemplate('users/wishlist/wishlist_top.tpl');
        }
        return $dis;
    }

    /**
     * �������� �����������
     * @return bool
     */
    function autorization() {
        if (PHPShopSecurity::true_login($_POST['login']) and PHPShopSecurity::true_passw($_POST['password'])) {
            $PHPShopOrm = new PHPShopOrm($this->objBase);
            $PHPShopOrm->debug = $this->debug;
            $data = $PHPShopOrm->select(array('*'), array('login' => '="' . trim($_POST['login']) . '"', 'password' => '="' . $this->encode($_POST['password']) . '"', 'enabled' => "='1'"), false, array('limit' => 1));
            if (is_array($data) AND PHPShopSecurity::true_num($data['id'])) {

                // ��������� ������� ������� ��� � ������ �� ����������.
                $wishlist = unserialize($data['wishlist']);
                if (!is_array($wishlist))
                    $wishlist = array();
                if (is_array($_SESSION['wishlist']))
                    foreach ($_SESSION['wishlist'] as $key => $value) {
                        $wishlist[$key] = 1;
                    }
                $_SESSION['wishlistCount'] = count($wishlist);
                $wishlist = serialize($wishlist);
                $PHPShopOrm->update(array('wishlist' => "$wishlist"), array('id' => '=' . $data['id']), false);
                //unset($_SESSION['wishlist']);
                // ID ������������
                $_SESSION['UsersId'] = $data['id'];

                // ����� ������������
                $_SESSION['UsersLogin'] = $data['login'];

                // ��� ������������
                $_SESSION['UsersName'] = $data['name'];

                // ������ ������������
                $_SESSION['UsersStatus'] = $data['status'];

                // E-mail ������������ ��� ������
                if (PHPShopSecurity::true_email($data['login']))
                    $_SESSION['UsersMail'] = $data['login'];
                else
                    $_SESSION['UsersMail'] = $data['mail'];

                // ���� �����
                $this->log();

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $data);


                return true;
            }
            else
                $this->set("shortAuthError", "�������� ����� ��� ������");
        }
        else
            $this->set("shortAuthError", "�������� ����� ��� ������");
    }

    /**
     * ������ ���� ����������� ������������
     */
    function log() {
        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug = $this->debug;
        $PHPShopOrm->update(array('datas_new' => time()), array('id' => '=' . $_SESSION['UsersId']));
    }

    /**
     * ����� ����� ���������� ������������ �� �������� ���������� ������
     */
    function user_register() {
        // ����������� ������ ������� �������� ��� ����������� ����������� �� �������� ���������� ������
        if (!class_exists('PHPShopUsers'))
            PHPShopObj::importCore('users');
        if (class_exists('PHPShopUsers')) {
            $PHPShopUsers = new PHPShopUsers();
            $PHPShopUsers->action_add_user();
        }
    }

    /**
     * ����� ����� ������������
     */
    function user_enter() {
        if ($this->autorization()) {

            // ���������� ������������ � cookie
            if (!empty($_POST['safe_users'])) {
                setcookie("UserLogin", trim($_POST['login']), time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
                setcookie("UserPassword", trim($_POST['password']), time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
                setcookie("UserChecked", 1, time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
            } else {
                setcookie("UserLogin", "", time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
                setcookie("UserPassword", "", time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
                setcookie("UserChecked", "", time() + 60 * 60 * 24 * 30, "/", $_SERVER['SERVER_NAME'], 0);
            }

            // ��������
            if (preg_match("/LogOut/", $_SERVER['REQUEST_URI']))
                $url_user = str_replace("?LogOut", "#userPage", $_SERVER['REQUEST_URI']);
            elseif (!empty($_GET['key']))
                $url_user = $this->getValue('dir.dir') . '/users/';
            else
                $url_user = $_SERVER['REQUEST_URI'];

            // header("Location: " . $url_user);
            $this->checkRedirect();
        }
        else
            $this->set('usersError', $this->lang('error_login'));
    }

    /**
     * ���� ����� �����������, ����������� ���������� ��������� �� �������� � ������� ������, ��������������
     */
    function checkRedirect() {
        // ���� ����� �����������, ����������� ���������� ��������� �� �������� � ������� ������, ��������������
        if ($_REQUEST['from'] AND $_REQUEST['fromSave'])
            header("Location: " . $_REQUEST['fromSave']);
    }

    /**
     * ����� ����������� ������������
     */
    function usersDisp() {
        if (!empty($_SESSION['UsersId']) and PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $this->set('UsersLogin', $_SESSION['UsersLogin']);
            $this->set('UsersName', $_SESSION['UsersName']);
            $dis = $this->parseTemplate($this->getValue('templates.users_forma_enter'));
        } else {

            // ���� �����������, ������ �� cookie
            if (PHPShopSecurity::true_num($_COOKIE['UserChecked']))
                $this->set('UserChecked', 'checked');

            if (PHPShopSecurity::true_email($_COOKIE['UserLogin']))
                $this->set('UserLogin', $_COOKIE['UserLogin']);

            if (PHPShopSecurity::true_passw($_COOKIE['UserPassword']))
                $this->set('UserPassword', $_COOKIE['UserPassword']);

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__);

            $dis = $this->parseTemplate($this->getValue('templates.users_forma'));
        }
        return $dis;
    }

}

/**
 * ������� �������� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopPageCatalogElement
 * @version 1.2
 * @package PHPShopElements
 */
class PHPShopPageCatalogElement extends PHPShopElements {

    /**
     * @var bool ��������� �� ��������� ��������
     */
    var $chek_page = true;
    var $debug = false;

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['page_categories'];
        parent::__construct();
    }

    /**
     * ����� ��������� ���������
     * @return string
     */
    function pageCatal() {
        $dis = null;
        $i = 0;

        $this->PHPShopOrm->cache = true;
        $data = $this->PHPShopOrm->select(array('*'), array('parent_to' => '=0'), array('order' => 'num'), array("limit" => 100));

        // �������� ������ � ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $data, 'START');
        if ($hook)
            return $hook;

        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $this->set('catalogId', $row['id']);
                $this->set('catalogI', $i);
                $this->set('catalogTemplates', $this->getValue('dir.templates') . chr(47) . $this->PHPShopSystem->getValue('skin') . chr(47));

                // ���� ���� ��������
                if ($this->chek($row['id'])) {

                    $this->set('catalogName', $row['name']);
                    $this->set('catalogId', $row['id']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_page_forma_2'));
                } else {
                    $this->set('catalogPodcatalog', $this->subcatalog($row['id']));
                    $this->set('catalogName', $row['name']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    $dis.=$this->parseTemplate($this->getValue('templates.catalog_page_forma'));
                }

                $i++;
            }
        return $dis;
    }

    /**
     * �������� ������������
     * @param Int $id �� ��������
     * @return bool
     */
    function chek($id) {
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
        $PHPShopOrm->debug = $this->debug;
        $num = $PHPShopOrm->select(array('id'), array('parent_to' => "=$id"), false, array('limit' => 1));
        if (empty($num['id']))
            return true;
    }

    /**
     * ����� ������������
     * @param Int $n �� ��������
     * @return string
     */
    function subcatalog($n) {
        $dis = null;
        $i = 0;
        $n = PHPShopSecurity::TotalClean($n, 1);
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
        $data = $PHPShopOrm->select(array('*'), array('parent_to' => '=' . $n), array('order' => 'num'), array("limit" => 100));

        // �������� ������ � ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $data, 'START');
        if ($hook)
            return $hook;

        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $this->set('catalogId', $n);
                $this->set('catalogUid', $row['id']);
                $this->set('catalogI', $i);
                $this->set('catalogLink', 'CID_' . $row['id']);
                $this->set('catalogTemplates', $this->getValue('dir.templates') . chr(47) . $this->PHPShopSystem->getValue('skin') . chr(47));
                $this->set('catalogName', $row['name']);
                $i++;

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $dis.=$this->parseTemplate($this->getValue('templates.podcatalog_page_forma'));
            }
        return $dis;
    }

}

/**
 * ������� ��������� �����
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopTextElement
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopTextElement extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function PHPShopTextElement() {
        $this->objBase = $GLOBALS['SysValue']['base']['table_name14'];
        parent::__construct();
    }

    /**
     * ����� ���������� ����� � ����� �����
     * @return string
     */
    function leftMenu() {
        $dis = null;
        $data = $this->PHPShopOrm->select(array('*'), array("flag" => "='1'", 'element' => "='0'"), array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    // ���������� ����������
                    $this->set('leftMenuName', $row['name']);
                    $this->set('leftMenuContent', Parser($row['content']));

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row);

                    // ���������� ������
                    $dis.=$this->parseTemplate($this->getValue('templates.left_menu'));
                } else {
                    $dirs = explode(",", $row['dir']);
                    foreach ($dirs as $dir)
                        if (@strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
                            $this->set('leftMenuName', $row['name']);
                            $this->set('leftMenuContent', Parser($row['content']));

                            // �������� ������
                            $this->setHook(__CLASS__, __FUNCTION__, $row);

                            // ���������� ������
                            $dis.=$this->parseTemplate($this->getValue('templates.left_menu'));
                        }
                }
            }
        return $dis;
    }

    /**
     * ����� ���������� ����� � ������ �����
     * @return string
     */
    function rightMenu() {
        $dis = null;
        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $data = $PHPShopOrm->select(array('*'), array("flag" => "='1'", 'element' => "='1'"), array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    // ���������� ����������
                    $this->set('leftMenuName', $row['name']);
                    $this->set('leftMenuContent', Parser($row['content']));

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row);

                    $dis.=$this->parseTemplate($this->getValue('templates.right_menu'));
                } else {
                    $dirs = explode(",", $row['dir']);
                    foreach ($dirs as $dir)
                        if (@strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
                            $this->set('leftMenuName', $row['name']);
                            $this->set('leftMenuContent', Parser($row['content']));

                            // �������� ������
                            $this->setHook(__CLASS__, __FUNCTION__, $row);

                            // ���������� ������
                            $dis.=$this->parseTemplate($this->getValue('templates.right_menu'));
                        }
                }
            }
        return $dis;
    }

    /**
     * ����� �������� �������������� ����
     * @return string
     */
    function topMenu() {
        $dis = null;
        $objBase = $GLOBALS['SysValue']['base']['table_name11'];
        $PHPShopOrm = new PHPShopOrm($objBase);
        $data = $PHPShopOrm->select(array('name', 'link'), array("category" => "=1000", 'enabled' => "='1'"), array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $this->set('topMenuName', $row['name']);
                $this->set('topMenuLink', $row['link']);

                // �������� ��������
                if ($row['link'] == $this->PHPShopNav->getName(true))
                    $this->set('topMenuActive', 'active');
                else
                    $this->set('topMenuActive', '');

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row);

                // ���������� ������
                $dis.=$this->parseTemplate($this->getValue('templates.top_menu'));
            }
        return $dis;
    }

}

/**
 * ������� c���� ��������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopSkinElement
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopSkinElement extends PHPShopElements {

    function __construct() {
        parent::__construct();

        // ������
        $this->setAction(array('post' => 'skin', 'get' => 'skin'));
    }

    /**
     * ����� �� ���������, ����� ����� ������ �������
     * @return string
     */
    function index() {
        if ($this->PHPShopSystem->getSerilizeParam("admoption.user_skin") == 1) {
            $dir = $this->getValue('dir.templates') . chr(47);
            if (is_dir($dir)) {
                if (@$dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if (@file_exists($dir . '/' . $file . "/main/index.tpl")) {
                            if ($_SESSION['skin'] == $file)
                                $sel = "selected";
                            else
                                $sel = "";

                            if ($file != "." and $file != ".." and $file != "index.html") {


                                $value[] = array($file, $file, $sel);
                            }
                        }
                    }
                    closedir($dh);
                }
            }


            // ���������� ����������
            $forma = PHPShopText::div(PHPShopText::form(PHPShopText::select('skin', $value, 150, $float = "none", $caption = false, $onchange = "ChangeSkin()"), 'SkinForm', 'get'), 'left', 'padding:10px');
            $this->set('leftMenuContent', $forma);
            $this->set('leftMenuName', __("������� ������"));

            // ���������� ������
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
        }
        return $dis;
    }

    /**
     * ����� ����� �������
     */
    function skin() {
        if ($this->PHPShopSystem->getValue('num_vitrina')) {
            if (file_exists("phpshop/templates/" . $_REQUEST['skin'] . "/main/index.tpl")) {
                $skin = $_REQUEST['skin'];
                if (PHPShopSecurity::true_skin($skin)) {
                    unset($_SESSION['Memory']);
                    unset($_SESSION['gridChange']);
                    $_SESSION['skin'] = $skin;
                    // ������������ � ������ skinpage
                    $_SESSION['skinSave'] = $skin;
                }
            }
        }
    }

}

/**
 * ������� ��������� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopNewsElement
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopNewsElement extends PHPShopElements {

    /**
     * @var bool ���������� ������� ������ �� �������
     */
    var $disp_only_index = true;

    /**
     * @var int  ���-�� ��������
     */
    var $limit = 5;

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name8'];
        parent::__construct();
    }

    /**
     * ����� ��������� ��������
     * @return string
     */
    function index() {
        $dis = null;

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, false, 'START');

        // ���������� ������ �� ������� ��������
        if ($this->disp_only_index) {
            if ($this->PHPShopNav->index())
                $view = true;
            else
                $view = false;
        }
        else
            $view = true;

        if (!empty($view)) {

            $result = $this->PHPShopOrm->select(array('id', 'zag', 'datas', 'kratko'), false, array('order' => 'id DESC'), array("limit" => $this->limit));

            // �������� �� �������� ������
            if ($this->limit > 1)
                $data = $result;
            else
                $data[] = $result;

            if (is_array($data))
                foreach ($data as $row) {

                    // ���������� ����������
                    $this->set('newsId', $row['id']);
                    $this->set('newsZag', $row['zag']);
                    $this->set('newsData', $row['datas']);
                    $this->set('newsKratko', $row['kratko']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    // ���������� ������
                    $dis.=$this->parseTemplate($this->getValue('templates.news_main_mini'));
                }
            return $dis;
        }
    }

}

/**
 * ������� ������ ����������� � �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopSliderElement
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopSliderElement extends PHPShopElements {

    /**
     * @var bool ���������� ������� ������ �� �������
     */
    var $disp_only_index = true;

    /**
     * @var int  ���-�� �����������
     */
    var $limit = 7;

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['slider'];
        parent::__construct();
    }

    /**
     * ����� ����������� � �������
     * @return string
     */
    function index() {
        $dis = null;

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, false, 'START');

        // ���������� ������ �� ������� ��������
        if ($this->disp_only_index) {
            if ($this->PHPShopNav->index())
                $view = true;
            else
                $view = false;
        }
        else
            $view = true;
        if (!empty($view)) {
            $result = $this->PHPShopOrm->select(array('image', 'alt', 'link'), array('enabled' => '="1"'), array('order' => 'num, id DESC'), array("limit" => $this->limit));

            // �������� �� �������� ������
            if ($this->limit > 1)
                $data = $result;
            else
                $data[] = $result;

            if (is_array($data))
                foreach ($data as $row) {

                    // ���������� ����������
                    $this->set('image', $row['image']);
                    $this->set('alt', $row['alt']);
                    $this->set('link', $row['link']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    // ���������� ������
                    $dis.=$this->parseTemplate("/slider/slider_oneImg.tpl");
                }
            if (@$dis) {
                $this->set('imageSliderContent', $dis);
                return$this->parseTemplate("/slider/slider_main.tpl");
            }
            return false;
        }
    }

}

/**
 * ������� ����� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopOprosElement
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopOprosElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        parent::__construct();
    }

    /**
     * ����� ����� �����������
     * @return string
     */
    function oprosDisp() {

        // ������� ������
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.opros_categories'));
        $PHPShopOrm->debug = $this->debug;
        $dataArray = $PHPShopOrm->select(array('*'), array('flag' => "='1'"), array('order' => 'id DESC'), array('limit' => 10));
        $content = null;
        if (is_array($dataArray))
            foreach ($dataArray as $row) {

                if (empty($row['dir'])) {
                    // ���������� ����������
                    $this->set('oprosName', $row['name']);
                    $this->set('oprosContent', $this->getOprosValue($row['id'], "FORMA"));

                    // ���������� ������
                    $content.= $this->parseTemplate($this->getValue('templates.opros_list'));
                } else {

                    // ���� ����� ������� �������
                    if (strpos($row['dir'], ","))
                        $dirs = explode(",", $row['dir']);
                    else
                        $dirs[] = $row['dir'];

                    foreach ($dirs as $dir)
                        if (!empty($dir))
                            if (strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {

                                // ���������� ����������
                                $this->set('oprosName', $row['name']);
                                $this->set('oprosContent', $this->getOprosValue($row['id'], "FORMA"));

                                // �������� ������
                                $this->setHook(__CLASS__, __FUNCTION__, $row);

                                // ���������� ������
                                $content.= $this->parseTemplate($this->getValue('templates.opros_list'));
                            }
                }
            }

        return $content;
    }

    /**
     * ����� �������
     * @param int $n �� ������
     * @param string $flag [FORMA|RESULT] ����� ����� ������ (����� ������ ��� ��������� �������)
     * @return string
     */
    function getOprosValue($n, $flag) {
        $dis = null;
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.opros'));
        $PHPShopOrm->comment = 'getOprosValue';
        $PHPShopOrm->debug = $this->debug;
        $this->dataArray = $PHPShopOrm->select(array('*'), array('category' => '=' . $n), array('order' => 'num'), array('limit' => 100));
        if (is_array($this->dataArray))
            foreach ($this->dataArray as $row) {

                if ($row['total'] > 0)
                    $total = $row['total'];
                else
                    $total = "--";

                // ���������� ���������
                $this->set('valueName', $row['name']);
                $this->set('valueId', $row['id']);


                // ���������� ������
                if ($flag == "FORMA")
                    $dis.=$this->parseTemplate($this->getValue('templates.opros_forma'));
                elseif ($flag == "RESULT") {
                    $sum = $this->getSumValue($row['category']);
                    $pr = @number_format(($total * 100) / $sum, "1", ".", "");

                    // ���������� ���������
                    $this->set('valueSum', $total);
                    $this->set('valueProc', $pr);
                    $this->set('valueWidth', $pr * 3 + 1);

                    $dis.=$this->parseTemplate($this->getValue('templates.opros_page_forma'));
                }
            }
        return $dis;
    }

    /**
     * ����� ��������
     * @param int $n �� ������
     * @return int
     */
    function getSumValue($n) {
        $objBase = $this->getValue('base.opros');
        $PHPShopOrm = new PHPShopOrm($objBase);
        $result = $PHPShopOrm->query("select SUM(total) as sum from " . $objBase . " where category=" . $n);
        $row = mysqli_fetch_array($result);
        return $row['sum'];
    }

}

/**
 * ������� ������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopBannerElement
 * @version 1.4
 * @package PHPShopElements
 */
class PHPShopBannerElement extends PHPShopElements {

    function __construct() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name15'];
        parent::__construct();
    }

    /**
     * ����� �������
     * @return string
     */
    function index() {

        $data = $this->PHPShopOrm->select(array('*'), array("flag" => "='1'"), array('order' => 'RAND()'), array("limit" => 30));

        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    // ���������� ����������
                    $this->set('banerContent', $row['content']);
                    $this->set('banerTitle', $row['name']);

                    // ��������� �������������� � ����� �������
                    //if ($row['count_all'] > $row['limit_all'])
                    // $this->mail();
                    // ��������� ������ ������
                    //$this->update();
                    // ���������� ������
                    return $this->parseTemplate($this->getValue('templates.baner_list_forma'));
                } else {
                    $dirs = explode(",", $row['dir']);
                    foreach ($dirs as $dir)
                        if (!empty($dir))
                            if (strpos($_SERVER['REQUEST_URI'], trim($dir)) or $_SERVER['REQUEST_URI'] == trim($dir)) {

                                // ���������� ����������
                                $this->set('banerContent', $row['content']);
                                $this->set('banerTitle', $row['name']);

                                // ��������� �������������� � ����� �������
                                //if ($this->row['count_all'] > $row['limit_all'])
                                // $this->mail();
                                // ��������� ������ ������
                                //$this->update();
                                // ���������� ������
                                return $this->parseTemplate($this->getValue('templates.baner_list_forma'));
                            }
                }
            }
    }

    /**
     * ������ ������� �������
     */
    function update() {
        if ($this->row['datas'] != date("d.m.y"))
            $count_today = 0;
        else
            $count_today = $this->row['count_today'] + 1;

        $count_all = $this->row['count_all'] + 1;
        $this->PHPShopOrm->update(array('count_all' => $count_all, 'count_today' => $count_today, 'datas' => date("d.m.y")), array('id' => "=" . $this->row['id']), $prefix = '');
    }

    /**
     * ��������� �� ��������� ������� �������
     */
    function mail() {
        $this->PHPShopOrm->update(array('flag' => '0'), array('id' => "=" . $this->row['id']), $prefix = '');

        // ���������� ���������� �������� �����
        PHPShopObj::loadClass("mail");
        $zag = __("����������� ������ � �������") . " " . $this->row['name'];

        $this->set('banner_name', $this->row['name']);
        $this->set('banner_limit', $this->row['limit_all']);

        // ����� ���������
        $message = ParseTemplateReturn('./phpshop/lib/templates/banner/mail_notice.tpl', true);

        new PHPShopMail($this->PHPShopSystem->getParam('adminmail2'), "robot@" . str_replace("www", '', $_SERVER['SERVER_NAME']), $zag, $message);
    }

}

/**
 * ������� ���� �������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopElements
 */
class PHPShopPhotoElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {

        // �������
        $this->debug = false;

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['photo_categories'];
        parent::__construct();
    }

    /**
     * ����� ���� �� ����������
     * @return string
     */
    function getPhotos() {
        $dis = null;
        $url = addslashes(substr($this->SysValue['nav']['url'], 1));
        if (empty($url))
            $url = '/';

        $PHPShopOrm = new PHPShopOrm($this->getValue('base.photo_categories'));
        $PHPShopOrm->debug = $this->debug;
        $data = $PHPShopOrm->select(array('*'), array('enabled' => "='1'", "page" => " LIKE '%$url%'"), array('order' => 'num'), array("limit" => 100));

        if (is_array($data))
            foreach ($data as $row) {
                $this->set('photoTitle', $row['name']);
                $this->set('photoLink', $row['id']);
                $this->set('photoContent', $this->ListPhoto($row['id'], $row['num']));
                $dis.=$this->parseTemplate('./phpshop/lib/templates/photo/photo_list_forma.tpl', true);
            }
        return $dis;
    }

    /**
     * ����� ����
     * @param int $cat �� ��������� ����
     * @param int $num ���-�� ���� ��� ������
     * @return string
     */
    function ListPhoto($cat, $num) {
        $dis = null;

        // ������� ������
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.photo'));
        $PHPShopOrm->debug = $this->debug;
        $data = $PHPShopOrm->select(array('*'), array('category' => '=' . intval($cat), 'enabled' => "='1'"), array('order' => 'num'), array('limit' => $num));
        if ($num == 1)
            $this->dataArray[] = $data;
        else
            $this->dataArray = $data;

        if (is_array($this->dataArray))
            foreach ($this->dataArray as $row) {

                $name_s = str_replace(".", "s.", $row['name']);
                $this->set('photoIcon', $name_s);
                $this->set('photoInfo', $row['info']);
                $this->set('photoImg', $row['name']);

                $dis.=$this->parseTemplate('./phpshop/lib/templates/photo/photo_element_forma.tpl', true);
            }
        return $dis;
    }

}

?>