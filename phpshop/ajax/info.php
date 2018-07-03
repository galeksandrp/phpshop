<?php

session_start();

/**
 * ��������
 * @package PHPShopAjaxElements
 */
$_classPath = "../";

// ���������� ���������� ��������� JsHttpRequest
if ($_REQUEST['type'] != 'json') {
    require_once $_classPath . "/lib/Subsys/JsHttpRequest/Php.php";
    $JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");
}


// ����������
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("security");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

@$fp = fopen("../../index.php", "r");
if ($fp) {
    $fstat = fstat($fp);
    fclose($fp);
    $FileDate = PHPShopDate::dataV($fstat['mtime']);
}

// ����� �����
function GetFile($dir) {
    global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $fstat = explode(".", $file);
            if ($fstat[1] == "lic")
                return $file;
        }
        closedir($dh);
    }
}

// ���� �������� ���. ���������
$GetFile = GetFile("../../license/");
@$License = parse_ini_file("../../license/" . $GetFile, 1);

$TechPodUntilUnixTime = $License['License']['SupportExpires'];
if (is_numeric($TechPodUntilUnixTime))
    $TechPodUntil = PHPShopDate::dataV($TechPodUntilUnixTime);
else
    $TechPodUntil = " - ";

$LicenseUntilUnixTime = $License['License']['Expires'];
if (is_numeric($LicenseUntilUnixTime))
    $LicenseUntil = PHPShopDate::dataV($LicenseUntilUnixTime);
else
    $LicenseUntil = " - ";

if ($License['License']['Pro'] == 'Start') {
    $product_name = 'Start';
} else {
    if ($License['License']['Pro'] == 'Enabled')
        $product_name = 'Pro 1C';
    else
        $product_name = 'Enterprise';
}

if (PHPShopSecurity::true_skin($_COOKIE['bootstrap_theme']))
    $theme = ' + ' . $_COOKIE['bootstrap_theme'] . '.css';
else
    $theme = null;


$version = null;
foreach (str_split($GLOBALS['SysValue']['upload']['version']) as $w)
    $version.=$w . '.';

$Info = "���������� � ���������
---------------------------------------------

������: " . $product_name . "
������: " . substr($version, 0, strlen($version)-1). "
������: " . $PHPShopSystem->getParam('skin') . " " . $theme . "
�����������: " . $FileDate . "
��������� ��������: " . $LicenseUntil . "
��������� ���������: " . $TechPodUntil . "

---------------------------------------------

Copyright � PHPShop�, 2004-" . date("Y") . ". 
��� ����� ��������  ��� \"������\"";

// ��������� ��������� ����� � ���� PHP-�������!
$_RESULT = array(
    "info" => $Info,
    'success' => 1
);

// JSON 
if ($_REQUEST['type'] == 'json') {
    $_RESULT['info'] = PHPShopString::win_utf8($_RESULT['info']);
    echo json_encode($_RESULT);
}
?>