<?php

/**
 * ���������� ������������� ������� � 1�
 * @package PHPShopExchange
 * @author PHPShop Software
 * @version 1.8
 */
// ������� �����������
include_once("login.php");

// ������� ������ � ������
include_once("mailer.php");

function ReturnSumma($sum, $disc) {
    $sum = $sum - ($sum * $disc / 100);
    return $sum;
}

// ������� ������ ������������� ������
function CheckStatusReady() {
    global $link_db;
    $sql = "select id from " . $GLOBALS['SysValue']['base']['table_name32'] . " where id=100 limit 1";
    @$result = mysqli_query($link_db, $sql);
    $num = mysqli_num_rows($result);

    // ������ ������ �������
    if (empty($num))
        mysqli_query($link_db, "INSERT INTO " . $GLOBALS['SysValue']['base']['table_name32'] . " VALUES (100, '�������� � �����������', '#ffff33','')");

    return 100;
}

/**
 * ��������� ������� [check_f | update_f | check | new | update | list | optimize]
 */
switch ($_GET['command']) {

    // ����������� ���� ����� ��������� ������
    case("optimize"):
        mysqli_query($link_db, "OPTIMIZE TABLE " . $GLOBALS['SysValue']['base']['table_name'] . ", " . $GLOBALS['SysValue']['base']['table_name2']) or die("Optimize fail: " . mysqli_error($link_db));
        break;

    // ������� ������ ���� �������
    // command=list&date1=123456&date2=24255
    case("list"):
        PHPShopObj::loadClass("order");
        PHPShopObj::loadClass("delivery");
        $csv = $adr_info = null;

        // ������������
        if (PHPShopSecurity::true_num($_GET['date1']) and PHPShopSecurity::true_num($_GET['date2']) and PHPShopSecurity::true_num($_GET['num'])) {

            $sql = "select * from " . $GLOBALS['SysValue']['base']['table_name1'] . " where seller!='1' and datas BETWEEN " . $_GET['date1'] . " AND " . $_GET['date2'] . " order by id desc  limit " . $_GET['num'];
//            $sql = "select * from " . $PHPShopBase->getParam("base.table_name1") . " where seller!='1' and datas<'" . date("U") . "'  order by id desc  limit 1";

            $result = mysqli_query($link_db, $sql);
            while ($row = mysqli_fetch_array($result)) {


                $csv1 = "������ ������ ������\n";
                $csv2 = "������ ���������� �������\n";
                $csv3 = "������ ������ ��������\n";
                $id = $row['id'];
                $datas = $row['datas'];
                $uid = $row['uid'];
                $adr_info = null;

                // ���������� ����� ������
                if (class_exists('PHPShopOrder'))
                    $PHPShopOrder = new PHPShopOrder($id);
                else
                    $PHPShopOrder = new PHPShopOrderFunction($id);

                $order = unserialize($row['orders']);
                //$status=unserialize($row['status']);
                $mail = $order['Person']['mail'];
                $user = $row['user'];
                $name = $order['Person']['name_person'] . $row['fio'];
                $company = str_replace("&quot;", '"', $order['Person']['org_name'] . $row['org_name']);
                $inn = $order['Person']['org_inn'] . $row['org_inn'];
                $kpp = $order['Person']['org_kpp'] . $row['org_kpp'];
                $tel = $order['Person']['tel_code'] . " " . $order['Person']['tel_name'] . $row['tel'];

                // ��������� ����� ��� ����� ��������� ������� �������
                if ($row['country'])
                    $adr_info .= ", ������: " . $row['country'];
                if ($row['state'])
                    $adr_info .= ", ������/����: " . $row['state'];
                if ($row['city'])
                    $adr_info .= ", �����: " . $row['city'];
                if ($row['index'])
                    $adr_info .= ", ������: " . $row['index'];
                if ($row['street'])
                    $adr_info .= ", �����: " . $row['street'];
                if ($row['house'])
                    $adr_info .= ", ���: " . $row['house'];
                if ($row['porch'])
                    $adr_info .= ", �������: " . $row['porch'];
                if ($row['door_phone'])
                    $adr_info .= ", ��� ��������: " . $row['door_phone'];
                if ($row['flat'])
                    $adr_info .= ", ��������: " . $row['flat'];
                if ($row['delivtime'])
                    $adr_info .= ", ����� ��������: " . $row['delivtime'];
                if ($row['dop_info'])
                    $adr_info .= ", �������������� ����������: " . $row['dop_info'];

                $adres = str_replace("&quot;", '"', $adr_info . $order['Person']['adr_name']);
                $adres = PHPShopSecurity::CleanOut($adres);
                $oplata = $PHPShopOrder->getOplataMetodName();
                $sum = @ReturnSumma($order['Cart']['sum'], $order['Person']['discount']);
                $weight = $order['Cart']['weight'];
                $discount = $order['Person']['discount'];

                // ��������� ������������ ����� ��������� ������� �������
                $org_yur_adres = $row['org_yur_adres'];
                $org_fakt_adres = $row['org_fakt_adres'];
                $org_ras = $row['org_ras'];
                $org_bank = $row['org_bank'];
                $org_kor = $row['org_kor'];
                $org_bik = $row['org_bik'];
                $org_city = $row['org_city'];

                // Ver 1.7
                //$csv1.="$id;$uid;$datas;$mail;$name;$company;$tel;$oplata;$sum;$discount;$inn;$adres;$kpp;$user;\n";
                // Ver 1.8
                $csv1.="$id;$uid;$datas;$mail;$name;$company;$tel;$oplata;$sum;$discount;$inn;$adres;$kpp;$user;$org_yur_adres;$org_fakt_adres;$org_ras;$org_bank;$org_kor;$org_bik;$org_city\n";

                if (is_array($order['Cart']['cart']))
                    foreach ($order['Cart']['cart'] as $val) {
                        $id = $val['id'];
                        $uid = $val['uid'];
                        $num = $val['num'];
                        $sum = ReturnSumma($val['price'] * $num, $order['Person']['discount']);

                        // ������
                        $valuta = $PHPShopOrder->getValutaIso($id);
                        $csv2.="$id;$uid;$num;$sum;$valuta\n";
                    }

                // ��������
                $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
                $csv3.=$PHPShopDelivery->getCity() . ";" . $PHPShopDelivery->getPrice($sum, $weight) . ";" . $valuta . "\n";

                $csv.=$csv1 . $csv2 . $csv3;
            }
            echo $csv;
        }
        else
            exit('������ �������� ���������� ����� list');
        break;



    // ���������� ������� ������
    // command=update&id=63[�� ������]&cid=12345[����� ����� 1�]&accounts=true
    case("update"):
        $CheckStatusReady = CheckStatusReady();
        $sql = "UPDATE " . $GLOBALS['SysValue']['base']['table_name1'] . " SET seller='1', statusi=".intval($CheckStatusReady)." where id=" . intval($_GET['id']);
        mysqli_query($link_db, $sql) or die("error");

        $date = time();
        mysqli_query($link_db, "INSERT INTO " . $GLOBALS['SysValue']['base']['table_name9'] . " VALUES ('', " . $_GET['id'] . ", '" . $_GET['cid'] . "',$date,'')");

        // ��������� ������������
        SendMailUser($_GET['id'], "accounts");
        break;


    // ���-�� ����� �������
    // command=new&date1=123456&date2=24255
    case("new"):
        $sql = "select id from " . $GLOBALS['SysValue']['base']['table_name1'] . " where seller!='1' and datas<'$_GET[date2]' and datas>'$_GET[date1]'";
        @$result = mysqli_query($link_db, $sql);
        $new_order = mysqli_num_rows($result);
        echo $new_order;
        break;

    // �������� ��� ����-������
    // command=check&date1=123456&date2=24255
    case("check"):
        $csv = null;
        $sql = "select * from " . $GLOBALS['SysValue']['base']['table_name9'] . " where datas<'$_GET[date2]' and datas>'$_GET[date1]'";
        @$result = mysqli_query($link_db, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $cid = $row['cid'];
            $csv.="$cid;";
        }
        echo $csv;
        break;

    // ���������� ���� ��� ����-������
    // command=update_f&cid=1234[����� ����� 1�]&date=123456
    case("update_f"):
        $sql = "UPDATE " . $GLOBALS['SysValue']['base']['table_name9'] . " SET datas_f=$_GET[date] where cid='$_GET[cid]'";
        mysqli_query($link_db, $sql) or die("error");

        // ��������� ������������
        SendMailUser($_GET['cid'], "invoice");
        break;

    // �������� �������� ����-������
    // command=check_f&cid=123[����� ����� 1�]
    case("check_f"):
        $sql = "select datas_f from " . $GLOBALS['SysValue']['base']['table_name9'] . " where cid='$_GET[cid]' limit 1";
        @$result = mysqli_query($link_db, $sql);
        $row = mysqli_fetch_array($result);
        $datas_f = $row['datas_f'];
        echo $datas_f;
        break;

    default: echo "��� ��������<br>
	 loader.php?command=[check_f | update_f | check | new | update | list | optimize]";
}
?>