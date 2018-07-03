<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.pickpoint.pickpoint_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    if ($data['type_service'] == 'STD')
        $s0 = 'selected';
    else
        $s1 = 'selected';

    $type_service_value[] = array('STD - ��������, �������� ��������������� ������ ��� ������ ������ �� �����', 'STD', $s0);
    $type_service_value[] = array('STDCOD - �������� � ������� ������ �� �����, �.�. ���������� ������', 'STDCOD', $s1);


    switch ($data['type_reception']) {
        case "CUR":
            $s2 = 'selected';
            break;
        case "WIN":
            $s3 = 'selected';
            break;
        case "APTCON":
            $s4 = 'selected';
            break;
        case "APT":
            $s5 = 'selected';
            break;
    }

    $type_reception_value[] = array('CUR � ���� ����������� �������� PickPoint', 'CUR', $s2);
    $type_reception_value[] = array('WIN � ��������������� ������ ����������� � ���� ������ �� ������������� ����� PickPoint', 'WIN', $s3);
    $type_reception_value[] = array('APTCON � ����� ����������� ��������������� � 1 ������ � ��������� �����', 'APTCON', $s4);
    $type_reception_value[] = array('APT � ��������������� ������ ����������� �� ����������', 'APT', $s4);


    $Tab1 = $PHPShopGUI->setField('��� �������� PickPoint', $PHPShopGUI->setInputText(false, 'city_new', $data['city']) . $PHPShopGUI->setHelp('�������� ������ ���� ������� � ���� � ��������� �� ���.'));
    $Tab1.=$PHPShopGUI->setField('����� ������', $PHPShopGUI->setInputText(false, 'name_new', $data['name'], 300));

    $Tab1.=$PHPShopGUI->setField('���� �����', $PHPShopGUI->setSelect('type_service_new', $type_service_value,400));
    $Tab1.=$PHPShopGUI->setField('��� ������', $PHPShopGUI->setSelect('type_reception_new', $type_reception_value,400));

    $info = '���������� ������� ����� ��������, � ������ ������� ���� ����� \'PickPoint\'. ���� ��� ��c����� ��������� ��������, ��
        ����� ���-������� ��������� ����� ������� � ���������� ����� ������ � ���� \'��� �������� PickPoint\'. ��� �������, ��� �������� �����
        PickPoint, ����� ������ �������� �������� � ���� ��������, � ������� ����� PickPoint ������������ � ����� ��������. ��� ������� �� ��������� �
        ������ �������� ��������.
<p>
����� ������ �� ����� �������������� ������ ������ � ��������� XML ������ �������� ������ � ������ ���������� ������� <a href="http://
PickPoint.ru?from=phpshop_mod" target="_blank">PickPoint<a>.
</p> ';

    $Tab2 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("����������", $Tab2, 270), array("� ������", $Tab3, 270));

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
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>