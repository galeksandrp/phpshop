<?php

// ���������
$TitlePage = __("������� �������");

// ���������� JS ����������
$addJS = true;

function actionStart() {
    $PHPShopIframePanel = new PHPShopIframePanel(array('page/tree.php', 300, '85%', 'frame1'), array('page/admin_page_content.php', '100%', '100%', 'frame2'));
    $PHPShopIframePanel->title = __('��������');

    $PHPShopIcon = new PHPShopIcon($start = 100);
    $PHPShopIcon->padding=0;
    $PHPShopIcon->margin=0;

    // ����� ������
    $Search = $PHPShopIcon->setForm(
            $PHPShopIcon->setInputText(__('�����: '), 'words', '', $size = 180, false, "left",false, $GLOBALS['SysValue']['Lang']['Help']['4']) .
            $PHPShopIcon->setInput("button", "search_but", "������", "right", 70,'PHPShopJS.page.search(search.words.value)','but small'), $action = false, $name = "search", 'get');

    $Tab1 = $PHPShopIcon->add($Search,300);
    
    $Tab1.= $PHPShopIcon->setBorder() .
            $PHPShopIcon->setIcon("icon/folder_add.gif", __('����� �������'), "PHPShopJS.page.addcat()") .
            $PHPShopIcon->setIcon("icon/folder_edit.gif", __('������������� �������'), "PHPShopJS.page.edit()") .
            $PHPShopIcon->setBorder() .
            $PHPShopIcon->setIcon("icon/page_new.gif", __('����� ��������'), "PHPShopJS.page.addpage()") .
            $PHPShopIcon->setIcon("icon/layout_content.gif", __('����� ���� �������'), "PHPShopJS.page.all()").
            $PHPShopIcon->setBorder();

    // ���������� ���������
    $selact_value[]=array(__('� �����������'),0,'selected');
    $selact_value[]=array(__('�������� �����'),30,false);
    $selact_value[]=array(__('��������� �����'),31,false);
    $selact_value[]=array(__('�������� �����������'),31,false);
    $selact_value[]=array(__('��������� �����������'),33,false);
    $selact_value[]=array(__('��������� � �������'),34,false);
    $selact_value[]=array(__('�������� ��������������� ������'),35,false);
    $selact_value[]=array(__('������� �� ����'),39,false);
    $Select=$PHPShopIcon->setSelect('action', $selact_value, 200, 'none', false, $onchange = 'PHPShopJS.page.action(this.value)', $height = false, $size = 1, $multiple = false, $id = 'actionSelect');

    $Tab1.=$PHPShopIcon->add($Select,100);
    
    $Tab1.=$PHPShopIcon->setIcon("icon/chart_organisation_add.gif", __('�������� ���'), "PHPShopJS.selectall(1)") .
           $PHPShopIcon->setBorder().
           $PHPShopIcon->setIcon("icon/chart_organisation_delete.gif", __('����� �������'), "PHPShopJS.selectall(2)");
    
    $PHPShopIcon->setTab($Tab1);
    $PHPShopIframePanel->addTop($PHPShopIcon->Compile(true));
    $PHPShopIframePanel->Compile();
}

?>