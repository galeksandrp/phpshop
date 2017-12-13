<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

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
    global $PHPShopGUI, $PHPShopSystem, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ ����������� �������� � ������.������";
    //$PHPShopGUI->size = "500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    $vendor = unserialize($data['vendor']);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '������.������'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");


    $Tab1 = $PHPShopGUI->setField('�������������� A', $PHPShopGUI->setInputText('��� ����', 'sort1_tag', $vendor['sort1_tag'], 180, false, 'left') .
            $PHPShopGUI->setInputText('��� ��������������', 'sort1_name', $vendor['sort1_name'], 180, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� B', $PHPShopGUI->setInputText('��� ����', 'sort2_tag', $vendor['sort2_tag'], 180, false, 'left') .
            $PHPShopGUI->setInputText('��� ��������������', 'sort2_name', $vendor['sort2_name'], 180, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� C', $PHPShopGUI->setInputText('��� ����', 'sort3_tag', $vendor['sort3_tag'], 180, false, 'left') .
            $PHPShopGUI->setInputText('��� ��������������', 'sort3_name', $vendor['sort3_name'], 180, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������������� D', $PHPShopGUI->setInputText('��� ����', 'sort4_tag', $vendor['sort4_tag'], 180, false, 'left') .
            $PHPShopGUI->setInputText('��� ��������������', 'sort4_name', $vendor['sort4_name'], 180, false, 'left')
    );

    $Tab1.=$PHPShopGUI->setField('�������� �� �������������', $PHPShopGUI->setCheckbox('warranty_enabled_new', 1, __('�������� ��� �������� manufacturer_warranty'), $warranty_enabled), 'left');
    
    $Tab1.=$PHPShopGUI->setField('��������� �������� ������', $PHPShopGUI->setCheckbox('content_enabled_new', 1, __('�������� ��� ���������� �������� content'), $content_enabled), 'left');
    
    $Tab1.=$PHPShopGUI->setLine().$PHPShopGUI->setField('������', $PHPShopGUI->setInputText(null, 'password_new', $data['password'], '98%', false));
    


    $Info = '
������ ��������� �������� ������������� ���� ��� ����������� �������� ������� �������� ������������� �� �������������� ���������� ������� � �������.
��������, ��� ��������� "������ � �����" ���������� ������������ "<a href="http://help.yandex.ru/partnermarket/?id=1124379#4" target="_blank">������ ��������</a>".
<p>
��� ��������� ����� �������������(������) ������� ������� � ���� ��� ���� <b>vendor</b>, � � ���� ��� �������������� ������� 
��� ������������ �������������� � ������� (������������� ��� ���� ��������). �������������� ������ ���� �������� � ����������� � ���� �������.
</p>
<p>
��� ��������� ����� ������� ������� ������� � ���� ��� ���� <b>param name="����"</b>, � � ���� ��� �������������� ������� 
��� ������������ �������������� � ������� (���� ��� ���� ��������). �������������� ������ ���� �������� � ����������� � ���� �������.
</p>
<p>
������ ��������� ������� �������������� ��������� � ���� �������� ��� ������.�������. ��������� � ���� 
http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php ��� ������� �������� �� ������������� <b>manufacturer_warranty</b>.
</p>
<p>
���� ������ <b>��������</b> �� ������������������� ����� ��������. ��� ������������� ������ ������ �� ���� YML ������ ���: http://' . $_SERVER['SERVER_NAME'] . '/yml/yandex.php?pas=*******. ��� ������������� ������ ��������� ��� �� �������� ������ � ������.�������.
</p>
';
    $Tab2 = $PHPShopGUI->setInfo($Info, 280, '98%');

    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);
    
    // ������� ���������
    $Tab3.= $PHPShopGUI->setLine('<br>').$PHPShopGUI->setHistory();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 300), array("����������", $Tab2, 300), array("� ������", $Tab3, 300));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

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
    return $action;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>