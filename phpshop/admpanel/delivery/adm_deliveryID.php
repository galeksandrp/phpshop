<?php

PHPShopObj::loadClass(array('delivery', 'payment'));


$TitlePage = __('�������������� ��������') . ' #' . $_GET['id'];
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
		<td><a href="?path=delivery&cat=' . $k . '">' . $v . '</a></td>
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
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem;

    // ������ �������� ����
    $PHPShopGUI->field_col = 3;
    $PHPShopGUI->addJSFiles('./js/jquery.treegrid.js', './delivery/gui/delivery.gui.js');

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    if (!empty($data['is_folder']))
        $catalog = true;
    else
        $catalog = false;

    $PHPShopGUI->setActionPanel(__("��������") . ' &rarr; ' . $data['city'], array('�������', '|', '�������',), array('���������', '��������� � �������'));

    // ������������
    $Tab_info = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(false, 'city_new', $data['city'], '100%'));


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

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-container=""  data-style="btn btn-default btn-sm" name="PID_new"><option value="0">' . $CategoryArray[0]['city'] . '</option>';
    $tree = '<table class="tree table table-hover">';
    if ($k == $data['PID'])
        $selected = 'selected';
    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator($tree_array[$k], 1, $k);

            $tree.='<tr class="treegrid-' . $k . ' data-tree">
		<td><a href="?path=delivery&cat=' . $k . '">' . $v . '</a></td>
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
    $Tab_info.= $PHPShopGUI->setField("����������", $tree_select);

    // �����
    $Tab_info.=$PHPShopGUI->setField("�����", $PHPShopGUI->setCheckbox('enabled_new', 1, "�������� ������", $data['enabled']) . $PHPShopGUI->setCheckbox('flag_new', 1, "�������� �� ���������", $data['flag']));

    // ����
    $Tab_price = $PHPShopGUI->setField("���������", $PHPShopGUI->setInputText(false, 'price_new', $data['price'], '150', $PHPShopSystem->getDefaultValutaCode()));

    $Tab_price.=$PHPShopGUI->setField("���������� �������� �����", $PHPShopGUI->setInputText(false, 'price_null_new', $data['price_null'], '150', $PHPShopSystem->getDefaultValutaCode()) . $PHPShopGUI->setCheckbox('price_null_enabled_new', 1, "���������", $data['price_null_enabled']));

    // �����
    $Tab_price.=$PHPShopGUI->setField("����� �� ������ 0.5 �� ����", $PHPShopGUI->setInputText(false, 'taxa_new', $data['taxa'], '150', $PHPShopSystem->getDefaultValutaCode()) . $PHPShopGUI->setHelp('������������ ��� ������� �������������� ����������� (��������, ��� "����� ������").<br>������ �������������� 0.5 �� ����� ������� 0.5 �� ����� ������ ��������� �����.'));

    if ($data['ofd_nds'] == '')
        $data['ofd_nds'] = $PHPShopSystem->getParam('nds');

    $Tab_price.= $PHPShopGUI->setField("�������� ���", $PHPShopGUI->setInputText(null, 'ofd_nds_new', $data['ofd_nds'], 100, '%'));

    // ��� ����������
    $Tab_info.=$PHPShopGUI->setField("���������", $PHPShopGUI->setInputText('�', "num_new", $data['num'], 150));

    // ��������� ������ ������� �� ��
    $city_select_value[] = array('�� ������������', 0, $data['city_select']);
    $city_select_value[] = array('������ ������� � ������ ��', 1, $data['city_select']);
    $city_select_value[] = array('��� ������ ����', 2, $data['city_select']);

    if (!$catalog)
        $Tab_info.=$PHPShopGUI->setField("������ ������� �������� � �������", $PHPShopGUI->setSelect('city_select_new', $city_select_value, null, true));

    $Tab1 = $PHPShopGUI->setCollapse('����������', $Tab_info);

    // ������
    $Tab1.=$PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['icon'], "icon_new", false));

    $PHPShopPaymentArray = new PHPShopPaymentArray(array('enabled' => "='1'"));
    if (strstr($data['payment'], ","))
        $payment_array = explode(",", $data['payment']);
    else
        $payment_array[] = $data['payment'];

    $PaymentArray = $PHPShopPaymentArray->getArray();
    if (is_array($PaymentArray))
        foreach ($PaymentArray as $payment) {

            if (in_array($payment['id'], $payment_array))
                $payment_check = $payment['id'];
            else
                $payment_check = null;
            $payment_value[] = array($payment['name'], $payment['id'], $payment_check);
        }

    // ������
    if (empty($data['is_folder']))
        $Tab1.=$PHPShopGUI->setField("���������� �����", $PHPShopGUI->setSelect('payment_new[]', $payment_value, false, true, false, $search = false, false, $size = 1, true));

    // ��� �������
    if (isset($data['is_mod']))
        $Tab1.=$PHPShopGUI->setField(__('�� �������� ���������'), $PHPShopGUI->setRadio('is_mod_new', 1, __('���������'), $data['is_mod'], false, 'text-warning') . $PHPShopGUI->setRadio('is_mod_new', 2, __('��������'), $data['is_mod']));

    // ����� ������
    if (empty($data['is_folder']))
        $Tab1.=$PHPShopGUI->setField("���������� ��� ��������� �����", $PHPShopGUI->setInputText(null, "sum_max_new", $data['sum_max'], 150, $PHPShopSystem->getDefaultValutaCode()));

    // ����
    if (!$catalog)
        $Tab1.= $PHPShopGUI->setCollapse('����', $Tab_price);

    // �������
    $Tab1.=$PHPShopGUI->setField("�������", $PHPShopGUI->loadLib('tab_multibase', $data, 'catalog/'));
    
    // ������
    $PHPShopOrmWarehouse = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
    $dataWarehouse = $PHPShopOrmWarehouse->select(array('*'), array('enabled' => "='1'"), array('order' => 'num DESC'), array('limit' => 100));
    $warehouse_value[] = array('����� �����', 0, $data['warehouse']);
    if (is_array($dataWarehouse)) {
        foreach ($dataWarehouse as $val) {
            $warehouse_value[] = array($val['name'], $val['id'], $data['warehouse']);
        }
    }
    
    $Tab1.=$PHPShopGUI->setField("����� ��� ��������", $PHPShopGUI->setSelect('warehouse_new', $warehouse_value,300));

    // �������������� ����
    if (!$catalog)
        $Tab2 = $PHPShopGUI->loadLib('tab_option', $data);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    if (!$catalog)
        $PHPShopGUI->setTab(array("��������", $Tab1), array("������ ������������", $Tab2));
    else
        $PHPShopGUI->setTab(array("��������", $Tab1));

    // ����� �������
    $sidebarleft[] = array('title' => '���������', 'content' => $tree, 'title-icon' => '<span class="glyphicon glyphicon-plus newcat" data-toggle="tooltip" data-placement="top" title="�������� �������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-down" data-toggle="tooltip" data-placement="top" title="����������"></span>&nbsp;<span class="glyphicon glyphicon-chevron-up" data-toggle="tooltip" data-placement="top" title="��������"></span>');

    $help = '<p class="text-muted">' . __('� ������� ���� �������� ����� ��������� ������������ � �������������� ���� ��� ���������� ������ � �������� ���������� ��������� <kbd>������ ������������</kbd>') . '</p>';

    $sidebarleft[] = array('title' => '���������', 'content' => $help);

    $PHPShopGUI->setSidebarLeft($sidebarleft, 3);
    $PHPShopGUI->sidebarLeftCell = 3;

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.delivery.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.delivery.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.delivery.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    $result = actionUpdate();

    if (isset($_REQUEST['ajax'])) {
        exit(json_encode($result));
    }
    else
        header('Location: ?path=' . $_GET['path'] . '&cat=' . $_POST['PID_new']);
}

/**
 * ����� ����������
 * @return bool
 */
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    if (is_array($_POST['data_fields'])) {

        if (is_array($_POST[data_fields][enabled]))
            foreach ($_POST[data_fields][enabled] as $k => $v) {
                $_POST[data_fields][enabled][$k] = array_map("urldecode", $v);
            }


        $_POST['data_fields_new'] = serialize($_POST['data_fields']);
    }

    if (empty($_POST['ajax'])) {

        // ������������� ������ ��������
        $PHPShopOrm->updateZeroVars('flag_new', 'enabled_new', 'price_null_enabled_new');
    }

    if (!empty($_POST['icon_new']))
        $_POST['icon_new'] = iconAdd('icon_new');

    // ������
    if (isset($_POST['payment_new'])) {
        if (is_array($_POST['payment_new']))
            $_POST['payment_new'] = @implode(',', $_POST['payment_new']);
    }

    // ����������
    if (is_array($_POST['servers'])){
        $_POST['servers_new'] = "";
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['servers_new'].="i" . $v . "i";
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
    $PHPShopOrm->debug = false;

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . intval($_POST['rowID'])));

    return array("success" => $action);
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

    if (empty($file))
        $file = '';

    return $file;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);


    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    $PHPShopOrm->debug = true;
    return array('success' => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>