<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_job"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    if (!empty($_POST['last_execute_new']))
        $_POST['used_new'] = 0;

    // ����������
    if (is_array($_POST['servers'])) {
        $_POST['servers_new'] = "";
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['servers_new'].="i" . $v . "i";
    }


    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));


    $work[] = array('�������', '');
    $work[] = array('����� ��', 'phpshop/modules/cron/sample/dump.php');
    $work[] = array('����� �����', 'phpshop/modules/cron/sample/currency.php');
    $work[] = array('������ � ������ �������', 'phpshop/modules/cron/sample/product.php');
    $work[] = array('������������ �����', 'phpshop/modules/cron/sample/pricesearch.php');

    // ���� ������ SiteMap
    if (!empty($GLOBALS['SysValue']['base']['sitemap']['sitemap_system'])) {
        $work[] = array('����� �����', 'phpshop/modules/sitemap/cron/sitemap_generator.php');
        $work[] = array('����� ����� SSL', 'phpshop/modules/sitemap/cron/sitemap_generator.php?ssl');
    }

    $Tab1 = $PHPShopGUI->setField("�������� ������:", $PHPShopGUI->setInput("text.requared", "name_new", $data['name']));
    $Tab1.=$PHPShopGUI->setField("����������� ����:", $PHPShopGUI->setInputArg(array('type' => "text.requared", 'name' => "path_new", 'size' => '60%', 'float' => 'left', 'placeholder' => 'phpshop/modules/cron/sample/testcron.php', 'value' => $data['path'])) . '&nbsp;' . $PHPShopGUI->setSelect('work', $work, 200, true, false, false, false, false, false, false, 'selectpicker', '$(\'input[name=path_new]\').val(this.value);'));
    $Tab1.=$PHPShopGUI->setField("������", $PHPShopGUI->setCheckbox("enabled_new", 1, "��������", 1));
    $Tab1.=$PHPShopGUI->setField("���-�� �������� � ����", $PHPShopGUI->setSelect('execute_day_num_new', $PHPShopGUI->setSelectValue($data['execute_day_num']), 70));
    $Tab1.=$PHPShopGUI->setField("�������", $PHPShopGUI->loadLib('tab_multibase', $data, 'catalog/'));


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.modules.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.modules.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart');
?>