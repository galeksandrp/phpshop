<?php

class PHPShopSocauth extends PHPShopCore {

    // ������ �������� ��� ��������. ��������� � ������������.
    var $authConfig = array();
    // ����� ������
    var $error;

    /**
     * �����������
     */
    function PHPShopSocauth() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['socauth']['socauth_system'];
        $this->debug = false;

        // ������ ������ � ��
        $this->PHPShopOrm = new PHPShopOrm($this->objBase);
        $this->PHPShopOrm->debug = $this->debug;
        $data = $this->PHPShopOrm->select();

        // �������� ��������� ��������.
        $this->authConfig = unserialize($data['authConfig']);

        // ������ �������
        $this->action = array("nav" => array("facebook", "twitter", "index"));

        parent::PHPShopCore();
    }

    // index �����
    function index() {

        header("Location: /");
    }

    // ����� ����������� ����� twitter
    function twitter() {
        // �������� ������ �� ��������
        $regArr = $this->twitter_getData();
        if ($regArr) { // ���� ������ ��������
            //print_r($regArr);
            $regUser = $this->authUser($regArr);
            if ($regUser) {
                $this->set('message', ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_twitter_success'], true));
            } else {
                $this->set('message', $this->error);
            }
        } else {
            $this->set('message', $this->error);
        }


        $this->parseTemplate($GLOBALS['SysValue']['templates']['socauth']['socauth_main_forma'], true);
    }

    // ����� ��������� ������ �� twitter
    function twitter_getData() {
        require './phpshop/modules/socauth/lib/twitter/twitteroauth.php';

        if (!empty($_GET['oauth_verifier']) && !empty($_SESSION['twitter']['oauth_token']) && !empty($_SESSION['twitter']['oauth_token_secret'])) {

            $twitteroauth = new TwitterOAuth($this->authConfig['twitter']['key'], $this->authConfig['twitter']['secretkey'], $_SESSION['twitter']['oauth_token'], $_SESSION['twitter']['oauth_token_secret']);
            // Let's request the access token
            $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
            // Save it in a session var
            $_SESSION['twitter']['access_token'] = $access_token;
            // Let's get the user's info
            $user_info = $twitteroauth->get('account/verify_credentials');
            // Print user's info
            if (isset($user_info->error)) {
                // Something's wrong, go back to square 1  
                //header('Location: login-twitter.php');
                $this->error = ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_twitter_auth_fail'], true);
            } else {
                $uid = $user_info->id;
                $regMass['login'] = "twitter" . $user_info->id . "@" . $_SERVER['SERVER_NAME'];
                $regMass['name'] = PHPShopString::utf8_win1251($user_info->name);

                return $regMass;
            }
        } else {

            $twitteroauth = new TwitterOAuth($this->authConfig['twitter']['key'], $this->authConfig['twitter']['secretkey']);
            // Requesting authentication tokens, the parameter is the URL we will be redirected to
            $getDataUrl = "http://" . $_SERVER['SERVER_NAME'] . "/socauth/twitter";
            $request_token = $twitteroauth->getRequestToken($getDataUrl);

            // Saving them into the session

            $_SESSION['twitter']['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['twitter']['oauth_token_secret'] = $request_token['oauth_token_secret'];

            // If everything goes well..
            if ($twitteroauth->http_code == 200) {
                // Let's generate the URL and redirect
                $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
                header('Location: ' . $url);
            } else {
                // It's a bad idea to kill the script, but we've got to know when there's an error.
                $this->error = ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_twitter_auth_fail'], true);
            }
        }
        return false;
    }

    // ����� ����������� ����� facebook
    function facebook() {
        // �������� ������ �� ��������
        $regArr = $this->facebook_getData();
        if ($regArr) { // ���� ������ ��������
            //print_r($regArr);
            $regUser = $this->authUser($regArr);
            if ($regUser) {
                $this->set('message', ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_facebook_success'], true));
            } else {
                $this->set('message', $this->error);
            }
        } else {
            $this->set('message', $this->error);
        }


        $this->parseTemplate($GLOBALS['SysValue']['templates']['socauth']['socauth_main_forma'], true);
    }

    // ����� ����������� ��� ����������� ������������.
    function authUser($mass) {
        $auth = new PHPShopUserSoc($mass);
        //��������� �������������, ���� ����������, �� ����������
        if (!$auth->checkUser()) {
            //���� ��� ������������, �� ������������, ����� � �� � ����������.
            if ($auth->registerUser()) {
                if ($auth->autorization()) {
                    return true;
                }
            }
        } else {
            if ($auth->autorization())
                return true;
        }
        return false;
    }

    // ����� ��������� ������ �� ��������
    function facebook_getData() {
        require './phpshop/modules/socauth/lib/facebook/facebook.php';

        $facebook = new Facebook(array(
                    'appId' => $this->authConfig['facebook']['appid'],
                    'secret' => $this->authConfig['facebook']['secret'],
                    'cookie' => false
                ));

        $session = $facebook->getSession();

        if (!empty($session)) {  // ���� ����������� ������
            // �������� ������ �� �������� 
            $uid = $facebook->getUser();
            $user = $facebook->api('/me');
            $naitik = $facebook->api('/naitik');


            if (!empty($user)) { // ���� ������ ��������
                // ���� ����� �� �������, ���������� � �����������.
                if (!isset($user['email'])) {
                    $this->set('link', $facebook->getLoginUrl(array('req_perms' => 'email')));
                    $this->error = ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_facebook_email_fail'], true);

                    return false;
                }

                $regMass['login'] = $user['email'];
                $regMass['name'] = PHPShopString::utf8_win1251($user['name']);
                $regMass['first_name'] = PHPShopString::utf8_win1251($user['first_name']);
                $regMass['last_name'] = PHPShopString::utf8_win1251($user['last_name']);

                return $regMass;
            } else {
                # For testing purposes, if there was an error, let's kill the script
                $this->error = ParseTemplateReturn($GLOBALS['SysValue']['templates']['socauth']['socauth_facebook_auth_fail'], true);

                return false;
            }
        } else {
            // ��������� �� ����������� � �������� ����������� �������� ������.
            $login_url = $facebook->getLoginUrl(array('req_perms' => 'email'));
            header("Location: " . $login_url);
        }
    }

}

/* ����� ����������� ��� ����������� ������������� �� ������ �� ��� ����� */

class PHPShopUserSoc extends PHPShopElements {

    /**
     * �����������
     */
    function PHPShopUserSoc($mass) {
        $this->debug = false;
        $this->objBase = $GLOBALS['SysValue']['base']['shopusers'];


        $this->userData = $mass;
        parent::PHPShopElements();
    }

    // ��������� ���� ����� ������������ ��� ���.
    // ���� ����, ����������.
    function checkUser() {
        // �������� ������������ ������
        $this->PHPShopOrm = new PHPShopOrm($this->objBase);
        $this->PHPShopOrm->debug = $this->debug;

        $login = $this->userData['login'];
        $data = $this->PHPShopOrm->select(array('id'), array('login' => "='$login'"), false, array('limit' => 1));
        if (!empty($data['id']))
            return true;
        return false;
    }

    // ������������ ������������
    function registerUser() {
        // ������ ������ ������ ������������
        $this->PHPShopOrm = new PHPShopOrm($this->objBase);
        $this->PHPShopOrm->debug = $this->debug;

        $password = base64_encode($this->generate_password(8));

        $insert = array(
            'login_new' => $this->userData['login'],
            'password_new' => $password,
            'datas_new' => time(),
            'mail_new' => $this->userData['login'],
            'name_new' => $this->userData['name'],
            'company_new' => '',
            'inn_new' => '',
            'tel_new' => '',
            'adres_new' => '',
            'enabled_new' => 1,
            'status_new' => 1,
            'kpp_new' => '',
            'tel_code_new' => ''
        );


        // ������ � ��
        $this->PHPShopOrm->insert($insert);
        return true;
    }

    // ����������� ������������.

    function autorization() {
        $this->PHPShopOrm = new PHPShopOrm($this->objBase);
        $this->PHPShopOrm->debug = $this->debug;

        $login = $this->userData['login'];
        $data = $this->PHPShopOrm->select(array('*'), array('login' => '="' . $login . '"'), false, array('limit' => 1));
        if (is_array($data))
            if (PHPShopSecurity::true_num($data['id'])) {

                // ����� ������������
                $_SESSION['UsersId'] = $data['id'];

                // ������ ������������
                $_SESSION['UsersStatus'] = $data['status'];

                return true;
            }
        return false;
    }

    // ����� ��������� ������, � ��������� ������� ���-�� �������� � ������
    function generate_password($number) {
        $arr = array('a', 'b', 'c', 'd', 'e', 'f',
            'g', 'h', 'i', 'j', 'k', 'l',
            'm', 'n', 'o', 'p', 'r', 's',
            't', 'u', 'v', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F',
            'G', 'H', 'I', 'J', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S',
            'T', 'U', 'V', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6',
            '7', '8', '9', '0', '.', ',',
            '(', ')', '[', ']', '!', '?',
            '&', '^', '%', '@', '*', '$',
            '<', '>', '/', '|', '+', '-',
            '{', '}', '`', '~');
        // ���������� ������
        $pass = "";
        for ($i = 0; $i < $number; $i++) {
            // ��������� ��������� ������ �������
            $index = rand(0, count($arr) - 1);
            $pass .= $arr[$index];
        }
        return $pass;
    }

}

?>