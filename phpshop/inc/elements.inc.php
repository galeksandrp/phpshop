<?php

/**
 * ������� ����������� ��������� ����������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopCoreElement
 * @version 1.1
 * @package PHPShopElements
 */
class PHPShopCoreElement extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopCoreElement() {
        parent::PHPShopElements();
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
        $this->set('telNum', $this->PHPShopSystem->getValue('tel'));
        $this->set('name', $this->PHPShopSystem->getValue('name'));
        $this->set('company', $this->PHPShopSystem->getValue('company'));
        $this->set('descrip', $this->PHPShopSystem->getValue('descrip'));
        $this->set('adminMail', $this->PHPShopSystem->getValue('adminmail2'));
        $this->set('pathTemplate', $this->getValue('dir.templates') . chr(47) . $_SESSION['skin']);
        $this->set('serverName', $_SERVER['SERVER_NAME']);
        $this->set('serverShop', $_SERVER['SERVER_NAME']);
        if (!empty($_SESSION['UserLogin']))
            $this->set('UserLogin', $_SESSION['UserLogin']);
        $this->set('ShopDir', $this->getValue('dir.dir'));
        $this->set('date', date("d-m-y H:i a"));
        $this->set('user_ip', $_SERVER['REMOTE_ADDR']);
        $this->set('NavActive', $this->PHPShopNav->getPath());
        $v=$this->getValue('upload.version');
        $this->set('version',substr($v, 0, 1).'.'.substr($v, 1, 1).'.'.substr($v, 2, 1));

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
 * @version 1.2
 * @package PHPShopElements
 */
class PHPShopUserElement extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopUserElement() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['shopusers'];
        parent::PHPShopElements();

        // ������
        $this->setAction(array('post' => 'user_enter', 'get' => 'logout'));
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
        $url_user = str_replace("?logout=true", "", $_SERVER['REQUEST_URI']);
        header("Location: " . $url_user);
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
            if (is_array($data))
                if (PHPShopSecurity::true_num($data['id'])) {

                    // ID ������������
                    $_SESSION['UsersId'] = $data['id'];

                    // ����� ������������
                    $_SESSION['UsersLogin'] = $data['login'];

                    // ������ ������������
                    $_SESSION['UsersStatus'] = $data['status'];

                    // ���� �����
                    $this->log();

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__,$data);

                    return true;
                }
        }
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

            header("Location: " . $url_user);
        }
        else
            $this->set('usersError', $this->lang('error_login'));
    }

    /**
     * ����� ����������� ������������
     */
    function usersDisp() {
        if (!empty($_SESSION['UsersId']) and PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $this->set('UsersLogin', $_SESSION['UsersLogin']);
            $dis = $this->parseTemplate($this->getValue('templates.users_forma_enter'));
        } else {

            // ���� �����������, ������ �� cookie
            if (PHPShopSecurity::true_num($_COOKIE['UserChecked']))
                $this->set('UserChecked', 'checked');

            if (PHPShopSecurity::true_login($_COOKIE['UserLogin']))
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
    function PHPShopPageCatalogElement() {
        $this->objBase = $GLOBALS['SysValue']['base']['page_categories'];
        parent::PHPShopElements();
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
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopTextElement extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function PHPShopTextElement() {
        $this->objBase = $GLOBALS['SysValue']['base']['table_name14'];
        parent::PHPShopElements();
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
                        if (strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
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
                        if (strpos($_SERVER['REQUEST_URI'], $dir) or $_SERVER['REQUEST_URI'] == $dir) {
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
 * @version 1.0
 * @package PHPShopElements
 */
class PHPShopSkinElement extends PHPShopElements {

    function PHPShopSkinElement() {
        parent::PHPShopElements();

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

                        if ($_SESSION['skin'] == $file)
                            $sel = "selected";
                        else
                            $sel = "";

                        if ($file != "." and $file != ".." and $file != "index.html")
                            $value[] = array($file, $file, $sel);
                    }
                    closedir($dh);
                }
            }

            // ���������� ����������
            $forma = PHPShopText::p(PHPShopText::form(PHPShopText::select('skin', $value, 150, $float = "none", $caption = false, $onchange = "ChangeSkin()"), 'SkinForm'));
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
        if ($this->PHPShopSystem->getValue('spec_num')) {
            if (file_exists("phpshop/templates/" . $_REQUEST['skin'] . "/main/index.tpl")) {
                $skin = $_REQUEST['skin'];
                if (PHPShopSecurity::true_skin($_REQUEST['skin']))
                    $_SESSION['skin'] = $_REQUEST['skin'];
            }
        }
    }

}

/**
 * ������� ��������� �������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopNewsElement
 * @version 1.0
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
    function PHPShopNewsElement() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name8'];
        parent::PHPShopElements();
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
    function PHPShopOprosElement() {
        $this->debug = false;
        parent::PHPShopElements();
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
        $row = mysql_fetch_array($result);
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

    function PHPShopBannerElement() {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name15'];
        parent::PHPShopElements();
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
        $zag = __("����������� ������ � ������") . " " . $this->row['name'];

        $this->set('banner_name', $this->row['name']);
        $this->set('banner_limit', $this->row['limit_all']);

        // ����� ���������
        $message = ParseTemplateReturn('./phpshop/lib/templates/banner/mail_notice.tpl', true);

        $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getParam('adminmail2'), "robot@" . str_replace("www", '', $_SERVER['SERVER_NAME']), $zag, $message);
    }

}

?>