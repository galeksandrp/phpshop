<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
//$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.button.button_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    //if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
    //$action = $PHPShopOrm->update($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";




    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Promotions'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Info = '
    <p><b>1. ������ (���_�������/product):</b></p>
    <ul>
        <li><b>@promotionInfo@</b> - �������� ����� <i>(������ � ������ <u>phpshop/templates/��� �������/product/main_product_forma_full.tpl</u>)</i></p>
        <li><b>@promotionsIcon@</b> - ������ �����</li>
    </ul>';

    // ���������� �������� 1
    $Tab2=$PHPShopGUI->setInfo($Info, 100, '95%');
    
    // ���������� �������� 2
    $Tab3=$PHPShopGUI->setPay('� ������',false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("���������",$Tab2,270), array("� ������",$Tab3,270));

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


