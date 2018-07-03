<?php

PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");

$TitlePage = __('�������������� ������ #' . $_GET['id']);
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);

// ���������� ������ ���������
function treegenerator($array, $i, $curent) {
    global $tree_array;
    $del = '�&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree_select = $check = false;

    $del = str_repeat($del, $i);
    if (is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator($tree_array[$k], $i + 1, $curent);

            if ($k == $curent)
                $selected = 'selected';
            else
                $selected = null;

            if (empty($check['select'])) {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                $i = 1;
            } else {
                $tree_select.='<option value="' . $k . '" ' . $selected . ' disabled>' . $del . $v . '</option>';
                //$i++;
            }

            $tree_select.=$check['select'];
        }
    }
    return array('select' => $tree_select);
}

function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['return']);
    }

    // ��� ������
    if (strlen($data['name']) > 60)
        $title_name = substr($data['name'], 0, 60) . '...';
    else
        $title_name = $data['name'];

    $PHPShopGUI->action_select['������������'] = array(
        'name' => '������������',
        'url' => '../../shop/UID_' . $data['id'] . '.html',
        'action' => 'front',
        'target' => '_blank'
    );

    $PHPShopGUI->setActionPanel(__("�����") . ": " . $title_name . ' [ID ' . $data['id'] . ']', array('������� �����', '������������', '|', '�������'), array('���������', '��������� � �������'));

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.tagsinput.min.js', './catalog/gui/catalog.gui.js', './js/jquery.waypoints.min.js', './product/gui/product.gui.js');
    $PHPShopGUI->addCSSFiles('./css/jquery.tagsinput.css');

    $PHPShopCategoryArray = new PHPShopCategoryArray();
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $CategoryArray[0]['name'] = '- �������� ������� -';

    $tree_array = array();



    foreach ($PHPShopCategoryArray->getKey('parent_to.id', true) as $k => $v) {
        foreach ($v as $cat) {
            $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
        }
        $tree_array[$k]['name'] = $CategoryArray[$k]['name'];
        $tree_array[$k]['id'] = $k;
    }

    $tree_array[0]['sub'][1000000] = '�������������� ������';
    $tree_array[1000000]['name'] = '�������������� ������';
    $tree_array[1000000]['id'] = 1000000;
    $tree_array[1000000]['sub'][1000001] = '����������� 1C';
    $tree_array[1000000]['sub'][1000002] = '����������� CSV';
    $tree_array[1000002]['id'] = 0;


    $GLOBALS['tree_array'] = &$tree_array;

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-live-search="true" data-container=""  data-style="btn btn-default btn-sm" name="category_new"  data-width="100%">';

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

            $tree_select.='<option value="' . $k . '" ' . $selected . $disabled . '>' . $v . '</option>';

            $tree_select.=$check['select'];
        }
    $tree_select.='</select>';

    // ����� ��������
    $Tab_info = $PHPShopGUI->setField(__("����������:"), $tree_select, 1, '����� � �������� ID ' . $data['category'] . '. �������� ' . PHPShopDate::get($data['datas'], true));

    // ������������
    $Tab_info.=$PHPShopGUI->setField("��������:", $PHPShopGUI->setInputText(null, 'name_new', $data['name']));

    // �������
    $Tab_info.=$PHPShopGUI->setField('�������:', $PHPShopGUI->setInputText(null, 'uid_new', $data['uid'], 250));

    // ������
    $Tab_info.=$PHPShopGUI->setField(__("�����������"), $PHPShopGUI->setIcon($data['pic_big'], "pic_big_new", false, array('load' => false, 'server' => true, 'url' => false)), 1, '������� ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������� ���� �������� �����.');
    $Tab_info.=$PHPShopGUI->setField(__("������"), $PHPShopGUI->setFile($data['pic_small'], "pic_small_new", array('load' => false, 'server' => 'image', 'url' => false)), 1, '������ ����������� ������ ��������� ������������� ��� �������� ����� �������� �����������. �� �� ������ ��������� ������ �������� �����.');

    // �����
    if (empty($data['ed_izm']))
        $ed_izm = '��.';
    else
        $ed_izm = $data['ed_izm'];

    $Tab_info.=$PHPShopGUI->setField('�����:', $PHPShopGUI->setInputText(false, 'items_new', $data['items'], 100, $ed_izm), 'left');

    // ���
    $Tab_info.=$PHPShopGUI->setField('���:', $PHPShopGUI->setInputText(false, 'weight_new', $data['weight'], 100, '��.'), 'left');

    // ������� ���������
    if (empty($data['ed_izm']))
        $data['ed_izm'] = '��.';
    $Tab_info.=$PHPShopGUI->setField('������� ���������:', $PHPShopGUI->setInputText(false, 'ed_izm_new', $data['ed_izm'], 100));

    // ������������� ������
    $Tab_info.=$PHPShopGUI->setField('������������� ������ ��� ���������� �������:', $PHPShopGUI->setTextarea('odnotip_new', $data['odnotip'], false, false, false, __('������� ID ������� ��� �������������� <a href="#" data-target="#odnotip_new"  class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ������� �������</a>')));

    // �������������� ��������
    $Tab_info.=$PHPShopGUI->setField('�������������� ��������:', $PHPShopGUI->setTextarea('dop_cat_new', $data['dop_cat'], false, false, false, __('������� ID ��������')), 1, '������ ������������ ��������� � ���������� ���������.');

    // ����� ������
    $Tab_info.=$PHPShopGUI->setField('����� ������:', $PHPShopGUI->setCheckbox('enabled_new', 1, '����� � ��������', $data['enabled']) .
            $PHPShopGUI->setCheckbox('spec_new', 1, '���������������', $data['spec']) . $PHPShopGUI->setCheckbox('newtip_new', 1, '�������', $data['newtip']));
    $Tab_info.=$PHPShopGUI->setField('����������:', $PHPShopGUI->setInputText('�', 'num_new', $data['num'], 150));

    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), $Tab_info);


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
            $valuta_area.=$PHPShopGUI->setRadio('baseinputvaluta_new', $val['id'], $val['name'], $check);
        }

    // ����
    $Tab_price.=$PHPShopGUI->setField('���� 1:', $PHPShopGUI->setInputText(null, 'price_new', $data['price'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField('���� 2:', $PHPShopGUI->setInputText(null, 'price2_new', $data['price2'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField('���� 3:', $PHPShopGUI->setInputText(null, 'price3_new', $data['price3'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField('���� 4:', $PHPShopGUI->setInputText(null, 'price4_new', $data['price4'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField('���� 5:', $PHPShopGUI->setInputText(null, 'price5_new', $data['price5'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField(__('������ ����'), $PHPShopGUI->setInputText(null, 'price_n_new', $data['price_n'], 150, $valuta_def_name));
    $Tab_price.=$PHPShopGUI->setField('��� �����:', $PHPShopGUI->setCheckbox('sklad_new', 1, '��� �����', $data['sklad']));

    // ������
    $Tab_price.=$PHPShopGUI->setField(__('������:'), $valuta_area);

    $Tab1.=$PHPShopGUI->setCollapse(__('����'), $Tab_price);


    // YML
    $data['yml_bid_array'] = unserialize($data['yml_bid_array']);
    $Tab_yml = $PHPShopGUI->setField(__('YML'), $PHPShopGUI->setCheckbox('yml_new', 1, __('����� � ������ �������'), $data['yml']) .
            $PHPShopGUI->setRadio('p_enabled_new', 1, __('� �������'), $data['p_enabled']) .
            $PHPShopGUI->setRadio('p_enabled_new', 0, __('��������� (��� �����)'), $data['p_enabled'])
    );

    // BID
    $Tab_yml.=$PHPShopGUI->setField(__('������ BID'), $PHPShopGUI->setInputText(null, 'yml_bid_array[bid]', $data['yml_bid_array']['bid'], 100));
    $Tab_yml.=$PHPShopGUI->setField(__('������ CBID'), $PHPShopGUI->setInputText(null, 'yml_bid_array[cbid]', $data['yml_bid_array']['cbid'], 100));
    $Tab1.=$PHPShopGUI->setCollapse(__('������ ������'), $Tab_yml, false);

    // �������
    $Tab_option = $PHPShopGUI->setField(__('�����'), $PHPShopGUI->setRadio('parent_enabled_new', 0, __('������� �����'), $data['parent_enabled']) .
            $PHPShopGUI->setRadio('parent_enabled_new', 1, __('���������� ����� ��� �������� ������'), $data['parent_enabled']));

    $Tab_option.=$PHPShopGUI->setField(__('ID ��������'), $PHPShopGUI->setTextarea('parent_new', $data['parent'], "none", false, false, __('������� ID ������� ��� �������������� <a href="#"  data-target="#parent_new" class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ������� �������</a>')));

    // �������
    $Tab1.=$PHPShopGUI->setCollapse(__('�����'), $Tab_option, false);

    // �������� �������� ��������
    $Tab2 = $PHPShopGUI->loadLib('tab_description', $data);

    // �������� ���������� ��������
    $Tab3 = $PHPShopGUI->loadLib('tab_content', $data);

    // ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
    $data_page = $PHPShopOrm->select(array('*'), false, array('order' => 'name'), array('limit' => 100));

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
    $Tab_docs = $PHPShopGUI->setCollapse(__('������'), $PHPShopGUI->setSelect('page_new[]', $value, '50%', false, false, false, '90%', 30, true));

    // �����
    $Tab_docs.= $PHPShopGUI->setCollapse(__('�����'), $PHPShopGUI->loadLib('tab_files', $data));


    // �����������
    $Tab6 = $PHPShopGUI->loadLib('tab_img', $data);

    // ��������������
    $Tab_sorts = $PHPShopGUI->loadLib('tab_sorts', $data);

    // ���������
    $Tab_header = $PHPShopGUI->loadLib('tab_headers', $data);

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1), array(__("�����������"), $Tab6), array(__("��������"), $Tab2), array(__("��������"), $Tab3), array(__("���������"), $Tab_docs), array(__("��������������"), $Tab_sorts), array(__("���������"), $Tab_header));



    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
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

    // ���������� �� ������
    if (isset($_POST['items_new'])) {
        switch ($PHPShopSystem->getSerilizeParam('admoption.sklad_status')) {

            case(3):
                if ($_POST['items_new'] < 1) {
                    $_POST['sklad_new'] = 1;
                    //$_POST['enabled_new'] = 1;
                } else {
                    $_POST['sklad_new'] = 0;
                    //$_POST['enabled_new'] = 1;
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

        // ���������� �������������
        if (is_array($_POST['vendor_array_add'])) {
            foreach ($_POST['vendor_array_add'] as $k => $val) {

                if (!empty($val)) {
                    $PHPShopOrmSort = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                    $result = $PHPShopOrmSort->insert(array('name_new' => $val, 'category_new' => $k));
                    if (!empty($result))
                        $_POST['vendor_array_new'][$k][] = $result;
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
                        $_POST['vendor_new'].="i" . $k . "-" . $p . "i";
                        if (empty($p))
                            unset($_POST['vendor_array_new'][$k][$key]);
                    }
                }
                else
                    $_POST['vendor_new'].="i" . $k . "-" . $v . "i";
            }

        $_POST['vendor_array_new'] = serialize($_POST['vendor_array_new']);

        // ������
        if (isset($_POST['editID']))
            $_POST['page_new'] = array_pop($_POST['page_new']);
        elseif (@strpos($_POST['page_new'], ''))
            $_POST['page_new'] = implode(',', $_POST['page_new']);

        // �����
        if (isset($_POST['editID'])) {
            if (is_array($_POST['files_new'])) {
                foreach ($_POST['files_new'] as $k => $files)
                    $files_new[$k] = @array_map("urldecode", $files);

                $_POST['files_new'] = serialize($files_new);
            }
        }
        else
            $_POST['files_new'] = serialize($_POST['files_new']);

        // ��� ��������
        if (!empty($_POST['dop_cat_new']) and substr($_POST['dop_cat_new'], 1) != '#') {
            $_POST['dop_cat_new'] = '#' . $_POST['dop_cat_new'] . '#';
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


    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    $PHPShopOrm->clean();



    return array('success' => $action);
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

    // ����
    $RName = substr(abs(crc32(time())), 0, 5);

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
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


        $thumb->save($_SERVER['DOCUMENT_ROOT'] . $path . $name_s);

        // ������� �����������
        $thumb = new PHPThumb($file);
        $thumb->setOptions(array('jpegQuality' => $width_podrobno));

        // ������������
        if (!empty($img_adaptive))
            $thumb->adaptiveResize($img_w, $img_h);
        else
            $thumb->resize($img_w, $img_h);



        $watermark = $PHPShopSystem->getSerilizeParam('admoption.watermark_image');
        $watermark_text = $PHPShopSystem->getSerilizeParam('admoption.watermark_text');

        // ���������
        if ($PHPShopSystem->ifSerilizeParam('admoption.watermark_big_enabled')) {

            // Image
            if (!empty($watermark) and file_exists($_SERVER['DOCUMENT_ROOT'] . $watermark))
                $thumb->createWatermark($_SERVER['DOCUMENT_ROOT'] . $watermark, $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'));
            // Text
            elseif (!empty($watermark_text))
                $thumb->createWatermarkText($watermark_text, $PHPShopSystem->getSerilizeParam('admoption.watermark_text_size'), $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['SysValue']['dir']['dir'] . '/phpshop/lib/font/' . $PHPShopSystem->getSerilizeParam('admoption.watermark_text_font') . '.ttf', $PHPShopSystem->getSerilizeParam('admoption.watermark_right'), $PHPShopSystem->getSerilizeParam('admoption.watermark_bottom'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_color'), $PHPShopSystem->getSerilizeParam('admoption.watermark_text_alpha'), 0);
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
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['rowID'])));

    // �������� �����������
    if ($action)
        fotoDelete();

    return array("success" => $action);
}

/**
 * ������������ ����
 */
function actionFileEdit() {
    global $PHPShopGUI, $PHPShopModules;


    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->_CODE.= $PHPShopGUI->setField('��������', $PHPShopGUI->setInputArg(array('name' => 'modal_file_name', 'type' => 'text.required', 'value' => urldecode($_GET['name']))));
    $PHPShopGUI->_CODE.= $PHPShopGUI->setField('����', $PHPShopGUI->setFile($_GET['file'], 'lfile', array('server' => true)));
    $PHPShopGUI->_CODE.=$PHPShopGUI->setInputArg(array('name' => 'selectID', 'type' => 'hidden', 'class' => 'data-id', 'value' => $_POST['selectID']));
    $PHPShopGUI->_CODE.=$PHPShopGUI->setInputArg(array('name' => 'fileCount', 'type' => 'hidden', 'class' => 'data-count', 'value' => $_POST['fileCount']));


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