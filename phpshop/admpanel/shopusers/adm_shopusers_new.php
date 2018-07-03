<?php

$TitlePage = __('�������� ������������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
PHPShopObj::loadClass('user');

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $TitlePage, $PHPShopModules;


    // ��������� ������
    $data['name'] = '����� ����������';
    $data['enabled'] = 1;


    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }


    $PHPShopGUI->action_select['������� �����'] = array(
        'name' => '������� �����',
        'url' => '?path=order&action=new&where[user]=' . $data['id']
    );

    $PHPShopGUI->action_select['������ ������������'] = array(
        'name' => '������ ������������',
        'url' => '?path=order&where[user]=' . $data['id']
    );

    $PHPShopGUI->action_select['��������� ������'] = array(
        'name' => '��������� ������',
        'url' => 'mailto:' . $data['login']
    );

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("����������"). ' / '.$TitlePage, false, array('��������� � �������', '������� � �������������'));
    $PHPShopGUI->addJSFiles('./js/validator.js');

    // ������� �������������
    $PHPShopUserStatus = new PHPShopUserStatusArray();
    $PHPShopUserStatusArray = $PHPShopUserStatus->getArray();
    $user_status_value[] = array(__('������������'), 0, $data['status']);
    if (is_array($PHPShopUserStatusArray))
        foreach ($PHPShopUserStatusArray as $user_status)
            $user_status_value[] = array($user_status['name'], $user_status['id'], $data['status']);

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse('����������', $PHPShopGUI->setField("���", $PHPShopGUI->setInput('text.required', "name_new", $data['name'])) .
            $PHPShopGUI->setField("E-mail", $PHPShopGUI->setInput('email.required.6', "login_new", $data['login'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInput("password.required.6", "password_new", $data['password'])) .
            $PHPShopGUI->setField("������������� ������", $PHPShopGUI->setInput("password.required", "password2_new", $data['password'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled']) . '&nbsp;&nbsp;' . $PHPShopGUI->setCheckbox('sendActivationEmail', 1, '���������� ������������', 0)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setSelect('status_new', $user_status_value))
    );

    // ������ ��������
    $Tab2 = $PHPShopGUI->loadLib('tab_addres', $data['data_adres']);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("�������� � ���������", $Tab2));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.shopusers.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules,$PHPShopSystem;

    $_POST['password_new'] = base64_encode($_POST['password_new']);

    // ���������� ������������
    if (!empty($_POST['enabled_new']) and !empty($_POST['sendActivationEmail'])) {

        PHPShopObj::loadClass("parser");
        PHPShopObj::loadClass("mail");

        PHPShopParser::set('user_name', $_POST['name_new']);
        PHPShopParser::set('login', $_POST['login_new']);
        PHPShopParser::set('password', $_POST['password_new']);

        $zag_adm = __("��� ������� ��� ������� ����������� ���������������");
        $PHPShopMail = new PHPShopMail($_POST['login_new'], $PHPShopSystem->getEmail(), $zag_adm, '', true, true);
        $content_adm = PHPShopParser::file('../lib/templates/users/mail_user_activation_by_admin_success.tpl', true);

        if (!empty($content_adm)) {
            $PHPShopMail->sendMailNow($content_adm);
        }
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    if ($_POST['saveID'] == '������� � �������������')
        header('Location: ?path=' . $_GET['path'] . '&id=' . $action);
    else
        header('Location: ?path=' . $_GET['path']);

    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>