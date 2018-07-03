<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.ymladvance.ymladvance_system"));

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

function actionStart() {
    global $PHPShopGUI,  $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();


    $vendor = unserialize($data['vendor']);


    $Tab1 = $PHPShopGUI->setField('�������������� A', $PHPShopGUI->setInputText('���', 'sort1_tag', $vendor['sort1_tag'], 300, false, 'left') .
            $PHPShopGUI->set_().
            $PHPShopGUI->setInputText('���', 'sort1_name', $vendor['sort1_name'], 300, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� B', $PHPShopGUI->setInputText('���', 'sort2_tag', $vendor['sort2_tag'], 300, false, 'left') .
            $PHPShopGUI->set_().
            $PHPShopGUI->setInputText('���', 'sort2_name', $vendor['sort2_name'], 300, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� C', $PHPShopGUI->setInputText('���', 'sort3_tag', $vendor['sort3_tag'], 300, false, 'left') .
            $PHPShopGUI->set_().
            $PHPShopGUI->setInputText('���', 'sort3_name', $vendor['sort3_name'], 300, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� D', $PHPShopGUI->setInputText('���', 'sort4_tag', $vendor['sort4_tag'], 300, false, 'left') .
            $PHPShopGUI->set_().
            $PHPShopGUI->setInputText('���', 'sort4_name', $vendor['sort4_name'], 300, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������� �� �������������', $PHPShopGUI->setCheckbox('warranty_enabled_new', 1, __('�������� ��� �������� manufacturer_warranty'), $data['warranty_enabled']));
    
    $Tab1.=$PHPShopGUI->setField('��������� �������� ������', $PHPShopGUI->setCheckbox('content_enabled_new', 1, __('�������� ��� ���������� �������� content'), $data['content_enabled']). $PHPShopGUI->setHelp('��������� ��� ������������� PriceLoader'));
    
    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(null, 'password_new', $data['password'], 300).$PHPShopGUI->setHelp('��������� ��� ������������� <a href="http://faq.phpshop.ru/page/batch-loading.html" target="_blamck">PriceLoader</a>'));
    

    $Info = '������ ��������� �������� ������������� ���� ��� ����������� �������� ������� �������� ������������� �� �������������� ���������� ������� � �������.
��������, ��� ��������� "������ � �����" ���������� ������������ <a href="http://help.yandex.ru/partnermarket/?id=1124379#4" target="_blank">������ ��������</a>.
<p>
��� ��������� ����� �������������(������) ������� ������� � ���� ��� ���� <kbd>vendor</kbd>, � � ���� ��� �������������� ������� 
��� ������������ �������������� � ������� (������������� ��� ���� ��������). �������������� ������ ���� �������� � ����������� � ���� �������.
</p>
<p>
��� ��������� ����� ������� ������� ������� � ���� ��� ���� <kbd>param name="����"</kbd>, � � ���� ��� �������������� ������� 
��� ������������ �������������� � ������� (���� ��� ���� ��������). �������������� ������ ���� �������� � ����������� � ���� �������.
</p>
<p>
������ ��������� ������� �������������� ��������� � ���� �������� ��� ������.�������. ��������� � ���� 
http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php ��� ������� �������� �� ������������� <kbd>manufacturer_warranty</kbd>.
</p>
<p>
���� ������ <b>��������</b> �� ������������������� ����� ��������. ��� ������������� ������ ������ �� ���� YML ������ ��� <code>http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php?pas=*******</code>. ��� ������������� ������ ��������� ��� �� �������� ������ � ������.�������.
</p>
';
    $Tab2 = $PHPShopGUI->setInfo($Info);

    $Tab3 = $PHPShopGUI->setPay($data['serial'], false, $data['version'], true);
    
    // ������� ���������
    $Tab3.= $PHPShopGUI->setHistory();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("����������", $Tab2), array("� ������", $Tab3));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $vendor = array(
        'sort1_tag' => $_POST['sort1_tag'],
        'sort1_name' => $_POST['sort1_name'],
        'sort2_tag' => $_POST['sort2_tag'],
        'sort2_name' => $_POST['sort2_name'],
        'sort3_tag' => $_POST['sort3_tag'],
        'sort3_name' => $_POST['sort3_name'],
        'sort4_tag' => $_POST['sort4_tag'],
        'sort4_name' => $_POST['sort4_name'],
    );

    $_POST['vendor_new'] = serialize($vendor);

    if (empty($_POST['warranty_enabled_new']))
        $_POST['warranty_enabled_new'] = 0;
    
       if (empty($_POST['content_enabled_new']))
        $_POST['content_enabled_new'] = 0;


    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>