<?php

/**
 * ������ ���������� ��� ����� ������ �� �������������� �������
 * @author PHPShop Software
 * @version 1.0
 */
// �������������� ��������
function mod_option($option) {
    $GLOBALS['option']['sort'] = 18;
}

// �������������� ����������
function mod_update(&$CsvToArray, $class_name, $func_name) {
    return " option1='" . $CsvToArray[17] . "',  ";
}

// �������������� �������
function mod_insert(&$CsvToArray, $class_name, $func_name) {
    return " option1='" . $CsvToArray[17] . "', ";
}

/* 
1. �������� ��������� ��� � ���� phpshopshop.hook.php � ������� template_UID

// ������
$slad_name = array('�����-�����', '���������� 32', '������� 9', '����������', '�����-���75', '����');
$sklad_disp = null;

if (strstr($dataArray['option1'], "#")) {
    $sklad_array = explode("#", $dataArray['option1']);
    if (is_array($sklad_array)) {

        foreach ($sklad_array as $k => $v) {

            if (!empty($v))
                $sklad_disp.=$slad_name[$k] . ': ����';
            else
                $sklad_disp.=$slad_name[$k] . ': ���';
            $sklad_disp.='<br>';
        }
    }
    $obj->set('skladOption', $sklad_disp);
}
 
2. �������� ���������� ������������� @skladOption@ � product/main_product_forma_fiil.tpl

 */
?>