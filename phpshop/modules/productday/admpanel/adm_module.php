<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.productday.productday_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopModules,$PHPShopOrm;
    
    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);
    
    if($_POST['time_new']>24 or empty($_POST['time_new']))
        $_POST['time_new'] = 24;

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id='.$_GET['id']);
    return $action;
}


function actionStart() {
    global $PHPShopGUI,$PHPShopOrm;
    
     //�������
    $data = $PHPShopOrm->select();
    
    $Tab1 = $PHPShopGUI->setField('��� ��������� �����', $PHPShopGUI->setInputText(false, 'time_new', $data['time'],50),2,'��� � ������� 1-24');
    
    $info = '<p>������ ������� ����� ��� �� �������� ����� �� �����. ��� �������������� ������ �������� ���������� ������� � �������� <kbd>����� ���</kbd></p>
    <p>��� ������ ����� �� �������� ����������� ����� <mark>@productDay@</mark></p>';

    $Tab2 = $PHPShopGUI->setInfo($info);



    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true), array("����������", $Tab2),array("� ������", $PHPShopGUI->setPay()));

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