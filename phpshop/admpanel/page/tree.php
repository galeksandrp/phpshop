<?php
$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("admgui");


$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

class MainCatalogTree extends CatalogTree {

    function MainCatalogTree($base) {
        if ($_COOKIE['winOpenType'] == 'highslide')
            $this->dot = "./catalog/";
        else
            $this->dot = "";
        parent::CatalogTree($base);
    }

    function addcat($n, $id, $name, $link = false, $icon = false) {
        $name = __($name);
        $this->dis.="d.add($n,$id,'$name','$link','','','','$icon');";
    }

    function create($parent_to) {
        $result = $this->sql("select * from " . $this->table . " where parent_to=" . intval($parent_to) . " order by num");
        $i = 0;
        while ($row = mysql_fetch_array($result)) {
            $id = $row['id'];
            $name = addslashes($row['name']);
            $num = $this->chek($id);
            $link = './admin_page_content.php?pid=' . $id;
            if ($num > 0)
                $this->dis.="
  d.add($id," . intval($parent_to) . ",'$name',\"javascript:miniWin('" . $this->dot . "adm_catalogID.php?id=$id',650,630)\");
                        " . $this->add($id) . "
  ";
            else
                $this->dis.="
  d.add($id," . intval($parent_to) . ",'$name','$link');
                        " . $this->add($id) . "
  ";
            $i++;
        }


        // �������� ���������
        if (!empty($_GET['category'])) {
            $this->dis.="d.openTo(" . $_GET['category'] . ", true);";
        }
    }

    function add($n) {
        $disp = '';
        $result = $this->sql("select * from " . $this->table . " where parent_to='$n' order by num");
        while ($row = mysql_fetch_array($result)) {
            $i = 0;
            $id = $row['id'];
            $name = addslashes($row['name']);
            $num = $this->chek($id);
            $link = './admin_page_content.php?pid=' . $id;

            if ($i < $num) {// ���� ���� ��� ��������
                $disp.="d.add($id,$n,'$name',\"javascript:miniWin('" . $this->dot . "adm_catalogID.php?id=$id',650,630)\");
                        " . $this->add($id);
            } else {// ���� ��� ���������
                $disp.="d.add($id,$n,'$name','" . $link . "');";
            }
        }
        return $disp;
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= $GLOBALS['PHPShopLangCharset'] ?>">
            <LINK href="../skins/<?= $_SESSION['theme'] ?>/dtree.css" type=text/css rel=stylesheet>
                <SCRIPT language=JavaScript1.2 src="../java/dtree.js" type=text/javascript></SCRIPT>
                <script language="JavaScript1.2" src="../java/phpshop.js" type="text/javascript"></script>
                </head>
                <body bottommargin="0" rightmargin="0" topmargin="10" leftmargin="10" bgcolor="#ffffff">
                    <div style="padding:0px">
<?
// ������ ���������
$CatalogTree = new MainCatalogTree($GLOBALS['SysValue']['base']['page_categories']);
$CatalogTree->addcat(0, -1, '������� �������', '');
$CatalogTree->addcat(3000, 0, '����', '');
$CatalogTree->addcat(1000, 3000, '������� ���� �����', 'admin_page_content.php?pid=1000');
$CatalogTree->addcat(2000, 3000, '��������� ��������', 'admin_page_content.php?pid=2000');
$CatalogTree->addcat(100000, 0, '!!! ��������� ����� !!!', '', '../img/imgfolder.gif');
$CatalogTree->create(100000);
$CatalogTree->create();
$CatalogTree->disp();
?>
                    </div>
                </body>
                </html>

