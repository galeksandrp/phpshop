<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

function TestCat($n) {// ���� �� ��� �����������
    global $SysValue;
    $sql = "select id from " . $SysValue['base']['table_name30'] . " where PID='$n'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

function Vivod_rekurs($n) {// ����� ������������ ��������
    global $SysValue;
    $sql = "select * from " . $SysValue['base']['table_name30'] . " where PID='$n' order by num";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $i = 0;
        $id = $row['id'];
        $city = $row['city'];
        $PID = $row['PID'];
        $num = TestCat($id);

        if ($i < $num) {// ���� ���� ��� ��������
            @$disp.="d2.add($id,$n,'$city','');
" . Vivod_rekurs($id) . "
";
        } else {// ���� ��� ���������
            @$disp.="d2.add($id,$n,'$city','" . DispName($PID, $city) . "');";
        }
    }
    return @$disp;
}

function Delivery_Cat($PID = 0) {
    global $SysValue;

    $sql = "select * from " . $SysValue['base']['table_name30'] . " where PID=" . intval($PID) . " AND is_folder='1'  order by city";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $PID = $row['PID'];
        $city = $row['city'];
        $enabled = $row['enabled'];
        $free_en = $row['price_null_enabled'];
        $free = $row['price_null'];
        $taxa = $row['taxa'];
        $price = $row['price'];
        if (($enabled) == "1") {
            $checked = "";
        } else {
            $checked = '[����!]';
        };

        $sqlnums = 'select * from ' . $SysValue['base']['table_name30'] . ' where PID=' . $id . ' order by city';
        $resultnums = mysql_query($sqlnums);
        @$nums = mysql_num_rows(@$resultnums);

        if ($nums) {
            $nums = '(' . $nums . ')';
        } else {
            $nums = '';
        }

        $name = trim($checked . ' ' . $city . ' ' . $nums);
        @$display.="
	d2.add($id,$PID,'$name','" . DispName($PID, $city) . "');
	" . Delivery_Cat($id);
    }

    return $display;
}

//����� Delivery_Cat

function DispName($n, $catalog) {
    global $SysValue;
    $sql = "select city from " . $SysValue['base']['table_name30'] . " where id='$n'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $city = $row['city'];
    return $city . " => " . $catalog;
}

function Vivod_pot() {// ����� ���������

    $dis = "
<script type=\"text/javascript\">
		<!--
		d2 = new dTree('d2');
		d2.add(0,-1,'<B>������ ��������</B>');
        " . Delivery_Cat() . "
		document.write(d2);";
    if ($_GET['category'] != "") {
        $dis.="d2.openTo(" . $_GET['category'] . ", true);";
    }
    $dis.="
		//-->
	</script>";
    return $dis;
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <title>�������</title>
        <META http-equiv="Content-Type" content="text-html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <LINK href="../css/dtree.css" type=text/css rel=stylesheet>
        <SCRIPT language=JavaScript1.2 src="../java/dtree4.js" type=text/javascript></SCRIPT>
        <script language="JavaScript">
        // ��������� ����
            function CloseWindow() {
                window.close();
            }

        // ������
            function My(name, cat) {
        //alert(name+","+cat)
                window.opener.document.getElementById('myName').value = name;
                window.opener.document.getElementById('myCat').value = cat;
                window.close();
            }

        </script>

    </head>

    <body bottommargin="0" leftmargin="5" topmargin="0" rightmargin="5"">
        <div align="center" style="padding:5"><a href="javascript: window.d2.openAll();"><?= $SysValue['Lang']['Category'][5] ?></a> | <a href="javascript: window.d2.closeAll();"><?= $SysValue['Lang']['Category'][6] ?></a> | <a href="javascript: window.close()"><?= $SysValue['Lang']['Category'][7] ?></a></div>
        <table cellpadding="0" cellspacing="0" bgcolor="ffffff" style="border: 2px;border-style: inset;" width="100%" height="350">
            <tr>
                <td valign="top">
<? echo Vivod_pot(); ?>
                </td>
            </tr>
        </table>
        <div align="center" style="padding:5"><a href="javascript: window.d2.openAll();"><?= $SysValue['Lang']['Category'][5] ?></a> | <a href="javascript: window.d2.closeAll();"><?= $SysValue['Lang']['Category'][6] ?></a> | <a href="javascript: window.close()"><?= $SysValue['Lang']['Category'][7] ?></a></div>
    </body>
</html>
