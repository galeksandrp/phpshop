<?php

/**
 * ������ ���������� ��� ����� �������������� ����� ������� � ������� JSON
 * ��� ��������� ������������� ���� � json.php
 * @author PHPShop Software
 * @version 1.0
 */
// �������������� ��������
function mod_option($option) {
    $GLOBALS['option']['sort'] = 18;
}

// �������������� ����������
function mod_update(&$CsvToArray, $class_name, $func_name) {
    $json = json_decode(json_decode('"'.$CsvToArray[17].'"'),true);
    if (is_array($json)) {
        return " spec='" . intval($json['spec']) . "', newtip='" . intval($json['newtip']) . "', ";
    }
}

// �������������� �������
function mod_insert(&$CsvToArray, $class_name, $func_name) {
    $json = json_decode(json_decode('"'.$CsvToArray[17].'"'),true);
    if (is_array($json)) {
        return " spec='" . intval($json['spec']) . "', newtip='" . intval($json['newtip']) . "', ";
    }
}

?>