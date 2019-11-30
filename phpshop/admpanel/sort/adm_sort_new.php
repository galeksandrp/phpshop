<?php

PHPShopObj::loadClass('sort');

if (!empty($_GET['type']))
    $TitlePage = __('�������� ������ ��������������');
else
    $TitlePage = __('�������� ��������������');

$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules, $TitlePage, $PHPShopBase;

    // �������
    $newId = getLastID();

    if (empty($_GET['id'])) {
        $data['id'] = $newId;
    } else {
        // �������� ����� 
        $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));
        $data['id'] = $newId;

        // ����������� �������������
        if ($PHPShopBase->Rule->CheckedRules('sort', 'create'))
            valueCopy($_GET['id'], $newId);
    }

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./sort/gui/sort.gui.js');
    $PHPShopGUI->setActionPanel($TitlePage, false, array('������� � �������������', '��������� � �������'));

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
            $category_value[] = array($v['name'], $v['id'], $_GET['cat']);

    // ������ ���������
    if (empty($_GET['type'])) {
        $Tab3 = $PHPShopGUI->setField("������", $PHPShopGUI->setSelect('category_new', $category_value, '100%', false, false, true), 1, '������ ������������� ������ ��� ���������� ���������� ������������� � ��������� ����������.') . $PHPShopGUI->setField("�����:", $PHPShopGUI->setCheckbox('brand_new', 1, '���.', $data['brand']), 1, '�������������� ���������� ������� � ������������ � ������ �������') . 
                $PHPShopGUI->setField("������������", $PHPShopGUI->setCheckbox('product_new', 1, '���.', $data['product']), 1, '������ �������� ���-�� �������� ������������� ������ ��� ���������� �������, ��������� � �������� ������') .
                $PHPShopGUI->setField("�����:", $PHPShopGUI->setCheckbox('filtr_new', 1, '������', $data['filtr']) . $PHPShopGUI->setCheckbox('goodoption_new', 1, '�������� �����', $data['goodoption']) . $PHPShopGUI->setCheckbox('optionname_new', 1, '�� ����������� ��� ���������� � �������', $data['optionname']).
                $PHPShopGUI->setCheckbox('virtual_new', 1, '����������� �������', $data['virtual'])) . 
                $PHPShopGUI->setField("��������:", $PHPShopGUI->setSelect('page_new', $page_value, '100%', false, false, true), 1, '��� �������������� (� ������� ������������� � ��������� �������� ������) ���������� ������� �� ��������� �������� � ���������.');
    }

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse('����������', $PHPShopGUI->setField("������������", $PHPShopGUI->setInputArg(array('type' => 'text.requared', 'name' => 'name_new', 'value' => $data['name']))) .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setInputArg(array('type' => 'text', 'name' => 'num_new', 'value' => $data['num'], 'size' => 100))) .
            $Tab3 .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setTextarea('description_new', $data['description']))
    );

    // ��������
    if (empty($_GET['type']))
        $Tab1.=$PHPShopGUI->setCollapse('��������', $PHPShopGUI->setField("��������", $PHPShopGUI->loadLib('tab_value', $data)));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.sort.create") . $PHPShopGUI->setInput("hidden", "rowID", $data['id']);

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ID ����� ������ � �������
 * @return integer 
 */
function getLastID() {
    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->sql = 'SHOW TABLE STATUS LIKE "' . $GLOBALS['SysValue']['base']['sort_categories'] . '"';
    $data = $PHPShopOrm->select();
    if (is_array($data)) {
        return $data[0]['Auto_increment'];
    }
}

/**
 * ����������� ������� ������
 */
function valueCopy($j, $n) {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
    $data = $PHPShopOrm->select(array('*'), array('category' => "=" . intval($j)), array('order' => 'num,name DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            $insert['category_new'] = $n;
            $insert['name_new'] = $row['name'];
            $insert['num_new'] = $row['num'];
            $insert['icon_new'] = $row['icon'];
            $insert['page_new'] = $row['page'];
            $insert['sort_seo_name_new'] = $row['sort_seo_name'];

            $PHPShopOrm->clean();
            $PHPShopOrm->insert($insert);
        }
}

/**
 * ����� ������
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopOrm;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $_POST['category_new'] = intval($_POST['category_new']);

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->insert($_POST, '_new');

    if ($_POST['saveID'] == '������� � �������������') {
        if (empty($_POST['category_new']))
            header('Location: ?path=' . $_GET['path'] . '&id=' . $_POST['rowID'] . '&type=sub');
        else
            header('Location: ?path=' . $_GET['path'] . '&id=' . $_POST['rowID']);
    }
    else
        header('Location: ?path=' . $_GET['path'] . '&cat=' . $_POST['category_new']);
    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>