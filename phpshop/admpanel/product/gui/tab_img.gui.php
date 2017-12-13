<?php
/**
 * ������ ����������� ������
 * @param array $row ������ ������
 * @return string 
 */
function tab_img($data){
    global $PHPShopGUI,$PHPShopSystem;
    
    // ���������� ����������� � �������
    $Tab6 = $PHPShopGUI->setField(__('�������� ����������� � �������'), $PHPShopGUI->setInputText(false, "pic_resize", null, '500px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPicResize(" . $data['id'] . ");return false;"));

    // ��������� �����������
    $Tab6_1 = $PHPShopGUI->setField(__('���������'), $PHPShopGUI->setInputText(false, "pic_small_new", $data['pic_small'], '500px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('pic_small_new');return false;"));

    // ������� �����������
    $Tab6_1.= $PHPShopGUI->setField(__('�������'), $PHPShopGUI->setInputText(false, "pic_big_new", $data['pic_big'], '500px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('pic_big_new');return false;"));

    // ������� ����������� � �����������
    $PHPShopInterfacePic = new PHPShopInterface();
    $PHPShopInterfacePic->size = "500,500";
    $PHPShopInterfacePic->window = true;
    $PHPShopInterfacePic->imgPath = "../img/";
    $PHPShopInterfacePic->link = $dot . "./adm_galeryID.php";
    $PHPShopInterfacePic->setCaption(array("�", "10%"), array(__("����������"), "90%"));
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['foto']);
    $data_pic = $PHPShopOrm->select(array('*'), array('parent' => '=' . $data['id']), array('order' => 'num desc'),array('limit'=>100));
    $i = 1;
    $img_list = null;
    if (is_array($data_pic))
        foreach ($data_pic as $row) {
            $PHPShopInterfacePic->setRow($row['id'], $i, $row['name']);

            if ($i < 6)
                $img_list.=$PHPShopGUI->setImage($row['name'], $PHPShopSystem->getSerilizeParam('admoption.img_tw'), $PHPShopSystem->getSerilizeParam('admoption.img_tw'), false, false, 'cursor:pointer;padding:3px', 'miniWin(\'./adm_galeryID.php?id=' . $row['id'] . '\',500,500)');

            $i++;
        }

    $Tab6_1.=$img_list;

    // �������
    $PHPShopInterface = new PHPShopInterface('_foto_');
    $PHPShopInterface->setTab(array(__("�����������"), $Tab6_1, 300), array(__("�����������"), $PHPShopInterfacePic->Compile('fotolist'), 300));
    $Tab6.=$PHPShopInterface->getContent();
    
    return $Tab6;
}
?>
