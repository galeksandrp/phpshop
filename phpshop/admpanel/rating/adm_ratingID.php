<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// �����
$GetSystems = GetSystems();
$option = unserialize($GetSystems['admoption']);
$Lang = $option['lang'];
require("../language/" . $Lang . "/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������������� ��������</title>
        <META http-equiv=Content-Type content="text/html; <?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.2" src="../language/<? echo $Lang; ?>/language_windows.js"></script>
        <script type="text/javascript" language="JavaScript1.2" src="../language/<? echo $Lang; ?>/language_interface.js"></script>
        <script>
            DoResize(<? echo $GetSystems['width_icon'] ?>, 630, 640);
        </script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0" onload="DoCheckLang(location.pathname,<?= $SysValue['lang']['lang_enabled'] ?>);
        preloader(0)">
        <table id="loader">
            <tr>
                <td valign="middle" align="center">
                    <div id="loadmes" onclick="preloader(0)">
                        <table width="100%" height="100%">
                            <tr>
                                <td id="loadimg"></td>
                                <td ><b><?= $SysValue['Lang']['System']['loading'] ?></b><br><?= $SysValue['Lang']['System']['loading2'] ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <SCRIPT language=JavaScript type=text/javascript>preloader(1);</SCRIPT>
<?

// ����� �������
function dispFaq($n) {
    global $SysValue, $systems;

    /*
      $sql="select SUM(total) as sum from $table_name52 where category='$n'";
      $result=mysql_query($sql);
      $row = mysql_fetch_array($result);
      $sum=$row['sum'];
     */

    $sql = "select * from " . $SysValue['base']['table_name51'] . " where id_category='" . intval($n) . "' order by num";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id_charact = $row['id_charact'];
        $name = $row['name'];
        $num = $row['num'];
        $enabled = $row['enabled'];
        if (@$enabled != 0) {
            $imgchek = "<img src=\"../img/icon-activate.gif\" width=\"16\" height=\"16\" border=\"0\">";
        } else {
            $imgchek = "<img src=\"../img/icon-deactivate.gif\" width=\"16\" height=\"16\" border=\"0\">";
        }

        @$disp.='
	<tr onclick="miniWin(\'adm_valueID.php?id=' . $id_charact . '\',500,370)"  onmouseover="show_on(\'r' . $id_charact . '\')" id="r' . $id_charact . '" onmouseout="show_out(\'r' . $id_charact . '\')" class=row>
	<td class="forma">' . $imgchek . '</td>
	<td class="forma">' . $name . '</td>
	<td class="forma">' . $num . '</td>
</tr>
	';
    }
    return @$disp;
}

// �������������� ������� �����
$sql = "select * from " . $SysValue['base']['table_name50'] . " where id_category=".intval($id);
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$id_category = $row['id_category'];
$name = $row['name'];
$ids_dir = $row['ids_dir'];
if ($row['enabled'] == 1)
    $sel1 = "checked";
else
    $sel2 = "checked";
if ($row['revoting'] == 1)
    $sel3 = "checked";
else
    $sel4 = "checked";
?>
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������������� ��������</span> "<?= $name ?>"</b><br>
                        &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
                    </td>
                    <td align="right">
                        <img src="../img/i_website_statistics_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <br>
            <table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td colspan="2">
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="name_new" class=s style="width:100%;" value="<?= $name ?>">
                            </div>
                        </FIELDSET>
                    </td>
                </tr>


                <tr>
                    <td width="70%" rowspan=2>
                        <FIELDSET>
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>������� � ���������� �������</span></LEGEND>


                            <DIV  style="overflow-y:auto; height:155px; padding:10;">
                                <?

                                function dispcats($PID = 0, $LVL = 0) {
                                    global $SysValue, $ids_dir;
                                    $sql = 'select * from ' . $SysValue['base']['table_name'] . ' where parent_to=' . intval($PID) . ' order by num';
                                    $result = mysql_query($sql);
                                    $dis = '0';
                                    $LVL++;
                                    while (@$row = mysql_fetch_array($result)) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $parent_to = $row['parent_to'];
                                        $mover = '';
                                        for ($i = 0; $i < $LVL - 1; $i++) {
                                            $mover.='&nbsp;&nbsp;&nbsp;&nbsp;';
                                        }
                                        if (strpos($ids_dir, ',' . $id . ',') !== false) {
                                            $sel = "selected";
                                        } else {
                                            $sel = "";
                                        }
                                        if (dispcats($id, $LVL) != "0") {
                                            $dis.='<optgroup label="' . $name . '">' . dispcats($id, $LVL) . '</optgroup>';
                                        } else {
                                            @$dis.='<option value="' . $id . '" ' . $sel . '>' . $mover . $name . '</option>';
                                        }
                                    }
                                    return $dis;
                                }

//����� �������
                                ?>
                                <select size=1 name=idsdir_new[] style="height:135;width:100%;" multiple>
<? echo dispcats(); ?>
                                </select>

                            </DIV>
                        </FIELDSET>
                    </td>
                    <td>
                        <FIELDSET>
                            <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>����</span></LEGEND>
                            <div style="padding:10">
                                <input type="radio" name="enabled_new" value="1" <?= $sel1 ?>><span name=txtLang id=txtLang>��������</span>&nbsp;&nbsp;
                                <input type="radio" name="enabled_new" value="0" <?= $sel2 ?>><font color="#FF0000"><span name=txtLang id=txtLang>������</span></font>
                                <br><br>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <TR>
                    <td>
                        <FIELDSET>
                            <LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>��������������</span></LEGEND>
                            <div style="padding:10">
                                <input type="radio" name="revoting_new" value="1" <?= $sel3 ?>><span name=txtLang id=txtLang>���������</span>&nbsp;&nbsp;
                                <input type="radio" name="revoting_new" value="0" <?= $sel4 ?>><font color="#FF0000"><span name=txtLang id=txtLang>���������</span></font>
                                <br><br>
                            </div>
                        </FIELDSET>
                    </td>
                </TR>



                <tr>
                    <td colspan="2">
                        <table width="100%"  cellpadding="0" cellspacing="0" style="border: 1px;
                               border-style:inset;" >
                            <tr>
                                <td valign="top">
                                    <div align="left" style="width:100%;height:150;overflow:auto"> 
                                        <table cellpadding="0" cellspacing="1" width="100%" border="0" bgcolor="#808080">
                                            <tr>
                                                <td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>+/-</td>
                                                <td id=pane align=center ><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>������� ������</span></td>
                                                <td id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>������� ������</span></td>
                                            </tr>
<?= dispFaq($id_category); ?>
                                        </table>


                                </td>
                            </tr>
                        </table>
                        <div align="right" style="padding:10">
                            <BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin('../window/adm_window.php?do=122&ids=<?= $id ?>', 300, 220)">
                                <img src="../img/i_delete[1].gif" width="16" height="16" border="0" align="absmiddle">
                                <span name=txtLang id=txtLang>�������� ������</span>
                            </BUTTON>
                            <BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin('adm_value_new.php?categoryID=<?= $id ?>', 500, 370)">
                                <img src="../img/icon-move-banner.gif" width="16" height="16" border="0" align="absmiddle">
                                <span name=txtLang id=txtLang>����� �������</span>
                            </BUTTON>
                        </div>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('rating')">�������</BUTTON></BUTTON>
                    </td>
                    <td align="right" style="padding:10">
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
            if (CheckedRules($UserStatus["rating"], 1) == 1) {
                foreach ($idsdir_new as $cid) {
                    $idsd.=',' . $cid . ',';
                }

                $sql = "UPDATE " . $SysValue['base']['table_name50'] . "
SET
name='$name_new',
ids_dir='$idsd',
enabled='$enabled_new',
revoting='$revoting_new'
where id_category='$id'";
                $result = mysql_query($sql) or @die("" . mysql_error() . "");
                echo"
	  <script>
DoReloadMainWindow('rating');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        if (@$productDELETE == "doIT") {// ��������
            if (CheckedRules($UserStatus["rating"], 1) == 1) {
                $sql = "delete from " . $SysValue['base']['table_name50'] . "
where id_category='$id'";
                $result = mysql_query($sql) or @die("���������� �������� ������");
                echo"
	  <script>
DoReloadMainWindow('rating');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>