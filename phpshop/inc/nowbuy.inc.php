<?php
/**
 * ����� ������� ��-�� ������� ��� ����� ������ ��������
 * @package PHPShopDepricated
 * @return string
 */
function nowbuy() {
    global $SysValue,$LoadItems;

    $i=1; //��������� �����
    $limitpos=10; //���������� ��������� �������
    $limitorders=100; //���������� ������������� ������� (����� ������ ���� ������, �.�. ����� � ������������� ������ ����������)

    $query='SELECT orders FROM '.$SysValue['base']['table_name1'].' ORDER BY id DESC LIMIT 0,'.$limitorders;
    @$res = mysql_query($query);
    @$rows=mysql_num_rows(@$res);

    $SysValue['sql']['num']++;
    $disp=null;

    while ($f=mysql_fetch_array($res)) {
        $order=unserialize($f['orders']);
        $cart=$order['Cart']['cart'];
        if(is_array($cart))
            foreach ($cart as $num => $good) {
                if ($i>$limitpos) break;
                $sort.=" or id=".$good['id']."";
            }
    }

    $sql="select * from ".$SysValue['base']['table_name2']." where  enabled='1' ".$sort." order by  RAND() LIMIT 0, ".$limitpos;
    $SysValue['sql']['num']++;
    $resgood = mysql_query(@$sql);
    @$rowsgood=mysql_num_rows(@$resgood);

    while(@$row = mysql_fetch_array($resgood)) {
        $disp.=$i.'. <A title="'.$row['name'].'" href="shop/UID_'.$row['id'].'.html">'.$row['name'].'</A><BR>';
        $i++;
    }
    
    return $disp;
}

/**
 * ����� ����� ������ �� ������� �������
 * @package PHPShopDepricated
 * @return string
 */
function HitTradeMain() {
    global $SysValue,$LoadItems;

    $admoption=unserialize($LoadItems['System']['admoption']);
    $Disp = new DispSpec();
    $limitpos=10; //���������� ��������� �������
    $limitorders=100; //���������� ������������� ������� (����� ������ ���� ������, �.�. ����� � ������������� ������ ����������)

    // �������� ������ �� �������
    $query='SELECT orders FROM '.$SysValue['base']['table_name1'].' ORDER BY id DESC LIMIT 0,'.$limitorders;
    @$res = mysql_query(@$query);
    @$rows=mysql_num_rows(@$res);
    $SysValue['sql']['num']++;
    $disp=null;
    $sort=null;

    while ($f=mysql_fetch_array($res)) {
        $order=unserialize($f['orders']);
        $cart=$order['Cart']['cart'];
        if(is_array($cart))
            foreach ($cart as $num => $good) {
                if ($i>$limitpos) break;
                $sort.=" or id=".$good['id']."";
            }
    }

    $Disp->sql="select * from ".$SysValue['base']['table_name2']." where newtip='1' and  enabled='1' ".$sort." order by  RAND() LIMIT 0, ".$LoadItems['System']['spec_num'];
    $SysValue['sql']['num']++;
    $Disp->setka_num=$LoadItems['System']['num_vitrina'];
    $Disp->setka_style="setka";
    $Disp->template=$SysValue['templates']['main_product_forma_'.$Disp->setka_num];
    $Disp->Engen();
    $Return=$Disp->disp;

    return $Return;
}
?>