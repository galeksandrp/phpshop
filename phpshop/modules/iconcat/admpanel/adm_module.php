<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.iconcat.iconcat_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST);
    return $action;
}


function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;
    
    
    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";
    
    
    // �������
    $data = $PHPShopOrm->select();
    @extract($data);
    
    
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'IconCat'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");
    
    
        $info='������ ��������� � �������� �������������� �������� ����� �������� "������", � ��� ����� ��������� ������
            �������� � ������� �������� � ������. ����� ��������� � ����������� ����� �������������  � ����� ��������� � �������� � 
            ���������.
            <p>
        <p>��� �������������� ����� �������� �������������� ������ phpshop/modules/iconcat/templates/catalog_forma.tpl</p>
';

    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');
    
    $Tab3=$PHPShopGUI->setPay($serial,false);
    $Tab3.= $PHPShopGUI->setLine('<br>').$PHPShopGUI->setHistory();
    
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab2,270),array("� ������",$Tab3,270));
    
    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","�������","right",70,"return onCancel();","but");
    
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


