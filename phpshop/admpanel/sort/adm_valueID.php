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
        <title>�������������� ��������������</title>
        <META http-equiv=Content-Type content="text/html; charset=windows-1251">
        <LINK href="../skins/<?=$_SESSION['theme']?>/texts.css" type=text/css rel=stylesheet>
        <LINK href="../skins/<?=$_SESSION['theme']?>/tab.css" type=text/css rel=stylesheet>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
        <script type="text/javascript" src="../java/tabpane.js"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <?

        function Disp_cat($n) {// ����� ��������� � ������
            global $SysValue;
            $sql = "select * from " . $SysValue['base']['table_name20'] . " WHERE category!=0 order by name";
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

        function dispPage($array) { // ����� ������ �� ����
            global $SysValue;
            $array = explode(",", $array);
            $sql = "select * from " . $SysValue['base']['table_name11'] . " where enabled='1' order by num";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $link = $row['link'];
                $name = substr($row['name'], 0, 100);
                $sel = "";
                if (is_array($array))
                    foreach ($array as $v) {
                        if ($link == $v)
                            $sel = "selected";
                    }
                @$dis.="<option value=" . $link . " " . $sel . " >" . $name . "</option>";
            }
            @$disp = "
<select name=page_new>
<option value=''>��� ��������</option>
$dis
</select>
";
            return @$disp;
        }

// �������������� �������
        $sql = "select * from " . $SysValue['base']['table_name21'] . " where id=" . intval($_GET['id']);
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['id'];
        $name = $row['name'];
        $category = $row['category'];
        $num = $row['num'];
        $page = $row['page'];
        $icon = $row['icon'];
        
        //
        $sql = "select brand from " . $SysValue['base']['table_name20'] . " where id='$category'";
        $result = mysql_query($sql);
        $rowTemp = mysql_fetch_array($result);
        $brand = $rowTemp['brand'];
        ?>
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b>�������������� �������������� "<?= $name ?>"</b><br>
                        &nbsp;&nbsp;&nbsp;
                    </td>
                    <td align="right">
                        <img src="../img/i_billing_history_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <!-- begin tab pane -->
            <div class="tab-pane" id="article-tab" style="margin-top:5px;height:300px">

                <script type="text/javascript">
                    tabPane = new WebFXTabPane(document.getElementById("article-tab"), true);
                </script>



                <!-- begin intro page -->
                <div class="tab-page" id="intro-page" style="height:250px">
                    <h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

                    <script type="text/javascript">
                        tabPane.addTabPage(document.getElementById("intro-page"));
                    </script>
                    <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                        <tr>
                            <td colspan="2">
                                <FIELDSET>
                                    <LEGEND><u>�</u>�������������</LEGEND>
                                    <div style="padding:10">
                                        <input type="text" name="name_new" value="<?= $name ?>" class="full">
                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <FIELDSET>
                                    <LEGEND><u>�</u>��������</LEGEND>
                                    <div style="padding:10">
                                        <?= Disp_cat($category); ?>
                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <FIELDSET>
                                    <LEGEND><u>�</u>������ �� �������</LEGEND>
                                    <div style="padding:10">
                                        <input type="text" name="num_new" value="<?= $num ?>" class="full">
                                    </div>
                                </FIELDSET>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-page" id="content-page" style="height:250px">
                    <h2 class="tab"><span name=txtLang id=txtLang>��������</span></h2>

                    <script type="text/javascript">
                        tabPane.addTabPage(document.getElementById("content-page"));
                    </script>

                    <table cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                        <tr>
                            <td>
                                <FIELDSET>
                                    <LEGEND><span name=txtLang id=txtLang><u>�</u>����� �� ��������</span></LEGEND>
                                    <div style="padding:10">
                                        <? echo dispPage($page) ?>
                                        <p>* ��� �������� �������������� (� ������� ������������� � ��������� �������� ������) ���������� ������� �� ��������� �������� � ���������.</p>
                                    </div>
                                </FIELDSET>
                                <? if ($brand) { ?>
                                <FIELDSET>
                                    <LEGEND><span name=txtLang id=txtLang>������ �������� ��������������</span></LEGEND>
                                    <div style="padding:2">
                                        <input type="text" value="<?= $icon ?>" name="icon_new" id="icon_new" style="width:300px;"
                                               class="" onclick="" title="">
                                        <BUTTON style="width:100px; height:20px; margin-left:5"  onclick="ReturnPic('icon_new');
                            return false;">
                                            <img src="../img/icon-move-banner.gif" width="16" height="16" border="0" align="absmiddle" hspace="3" hspace="3">
                                            �������
                                        </BUTTON>

                                    </div>
                                </FIELDSET>
                                <? } ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <hr>
                <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                    <tr>

                        <td align="right" style="padding:10">
                            <input type="hidden" name="id" value="<?= $id ?>" >
                            <input type="submit" name="editID" value="OK" class=but>
                            <input type="button" class=but value="�������" onClick="PromptThis();">
                            <input type="hidden" class=but  name="productDELETE" id="productDELETE">
                            <input type="button" value="������" onClick="return onCancel();" class=but>
                        </td>
                    </tr>
                </table>
        </form>
        <?
        if (isset($editID) and !empty($name_new)) {// ������ ��������������
            if (CheckedRules($UserStatus["cat_prod"], 1) == 1) {
                $sql = "UPDATE " . $SysValue['base']['table_name21'] . "
SET
category='$category_new',
name='$name_new',
num='$num_new',
page='$page_new',
icon='$icon_new'
where id='$id'";
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
        if (@$productDELETE == "doIT") {// ��������
            if (CheckedRules($UserStatus["cat_prod"], 1) == 1) {
                $sql = "delete from " . $SysValue['base']['table_name21'] . "
where id='$id'";
                $result = mysql_query($sql) or @die("���������� �������� ������");
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



