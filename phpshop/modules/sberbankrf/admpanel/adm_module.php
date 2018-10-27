<?php
PHPShopObj::loadClass('order');

// SQL
$PHPShopOrm = new PHPShopOrm("phpshop_modules_sberbankrf_system");
// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$PHPShopModules;
    
    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);
    $PHPShopOrm->debug = false;

    if (empty($_POST["dev_mode_new"]))
        $_POST["dev_mode_new"] = 0;

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id=' . $_GET['id']);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    $Tab1 = $PHPShopGUI->setInfo('<p>������ ���������� ��������-�������� � ��������� ������ ��������� ������, ��������� ��������� ������ ������ ������ ����� �������� ������.
 ����� ������� ������, ���������� ���������� ����������� ��������� �� ��������������� �������. ����� ���������� ��������� ���������� ������� �� �������� ����� ��������� ������ https://3dsec.sberbank.ru</p>');

    $Tab2 = $PHPShopGUI->setField('����� ��������', $PHPShopGUI->setInputText(false, 'login_new', $data['login'], 300));
    $Tab2 .= $PHPShopGUI->setField('������ ��������', $PHPShopGUI->setInput("password", 'password_new', $data['password'], false, 300));

    // ������� ���������������
    $tax_system = array (
        array("����� ������� ���������������", 0, $data["taxationSystem"]),
        array("���������� ������� ��������������� (�����)", 1, $data["taxationSystem"]),
        array("���������� ������� ��������������� (����� ����� ������)", 2, $data["taxationSystem"]),
        array("������ ����� �� ��������� �����", 3, $data["taxationSystem"]),
        array("������ �������������������� �����", 4, $data["taxationSystem"]),
        array("��������� ������� ���������������", 5, $data["taxationSystem"])
    );
    $Tab2 .= $PHPShopGUI->setField('C������ ���������������', $PHPShopGUI->setSelect('taxationSystem_new', $tax_system, 300));

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['status']);

    // ������ ������
    $Tab2 .= $PHPShopGUI->setField('������ ��� �������', $PHPShopGUI->setSelect('status_new', $order_status_value, 250));

    $Tab2 .= $PHPShopGUI->setField('����� ����������', $PHPShopGUI->setCheckbox("dev_mode_new", 1, "�������� ������ �� �������� ����� ��������� ��", $data["dev_mode"]));

    $Tab2 .= $PHPShopGUI->setField('��������� ��������������� ��������', $PHPShopGUI->setTextarea('title_sub_new', $data['title_sub']));

    // ����������
    $info = '
        <h4>��������� ������</h4>
        <ol>
<li>������������ ����������� ��������� � ��������� ������� �� ���������� ��</li>
<li>�� �������� ��������� ������ ��������������� ���������� �� ����� API �������� (*********-api) � ������ ��������.</li>
<li>�� ����� ������������ �������� "����� ����������", ������ ����� ������������ �� �������� ����� ��������� ��</li>
<li>��� �������� ������ � ������� �����, ��������� "����� ����������"</a></li>
</ol>
';

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("���������", $Tab2, true), array("����������", $info, true), array("� ������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>