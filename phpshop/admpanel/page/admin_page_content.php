<?php

$_classPath="../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopInterface = new PHPShopInterface();

function actionStart() {
    global $PHPShopInterface,$PHPShopBase;
    $PHPShopInterface->size="650,600";
    $PHPShopInterface->imgPath="../img/";

    if($_COOKIE['winOpenType'] == 'highslide')
        $PHPShopInterface->link="page/adm_pagesID.php";
    else $PHPShopInterface->link="../page/adm_pagesID.php";

    $PHPShopInterface->setCaption(array(' ',"3%"),array("&plusmn;","5%"),array("������","20%"),array("��������","40%"),
            array("�������� ����������","30%"));

    if(!PHPShopSecurity::true_num($_GET['pid'])) $_GET['pid']=0;


    if(!empty($_REQUEST['words']))
        $sql="select * from ".$GLOBALS['SysValue']['base']['table_name11']." where name REGEXP'".$_REQUEST['words']."' or link REGEXP'".$_REQUEST['words']."'";
    elseif($_GET['pid']=="all") $sql="select * from ".$GLOBALS['SysValue']['base']['table_name11']." order by datas desc";
    else $sql="select * from ".$GLOBALS['SysValue']['base']['table_name11']." where category=".$_GET['pid'].' order by datas desc';
    $PHPShopOrm = new PHPShopOrm();
    $result=$PHPShopOrm->query($sql);
    while (@$row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        $link=$row['link'];
        switch ($row['enabled']) {
            case '0': $checked=$PHPShopInterface->setImage('../img/icon-deactivate.gif',false,false,false,false,false,false,'����������');break;
            case '1': $checked=$PHPShopInterface->setImage('../img/icon-activate.gif',false,false,false,false,false,false,'����������');break;
            case '2': $checked=$PHPShopInterface->setImage('../img/icon-move-banner.gif',false,false,false,false,false,false,'����������');break;
        }
        
        $PHPShopInterface->setRow($id,array($PHPShopInterface->setCheckbox($id, $id,false,false),$link),$checked,$link,$name,array($PHPShopInterface->setLink("http://".$_SERVER['SERVER_NAME'].$PHPShopBase->getParam('dir.dir')."/page/".$link.".html", "http://".$_SERVER['SERVER_NAME'].$PHPShopBase->getParam('dir.dir')."/page/".$link.".html"),$link=false));
    }
    $PHPShopInterface->_CODE_ADD_BUTTON=$PHPShopInterface->setInput("hidden","catal",$_GET['pid'],"none",100);
    $PHPShopInterface->Compile('interfaces','flag_form',null);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=$GLOBALS['PHPShopLangCharset']?>">
        <link href="../skins/<?=$_SESSION['theme']?>/texts.css" type=text/css rel=stylesheet>
        <script type="text/javascript" language="JavaScript1.2" src="../java/sorttable.js"></script>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="ffffff">

        <?
        // ����� ����� ��� ������
        $PHPShopInterface->setLoader(false,'actionStart');
        ?>
    </body>
</html>