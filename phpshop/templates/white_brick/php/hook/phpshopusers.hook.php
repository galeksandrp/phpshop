<?php

/**
 * ��������� ������� ������ ������� ��������� �� ������ �� �������
 * @param array $obj ������
 * @param array $val ������ ������
 */
function user_info_nt($obj, $val, $rout) {
    if ($rout == 'END') {
        $obj->set('formaContent', ParseTemplateReturn('users/users_page_info.tpl'));
    }
}

    $addHandler = array
        (
        'user_info' => 'user_info_nt'
    );
?>