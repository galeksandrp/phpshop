<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("system");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();



if (!empty($_GET['id'])) {
    $PHPShopOrder = new PHPShopOrderFunction($_GET['orderID']);

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['orders']);
    $row = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])), false, array('limit' => 1));

    if (is_array($row)) {

        $num = 0;
        $id = $row['id'];
        $uid = $row['uid'];
        $order = unserialize($row['orders']);


        $sum = $PHPShopOrder->returnSumma($order['Cart']['sum'], $order['Person']['discount']);
  
        $item = null;
        if (is_array($order['Cart']['cart']))
            foreach ($order['Cart']['cart'] as $val) {
                $id = $val['id'];
                $uid = $val['uid'];
                $num = $val['num'];
                $sum = $PHPShopOrder->returnSumma($val['price'] * $num, $order['Person']['discount']);

                $item.='
                        <�����>
				<��>' . $val['id'] . '</��>
				<��������></��������>
				<�������>' . $val['uid'] . '</�������>
				<������������>' . $val['name'] . '</������������
				<�������������>' . $val['price'] . '</�������������>
				<����������>' . $val['num'] . '</����������>
				<�����>' . $sum . '</�����>
				<�������>��</�������>
			</�����>
                        ';
            }

        if (empty($row['org_inn']))
            $row['org_name'] = $row['fio'];

        $xml = '<?xml version="1.0" encoding="windows-1251"?>
<���������������������� �����������="2.03" ����������������="' . PHPShopDate::get($row['datas'], false) . '">
	<��������>
		<�����>' . $row['uid'] . '</�����>
		<����>' . PHPShopDate::get($row['datas'], false) . '</����>
		<�����������>���� �� ������</�����������>
		<����>��������</����>
		<������>' . $PHPShopSystem->getDefaultValutaIso() . '</������>
		<�����>' . $row['sum'] . '</�����>
		<�����������>
			<����������>
				<������������>' . $row['org_name'] . '</������������>
				<�����������������������>' . $row['org_name'] . '</�����������������������>
				<���>' . $row['org_inn'] . '</���>
				<���>' . $row['org_kpp'] . '</���>
				<����>����������</����>
			</����������>
		</�����������>
		<������>
			' . $item . '
		</������>
	</��������>
</����������������������>';


        $file = $row['uid'] . ".xml";
        @$fp = fopen("../../csv/" . $file, "w+");
        if ($fp) {
            fputs($fp, $xml);
            fclose($fp);
        }


        header("Content-Description: File Transfer");
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename=' . $file);
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: ' . filesize("../../csv/" . $file));
        readfile("../../csv/" . $file);

    } else die('������ � ����� ������� �� ����������');
}
?>