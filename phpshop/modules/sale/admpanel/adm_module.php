<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sale.sale_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $LoadItems;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $price = ($price + (($price * $LoadItems['System']['percent']) / 100));
    $pr = $_POST['mod_sale_price'] / 100;

    switch ($_POST['mod_sale_old']) {
        case "null":
            $price_n = 'price_n=0, price=old_price_sale';
            break;
        case "price":
            $price_n = 'price_n=price';
            break;
        default:
            $price_n = null;
    }

    if (!empty($_POST['mod_sale_price'])) {

        if (!empty($price_n))
            $price_action = ',';
        else
            $price_action = null;

        $price_action.=' price=price' . $_POST['mod_sale_opt'] . '(price*' . $pr . ')';
    }


    $PHPShopOrm->sql = 'update ' . $GLOBALS['SysValue']['base']['products'] . ' set 
    ' . $price_n . $price_action;

    $action = $PHPShopOrm->update();
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $sel_value[] = array('+', '+', false);
    $sel_value[] = array('-', '-', 'selected');
    $Tab1 = $PHPShopGUI->setField('����� ���� ��������', $PHPShopGUI->setInputText(false, 'mod_sale_price', "", '100', '%', 'left') . $PHPShopGUI->set_() . $PHPShopGUI->setSelect('mod_sale_opt', $sel_value, 50, 'left'));

    $sel_value2[] = array('�������', 'none');
    $sel_value2[] = array('��������', 'null');
    $sel_value2[] = array('��������� �������� ��������� ���� �� ���������', 'price');

    $Tab1.=$PHPShopGUI->setField('������ ����', $PHPShopGUI->setSelect('mod_sale_old', $sel_value2, 300));

    $Info = '��� ������� ������ ����������� �������� ����������� �������� "����������" � �������� �������������� ���������� �������� �������.
<p>��� ������ ������ �������� ����� "��������" ������ ����.';
    $Tab1.= $PHPShopGUI->setField('�����', $PHPShopGUI->setInfo($Info));

    $Tab2 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab2, 270));

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