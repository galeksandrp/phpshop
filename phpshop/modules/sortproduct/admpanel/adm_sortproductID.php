<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");


$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window=false;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','sortproduct'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sortproduct.sortproduct_forms"));

function checkName($name){
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
    $data = $PHPShopOrm->select(array('*'),array('name'=>'="'.$name.'"'),false,array('limit'=>1));
    if(!empty($data['id'])) return $data['id'];
}

function checkId($id){
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$id),false,array('limit'=>1));
    if(!empty($data['name'])) return $data['name'];
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    // �������� ������� ��������������
    if(is_numeric($_POST['value_name_new'])){
        $_POST['value_id_new']=$_POST['value_name_new'];
        $_POST['value_name_new']=checkId($_POST['value_name_new']);
    }
    else{
        $_POST['value_id_new']=checkName($_POST['value_name_new']);
    }


    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;

    $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    return $action;
}

/**
 * ����� ��������������
 */
function getSortValue($n) {
    global $PHPShopGUI;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
    $PHPShopOrm->debug=false;
    $data = $PHPShopOrm->select(array('*'),array('filtr'=>"='1'",'goodoption'=>"!='1'"),array('order'=>'num'),array('limit'=>100));
    if(is_array($data))
        foreach($data as $row) {

            if($n == $row['id']) $sel='selected';
            else $sel=false;

            $value[]=array($row['name'],$row['id'],$sel);
        }

    return $PHPShopGUI->setSelect('sort_new',$value,300);
}


// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="�������������� ��������";
    $PHPShopGUI->size="630,530";


    // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ��������","������� ������ ��� ������ � ����.",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('�����:',
            $PHPShopGUI->setInputText('�������','num_new',$num,'30'). $PHPShopGUI->setInputText('���������� ������','items_new',$items,'30').
            $PHPShopGUI->setCheckbox('enabled_new',1,'�����',$enabled));
    $Tab1.=$PHPShopGUI->setField('��������������',getSortValue($sort));
    $Tab1.=$PHPShopGUI->setField('��������',$PHPShopGUI->setInputText(false,'value_name_new',$value_name,'300','* ��� ��� ID'));


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","delID","�������","right",70,"","but","actionDelete").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}


// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
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


