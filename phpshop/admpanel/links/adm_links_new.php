<?php

$TitlePage = __('�������� c�����');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['links']);

// ��������� �����
function setSelectChek($n) {
    $i = 1;
    while ($i <= 10) {
        if ($n == $i)
            $s = "selected";
        else
            $s = "";
        $select[] = array($i, $i, $s);
        $i++;
    }
    return $select;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopModules,$TitlePage;

    $PHPShopGUI->setActionPanel($TitlePage, false, array('��������� � �������'));

    $Select1 = setSelectChek(1);
    $PHPShopGUI->field_col = 2;


    // ���������� �������� 1
    $Tab1 =
            $PHPShopGUI->setField("������", $PHPShopGUI->setTextarea("name_new", '����� ������')) .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setSelect("num_new", $Select1, 50)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "��������", 1) . $PHPShopGUI->setRadio("enabled_new", 0, "���������", 1)) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setInput("text", "link_new", '')) .
            $PHPShopGUI->setField("��������", $PHPShopGUI->setTextarea("opis_new", ''));


    $Tab1.=$PHPShopGUI->setField("��� ������", $PHPShopGUI->setTextarea("image_new", ''));
    
    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, null);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.links.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    if (!empty($_POST['otsiv_new']))
        $_POST['flag_new'] = 1;
    $action = $PHPShopOrm->insert($_POST);
    header('Location: ?path=' . $_GET['path']);
}

// ��������� ������� 
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>