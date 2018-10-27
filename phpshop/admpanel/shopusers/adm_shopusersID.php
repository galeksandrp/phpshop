<?php

$TitlePage = __('�������������� ����������').' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
PHPShopObj::loadClass('user');

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    $PHPShopGUI->action_select['������� �����'] = array(
        'name' => '������� �����',
        'url' => '?path=order&action=new&user=' . $data['id']
    );

    $PHPShopGUI->action_select['������ ������������'] = array(
        'name' => '������ ������������',
        'url' => '?path=order&where[a.user]=' . $data['id']
    );

    $PHPShopGUI->action_select['��������� ������������'] = array(
        'name' => '��������� ������������',
        'url' => '?path=shopusers.messages&where[a.UID]=' . $data['id']
    );

    $PHPShopGUI->action_select['��������� ������'] = array(
        'name' => '��������� ������',
        'url' => 'mailto:' . $data['login']
    );

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("����������") . '<span class="hidden-xs"> / ' . $data['name'] . '</span>', array('��������� ������', '������� �����', '������ ������������', '��������� ������������', '|', '�������'), array('���������', '��������� � �������'));
    $PHPShopGUI->addJSFiles('./js/validator.js','./js/jquery.suggestions.min.js','./order/gui/dadata.gui.js');
    $PHPShopGUI->addCSSFiles('./css/suggestions.min.css');

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
            $PHPShopGUI->setField("������", $PHPShopGUI->setInput("password.required.6", "password_new", base64_decode($data['password']))) .
            $PHPShopGUI->setField("������������� ������", $PHPShopGUI->setInput("password.required.6", "password2_new", base64_decode($data['password']))) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled']) . '&nbsp;&nbsp;' . $PHPShopGUI->setCheckbox('sendActivationEmail', 1, '���������� ������������', 0)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setSelect('status_new', $user_status_value))
    );

    // ������ ��������
    $Tab2 = $PHPShopGUI->loadLib('tab_addres', $data['data_adres']);

    // �����
    $PHPShopGUI->addJSFiles('./shopusers/gui/shopusers.gui.js', '//api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU'); 

    $mass = unserialize($data['data_adres']);
    if (strlen($mass['list'][$mass['main']]['street_new']) > 5) {
        $map = '<div id="map" data-geocode="' . $mass['list'][$mass['main']]['city_new'] . ', ' . $mass['list'][$mass['main']]['street_new'] . ' ' . $mass['list'][$mass['main']]['house_new'] . '"></div>';

        $sidebarright[] = array('title' => '����� �������� �� �����', 'content' => array($map));

        // ������ �������
        $PHPShopGUI->setSidebarRight($sidebarright, 2);
        $PHPShopGUI->sidebarLeftRight = 2;
    }

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("�������� � ���������", $Tab2));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.shopusers.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.shopusers.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.shopusers.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopSystem;

    if (is_array($_POST['mass']))
        foreach ($_POST['mass'] as $k => $v) {

            // ��������� windows 1251
            $mass_decode[$k] = @array_map("urldecode", $v);

            // ���������� ��������
            if (!empty($_POST['mass'][$k]['default']))
                $_POST['data_adres_new']['main'] = $k;

            if (!empty($_POST['mass'][$k]['delete']))
                unset($mass_decode[$k]);
        }

        
    $_POST['mail_new']=$_POST['login_new'];

    // ���������� ������������
    if (!empty($_POST['enabled_new']) and !empty($_POST['sendActivationEmail'])) {

        PHPShopObj::loadClass("parser");
        PHPShopObj::loadClass("mail");

        PHPShopParser::set('user_name', $_POST['name_new']);
        PHPShopParser::set('login', $_POST['login_new']);
        PHPShopParser::set('password', $_POST['password_new']);

        $zag_adm = __("��� ������� ��� ������� ����������� ���������������");
        $PHPShopMail = new PHPShopMail($_POST['login_new'], $PHPShopSystem->getParam('adminmail2'), $zag_adm, '', true, true);
        $content_adm = PHPShopParser::file('../lib/templates/users/mail_user_activation_by_admin_success.tpl', true);

        if (!empty($content_adm)) {
            $PHPShopMail->sendMailNow($content_adm);
        }
    }

    if(!empty($mass_decode))
    $_POST['data_adres_new']['list'] = $mass_decode;
    
    if(is_array($_POST['data_adres_new']))
    $_POST['data_adres_new'] = serialize($_POST['data_adres_new']);
    
    if(!empty($_POST['password_new']))
    $_POST['password_new'] = base64_encode($_POST['password_new']);

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>