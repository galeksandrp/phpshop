<?

$TitlePage="������ �������";

function actionStart() {
    global $PHPShopInterface,$_classPath;


    $PHPShopInterface->setCaption(array("����","10%"),array("IP","10%"),array("�������","80%"));

    // ��������� ������
    PHPShopObj::loadClass("modules");
    $PHPShopModules = new PHPShopModules($_classPath."modules/");


    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.errorlog.errorlog_log"));
    $PHPShopOrm->debug=false;
    if(!empty($_GET['sortdate_start'])) $where=array('date'=>' < '.(PHPShopDate::GetUnixTime($_GET['sortdate_end'])+86400).' AND date > '.(PHPShopDate::GetUnixTime($_GET['sortdate_start'])-86400));
    else $where=false;

    $data = $PHPShopOrm->select(array('*'),$where,array('order'=>'id DESC'),array('limit'=>500));

    if(!empty($mod_option['enabled'])){
    $PHPShopInterface->size="630,530";
    }
    
    if(is_array($data))
        foreach($data as $row) {
            extract($row);

            $PHPShopInterface->setRow($id,PHPShopDate::dataV($date),$ip,htmlspecialchars($error));
        }

    $link = "../modules/errorlog/admpanel/export.php?sortdate_start=".$_GET['sortdate_start']."&sortdate_end=".$_GET['sortdate_end'];
    $clean='../modules/errorlog/admpanel/export.php?do=clean';

    $notice='<b>���������</b> - ����� ��� ������������, ��������� ��� ������� ������';
    if(count($data)>5){
        $PHPShopInterface->_CODE_ADD_BUTTON=$PHPShopInterface->setDiv('left',$notice,'padding:10px;float:left').
            $PHPShopInterface->setInput("button","",__("��������� � CSV"),"right",150,"return  window.open('".$link."','_blank');","but").$PHPShopInterface->setInput("button","clean",__("��������"),"right",150,"window.open('".$clean."','_blank');window.location.reload();","but");
    }
    $PHPShopInterface->Compile();
}
?>