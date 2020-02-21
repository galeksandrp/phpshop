<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));
$TitlePage = __('�������������� ������ ') . ' #' . $_GET['id'];

/**
 * ��������� ������ ������
 */
function setNum() {
    global $PHPShopBase;

    // ���-�� ������ � ��������� ������ �_XX, �� ��������� 2
    $format = $PHPShopBase->getParam('my.order_prefix_format');
    if (empty($format))
        $format = 2;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $row = $PHPShopOrm->select(array('uid'), false, array('order' => 'id desc'), array('limit' => 1));
    $last = $row['uid'];
    $all_num = explode("-", $last);
    $ferst_num = $all_num[0];
    $order_num = $ferst_num + 1;
    $order_num = $order_num . "-" . substr(abs(crc32(uniqid(session_id()))), 0, $format);
    return $order_num;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/bootstrap-datetimepicker.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    $PHPShopGUI->setActionPanel(__("������") . ' �' . $data['id'], false, array('��������� � �������'), false);

    $Tab1 = $PHPShopGUI->setField("����", $PHPShopGUI->setInputDate("date_new", PHPShopDate::dataV($data['date'], false)));
    $Tab1 .= $PHPShopGUI->setField('���: ', $PHPShopGUI->setInputText(false, 'name_new', $data['name'], 600), false, 'IP: ' . $data['ip']);
    $Tab1 .= $PHPShopGUI->setField('�������:', $PHPShopGUI->setInputText(false, 'tel_new', $data['tel'], 300));
    $Tab1 .= $PHPShopGUI->setField('����� ������:', $PHPShopGUI->setInputText(null, 'time_start_new', $data['time_start'] . ' ' . $data['time_end'], 300));
    $Tab1 .= $PHPShopGUI->setField('���������', $PHPShopGUI->setTextarea('message_new', $data['message'], false, 600));

    $status_atrray[] = array('�����', 1, $data['status']);
    $status_atrray[] = array('�����������', 2, $data['status']);
    $status_atrray[] = array('����c�����', 3, $data['status']);
    $status_atrray[] = array('��������', 4, $data['status']);
    $status_atrray[] = array('��������� � �����', 5, $data['status']);

    $Tab1 .= $PHPShopGUI->setField('������', $PHPShopGUI->setSelect('status_new', $status_atrray, 300).$PHPShopGUI->setHelp('������ "��������� � �����" ������� ������ ����� � ������� �������'));
    $Tab1 .= $PHPShopGUI->setInput("hidden", "status", $data['status']);


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
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
    global $PHPShopModules;

    $_POST['date_new'] = PHPShopDate::GetUnixTime($_POST['date_new']);
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.returncall.returncall_jurnal"));
    $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));

    // ����� �����
    if ($_POST['status_new'] == 5 and $_POST['status'] != 5) {

        // ������ ������� ������ ��� ��������� �������������� ������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $data['fio_new'] = $_POST['name_new'];
        $data['tel_new'] = $_POST['tel_new'];
        $data['datas_new'] = time();
        $data['uid_new'] = setNum();
        $data['dop_info_new'] = '������ � ����� �' . $_POST['rowID'] . ' ' . $_POST['message_new'] . ' ' . $_POST['time_start_new'];
        $id = $PHPShopOrm->insert($data);
        header('Location: ?path=order&id=' . $id);
        return true;
    } else
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