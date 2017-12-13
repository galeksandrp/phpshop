<?php

/**
 * ��� ������ ����������� ������� � ����������
 * @param Obj $obj ������
 * @param string $old_paginator ����������� ���������� ����������
 * @param string $rout 
 */
function setPaginator_hook($obj, $old_paginator, $rout) {
    if ($rout == 'END') {
      
      // ����� ����� ������
      $old=array('1-3','3-6');
      
      // �� ��� ������
      $new=array('1','2');
      
      $obj->set('productPageNav', str_replace($old, $new, $old_paginator));
    }
}

$addHandler = array
    (
    'setPaginator' => 'setPaginator_hook'
);
?>
