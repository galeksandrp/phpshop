<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������� ������ ��� ������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <?

        function Disp_cat($n) {// ����� ��������� � ������
            global $table_name6;
            $sql = "select * from $table_name6 order by name";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $id = $row['id'];
                $name = substr($row['name'], 0, 35);
                if ($id == $n) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                @$dis.="<option value=\"$id\" $sel>$name</option>\n";
            }
            @$disp = "
<select name=category_new size=1>
$dis
</select>
";
            return @$disp;
        }
        ?>
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������� ������ ������</span></b><br>
                        &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
                    </td>
                    <td align="right">
                        <img src="../img/i_website_statistics_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>����</span></LEGEND>
                            <div style="padding:10">
                                <input type="text" name="name_new" value="<?= $name ?>" class="full">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span></LEGEND>
                            <div style="padding:10">
<?= Disp_cat(@$categoryID); ?>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td width="50%">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�����</span></LEGEND>
                            <div style="padding:10">
                                <input type="text" name="total_new" value="<?= $total ?>" class="full">
                            </div>
                        </FIELDSET>
                    </td>
                    <td width="50%">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>������ �� �������</span></LEGEND>
                            <div style="padding:10">
                                <input type="text" name="num_new" value="<?= $num ?>" class="full">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="right" style="padding:10">
                        <input type="submit" name="editID" value="OK" class=but>
                        <input type="reset" name="btnLang" class=but value="��������">
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
<?
if (isset($editID) and !empty($name_new)) {// ������ ��������������
    if (CheckedRules($UserStatus["opros"], 2) == 1) {
        $sql = "INSERT INTO $table_name5 VALUES ('','$category_new','$name_new','$total_new','$num_new')";
        $result = mysql_query($sql) or @die("" . mysql_error() . "");
        echo"
<script>
CLREL();
</script>
	   ";
    }
    else
        $UserChek->BadUserFormaWindow();
}
?>



