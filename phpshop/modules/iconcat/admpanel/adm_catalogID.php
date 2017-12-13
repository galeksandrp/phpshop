<?php

function addIcon($data) {
    global $PHPShopGUI;

    // ������
    $Tab10 = $PHPShopGUI->setField(__('�����������'), $PHPShopGUI->setInputText(false, "icon_new", $data['icon'], '450px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;"));

    $Tab10.=$PHPShopGUI->setField(__('�������� �����������'),$PHPShopGUI->setTextArea('icon_description_new',$data['icon_description']));
    
    $PHPShopGUI->addTab(array("������", $Tab10, 450));
}

$addHandler = array(
    'actionStart' => 'addIcon',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>