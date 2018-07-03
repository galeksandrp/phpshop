<?php

$TitlePage = __('�������������� ������� #' . $_GET['id']);
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers_status']);
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

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./shopusers/gui/shopusers.gui.js');
    $PHPShopGUI->setActionPanel(__("����������") . ' / ' . __('�������') . ' / ' . $data['name'], array('�������'), array('���������', '��������� � �������'));


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), $PHPShopGUI->setField("��������", $PHPShopGUI->setInput('text.required', "name_new", $data['name'])) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInputText('%', "discount_new", $data['discount'], 100)) .
            $PHPShopGUI->setField("������� ���", $PHPShopGUI->setSelect('price_new', $PHPShopGUI->setSelectValue($data['price'], 5), 100)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled'])
    ),'in',false);

    $Tab1.= $PHPShopGUI->setCollapse(__('������������� ������'),
            $PHPShopGUI->setField(null,'<p class="text-muted hidden-xs">��� ����� ���������� ������ �� ������� ��������� ������ ��� �������� � ������� ������������ � ���������� ��������� � ������ <a href="?path=shopusers.discount"><span class="glyphicon glyphicon-share-alt"></span> ������ �� ������</a>.</p>').
            $PHPShopGUI->setField("������ �� ����� �������", $PHPShopGUI->setCheckbox('cumulative_discount_check_new', 1, '������������� ������������� ������', $data['cumulative_discount_check']) .
                    $PHPShopGUI->loadLib('tab_discount', $data['cumulative_discount'], 'shopusers/'))
    );

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1));

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
    return array('success' => $action);
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

    // ������������� ������
    foreach ($_POST['cumulative_sum_ot'] as $key => $value) {
        if ($_POST['cumulative_discount'][$key] != ''){
            $cumulative_array[$key]['cumulative_sum_ot'] = $value;
            $cumulative_array[$key]['cumulative_sum_do'] = $_POST['cumulative_sum_do'][$key];
            $cumulative_array[$key]['cumulative_discount'] = $_POST['cumulative_discount'][$key];
            $cumulative_array[$key]['cumulative_enabled'] = intval($_POST['cumulative_enabled'][$key]);
        }
    }
    
    // ������������
    $_POST['cumulative_discount_new'] = serialize($cumulative_array);

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>