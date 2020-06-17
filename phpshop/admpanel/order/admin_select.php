<?php

$TitlePage = __("�������� ������");
PHPShopObj::loadClass('valuta');
PHPShopObj::loadClass('category');
PHPShopObj::loadClass('order');

$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);


/**
 * ��������� ����� - 2 ���
 */
function actionOptionSave() {

    // ������ ��������� �����
    if (is_array($_POST['option'])) {

        $memory = json_decode($_COOKIE['check_memory'], true);
        unset($memory['order.option']);
        foreach ($_POST['option'] as $k => $v) {
            $memory['order.option'][$k] = $v;
        }
        if (is_array($memory))
            setcookie("check_memory", json_encode($memory), time() + 3600000 * 6, $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/admpanel/');
    }

    return array('success' => true);
}

/**
 * ��������� ����� - 1 ���
 */
function actionOption() {
    global $PHPShopInterface;

    // ������ ��������� �����
    if (!empty($_COOKIE['check_memory'])) {
        $memory = json_decode($_COOKIE['check_memory'], true);
    }
    if (!is_array($memory['order.option'])) {
        $memory['order.option']['uid'] = 1;
        $memory['order.option']['statusi'] = 1;
        $memory['order.option']['datas'] = 1;
        $memory['order.option']['fio'] = 1;
        $memory['order.option']['menu'] = 1;
        $memory['order.option']['tel'] = 1;
        $memory['order.option']['sum'] = 1;
        $memory['order.option']['city'] = 0;
        $memory['order.option']['adres'] = 0;
        $memory['order.option']['org'] = 0;
        $memory['order.option']['comment'] = 0;
        $memory['order.option']['cart'] = 0;
        $memory['order.option']['tracking'] = 0;
        $memory['order.option']['admin'] = 0;
    }

    $message = '<p class="text-muted">'.__('�� ������ �������� �������� ����� � ������� ����������� �������').'</p>';

    $searchforma = $message .
            $PHPShopInterface->setCheckbox('uid', 1, '� ������', $memory['order.option']['uid']) .
            $PHPShopInterface->setCheckbox('statusi', 1, '������', $memory['order.option']['statusi']) .
            $PHPShopInterface->setCheckbox('datas', 1, '����', $memory['order.option']['datas']) .
            $PHPShopInterface->setCheckbox('id', 1, 'ID', $memory['order.option']['id']) .
            $PHPShopInterface->setCheckbox('fio', 1, '����������', $memory['order.option']['fio']) .
            $PHPShopInterface->setCheckbox('sum', 1, '�����', $memory['order.option']['sum']) .
            $PHPShopInterface->setCheckbox('tel', 1, '�������', $memory['order.option']['tel']) . '<br>' .
            $PHPShopInterface->setCheckbox('menu', 1, '����� ����', $memory['order.option']['menu']) .  
            $PHPShopInterface->setCheckbox('discount', 1, '������', $memory['order.option']['discount']).
            $PHPShopInterface->setCheckbox('city', 1, '�����', $memory['order.option']['city']).
            $PHPShopInterface->setCheckbox('adres', 1, '�����', $memory['order.option']['adres']).
            $PHPShopInterface->setCheckbox('org', 1, '��������', $memory['order.option']['org']) .
            $PHPShopInterface->setCheckbox('comment', 1, '�����������', $memory['order.option']['comment']).'<br>'.
            $PHPShopInterface->setCheckbox('cart', 1, '�������', $memory['order.option']['cart']). 
            $PHPShopInterface->setCheckbox('tracking', 1, 'Tracking', $memory['order.option']['tracking']).
            $PHPShopInterface->setCheckbox('admin', 1, '��������', $memory['order.option']['admin'])
            ;

    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => 'order'));
    $searchforma.='<p class="clearfix"> </p>';


    $PHPShopInterface->_CODE.=$searchforma;

    exit($PHPShopInterface->getContent() . '<p class="clearfix"> </p>');
}

// ����������� ���������� ������ ����
function getKeyView($val) {

    if (strpos($val['Type'], "(")) {
        $a = explode("(", $val['Type']);
        $b = $a[0];
    }
    else
        $b = $val['Type'];
    $key_view = array(
        'varchar' => array('type' => 'text', 'name' => $val['Field'] . '_new'),
        'text' => array('type' => 'textarea', 'height' => 150, 'name' => $val['Field'] . '_new'),
        'int' => array('type' => 'text', 'size' => 100, 'name' => $val['Field'] . '_new'),
        'float' => array('type' => 'text', 'size' => 200, 'name' => $val['Field'] . '_new'),
        'enum' => array('type' => 'checkbox', 'name' => $val['Field'] . '_new', 'value' => 1, 'caption' => '���.'),
    );

    if (!empty($key_view[$b]))
        return $key_view[$b];
    else
        return array('type' => 'text', 'name' => $val['Field'] . '_new');
}

// �������� �����
$key_name = array(
    'id' => 'Id',
    'status' => '���������� ���������',
    'seller' => '��������� � CRM',
    'country' => '������',
    'statusi' => '<b>������</b>',
    'state' => '������/����',
    'city' => '�����',
    'index' => '������',
    'fio' => '���',
    'tel' => '�������',
    'street' => '�����',
    'house' => '���',
    'porch' => '�������',
    'door_phone' => '�������',
    'flat' => '��������',
    'delivtime' => '����� ��������',
    'door_phone' => '�������',
    'tel' => '�������',
    'house' => '���',
    'porch' => '�������',
    'org_name' => '��������',
    'org_inn' => '���',
    'org_kpp' => '���',
    'org_yur_adres' => '��. �����',
    'org_fakt_adres' => '����. �����',
    'org_ras' => '�/�',
    'org_bank' => '����',
    'org_kor' => '�/�',
    'org_bik' => '���',
    'org_city' => '�����',
    'dop_info' => '���������� ����������',
);

// ���� ����
$key_stop = array('id', 'datas', 'uid', 'orders', 'user', 'sum');

/**
 * ������������� � ���������� ��� 1
 */
function actionSelect() {
    global $PHPShopGUI, $key_name, $key_stop;

    // ��������� ������
    if (!empty($_POST['select'])) {
        unset($_SESSION['select']['order']);
        $_SESSION['select']['order'] = $_POST['select'];
    }

    // ������
    $command[] = array('�����-����', 1, false);
    $command[] = array('���� Excel', 2, false);

    $PHPShopGUI->_CODE.= '<p class="text-muted">�� ������ ������������� ������������ ��������� �������. �������� ������ �� ������ ����, �������� �������� ����, ������� ����� ���������������, � ������� �� ������ "������������� ���������".</p><p class="text-muted"><a href="#" id="select-all">������� ���</a> | <a href="#" id="select-none">����� ��������� �� ����</a></p>';

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));

    if (is_array($data))
        foreach ($data as $key => $val) {

            if ((!in_array($key, $key_stop))) {
                if (!empty($key_name[$key])) {
                    $name = __($key_name[$key]);
                    $select = 0;
                } else {
                    $name = $key;
                    $select = 0;
                }
                
                // ������ ��������� �����
                if(!empty($_COOKIE['check_memory'])){
                        $memory = json_decode($_COOKIE['check_memory'],true);
                        if(is_array($memory[$_GET['path']])){
                            if($memory[$_GET['path']][$key] == 1)
                                $select=1;
                            else $select=0;
                        }
                }
                            
                    
                $PHPShopGUI->_CODE.='<div class="pull-left" style="width:200px;>' . $PHPShopGUI->setCheckBox($key, 1, ucfirst($name), $select) . '</div>';
            }
        }

    exit($PHPShopGUI->_CODE . '<p class="clearfix"> </p>');
}

// ���������� ����� ������ � �����
function actionSelectEdit() {

    unset($_SESSION['select_col']);
    if (!empty($_POST['select_col'])) {
        $_SESSION['select_col'] = $_POST['select_col'];
    }
    return array("success" => true);
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopOrm;

    if (is_array($_SESSION['select']['order'])) {
        $val = array_values($_SESSION['select']['order']);
        $where = array('id' => ' IN (' . implode(',', $val) . ')');
    }
    else
        $where = null;

    $PHPShopOrm->debug = false;

    // ����������� � ����� ���������
    if (!empty($_POST['status_new'])) {
        $status['maneger'] = $_POST['status_new'];
        $status['time'] = PHPShopDate::dataV();
        $_POST['status_new'] = serialize($status);
    }

    // ������ ��������� �����
    if (is_array($_POST)) {
        $memory=json_decode($_COOKIE['check_memory'],true);
        unset($memory[$_GET['path']]);
        foreach ($_POST as $k => $v) {
            if (strstr($k, '_new'))
                $memory[$_GET['path']][str_replace('_new','',$k)] = 1;
        }
        if (is_array($memory))
            setcookie("check_memory", json_encode($memory),time()+3600000,$GLOBALS['SysValue']['dir']['dir'].'/phpshop/admpanel/');
    }

    $oldStatuses = $PHPShopOrm->getList(array('statusi', 'id'), $where);

    if ($PHPShopOrm->update($_POST, $where)) {
        // ���������� ������������ � ����� �������
        foreach ($oldStatuses as $status) {
            if ((int) $status['statusi'] !== (int) $_POST['statusi_new']) {
                $PHPShopOrderFunction = new PHPShopOrderFunction((int) $status['id']);
                $PHPShopOrderFunction->sendStatusChangedMail();
            }
        }

        header('Location: ?path=order');
    }
    else
        return true;
}

/**
 * ������������� � ���������� ��� 2
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules, $key_name, $key_stop;

    $PHPShopGUI->setActionPanel(__("�������� ������"), false, array('��������� � �������'));
    $PHPShopGUI->addJSFiles('./order/gui/order.gui.js');
    $PHPShopGUI->field_col = 2;
    $select_error = null;

    $PHPShopGUI->_CODE.= $PHPShopGUI->setHelp('�� ������ ������������� ������������ ��������� �������. �������� ������ �� ������ �������, �������� �������� ������, ������� ����� ���������������, � ������� �� ������ "������������� ���������".<hr>', false);

    $PHPShopOrm->sql = 'show fields  from ' . $GLOBALS['SysValue']['base']['orders'];
    $select = array_values($_SESSION['select_col']);
    $data = $PHPShopOrm->select();
    if (is_array($data))
        foreach ($data as $val) {

            if (in_array($val['Field'], $select) and !in_array($val['Field'], $key_stop)) {

                // �������
                if ($val['Field'] == 'statusi') {
                    // ������� �������
                    PHPShopObj::loadClass('order');
                    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
                    $status_array = $PHPShopOrderStatusArray->getArray();
                    $status[] = __('����� �����');
                    $order_status_value[] = array(__('����� �����'), 0, '');
                    if (is_array($status_array))
                        foreach ($status_array as $status_val) {

                            $status[$status_val['id']] = $status_val['name'];
                            $order_status_value[] = array($status_val['name'], $status_val['id'], $_GET['where']['statusi']);
                        }
                    $PHPShopGUI->_CODE.=$PHPShopGUI->setField('������', $PHPShopGUI->setSelect('statusi_new', $order_status_value));
                } elseif (!empty($key_name[$val['Field']])) {
                    $name = $key_name[$val['Field']];
                    $PHPShopGUI->_CODE.=$PHPShopGUI->setField(ucfirst($name), $PHPShopGUI->setInputArg(getKeyView($val)));
                } else {
                    $name = $val['Field'];
                    $PHPShopGUI->_CODE.=$PHPShopGUI->setField(ucfirst($name), $PHPShopGUI->setInputArg(getKeyView($val)));
                }
            }
        }


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.order.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.order.edit");


    // ��������� ������
    $select_action_path = 'order';
    if (is_array($_SESSION['select'][$select_action_path])) {
        foreach ($_SESSION['select'][$select_action_path] as $val)
            $select_message = '<span class="label label-default">' . count($_SESSION['select']['order']) . '</span> '.__('������� �������').'<hr><a href="#" class="back"><span class="glyphicon glyphicon-ok"></span> '.__('�������� ��������').'</a>';
    }
    else
        $select_message = '<p class="text-muted">'.__('�� ������ ������� ���������� ������� ��� ��������. �� ��������� ����� �������������� ��� �������').'.: <a href="?path=catalog"><span class="glyphicon glyphicon-share-alt"></span> '.__('�������').'</a></p>';

    $sidebarleft[] = array('title' => '���������', 'content' => $select_message);

    // ������
    if (!empty($select_error))
        $sidebarleft[] = array('title' => '������', 'content' => $select_error, 'class' => 'text-danger');


    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->setFooter($ContentFooter);

    $PHPShopGUI->Compile(2);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();
?>