<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.mobile.mobile_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST);
    if($action)
    header('Location: ?path=modules&install=check');
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $Tab1 = $PHPShopGUI->setField(__('���������'), $PHPShopGUI->setTextarea('message_new', $data['message']),1,'������ ���� �� ���������� ���� ������� �� �������');

    // ������
    $Tab1.= $PHPShopGUI->setField(__('����������� � �����'), $PHPShopGUI->setInputText(false, "logo_new", $data['logo']));

    // ���������
    $returncall_value[] = array('�������', 1, $data['returncall']);
    $returncall_value[] = array('�������� ������', 2, $data['returncall']);
    $Tab1.=$PHPShopGUI->setField(__("���������:"), $PHPShopGUI->setSelect('returncall_new', $returncall_value, 200));

    $Tab2 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true), array("� ������", $Tab2));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� ������� 
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>