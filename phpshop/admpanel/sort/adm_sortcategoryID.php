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
        <title>�������������� ������ �������������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <?

// ����� �������
        function dispValue($n, &$category_arr) {
            global $SysValue;
            $sql = "select * from " . $SysValue['base']['table_name20'] . " where category!=0 order by num";
            $result = mysql_query($sql);
            while (@$row = mysql_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $num = $row['num'];
                $category = $row['category'];
                $description = $row['description'];
                if ($n == $category) {
                    $fl = "selected";
                    $category_arr[] = $id;
                }
                else
                    $fl = "";

                @$dis.='
	<option value="' . $id . '" ' . $fl . ' title="' . $description . '">' . $name . '</option>';
                $disp = '
<select name=category_new[] style="width:100%;height:150px" multiple>
		' . @$dis . '
</select>
';
            }
            return @$disp;
        }

// �������������� ������� �����
        $sql = "select * from " . $SysValue['base']['table_name20'] . " where id=" . intval($_GET['id']);
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['id'];
        $name = $row['name'];
        $num = $row['num'];
        $description = $row['description'];
        $category_arr = array();
        ?>
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������������� ������</span> "<?= $name ?>"</b><br>
                        &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
                    </td>
                    <td align="right">
                        <img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�����������</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="name_new" class="full" value="<?= $name ?>">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%">
                            <tr>
                                <td>
                                    <FIELDSET style="height:70px;">
                                        <LEGEND><span name=txtLang id=txtLang><u>�</u>�������</span></LEGEND>
                                        <div style="padding:10">
                                            <textarea class=full name=description_new style="height:40px"><?= $description ?></textarea>
                                        </div>
                                    </FIELDSET>
                                </td>
                                <td width="100" valign="top">
                                    <FIELDSET style="height:70px;">
                                        <LEGEND><span name=txtLang id=txtLang><u>�</u>������</span> </LEGEND>
                                        <div style="padding:10">
                                            <input type="text" size="3" name="num_new" value="<?= $num ?>">
                                        </div>
                                    </FIELDSET>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�������������</span> </LEGEND>
                            <div style="padding:10">
                                <div align="left" style="width:95%;overflow:true">
                                    <?= dispValue($id, $category_arr); ?>
                                </div>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('sort_groupID')">�������</BUTTON>
                    </td>
                    <td align="right" style="padding:10">
                        <input type="hidden" name="category_arr" value="<?= $category_arr ?>" >
                        <input type="hidden" name="id" value="<?= $id ?>" >
                        <input type="submit" name="editID" value="OK" class=but>
                        <input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
                        <input type="hidden" class=but  name="productDELETE" id="productDELETE">
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and !empty($name_new)) {// ������ ��������������
            if (CheckedRules($UserStatus["cat_prod"], 1) == 1) {

                if (is_array($category_arr))
                    foreach ($category_arr as $v) {
                        $sql = "UPDATE " . $SysValue['base']['table_name20'] . "
SET category='-1' where id='$v'";
                        $result = mysql_query($sql);
                    }

                if (is_array($category_new))
                    foreach ($category_new as $v) {
                        $sql = "UPDATE " . $SysValue['base']['table_name20'] . "
SET category='$id' where id='$v'";
                        $result = mysql_query($sql);
                    }

                $sql = "UPDATE " . $SysValue['base']['table_name20'] . "
SET
name='$name_new',
num='$num_new',
description='$description_new' 
where id='$id'";
                $result = mysql_query($sql) or @die("" . mysql_error() . "");
                echo"
	  <script>
DoReloadMainWindow('sort_group');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        if (@$productDELETE == "doIT") {// ��������
            if (CheckedRules($UserStatus["cat_prod"], 1) == 1) {
                $sql = "delete from " . $SysValue['base']['table_name20'] . "
where id='$id'";
                $result = mysql_query($sql) or @die("���������� �������� ������");
                echo"
	  <script>
DoReloadMainWindow('sort_group');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>
