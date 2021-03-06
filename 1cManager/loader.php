<?php

/**
 * ���������� ������������� ������� � 1�
 * @package PHPShopExchange
 * @author PHPShop Software
 * @version 2.2
 */
// ������� �����������
include_once("login.php");

// ������� ������ � ������
include_once("mailer.php");

// ����� ������ ���������
$curent_time = time();

// ������� ������ ������������� ������
function CheckStatusReady() {
    global $link_db;
    $result = mysqli_query($link_db, "select id from " . $GLOBALS['SysValue']['base']['order_status'] . " where id=100 limit 1");
    $num = mysqli_num_rows($result);

    // ������ ������ �������
    if (empty($num))
        mysqli_query($link_db, "INSERT INTO " . $GLOBALS['SysValue']['base']['order_status'] . " (`id`, `name`, `color`) VALUES (100, '�������� � �����������', '#EC971F')");
    return 100;
}

/**
 * ��������� ������� [check_f | update_f | check | new | update | list | optimize]
 */
switch ($_REQUEST['command']) {

    // ����������� ���� ����� ��������� ������
    case("optimize"):
        mysqli_query($link_db, "OPTIMIZE TABLE " . $GLOBALS['SysValue']['base']['categories'] . ", " . $GLOBALS['SysValue']['base']['products']) or die("Optimize fail: " . mysqli_error($link_db));
        break;

    // ������� ������ ���� �������
    // command=list&date1=123456&date2=24255
    case("list"):
        PHPShopObj::loadClass(array("order", "delivery"));
        $csv = $adr_info = null;

        // ������������
        if (PHPShopSecurity::true_num($_REQUEST['date1']) and PHPShopSecurity::true_num($_REQUEST['date2']) and PHPShopSecurity::true_num($_REQUEST['num'])) {

            $PHPShopSystem = new PHPShopSystem();
            $load_status = $PHPShopSystem->getSerilizeParam('1c_option.1c_load_status');
            $where = "where seller!='1'";

            if (!empty($load_status))
                $where.=" and statusi=" . intval($load_status);

            $sql = "select * from " . $GLOBALS['SysValue']['base']['orders'] . " " . $where . " and datas BETWEEN " . $_REQUEST['date1'] . " AND " . $_REQUEST['date2'] . " order by id desc  limit " . $_REQUEST['num'];

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
                $mail = $order['Person']['mail'];
                $user = $row['user'];

                // ���
                if (empty($row['fio']))
                    $name = $order['Person']['name_person'];
                else
                    $name = $row['fio'];

                // ��������� ������� �������
                if (empty($row['org_inn'])) {
                    $company = str_replace("&quot;", '"', $order['Person']['org_name']);
                    $inn = $order['Person']['org_inn'];
                    $kpp = $order['Person']['org_kpp'];
                }
                // ��������� ������ �������
                else {
                    $company = str_replace("&quot;", '"', $row['org_name']);
                    $inn = $row['org_inn'];
                    $kpp = $row['org_kpp'];
                }

                if (empty($row['tel'])) {
                    $tel = $order['Person']['tel_code'] . " " . $order['Person']['tel_name'];
                } else {
                    $tel = str_replace(array('&#43;', '&#43'), '+', $row['tel']);
                }

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

                $adres = PHPShopSecurity::CleanOut(str_replace("&quot;", '"', $adr_info . $order['Person']['adr_name']));
                $oplata = $PHPShopOrder->getOplataMetodName();
                $sum = $row['sum'];
                //$weight = $order['Cart']['weight'];
                $discount = $order['Person']['discount'];

                // ��������� ������������ ����� ��������� ������� �������
                $org_yur_adres = $row['org_yur_adres'];
                $org_fakt_adres = $row['org_fakt_adres'];
                $org_ras = $row['org_ras'];
                $org_bank = $row['org_bank'];
                $org_kor = $row['org_kor'];
                $org_bik = $row['org_bik'];
                $org_city = $row['org_city'];

                // Ver 1.8
                $csv1.="$id;$uid;$datas;$mail;$name;$company;$tel;$oplata;$sum;$discount;$inn;$adres;$kpp;$user;$org_yur_adres;$org_fakt_adres;$org_ras;$org_bank;$org_kor;$org_bik;$org_city\n";

                if (is_array($order['Cart']['cart']))
                    foreach ($order['Cart']['cart'] as $val) {
                        $id = $val['id'];
                        $uid = $val['uid'];
                        $num = $val['num'];
                        $sum = $val['price'] * $num - ($val['price'] * $num * $order['Person']['discount'] / 100);

                        // ������
                        $valuta = $PHPShopOrder->getValutaIso($id);
                        $csv2.="$id;$uid;$num;$sum;$valuta\n";
                    }

                // ��������
                $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
                $csv3.=$PHPShopDelivery->getCity() . ";" . $order['Cart']['dostavka'] . ";" . $valuta . "\n";

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
        mysqli_query($link_db, "UPDATE " . $GLOBALS['SysValue']['base']['orders'] . " SET seller='1', statusi=" . intval($CheckStatusReady) . " where id=" . intval($_REQUEST['id']));

        mysqli_query($link_db, "INSERT INTO " . $GLOBALS['SysValue']['base']['1c_docs'] . " (`uid`, `cid`, `datas`, `year`) VALUES (" . $_REQUEST['id'] . ", '" . $_REQUEST['cid'] . "'," . $curent_time . "," . date('Y') . ")");

        // ��������� ������������
        SendMailUser($_REQUEST['id'], "accounts", $curent_time);
        break;


    // ���-�� ����� �������
    // command=new&date1=123456&date2=24255
    case("new"):
        @$result = mysqli_query($link_db, "select id from " . $GLOBALS['SysValue']['base']['orders'] . " where seller!='1' and datas<'$_REQUEST[date2]' and datas>'$_REQUEST[date1]'");
        $new_order = mysqli_num_rows($result);
        echo $new_order;
        break;

    // �������� ��� ����-������
    // command=check&date1=123456&date2=24255
    case("check"):
        $csv = null;
        @$result = mysqli_query($link_db, "select * from " . $GLOBALS['SysValue']['base']['1c_docs'] . " where datas<'" . $_REQUEST[date2] . "' and datas>'" . $_REQUEST[date1] . "'");
        while ($row = mysqli_fetch_array($result)) {
            $cid = $row['cid'];
            $csv.="$cid;";
        }
        echo $csv;
        break;

    // ���������� ���� ��� ����-������
    // command=update_f&cid=1234[����� ����� 1�]&date=123456
    case("update_f"):

        mysqli_query($link_db, "UPDATE " . $GLOBALS['SysValue']['base']['1c_docs'] . " SET datas_f='" . $_REQUEST[date] . "' where cid='" . $_REQUEST[cid] . "' and year='" . date('Y', $_REQUEST[date]) . "'");

        // ��������� ������������
        SendMailUser($_REQUEST['cid'], "invoice");
        break;

    // �������� �������� ����-������
    // command=check_f&cid=123[����� ����� 1�]
    case("check_f"):

        @$result = mysqli_query($link_db, "select datas_f from " . $GLOBALS['SysValue']['base']['1c_docs'] . " where cid='" . $_REQUEST[cid] . "' and year='" . date('Y') . "' limit 1");
        $row = mysqli_fetch_array($result);
        $datas_f = $row['datas_f'];
        echo $datas_f;
        break;

    default: echo "��� ��������<br>
	 loader.php?command=[check_f | update_f | check | new | update | list | optimize]";
}
?>