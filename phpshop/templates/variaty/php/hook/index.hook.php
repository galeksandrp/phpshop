<?php

/**
 * ��������� ����� ������� � "��������������� �� �������"
 * @param array $obj ������
 */

function specmain_index_hook($obj){
	// ���� ��������� ��� �� ������ ������� ��� ��������
	// ������ ���-�� ������ �� ������� = 15
	$obj->limit = 15;
}




$addHandler=array
        (
        'specMain'=>'specmain_index_hook'
);

?>