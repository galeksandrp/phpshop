<?php
$_classPath = "../";
require("connect.php");
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("admgui");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("xml");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("parser");
PHPShopObj::loadClass("mail");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
$PHPShopInterface = new PHPShopInterface();
$PHPShopInterface->winOpenType = $PHPShopSystem->getSerilizeParam("admoption.wintype");
$PHPShopIcon = new PHPShopIcon();

// ��������� �� root
if ($_SESSION['logPHPSHOP'] == "root" and $_SESSION['pasPHPSHOP'] == "cm9vdA==" and !getenv("COMSPEC"))
    $rootNote = "rootNote()";
else
    $rootNote = "";

// ����� �����
function GetFile($dir) {
    if (@$dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $fstat = explode(".", $file);
            if ($fstat[1] == "lic")
                return 'license' . chr(47) . $file;
        }
        closedir($dh);
    }
}

$num = explode(" ", $SysValue['license']['product_name']);
$product_num = str_replace(".", "", trim($num[1]));



// ���� �������� ���. ���������
$GetFile = GetFile("../../license/");
@$License = parse_ini_file("../../" . $GetFile, 1);


if ($License['License']['SupportExpires'] != "No")
    define("EXPIRES", $License['License']['SupportExpires']);
else
    define("EXPIRES", 0);

$GetSystems = GetSystems();
$option = unserialize($GetSystems['admoption']);
$Lang = 'russian';
require("./language/russian/language.php");

function detect_utf($Str) {
    for ($i = 0; $i < strlen($Str); $i++) {
        if (ord($Str[$i]) < 0x80)
            $n = 0;# 0bbbbbbb
        elseif ((ord($Str[$i]) & 0xE0) == 0xC0)
            $n = 1;# 110bbbbb
        elseif ((ord($Str[$i]) & 0xF0) == 0xE0)
            $n = 2;# 1110bbbb
        elseif ((ord($Str[$i]) & 0xF0) == 0xF0)
            $n = 3;# 1111bbbb
        else
            return false;# Does not match any model
        for ($j = 0; $j < $n; $j++) { # n octets that match 10bbbbbb follow ?
            if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}

function utf8_win($s) {
    $out = "";
    $c1 = "";
    $byte2 = false;
    for ($c = 0; $c < strlen($s); $c++) {
        $i = ord($s[$c]);
        if ($i <= 127)
            $out.=$s[$c];
        if ($byte2) {
            $new_c2 = ($c1 & 3) * 64 + ($i & 63);
            $new_c1 = ($c1 >> 2) & 5;
            $new_i = $new_c1 * 256 + $new_c2;
            if ($new_i == 1025) {
                $out_i = 168;
            } else {
                if ($new_i == 1105) {
                    $out_i = 184;
                } else {
                    $out_i = $new_i - 848;
                }
            }
            $out.=chr($out_i);
            $byte2 = false;
        }
        if (($i >> 5) == 6) {
            $c1 = $i;
            $byte2 = true;
        }
    }
    return $out;
}

// ��������� update
if ($option['update_enabled'] == 1)
    $ChekUpdate = "ChekUpdate('false');";

define("PATH", $SysValue['update']['path'] . "update3.php?from=" . $_SERVER['SERVER_NAME'] . "&version=" . $SysValue['upload']['version'] . "&support=" . $License['License']['SupportExpires']);

if ($License['License']['RegisteredTo'] != "Trial NoName" and !getenv("COMSPEC") and function_exists("xml_parser_create") and !$_SESSION['chekUpdate'])
    if (@$db = readDatabase(PATH, "update")) {
        foreach ($db as $k => $v) {
            if ($db[$k]['num'] == $SysValue['upload']['version'] and !empty($db[$k]['name'])) {
                $support_status = $db[$k]['status'];
                @$UpdateContent.="����� ������: " . $SysValue['license']['product_name'] . " " . $db[$k]['name'];
                $_SESSION['readyUpdate'] = true;
                if ($db[$k]['upload_type'] == 'script') {
                    $upload_type = "script";
                    $new_version = $db[$k]['name'];
                    $ftp_host = base64_encode($db[$k]['ftp_host']);
                    $ftp_login = base64_encode($db[$k]['ftp_login']);
                    $ftp_password = base64_encode(strtoupper(substr(md5(date("U")), 0, 6)) . $db[$k]['ftp_password']);
                    $ftp_folder = $db[$k]['os'] . "/" . $db[$k]['num'];
                }
            }
        }
        if (empty($_SESSION['readyUpdate']))
            $_SESSION['chekUpdate'] = true;
    }

// ����������� JS ���� �������
function CreateModulesMenu() {
    global $PHPShopIcon;
    $sql = "select path from " . $GLOBALS['SysValue']['base']['modules'];
    $result = mysql_query($sql);
    $dis_js = null;

    while ($row = mysql_fetch_array($result)) {
        $path = $row['path'];
        $menu = "../modules/" . $path . "/install/module.xml";
        @$data = implode("", file($menu));
        if (@$db = readDatabase($data, "adminmenu", false)) {
            $DIR = "../../modules/" . $path . "/install/";
            $dis_js.='
	  stm_aix("p1i1","p1i0",[0,"' . $db[0]['title'] . '","","",-1,-1,0,"","_self","","","../img/arrow_r.gif","",7,7]);
      stm_bp("p2",[1,2,-1,0,3,3,18,0,100,"",-2,"",-2,100,2,2,MenuTextColor,MenuColor,"",3,1,1,MenuColorActiveBorder]);';

            // JS ����
            $podmenu = readDatabase($data, "podmenu", false);
            foreach ($podmenu as $val)
                @$dis_js.='
stm_aix("p2i0","p1i0",[0,"' . $val['podmenu_name'] . '","","",-1,-1,0,"' . $val['podmenu_action'] . '","_self","","","' . $DIR . $val['podmenu_icon'] . '","' . $DIR . $val['podmenu_icon'] . '",16,16]);
	  ';
            $dis_js.='stm_ep();';

            // ������
            $icon = readDatabase($data, "menu", false);

            if (is_array($icon)) {
                foreach ($icon as $val)
                    $IconTab.= $PHPShopIcon->setIcon("../modules/" . $path . "/install/" . $val['menu_icon'], $val['menu_name'], $val['menu_action']);
            }
        }
    }
    $disp = '
stm_aix("p0i1","p0i0",[1,"' . __('������') . '&nbsp;&nbsp;","","",-1,-1,0,"","_self","","","","",5,20]);
stm_bp("p1",[1,4,-1,0,3,3,16,0,100,"",-2,"",-2,100,2,2,MenuTextColor,MenuColor,"",3,1,1,MenuColorActiveBorder]);
stm_aix("p10i1","p2i0",[0,"' . __('����� ��������� �������') . '","","",-1,-1,0,"javascript:DoReload(\'modules\')","_self","","","plugin.gif","plugin.gif"]);
' . @$dis_js . '
stm_ep();
stm_ep();
';
    if (is_array($icon))
        $IconTab = $PHPShopIcon->setBorder() . $IconTab;
    return array($disp, $IconTab);
}

if(isset($_GET['skinload'])){
    $_SESSION['theme']=null;
}

// ���� ������
if (empty($_SESSION['theme'])) {
    $theme = PHPShopSecurity::TotalClean($PHPShopSystem->getSerilizeParam('admoption.theme'));
    if (!empty($theme))
        $_SESSION['theme'] = $theme;
    else
        $_SESSION['theme'] = 'default';
}
else
    $_SESSION['theme'] = substr(PHPShopSecurity::TotalClean($_SESSION['theme']),0,10);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title><?= $ProductName ?></title>
        <META http-equiv=Content-Type content="text/html; charset=windows-1251">
        <META name="ROBOTS" content="NONE">
        <META name="copyright" content="<?= $RegTo ?>">
        <META name="engine-copyright" content="PHPShop LLC, <?= $ProductName; ?>">
        <LINK href="skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <LINK href="skins/<?= $_SESSION['theme'] ?>/dateselector.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script type="text/javascript" language="JavaScript" src="/phpshop/lib/JsHttpRequest/JsHttpRequest.js"></script>
        <SCRIPT type="text/javascript" language="JavaScript" src="java/popup_lib.js"></SCRIPT>
        <SCRIPT type="text/javascript" language="JavaScript" src="java/dateselector.js"></SCRIPT>
        <script type="text/javascript" language="JavaScript" src="java/javaMG.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript" src="java/stm31.js"></script>
        <script type="text/javascript" language="JavaScript" src="java/sorttable.js"></script>
        <script type="text/javascript" language="JavaScript" src="language/<? echo $Lang; ?>/language_interface.js"></script>
        <script type="text/javascript" language="JavaScript">

            // �������� ������ root
<?= $rootNote; ?>


            // �������� ����������
            function ChekUpdate(flag) {

                // ��������� ��� ������ ��������������� ���������� ������
                var auto_upload_flag = "<?php echo $upload_type ?>";
                var ftp_pars = "<?php echo "?ftp_host=$ftp_host&ftp_folder=$ftp_folder&ftp_login=$ftp_login&ftp_password=$ftp_password&new_version=$new_version" ?>";
                // �����
                var update_message = "<?= $UpdateContent; ?>";
                var version = "<?= $SysValue['upload']['version']; ?>";
                var path = "<?= PATH ?>";
                var soft = "<?= $ProductName . " " . $SysValue['upload']['version'] ?>";
                var pathD = "./update/update.php";
                var expir = "<?= EXPIRES ?>";
                var expirUntil = "<?= dataV(EXPIRES, 'update'); ?>";
                var cookieValue = GetCookie('update');
                var support_status = "<?= $support_status ?>";


                if (support_status == "active") {
                    window.status = "��������, �������� ���������� ���������!";
                    if (!cookieValue | flag == "true")
                        if (confirm("�������� ����������!\n\n������� ������: " + soft + "\n" + update_message + "\n\n���������� ����������?")) {

                            if (support_status != 'passive') {

                                if (auto_upload_flag == "script")
                                    miniWin('upload/adm_upload.php' + ftp_pars, 600, 470);
                                else {
                                    if (confirm("������ ����������� �� ������� PHPShop. �������� �� ���������� � ����. ������� �� ���������� �������?"))
                                        window.open("http://www.phpshop.ru/order/");

                                }
                            }
                            else {
                                if (confirm("������ ����������� ��������� ���������� " + expirUntil + " �.\n\n������ ��������� ����������� ��������� � �������� ����� ���������� ��������� � ������� 1 ����?"))
                                    window.open("http://www.phpshop.ru/docs/techpod.html");

                            }
                        }
                        else
                            SetCookie('update', 2, 5);
                }
                else if (flag == "true")
                    alert("��� " + soft + " ���������� �����������.");
            }


            // �� ���� �����
            window.moveTo(0, 0);
            window.resizeTo(screen.availWidth, screen.availHeight);
            window.status = "<?= $SysValue['Lang']['System']['status'] . " " . $_SESSION['logPHPSHOP'] . " " . $SysValue['Lang']['System']['status2'] . " " . $_SERVER['SERVER_NAME'] ?>";
            //document.onmousedown=mp;
        </script>
    </head>
    <body id="mybody"  topmargin="0" rightmargin="3" leftmargin="3">
        <script>
            // �������� ����� �������
<?
// �������� ����� �������
if ($option['message_enabled'] == 1) {
    if ($option['message_time'] < 30)
        $option['message_time'] = 30;
    echo 'CheckNewOrders(); setInterval("CheckNewOrders()",' . ($option['message_time'] * 1000) . ');';
}


// ���� ������������� �������� 7 ����
$LicenseUntilUnixTime = $License['License']['Expires'];
$until = $LicenseUntilUnixTime - date("U");
$until_day = $until / (24 * 60 * 60);
if (is_numeric($LicenseUntilUnixTime))
    if ($until_day < 8 and $until_day > 0) {
        $warning_mes = $SysValue['Lang']['System']['license'];
        echo 'setInterval("initializemessage(\'licensewindow\')",' . ($option['message_time'] * 1000) . ');';
        mailNotice('license', $until_day);
    }


// ���� ������������� ��������� 7 ����
if (empty($warning_mes)) {
    $TechPodUntilUnixTime = $License['License']['SupportExpires'];
    if (is_numeric($TechPodUntilUnixTime))
        $until = $TechPodUntilUnixTime - date("U");
    $until_day = $until / (24 * 60 * 60);
    if (is_numeric($TechPodUntilUnixTime))
        if ($until_day < 8 and $until_day > 0) {
            $warning_mes = $SysValue['Lang']['System']['techpod'];
            if ($option['message_enabled'] == 1)
                echo 'setInterval("initializemessage(\'supportwindow\')",' . ($option['message_time'] * 1000) . ');';
            mailNotice('support', $until_day);
        }
}

// ���������� ������������ �� �����
function mailNotice($type, $until_day) {
    global $PHPShopSystem, $option;

    if (!empty($option[$type . '_notice']))
        return true;

    PHPShopParser::set('url', $_SERVER['SERVER_NAME']);
    PHPShopParser::set('day', abs(round($until_day)));
    switch ($type) {
        case "license":

            $userContent = PHPShopParser::file("system/mail_notice/notice_license.htm", true, false);
            new PHPShopMail($PHPShopSystem->getParam('adminmail2'), $PHPShopSystem->getParam('adminmail2'), '������������� �������� ��� ����� ' . $_SERVER['SERVER_NAME'], $userContent, "text/html");

            break;
        case "support":
            $userContent = PHPShopParser::file("system/mail_notice/notice_support.htm", true, false);
            new PHPShopMail($PHPShopSystem->getParam('adminmail2'), $PHPShopSystem->getParam('adminmail2'), '������������� ����������� ��������� ��� ����� ' . $_SERVER['SERVER_NAME'], $userContent, "text/html");

            break;
    }
    $option[$type . '_notice'] = true;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['system']);
    $PHPShopOrm->update(array('admoption_new' => serialize($option)));
}

// ��� ������
$DomenLocked = $License['License']['DomenLocked'];
if (empty($DomenLocked))
    $DomenLocked = $_SERVER['SERVER_NAME'];
?>
        </script>

        <span class="message" id="supportwindow">
            <form method="post" target="_blank" enctype="multipart/form-data" action="http://www.phpshop.ru/order.html"  id="product_support" style="display:none">
                <input type="hidden" value="supportenterprise" name="addToCartFromPages" id="addToCartFromPages">             
                <input type="hidden" value="<?= $DomenLocked ?>" name="addToCartFromPagesDomen" id="addToCartFromPagesDomen">
            </form>
            <table width="100%" height="100%">
                <tr>
                    <td width="35" vAlign=center>
                        <img src="img/i_crontab_med[1].gif" alt="" width="32" height="32" border="0" align="absmiddle">
                    </td>
                    <td><b><?= $SysValue['Lang']['System']['cart1'] ?></b><br><?= $warning_mes . " <strong>" . round($until_day) . "</strong> ��." ?>
                        <p><BUTTON style="width: 200px;" title="���������� ����������� ���������"  onclick="DoUpgrade('product_support');
                return false;">������ ����������� ���������</BUTTON></p>
                    </td>
                </tr>
            </table>
        </span>
        <span class="message" id="licensewindow">
            <form method="post" target="_blank" enctype="multipart/form-data" action="http://www.phpshop.ru/order.html"  id="product_license" style="display:none">
                <input type="hidden" value="scriptenterprise" name="addToCartFromPages" id="addToCartFromPages">             
                <input type="hidden" value="<?= $DomenLocked ?>" name="addToCartFromPagesDomen" id="addToCartFromPagesDomen">
            </form>
            <table width="100%" height="100%">
                <tr>
                    <td width="35" vAlign=center>
                        <img src="img/i_crontab_med[1].gif" alt="" width="32" height="32" border="0" align="absmiddle">
                    </td>
                    <td><b><?= $SysValue['Lang']['System']['cart1'] ?></b><br><?= $warning_mes . " <strong>" . round($until_day) . "</strong> ��." ?>
                        <p><BUTTON style="width: 200px;" title="���������� ����������� ���������"  onclick="DoUpgrade('product_license');
                return false;">������ ����������� ��������</BUTTON></p>
                    </td>
                </tr>
            </table>
        </span>
        <div id="lock"></div>
        <table width="100%" cellpadding="0" cellspacing="3" class="iconpane">
            <tr>
                <td>
                    <script type="text/javascript" language="JavaScript1.2" src="skins/<?= $_SESSION['theme'] ?>/menu.js"></script>

                    <script>
            // �������� ����
<?
include('java/menu.js');
?>

            // ������
<?
$CreateModulesMenu = CreateModulesMenu();
echo $CreateModulesMenu[0];
?>


            // ���������� ����
            stm_aix("p0i7", "p0i0", [0, "����������"], 80, 20);
            stm_bpx("p13", "p1", []);
            stm_aix("p13i0", "p1i0", [0, "��������� ������� ����������", "", "", -1, -1, 0, "javascript:ChekUpdate('true')", "_self", "", "", "wand.gif", "wand.gif"]);
            stm_aix("p13i0", "p1i0", [0, "��������� ����� ����������", "", "", -1, -1, 0, "javascript:miniWin('upload/adm_backup.php',600,430)", "_self", "", "", "wand.gif", "wand.gif"]);
            stm_ep();
            stm_aix("p0i7", "p0i0", [0, "��������� ������"], 110, 20);
            stm_bpx("p13", "p1", []);
            stm_aix("p13i0", "p1i0", [0, "������� ��������� ������", "", "", -1, -1, 0, "javascript:miniWin('flipcat/adm_flipcat.php',500,350)", "_self", "", "", "add.png", "add.png"]);
            stm_ep();
            stm_aix("p0i7", "p0i0", [0, "�������"], 60, 20);
            stm_bpx("p12", "p1", []);
            stm_aix("p12i0", "p1i0", [0, "����������� ���������", "", "", -1, -1, 0, "http://help.phpshop.ru/", "_blank", "", "", "question_frame.png", "question_frame.png"]);
            stm_aix("p12i2", "p1i0", [0, "�������", "", "", -1, -1, 0, "http://faq.phpshop.ru", "_blank", "", "", "book.gif", "book.gif"]);
            stm_aix("p12i3", "p1i0", [0, "�������", "", "", -1, -1, 0, "http://www.phpshop.ru/news/", "_blank", "", "", "book_next.gif", "book_next.gif"]);
            stm_aix("p12i4", "p1i0", [0, "���������� Easy Control", "", "", -1, -1, 0, "http://www.phpshop.ru/loads/files/setup.exe", "_blank", "", "", "plugin.gif", "plugin.gif"]);
            stm_aix("p12i5", "p1i0", [0, "���������� Order Agent Mobil", "", "", -1, -1, 0, "http://www.phpshop.ru/page/downloads.html", "_blank", "", "", "plugin_blue.gif", "plugin_blue.gif"]);
            stm_aix("p12i6", "p1i0", [0, "���������� Order Gadget", "", "", -1, -1, 0, "http://www.phpshop.ru/page/downloads.html", "_blank", "", "", "plugin_red.gif", "plugin_red.gif"]);
            stm_aix("p12i7", "p1i0", [0, "���������� ���������� 1�:�����������", "", "", -1, -1, 0, "http://www.phpshop.ru/page/pro1c.html#6", "_blank", "", "", "1c_icon.gif", "1c_icon.gif"]);
            stm_aix("p12i8", "p1i0", [0, "� ���������", "", "", -1, -1, 0, "javascript:miniWin('window/adm_about.php',670,500)", "_self", "", "", "image.gif", "image.gif"]);
            stm_aix("p12i9", "p1i0", [0, "�����", "", "", -1, -1, 0, "javascript:window.close()", "_self", "", "", "door.gif", "door.gif"]);
            stm_aix("p12i10", "p1i0", [0, "�������", "", "", -1, -1, 0, "../../", "_blank", "", "", "house.gif", "house.gif"]);
            stm_ep();
            stm_ep();
            stm_em();


                    </script>
                </td>
                <td align="right" id="phpshop">
                    <a href="http://www.phpshop.ru" target="_blank" class="phpshop" title="��� ����� �������� � ��� ������">
                        <?= $ProductNameVersion ?></a>
                </td>

            </tr>
        </table>
        <table width="100%" cellpadding="0" cellspacing="1" class="iconpane border-both">
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td id="but0"  class="butoff"><img name="iconLang" src="icon/folder_images.gif" alt="�������" title="�������" width="16" height="16" border="0" onmouseover="ButOn(0)" onmouseout="ButOff(0)" onclick="DoReload('cat_prod')" ></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator"></td>
                            <td width="3"></td>
                            <td id="but3"  class="butoff"><img name="iconLang" src="icon/creditcards.gif" alt="������" title="������" width="16" height="16" border="0" onmouseover="ButOn(3)" onmouseout="ButOff(3)" onclick="DoReload('orders')"></td>
                            <td width="3"></td>
                            <td id="but18"  class="butoff"><img name="iconLang" src="icon/chart_bar.gif" alt="������" title="������"  width="16" height="16" border="0" onmouseover="ButOn(18)" onmouseout="ButOff(18)" onclick="DoReload('orders_stat1')"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator" ></td>
                            <td width="3"></td>
                            <td id="but4"  class="butoff"><img name="iconLang" src="icon/page_code.gif" alt="�������� ������" title="�������� ������" width="16" height="16" border="0" onmouseover="ButOn(4)" onmouseout="ButOff(4)" onclick="DoReload('csv')"></td>
                            <td width="3"></td>
                            <td id="but104"  class="butoff"><img name="iconLang" src="icon/1c_icon.gif" alt="�������� 1C:�����������" title="�������� 1C:�����������"  width="16" height="16" border="0" onmouseover="ButOn(104)" onmouseout="ButOff(104)" onclick="DoReload('csv1c')"></td>
                            <td width="3"></td>
                            <td id="but5"  class="butoff"><img name="iconLang" src="icon/page_save.gif" alt="�������� ������" title="�������� ������" width="16" height="16" border="0" onmouseover="ButOn(5)" onmouseout="ButOff(5)" onclick="miniWin('export/adm_csv.php?IDS=all', 300, 300)"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" class="separator"></td>
                            <td width="3"></td>
                            <td id="but6"  class="butoff"><img name="iconLang" src="icon/joystick.gif" alt="��������� ���������" title="��������� ���������" width="16" height="16" border="0" onmouseover="ButOn(6)" onmouseout="ButOff(6)" onclick="miniWin('system/adm_system.php', 600, 450)"></td>
                            <td width="3"></td>
                            <td id="butxhtml"  class="butoff"><img name="iconLang" src="icon/xhtml.gif" alt="Keywords & Titles" title="Keywords & Titles"  width="16" height="16" border="0" onmouseover="ButOn('xhtml')" onmouseout="ButOff('xhtml')" onclick="miniWin('system/adm_system_promo.php', 650, 630)"></td>
                            <td width="3"></td>
                            <td id="but7"  class="butoff"><img name="iconLang" src="icon/telephone.gif" alt="���������" title="���������" width="16" height="16" border="0" onmouseover="ButOn(7)" onmouseout="ButOff(7)" onclick="miniWin('system/adm_system_recvizit.php', 500, 500)"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator"></td>
                            <td width="3"></td>
                            <td id="but8"  class="butoff"><img name="iconLang" src="icon/page.gif" alt="��������" title="��������" width="16" height="16" border="0" onmouseover="ButOn(8)" onmouseout="ButOff(8)" onclick="DoReload('page')"></td>
                            <td width="3"></td>
                            <td id="but9"  class="butoff"><img name="iconLang" src="icon/page_lightning.gif" alt="�������" title="�������" width="16" height="16" border="0" onmouseover="ButOn(9)" onmouseout="ButOff(9)" onclick="DoReload('news')"></td>
                            <td width="3"></td>
                            <td id="but10"  class="butoff"><img name="iconLang" src="icon/page_refresh.gif" alt="�������" title="�������" width="16" height="16" border="0" onmouseover="ButOn(10)" onmouseout="ButOff(10)" onclick="DoReload('banner')"></td>
                            <td width="3"></td>
                            <td id="but11"  class="butoff"><img name="iconLang" src="icon/page_attach.gif" alt="��������� �����" title="��������� �����"  width="16" height="16" border="0" onmouseover="ButOn(11)" onmouseout="ButOff(11)" onclick="DoReload('menu')"></td>
                            <td width="3"></td>
                            <td id="but12"  class="butoff"><img name="iconLang" src="icon/page_error.gif" alt="������" width="16"  title="������" height="16" border="0" onmouseover="ButOn(12)" onmouseout="ButOff(12)" onclick="DoReload('gbook')"></td>
                            <td width="3"></td>
                            <td id="but14"  class="butoff"><img name="iconLang" src="icon/page_link.gif" alt="������" width="16" title="������"  height="16" border="0" onmouseover="ButOn(14)" onmouseout="ButOff(14)" onclick="DoReload('links')"></td>
                            <td width="3"></td>
                            <td id="but21"  class="butoff"><img name="iconLang" src="icon/page_edit.gif" alt="������" title="������" width="16" height="16" border="0" onmouseover="ButOn(21)" onmouseout="ButOff(21)" onclick="DoReload('opros')"></td>
                            <td width="3"></td>
                            <td id="but45"  class="butoff"><img name="iconLang" src="icon/page_key.gif" alt="�����������" title="�����������" width="16" height="16" border="0" onmouseover="ButOn(45)" onmouseout="ButOff(45)" onclick="DoReload('comment')"></td>
                            <td width="3"></td>
                            <td id="but60"  class="butoff"><img name="iconLang" src="icon/page_rating.gif" alt="��������"  title="��������" width="16" height="16" border="0" onmouseover="ButOn(60)" onmouseout="ButOff(60)" onclick="DoReload('rating')"></td>
                            <td width="3"></td>
                            <td id="but65"  class="butoff"><img name="iconLang" src="icon/plugin.gif" alt="������"  title="������" width="16" height="16" border="0" onmouseover="ButOn(65)" onmouseout="ButOff(65)" onclick="DoReload('modules')"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator"></td>
                            <td width="3"></td>
                            <td id="but41"  class="butoff"><img name="iconLang" src="icon/group.gif" alt="������������" title="������������" width="16" height="16" border="0" onmouseover="ButOn(41)" onmouseout="ButOff(41)" onclick="DoReload('shopusers')"></td>
                            <td width="3"></td>
                            <td id="but42"  class="butoff"><img name="iconLang" src="icon/user.gif" alt="��������������"  title="��������������" width="16" height="16" border="0" onmouseover="ButOn(42)" onmouseout="ButOff(42)" onclick="DoReload('users')"></td>
                            <td width="3"></td>
                            <td id="but43"  class="butoff"><img name="iconLang" src="icon/vcard.gif" alt="������ �����������" title="������ �����������" width="16" height="16" border="0" onmouseover="ButOn(43)" onmouseout="ButOff(43)" onclick="DoReload('users_jurnal')"></td>
                            <td width="3"></td>
                            <td id="but44"  class="butoff"><img name="iconLang" src="icon/page_find.gif" alt="������ ������" title="������ ������"  width="16" height="16" border="0" onmouseover="ButOn(44)" onmouseout="ButOff(44)" onclick="DoReload('search_jurnal')"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator"></td>
                            <td width="3"></td>
                            <td id="but15"  class="butoff"><img name="iconLang" src="icon/database_key.gif" alt="SQL" title="SQL" width="16" height="16" border="0" onmouseover="ButOn(15)" onmouseout="ButOff(15)" onclick="miniWin('sql/adm_sql.php', 500, 400)"></td>
                            <td width="3"></td>
                            <td id="but22"  class="butoff"><img name="iconLang" src="icon/database_save.gif" alt="�������� �������� �����" title="�������� �������� �����" width="16" height="16" border="0" onmouseover="ButOn(22)" onmouseout="ButOff(22)" onclick="miniWin('dumper/dumper.php', 500, 430)"></td>
                            <td width="3"></td>
                            <td width="1" bgcolor="#ffffff"></td>
                            <td width="1" bgcolor="#808080" class="separator"></td>
                            <? if ($SysValue['cnstats']['enabled'] == "true") { ?>
                                <td width="3"></td>
                                <td id="but40"  class="butoff"><img name="iconLang" src="icon/chart_curve.gif" alt="����������" title="����������" width="16" height="16" border="0" onmouseover="ButOn(40)" onmouseout="ButOff(40)" onclick="window.open('/cnstats/')"></td>
                            <? } ?>
                            <td width="3"></td>
                            <td id="but17"  class="butoff"><img name="iconLang" src="icon/house.gif" alt="�������" title="�������" width="16" height="16" border="0" onmouseover="ButOn(17)" onmouseout="ButOff(17)" onclick="window.open('../../')"></td>
                            <td width="3"></td>
                            <td id="but16"  class="butoff"><img name="iconLang" src="icon/door.gif" alt="�����" title="�����" width="16" height="16" border="0" onmouseover="ButOn(16)" onmouseout="ButOff(16)" onclick="onExit()"></td>
                            <td width="3"></td>
                            <? if ($support_status == "active" and $option['update_enabled'] == 1) { ?>
                                <td id="but100"  class="butoff"><img name="iconLang" src="icon/update.gif" alt="�������� ����������"  title="�������� ����������" width="16" height="16" border="0" onmouseover="ButOn(100)" onmouseout="ButOff(100)" onclick="ChekUpdate('true');"></td>
                                <td width="3"></td>
                            <? } ?>
                        </tr>
                    </table>
                </td>
                <td style="padding-right:5px" align="right">
                    <span class="display" onclick="DoReload('orders')" title="������">����� �������: <b id="new_order">0</b></span>
                    <span class="display" onclick="DoReload('shopusers_messages')" title="���������">����� ���������: <b id="new_message">0</b></span>
                    <span class="display" onclick="DoReload('comment')" title="�����������">����� ������������: <b id="new_comment">0</b></span>
                </td>
            </tr>
        </table>
        <?
// Fix bug FF
        if (empty($_GET['page']))
            $_GET['page'] = 'orders';


// ��������� ������� CMS Free c ��������� ����������  $_SERVER['QUERY_STRING'] � ���������� $_GET['var2']
        if (!empty($_GET['plugin'])) {
            $_GET['page'] = 'modules';
            $_GET['var1'] = $_GET['plugin'];

            if (empty($_GET['var2'])) {
                parse_str($_SERVER['QUERY_STRING'], $cms_var_array);

                if (count($cms_var_array) > 4)
                    $_GET['var2'] = base64_encode($_SERVER['QUERY_STRING']);
            }
        }
        ?>

        <div align="center" id="interfaces" name="interfaces">
            <script>
            setTimeout("DoReload('<?= $_GET['page'] ?>','<?= $_GET['var1'] ?>','<?= $_GET['var2'] ?>')", 500);
            </script>
        </div>
        <div id="CSCHint"></div>
    </body>
</html>
