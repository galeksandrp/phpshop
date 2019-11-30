<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    $_POST['date_new'] = PHPShopDate::GetUnixTime($_POST['date_new']);
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/bootstrap-datetimepicker.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    $Tab1 = $PHPShopGUI->setField("����", $PHPShopGUI->setInputDate("date_new", PHPShopDate::dataV($data['date'], false)));
    $Tab1.= $PHPShopGUI->setField('���: ', $PHPShopGUI->setInputText(false, 'name_new', $data['name'],600),false,'IP: '.$data['ip']);
    $Tab1.= $PHPShopGUI->setField('�������:', $PHPShopGUI->setInputText(false, 'tel_new', $data['tel'], 300));
    $Tab1.= $PHPShopGUI->setField('����� ������:', $PHPShopGUI->setInputText(null, 'time_start_new', $data['time_start']. ' '.$data['time_end'], 300));
    $Tab1.=$PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('message_new', $data['message'],false,600));

    $status_atrray[] = array('�����', 1, $data['status']);
    $status_atrray[] = array('�����������', 2, $data['status']);
    $status_atrray[] = array('����c�����', 3, $data['status']);
    $status_atrray[] = array('��������', 4, $data['status']);

    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setSelect('status_new', $status_atrray, 200));


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.modules.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.modules.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;


    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>