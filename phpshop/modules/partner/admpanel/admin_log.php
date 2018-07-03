<?php


function actionStart() {
    global $PHPShopInterface,$PHPShopModules,$TitlePage, $select_name;

    $PHPShopInterface->checkbox_action=false;
    $PHPShopInterface->setActionPanel($TitlePage, $select_name, false);
    $PHPShopInterface->setCaption(array("� ������","5%"),array("����","10%"),array("����������","25%"),array("�������","25%"),array("�������","30%"),array("������","10%"));


    // SQL
    $PHPShopOrm = new PHPShopOrm();
    $result = $PHPShopOrm->query('SELECT a.*, b.login, c.id FROM '.$PHPShopModules->getParam("base.partner.partner_log").' AS a JOIN '.$PHPShopModules->getParam("base.partner.partner_users").' AS b ON a.partner_id = b.id JOIN '.$GLOBALS['SysValue']['base']['orders'].' AS c ON a.order_id = c.uid order by a.order_id desc limit 1000;');

    while($row = mysqli_fetch_array($result)) {
        
        if(!empty($row['enabled']))
            $row['enabled']='��������';
        
        $PHPShopInterface->setRow(array('name'=>$row['order_id'],'link'=>'?path=order&id=uid&uid=' . $row['order_id']),PHPShopDate::dataV($row['date'],false),$row['order_user'],array('name'=>$row['login'],'link'=>'?path=modules.dir.partner&id=' . $row['partner_id']), PHPShopSecurity::TotalClean($row['path'],2),$row['enabled']);
    }

    $PHPShopInterface->Compile();
}
?>