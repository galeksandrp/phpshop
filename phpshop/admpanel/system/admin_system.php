<?php

$TitlePage = __("�������� ���������");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ����� html ���������
function GetEditors($editor) {
    global $PHPShopGUI;

    if ($editor == 'tiny_mce')
        $editor = 'default';

    $dir = "./editors/";
    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                if ($editor == $file)
                    $sel = "selected";
                else
                    $sel = "";

                if ($file != "." and $file != ".." and $file != "index.html")
                    $value[] = array($file, $file, $sel);
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('option[editor]', $value);
}

// ����� ������� �������
function GetSkinList($skin) {
    global $PHPShopGUI;
    $dir = "../templates/";

    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (file_exists($dir . '/' . $file . "/main/index.tpl")) {

                    if ($skin == $file)
                        $sel = "selected";
                    else
                        $sel = "";

                    if ($file != "." and $file != ".." and !strpos($file, '.'))
                        $value[] = array($file, $file, $sel);
                }
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('skin_new', $value);
}

// ����� ����� ��������� �������
function GetAceSkinList($skin) {
    global $PHPShopGUI;
    $dir = "./tpleditor/gui/ace/";

    if (empty($skin))
        $skin = 'dawn';

    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                if (preg_match("/^theme-([a-zA-Z0-9_]{1,30}).js$/", $file, $match)) {

                    $file = str_replace(array('.js', 'theme-'), '', $file);

                    if ($skin == $file)
                        $sel = "selected";
                    else
                        $sel = "";

                    if ($file == 'dawn')
                        $value[] = array('default', 'dawn', $sel);

                    elseif ($file != "." and $file != ".." and !strpos($file, '.'))
                        $value[] = array($file, $file, $sel);
                }
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('option[ace_theme]', $value, 200);
}

// ����� ������� ������ ����������
function GetAdminSkinList($skin) {
    global $PHPShopGUI;
    $dir = "./css/";

    $color = array(
        'default' => '#178ACC',
        'cyborg' => '#000',
        'flatly' => '#D9230F',
        'spacelab' => '#46709D',
        'slate' => '#4E5D6C',
        'yeti' => '#008CBA',
        'simplex' => '#DF691A',
        'sardbirds' => '#45B3AF',
        'wordless' => '#468966',
        'wildspot' => '#564267',
        'loving' => '#FFCAEA',
        'retro' => '#BBBBBB',
        'cake' => '#E3D2BA'
    );

    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                if (preg_match("/^bootstrap-theme-([a-zA-Z0-9_]{1,30}).css$/", $file, $match)) {
                    $icon = $color[$match[1]];

                    $file = str_replace(array('.css', 'bootstrap-theme-'), '', $file);

                    if ($skin == $file)
                        $sel = "selected";
                    else
                        $sel = "";

                    if ($file != "." and $file != ".." and !strpos($file, '.'))
                        $value[] = array($file, $file, $sel, 'data-content="<span class=\'glyphicon glyphicon-text-background\' style=\'color:' . $icon . '\'></span> ' . $file . '"');
                }
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('option[theme]', $value, 200, null, false, false, false, 1, false, 'theme_new');
}

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm;

    PHPShopObj::loadClass('valuta');
    PHPShopObj::loadClass('user');


    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['admoption']);

    // ������
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            $dengi_value[] = array($val['name'], $val['id'], $data['dengi']);
            $kurs_value[] = array($val['name'], $val['id'], $data['kurs']);
            $kurs_beznal_value[] = array($val['name'], $val['id'], $data['kurs_beznal']);
        }


    // �������
    $PHPShopUserStatusArray = new PHPShopUserStatusArray();
    $userstatus_array = $PHPShopUserStatusArray->getArray();

    $userstatus_value[] = array(__('�������������� ������������'), 0, $option['user_status']);
    if (is_array($userstatus_array))
        foreach ($userstatus_array as $val) {
            $userstatus_value[] = array($val['name'], $val['id'], $option['user_status']);
        }

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./js/jquery.waypoints.min.js', './system/gui/system.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('���������'));

    $num_vitrina_value[] = array(1, 1, $data['num_vitrina']);
    $num_vitrina_value[] = array(2, 2, $data['num_vitrina']);
    $num_vitrina_value[] = array(3, 3, $data['num_vitrina']);

    $nowbuy_enabled_value[] = array('���������', 0, $data['nowbuy_enabled']);
    $nowbuy_enabled_value[] = array('���������� ������', 1, $data['nowbuy_enabled']);
    $nowbuy_enabled_value[] = array('�����', 2, $data['nowbuy_enabled']);

    $sklad_status_value[] = array('�� ������������', 1, $option['sklad_status']);
    $sklad_status_value[] = array('����� ��������� � ������', 2, $option['sklad_status']);
    $sklad_status_value[] = array('����� �������� ��� �����', 3, $option['sklad_status']);
    
    $search_enabled_value[] = array('������ � ��������', 2, $option['search_enabled']);
    $search_enabled_value[] = array('������ � �������', 3, $option['search_enabled']);
    $search_enabled_value[] = array('�� ������������', 1, $option['search_enabled']);

    // ���������� �������� 1
    $PHPShopGUI->_CODE = '<p></p>' . $PHPShopGUI->setField("����� ���������", $PHPShopGUI->setInputText(false, 'num_row_new', $data['num_row'], 50), 1, '���������� ������� �� ����� �������� � ��������') .
            $PHPShopGUI->setField("���������� � ����������������", $PHPShopGUI->setInputText(false, 'spec_num_new', $data['spec_num'], 50)) .
            $PHPShopGUI->setField("���������� � ��������", $PHPShopGUI->setInputText(false, 'new_num_new', $data['new_num'], 50)) .
            $PHPShopGUI->setField("�������� ����� �������", $PHPShopGUI->setSelect('num_vitrina_new', $num_vitrina_value, 50), 1, '������� � ����� 
	  ��� ������� ������� ��������') .
            $PHPShopGUI->setField("������ ��������", $PHPShopGUI->setSelect('option[nowbuy_enabled]', $nowbuy_enabled_value)) .
            $PHPShopGUI->setField("��������� ��������", $PHPShopGUI->setCheckbox('option[user_calendar]', 1, 'C��������� �������� �� �����', $option['user_calendar'])) .
            $PHPShopGUI->setField("������ �����", $PHPShopGUI->setCheckbox('option[cloud_enabled]', 1, '���������� ������� �� �������� �����', $option['cloud_enabled'])) .
            $PHPShopGUI->setField("�������� ������", $PHPShopGUI->setCheckbox('option[digital_product_enabled]', 1, '������� �������� �������', $option['digital_product_enabled']), 1, '������������� � ������ ����� �������� ����� ������ ������ � ������ ��������');

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('��������� ���', $PHPShopGUI->setField("������ �� ���������", $PHPShopGUI->setSelect('dengi_new', $dengi_value)) .
            $PHPShopGUI->setField("������ � �����", $PHPShopGUI->setSelect('kurs_new', $kurs_value)) .
            $PHPShopGUI->setField("������ ��� �������", $PHPShopGUI->setSelect('kurs_beznal_new', $kurs_beznal_value)) .
            $PHPShopGUI->setField("�������� ����", $PHPShopGUI->setInputText(false, 'percent_new', $data['percent'], 100, '%')) .
            $PHPShopGUI->setField("���", $PHPShopGUI->setCheckbox('nds_enabled_new', 1, '��������� ��� � �����', $data['nds_enabled'])) .
            $PHPShopGUI->setField("�������� ���", $PHPShopGUI->setInputText(false, 'nds_new', $data['nds'], 100, '%')) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setCheckbox('option[sklad_enabled]', 1, '���������� �������� ������ � ������', $option['sklad_enabled'])) .
            $PHPShopGUI->setField("���������� ���", $PHPShopGUI->setInputText(false, 'option[price_znak]', $option['price_znak'], 50), 1, '���������� ������ ����� ������� � ����') .
            $PHPShopGUI->setField("����������� ����� ������", $PHPShopGUI->setInputText(false, 'option[cart_minimum]', $option['cart_minimum'], 100)) .
            $PHPShopGUI->setField("�������� ������", $PHPShopGUI->setSelect('option[sklad_status]', $sklad_status_value)) .
            $PHPShopGUI->setField("�������", $PHPShopGUI->setCheckbox('option[parent_price_enabled]', 1, '���������� ���� � ������� � �������� ������ � ��������', $option['parent_price_enabled']))
    );
    
    if(empty($option['adm_cat_limit'])) $option['adm_cat_limit']=100;

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('��������� �������', $PHPShopGUI->setField('������', GetSkinList($data['skin']) . '<br>' . $PHPShopGUI->setCheckbox('option[user_skin]', 1, '����� ������� ��������������', $option["user_skin"]), 1, '������ ������ ����� (front-end)') . $PHPShopGUI->setField("�������", $PHPShopGUI->setIcon($data['logo'], "logo_new", false), 1, '������������ � ����� ������� � �������� ����������'));

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('��������� �����������', $PHPShopGUI->setField("SMS ����������", $PHPShopGUI->setCheckbox('option[sms_enabled]', 1, '����������� � ������ ��������������', $option['sms_enabled']) . '<br>' .
                    $PHPShopGUI->setCheckbox('option[sms_status_order_enabled]', 1, '����������� � ������� ������ ������������', $option['sms_status_order_enabled']) . '<br>' .
                    $PHPShopGUI->setCheckbox('option[notice_enabled]', 1, '����������� � ������� ������ �������������', $option['notice_enabled'])
            ) .
            $PHPShopGUI->setField(__("��������� �������"), $PHPShopGUI->setInputText(null, "option[sms_phone]", $option['sms_phone'], 300), 1, '������� ��� SMS ����������� ������� 792612345678') .
            $PHPShopGUI->setField(__("������������"), $PHPShopGUI->setInputText(null, "option[sms_login]", $option['sms_login'], 300), 1, '������������ � ������� terasms.ru') .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInput('password', "option[sms_pass]", $option['sms_pass'], null, 300), 1, '������ � ������� terasms.ru') .
            $PHPShopGUI->setField(__("��� �����������"), $PHPShopGUI->setInputText(null, "option[sms_name]", $option['sms_name'], 300), 1, '������������������ ��� ����������� � terasms.ru')
    );

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('��������� �������������', $PHPShopGUI->setField("����������� �������������", $PHPShopGUI->setCheckbox('option[user_mail_activate]', 1, '��������� ����� E-mail', $option['user_mail_activate']) . '<br>' . $PHPShopGUI->setCheckbox('option[user_mail_activate_pre]', 1, '������ ��������� ���������������', $option['user_mail_activate_pre']) . '<br>' . $PHPShopGUI->setCheckbox('option[user_price_activate]', 1, '����������� ��� ��������� ���', $option['user_price_activate'])) . $PHPShopGUI->setField("������ ����� �����������", $PHPShopGUI->setSelect('option[user_status]', $userstatus_value)));

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('��������� ����������', $PHPShopGUI->setField('������', GetAdminSkinList($option['theme']), 1, '�������� ����� ���������� ������ ���������� (back-end)') .
            $PHPShopGUI->setField("HTML-�������� �� ���������", GetEditors($option['editor']), 1, '���������� �������� ��������') .
            $PHPShopGUI->setField("���� ��������� ��������", GetAceSkinList($option['ace_theme']), 1, '������������� ��������� ���������� ���� ��������') .
            $PHPShopGUI->setField(__("���������"), $PHPShopGUI->setInputText(null, "option[adm_title]", $option['adm_title'], 300), 1, '��������� ��������� � ����� ������� ���� ������ ����������') .
            $PHPShopGUI->setField("RSS", $PHPShopGUI->setCheckbox('option[rss_graber_enabled]', 1, '��������� ������� �� RSS �������', $option['rss_graber_enabled'])).
            $PHPShopGUI->setField("������� �����", $PHPShopGUI->setSelect('option[search_enabled]', $search_enabled_value),1,'����� � ������� ������ ���� ������ ���������� (back-end)').
            $PHPShopGUI->setField(__("����� ������ ���������"), $PHPShopGUI->setInputText(null, 'option[adm_cat_limit]', $option['adm_cat_limit'], 100),1,'������������ ����� �������� ����� ��������� ���������')
    );

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);


    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.system.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.system.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $sidebarleft[] = array('title' => '���������', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './system/'));
    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->Compile(2);
    return true;
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
    global $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['admoption']);
    
    // ������� ��������� � ���������
    unset($option['support_notice']);

    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('option.user_calendar','option.cloud_enabled','option.digital_product_enabled','option.parent_price_enabled','option.user_skin','option.sms_enabled','option.sms_status_order_enabled','option.notice_enabled','option.user_mail_activate','option.user_mail_activate_pre','option.user_price_activate','option.rss_graber_enabled');

    if (is_array($_POST['option']))
        foreach ($_POST['option'] as $key => $val)
            $option[$key] = $val;

    // ����� ������� �� front-end
    if ($data['skin'] != $_POST['skin_new'] and PHPShopSecurity::true_skin($_POST['skin_new']))
        $_SESSION['skin'] = $_POST['skin_new'];


    $_POST['admoption_new'] = serialize($option);

    $_POST['nds_enabled_new'] = $_POST['nds_enabled_new'] ? 1 : 0;
    $_POST['nds_enabled_new'] = $_POST['nds_enabled_new'] ? 1 : 0;


    // �������
    $_POST['logo_new'] = iconAdd('logo_new');

    //$PHPShopOrm->debug=true;
    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
   
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));


    return array("success" => $action);
}

// ���������� ����������� 
function iconAdd($name = 'icon_new') {

    // ����� ����������
    $path = '/UserFiles/Image/';

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST[$name];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST[$name])) {
        $file = $_POST[$name];
    }

    if (empty($file))
        $file = '';

    return $file;
}

// ��������� �������
$PHPShopGUI->getAction();
?>