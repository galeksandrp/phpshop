<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));

function TestCat($n) {// ���� �� ��� �����������
    global $SysValue,$link_db;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where parent_to='$n'";
    $result = mysqli_query($link_db,$sql);
    $num = mysqli_num_rows($result);
    return $num;
}

function Vivod_rekurs($n, $prefix, $categories) {// ����� ������������ ��������
    global $SysValue,$link_db;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to='$n' order by num, name";
    $result = mysqli_query($link_db,$sql);
    while ($row = mysqli_fetch_array($result)) {
        $i = 0;
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $parent_to = $row['parent_to'];
        $num = TestCat($id);



        if ($i < $num) {// ���� ���� ��� ��������
            //@$disp.=$name . Vivod_rekurs($id);
            $disp.='<option value="' . $id . '" disabled>' . $prefix . ' ' . $name . '</option>';
            $prefix = $prefix . '-';
            $disp.=Vivod_rekurs($id, $prefix, $categories);
        } else {// ���� ��� ���������
            //@$disp.=$name . DispName($parent_to, $name);
            $catego_ar = explode(',', $categories);
            foreach ($catego_ar as $val_c) {
                if ($val_c == $id):
                    $ssel = 'selected';
                    break;
                else:
                    $ssel = '';
                endif;
            }
            $disp.='<option value="' . $id . '" ' . $ssel . '>' . $prefix . ' ' . $name . '</option>';
            //$valuer = DispName($parent_to, $name);
        }
    }
    return @$disp;
}

function DispName($n, $catalog) {
    global $SysValue,$link_db;
    $sql = "select name from " . $SysValue['base']['table_name'] . " where id='$n'";
    $result = mysqli_query($link_db,$sql);
    $row = mysqli_fetch_array($result);
    $name = str_replace(array('"', "'"), " ", $row['name']);
    $ar = array($name, $row['id'], false);
    return $ar;
}

function Vivod_pot($categories) {// ����� ���������
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm, $category,$link_db;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to=0 order by num, name";
    $result = mysqli_query($link_db,$sql);
    $i = 0;
    $dis = null;
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $num = TestCat($id);
        if ($num > 0) {
            //$dis.=$name . Vivod_rekurs($id);
            $dis .= '<option value="' . $id . '" disabled>' . $name . '</option>';
            $dis .= Vivod_rekurs($id, '-', $categories);
        } else {
            //@$dis.=$name . Vivod_rekurs($id);
            $catego_ar = explode(',', $categories);
            foreach ($catego_ar as $val_c) {
                if ($val_c == $id)
                    $ssel = 'selected';
                else
                    $ssel = '';
            }
            $dis .= '<option value="' . $id . '" ' . $ssel . '>' . $name . '</option>';
            //$dis .= Vivod_rekurs($id, '-',$categories);
        }
        $i++;
    }

    return $dis;
}

function Vivod_cat_all_num($n) {// ����� ���-�� ������� �� ������� �����������
    global $SysValue,$link_db;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where category='$n' and enabled='1'";
    $result = mysqli_query($link_db,$sql);
    $num = mysqli_num_rows($result);
    return $num;
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm;

    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 1;
    if (empty($_POST['active_check_new']))
        $_POST['active_check_new'] = 0;
    if (empty($_POST['discount_check_new']))
        $_POST['discount_check_new'] = 0;
    if (empty($_POST['free_delivery_new']))
        $_POST['free_delivery_new'] = 0;
    if (empty($_POST['categories_check_new']))
        $_POST['categories_check_new'] = 0;
    if (empty($_POST['products_check_new']))
        $_POST['products_check_new'] = 0;
    if (empty($_POST['sum_order_check_new']))
        $_POST['sum_order_check_new'] = 0;
    if (empty($_POST['delivery_method_check_new']))
        $_POST['delivery_method_check_new'] = 0;
    if (empty($_POST['code_check_new']))
        $_POST['code_check_new'] = 0;
    if (empty($_POST['discount_tip_new']))
        $_POST['discount_tip_new'] = 0;
    if (empty($_POST['code_tip_new']))
        $_POST['code_tip_new'] = 0;

    if ($_POST['enabled_new'][0] == 0) {
        $_POST['enabled_new'] = 0;
    } else {
        $_POST['enabled_new'] = 1;
    }

    if (isset($_POST['categories'])) {
        foreach ($_POST['categories'] as $value) {
            $_POST['categories_new'] .= $value . ',';
        }
    } else {
        $_POST['categories_new'] = '';
    }


    if ($_POST['code_new'] != '*') {
        if ($_POST['code_new'] != ''):
            $indata = $PHPShopOrm->select(array('code'), array('code' => '="' . $_POST['code_new'] . '"'));
            if ($indata['code'] != ''):
                echo '<span style="color:red;">������. ��� <b>' . $_POST['code_new'] . '</b> ��� ��������� � ����</span>';
                exit();
            endif;
        endif;
    }


    $action = $PHPShopOrm->insert($_POST);
    header('Location: ?path=' . $_GET['path']);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopOrm;

    $data['name']='����� ������';
    
        // ����� ����
    $PHPShopGUI->addJSFiles('./js/bootstrap-datetimepicker.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-datetimepicker.min.css');
    
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('../modules/promotions/admpanel/gui/promotions.gui.js');

    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"), true);
    $oFCKeditor = new Editor('description_new', true);
    $oFCKeditor->Height = '120';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $data['description'];

    $descriptionCon = $oFCKeditor->AddGUI();

    $Tab1 = $PHPShopGUI->setCollapse('��������', $PHPShopGUI->setField('��������', $PHPShopGUI->setInputText('', 'name_new', $data['name'])) . $PHPShopGUI->setField('������', $PHPShopGUI->setRadio("enabled_new[]", 1, "����������", 'checked') . $PHPShopGUI->setRadio("enabled_new[]", 0, "������", '1')));

    $versphp = phpversion(); //5.3.0
    //$versphp = "4.1.1";
    $version_status = version_compare($versphp, "5.3.0");

    if ($version_status != '-1') {
        $Tab1.=$PHPShopGUI->setCollapse('����������', $PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox("active_check_new", 1, "��������� ����������", $data['active_check'])) . $PHPShopGUI->setField('������', $PHPShopGUI->setInputDate("active_date_ot_new", $data['active_date_ot'])) . $PHPShopGUI->setField('����������', $PHPShopGUI->setInputDate("active_date_do_new", $data['active_date_do'])));
    }


    $Tab1.=$PHPShopGUI->setCollapse('������', $PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox("discount_check_new", 1, "��������� ������", $data['discount_check'])) .
            $PHPShopGUI->setField('���', $PHPShopGUI->setRadio("discount_tip_new", 1, "%", $data['discount_tip']) . $PHPShopGUI->setRadio("discount_tip_new", 0, "�����", $data['discount_tip']), 'left') .
            $PHPShopGUI->setField('��������', $PHPShopGUI->setInputText('', 'discount_new', $data['discount'], '100')) .
            $PHPShopGUI->setField('��������', $PHPShopGUI->setCheckbox("free_delivery_new", 1, "���������� ��������", $data['free_delivery']))
    );

    // ������ ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment_systems']);
    $data_payment_systems = $PHPShopOrm->select(array('id,name'), false, array('order' => 'name'), array('limit' => 100));

    foreach ($data_payment_systems as $value) {
        if ($value['id'] == $data['delivery_method'])
            $sel = 'selected';
        else
            $sel = false;
        $value_payment_systems[] = array($value['name'], $value['id'], $sel);
    }


    //������ ��������� � ������������
    $categories_option = Vivod_pot($data['categories']);
    $categories_mul_sel .= '<select multiple size="10" id="categories"  class="form-control input-sm" name="categories[]">' . $categories_option . '</select>';

    $Tab1.=$PHPShopGUI->setCollapse('�������', $PHPShopGUI->setField('���������', $PHPShopGUI->setCheckbox("categories_check_new", 1, "��������� ��������� ������", $data['categories_check']) . $PHPShopGUI->setCheckbox("selectalloption", 1, "������� ��� ���������?", '', "right") . $categories_mul_sel) .
            $PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox("products_check_new", 1, "��������� ������", $data['products_check']) .
                    $PHPShopGUI->setTextarea('products_new', $data['products']) . $PHPShopGUI->setHelp('ID ������� � ������� 1,2,3 ��� ��������'))
            .
            $PHPShopGUI->setField('�����', $PHPShopGUI->setCheckbox("sum_order_check_new", 1, "��������� ����� ������", $data['sum_order_check']) .
                    $PHPShopGUI->setInputText(false, 'sum_order_new', $data['sum_order'], '200', $PHPShopSystem->getDefaultValutaCode()) .
                    $PHPShopGUI->setCheckbox("delivery_method_check_new", 1, "��������� ������ ������", $data['delivery_method_check']) . '<br>' .
                    $PHPShopGUI->setSelect('delivery_method_new', $value_payment_systems, 300)
    ));

    $Tab1.=$PHPShopGUI->setCollapse('�����', $PHPShopGUI->setField('������', $PHPShopGUI->setCheckbox("code_check_new", 1, "��������� ��� ������", $data['code_check'])) .
            $PHPShopGUI->setField('���', $PHPShopGUI->setInputText('', 'code_new', $data['code'], '170', false, 'left') . '&nbsp;' .
                    $PHPShopGUI->setInput('button', 'gen', '�������������', $float = "none", 120, $onclick = "randAa(10);", 'btn-sm btn-success')) .
            $PHPShopGUI->setField('�������������', $PHPShopGUI->setRadio("code_tip_new", 1, "����������", $data['code_tip']) .
                    $PHPShopGUI->setRadio("code_tip_new", 0, "�����������", $data['code_tip']), 'left')
    );



    $Tab2 = $descriptionCon;

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("��������", $Tab2));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "���������", "right", false, false, false, "actionInsert.modules.create");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>