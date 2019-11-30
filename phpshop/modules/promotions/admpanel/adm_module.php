<?php

$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_system"));
$PHPShopOrm->mysql_error = false;

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$PHPShopModules;
    
    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=' . $_GET['id']);
    
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $select_name, $PHPShopOrm;

    $data = $PHPShopOrm->select();

    $PHPShopGUI->setActionPanel(__("��������� ������") . ' <span id="module-name">���������</span>', $select_name, array('��������� � �������'));

    // ���������� �������� 2
    $Tab3 = $PHPShopGUI->setPay(false, false, $data['version'], true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("� ������", $Tab3), array("���������", null, '?path=modules.dir.promotions'));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>