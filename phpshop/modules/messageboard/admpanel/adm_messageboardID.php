<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window=false;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','messageboard'";
$PHPShopGUI->title="�������������� ����������";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.messageboard.messageboard_log"));


function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm,$PHPShopModules;

 // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    extract($data);

    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->size="630,530";
    $PHPShopGUI->addJSFiles($_classPath.'admpanel/java/popup_lib.js',$_classPath.'admpanel/java/dateselector.js');
    $PHPShopGUI->addCSSFiles($_classPath.'admpanel/skins/'.$_SESSION['theme'].'/dateselector.css');


// ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ����������","",$PHPShopGUI->dir."img/i_account_properties_med[1].gif");

    
// ���������� �������� 1
    $Tab1=$PHPShopGUI->setField("����:",
            $PHPShopGUI->setInput("text","date_new",PHPShopDate::dataV($date,false),"left",70).
            $PHPShopGUI->setCalendar('date_new','left',$_classPath.'admpanel/icon/date.gif','left').
            $PHPShopGUI->setLine().
            $PHPShopGUI->setCheckbox('enabled_new','1','�����',$enabled)
            ,"left");


    $Tab1.=$PHPShopGUI->setField("�����:",$PHPShopGUI->setText("���:&nbsp;&nbsp;","left").
            $PHPShopGUI->setInput("text","name_new",$name,"none",300).
            $PHPShopGUI->setText("E-mail:","left").$PHPShopGUI->setInput("text","mail_new",$mail,"left",150).
            $PHPShopGUI->setText("���:","left").$PHPShopGUI->setInput("text","tel_new",$tel,"none",150)
            ,"right",5).
            $PHPShopGUI->setLine().
            $PHPShopGUI->setField("����:",$PHPShopGUI->setTextarea("title_new",$title,"left",'97%','50px'),"none").
            $PHPShopGUI->setField("����������:",$PHPShopGUI->setTextarea("content_new",$content,"left",'97%','80px'),"none");



// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,350));


// ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","delID","�������","right",70,"","but","actionDelete").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

// �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}




// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$PHPShopModules;

    $_POST['date_new'] = PHPShopDate::GetUnixTime($_POST['date_new']);
    if(empty($_POST['enabled_new'])) $_POST['enabled_new'] = 0;

    $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm,$PHPShopModules;
    $action = $PHPShopOrm->delete(array('id'=>'='.$_POST['newsID']));
    return $action;
}

if($UserChek->statusPHPSHOP < 2) {

// ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'],'actionStart','none');

// ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();
?>