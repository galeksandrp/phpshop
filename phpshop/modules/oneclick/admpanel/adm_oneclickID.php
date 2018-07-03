<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.oneclick.oneclick_jurnal"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    $_POST['date_new']=PHPShopDate::GetUnixTime($_POST['date_new']);
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
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

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;
    
        // ����� ����
    $PHPShopGUI->addJSFiles('./js/bootstrap-datetimepicker.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));
    $PHPShopGUI->field_col = 1;

    $Tab1 = $PHPShopGUI->setField('����', $PHPShopGUI->setInputDate("date_new", PHPShopDate::get($data['date'])));
    $Tab1.= $PHPShopGUI->setField('���', $PHPShopGUI->setInputText($data['ip'], 'name_new', $data['name']));
    $Tab1.= $PHPShopGUI->setField('�������', $PHPShopGUI->setInputText(false, 'tel_new', $data['tel']));
    $Tab1.= $PHPShopGUI->setField('�������', $PHPShopGUI->setInputText('<a href="?path=product&id='.$data['product_id'].'">ID:' . $data['product_id'].'</a>', 'product_name_new', $data['product_name']));
    $Tab1.=$PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('message_new', $data['message']));

    $status_atrray[] = array('�����', 1, $data['status']);
    $status_atrray[] = array('�����������', 2, $data['status']);
    $status_atrray[] = array('����c�����', 3, $data['status']);
    $status_atrray[] = array('��������', 4, $data['status']);

    $Tab1.=$PHPShopGUI->setField('������', $PHPShopGUI->setSelect('status_new', $status_atrray, 150));


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.modules.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.modules.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
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