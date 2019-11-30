<?php

$TitlePage = __('�������� �������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['order_status']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules,$PHPShopSystem,$TitlePage;

    // ��������� ������
    $data['name'] = '����� ������';
    $data['color'] = '#000000';
    $data['mail_action']=1;


    // bootstrap-colorpicker
    $PHPShopGUI->addCSSFiles('./css/bootstrap-colorpicker.min.css');
    $PHPShopGUI->addJSFiles('./js/bootstrap-colorpicker.min.js');
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel($TitlePage, false, array('������� � �������������', '��������� � �������'));


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("��������", $PHPShopGUI->setInput("text", "name_new", $data['name'], null, 500));


    $Tab1.=$PHPShopGUI->setField('����', '<div class="input-group color" style="width:200px">
    <input type="text" name="color_new" value="' . $data['color'] . '" class="form-control input-sm">
    <span class="input-group-addon input-sm"><i></i></span></div>');

    $Tab1.=$PHPShopGUI->setField("�������������", $PHPShopGUI->setCheckbox('mail_action_new', 1, 'E-mail ����������� ���������� � ����� ������� ������', $data['mail_action']) . '<br>' .
             $PHPShopGUI->setCheckbox('sms_action_new', 1, 'SMS ����������� ���������� � ����� ������� ������', $data['sms_action']).'<br>'.
            $PHPShopGUI->setCheckbox("sklad_action_new", 1, "�������� �� ������ ������� � ������", $data['sklad_action']) . '<br>' .
            $PHPShopGUI->setCheckbox("cumulative_action_new", 1, "���� ������ ����������", $data['cumulative_action']).$PHPShopGUI->setHelp(__('����� ������ ������������ ����� ��������� � ������������� �����, ��������� �').' <a href="?path=shopusers.status"><span class="glyphicon glyphicon-share-alt"></span>'.__('�������� � ������� �����������').'</a>',false,false)
    );
    
        // ���������
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('mail_message_new');
    $oFCKeditor->Height = '350';
    $oFCKeditor->Value = $data['mail_message'];
    
    $Tab1.=$PHPShopGUI->setField("����� ������:", $oFCKeditor->AddGUI() . $PHPShopGUI->setHelp('����������: <code>@ouid@</code> - ����� ������, <code>@date@</code> - ���� ������, <code>@status@</code> - ����� ������ ������, <code>@fio@</code> - ��� ����������, <code>@sum@</code> - ��������� ������, <code>@manager@</code> - ����������'));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.order.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;


    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    if ($_POST['saveID'] == '������� � �������������')
        header('Location: ?path=' . $_GET['path'] . '&id=' . $action);
    else
        header('Location: ?path=' . $_GET['path']);

    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>
