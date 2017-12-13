<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.admlog.admlog_log"));


// ������� ����������
function actionUpdate() {
    global $PHPShopSystem;

    $pathinfo=pathinfo($_POST['file_new']);
    $file=$pathinfo['dirname'];

    // ����� ������ ��
    $baseMap=array(
            'page'=>'table_name11',
            'catalog'=>'table_name',
            'system'=>'table_name3',
            'gbook'=>'table_name7',
            'news'=>'table_name8',
            'menu'=>'table_name14',
            'news_writer'=>'table_name9',
            'banner'=>'table_name15',
            'links'=>'table_name17',
            'users'=>'table_name19',
            'opros'=>'table_name20',
            'opros_categories'=>'table_name21',
            'phpshop_photo_categories'=>'table_name22',
            'phpshop_photo'=>'table_name23',
            'phpshop_rssgraber'=>'table_name24'
    );

    // ����� �����
    $dirSearch=array_keys($baseMap);


    foreach($dirSearch as $val)
        if(strpos($file,$val)) {
            $baseName=$baseMap[$val];
            break;
        }

    $contentCode=unserialize(base64_decode($_POST['contentCode']));


    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base'][$baseName]);
    $PHPShopOrm->debug=false;
    //$PHPShopOrm->trace($contentCode);

    if(!empty($contentCode['delID'])){
        $action = $PHPShopOrm->insert($contentCode);
        $nameHandler='����� ��������';
    }
    else{
        $action = $PHPShopOrm->update($contentCode,array('id'=>'='.$contentCode['newsID']));
        $nameHandler='����� ���������';
    }

    // ����� ���
    include_once('writelog.php');
    setLog(false,$nameHandler);

    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;

    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="����� ���������";
    $PHPShopGUI->size="500,450";


    // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    $contentTemp=unserialize($data['content']);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("����� ���������","����������� ������ �� ".PHPShopDate::dataV($date,true),$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    // ���������� �������� 1
    $Tab1=$PHPShopGUI->setField("����:",$PHPShopGUI->setInput("text","name_new",PHPShopDate::dataV($data['date'],true),"left",100));
    $Tab1.=$PHPShopGUI->setField("������������:",$PHPShopGUI->setInput("text","name_new",$data['user'],"left",200));
    $Tab1.=$PHPShopGUI->setField("��������:",$PHPShopGUI->setInput("text","name_new",$data['title'],"left",500));
    $Tab1.=$PHPShopGUI->setField("����:",$PHPShopGUI->setInput("text","file_new",$data['file'],"left",500));


    // �������� ����������
    $titleSearch=array('content_new');
    if(is_array($contentTemp))
    foreach($contentTemp as $key=>$val) {
        if(in_array($key, $titleSearch)) {
            $contentMain = $contentTemp[$key];
            break;
        }
    }


    // �������� 1
    $PHPShopGUI->setEditor('none',$mod_enabled=true);
    $oFCKeditor = new Editor('content_temp') ;
    $oFCKeditor->Height = '280';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath."../templates".chr(47).$PHPShopSystem->getParam("skin").chr(47).$SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value		= $contentMain ;

    $Tab2=$oFCKeditor->AddGUI();

    // ������ ������
    $Tab1.=$PHPShopGUI->setInput("hidden","contentCode",base64_encode($data['content']),"left",1);


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,300));

    if(!empty($contentMain))
        $PHPShopGUI->addTab(array("����������",$Tab2,300));


    $pathinfo=pathinfo($file);
    $ContentFooter=$PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but");

    if($pathinfo['basename'] != "adm_admlog_back.php")
        $ContentFooter.=$PHPShopGUI->setInput("submit","editID","��������","right",70,"","but","actionUpdate");

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