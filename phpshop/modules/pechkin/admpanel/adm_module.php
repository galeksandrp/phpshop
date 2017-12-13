<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";

    //����� ��������������
    $adminmail = $PHPShopSystem->objRow['adminmail2'];

    //���������� JS �������������
    $PHPShopGUI->addJSFiles('../js/jquery-1.7.1.min.js','../js/pechkin-admin.js');
    $PHPShopGUI->addCSSFiles('../css/pechkin-admin.css');

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '������'","���������","../img/email_edit.png");

    if($_SESSION['pechkinLogin']!='') {
        $LoginPechkin = $_SESSION['pechkinLogin'];
        $cssPechkin = 'hidden';
        $cssPechkinTrue = 'visible';
        $cssPechkinReg = 'hidden';
    }
    else {
        $cssPechkin = 'visible';
        $cssPechkinTrue = 'hidden';
        $cssPechkinReg = 'visible';
    }


    // ���������� �������� 1
    $Tab1=$PHPShopGUI->setField('����������� �� ������� <u>Pechkin-Mail</u>',
        '<div class="auth-pechkin '.$cssPechkin.'">' .
        $PHPShopGUI->setInput("text", "login_p_new", $login_p, false, 140, false, false, false, '�����&nbsp;&nbsp;&nbsp;') .
        $PHPShopGUI->setInput("password", "pass_p_new", $pass_p, false, 140, false, false, false, '������&nbsp;') .
        $PHPShopGUI->setInput("button","auth","�����",false,70,"authPechkin()","but","actionStart", false ,'<img src="../img/zoomloader.gif" id="loader_auth">') .
        '</div>' .
        '<div class="auth-pechkin-true '.$cssPechkinTrue.'"><img src="../../../admpanel/icon/information.gif" id="inf-pechkin"> �� ����� ��� <b>'.$LoginPechkin.'</b><br>' .
        $PHPShopGUI->setInput("button","exit","�����",false,70,"exitPechkin()","but","actionStart", false ,'<img src="../img/zoomloader.gif" id="loader_auth">') .
        '</div>'
    ,false,false,'10' );

    $Tab1.='<div class="reg-pechkin '.$cssPechkinReg.'">'.
        $PHPShopGUI->setField('����������� �� ������� <u>Pechkin-Mail</u>',
        $PHPShopGUI->setInput("button","auth","�����������",false,150,"miniWin(' https://web.pechkin-mail.ru/common/auth_new.php?registration&email=".$adminmail."&username=".$adminmail."&integration=phpshop', 970, 500);","but","actionStart") .
        $PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16, false, false, 'float:left; margin:4px 0 -1px 4px;vertical-align: bottom;padding-right: 3px;') .
                    __('<div class="reg">����� �������, ��� �� ����� <b>'.$adminmail.'</b> ����� ����������<br> ������ � ����������� �� ��������� ������� ������.</div>')
    ,false,false,'10', array('margin-top' => '10px' ) );
    $Tab1.= '</div>';
    
    // ���������� �������� 2
    $Tab2=$PHPShopGUI->setPay('� ������',false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("�����������",$Tab1,270), array("� ������",$Tab2,270));

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


