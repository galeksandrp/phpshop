<?php

PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");


$TitlePage = __('�������������� ������') . ' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

// ���������� ������ ���������
function treegenerator($array, $i, $curent, $dop_cat_array) {
    global $tree_array;
    $del = '�&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree_select = $tree_select_dop = $check = false;

    $del = str_repeat($del, $i);
    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator($tree_array[$k], $i + 1, $curent, $dop_cat_array);

            if ($k == $curent)
                $selected = 'selected';
            else
                $selected = null;

            // �����������
            $selected_dop = null;
            if (is_array($dop_cat_array))
                foreach ($dop_cat_array as $vs) {
                    if ($k == $vs)
                        $selected_dop = "selected";
                }

            if (empty($check['select'])) {
                $tree_select .= '<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';

                //if ($k < 1000000)
                $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . '>' . $del . $v . '</option>';

                $i = 1;
            } else {
                $tree_select .= '<option value="' . $k . '" ' . $selected . ' disabled>' . $del . $v . '</option>';
                //if ($k < 1000000)
                $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . ' disabled >' . $del . $v . '</option>';
            }

            $tree_select .= $check['select'];
            $tree_select_dop .= $check['select_dop'];
        }
    }
    return array('select' => $tree_select, 'select_dop' => $tree_select_dop);
}

function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopBase, $PHPShopSystem, $CategoryArray;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    // �������� �� �������� �������
    if ($data['parent_enabled'] == 1 and empty($_GET['view'])) {
        $data_parent = $PHPShopOrm->select(array('id'), array('parent' => "='" . $data['id'] . "' or parent LIKE '," . $data['id'] . "' or  parent LIKE '" . $data['id'] . ",'", 'parent_enabled' => "='0'"), false, array('limit' => 1));
        if (!empty($data_parent['id']))
            header('Location: ?path=' . $_GET['path'] . '&id=' . $data_parent['id'] . '&tab=6&return=' . $_GET['return']);
    }

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['return']);
    }

    // ��� ������
    if (strlen($data['name']) > 47)
        $title_name = substr($data['name'], 0, 47) . '...';
    else
        $title_name = $data['name'];

    $PHPShopGUI->action_select['������������'] = array(
        'name' => '������������',
        'url' => '../../shop/UID_' . $data['id'] . '.html',
        'action' => 'front',
        'target' => '_blank',
        'class' => $GLOBALS['isFrame']
    );

    $PHPShopGUI->setActionPanel(__("�����") . ": " . $title_name . ' [ID ' . $data['id'] . ']', array('������� �����', '������������', '|', '�������'), array('���������', '��������� � �������'), false);

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.tagsinput.min.js', './catalog/gui/catalog.gui.js', './js/jquery.waypoints.min.js', './product/gui/product.gui.js', './js/bootstrap-colorpicker.min.js');
    $PHPShopGUI->addCSSFiles('./css/jquery.tagsinput.css', './css/bootstrap-colorpicker.min.css');

    // ����� ����������
    if ($PHPShopSystem->ifSerilizeParam('admoption.rule_enabled', 1) and !$PHPShopBase->Rule->CheckedRules('catalog', 'remove')) {
        $where = array('secure_groups' => " REGEXP 'i" . $_SESSION['idPHPSHOP'] . "i' or secure_groups = ''");
        $secure_groups = true;
    }
    else
        $where = $secure_groups = false;

    $PHPShopCategoryArray = new PHPShopCategoryArray($where);
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $CategoryArray[0]['name'] = '- ' . __('������� �������') . ' -';
    $tree_array = array();

    foreach ($PHPShopCategoryArray->getKey('parent_to.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['name'];
        $tree_array[$k]['id'] = $k;
    }

    $tree_array[0]['sub'][1000000] = __('�������������� ������');
    $tree_array[1000000]['name'] = __('�������������� ������');
    $tree_array[1000000]['id'] = 1000000;
    $tree_array[1000000]['sub'][1000001] = __('����������� 1C');
    $tree_array[1000000]['sub'][1000002] = __('����������� CSV');
    $tree_array[1000002]['id'] = 0;

    $GLOBALS['tree_array'] = &$tree_array;

    // �����������
    $dop_cat_array = preg_split('/#/', $data['dop_cat'], -1, PREG_SPLIT_NO_EMPTY);

    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $data['category'], $dop_cat_array);

            if ($k == $data['category'])
                $selected = 'selected';
            else
                $selected = null;

            // �����������
            $selected_dop = null;
            if (is_array($dop_cat_array))
                foreach ($dop_cat_array as $vs) {
                    if ($k == $vs)
                        $selected_dop = "selected";
                }

            if (empty($tree_array[$k]))
                $disabled = null;
            else
                $disabled = ' disabled';

            $tree_select .= '<option value="' . $k . '" ' . $selected . $disabled . '>' . $v . '</option>';

            //if ($k < 1000000)
            $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . $disabled . '>' . $v . '</option>';

            $tree_select .= $check['select'];
            $tree_select_dop .= $check['select_dop'];
        }

    $tree_select_dop = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="dop_cat[]" data-width="100%" multiple><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select_dop . '</select>';

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="category_new"  data-width="100%"><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select . '</select>';

    // ����� ��������
    $Tab_info = $PHPShopGUI->setField("����������", $tree_select, 1, __('����� � �������� ID') . ' ' . $data['category'] . '. ' . __('��������') . ' ' . PHPShopDate::get($data['datas'], true), false, 'control-label', false);

    // ������������
    $Tab_info .= $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(null, 'name_new', $data['name']));

    // �������
    $Tab_info .= $PHPShopGUI->setField('�������', $PHPShopGUI->setInputText(null, 'uid_new', $data['uid'], 250));

    // ������
    $PHPShopOrmImg = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
    $data_pic = $PHPShopOrmImg->select(array('*'), array('parent' => '=' . intval($data['id'])), array('order' => 'num,id'), array('limit' => 1));
    if (is_array($data_pic)) {
        $icon_server = true;
        $icon_title = false;
    } else {
        $icon_server = false;
        $icon_title = '������� ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������� ���� �������� �����.';
    }

    $Tab_info .= $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['pic_big'], "pic_big_new", true, array('load' => false, 'server' => true, 'url' => false, 'view' => $icon_server)), 1, $icon_title);

    if (empty($icon_server))
        $Tab_info .= $PHPShopGUI->setField("������", $PHPShopGUI->setFile($data['pic_small'], "pic_small_new", array('load' => false, 'server' => 'image', 'url' => false, 'view' => $icon_server)), 1, '������ ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������ �������� �����.');
    else
        $Tab_info .= $PHPShopGUI->setFile($data['pic_small'], "pic_small_new", array('load' => false, 'server' => 'image', 'url' => false, 'view' => $icon_server));

    // ������� ���������
    if (empty($data['ed_izm']))
        $ed_izm = '��.';
    else
        $ed_izm = $data['ed_izm'];

    // �������������� �����
    $PHPShopOrmWarehouse = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
    $dataWarehouse = $PHPShopOrmWarehouse->select(array('*'), array('enabled' => "='1'"), array('order' => 'num DESC'), array('limit' => 100));
    if (is_array($dataWarehouse)) {

        $Tab_info .= $PHPShopGUI->setField('����� �����:', $PHPShopGUI->setInputText(false, 'items_new', $data['items'], 100, $ed_izm), 'left');

        foreach ($dataWarehouse as $row) {
            $Tab_info .= $PHPShopGUI->setField($row['name'], $PHPShopGUI->setInputText(false, 'items' . $row['id'] . '_new', $data['items' . $row['id']], 100, $ed_izm), 2, $row['description']);
        }
    }
    else
        $Tab_info .= $PHPShopGUI->setField('�����:', $PHPShopGUI->setInputText(false, 'items_new', $data['items'], 100, $ed_izm), 'left');

    // ���
    $Tab_info .= $PHPShopGUI->setField('���:', $PHPShopGUI->setInputText(false, 'weight_new', $data['weight'], 100, '��.'), 'left');


    $Tab_info .= $PHPShopGUI->setField('������� ���������', $PHPShopGUI->setInputText(false, 'ed_izm_new', $ed_izm, 100));

    // ������������� ������
    $Tab_info .= $PHPShopGUI->setField('������������� ������ ��� ���������� �������', $PHPShopGUI->setTextarea('odnotip_new', $data['odnotip'], false, false, false, __('������� ID ������� ��� ��������������') . ' <a href="#" data-target="#odnotip_new"  class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ' . __('������� �������') . '</a>'));

    // �������������� ��������
    $Tab_info .= $PHPShopGUI->setField('�������������� ��������', $tree_select_dop, 1, '������ ������������ ��������� � ���������� ���������.');

    // ����� ������
    $Tab_info .= $PHPShopGUI->setField('����� ������', $PHPShopGUI->setCheckbox('enabled_new', 1, '����� � ��������', $data['enabled']) .
            $PHPShopGUI->setCheckbox('spec_new', 1, '���������������', $data['spec']) . $PHPShopGUI->setCheckbox('newtip_new', 1, '�������', $data['newtip']));
    $Tab_info .= $PHPShopGUI->setField('����������', $PHPShopGUI->setInputText('�', 'num_new', $data['num'], 150));

    if ($_GET['view'] == 'option')
        $Tab_info .= $PHPShopGUI->setField('�����', $PHPShopGUI->setRadio('parent_enabled_new', 0, '������� �����', $data['parent_enabled']) . $PHPShopGUI->setRadio('parent_enabled_new', 1, '������ ������', $data['parent_enabled']));

    $Tab1 = $PHPShopGUI->setCollapse('����������', $Tab_info);

    // ������
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    $valuta_area = null;
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            if ($data['baseinputvaluta'] == $val['id']) {
                $check = 'checked';
                $valuta_def_name = $val['code'];
            }
            else
                $check = false;
            $valuta_area .= $PHPShopGUI->setRadio('baseinputvaluta_new', $val['id'], $val['name'], $check, false, false, array('code' => $val['code']), false);
        }

    // ����
    if (!empty($data['parent']) and $PHPShopSystem->ifSerilizeParam('admoption.parent_price_enabled') == 0)
        $price_parent_help = '���� ������� �������, ������� ���� ������ ������������� ������������� �� ���������� ���� �������, ��� ����������� ����������� ���� � ������ ������.';
    else
        $price_parent_help = null;
    $Tab_price .= $PHPShopGUI->setField('����', $PHPShopGUI->setInputText(null, 'price_new', $data['price'], 150, $valuta_def_name), 2, $price_parent_help);

    if (empty($data['parent']) or $PHPShopSystem->ifSerilizeParam('admoption.parent_price_enabled')) {
        $Tab_price .= $PHPShopGUI->setField('���� 2', $PHPShopGUI->setInputText(null, 'price2_new', $data['price2'], 150, $valuta_def_name), 2);
        $Tab_price .= $PHPShopGUI->setField('���� 3', $PHPShopGUI->setInputText(null, 'price3_new', $data['price3'], 150, $valuta_def_name), 2);
        $Tab_price .= $PHPShopGUI->setField('���� 4', $PHPShopGUI->setInputText(null, 'price4_new', $data['price4'], 150, $valuta_def_name), 2);
        $Tab_price .= $PHPShopGUI->setField('���� 5', $PHPShopGUI->setInputText(null, 'price5_new', $data['price5'], 150, $valuta_def_name), 2);
    }
    $Tab_price .= $PHPShopGUI->setField('������ ����', $PHPShopGUI->setInputText(null, 'price_n_new', $data['price_n'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('��� �����', $PHPShopGUI->setCheckbox('sklad_new', 1, '��� �����', $data['sklad']));

    // ������
    $Tab_price .= $PHPShopGUI->setField('������', $valuta_area);

    $Tab1 .= $PHPShopGUI->setCollapse('����', $Tab_price, 'in', true, true, array('type' => 'price'));

    // YML
    $data['yml_bid_array'] = unserialize($data['yml_bid_array']);
    $Tab_yml = $PHPShopGUI->setField('<a href="/yml/" target="_blank" title="������� ����">YML</a>', $PHPShopGUI->setCheckbox('yml_new', 1, __('����� � ������ �������'), $data['yml']) . '<br>' .
            $PHPShopGUI->setRadio('p_enabled_new', 1, '� �������', $data['p_enabled']) .
            $PHPShopGUI->setRadio('p_enabled_new', 0, '��������� (��� �����)', $data['p_enabled'])
    );

    // BID
    $Tab_yml .= $PHPShopGUI->setField('������ BID', $PHPShopGUI->setInputText(null, 'yml_bid_array[bid]', $data['yml_bid_array']['bid'], 100));
    $Tab_yml .= $PHPShopGUI->setField('������ CBID', $PHPShopGUI->setInputText(null, 'yml_bid_array[cbid]', $data['yml_bid_array']['cbid'], 100));
    $Tab1 .= $PHPShopGUI->setCollapse('������ ������', $Tab_yml, false);

    // �������� �������� ��������
    $Tab2 = $PHPShopGUI->loadLib('tab_description', $data);

    // �������� ���������� ��������
    $Tab3 = $PHPShopGUI->loadLib('tab_content', $data);

    // ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
    $data_page = $PHPShopOrm->select(array('*'), false, array('order' => 'name'), array('limit' => 500));

    if (strstr($data['page'], ',')) {
        $data['page'] = explode(",", $data['page']);
    }
    else
        $data['page'] = array($data['page']);

    $value = array();
    if (is_array($data_page))
        foreach ($data_page as $val) {
            if (is_numeric(array_search($val['link'], $data['page']))) {
                $check = 'selected';
            }
            else
                $check = false;

            $value[] = array($val['name'], $val['link'], $check);
        }

    // ������
    $Tab_docs = $PHPShopGUI->setCollapse('������', $PHPShopGUI->setSelect('page_new[]', $value, '100%', false, false, true, '90%', 30, true));

    // �����
    $Tab_docs .= $PHPShopGUI->setCollapse('�����', $PHPShopGUI->loadLib('tab_files', $data));

    // �����������
    $Tab6 = $PHPShopGUI->loadLib('tab_img', $data);

    // ��������������
    $Tab_sorts = $PHPShopGUI->loadLib('tab_sorts', $data);

    // ���������
    $Tab_header = $PHPShopGUI->loadLib('tab_headers', $data);

    // �������
    $Tab_option = $PHPShopGUI->loadLib('tab_option', $data);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("�����������", $Tab6), array("��������", $Tab2), array("��������", $Tab3), array("���������", $Tab_docs), array("��������������", $Tab_sorts), array("�������", $Tab_option, true), array("���������", $Tab_header));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.catalog.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.catalog.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.catalog.edit");

    $_GET['path'] = 'catalog';

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['return'] . '&cat=' . $_POST['category_new']);
}

/**
 * ����� ����������
 * @return bool
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopSystem, $PHPShopOrm;


    // ����� ����������� ���� ��������
    if ($PHPShopSystem->ifSerilizeParam('admoption.parent_price_enabled') != 1) {
        
        $PHPShopOrm->mysql_error = false;
        $PHPShopProduct = new PHPShopProduct($_POST['rowID']);
        $parent_enabled = $PHPShopProduct->getParam('parent_enabled');
        $parent = @explode(",", $PHPShopProduct->getParam('parent'));
        if (empty($parent_enabled) and !empty($parent)) {

            $category = $PHPShopProduct->getParam('category');

            if ($category != $_POST['category_new'])
                $category_update = true;


            // ������� �� 1�
            if ($PHPShopSystem->ifSerilizeParam('1c_option.update_option')) {
                $ParentData = $PHPShopOrm->select(array('min(price) as price, price_n'), array('uid' => ' IN ("' . @implode('","', $parent) . '")', 'enabled' => "='1'", 'sklad' => "!='1'", 'parent_enabled' => "='1'"), false, array('limit' => 1));

                if ($category_update) {
                    $PHPShopOrm->update(array('category_new' => $_POST['category_new']), array('uid' => ' IN ("' . @implode('","', $parent) . '")', 'parent_enabled' => "='1'"));
                }
            } else {
                $ParentData = $PHPShopOrm->select(array('min(price) as price, price_n'), array('id' => ' IN ("' . @implode('","', $parent) . '")', 'enabled' => "='1'", 'sklad' => "!='1'", 'parent_enabled' => "='1'"), false, array('limit' => 1));

                if ($category_update) {
                    $PHPShopOrm->update(array('category_new' => $_POST['category_new']), array('id' => ' IN ("' . @implode('","', $parent) . '")', 'parent_enabled' => "='1'"));
                }
            }

            if (!empty($ParentData['price'])) {

                $_POST['price_new'] = $ParentData['price'];

                if (!empty($ParentData['price_n']))
                    $_POST['price_n_new'] = $ParentData['price_n'];
            }
        }
    }


    // ���������� �� ������
    if (isset($_POST['items_new'])) {
        switch ($PHPShopSystem->getSerilizeParam('admoption.sklad_status')) {

            case(3):
                if ($_POST['items_new'] < 1) {
                    $_POST['sklad_new'] = 1;
                    //$_POST['enabled_new'] = 1;
                } else {
                    $_POST['sklad_new'] = 0;
                    $_POST['enabled_new'] = 1;
                }
                break;

            case(2):
                if ($_POST['items_new'] < 1) {
                    $_POST['enabled_new'] = 0;
                    //$_POST['sklad_new'] = 0;
                } else {
                    $_POST['enabled_new'] = 1;
                    //$_POST['sklad_new'] = 0;
                }
                break;

            default:
                break;
        }
    }

    // ���� �����������
    $_POST['datas_new'] = time();

    if (empty($_POST['ajax'])) {
        $_POST['yml_bid_array_new'] = serialize($_POST['yml_bid_array']);


        // ����� �� �������
        if ($PHPShopSystem->ifSerilizeParam('admoption.sklad_sum_enabled')) {
            $PHPShopOrmW = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
            $data = $PHPShopOrmW->select(array('*'), false, array('order' => 'num DESC'), array('limit' => 100));
            if (is_array($data)) {
                $items = 0;
                foreach ($data as $row) {
                    if (isset($_POST['items' . $row['id'] . '_new'])) {
                        $items += $_POST['items' . $row['id'] . '_new'];
                    }
                }
            }

            if (!empty($items)) {
                $_POST['items_new'] = $items;
            }
        }


        // ���������� �������������
        if (is_array($_POST['vendor_array_add'])) {
            foreach ($_POST['vendor_array_add'] as $k => $val) {

                $sort_array = $result = null;

                if (!empty($val)) {

                    if (strstr($val, '#')) {
                        $sort_array = explode('#', $val);
                    }
                    else
                        $sort_array[] = $val;

                    if (is_array($sort_array))
                        foreach ($sort_array as $val_sort) {

                            $PHPShopOrmSort = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);

                            // �������� ������������
                            $checkName = $PHPShopOrmSort->select(array('id'), array('name' => '="' . trim($val_sort) . '"', 'category' => '=' . intval($k)), false, array('limit' => 1));

                            // ��� ��������������, ������� �����
                            if (empty($checkName['id'])) {
                                $PHPShopOrmSort->clean();

                                $result = $PHPShopOrmSort->insert(array('name_new' => trim($val_sort), 'category_new' => intval($k)));
                                if (!empty($result))
                                    $_POST['vendor_array_new'][$k][] = $result;
                            }
                            // ����, �������� �� ����
                            else {
                                $_POST['vendor_array_new'][$k][] = $checkName['id'];
                            }
                        }
                }
                else
                    unset($_POST['vendor_array_add'][$k]);
            }
        }

        // ��������� �������������
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

        // ������
        if (isset($_POST['editID'])) {
            if (is_array($_POST['page_new']))
                $_POST['page_new'] = array_pop($_POST['page_new']);
        }
        else
            $_POST['page_new'] = @implode(',', $_POST['page_new']);

        // �����
        if (isset($_POST['editID'])) {
            if (is_array($_POST['files_new'])) {
                foreach ($_POST['files_new'] as $k => $files)
                    $files_new[] = @array_map("urldecode", $files);

                $_POST['files_new'] = serialize($files_new);
            }
        }
        else
            $_POST['files_new'] = serialize($_POST['files_new']);

        // ��� ��������
        $_POST['dop_cat_new'] = "";
        if (is_array($_POST['dop_cat']) and $_POST['dop_cat'][0] != 'null') {
            $_POST['dop_cat_new'] = "#";
            foreach ($_POST['dop_cat'] as $v)
                if ($v != 'null' and !strstr($v, ','))
                    $_POST['dop_cat_new'] .= $v . "#";
        }

        // ��������� �����
        if (!empty($_POST['parent2_new']) and empty($_POST['color_new']))
            $_POST['color_new'] = PHPShopString::getColor($_POST['parent2_new']);

        // ����������� �������
        if (!empty($_POST['editParent']) and !empty($_POST['pic_big_new'])) {
            $_POST['pic_small_new'] = $_POST['pic_big_new'];
        }


        // ������������� ������ ��������
        $PHPShopOrm->updateZeroVars('newtip_new', 'enabled_new', 'spec_new', 'yml_new', 'sklad_new', 'pic_small_new', 'pic_big_new');
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    // ���������� ����������� � �����������
    $insert = fotoAdd();
    if (empty($_POST['pic_small_new']) and !empty($insert['pic_small_new']))
        $_POST['pic_small_new'] = $insert['pic_small_new'];
    if (empty($_POST['pic_big_new']) and !empty($insert['name_new']))
        $_POST['pic_big_new'] = $insert['name_new'];

    // ����� ������������
    $_POST['user_new'] = $_SESSION['idPHPSHOP'];

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    $PHPShopOrm->clean();

    return array('success' => $action, 'enabled' => $_POST['enabled_new'], 'sklad' => $_POST['sklad_new'], 'id' => $_POST['rowID']);
}

// ���������� ����������� � �����������
function fotoAdd() {
    global $PHPShopSystem;
    require_once $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/thumb/phpthumb.php';

    // ��������� ����������
    $img_tw = $PHPShopSystem->getSerilizeParam('admoption.img_tw');
    $img_th = $PHPShopSystem->getSerilizeParam('admoption.img_th');
    $img_w = $PHPShopSystem->getSerilizeParam('admoption.img_w');
    $img_h = $PHPShopSystem->getSerilizeParam('admoption.img_h');
    $img_tw = empty($img_tw) ? 150 : $img_tw;
    $img_th = empty($img_th) ? 150 : $img_th;
    $img_w = empty($img_w) ? 300 : $img_w;
    $img_h = empty($img_h) ? 300 : $img_h;

    $img_adaptive = $PHPShopSystem->getSerilizeParam('admoption.image_adaptive_resize');
    $image_save_source = $PHPShopSystem->getSerilizeParam('admoption.image_save_source');
    $width_kratko = $PHPShopSystem->getSerilizeParam('admoption.width_kratko');
    $width_podrobno = $PHPShopSystem->getSerilizeParam('admoption.width_podrobno');

    // ����� ����������
    $path = $GLOBALS['SysValue']['dir']['dir'] . '/UserFiles/Image/' . $PHPShopSystem->getSerilizeParam('admoption.image_result_path');

    // ��������� � ����� ���������
    if ($PHPShopSystem->ifSerilizeParam('admoption.image_save_catalog')) {

        $PHPShopCategory = new PHPShopCategory($_POST['category_new']);
        $parent_to = $PHPShopCategory->getParam('parent_to');
        $pathName = ucfirst(PHPShopString::toLatin($PHPShopCategory->getName()));

        if (!empty($parent_to)) {
            $PHPShopCategory = new PHPShopCategory($parent_to);
            $pathName = ucfirst(PHPShopString::toLatin($PHPShopCategory->getName())) . '/' . $pathName;
            $parent_to = $PHPShopCategory->getParam('parent_to');
        }

        if (!empty($parent_to)) {
            $PHPShopCategory = new PHPShopCategory($parent_to);
            $pathName = '/' . ucfirst(PHPShopString::toLatin($PHPShopCategory->getName())) . '/' . $pathName;
        }

        $path .= $pathName . '/';

        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $path))
            @mkdir($_SERVER['DOCUMENT_ROOT'] . $path, 0777, true);
    }

    // ����
    $RName = substr(abs(crc32(time())), 0, 5);

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        $_FILES['file']['name'] = PHPShopString::toLatin(str_replace('.' . $_FILES['file']['ext'], '', PHPShopString::utf8_win1251($_FILES['file']['name']))) . '.' . $_FILES['file']['ext'];
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg', 'jpeg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $path . $_FILES['file']['name'])) {
                $file = $_SERVER['DOCUMENT_ROOT'] . $path . $_FILES['file']['name'];
                $file_name = $_FILES['file']['name'];
                $path_parts = pathinfo($file);
                $tmp_file = $_SERVER['DOCUMENT_ROOT'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST['img_new'];
        $path_parts = pathinfo($file);
        $file_name = $path_parts['basename'];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST['img_new'])) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $_POST['img_new'];
        $path_parts = pathinfo($file);
        $file_name = $path_parts['basename'];

        // ���������� ���� �����
        if ($PHPShopSystem->ifSerilizeParam('admoption.image_save_path'))
            $path = $GLOBALS['SysValue']['dir']['dir'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', $path_parts['dirname']) . '/';
    }

    if (!empty($file)) {

        // ��������� ����������� (��������)
        $thumb = new PHPThumb($file);
        $thumb->setOptions(array('jpegQuality' => $width_kratko));

        // ������������
        if (!empty($img_adaptive))
            $thumb->adaptiveResize($img_tw, $img_th);
        else
            $thumb->resize($img_tw, $img_th);

        $watermark = $PHPShopSystem->getSerilizeParam('admoption.watermark_image');
        $watermark_text = $PHPShopSystem->getSerilizeParam('admoption.watermark_text');

        // �������� ��������
        if ($PHPShopSystem->ifSerilizeParam('admoption.image_save_name')) {
            $name_s = $path_parts['filename'] . 's.' . strtolower($thumb->getFormat());
            $name = $path_parts['filename'] . '.' . strtolower($thumb->getFormat());
            $name_big = $path_parts['filename'] . '_big.' . strtolower($thumb->getFormat());

            if (!empty($image_save_source)) {
                $file_big = $_SERVER['DOCUMENT_ROOT'] . $path . $name_big;
                @copy($file, $file_big);
            }
        } else {
            $name_s = 'img' . $_POST['rowID'] . '_' . $RName . 's.' . strtolower($thumb->getFormat());
            $name = 'img' . $_POST['rowID'] . '_' . $RName . '.' . strtolower($thumb->getFormat());
            $name_big = 'img' . $_POST['rowID'] . '_' . $RName . '_big.' . strtolower($thumb->getFormat());
        }


        // ��������� ��������
        if ($PHPShopSystem->ifSerilizeParam('admoption.watermark_small_enabled')) {

            // Image
            if (!empty($watermark) and file_exists($_SERVER['DOCUMENT_ROOT'] . $watermark))
                $thumb->createWatermark($_SERVER['DOCUMENT_ROOT'] . $watermark, $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));
            // Text
            elseif (!empty($watermark_text))
                $thumb->createWatermarkText($watermark_text, $PHPShopSystem->getSerilizeParam('admoption.watermark_text_size'), $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/font/' . $PHPShopSystem->getSerilizeParam('admoption.watermark_text_font') . '.ttf', $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_color'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_alpha'), 0, $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));
        }

        $thumb->save($_SERVER['DOCUMENT_ROOT'] . $path . $name_s);

        // ������� �����������
        $thumb = new PHPThumb($file);
        $thumb->setOptions(array('jpegQuality' => $width_podrobno));

        // ������������
        if (!empty($img_adaptive))
            $thumb->adaptiveResize($img_w, $img_h);
        else
            $thumb->resize($img_w, $img_h);

        // ��������� �������� �����������
        if ($PHPShopSystem->ifSerilizeParam('admoption.watermark_big_enabled')) {

            // Image
            if (!empty($watermark) and file_exists($_SERVER['DOCUMENT_ROOT'] . $watermark))
                $thumb->createWatermark($_SERVER['DOCUMENT_ROOT'] . $watermark, $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));
            // Text
            elseif (!empty($watermark_text))
                $thumb->createWatermarkText($watermark_text, $PHPShopSystem->getSerilizeParam('admoption.watermark_text_size'), $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/font/' . $PHPShopSystem->getSerilizeParam('admoption.watermark_text_font') . '.ttf', $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_color'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_alpha'), 0, $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));
        }

        $thumb->save($_SERVER['DOCUMENT_ROOT'] . $path . $name);

        // �������� �����������
        if (!empty($image_save_source)) {

            if (!$PHPShopSystem->ifSerilizeParam('admoption.image_save_name')) {
                $file_big = $_SERVER['DOCUMENT_ROOT'] . $path . $name_big;
                @copy($file, $file_big);
            }

            // ���������
            if ($PHPShopSystem->ifSerilizeParam('admoption.watermark_source_enabled')) {

                $thumb = new PHPThumb($file_big);
                $thumb->setOptions(array('jpegQuality' => $width_podrobno));
                $thumb->setWorkingImage($thumb->getOldImage());

                // Image
                if (!empty($watermark) and file_exists($_SERVER['DOCUMENT_ROOT'] . $watermark))
                    $thumb->createWatermark($_SERVER['DOCUMENT_ROOT'] . $watermark, $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));
                // Text
                elseif (!empty($watermark_text))
                    $thumb->createWatermarkText($watermark_text, $PHPShopSystem->getSerilizeParam('admoption.watermark_text_size'), $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/font/' . $PHPShopSystem->getSerilizeParam('admoption.watermark_text_font') . '.ttf', $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_color'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_alpha'), 0, $PHPShopSystem->getSerilizeParam('admoption.watermark_center_enabled'));

                $thumb->save($file_big);
            }
        }

        if (!$PHPShopSystem->ifSerilizeParam('admoption.image_save_name') and !empty($tmp_file))
            unlink($tmp_file);

        // ���������� � ������� �����������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
        $insert['parent_new'] = $_POST['rowID'];
        $insert['name_new'] = $path . $name;
        $insert['pic_small_new'] = $path . $name_s;
        //$insert['info_new'] = $_POST['info_img_new'][0];
        $PHPShopOrm->insert($insert);
        return $insert;
    }
}

// �������� �����������
function fotoDelete($where = null) {

    if (!is_array($where))
        $where = array('parent' => '=' . intval($_POST['rowID']));

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
    $data = $PHPShopOrm->select(array('*'), $where, false, array('limit' => 100));
    if (is_array($data)) {
        foreach ($data as $row) {
            $name = $row['name'];
            $pathinfo = pathinfo($name);
            $oldWD = getcwd();
            $dirWhereRenameeIs = $_SERVER['DOCUMENT_ROOT'] . $pathinfo['dirname'];
            $oldFilename = $pathinfo['basename'];

            @chdir($dirWhereRenameeIs);
            @unlink($oldFilename);
            $oldFilename_s = str_replace(".", "s.", $oldFilename);
            @unlink($oldFilename_s);
            $oldFilename_big = str_replace(".", "_big.", $oldFilename);
            @unlink($oldFilename_big);
            @chdir($oldWD);
        }
        $PHPShopOrm->clean();
        return $PHPShopOrm->delete($where);
    }
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopSystem;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    // �������� ��������
    $data = $PHPShopOrm->select(array('parent'), array('id' => '=' . intval($_POST['rowID'])));
    $PHPShopOrm->clean();

    $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['rowID'])));

    // �������� �����������
    if ($action)
        fotoDelete();

    // �������� �������� ��� �������� �������� ������
    if ($action and !empty($data['parent'])) {

        $parent = @explode(",", $data['parent']);
        $PHPShopOrm->mysql_error = false;

        if ($PHPShopSystem->ifSerilizeParam('1c_option.update_option'))
            $PHPShopOrm->delete(array('uid' => ' IN ("' . @implode('","', $parent) . '")'));
        else
            $PHPShopOrm->delete(array('id' => ' IN ("' . @implode('","', $parent) . '")'));
    }

    // �������� �������, ��������� ��������� ������ �� �������
    if (!empty($_POST['parent_enabled'])) {

        $PHPShopProduct = new PHPShopProduct($_POST['parent']);
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $parent_array = @explode(",", $PHPShopProduct->getParam('parent'));
        if (is_array($parent_array)) {
            foreach ($parent_array as $v)
                if (!empty($v) and $v != $_POST['rowID'])
                    $parent_array_true[] = $v;
        }

        if (is_array($parent_array_true))
            $PHPShopOrm->update(array('parent_new' => @implode(",", $parent_array_true)), array('id' => '=' . intval($_POST['parent'])));
        else
            $PHPShopOrm->update(array('parent_new' => ''), array('id' => '=' . intval($_POST['parent'])));
    }

    return array("success" => $action);
}

/**
 * ������������� �����
 */
function actionOptionEdit() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm;

    PHPShopObj::loadClass('sort');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])));

    if (empty($data['name'])) {
        $data['name'] = $_REQUEST['parent_name'] . ' ' . $data['parent'] . ' ' . $data['parent2'];
    }

    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->tab_key = 1000;

    // ��������� �����
    if (!empty($data['parent2']) and empty($data['color']))
        $data['color'] = PHPShopString::getColor($data['parent2']);

    $PHPShopCategoryArray = new PHPShopCategoryArray(array('id' => '=' . $data['category']));
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $PHPShopParentNameArray = new PHPShopParentNameArray(array('id' => '=' . $CategoryArray[$data['category']]['parent_title']));
    $parent_title = $PHPShopParentNameArray->getParam($CategoryArray[$data['category']]['parent_title'] . ".name");

    if (empty($parent_title))
        $parent_title = __('������');



    $Tab1 = $PHPShopGUI->setField(array($parent_title, '�'), array($PHPShopGUI->setInputArg(array('name' => 'parent_new', 'type' => 'text', 'value' => $data['parent'])), $PHPShopGUI->setInputArg(array('name' => 'num_new', 'type' => 'text', 'value' => $data['num'], 'size' => 110))), array(array(2, 6), array(1, 2)));
    $Tab1 .= $PHPShopGUI->setField(array('����', '���'), array($PHPShopGUI->setInputArg(array('name' => 'parent2_new', 'type' => 'text', 'value' => $data['parent2'])), $PHPShopGUI->setInputColor('color_new', $data['color'], 110)), array(array(2, 6), array(1, 2)));
    $Tab1 .= $PHPShopGUI->setField('��������', $PHPShopGUI->setInputArg(array('name' => 'name_new', 'type' => 'text.required', 'value' => $data['name'])) . $PHPShopGUI->setHelp(__('������') . ' <a href="?path=product&return=catalog.' . $data['category'] . '&id=' . $_REQUEST['id'] . '&view=option">' . __('�������� ������') . '</a>, ' . __('����������� � �������'), false, false));
    $Tab1 .= $PHPShopGUI->setField('�������', $PHPShopGUI->setInputArg(array('name' => 'uid_new', 'type' => 'text', 'value' => $data['uid'])));

    // �����
    if (empty($data['ed_izm']))
        $ed_izm = '��.';
    else
        $ed_izm = $data['ed_izm'];

    // �������������� �����
    $PHPShopOrmWarehouse = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
    $dataWarehouse = $PHPShopOrmWarehouse->select(array('*'), array('enabled' => "='1'"), array('order' => 'num DESC'), array('limit' => 100));
    if (is_array($dataWarehouse)) {

        $warehouse_main = '����� �����';
        foreach ($dataWarehouse as $row) {
            $warehouse_name[] = $row['name'];
            $warehouse[] = $PHPShopGUI->setInputText(false, 'items' . $row['id'] . '_new', $data['items' . $row['id']], 80, $ed_izm);
            $warehouse_size[] = array(2, 1);
        }

        $Tab1 .= $PHPShopGUI->setField($warehouse_name, $warehouse, $warehouse_size);
    }
    else
        $warehouse_main = '�����';

    // ����� � ���
    $Tab1 .= $PHPShopGUI->setField(array($warehouse_main, '���'), array($PHPShopGUI->setInputText(false, 'items_new', $data['items'], 150, $ed_izm), $PHPShopGUI->setInputText(false, 'weight_new', $data['weight'], 150, '��.')), array(array(2, 4), array(2, 4)));

    // ������
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    $valuta_area = null;
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            if ($data['baseinputvaluta'] == $val['id']) {
                $check = 'checked';
                $valuta_def_name = $val['code'];
            }
            else
                $check = false;
            $valuta_area .= $PHPShopGUI->setRadio('baseinputvaluta_new', $val['id'], $val['name'], $check, false, false, false, false);
        }


    // ���������� � �����
    $Tab1 .= $PHPShopGUI->setField(array('������ ����', '�����'), array($PHPShopGUI->setInputText(null, 'price_n_new', $data['price_n'], 150, $valuta_def_name), $PHPShopGUI->setCheckbox('enabled_new', 1, '����� � ������', $data['enabled'])), array(array(2, 4), array(2, 4)));


    // ����
    $Tab1 .= $PHPShopGUI->setField(array('���� 1', '���� 2'), array($PHPShopGUI->setInputText(null, 'price_new', $data['price'], 150, $valuta_def_name), $PHPShopGUI->setInputText(null, 'price2_new', $data['price2'], 150, $valuta_def_name)), array(array(2, 4), array(2, 4)));

    // ������
    $Tab1 .= $PHPShopGUI->setField('������', $valuta_area);
    $Tab1 .= $PHPShopGUI->setInputArg(array('name' => 'rowID', 'type' => 'hidden', 'value' => $_REQUEST['id']));
    $Tab1 .= $PHPShopGUI->setInputArg(array('name' => 'parentID', 'type' => 'hidden', 'value' => $_REQUEST['parentID']));

    $Tab1 .= $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['pic_big'], "pic_big_new", true, array('load' => false, 'server' => true, 'url' => false, 'view' => false)) . $PHPShopGUI->setHelp('�� ������ ������� ���� � �������� <a href="#" class="set-image-tab">�����������</a> ��� �������� ���� �������������� ����.'));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    $PHPShopGUI->setTab(array("��������", $Tab1));

    writeLangFile();
    exit($PHPShopGUI->_CODE . '<p class="clearfix"> </p>');
}

/**
 * ������������� ����
 */
function actionFileEdit() {
    global $PHPShopGUI, $PHPShopModules;


    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField('��������', $PHPShopGUI->setInputArg(array('name' => 'modal_file_name', 'type' => 'text.required', 'value' => urldecode($_GET['name']))));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setField('����', $PHPShopGUI->setFile($_GET['file'], 'lfile', array('server' => true)));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setInputArg(array('name' => 'selectID', 'type' => 'hidden', 'class' => 'data-id', 'value' => $_POST['selectID']));
    $PHPShopGUI->_CODE .= $PHPShopGUI->setInputArg(array('name' => 'fileCount', 'type' => 'hidden', 'class' => 'data-count', 'value' => $_POST['fileCount']));

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    exit($PHPShopGUI->_CODE . '<p class="clearfix"> </p>');
}

// ������� �������� �����������
function actionImgDelete() {
    global $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = fotoDelete(array('id' => '=' . $_POST['rowID']));

    return array("success" => $action);
}

// ������� �������������� �����������
function actionImgEdit() {
    global $PHPShopModules;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . intval($_POST['rowID'])));

    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>