<?php

// ����������
PHPShopObj::loadClass('user');
PHPShopObj::loadClass('mail');
PHPShopObj::loadClass('order');
PHPShopObj::loadClass('delivery');

/**
 * ���������� �������� ������������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopUsers
 * @version 1.2
 * @package PHPShopCore
 */
class PHPShopUsers extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopUsers() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['shopusers'];

        // �������
        $this->debug = false;

        // ������ �������
        $this->action = array('get' => array('productId', 'noticeId'), 'post' => array('add_notice', 'update_password', 'add_user', 'update_user', 'passw_send'),
            'name' => array('register', 'order', 'useractivate', 'sendpassword', 'notice', 'message'), 'nav' => 'index');

        // ������� ��� ������� �������
        $this->action_prefix = 'action_';

        // �����������
        $this->locale = array(
            'error_key' => __('������������ ����'),
            'error_id' => __('������������ � ����� ������� ��� ����������'),
            'error_password' => __('������ �� ���������'),
            'error_login' => __('������������ �����'),
            'error_password_hack' => __('������������ ������'),
            'error_mail' => __('������������ e-mail'),
            'error_name' => __('������������ ���'),
            'done' => __('������ ��������'),
            'activation_title' => __('��������� ����������� ������������'),
            'activation_admin_title' => __('��������� ����������� ������������'),
            'order_info' => __('���������� � ������') . ' �',
            'order_table_title_1' => '� ' . __('������'),
            'order_table_title_2' => __('����'),
            'order_table_title_3' => __('���-��'),
            'order_table_title_4' => __('������') . ' %',
            'order_table_title_5' => __('�����'),
            'order_table_title_6' => __('������'),
            'user' => __('�������������� ������������')
        );

        parent::PHPShopCore();
    }

    /**
     * ����� �� ��������
     */
    function action_index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // �������� ����������� �����������
        if ($this->true_user()) {

            // ����� �������������� ������������ ������
            $this->user_info();
        } else {
            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ������ ������ �����������
     */
    function action_add_notice() {
        if ($this->true_user()) {
            if (PHPShopSecurity::true_num($_POST['productId'])) {
                $this->notice_add();
            }
            $this->action_notice();
        } else {
            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ������ ���� ���������
     */
    function action_message() {
        if ($this->true_user()) {
            $this->user_message();
        } else {
            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ������ ���������
     * ������� �������� � ��������� ���� users.core/user_message.php
     */
    function user_message() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

    /**
     * ����� ������ ���� �����������
     */
    function action_notice() {
        if ($this->true_user()) {
            $this->notice_list();
        } else {
            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ������ �����������
     */
    function notice_list() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

    /**
     * ������ ������ �����������
     */
    function notice_add() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

    /**
     * ����� �������� �����������
     */
    function action_noticeId() {
        if ($this->true_user()) {
            if (PHPShopSecurity::true_num($_GET['noticeId'])) {
                $PHPShopOrm = new PHPShopOrm($this->getValue('base.notice'));
                $PHPShopOrm->debug = $this->debug;
                $PHPShopOrm->delete(array('user_id' => '=' . $this->UsersId, 'id' => '=' . $_GET['noticeId']));
                $this->action_notice();
            }
            else
                $this->setError404();
        }
        else {
            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ����� �����������
     */
    function action_productId() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        if (PHPShopSecurity::true_num($_GET['productId'])) {
            $PHPShopProduct = new PHPShopProduct($_GET['productId']);
            if (PHPShopSecurity::true_num($PHPShopProduct->getParam('id'))) {
                $this->set('productId', $_GET['productId']);
                $this->set('pic_small', $PHPShopProduct->getParam('pic_small'));
                $this->set('name', $PHPShopProduct->getParam('name'));

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $PHPShopProduct, 'MIDDLE');

                $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/notice.tpl', true));
                $this->set('formaTitle', __('�����������'));

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $PHPShopProduct, 'END');

                $this->ParseTemplate($this->getValue('templates.users_page_list'));
            }
            else
                $this->setError404();
        }
    }

    /**
     * ����� ��������� ������ �� �������
     * ������� �������� � ��������� ���� users.core/order_info.php
     * @return mixed
     */
    function action_order_info() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $tip = 1);
    }

    /**
     * ����� ������� ������� ������������
     * ������� �������� � ��������� ���� users.core/order_list.php
     * @return mixed
     */
    function order_list() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__, $tip = 1);
    }

    /**
     * ���������� ������ �� �����
     * @param string $files ��� �����
     * @return string 
     */
    function link_encode($files) {
        $str = array(
            "files" => $files,
            "time" => (time("U") + ($this->getValue('my.digital_time') * 86400))
        );
        $str = serialize($str);
        $code = base64_encode($str);
        $code2 = str_replace($this->getValue('my.digital_pass1'), "!", $code);
        $code2 = str_replace($this->getValue('my.digital_pass2'), "$", $code2);

        return $code2;
    }

    /**
     * ������ ������ ���������
     */
    function clean_old_activation() {
        $nowData = time() - 432000;
        $this->PHPShopOrm->delete(array('datas' => '<' . $nowData, 'enabled' => "='0'"));
        $this->PHPShopOrm->clean();
    }

    /**
     * �������� ����� ���������
     */
    function true_key($passw) {
        return preg_match("/^[a-zA-Z0-9_]{4,35}$/", $passw);
    }

    /**
     * ����� ��������� �� �����
     */
    function action_useractivate() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        if ($this->true_key($_GET['key'])) {

            // ������ ������ ���������
            $this->clean_old_activation();

            $data = $this->PHPShopOrm->select(array('login'), array('status' => "='" . $_GET['key'] . "'"), false, array('limit' => 1));
            if (!empty($data['login'])) {

                $this->set('date', date("d-m-y H:i a"));
                $this->set('user_ip', $_SERVER['REMOTE_ADDR']);
                $this->set('user_name', $data['login']);
                $this->set('user_login', $data['login']);

                if (!$this->PHPShopSystem->ifSerilizeParam('admoption.user_mail_activate_pre')) {

                    $this->PHPShopOrm->clean();

                    $this->PHPShopOrm->update(array('enabled_new' => '1', 'status_new' => $this->PHPShopSystem->getSerilizeParam('admoption.user_status')), array('status' => "='" . $_GET['key'] . "'"));

                    $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/message_activation_done.tpl', true));
                } else {

                    $this->PHPShopOrm->clean();

                    $this->PHPShopOrm->update(array('status_new' => $this->PHPShopSystem->getSerilizeParam('admoption.user_status')), array('status' => "='" . $_GET['key'] . "'"));

                    // ��������� e-mail ��������������
                    $title = $this->PHPShopSystem->getName() . " - " . $obj->locale['activation_admin_title'] . " " . $_POST['name_new'];

                    // ���������� e-mail ��������������
                    $content = ParseTemplateReturn('./phpshop/lib/templates/users/mail_admin_activation.tpl', true);

                    // �������� e-mail ��������������
                    $PHPShopMail = new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'), $_POST['mail_new'], $title, $content);

                    $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/message_admin_activation.tpl', true), true);
                }
            } else {
                $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/message_activation_error.tpl', true));
            }

            $this->set('formaTitle', $this->lang('user_register_title'));

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, $data, 'END');

            $this->ParseTemplate($this->getValue('templates.users_page_list'));
        }
        else
            $this->action_register();
    }

    /**
     * ����� ������ �������
     */
    function action_order() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        if ($this->true_user()) {

            // ����� ������ �������
            $this->order_list();

            // �������� ������ ���������� �������� ������
            $this->waitAction('order_info');

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, false, 'END');

            $this->ParseTemplate($this->getValue('templates.users_page_list'));
        } else {

            // ����� ����������� ������ ������������
            $this->action_register();
        }
    }

    /**
     * ����� ���������� ������������ ������
     */
    function action_update_user() {

        if (PHPShopSecurity::true_num($_SESSION['UsersId'])) {

            if (!PHPShopSecurity::true_email($_POST['mail_new']))
                $this->error[] = $this->locale('error_mail');

            if (strlen($_POST['name_new']) < 3)
                $this->error[] = $this->locale('error_name');

            if (count($this->error) == 0) {
                $this->PHPShopOrm->update(array(
                    'mail_new' => PHPShopSecurity::TotalClean($_POST['mail_new'],3),
                    'name_new' => PHPShopSecurity::TotalClean($_POST['name_new']),
                    'company_new' => PHPShopSecurity::TotalClean($_POST['company_new']),
                    'inn_new' => PHPShopSecurity::TotalClean($_POST['inn_new']),
                    'tel_new' => PHPShopSecurity::TotalClean($_POST['tel_new']),
                    'adres_new' => PHPShopSecurity::TotalClean($_POST['adres_new']),
                    'kpp_new' => PHPShopSecurity::TotalClean($_POST['kpp_new']),
                    'tel_code_new' => PHPShopSecurity::TotalClean($_POST['tel_code_new'])), array('id' => '=' . intval($_SESSION['UsersId'])));
                $this->error[] = $this->locale['done'];

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $_POST);
            }
        }

        // ������ ������ ����� ������
        $this->error();

        // ����� ������������ ������ ������������
        $this->user_info();
    }

    /**
     * ����� ����� �������������� ������
     */
    function action_sendpassword() {
        $this->set('formaTitle', __('�������������� ������'));
        $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/sendpassword.tpl', true));
        $this->setHook(__CLASS__, __FUNCTION__);
        $this->ParseTemplate($this->getValue('templates.users_page_list'));
    }

    /**
     * ����� ����������� ������ �� �����
     */
    function action_passw_send() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        if (PHPShopSecurity::true_login($_POST['login'])) {
            $this->PHPShopOrm->clean();
            $data = $this->PHPShopOrm->select(array('*'), array('login' => '="' . $_POST['login'] . '"'), false, array('limit' => 1));
            if (is_array($data)) {

                $this->set('date', date("d-m-y H:i a"));
                $this->set('user_ip', $_SERVER['REMOTE_ADDR']);
                $this->set('user_login', $data['login']);
                $this->set('user_mail', $data['mail']);
                $this->set('user_password', $this->decode($data['password']));

                // ��������� e-mail ������������
                $title = $this->PHPShopSystem->getName() . " - " . __('�������������� ������ ������������') . " " . $_POST['login'];

                // ���������� e-mail ������������
                $content = ParseTemplateReturn('./phpshop/lib/templates/users/mail_sendpassword.tpl', true);

                // �������� e-mail ������������
                $PHPShopMail = new PHPShopMail($data['mail'], 'robot@' . str_replace("www.", "", $_SERVER['SERVER_NAME']), $title, $content);

                // ��������� �� �������� ����������� ������
                $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/message_sendpassword.tpl', true));
            } else {
                // ��������� �� �������� ����������� ������
                $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/message_sendpassword_error.tpl', true));
            }
        }

        $this->set('formaTitle', __('������ �������'));
        $this->ParseTemplate($this->getValue('templates.users_page_list'));
    }

    /**
     * ����� ���������� ������ ������������
     */
    function action_update_password() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        //�������� ���������� ����� ������
        if (PHPShopSecurity::true_num($_SESSION['UsersId'])) {

            if ($_POST['password_new'] != $_POST['password_new2'])
                $this->error[] = $this->locale('error_password');

            if (!PHPShopSecurity::true_login($_POST['login_new']))
                $this->error[] = $this->locale('error_login');

            if (!PHPShopSecurity::true_passw($_POST['password_new']))
                $this->error[] = $this->locale('error_password_hack');

            if (count($this->error) == 0) {
                $this->PHPShopOrm->update(array('login_new' => $_POST['login_new'],
                    'password_new' => $this->encode($_POST['password_new'])), array('id' => '=' . $_SESSION['UsersId']));
                $this->error[] = $this->locale['done'];
            }
        }

        // ������ ������ ����� ������
        $this->error();

        // ����� ������������ ������ ������������
        $this->user_info();
    }

    /**
     * ��������� � ������ � ����� ������ �������������
     */
    function error() {
        $user_error = null;
        if (is_array($this->error))
            foreach ($this->error as $val)
                $user_error.=PHPShopText::ul(PHPShopText::li($val));

        $this->set('user_error', $user_error);
    }

    /**
     * ������������ ������ ������������
     */
    function user_info() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        $this->PHPShopUser = new PHPShopUser($_SESSION['UsersId']);

        // ������������ ������ ������������
        $this->set('user_status', $this->PHPShopUser->getStatusName());

        if ($this->get('user_status') == "")
            $this->set('user_status', __('�������������� ������������'));

        $this->set('user_login', $this->PHPShopUser->getParam('login'));
        $this->set('user_password', $this->decode($this->PHPShopUser->getParam('password')));
        $this->set('user_name', $this->PHPShopUser->getName());
        $this->set('user_mail', $this->PHPShopUser->getParam('mail'));
        $this->set('user_company', $this->PHPShopUser->getParam('company'));
        $this->set('user_inn', $this->PHPShopUser->getParam('inn'));
        $this->set('user_tel', $this->PHPShopUser->getParam('tel'));
        $this->set('user_tel_code', $this->PHPShopUser->getParam('tel_code'));
        $this->set('user_adres', $this->PHPShopUser->getParam('adres'));
        $this->set('user_kpp', $this->PHPShopUser->getParam('kpp'));

        // ����� ������� �������� ������������
        $this->set('formaTitle', $this->lang('user_info_title'));
        $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/info.tpl', true));

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->PHPShopUser, 'END');

        $this->ParseTemplate($this->getValue('templates.users_page_list'));
    }

    /**
     * �������� ����������� �����������
     * @return bool
     */
    function true_user() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook)
            return $hook;

        if (PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $this->UsersId = $_SESSION['UsersId'];
            $this->UsersStatus = $_SESSION['UsersStatus'];
            return true;
        }
    }

    /**
     * ����������� ������
     * @param string $str ������
     * @return string
     */
    function encode($str) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $str);
        if ($hook)
            return $hook;

        return base64_encode($str);
    }

    /**
     * ������������� ������
     * @param string $str ������
     * @return string
     */
    function decode($str) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $str);
        if ($hook)
            return $hook;

        return base64_decode($str);
    }

    /**
     * �������� ������ ������������
     * @return Bool
     */
    function add_user_check() {

        // �������� �� �������� ��������
        if (empty($_SESSION['text']) or ($_POST['key'] != $_SESSION['text'])) {
            $this->error[] = $this->locale['error_key'];
            return false;
        }

        // �������� ������������ ������
        if (PHPShopSecurity::true_login($_POST['login_new'])) {
            $data = $this->PHPShopOrm->select(array('id'), array('login' => "='" . $_POST['login_new'] . "'"), false, array('limit' => 1));
            if (!empty($data['id']))
                $this->error[] = $this->locale['error_id'];
        }

        // �������� �������� ������� 1 � 2
        if ($_POST['password_new'] != $_POST['password_new2'])
            $this->error[] = $this->locale['error_password'];

        // �������� ���������� ������
        if (!PHPShopSecurity::true_login($_POST['login_new']))
            $this->error[] = $this->locale['error_login'];

        // �������� ���������� ������
        if (!PHPShopSecurity::true_passw($_POST['password_new']))
            $this->error[] = $this->locale['error_password_hack'];

        // �������� ���������� �����
        if (!PHPShopSecurity::true_email($_POST['mail_new']))
            $this->error[] = $this->locale['error_mail'];

        // �������� ���������� �����
        if (strlen($_POST['name_new']) < 3)
            $this->error[] = $this->locale['error_name'];

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $_POST);

        if (count($this->error) == 0)
            return true;
    }

    /**
     * ������ ������ ������������ � ��
     * @return Int �� ������ ������������ � ��
     */
    function add() {

        // �������� �� ������������� ���������
        if (!$this->PHPShopSystem->ifSerilizeParam('admoption.user_mail_activate')
                and !$this->PHPShopSystem->ifSerilizeParam('admoption.user_mail_activate_pre')) {
            $user_mail_activate = 1;
            $this->user_status = $this->PHPShopSystem->getSerilizeParam('admoption.user_status');
        } else {
            $user_mail_activate = 0;
            $this->user_status = md5(time());
        }

        // ������ ������ ������ ������������
        $insert = array(
            'login_new' => PHPShopSecurity::TotalClean($_POST['login_new']),
            'password_new' => $this->encode($_POST['password_new']),
            'datas_new' => time(),
            'mail_new' => PHPShopSecurity::TotalClean($_POST['mail_new'],3),
            'name_new' => PHPShopSecurity::TotalClean($_POST['name_new']),
            'company_new' => PHPShopSecurity::TotalClean($_POST['company_new']),
            'inn_new' => PHPShopSecurity::TotalClean($_POST['inn_new']),
            'tel_new' => PHPShopSecurity::TotalClean($_POST['tel_new']),
            'adres_new' => PHPShopSecurity::TotalClean($_POST['adres_new']),
            'enabled_new' => $user_mail_activate,
            'status_new' => $this->user_status,
            'kpp_new' => PHPShopSecurity::TotalClean($_POST['kpp_new']),
            'tel_code_new' => PHPShopSecurity::TotalClean($_POST['tel_code_new'])
        );

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $insert);
        if (is_array($hook))
            $insert = $hook;

        // ������ � ��
        $this->PHPShopOrm->insert($insert);

        // ���������� �� ������ ������������
        return mysql_insert_id();
    }

    /**
     * ����� ���������� ������ ������������
     */
    function action_add_user() {


        // ���� �������� �������� �� ������������ �����
        if ($this->add_user_check()) {

            // ���������� ������ � ��
            $UsersId = $this->add();

            // �������� �� ������������� ���������
            if (!$this->PHPShopSystem->ifSerilizeParam('admoption.user_mail_activate')
                    and !$this->PHPShopSystem->ifSerilizeParam('admoption.user_mail_activate_pre')) {

                $this->PHPShopUser = new PHPShopUser($UsersId);

                // �������� �������� �������� �����������
                $_SESSION['UsersId'] = $UsersId;
                $_SESSION['UsersStatus'] = $this->PHPShopUser->getStatus();

                // ����� ������������ ������
                $this->user_info();
            } else {

                // ��������� �� ��������� ��������
                $this->message_activation();
            }
        } else {

            // ������ ������
            $this->error();

            // ����� �����������
            $this->action_register();
        }
    }

    /**
     * ��������� �����������
     * ������� �������� � ��������� ���� users.core/message_activation.php
     * @return mixed
     */
    function message_activation() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

    /**
     * ����� ����� ����������� ������ ������������
     * ��������� ���������� ����� �������������� � action_add_user()
     */
    function action_register() {
        $this->set('formaTitle', $this->lang('user_register_title'));
        $this->set('formaContent', ParseTemplateReturn('phpshop/lib/templates/users/register.tpl', true));
        $this->setHook(__CLASS__, __FUNCTION__);
        $this->ParseTemplate($this->getValue('templates.users_page_list'));
    }

    /**
     * ������������ ������ ������
     * @return string
     */
    function tr() {
        $Arg = func_get_args();

        $tr = '<tr>';

        foreach ($Arg as $key => $val)
            if ($val != '-')
                $col[$key] = 1;
            else
                $col[$key] = 2;

        foreach ($Arg as $key => $val) {
            if ($val != '-')
                $tr.=PHPShopText::td($val, false, @$col[$key + 1], $id = 'allspecwhite');
        }

        $tr.='</tr>';
        return $tr;
    }

    /**
     * ������������ ������ ������. ���������.
     * @return string
     */
    function caption() {
        $Arg = func_get_args();
        $tr = '<tr id="allspec">';
        foreach ($Arg as $val) {
            $tr.=PHPShopText::td(PHPShopText::b($val), false, false, $id = 'allspecwhite');
        }
        $tr.='</tr>';
        return $tr;
    }

}

?>