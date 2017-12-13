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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function getStatus($status_id) {
    global $SysValue,$PHPShopGUI,$PHPShopModules;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['order_status']);
    $data = $PHPShopOrm->select(array('*'),false,false,array('limit'=>100));
    if(is_array($data)) 
        foreach($data as $row) {
            if($row['id'] == $status_id) $sel='selected';
            else $sel=null;
            $value[]=array($row['name'],$row['id'],$sel);
        }

    return $PHPShopGUI->setSelect('order_status_new',$value,200,false,'������ ������ �������:');
}


// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;

    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Partner'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");


    $Tab1=$PHPShopGUI->setCheckbox('enabled_new', 1, '���� ��������� ���������', $enabled);
    $Tab1.=$PHPShopGUI->setInputText('���������� ���������','percent_new', $percent, '50', '% �� ������');
    $Tab1.=getStatus($order_status);
    $Info='�������� ����� � ����������� ������ ��������� �� ������: http://'.$_SERVER['SERVER_NAME'].'/partner/<br>
        ���������� �� ����� ����� �������� ��� ������ ��� �������������.
        <p>
������� ����������� � ����������� ��������� �������� �� ������
        http://'.$_SERVER['SERVER_NAME'].'/rulepartner/
     <p>
     ������� ���������� ��������� � ����� /phpshop/modules/partner/templates/<br>
     �������� ���� �� ������ /phpshop/modules/partner/inc/config.ini � ����� [lang]
     <p>
     ��� ���������� ������������ ����� � ����� ����������� ������������� �������������� ���� /phpshop/modules/partner/templates/partner_forma_register.tpl,
     �������� ����������� ���� � ��������� dop_, �������� dop_icq.

';
    
    $Tab1.=$PHPShopGUI->setInfo($Info, '200','97%');

    // ���������� �������� 2
    $Tab2=$PHPShopGUI->setPay($serial,false);

    $Tab3=$PHPShopGUI->setTextarea('rule_new', $rule, false, '99%', 320);
    $Tab3.=$PHPShopGUI->setText('* ����������� ���������� @partnerPercent@ ��� ����������� % ��������������.');


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,350),array("����� ������� �������",$Tab3,350),array("� ������",$Tab2,350));

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


