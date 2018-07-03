<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("inwords");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System'] = $PHPShopSystem->getArray();


// ���������� ���������
$SysValue['bank'] = unserialize($LoadItems['System']['bank']);
$pathTemplate = $SysValue['dir']['templates'] . chr(47) . $_SESSION['skin'];


$sql = "select * from " . $SysValue['base']['table_name1'] . " where id=" . intval($_GET['orderID']);
$n = 1;
@$result = mysqli_query($link_db,$sql);
$row = mysqli_fetch_array(@$result);
$id = $row['id'];
$datas = $row['datas'];
$ouid = $row['uid'];
$order = unserialize($row['orders']);
$status = unserialize($row['status']);

foreach ($order['Cart']['cart'] as $val) {
    @$dis.="
  <tr class=tablerow>
		<td class=tablerow>" . $n . "</td>
		<td class=tablerow>" . $val['name'] . "</td>
		<td align=right class=tablerow>" . $val['num'] . "</td>
		<td align=right class=tablerow nowrap>" . $ouid . "</td>
		<td class=tableright>12</td>
	</tr>
  ";
    @$sum+=$val['price'] * $val['num'];
    @$num+=$val['num'];
    $n++;
}

if ($LoadItems['System']['nds_enabled']) {
    $nds = $LoadItems['System']['nds'];
    @$nds = number_format($sum * $nds / (100 + $nds), "2", ".", "");
}
@$sum = number_format($sum, "2", ".", "");

$name_person = $order['Person']['name_person'];
$org_name = $order['Person']['org_name'];
$datas = PHPShopDate::dataV($datas, false);


// ������� ����� ��������� ����
$chek_num = substr(abs(crc32(uniqid(rand(), true))), 0, 5);
$LoadBanc = unserialize($LoadItems['System']['bank']);
?>
<head>
    <title>����������� ������������� �<?= @$chek_num ?></title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <link href="style.css" type=text/css rel=stylesheet>
</head>
<body>
    <div align="right" class="nonprint">
        <button onclick="window.print()">�����������</button> 
        <br><br>
    </div>

    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH scope=row align=middle width="50%" rowSpan=3><img src="<?= $PHPShopSystem->getLogo(); ?>" alt="" border="0"></TH>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P><b>����������� �������������</b> <SPAN class=style4>�<?= @$chek_num ?> �� <?= $datas ?></SPAN> </P></BLOCKQUOTE></TD></TR>
            <TR>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P><SPAN class=style4><?= $LoadBanc['org_adres'] ?>, ������� <?= $LoadItems['System']['tel'] ?> </SPAN></P></BLOCKQUOTE></TD></TR>
            <TR>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P class=style4>���������: <?= $LoadItems['System']['company'] ?></P></BLOCKQUOTE></TD></TR></TBODY></TABLE>

    <p><br></p>
    <table width=99% cellpadding=2 cellspacing=0 align=center>
        <tr class=tablerow>
            <td class=tablerow>�</td>
            <td width=50% class=tablerow>������������</td>
            <td class=tablerow>���-��</td>
            <td class=tablerow>�������� �����</td>
            <td class=tablerow style="border-right: 1px solid #000000;">�������� (���)</td>
        </tr>
        <? echo @$dis; ?>


        <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
    </table>


    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH scope=row align=middle width="50%">
        <P>&nbsp;</P>
        <P class=style4>��������: ________________ �.�. </P>
        <P>&nbsp;</P></TH>
    <TD vAlign=center align=left><SPAN class=style5>����������� ������������ ������� �������������� � �������������� ��������� ������ ������������. ��� ���������� ���������������� ���������� ������ ����������� ������������ �������������� � ��������. </SPAN></TD></TR></TBODY></TABLE>
</body>
</html>