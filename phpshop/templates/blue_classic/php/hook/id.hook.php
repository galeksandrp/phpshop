<?php
 
/**
 * ��� ������� ������ 
 */
function uid_bread_crumbs_hook($obj, $row, $rout) {
 
     if($rout == 'MIDDLE'){
 
     // ��������� ������� ������ � �������
     $obj->navigation($obj->category, $row['name']);
 
     // ��� ��������
     $obj->set('catalogCategory', $obj->category_name);
 
     // ID ���������
     $obj->set('pcatalogId', $obj->category);
     }   
}
 
$addHandler = array
    (
    'UID' => 'uid_bread_crumbs_hook'
);
?>