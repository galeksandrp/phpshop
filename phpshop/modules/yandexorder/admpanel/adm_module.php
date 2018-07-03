<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexorder.yandexorder_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if (empty($_POST['img_new']))
        $_POST['img_new'] = $_POST['icon_new'];

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
    

    // ���������� ��������
    $Info = '��� ������ ������ ��������� ���������������� ���� ������� � ��������� "������� �����", ��� ����� ��������� �� ������
        <a href="http://partner.market.yandex.ru/delivery-registration.xml" target="_blank">
        http://partner.market.yandex.ru/delivery-registration.xml</a> � ������� � �������� ����� ����� �����
        <code>http://' . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . '/order/</code>';

    $Tab1 = $PHPShopGUI->setField('������:', $PHPShopGUI->setIcon($data['img'],false,false));
    $Tab1.= $PHPShopGUI->setField('����������', $PHPShopGUI->setInfo($Info));

    // ����� �����������
    $Tab2 = $PHPShopGUI->setPay();


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("� ������", $Tab2));

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
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>