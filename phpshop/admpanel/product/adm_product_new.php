<?php

PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");
PHPShopObj::loadClass("product");

$TitlePage = __('����� �����');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

$colorArray = array(
    '�����' => '#ffffff',
    '������' => '#000000',
    '�������' => '#FF0000',
    '�������' => '#008000',
    '�����' => '#0000FF',
    '�������' => '#00FFFF',
    '������' => '#FFFF00',
    '�������' => '#FFC0CB',
    '���������' => '#FFA500',
    '����������' => '#EE82EE',
    '����������' => '#A0522D',
    '�����' => '#808080',
    '����������' => '#C0C0C0'
);

// ���������� ������ ���������
function treegenerator($array, $i, $curent, $dop_cat_array) {
    global $tree_array;
    $del = '&brvbar;&nbsp;&nbsp;&nbsp;&nbsp;';
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
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // �������� �� �������� ������������ ������
    $newId = getLastID();

    // ��������� ������
    $data = array();
    if (!empty($_GET['cat']))
        $data['category'] = intval($_GET['cat']);

    if (empty($_GET['id'])) {
        $data['ed_izm'] = $ed_izm = '��.';
        $data['baseinputvaluta'] = $PHPShopSystem->getDefaultOrderValutaId();
        $data['name'] = __('����� �����');
        $data['enabled'] = 1;
        $data['newtip'] = 1;
        $data['p_enabled'] = 1;
        $data['yml'] = 1;
        $data['id'] = $newId;
    } else {
        // �������� ����� ������
        $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));
        $data['id'] = $newId;
        $data['prod_seo_name'] = null;

        // ����������� �������
        if (!empty($data['pic_small']))
            imgCopy($_GET['id'], $newId);
    }


    $PHPShopGUI->action_select['����'] = array(
        'name' => '��������',
        'action' => 'presentation',
        'icon' => 'glyphicon glyphicon-education'
    );

    $PHPShopGUI->setActionPanel(__("����� �����"), array('����'), array('������� � �������������', '��������� � �������'));

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.tagsinput.min.js', './catalog/gui/catalog.gui.js', './js/jquery.waypoints.min.js', './product/gui/product.gui.js', './js/bootstrap-tour.min.js', './product/gui/tour.gui.js');
    $PHPShopGUI->addCSSFiles('./css/jquery.tagsinput.css');

    // ����� ����������
    if ($PHPShopSystem->ifSerilizeParam('admoption.rule_enabled', 1) and ! $PHPShopBase->Rule->CheckedRules('catalog', 'remove')) {
        $where = array('secure_groups' => " REGEXP 'i" . $_SESSION['idPHPSHOP'] . "i' or secure_groups = ''");
        $secure_groups = true;
    } else
        $where = $secure_groups = false;

    $PHPShopCategoryArray = new PHPShopCategoryArray($where);
    $CategoryArray = $PHPShopCategoryArray->getArray();

    //$CategoryArray[0]['name'] = '- ' . __('������� �������') . ' -';
    $tree_array = array();

    foreach ($PHPShopCategoryArray->getKey('parent_to.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['name'];
        $tree_array[$k]['id'] = $k;
    }

    $GLOBALS['tree_array'] = &$tree_array;

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
                $disabled = 'disabled';

            $tree_select .= '<option value="' . $k . '" ' . $selected . $disabled . '>' . $v . '</option>';
            $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . $disabled . '>' . $v . '</option>';

            $tree_select .= $check['select'];
            $tree_select_dop .= $check['select_dop'];
        }

    $tree_select_dop = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="dop_cat[]" data-width="100%" multiple><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select_dop . '</select>';

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="category_new"  data-width="100%"><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select . '</select>';


    // ����� ��������
    $Tab_info = $PHPShopGUI->setField("����������", $tree_select);

    // ������������
    $Tab_info .= $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(null, 'name_new', $data['name']));

    // �������
    $Tab_info .= $PHPShopGUI->setField('�������', $PHPShopGUI->setInputText(null, 'uid_new', $data['uid'], 250));

    // ������
    $Tab_info .= $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['pic_big'], "pic_big_new", true, array('load' => false, 'server' => true, 'url' => false)), 1, '������� ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������� ���� �������� �����.');
    $Tab_info .= $PHPShopGUI->setField("������", $PHPShopGUI->setFile($data['pic_small'], "pic_small_new", array('load' => false, 'server' => 'image', 'url' => false)), 1, '������ ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������ �������� �����.');

    // ������� ���������
    $ed_izm = __('��.');


    // �������������� �����
    $PHPShopOrmWarehouse = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
    $dataWarehouse = $PHPShopOrmWarehouse->select(array('*'), array('enabled' => "='1'"), array('order' => 'num DESC'), array('limit' => 100));
    if (is_array($dataWarehouse)) {

        $Tab_info .= $PHPShopGUI->setField('����� �����:', $PHPShopGUI->setInputText(false, 'items_new', $data['items'], 100, $ed_izm), 'left');

        foreach ($dataWarehouse as $row) {
            $Tab_info .= $PHPShopGUI->setField($row['name'], $PHPShopGUI->setInputText(false, 'items' . $row['id'] . '_new', $data['items' . $row['id']], 100, $ed_izm), 2, $row['description']);
        }
    } else
        $Tab_info .= $PHPShopGUI->setField('�����:', $PHPShopGUI->setInputText(false, 'items_new', $data['items'], 100, $ed_izm), 'left');

    // ���
    $Tab_info .= $PHPShopGUI->setField('���', $PHPShopGUI->setInputText(false, 'weight_new', $data['weight'], 100, __('��.')), 'left');

    $Tab_info .= $PHPShopGUI->setField('������� ���������', $PHPShopGUI->setInputText(false, 'ed_izm_new', $ed_izm, 100));

    // ������������� ������
    $Tab_info .= $PHPShopGUI->setField('������������� ������ ��� ���������� �������', $PHPShopGUI->setTextarea('odnotip_new', $data['odnotip'], false, false, false, __('������� ID ������� ��� ��������������') . ' <a href="#" data-target="#odnotip_new"  class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ' . __('������� �������') . '</a>'));

    // �������������� ��������
    $Tab_info .= $PHPShopGUI->setField('�������������� ��������', $tree_select_dop, 1, '������ ������������ ��������� � ���������� ���������.');

    // ����� ������
    $Tab_info .= $PHPShopGUI->setField('����� ������', $PHPShopGUI->setCheckbox('enabled_new', 1, '����� � ��������', $data['enabled']) .
            $PHPShopGUI->setCheckbox('spec_new', 1, '���������������', $data['spec']) . $PHPShopGUI->setCheckbox('newtip_new', 1, '�������', $data['newtip']));
    $Tab_info .= $PHPShopGUI->setField('����������', $PHPShopGUI->setInputText('&#8470;', 'num_new', $data['num'], 150));
    ///$Tab_info .= $PHPShopGUI->setField('������ �� �������', $PHPShopGUI->setInputText(null, 'bonus_new', $data['bonus'], 150, '<span class="glyphicon glyphicon-gift"></span>'));

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
            } else
                $check = false;
            $valuta_area .= $PHPShopGUI->setRadio('baseinputvaluta_new', $val['id'], $val['name'], $check, false, false, array('code' => $val['code']));
        }

    // ����
    $Tab_price .= $PHPShopGUI->setField('���� 1', $PHPShopGUI->setInputText(null, 'price_new', $data['price'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('���� 2', $PHPShopGUI->setInputText(null, 'price2_new', $data['price2'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('���� 3', $PHPShopGUI->setInputText(null, 'price3_new', $data['price3'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('���� 4', $PHPShopGUI->setInputText(null, 'price4_new', $data['price4'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('���� 5', $PHPShopGUI->setInputText(null, 'price5_new', $data['price5'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('������ ����', $PHPShopGUI->setInputText(null, 'price_n_new', $data['price_n'], 150, $valuta_def_name));
    $Tab_price .= $PHPShopGUI->setField('��� �����', $PHPShopGUI->setCheckbox('sklad_new', 1, '��� �����', $data['sklad']));

    // ������
    $Tab_price .= $PHPShopGUI->setField('������', $valuta_area);

    $Tab1 .= $PHPShopGUI->setCollapse('����', $Tab_price, 'in', true, true, array('type' => 'price'));

    // YML
    $data['yml_bid_array'] = unserialize($data['yml_bid_array']);
    $Tab_yml = $PHPShopGUI->setField('YML', $PHPShopGUI->setCheckbox('yml_new', 1, '����� � ������ �������', $data['yml']) . '<br>' .
            $PHPShopGUI->setRadio('p_enabled_new', 1, '� �������', $data['p_enabled']) .
            $PHPShopGUI->setRadio('p_enabled_new', 0, '��������� (��� �����)', $data['p_enabled'])
    );

    // BID
    $Tab_yml .= $PHPShopGUI->setField('������ BID', $PHPShopGUI->setInputText(null, 'yml_bid_array[bid]', $data['yml_bid_array']['bid'], 100));
    $Tab_yml .= $PHPShopGUI->setField('������ CBID', $PHPShopGUI->setInputText(null, 'yml_bid_array[cbid]', $data['yml_bid_array']['cbid'], 100));
    $Tab1 .= $PHPShopGUI->setCollapse('������ ������', $Tab_yml, false);

    // �������
    $option_info = '<p class="text-muted">' . __('��� ���������� ����� �������� ���������� ������� ������� �������� ����� � ����� ������� � ��� ��������������') . ' <span href="?path=sort" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-floppy-saved"></span> ' . __('������� � �������������') . '</span>.</p>';
    $Tab_option = $PHPShopGUI->setCollapse('�������', $option_info, $collapse = 'none', false, false);

    // �������� �������� ��������
    $Tab2 = $PHPShopGUI->loadLib('tab_description', $data);

    // �������� ���������� ��������
    $Tab3 = $PHPShopGUI->loadLib('tab_content', $data);

    // ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
    $data_page = $PHPShopOrm->select(array('*'), false, array('order' => 'name'), array('limit' => 500));

    if (strstr($data['page'], ',')) {
        $data['page'] = explode(",", $data['page']);
    } else
        $data['page'] = array($data['page']);

    $value = array();
    if (is_array($data_page))
        foreach ($data_page as $val) {
            if (is_numeric(array_search($val['link'], $data['page']))) {
                $check = 'selected';
            } else
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

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("�����������", $Tab6), array("��������", $Tab2), array("��������", $Tab3,), array("���������", $Tab_docs), array("��������������", $Tab_sorts), array("�������", $Tab_option, true), array("���������", $Tab_header));


    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.catalog.create") .
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) . $PHPShopGUI->setInput("hidden", "tabName", null);

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����������� ������� ������
 */
function imgCopy($j, $n) {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
    $data = $PHPShopOrm->select(array('*'), array('parent' => '=' . intval($j)), false, array('limit' => 100));
    if (is_array($data))
        foreach ($data as $row) {
            $pic_b = $row['name'];
            $name = $row['name'];
            $pic_s = str_replace(".", "s.", $name);
            $pic_big = str_replace(".", "_big.", $name);
            $num = $row['num'];
            $info = $row['info'];
            $myRName = substr(abs(crc32(uniqid($n))), 0, 5);

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pic_s) and file_exists($_SERVER['DOCUMENT_ROOT'] . $pic_b)) {

                // ������� ��������
                $pathinfo = pathinfo($pic_b);
                $pic_b_ext = $pathinfo['extension'];
                $pic_b_name_new = "img" . $n . "_" . $myRName . "." . $pic_b_ext;
                $pic_b_name_old = $pathinfo['basename'];
                $pic_b_new = str_replace($pic_b_name_old, $pic_b_name_new, $pic_b);

                $oldWD = getcwd();
                $dirWhereRenameeIs = $_SERVER['DOCUMENT_ROOT'] . $pathinfo['dirname'];
                $oldFilename = $pathinfo['basename'];
                $newFilename = $pic_b_name_new;
                @chdir($dirWhereRenameeIs);
                @copy($oldFilename, $newFilename);
                @chdir($oldWD);

                // ��������� ������
                $pathinfo = pathinfo($pic_s);
                $pic_s_ext = $pathinfo['extension'];
                $pic_s_name_new = "img" . $n . "_" . $myRName . "s." . $pic_s_ext;
                $pic_s_name_old = $pathinfo['basename'];
                $pic_s_new = str_replace($pic_s_name_old, $pic_s_name_new, $pic_s);

                $oldFilename = $pathinfo['basename'];
                $newFilename = $pic_s_name_new;
                @chdir($dirWhereRenameeIs);
                @copy($oldFilename, $newFilename);
                @chdir($oldWD);

                // ��������
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pic_big)) {
                    $pathinfo = pathinfo($pic_big);
                    $pic_big_ext = $pathinfo['extension'];
                    $pic_big_name_new = "img" . $n . "_" . $myRName . "_big." . $pic_big_ext;
                    $pic_big_name_old = $pathinfo['basename'];
                    $pic_big_new = str_replace($pic_big_name_old, $pic_big_name_new, $pic_big);

                    $oldFilename = $pathinfo['basename'];
                    $newFilename = $pic_big_name_new;
                    @chdir($dirWhereRenameeIs);
                    @copy($oldFilename, $newFilename);
                    @chdir($oldWD);
                }

                $insert['parent_new'] = $n;
                $insert['name_new'] = $pic_b_new;
                $insert['num_new'] = $num;
                $insert['info_new'] = $info;

                $PHPShopOrm->clean();
                $PHPShopOrm->insert($insert);
            }
        }
}

/**
 * ID ����� ������ � �������
 * @return integer
 */
function getLastID() {
    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->sql = 'SHOW TABLE STATUS LIKE "' . $GLOBALS['SysValue']['base']['products'] . '"';
    $data = $PHPShopOrm->select();
    if (is_array($data)) {
        return $data[0]['Auto_increment'];
    }
}

/**
 * ����� ������
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopOrm, $PHPShopSystem;

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


    $_POST['datas_new'] = time();

    $_POST['yml_bid_array_new'] = serialize($_POST['yml_bid_array']);

    // ���������� �������������
    if (is_array($_POST['vendor_array_add'])) {
        foreach ($_POST['vendor_array_add'] as $k => $val) {

            $sort_array = $result = null;

            if (!empty($val)) {

                if (strstr($val, '#')) {
                    $sort_array = explode('#', $val);
                } else
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
            } else
                unset($_POST['vendor_array_add'][$k]);
        }
    }

    // ��������������
    $_POST['vendor_new'] = null;
    if (is_array($_POST['vendor_array_new']))
        foreach ($_POST['vendor_array_new'] as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $key => $p) {
                    $_POST['vendor_new'] .= "i" . $k . "-" . $p . "i";
                    if (empty($p))
                        unset($_POST['vendor_array_new'][$k][$key]);
                }
            } else
                $_POST['vendor_new'] .= "i" . $k . "-" . $v . "i";
        }
    $_POST['vendor_array_new'] = serialize($_POST['vendor_array_new']);

    // ������
    if (is_array($_POST['page_new']))
        $_POST['page_new'] = array_pop($_POST['page_new']);

    // �����
    $_POST['files_new'] = serialize($_POST['files_new']);

    // ���������� ����������� � �����������
    $img = fotoAdd();
    if (is_array($img)) {
        $_POST['pic_big_new'] = $img['name_new'];
        $_POST['pic_small_new'] = str_replace('.', 's.', $img['name_new']);
    }

    // ��� ��������
    $_POST['dop_cat_new'] = "";
    if (is_array($_POST['dop_cat']) and $_POST['dop_cat'][0] != 'null') {
        $_POST['dop_cat_new'] = "#";
        foreach ($_POST['dop_cat'] as $v)
            if ($v != 'null' and ! strstr($v, ','))
                $_POST['dop_cat_new'] .= $v . "#";
    }


    // ����� ������������
    $_POST['user_new'] = $_SESSION['idPHPSHOP'];

    // ��������� �����
    if (isset($_POST['parent2_new']) and empty($_POST['color_new']))
        $_POST['color_new'] = PHPShopString::getColor($_POST['parent2_new']);


    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('newtip_new', 'enabled_new', 'spec_new', 'yml_new');
    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->insert($_POST);

    // Ajax ��� ��������
    if (isset($_POST['ajax'])) {

        $PHPShopProduct = new PHPShopProduct($_POST['parent']);
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $parent_array = @explode(",", $PHPShopProduct->getParam('parent'));
        $parent_array_true[] = $action;
        if (is_array($parent_array))
            foreach ($parent_array as $v)
                if (!empty($v))
                    $parent_array_true[] = $v;

        $PHPShopOrm->update(array('parent_new' => @implode(",", $parent_array_true)), array('id' => '=' . intval($_POST['parent'])));

        return array("success" => $action);
    } else if ($_POST['saveID'] == '������� � �������������') {

        // �����������
        if ($_POST['tabName'] == '�����������')
            $tab = '&tab=1';
        else
            $tab = null;

        header('Location: ?path=product&return=catalog&id=' . $_POST['rowID'] . $tab);
    } else
        header('Location: ?path=catalog&cat=' . $_POST['category_new']);

    return $action;
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
                    $thumb->createWatermark($_SERVER['DOCUMENT_ROOT'] . $watermark, $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'));
                // Text
                elseif (!empty($watermark_text))
                    $thumb->createWatermarkText($watermark_text, $PHPShopSystem->getSerilizeParam('admoption.watermark_text_size'), $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/font/' . $PHPShopSystem->getSerilizeParam('admoption.watermark_text_font') . '.ttf', $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_color'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_alpha'), 0);

                $thumb->save($file_big);
            }
        }

        if (!$PHPShopSystem->ifSerilizeParam('admoption.image_save_name') and ! empty($tmp_file))
            unlink($tmp_file);

        // ���������� � ������� �����������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
        $insert['parent_new'] = $_POST['rowID'];
        $insert['name_new'] = $path . $name;
        $PHPShopOrm->insert($insert);
        return $insert;
    }
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>