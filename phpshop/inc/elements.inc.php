<?php

/**
 * ������� ����������� ��������� ����������
 * @author PHPShop Software
 * @version 1.4
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

        if (empty($_SESSION['skin'])) {

            // ����������
            if (defined("HostSkin"))
                $_SESSION['skin'] = HostSkin;
            else
                $_SESSION['skin'] = $this->PHPShopSystem->getValue('skin');
        }

        return $_SESSION['skin'];
    }

    /**
     * �������� ������������� �������,
     * ����� �� ������ ��������� ������ ��� �������������� ����� � ��������
     * @return string
     */
    function checkskin() {
        if (!@file_exists("phpshop/templates/" . $_SESSION['skin'] . "/main/index.tpl")) {
            $dir = $this->getValue('dir.templates') . chr(47);
            if (is_dir($dir)) {
                if (@$dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if (@is_file($dir . $file . chr(47) . 'main/index.tpl')) {
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
     * ����������� ��������� ���������� ��� ��������
     * (���, �������, ����� ��������������, ����, �������)
     */
    function setdefault() {
        global $PHPShopBase;

        // ����������
        if (defined("HostID")) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['servers']);
            $PHPShopOrm->debug = false;
            $showcaseData = $PHPShopOrm->select(array('*'), array('enabled' => "='1'", 'host' => "='" . str_replace('www.', '', $_SERVER['HTTP_HOST']) . "'"), array('order' => 'id'), array('limit' => 1));
            if (is_array($showcaseData)) {

                if (!empty($showcaseData['currency']) and $this->PHPShopNav->notPath('order')) {

                    if (empty($_SESSION['valuta']))
                        $_SESSION['valuta'] = $showcaseData['currency'];

                    $lang = $showcaseData['lang'];
                }

                if (!empty($showcaseData['tel']))
                    $this->PHPShopSystem->setParam("tel", $showcaseData['tel']);

                if (!empty($showcaseData['adminmail']))
                    $this->PHPShopSystem->setParam("adminmail2", $showcaseData['adminmail']);

                if (!empty($showcaseData['company']))
                    $this->PHPShopSystem->setParam('company', $showcaseData['company']);

                if (!empty($showcaseData['name']))
                    $this->PHPShopSystem->setParam('name', $showcaseData['name']);

                if (!empty($showcaseData['title']))
                    $this->PHPShopSystem->setParam('title', $showcaseData['title']);

                if (!empty($showcaseData['descrip']))
                    $this->PHPShopSystem->setParam('descrip', $showcaseData['descrip']);

                if (!empty($showcaseData['logo']))
                    $this->PHPShopSystem->setParam('logo', $showcaseData['logo']);

                if (!empty($showcaseData['adres']))
                    $this->set('streetAddress', $showcaseData['adres']);

                if (!empty($showcaseData['skin']))
                    define("HostSkin", $showcaseData['skin']);

                if (!empty($showcaseData['price']))
                    define("HostPrice", $showcaseData['price']);

                define("HostAdmin", $showcaseData['admin']);

                $admoption = unserialize($showcaseData['admoption']);
                if (is_array($admoption)) {

                    if (isset($admoption['user_price_activate']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.user_price_activate', $admoption['user_price_activate']);

                    if (isset($admoption['user_mail_activate']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.user_mail_activate', $admoption['user_mail_activate']);

                    if (isset($admoption['user_mail_activate_pre']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.user_mail_activate_pre', $admoption['user_mail_activate_pre']);

                    if (isset($admoption['smtp_user']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.mail_smtp_user', $admoption['smtp_user']);

                    if (isset($admoption['smtp_password']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.mail_smtp_pass', $admoption['smtp_password']);

                    if(isset($admoption['user_status']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.user_status', $admoption['user_status']);
                    
                    if(isset($admoption['metrica_id']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.metrica_id', $admoption['metrica_id']);
                    
                    if(isset($admoption['google_id']))
                        $this->PHPShopSystem->setSerilizeParam('admoption.google_id', $admoption['google_id']);
                }
            }
        } else {
            $this->set('streetAddress', $this->PHPShopSystem->getSerilizeParam('bank.org_adres'));
            $lang = $this->PHPShopSystem->getSerilizeParam("admoption.lang");
        }

        $_SESSION['lang'] = $lang;
            
        // ����
        $GLOBALS['PHPShopLang'] = new PHPShopLang(array('locale' => $lang, 'path' => 'shop'));
        $this->set('charset', $GLOBALS['PHPShopLang']->charset);
        $this->set('lang', $GLOBALS['PHPShopLang']->code);
  
        // �������
        $tel = $this->PHPShopSystem->getValue('tel');
        $this->set('telNum', $tel);
        $this->set('telNum2', $this->PHPShopSystem->getSerilizeParam("bank.org_tel"));
        $this->set('workingTime', $this->PHPShopSystem->getSerilizeParam("bank.org_time"));

        // ������� ��� �������
        if (strstr($tel, ","))
            $tel_xs = explode(",", $tel);
        else
            $tel_xs[] = $tel;

        $this->set('telNumMobile', $tel_xs[0]);
        $this->set('rule', $this->lang('rule'));
        $this->set('name', $this->PHPShopSystem->getValue('name'));

        // Favicon
        $icon = $this->PHPShopSystem->getValue('icon');
        if (empty($icon))
            $icon = '/apple-touch-icon.png';
        $this->set('icon', $icon);

        $this->set('company', $this->PHPShopSystem->getValue('company'));
        $this->set('descrip', $this->PHPShopSystem->getValue('descrip'));
        $this->set('adminMail', $this->PHPShopSystem->getValue('adminmail2'));
        $this->set('pathTemplate', $this->getValue('dir.templates') . chr(47) . $_SESSION['skin']);
        $this->set('serverName', PHPShopString::check_idna($_SERVER['SERVER_NAME']));
        $this->set('serverShop', PHPShopString::check_idna($_SERVER['SERVER_NAME']));
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

        // ��������� �������
        if (!is_array($_SESSION['editor'][$_SESSION['skin']])) {
            $editor = $this->PHPShopSystem->getSerilizeParam('admoption.' . $_SESSION['skin'] . '_editor');
            if (is_array($editor))
                $_SESSION['editor'][$_SESSION['skin']] = $editor;
        }

        // �������
        $this->set('logo', $this->PHPShopSystem->getLogo());

        // DaData.ru
        if ($this->PHPShopSystem->getSerilizeParam('admoption.dadata_enabled')) {
            $dadataToken = $this->PHPShopSystem->getSerilizeParam('admoption.dadata_token');
            if (empty($dadataToken))
                $dadataToken = 'b13e0b4fd092a269e229887e265c62aba36a92e5';
            $this->set('dadataToken', $dadataToken);
        } else
            $this->set('dadataToken', null);

        // Demo �����
        if (isset($_GET['demo']))
            $PHPShopBase->setParam('template_theme.demo', 'false');
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
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopUserElement extends PHPShopElements {

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        $this->template_debug = true;
        $this->objBase = $GLOBALS['SysValue']['base']['shopusers'];
        parent::__construct();

        // ���� ���� �������� from, ����� ��������� ����������� �������� � ������� �� ��� ������������ ����� �����������, �����������.
        if ($_REQUEST['from'] AND ! $_REQUEST['fromSave'])
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
        unset($_SESSION['UsersLogin']);
        unset($_SESSION['UsersName']);
        unset($_SESSION['UsersMail']);
        unset($_SESSION['UsersStatus']);
        unset($_SESSION['UsersStatusPice']);
        $url_user = str_replace("?logout=true", "", $_SERVER['REQUEST_URI']);
        header("Location: " . $url_user);
    }

    /**
     * ������ �� ������� � ���-��� � ��� ������
     */
    function wishlist() {
        if (!empty($_SESSION['UsersId']) and PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $this->set('wishlistCount', $_SESSION['wishlistCount']);
            $dis = $this->parseTemplate('users/wishlist/wishlist_top_enter.tpl');
        } else {
            //$this->set('wishlistCount', 0);
            $this->set('wishlistCount', @count($_SESSION['wishlist']));
            $dis = $this->parseTemplate('users/wishlist/wishlist_top_enter.tpl');
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

            $where = array('login' => '="' . trim($_POST['login']) . '"', 'password' => '="' . $this->encode($_POST['password']) . '"', 'enabled' => "='1'");

            // ����������
            if ($this->PHPShopSystem->ifSerilizeParam("admoption.user_servers_control"))
                $where['servers'] = '=' . intval(HostID);

            $data = $PHPShopOrm->select(array('*'), $where, false, array('limit' => 1));
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

                // ������� ������� �� ������, �� �������� � ��
                unset($_SESSION['wishlist']);

                $wishlist = serialize($wishlist);
                $PHPShopOrm->update(array('wishlist' => $wishlist), array('id' => '=' . $data['id']), false);

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
            } else
                $this->set("shortAuthError", __("�������� ����� ��� ������"));
        } else
            $this->set("shortAuthError", __("�������� ����� ��� ������"));
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
        } else
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
 * @version 1.3
 * @package PHPShopElements
 */
class PHPShopPageCatalogElement extends PHPShopElements {

    /**
     * @var bool ��������� �� ��������� ��������
     */
    var $chek_page = true;
    var $debug = false;

    /**
     * @var int ���������� ��� ������ ��������� ������� 
     */
    var $limit_last = 2;

    /**
     * �����������
     */
    function __construct() {
        $this->template_debug = true;
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

        $where = array('parent_to' => '=0');

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['parent_to'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $this->PHPShopOrm->cache = true;
        $data = $this->PHPShopOrm->select(array('*'), $where, array('order' => 'num,id desc'), array("limit" => 100));

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
                    $this->set('catalogPodcatalog', null);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                    $dis .= $this->parseTemplate($this->getValue('templates.catalog_page_forma_2'));
                } else {
                    $this->set('catalogPodcatalog', $this->subcatalog($row['id']));
                    $this->set('catalogName', $row['name']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    $dis .= $this->parseTemplate($this->getValue('templates.catalog_page_forma'));
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

        $where = array('parent_to' => "=$id");

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['parent_to'] .= ' and (servers ="" or servers REGEXP "i1000i")';


        $num = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 1));
        if (empty($num['id']))
            return true;
    }

    /**
     * �������� ������������
     * @param Int $id �� ��������
     * @return bool
     */
    function chekPages($id) {
        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page'));
        $PHPShopOrm->debug = $this->debug;

        $where = array('category' => "=$id");

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['category'] .= ' and (servers ="" or servers REGEXP "i1000i")';


        $num = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 1));
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

        $where = array('parent_to' => '=' . $n);

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['parent_to'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $PHPShopOrm = new PHPShopOrm($this->getValue('base.page_categories'));
        $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'num,id desc'), array("limit" => 100));

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
                $dis .= $this->parseTemplate($this->getValue('templates.podcatalog_page_forma'));
            }
        return $dis;
    }

    /**
     * ����� ���� ��������� ������� � �������� �������������� ����
     * @return string
     */
    function topMenu() {
        $dis = $dis_page = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        $where['menu'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['menu'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug = false;
        $data = $PHPShopOrm->select(array('id', 'name'), $where, array('order' => 'num,name'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {

                $dis_page = null;

                // ���������� ����������
                $this->set('topMenuName', $row['name']);
                $this->set('topMenuLink', $row['id']);

                // ���� ���� ��������
                if (!$this->chekPages($row['id'])) {
                    $PHPShopOrm = new PHPShopOrm($this->getValue('base.page'));
                    $PHPShopOrm->debug = $this->debug;
                    $dataPage = $PHPShopOrm->select(array('link', 'name'), array('category' => '=' . $row['id']), array('order' => 'num,name'), array("limit" => 100));
                    if (is_array($dataPage)) {
                        foreach ($dataPage as $rowPage) {
                            $dis_page .= PHPShopText::li($rowPage['name'], '/page/' . $rowPage['link'] . '.html', null);
                        }
                        $this->set('topMenuList', $dis_page);

                        // �������� ������
                        $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                        // ���������� ������
                        $dis .= $this->parseTemplate($this->getValue('templates.page_top_menu'));
                    }
                } else
                    $dis .= str_replace('page/', 'page/CID_', $this->parseTemplate($this->getValue('templates.top_menu')));
            }

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $dis, 'END');
        if ($hook)
            return $hook;

        return $dis;
    }

    /**
     * ����� ��������� ������� �� �������
     * @return string
     */
    function getLastPages() {
        $dis = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, false, 'START');
        if ($hook)
            return $hook;

        $where = array('enabled' => "='1'", 'preview' => '!=""');

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['preview'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
        $PHPShopOrm->debug = $this->debug;
        $result = $PHPShopOrm->select(array('link', 'name', 'icon', 'datas', 'preview'), $where, array('order' => 'datas DESC'), array("limit" => $this->limit_last));

        // �������� �� ��������� ������
        if ($this->limit_last > 1)
            $data = $result;
        else
            $data[] = $result;

        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $this->set('pageLink', $row['link']);
                $this->set('pageName', $row['name']);
                $this->set('pageIcon', $row['icon']);
                $this->set('pageData', PHPShopDate::get($row['datas']));
                $this->set('pagePreview', Parser(stripslashes($row['preview'])));

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                // ���������� ������
                $dis .= parseTemplateReturn($this->getValue('templates.page_mini'));
            }

        return $dis;
    }

}

/**
 * ������� ��������� �����
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopTextElement extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function __construct() {
        $this->objBase = $GLOBALS['SysValue']['base']['menu'];
        $this->template_debug = true;
        parent::__construct();
    }

    /**
     * ����� ���������� ����� � ����� �����
     * @return string
     */
    function leftMenu() {
        $dis = null;

        $where['flag'] = "='1'";
        $where['element'] = "='0'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['element'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $data = $this->PHPShopOrm->select(array('*'), $where, array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    // ���������� ����������
                    $this->set('leftMenuName', $row['name']);
                    $this->set('leftMenuContent', Parser($row['content']));

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row);

                    // ���������� ������
                    $dis .= $this->parseTemplate($this->getValue('templates.left_menu'));
                } else {
                    $dirs = explode(",", $row['dir']);
                    foreach ($dirs as $dir)
                        if (@strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
                            $this->set('leftMenuName', $row['name']);
                            $this->set('leftMenuContent', Parser($row['content']));

                            // �������� ������
                            $this->setHook(__CLASS__, __FUNCTION__, $row);

                            // ���������� ������
                            $dis .= $this->parseTemplate($this->getValue('templates.left_menu'));
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

        $where['flag'] = "='1'";
        $where['element'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['element'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'num'), array("limit" => 20));
        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    // ���������� ����������
                    $this->set('leftMenuName', $row['name']);
                    $this->set('leftMenuContent', Parser($row['content']));

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row);

                    $dis .= $this->parseTemplate($this->getValue('templates.right_menu'));
                } else {
                    $dirs = explode(",", $row['dir']);
                    foreach ($dirs as $dir)
                        if (@strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
                            $this->set('leftMenuName', $row['name']);
                            $this->set('leftMenuContent', Parser($row['content']));

                            // �������� ������
                            $this->setHook(__CLASS__, __FUNCTION__, $row);

                            // ���������� ������
                            $dis .= $this->parseTemplate($this->getValue('templates.right_menu'));
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

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        $where['category'] = "=1000";
        $where['enabled'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $objBase = $GLOBALS['SysValue']['base']['page'];
        $PHPShopOrm = new PHPShopOrm($objBase);
        $PHPShopOrm->debug = $this->debug;
        $data = $PHPShopOrm->select(array('name', 'link'), $where, array('order' => 'num'), array("limit" => 20));
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
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $dis .= $this->parseTemplate($this->getValue('templates.top_menu'));
            }

        return $dis;
    }

    /**
     * ����� ������� �������������� ����
     * @return string
     */
    function bottomMenu() {
        $dis = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, null, 'START');
        if ($hook)
            return $hook;

        $where['enabled'] = "='1'";
        $where['footer'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        $objBase = $GLOBALS['SysValue']['base']['page'];
        $PHPShopOrm = new PHPShopOrm($objBase);
        $PHPShopOrm->debug = $this->debug;
        $data = $PHPShopOrm->select(array('name', 'link'), $where, array('order' => 'num'), array("limit" => 20));
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
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $dis .= $this->parseTemplate($this->getValue('templates.top_menu'));
            }

        return $dis;
    }

}

/**
 * ������� c���� ��������
 * @author PHPShop Software
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
            if (@file_exists("phpshop/templates/" . $_REQUEST['skin'] . "/main/index.tpl")) {
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
 * ������� ��������� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopGbookElement extends PHPShopElements {

    /**
     * @var bool  ���������� ������ �� �������
     */
    var $disp_only_index = true;

    /**
     * @var Int ���-�� �������
     */
    var $limit = 10;

    /**
     * �����������
     */
    function __construct() {

        // �������
        $this->debug = false;

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['gbook'];
        parent::__construct();
    }

    /**
     * ����� ��������� �������
     * @return string
     */
    function index() {
        global $PHPShopModules;
        $dis = null;

        // ���������� ������ �� ������� ��������
        if ($this->disp_only_index) {
            if ($this->PHPShopNav->index())
                $view = true;
            else
                $view = false;
        } else
            $view = true;

        if ($view) {

            $where['flag'] = "='1'";

            // ����������
            if (defined("HostID"))
                $where['servers'] = " REGEXP 'i" . HostID . "i'";
            elseif (defined("HostMain"))
                $where['flag'] .= ' and (servers ="" or servers REGEXP "i1000i")';

            $data = $this->PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), array("limit" => $this->limit));
            if (is_array($data))
                foreach ($data as $row) {

                    // ������ �� ������
                    if (!empty($row['mail']))
                        $d_mail = PHPShopText::a('mailto:' . $row['mail'], PHPShopText::b($row['name']), $row['name']);
                    else
                        $d_mail = PHPShopText::b($row['name']);

                    // ���������� ���������
                    $this->set('gbookData', PHPShopDate::dataV($row['datas'], false));
                    $this->set('gbookName', $row['name']);
                    $this->set('gbookTema', $row['tema']);
                    $this->set('gbookMail', $d_mail);
                    $this->set('gbookOtsiv', $row['otsiv']);
                    $this->set('gbookOtvet', $row['otvet']);
                    $this->set('gbookId', $row['id']);

                    // �������� ������
                    $PHPShopModules->setHookHandler(__CLASS__, __FUNCTION__, $this, $row);

                    // ���������� ������
                    $dis .= $this->parseTemplate($this->getValue('templates.gbook_main_mini'));
                }

            return $dis;
        }
    }

}

/**
 * ������� ��������� �������
 * @author PHPShop Software
 * @version 1.2
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
    var $limit = 3;

    /**
     * �����������
     */
    function __construct() {
        $this->debug = false;
        $this->template_debug = true;
        $this->objBase = $GLOBALS['SysValue']['base']['news'];
        parent::__construct();
    }

    /**
     * ����� ��������� ��������
     * @return string
     */
    function index() {
        $dis = null;

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, false, 'START');
        if ($hook)
            return $hook;

        // ���������� ������ �� ������� ��������
        if ($this->disp_only_index) {
            if ($this->PHPShopNav->index())
                $view = true;
            else
                $view = false;
        } else
            $view = true;

        $where['datau'] = '<' . time();

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['datau'] .= ' and (servers ="" or servers REGEXP "i1000i")';


        if (!empty($view)) {

            $result = $this->PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), array("limit" => $this->limit));

            // �������� �� ��������� ������
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
                    $this->set('newsIcon', $row['icon']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

                    // ���������� ������
                    $dis .= $this->parseTemplate($this->getValue('templates.news_main_mini'));
                }
            return $dis;
        }
    }

}

/**
 * ������� ������ ����������� � �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopSliderElement extends PHPShopElements {

    /**
     * @var bool ���������� ������� ������ �� �������
     */
    var $disp_only_index = true;
    var $template_debug = false;
    var $debug = false;

    /**
     * @var int  ���-�� �����������
     */
    var $limit = 7;

    /**
     * �����������
     */
    function __construct() {
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
        } else
            $view = true;

        $where['enabled'] = '="1"';

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['enabled'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        if (!empty($view)) {
            $result = $this->PHPShopOrm->select(array('image', 'alt', 'link'), $where, array('order' => 'num, id DESC'), array("limit" => $this->limit));

            // �������� �� ��������� ������
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
                    $dis .= $this->parseTemplate("/slider/slider_oneImg.tpl");
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
                    $content .= $this->parseTemplate($this->getValue('templates.opros_list'));
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
                                $content .= $this->parseTemplate($this->getValue('templates.opros_list'));
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
                    $dis .= $this->parseTemplate($this->getValue('templates.opros_forma'));
                elseif ($flag == "RESULT") {
                    $sum = $this->getSumValue($row['category']);
                    $pr = @number_format(($total * 100) / $sum, "1", ".", "");

                    // ���������� ���������
                    $this->set('valueSum', $total);
                    $this->set('valueProc', $pr);
                    $this->set('valueWidth', $pr * 3 + 1);

                    $dis .= $this->parseTemplate($this->getValue('templates.opros_page_forma'));
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
 * @version 1.7
 * @package PHPShopElements
 */
class PHPShopBannerElement extends PHPShopElements {

    function __construct() {
        $this->debug = false;
        $this->template_debug = true;
        $this->objBase = $GLOBALS['SysValue']['base']['banner'];
        parent::__construct();
    }

    /**
     * ����� �������
     * @return string
     */
    function index() {

        $where['flag'] = "='1'";

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['flag'] .= ' and (servers ="" or servers REGEXP "i1000i")';

        // ��������
        if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system']))
            $true_cid = $GLOBALS['PHPShopSeoPro']->getCID();
        else
            $true_cid = $this->PHPShopNav->getId();

        if (!empty($true_cid))
            $where['flag'] .= " and ( dop_cat REGEXP '#" . $true_cid . "#' or dop_cat='') ";

        $data = $this->PHPShopOrm->select(array('*'), $where, array('order' => 'RAND()'), array("limit" => 100));

        if (is_array($data))
            foreach ($data as $row) {
                if (empty($row['dir'])) {

                    if (!empty($row['dop_cat']) and empty($true_cid))
                        continue;

                    if (!empty($row['skin']) and $row['skin'] != $_SESSION['skin'])
                        continue;

                    // ���������� ����������
                    $this->set('banerContent', $row['content']);
                    $this->set('banerTitle', $row['name']);

                    // ���������� ������
                    return $this->parseTemplate($this->getValue('templates.baner_list_forma'));
                } else {
                    $dirs = explode(",", $row['dir']);

                    foreach ($dirs as $dir)
                        if (!empty($dir))
                            if (stristr($_SERVER['REQUEST_URI'], trim($dir)) or $_SERVER['REQUEST_URI'] == trim($dir)) {

                                // �������� �������
                                if ($dir == '/' and $_SERVER['REQUEST_URI'] != '/')
                                    continue;

                                // ���������� ����������
                                $this->set('banerContent', $row['content']);
                                $this->set('banerTitle', $row['name']);

                                // ���������� ������
                                return $this->parseTemplate($this->getValue('templates.baner_list_forma'));
                            }
                }
            }
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
                $dis .= $this->parseTemplate('./phpshop/lib/templates/photo/photo_list_forma.tpl', true);
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

                $dis .= $this->parseTemplate('./phpshop/lib/templates/photo/photo_element_forma.tpl', true);
            }
        return $dis;
    }

}

/**
 * ������� �������� �������� Recaptcha
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopRecaptchaElement extends PHPShopElements {

    /**
     * ��������� ����� �� ��������� �����
     * @var string
     */
    public $secret = '6LdhAiYUAAAAAGzO0wlENkavrN49gFhHiHqH9vkv';
    public $public = '6LdhAiYUAAAAAO1uc9b8KfotAyfoInSrWuygbQKC';

    /**
     * API URL
     * @var string
     */
    protected $api = 'https://www.google.com/recaptcha/api/siteverify';

    public function __construct() {

        parent::__construct();

        $public = $this->PHPShopSystem->getSerilizeParam('admoption.recaptcha_pkey');
        if (!empty($public))
            $this->public = $public;

        $secret = $this->PHPShopSystem->getSerilizeParam('admoption.recaptcha_skey');

        if (!empty($secret))
            $this->secret = $secret;
    }

    /**
     * �������� ������������ ���������� ������
     * @return boolean
     */
    public function check() {
        if (!empty($_POST['g-recaptcha-response'])) {
            $res = $this->request();

            if (!empty($res['success']))
                return true;
        }
    }

    /**
     * �������� �����
     * @param array $option ��������� �������� [url|captcha|referer]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true, 'referer' => true)) {

        // �������� ��������� ������
        if (!empty($option['url'])) {
            preg_match_all('/http:?/', $_POST[$option['url']], $url, PREG_SET_ORDER);
            if (count($url) > 0)
                return false;
        }

        // �������� Referer
        if (!empty($option['referer'])) {
            if (!strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME']))
                return false;
        }

        // �������� ������
        if ($option['captcha'] === true) {

            // Recaptcha
            if ($this->true()) {
                $result = $this->check();
                return $result;
            }

            // ������� ������
            elseif (!empty($_SESSION['text']) and strtoupper($_POST['key']) == strtoupper($_SESSION['text'])) {
                return true;
            } else
                return false;
        }

        return true;
    }

    /**
     * �������� ������ � Google
     * @return array
     */
    protected function request() {

        $recaptcha = $_POST['g-recaptcha-response'];
        $rout = "?secret=" . $this->secret . "&response=" . $recaptcha;

        // ��������� �����
        if ($_SERVER["SERVER_ADDR"] == "127.0.0.1" and getenv("COMSPEC")) {
            $responsecontent = file_get_contents($this->api . $rout);
        } else {
            $data_string = $rout;
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $this->api . $rout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            ));

            $output = curl_exec($ch);
            curl_close($ch);

            $response = explode("\r\n\r\n", $output);
            $responsecontent = $response[1];
        }

        return json_decode($responsecontent, true);
    }

    /**
     * ����� �������� �������� recaptcha
     * @param string $name �� ������
     * @param string $size ������ ������ [normal|compact]   
     * @return string
     */
    public function captcha($name = 'default', $size = 'normal') {

        if ($this->PHPShopSystem->ifSerilizeParam('admoption.recaptcha_enabled')) {
            $dis .= '<div id="recaptcha_' . $name . '" data-size="' . $size . '" data-key="' . $this->public . '"></div>';
            $this->recaptcha = true;
        } else {
            $dis = '<img src="phpshop/lib/captcha/captcha.php" align="left" style="margin-right:10px"> <input type="text" name="key" class="form-control" placeholder="' . __('��� � ��������') . '..." style="width:100px" required="">';
            $this->recaptcha = false;
        }

        return $dis;
    }

    /**
     * ������������ ��������
     * @return boolen
     */
    public function true(){
    return $this->recaptcha;
    }
}
?>