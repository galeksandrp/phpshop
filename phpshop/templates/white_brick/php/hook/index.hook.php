<?php
/**
 * ��������� ����� ������� � "��������������� �� �������"
 * @param array $obj ������
 */

function specmain_hook($obj){
	// ���� ��������� ��� �� ������ ������� ��� ��������
	// ������ ���-�� ������ �� ������� = 15
//	$obj->limit = 15;
}


/**
 * ��������� ����� ��������� � "������� ��������� �� �������"
 * @param array $obj ������
 */
function leftCatalTable_hook($obj) {

    // ��������� ����
    return true;
    
    $obj->cell=1;
}

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>
 * @param array $obj ������
 * @param array $arg ������ ������
 * @return string
 */
function setcell_hook($obj,$arg) {
    $li=null;
    $panel=array('panel_l','panel_r','panel_l','panel_r');

    foreach($arg as $key=>$val) {
        if(!empty($val)) {
            $li.='<li>'.$val.'</li>';
        }
    }

    return $li;
}

/**
* ��������� ���-�� ������ �� �������
*/

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>, ���������� ������ � <ul>
 * @return string
 */
function compile_hook($obj) {
    $ul='<ul>'.$obj->product_grid.'</ul>';
    $obj->product_grid=null;
    return $ul;
}



$addHandler=array
        (
        '#setCell'=>'setcell_hook',
        '#compile'=>'compile_hook',
        'specMain'=>'specmain_hook'
);

?>