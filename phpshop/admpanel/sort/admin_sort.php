<?php

PHPShopObj::loadClass('sort');

$TitlePage = __("��������������");

$PHPShopSortCategoryArray = new PHPShopSortCategoryArray(array('category' => '=0'));
$SortCategoryArray = $PHPShopSortCategoryArray->getArray();

/**
 * ����� �������
 */
function actionStart() {
    global $PHPShopInterface, $TitlePage, $SortCategoryArray, $help;

    $PHPShopInterface->action_button['�������� ��������������'] = array(
        'name' => '',
        'action' => 'addNew',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="�������� ��������������" data-cat="' . $_GET['cat'] . '"'
    );

    $PHPShopInterface->action_select['�������� ������'] = array(
        'name' => '�������� ������',
        'action' => 'enabled',
        'url' => '?path=' . $_GET['path'] . '&action=new&type=sub'
    );

    $PHPShopInterface->action_select['�������� ���'] = array(
        'name' => '�������� ��� �������',
        'action' => 'ResetCache'
    );

    if (isset($_GET['cat']))
        $PHPShopInterface->action_select['������������� ������'] = array(
            'name' => '������������� ������',
            'action' => 'enabled',
            'url' => '?path=' . $_GET['path'] . '&type=sub&id=' . intval($_GET['cat'])
        );

    if (!empty($_GET['cat']))
        $TitlePage.=': ' . $SortCategoryArray[$_GET['cat']]['name'];

    $PHPShopInterface->setActionPanel($TitlePage, array('������������� ������', '�������� ������', '�������� ���', '|', '������� ���������'), array('�������� ��������������'));
    $PHPShopInterface->setCaption(array(null, "1%"), array("��������", "50%"), array("", "10%"), array("�����" . "", "10%", array('align' => 'center')), array("�����" . "", "10%", array('align' => 'center')), array("������" . "", "10%", array('align' => 'center')));

    $where = array('category' => '!=0');
    if (!empty($_GET['cat'])) {
        $where = array('category' => '=' . intval($_GET['cat']));
    }

    $PHPShopInterface->addJSFiles('./js/jquery.treegrid.js', './sort/gui/sort.gui.js');

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
    //$PHPShopOrm->Option['where'] = ' or ';
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {

            // ������
            if (!empty($row['filtr']))
                $filtr = '<span class="glyphicon glyphicon-ok"><span class="hide">1</span></span>';
            else
                $filtr = '<span class="hide">0</span>';

            // �����
            if (!empty($row['goodoption']))
                $goodoption = '<span class="glyphicon glyphicon-ok"><span class="hide">1</span></span>';
            else
                $goodoption = '<span class="hide">0</span>';

            // �����
            if (!empty($row['brand']))
                $brand = '<span class="glyphicon glyphicon-ok"><span class="hide">1</span></span>';
            else
                $brand = '<span class="hide">0</span>';

            // ��������
            if (!empty($row['description']))
                $help='<div class="text-muted">'.$row['description'].'</div>';
            else $help=null;

            $PHPShopInterface->path = 'sort';
            $PHPShopInterface->setRow($row['id'], array('name' => $row['name'], 'link' => '?path=sort&id=' . $row['id'], 'align' => 'left','addon' => $help), array('action' => array('edit', 'copy', '|', 'delete', 'id' => $row['id']), 'align' => 'center'), array('name' => $brand, 'align' => 'center'), array('name' => $goodoption, 'align' => 'center'), array('name' => $filtr, 'align' => 'center')
            );
        }

    $sidebarleft[] = array('title' => '������', 'content' => $PHPShopInterface->loadLib('tab_menu_sort', false, './sort/'), 'title-icon' => '<span class="glyphicon glyphicon-plus newsub" data-toggle="tooltip" data-placement="top" title="' . __('�������� ������') . '"></span>');
    $sidebarleft[] = array('title' => '���������', 'content' => $help, 'class' => 'hidden-xs');
    $PHPShopInterface->setSidebarLeft($sidebarleft, 3);

    $PHPShopInterface->Compile(3);
}

?>