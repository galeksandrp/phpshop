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
    'descrip' => 'Meta description',
    'keywords' => 'Meta keywords',
    "prod_seo_name" => 'SEO ������',
    'num_row' => '������� � �����',
    'num_cow' => '������� �� ��������',
    'count' => '�������� �������',
    'cat_seo_name' => 'SEO ������ ��������',
    'sum' => '�����',
    'servers' => '�������',
    'items1' => '����� 2',
    'items2' => '����� 3',
    'items3' => '����� 4',
    'items4' => '����� 5',
    'vendor' => '@��������������',
    'data_adres' => '�������',
    'color' => '��� �����',
    'parent2' => '����',
    'rate' => '�������',
    'productday' => '����� ���',
    'hit' => '���',
    'sendmail' => '�������� �� ��������',
    'statusi' => '������ ������',
    'country' => '������',
    'state' => '�������',
    'index' => '������',
    'house' => '���',
    'porch' => '�������',
    'door_phone' => '�������',
    'flat' => '��������',
    'delivtime' => '����� ��������',
    'org_name' => '�����������',
    'org_inn' => '���',
    'org_kpp' => '���',
    'org_yur_adres' => '����������� �����',
    'dop_info' => '����������� �����������',
    'tracking' => '��� ������������'
);

if ($GLOBALS['PHPShopBase']->codBase == 'utf-8')
    unset($key_name);

// ���� ����
$key_stop = array('password', 'wishlist', 'sort', 'yml_bid_array', 'status', 'files', 'datas', 'price_search', 'vid', 'name_rambler', 'servers', 'skin', 'skin_enabled', 'secure_groups', 'icon_description', 'title_enabled', 'title_shablon', 'descrip_shablon', 'descrip_enabled', 'productsgroup_check', 'productsgroup_product', 'keywords_enabled', 'keywords_shablon', 'rate_count', 'sort_cache', 'sort_cache_created_at', 'parent_title', 'menu', 'order_by', 'order_to', 'org_ras', 'org_bank', 'org_kor', 'org_bik', 'org_city', 'admin', 'org_fakt_adres');

switch ($subpath[2]) {
    case 'catalog':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
        $key_base = array('id');
        break;
    case 'user':
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
        $key_base = array('id', 'login');
        array_push($key_stop, 'tel_code', 'adres', 'inn', 'kpp', 'company', 'tel');
        break;
    case 'order':
        PHPShopObj::loadClass('order');
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
        $key_base = array('id', 'uid');
        array_push($key_stop, 'orders', 'user');
        $key_name['uid'] = __('� ������');
        $TitlePage .= ' ' . __('�������');
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
        } else
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
                    $result_1 = $PHPShopOrm->query('select sort,name from ' . $GLOBALS['SysValue']['base']['categories'] . ' where id="' . $category . '"  limit 1', __FUNCTION__, __LINE__);
                    $row_1 = mysqli_fetch_array($result_1);

                    $cat_sort = unserialize($row_1['sort']);

                    $cat_name = $row_1['name'];

                    // ����������� � ����
                    if (is_array($cat_sort))
                        $where_in = ' and a.id IN (' . @implode(",", $cat_sort) . ') ';
                    else
                        $where_in = null;

                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                    $PHPShopOrm->debug = $debug;

                    $result_2 = $PHPShopOrm->query('select a.id as parent, b.id from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['sort'] . ' AS b ON a.id = b.category where a.name="' . $sort_name . '" and b.name="' . $sort_value . '" ' . $where_in . ' limit 1', __FUNCTION__, __LINE__);
                    $row_2 = mysqli_fetch_array($result_2);

                    // ������������ �  ����
                    if (!empty($where_in) and isset($row_2['id'])) {
                        $return[$row_2['parent']][] = $row_2['id'];
                    }
                    // ����������� � ����
                    else {

                        // �������� ��������������
                        if (!empty($where_in))
                            $sort_name_present = $PHPShopBase->getNumRows('sort_categories', 'as a where a.name="' . $sort_name . '" ' . $where_in . ' limit 1');

                        // ������� ����� ��������������
                        if (empty($sort_name_present) and ! empty($category)) {

                            // ����
                            if (!empty($cat_sort[0])) {
                                $PHPShopOrm = new PHPShopOrm();
                                $PHPShopOrm->debug = $debug;

                                $result_3 = $PHPShopOrm->query('select category from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' where id="' . intval($cat_sort[0]) . '"  limit 1', __FUNCTION__, __LINE__);
                                $row_3 = mysqli_fetch_array($result_3);
                                $cat_set = $row_3['category'];
                            }
                            // ���, ������� ����� �����
                            else {

                                // �������� ������ �������������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                                $PHPShopOrm->debug = $debug;
                                $cat_set = $PHPShopOrm->insert(array('name_new' => __('��� ��������') . ' ' . $cat_name, 'category_new' => 0), '_new', __FUNCTION__, __LINE__);
                            }

                            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                            $PHPShopOrm->debug = $debug;
                            if ($parent = $PHPShopOrm->insert(array('name_new' => $sort_name, 'category_new' => $cat_set), '_new', __FUNCTION__, __LINE__)) {

                                // ������� ����� �������� ��������������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                                $PHPShopOrm->debug = $debug;
                                $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent), '_new', __FUNCTION__, __LINE__);

                                $return[$parent][] = $slave;
                                $cat_sort[] = $parent;

                                // ��������� ����� �������� �������
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
                                $PHPShopOrm->debug = $debug;
                                $PHPShopOrm->update(array('sort_new' => serialize($cat_sort)), array('id' => '=' . $category), '_new', __FUNCTION__, __LINE__);
                            }
                        }
                        // ���������� �������� 
                        else {

                            // �������� �� ������������ ��������������
                            $PHPShopOrm = new PHPShopOrm();
                            $PHPShopOrm->debug = $debug;
                            $result = $PHPShopOrm->query('select a.id  from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a where a.name="' . $sort_name . '" ' . $where_in . ' limit 1', __FUNCTION__, __LINE__);
                            if ($row = mysqli_fetch_array($result)) {
                                $parent = $row['id'];
                                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                                $PHPShopOrm->debug = $debug;
                                $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent), '_new', __FUNCTION__, __LINE__);

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
    global $PHPShopOrm, $PHPShopBase, $csv_load_option, $key_name, $csv_load_count, $subpath, $PHPShopSystem;

    // ��������� UTF-8
    if ($_POST['export_code'] == 'utf' and is_array($data)) {
        foreach ($data as $k => $v)
            $data[$k] = PHPShopString::utf8_win1251($v);
    }


    require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/thumb/phpthumb.php';
    $width_kratko = $PHPShopSystem->getSerilizeParam('admoption.width_kratko');
    $img_tw = $PHPShopSystem->getSerilizeParam('admoption.img_tw');
    $img_th = $PHPShopSystem->getSerilizeParam('admoption.img_th');

    if (is_array($data)) {

        $key_name_true = array_flip($key_name);

        // ����� �����
        if (empty($csv_load_option)) {
            $select = false;

            // ������������� �����
            if (is_array($_POST['select_action'])) {

                foreach ($_POST['select_action'] as $k => $name) {

                    if (!empty($name))
                        $select = true;

                    if (substr($name, 0, 1) == '@')
                        $_POST['select_action'][$k] = '@' . $data[$k];
                }
            }

            if ($select)
                $csv_load_option = $_POST['select_action'];
            else
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

                // ���� �������������
                if (!empty($key_name_true[$cols_name])) {
                    $row[$key_name_true[$cols_name]] = $data[$k];
                }
                // ���� �������������� � ��������
                elseif (substr($cols_name, 0, 1) == '@') {
                    $row[$cols_name] = $data[$k];
                    $sort_name = substr($cols_name, 1, (strlen($cols_name) - 1));

                    // ��������� ��������
                    if (strstr($data[$k], ',')) {
                        $sort_array = explode(',', $data[$k]);
                    } else
                        $sort_array[] = $data[$k];

                    if (is_array($sort_array)) {
                        foreach ($sort_array as $v)
                            $row['vendor_array'] .= $sort_name . $_POST['export_sortsdelim'] . $v . $_POST['export_sortdelim'];
                    }

                    unset($row[$cols_name]);
                    unset($sort_array);
                }
                // ���������
                else
                    $row[$cols_name] = $data[$k];
            }

            // ������� ������������
            if (!empty($row['data_adres'])) {
                $tel['main'] = 0;
                $tel['list'][0]['tel_new'] = $row['data_adres'];
                $row['data_adres'] = serialize($tel);
            }

            // ��������� ����� �������
            if (isset($row['parent']) and $row['parent'] == '')
                unset($row['parent']);

            // ��������������
            if (!empty($row['vendor_array'])) {
                $row['vendor'] = null;
                $vendor_array = sort_encode($row['vendor_array'], $row['category']);

                if (is_array($vendor_array)) {
                    $row['vendor_array'] = serialize($vendor_array);
                    foreach ($vendor_array as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $p) {
                                $row['vendor'] .= "i" . $k . "-" . $p . "i";
                            }
                        } else
                            $row['vendor'] .= "i" . $k . "-" . $v . "i";
                    }
                } else
                    $row['vendor_array'] = null;
            }

            // ������ ���� � �������������
            if (isset($_POST['export_imgpath'])) {
                if (!empty($row['pic_small']))
                    $row['pic_small'] = '/UserFiles/Image/' . $row['pic_small'];
            }

            // �������������� �����������
            if (!empty($_POST['export_imgdelim']) and strstr($row['pic_big'], $_POST['export_imgdelim'])) {
                $data_img = explode($_POST['export_imgdelim'], $row['pic_big']);
            } else
                $data_img[] = $row['pic_big'];

            if (is_array($data_img)) {
                foreach ($data_img as $k => $img) {

                    if (!empty($img)) {

                        // ������� �����������
                        if ($k == 0) {
                            if (isset($_POST['export_imgpath']) and ! empty($img))
                                $row['pic_big'] = '/UserFiles/Image/' . $img;
                            elseif (!empty($img))
                                $row['pic_big'] = $img;
                        }

                        // ������ ���� � ������������
                        if (isset($_POST['export_imgpath']))
                            $img = '/UserFiles/Image/' . $img;

                        // �������� ������������� �����������
                        $PHPShopOrmImg = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
                        $check = $PHPShopOrmImg->select(array('name'), array('name' => '="' . $img . '"', 'parent' => '=' . intval($row['id'])), false, array('limit' => 1));

                        // ������� �����
                        if (!is_array($check)) {

                            // ������ � �����������
                            $PHPShopOrmImg->insert(array('parent_new' => intval($row['id']), 'name_new' => $img, 'num_new' => $k));

                            $file = $_SERVER['DOCUMENT_ROOT'] . $img;
                            $name = str_replace(array(".png", ".jpg", ".jpeg", ".gif"), array("s.png", "s.jpg", "s.jpeg", "s.gif"), $file);

                            if (!file_exists($name) and file_exists($file)) {

                                // ��������� �������� 
                                if (isset($_POST['export_imgproc'])) {
                                    $thumb = new PHPThumb($file);
                                    $thumb->setOptions(array('jpegQuality' => $width_kratko));
                                    $thumb->resize($img_tw, $img_th);
                                    $thumb->save($name);
                                }
                                else copy($file,$name);
                            }
                        }
                    }
                }
            }
            // ������ ���� � �������������
            else if (isset($_POST['export_imgpath']) and ! empty($row['pic_big']))
                $row['pic_big'] = '/UserFiles/Image/' . $row['pic_big'];

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
                if (empty($subpath[2]) and ! empty($_POST['export_uniq']) and ! empty($row['uid'])) {
                    $uniq = $PHPShopBase->getNumRows('products', "where uid = '" . $row['uid'] . "'");
                } else
                    $uniq = 0;

                if (empty($uniq)) {

                    $insertID = $PHPShopOrm->insert($row, '');
                    if (is_numeric($insertID)) {

                        $PHPShopOrm->clean();

                        // ��������� ID � ����������� ������ ������
                        if ($PHPShopOrmImg)
                            $PHPShopOrmImg->update(array('parent_new' => $insertID), array('parent' => '=0'));

                        // �������
                        $csv_load_count++;
                    }
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


                        // ��������� ID � ����������� ������ �� ��������
                        if (!empty($where['uid']) and is_array($data_img) and $PHPShopOrmImg) {

                            $PHPShopOrmProduct = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                            $data_product = $PHPShopOrmProduct->select(array('id'), array('uid' => $where['uid']), false, array('limit' => 1));

                            $PHPShopOrmImg->update(array('parent_new' => $data_product['id']), array('parent' => '=0'));
                        }

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
    $memory[$_GET['path']]['export_imgdelim'] = $_POST['export_imgdelim'];
    $memory[$_GET['path']]['export_imgpath'] = $_POST['export_imgpath'];
    $memory[$_GET['path']]['export_uniq'] = $_POST['export_uniq'];
    $memory[$_GET['path']]['export_action'] = $_POST['export_action'];
    $memory[$_GET['path']]['export_delim'] = $_POST['export_delim'];
    $memory[$_GET['path']]['export_imgproc'] = $_POST['export_imgproc'];
    
    if (is_array($memory))
        setcookie("check_memory", json_encode($memory), time() + 3600000, $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/admpanel/');

    // �������� csv �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if ($_FILES['file']['ext'] == "csv") {
            if (@move_uploaded_file($_FILES['file']['tmp_name'], "csv/" . $_FILES['file']['name'])) {
                $csv_file = "csv/" . $_FILES['file']['name'];
                $csv_file_name = $_FILES['file']['name'];
            } else
                $result_message = $PHPShopGUI->setAlert(__('������ ���������� �����') . ' <strong>' . $csv_file_name . '</strong> � phpshop/admpanel/csv', 'danger');
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
        $result = PHPShopFile::readCsv($csv_file, 'csv_update', $delim);

        if ($result) {

            if (empty($csv_load_count))
                $result_message = $PHPShopGUI->setAlert(__('����') . ' <strong>' . $csv_file_name . '</strong> ' . __('��������. ����������') . ' <strong>' . intval($csv_load_count) . '</strong> ' . __('�����. �� ������ ���� ���������� <kbd>Id</kbd> ��� <kbd>�������</kbd>'), 'warning');
            else
                $result_message = $PHPShopGUI->setAlert(__('����') . ' <strong>' . $csv_file_name . '</strong> ' . __('��������. ����������') . ' <strong>' . intval($csv_load_count) . '</strong> ' . __('�����.'));
        } else
            $result_message = $PHPShopGUI->setAlert(__('��� ���� �� ������ �����') . ' ' . $csv_file, 'danger');
    }
}

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopOrm, $key_name, $subpath, $key_base, $key_stop, $result_message;

    $PHPShopGUI->action_button['������'] = array(
        'name' => __('������'),
        'action' => 'saveID',
        'class' => 'btn btn-primary btn-sm navbar-btn',
        'type' => 'submit',
        'icon' => 'glyphicon glyphicon-save'
    );

    $list = null;
    $PHPShopOrm->clean();
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));
    $select_value[] = array('�� �������', false, false);
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

                $list .= '<div class="pull-left" style="width:190px;min-height: 19px;"><kbd class="' . $kbd_class . '">' . ucfirst($name) . '</kbd></div>';
                $help = 'data-subtext="<span class=\'glyphicon glyphicon-flag text-success\'></span>"';
            }
            elseif (!in_array($key, $key_stop)) {
                $list .= '<div class="pull-left" style="width:190px;min-height: 19px;">' . ucfirst($name) . '</div>';
                $help = null;
            }

            $select_value[] = array(ucfirst($name), ucfirst($name), false, $help);
        }
    } else
        $list = '<span class="text-warning hidden-xs">' . __('������������ ������ ��� �������� ����� �����. �������� ���� ������ � ������ ������� � ������ ������ ��� ������ ������') . '.</span>';

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./exchange/gui/exchange.gui.js');
    $PHPShopGUI->_CODE = $result_message;

    // ������
    if (empty($subpath[2])) {
        $class = false;
        $TitlePage .= ' ' . __('�������');
    }

    // ��������
    elseif ($subpath[2] == 'catalog') {
        $class = 'hide';
        $TitlePage .= ' ' . __('���������');
    }

    // ������������
    elseif ($subpath[2] == 'user') {
        $class = 'hide';
        $TitlePage .= ' ' . __('�������������');
    }

    // ������������
    elseif ($subpath[2] == 'order') {
        $class = 'hide';
    }

    $PHPShopGUI->_CODE .= '<p class="text-muted hidden-xs">' . __('���� �������� ������ �����, ������� ����� ��������� ��� ����. ���� �� ���������� ����� �������� �������������. ���� �� ������������ ������, ���������� ����������� ������� (�������, ����� � �������� � �.�.), ��������������� ���� ������ ���� ��������� � �������') . '.</p>';
    $PHPShopGUI->_CODE .= '<div class="panel panel-default"><div class="panel-body">' . $list . '</div></div>';
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
        $export_imgvalue = $memory[$_GET['path']]['export_imgdelim'];
    }

    $delim_value[] = array('����� � �������', ';', $memory[$_GET['path']]['export_delim']);
    $delim_value[] = array('�������', ',', $memory[$_GET['path']]['export_delim']);

    $action_value[] = array('����������', 'update', $memory[$_GET['path']]['export_action']);
    $action_value[] = array('��������', 'insert', $memory[$_GET['path']]['export_action']);

    $delim_sortvalue[] = array('#', '#', $export_sortdelim);
    $delim_sortvalue[] = array('@', '@', $export_sortdelim);
    $delim_sortvalue[] = array('$', '$', $export_sortdelim);
    $delim_sortvalue[] = array('|', '|', $export_sortdelim);

    $delim_sort[] = array('/', '/', $export_sortsdelim);
    $delim_sort[] = array('\\', '\\', $export_sortsdelim);
    $delim_sort[] = array('-', '-', $export_sortsdelim);
    $delim_sort[] = array('&', '&', $export_sortsdelim);

    $delim_imgvalue[] = array(__('���������'), 0, $export_imgvalue);
    $delim_imgvalue[] = array(__('�������'), ',', $export_imgvalue);
    $delim_imgvalue[] = array('#', '#', $export_imgvalue);
    $delim_imgvalue[] = array(__('������'), ' ', $export_imgvalue);

    $code_value[] = array('ANSI', 'ansi', 'selected');
    $code_value[] = array('UTF-8', 'utf', '');

    // �������� 1
    $Tab1 = $PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('export_action', $action_value, 150, true)) .
            $PHPShopGUI->setField('CSV-�����������', $PHPShopGUI->setSelect('export_delim', $delim_value, 150, true)) .
            $PHPShopGUI->setField('����������� ��� �������������', $PHPShopGUI->setSelect('export_sortdelim', $delim_sortvalue, 150), false, false, $class) .
            $PHPShopGUI->setField('����������� �������� �������������', $PHPShopGUI->setSelect('export_sortsdelim', $delim_sort, 150), false, false, $class) .
            $PHPShopGUI->setField('������ ���� ��� �����������', $PHPShopGUI->setCheckbox('export_imgpath', 1, '��������', $memory[$_GET['path']]['export_imgpath']), 1, '��������� � ������������ ����� /UserFiles/Image/', $class) .
            $PHPShopGUI->setField('��������� �����������', $PHPShopGUI->setCheckbox('export_imgproc', 1, '��������', $memory[$_GET['path']]['export_imgproc']), 1, '�������� ��������� � ����������', $class) .
            $PHPShopGUI->setField('����������� ��� �����������', $PHPShopGUI->setSelect('export_imgdelim', $delim_imgvalue, 150), 1, '�������������� �����������', $class) .
            $PHPShopGUI->setField('��������� ������', $PHPShopGUI->setSelect('export_code', $code_value, 150)) .
            $PHPShopGUI->setField('�������� ������������', $PHPShopGUI->setCheckbox('export_uniq', 1, '��������', $memory[$_GET['path']]['export_uniq']), 1, '��������� ������������ ������ ��� ��������') .
            $PHPShopGUI->setField("����", $PHPShopGUI->setFile());

    // �������� 2
    $Tab2 = $PHPShopGUI->setField('������� 1', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 2', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 3', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 4', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 5', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 6', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 7', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 8', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));
    $Tab2 .= $PHPShopGUI->setField('������� 9', $PHPShopGUI->setSelect('select_action[]', $select_value, 150, true));

    $PHPShopGUI->tab_return = true;
    $PHPShopGUI->setTab(array('���������', $Tab1, true), array('������������� �����', $Tab2, true));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.exchange.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.exchange.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    $help = '<p class="text-muted data-row">' . __('��� ������� ������ ����� �������') . ' <a href="?path=exchange.export"><span class="glyphicon glyphicon-share-alt"></span>' . __('������ �����') . '</a>' . __(', ������ ������ ��� ����. ����� ������/�������� ������ ����������, �� ������� ��������� � �������� ����') . ' <em> ' . __('"������ ������"') . '</em></p>';

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