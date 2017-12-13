<?php

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
$PHPShopGUI->ajax="'modules','partner'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_users"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
    $_POST['date_done_new']=time();
    $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;

    $PHPShopGUI->title="�������������� ��������";
    //$PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    @extract($data);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ��������","",$PHPShopGUI->dir."img/i_account_contacts_med[1].gif");

    $Tab1=$PHPShopGUI->setInputText('�����: ','login', $login);
    $Tab1.=$PHPShopGUI->setInputText('E-mail: ','mail_new', $mail);

    // �������������� ����
    $content=unserialize($content);
    $dop=null;

    if(is_array($content))
        foreach($content as $k=>$v) {
            $name=str_replace('dop_', '', $k);
            $dop.=$name.': '.$v.'
';
        }
    $dop=substr($dop,0,strlen($dop)-1);

    $Tab1.=$PHPShopGUI->setTextarea('dop', $dop,'none','100%','200px');
    $Tab1.=$PHPShopGUI->setCheckbox('enabled_new', 1, '�����������', $enabled);

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


// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'],'actionStart','none');

// ��������� �������
$PHPShopGUI->getAction();
?>