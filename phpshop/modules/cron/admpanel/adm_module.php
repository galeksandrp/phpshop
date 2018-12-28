<?php

$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_system"));

/**
 * ���������� ��������
 * @return mixed
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopOrm;

    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=' . $_GET['id']);

    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI;

    // ���������� �������� 2
    $Tab2 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("� ������", $Tab2), array("����� �����", null, '?path=modules.dir.cron'), array("������ ����������", null, '?path=modules.dir.cron.log'));

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
$PHPShopGUI->setAction($_GET['id'], 'actionStart');
?>