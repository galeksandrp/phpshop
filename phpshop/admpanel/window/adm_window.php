<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
// �����
$GetSystems = GetSystems();
$option = unserialize($GetSystems['admoption']);
require("../language/russian/language.php");

// ������ �� ������
function GetValuta($id) {
    global $SysValue;
    $sql = "select * from " . $SysValue['base']['table_name24'] . " where id=" . intval($id);
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row;
}

function Ras_data_content($string) {// ������ ��������
    global $table_name8, $GetSystems, $SysValue;
    $sql = "select * from $table_name8  where id='0' $string";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $data = $row['datas'];
        $zag = $row['zag'];
        $kratko = strip_tags($row['kratko']);
        $podrob = $row['podrob'];
        if ($podrob != "") {
            $link = "<a href=\"http://" . $_SERVER['SERVER_NAME'] . $SysValue['dir']['dir'] . "/news/ID_" . $id . ".html\">����� &raquo;</a>";
        } else {
            $link = "";
        }
        @$content.="
  <p>
<table>
<tr>
  <td class=date>$data</td>
  <td><strong>$zag</strong></td>
</tr>
</table>
$kratko
<div align=\"right\">" . $link . "</div>
</p>";
    }

    $disp = '
<html>
<head>
<style>
body, td{
font-family: Tahoma;
font-size: 11px;
background-color: #FFFFFF;
}
H1{
   FONT-SIZE: 15px;
   color: #0068B9;
}

.date{
   background-color:#1982C6;
   color: white;
   padding:5px
}


a{
  color: #0068B9;
}

</style>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td>
  <h1>������������, ������������ ������� � ����� "' . $GetSystems['name'] . '"</h1>
  </td>
  <td align="right"><a href="http://' . $_SERVER['SERVER_NAME'] . $SysValue['dir']['dir'] . '" target="_blank" title="' . $SERVER_NAME . '"><img src="http://' . $_SERVER['SERVER_NAME'] . $SysValue['dir']['dir'] . $GetSystems['logo'] . '" alt="' . $GetSystems['name'] . '"  border="0"></a></td>
</tr>
<tr>
   <td colspan="2" style="background-color:#1982C6;" height="3"></td>
</tr>
</table>

' . @$content . '


<em>� ���������,<br>
��������� ' . $GetSystems['company'] . '</em>
<br><br><br>
</body>
</html>
';
    return @$disp;
}

function Ras_data_mail($content, &$num, $id = "") {// �� ���� ����...
    global $table_name27, $GetSystems;
    $codepage = "windows-1251";
    $header = "MIME-Version: 1.0\n";
    $header .= "From: " . $GetSystems['name'] . " <" . $GetSystems['adminmail2'] . ">\n";
    $header .= "Content-Type: text/html; charset=$codepage\n";
    $header .= "X-Mailer: PHP/";
    $zag = "������ �������� " . $GetSystems['name'];

    if (empty($id))
        $sql = "select mail from $table_name27 where enabled='1'";
    else
        $sql = "select mail from $table_name27 where id=" . intval($id);

    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $mail_to = $row['mail'];
        mail($mail_to, $zag, $content, $header);
        @$num++;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>��������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/dateselector.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="../java/popup_lib.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="../java/dateselector.js"></SCRIPT>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <?
        $Name = $SysValue['Lang']['Window'];

        function GetInfoUsers($n) {
            global $SysValue;
            $sql = "select * from " . $SysValue['base']['table_name27'] . " where id=".intval($n);
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            return $row;
        }

        function GetInfoProduct($n) {
            global $SysValue;
            $sql = "select name, sklad, uid, price, datas, baseinputvaluta  from " . $SysValue['base']['table_name2'] . " where id=".intval($n);
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            return $row;
        }

        function dispPage() { // ����� ������ �� ����
            global $SysValue;
            $array = explode(",", $array);
            $sql = "select * from " . $SysValue['base']['table_name11'] . " order by num";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $link = $row['link'];
                $name = substr($row['name'], 0, 200);
                @$dis.="<option value=" . $link . ">" . $name . "</option>\n";
            }
            @$disp = "
<select name=page_new[] size=5 style=\"width: 280;\" multiple>

$dis
</select>
";
            return @$disp;
        }

        function dispValue($n) { // ����� �������������
            global $SysValue;
            $dis=null;
            $sql = "select * from " . $SysValue['base']['table_name21'] . " where category=".intval($n)." order by num";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $id = $row['id'];
                $name = substr($row['name'], 0, 35);
                $dis.="<option value=" . $id . ">" . $name . "</option>\n";
            }
            $disp = "
<select name=vendor_new[" . $n . "][] size=1 style=\"width: 250;\">
<option value=''>��� ������</option>
$dis
</select>
";
            return @$disp;
        }

        function DispCatSort($category, &$h) {
            global $SysValue;
            $disp=null;
            $sql = "select sort from " . $SysValue['base']['table_name'] . " where id=".intval($category);
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            $sort = unserialize($row["sort"]);
            if (is_array($sort))
                foreach ($sort as $v) {
                    $sql = "select * from " . $SysValue['base']['table_name20'] . " where id=$v order by name";
                    $result = mysql_query($sql);
                    while (@$row = mysql_fetch_array($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $disp.= '
<div style="padding-top:7">
<FIELDSET id=fldLayout >
<LEGEND><input type="checkbox" name="vendor_cat[' . $id . ']" value="1"> ' . $name . '</LEGEND>
<div style="padding:10">
' . dispValue($id) . '
</div>
</FIELDSET>
</div>
';
                        @$n++;
                    }
                }
            $h = $h + (55 * $n);
            return $disp;
        }

//����� �������

        if ($do == 14) {
            echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<br>
<FIELDSET>
<legend>��������� � �������</legend>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  <input type=text id="parent_name" style="width:300px" value="">
<input type="hidden" name="category_new" id="category_new">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'../catalog/adm_cat.php\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
  </td>
</tr></table>
 </FIELDSET>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 37) { // �������� ������ �������
            $sql = "select * from " . $SysValue['base']['table_name32'];
            $result = mysql_query($sql);
            while (@$row = mysql_fetch_array(@$result)) {
                if ($n == $row['id'])
                    $sel2 = "selected";
                else
                    $sel2 = "";

                if ($row['sklad_action'] == 1)
                    $sel1 = " (�������/������� ����)";
                else
                    $sel1 = "";

                @$dis.="<option value='" . $row['id'] . "' $sel2>" . $row['name'] . $sel1 . "</option>";
            }

            echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  ������:<br>
<select name=statusi_new>
<option value=0>����� �����</option>
' . @$dis . '
</select>
  <br>
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        }
        elseif ($do == "rss4") { // �������� ���� ������ RSS �������
            echo'<form name="product_edit" id="product_edit"  method="post">
<script>
DoResize(' . $GetSystems['width_icon'] . ',400,300);
</script>
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  <FIELDSET style="height:30px">
<LEGEND>���� ������ (dd-mm-yyyy)</LEGEND>
<div style="padding:10">
�&nbsp;&nbsp;
<input type="text" name="start_date_new" id="start_date_new"  maxlength="10" value="' . date("d-m-Y") . '" style="width:80px;">
<IMG onclick="popUpCalendar(this, product_edit.start_date_new, \'dd-mm-yyyy\');" height=16 hspace=3 src="../icon/date.gif" width=16 border=0 align="absmiddle">
��
<input type="text" name="end_date_new"  maxlength="10" value="' . date("d-m-Y") . '" style="width:80px;" >
<IMG onclick="popUpCalendar(this, product_edit.end_date_new, \'dd-mm-yyyy\');" height=16 hspace=3 src="../icon/date.gif" width=16 border=0 align="absmiddle">
</div>
</FIELDSET>
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 34) { // �������� ���������� � �������
            echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<br>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  <span name=txtLang id=txtLang><u>�</u>�������� � �������</span><br>
  <input type=text id="myName"  style="width: 230" value="">
<input type="hidden" name="category_new" id="myCat">
<BUTTON style="width: 3em; height: 2.2em; margin-left:5"  onclick="miniWinFull(\'../page/adm_cat.php\',300,400,300,200)"><img src="../img/icon-move-banner.gif"  width="16" height="16" border="0"></BUTTON>
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 15) {
            echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  <FIELDSET>
  <legend><u>�</u>����� ��� ��������� ������</legend>
  <input type=text name="uid_new"  style="width: 280"><br>
  <span name=txtLang id=txtLang>* ������� �������������� (ID) ������� ����� �������</span> (100,101). 
  </FIELDSET>
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 35) { // ��������������� ������ ��� �������
            echo'
<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  <span name=txtLang id=txtLang><u>�</u>����� ��� ������������</span><br>
  <input type=text name="uid_new"  style="width: 280"><br>
  <span name=txtLang id=txtLang>* ������� �������������� (ID) ������� ����� �������</span> (100,101). ������ ����� ��������� ��������.
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr>
  <td align="right" style="padding:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 222) { //�����. �������� �� ��������� 
            $systems = GetSystems();

            echo'
<script>
DoResize(' . $GetSystems['width_icon'] . ',600,450);
function enable_div() {
if (document.getElementById(\'nid_new\').value=="0") {
//alert("we");
  document.getElementById(\'Message_new\').disabled=false;
  document.getElementById(\'Message_new\').value="";

} else {
//alert("we");
  document.getElementById("Message_new").disabled=true;
  document.getElementById("Message_new").value="����� ��������� ����� ��������� ���� �������!";

}
}


</script>
<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ��������� ��� ��������</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7" style="width: 100%;">
<tr><td>
  <span name=txtLang id=txtLang><u>�</u>���� ��������� ��� ��������:</span><br>
  <input type="TEXT" id="Message_new" name="Message_new" style="width:100%; height:200px;">
  </td></tr><tr><td>
  <span name=txtLang id=txtLang>��� �������� ������� ��� ��������:</span><br>
  <select id="nid_new" name="nid_new" onChange="enable_div(); ">
  <option value="0" selected>[��������� ����������� ���������]</option>';
            $sql = 'select id,zag,datas from ' . $SysValue['base']['table_name8'] . ' ORDER by id LIMIT 25';
            $result = mysql_query($sql);
            $lvl++;
            while ($row = mysql_fetch_array($result)) {
                $nid = $row['id'];
                $nzag = $row['zag'];
                $ndate = $row['datas'];
                echo '<option value="' . $nid . '">' . $nzag . ' (' . $ndate . ')</option>';
            }

            echo'</select></td></tr></table>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="40" >
<tr><td align="right" style="padding:10">
  <input type=submit value=�� class=but name=productSAVE>
  <input type=submit value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td></tr></table></form>';
        } elseif ($do == 23) {
            echo'<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<table cellpadding="0"  cellspacing="7">
<tr>
  <td>
  ' . dispPage() . '
  </td>
</tr></table>

<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="30" >
<tr>
  <td align="right" style="padding-right:10">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } elseif ($do == 24) {
            $h = 220;
            echo'
<form  method="post">
<table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
<tr bgcolor="#ffffff">
  <td style="padding:10">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align="right">
  <img src="../img/i_documentation_med[1].gif" border="0" hspace="10">
  </td>
</tr>
</table>
<div style="height:350;overflow:auto"> 
<table width="100%">
<tr>
  <td>
  ' . DispCatSort($catal, $h) . '
  </td>
</tr>
</table>
</div>
<script>
DoResize(' . $GetSystems['width_icon'] . ',300,500);
</script>
<hr>
<table cellpadding="0" cellspacing="0" width="100%" height="30" >
<tr>
  <td align="right" style="padding-right:10">
  <input type=submit value=�� class=but name=productSAVE>
  <input type=submit name="btnLang" value=������ class=but onClick="return onCancel();">
  <input type=hidden name=IDS value="' . $ids . '">
  <input type=hidden name=DO value="' . $do . '">
  </td>
</tr>
</table>
</form>
';
        } else {
            echo"
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" id=\"title\">
<tr bgcolor=\"#ffffff\">
  <td style=\"padding:10\">
  <b><span name=txtLang id=txtLang>��������</span></b><br>
  &nbsp;&nbsp;&nbsp;<span name=txtLang id=txtLang>������� ������ ��� ������ � ����</span>.
  </td>
  <td align=\"right\">
  <img src=\"../img/i_documentation_med[1].gif\" border=\"0\" hspace=\"10\">
  </td>
</tr>
</table>
<br>
<form action=\"$PHP_SELF\" method=\"post\">
  <div style=\"padding:10\" align=\"center\">
  ";
            if ($action == "wait")
                echo $SysValue['Lang']['System']['load'] . "
  <div align=center style=\"padding: 5px\">
  <img src=\"../img/loader2.gif\"  width=220 height=19 border=0>
  </div>
  ";
            else
                echo "
  <span name=txtLang id=txtLang>�� �������, ��� ������</span> <b>" . $SysValue['Lang']['Window'][$do] . "</b>? <br>
";
            echo "
  </div>
<hr>
<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"50\" >
<tr>
  <td align=\"right\" style=\"padding:10\">
<input type=submit value=�� class=but name=productSAVE>
  <input type=submit name=btnLang value=������ class=but onClick=\"return onCancel();\">
  <input type=hidden name=IDS value='$ids'>
  <input type=hidden name=DO value='$do'>
  <input type=hidden name=action value='wait'>
  </td>
</tr>
</table>
</form>
";
        }
        if (CheckedRules($UserStatus["cat_prod"], 1) == 1) {
            if (isset($productSAVE)) {// ������ ��������������
                $IdsArray = split(",", $IDS);

                if ($DO == 1) {// ������� �����
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from $table_name2 
    where id='0' $string;";
                    $pageReload = "cat_prod";
                } elseif ($DO == 2) {// � ����������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
spec='1'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 3) {// �� ���������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
spec='0'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 4) {// �� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
enabled='0'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 5) {// � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
enabled='1'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 47) {// ��������� �������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";



                    $num = 0;
                    $content = Ras_data_content($string);
                    Ras_data_mail($content, $num);


                    $pageReload = "news";
                } elseif ($DO == 48) {// ��������� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name7'] . "
SET
flag='0'
where id='0' $string";
                    $pageReload = "gbook";
                } elseif ($DO == 50) {// �������� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name7'] . "
SET
flag='1'
where id='0' $string";
                    $pageReload = "gbook";
                } elseif ($DO == 49) {// ������� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";


                    $sql = "delete from " . $SysValue['base']['table_name7'] . " 
    where id='0' $string;";

                    $pageReload = "gbook";
                } elseif ($DO == 6) {// �� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
yml='0'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 7) {// � �����
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
yml='1'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 8) {// � CSV
                    $sql = "--";
                    echo"
<script>
window.open('../export/adm_csv.php?IDS=" . $IDS . "');
</script>
";
                    $pageReload = "cat_prod";
                } elseif ($DO == 10) {// � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
newtip='1'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 11) {// �� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
newtip='0'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 12) {// �������� �����
                    $sql = "UPDATE $table_name5
SET
total='0'
where category='$IDS'";
                    $pageReload = "opros";
                } elseif ($DO == 14 and !empty($category_new)) {// ��������� � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE $table_name2
SET
category='$category_new'
where id='0' $string";
                    $pageReload = "cat_prod";
                } elseif ($DO == 34 and !empty($category_new)) {// ��������� � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
category='$category_new'
where id='0' $string";
                    $pageReload = "page";
                } elseif ($DO == 37) {// �������� ������� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name1'] . "
SET
statusi='$statusi_new'
where id='0' $string";
                    $pageReload = "orders";
                } elseif ($DO == 41) {// ������� �����������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name36'] . "
    where id='0' $string";
                    $pageReload = "comment";
                } elseif ($DO == 35 and !empty($uid_new)) {// ��������������� ������ ��� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
odnotip='$uid_new'
where id='0' $string";
                    $pageReload = "page";
                } elseif ($DO == 15) {// ��������� ����� � ���� ������
                    foreach ($IdsArray as $v)
                        @$string.="i" . $v . "i";
                    $sql = "INSERT INTO " . $SysValue['base']['table_name26'] . " 
VALUES ('','$string','$uid_new','1')";
                    $pageReload = "search_pre";
                } elseif ($DO == 16) {// ������� �� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name18'] . "
    where id='0' $string";
                    $pageReload = "search_jurnal";
                } elseif ($DO == 17) {// ������� �� ���� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name26'] . "
    where id='0' $string";
                    $pageReload = "search_pre";
                } elseif ($DO == 18) {// �� ��������� ��� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";
                    $pageReload = "search_pre";
                    $sql = "UPDATE " . $SysValue['base']['table_name26'] . "
SET
enabled='0'
where id='0' $string";
                    $pageReload = "search_pre";
                } elseif ($DO == 19) {// �������������� ��� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name26'] . "
SET
enabled='1'
where id='0' $string";
                    $pageReload = "search_pre";
                } elseif ($DO == 20) {// ������������� �������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name27'] . "
SET
enabled='0'
where id='0' $string";
                    $pageReload = "shopusers";
                } elseif ($DO == 21) {// �������������� �������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name27'] . "
SET
enabled='1'
where id='0' $string";
                    $pageReload = "shopusers";

/////////////////////////////////////////////////////////////////////�����///////////////////
                } elseif ($DO == 222) {// ��������� ���������

                    function Systems() {// ����� ��������
                        global $SysValue;
                        $sql = "select * from " . $SysValue['base']['table_name3'];
                        $result = mysql_query($sql);
                        $row = mysql_fetch_array($result);
                        return $row;
                    }

                    $systems = Systems();

                    if ($nid_new == 0) { //���� ��������� �������� ���������, ��������� �� ���. ���-�� �������� ��������� �������
                        foreach ($IdsArray as $v) {//������� �������������, �������� ������� ��������� � �������� ����� � ����
                            $UID = $v;
                            $DateTime_new = date("Y-m-d H:i:s");
                            $Subject_new = '��������� ��������������!';
//$Message_new=$Message_new;
                            $sql = 'INSERT INTO ' . $SysValue['base']['table_name37'] . '
VALUES ("",0,' . $UID . ',' . $_SESSION['idPHPSHOP'] . ',\'' . $DateTime_new . '\',\'' . $Subject_new . '\',\'' . $Message_new . '\',1)';
                            $result = mysql_query($sql) or @die("" . mysql_error());

//�������� ��������� ������������
                            $UsersId = $UID;
                            $sql = "select * from " . $SysValue['base']['table_name27'] . " where id=".intval($UsersId)." LIMIT 0, 1";
                            $result = mysql_query($sql);
                            $row = mysql_fetch_array($result);
                            $id = $row['id'];
                            $login = $row['login'];
                            $password = $row['password'];
                            $status = $row['status'];
                            $mail = $row['mail'];
                            $name = $row['name'];
                            $company = $row['company'];
                            $inn = $row['inn'];
                            $tel = $row['tel'];
                            $adres = $row['adres'];



                            $codepage = "windows-1251";
                            $header_adm = "MIME-Version: 1.0\n";
                            $header_adm .= "From:   <" . $systems['adminmail2'] . ">\n";
                            $header_adm .= "Content-Type: text/plain; charset=$codepage\n";
                            $header_adm .= "X-Mailer: PHP/";
                            $zag_adm = $systems['name'] . " -  ��������� �� ��������������";
                            $content_adm = "
������� �������!
--------------------------------------------------------

��������� ��������� �������������� � ��������-�������� '" . $systems['name'] . "'
---------------------------------------------------------

" . $Message_new . "

����/�����: " . date("d-m-y H:i a") . "
---------------------------------------------------------

�� ������ ������ ����������� ���� ���������
��-���� ����� '������ �������' -> '����� � ����������' 
��� �� ������ http://" . $SERVER_NAME . $SysValue['dir']['dir'] . "/users/message.html

Powered & Developed by www.PHPShop.ru";
                            mail($mail, $zag_adm, $content_adm, $header_adm);
                        }//����� �������� �������� ���������

                        echo '<B>��������� ����������!</B> ������ ��������� ��� ���� �����.';
                    } //����� ���� ���������� ���������
                    else { //���� ������� �������, ��������� �� ������������ ��������� �������� ��������
                        foreach ($IdsArray as $v) {//������� �������������, �������� ������� ���������
                            $content = Ras_data_content("or id=" . $nid_new);
                            Ras_data_mail($content, $num, $v);
                        }

                        echo '<B>������� ���������!</B> ������ ��������� ���, ���� �����!';
                    } //����� ���� ������� �������
/////////////////////////////////////////////////////////////////////�����///////////////////
                } elseif ($DO == 42) {// ������� ��������� �������������
                    $sql = "delete from " . $SysValue['base']['table_name37'] . "
where UID='$IDS'";
                    $pageReload = "shopusers_messages";
                } elseif ($DO == 22) {// ������� �������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name27'] . "
    where id='0' $string";
                    $pageReload = "shopusers";
                } elseif ($DO == 43) {// ������ ������� ������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";


                    $sql = "UPDATE " . $SysValue['base']['table_name36'] . "
SET
enabled='1' 
where id='0' $string";
                    $pageReload = "comment";
                } elseif ($DO == 46) {// ������� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name8'] . "
    where id='0' $string";
                    $pageReload = "news";
                } elseif ($DO == 44) {// ������������� ����� ������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";


                    $sql = "UPDATE " . $SysValue['base']['table_name36'] . "
SET
enabled='0' 
where id='0' $string";
                    $pageReload = "comment";
                } elseif ($DO == 23) {// ������������ ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    if (is_array($page_new))
                        foreach ($page_new as $value)
                            @$page.=$value . ",";

                    $sql = "UPDATE $table_name2
SET
page='$page' 
where id='0' $string";
                    $pageReload = "cat_prod";
                }
                elseif ($DO == 25) {// ��������� �����������
                    require_once "../../lib/sms/smsmmapi.php";
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "select * from " . $SysValue['base']['table_name34'] . " where id='0' $string";
                    @$result = mysql_query(@$sql);
                    while (@$row = mysql_fetch_array(@$result)) {
                        $id = $row['id'];
                        $datas = $row['datas'];
                        $datas_start = $row['datas_start'];
                        $user_id = $row['user_id'];
                        $product_id = $row['product_id'];

                        $User = GetInfoUsers($user_id);
                        $Product = GetInfoProduct($product_id);
                        $price = ($Product['price'] + (($Product['price'] * $GetSystems['percent']) / 100));
                        $valuta = GetValuta($Product['baseinputvaluta']);

// ���� ������
                        $codepage = "windows-1251";
                        $header_adm = "MIME-Version: 1.0\n";
                        $header_adm .= "From:   <" . $GetSystems['adminmail2'] . ">\n";
                        $header_adm .= "Content-Type: text/plain; charset=$codepage\n";
                        $header_adm .= "X-Mailer: PHP/";
                        $zag_adm = $GetSystems['name'] . " - ��������� ����������� � ������, ������ �$id ";



                        $content_adm = "
������� �������!
--------------------------------------------------------

��������� ����������� �$id � ��������-�������� '" . $GetSystems['name'] . "' ��� ������������ " . $User['name'] . "

�����: " . $Product['name'] . "
���: " . $Product['uid'] . "
������� ���������: " . $price . " " . $valuta['code'] . "
���� ��������� ���������� �� ������: " . dataV($Product['datas']) . "
����: http://" . $SERVER_NAME . "/shop/UID_" . $product_id . ".html
���� ����������� ������: " . dataV($datas_start) . "
���������� ������ ��: " . dataV($datas) . "

---------------------------------------------------------

Powered & Developed by www.PHPShop.ru";
                        mail($User['mail'], $zag_adm, $content_adm, $header_adm) or die("�� ���� ��������� �����������");

// ��������� �����������
                        mysql_query("UPDATE " . $SysValue['base']['table_name34'] . " SET enabled='1' where id=".intval($id));

// �������� SMS
                        if ($option['notice_enabled'] == 1) {
                            $msg = "����� �������� � �������, �����������: http://$SERVER_NAME/shop/UID_$product_id.html";
                            $phone = $User['tel_code'] . "" . $User['tel'];
                            SendSMS($msg, $phone);
                        }
                    }

                    $pageReload = "shopusers_notice";
                } elseif ($DO == 26) {// ������� �����������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name34'] . "
    where id='0' $string";
                    $pageReload = "shopusers_notice";
                } elseif ($DO == 39) {// ������� ��������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name11'] . "
    where id='0' $string";
                    $pageReload = "page";
                } elseif ($DO == 40) {// ������� ����������� � ������ ��� ����� ������
                    $sql = "delete from " . $SysValue['base']['table_name35'] . " where parent=$IDS";
                    $pageReload = "";
                } elseif ($DO == 27) {// �������� ��� ��� � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name2'] . "
SET
sklad='1'
where id='0' $string";

                    $pageReload = "cat_prod";
                } elseif ($DO == 28) {// �������� ��� ���� � �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name2'] . "
SET
sklad='0'
where id='0' $string";

                    $pageReload = "cat_prod";
                } elseif ($DO == 30) {// �������� ������� ��� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
enabled='1'
where id='0' $string";

                    $pageReload = "page";
                } elseif ($DO == 31) {// �������� ������� ��� ������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
enabled='0'
where id='0' $string";

                    $pageReload = "page";
                } elseif ($DO == 32) {// �������� ������� ������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
secure='1'
where id='0' $string";

                    $pageReload = "page";
                } elseif ($DO == 33) {// �������� ������� ������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "UPDATE " . $SysValue['base']['table_name11'] . "
SET
secure='0'
where id='0' $string";

                    $pageReload = "page";
                } elseif ($DO == 29) {// ������������� ��������� �����������
                    $sql = "select * from " . $SysValue['base']['table_name34'] . " where datas>'" . date("U") . "' and enabled='0'";

                    $result = mysql_query($sql);
                    while (@$row = mysql_fetch_array(@$result)) {
                        $id = $row['id'];
                        $datas = $row['datas'];
                        $datas_start = $row['datas_start'];
                        $user_id = $row['user_id'];
                        $product_id = $row['product_id'];

                        $User = GetInfoUsers($user_id);
                        $Product = GetInfoProduct($product_id);

                        if ($Product['sklad'] == 0) {

// ���� ������
                            $codepage = "windows-1251";
                            $header_adm = "MIME-Version: 1.0\n";
                            $header_adm .= "From:   <" . $GetSystems['adminmail2'] . ">\n";
                            $header_adm .= "Content-Type: text/plain; charset=$codepage\n";
                            $header_adm .= "X-Mailer: PHP/";
                            $zag_adm = $GetSystems['name'] . " - ��������� ����������� � ������, ������ �$id ";

                            $content_adm = "
������� �������!
--------------------------------------------------------

��������� ����������� �$id � ��������-�������� '" . $GetSystems['name'] . "' ��� ������������ " . $User['name'] . "

�����: " . $Product['name'] . "
���: " . $Product['uid'] . "
������� ���������: " . $Product['price'] . "
���� ��������� ���������� �� ������: " . dataV($Product['datas']) . "
����: http://" . $_SERVER['SERVER_NAME'] . $GLOBALS['SysValue']['dir']['dir'] . "/shop/UID_" . $product_id . ".html
���� ����������� ������: " . dataV($datas_start) . "
���������� ������ ��: " . dataV($datas) . "

---------------------------------------------------------

Powered & Developed by www.PHPShop.ru";
                            mail($User['mail'], $zag_adm, $content_adm, $header_adm);

// ��������� �����������
                            mysql_query("UPDATE " . $SysValue['base']['table_name34'] . " SET enabled='1' where id=$id");


// �������� SMS
                            if ($option['notice_enabled'] == 1) {
                                $msg = "����� �������� � �������, �����������: http://$SERVER_NAME/shop/UID_$product_id.html";
                                $phone = $User['tel_code'] . "" . $User['tel'];
                                SendSMS($msg, $phone);
                            }
                        }
                    }

                    $pageReload = "shopusers_notice";
                } elseif ($DO == 36) {// ������� �� �������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "delete from " . $SysValue['base']['table_name1'] . "
    where id='0' $string";
                    $pageReload = "orders";
                } elseif ($DO == 45) {// ��������� ������ � 1�:�����������
                    $sql = "--";
                    echo"
<script>
window.open('../1c/orders_export.php?IDS=" . $IDS . "');
</script>
";
                    $pageReload = "orders";
                } elseif ($DO == "rss1") {// ������� �� RSS �������
                    if (CheckedRules($UserStatus["rsschanels"], 1) == 1) {
                        foreach ($IdsArray as $v)
                            @$string.="or id='$v' ";

                        $sql = "delete from " . $SysValue['base']['table_name38'] . "
    where id='0' $string";
                        $pageReload = "rssgraber_chanels";
                    }
                    else
                        $UserChek->BadUserFormaWindow();
                }
                elseif ($DO == "rss2") {// �������� RSS ������
                    if (CheckedRules($UserStatus["rsschanels"], 1) == 1) {
                        foreach ($IdsArray as $v)
                            @$string.="or id='$v' ";

                        $sql = "UPDATE " . $SysValue['base']['table_name38'] . " SET enabled = '1'
    where id='0' $string";
                        $pageReload = "rssgraber_chanels";
                    }
                    else
                        $UserChek->BadUserFormaWindow();
                }
                elseif ($DO == "rss3") {// �������� RSS ������
                    if (CheckedRules($UserStatus["rsschanels"], 1) == 1) {
                        foreach ($IdsArray as $v)
                            @$string.="or id='$v' ";

                        $sql = "UPDATE " . $SysValue['base']['table_name38'] . " SET enabled = '0'
    where id='0' $string";
                        $pageReload = "rssgraber_chanels";
                    }
                    else
                        $UserChek->BadUserFormaWindow();
                }
                elseif ($DO == "rss4") {// �������� RSS ������
                    if (CheckedRules($UserStatus["rsschanels"], 1) == 1) {
                        foreach ($IdsArray as $v)
                            @$string.="or id='$v' ";
                        $start_date_new = GetUnicTime($start_date_new);
                        $end_date_new = GetUnicTime($end_date_new);
                        $sql = "UPDATE " . $SysValue['base']['table_name38'] . " SET start_date = '$start_date_new', end_date = '$end_date_new'  
    where id='0' $string";
                        $pageReload = "rssgraber_chanels";
                    }
                    else
                        $UserChek->BadUserFormaWindow();
                }
                elseif ($DO == 24) {// ��������������
                    foreach ($IdsArray as $v)
                        @$string.="or id='$v' ";

                    $sql = "select id,vendor_array from $table_name2 where id='0' $string";
                    $result = mysql_query($sql);

//echo $sql;
//echo '�����:"'.mysql_num_rows(@$result).'"';
//������� ������� �� ������� ��� ������ ��������. ���� ������ ����, ������� � ��� ������
                    function cleanArray($arr) {
                        foreach ($arr as $key => $value) {
                            if (is_array($value)) {
                                $value = cleanArray($value);
                            } //���� �������� - ������,�� �������� ������� �������
                            if ($value == "") {
                                unset($arr[$key]);
                                if (count($arr) < 1) {
                                    return;
                                }
                            } //���� ��������� ������� ��� ��������� - ���������� false
                        }
                        return $arr;
                    }

//����� ������� 

                    while ($row = mysql_fetch_array($result)) { //������� ��������� �������
//������ ������������� �� ����� � ��� �� ���������
                        $vendor_array = unserialize($row['vendor_array']);  //��������� ������ ������ �������������
//���������� ���������� ���� ��������
                        if (is_array($save_arr))
                            $vendor_new = $save_arr;
                        $arr1 = cleanArray($vendor_array); //������� �������� �� �������
                        $arr2 = cleanArray($vendor_new); //������� �������� �� �������
                        $save_arr = $vendor_new;
//print_r($arr1);
//print_r($arr2);

                        if (is_array($arr1) && is_array($arr2)) { //���� ��� ��������� �������
                            foreach ($arr1 as $id => $values) { //������� �����
                                if (isset($arr2[$id])) { //���� ���� ������� �� ������ �������, ���� ��������� �������� �����������
                                    /*
                                      if (is_array($values) && is_array($arr2[$id])) { //���� ��� �������� �������
                                      $new_values=array_merge($values,$arr2[$id]); //����� �������� = ������ ������� ������� � ������ ��������
                                      } else if (is_array($values)) { //���� �� ������ ������
                                      $new_values=$values;
                                      $new_values[]=$arr2[$id];
                                      } else if (is_array($arr2[$id])) { //���� �� ������ ������
                                      $new_values=$arr2[$id];
                                      $new_values[]=$values;
                                      } else { //���� ��� �� �������
                                      if ($values!==$arr2[$id]) {//���� �������� ����������, ������ ������
                                      $new_values=array($values,$arr2[$id]);
                                      } else {//����� ���� �������� ����������.
                                      $new_values=$values;
                                      }

                                      }
                                      // */
                                    if ($arr2[$id])
                                        $new_values = $arr2[$id]; //���� ����� �������� true, ��������� ����� ��������
//    $new_values=array_unique($new_values); //��������� ���������� �������� � ������ (��� ������� �� ���������)
                                    $arr1[$id] = $new_values;
                                    unset($arr2[$id]); //����������� ���� ��������� ������� �� ������ �������
                                } //����� ���� ���� ������� �� ������ �������
                            }//����� ������� �����
//$arr3=array_merge($arr1,$arr2); //merge ����� ������������ �������� �������������. ���������� ������������ ������
                            $arr3 = $arr1 + $arr2;
//print_r($arr1);
//print_r($arr2);
                        } else if (is_array($arr1)) {
                            $arr3 = $arr1;
                        } else if (is_array($arr2)) {
                            $arr3 = $arr2;
                        } else {
                            $arr3 = "";
                        }
//����� ���������� ���������� ���� ��������

                        $idgood = $row['id']; //��������� id ������
                        $vendor_new = $arr3;

                        if (is_array($vendor_new)) { //���� ���������� ����� �������������� ������
                            $vendor = '';
                            foreach ($vendor_new as $k => $v) { //���������� �������� ����������� ������
                                if (is_array($v)) { //���� ������� ��������� ���������
                                    foreach ($v as $o => $p)
                                        @$vendor.="i" . $k . "-" . $p . "i";
                                } else { //���� ������ ���� �������
                                    @$vendor.="i" . $k . "-" . $v . "i";
                                }
                            } //����� ���������� �������� ����������� ������
                        } //����� �������� ������ �� ����� ���-��

                        $sqll = 'UPDATE ' . $table_name2 . ' SET vendor="' . $vendor . '", vendor_array="' . addslashes(serialize($vendor_new)) . '" where id=' . $idgood;
                        $resultt = mysql_query($sqll);
//print_r($vendor_new);
//echo $vendor;
//echo '"'.$sqll.'"';
                    } //����� ������� ��������� �������



                    /*
                      $sql="UPDATE $table_name2
                      SET
                      vendor='$vendor',
                      vendor_array='".serialize($vendor_new)."'
                      where id='0' $string";
                      // */
                    $pageReload = "cat_prod";

//echo($vendor);
                }

                $result = mysql_query($sql);
///*
                echo"
   <script>
   DoReloadMainWindow('$pageReload');
   </script>
     ";
//*/
            }
        }
        else
            $UserChek->BadUserFormaWindow();
        ?>
    </body>
</html>

