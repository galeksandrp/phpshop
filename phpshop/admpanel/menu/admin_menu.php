<?php

$TitlePage = __("��������� �����");

function actionStart() {
    global $PHPShopInterface;
    $PHPShopInterface->size = "650,530";
    $PHPShopInterface->link = "menu/adm_menuID.php";
    $PHPShopInterface->setCaption(array("&plusmn;", "5%"), array("��������", "50%"), array("����", "10%"), array("������������", "10%"));

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['menu']);
    $data = $PHPShopOrm->select(array('*'), false, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {
            extract($row);

            if ($element == 0)
                $element = __("�����");
            else
                $element = __("������");

            $PHPShopInterface->setRow($id, $PHPShopInterface->icon($flag), $name, $dir, $element);
        }

    $PHPShopInterface->setAddItem('menu/adm_menu_new.php');
    $PHPShopInterface->Compile();
}

?>
