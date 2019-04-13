<?php

session_start();
$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass(array("base", "system", "admgui", "orm", "date", "xml", "security", "string", "parser", "mail", "lang"));
$subpath[0] = 'catalog';

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


/**
 * ����� �������
 */

// ��������� �����
if (!empty($_COOKIE['check_memory'])) {
    $memory = json_decode($_COOKIE['check_memory'], true);
}
if (!is_array($memory['catalog.option'])) {
    $memory['catalog.option']['icon'] = 1;
    $memory['catalog.option']['name'] = 1;
    $memory['catalog.option']['price'] = 1;
    $memory['catalog.option']['item'] = 1;
    $memory['catalog.option']['menu'] = 1;
    $memory['catalog.option']['status'] = 1;
    $memory['catalog.option']['label'] = 1;
    $memory['catalog.option']['uid'] = 0;
    $memory['catalog.option']['id'] = 0;
    $memory['catalog.option']['num'] = 0;
    $memory['catalog.option']['sort'] = 0;
}

// ��������������
if (!empty($memory['catalog.option']['sort'])) {
    $PHPShopSortArray = new PHPShopSortArray();
    $PHPShopSort = $PHPShopSortArray->getArray();
}
else
    $PHPShopSort = array();


if (isset($_GET['where']['category']))
    unset($_GET['cat']);

// ��� ������
switch ($_GET['core']) {
    case 'reg':
        $core = 'REGEXP';
        break;
    case 'eq':
        $core = ' = ';
        break;
    default: $core = 'REGEXP';
}

// ID ������ eq
if (!empty($_GET['where']['id']))
    $core = ' = ';


$where = false;
//$limit = array('limit' => 300);

if (isset($_GET['start']))
    $limit = array('limit' => $_GET['start'] . ',' . $_GET['length']);
else
    $limit = array('limit' => 300);

if (isset($_GET['cat']) or isset($_GET['sub'])) {

    if (!empty($_GET['cat']) or $_GET['sub'] == 'csv' or isset($_GET['sub'])) {
        $where['category'] = "=" . intval($_GET['cat']);
    }

    // ����������� ���������� �� �������� ��������
    $PHPShopCategory = new PHPShopCategory(intval($_GET['cat']));
    switch ($PHPShopCategory->getParam('order_to')) {
        case(1): $order_direction = "";
            break;
        case(2): $order_direction = " desc";
            break;
        default: $order_direction = "";
            break;
    }
    switch ($PHPShopCategory->getParam('order_by')) {
        case(1): $order = array('order' => 'name' . $order_direction);
            break;
        case(2):
            $order = array('order' => 'price' . $order_direction);
            break;
        case(3): $order = array('order' => 'num' . $order_direction . ", datas desc");
            break;
        default: $order = array('order' => 'num' . $order_direction . ", datas desc");
            break;
    }
} else {

    $order = array('order' => 'id DESC');
}


// ����������� ����������
/*
  if (is_array($_GET['order'])) {
  foreach ($_GET['order'] as $k => $v) {
  $order = array('order' => PHPShopSecurity::TotalClean($k) . ' ' . PHPShopSecurity::TotalClean($v));
  }
  } */

// ����������� �����
if (is_array($_GET['where'])) {
    foreach ($_GET['where'] as $k => $v) {

        if (isset($v) and $v != '') {

            // ��������������
            if (is_array($v)) {
                $vendor = null;
                foreach ($v as $kk => $vv) {
                    if ($kk == 0 and !empty($vv))
                        $vendor.="  LIKE '%" . PHPShopSecurity::TotalClean($vv) . "%'";
                    elseif (!empty($vv))
                        $vendor.=" and " . PHPShopSecurity::TotalClean($k) . " LIKE '%" . PHPShopSecurity::TotalClean($vv) . "%'";
                }

                if (!empty($vendor))
                    $where[PHPShopSecurity::TotalClean($k)] = $vendor;
            }
            else
                $where[PHPShopSecurity::TotalClean($k)] = " " . $core . " '" . PHPShopSecurity::TotalClean($v) . "'";
        }
    }
}

// �������� ��������������
if (!empty($_GET['sort'])) {
    $sort_array = explode(":", $_GET['sort']);
    $PHPShopSortSearch = new PHPShopSortSearch($sort_array[0]);

    if (is_array($PHPShopSortSearch->sort_array))
        foreach ($PHPShopSortSearch->sort_array as $k => $v) {
            if ($v == $sort_array[1])
                $where['vendor'] = " REGEXP 'i" . $PHPShopSortSearch->sort_category . '-' . $k . "i'";
        }
}

// ��������
if (!empty($_GET['cat']))
    $postfix = '&cat=' . intval($_GET['cat']);
else
    $postfix = null;


// ������� � �������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
$PHPShopOrm->debug = false;

// ������� �����
if ($_GET['from'] == 'header') {
    $PHPShopOrm->Option['where'] = " or ";
    $where['uid'] = $where['name'];

    // ������� �������
    $where['id'] = $where['name'] . " and parent_enabled='0'";
} else {

    // ������� �������
    $where['parent_enabled'] = "='0'";
}

// ����� ��������
if (!empty($_GET['parent'])) {
    $where['parent'] = "='" . $_GET['parent'] . "'";
    $where['parent_enabled'] = "='1'";
}

//$PHPShopOrm->mysql_error = false;
$data = $PHPShopOrm->select(array('*'), $where, $order, $limit);
if (is_array($data))
    foreach ($data as $row) {

        if (!empty($row['pic_small']))
            $icon = '<img src="' . $row['pic_small'] . '" onerror="this.onerror = null;this.src = \'./images/no_photo.gif\'" class="media-object">';
        else
            $icon = '<img class="media-object" src="./images/no_photo.gif">';

        $PHPShopInterface->path = 'product&return=catalog';

        // �������
        if (!empty($row['uid']) and empty($memory['catalog.option']['uid']))
            $uid = '<div class="text-muted">��� ' . $row['uid'] . '</div>';
        else
            $uid = null;


        if (!empty($memory['catalog.option']['label']) and (!empty($row['newtip']) or !empty($row['spec']) or !empty($row['sklad']) or isset($row['yml']))) {
            $uid.='<div class="text-muted">';

            // �������
            if (!empty($row['newtip']))
                $uid.= '<a class="label label-info" title="' . __('�������') . '" href="?path=catalog' . $postfix . '&where[newtip]=1">�</a> ';

            // ���������������
            if (!empty($row['spec']))
                $uid.= '<a class="label label-warning" title="' . __('���������������') . '" href="?path=catalog' . $postfix . '&where[spec]=1">�</a> ';

            // ��� �����
            if (!empty($row['sklad']))
                $uid.= '<a class="label label-danger" title="' . __('��� �����') . '" href="?path=catalog' . $postfix . '&where[sklad]=1">�</a> ';

            // ������ ������
            if (empty($row['yml']))
                $uid.= '<a class="label label-danger" title="' . __('��� � ������.�������') . '" href="?path=catalog' . $postfix . '&where[yml]=0">�</a> ';

            // ������ ������
            if ($row['cpa'] == 1 and !empty($row['yml']))
                $uid.= '<a class="label label-info" title="' . __('������.������� CPA') . '" href="?path=catalog' . $postfix . '&where[cpa]=1">CPA</a> ';

            // ������
            if (strstr($row['parent'], ','))
                $uid.= '<a class="label label-default" title="' . __('�������') . '" href="?path=catalog' . $postfix . '&where[parent]=,">�</a> ';

            $uid.='</div>';
        }

        // Enabled
        if (empty($row['enabled']))
            $enabled = 'text-muted';
        else
            $enabled = null;

        if ($row['items'] < 0)
            $row['items'] = 0;

        // ��������������
        $sort_list = null;
        $sort = unserialize($row['vendor_array']);
        if (is_array($sort))
            foreach ($sort as $scat => $sorts) {
                if (is_array($sorts))
                    foreach ($sorts as $s)
                        $sort_list.='<a href="?path=sort&id=' . $scat . '" class="text-muted">' . $PHPShopSort[$s]['name'] . '</a>, ';
            }

        $sort_list = substr($sort_list, 0, strlen($sort_list) - 2);

        $PHPShopInterface->setRow(
                $row['id'], array('name' => $icon, 'link' => '?path=product&return=catalog.' . $row['category'] . '&id=' . $row['id'], 'align' => 'left', 'view' => intval($memory['catalog.option']['icon'])), array('name' => $row['name'], 'link' => '?path=product&return=catalog.' . $row['category'] . '&id=' . $row['id'], 'align' => 'left', 'addon' => $uid, 'class' => $enabled, 'view' => intval($memory['catalog.option']['name'])), array('name' => $row['num'], 'align' => 'center', 'editable' => 'num_new', 'view' => intval($memory['catalog.option']['num'])), array('name' => $row['id'], 'view' => intval($memory['catalog.option']['id'])), array('name' => $row['uid'], 'view' => intval($memory['catalog.option']['uid'])), array('name' => $row['price'], 'editable' => 'price_new', 'view' => intval($memory['catalog.option']['price'])), array('name' => $row['items'], 'align' => 'center', 'editable' => 'items_new', 'view' => intval($memory['catalog.option']['item'])), array('action' => array('edit', 'copy', 'url', '|', 'delete', 'id' => $row['id']), 'align' => 'center', 'view' => intval($memory['catalog.option']['menu'])), array('name' => $sort_list, 'view' => intval($memory['catalog.option']['sort'])), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���')), 'view' => intval($memory['catalog.option']['status']))
        );
    }

$total = $PHPShopOrm->select(array('*'), $where, $order, array('limit' => 10000));
if (is_array($total)) {
    $PHPShopInterface->_AJAX["recordsFiltered"] = count($total);
} else {
    $PHPShopInterface->_AJAX["data"] = array();
    $PHPShopInterface->_AJAX["recordsFiltered"] = 0;
}


header("Content-Type: application/json");
exit(json_encode($PHPShopInterface->_AJAX));
?>