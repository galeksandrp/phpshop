<?php
error_reporting(0);
$_classPath = "../phpshop/";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("mail");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini",false);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<title><?php echo $SysValue['license']['product_name'] ?> -> ���������</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META name="ROBOTS" content="NONE">
<link href="<?php echo $SysValue['dir']['dir'] ?>/phpshop/admpanel/skins/1c/texts.css" type=text/css rel=stylesheet>
<script>
    function Warning() {
        return alert("��������!\n�� �������� �������� �������� ��� ������ � ������������ ����� config.ini");
    }

    function InstallOk() {
        try {
            window.opener.location.replace("../");
        } catch (e) {
            window.location.replace("../");
        }
        window.close();
    }

    function Readonlys() {
        return alert("��������!\n������ ��������������� ������ � ����� /phpshop/inc/config.ini");
    }

    function ChekRegLic() {
        var s1 = window.document.forms.regForma.selectLic.checked;
        if (s1 === false) {
            if (confirm("��������!\n��  �������� �  ������������ �����������?"))
                window.document.forms.regForma.selectLic.checked = true;
        }
        else
            document.regForma.submit();
    }


    function ChekApi() {
        var s1 = window.document.forms.regForma.errors.value;
        if (s1 === 1) {
            if (confirm("��������!\n���� ��������� ���������� �� �������, ������������ ����������� �������� ����������� �����.\n��� ����� ���������� ���������?"))
                window.document.forms.regForma.submit();
        }
        else
            document.regForma.submit();
    }

    function GenPassword(a) {
        document.getElementById("pas1").value = a;
        document.getElementById("pas2").value = a;
        alert("������������ ������: " + a);
    }

    function TestPas() {
        var pas1 = document.getElementById("pas1").value;
        var pas2 = document.getElementById("pas2").value;
        var login = document.getElementById("login").value;
        var mail = document.getElementById("mail").value;
        var mes_zag = "��������, ���������� ������ ��� ���������� �����:\n";
        var mes = "";
        var pattern = /\w+@\w+/;
        if (pas1.length < 6 || pas2.length < 6)
            mes += "-> ������ ������ ��������� �� ����� 6 ��������\n";
        if (pas1 != pas2)
            mes += "-> ������ ������ ���������\n";
        if (login.length < 4)
            mes += "-> ����� ������ ��������� �� ����� 4 ��������\n";
        if (pattern.test(mail) === false)
            mes += "-> �� ��������� ������� ���� 'E-mail'\n";
        if (mes != "")
            alert(mes_zag + mes);
        else
            document.install.submit();
    }

    // ���������� � �����
    function copyToClipboard() {
        try {
            document.getElementById('adm_option').select();
            var CopiedTxt = document.selection.createRange();
            CopiedTxt.execCommand("Copy");
            alert("������ ����������� � ����� ������.");
        } catch (e) {
            alert("������� ����������� �������� ������ ��� �������� IE");
        }
    }

</script>
</head>
<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">

    <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
        <tr bgcolor="#ffffff">
            <td style="padding:10">
                <b>���������  <?php echo $SysValue['license']['product_name'] ?></b><br>
                &nbsp;&nbsp;&nbsp;��������� ���������� � ������������ ����������
            </td>
            <td align="right">
                <img src="<?php echo $SysValue['dir']['dir'] ?>/phpshop/admpanel/img/i_server_info_med[1].gif" border="0" hspace="10">
            </td>
        </tr>
    </table>
    <?

    // ����� �����
    function GetFile() {
        $dir = "./";
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                $fstat = explode(".", $file);
                if ($fstat[1] == "sql")
                    $disp = $file;
            }
            closedir($dh);
        }
        return $disp;
    }

    // ������������� ����
    if ($_POST['install'] == 3) {
        
        $PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

        //�������� �����
        if ($_POST['pas_send'] == 1 and !empty($_POST['pas_send'])) {

            $zag = "PHPShop: ������ ��������� �� ������ " . $_SERVER['SERVER_NAME'];
            $content = "
������� �������!
---------------------------------------------------------

" . $SysValue['license']['product_name'] . " ������ ���������� �� ������ " . $_SERVER['SERVER_NAME'] . "

���������������� ������ �������� �� ������:  http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/
��� �������� Ctrl + F12

�����: " . $_POST['user'] . "
������: " . $_POST['password'] . "

---------------------------------------------------------
" . $SysValue['license']['product_name'];

            new PHPShopMail($_POST['mail'], 'no_reply@phpshop.ru', $zag, $content);
        }

        @$fp = fopen(GetFile(), "r");

        if ($fp) {
            stream_set_write_buffer($fp, 0);
            $fstat = fstat($fp);
            $CsvContent = fread($fp, $fstat['size']);
            $CsvContent = str_replace("phpshop_", $_POST['prefix'], $CsvContent);
            fclose($fp);
        }

        $IdsArray2 = explode(";\n", $CsvContent);
        if (count($IdsArray2) < 5) {
            $IdsArray2 = explode(";\r\n", $CsvContent);
        } // \r\n
        array_pop($IdsArray2);
        while (list($key, $val) = each($IdsArray2))
            $result = mysql_query($val);
        $result = mysql_query("INSERT INTO " . $_POST['prefix'] . "users VALUES (1, 0x613a32343a7b733a353a2267626f6f6b223b733a353a22312d312d31223b733a343a226e657773223b733a353a22312d312d31223b733a373a2276697369746f72223b733a373a22312d312d312d31223b733a353a227573657273223b733a373a22312d312d312d31223b733a393a2273686f707573657273223b733a353a22312d312d31223b733a383a226361745f70726f64223b733a31313a22312d312d312d312d312d31223b733a363a22737461747331223b733a353a22312d312d31223b733a353a227275706179223b733a353a22302d302d30223b733a31313a226e6577735f777269746572223b733a353a22312d312d31223b733a393a22706167655f73697465223b733a353a22312d312d31223b733a393a22706167655f6d656e75223b733a353a22312d312d31223b733a353a2262616e6572223b733a353a22312d312d31223b733a353a226c696e6b73223b733a353a22312d312d31223b733a333a22637376223b733a353a22312d312d31223b733a353a226f70726f73223b733a353a22312d312d31223b733a363a22726174696e67223b733a353a22312d312d31223b733a333a2273716c223b733a353a22302d312d31223b733a363a226f7074696f6e223b733a333a22302d31223b733a383a22646973636f756e74223b733a353a22312d312d31223b733a363a2276616c757461223b733a353a22312d312d31223b733a383a2264656c6976657279223b733a353a22312d312d31223b733a373a2273657276657273223b733a353a22312d312d31223b733a31303a227273736368616e656c73223b733a353a22312d312d31223b733a363a2275706c6f6164223b693a313b7d, '" . $_POST['user'] . "', '" . base64_encode($_POST['password']) . "', '" . $_POST['mail'] . "', '1', '', '', '1', '', '1');");

        if ($result) {
            $copy = "
������ ������� � PHPShop
------------------------
���������������� ������ �������� �� ������: http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/ ��� �������� Ctrl + F12
�����: " . $_POST['user'] . "
������: " . $_POST['password'] . "
";
            $disp = "<h4>���� ����������� ���������. ���� ����� � �������.</h4>
<FIELDSET id=fldLayout>
<DIV style=\"padding: 10px;>
���������������� ������ �������� �� ������:  <br>
<a href=\"http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/\" target=\"_blank\">http://" . $_SERVER['SERVER_NAME'] . "/phpshop/admpanel/</a><br>
��� ��������  Ctrl + F12<br><br>
�����: <strong>" . $_POST['user'] . "</strong><br>
������: <strong>" . $_POST['password'] . "</strong><br><br>
</DIV>
</FIELDSET>
                    ";
            $d = "";
        } else {
            $disp = "<h4>������ ���������: " . mysql_error() . " </h4>";
            $d = "disabled";
        }
        ?>
        <TABLE cellSpacing=0 cellPadding=0 width="100%"><TBODY>
                <TR>
                    <TD vAlign=top>
                        <TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
                            <FORM method=post>
                                <TBODY>
                                    <TR class=adm vAlign=top align=middle>
                                        <TD align=left>
                                            <FIELDSET >
                                                <div align="center" style="padding:10px;">
                                                    <?php echo @$disp ?>
                                                </div>
                                            </FIELDSET>
                                        </TD>
                                    </TR></FORM></TBODY></TABLE></TD></TR></TBODY></TABLE>
    <table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:170px">
        <tr>
            <td><hr></td>
        </tr>
        <tr>
            <td align="right" style="padding:10">
                <INPUT class=but type=button value="&laquo; �����" onclick="history.back(1)">
                <INPUT class=but type=button id="close" value="������" onclick="InstallOk()" <?php echo $d ?>>
            </td>
        </tr>
    </form>
    </table>
    <?
} elseif ($_POST['install'] == 2) {
    ?>
    <div style="padding:5px">
        <FIELDSET>
            <LEGEND id=lgdLayout >MySQL</LEGEND>
            <br>
            <table cellSpacing=1 cellPadding=5  border=0 width="100%">
                <FORM method="post" name="install">
                    <tr>
                        <td align="right" width="100">����:</td>
                        <td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly value="<?php echo $SysValue['connect']['host'] ?>" name="host"></td>
                    </tr>
                    <tr>
                        <td align="right">������������:</td>
                        <td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="user_db" value="<?php echo $SysValue['connect']['user_db'] ?>"></td>
                    </tr>
                    <tr>
                        <td align="right">������ ����:</td>
                        <td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="pass_db" value="<?php echo $SysValue['connect']['pass_db'] ?>"></td>
                    </tr>
                    <tr>
                        <td align="right">��� ����:</td>
                        <td align="left"><input type="text" style="width:300" onclick="Readonlys()" readonly name="dbase" value="<?php echo $SysValue['connect']['dbase'] ?>"></td>
                    </tr>
                    <tr>
                        <td align="right">�������:</td>
                        <td align="left"><input type="text" style="width:300" name="prefix" value="phpshop_" onchange="Warning()"></td>
                    </tr>
            </table>
            <br>

        </FIELDSET>
        <FIELDSET>
            <LEGEND id=lgdLayout >�����������������</LEGEND>
            <br>
            <table cellSpacing=1 cellPadding=5  border=0 width="100%">
                <tr>
                    <td align="right" width="100">������������</td>
                    <td align="left"><input type="text" id="login" style="width:150" value="root" name="user"> ( �� ����� 4 �������� )</td>
                </tr>
                <tr>
                    <td align="right">E-mail:</td>
                    <td align="left"><input type="text" style="width:150" name="mail" id="mail" value=""> <input type="checkbox" value="1" name="pas_send" id="pas_send" checked> �������� ���. ������ �� �����</td>
                </tr>
                <tr>
                    <td align="right">������:</td>
                    <td align="left"><input type="password" id="pas1" style="width:150" name="password" value=""> ( �� ����� 6 �������� )</td>
                </tr>
                <tr>
                    <td align="right">������ ��� ���:</td>
                    <td align="left"><input type="password" id="pas2" style="width:150" value="">

                        <INPUT class=but type=button value="�������������" style="width:100" onclick="GenPassword('<?php echo "P" . substr(md5(date("U")), 0, 6) ?>')">
                    </td>
                </tr>
            </table>
            <br>
        </FIELDSET>

    </div>
    <table cellpadding="0" cellspacing="0" width="100%" height="50" style="margin-top:5px">
        <tr>
            <td><hr></td>
        </tr>
        <tr>
            <td align="right" style="padding:10px">
                <INPUT class=but type=button value="&laquo; �����" onclick="history.back(1)">
                <INPUT class=but type=button value="������" onclick="window.close()">
                <INPUT class=but type="button" value="����� &raquo;" onclick="TestPas()">
                <input type="hidden" name="install" value="3">
            </td>
        </tr>
    </table>
    </form>

    <?
} elseif ($_POST['install'] == 1) {

    while (list($val) = each($SysValue['base']))
        @$bases.=$SysValue['base'][$val] . ", ";

    $bases = substr($bases, 0, strlen($bases) - 2);
    $bases2 = preg_replace("phpshop_system", "", $bases);
    ?>
    <TABLE cellSpacing=1 cellPadding=5 width="100%" align=center border=0>
        <FORM method="post" name="regForma">
            <TR class=adm vAlign=top align=middle>
                <TD align=left width="100%">
                    <FIELDSET><LEGEND id=lgdLayout><u>�</u>����������� ����������</LEGEND>
                        <DIV style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px">


                            <textarea style="width:99%;height:300">
������������ ���������� �� ������������� ������������ �������� "PHPShop"

��������� ������������ ���������� ����������� ����� ������������� ������������ �������� "PHPShop" (����� ������������) � ��� "������" (����� �����). ����� �������������� �������� ����������� ������������ � ��������� ������� ����������. ���� �� �� �������� � ��������� ������� ����������, �� �� ������ ������������ ������ �������. ��������� � ������������� �������� (� ��� ����� �������� ��������� ����) �������� ���� ������ �������� �� ����� �������� ���������� ����������. ���������� ��������� �� ���� ����������� ���������������� ������� � ������������ ������������ �������� PHPShop.

�������� ������� ���������� ����������: ��������� ��������� - ����� �������� "PHPShop", ���������� � ���� ��� ��������� ��������-��������, ���������������� � ������, ������� ����������� ��� ������������� ������������.

������������ ���������� �������� � ���� � ������� ������������ ��� ��������� �������� � ��������� �� ���������� ����� ����� ������������� ��������.

1. ������� ������������� ����������
1.1. ��������� ���������� ������������� ���������� �������� ����� ������������� ������ ���������� ������������ �������� (� ���������� "��������� ���������", "���������" ��� "�������") "PHPShop", ��������������� ������������ ��� "������", � ������� � �� ��������, ������������� ��������� �����������.
1.2. ��� ��������� ���������� ���������� ���������������� ��� �� ���� ������� � �����, ��� � �� ��� ��������� ����������.
1.3. ������ ���������� ���� ����� ������������ �� ������������� ����� ����� �������� �� ����� web-������� � �������� ������ ������.
1.4. ������������ ���������� �� ������������� ����� ������������� �� ������� "PHPShop" � ��� ����������, � ������ ����� ������������� ���������� ��������� � ��� ����������� � ������������ � ���������, ������� ���������� � ������ 3 ���������� ����������.

2. ��������� �����
2.1. ��� ��������� ����� �� �������, ������� ������������ � �������� �����, ����������� ������, �� ��������� ������������ � ��������������� ����������� ��������� ��� ��� "PHPShop" �2006614274 � �2010611237.
2.2. ������� � ����� ��� �� ����������� �������� �������� ���������� ����� � ������� ������� �� "� �������� ������ �������� ��� ����������� �������������� ����� � ��� ������" �� 23 �������� 1992 ����, ������� �� "�� ��������� ����� � ������� ������" �� 9 ���� 1993 ����, � ����� �������������� ����������.
2.3. � ������ ��������� ��������� ���� ����������������� ��������������� � ������������ � ����������� ����������������� ��.

3. ������� ������������� �������� � �����������
3.1. ������������ ����� ����� ��������� ��������������� ����-������� ��������, ������ � ����� ���������� www.phpshop.ru � ��������� �� ������ � ������� 30 ����, � ��� ����������� ������� ��� ��������� �� ��������� ����������. ����-������ ���� ������ �������� PHPShop �������� ��� �����-���� ����������� ����������������, ����� ���������� �������� ������� � ����������� 1� ������ PHPShop Enterprise Pro.
3.2. ��� ������ ����� ��������� �������� �� ������ ����� web-������� ������ ���� ����������� ��������� ��������. ������� �������� �� ����� ����� �������� ������ ��� �������� ����������� ���������.
3.3. ����� ��������� �� ����� ����� ��������� ���������� �������� ������, � ��������� ���������� ����� �� �����, ��� ������������ �������. ������������� �������� � ���������� ������� ������� ����������, �������� ���������� ������� �� ��������� �����, � ����� �������������� � ������������ � ����������� �����������������. ����� �� ���������� �������� ������ � ��������� ���������� ����� �������� ���������� ���������� � ������������ ������� � �������������� ����������� ��������� ������� �� ��� ����� ������������.
3.4. ��� ������ � ���������� ������ �������� �������, ��� ������ �� ��������� ���������. � ����� ���������� ������������ � ������������ �������� �������� ��������� ����� ������ (�������� ���������).
3.5. ��� ����������� ���������, ����� ����������� ������������ � �������, ������ ����������� � ������� ��� ��� �����, �� ������ �������� �����. �������� ��� ���������� ������ ����������� ��������� ��������.
3.6. ������ Enterprise � EnterprisePro ������������ ���������� � ���������� ����������, �.�. ���� seamply.ru/market1/. ���������� ���� market1.seamply.ru � �.�. ������� ������� ��������� ��������. ����������� ��������� ���������������� ������ �� ���� ����� ��������. ��� ������� ������ ���������� ��������, � ����� ��� ��������� ���������� ���������� ���� seamply.ru/market1/, ��������� ������� ����� ����������� ��������� �� �������, ��������� �� ����� ����������. ������ Start � Catalog ������������ ���������� ������ � �������� ����� ��� ���������. ����������� ����������� �������� � ������������� ������������� �������������� ����� �������� ������������� � ����� ������������ ��� �������� ��������� � �������� ���, ��� �������, ��� ����� ����� �� ����� �������� ������� �����.
3.7. ����� ������� ������ ���������� ��������������� �������� ���� php-���������� �� ����������� ����� index.php, � ������� ���������� �������� �������� � ������ �� �������������������� ��������������� ���������. ��� �������������� ���������� �� ��������� EasyControl ��������������� � ���������������� ���� ��� ����������� �������� ��������� � ���.
3.8. ������������ ����� ��������, ��������� ��� ������� �������� ����� �������������� ���������� ��������� "PHPShop" � ������������ � ����������������� �� �� ��������� �����. ��������� ���������������� ������ ��������� � ������ ��������� ������� ���������� � ������������ � 273 ������� �� ��.

4. ��������������� ������
4.1. ������������ �� ����� ����������, ���������� ������� ����� ��� ��������������, ������� � ������/������������� � ��� ����������, � ��� �����, ��������� �� ���� �������� �����, � ����� �����, � ��� �����, � ���� ��������� ������, �����-���� ������ ��������.
4.2. ����� ��������������� �������� ��� ���������������� �������� ������, ������� ��������������, �������� ���������� ������� ����������, � ������ ��������������� �������� ������������ ����������������.
4.3. ������� ������������ �� �������� "��� ����" ("AS IS") ��� �������������� �������� ������������������, ������������� �����������, ����������� ������, � ����� ���� ���� ���������� ��� �������������� ��������.
4.4. ����� �� ����� �����-���� ��������������� �� ���������� ��� ����������� ���������� ����� ���, ����� ���������� ��� ������ ������� ���������� ������������� ��� ������������� ������������� ��������.
4.5. ����� �� ����� ���������������, ��������� � ������������ ��� � ���������������� ��� ��������� ��������������� �� ������������� �������� � ��������������� ����� (�������, �� �� �������������, �������� ����� �������� ������� ��������, ������� �� ������� ��� ������� ���������� �����, ��������������� ��� ���������� ���������� ��� ��������������� ������; � �.�.).
4.6. ����� �� ����� ��������������� �� ����������������� ��������, � ������ �������� ���� ����� �� �� �� ���� ��������� � ��� ���������.
4.7. ����������� ����� ������������� ��������, �������������� ������������ ���������������� ��.
4.8. �� ��������� ������� ���������� ���������� ��������� ���������������, ��������������� ����������������� ��.

5. ������� ����������� ���������
5.1. ���������� ��������-�������� PHPShop Enterprise, ������������ �������� ���������� ������� ����������� ��������� � ������� 6 �������. ��� ������ PHPShop Start ���� ��������� ���������� 3 ������.
5.2. ����������� ��������� ��������������� ������ � �����������, ����������� ������������, ���������� ������ � ����������� �������� "PHPShop", ���������� � ������� ������������ �������.
5.3. � ��������� �������� ������������ �� ������ ���������� � ���������� ��������. ��������� ����� � 1� (����������� � ������� � ������������� ������). ������� �� ������ ��������� �������� �� ������, ������� �������, �������� ��������� �������� �� ������. ��������� � ��������� �������������� ���������� ������ �� ������ EasyControl.
5.4. ������������ ���������� � ����������� ������� ����� ������ ����������� ��������� help.phpshop.ru ��� "������" � ������� ������������ ����� �� ������� ���� (�� ����������� �������� � ��������� ����������� ���� ���������� ���������) � 10 �� 18 ����� ����������� �������.
5.5. �� ��������� ����� ���������� ����������� ���������, ������������ ����� ���������� ���������. ���� �������� ����������� ��������� ������������ �� ���� ��� � ������� ������ ���������. ������������ ����� �������� ����������� ��������� � ���������� ��� ��������� � ����������, ������� ���� �������� � ������������ �������� �� ������� ������ ��������� ����������� ���������. ����������� �����-���� ��� ������������ ����������� ��������� ������ �� ��������-����� http://www.phpshop.ru/order/.
5.6. ��������, �� ����������� � ������� ����������� ���������, �� ����� ���� ��������� ������. ��� ��������� � ������� ����� ������� ������� �������� �������������� ����������� ������. ������ ������ ������� ����������� ����� �������� �� ������: https://help.phpshop.ru/knowledgebase.php?article=116
5.7. ������������ ��������� � ������, ����������� ��� �����, �������������� ��������� � ������� 1 ������.

6.�������� �������� �������� �������
6.1. � ����� � ���, ��� ����� �������������, ������� ������������� ����� ��������� ������������ �������� ������������ ������������, � ������, ���������� ����-������ ��������, �������� �. 3.1. ���������� ����������, � �����, �� ������� ����, ��� ����� ��� ������� �������� �������������� �������, �� ���������� �������� ���������, ������� �������� ������� ������������ ��������, ���� ������� ���� �� ������������� ��������, ������� ������� � ����������� ������������ �� ������: http://wiki.phpshop.ru
6.2. ����� ������ ��������������� ��������, ��������������, �� �� ������������ ������������� ��� �������, ����� ��������� � http://wiki.phpshop.ru � �� ����� ������, �� ����� �������� �������� ��� �������� �������� �������.
6.3. ������� �������� ������� �������������� ��� �������� ������ � ������ ��������, �� ����������� ��������� ������������, �� ������� 30 (��������) ����������� ���� � ������� ������������ ��������. � ��������� ���������� �������, ��� ������������ ����������� ��������������� ��������, � ����� �������� ���� ��� ���������� ���������� �� ������ ������, ������� ��������� � ��������.
6.4. �� ��������� 30 (��������) ���� � ������� ������������ ��������, ��������� ������� �� ����������� � �������� �������� �� ������������.
6.5. ������� �������������� � ������� 15 (����������) ����������� ���� � ������� ��������� ����������� ��������� � ������ �������� ������� ������� � �������� �������� ������� ������������.
6.6. ���������� ������� EasyControl, ����� ������� ������������� � 1�, ��������������� �� �������� ������ ��� ����" ("AS IS"), � �� ����� ���� �������� �������� �������� ������� �� �������.

7. ��������� � ����������� ����������
7.1. � ������ ������������ ������������� ������ �� ������������� ���������, ��� "������" ����� ����� � ������������� ������� ����������� ��������� ����������, �������� �� ���� ������������.
7.2. ��� ����������� ���������� ������������ ������ ���������� ������������� �������� � ������� �������� ���������.
7.3. ������������ ������ ����������� ������ ���������� � ����� �����, ��������� ������ ��������� ��������� "PHPShop", ��� ����, ����������� ���������� �� ��������� ������ ���������� ��������, ����������� ������������� �� ������������ ��������.
7.4. � ������ ���� ������������ ��� �������� �����-���� ��������� ���������� ���������� �����������������, ���������� ���������� ����������� � ��������� �����.
7.5. ��������� ������������ ���������� ����� ���������������� �� ��� ����������, ��������������� ������������ � ������ ����������� ���������, ���� ������ ��� ���������� ������������ �������� ������������ �� ������������ ������������ � ������� ����� ������������ ���������� ��� ���������� � ������������ ����������. 

���������� ���������� �������� ��� ������ϻ
����� �����: http://www.phpshop.ru
E-mail ������ ������: sales@phpshop.ru
������� ������ ������: +7 (495) 989-11-15
������ ������������ �� �����: https://help.phpshop.ru

                            </textarea>


                    </FIELDSET> </TD>
            </TR>
    </TABLE><br>
    &nbsp;&nbsp;<input type="checkbox" name="selectLic">� �������� ������� ������������� ����������
    </DIV>
    <br>
    <hr>
    <table cellpadding="0" cellspacing="0" width="100%" height="50" >
        <tr>
            <td align="right" style="padding:10"><br>
                <INPUT class=but type=button value="&laquo; �����" onclick="history.back(1)">
                <INPUT class=but type=button value="������" onclick="window.close()">
                <INPUT class=but type="button" value="����� &raquo;" onclick="ChekRegLic()">
                <input type="hidden" name="install" value="2">
            </td>
        </tr>
    </table>
    </form>
    <?
} else {

    $AllError = 0;


// ����
    if (stristr($_SERVER['SERVER_SOFTWARE'], 'Apache'))
        $API = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $API = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }

// ������ PHP
    $phpversion = substr(phpversion(), 0, 1);
    if ($phpversion >= 5)
        $php = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $php = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }



    if (@mysql_get_server_info()) {
        $mysqlversion = substr(@mysql_get_server_info(), 0, 1);
        if ($mysqlversion >= 4)
            $mysql = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
        else {
            $mysql = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
            $AllError = 1;
        }
    }
    else
        $mysql = "...............?";

// Rewrite
    $path_parts = pathinfo($_SERVER['PHP_SELF']);
    $filename = "http://" . $_SERVER['SERVER_NAME'] . $path_parts['dirname'] . "/rewritemodtest/test.html";
    if (@fopen($filename, "r"))
        $rewrite = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $rewrite = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }

    $GD = gd_info();

//GD Support
    if ($GD['GD Version'] != "")
        $gd_support = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $gd_support = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }

//FreeType Support
    if ($GD['FreeType Support'] === true)
        $gd_freetype_support = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $gd_freetype_support = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }

//FreeType Linkage
    if ($GD['FreeType Linkage'] == "with freetype")
        $gd_freetype_linkage = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $gd_freetype_linkage = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }

// XML Support
    if (function_exists("xml_parser_create"))
        $xml_support = "............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else {
        $xml_support = "............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
        $AllError = 1;
    }
    ?>
    <TABLE cellSpacing=1 cellPadding=5 width="100%" height="400" align=center border=0>
        <FORM method="post" name="regForma">
            <TR class=adm vAlign=top align=middle>
                <TD align=left>
                    <FIELDSET style="height:300px"><LEGEND>���� ��������� ����������</LEGEND>
                        <DIV style="padding: 10px;">
                            <ol>
                                <li id="line1" style="visibility:hidden"> Apache <?php echo $API ?></li>
                                <li id="line2" style="visibility:hidden"> MySQL <?php echo $mysql ?>
                                <li id="line3" style="visibility:hidden"> PHP  <?php echo $php ?></li>
                                <li id="line4" style="visibility:hidden">GD Support ��� PHP <?php echo $gd_support ?></li>
                                <li id="line5" style="visibility:hidden">FreeType Support ��� PHP <?php echo $gd_freetype_support ?></li>
                                <li id="line6" style="visibility:hidden">FreeType Linkage ��� PHP <?php echo $gd_freetype_linkage ?></li>
                                <li id="line7" style="visibility:hidden">XML Parser ��� PHP <?php echo $xml_support ?></li>
                                <br><br>
                                <ol>
                                    </DIV>
                                    <div style="padding: 20px"><strong>�����������</strong>: <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle> <b class='ok'>Ok</b> - ���� �������,
                                        <img src="rewritemodtest/errormessage.gif"  border=0 align=absmiddle> <b class='error'>Error</b> - ���� �� ������� (�������� �������� ��� ������ �������, ���������� � ������������ ������� ��� ��������� � ��������������� �������)
                                    </div>
                                    </FIELDSET> </TD>
                                    </TR>
                                    </TABLE>


                                    <br>
                                    <hr>
                                    <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                                        <tr>
                                            <td align="right" style="padding:10">
                                                <INPUT class=but type=button value="������" onclick="window.close()">
                                                <input type="hidden" name="errors" id="error" value="<?php echo $AllError ?>">
                                                <INPUT class=but type="button" value="����� &raquo;" onclick="ChekApi()">
                                                <input type="hidden" name="install" value="1">
                                            </td>
                                        </tr>

                                    </table>
                                    </form>
                                    <script>
    function LoadTest(i) {
        document.getElementById("line" + i).style.visibility = 'visible';
        if (i != 7)
            setTimeout("LoadTest(" + (i + 1) + ")", 300);
    }
    setTimeout("LoadTest(1)", 300);
                                    </script>
<? } ?>


                                </body>
                                </html>