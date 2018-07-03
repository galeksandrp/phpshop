<?php

PHPShopObj::loadClass('delivery');


$TitlePage = __('�������� ��������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);

// ���������� ������ ���������
function treegenerator($array, $i, $parent) {
    global $tree_array;
    $del = '�&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree = $tree_select = $check = false;

    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {
            $del = str_repeat($del, $i);
            $check = treegenerator($tree_array[$k], $i + 1, $k);


            if ($k == $_GET['parent_to'])
                $selected = 'selected';
            else
                $selected = null;

            if (empty($check['select'])) {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                $i = 1;
            } else {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                //$i++;
            }


            $tree.='<tr class="treegrid-' . $k . ' treegrid-parent-' . $parent . ' data-tree">
		<td><a href="?path=delivery&id=' . $k . '">' . $v . '</a></td>
                    </tr>';

            $tree_select.=$check['select'];
            $tree.=$check['tree'];
        }
    }
    return array('select' => $tree_select, 'tree' => $tree);
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopSystem;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.treegrid.js', './delivery/gui/delivery.gui.js');

    if ($_GET['target'] == 'cat') {
        $catalog = true;
        $data['is_folder'] = 1;
    }
    else
        $catalog = false;

    // ��������� ������
    if ($catalog)
        $data['city'] = '����� ��������� ��������';
    else
        $data['city'] = '����� ��������';

    $data['enabled'] = 1;
    $data['PID'] = $_GET['cat'];




    $PHPShopGUI->setActionPanel(__("��������") . ' / ' . $data['city'], false, array('������� � �������������', '��������� � �������'));

    // ������������
    $Tab_info = $PHPShopGUI->setField(__("��������:"), $PHPShopGUI->setInputText(false, 'city_new', $data['city'], '100%') . $PHPShopGUI->setInput('hidden', 'is_folder_new', $data['is_folder']));


    $PHPShopCategoryArray = new PHPShopDeliveryArray(array('is_folder' => "='1'"));
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $CategoryArray[0]['city'] = '- �������� ������� -';
    $tree_array = array();

    foreach ($PHPShopCategoryArray->getKey('PID.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['city'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['city'];
        $tree_array[$k]['id'] = $k;
        if ($k == $data['PID'])
            $tree_array[$k]['selected'] = true;
    }



    $GLOBALS['tree_array'] = &$tree_array;
    $_GET['parent_to'] = $data['PID'];

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-container=".sidebarcontainer"  data-style="btn btn-default btn-sm" name="PID_new"><option value="0">' . $CategoryArray[0]['city'] . '</option>';
    $tree = '<table class="tree table table-hover">';
    if ($k == $data['PID'])
        $selected = 'selected';
    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $k);

            $tree.='<tr class="treegrid-' . $k . ' data-tree">
		<td><a href="?path=delivery&id=' . $k . '">' . $v . '</a></td>
                    </tr>';

            if ($k == $data['PID'])
                $selected = 'selected';
            else
                $selected = null;

            $tree_select.='<option value="' . $k . '"  ' . $selected . '>' . $v . '</option>';

            $tree_select.=$check['select'];
            $tree.=$check['tree'];
        }
    $tree_select.='</select>';
    $tree.='</table>';


    // ����� ��������
    $Tab_info.= $PHPShopGUI->setField(__("����������:"), $tree_select);

    // �����
    $Tab_info.=$PHPShopGUI->setField(__("�����:"), $PHPShopGUI->setCheckbox('enabled_new', 1, "�������� ������", $data['enabled']) . $PHPShopGUI->setCheckbox('flag_new', 1, "�������� �� ���������", $data['flag']));

    // ����
    $Tab_price = $PHPShopGUI->setField(__("���������:"), $PHPShopGUI->setInputText(false, 'price_new', $data['price'], '150', $PHPShopSystem->getDefaultValutaCode()));

    $Tab_price.=$PHPShopGUI->setField(__("���������� �������� �����:"), $PHPShopGUI->setInputText(false, 'price_null_new', $data['price_null'], '150', $PHPShopSystem->getDefaultValutaCode()) . $PHPShopGUI->setCheckbox('price_null_enabled_new', 1, "���������", $data['price_null_enabled']));

    // �����
    $Tab_price.=$PHPShopGUI->setField(__("����� �� ������ 0.5 �� ����"), $PHPShopGUI->setInputText(false, 'taxa_new', $data['taxa'], '150', $PHPShopSystem->getDefaultValutaCode()) . $PHPShopGUI->setHelp('������������ ��� ������� �������������� ����������� (��������, ��� "����� ������").<br>������ �������������� 0.5 �� ����� ������� 0.5 �� ����� ������ ��������� �����.'));


    // ��� ����������
    $Tab_info.=$PHPShopGUI->setField(__("���������:"), $PHPShopGUI->setInputText('�', "num_new", $data['num'], 150));

    // ��������� ������ ������� �� ��
    $city_select_value[] = array('�� ������������', 0, $data['city_select']);
    $city_select_value[] = array('������ ������� � ������ ��', 1, $data['city_select']);
    $city_select_value[] = array('��� ������ ����', 2, $data['city_select']);

    if (!$catalog)
        $Tab_info.=$PHPShopGUI->setField(__("������ ������� �����, �������� � �������:"), $PHPShopGUI->setSelect('city_select_new', $city_select_value));

    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), $Tab_info);

    // ������
    $Tab1.=$PHPShopGUI->setField(__("�����������"), $PHPShopGUI->setIcon($data['icon'], "icon_new", false));

    // ����
    if (!$catalog)
        $Tab1.= $PHPShopGUI->setCollapse(__('����'), $Tab_price);

    // �������������� ����
    if (!$catalog)
        $Tab2 = $PHPShopGUI->loadLib('tab_option', $data);


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    if (!$catalog)
        $PHPShopGUI->setTab(array(__("��������"), $Tab1), array(__("������ ������������"), $Tab2));
    else
        $PHPShopGUI->setTab(array(__("��������"), $Tab1));


    // ����� �������
    $sidebarleft[] = array('title' => '���������', 'content' => $tree, 'title-icon' => '<span class="glyphicon glyphicon-plus newcat" data-toggle="tooltip" data-placement="top" title="�������� �������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-down" data-toggle="tooltip" data-placement="top" title="����������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-up" data-toggle="tooltip" data-placement="top" title="��������"></span>');

    $help = '<p class="text-muted">� ������� ���� �������� ����� ��������� ������������ � �������������� ���� ��� ���������� ������ � �������� ���������� ��������� <kbd>������ ������������</kbd></p>';

    $sidebarleft[] = array('title' => '���������', 'content' => $help);

    $PHPShopGUI->setSidebarLeft($sidebarleft, 3);
    $PHPShopGUI->sidebarLeftCell = 3;

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.delivery.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    $PHPShopOrm->updateZeroVars('flag_new', 'enabled_new', 'price_null_enabled_new');

    $_POST['icon_new'] = iconAdd('icon_new');

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);

    if ($_POST['saveID'] == '������� � �������������')
        header('Location: ?path=' . $_GET['path'] . '&id=' . $action);
    else
        header('Location: ?path=' . $_GET['path']);

    return $action;
}

// ���������� ����������� 
function iconAdd($name = 'icon_new') {


    // ����� ����������
    $path = '/UserFiles/Image/';

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST[$name];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST[$name])) {
        $file = $_POST[$name];
    }

    if (!empty($file)) {
        return $file;
    }
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>