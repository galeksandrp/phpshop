<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

// �������� ���������� �����
function getExt($sFileName) {//ffilter
    $sTmp = $sFileName;
    while ($sTmp != "") {
        $sTmp = strstr($sTmp, ".");
        if ($sTmp != "") {
            $sTmp = substr($sTmp, 1);
            $sExt = $sTmp;
        }
    }
    $pos = stristr($sFileName, "php");
    $pos2 = stristr($sFileName, "phtm");
    if ($pos === false and $pos2 === false)
        return strtolower($sExt);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>������ � �����</title>
        <META http-equiv=Content-Type content="text/html; charset=windows-1251">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
        <script type="text/javascript" language="JavaScript1.2" src="../language/russian/language_windows.js"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <?
        echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
	<td style=\"padding:10\">
	<b><span name=txtLang id=txtLang>������ � �����</span></b><br>
	&nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������� ��� MySQL</span>.
	</td>
	<td align=\"right\">
	<img src=\"../img/i_databases_med[1].gif\" border=\"0\" hspace=\"10\">
	</td>
</tr>
</table>
";
        if (@$sql_file) {
            if (CheckedRules($UserStatus["sql"], 1) == 1) {


// ����������
                $_FILES['file']['ext'] = getExt($_FILES['file']['name']);

                if ($_FILES['file']['ext'] == "sql") {

// ���������
                    $copy_file = "../csv/" . @$_FILES['file']['name'];
                    if (move_uploaded_file(@$_FILES['file']['tmp_name'], $copy_file))
                        if (is_file($copy_file)) {
                            $CsvContent = file_get_contents($copy_file);

                            $IdsArray2 = split(";\r", $CsvContent);
                            array_pop($IdsArray2);
                            while (list($key, $val) = each($IdsArray2))
                                $result = mysql_query($val);
                        }
                }

                if (@$result)
                    $disp = "><strong> MySQL: ������ ��������.</strong>";
                else
                    $disp = "<strong>> MySQL: </strong>" . mysql_error() . "";
                echo ('
<div align="left" style="width:98%;height:250;overflow:auto;padding:5px">
<table bgcolor="white" style="border: 1px;
	border-style: inset;" width="100%"  cellpadding="0" cellspacing="0" height="250">
<tr>
	<td style="padding:5" valign="top">
	' . @$disp . '
	</td>
</tr>
</table>

</div>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="50">
<tr>
	<td align="right" style="padding:10">
<input type=submit value=��������� class=but onClick="history.back(1);" name="btnLang2">
<input type=submit value=������� class=but onClick="return onCancel();" name="btnLang2">
	</td>
</tr>
</table>

');
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        else {

            while (list($val) = each($SysValue['base']))
                @$bases.=$SysValue['base'][$val] . ", ";

            $bases = substr($bases, 0, strlen($bases) - 2);
          
            ?>
            <TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
                <FORM method="post" name="sql_forma2" id="sql_forma2" encType="multipart/form-data">
                    <TBODY>
                        <TR class=adm vAlign=top align=middle>
                            <TD align=left>
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <FIELDSET><LEGEND id=lgdLayout><span name=txtLang id=txtLang>�������� SQL</span></LEGEND>
                                                <DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 185px; PADDING-TOP: 10px"><span name=txtLang id=txtLang>�������� ���� � �����������</span> *.sql&nbsp;&nbsp; <INPUT type=file size=70 name=file  id=csv_file>
                                                </DIV></FIELDSET>

                                        </td>
                                    </tr>
                                </table>
                            </TD>
                        </TR>
                        </TABLE>
                    <hr>
                    <table cellpadding="0" cellspacing="0" width="100%" height="50">
                        <tr>
                            <td align="left" style="padding:10">
                                <BUTTON class="help" onclick="helpWinParent('sql_file')">�������</BUTTON></BUTTON>
                            </td>
                            <td align="right" style="padding:10">
                                <INPUT class=but onclick="SqlSend2()" type=button value=OK> 
                                <INPUT class=but type=reset value=����� name="btnLang"> 
                                <input type="hidden" name="sql_file" value="ok">
                                <input type=submit value=������ class=but onClick="return onCancel();" name="btnLang">
                            </td>
                        </tr>
                    </table>
                </FORM>
<? }
?>
    </body>
</html>

