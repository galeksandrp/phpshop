<?php

$TitlePage = __("���������");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
    $bank = unserialize($data['bank']);

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./system/gui/system.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('���������'));


    $PHPShopGUI->_CODE = '<p></p>' . $PHPShopGUI->setField(__("�������� ��������"), $PHPShopGUI->setInputText(null, "name_new", $data['name']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText(null, "company_new", $data['company']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText(null, "tel_new", $data['tel']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("������������ �����������"), $PHPShopGUI->setInputText(null, "bank[org_name]", $bank['org_name']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText(null, "bank[org_ur_adres]", $bank['org_ur_adres']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText(null, "bank[org_adres]", $bank['org_adres']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank[org_inn]", $bank['org_inn'], 300));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank[org_kpp]", $bank['org_kpp'], 300));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("� ����� �����������"), $PHPShopGUI->setInputText(null, "bank[org_schet]", $bank['org_schet'], 300));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setLine() . $PHPShopGUI->setField(__("������������ ����"), $PHPShopGUI->setInputText(null, "bank[org_bank]", $bank['org_bank'], 300));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText(null, "bank[org_bic]", $bank['org_bic'], 300));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(__("� ����� �����"), $PHPShopGUI->setInputText(null, "bank[org_bank_schet]", $bank['org_bank_schet'], 300));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);


    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.system.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.system.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $sidebarleft[] = array('title' => '���������', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './system/'));
    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->Compile(2);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select();
    $bank = unserialize($data['bank']);


    if (is_array($_POST['bank']))
        foreach ($_POST['bank'] as $key => $val)
            $bank[$key] = $val;

    $_POST['bank_new'] = serialize($bank);


    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));


    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();
?>