<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.stockgallery.stockgallery_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    $action = $PHPShopOrm->update($_POST);
     header('Location: ?path=modules&install=check');
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

           // bootstrap-colorpicker
    $PHPShopGUI->addCSSFiles('./css/bootstrap-colorpicker.min.css');
    $PHPShopGUI->addJSFiles('./js/bootstrap-colorpicker.min.js');

    $Tab1 = $PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox('enabled_new', 1, '�������� � ����� ��������������� �� ������� ��������', $data['enabled']));
    $Tab1.=$PHPShopGUI->setField('������ ��������', $PHPShopGUI->setInputText(false, 'width_new', $data['width'], 100, 'px'));
    $Tab1.=$PHPShopGUI->setField('������ ����������� ������', $PHPShopGUI->setInputText(false, 'img_width_new', $data['img_width'], 100, 'px'));
    $Tab1.=$PHPShopGUI->setField('������ ����������� ������', $PHPShopGUI->setInputText(false, 'img_height_new', $data['img_height'], 100, 'px'));
    $Tab1.=$PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(false, 'border_new', $data['border'], 100, 'px'));
    $Tab1.=$PHPShopGUI->setField('���� �����', $PHPShopGUI->setInputColor('border_color_new', $data['border_color']));
    $Tab1.=$PHPShopGUI->setField('���������� �������', $PHPShopGUI->setInputText(false, 'limit_new', $data['limit'], 100));

    $info = '��� ������������ ������� �������� ������� ������� ������� ������ "�� ��������" � � ������ ������ �������� ����������
        <kbd>@stockgallery@</kbd> � ���� ������. ��� ����� ������ ���������� �������� ��������� ����, ������������� � ����� ��������� ���� (������� - ��������� - ������ - ���������� ��������),
        ������� ����� <kbd>@stockgallery@</kbd> - ������ ���� ����� ���������� � ������ ��� �����.
        <p>��� �������������� ����� ������ �������������� ������ <code>phpshop/modules/stockgallery/templates/stockgallery_forma.tpl</code></p>';

    $Tab2 = $PHPShopGUI->setInfo($info);
    
    // ���������� �������� 3
    $Tab3 = $PHPShopGUI->setPay();
    

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1),array("����������",$Tab2), array("� ������", $Tab3));

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