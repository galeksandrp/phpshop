<?php

$TitlePage = __("�������� ������");
PHPShopObj::loadClass('valuta');
PHPShopObj::loadClass('category');

$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

// ����������� ���������� ������ ����
function getKeyView($val) {
    global $key_placeholder, $key_format;

    if (strpos($val['Type'], "(")) {
        $a = explode("(", $val['Type']);
        $b = $a[0];
    }
    else
        $b = $val['Type'];

    $key_view = array(
        'varchar' => array('type' => 'text', 'name' => $val['Field'] . '_new', 'placeholder' => $key_placeholder[$val['Field']]),
        'text' => array('type' => 'textarea', 'height' => 150, 'name' => $val['Field'] . '_new', 'placeholder' => $key_placeholder[$val['Field']]),
        'int' => array('type' => 'text', 'size' => 100, 'name' => $val['Field'] . '_new', 'placeholder' => $key_placeholder[$val['Field']]),
        'float' => array('type' => 'text', 'size' => 200, 'name' => $val['Field'] . '_new', 'placeholder' => $key_placeholder[$val['Field']]),
        'enum' => array('type' => 'checkbox', 'name' => $val['Field'] . '_new', 'value' => 1, 'caption' => '���.'),
        'radio' => array('type' => 'checkbox', 'name' => $val['Field'] . '_new', 'value' => 1, 'caption' => '���.'),
        'editor' => array('type' => 'editor', 'name' => $val['Field'] . '_new', )
    );

    if (!empty($key_format[$val['Field']])) {
        return $key_view[$key_format[$val['Field']]];
    } else if (!empty($key_view[$b]))
        return $key_view[$b];
    else
        return array('type' => 'text', 'name' => $val['Field'] . '_new');
}

// �������� �����
$key_name = array(
    'id' => 'Id',
    'name' => '<b>������������</b>',
    'uid' => '�������',
    'price' => '<b>���� 1</b>',
    'price2' => '���� 2',
    'price3' => '���� 3',
    'price4' => '���� 4',
    'price5' => '���� 5',
    'price_n' => '������ ����',
    'sklad' => '��� �����',
    'newtip' => '�������',
    'spec' => '���������������',
    'items' => '<b>�����</b>',
    'weight' => '���',
    'num' => '���������',
    'enabled' => '<b>�����</b>',
    'content' => '��������� ��������',
    'description' => '������� ��������',
    'pic_small' => '��������� �����������',
    'pic_big' => '������� �����������',
    'category' => '���������',
    'yml' => '������.������',
    'icon' => '������',
    'parent_to' => '��������',
    'category' => '�������',
    'title' => 'Meta Title',
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
    'odnotip' => '������������� ������ (IDS)',
    'page' => '��������',
    'parent' => '����������� ������ (IDS)',
    'dop_cat' => '�������������� ��������',
    'ed_izm' => '������� ���������',
    'baseinputvaluta' => '������ (ID)',
    'p_enabled' => '������.������ ��� �����',
    'rate' => '�������',
    'rate_count' => '������ � ��������',
    'descrip' => 'Meta description',
    'keywords' => 'Meta keywords',
    'parent_enabled' => '������ ������',
    'price_search' => '���� ��� ������',
    'prod_seo_name' => 'SEO ������',
    'vendor_array' => '��������������',
    'vendor_name' => '�������������', 
    'items1' => '����� 2',
    'items2' => '����� 3',
    'items3' => '����� 4',
    'items4' => '����� 5',
);

$key_placeholder = array(
    'dop_cat' => '#10#11#',
    'odnotip' => '10,11,12',
    'parent' => '10,11,12',
);

// ���� ����
$key_stop = array('id', 'password', 'wishlist', 'datas', 'data_adres', 'sort', 'yml_bid_array', 'vendor', 'status', 'files', 'user', 'title_enabled', 'descrip_enabled', 'title_shablon', 'descrip_shablon', 'title_shablon', 'keywords_enabled', 'keywords_shablon');

// ������������� ����
if (!empty($GLOBALS['SysValue']['base']['productoption']['productoption_system'])) {
    $PHPShopOrmOptions = new PHPShopOrm($GLOBALS['SysValue']['base']['productoption']['productoption_system']);
    $m_data = $PHPShopOrmOptions->select();
    $vendor = unserialize($m_data['option']);

    if (!empty($vendor['option_1_name'])) {
        $key_name['option1'] = ucfirst($vendor['option_1_name']);
        $key_format['option1'] = $vendor['option_1_format'];
    }
    else
        $key_stop[] = 'option1';

    if (!empty($vendor['option_2_name'])) {
        $key_name['option2'] = ucfirst($vendor['option_2_name']);
        $key_format['option2'] = $vendor['option_2_format'];
    }
    else
        $key_stop[] = 'option2';

    if (!empty($vendor['option_3_name'])) {
        $key_name['option3'] = ucfirst($vendor['option_3_name']);
        $key_format['option3'] = $vendor['option_3_format'];
    }
    else
        $key_stop[] = 'option3';

    if (!empty($vendor['option_4_name'])) {
        $key_name['option4'] = ucfirst($vendor['option_4_name']);
        $key_format['option4'] = $vendor['option_4_format'];
    }
    else
        $key_stop[] = 'option4';

    if (!empty($vendor['option_5_name'])) {
        $key_name['option5'] = ucfirst($vendor['option_5_name']);
        $key_format['option5'] = $vendor['option_5_format'];
    }
    else
        $key_stop[] = 'option5';
}

/**
 * ������������� � ���������� ��� 1 /
 */
function actionSelect() {
    global $PHPShopGUI, $key_name, $key_stop;

    // ��������� ������
    if (!empty($_POST['select'])) {
        unset($_SESSION['select']['product']);
        if (is_array($_POST['select'])) {
            foreach ($_POST['select'] as $k => $v)
                if (!empty($v))
                    $select[intval($k)] = intval($v);
            $_SESSION['select']['product'] = $select;
        }
    }

    // ������
    $command[] = array('�����-����', 1, false);
    $command[] = array('���� Excel', 2, false);

    $PHPShopGUI->_CODE .= '<p class="text-muted">'.__('�� ������ ������������� ������������ ��������� �������. �������� ������ �� ������ ����, �������� �������� ����, ������� ����� ���������������, � ������� �� ������ "������������� ���������".</p><p class="text-muted"><a href="#" id="select-all">������� ���</a> | <a href="#" id="select-none">����� ��������� �� ����</a>').'</p>';

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));

    if (is_array($data))
        foreach ($data as $key => $val) {

            if ((!in_array($key, $key_stop))) {
                if (!empty($key_name[$key])) {
                    $name = $key_name[$key];
                    $select = 0;
                } else {
                    $name = $key;
                    $select = 0;
                }

                // ������ ��������� �����
                if (!empty($_COOKIE['check_memory'])) {
                    $memory = json_decode($_COOKIE['check_memory'], true);
                    if (is_array($memory[$_GET['path']])) {
                        if ($memory[$_GET['path']][$key] == 1)
                            $select = 1;
                        else
                            $select = 0;
                    }
                }

                $PHPShopGUI->_CODE .= '<div class="pull-left" style="width:200px;>' . $PHPShopGUI->setCheckBox($key, 1, ucfirst($name), $select) . '</div>';
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

// ������������ ��������� �������������� � ������
function sortParse($current_sort) {
    $current_sort = unserialize($current_sort);

    if (is_array($current_sort))
        foreach ($current_sort as $k => $v) {
            if (empty($_POST['vendor_array_new'][$k]))
                $_POST['vendor_array_new'][$k] = $v;
        }
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopOrm, $PHPShopSystem;

    if (is_array($_SESSION['select']['product'])) {
        $val = array_values($_SESSION['select']['product']);
        $where = array('id' => ' IN (' . implode(',', $val) . ')');
    }
    else
        $where = null;

    $PHPShopOrm->debug = false;


    // ��������� �������� ��� ����� �������� � �������� ������
    if (!empty($_POST['category_new'])) {
        
        $update_option = $PHPShopSystem->ifSerilizeParam('1c_option.update_option');

        if (is_array($val))
            foreach ($val as $id) {

                $PHPShopProduct = new PHPShopProduct($id);
                $parent_enabled = $PHPShopProduct->getParam('parent_enabled');
                $parent = @explode(",", $PHPShopProduct->getParam('parent'));
                if (empty($parent_enabled) and !empty($parent)) {
                    
                    $category = $PHPShopProduct->getParam('category');

                    if ($category != $_POST['category_new'])
                        $category_update = true;
                    else $category_update = false;

                    // ������� �� 1�
                    if ($update_option) {

                        if ($category_update) {
                            $PHPShopOrm->update(array('category_new' => $_POST['category_new']), array('uid' => ' IN ("' . @implode('","', $parent) . '")', 'parent_enabled' => "='1'"));
                        }
                    } else {
                        
                        if ($category_update) {
                            $PHPShopOrm->update(array('category_new' => $_POST['category_new']), array('id' => ' IN ("' . @implode('","', $parent) . '")', 'parent_enabled' => "='1'"));
                        }
                    }

                }
            }
    }


    // ���������� �������������
    if (is_array($_POST['vendor_array_add'])) {
        foreach ($_POST['vendor_array_add'] as $k => $valS) {

            if (!empty($valS)) {
                $PHPShopOrmSort = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                $result = $PHPShopOrmSort->insert(array('name_new' => $valS, 'category_new' => $k));
                if (!empty($result))
                    $_POST['vendor_array_new'][$k][] = $result;
            }
            else
                unset($_POST['vendor_array_add'][$k]);
        }
    }


    $PHPShopOrm->debug = false;


    // ��������� �������������
    if (!empty($_POST['vendor_array_new'])) {

        // ���������� ������ �������� �������������
        $data = $PHPShopOrm->select(array('id,vendor_array'), $where, array('order' => ' FIELD (id, ' . implode(',', $val) . ') '), array('limit' => 1000));
        $vendor_array_new_memory = $_POST['vendor_array_new'];
        if (is_array($data))
            foreach ($data as $val) {
                sortParse($val['vendor_array']);

                $_POST['vendor_new'] = null;
                if (is_array($_POST['vendor_array_new']))
                    foreach ($_POST['vendor_array_new'] as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $key => $p) {
                                $_POST['vendor_new'] .= "i" . $k . "-" . $p . "i";
                                if (empty($p))
                                    unset($_POST['vendor_array_new'][$k][$key]);
                            }
                        }
                        else
                            $_POST['vendor_new'] .= "i" . $k . "-" . $v . "i";
                    }


                $_POST['vendor_array_new'] = serialize($_POST['vendor_array_new']);
                $PHPShopOrm->update($_POST, array('id' => '=' . $val['id']));

                // ���������� �������� �� ������
                $_POST['vendor_array_new'] = $vendor_array_new_memory;
            }
    }

    // ������ ��������� �����
    if (is_array($_POST)) {
        $memory = json_decode($_COOKIE['check_memory'], true);
        unset($memory[$_GET['path']]);
        foreach ($_POST as $k => $v) {
            if (strstr($k, '_new'))
                $memory[$_GET['path']][str_replace('_new', '', $k)] = 1;
        }
        if (is_array($memory))
            setcookie("check_memory", json_encode($memory), time() + 3600000, '/phpshop/admpanel/');
    }

    $PHPShopOrm->clean();
    unset($_POST['vendor_array_new']);
    unset($_POST['vendor_new']);

    // ���������� �� ������
    if (isset($_POST['items_new'])) {
        switch ($PHPShopSystem->getSerilizeParam('admoption.sklad_status')) {

            case(3):
                if ($_POST['items_new'] < 1) {
                    $_POST['sklad_new'] = 1;
                } else {
                    $_POST['sklad_new'] = 0;
                }
                break;

            case(2):
                if ($_POST['items_new'] < 1) {
                    $_POST['enabled_new'] = 0;
                } else {
                    $_POST['enabled_new'] = 1;
                }
                break;

            default:
                break;
        }
    }


    // ��� ��������
    if (is_array($_POST['dop_cat']) and $_POST['dop_cat'][0] != 'null') {
        $_POST['dop_cat_new'] = "#";
        foreach ($_POST['dop_cat'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['dop_cat_new'] .= $v . "#";
    }


    // ���� ����������
    $_POST['datas_new'] = time();

    if (is_array($where) and $PHPShopOrm->update($_POST, $where)) {
        header('Location: ?path=catalog&cat=' . intval($_GET['cat']));
        return true;
    }
    else
        return true;
}

// ���������� ������ ���������
function treegenerator($array, $i, $parent) {
    global $tree_array;
    $del = '&brvbar;&nbsp;&nbsp;&nbsp;';
    $tree = $tree_select = $check = false;
    $del = str_repeat($del, $i);
    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator($tree_array[$k], $i + 1, $k);

            if ($k == $_GET['parent_to'])
                $selected = 'selected';
            else
                $selected = null;

            if (empty($check['select'])) {
                $tree_select .= '<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                $i = 1;
            } else {
                $tree_select .= '<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                //$i++;
            }

            $tree .= '<tr class="treegrid-' . $k . ' treegrid-parent-' . $parent . ' data-tree">
		<td><a href="?path=catalog&id=' . $k . '">' . $v . '</a></td>
                    </tr>';

            $tree_select .= $check['select'];
            $tree .= $check['tree'];
        }
    }
    return array('select' => $tree_select, 'tree' => $tree);
}

// ����� ��������
function viewCatalog($name = 'category_new', $multi = false) {

    $PHPShopCategoryArray = new PHPShopCategoryArray();
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $CategoryArray[0]['name'] = '- ��������� ������� -';
    $tree_array = array();

    foreach ($PHPShopCategoryArray->getKey('parent_to.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['name'];
        $tree_array[$k]['id'] = $k;
    }


    $GLOBALS['tree_array'] = &$tree_array;

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container="" data-width="100%" data-style="btn btn-default btn-sm" name="' . $name . '" ' . $multi . '>';

    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $data['category']);

            if ($k == $data['category'])
                $selected = 'selected';
            else
                $selected = null;

            if (empty($tree_array[$k]))
                $disabled = null;
            else
                $disabled = ' disabled';

            $tree_select .= '<option value="' . $k . '" ' . $selected . $disabled . '>' . $v . '</option>';

            $tree_select .= $check['select'];
        }
    $tree_select .= '</select>';

    return $tree_select;
}

/**
 * ������������� � ���������� ��� 2
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules, $key_name, $key_stop;

    $PHPShopGUI->setActionPanel(__("�������� ������"), false, array('��������� � �������'));
    $PHPShopGUI->addJSFiles('./catalog/gui/catalog.gui.js');
    $PHPShopGUI->field_col = 2;
    $select_error = null;

    $PHPShopGUI->_CODE .= $PHPShopGUI->setHelp('�� ������ ������������� ������������ ��������� �������. �������� ������ �� ������ �������, �������� �������� ������, ������� ����� ���������������, � ������� �� ������ "������������� ���������".<hr>', false);

    $PHPShopOrm->sql = 'show fields  from ' . $GLOBALS['SysValue']['base']['products'];
    $select = array_values($_SESSION['select_col']);
    $data = $PHPShopOrm->select();
    if (is_array($data))
        foreach ($data as $val) {

            if (in_array($val['Field'], $select) and !in_array($val['Field'], $key_stop)) {

                // ��������
                if ($val['Field'] == 'category') {
                    $PHPShopGUI->_CODE .= $PHPShopGUI->setField("����������", viewCatalog());
                }
                // ��������
                elseif ($val['Field'] == 'dop_cat') {
                    $PHPShopGUI->_CODE .= $PHPShopGUI->setField("����������", viewCatalog('dop_cat[]', 'multiple'));
                }
                // ��������������
                elseif ($val['Field'] == 'vendor_array') {
                    if (!empty($_GET['cat']) and $_GET['cat'] != 'undefined') {
                        PHPShopObj::loadClass("sort");
                        $PHPShopSort = new PHPShopSort((int) $_GET['cat'], false, false, 'sorttemplate', false, false, false,false,null,true);
                        $PHPShopGUI->_CODE .= $PHPShopSort->disp;
                    } else {
                        $select_error = '������������� �������������� ����� ������ � ������� �� ����� ���������: <a href="?path=catalog"><span class="glyphicon glyphicon-share-alt"></span> �������</a>';
                    }
                } elseif (!empty($key_name[$val['Field']])) {
                    $name = $key_name[$val['Field']];
                    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(ucfirst($name), $PHPShopGUI->setInputArg(getKeyView($val)));
                } else {
                    $name = $val['Field'];
                    $PHPShopGUI->_CODE .= $PHPShopGUI->setField(ucfirst($name), $PHPShopGUI->setInputArg(getKeyView($val)));
                }
            }
        }


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.catalog.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.catalog.edit");


    // ��������� ������
    $select_action_path = 'product';

    if (is_array($_SESSION['select'][$select_action_path])) {
        foreach ($_SESSION['select'][$select_action_path] as $val)
            $select_message = '<span class="label label-default">' . count($_SESSION['select']['product']) . '</span> '.__('������� �������').'<hr><a href="#" class="back"><span class="glyphicon glyphicon-ok"></span> '.__('�������� ��������').'</a>';
    }
    else
        $select_message = '<p class="text-muted">�� ������ ������� ���������� ������� ��� ��������. �� ��������� ����� �������������� ��� �������.: <a href="?path=catalog"><span class="glyphicon glyphicon-share-alt"></span> �������</a></p>';

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

/**
 * ������ ������ �������������
 */
function sorttemplate($value, $n, $title, $vendor) {
    global $PHPShopGUI;
    $i = 1;
    //$value_new[0]=array(__('��� ������'),false, 'none');
    if (is_array($value)) {
        sort($value);
        foreach ($value as $p) {
            $sel = null;
            if (is_array($vendor[$n])) {
                foreach ($vendor[$n] as $value) {

                    if ($value == $p[1])
                        $sel = "selected";
                }
            }elseif ($vendor[$n] == $p[1])
                $sel = "selected";

            $value_new[$i] = array($p[0], $p[1], $sel);
            $i++;
        }
    }

    $value = $PHPShopGUI->setSelect('vendor_array_new[' . $n . '][]', $value_new, 300, null, false, $search = true, false, $size = 1, $multiple = true);
            
    $disp = $PHPShopGUI->setField($title, $value, 1, null, null, 'control-label', false) .
            $PHPShopGUI->setField(null, $PHPShopGUI->setInputArg(array('type' => 'text', 'placeholder' => '������ ������', 'size' => '300', 'name' => 'vendor_array_add[' . $n . ']')));

    return $disp;
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
    if (!is_array($memory['catalog.option']) or count($memory['catalog.option']) < 3) {
        $memory['catalog.option']['icon'] = 1;
        $memory['catalog.option']['name'] = 1;
        $memory['catalog.option']['price'] = 1;
        $memory['catalog.option']['item'] = 1;
        $memory['catalog.option']['menu'] = 1;
        $memory['catalog.option']['status'] = 1;
        $memory['catalog.option']['label'] = 1;
        $memory['catalog.option']['sort'] = 0;
    }

    $message = '<p class="text-muted">'.__('�� ������ �������� �������� ����� � ������� ����������� ������� � ����������').'.</p>';

    $searchforma = $message .
            $PHPShopInterface->setCheckbox('icon', 1,'������', $memory['catalog.option']['icon']) .
            $PHPShopInterface->setCheckbox('name', 1, '��������', $memory['catalog.option']['name']) .
            $PHPShopInterface->setCheckbox('uid', 1, '�������', $memory['catalog.option']['uid']) .
            $PHPShopInterface->setCheckbox('id', 1, 'ID', $memory['catalog.option']['id']) .
            $PHPShopInterface->setCheckbox('price', 1, '����', $memory['catalog.option']['price']) .
            $PHPShopInterface->setCheckbox('status', 1, '������', $memory['catalog.option']['status']) .
            $PHPShopInterface->setCheckbox('item', 1, '����������', $memory['catalog.option']['item']) . '<br>' .
            $PHPShopInterface->setCheckbox('menu', 1, '����� ����', $memory['catalog.option']['menu']) .
            $PHPShopInterface->setCheckbox('num', 1, '����������', $memory['catalog.option']['num']) .
            $PHPShopInterface->setCheckbox('label', 1, '������ ��������', $memory['catalog.option']['label']) .
            $PHPShopInterface->setCheckbox('sort', 1, '��������������', $memory['catalog.option']['sort']);

    $searchforma .= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => 'catalog'));
    $searchforma .= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'cat', 'value' => $_REQUEST['cat']));

    $searchforma .= '<p class="clearfix"> </p>';


    $PHPShopInterface->_CODE .= $searchforma;

    exit($PHPShopInterface->getContent() . '<p class="clearfix"> </p>');
}

/**
 * ��������� ����� - 2 ���
 */
function actionOptionSave() {

    // ������ ��������� �����
    if (is_array($_POST['option'])) {

        $memory = json_decode($_COOKIE['check_memory'], true);
        unset($memory['catalog.option']);
        foreach ($_POST['option'] as $k => $v) {
            $memory['catalog.option'][$k] = $v;
        }
        if (is_array($memory))
            setcookie("check_memory", json_encode($memory), time() + 3600000 * 6, $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/admpanel/');
    }

    return array('success' => true);
}

/*
 * ����� ���� ������������� ���� ���������
 */

function actionResetCache() {
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
    $PHPShopOrm->update(array('sort_cache_new' => '', 'sort_cache_created_at_new' => 0));

    return array('success' => true);
}

// ��������� �������
$PHPShopGUI->getAction();
?>