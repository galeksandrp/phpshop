<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.hit.hit_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $PHPShopOrm->update(array('version_new' => $new_version));
}

// ������� ����������
function actionUpdate() {
    global $PHPShopModules;

    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.hit.hit_system"));
    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);

    header('Location: ?path=modules&id=' . $_GET['id']);

    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $Tab1 = $PHPShopGUI->setField('���������� ����� �� ������� ��������:', '<input class="form-control input-sm" type="number" step="1" min="0" value="' . $data['hit_main'] . '" name="hit_main_new" style="width:300px; ">');
    $Tab1 .= $PHPShopGUI->setField('���������� ����� � ��� �� �������� �����:', '<input class="form-control input-sm" type="number" step="1" min="0" value="' . $data['hit_page'] . '" name="hit_page_new" style="width:300px; ">');

    $info = '<h4>��������� ������</h4>
       <ol>
        <li>�������� ������, � �������� ������ �������� "���", �� ��������������� �������.</li>
        <li>��� ������ �� ������� ��������, �������� � ��� <code>phpshop/���_�������/main/index.tpl</code> ���������� <kbd>@hitMain@</kbd>, ��� ������� �����, ��� ��������� �������, ������������ ���������� <kbd>@hitMainHidden@</kbd>.</li>
        <li>��� ������ ����� � ��������, �������� � ���� <code>phpshop/���_�������/product/product_catalog_content.tpl</code> ���������� <kbd>@hit@</kbd>.</li>
        </ol>';

    $Tab2 = $PHPShopGUI->setInfo($info);

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial = false, false, $data['version'], true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $Tab2), array("� ������", $Tab3));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>