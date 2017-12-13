<?php
session_start();
$_classPath = "../";
require("connect.php");
include($_classPath . "class/obj.class.php");
require_once $_classPath.'/lib/phpass/passwordhash.php';
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("xml");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("admgui");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// ���� ������
$theme = PHPShopSecurity::TotalClean($PHPShopSystem->getSerilizeParam('admoption.theme'), 2);
if (!empty($theme))
    $_SESSION['theme'] = $theme;
else
    $_SESSION['theme'] = 'default';

// ��������� ������
function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}

// ����� ������� ���������������� �����
function GetTheme($return = false) {
    $i = 1;
    $name = null;
    $theme_id = array();

    $skin = $_SESSION['theme'];

    $dir = "./skins";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                if ($skin == $file)
                    $sel = "selected";
                else
                    $sel = "";

                if ($file != "." and $file != ".." and $file != "index.html") {
                    $name.= "<option value=\"$i\" $sel>$file</option>";
                    $theme_id[$i] = PHPShopSecurity::TotalClean($file);
                    $i++;
                }
            }
            closedir($dh);
        }
    }


    if (empty($return)) {
        $name = "<select name=\"theme_id\">" . $name . "</select>";
        return $name;
    }
    else
        return $theme_id;
}


$SendMailStatus = null;

function CheckBlackList($n) {
    global $SysValue;
    $sql = "select * from " . $SysValue['base']['table_name22'] . " where ip='" . substr($n, 0, 12) . "'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

// �������� �����
require("./language/russian/language.php");


if ($_GET['do'] == "out") {
    session_destroy();
    //setcookie("PHPSESSID", "", (time() - 1000), "/phpshop/admpanel/", $_SERVER['SERVER_NAME'], 0);
    header('Location: ../../');
}

// �������� ������
if ($SysValue['geoip']['geoip'] == "true")
    if ($_SERVER["SERVER_ADDR"] != "127.0.0.1") {
        include("geoip/geoip.inc");

        $FlagProxy = 1;
        $gi = geoip_open("geoip/GeoIP.dat", GEOIP_STANDARD);
        $PROXY = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
        $MyPROXY = explode(",", $SysValue['geoip']['geoip_zone']);

        foreach ($MyPROXY as $value)
            if ($PROXY == $value)
                $FlagProxy = 0;

        $MyList = CheckBlackList($_SERVER['REMOTE_ADDR']);
        if ($MyList > 0)
            $FlagProxy = 1;
    }

if ($FlagProxy == 1) {
    header("Location: /?status=lock&ip=" . $_SERVER['REMOTE_ADDR'] . "&proxy=$PROXY");
    exit("������������� ��� " . $_SERVER['REMOTE_ADDR']);
}


if (isset($_POST['pas_to_mail']) and strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME'])) {
    $log = htmlspecialchars(addslashes($_POST['log']));
    if (!PHPShopSecurity::true_login($log))
        $log = null;
    $sql = "select password,mail,id from $table_name19 where login='" . $log . "'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $OLDpassword = $row['password'];
        $OLDmail = $row['mail'];
        $id = $row['id'];
    }

    $hash = md5($id . $log . $OLDmail . $OLDpassword . time());

    mysql_query("UPDATE $table_name19 SET hash = '$hash' WHERE id=$id");

    if (!empty($OLDmail)) {
        $content = "
������� �������!
---------------

��������� $log, �� ��������� ���������� ������  
� ������ ����������������� PHPShop �� ����� " . $_SERVER['SERVER_NAME'] . "

���� ������
---------------
������������: $log
��� �������������� ������ ��������� �� ������: http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/?newPassGen=" . $hash . "
����: " . date("d-m-y H:s a") . "
IP �����������:" . $_SERVER['REMOTE_ADDR'] . "

---------------
� ���������,
�������� PHPShop
http://www.phpshop.ru";

        $codepage = "windows-1251";
        $header = "MIME-Version: 1.0\n";
        $header .= "From: \"robot@" . preg_replace("/www.\//i", "//", $_SERVER['SERVER_NAME']) . "\" <\"MAIL PHPSHOP\">\n";
        $header .= "Content-Type: text/plain; charset=$codepage\n";
        $header .= "X-Mailer: PHP/";
        $zag = "������ � ������ ����������������� PHPShop";

        // ��������� ��������������
        mail($OLDmail, $zag, $content, $header);
        $SendMailStatus = "
<div class='display' style='height:auto;'>������ � ������������ ������� �� <br><b>" . $OLDmail . "</b></div>";
    }
} elseif (isset($_GET['newPassGen'])) {
    $hash = mysql_real_escape_string(stripslashes($_GET['newPassGen']));
    $sql = "select password,mail,id,login from $table_name19 where hash='" . $hash . "'";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $OLDpassword = $row['password'];
        $OLDmail = $row['mail'];
        $id = $row['id'];
        $log = $row['login'];
    }
    if (!empty($OLDmail)) {

        // ���������� ����� ������ ��� ��������������
        $newPass = generatePassword();
        // �������� ����� ������ � ��������� � ��
        $hasher = new PasswordHash(8, false);
        $hash = $hasher->HashPassword($newPass);

        mysql_query("UPDATE $table_name19 SET password = '$hash', hash='' WHERE id=$id");

        $content = "
������� �������!
---------------

��������� $log, ��� ������������ ����� ������ ������� 
� ������ ����������������� PHPShop �� ����� " . $_SERVER['SERVER_NAME'] . "

���� ������
---------------
������ �����������������: http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/
������������: $log
������: " . $newPass . "
����: " . date("d-m-y H:s a") . "
IP �����������:" . $_SERVER['REMOTE_ADDR'] . "

---------------
� ���������,
�������� PHPShop
http://www.phpshop.ru";

        $codepage = "windows-1251";
        $header = "MIME-Version: 1.0\n";
        $header .= "From: \"robot@" . preg_replace("/www.\//i", "//", $_SERVER['SERVER_NAME']) . "\" <\"MAIL PHPSHOP\">\n";
        $header .= "Content-Type: text/plain; charset=$codepage\n";
        $header .= "X-Mailer: PHP/";
        $zag = "������ � ������ ����������������� PHPShop";

        // ��������� ��������������
        mail($OLDmail, $zag, $content, $header);
        $SendMailStatus = "
<div class='display'>������ ������ �� <b>" . $OLDmail . "</b></div>";
    }
} elseif (isset($_POST['enter']) and strpos($_SERVER["HTTP_REFERER"], $_SERVER['SERVER_NAME'])) {
    $sql = "select * from $table_name19 where enabled='1'";
    $result = mysql_query($sql);
    $pas = $_POST['pas'];
    $hasher = new PasswordHash(8, false);
    while (@$row = mysql_fetch_array($result)) {
        // Check that the password is correct, returns a boolean
        $check = $hasher->CheckPassword($pas, $row['password']);
        if ($row['login'] == $_POST['log'] and $check) {
            $logPHPSHOP = $log;
            $pasPHPSHOP = $pas;
            $idPHPSHOP = $row['id'];
            session_start();

            // ���������������� ������
            $_SESSION['logPHPSHOP'] = $logPHPSHOP;
            $_SESSION['pasPHPSHOP'] = $pasPHPSHOP;
            $_SESSION['idPHPSHOP'] = $idPHPSHOP;

            // ����
            $theme = GetTheme(true);
            $_SESSION['theme'] = $theme[$_POST['theme_id']];

            // ������ � ������ �����������
            $sql = "INSERT INTO " . $SysValue['base']['table_name10'] . "
VALUES ('','$logPHPSHOP','" . date("U") . "','0','" . $_SERVER['REMOTE_ADDR'] . "')";
            $result = mysql_query($sql);


            if (isset($_POST['log']) and isset($pas))
                $_id = session_id();
            setcookie("win_e", $_POST['win_e'], time() + 60 * 60 * 24 * 30, "/phpshop/admpanel/", $_SERVER['SERVER_NAME'], 0);
            $_Path = '
function WO(){
var URL = "admin.php";
var win_e=' . $_POST['win_e'] . '-0;
if(win_e != 1){
if(!window.open(URL,"admin' . $_id . '","toolbar=0; location=0; menubar=0; status=1; directories=0; resizable=1;")){
if(confirm("��������!\n� ����� �������� "+navigator.appName+" ��������� ����������� ����.\n��� ��������� << ' . $ProductName . ' - ������ ���������� >>\n��������� ��������� ����������� ����.\n\n���������� ������ � ������������ ������������ ������? "))
window.location.replace(URL);
}}
else{ window.location.replace(URL);}
}
tmr = setTimeout("WO();",100);
';
        }
    }
    if (empty($logPHPSHOP)) {

        // ������ � ������ �����������
        $sql = "INSERT INTO " . $SysValue['base']['table_name10'] . "
VALUES ('','" . PHPShopSecurity::TotalClean($_POST['log'] . "@" . $_POST['pas']) . "','" . date("U") . "','1','" . PHPShopSecurity::TotalClean($_SERVER['REMOTE_ADDR']) . "')";
        $result = mysql_query($sql);
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title><?= $SysValue['Lang']['Title']['index'] . " -> " . $ProductNameVersion ?></title>
        <META http-equiv=Content-Type content="text/html; charset=windows-1251">
        <META name="ROBOTS" content="NONE">
        <META name="copyright" content="<?= $RegTo ?>">
        <META name="engine-copyright" content="PHPShop LTD, <?= $ProductName; ?>">
        <LINK href="skins/<?= $_SESSION['theme']; ?>/texts.css" type="text/css" rel="stylesheet">
        <LINK rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="./favicon.ico" type="image/x-icon">
        <script language="JavaScript">
<?= @$_Path; ?>
        </script>
    </head>
    <body id="autorization">
        <?
        echo "
<table width=\"100%\" height=\"100%\">
<tr>
	<td valign=\"middle\">

<form method=\"post\" action=\"./\">
<table align=\"center\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\" class=\"login\">
<tr align=\"center\" >
<td colspan=3 >
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>���� � ���������������� ������</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������������ � ������</span>.
	</td>
	<td align=\"right\">
	<a href=\"../../\" title=\"�����\"><img src=\"img/i_users_med[1].gif\" border=\"0\" hspace=\"10\"></a>
	</td>
</tr>
</table>
<br>
</td>
</tr>
<tr>
<td align=\"left\" style=\"padding:5px\">
<FIELDSET>
<LEGEND><span name=txtLang id=txtLang>������������</span></LEGEND>
<div style=\"padding:10px\">
<input type=\"text\" name=\"log\" style=\"width:180px\" maxlength=\"20\" value=\"$log\" id=\"log\" tabindex=1>
</div>
</FIELDSET>
</td>
<td rolspan=\"2\" valign=\"top\" style=\"padding:5px;\">
<input type=submit value=OK class=but name=enter style=\"margin-top:9px\" tabindex=3><br>
<input type=button value=����� class=but onclick=\"location.replace('./?do=out')\" style=\"margin-top:10px;\" tabindex=4>
</td>
</tr>
<tr>
<td style=\"padding:5\">
<FIELDSET>
<LEGEND ><span name=txtLang id=txtLang>������</span></LEGEND>
<div style=\"padding:10px\">
<input type=\"password\" name=\"pas\" id=pas style=\"width:180px\" maxlength=\"20\" value=\"\" tabindex=2>
</div>
</FIELDSET>
</td>
</tr>
<tr>
 <td style=\"padding:5px\">";
        if (empty($SendMailStatus)) {
            if (!$_COOKIE['win_e'])
                echo "<input type=checkbox name=win_e value=1 ><span name=txtLang id=txtLang>������� � ������� ����</span><br>";
            else
                echo "<input type=checkbox name=win_e value=1 checked><span name=txtLang id=txtLang>������� � ������� ����</span><br>";
            echo"<input type=checkbox name=pas_to_mail value=1><span name=txtLang id=txtLang>������������ ������</span>";
        }
        else
            echo $SendMailStatus;
        echo "
 </td>
 <td>
 <FIELDSET title='���� ����������' style='padding:5px'>
 " . GetTheme() . "
 </FIELDSET>
 </td>
</tr>
</table>
</form>
</td>
</tr>
</table>";
        ?>
    </body>
</html>