<?php
if(!empty($_GET['backup']) and !strpos($_GET['backup'], '/')) {
    $_classPath="../../../";
    include($_classPath."class/obj.class.php");
    PHPShopObj::loadClass("base");
    $backup=$_GET['backup'];
    $PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
    $PHPShopBase->chekAdmin();
    if(CheckedRules($UserStatus["sql"],2) == 1) {
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename="'.$backup.'"');
        header('Content-Length: '.filesize($backup));
        readfile($backup);
    }
}
else exit();
?>