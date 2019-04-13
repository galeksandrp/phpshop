<?php

$TitlePage = __("������ ������");

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
    'yml' => '������.������',
    'icon' => '������',
    'parent_to' => '��������',
    'category' => '�������',
    'title' => '���������',
    'login' => '�����',
    'tel' => '�������',
    'cumulative_discount' => '������������� ������',
    'seller' => '������ �������� � 1�',
    'fio' => '�.�.�',
    'city' => '�����',
    'street' => '�����',
    'odnotip' => '������������� ������',
    'page' => '��������',
    'parent' => '����������� ������',
    'dop_cat' => '�������������� ��������',
    'ed_izm' => '������� ���������',
    'baseinputvaluta' => '������',
    'vendor_array' => '��������������',
    'p_enabled' => '������� � ������.������',
    'parent_enabled' => '������',
    'data_adres' => '�����',
    'descrip' => 'Meta description',
    'keywords' => 'Meta keywords',
    "prod_seo_name" => 'SEO ������',
    'num_row' => '������� � �����',
    'num_cow' => '������� �� ��������',
    'count' => '�������� �������',
    'cat_seo_name' => 'SEO ������ ��������',
    'sum' => '�����'
);


// ���� ����
$key_stop = array('password', 'wishlist', 'data_adres', 'sort', 'yml_bid_array', 'vendor', 'status', 'files', 'datas', 'price_search', 'vid', 'name_rambler', 'servers', 'skin', 'skin_enabled', 'secure_groups', 'icon_description');

switch ($subpath[2]) {
    case 'catalog':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
        $key_base = array('id');
        break;
    case 'user':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
        $key_base = array('id', 'login');
        array_push($key_stop, 'tel_code', 'adres', 'inn', 'kpp', 'company');
        break;
    case 'order':
        PHPShopObj::loadClass('order');
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $key_base = array('id', 'uid');
        $key_name['uid'] = '� ������';
        $TitlePage.=' �������';
        break;
    default: $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $key_base = array('id', 'uid');
        break;
}

function sort_encode($sort, $category) {
    global $PHPShopBase;

    $return = null;
    $delim = $_POST['export_sortdelim'];
    $sortsdelim = $_POST['export_sortsdelim'];
    $debug = false;
    if (!empty($sort)) {

        if (strstr($sort, $delim)) {
            $sort_array = explode($delim, $sort);
        }
        else
            $sort_array[] = $sort;

        if (is_array($sort_array))
            foreach ($sort_array as $sort_list) {

                if (strstr($sort_list, $sortsdelim)) {

                    $sort_list_array = explode($sortsdelim, $sort_list, 2);
                    $sort_name = PHPShopSecurity::TotalClean($sort_list_array[0]);
                    $sort_value = PHPShopSecurity::TotalClean($sort_list_array[1]);

                    // �������� �� ������ ������������� � ��������
                    $PHPShopOrm = new PHPShopOrm();
                    $PHPShopOrm->debug = $debug;
                    $result_1 = $PHPShopOrm->query('select sort,name from ' . $GLOBALS['SysValue']['base']['categories'] . ' where id="' . $category . '"  limit 1',__FUNCTION__,__LINE__);
                    $row_1 = mysqli_fetch_array($result_1);

                    $cat_sort = unserialize($row_1['sort']);
                    
                    $cat_name = $row_1['name'];
                    
                    // ����������� � ����
                    if (is_array($cat_sort))
                        $where_in=' and a.id IN (' . @implode(",", $cat_sort) . ') ';
                    else $where_in=null;

                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                    $PHPShopOrm->debug = $debug;

                    $result_2 = $PHPShopOrm->query('select a.id as parent, b.id from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['sort'] . ' AS b ON a.id = b.category where a.name="' . $sort_name . '" and b.name="' . $sort_value . '" '.$where_in.' limit 1',__FUNCTION__,__LINE__);
                    $row_2 = mysqli_fetch_array($result_2);

                    // ������������ �  ����
                    if (!empty($where_in) and isset($row_2['id'])) {
                        $return[$row_2['parent']][] = $row_2['id'];
                    }
                    // ����������� � ����
                    else {
                        
                        
                        // �������� ��������������
                        if(!empty($where_in))
                        $sort_name_present = $PHPShopBase->getNumRows('sort_categories', 'as a where a.name="' . $sort_name . '" '.$where_in.' limit 1');

                        // ������� ����� ��������������
                        if (empty($sort_name_present) and !empty($category)) {

                            // ����
                            if (!empty($cat_sort[0])) {
                                $PHPShopOrm = new PHPShopOrm();
                                $PHPShopOrm->debug = $debug;

                                $result_3 = $PHPShopOrm->query('select category from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' where id="' . intval($cat_sort[0]) . '"  limit 1',__FUNCTION__,__LINE__);
                                $row_3 = mysqli_fetch_array($result_3);
                                $cat_set = $row_3['category'];
                            }
                            // ���, ������� ����� �����
                            else {

                                // �������� ������ �������������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                                $PHPShopOrm->debug = $debug;
                                $cat_set = $PHPShopOrm->insert(array('name_new' => __('��� ��������').' ' . $cat_name, 'category_new' => 0),'_new',__FUNCTION__,__LINE__);
                            }


                            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                            $PHPShopOrm->debug = $debug;
                            if ($parent = $PHPShopOrm->insert(array('name_new' => $sort_name, 'category_new' => $cat_set),'_new',__FUNCTION__,__LINE__)) {

                                // ������� ����� �������� ��������������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                                $PHPShopOrm->debug = $debug;
                                $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent),'_new',__FUNCTION__,__LINE__);

                                $return[$parent][] = $slave;
                                $cat_sort[] = $parent;

                                // ��������� ����� �������� �������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
                                $PHPShopOrm->debug = $debug;
                                $PHPShopOrm->update(array('sort_new' => serialize($cat_sort)), array('id' => '=' . $category),'_new',__FUNCTION__,__LINE__);
                            }
                        }
                        // ���������� �������� 
                        else {

                            // �������� �� ������������ ��������������
                            $PHPShopOrm = new PHPShopOrm();
                            $PHPShopOrm->debug = $debug;
                            $result = $PHPShopOrm->query('select a.id  from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a where a.name="' . $sort_name . '" '.$where_in.' limit 1',__FUNCTION__,__LINE__);
                            if ($row = mysqli_fetch_array($result)) {
                                $parent = $row['id'];
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                                $PHPShopOrm->debug = $debug;
                                $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent),'_new',__FUNCTION__,__LINE__);

                                $return[$parent][] = $slave;
                            }
                        }
                    }
                }
            }
    }

    return $return;
}

// ��������� ������ CSV
function csv_update($data) {
    global $PHPShopOrm, $PHPShopBase, $csv_load_option, $key_name, $csv_load_count, $subpath;

    if (is_array($data)) {

        $key_name_true = array_flip($key_name);

        // ����� �����
        if (empty($csv_load_option)) {
            $csv_load_option = $data;
        }
        // ��������
        else {

            // ����������� �����
            foreach ($csv_load_option as $k => $cols_name) {

                // base64
                if (substr($data[$k], 0, 7) == 'base64-') {

                    // ������������
                    if ($subpath[2] == 'user') {
                        $array = array();
                        $array['main'] = 0;
                        $array['list'][] = json_decode(base64_decode(substr($data[$k], 7, strlen($data[$k]) - 7)), true);
                        array_walk_recursive($array, 'array2iconv');

                        $data[$k] = serialize($array);
                    }
                }

                if (!empty($key_name_true[$cols_name]))
                    $row[$key_name_true[$cols_name]] = $data[$k];
                else
                    $row[$cols_name] = $data[$k];
            }

            // ��������������
            if (!empty($row['vendor_array'])) {
                $row['vendor'] = null;
                $vendor_array = sort_encode($row['vendor_array'], $row['category']);

                if (is_array($vendor_array)) {
                    $row['vendor_array'] = serialize($vendor_array);
                    foreach ($vendor_array as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $p) {
                                $row['vendor'].="i" . $k . "-" . $p . "i";
                            }
                        }
                        else
                            $row['vendor'].="i" . $k . "-" . $v . "i";
                    }
                }
                else
                    $row['vendor_array'] = null;
            }

            // ������ ���� � �������������
            if (isset($_POST['export_imgpath'])) {
                if (!empty($row['pic_small']))
                    $row['pic_small'] = '/UserFiles/Image/' . $row['pic_small'];
                if (!empty($row['pic_big']))
                    $row['pic_big'] = '/UserFiles/Image/' . $row['pic_big'];
            }

            // �������� ������
            if ($_POST['export_action'] == 'insert') {

                $PHPShopOrm->debug = false;
                $PHPShopOrm->mysql_error = false;

                // ���������� �� ������
                if (isset($row['items'])) {
                    switch ($GLOBALS['admoption_sklad_status']) {

                        case(3):
                            if ($row['items'] < 1) {
                                $row['sklad'] = 1;
                            } else {
                                $row['sklad'] = 0;
                            }
                            break;

                        case(2):
                            if ($row['items'] < 1) {
                                $row['enabled'] = 0;
                            } else {
                                $row['enabled'] = 1;
                            }
                            break;

                        default:
                            break;
                    }
                }

                // ���� ��������
                $row['datas'] = time();

                // �������� ������������ �������
                if (empty($subpath[2]) and !empty($_POST['export_uniq']) and !empty($row['uid'])) {
                    $uniq = $PHPShopBase->getNumRows('products', "where uid = '" . $row['uid'] . "'");
                }
                else
                    $uniq = 0;

                if (empty($uniq))
                    if (is_numeric($PHPShopOrm->insert($row, ''))) {

                        $PHPShopOrm->clean();

                        // �������
                        $csv_load_count++;
                    }
            }
            // ���������� ������
            else {
                // ���������� �� ID
                if (isset($row['id'])) {
                    $where = array('id' => '="' . intval($row['id']) . '"');
                    unset($row['id']);
                }

                // ���������� �� ��������
                elseif (isset($row['uid'])) {
                    $where = array('uid' => '="' . $row['uid'] . '"');
                    unset($row['uid']);
                }

                // ���������� �� ������
                elseif (isset($row['login'])) {
                    $where = array('login' => '="' . $row['login'] . '"');
                    unset($row['login']);
                }

                // ������
                else {
                    unset($row);
                    return false;
                }

                // ���������� �� ������
                if (isset($row['items'])) {
                    switch ($GLOBALS['admoption_sklad_status']) {

                        case(3):
                            if ($row['items'] < 1) {
                                $row['sklad'] = 1;
                            } else {
                                $row['sklad'] = 0;
                            }
                            break;

                        case(2):
                            if ($row['items'] < 1) {
                                $row['enabled'] = 0;
                            } else {
                                $row['enabled'] = 1;
                            }
                            break;

                        default:
                            break;
                    }
                }

                // ���� ����������
                $row['datas'] = time();

                if (!empty($where)) {
                    $PHPShopOrm->debug = false;
                    if ($PHPShopOrm->update($row, $where, '') === true) {

                        // �������
                        $csv_load_count++;
                    }
                }
            }
        }
    }
}

// ������� ����������
function actionSave() {
    global $PHPShopGUI, $PHPShopSystem, $key_name, $key_name, $result_message, $csv_load_count;

    $delim = $_POST['export_delim'];

    // ��������� �������� ������
    $GLOBALS['admoption_sklad_status'] = $PHPShopSystem->getSerilizeParam('admoption.sklad_status');

    // ������ ������������ �������������
    $memory = json_decode($_COOKIE['check_memory'], true);
    unset($memory[$_GET['path']]);
    $memory[$_GET['path']]['export_sortdelim'] = $_POST['export_sortdelim'];
    $memory[$_GET['path']]['export_sortsdelim'] = $_POST['export_sortsdelim'];

    if (is_array($memory))
        setcookie("check_memory", json_encode($memory), time() + 3600000, $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/admpanel/');


    // �������� csv �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if ($_FILES['file']['ext'] == "csv") {
            if (move_uploaded_file($_FILES['file']['tmp_name'], "csv/" . $_FILES['file']['name'])) {
                $csv_file = "csv/" . $_FILES['file']['name'];
                $csv_file_name = $_FILES['file']['name'];
            }
            else
                $result_message = $PHPShopGUI->setAlert(__('������ ���������� �����').' <strong>' . $csv_file_name . '</strong> � phpshop/admpanel/csv', 'danger');
        }
    }

    // ������ csv �� URL
    elseif (!empty($_POST['furl'])) {
        $csv_file = $_POST['furl'];
        $path_parts = pathinfo($csv_file);
        $csv_file_name = $path_parts['basename'];
    }

    // ������ csv �� ��������� ���������
    elseif (!empty($_POST['lfile'])) {
        $csv_file = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $_POST['lfile'];
        $path_parts = pathinfo($csv_file);
        $csv_file_name = $path_parts['basename'];
    }

    // ��������� csv
    if (!empty($csv_file)) {

        PHPShopObj::loadClass('file');
        PHPShopFile::readCsv($csv_file, 'csv_update', $delim);

        if (empty($csv_load_count))
            $result_message = $PHPShopGUI->setAlert(__('����').' <strong>' . $csv_file_name . '</strong> '.__('��������. ����������').' <strong>' . intval($csv_load_count) . '</strong> '.__('�����. �� ������ ���� ���������� <kbd>Id</kbd> ��� <kbd>�������</kbd>'), 'warning');
        else
            $result_message = $PHPShopGUI->setAlert(__('����').' <strong>' . $csv_file_name . '</strong> '.__('��������. ����������').' <strong>' . intval($csv_load_count) . '</strong> '.__('�����.'));
    }
}

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm, $key_name, $subpath, $key_base, $key_stop, $result_message;

    $PHPShopGUI->action_button['������'] = array(
        'name' => '���������',
        'action' => 'saveID',
        'class' => 'btn btn-primary btn-sm navbar-btn',
        'type' => 'submit',
        'icon' => 'glyphicon glyphicon-save'
    );

    $list = null;
    $PHPShopOrm->clean();
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));
    if (is_array($data)) {
        foreach ($data as $key => $val) {

            if (!empty($key_name[$key]))
                $name = $key_name[$key];
            else
                $name = $key;

            if (@in_array($key, $key_base)) {
                if ($key == 'id')
                    $kbd_class = 'enabled';
                else
                    $kbd_class = null;

                $list.='<div class="pull-left" style="width:200px;"><kbd class="' . $kbd_class . '">' . ucfirst($name) . '</kbd></div>';
            }
            elseif (!in_array($key, $key_stop))
                $list.='<div class="pull-left" style="width:200px">' . ucfirst($name) . '</div>';
        }
    }
    else
        $list = '<span class="text-warning hidden-xs">'.__('������������ ������ ��� �������� ����� �����. �������� ���� ������ � ������ ������� � ������ ������ ��� ������ ������').'.</span>';

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./exchange/gui/exchange.gui.js');
    $PHPShopGUI->_CODE = $result_message;

    // ������
    if (empty($subpath[2])) {
        $class = false;
        $TitlePage.=' �������';
    }

    // ��������
    elseif ($subpath[2] == 'catalog') {
        $class = 'hide';
        $TitlePage.=' ���������';
    }

    // ������������
    elseif ($subpath[2] == 'user') {
        $class = 'hide';
        $TitlePage.=' �������������';
    }

    // ������������
    elseif ($subpath[2] == 'order') {
        $class = 'hide';
    }

    $PHPShopGUI->_CODE.= '<p class="text-muted hidden-xs">'.__('���� �������� ������ �����, ������� ����� ��������� ��� ����. ���� �� ���������� ����� �������� �������������. ���� �� ������������ ������, ���������� ����������� ������� (�������, ����� � �������� � �.�.), ��������������� ���� ������ ���� ��������� � �������').'.</p>';
    $PHPShopGUI->_CODE.= '<div class="panel panel-default"><div class="panel-body">' . $list . '</div></div>';
    $PHPShopGUI->setActionPanel($TitlePage, false, array('������'));

    // ������ �����
    if (!empty($_POST['export_sortdelim']))
        $export_sortdelim = $_POST['export_sortdelim'];
    else
        $export_sortdelim = '#';

    if (!empty($_POST['export_sortsdelim']))
        $export_sortdelim = $_POST['export_sortsdelim'];
    else
        $export_sortsdelim = '/';

    if (!empty($_COOKIE['check_memory'])) {
        $memory = json_decode($_COOKIE['check_memory'], true);
        $export_sortdelim = $memory[$_GET['path']]['export_sortdelim'];
        $export_sortsdelim = $memory[$_GET['path']]['export_sortsdelim'];
    }

    $delim_value[] = array('����� � �������', ';', 'selected');
    $delim_value[] = array('�������', ',', '');

    $action_value[] = array('����������', 'update', 'selected');
    $action_value[] = array('��������', 'insert', '');

    $delim_sortvalue[] = array('#', '#', $export_sortdelim);
    $delim_sortvalue[] = array('@', '@', $export_sortdelim);
    $delim_sortvalue[] = array('$', '$', $export_sortdelim);
    $delim_sortvalue[] = array('|', '|', $export_sortdelim);

    $delim_sort[] = array('/', '/', $export_sortsdelim);
    $delim_sort[] = array('\\', '\\', $export_sortsdelim);
    $delim_sort[] = array('-', '-', $export_sortsdelim);
    $delim_sort[] = array('&', '&', $export_sortsdelim);

    $PHPShopGUI->_CODE.=$PHPShopGUI->setCollapse('���������', $PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('export_action', $action_value, 150,true)) .
            $PHPShopGUI->setField('CSV-�����������', $PHPShopGUI->setSelect('export_delim', $delim_value, 150,true)) .
            $PHPShopGUI->setField('����������� �������������', $PHPShopGUI->setSelect('export_sortdelim', $delim_sortvalue, 150), false, false, $class) .
            $PHPShopGUI->setField('����������� �������� �������������', $PHPShopGUI->setSelect('export_sortsdelim', $delim_sort, 150), false, false, $class) .
            $PHPShopGUI->setField('������ ���� ��� �����������', $PHPShopGUI->setCheckbox('export_imgpath', 1, '��������', 0), 1, '��������� � ������������ ����� /UserFiles/Image/') .
            $PHPShopGUI->setField('�������� ������������', $PHPShopGUI->setCheckbox('export_uniq', 1, '��������', 0, 'disabled'), 1, '��������� ������������ ������ ��� ��������') .
            $PHPShopGUI->setField("����", $PHPShopGUI->setFile())
    );

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.exchange.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.exchange.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $help = '<p class="text-muted data-row">'.__('��� ������� ������ ����� ������� <a href="?path=exchange.export"><span class="glyphicon glyphicon-share-alt"></span>������ �����</a>, ������ ������ ��� ����. ����� ������/�������� ������ ����������, �� ������� ��������� � �������� ���� <em>"������ ������"</em>').'.</p>';

    $sidebarleft[] = array('title' => '��� ������', 'content' => $PHPShopGUI->loadLib('tab_menu', false, './exchange/'));
    $sidebarleft[] = array('title' => '���������', 'content' => $help, 'class' => 'hidden-xs');

    $PHPShopGUI->setSidebarLeft($sidebarleft, 2);

    // �����
    $PHPShopGUI->Compile(2);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();
?>