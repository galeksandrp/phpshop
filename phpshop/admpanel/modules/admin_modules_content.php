<?php
$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("xml");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopInterface = new PHPShopInterface();

// ���������� �� ������
function GetModuleInfo($name) {
    $path = "../../modules/" . $name . "/install/module.xml";
    if (function_exists("xml_parser_create")) {
        if (@$db = readDatabase($path, "module"))
            return $db[0];
    }
}

function ChekInstallModule($path) {
    $return = array();
    $sql = 'SELECT a.*, b.key FROM ' . $GLOBALS['SysValue']['base']['modules'] . ' AS a LEFT OUTER JOIN ' . $GLOBALS['SysValue']['base']['modules_key'] . ' AS b ON a.path = b.path where a.path="' . $path . '"';

    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    if (mysql_num_rows($result) > 0) {
        $return[0] = "#C0D2EC";
        $return[1] = "
<BUTTON style=\"width: 10em; height: 2.2em; margin-left:5\"  onclick=\"DoUpdateModules('off','$path','" . $_GET['pid'] . "');return false;\">
<img src=\"../img/icon-deactivate.gif\" border=\"0\" align=\"absmiddle\">
���������
</BUTTON>
                ";

        $return[2] = $row['date'];
        $return[3] = $row['key'];
    } else {

        $return[0] = "white";
        $return[1] = "
<BUTTON style=\"width: 10em; height: 2.2em; margin-left:5\"  onclick=\"DoUpdateModules('on','$path','" . $_GET['pid'] . "');return false;\">
<img src=\"../img/icon-activate.gif\"  border=\"0\" align=\"absmiddle\">
����������
</BUTTON>
                ";
        $return[2] = null;
        $return[3] = $row['key'];
    }
    return $return;
}

function actionStart() {
    global $PHPShopInterface, $UserStatus;
    $PHPShopInterface->razmer = "height:100%";
    $PHPShopInterface->imgPath = '../img/';

    $PHPShopInterface->setCaption(array("����������", "10%"), array("��������", "20%"), array("��������", "50%"), array("�����������", "15%"));

    $path = "../../modules/";
    $i = 1;

    if (isset($_GET['install'])) {

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['modules']);
        $data = $PHPShopOrm->select(array('*'), false, array('order' => 'date desc'), array('limit' => 100));
        if (is_array($data))
            foreach ($data as $row) {
                $ChekInstallModule = ChekInstallModule($row['path']);

                // ���������� �� ������
                $Info = GetModuleInfo($row['path']);

                $ModuleHomePage = '<img src="' . $path . $row['path'] . '/install/' . $Info['icon'] . '" align="absmiddle">
<a href="http://wiki.phpshop.ru/index.php/Modules#' . str_replace(' ', '_', $Info['name']) . '" target="_blank" title="�������� ������" class="blue">' . $Info['name'] . ' ' . $Info['version'] . '</a> ';
                ;
                $PHPShopInterface->setRow($i, $ChekInstallModule[1], $ModuleHomePage, $Info['description'], date("d-m-y H:s", $ChekInstallModule[2]));
                $i++;
            }
    } elseif (@$dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {

                if (is_dir($path . $file)) {

                    // ���������� �� ������
                    $Info = GetModuleInfo($file);

                    if (!empty($Info['status']))
                        $new = '<sup>' . strtoupper($Info['status']) . '</sup>';
                    else
                        $new = null;

                    // ���� ������� ���������
                    if (isset($_GET['pid']) and @strstr($Info['category'], $_GET['pid']) and empty($Info['hidden'])) {

                        $ChekInstallModule = ChekInstallModule($file);

                        // ���� ���������
                        if (!empty($ChekInstallModule[2]))
                            $InstallDate = date("d-m-y H:s", $ChekInstallModule[2]);
                        else
                            $InstallDate = "";

                        if (!empty($Info['trial']) and empty($ChekInstallModule[3])) {
                            $trial = ' (Trial 30 ����)';
                        }
                        else
                            $trial = null;

                        $ModuleHomePage = '<img src="' . $path . $file . '/install/' . $Info['icon'] . '" align="absmiddle">
<a href="http://wiki.phpshop.ru/index.php/Modules#' . str_replace(' ', '_', $Info['name']) . '" target="_blank" title="�������� ������" class="blue">' . $Info['name'] . ' ' . $Info['version'] . $trial . '</a> ' . $new;

                        if (CheckedRules($UserStatus["module"], 0)) {
                            $ChekInstallModule[1] = "<BUTTON style=\"width: 10em; height: 2.2em; margin-left:5\" >
<img src=\"../img/errormessage.gif\"  border=\"0\" align=\"absmiddle\">
��� ����
</BUTTON>";
                        }


                        $PHPShopInterface->setRow($i, $ChekInstallModule[1], $ModuleHomePage, $Info['description'], $InstallDate);
                        $i++;
                    }
                    // ����� ���� �������
                    elseif (empty($_GET['pid']) and empty($Info['hidden'])) {
                        $ChekInstallModule = ChekInstallModule($file);

                        // ���� ���������
                        if (!empty($ChekInstallModule[2]))
                            $InstallDate = date("d-m-y H:s", $ChekInstallModule[2]);
                        else
                            $InstallDate = "";

                        if (!empty($Info['trial']) and empty($ChekInstallModule[3])) {
                            $trial = ' (Trial 30 ����)';
                        }
                        else
                            $trial = null;


                        $ModuleHomePage = '<img src="' . $path . $file . '/install/' . $Info['icon'] . '" align="absmiddle">
<a href="http://wiki.phpshop.ru/index.php/Modules#' . str_replace(' ', '_', $Info['name']) . '" target="_blank" title="�������� ������" class="blue">' . $Info['name'] . ' ' . $Info['version'] . $trial . '</a> ' . $new;


                        if (CheckedRules($UserStatus["module"], 0)) {
                            $ChekInstallModule[1] = "<BUTTON style=\"width: 10em; height: 2.2em; margin-left:5\" >
<img src=\"../img/errormessage.gif\"  border=\"0\" align=\"absmiddle\">
��� ����
</BUTTON>";
                        }


                        $PHPShopInterface->setRow($i, $ChekInstallModule[1], $ModuleHomePage, $Info['description'], $InstallDate);
                        $i++;
                    }
                }
            }
        }
        closedir($dh);
    }
    $PHPShopInterface->Compile();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= $GLOBALS['PHPShopLangCharset'] ?>">
            <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
                <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
                <script type="text/javascript" language="JavaScript1.2" src="../java/sorttable.js"></script>
                <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
                </head>
                <body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="ffffff">

                    <?
// ����� ����� ��� ������
                    $PHPShopInterface->setLoader(false, 'actionStart');
                    ?>
                </body>
                </html>