<?php

PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");

$TitlePage = __('�������������� ���������') . ' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

// ���������� ������ ���������
function treegenerator($array, $i, $curent, $dop_cat_array) {
    global $tree_array;
    $del = '&brvbar;&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree_select = $tree_select_dop = $check = false;

    $del = str_repeat($del, $i);
    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator($tree_array[$k], $i + 1, $k, $dop_cat_array);

            if ($k == $_GET['parent_to'])
                $selected = 'selected';
            else
                $selected = null;

            // �������� ������������
            if ($k == $_GET['id'])
                $disabled = ' disabled ';
            else
                $disabled = null;

            // �����������
            $selected_dop = null;
            if (is_array($dop_cat_array))
                foreach ($dop_cat_array as $vs) {
                    if ($k == $vs)
                        $selected_dop = "selected";
                }

            if (empty($check['select'])) {
                $tree_select .= '<option value="' . $k . '" ' . $selected . $disabled . '>' . $del . $v . '</option>';

                //if ($k < 1000000)
                    $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . $disabled . '>' . $del . $v . '</option>';

                $i = 1;
            } else {
                $tree_select .= '<option value="' . $k . '" ' . $selected . $disabled . ' >' . $del . $v . '</option>';
               // if ($k < 1000000)
                    $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . $disabled . '>' . $del . $v . '</option>';
            }

            $tree_select .= $check['select'];
            $tree_select_dop .= $check['select_dop'];
        }
    }
    return array('select' => $tree_select, 'select_dop' => $tree_select_dop);
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.treegrid.js', './catalog/gui/catalog.gui.js', './js/bootstrap-treeview.min.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-treeview.min.css');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    $PHPShopGUI->action_select['������������'] = array(
        'name' => '������������',
        'url' => '../../shop/CID_' . $data['id'] . '.html',
        'action' => 'front' . $GLOBALS['isFrame'],
        'target' => '_blank'
    );

    $PHPShopGUI->action_select['������'] = array(
        'name' => '������ � ��������',
        'url' => '?path=' . $_GET['path'] . '&cat=' . intval($_GET['id']),
        'class' => $GLOBALS['isFrame']
    );

    $PHPShopGUI->setActionPanel(__("�������") . ': ' . $data['name'] . ' [ID ' . $data['id'] . ']', array('������', '�������', '������������', '|', '�������'), array('���������', '��������� � �������'));

    // ������������
    $Tab_info = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(false, 'name_new', $data['name'], '100%'));

    // ����� ����������
    if ($PHPShopSystem->ifSerilizeParam('admoption.rule_enabled', 1) and ! $PHPShopBase->Rule->CheckedRules('catalog', 'remove')) {
        $where = array('secure_groups' => " REGEXP 'i" . $_SESSION['idPHPSHOP'] . "i' or secure_groups = ''");
        $secure_groups = true;
    } else
        $where = $secure_groups = false;

    $PHPShopCategoryArray = new PHPShopCategoryArray($where);
    $CategoryArray = $PHPShopCategoryArray->getArray();
    $GLOBALS['count'] = count($CategoryArray);

    $CategoryArray[0]['name'] = '- ' . __('�������� �������') . ' -';
    $tree_array = array();

    foreach ($PHPShopCategoryArray->getKey('parent_to.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['name'];
        $tree_array[$k]['id'] = $k;
        if ($k == $data['parent_to'])
            $tree_array[$k]['selected'] = true;
    }

    $GLOBALS['tree_array'] = &$tree_array;
    $_GET['parent_to'] = $data['parent_to'];

    // �����������
    $dop_cat_array = preg_split('/#/', $data['dop_cat'], -1, PREG_SPLIT_NO_EMPTY);

    if ($k == $data['parent_to'])
        $selected = 'selected';
    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $k, $dop_cat_array);


            if ($k == $data['parent_to'])
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


            // �������� ������������
            if ($k == $_GET['id'])
                $disabled = ' disabled ';
            else
                $disabled = null;

            $tree_select .= '<option value="' . $k . '"  ' . $selected . $disabled . '>' . $v . '</option>';

                $tree_select_dop .= '<option value="' . $k . '" ' . $selected_dop . $disabled . '>' . $v . '</option>';

            $tree_select .= $check['select'];
            $tree_select_dop .= $check['select_dop'];
        }

    $tree_select_dop = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="dop_cat[]" data-width="100%" multiple><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select_dop . '</select>';

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="parent_to_new"  data-width="100%"><option value="0">' . $CategoryArray[0]['name'] . '</option>' . $tree_select . '</select>';

    // ����� ��������
    $Tab_info .= $PHPShopGUI->setField("����������", $tree_select);

    // �����
    $num_row_area = $PHPShopGUI->setRadio('num_row_new', 1, 1, $data['num_row'], false, false, false, false);
    $num_row_area .= $PHPShopGUI->setRadio('num_row_new', 2, 2, $data['num_row'], false, false, false, false);
    $num_row_area .= $PHPShopGUI->setRadio('num_row_new', 3, 3, $data['num_row'], false, false, false, false);
    $num_row_area .= $PHPShopGUI->setRadio('num_row_new', 4, 4, $data['num_row'], false, false, false, false);
    $num_row_area .= $PHPShopGUI->setRadio('num_row_new', 5, 5, $data['num_row'], false, false, false, false);
    $Tab_info .= $PHPShopGUI->setField("������� � �����", $num_row_area, 'left');


    $vid = $PHPShopGUI->setCheckbox('vid_new', 1, '�� �������� ���������� ����������� � ���� ���������', $data['vid']);
    $vid .= $PHPShopGUI->setCheckbox('skin_enabled_new', 1, '������ �������', $data['skin_enabled']);
    $vid .= $PHPShopGUI->setCheckbox('menu_new', 1, '������� ����', $data['menu']);
    $Tab_info .= $PHPShopGUI->setField("����� ������", $vid);

    // ������� �� ��������
    $Tab_info .= $PHPShopGUI->setLine() . $PHPShopGUI->setField("������� �� ��������", $PHPShopGUI->setInputText(false, 'num_cow_new', $data['num_cow'], '100', __('��.')), 'left');

    // ��� ����������
    $order_by_value[] = array(__('�� �����'), 1, $data['order_by']);
    $order_by_value[] = array(__('�� ����'), 2, $data['order_by']);
    $order_by_value[] = array(__('�� ������'), 3, $data['order_by']);
    $order_to_value[] = array(__('�����������'), 1, $data['order_to']);
    $order_to_value[] = array(__('��������'), 2, $data['order_to']);
    $Tab_info .= $PHPShopGUI->setField("����������", $PHPShopGUI->setInputText(null, "num_new", $data['num'], 100, false, 'left') . '&nbsp' .
            $PHPShopGUI->setSelect('order_by_new', $order_by_value, 120) . $PHPShopGUI->setSelect('order_to_new', $order_to_value, 120), 'left');

    // �������������� ��������
    $Tab_info .= $PHPShopGUI->setField('�������������� ��������', $tree_select_dop, 1, '����������� ������������ ��������� � ���������� ���������.');

    $Tab1 = $PHPShopGUI->setCollapse('����������', $Tab_info);

    // ������
    $Tab_icon .= $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['icon'], "icon_new", false));
    $Tab1 .= $PHPShopGUI->setCollapse('������', $Tab_icon);

    // ��������
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $editor = new Editor('content_new');
    $editor->Height = '450';
    $editor->Config['EditorAreaCSS'] = chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $editor->ToolbarSet = 'Normal';
    $editor->Value = $data['content'];
    $Tab2 = $editor->AddGUI();

    // ���������
    $Tab7 = $PHPShopGUI->loadLib('tab_headers', $data);

    // �����
    $Tab9 = $PHPShopGUI->setCollapse('������� ����� �������������', $PHPShopGUI->loadLib('tab_secure', $data), 'in', false);

    // ���������� �������� �������������� ���� ��� ������������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
    $subcategory_data = $PHPShopOrm->select(array('id'), array('parent_to' => '=' . intval($data['id'])), false, array('limit' => 1));

    // ��� �������
    if ($PHPShopSystem->getSerilizeParam("admoption.filter_cache_enabled") == 1) {
        $cache = $PHPShopGUI->setCheckbox('reset_cache', 1, __('�������� ��� ������������� ������� ������ �� ����������'), false);
        $Tab8 = $PHPShopGUI->setCollapse(__('����������� �������������'), $cache, 'in', false);
    }

    $Tab8 .= $PHPShopGUI->setCollapse('��������������', $PHPShopGUI->loadLib('tab_sorts', $data), 'in', false);

    if (!is_array($subcategory_data))
        $Tab8 .= $PHPShopGUI->setCollapse('�������� ��������', tab_parent($data) . $PHPShopGUI->setHelp('���������� ���������� �������� ������� ��������� � ������� <a href="?path=sort.parent" title="�������">�������� ��������</a>'), 'in', true);
    else
        $Tab8 .= $PHPShopGUI->setCollapse('�������� ��������', $PHPShopGUI->setHelp('�������� �������� �������� ������ � ������������ � ��������.'), 'in', true);


    // ����������
    $Tab9 .= $PHPShopGUI->setCollapse('���������� �� ��������', $PHPShopGUI->loadLib('tab_multibase', $data));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("��������", $Tab2), array("���������", $Tab7), array("��������������", $Tab8, true), array("�����", $Tab9, true));

    // �����������
    if ($GLOBALS['count'] > 500)
        $treebar = '<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
    <span class="sr-only">' . __("��������") . '..</span>
  </div>
</div>';

    // ����� ���������
    $search = '<div class="none" id="category-search" style="padding-bottom:5px;"><div class="input-group input-sm">
                <input type="input" class="form-control input-sm" type="search" id="input-category-search" placeholder="' . __('������ � ����������...') . '" value="">
                 <span class="input-group-btn">
                  <a class="btn btn-default btn-sm" id="btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></a>
                 </span>
            </div></div>';

    if (empty($GLOBALS['isFrame'])) {

        // ����� �������
        $sidebarleft[] = array('title' => '���������', 'content' => $search . '<div id="tree">' . $treebar . '</div>', 'title-icon' => '<span class="glyphicon glyphicon-plus new" data-toggle="tooltip" data-placement="top" title="�������� �������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-down" data-toggle="tooltip" data-placement="top" title="����������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-up" data-toggle="tooltip" data-placement="top" title="��������"></span>&nbsp;<span class="glyphicon glyphicon-search" id="show-category-search" data-toggle="tooltip" data-placement="top" title="�����"></span>');
        $PHPShopGUI->setSidebarLeft($sidebarleft, 3);
        $PHPShopGUI->sidebarLeftCell = 3;
    }


    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.catalog.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.catalog.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.catalog.edit");

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

    header('Location: ?path=catalog.list');
}

/**
 * ����� ����������
 * @return bool 
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopBase;

    // ��������������
    $_POST['sort_new'] = serialize($_POST['sort_new']);

    // �������� ���� ��������������
    if ($PHPShopBase->Rule->CheckedRules('catalog', 'rule')) {

        $secure = null;
        if (is_array($_POST['secure_groups_new']))
            foreach ($_POST['secure_groups_new'] as $crid => $value) {
                $secure .= 'i' . $crid . 'i';
                if (!empty($_POST['secure_groups_new']['all'])) {
                    $secure = '';
                    break;
                }
            }

        $_POST['secure_groups_new'] = $secure;
    }

    // ����������
    $_POST['servers_new'] = "";
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ',') )
                $_POST['servers_new'] .= "i" . $v . "i";

    // ��� ��������
    $_POST['dop_cat_new'] = "";
    if (is_array($_POST['dop_cat']) and $_POST['dop_cat'][0] != 'null') {
        $_POST['dop_cat_new'] = "#";
        foreach ($_POST['dop_cat'] as $v)
            if ($v != 'null' and ! strstr($v, ','))
                $_POST['dop_cat_new'] .= $v . "#";
    }

    $_POST['icon_new'] = iconAdd();

    // ������� ��� �������������
    if (!empty($_POST['reset_cache'])) {
        $_POST['sort_cache_new'] = '';
        $_POST['sort_cache_created_at_new'] = 0;
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('vid_new', 'skin_enabled_new', 'menu_new');
    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    $PHPShopOrm->clean();

    // �������� ������� �������� � ������� ������� � ����� �������
    $PHPShopOrm->clean();
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $check = $PHPShopOrm->select(array('id'), array("category" => "=" . $_POST['parent_to_new']), false, array('limit' => '1'));

    if (is_array($check))
        $PHPShopOrm->update(array("category" => $_POST['rowID']), array("category" => "=" . $_POST['parent_to_new']), false);

    return array('success' => $action);
}

// ���������� ����������� 
function iconAdd() {
    global $PHPShopSystem;

    // ����� ����������
    $path = $GLOBALS['SysValue']['dir']['dir'] . '/UserFiles/Image/' . $PHPShopSystem->getSerilizeParam('admoption.image_result_path');

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        $_FILES['file']['name'] = PHPShopString::toLatin(str_replace('.' . $_FILES['file']['ext'], '', PHPShopString::utf8_win1251($_FILES['file']['name']))) . '.' . $_FILES['file']['ext'];
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg', 'jpeg', 'svg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST['icon_new'];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST['icon_new'])) {
        $file = $_POST['icon_new'];
    }

    if (empty($file))
        $file = '';

    return $file;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
    $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['rowID'])));

    // ��������� ������ � ��������� �������� �� ��������� �����
    $PHPShopOrm->clean();

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $PHPShopOrm->update(array("category" => "1000004", "enabled" => '0','datas'=>time()), array("category" => "=" . $_POST['rowID']), false);

    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>