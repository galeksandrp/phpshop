<?php

// ����� ����� ��������
function lic_parse($dir) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $fstat = explode(".", $file);
            if ($fstat[1] == "lic")
                return @parse_ini_file("../../../license/" . $file, 1);
        }
        closedir($dh);
    }
}

/**
 * ������ �������������� �����
 * @param array $row ������ ������
 * @return string 
 */
function tab_advance($data) {
    global $PHPShopGUI;

    $disp = null;

    // ������������
    if (!empty($data['user']))
        $disp.=$PHPShopGUI->setButton(__('������������'), '../img/icon_user.gif', 130, 30, $float = "left", $onclick = "return miniWin('../shopusers/adm_userID.php?id=" . $data['user'] . "',550,580)");
    else
        $disp.=$PHPShopGUI->setButton(__('������������'), '../img/icon_user.gif', 130, 30, $float = "left", $onclick = "return miniWin('../shopusers/adm_users_new.php?visitorID=" . $data['id'] . "',550,580)");

    // ������ � 1�
    $License = lic_parse("../../../license/");
    if (empty($License) or $License['License']['Pro'] == 'Enabled')
        $disp.=$PHPShopGUI->setButton(__('������ � 1�'), '../img/icon_package_get.gif', 130, 30, $float = "left", $onclick = "window.open('../1c/orders_export.php?orderID=" . $data['id'] . "'); return false;");

    // ����� �����
    $disp.=$PHPShopGUI->setButton(__('����� �����'), '../img/icon_package_get.gif', 130, 30, $float = "left", $onclick = "window.location.replace('adm_visitor_new.php?orderAdd=" . $data['id'] . "'); return false;");


    return $disp;
}

?>
