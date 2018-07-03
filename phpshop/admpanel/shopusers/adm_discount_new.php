<?php

$TitlePage = __('�������� ������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['discount']);
PHPShopObj::loadClass('user');

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    // ��������� ������
    $data['enabled'] = 1;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("����������") . ' / ' . __('����� ������'), false, array('��������� � �������', '������� � �������������'));

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), $PHPShopGUI->setField("�����", $PHPShopGUI->setInput('text.required', "sum_new", $data['sum'],null,300)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInputText('%', "discount_new", $data['discount'], 100)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled'])
    ),'in', false);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.shopusers.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    if ($_POST['saveID'] == '������� � �������������')
        header('Location: ?path=' . $_GET['path'] . '&id=' . $action);
    else
        header('Location: ?path=' . $_GET['path']);

    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>