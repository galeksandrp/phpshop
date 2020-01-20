<?php

session_start();
$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass(array("base", "system", "admgui", "orm", "date", "xml", "security", "string", "parser", "mail", "lang", "order"));
$subpath[0] = 'order';

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini", true, true);
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass('valuta');
PHPShopObj::loadClass('category');
PHPShopObj::loadClass('sort');

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();
$_SESSION['lang'] = $PHPShopSystem->getSerilizeParam("admoption.lang");
$PHPShopLang = new PHPShopLang(array('locale' => $_SESSION['lang'], 'path' => 'admin'));

// �������� GUI
$PHPShopInterface = new PHPShopInterface();

// �����
$where = null;

if (isset($_GET['start']))
    $limit = $_GET['start'] . ',' . $_GET['length'];
else
    $limit = 300;

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

if (is_array($_GET['where'])) {
    foreach ($_GET['where'] as $k => $v) {
        if ($v != '' and $v != 'none')
            if ($k == 'a.user' || $k == 'statusi')
                $where .= ' ' . PHPShopSecurity::TotalClean($k) . ' = "' . PHPShopSecurity::TotalClean($v) . '" or';
            else
                $where .= ' ' . PHPShopSecurity::TotalClean($k) . ' like "%' . PHPShopSecurity::TotalClean($v) . '%" or';
    }

    if ($where)
        $where = 'where' . substr($where, 0, strlen($where) - 2);

    // ����
    if (!empty($_GET['date_start']) and ! empty($_GET['date_end'])) {
        if ($where)
            $where .= ' and ';
        else
            $where = ' where ';
        $where .= ' a.datas between ' . (PHPShopDate::GetUnixTime($_GET['date_start']) - 1) . ' and ' . (PHPShopDate::GetUnixTime($_GET['date_end']) + 259200 / 2) . '  ';
    }
}

// ���� �����
if ($PHPShopSystem->getDefaultValutaIso() == 'RUB' or $PHPShopSystem->getDefaultValutaIso() == 'RUR')
    $currency = ' <span class="rubznak hidden-xs">p</span>';
else
    $currency = $PHPShopSystem->getDefaultValutaCode();


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
    $memory['order.option']['cart'] = 0;
}

// ����������� ���������� �� JSON
if (is_array($_GET['order']) and ! empty($_SESSION['jsort'][$_GET['order']['0']['column']])) {
    $order = 'a.' . $_SESSION['jsort'][$_GET['order']['0']['column']] . ' ' . $_GET['order']['0']['dir'];
} else {
    $order = 'a.id desc';
}

// ����� �� �������� JSON
if (!empty($_GET['search']['value'])) {
    if (empty($where))
        $where = ' where ';
    else
        $where .= ' and ';

    $where .= "(a.uid LIKE '%" . PHPShopString::utf8_win1251(PHPShopSecurity::TotalClean($_GET['search']['value'])) . "%' or a.fio LIKE '%" . PHPShopString::utf8_win1251(PHPShopSecurity::TotalClean($_GET['search']['value'])) . "%' or a.tel LIKE '%" . PHPShopString::utf8_win1251(PHPShopSecurity::TotalClean($_GET['search']['value'])) . "%'";

    // �����
    if (is_numeric($_GET['search']['value']))
        $where .= ' or a.sum = ' . $_GET['search']['value'];

    $where .= ')';
}

// ������� � �������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
$PHPShopInterface->path = 'order';
$PHPShopOrm->Option['where'] = ' or ';
$PHPShopOrm->debug = false;
$PHPShopOrm->mysql_error = false;
$PHPShopOrm->sql = 'SELECT a.*, b.mail, b.name FROM ' . $GLOBALS['SysValue']['base']['orders'] . ' AS a 
        LEFT JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.user = b.id  ' . $where . ' order by ' . $order . ' limit ' . $limit;

//$PHPShopInterface->_AJAX["debug"]=$PHPShopOrm->sql;

$sum = 0;
$data = $PHPShopOrm->select();
if (is_array($data))
    foreach ($data as $row) {

        // �����
        $sum += $row['sum'];

        // ���������� ������
        $PHPShopOrder = new PHPShopOrderFunction($row['id'], $row);

        $mail = $row['mail'];
        if (empty($mail))
            $mail = $PHPShopOrder->getSerilizeParam('orders.Person.mail');
        $comment = $PHPShopOrder->getSerilizeParam('status.maneger');

        if (empty($row['fio']) and ! empty($row['name']))
            $row['fio'] = $row['name'];
        elseif (empty($row['fio']) and empty($row['name']))
            $row['fio'] = $mail;

        // ������
        $datas = PHPShopDate::get($row['datas'], false);
        $discount = $PHPShopOrder->getDiscount();

        // �����
        $adres = $row['street'];
        if (!empty($row['house']))
            $adres .= ', �. ' . $row['house'];
        if (!empty($row['flat']))
            $adres .= ', ��. ' . $row['flat'];

        // �������
        $order = unserialize($row['orders']);
        $cart_list = $order['Cart']['cart'];
        $carts = null;

        if (sizeof($cart_list) != 0)
            if (is_array($cart_list))
                foreach ($cart_list as $key => $val) {

                    if (!empty($val['id'])) {

                        // �������� ������� ������
                        if (!empty($val['parent']))
                            $val['id'] = $val['parent'];
                        if (!empty($val['parent_uid']))
                            $val['uid'] = $val['parent_uid'];
                        
                        $carts.='<a href="?path=product&id=' . $val['id'] . '&return=order.' . $row['id'] . '" title="�������: '.$val['uid'].'">'.$val['name'].'</a><br>';

                    }
                }



        $PHPShopInterface->setRow($row['id'], array('name' => '<span class="hidden-xs">' . __('�����') . '</span> ' . $row['uid'], 'link' => '?path=order&id=' . $row['id'], 'align' => 'left', 'sort' => 'uid', 'order' => $row['id'], 'view' => intval($memory['order.option']['uid'])), array('name' => $row['id'], 'sort' => 'id', 'view' => intval($memory['order.option']['id']), 'link' => '?path=order&id=' . $row['id']), array('status' => array('enable' => $row['statusi'], 'caption' => $status, 'passive' => true, 'color' => $PHPShopOrder->getStatusColor()), 'sort' => 'statusi', 'view' => intval($memory['order.option']['statusi'])), array('name' => $carts, 'order' => $row['datas'], 'sort' => 'datas', 'view' => intval($memory['order.option']['cart'])), array('name' => $datas, 'order' => $row['datas'], 'sort' => 'datas', 'view' => intval($memory['order.option']['datas'])), array('name' => $row['fio'], 'sort' => 'fio', 'link' => '?path=shopusers&id=' . $row['user'], 'view' => intval($memory['order.option']['fio'])), array('name' => '<span class="hidden" id="order-' . $row['id'] . '-email">' . $row['mail'] . '</span>' . $row['tel'], 'sort' => 'tel', 'view' => intval($memory['order.option']['tel'])), array('action' => array('edit', 'email', 'copy', '|', 'delete', 'id' => $row['id']), 'align' => 'center', 'view' => intval($memory['order.option']['menu'])), array('name' => $discount . '%', 'order' => $discount, 'view' => intval($memory['order.option']['discount'])), array('name' => $row['city'], 'sort' => 'city', 'view' => intval($memory['order.option']['city'])), array('name' => $adres, 'view' => intval($memory['order.option']['adres'])), array('name' => $row['org_name'], 'sort' => 'org_name', 'view' => intval($memory['order.option']['org'])), array('name' => $comment, 'view' => intval($memory['order.option']['comment'])), array('name' => $PHPShopOrder->getTotal(false, ' ') . $currency, 'align' => 'right', 'order' => $row['sum'], 'sort' => 'sum', 'view' => intval($memory['order.option']['sum'])));
    }

$PHPShopOrm->sql = 'SELECT a.sum FROM ' . $GLOBALS['SysValue']['base']['orders'] . ' AS a 
        LEFT JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.user = b.id  ' . $where . ' order by a.id desc 
            limit 10000';
$total = $PHPShopOrm->select();

if (is_array($total)) {

    $sum = $num = 0;
    foreach ($total as $row) {
        $sum += $row['sum'];
        $num++;
    }

    $PHPShopInterface->_AJAX["recordsFiltered"] = count($total);
    $PHPShopInterface->_AJAX["sum"] = number_format($sum, 0, '', ' ');
    $PHPShopInterface->_AJAX["num"] = $num;
} else {
    $PHPShopInterface->_AJAX["data"] = array();
    $PHPShopInterface->_AJAX["recordsFiltered"] = $PHPShopInterface->_AJAX["sum"] = $PHPShopInterface->_AJAX["num"] = 0;
}

$_SESSION['jsort'] = $PHPShopInterface->_AJAX["sort"];
unset($PHPShopInterface->_AJAX["sort"]);

header("Content-Type: application/json");
exit(json_encode($PHPShopInterface->_AJAX));
?>