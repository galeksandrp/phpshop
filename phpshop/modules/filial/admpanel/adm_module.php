<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.filial.filial_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $TitlePage, $select_name, $PHPShopOrm;

    $PHPShopGUI->setActionPanel($TitlePage, $select_name, array('��������� � �������'));
    
    // �������
    $data = $PHPShopOrm->select();
    
    // ����� �����������
    $Tab1 = $PHPShopGUI->setInfo('������ ��������� ��������� �������� ������� � ������� ���� ��� �������� (��������, ��������� � �.�.)').$PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("� ������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", 1) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>