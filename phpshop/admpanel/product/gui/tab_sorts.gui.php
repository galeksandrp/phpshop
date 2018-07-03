<?php

/**
 * ������ ������ �������������
 * @param int $value �������� ��������������
 * @param int $n �� ��������������
 * @param int $title ��������� ��������������
 * @param array $vendor ������ �������������
 */
function sorttemplate($value, $n, $title, $vendor) {
    global $PHPShopGUI;
    $i = 1;
    //$value_new[0]=array(__('��� ������'),false, 'none');
    
    if (is_array($value)) {
        sort($value);
        foreach ($value as $p) {
            $sel = null;
            if (is_array($vendor[$n])) {
                foreach ($vendor[$n] as $value) {

                    if ($value == $p[1])
                        $sel = "selected";
                }
            }elseif ($vendor[$n] == $p[1])
                $sel = "selected";

            $value_new[$i] = array($p[0], $p[1], $sel);
            $i++;
        }
    }

    $value = $PHPShopGUI->setSelect('vendor_array_new[' . $n . '][]', $value_new, 300, null, false, $search = true, false, $size = 1, $multiple = true);

    $disp = $PHPShopGUI->setField($title, $value) .
            $PHPShopGUI->setField(null, $PHPShopGUI->setInputArg(array('type' => 'text', 'placeholder' => __('������ ������'), 'size' => '300', 'name' => 'vendor_array_add[' . $n . ']','class'=>'vendor_add')));

    return $disp;
}

/**
 * ������ ����������� ������
 * @param array $row ������ ������
 * @return string 
 */
function tab_sorts($data) {
    global $PHPShopGUI;
    PHPShopObj::loadClass("sort");
    $PHPShopSort = new PHPShopSort($data['category'], false, false, 'sorttemplate', unserialize($data['vendor_array']), false, true);

    $sort = $PHPShopSort->disp;

    if (empty($sort))
        $sort =
                '<p class="text-muted">��� ����������� ������������� � ������� ���������� ���������� <a href="?path=sort" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> �������������� � ������</a> � ������� ��� ������ � <a href="?path=catalog" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-share-alt"></span> ��������� �������</a>. �������������� �� ��������� ���� �������� � ������� ��������� ���������.</p>';


    return $PHPShopGUI->setCollapse('��������������', $sort, $collapse = 'none', $line = true, $icons = false);
}

?>
