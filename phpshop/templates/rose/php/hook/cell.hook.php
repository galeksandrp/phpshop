<?php

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>
 * @param array $obj ������
 * @param array $arg ������ ������
 * @return string
 */
function setcell_hook($obj, $arg) {

    $li = null;
    $panel = array('panel_l', 'panel_r', 'panel_l', 'panel_r');

    foreach ($arg as $key => $val) {
        if (!empty($val)) {
            $li.='<li class="' . $panel[$key] . '">' . $val . '</li>';
        }
    }

    return $li;
}

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>, ���������� ������ � <ul>
 * @return string
 */
function compile_hook($obj) {
    $ul = '<ul>' . $obj->product_grid . '</ul>';
    $obj->product_grid = null;
    return $ul;
}

/**
 * ��������� ����� ������������� �������, ����� ������� = 3
 */
function odnotip_hook($obj, $row, $rout) {
    if ($rout == 'START') {
        $obj->odnotip_setka_num = 3;
        //$obj->template_odnotip='main_product_forma_3';
        $obj->line = true;
    }
}

/**
 * ��������� ������ ������������ � �������� � <li> �� <div> + ��������
 */
function cid_category_hook($obj, $dataArray, $rout) {

    $dis = null;
    if ($rout == 'END') {
        if (is_array($dataArray))
            foreach ($dataArray as $row) {
                $content = PHPShopText::a($obj->path . '/CID_' . $row['id'] . '.html', $row['name']);
                $content.=PHPShopText::p($row['content']);
                $dis.=PHPShopText::div($content, $align = "left", $style = 'float:left;padding:10px');
            }

        // ������������ ���������� ������ ���������
        $obj->set('catalogList', $dis);

        // C�������������� �������
        cid_category_add_spec_hook($obj, $dataArray);
    }
}

/**
 * ���������� � ������ ��������� ��������������� ������� � 3 ������, ����� 3
 */
function cid_category_add_spec_hook($obj, $row) {
    global $PHPShopProductIconElements;

    // ��������� ����� ��������
    if (is_array($row))
        foreach ($row as $val)
            $cat[] = $val['id'];
    $rand = rand(0, count($cat) - 1);

    // ���������� ������� ������ ���������������
    $PHPShopProductIconElements->template = 'main_product_forma_3';
    $spec = $PHPShopProductIconElements->specMainIcon(false, $cat[$rand], 3, 3, true);
    $spec = PHPShopText::div(PHPShopText::p($spec), $align = "left", $style = 'float:none;padding:10px');

    // ��������� � ���������� ������ ��������� ����� ���������������
    $obj->set('catalogList', $spec, true);
}

function CID_Product_cell_hook($obj, $row, $rout) {
    if ($rout == "START") {
        if ($obj->PHPShopCategory->getParam('num_row') == 4)
            $obj->PHPShopCategory->setParam('num_row', 3);
    }
}

$addHandler = array
    (
    'odnotip' => 'odnotip_hook',
    '#setCell' => 'setcell_hook',
    '#compile' => 'compile_hook',
    '#CID_Category' => 'cid_category_add_spec_hook',
    'CID_Product' => 'CID_Product_cell_hook'
);
?>