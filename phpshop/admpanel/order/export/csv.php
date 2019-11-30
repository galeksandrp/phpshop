<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("delivery");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();



if (!empty($_GET['id'])) {
    $PHPShopOrder = new PHPShopOrderFunction($_GET['orderID']);

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $row = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])), false, array('limit' => 1));

    if (is_array($row)) {

        $num = 0;
        $csv1 = "������ ������ ������;;;;;;;;;;\n";
        $csv2 = "������ ���������� �������;;;;;;;;;;\n";
        $csv3 = "������ ������ ��������;;;;;;;;;;\n";

        $adr_info = null;
        $id = $row['id'];
        $datas = $row['datas'];
        $uid = $row['uid'];
        $order = unserialize($row['orders']);
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
        $sum = $PHPShopOrder->returnSumma($order['Cart']['sum'], $order['Person']['discount']);
        $discount = $order['Person']['discount'];
        $weight = $order['Cart']['weight'];

        $csv1.="$uid;$datas;$mail;$name;$company;$tel;$oplata;$sum;$discount;$inn;$adres;$kpp;$user;\n";

        if (is_array($order['Cart']['cart']))
            foreach ($order['Cart']['cart'] as $val) {
                $id = $val['id'];
                $uid = $val['uid'];
                $num = $val['num'];
                $sum = $PHPShopOrder->returnSumma($val['price'] * $num, $order['Person']['discount']);

                // ���������� ���� ������
                $valuta = $PHPShopOrder->getValutaIso($id);
                $csv2.="$id;$uid;$num;$sum;$valuta;;;;;;\n";
            }

        // ��������

        $PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
        $csv3.=$PHPShopDelivery->getCity() . ";" . $PHPShopDelivery->getPrice($sum, $weight) . ";" . $valuta . "\n";

        $csv = $csv1 . $csv2 . $csv3;

        $file = $row['uid'] . ".csv";
        @$fp = fopen("../../csv/" . $file, "w+");
        if ($fp) {
            fputs($fp, $csv);
            fclose($fp);
        }
        header("Location: ../../csv/" . $file);
    } else die('������ � ����� ������� �� ����������');
}
?>