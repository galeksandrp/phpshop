<?php

$TitlePage = __("������");

function actionStart() {
    global $PHPShopInterface, $PHPShopSystem, $TitlePage;


    // ������� �������
    PHPShopObj::loadClass('order');
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $status_array = $PHPShopOrderStatusArray->getArray();
    $status[] = __('����� �����');
    $order_status_value[] = array(__('����� �����'), 0, '');
    if (is_array($status_array))
        foreach ($status_array as $status_val) {

            $status[$status_val['id']] = substr($status_val['name'], 0, 22);
            $order_status_value[] = array($status_val['name'], $status_val['id'], $_GET['where']['statusi']);
        }

    
    if (!isset($_GET['where']['statusi']))
        $_GET['where']['statusi'] = 'none';
    

    $order_status_value[] = array(__('��� ������'), 'none', $_GET['where']['statusi']);

    // �����
    $where = null;
    $limit = 300;
    
    if (is_array($_GET['where'])) {
        foreach ($_GET['where'] as $k => $v) {
            if ($v != '' and $v != 'none')
                if ($k == 'a.user' || $k == 'statusi')
                    $where.= ' ' . PHPShopSecurity::TotalClean($k) . ' = "' . PHPShopSecurity::TotalClean($v) . '" or';
                else
                    $where.= ' ' . PHPShopSecurity::TotalClean($k) . ' like "%' . PHPShopSecurity::TotalClean($v) . '%" or';
        }

        if ($where)
            $where = 'where' . substr($where, 0, strlen($where) - 2);

        // ����
        if (!empty($_GET['date_start']) and !empty($_GET['date_end'])) {
            if ($where)
                $where.=' and ';
            else
                $where = ' where ';
            $where.=' a.datas between ' . (PHPShopDate::GetUnixTime($_GET['date_start']) - 1) . ' and ' . (PHPShopDate::GetUnixTime($_GET['date_end']) + 259200 / 2) . '  ';
            $TitlePage.=' � ' . $_GET['date_start'] . ' �� ' . $_GET['date_end'];
        }

        $limit = 1000;
    }

    // ���� �����
    if ($PHPShopSystem->getDefaultValutaIso() == 'RUB' or $PHPShopSystem->getDefaultValutaIso() == 'RUR')
        $currency = ' <span class="rubznak hidden-xs">p</span>';
    else
        $currency = $PHPShopSystem->getDefaultValutaCode();

    $PHPShopInterface->action_select['������������� ���������'] = array(
        'name' => '������������� ���������',
        'action' => 'edit-select',
        'class' => 'disabled'
    );

    $PHPShopInterface->action_select['���������'] = array(
        'name' => '��������� �����',
        'action' => 'option enabled'
    );

    $PHPShopInterface->setActionPanel($TitlePage, array('���������', '������������� ���������', 'CSV', '|', '������� ���������'), false);

    // ��������� �����
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
    }

    $PHPShopInterface->setCaption(array(null, "3%"), array("�", "12%", array('align' => 'left', 'view' => intval($memory['order.option']['uid']))), array("ID", "10%", array('view' => intval($memory['order.option']['id']))), array("������", "20%", array('view' => intval($memory['order.option']['statusi']))), array("����", "10%", array('view' => intval($memory['order.option']['datas']))), array("����������", "20%", array('view' => intval($memory['order.option']['fio']))), array("�������", "15%", array('view' => intval($memory['order.option']['tel']))), array("", "7%", array('view' => intval($memory['order.option']['menu']))), array("������", "10%", array('view' => intval($memory['order.option']['discount']))), array("�����", "15%", array('view' => intval($memory['order.option']['city']))), array("�����", "25%", array('view' => intval($memory['order.option']['adres']))), array("��������", "15%", array('view' => intval($memory['order.option']['org']))), array("�����������", "15%", array('view' => intval($memory['order.option']['comment']))), array("�����", "17%", array('align' => 'right', 'view' => intval($memory['order.option']['sum']))));
    $PHPShopInterface->addJSFiles('./js/bootstrap-datetimepicker.min.js', './js/bootstrap-datetimepicker.ru.js', './order/gui/order.gui.js');
    $PHPShopInterface->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $PHPShopOrm->Option['where'] = ' or ';
    $PHPShopOrm->debug = false;
    $PHPShopOrm->mysql_error = false;
    $PHPShopOrm->sql = 'SELECT a.*, b.mail, b.name FROM ' . $GLOBALS['SysValue']['base']['orders'] . ' AS a 
        LEFT JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.user = b.id  ' . $where . ' order by a.id desc 
            limit ' . $limit;

    $data = $PHPShopOrm->select();
    if (is_array($data))
        foreach ($data as $row) {

            // ���������� ������
            $PHPShopOrder = new PHPShopOrderFunction($row['id'], $row);

            $mail = $row['mail'];
            if(empty($mail)) $mail=$PHPShopOrder->getSerilizeParam('orders.Person.mail');
            $comment = $PHPShopOrder->getSerilizeParam('status.maneger');

            if (empty($row['fio']) and !empty($row['name'])) 
                $row['fio'] = $row['name'];
            elseif(empty($row['fio']) and empty($row['name']))
                $row['fio'] = $mail;

            // ������
            $datas = PHPShopDate::get($row['datas'], false);
            $discount = $PHPShopOrder->getDiscount();

            // �����
            $adres = $row['street'];
            if (!empty($row['house']))
                $adres.= ', �. ' . $row['house'];
            if (!empty($row['flat']))
                $adres.= ', ��. ' . $row['flat'];


            $PHPShopInterface->setRow($row['id'], array('name' => '<span class="hidden-xs">'.__('�����').'</span> ' . $row['uid'], 'link' => '?path=order&id=' . $row['id'], 'align' => 'left', 'order' => $row['id'], 'view' => intval($memory['order.option']['uid'])), array('name' => $row['id'], 'view' => intval($memory['order.option']['id']), 'link' => '?path=order&id=' . $row['id']), array('status' => array('enable' => $row['statusi'], 'caption' => $status, 'passive' => true, 'color' => $PHPShopOrder->getStatusColor()), 'view' => intval($memory['order.option']['statusi'])), array('name' => $datas, 'order' => $row['datas'], 'view' => intval($memory['order.option']['datas'])), array('name' => $row['fio'], 'link' => '?path=shopusers&id=' . $row['user'], 'view' => intval($memory['order.option']['fio'])), array('name' => '<span class="hidden" id="order-' . $row['id'] . '-email">' . $row['mail'] . '</span>' . $row['tel'], 'view' => intval($memory['order.option']['tel'])), array('action' => array('edit', 'email', 'copy', '|', 'delete', 'id' => $row['id']), 'align' => 'center', 'view' => intval($memory['order.option']['menu'])), array('name' => $discount . '%', 'order' => $discount, 'view' => intval($memory['order.option']['discount'])), array('name' => $row['city'], 'view' => intval($memory['order.option']['city'])), array('name' => $adres, 'view' => intval($memory['order.option']['adres'])), array('name' => $row['org_name'], 'view' => intval($memory['order.option']['org'])), array('name' => $comment, 'view' => intval($memory['order.option']['comment'])), array('name' => $PHPShopOrder->getTotal(false, ' ') . $currency, 'align' => 'right', 'order' => $row['sum'], 'view' => intval($memory['order.option']['sum'])));
        }

    if (isset($_GET['date_start']))
        $date_start = $_GET['date_start'];
    else
        $date_start = PHPShopDate::get(time() - 2592000);

    if (isset($_GET['date_end']))
        $date_end = $_GET['date_end'];
    else
        $date_end = PHPShopDate::get(time() - 1);

    // ������� �������������
    PHPShopObj::loadClass('user');
    $PHPShopUserStatus = new PHPShopUserStatusArray();
    $PHPShopUserStatusArray = $PHPShopUserStatus->getArray();
    $user_status_value[] = array(__('��� ������������'), '', $_GET['where']['b.status']);
    if (is_array($PHPShopUserStatusArray))
        foreach ($PHPShopUserStatusArray as $user_status)
            $user_status_value[] = array($user_status['name'], $user_status['id'], $_GET['where']['b.status']);

    // ������ ������
    $PHPShopInterface->field_col = 1;
    $searchforma.=$PHPShopInterface->setInputDate("date_start", $date_start, 'margin-bottom:10px', null, '���� ������ ������');
    $searchforma.=$PHPShopInterface->setInputDate("date_end", $date_end, false, null, '���� ����� ������');
    $searchforma.= $PHPShopInterface->setSelect('where[statusi]', $order_status_value, 180);
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.uid]', 'placeholder' => '� ������', 'value' => $_GET['where']['a.uid']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.fio]', 'placeholder' => '��� ����������', 'value' => $_GET['where']['a.fio']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.org_name]', 'placeholder' => '��������', 'value' => $_GET['where']['a.org_name']));
    $searchforma.=$PHPShopInterface->setSelect('where[b.status]', $user_status_value, 180);

    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[b.mail]', 'placeholder' => 'E-mail', 'value' => $_GET['where']['b.mail']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.tel]', 'placeholder' => '�������', 'value' => $_GET['where']['a.tel']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.city]', 'placeholder' => '�����', 'value' => $_GET['where']['a.city']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.street]', 'placeholder' => '�����', 'value' => $_GET['where']['a.street']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => $_GET['path']));
    $searchforma.=$PHPShopInterface->setButton('�����', 'search', 'btn-order-search pull-right');

    if ($where)
        $searchforma.=$PHPShopInterface->setButton('�����', 'remove', 'btn-order-cancel pull-left');

    // ������ �������
    $sidebarright[] = array('title' => '����������� �����', 'content' => $PHPShopInterface->setForm($searchforma, false, "order_search", false, false, 'form-sidebar'));
    $PHPShopInterface->setSidebarRight($sidebarright, 2);

    $PHPShopInterface->Compile(2);
}

?>