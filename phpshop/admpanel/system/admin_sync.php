<?php

$TitlePage = __("���������������");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm;

// �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['1c_option']);

// ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./system/gui/system.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('���������'));


    $PHPShopGUI->_CODE = '<p></p>' . $PHPShopGUI->setField(__("������������� ���������"), $PHPShopGUI->setCheckbox('1c_load_accounts_new', 1, '������������ ���� � ������� � ��������� �� 1�', $data['1c_load_accounts']) . '<br>' . $PHPShopGUI->setCheckbox('1c_load_invoice_new', 1, '������������ ����-������� � ������� �� 1�', $data['1c_load_invoice']), 1, '������������ ��������� ����������� �� 1� ��� ������������� �������.');

    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("������ ��� ������������� ������������"), $PHPShopGUI->setCheckbox('option[update_name]', 1, '������������ ������������', $option['update_name']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_description]', 1, '������� ��������', $option['update_description']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_content]', 1, '��������� ��������', $option['update_content']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_category]', 1, '������������ ���������', $option['update_category']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_sort]', 1, '���������c���� � ��������', $option['update_sort'])
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

// header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['1c_option']);

    if (is_array($_POST['option']))
        foreach ($_POST['option'] as $key => $val)
            $option[$key] = $val;

    // ����� ������� ��������
    if (is_array($_POST['option']))
        $option_null = array_diff_key($option, $_POST['option']);
    else
        $option_null = $option;

    if (is_array($option_null)) {
        foreach ($option_null as $key => $val)
            $option[$key] = 0;
    }

    $_POST['1c_load_accounts_new'] = $_POST['1c_load_accounts_new'] ? 1 : 0;
    $_POST['1c_load_invoice_new'] = $_POST['1c_load_invoice_new'] ? 1 : 0;
    $_POST['1c_option_new'] = serialize($option);

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));


    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();
?>