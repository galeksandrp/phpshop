<?php

$TitlePage = __("���������������");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm;
    
    PHPShopObj::loadClass('order');

    // �������
    $data = $PHPShopOrm->select();
    $option = unserialize($data['1c_option']);

    $PHPShopGUI->action_button['CRM ������'] = array(
        'name' => __('������ ��������'),
        'action' => 'report.crm',
        'class' => 'btn btn-default btn-sm navbar-btn btn-action-panel',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-hourglass'
    );

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./system/gui/system.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('CRM ������', '���������'));

    $PHPShopGUI->_CODE = '<p></p>' . $PHPShopGUI->setField("������������� ���������", $PHPShopGUI->setCheckbox('1c_load_accounts_new', 1, '������������ ���� � ������� � ��������� �� 1�', $data['1c_load_accounts']) . '<br>' . $PHPShopGUI->setCheckbox('1c_load_invoice_new', 1, '������������ ����-������� � ������� �� 1�', $data['1c_load_invoice']), 1, '������������ ��������� ����������� �� 1� ��� ������������� �������.');

    $PHPShopGUI->_CODE .= $PHPShopGUI->setField("������ ��� ������������� ������������", $PHPShopGUI->setCheckbox('option[update_name]', 1, '������������ ������������', $option['update_name']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_description]', 1, '������� ��������', $option['update_description']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_content]', 1, '��������� ��������', $option['update_content']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_category]', 1, '������������ ���������', $option['update_category']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_sort]', 1, '���������c���� � ��������', $option['update_sort']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_option]', 1, '�������', $option['update_option']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_price]', 1, '����', $option['update_price']) . '<br>' .
            $PHPShopGUI->setCheckbox('option[update_item]', 1, '�����', $option['update_item'])
    );

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('�� ������������'), 0, $option['1c_load_status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $option['1c_load_status']);

    $PHPShopGUI->_CODE .= $PHPShopGUI->setField("������ ������", $PHPShopGUI->setSelect('option[1c_load_status]', $order_status_value, 300).'<br>'.
            $PHPShopGUI->setCheckbox('option[1c_load_status_email]', 1, 'E-mail ���������� ���������� � ����� ����������� ������������� ���������� �� 1�', $option['1c_load_status_email'])
            , 1, '������ ��������� � 1� ������ ��� ������������ �������');
    
    


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