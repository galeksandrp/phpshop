<?php

function addRussianPostDelivery($data) {
    global $PHPShopGUI;

    if (!function_exists('addDDelivery')) {

        $Tab3.=$PHPShopGUI->setField('�� �������� ���������', $PHPShopGUI->setRadio('is_mod_new', 1, '���������', $data['is_mod'], false, 'text-warning') .
                $PHPShopGUI->setRadio('is_mod_new', 2, '��������', $data['is_mod']));

        $PHPShopGUI->addTab(array("����� ������", $Tab3, true));
    }
}

$addHandler = array(
    'actionStart' => 'addRussianPostDelivery',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>