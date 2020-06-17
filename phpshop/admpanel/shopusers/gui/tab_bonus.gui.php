<?php

function tab_bonus($id) {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['bonus']);
    $data = $PHPShopOrm->select(array('*'), array('user_id' => '= "' . $id . '"'), array('order' => 'date'), array('limit' => 10));
    $dis = '<table id="table-bonus-comment" class="table"><thead><tr><th>'.__('Дата').'</th><th>'.__('Комментарий').'</th><th>'.__('Операция с бонусами').'</th></tr></thead>';

    if (is_array($data)) {
        foreach ($data as $row) {
            $dis .= '<tr><td>' . PHPShopDate::get($row['date']) . '</td><td>' . $row['comment'] . '</td><td>' . $row['bonus_operation'] . '</td></tr>';
        }

    }
    $dis .= '<tr><td></td><td><input style="width:100%" placeholder="' . __('Добавить') . '" name="comment_new" class="form-control input-sm" value=""></td><td><input style="width:100%" placeholder="' . __('0') . '" name="bonus_operation_new" class="form-control input-sm" value=""></td></tr></table>
        
	<input type="hidden" name="dateb_new" value="' . PHPShopDate::get() . '">';
    
    return $dis;
}

?>