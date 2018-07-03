<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_payment"));

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;


    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopSystem;

    // ��������� ������ ��������
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_users"));
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('id,money'), array('login' => "='" . $_POST['partnerLogin'] . "'"), false, array('limit' => 1));
    if (is_array($data))
        if ($data['money'] >= $_POST['sum']) {
            $money = $data['money'];
            $total = $money - $_POST['sum'];
            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_users"));
            $PHPShopOrm->debug = false;
            $action = $PHPShopOrm->update(array('money_new' => $total), array('id' => '=' . $data['id']));
        }

    if ($action == true) {

        if (empty($_POST['enabled_new']))
            $_POST['enabled_new'] = 0;
        $_POST['date_done_new'] = time();

        // ��������� ������������
        if (!empty($_POST['sendmail'])) {
            PHPShopObj::loadClass("mail");
            new PHPShopMail($_POST['mail'], $PHPShopSystem->getValue('adminmail2'), '������� ��������� - ' . $PHPShopSystem->getValue('name'), $_POST['content']);
        }

        $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_payment"));
        $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    }


    return array('success' => $action);
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopOrm, $PHPShopModules;
    $PHPShopGUI->field_col = 1;

    // �������
    $PHPShopOrm->sql = 'SELECT a.*, b.login, b.mail, b.money, b.content FROM ' . $PHPShopModules->getParam("base.partner.partner_payment") . ' AS a JOIN ' . $PHPShopModules->getParam("base.partner.partner_users") . ' AS b ON a.partner_id = b.id where a.id=' . $_GET['id'] . ' limit 1';
    $dataArray = $PHPShopOrm->select();
    $data = $dataArray[0];

    $Tab1 = $PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(null, 'login', $data['login']));
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox('enabled_new', 1, '������ ���������', $data['enabled']));
    $Tab1.=$PHPShopGUI->setField('E-mail', $PHPShopGUI->setInputText(null, 'mail', $data['mail']));
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(null, '', $data['money'], 150, $PHPShopSystem->getDefaultValutaCode()));
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(null, 'sum', $data['sum'], 150, $PHPShopSystem->getDefaultValutaCode()));

    // �������������� ����
    $content = unserialize($data['content']);
    $dop = null;

    if (is_array($content))
        foreach ($content as $k => $v) {
            $name = str_replace('dop_', '', $k);
            $dop.=$name . ': ' . $v . '
';
        }
    $dop = substr($dop, 0, strlen($dop) - 1);

    $Tab1.=$PHPShopGUI->setField('�������������', $PHPShopGUI->setTextarea('dop', $dop));

    $message = '���������, ' . $data['login'] . '.
' . $GLOBALS['SysValue']['lang']['partner_money_ready'] . '
��������� ' . $data['sum'] . ' ' . $PHPShopSystem->getDefaultValutaCode();

    $Tab1.=$PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('content', $message, false, false, 200) . $PHPShopGUI->setCheckbox('sendmail', 1, '��������� ��������� ������������', $data['enabled']));



    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "partnerLogin", $data['login'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.modules.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.modules.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>