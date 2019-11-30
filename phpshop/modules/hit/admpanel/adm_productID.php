<?php

function addOptionHit($data) {
    global $PHPShopGUI;

    // ����� ������
    $Tab10 = $PHPShopGUI->setCheckbox('hit_new', 1, '���', $data['hit']);

    $PHPShopGUI->addTab(array("����", $Tab10, true));
}

function updateOptionHit($data) {
    if (empty($_POST['hit_new'])) {
        $_POST['hit_new'] = 0;
    }
}

$addHandler = array(
    'actionStart' => 'addOptionHit',
    'actionDelete' => false,
    'actionUpdate' => 'updateOptionHit'
);
?>