<?
/*
+-------------------------------------+
|  PHPShop Enterprise Pro 1C          |
|  ������ ���������� ��������         |
+-------------------------------------+
*/

include("login.php");
include("mailer.php");


function ReturnSumma($sum,$disc) {
    $sum=$sum-($sum*$disc/100);
    return $sum;
}


// ������� ������ ������������� ������
function CheckStatusReady() {
    global $SysValue;
    $sql="select id from ".$GLOBALS['SysValue']['base']['table_name32']." where id=100 limit 1";
    @$result=mysql_query(@$sql);
    $num=mysql_numrows($result);

// ������ ������ �������
    if(empty($num))
        mysql_query("INSERT INTO ".$GLOBALS['SysValue']['base']['table_name32']." VALUES (100, '�������� � �����������', '#ffff33','')");


    return 100;
}


switch($_GET['command']) {

    // ����������� ���� ����� ��������� ������
    case("optimize"):
        mysql_query("OPTIMIZE TABLE ".$GLOBALS['SysValue']['base']['table_name'].", ".$GLOBALS['SysValue']['base']['table_name2']) or die("Optimize fail: ".mysql_error());
        break;

    // ������� ������ ���� �������
    // command=list&date1=123456&date2=24255
    case("list"):
        PHPShopObj::loadClass("order");
        PHPShopObj::loadClass("delivery");


        $sql="select * from ".$GLOBALS['SysValue']['base']['table_name1']." where seller!='1' and datas BETWEEN ".@$_GET['date1']." AND ".@$_GET['date2']." order by id desc  limit ".@$_GET['num'];

//$sql="select * from ".$PHPShopBase->getParam("base.table_name1")." where seller!='1' and datas<'".date("U")."'  order by id desc  limit 1";

        @$result=mysql_query(@$sql);
        while(@$row = mysql_fetch_array(@$result)) {

            $csv1="������ ������ ������\n";
            $csv2="������ ���������� �������\n";
            $csv3="������ ������ ��������\n";
            $id=$row['id'];
            $datas=$row['datas'];
            $uid=$row['uid'];

            // ���������� ����� ������
            $PHPShopOrder = new PHPShopOrder($id);

            $order=unserialize($row['orders']);
            $status=unserialize($row['status']);
            $mail=$order['Person']['mail'];
            $name=$order['Person']['name_person'];
            $conpany=str_replace("*","\"",$order['Person']['org_name']);
            $inn=$order['Person']['org_inn'];
            $tel=$order['Person']['tel_code']." ".$order['Person']['tel_name'];
            $adres=str_replace("*","\"",$order['Person']['adr_name']);
            $adres=PHPShopSecurity::CleanOut($adres);
            $oplata=$PHPShopOrder->getOplataMetodName();
            $sum=@ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
            $weight=$order['Cart']['weight'];
            $discount=$order['Person']['discount'];
            if($discount>0) $discountStr="- ������ $discount%";
            else $discountStr="";

            $csv1.="$id;$uid;$datas;$mail;$name $discountStr;$conpany;$tel;$oplata;$sum;$discount;$inn;$adres;\n";

            if(@is_array($order['Cart']['cart']))
                foreach($order['Cart']['cart'] as $val) {
                    $id=$val['id'];
                    $uid=$val['uid'];
                    $num=$val['num'];
                    $sum=ReturnSumma($val['price']*$num,$order['Person']['discount']);

                    // ������
                    $valuta=$PHPShopOrder->getValutaIso($id);
                    $csv2.="$id;$uid;$num;$sum;$valuta\n";
                }

            // ��������
            $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
            $csv3.=$PHPShopDelivery->getCity().";".$PHPShopDelivery->getPrice($sum,$weight).";".$valuta."\n";

            @$csv.=$csv1.$csv2.$csv3;
        }
        echo @$csv;
        break;



    // ���������� ������� ������
    // command=update&id=63&cid=12345
    case("update"):
        $CheckStatusReady=CheckStatusReady();
        $sql="UPDATE ".$GLOBALS['SysValue']['base']['table_name1']."
     SET
	 seller='1',
     statusi=$CheckStatusReady 
     where id=".$_GET['id'];
        @$result=mysql_query(@$sql) or die("error");

        // ��������� ������ � ����
        $date=date("U");
        mysql_query("INSERT INTO ".$GLOBALS['SysValue']['base']['table_name9']." VALUES ('', $id, '$cid',$date,'')");

        // ���� ��������� ������������
        SendMailUser($id);
        break;


    // ���-�� ����� �������
    // command=new&date1=123456&date2=24255
    case("new"):
        $sql="select id from ".$GLOBALS['SysValue']['base']['table_name1']." where seller!='1' and datas<'$date2' and datas>'$date1'";
        @$result=mysql_query(@$sql);
        $new_order=mysql_numrows($result);
        echo $new_order;
        break;

    // �������� ��� ����-������
    // command=check&date1=123456&date2=24255
    case("check"):
        $sql="select * from ".$GLOBALS['SysValue']['base']['table_name9']." where datas<'$date2' and datas>'$date1'";
        @$result=mysql_query(@$sql);
        while($row = mysql_fetch_array($result)) {
            $cid=$row['cid'];
            @$csv.="$cid;";
        }
        echo $csv;
        break;

    // ���������� ���� ��� ����-������
    // command=update_f&cid=1234&date=123456
    case("update_f"):
        $sql="UPDATE ".$GLOBALS['SysValue']['base']['table_name9']."
     SET
	 datas_f=$date 
     where cid='$cid'";
        @$result=mysql_query(@$sql) or die("error");
        // ���� ��������� ������������
        SendMailUser($id,"invoice");
        break;

    // �������� �������� ����-������
    // command=check_f&cid=123
    case("check_f"):
        $sql="select datas_f from ".$GLOBALS['SysValue']['base']['table_name9']." where cid='$cid' limit 1";
        @$result=mysql_query(@$sql);
        $row = mysql_fetch_array($result);
        $datas_f=$row['datas_f'];
        echo $datas_f;
        break;

    default: echo "��� ��������<br>
	 loader.php?command=[check_f | update_f | check | new | update | list | optimize]";

}
?>
