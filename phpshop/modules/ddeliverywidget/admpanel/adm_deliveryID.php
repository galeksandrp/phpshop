<?php

function addDDelivery($data) {
    global $PHPShopGUI;
    if (!function_exists('addRussianPostDelivery')) {
        $Tab3.=$PHPShopGUI->setField(__('�� �������� ���������'), $PHPShopGUI->setRadio('is_mod_new', 1, __('���������'), $data['is_mod'], false, 'text-warning') .
                $PHPShopGUI->setRadio('is_mod_new', 2, __('��������'), $data['is_mod']));

        $PHPShopGUI->addTab(array("DDelivery", $Tab3, true));
    }
}

$addHandler = array(
    'actionStart' => 'addDDelivery',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>