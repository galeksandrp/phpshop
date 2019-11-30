<?php
PHPShopObj::loadClass('order');
// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.oneclick.oneclick_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    header('Location: ?path=modules&id=' . $_GET['id']);
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=' . $_GET['id']);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();


    // �����
    $e_value[] = array('������ ������', 0, $data['enabled']);
    $e_value[] = array('�����', 1, $data['enabled']);
    $e_value[] = array('������', 2, $data['enabled']);

    // ��� ������
    $w_value[] = array('�����', 0, $data['windows']);
    $w_value[] = array('����������� ����', 1, $data['windows']);

    // ����� ������
    $d_value[] = array('��������� ��������', 0, $data['display']);
    $d_value[] = array('��������� � ������� ��������', 1, $data['display']);

    // ���������� �������
    $o_value[] = array('��������� ���� �������', 0, $data['write_order']);
    $o_value[] = array('����� ���� �������', 1, $data['write_order']);

    // Captcha
    $c_value[] = array('���', 0, $data['captcha']);
    $c_value[] = array('����', 1, $data['captcha']);

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['status']);


    $Tab1 = $PHPShopGUI->setField('���������', $PHPShopGUI->setInputText(false, 'title_new', $data['title']));
    $Tab1 .= $PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('title_end_new', $data['title_end']));
    $Tab1 .= $PHPShopGUI->setField('����� ������', $PHPShopGUI->setSelect('enabled_new', $e_value, 250));
    $Tab1 .= $PHPShopGUI->setField('��� ������', $PHPShopGUI->setSelect('windows_new', $w_value, 250));
    $Tab1 .= $PHPShopGUI->setField('�����', $PHPShopGUI->setSelect('display_new', $d_value, 250));
    $Tab1 .= $PHPShopGUI->setField('������ ������', $PHPShopGUI->setSelect('write_order_new', $o_value, 250));
    
    $Tab1 .= $PHPShopGUI->setField('������ ������', $PHPShopGUI->setSelect('status_new', $order_status_value, 250));
    
    $Tab1 .= $PHPShopGUI->setField('�������� ��������', $PHPShopGUI->setSelect('captcha_new', $c_value, 250));


    $info = '��� ������������ ������� ��������, ������� ������� �������� ������ "������ ������" � �������� ����������
        <kbd>@oneclick@</kbd> � ���� ������ � ������ ��� �����.
        <p>��� �������������� ����� ������, �������������� ������� <code>phpshop/modules/oneclick/templates/</code></p>
';

    $Tab2 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay(false, false, $data['version'], true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $Tab2), array("� ������", $Tab3), array("����� ������", 0, '?path=modules.dir.oneclick'));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>