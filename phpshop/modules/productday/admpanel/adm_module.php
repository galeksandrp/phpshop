<?php

// SQL
//$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.productoption.productoption_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = true;
    header('Location: ?path=modules&install=check');
    return $action;
}

function checkSelect($val) {
    $value[] = array('text', 'text', $val);
    $value[] = array('textarea', 'textarea', $val);
    //$value[] = array('checkbox', 'checkbox', $val);
    $value[] = array('radio', 'radio', $val);
    return $value;
}

function actionStart() {
    global $PHPShopGUI,$select_name;
    
    $PHPShopGUI->setActionPanel(__("��������� ������") . ' <span id="module-name">' . ucfirst($_GET['id']).'</span>', $select_name, false);


    $info = '<p>������ ������� ����� ��� �� �������� �����. ��� �������������� ������ �������� ���������� ������� � �������� <kbd>����� ���</kbd></p>
    <p>��� ������ ����� �� �������� ����������� ����� <mark>@productDay@</mark></p>';

    $Tab1 = $PHPShopGUI->setInfo($info);



    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("� ������", $PHPShopGUI->setPay()));

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
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>