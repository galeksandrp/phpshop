<?

$TitlePage="�����";


function actionStart() {
    global $PHPShopInterface,$_classPath;

    $PHPShopInterface->size="630,530";
    $PHPShopInterface->link="../modules/formgenerator/admpanel/adm_formgeneratorID.php";
    $PHPShopInterface->setCaption(array("&plusmn;","5%"),array("��������","30%"),array("������","10%"),array("��������","20%"),array("E-mail","20%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");


    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.formgenerator.formgenerator_forms"));
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),$where,array('order'=>'id DESC'),array('limit'=>100));

    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            // �������������� ����
            $content=unserialize($row['content']);
            $dop=null;

            if(is_array($content))
                foreach($content as $k=>$v) {
                    $name=str_replace('dop_', '', $k);
                    $dop.=$name.': '.$v.',';
                }
            $dop=substr($dop,0,strlen($dop)-1);


            $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),$name,$path,$dir,$mail);
        }

    //$PHPShopInterface->setAddItem('../modules/formgenerator/admpanel/adm_formgenerator_new.php');
    $PHPShopInterface->Compile();
}
?>