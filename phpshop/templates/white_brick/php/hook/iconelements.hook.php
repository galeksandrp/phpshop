<?php

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>
 * @param array $obj ������
 * @param array $arg ������ ������
 * @return string
 */
function setcell_hook($obj, $arg) {
    if ($PHPShopNav->objNav[path] == 'shop' AND $PHPShopNav->objNav[nav] == 'CID')
        return;
    $li = null;
    $panel = array('panel_l', 'panel_r', 'panel_l', 'panel_r');

    foreach ($arg as $key => $val) {
        if (!empty($val)) {
            $li.='<li>' . $val . '</li>';
        }
    }

    return $li;
}

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>, ���������� ������ � <ul>
 * @return string
 */
function compile_hook($obj) {
    //if(!$obj->PHPShopNav->index()) return;
    $ul = '<ul>' . $obj->product_grid . '</ul>';
    $obj->product_grid = null;
    return $ul;
}

function specMainIcon_white_blick_hook($obj){
    if($obj->PHPShopNav->getPath() == 'id' or $obj->PHPShopNav->getNav() == 'UID')
        return true;
}


$addHandler = array
    (
    'setCell' => 'setcell_hook',
    'compile' => 'compile_hook',
    'specMainIcon' => 'specMainIcon_white_blick_hook'
);
?>