<?

$TitlePage="������ �������� ����������";

function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->razmer='800px';
    $PHPShopInterface->setCaption(array("����","10%"),array("������ ��������","10%"),array("����� ������","10%"),array("���������� ������","10%"),
            array('����� (sec)','10%'));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");

    // SQL
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.guard.guard_log"));
    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'id DESC'),array('limit'=>100));
    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            $PHPShopInterface->setRow($id,PHPShopDate::dataV($date),$change_files,$new_files,$infected_files,$time);
        }

    $PHPShopInterface->Compile();
}
?>