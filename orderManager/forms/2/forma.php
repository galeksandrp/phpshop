<?php

/**
 * �������� ����� ���� ������ ��� Order Agent
 * @package PHPShopExchange
 * @author PHPShop Software
 * @version 1.1
 */

$_classPath="../../../phpshop/";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("inwords");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("math");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System']=$PHPShopSystem->getArray();

// ���������� ���������
$SysValue['bank']=unserialize($LoadItems['System']['bank']);
$pathTemplate=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];

$orderID=PHPShopSecurity::TotalClean($_GET['orderID'],5);
$datas=PHPShopSecurity::TotalClean($_GET['datas'],1);

$PHPShopOrder = new PHPShopOrderFunction($orderID);

$sql="select * from ".$SysValue['base']['table_name1']." where id='$orderID' and datas='$datas'";
$n=1;
$dis=null;
$sum=0;
$num=0;
$weight=0;

@$result=mysql_query($sql);
$row = mysql_fetch_array(@$result);
$id=$row['id'];
$datas=$row['datas'];
$ouid=$row['uid'];
$order=unserialize($row['orders']);
$status=unserialize($row['status']);

if(is_array($order['Cart']['cart']))
    foreach($order['Cart']['cart'] as $val) {
        $dis.="<tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>".$val['name']."</td>
		<td align=right class=tablerow nowrap>".$PHPShopOrder->returnSumma($val['price'],0)."</td>
		<td align=right class=tablerow>".$val['num']."</td>
		<td class=tableright>".$PHPShopOrder->returnSumma($val['price']*$val['num'],0)."</td>
	</tr>";

        $sum+=$val['price']*$val['num'];
        $num+=$val['num'];
        $n++;
        
        // ����������� � ������������ ����
        $goodid=$val['id'];
        $goodnum=$val['num'];
        $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
        $wresult=mysql_query($wsql);
        $wrow=mysql_fetch_array($wresult);
        $cweight=$wrow['weight']*$goodnum;
        if (!$cweight) {
            $zeroweight=1;
        } //���� �� ������� ����� ������� ���!
        $weight+=$cweight;
    }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {
    $weight=0;
}

$PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
$deliveryPrice=$PHPShopDelivery->getPrice($sum,$weight);

$dis.="<tr class=tablerow>
		<td class=tablerow>".$n."</td>
		<td class=tablerow>�������� - ".$PHPShopDelivery->getCity()."</td>
        <td align=right class=tablerow nowrap>".PHPShopMath::DoZero($deliveryPrice)."</td>
		<td align=right class=tablerow>1</td>
		<td class=tableright>".PHPShopMath::DoZero($deliveryPrice)."</td></tr>";

if($LoadItems['System']['nds_enabled']) {
    $nds=$LoadItems['System']['nds'];
    @$nds=number_format($sum*$nds/(100+$nds),"2",".","");
}

$sum=number_format($sum,"2",".","");
$summa_nds_dos=number_format($deliveryPrice*$nds/(100+$nds),"2",".","");

$name_person=$order['Person']['name_person'];
$org_name=$order['Person']['org_name'];
$datas=PHPShopDate::dataV($datas,"false");

function OplataMetod($tip) {
    if($tip==1) return "���� � ����";
    if($tip==2) return "���������";
    if($tip==3) return "�������� ������";
}


// ����� ��������� ����
$chek_num=substr(abs(crc32(uniqid(rand(),true))),0,5);
$LoadBanc=unserialize($LoadItems['System']['bank']);
?>
<head>
    <title>�������� ��� � <?=$chek_num?></title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <link href="../style.css" type=text/css rel=stylesheet>
    <style media="print" type="text/css">
        <!--
        .nonprint {
            display: none;
        }
        -->
    </style>
</head>
<body onload="window.focus()" bgcolor="#FFFFFF" text="#000000" marginwidth=5 leftmargin=5 style="padding: 2px;">
    <div align="right" class="nonprint"><a href="#" onclick="window.print();return false;" ><img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_print.gif">�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src="http://<?=$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']?>/phpshop/admpanel/img/action_save.gif"></a><br><br></div>

    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH scope=row align=middle width="50%" rowSpan=3></TH>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P>�������� ��� <SPAN class=style4><?=@$chek_num?> �� <?=PHPShopDate::dataV(date("U"),"update")?></SPAN> </P></BLOCKQUOTE></TD></TR>
            <TR>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P><SPAN class=style4><?=$LoadBanc['org_adres']?>, ������� <?=$LoadItems['System']['tel']?> </SPAN></P></BLOCKQUOTE></TD></TR>
            <TR>
                <TD align=right>
                    <BLOCKQUOTE>
                        <P class=style4>���������: <?=$LoadItems['System']['company']?></P></BLOCKQUOTE></TD></TR></TBODY></TABLE>



    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH scope=row align=middle width="50%">
                    <P class=style4>����������: <?=@$order['Person']['name_person']?></P></TH>
                <TH scope=row align=middle><b>����� �<?=$ouid?> </b></TH></TR></TBODY></TABLE>



    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH class=style2 scope=row align=left>
                    <BLOCKQUOTE>
                        <P class=style4>���������� ������������ � ������� ��� ������ �� ����� ��� ���������!</P></BLOCKQUOTE></TH></TR>
            <TR>
                <TH class=style4 scope=row align=left>
                    <BLOCKQUOTE>
                        <P>���������� �������������� ����� ��������������� �� ������� ��� � ������������ ������ ����� ������ ��� �� ��������.</P></BLOCKQUOTE></TH></TR></TBODY></TABLE>







    <p><br></p>
    <table width=99% cellpadding=2 cellspacing=0 align=center>
        <tr class=tablerow>
            <td class=tablerow>�</td>
            <td width=50% class=tablerow>������������</td>
            <td class=tablerow>����</td>
            <td class=tablerow>����������</td>
            <td class=tableright>��������� (<?=$PHPShopOrder->default_valuta_code?>)</td>
        </tr>
        <?
echo @$dis;
$my_total=$PHPShopOrder->returnSumma($sum,$order['Person']['discount'])+$deliveryPrice;
                $my_nds=number_format($my_total*$LoadItems['System']['nds']/(100+$LoadItems['System']['nds']),"2",".","");
                ?>
        <tr>
            <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">�����:
<?=$my_total?>
<?if($LoadItems['System']['nds_enabled']) {?>
                � �.�. ���:  <?=$my_nds?>
    <?}?>

            </td>
        </tr>

        <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
    </table>
    <p><b>����� ������������ <?=($num+1)?>, �� ����� <?=($PHPShopOrder->returnSumma($sum,$order['Person']['discount'])+$deliveryPrice)." ".$PHPShopOrder->default_valuta_code?>
            <br />
            <?
            $iw=new inwords;
$s=$iw->get($PHPShopOrder->returnSumma($sum,$order['Person']['discount'])+$deliveryPrice); 
$v=$PHPShopOrder->default_valuta_code;
if (preg_match("/���/i", $v)) echo $s;
?>
        </b></p><br>


    <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
            <TR>
                <TH scope=row align=middle width="50%">
                    <P>&nbsp;</P>
                    <P class=style4>��������: ________________ �.�. </P>
                    <P>&nbsp;</P></TH>
                <TD vAlign=center align=left><SPAN class=style5>����������� ������������ ������� �������������� � �������������� ��������� ������ ������������. ��� ���������� ���������������� ���������� ������ ����������� ������������ �������������� � ��������. </SPAN></TD></TR></TBODY></TABLE>
<?=$LoadItems['System']['promotext']?>
</body>
</html>