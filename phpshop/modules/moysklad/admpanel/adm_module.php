<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.moysklad.moysklad_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $TitlePage, $select_name;

    $PHPShopGUI->action_button['���������'] = array(
        'name' => '��������� ����',
        'action' => '../modules/moysklad/admpanel/file.php',
        'class' => 'btn  btn-default btn-sm navbar-btn btn-action-panel-blank',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-export'
    );
    
        $PHPShopGUI->action_button['����������������'] = array(
        'name' => '����������������',
        'action' => '../modules/moysklad/cron/stock.php',
        'class' => 'btn  btn-default btn-sm navbar-btn btn-action-panel-blank',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-refresh'
    );
    
    $PHPShopGUI->setActionPanel($TitlePage, $select_name, array('���������', '����������������', '��������� � �������'));


    // �������
    $data = $PHPShopOrm->select();

    $Tab1.=$PHPShopGUI->setField('������������', $PHPShopGUI->setInputText(false, 'merchant_user_new', $data['merchant_user']));
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInput('password', 'merchant_pwd_new', $data['merchant_pwd']));

    // ����� �������������
    $stock_value[] = array('��� ������', 'ALL_STOCK', $data['stock_option']);
    $stock_value[] = array('������ ������������� �������', 'POSITIVE_ONLY', $data['stock_option']);
    $stock_value[] = array('������ ������������� �������, � ������ �������', 'POSITIVE_INCLUDING_RESERVE_ONLY', $data['stock_option']);
    $stock_value[] = array('������ ������������� ��������', 'NEGATIVE_ONLY', $data['stock_option']);
    $stock_value[] = array('������������� � ������������� ��������', 'NON_EMPTY', $data['stock_option']);
    $stock_value[] = array('���� ������������ �������', 'UNDER_MINIMUM_BALANCE_ONLY', $data['stock_option']);
    $stock_value[] = array('� ������ �������', 'USE_RESERVES', $data['stock_option']);

    $Tab1.=$PHPShopGUI->setField('��� ����������� � ��������', $PHPShopGUI->setInputText(false, 'org_code_new', $data['org_code'], 300));

    // ���
    $Tab1.=$PHPShopGUI->setField('���', $PHPShopGUI->setInputText(false, 'nds_new', $data['nds'], 100, '%'));

    // ����� �������������
    $Tab1.= $PHPShopGUI->setField('������������� ������', $PHPShopGUI->setSelect('stock_option_new', $stock_value, 310) . $PHPShopGUI->setHelp('������ �� �������� � ����� ������ ��� ������������� ������.'));

    $Info = "��� �������������� ������������� ��������� ���������� ������ 'PHPShop Cron' � �������� � ���� ����� ������ � �������
        ������������ �����:  <code>phpshop/modules/moysklad/cron/stock.php</code>. ��� �������� ����� ������ � <b>Unix Cron</b>' ����������� �������:  <code>wget http://" . $_SERVER['SERVER_NAME'] . "/phpshop/modules/moysklad/cron/stock.php</code>";

    $Tab2= $PHPShopGUI->setInfo($Info, 100, '97%');

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("����������", $Tab2), array("� ������", $Tab3));

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