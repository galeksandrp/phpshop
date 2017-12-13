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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexmap.yandexmap_system"));


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
    $PHPShopGUI->setHeader("��������� ������ '������.�����'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setTextarea('code_new', $code, null, '98%', '200px');
    $Tab3=$PHPShopGUI->setPay($serial,false);
    $Info='<h4>��� ������� ������.����� �������� ����������</h4>
        <ol>
        <li> <a href="http://api.yandex.ru/maps/form.xml" target="_blank">�������� API ���� ��� ������ �����</a>
        <li> <a href="http://api.yandex.ru/maps/tools/constructor/" target="_blank">�������� ����� �� �����</a>.������� ����� �����.
        ���������� �� ����� ����� � ����� � ��������� ��.
        <li> �������� ��� ��� �������.
        <li> ���������� ��� � �������� � �������� "��� ������" �������� ���� ��������� ������.
        <li> ����� ����� �������� �� ���������� <b>@yandexmap@ </b>. ��� ������� ���������� @yandexmap@ ��������� � �������� ��������, �������� ����� ��������������
        HTML ���� �������� � �������� � ������ ����� @yandexmap@.

</ol>';
    $Tab2=$PHPShopGUI->setInfo($Info, '200px', '95%');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��� ������",$Tab1,270),array("��������",$Tab2,270),array("� ������",$Tab3,270));
    
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


