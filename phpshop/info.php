<?php
session_start();

/**
 * ��������
 * @package PHPShopAjaxElementsDepricated
 */

require_once "./lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// ����������
include("./class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("date");

// ����������� � ��
$PHPShopBase = new PHPShopBase("../phpshop/inc/config.ini");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();


@$fp = fopen("../index.php", "r");
if($fp) {
    $fstat = fstat($fp);
    fclose($fp);
    $FileDate=PHPShopDate::dataV($fstat['mtime']);
}


// ����� �����
function GetFile($dir) {
    global $SysValue;
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            $fstat = explode(".",$file);
            if($fstat[1] == "lic")
                return $SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
}

// ���� �������� ���. ���������
$GetFile=GetFile("../license/");
@$License=parse_ini_file("../".$GetFile,1);

$TechPodUntilUnixTime = $License['License']['SupportExpires'];
if(is_numeric($TechPodUntilUnixTime))
    $TechPodUntil=PHPShopDate::dataV($TechPodUntilUnixTime);
else $TechPodUntil=" - ";

$LicenseUntilUnixTime = $License['License']['Expires'];
if(is_numeric($LicenseUntilUnixTime))
    $LicenseUntil=PHPShopDate::dataV($LicenseUntilUnixTime);
else  $LicenseUntil=" - ";


$Info="PHPShop System Info
---------------------------------------------

������: ".$PHPShopBase->getParam('license.product_name')."
������: ".$PHPShopBase->getParam('upload.version')."
���� ���������: ".$PHPShopBase->getParam('cache.last_modified')."
������: ".$PHPShopSystem->getParam('skin')."
GZIP: ".$PHPShopBase->getParam('my.gzip')."; ������: ".$PHPShopBase->getParam('my.gzip_level')."
�����������: ".$FileDate."
��������� ��������: ".$LicenseUntil."
��������� ���������: ".$TechPodUntil."

---------------------------------------------

��� ����� ��������. 2003-".date("Y")."
Copyright � www.phpshop.ru";

// ��������� ��������� ����� � ���� PHP-�������!
$_RESULT = array(
        "info"     => $Info,
        'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
?>