<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

function Zero($a) {
    if ($a != 1)
        return 0;
    else
        return 1;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������� ��������������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/tab.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
        <script type="text/javascript" src="../java/tabpane.js"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
            <tr bgcolor="#ffffff">
                <td style="padding:10">
                    <b><span name=txtLang id=txtLang>�������� ��������������</span></b><br>
                    &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
                </td>
                <td align="right">
                    <img src="../img/i_groups_med[1].gif" border="0" hspace="10">
                </td>
            </tr>
        </table>
        <!-- begin tab pane -->
        <div class="tab-pane" id="article-tab" style="margin-top:5px;">

            <script type="text/javascript">
                tabPane = new WebFXTabPane(document.getElementById("article-tab"), true);
            </script>

            <!-- begin intro page -->
            <div class="tab-page" id="intro-page" style="height:320px">
                <h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

                <script type="text/javascript">
                    tabPane.addTabPage(document.getElementById("intro-page"));
                </script>
                <table cellpadding="" cellspacing="5" border="0" align="center" width="100%">
                    <form name="product_edit" method="post">
                        <tr>
                            <td colspan="3">
                                <FIELDSET>
                                    <LEGEND><span name=txtLang id=txtLang><u>�</u>��</span></LEGEND>
                                    <div style="padding:10">
                                        <input type="text" name="name" value="" class=full>
                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <FIELDSET>
                                    <LEGEND><span name=txtLang id=txtLang><u>E</u>-mail</span></LEGEND>
                                    <div style="padding:10">
                                        <input type="text" name="mail" value="" size="30">  <input type="checkbox" value="1" name="pas_send" id="pas_send" checked> �������� ���. ������ �� �����
                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <FIELDSET>
                                    <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
                                    <div style="padding:10">
                                        <table >
                                            <tr>
                                                <td>������������</td>
                                                <td width="10"></td>
                                                <td><input type="text" name="login" id="login" value="" size="20"> ( �� ����� 4 �������� )</td>
                                            </tr>
                                            <tr>
                                                <td>������</td>
                                                <td width="10"></td>
                                                <td><input type="Password" name="password" id="pas1" onclick="this.value = ''" size="20" value=""> ( �� ����� 6 �������� )</td>
                                            </tr>
                                            <tr>
                                                <td>������ ��� ���</td>
                                                <td width="10"></td>
                                                <td><input type="Password" name="password" id="pas2" size="20" value=""> 
                                                    <INPUT class=but type=button value="�������������" style="width:100" onclick="GenPassword('<?= "P" . substr(md5(date("U")), 0, 6) ?>')"> </td>
                                            </tr>
                                        </table>

                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                </table>
            </div>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('usersID')">�������</BUTTON></BUTTON>
                    </td>
                    <td align="right" style="padding:10">
                        <input type="button"  value="OK" class=but onclick="TestPas()">
                        <input type="hidden" name="editID" value="1">
                        <input type="reset" name="btnLang" class=but value="��������">
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and @$login != "") {// ������ ��������������
            if (CheckedRules($UserStatus["users"], 2) == 1) {

                $hasher = new PasswordHash(8, false);
                $hash = $hasher->HashPassword($password);

                $def_prava = 'a:23:{s:5:"gbook";s:5:"1-1-1";s:4:"news";s:5:"1-1-1";s:7:"visitor";s:7:"1-1-1-1";s:5:"users";s:7:"1-1-1-1";s:9:"shopusers";s:5:"1-1-1";s:8:"cat_prod";s:11:"1-1-1-1-1-1";s:6:"stats1";s:5:"1-1-1";s:5:"rupay";s:5:"0-0-0";s:11:"news_writer";s:5:"1-1-1";s:9:"page_site";s:5:"1-1-1";s:9:"page_menu";s:5:"1-1-1";s:5:"baner";s:5:"1-1-1";s:5:"links";s:5:"1-1-1";s:3:"csv";s:5:"1-1-1";s:5:"opros";s:5:"1-1-1";s:6:"rating";s:5:"1-1-1";s:3:"sql";s:5:"0-1-1";s:6:"option";s:3:"0-1";s:8:"discount";s:5:"1-1-1";s:6:"valuta";s:5:"1-1-1";s:8:"delivery";s:5:"1-1-1";s:7:"servers";s:5:"1-1-1";s:10:"rsschanels";s:5:"1-1-1";}';
                $sql = "INSERT INTO $table_name19
VALUES ('','$def_prava','$login','" . $hash . "','$mail','1','','','','$name','','')";
                $result = mysql_query($sql) or @die("���������� �������� ������");


//�������� �����
                if ($_POST['pas_send'] == 1) {

                    $codepage = "windows-1251";
                    $header = "MIME-Version: 1.0\n";
                    $header .= "From:   <no_reply@phpshop.ru>\n";
                    $header .= "Content-Type: text/plain; charset=$codepage\n";
                    $header .= "X-Mailer: PHP/";
                    $zag = "PHPShop: ������ ������������ ��� ������� " . $_SERVER['SERVER_NAME'];
                    $content = "
������� �������!
---------------------------------------------------------

���������������� ������ �������� �� ������:  http://" . $_SERVER['SERVER_NAME'] . $SysValue['dir']['dir'] . "/phpshop/admpanel/
��� �������� ������ Ctrl+F12
�����: " . $_POST['login'] . "
������: " . $_POST['password'] . "

---------------------------------------------------------
" . $SysValue['license']['product_name'];
                    mail($mail, $zag, $content, $header);
                }

                echo"
<script>
DoReloadMainWindow('users');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>



