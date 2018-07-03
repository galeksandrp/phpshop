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

            $status[$status_val['id']] = $status_val['name'];
            $order_status_value[] = array($status_val['name'], $status_val['id'], $_GET['where']['statusi']);
        }

    $order_status_value[] = array(__('��� ������'), 'none', 'none');

    // �����
    $where = null;
    $limit = 300;
    if (is_array($_GET['where'])) {
        foreach ($_GET['where'] as $k => $v) {
            if ($v!='' and $v != 'none')
                $where.= ' ' . PHPShopSecurity::TotalClean($k) . ' = "' . PHPShopSecurity::TotalClean($v) . '" or';
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

    $PHPShopInterface->setActionPanel($TitlePage, array('������������� ���������','CSV', '|', '������� ���������'), false);
    $PHPShopInterface->setCaption(array(null, "3%"), array("�", "12%"), array("������", "15%"), array("����", "10%"), array("����������", "20%"), array("�������", "15%"), array("", "15%"), array(__("�����"), "17%", array('align' => 'right')));
    $PHPShopInterface->addJSFiles('./js/bootstrap-datetimepicker.min.js', './js/bootstrap-datetimepicker.ru.js', './order/gui/order.gui.js');
    $PHPShopInterface->addCSSFiles('./css/bootstrap-datetimepicker.min.css');

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $PHPShopOrm->Option['where'] = ' or ';
    $PHPShopOrm->debug = false;
    $PHPShopOrm->mysql_error = false;
    $PHPShopOrm->sql = 'SELECT a.*, b.mail FROM ' . $GLOBALS['SysValue']['base']['orders'] . ' AS a 
        LEFT JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.user = b.id  ' . $where . ' order by a.id desc 
            limit ' . $limit;

    $data = $PHPShopOrm->select();
    if (is_array($data))
        foreach ($data as $row) {

            // ���������� ������
            $PHPShopOrder = new PHPShopOrderFunction($row['id'], $row);

            $mail = $PHPShopOrder->getSerilizeParam('orders.Person.mail');

            if (empty($row['fio'])) {
                $row['fio'] = $mail;
            }

            $datas = PHPShopDate::get($row['datas'], false);

            $PHPShopInterface->setRow($row['id'], array('name' =>  '<span class="hidden-xs">' . __('����� ') . '</span>' .$row['uid'], 'link' => '?path=order&id=' . $row['id'], 'align' => 'left','order'=>$row['id']), array('status' => array('enable' => $row['statusi'], 'caption' => $status,'passive'=>true, 'color' => $PHPShopOrder->getStatusColor())), array('name' =>$datas,'order'=>$row['datas']), array('name' => $row['fio'], 'link' => '?path=shopusers&id=' . $row['user']), array('name' => '<span class="hidden" id="order-' . $row['id'] . '-email">' . $row['mail'] . '</span>' . $row['tel']), array('action' => array('edit', 'email', 'copy', '|', 'delete', 'id' => $row['id']), 'align' => 'center'), array('name' => $PHPShopOrder->getTotal(false, ' ') . $currency, 'align' => 'right','order'=>$row['sum']));
        }

    if (isset($_GET['date_start']))
        $date_start = $_GET['date_start'];
    else
        $date_start = PHPShopDate::get(time() - 2592000);

    if (isset($_GET['date_end']))
        $date_end = $_GET['date_end'];
    else
        $date_end = PHPShopDate::get(time() - 1);

    // ������ ������
    $PHPShopInterface->field_col = 1;
    $searchforma.=$PHPShopInterface->setInputDate("date_start", $date_start, 'margin-bottom:10px', null, '���� ������ ������');
    $searchforma.=$PHPShopInterface->setInputDate("date_end", $date_end, false, null, '���� ����� ������');
    $searchforma.= $PHPShopInterface->setSelect('where[statusi]', $order_status_value, 180);
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.uid]', 'placeholder' => '� ������', 'value' => $_GET['where']['a.uid']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.fio]', 'placeholder' => '��� ����������', 'value' => $_GET['where']['a.io']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[b.mail]', 'placeholder' => 'E-mail', 'value' => $_GET['where']['b.mail']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.tel]', 'placeholder' => '�������', 'value' => $_GET['where']['a.tel']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[a.street]', 'placeholder' => '�����', 'value' => $_GET['where']['a.street']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => $_GET['path']));
    $searchforma.=$PHPShopInterface->setButton(__('�����'), 'search', 'btn-order-search pull-right');

    if ($where)
        $searchforma.=$PHPShopInterface->setButton(__('�����'), 'remove', 'btn-order-cancel pull-left');

    // ������ �������
    $sidebarright[] = array('title' => '����������� �����', 'content' => $PHPShopInterface->setForm($searchforma, false, "order_search", false, false, 'form-sidebar'));
    $PHPShopInterface->setSidebarRight($sidebarright, 2);

    $PHPShopInterface->Compile(2);
}

?>