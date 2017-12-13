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
$PHPShopGUI->ajax="'modules','partner','payment'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_payment"));



// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$PHPShopModules,$PHPShopSystem;

    // ��������� ������ ��������
    $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_users"));
    $PHPShopOrm->debug=false;
    $data=$PHPShopOrm->select(array('id,money'),array('login'=>"='".$_POST['partnerLogin']."'"),false,array('limit'=>1));
    print_r($data);
    if(is_array($data))
        if($data['money']>=$_POST['sum']) {
            $money=$data['money'];
            $total=$money-$_POST['sum'];
            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_users"));
            $PHPShopOrm->debug=false;
            $action = $PHPShopOrm->update(array('money_new'=>$total),array('id'=>'='.$data['id']));
        }

    if($action == true) {

        if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
        $_POST['date_done_new']=time();

        // ��������� ������������
        if(!empty($_POST['sendmail'])) {
            PHPShopObj::loadClass("mail");
            $PHPShopMail = new PHPShopMail($_POST['mail'],$PHPShopSystem->getValue('adminmail2'),
                    '������� ��������� - '.$PHPShopSystem->getValue('name'),$_POST['content'] );
        }

        $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_payment"));
        $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    }


    return true;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm,$PHPShopModules;

    $PHPShopGUI->title="������ �� �������";

    // �������
    $PHPShopOrm->sql='SELECT a.*, b.login, b.mail, b.money, b.content FROM '.$PHPShopModules->getParam("base.partner.partner_payment").' AS a JOIN '.$PHPShopModules->getParam("base.partner.partner_users").' AS b ON a.partner_id = b.id where a.id='.$_GET['id'];
    $data = $PHPShopOrm->select();
    @extract($data[0]);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("������ �� �������","������� ������ ��� ������ � ����.",$PHPShopGUI->dir."img/i_visa_med[1].gif");

    $Tab1=$PHPShopGUI->setInputText('�����: ','login', $login);
    $Tab1.=$PHPShopGUI->setInputText('E-mail: ','mail', $mail);
    $Tab1.=$PHPShopGUI->setInputText('������: ','', $money,50,$PHPShopSystem->getDefaultValutaCode());
    $Tab1.=$PHPShopGUI->setInputText('������: ','sum', $sum,50,$PHPShopSystem->getDefaultValutaCode());


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

    $Tab1.=$PHPShopGUI->setField('�������������', $PHPShopGUI->setTextarea('dop', $dop));

    $message='���������, '.$login.'.
'.$GLOBALS['SysValue']['lang']['partner_money_ready'].'
��������� '.$sum.' '.$PHPShopSystem->getDefaultValutaCode();

    $Tab1.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox('sendmail', 1, '��������� ������������', $enabled), $PHPShopGUI->setTextarea('content', $message));
    $Tab1.=$PHPShopGUI->setCheckbox('enabled_new', 1, '������ ���������', $enabled);


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","partnerLogin",$login,"right",70,"","but").
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