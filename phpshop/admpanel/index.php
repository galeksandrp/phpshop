<?php

session_start();
$_classPath = "../";
include($_classPath . "class/obj.class.php");
require_once $_classPath . '/lib/phpass/passwordhash.php';
PHPShopObj::loadClass(array("base", "system", "admgui", "orm", "security", "modules", "mail", "lang"));

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini", true, true);
$PHPShopSystem = new PHPShopSystem();

// Locale
$_SESSION['lang'] = $PHPShopSystem->getSerilizeParam("admoption.lang");
$PHPShopLang = new PHPShopLang(array('locale' => $_SESSION['lang'], 'path' => 'admin'));

$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['users']);
$PHPShopOrm->debug = false;
PHPShopParser::set('logo', $PHPShopSystem->getLogo());
PHPShopParser::set('serverPath', $_SERVER['SERVER_NAME']);

// ������
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// �������� GUI
$PHPShopGUI = new PHPShopGUI();

// �������� ������� ������
if ($PHPShopBase->getNumRows('black_list', 'where ip="' . PHPShopSecurity::TotalClean($_SERVER['REMOTE_ADDR']) . '"')) {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
    if (file_exists('../../404.html'))
        include_once('../../404.html');
    exit();
}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}

// ����� ������
function actionLogout() {
    global $notification;
    $notification = __('������������') . ' ' . $_SESSION['logPHPSHOP'] . ' ' . __('�������� �����');
    session_destroy();
}

// ����� ��������� ���� �� ����� ������
function actionHash() {
    global $PHPShopOrm, $notification, $PHPShopSystem;

    if (PHPShopSecurity::true_param($_POST['actionHash']) and PHPShopSecurity::true_login($_POST['log']) and strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME'])) {

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['users']);
        $data = $PHPShopOrm->select(array('password', 'mail', 'id', 'login'), array('login' => '="' . $_POST['log'] . '"'), false, array('limit' => 1));

        if (is_array($data)) {

            $hash = md5($data['id'] . $_POST['log'] . $data['mail'] . $data['password'] . time());
            $PHPShopOrm->clean();
            $PHPShopOrm->update(array('hash_new' => $hash), array('id' => '=' . $data['id']));

            PHPShopParser::set('hash', $hash);
            PHPShopParser::set('login', $data['login']);
            new PHPShopMail($data['mail'], $PHPShopSystem->getEmail(), __('������ � PHPShop'), PHPShopParser::file('tpl/hash.mail.tpl', true), true);

            $notification = __('������ � ������������ ������� ��') . ' ' . $data['mail'];
        }
    }
}

// ����� ��������� ������
function actionUpdate() {
    global $PHPShopOrm, $notification, $PHPShopSystem;


    $hash = mysqli_real_escape_string($PHPShopOrm->link_db, stripslashes($_GET['newPassGen']));

    if (PHPShopSecurity::true_param($_GET['newPassGen'])) {

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['users']);
        $data = $PHPShopOrm->select(array('password', 'mail', 'id', 'login'), array('hash' => '="' . $hash . '"'), false, array('limit' => 1));

        if (is_array($data)) {

            // ���������� ����� ������ ��� ��������������
            $newPass = generatePassword();

            // �������� ����� ������ 
            $hasher = new PasswordHash(8, false);
            $password = $hasher->HashPassword($newPass);

            $PHPShopOrm->update(array('password_new' => $password, 'hash_new' => ''), array('id' => '=' . $data['id']));

            PHPShopParser::set('login', $data['login']);
            PHPShopParser::set('password', $newPass);
            new PHPShopMail($data['mail'], $PHPShopSystem->getEmail(), __('������ � PHPShop'), PHPShopParser::file('tpl/pass.mail.tpl', true), true);

            $notification = __('������ � ����� ������� ������� ��') . ' ' . $data['mail'];
        }
    }
}

// ����� �����
function actionEnter() {
    global $PHPShopOrm, $PHPShopModules;

    $hasher = new PasswordHash(8, false);
    $data = $PHPShopOrm->select(array('*'), array('enabled' => "='1'"), false, array('limit' => 30));
    if (is_array($data)) {
        foreach ($data as $row) {

            if ($row['login'] == $_POST['log'] and $hasher->CheckPassword($_POST['pas'], $row['password'])) {

                $_SESSION['logPHPSHOP'] = $_POST['log'];
                $_SESSION['pasPHPSHOP'] = $_POST['pas'];
                $_SESSION['idPHPSHOP'] = $row['id'];

                // ������ ������ �� ��������
                $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

                if (isset($_SESSION['return']))
                    $return = '?' . $_SESSION['return'];
                else
                    $return = null;

                // ������ � ������ �����������
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['jurnal']);
                $PHPShopOrm->insert(array('user' => $_POST['log'], 'datas' => time(), 'flag' => 0, 'ip' => PHPShopSecurity::TotalClean($_SERVER['REMOTE_ADDR'])), '');

                header('Location: ./admin.php' . $return);
                return true;
            }
        }
    }
    // ������ � ������ �����������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['jurnal']);
    $PHPShopOrm->insert(array('user' => PHPShopSecurity::TotalClean($_POST['log']), 'datas' => time(), 'flag' => 1, 'ip' => PHPShopSecurity::TotalClean($_SERVER['REMOTE_ADDR'])), '');

    PHPShopParser::set('error', 'has-error');
}

// ����� ��������
function getLicense($file) {
    $fstat = explode(".", $file);
    if ($fstat[1] == "lic")
        return $file;
}

function actionStart() {
    global $PHPShopSystem, $PHPShopBase, $notification;

    $License = parse_ini_file_true("../../license/" . PHPShopFile::searchFile('../../license/', 'getLicense', true), 1);
    if ($License['License']['Expires'] != 'Never' and $License['License']['RegisteredTo'] == 'Trial NoName')
        $_SESSION['chat'] = true;

    // ��������������� �����
    if (is_array($License)) {
        if ($License['License']['Expires'] != 'Never' and $License['License']['Expires'] < time()) {
            PHPShopParser::set('title', __('��������� ������ PHPShop'));
            PHPShopParser::set('server', getenv('SERVER_NAME'));
            PHPShopParser::set('serverLocked', getenv('SERVER_NAME'));
            exit(PHPShopParser::file($_SERVER['DOCUMENT_ROOT'] . '/phpshop/lib/templates/error/license.tpl'));
            exit("������ �������� �������� ��� SERVER_NAME=" . $_SERVER["SERVER_NAME"] . ", HardwareLocked=" . getenv('SERVER_NAME'));
        } elseif (strstr($License['License']['HardwareLocked'], '-') and getenv('SERVER_NAME') != $License['License']['DomenLocked']) {
            header('Location: //' . $License['License']['DomenLocked'] . '/phpshop/admpanel/admin.php');
        }
    }

    if (!empty($_SESSION['logPHPSHOP']) and empty($_SESSION['return'])) {
        header('Location: ./admin.php');
    }

    // ����-�����
    if ($PHPShopBase->getParam('template_theme.demo') == 'true') {
        PHPShopParser::set('user', 'demo');
        PHPShopParser::set('password', 'demouser');
        PHPShopParser::set('readonly', 'readonly');
        PHPShopParser::set('disabled', 'disabled');
    }
    else {
        PHPShopParser::set('autofocus','autofocus');
    }

    PHPShopParser::set('title', 'PHPShop - ' . __('�����������'));
    PHPShopParser::set('version', $PHPShopBase->getParam('upload.version'));
    $theme = PHPShopSecurity::TotalClean($PHPShopSystem->getSerilizeParam('admoption.theme'));
    if (!file_exists('./css/bootstrap-theme-' . $theme . '.css'))
        $theme = 'default';
    PHPShopParser::set('theme', $theme);
    PHPShopParser::set('notification', $notification);
    PHPShopParser::set('code', $GLOBALS['PHPShopLang']->code);
    PHPShopParser::set('charset', $GLOBALS['PHPShopLang']->charset);
    PHPShopParser::set('lang', $_SESSION['lang']);
    PHPShopParser::file('tpl/signin.tpl');
}

// ����� ������
$_REQUEST['actionList']['newPassGen'] = 'actionUpdate';
$_REQUEST['actionList']['logout'] = 'actionLogout';


// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_GET['logout'], 'actionStart');
?>