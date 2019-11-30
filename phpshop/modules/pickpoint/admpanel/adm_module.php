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

    $type_service_value = array(
        array('STD - ��������, �������� ��������������� ������ ��� ������ ������ �� �����', 'STD', $data['type_service']),
        array('STDCOD - �������� � ������� ������ �� �����, �.�. ���������� ������', 'STDCOD', $data['type_service'])
    );

    $type_reception_value = array (
        array('CUR � ���� ����������� �������� PickPoint', 'CUR', $data['type_reception']),
        array('WIN � ��������������� ������ ����������� � ���� ������ �� ������������� ����� PickPoint', 'WIN', $data['type_reception']),
        array('APTCON � ����� ����������� ��������������� � 1 ������ � ��������� �����', 'APTCON', $data['type_reception']),
        array('APT � ��������������� ������ ����������� �� ����������', 'APT', $data['type_reception'])
    );

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
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $Tab2), array("� ������", $Tab3));

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