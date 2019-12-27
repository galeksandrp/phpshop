<?php

function addOptionProdDay($data) {
    global $PHPShopGUI;

    // ����� ������
    $Tab10 = $PHPShopGUI->setField('����� ���',$PHPShopGUI->setCheckbox('productday_new', 1, '����� ������ ��� �� �����', $data['productday']));

    if (empty($data['sklad']))
        $PHPShopGUI->addTab(array("����� ���", $Tab10, true));
}

function updateOptionProdDay($data) {
    if (empty($_POST['productday_new'])) {
        $_POST['productday_new'] = 0;
    }

    $_POST['datas_new'] = time();
}

$addHandler = array(
    'actionStart' => 'addOptionProdDay',
    'actionDelete' => false,
    'actionUpdate' => 'updateOptionProdDay'
);
?>