<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");

function TestCat($n) {// ���� �� ��� �����������
    global $SysValue;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where parent_to='$n'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

function Vivod_rekurs($n) {// ����� ������������ ��������
    global $SysValue, $sid;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to='$n' order by num";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $i = 0;
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $parent_to = $row['parent_to'];
        $num = TestCat($id);

        if ($i < $num) {// ���� ���� ��� ��������
            @$disp.="d2.add($id,$n,'$name','');
" . Vivod_rekurs($id) . "
";
        } else {// ���� ��� ���������
            @$disp.="d2.add($id,$n,'$name','" . DispName($parent_to, $name) . "');";
        }
    }
    return @$disp;
}

function DispName($n, $catalog) {
    global $SysValue;
    $sql = "select name from " . $SysValue['base']['table_name'] . " where id='$n'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name = str_replace(array('"', "'"), " ", $row['name']);
    return $name . " => " . $catalog;
}

function Vivod_pot() {// ����� ���������
    global $SysValue, $system, $category;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to=0 order by num";
    $result = mysql_query($sql);
    $i = 0;
    $j = 0;
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $num = TestCat($id);
        if ($num > 0)
            @$dis.="
	d2.add($id,0,'$name','');
	" . Vivod_rekurs($id) . "
	";
        else
            @$dis.="
	d2.add($id,0,'$name','$name');
	" . Vivod_rekurs($id) . "
	";



        $i++;
    }
    $dis = "
<script type=\"text/javascript\">
		<!--
		d2 = new dTree('d2');
		d2.add(0,-1,'<b>" . $SysValue['Lang']['Category'][1] . "</b>','������');
		
        " . $dis . "
		d2.add(1000003,0,'" . $SysValue['Lang']['Category'][14] . "','" . DispName(1000003, $SysValue['Lang']['Category'][14]) . "','','','../img/imgfolder.gif','');
" . Vivod_rekurs(1000003) . "
		document.write(d2);";
    if ($category != "") {
        $dis.="d2.openTo(" . $category . ", true);";
    }
    $dis.="
		//-->
	</script>
";
    return $dis;
}

function Vivod_cat_all_num($n) {// ����� ���-�� ������� �� ������� �����������
    global $SysValue;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where category='$n' and enabled='1'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <title><?= $SysValue['Lang']['Category'][1] ?></title>
        <META http-equiv="Content-Type" content="text-html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/dtree.css" type=text/css rel=stylesheet>
        <SCRIPT language=JavaScript src="../java/dtree4.js" type=text/javascript></SCRIPT>
        <script language="JavaScript">
            // ��������� ����
            function CloseWindow() {
                window.close();
            }

            // ������
            function My(name, cat) {

                window.opener.document.getElementById('parent_name').value = name;

                if (window.opener.document.getElementById('category_new'))
                    window.opener.document.getElementById('category_new').value = cat;

                if (window.opener.document.getElementById('parent_to_new'))
                    window.opener.document.getElementById('parent_to_new').value = cat;

                window.close();
            }

        </script>

    </head>

    <body bottommargin="0" leftmargin="5" topmargin="0" rightmargin="5">
        <div align="center" style="padding:5px"><a href="javascript: window.d2.openAll();"><?= $SysValue['Lang']['Category'][5] ?></a> | <a href="javascript: window.d2.closeAll();"><?= $SysValue['Lang']['Category'][6] ?></a> | <a href="javascript: window.close()"><?= $SysValue['Lang']['Category'][7] ?></a></div>
        <table cellpadding="3" cellspacing="3" bgcolor="ffffff" style="border: 1px;border-style: inset;padding:3px" width="100%" height="85%">
            <tr>
                <td valign="top">
                    <? echo Vivod_pot(); ?>
                </td>
            </tr>
        </table>
        <div align="center" style="padding:5px"><a href="javascript: window.d2.openAll();"><?= $SysValue['Lang']['Category'][5] ?></a> | <a href="javascript: window.d2.closeAll();"><?= $SysValue['Lang']['Category'][6] ?></a> | <a href="javascript: window.close()"><?= $SysValue['Lang']['Category'][7] ?></a></div>
    </body>
</html>
