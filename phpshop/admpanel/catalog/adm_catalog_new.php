<?php

PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");


$TitlePage = __('����� �������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

// ���������� ������ ���������
function treegenerator($array, $i, $parent) {
    global $tree_array;

    $del = '�&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree_select = $check = false;
    $del = str_repeat($del, $i);
    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator($tree_array[$k], $i + 1, $k);

            if ($k == $_GET['id'])
                $selected = 'selected';
            else
                $selected = null;

            if (empty($check['select'])) {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                $i = 1;
            } else {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
            }

            $tree_select.=$check['select'];
        }
    }
    return array('select' => $tree_select);
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./catalog/gui/catalog.gui.js', './js/bootstrap-tour.min.js', './catalog/gui/tour.gui.js', './js/bootstrap-treeview.min.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-treeview.min.css');

    // ��������� ������
    $data = array();
    //$data['name'] = __('����� �������');
    // ��-��� ������ �� �������� ��������.. ������ 0 ��� ��������� ��������� ��������������� ������� �����.
    $data['num_cow'] = 0;
    //$data['num_cow'] = $PHPShopSystem->getParam('num_row');
    $data['num_row'] = 3;
    $data['num'] = 1;

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    $PHPShopGUI->action_select['����'] = array(
        'name' => '��������',
        'action' => 'presentation',
        'icon' => 'glyphicon glyphicon-education'
    );

    $PHPShopGUI->setActionPanel(__("����� �������"), array('����'), array('������� � �������������'));

    // ������������
    $Tab_info = $PHPShopGUI->setField(__("��������:"), $PHPShopGUI->setInputArg(array('name' => 'name_new', 'type' => 'text.requared', 'value' => $data['name'])));


    $PHPShopCategoryArray = new PHPShopCategoryArray();
    $CategoryArray = $PHPShopCategoryArray->getArray();
    $GLOBALS['count'] = count($CategoryArray);

    $CategoryArray[0]['name'] = '- �������� ������� -';
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

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="parent_to_new" data-width="100%"><option value="0">' . $CategoryArray[0]['name'] . '</option>';
    if ($k == $data['parent_to'])
        $selected = 'selected';
    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $k);

            if ($k == $data['parent_to'])
                $selected = 'selected';
            else
                $selected = null;

            $tree_select.='<option value="' . $k . '"  ' . $selected . '>' . $v . '</option>';
            $tree_select.=$check['select'];
        }
    $tree_select.='</select>';

    // ����� ��������
    $Tab_info.= $PHPShopGUI->setField(__("����������:"), $tree_select);

    // �����
    $num_row_area = $PHPShopGUI->setRadio('num_row_new', 1, 1, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 2, 2, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 3, 3, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 4, 4, $data['num_row']);
    $Tab_info.=$PHPShopGUI->setField(__("������� � �����:"), $num_row_area, 'left');

    // �����
    // ����� ������� �������� ������ ��� �������� ���������.
    if ($data['parent_to'] == 0)
        $vid = $PHPShopGUI->setCheckbox('vid_new', 1, __('�������� ����������� ������� � �������� ����'), $data['vid']);
    $vid .= $PHPShopGUI->setCheckbox('skin_enabled_new', 1, __('������ �������'), $data['skin_enabled']);
    $Tab_info.=$PHPShopGUI->setField(__("����� ������:"), $vid);

    // ������� �� ��������
    $Tab_info.=$PHPShopGUI->setLine() . $PHPShopGUI->setField(__("������� �� ��������:"), $PHPShopGUI->setInputText(false, 'num_cow_new', $data['num_cow'], '100', __('��.')), 'left');

    // ��� ����������
    $order_by_value[] = array('�� �����', 1, $data['order_by']);
    $order_by_value[] = array('�� ����', 2, $data['order_by']);
    $order_by_value[] = array('�� ������', 3, $data['order_by']);
    $order_to_value[] = array('�����������', 1, $data['order_to']);
    $order_to_value[] = array('��������', 2, $data['order_to']);
    $Tab_info.=$PHPShopGUI->setField(__("����������:"), $PHPShopGUI->setInputText(null, "num_new", $data['num'], 100, false, 'left') . '&nbsp' .
            $PHPShopGUI->setSelect('order_by_new', $order_by_value, 120) . $PHPShopGUI->setSelect('order_to_new', $order_to_value, 120), 'left');

    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), $Tab_info);


    // ������
    $Tab_icon.=$PHPShopGUI->setField(__("�����������"), $PHPShopGUI->setIcon($data['icon'], "icon_new", false));


    $Tab1.= $PHPShopGUI->setCollapse(__('������'), $Tab_icon);

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

    // �����������
    //$Tab8 = $PHPShopGUI->setCollapse(__('��������������'), $PHPShopGUI->loadLib('tab_secure', $data));
    //����������
    //$Tab8.=$PHPShopGUI->setCollapse(__('����������'), $PHPShopGUI->loadLib('tab_multibase', $data));
    // ���������� �������� �������������� ���� ��� ������������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
    $subcategory_data = $PHPShopOrm->select(array('id'), array('parent_to' => '=' . intval($data['id'])), false, array('limit' => 2));
    if (!is_array($subcategory_data))
        $Tab9 = $PHPShopGUI->setCollapse(__('��������������'), $PHPShopGUI->loadLib('tab_sorts', $data));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1), array(__("��������"), $Tab2), array(__("���������"), $Tab7), array(__("��������������"), $Tab9));

    // �����������
    if ($GLOBALS['count'] > 500)
        $treebar = '<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
    <span class="sr-only">��������..</span>
  </div>
</div>';

    // ����� ���������
    $search = '<div class="none" id="category-search" style="padding-bottom:5px;"><div class="input-group input-sm">
                <input type="input" class="form-control input-sm" type="search" id="input-category-search" placeholder="' . __('������ � ����������...') . '" value="">
                 <span class="input-group-btn">
                  <a class="btn btn-default btn-sm" id="btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></a>
                 </span>
            </div></div>';

    // ����� �������
    $sidebarleft[] = array('title' => '���������', 'content' => $search . '<div id="tree">' . $treebar . '</div>', 'title-icon' => '<span class="glyphicon glyphicon-plus new" data-toggle="tooltip" data-placement="top" title="�������� �������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-down" data-toggle="tooltip" data-placement="top" title="����������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-up" data-toggle="tooltip" data-placement="top" title="��������"></span>&nbsp;<span class="glyphicon glyphicon-search" id="show-category-search" data-toggle="tooltip" data-placement="top" title="�����"></span>');

    $PHPShopGUI->setSidebarLeft($sidebarleft, 3);
    $PHPShopGUI->sidebarLeftCell = 3;



    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.catalog.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 * @return bool 
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopOrm;

    if (empty($_POST['vid_new']))
        $_POST['vid_new'] = 0;

    if (empty($_POST['yml_new']))
        $_POST['yml_new'] = 0;

    // ��������������
    $_POST['sort_new'] = serialize($_POST['sort_new']);

    // ����������
    $_POST['servers_new'] = null;
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            $_POST['servers_new'].="i" . $v . "i";

    $_POST['iocn_new'] = iconAdd();

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    header('Location: ?path=' . $_GET['path'] . '&id=' . $action);
    return $action;
}

// ���������� ����������� 
function iconAdd() {

    // ����� ����������
    $path = '/UserFiles/Image/';

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg', 'jpeg'))) {
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


    if (!empty($file)) {
        return $file;
    }
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>