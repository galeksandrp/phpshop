<?php

/**
 * ��������� ����� ������� � "������ ��������"
 * @param array $obj ������
 */
function nowBuy_hook($obj) {
    //$obj->cell=3;
    $obj->limitpos=6;
}

/**
 * ��������� ����� ������� � "��������������� �� �������"
 * @param array $obj ������
 */
function specMain_hook($obj) {
    $obj->cell=3;
    $obj->limit=6;
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

$addHandler=array
        (
        'nowBuy'=>'nowBuy_hook',
        '#specMain'=>'specMain_hook',
        'leftCatalTable'=>'leftCatalTable_hook'
);

?>