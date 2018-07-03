<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("inwords");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("valuta");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System'] = $PHPShopSystem->getArray();

$PHPShopOrder = new PHPShopOrderFunction($_GET['orderID']);

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

if (is_array($order['Cart']['cart']))
    foreach ($order['Cart']['cart'] as $val) {
        @$dis.="
  <tr class=tablerow>
		<td class=tablerow>" . $n . "</td>
		<td class=tablerow>" . $val['name'] . "</td>
		<td class=tablerow align=center>" . $val['ed_izm'] . "</td>
		<td align=right class=tablerow>" . $val['num'] . "</td>
		<td align=right class=tablerow nowrap>" . $PHPShopOrder->returnSumma($val['price'], 0) . "</td>
		<td class=tableright>" . $PHPShopOrder->returnSumma($val['price'] * $val['num'], 0) . "</td>
	</tr>
  ";

       //����������� � ������������ ����
        $goodid = $val['id'];
        $goodnum = $val['num'];
        $wsql = 'select weight from ' . $SysValue['base']['table_name2'] . ' where id=\'' . $goodid . '\'';
        $wresult = mysqli_query($link_db,$wsql);
        $wrow = mysqli_fetch_array($wresult);
        $cweight = $wrow['weight'] * $goodnum;
        if (!$cweight) {
            $zeroweight = 1;
        } //���� �� ������� ����� ������� ���!
        $weight+=$cweight;


        @$sum+=$val['price'] * $val['num'];
        @$num+=$val['num'];
        $n++;
    }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {
    $weight = 0;
}

$PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
$deliveryPrice = $PHPShopDelivery->getPrice($sum, $weight);
@$dis.="
  <tr class=tablerow>
		<td class=tablerow>" . $n . "</td>
		<td class=tablerow>�������� - " . $PHPShopDelivery->getCity() . "</td>
		<td class=tablerow align=center>��.&nbsp;</td>
		<td align=right class=tablerow>1</td>
		<td align=right class=tablerow nowrap>" . $deliveryPrice . "</td>
		<td class=tableright>" . $deliveryPrice . "</td>
	</tr>
  ";
if ($LoadItems['System']['nds_enabled']) {
    $nds = $LoadItems['System']['nds'];
    @$nds = number_format($sum * $nds / (100 + $nds), "2", ".", "");
}
@$sum = number_format($sum, "2", ".", "");

$summa_nds_dos = number_format($deliveryPrice * $nds / (100 + $nds), "2", ".", "");


$name_person = $order['Person']['name_person'];
$org_name = $order['Person']['org_name'];
$datas = PHPShopDate::dataV($datas, "false");

// ����� �������� ��� ������ ������ ������ � ������
if (!empty($order['Person']['dos_ot']) OR !empty($order['Person']['dos_do']))
    $dost_ot = " ��: " . $order['Person']['dos_ot'] . ", ��: " . $order['Person']['dos_do'];

// ��������� ����� �������� � ������ ������� ������� ������ � �������
if ($row['country'])
    $adr_info .= ", ������: " . $row['country'];
if ($row['state'])
    $adr_info .= ", ������/����: " . $row['state'];
if ($row['city'])
    $adr_info .= ", �����: " . $row['city'];
if ($row['index'])
    $adr_info .= ", ������: " . $row['index'];
if ($row['street'] OR $order['Person']['adr_name'])
    $adr_info .= ", �����: " . $row['street'] . $order['Person']['adr_name'];
if ($row['house'])
    $adr_info .= ", ���: " . $row['house'];
if ($row['porch'])
    $adr_info .= ", �������: " . $row['porch'];
if ($row['door_phone'])
    $adr_info .= ", ��� ��������: " . $row['door_phone'];
if ($row['flat'])
    $adr_info .= ", ��������: " . $row['flat'];

$adr_info = substr($adr_info, 2);
?>
<head>
    <title>����� ������ � <?= $ouid ?></title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <link href="style.css" type=text/css rel=stylesheet>
</head>
<body>
    <div align="right" class="nonprint">
        <button onclick="window.print();">�����������</button> 
        <br><br>
    </div>
    <div align="center"><table align="center" width="100%">
            <tr>
                <td align="center"><img src="<?= $PHPShopSystem->getLogo(); ?>" alt="" border="0"></td>
                <td align="center"><h4 align=center>�����&nbsp;�&nbsp;<?= $ouid ?>&nbsp;��&nbsp;<?= $datas ?></h4></td>
            </tr>
        </table>
    </div>


    <br />
    <table width=99% cellpadding=2 cellspacing=0 align=center>
        <tr class=tablerow>
            <td class=tablerow width="150">��������:</td>
            <td class=tableright><?= @$order['Person']['name_person'] . $row['fio'] ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>��������:</td>
            <td class=tableright>&nbsp;<?= @$order['Person']['org_name'] . $row['org_name'] ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>�����:</td>
            <td class=tableright><a href="mailto:<?= $order['Person']['mail'] ?>"><?= $order['Person']['mail'] ?></a></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>���:</td>
            <td class=tableright>&nbsp;<?= @$order['Person']['org_inn'] . $row['org_inn'] ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>���:</td>
            <td class=tableright>&nbsp;<?= @$order['Person']['org_kpp'] . $row['org_kpp'] ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>���:</td>
            <td class=tableright><?= @$order['Person']['tel_code'] . " " . @$order['Person']['tel_name'] . $row['tel'] ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>�����:</td>
            <td class=tableright><?= @$adr_info ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>���������������:</td>
            <td class=tableright><?= $PHPShopDelivery->getCity() ?></td>
        </tr>
        <tr class=tablerow>
            <td class=tablerow>����� ��������:</td>
            <td class=tableright><?= $dost_ot ?></td>
        </tr>
        <tr class=tablerow >
            <td class=tablerow>��� ������:</td>
            <td class=tableright><?= $PHPShopOrder->getOplataMetodName() ?></td>
        </tr>
        <tr class=tablerow >
            <td class=tablerow style="border-bottom: 1px solid #000000;">�����������:</td>
            <td class=tableright style="border-bottom: 1px solid #000000;">&nbsp;<?=  $row['dop_info']; ?></td>
        </tr>
    </table>
    <p><br></p>
    <table width=99% cellpadding=2 cellspacing=0 align=center>
        <tr class=tablerow>
            <td class=tablerow>�</td>
            <td width=50% class=tablerow>������������</td>
            <td class=tablerow>������� ���������&nbsp;</td>
            <td class=tablerow>����������</td>
            <td class=tablerow>����</td>
            <td class=tableright>�����</td>
        </tr>
        <?
        echo @$dis;
        $my_total = $PHPShopOrder->returnSumma($sum, $order['Person']['discount']) + $deliveryPrice;
        $my_nds = number_format($my_total * $LoadItems['System']['nds'] / (100 + $LoadItems['System']['nds']), "2", ".", "");
        ?>
        <tr>
            <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">������:</td>
            <td class=tableright nowrap><b><?= @$order['Person']['discount'] ?>%</b></td>
        </tr>
        <tr>
            <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">�����:</td>
            <td class=tableright nowrap><b><?= $my_total ?></b></td>
        </tr>
        <? if ($LoadItems['System']['nds_enabled']) { ?>
            <tr>
                <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">� �.�. ���: <?= $LoadItems['System']['nds'] ?>%</td>
                <td class=tableright nowrap><b><?= $my_nds ?></b></td>
            </tr>
        <? } ?>
        <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
    </table>
    
    <p><b>����� ������������ <?= ($num + 1) ?>, �� ����� <?= ($PHPShopOrder->returnSumma($sum, $order['Person']['discount']) + $deliveryPrice) . " " . $PHPShopOrder->default_valuta_code; ?>
            <br />
            <?
            $iw = new inwords;
            $s = $iw->get($PHPShopOrder->returnSumma($sum, $order['Person']['discount']) + $deliveryPrice);
            $v = $PHPShopOrder->default_valuta_code;
            if (preg_match("/���/i", $v))
                echo $s;
            ?>
        </b></p><br>
    <p>���� <u><?= date("d-m-y H:m a") ?></u></p>
<p>������������<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<p>������� ���������<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></p>
<br>
<table>
    <tr>
        <td style="padding:50px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center">�.�.</td>
    </tr>
</table>


</body>
</html>