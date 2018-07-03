<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.multilanguages.multilanguages"));

// ������� ����������
function actionUpdate() {
    $action = true;
    header('Location: ?path=modules&install=check');
    return $action;
}


// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();

    $Info = '������ �������������� ������ ��������� ��������� ����� ���������� ������ �������� �������� �����, ���������� � ��������� <kbd>windows-1251</kbd> (����������, ����������, �����������, ���������� � �.�.). ������ ��������� � �������� ���������� ������� ����� ���� ��� ���������� ���������� �� ������� ������ �����.
     
<h4>����������</h4>
<ol>
<li>������� ����� ���� � ���������� ���������� ��������������� �������, ������� ��� ����������� �����, �������� ��� �����������, <kbd>en</kbd>
<li>������� ����� ���� ������������ �������� ���� �� ����������� � <code>/phpshop/modules/multilanguages/inc/lang_en.ini</code>, (��� ������� <code>en</code> ������ ���� ���������� � ������������� ���� �����������, ���������� �� ���������� ����). ��� �������� ������ ������������� ����� ������������ �������� ������  <code>/phpshop/modules/multilanguages/inc/lang.ini</code>
<li>� �������� �������������� ����� ��������� ������ �������� ��������� �����������  ���������.
<li>�������� ���������� ������ ���� ������ ������ <code>@lang_panel_menu_top@</code> � ������� ������ �������� � ������ <code>/main/index.tpl</code> � <code>/main/shop.tpl</code>. ��� ����������� ������ ����� ������������� ������ � ���� ������ (index.tpl � shop.tpl).
<li>�������� ���������� ������ ���� ��������� <code>@leftCatal@</code> �� <code>@leftCatalMulti@</code>.
<li>�������� ���������� ������ ��������������� ���� ������� <code>@topMenu@</code> �� <code>@topMenuMulti@</code> .
<li>�������� ���������� ������ ���� �������� ��������� ������� <code>@pageCatal@</code> �� <code>@pageCatalMult@</code>.
<li>�������� ���������� ������ ��������� �������� �� ������� �������� <code>@miniNews@</code> �� <code>@miniNewsMulti@</code> � ����� <code>/main/index.tpl</code>.
<li>�������� ������� ���������� �� ������ ���� � ��������� �������������� �������, ���������, �������������, ��������� ������, ������ � ����� ����� ����� �������� <kbd>�����</kbd>. 
</ol>';
    
    $Tab1 = $PHPShopGUI->setInfo($Info);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1),array("� ������", $PHPShopGUI->setPay()), array("�����", null,'?path=modules.dir.multilanguages'));

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
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');

?>