<?php

$TitlePage = __('�������� ������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['currency']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    $PHPShopGUI->field_col = 2;
    
    
    $PHPShopGUI->setActionPanel(__("�������� ������"), false, array('��������� � �������'));
    

    // �������
    $data['name']='����� ������';
    $data['kurs']=1;
    $data['enabled']=1;

    $Tab1 = $PHPShopGUI->setField("��������:", $PHPShopGUI->setInputText(null, "name_new", $data['name'], 300));
    $Tab1 .= $PHPShopGUI->setField("�����������:", $PHPShopGUI->setInputText(null, "code_new", $data['code'], 300));
    $Tab1 .= $PHPShopGUI->setField("ISO:", $PHPShopGUI->setInputText(null, "iso_new", $data['iso'], 300),1,'��� ������ �� ��������� ISO (USD,RUB,UAH)');
    $Tab1 .= $PHPShopGUI->setField("����:", $PHPShopGUI->setInputText(null, "kurs_new", $data['kurs'], 300),1,'�������� ���� ������������ ����� ($ = 0.015)');
    $Tab1 .= $PHPShopGUI->setField("���������:", $PHPShopGUI->setInputText(null, "num_new", $data['num'], 50));
    $Tab1.=$PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled']));
    
    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350));


    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.currency.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

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
