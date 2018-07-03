<?php

PHPShopObj::loadClass('delivery');


$TitlePage = __('�������� ������������� ������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['search_base']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules;


    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("������������� ������"), false, array('��������� � �������'));
    
    // �������� ������
    $data=$_GET['data'];


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("������:", $PHPShopGUI->setInputText(false, "name_new", str_replace(array('i', 'ii'), array('', ','), $data['name'])) . $PHPShopGUI->setRadio("enabled_new", 1, "����������", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "������", $data['enabled']));
    $Tab1.= $PHPShopGUI->setField("ID �������:", $PHPShopGUI->setInputText(false, "uid_new", $data['uid']) . $PHPShopGUI->setHelp('������� �������������� (ID) ������� ����� ������� ��� ������� (100,101)'));


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.order.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    if (strpos($_POST['name_new'], ',')) {
        $name_new = null;
        $name = explode(",", $_POST['name_new']);
        foreach ($name as $v)
            $name_new.="i" . $v . "i";

        $_POST['name_new'] = $name_new;
    }
    else
        $_POST['name_new'] = "i" . $_POST['name_new'] . "i";

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    header('Location: ?path=' . $_GET['path']);

    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>