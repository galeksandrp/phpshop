<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

function MyStripSlashes($str) {
    return stripslashes(CleanStr($str));
}

function GetUsersStatus($n) {
    global $SysValue;
    $sql = "select * from " . $SysValue['base']['table_name28'] . " order by discount";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $discount = $row['discount'];
        $sel = "";
        if ($n == $id)
            $sel = "selected";
        @$dis.="<option value=" . $id . " " . $sel . " >" . $name . " - " . $discount . "%</option>\n";
    }
    @$disp = "
<select name=status_new size=1>
<option value=0 id=txtLang>�������������� ������������</option>
            $dis
</select>
            ";
    return @$disp;
}

// ���������� �� �������
if (isset($_GET['visitorID'])) {
    $sql = "select * from $table_name1 where id=".intval($visitorID)." limit 0, 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    $id = $row['id'];
    $order = unserialize($row['orders']);

    $user = "user" . $_GET['visitorID'];
    $pass = substr(abs(crc32(rand(0, 100))), 0, 6);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������� ������ ������������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
            <tr bgcolor="#ffffff">
                <td style="padding:10">
                    <b><span name=txtLang id=txtLang>�������� ������ ������������</span></b><br>
                    &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
                </td>
                <td align="right">
                    <img src="../img/i_groups_med[1].gif" border="0" hspace="10">
                </td>
            </tr>
        </table>
        <form name="product_edit">
            <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td colspan="2">
                        <FIELDSET id=fldLayout>
                            <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
                            <div style="padding:10">
                                <?= GetUsersStatus(@$status) ?>
                                &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="enabled_new" value="1" checked><span name=txtLang id=txtLang>���������</span>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="enabled_new" value="0" ><font color="#FF0000"><span name=txtLang id=txtLang>�������������</span></font>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <FIELDSET id=fldLayout>
                            <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
                            <div style="padding:10px">
                                <table>
                                    <tr>
                                        <td>Login</td>
                                        <td width="10"></td>
                                        <td><input type="text" name="login_new"  style="width:250px;" value="<?= @$user; ?>"></td>
                                        <td rowspan="2" valign="top" style="padding-left:10">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td width="10"></td>
                                        <td><input type="text" name="password_new" style="width:250px;" value="<?= @$pass; ?>"></td>
                                    </tr>
                                </table>

                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <FIELDSET id=fldLayout>
                            <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>����� ������</span></LEGEND>
                            <div style="padding:10px">
                                <table>
                                    <tr>
                                        <td>E-mail:
                                        </td>
                                        <td><input type="text" name="mail_new" style="width:350px" value="<?= @MyStripSlashes($order['Person']['mail']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>���������� ����</span>:
                                        </td>
                                        <td><input type="text" name="name_new" style="width:350px" 
                                                   value="<?= @$order['Person']['name_person']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>��������</span>: </td>
                                        <td><input type="text" name="company_new" style="width:350px;" value="<?= @MyStripSlashes($order['Person']['org_name']); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>���</span>: </td>
                                        <td><input type="text" name="inn_new" style="width:350px;" value="<?= $order['Person']['org_inn']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>���</span>: </td>
                                        <td><input type="text" name="kpp_new" style="width:350px;" value="<?= @$order['Person']['org_kpp']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>�������</span>: </td>
                                        <td><input type="text" name="tel_code_new" style="width:50px;"> -
                                            <input type="text" name="tel_new" style="width:290px;" value="<?= @$order['Person']['tel_code'] . " " . $order['Person']['tel_name']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><span name=txtLang id=txtLang>�����</span>: </td>
                                        <td><textarea style="width:350px; height:50px;" name="adres_new"><?= @MyStripSlashes($order['Person']['adr_name']); ?></textarea></td>
                                    </tr>
                                </table>

                            </div>
                        </FIELDSET>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('shopusersID')">�������</BUTTON></BUTTON>
                    </td>
                    <td align="right" style="padding:10">
                        <input type="submit" name="editID" value="OK" class=but>
                        <input type="hidden" name="orderID"  value="<?= @$visitorID; ?>">
                        <input type="reset" name="btnLang" name="delID" value="��������" class=but>
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and !empty($login_new) and !empty($password_new)) {
            if (CheckedRules($UserStatus["shopusers"], 2) == 1) {
                $sql = "INSERT INTO " . $SysValue['base']['table_name27'] . "
VALUES ('','$login_new','" . base64_encode($password_new) . "','" . date("U") . "','$mail_new','$name_new','$company_new','$inn_new','$tel_new','$adres_new','$enabled_new','$status_new',
'$kpp_new','$tel_code_new')";
                $result = mysql_query($sql) or @die("���������� �������� ������");


// ���������� ������ ������
                $sql2 = "select id from " . $SysValue['base']['table_name27'] . " where login='$login_new' limit 0, 1";
                $result2 = mysql_query($sql2) or @die($sql2);
                $row = mysql_fetch_array($result2);
                $id_user = $row['id'];

                mysql_query("UPDATE " . $SysValue['base']['table_name1'] . " SET user=$id_user where id=$orderID");


// ���� ���� �������
                $codepage = "windows-1251";
                $header_adm = "MIME-Version: 1.0\n";
                $header_adm .= "From:  User Activation <donotreply@" . str_replace("www.", "", $_SERVER['SERVER_NAME']) . ">\n";
                $header_adm .= "Content-Type: text/plain; charset=$codepage\n";
                $header_adm .= "X-Mailer: PHP/";
                $zag_adm = $GetSystems['name'] . " - ����������� ������������ " . $_POST['name_new'];
                $content_adm = "
������� �������!
--------------------------------------------------------

������������� ���������� ���� ������ � ������� 
��� � �������������� ������������ " . $_SERVER['SERVER_NAME'] . "

������ �������
--------------
�����: http://" . $_SERVER['SERVER_NAME'] . "/users/
�����: " . $login_new . "
������: " . $password_new . "


����/�����: " . date("d-m-y H:i a") . "
";
                mail($_REQUEST['mail_new'], $zag_adm, $content_adm, $header_adm);

                echo"
<script>
DoReloadMainWindow('shopusers');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>