<?php

PHPShopObj::loadClass("delivery");

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.russianpostcalc.russianpostcalc_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=' . $_GET['id']);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    // ��������
    $PHPShopDeliveryArray = new PHPShopDeliveryArray(array('is_folder'=>"!='1'"));

    $DeliveryArray = $PHPShopDeliveryArray->getArray();
    if (is_array($DeliveryArray))
        foreach ($DeliveryArray as $delivery) {

            // ������� ������������
            if (strpos($delivery['city'], '.')) {
                $name = explode(".", $delivery['city']);
                $delivery['city'] = $name[0];
            }

            $delivery_value[] = array($delivery['city'], $delivery['id'], $data['delivery_id']);
        }

        // ��� �����������
    $type_value[] = array('����� ������ 1 �����', 1, $data['type']);
    $type_value[] = array('������ ������� (�������)', 2, $data['type']);

    $Tab1 = $PHPShopGUI->setField('API ����', $PHPShopGUI->setInputText(false, 'key_new', $data['key'], 300));
    $Tab1.=$PHPShopGUI->setField('API ������', $PHPShopGUI->setInput('password', 'password_new', $data['password'], null, 300));
    $Tab1.=$PHPShopGUI->setField('������ �����������', $PHPShopGUI->setInputText(false, 'delivery_index_new', $data['delivery_index'], 300));
    $Tab1.=$PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('delivery_id_new', $delivery_value, 300));
    $Tab1.=$PHPShopGUI->setField('��� �����������', $PHPShopGUI->setSelect('type_new', $type_value, 300,true));
    $Tab1.= $PHPShopGUI->setField('����������� ��������', $PHPShopGUI->setInputText('�� ����� �������', 'cennost_new', $data['cennost'], 250,'%'));
    $Tab1.= $PHPShopGUI->setField('�������� �������', $PHPShopGUI->setInputText(null, 'fee_new', $data['fee'], 100));
    $Tab1.= $PHPShopGUI->setField('��� �������', $PHPShopGUI->setSelect('fee_type_new', array(array('%', 1, $data['fee_type']), array('���.', 2, $data['fee_type'])), 100, true, false, $search = false, false, $size = 1));

    $info = '<h4>��������� API ����� ����������</h4>
       <ol>
        <li>������������������ � <a href="http://russianpostcalc.ru" target="_blank">Russianpostcalc.ru</a>.
        <li>������� �� ������  <a target="_blank" href="http://russianpostcalc.ru/user/myaddr/api/">��������� API</a>.
        <li>"API ����" � "API ������" ����������� � ����������� ���� �������� ������.
        </ol>
        
      <h4>��������� ������</h4>
 <ol>
        <li>������� ������ ����������� ����������� ��������.
        <li>������� ��� ����������� "����� ������ 1 �����" ��� "������ ������� ������� �����������".
        <li>������� ������� ������� ����������� �������� 0 - 100% �� ����� �������
        <li>������� ��� �������� ��� ��������� ������.
        </ol>
';

    $Tab2 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial = false, false, $data['version'], true);

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