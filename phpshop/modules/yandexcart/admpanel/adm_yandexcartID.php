<?php


// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexcart.yandexcart_log"));

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $_GET['id']));

    // ��������� � �������� ���
    ob_start();
    print_r(unserialize($data['message']));
    $log = ob_get_clean();

    $Tab1 = $PHPShopGUI->setTextarea(null, $data['path'].PHPShopString::utf8_win1251($log), $float = "none", false, $height = '340');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("���������� � ������", $Tab1, 370));


    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>


