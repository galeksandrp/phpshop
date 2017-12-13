<?php

// �������� ������
$time = explode(' ', microtime());
$start_time = $time[1] + $time[0];

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
include_once '../class/moysklad.class.php';
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("string");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

// ���������� �� ������
$PHPShopSystem = new PHPShopSystem();
$sklad_status = $PHPShopSystem->getSerilizeParam('admoption.sklad_status');

PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");
$PHPShopModules->checkInstall('moysklad');

// ��������� ������ moysklad
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['moysklad']['moysklad_system']);
$option = $PHPShopOrm->select();

$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
$PHPShopOrm->debug =true;

$log_update=0;
$log_create=0;

// ���������� ������
function updateProductData($data, $uid, $uuid) {
    global $PHPShopOrm, $sklad_status,$Rest, $log_update, $log_create;
    $PHPShopOrm->clean();

    // ���������� �� ������
    switch ($sklad_status) {

        case(3):
            if ($data['items_new'] < 1) {
                $data['sklad_new'] = 1;
                $data['enabled_new'] = 1;
            } else {
                $data['sklad_new'] = 0;
                $data['enabled_new'] = 1;
            }
            break;

        case(2):
            if ($data['items_new'] < 1) {
                $data['enabled_new'] = 0;
                $data['sklad_new'] = 0;
            } else {
                $data['enabled_new'] = 1;
                $data['sklad_new'] = 0;
            }
            break;

        default:
            break;
    }

        $PHPShopOrm->update($data, array('id' => '=' . intval($uid)));
        $log_update++;

/*
    // ���������� ������ ������
    if (!empty($uid)) {
        $PHPShopOrm->update($data, array('id' => '=' . intval($uid)));
        $log_update++;
    } elseif($log_create<1) {

        // �������� ������ ������
        $PHPShopOrm->clean();

        $data['category_new'] = 1000002;

        $PHPShopOrm->insert($data);
        
        // ����� ��������� ������ ID
        $result=mysql_query('SELECT MAX(id) as last FROM '.$GLOBALS['SysValue']['base']['products']);
        $row = mysql_fetch_array($result);
        
        // ���������� code �� ��������
        $Rest->updateProduct($uuid,$row['last']);
        
        $log_create++;
    }*/
}

$Rest = new MoyskladRest();
$Rest->_credentials['USER'] = $option['merchant_user'];
$Rest->_credentials['PWD'] = $option['merchant_pwd'];
$Rest->_credentials['VAT'] = $option['nds'];
$Rest->_credentials['ORG'] = $option['org_code'];

$array = $Rest->stock(array('stockMode' => $option['stock_option']));
$i = 0;
//print_r($array);
if (is_array($array)) {
    foreach ($array as $row) {

        updateProductData(array('items_new' => $row['stock'], 'price_new' => ($row['salePrice'] / 100), 'name_new' => PHPShopString::utf8_win1251($row['goodRef']['name'])), $row['goodRef']['code'],$row['goodRef']['uuid']);
        $i++;
    }

    // ������ ������
    if (function_exists('memory_get_usage')) {
        $mem = memory_get_usage();
        $_MEM = '~  ' . round($mem / 1024, 2) . " Kb";
    }
    else
        $_MEM = null;

    // ��������� ������
    $time = explode(' ', microtime());
    $seconds = ($time[1] + $time[0] - $start_time);
    $seconds = substr($seconds, 0, 2);

    $result = '�����. ' . $i . ' ���.  �� ' . $seconds . ' �. ' . $_MEM.'. ���. '.$log_update.'. ���. '.$log_create;

    // ������ ����
    $Rest->log(array('�����' => '������������� ������'), $result);
}
else {
    $result = '������ �������������';
}


echo $result;
?>