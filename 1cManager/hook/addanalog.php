<?php

/**
 * ������ ���������� ��� ����� �������� ������� �� ��������
 * ��� ��������� ������������� ���� � addanalog.php
 * @author PHPShop Software
 * @version 1.0
 */
// �������������� ��������
function mod_option($option) {
    PHPShopObj::loadClass("product");
    $GLOBALS['option']['sort'] = 18;
}

// ����� �� ������ �� ��������
function mod_analog_get_uid($uid){
    $PHPShopProduct = new PHPShopProduct(trim($uid),'uid');
    return $PHPShopProduct->getParam("id");
}

// ���������� ������ ��������
function mod_add_analog($analog) {
    $analog_list=null;

    foreach ($analog as $uid){
        $analog_list=mod_analog_get_uid($uid).',';
    }
        
    return substr($analog_list,0,strlen($analog_list)-1);
}

// �������������� ����������
function mod_update($CsvToArray, $class_name, $func_name) {
    if (!empty($CsvToArray[17])) {

        if (strstr($CsvToArray[17], ','))
            $odnotip = explode(',', $CsvToArray[17]);
        else
            $odnotip[] = $CsvToArray[17];

        return "odnotip='" . mod_add_analog($odnotip) . "', ";
    }
}

// �������������� �������
function mod_insert($CsvToArray, $class_name, $func_name) {
    if (!empty($CsvToArray[17])) {

       if (strstr($CsvToArray[17], ','))
            $odnotip = explode(',', $CsvToArray[17]);
        else
            $odnotip[] = $CsvToArray[17];

        return "odnotip='" . mod_add_analog($odnotip) . "', ";
    }
}

?>