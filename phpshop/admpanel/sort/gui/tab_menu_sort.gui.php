<?php

/**
 * �������������� ���������
 */
function tab_menu_sort() {
    global $PHPShopInterface, $SortCategoryArray, $help;

    $tree = '<table class="tree table table-hover">
        <tr class="treegrid-0 data-tree">
		<td class="no_tree"><a href="?path=sort">'.__('�������� ���').'</a></td>
	</tr>';
    if (is_array($SortCategoryArray))
        foreach ($SortCategoryArray as $k => $v) {
            $tree.='<tr class="treegrid-' . $k . ' data-tree">
		<td class="no_tree"><a href="?path=sort&cat=' . $k . '">' . $v['name'] . '</a><span class="pull-right">' . $PHPShopInterface->setDropdownAction(array('edit', '|', 'delete', 'id' => $k)) . '</span></td>
	</tr>';
        }
    $tree.='</table><script>
    var cat="' . intval($_GET['cat']) . '";
    </script>';

    $help = '<p class="text-muted">'.__('��� ����������� ������������� � �������, ���������� ���������� �� � ������ � ������� ��� ������ � <a href="?path=catalog&action=new" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> ��������� �������</a>. �������������� �� ��������� ����� �������� � ������� ��������� ���������').'.</p>';

    return $tree;
}

?>