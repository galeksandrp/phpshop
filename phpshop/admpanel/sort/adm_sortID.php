<?php

PHPShopObj::loadClass('sort');

$TitlePage = __('�������������� ��������������') . ' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    if (!empty($_GET['type']))
        $TitlePage = __("������ �������������");
    else
        $TitlePage = __("��������������");

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./sort/gui/sort.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage . ': ' . $data['name']. ' [ID ' . $data['id'] . ']', array('�������', '������� �����', '|', '�������',), array('���������', '��������� � �������'));

    // ��������
    $page_value[] = array('- ' . __('��� ��������') . ' - ', null, $data['page']);
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
    $data_page = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1000));
    if (is_array($data_page))
        foreach ($data_page as $v)
            $page_value[] = array($v['name'], $v['link'], $data['page']);

    // ���������
    $PHPShopSort = new PHPShopSortCategoryArray(array('category' => '=0'));
    $PHPShopSortArray = $PHPShopSort->getArray();
    if (is_array($PHPShopSortArray))
        foreach ($PHPShopSortArray as $v)
            $category_value[] = array($v['name'], $v['id'], $data['category']);

    // ������ ��������� / optionname
    if (empty($_GET['type'])) {
        $Tab3 = $PHPShopGUI->setField("������:", $PHPShopGUI->setSelect('category_new', $category_value, '100%', false, false, true), 1, '������ ������������� ������ ��� ���������� ���������� ������������� � ��������� ����������.') .
                $PHPShopGUI->setField("�����:", $PHPShopGUI->setCheckbox('brand_new', 1, '���.', $data['brand']), 1, '�������������� ���������� ������� � ������������ � ������ �������') .
                $PHPShopGUI->setField("������������", $PHPShopGUI->setCheckbox('product_new', 1, '���.', $data['product']), 1, '������ �������� ���-�� �������� ������������� ������ ��� ���������� �������, ��������� � �������� ������') .
                $PHPShopGUI->setField("�����", $PHPShopGUI->setCheckbox('filtr_new', 1, '������', $data['filtr']) . $PHPShopGUI->setCheckbox('goodoption_new', 1, '�������� �����', $data['goodoption']) . $PHPShopGUI->setCheckbox('optionname_new', 1, '�� ����������� ��� ���������� � �������', $data['optionname']) .
                        $PHPShopGUI->setCheckbox('virtual_new', 1, '����������� �������', $data['virtual'])) .
                $PHPShopGUI->setField("��������", $PHPShopGUI->setSelect('page_new', $page_value, '100%', false, false, true), 1, '��� �������������� (� ������� ������������� � ��������� �������� ������) ���������� ������� �� ��������� �������� � ���������.');
    }

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse('����������', $PHPShopGUI->setField("������������", $PHPShopGUI->setInputArg(array('type' => 'text', 'name' => 'name_new', 'value' => $data['name']))) .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setInputArg(array('type' => 'text', 'name' => 'num_new', 'value' => $data['num'], 'size' => 100))) .
            $Tab3 .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setTextarea('description_new', $data['description'])) .
            $PHPShopGUI->setField("�������", $PHPShopGUI->loadLib('tab_multibase', $data, 'catalog/'))
    );

    // ��������
    if (empty($_GET['type']))
        $Tab1.=$PHPShopGUI->setCollapse('��������', $PHPShopGUI->setField("��������", $PHPShopGUI->loadLib('tab_value', $data)));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.sort.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.sort.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.sort.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);


    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();


    header('Location: ?path=' . $_GET['path'] . '&cat=' . $_POST['category_new']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    $_POST['category_new'] = intval($_POST['category_new']);

    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('brand_new', 'filtr_new', 'goodoption_new', 'optionname_new', 'product_new', 'virtual_new');

    // ����������
    if (is_array($_POST['servers'])) {
        $_POST['servers_new'] = "";
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['servers_new'].="i" . $v . "i";
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>