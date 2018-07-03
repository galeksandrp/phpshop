<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    if (empty($_POST['key_enabled_new']))
        $_POST['key_enabled_new'] = 0;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function getStatus($status_id) {
    global $PHPShopGUI;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['order_status']);
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 100));
    if (is_array($data))
        foreach ($data as $row) {
            if ($row['id'] == $status_id)
                $sel = 'selected';
            else
                $sel = null;
            $value[] = array($row['name'], $row['id'], $sel);
        }

    return $PHPShopGUI->setSelect('order_status_new', $value);
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $Tab1 = $PHPShopGUI->setField('������ �����', $PHPShopGUI->setCheckbox('enabled_new', 1, '���� ��������� ���������', $data['enabled']).$PHPShopGUI->setCheckbox('key_enabled_new', 1, '���� ������������ ������ API', $data['key_enabled']));
    $Tab1.=$PHPShopGUI->setField('���������� ���������', $PHPShopGUI->setInputText('%', 'percent_new', $data['percent'], '150', '�� ������'));
    $Tab1.=$PHPShopGUI->setField('������ ������ �������',getStatus($data['order_status']));
    $Info = '�������� ����� � ����������� ������ ��������� �� ������: <a href="../../partner/" target="_blank">http://' . $_SERVER['SERVER_NAME'] . '/partner/</a>. ���������� �� ����� ����� �������� ��� ������ ��� �������������.
        <p>
������� ����������� � ����������� ��������� �������� �� ������
        <a href="../../rulepartner/" target="_blank">http://' . $_SERVER['SERVER_NAME'] . '/rulepartner/</a>.
     <p>
     ������� ���������� ��������� � ����� <code>/phpshop/modules/partner/templates/</code><br>
     �������� ���� �� ������ <code>/phpshop/modules/partner/inc/config.ini</code> � ����� <kbd>[lang]</kbd>
     <p>
     ��� ���������� ������������ ����� � ����� ����������� ������������� �������������� ���� <code>/phpshop/modules/partner/templates/partner_forma_register.tpl</code>,
     �������� ����������� ���� � ��������� <b>dop_</b>, �������� dop_icq.';

    $Tab4=$PHPShopGUI->setInfo($Info);

    // ���������� �������� 2
    $Tab2 = $PHPShopGUI->setPay($data['serial'], false, $data['version'], true);

    $Tab3 = $PHPShopGUI->setTextarea('rule_new', $data['rule'], false, '99%', 320);


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("����� ������� �������", $Tab3), array("����������", $Tab4), array("� ������", $Tab2));

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


