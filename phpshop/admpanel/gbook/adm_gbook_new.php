<?php

$TitlePage = __('�������� ������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['gbook']);

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopModules, $TitlePage;

    // �������
    $data['datas'] = PHPShopDate::get();
    $data['tema'] = __('����� �� ') . $data['datas'];
    $data['name'] = __('�������������');

    $PHPShopGUI->setActionPanel($TitlePage, false, array('��������� � �������'));

    // datetimepicker
    $PHPShopGUI->addJSFiles('./js/bootstrap-datetimepicker.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-datetimepicker.min.css');


    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('otvet_new');
    $oFCKeditor->Height = '320';
    $oFCKeditor->Value = $data['otvet'];

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����", $PHPShopGUI->setInputDate("datas_new", PHPShopDate::get(time())));

    $Tab1.=$PHPShopGUI->setField("���", $PHPShopGUI->setInput("text", "name_new", $data['name']));

    $Tab1.=$PHPShopGUI->setField("E-mail", $PHPShopGUI->setInput("text", "mail_new", $data['mail']));

    $Tab1.=$PHPShopGUI->setField("����", $PHPShopGUI->setTextarea("tema_new", $data['tema'])) .
            $PHPShopGUI->setField("�����", $PHPShopGUI->setTextarea("otsiv_new", $data['otsiv'], "", '100%', '200'));
    $Tab1.=$PHPShopGUI->setField("������", $PHPShopGUI->setRadio("flag_new", 1, "���.", $data['flag']) . $PHPShopGUI->setRadio("flag_new", 0, "����.", $data['flag']));

    // ���������� �������� 2
    $Tab1.= $PHPShopGUI->setField("�����", $oFCKeditor->AddGUI());

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, null);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.gbook.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    $_POST['datas_new'] = time();

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
    $action = $PHPShopOrm->insert($_POST);
    header('Location: ?path=' . $_GET['path']);
    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>