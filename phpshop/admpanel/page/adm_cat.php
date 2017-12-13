<?php
$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("admgui");


$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();

// �����������
PHPShopObj::loadClass("lang");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "xhtml11.dtd">
<html>
    <head>
        <title><?= __('����� ��������'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= $GLOBALS['PHPShopLangCharset'] ?>">
            <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
                <LINK href="../skins/<?= $_SESSION['theme'] ?>/dtree.css" type=text/css rel=stylesheet>
                    <SCRIPT language=JavaScript src="./gui/dtree.js" type="text/javascript"></SCRIPT>
                    <script>

                        if (parent.window.hs)
                            exp = parent.window.hs.getExpander();

                        function doAction(name, cat) {
                            var winOpenType = '<?= $_COOKIE['winOpenType']; ?>';

                            switch (winOpenType) {

                                case 'highslide':
                                    exp.iDoc.getElementById('parent_name').value = name;
                                    if (exp.iDoc.getElementById('parent_to_new'))
                                        exp.iDoc.getElementById('parent_to_new').value = cat;
                                    else
                                        exp.iDoc.getElementById('category_new').value = cat;
                                    return parent.window.hs.close();
                                    break;

                                default:
                                    window.opener.document.getElementById('parent_name').value = name;
                                    if (window.opener.document.getElementById('parent_to_new'))
                                        window.opener.document.getElementById('parent_to_new').value = cat;
                                    else
                                        window.opener.document.getElementById('category_new').value = cat;

                                    window.close(null);
                                    return false;
                                    break;

                            }

                        }

                        // ��������� ����
                        function CloseWindow() {
                            window.close();
                        }

                        // ������
                        function Return(name, cat) {
                            //alert(name+","+cat)
                            window.opener.document.getElementById('parent_name').value = name;
                            try {
                                window.opener.document.getElementById('category_new').value = cat;
                            }
                            catch (e) {
                                window.opener.document.getElementById('parent_to_new').value = cat;
                            }

                            window.close();
                        }

                    </script>
                    </head>

                    <body bottommargin="0" leftmargin="5" topmargin="0" rightmargin="5" bgcolor="#ffffff">
                        <div align="center" style="padding:5px"><a href="javascript: window.d.openAll();"><?= __('���������� ���'); ?></a> | <a href="javascript: window.d2.closeAll();"><?= __('�������� ���'); ?></a></div>
                        <table cellpadding="3" cellspacing="3" bgcolor="ffffff" style="border: 1px;border-style: inset;" width="100%" height="85%">
                            <tr>
                                <td valign="top">
                                    <?
                                    // ������ ���������
                                    $CatalogTree = new CatalogTree($GLOBALS['SysValue']['base']['page_categories']);
                                    $CatalogTree->addcat(0, -1, '������');
                                    $CatalogTree->addcat(3000, 0, '����', '../img/imgfolder.gif');
                                    $CatalogTree->addcat(1000, 3000, '������� ���� �����', '������� ���� �����');
                                    $CatalogTree->addcat(2000, 3000, '��������� ��������', '��������� ��������');
                                    $CatalogTree->addcat(100000, 0, '!!! ��������� ����� !!!', '', '../img/imgfolder.gif');
                                    $CatalogTree->create(100000);
                                    $CatalogTree->create();
                                    $CatalogTree->disp();
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <div align="center" style="padding:5px"><a href="javascript: window.d.openAll();"><?= __('���������� ���'); ?></a> | <a href="javascript: window.d.closeAll();"><?= __('�������� ���'); ?></a></div>
                    </body>
                    </html>