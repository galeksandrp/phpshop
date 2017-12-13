<?

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

PHPShopObj::loadClass("date");

// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.socauth.socauth_system"));

// ����� �����
function GetSkins() {
    global $SysValue;
    $dir = "../../../templates";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." and $file != ".." and $file != "index.html")
                    $mass[] = $file;
            }
            closedir($dh);
        }
    }
    return $mass;
}

// ����� ������ �����
function GetSkinsIcon($skin) {
    global $SysValue;
    $dir = "../../../templates";
    $filename = $dir . '/' . $skin . '/icon/icon.gif';
    if (file_exists($filename))
        $disp = '<img src="' . $filename . '" alt="' . $skin . '" width="150" height="120" border="1" id="icon">';
    else
        $disp='<img src="../../../admpanel/img/icon_non.gif" alt="����������� �� ��������" width="150" height="120" border="1" id="icon">';
    return @$disp;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $upArr['authConfig_new'] = serialize($_POST['authConfig']);
    // ����������� ������ �� ��� �����
        $action = $PHPShopOrm->update($upArr, array('id' => '= 1'));
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ SocAuth";
    $PHPShopGUI->size = "500,500";


// �������
    $data = $PHPShopOrm->select();
    
    $authConfig = unserialize($data['authConfig']);
    $fcCongif = $authConfig['facebook'];
    $twCongif = $authConfig['twitter'];
    
// ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'SocAuth'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

// ������� ������� ��� �����

    $ContentField1 = $PHPShopGUI->setInput("text", "authConfig[facebook][appid]", $fcCongif['appid'], '' , 250, '', '', '', 'App ID');
    $ContentField1 .= $PHPShopGUI->setInput("text", "authConfig[facebook][secret]", $fcCongif['secret'], '' , 250, '', '', '', 'Secret ID');
    
    $ContentField2 = $PHPShopGUI->setInput("text", "authConfig[twitter][key]", $twCongif['key'], '' , 250, '', '', '', 'Consumer key');
    $ContentField2 .= $PHPShopGUI->setInput("text", "authConfig[twitter][secretkey]", $twCongif['secretkey'], '' , 250, '', '', '', 'Consumer secret');


// ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("��������� facebook", $ContentField1);
    $Tab1.=$PHPShopGUI->setField("��������� twitter", $ContentField2);


    $Info = getInstruct();
    $ContentField2 = $PHPShopGUI->setInfo($Info, 200, '95%');
	
	$Tab2.=$PHPShopGUI->setField("���������� �� ���������", $ContentField2);

    $Tab3 = $PHPShopGUI->setPay($serial, false);

// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("����������", $Tab2, 270), array("� ������", $Tab3, 270));

// ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

// ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
    $PHPShopGUI->getAction();
}else
    $UserChek->BadUserFormaWindow();


function getInstruct(){
return '
<h4>��������� �������</h4>
����� �������� ������ �� ����������� ����� ������� � ����� ����������� �� �����, ����� � ������<br><br>
users/users_forma.tpl<br><br>
�������� �����:<br><br>
@facebookAuth@<br><br>
@twitterAuth@
<h4>��������� twitter.com</h4>
- �������������� � ��������<br><br>
- ������� �� ������:<br><br>
<a href="https://dev.twitter.com/apps/new?from=phpshop" target="_blank">https://dev.twitter.com/apps/new</a><br><br>
- ��������� ��� ���� �� ��� ����������, ����� ���� "Callback URL:"<br><br>
- � "Callback URL:" ���������� ������� ������ �������� �� ��� ����:<br><br>
http://<b>��������.��</b>/socauth/twitter/<br><br>
- � ���� "WebSite: *" ����� ������� ����� ������ �����:<br><br>
http://<b>��������.��</b>/
- ����� ���� ��� ��������� ����������, ��������� �������� ��������<br><br>
- ������ ���� ������������� �� ��� ����������<br><br>
- �� �������� �������� ���������� ����� ���������: <br><br>
<b>Consumer key</b><br><br>
<b>Consumer secret</b><br><br>
- ��������� � ���������� ���� ��������� ���������� ��������� � ��������������� ���� 
� ��������� ������ ����������� ����� ��� ���� �� ������� "��������"



<h4>��������� facebook.com</h4>
- �������������� � ��������<br><br>
- ������� �� ������:<br><br>
<a href="http://www.facebook.com/developers/createapp.php?from=phpshop" target="_blank">http://www.facebook.com/developers/createapp.php</a><br><br>
- ������� ���������� (App Name ����� ���� �����)<br><br>
- ��������� ���� �� ������� �������� ���������� ������� �������<br><br>
- � ���� "App Domains" ���������� ������� ��� ����� (���� ���� ����� �� ���������, ����� ��������� ������ ��������), ��������:<br><br>
���� ���� �� test.phpshop-partners.ru, ����� ������� phpshop-partners.ru<br><br>
- ��� ���� ���� ������� �������� ������ �������� ��� ���������, ����� ���� "Site URL"<br><br>
- � ���� "Site URL" ���������� ������� ��������� ����� ������ ������, ��������:<br><br>
http://test.phpshop-partners.ru<br><br>
- �� ���������� ���������� ����� ������<br><br>
<b>App ID</b><br><br>
<b>App Secret</b><br><br>
- ��������� � ���������� ���� ��������� ���������� ��������� � ��������������� ���� 
� ��������� ������ ����������� ����� ��� ���� �� ������� "��������"

';
}
?>


