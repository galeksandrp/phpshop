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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.facebookpage.facebookpage_system"));

// ����� �����
function GetSkins() {
    global $SysValue;
    $dir = "../../../templates";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file != "." and $file != ".." and $file != "index.html" and strpos($file, "acebook_"))
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

    // ����������� ��������� ������
    if (!empty($_POST['skin_new'])) {
        $action = $PHPShopOrm->update($_POST, array('id' => '= 1'));
    }
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ facebookpage";
    $PHPShopGUI->size = "500,500";


// �������
    $data = $PHPShopOrm->select();


// ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Facebookpage'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");


    //////////// ��������� ��������
    $skin_arr = GetSkins();
    $tpl_dir = "../../../templates";
    // ������� ���������� �����
    @chmod($tpl_dir, 0775);
    if (isset($_GET['zip']) and !count($skin_arr)) {
        // ������� ����������� ����� � ������� ��� ��������
        $file = "../install/facebook_templates.zip";
        if (is_file($file)) {
            require '../../../lib/zip/pclzip.lib.php';
            $archive = new PclZip($file);
            if ($archive->extract(PCLZIP_OPT_PATH, $tpl_dir)) {
                $zip_log = 1;
                //unlink($file);
            } else
                $zip_log = 2;
        }
    }
    
    $skin_arr = GetSkins();
    if (!count($skin_arr))
        $skinAlert = '������� ��� facebook ����������� � �������:<br>
            <input type="button" value="����������" name="" id="" style="width:80px;" class="but" onclick="window.location.replace(\'?zip=true\')">';
    if ($zip_log == 1)
        $skinAlert = "������� ��� facebook ������� �����������!";
    if ($zip_log == 2 OR ($zip_log == 1 and !count($skin_arr)))
        $skinAlert = '������ ����������, ���������� ���������� ����� 775 �� ����� /phpshop/templates:<br>
            <input type="button" value="���������" name="" id="" style="width:80px;" class="but" onclick="window.location.replace(\'?zip=true\')">';

    ////////////
// ������� ������� ��� �����
    //�������� ������ ������
    $skin_arr = GetSkins();
    $now_skin = $data[skin];
    if(is_array($skin_arr))
    foreach ($skin_arr as $value) {
        if ($value == $now_skin)
            $select_arr[] = array($value, $value, 'selected');
        else
            $select_arr[] = array($value, $value, false);
    }

    $ContentField1 = '<script>
        // ����� ���������
        function GetSkinIcon_facebook(skin){
            var path="../../../templates/"+skin+"/icon/icon.gif";
            document.getElementById("icon").src=path;
        }
        </script>';
    $ContentField1 .= $PHPShopGUI->setSelect('skin_new', $select_arr, 200, "none", '', 'GetSkinIcon_facebook(this.value)', false, 10);
    $ContentField1 .= GetSkinsIcon($now_skin);

    $Info = getInstruct();
    $ContentField2 = $PHPShopGUI->setInfo($Info, 200, '95%');


// ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("�������� ������ ��� �������� � facebook", $ContentField1);
    $Tab1 .= $skinAlert;
    $Tab2 = $PHPShopGUI->setField("���������", $ContentField2);

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

function getInstruct() {
    return '
    <p>������ Facebook Templates ��������� ���������� �������������� �������-������� ��� ���� ���������� ����.</p>
<p><strong>1.</strong>&nbsp;������������ ��� �������� ���� ������� �� Facebook&nbsp;<a title="www.facebook.com" href="http://www.facebook.com/?from=phpshop">www.facebook.com</a><br><strong>2.</strong>&nbsp;�������� �������� <a title="www.facebook.com/pages/create.php" href="http://www.facebook.com/pages/create.php?from=phpshop">www.facebook.com/pages/create.php</a>. �������� ��� "<span>��������, ����������� ��� �����������"</span>, ����� �������� ���������, ����� �������� �������� � ������� ������ "������ ������".</p>
<p><strong>3.</strong> �������� �������� ��������, ������� "�����".&nbsp;</p>
<p><strong>4.</strong> ��������� ���������� � ��������.</p>
<p><strong>5.</strong> ������ ������� � ������� ������ Facebook ����������&nbsp;<span>&nbsp;"<strong>Static iframe tab</strong>" � ���������� ���. ����� �������� ��������� ���� ��������.</span></p>
<p><span><strong>6.</strong>&nbsp;<span>&nbsp;� ���������� ���������� ����� ��������� url �������������� �������. ��� ����� ������ ����� + /?faceBook=true. ��������, ��� ����� test.ru, ����� ����� ��������� url - test.ru/?faceBook=true.</span></span></p>
<p><span><strong>7.</strong> ������ ����� �������� ����������� �������, �� ������� �� ��� �������. ������� � ��������� ��������, ����������, �������� Static Iframe Tab, �������� ������� � �������� ��������.</span></p>
<p><span><strong>8.</strong> � ���������� �������� �������� �������� ����������� ������� �������� � ��������.&nbsp;</span></p>
<p><span>��������� ������! ��������� - ��� ������� � �������������� ������� ��� Facebook. ����������� ����� ������� ������������ �����, � �� ����� �������� �����.</span></p>
<BR> ��������� ��������� �� �����������:<br>
<a href="http://faq.phpshop.ru/page/facebook-templates.html">http://faq.phpshop.ru/page/facebook-templates.html </a>    ';
}
?>


