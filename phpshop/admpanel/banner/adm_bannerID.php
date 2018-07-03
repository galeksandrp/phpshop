<?php

$TitlePage = __('�������������� �������').' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['banner']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . $_GET['id']));
    $PHPShopGUI->field_col = 1;

    $PHPShopGUI->setActionPanel(__("�������������� �������").": " . $data['name'], array('�������'), array('���������', '��������� � �������'));

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("���", $PHPShopGUI->setInput("text", "name_new", $data['name'], false, 500)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("flag_new", 1, "��������", $data['flag']) . $PHPShopGUI->setRadio("flag_new", 0, "���������", $data['flag'])) .
            $PHPShopGUI->setField("���������:", $PHPShopGUI->setInput("text", "dir_new", $data['dir']) .
                    $PHPShopGUI->setHelp('* ������: /,/page/,/shop/UID_1.html. ����� ������� ��������� ������� ����� �������.')
    );

    // �������� 
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->Value = $data['content'];

    // ���������� �������� 2
    $Tab1.= $PHPShopGUI->setField("����������", $oFCKeditor->AddGUI());


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);


    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $_GET['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "btn-danger", "actionDelete.banner.edit") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "btn-success", "actionUpdate.banner.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.banner.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array('success'=>$action);
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

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success'=> $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>
