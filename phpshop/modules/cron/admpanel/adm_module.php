<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->update($_POST);
    return true;
}

// �������
function listJob(){
    global $PHPShopModules,$PHPShopGUI;
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.cron.cron_job"));
    $PHPShopInterface = new PHPShopInterface();
    $PHPShopInterface->size="600,500";
    $PHPShopInterface->window=true;
    $PHPShopInterface->link="./adm_cronID.php";
    $PHPShopInterface->realpath=true;
    $PHPShopInterface->imgPath=$PHPShopGUI->dir."img/";
    $PHPShopInterface->setCaption(array("&plusmn;","7%"),array("��������","60%"),array("��������� ������","25%"));

    $data = $PHPShopOrm->select(array('*'),false,array('order'=>'num'),array('limit'=>30));
    
    if(is_array($data))
        foreach($data as $row)
        $PHPShopInterface->setRow($row['id'],$PHPShopInterface->icon($row['enabled']),$row['name'],PHPShopDate::dataV($row['last_execute']));

    $PHPShopInterface->setAddItem('./adm_cron_new.php');
    return $PHPShopInterface->Compile();
}



// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";


    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Cron'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    // ���������� �������� 1
    $Tab1=listJob();

    // ���������� �������� 2
    $Tab2=$PHPShopGUI->setPay($serial,false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270),array("� ������",$Tab2,270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'],'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>


