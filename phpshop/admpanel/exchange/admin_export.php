<?php

$TitlePage = __("������� ������");
PHPShopObj::loadClass('sort');

// �������� �����
$key_name = array(
    'id' => 'Id',
    'name' => '������������',
    'uid' => '�������',
    'price' => '���� 1',
    'price2' => '���� 2',
    'price3' => '���� 3',
    'price4' => '���� 4',
    'price5' => '���� 5',
    'price_n' => '������ ����',
    'sklad' => '��� �����',
    'newtip' => '�������',
    'spec' => '���������������',
    'items' => '�����',
    'weight' => '���',
    'num' => '���������',
    'enabled' => '�����',
    'content' => '��������� ��������',
    'description' => '������� ��������',
    'pic_small' => '��������� �����������',
    'pic_big' => '������� �����������',
    'category' => '���������',
    'yml' => '������.������',
    'icon' => '������',
    'parent_to' => '��������',
    'category' => '�������',
    'title' => '���������',
    'login' => '�����',
    'tel' => '�������',
    'datas' => '����',
    'cumulative_discount' => '������������� ������',
    'seller' => '������ �������� � 1�',
    'statusi' => '������ ��������� ������',
    'fio' => '�.�.�',
    'city' => '�����',
    'street' => '�����',
    'orders' => '�����',
    'odnotip' => '������������� ������',
    'page' => '��������',
    'parent' => '����������� ������',
    'dop_cat' => '�������������� ��������',
    'ed_izm' => '������� ���������',
    'baseinputvaluta' => '������',
    'vendor_array' => '��������������',
    'p_enabled' => '������� � ������.������',
    'parent_enabled' => '������',
    'p_enabled' => '������.������ ��� �����',
    'rate' => '�������',
    'rate_count' => '������ � ��������',
    'descrip' => 'Meta description',
    'keywords' => 'Meta keywords',
    'parent_enabled' => '������ ������',
    'price_search' => '���� ��� ������',
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
    'status' => '���������� ���������',
    'seller' => '��������� � CRM',
    'country' => '������',
    'statusi' => '������',
    'state' => '������/����',
    'city' => '�����',
    'sum' => '�����'
);

// ���� ����
$key_stop = array('password', 'wishlist', 'sort', 'yml_bid_array', 'vendor', 'status', 'files');


switch ($subpath[2]) {
    case 'catalog':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
        $key_base = array('id', 'name', 'icon', 'parent_to');
        break;
    case 'user':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
        $key_base = array('id', 'login', 'name', 'tel');
        array_push($key_stop, 'tel_code', 'adres', 'inn', 'kpp', 'company', 'data_adres');
        break;
    case 'order':
        PHPShopObj::loadClass('order');
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $key_base = array('id', 'uid', 'fio', 'tel', 'datas', 'orders');
        $key_name['uid'] = '� ������';
        $TitlePage.=' �������';
        break;
    default: $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $key_base = array('id', 'name', 'uid', 'category', 'price', 'newtip', 'spec', 'items', 'enabled');
        array_push($key_stop, 'user', 'title_enabled', 'descrip_enabled', 'title_shablon', 'descrip_shablon', 'title_shablon', 'keywords_enabled', 'keywords_shablon');
        break;
}

// ������ �����
if (!empty($_COOKIE['check_memory'])) {
    $memory = json_decode($_COOKIE['check_memory'], true);
    if (is_array($memory[$_GET['path']])) {
        $key_base = array_keys($memory[$_GET['path']]);
    }
}

// ���������� ����� � �����
function actionSelect() {
    global $subpath;
    unset($_SESSION['select']);


    // ��������� ������
    if (!empty($_POST['select'])) {
        if (is_array($_POST['select'])) {
            foreach ($_POST['select'] as $k => $v)
                if (!empty($v))
                    $select[intval($k)] = intval($v);
            $_SESSION['select'][$subpath[2]] = $select;
        }
    }

    return array("success" => true);
}

// �������� ������ ��� implode
function implodeCheck(&$value) {
    $value = intval($value);
}

// �������� �����
function patternCheck(&$value) {
    $value = "`" . $value . "`";
}

// ������ ��������������� �����
function serializeSelect($str, $cols_name = false) {
    $delim = $_POST['export_delim'];
    $sortdelim = $_POST['export_sortdelim'];
    $array_line = $csv_line = null;
    $cols_array = unserialize($str);

    if (is_array($cols_array)) {

        // ���������
        $key = array_keys($cols_array);
        array_walk_recursive($key, 'implodeCheck');
        $where = array('id' => ' IN (' . implode(',', $key) . ')');

        $PHPShopSortCategoryArray = new PHPShopSortCategoryArray($where);
        $data = $PHPShopSortCategoryArray->getArray();

        if (is_array($data)) {

            foreach ($cols_array as $k => $v) {
                if (is_array($v)) {

                    // ��������
                    $val = array_values($v);
                    array_walk_recursive($val, 'implodeCheck');
                    $where = array('id' => ' IN (' . implode(',', $val) . ')');
                    $PHPShopSortArray = new PHPShopSortArray($where);
                    $data_v = $PHPShopSortArray->getArray();

                    foreach ($v as $a_v)
                        $array_line.=$data[$k]['name'] . '/' . $data_v[$a_v]['name'] . $sortdelim;
                }
            }
            $csv_line.='"' . substr($array_line, 0, (strlen($array_line) - 1)) . '"' . $delim;
        }
    }
    else
        $csv_line = '""'. $delim;

    return $csv_line;
}

// ������� ����������
function actionSave() {
    global $PHPShopOrm, $key_name, $subpath;

    $PHPShopOrm->debug = false;
    $PHPShopOrm->mysql_error = false;
    $delim = $_POST['export_delim'];
    $csv = null;
    $gz = $_POST['export_gzip'];
    $pattern_cols = $_POST['pattern_cols'];
    if (!is_array($pattern_cols))
       $pattern_cols = array('id', 'name', 'price');
    else {
        array_walk($pattern_cols, 'patternCheck');
    }

    // ������� ������ ���������
    $select_action_path = $subpath[2];
    if (empty($select_action_path))
        $select_action_path = 'product';

    if (is_array($_SESSION['select'][$select_action_path])) {
        $val = array_values($_SESSION['select'][$select_action_path]);
        $where = array('id' => ' IN (' . implode(',', $val) . ')');
    }
    else
        $where = null;

    // ������ ��������� �����
    if (is_array($_POST['pattern_cols'])) {
        $memory = json_decode($_COOKIE['check_memory'], true);
        unset($memory[$_GET['path']]);
        foreach ($_POST['pattern_cols'] as $k => $v) {
            $memory[$_GET['path']][$v] = 1;
        }
        if (is_array($memory))
            setcookie("check_memory", json_encode($memory), time() + 3600000, '/phpshop/admpanel/');
    }

    $data = $PHPShopOrm->select($pattern_cols, $where, array('order' => 'id desc'), array('limit' => $_POST['export_limit']));

    foreach ($_POST['pattern_cols'] as $cols_name) {

        if (!empty($key_name[$cols_name]))
            $name = $key_name[$cols_name];
        else
            $name = $cols_name;

        $csv.='"'.$name .'"'. $delim;
    }

    $csv = substr($csv, 0, (strlen($csv) - 1)) . "\n";

    if (is_array($data)) {
        foreach ($data as $row) {
            $csv_line = null;
            foreach ($_POST['pattern_cols'] as $cols_name) {
                if ($cols_name == 'datas')
                    $csv_line.=PHPShopDate::get($row[$cols_name]) . $delim;

                // ����� ������
                elseif ($cols_name == 'orders') {
                    $PHPShopOrderFunction = new PHPShopOrderFunction($row['id'], $row);
                    $csv_line.=$PHPShopOrderFunction->getTotal() . $delim;
                }
                // ��������������� ��������
                elseif (PHPShopString::is_serialized($row[$cols_name])) {
                    $csv_line.=serializeSelect($row[$cols_name], $cols_name);
                }
                else{
                    
                    // �������� ������ ������� < 4.0
                    if($cols_name == 'fio' and (empty($row['fio'])) and empty($row['tel'])){
                       $orders = unserialize($row['orders']);
                       if(is_array($orders["Person"])){
                       $row['fio']=$orders["Person"]['name_person'];
                       $row['tel']=$orders["Person"]['tel_code'].' '.$orders["Person"]['tel_name'];
                       $row['street']=$orders["Person"]['adr_name'];
                       $row['org_name']=$orders["Person"]['org_name'];
                       $row['org_inn']=$orders["Person"]['org_inn'];
                       $row['org_kpp']=$orders["Person"]['org_kpp'];
                       }
                    }
                    
                    $csv_line.='"' . PHPShopSecurity::CleanOut($row[$cols_name]) . '"' . $delim;
                }
            }

            $csv.=substr($csv_line, 0, (strlen($csv_line) - 1)) . "\n";
        }
    }


    $sorce = "./csv/export_" . $subpath[2] . "_" . date("d_m_y_His") . ".csv";
    PHPShopFile::write($sorce, $csv);

    if ($gz) {
        PHPShopFile::gzcompressfile($sorce);
        header("Location: " . $sorce . '.gz');
    }
    else
        header("Location: " . $sorce);

    //echo $csv;
    //return true;
}

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm, $key_name, $subpath, $key_base, $key_stop;

    $PHPShopGUI->action_button['�������'] = array(
        'name' => '�������',
        'action' => 'saveID',
        'class' => 'btn  btn-primary btn-sm navbar-btn',
        'type' => 'submit',
        'icon' => 'glyphicon glyphicon-open'
    );


    $sel_left = $sel_right = null;

    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));
    if (is_array($data))
        foreach ($data as $key => $val) {

            if (!empty($key_name[$key]))
                $name = $key_name[$key];
            else
                $name = $key;

            if (@in_array($key, $key_base))
                $sel_left.='<option value="' . $key . '" selected class="">' . ucfirst($name) . '</option>';
            elseif (!in_array($key, $key_stop))
                $sel_right.='<option value="' . $key . '" class="">' . ucfirst($name) . '</option>';
        }


    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./exchange/gui/exchange.gui.js');

    // ������
    if (empty($subpath[2])) {
        $class = false;
        $select_action = ' �������';
        $TitlePage.=$select_action;
        $select_path = 'catalog';
        $PHPShopGUI->_CODE = '<p></p><p class="text-muted">���� �������� ������ �����, ������� ����� ���� ��������������. ���������� ���� �������� ������������� ��� ����������� �������� �����, ��������� ���� ����� �������� ��� ������ �� ����� ��������� ����� �� �������.</p><p><kbd>Id</kbd> ��� <kbd>�������</kbd></p>';
    }

    // ��������
    elseif ($subpath[2] == 'catalog') {

        $class = 'hide';
        $select_action = ' ���������';
        $TitlePage.=$select_action;
        $PHPShopGUI->_CODE = '<p></p><p class="text-muted">���� �������� ������ �����, ������� ����� ���� ��������������. ���������� ���� �������� ������������� ��� ����������� �������� �����, ��������� ���� ����� �������� ��� ������ �� ����� ��������� ����� �� �������.</p><p><kbd>Id</kbd></p>';
    }

    // ������������
    elseif ($subpath[2] == 'user') {
        $class = 'hide';
        $select_path = 'shopusers';
        $select_action = ' �������������';
        $TitlePage.=$select_action;
        $PHPShopGUI->_CODE = '<p></p><p class="text-muted">���� �������� ������ �����, ������� ����� ���� ��������������. ���������� ���� �������� ������������� ��� ����������� �������� �����, ��������� ���� ����� �������� ��� ������ �� ����� ��������� ����� �� �������.</p><p><kbd>Id</kbd> ��� <kbd>�����</kbd></p>';
    }

    // ������
    elseif ($subpath[2] == 'order') {
        $class = 'hide';
        $select_path = $subpath[2];
        $PHPShopGUI->_CODE = '<p></p><p class="text-muted">���� �������� ������ �����, ������� ����� ���� ��������������. ���������� ���� �������� ������������� ��� ����������� �������� �����, ��������� ���� ����� �������� ��� ������ �� ����� ��������� ����� �� �������.</p><p><kbd>Id</kbd></p>';
    }


    $PHPShopGUI->_CODE.= '
    <table width="100%">
        <tr>
        <td class="text-center" width="48%"><label for="pattern_default">�������������� ����</label></td>
        <td> </td>
        <td class="text-center"><label for="pattern_more">��������� ����</label></td>
        </tr>
        <tr>
        <td>
        <select id="pattern_default" style="height:200px" name="pattern_cols[]" multiple class="form-control">
             ' . $sel_left . '                                 
        </select>
        </td>
        <td class="text-center"><a class="btn btn-default btn-sm" href="#" id="send-default" data-toggle="tooltip" data-placement="top" title="�������� ����"><span class="glyphicon glyphicon-chevron-left"></span></a><br><br>
        <a class="btn btn-default btn-sm" id="send-more" href="#" data-toggle="tooltip" data-placement="top" title="������ ����"><span class="glyphicon glyphicon-chevron-right"></span></a><br><br>
<a class="btn btn-default btn-sm" id="send-all" href="#" data-toggle="tooltip" data-placement="top" title="������� ��� ����"><span class="glyphicon glyphicon-backward"></span></a><br><br>
<a class="btn btn-default btn-sm" id="remove-all" href="#" data-toggle="tooltip" data-placement="top" title="������� ��� ����"><span class="glyphicon glyphicon-forward"></span></a></td>
        <td width="48%">
        <select id="pattern_more" style="height:200px" multiple class="form-control">
             ' . $sel_right . '                                    
        </select>
</td>
        </tr>
   </table>';

    $PHPShopGUI->setActionPanel($TitlePage, false, array('�������'));

    $delim_value[] = array('����� � �������', ';', 'selected');
    $delim_value[] = array('�������', ',', '');

    $delim_sortvalue[] = array('#', '#', 'selected');
    $delim_sortvalue[] = array('@', '@', '');
    $delim_sortvalue[] = array('$', '$', '');
    $delim_sortvalue[] = array('|', '|', '');

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('���������', $PHPShopGUI->setField('CSV-�����������', $PHPShopGUI->setSelect('export_delim', $delim_value, 150)) .
            $PHPShopGUI->setField('����������� ��� �������������', $PHPShopGUI->setSelect('export_sortdelim', $delim_sortvalue, 150), false, false, $class) .
            $PHPShopGUI->setField('GZIP ������', $PHPShopGUI->setCheckbox('export_gzip', 1, '��������', 0), 1, '��������� ������ ������������ �����') .
            $PHPShopGUI->setField('����� �����', $PHPShopGUI->setInputText(null, 'export_limit', '0,10000', 150), 1, '������ c 1 �� 10000')
    );

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);


    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.exchange.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.exchange.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    // ��������� ������
    $select_action_path = $subpath[2];
    if (empty($select_action_path))
        $select_action_path = 'product';
    if (is_array($_SESSION['select'][$select_action_path])) {

        if (!empty($_GET['return']))
            $select_path = $_GET['return'];

        foreach ($_SESSION['select'][$select_action_path] as $val)
            $select_message = '<span class="label label-default">' . count($_SESSION['select'][$select_action_path]) . '</span> ' . $select_action . ' �������<hr><a href="?path=' . $select_path . '""><span class="glyphicon glyphicon-ok"></span> �������� ��������</a><br><a href="#" class="text-danger select-remove"><span class="glyphicon glyphicon-remove"></span> ������� ��������</a>';
    }
    else
        $select_message = '<p class="text-muted">�� ������ ������� ���������� ������� ��� ��������, ������� �� ��������� � ������ � ���� <span class="glyphicon glyphicon-cog"></span><span class="caret"></span> <em>"�������������� ���������"</em>. �� ��������� ����� �������������� ��� �������. <a href="?path=' . $select_path . '"><span class="glyphicon glyphicon-share-alt"></span> �������</a></p>';

    $sidebarleft[] = array('title' => '��� ������', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './exchange/'));

    if (!empty($select_path))
        $sidebarleft[] = array('title' => '���������', 'content' => $select_message, 'class' => 'hidden-xs');

    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->Compile(2);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();
?>