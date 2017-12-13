<?php
/**
 * ������� ����� ������� ��� ����������� �����
 * @package PHPShopCoreDepricated
 * @return array 
 */
function Summa_cart() {
    global $LoadItems,$SysValue;
    
    $cart=$_SESSION['cart'];
    $cid=array_keys($cart);
    $in_cart=null;
    $sum=0;
    $weight=0;
    for ($i=0; $i<count($cid); $i++) {
        $j=$cid[$i];
        $in_cart.="
".$cart[$j]['name']." (".TotalClean($cart[$j]['num'],1)." ��.), ";
        $sum+=$cart[$j]['price']*$cart[$j]['num'];
        
        // ����������� � ������������ ����
        $goodid=$cart[$j]['id'];
        $goodnum=$cart[$j]['num'];
        $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
        $wresult=mysql_query($wsql);
        $wrow=mysql_fetch_array($wresult);
        $cweight=$wrow['weight']*$goodnum;
        if (!$cweight) {
            $zeroweight=1;
        } //���� �� ������� ����� ������� ���!
        $weight+=$cweight;
    }
    
    // �������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
    if ($zeroweight) {
        $weight=0;
    }
   
    $dis=array($in_cart,$sum,$weight);
    return $dis;
}

/**
 * ����� ��������� ��������� ������ � ������ ���������
 * @package PHPShopCoreDepricated
 * @return string
 */
function Order() {
    global $SysValue,$LoadItems;
    
    if($_SESSION['cart']) {
        if($_POST['send_to_order'] and $_POST['mail'] and $_POST['name_person'] and $_POST['tel_name'] and $_POST['adr_name']) {
            $order_metod = TotalClean($_POST['order_metod'],1);            
            $sql="select path from ".$SysValue['base']['table_name48']." where id=".$order_metod." and enabled='1'";
            @$result=mysql_query(@$sql);
            @$row = mysql_fetch_array(@$result);
            $path=$row['path'];

            // ����������� ������ ������ �� ������
            if(file_exists("./payment/$path/order.php"))
                include_once("./payment/$path/order.php");
            else exit("��� ����� ./payment/$path/order.php");
        }
        else {

            $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\"><B>".$SysValue['lang']['bad_order_mesage_1']."</B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2'];
            
            // ���������� ������
            $disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
            $disp.="<table><tr>
	<td><img src=\"images/shop/icon-setup.gif\" width=\"16\" height=\"16\" border=\"0\"></td>
	<td align=\"center\"><a href=\"javascript:history.back(1)\"><u>
	��������� � ����������<br>
	�������</u></a></td></tr></table>";
        }
    }
    else {

        // ���������� ����������
        $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\"><B>".$SysValue['lang']['bad_cart_1']."</B></FONT><BR>".$SysValue['lang']['good_order_mesage_2'];
        
        // ���������� ������
        $disp=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
    }
    return $disp;
}

// ���������� ����������
$SysValue['other']['orderMesage']=Order();
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);
$SysValue['other']['catalogCat']= "���������� ������";
$SysValue['other']['catalogCategory']= "����� ��������";
$SysValue['other']['orderEnabled']= "none";

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>