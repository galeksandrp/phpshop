<?

$TitlePage="������ ���������� ����� Cron";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->razmer='800px';
    $PHPShopInterface->setCaption(array("����","10%"),array("������","20%"),array("����������� ����","40%"),array("������","10%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");

    // SQL
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_log"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array('limit'=>100));
    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            $PHPShopInterface->setRow($id,PHPShopDate::dataV($date),$name,$path,$status);
        }

    $PHPShopInterface->Compile();
}
?>