<?php
/**
 * ���������� ������ ������ ����� Robox
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopPayment
 */


/**
 * ������ ���� � paymentlog.log
 */
function WriteLog($out_summ, $inv_id, $crc) {
    global $mrh_pass2;
    $handle = fopen("../paymentlog.log", "a+");
    $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));
    $str = "
  ROBOXchange Payment Start ------------------
  date=" . date("F j, Y, g:i a") . "
  out_summ=$out_summ
  inv_id=$inv_id
  crc=$crc
  my_crc=$my_crc
  REQUEST_URI=" . $_SERVER['REQUEST_URI'] . "
  IP=" . $_SERVER['REMOTE_ADDR'] . "
  ROBOXchange Payment End --------------------
  ";
    fwrite($handle, $str);
    fclose($handle);
}

/**
 * ����������� ������ ������
 */
function UpdateNumOrder($uid) {
    global $SysValue;
    $last_num = substr($uid, -$SysValue['my']['order_prefix_format']);
    $total = strlen($uid);
    $ferst_num = substr($uid, 0, ($total - $SysValue['my']['order_prefix_format']));
    return $ferst_num . "-" . $last_num;
}

// ��������� ������������ ����
$SysValue = parse_ini_file("../../phpshop/inc/config.ini", 1);
while (list($section, $array) = each($SysValue))
    while (list($key, $value) = each($array))
        $SysValue['other'][chr(73) . chr(110) . chr(105) . ucfirst(strtolower($section)) . ucfirst(strtolower($key))] = $value;

// as a part of ResultURL script
// your registration data
$mrh_pass2 = $SysValue['roboxchange']['mrh_pass2'];    // ������2
// HTTP parameters: $out_summ, $inv_id, $crc
$crc = strtoupper((string) $_POST['crc']);   // force uppercase
$out_summ = $_POST['out_summ'];
$inv_id = $_POST['inv_id'];

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

if (strtoupper($my_crc) != strtoupper($crc)) {
    echo "bad sign\n";
    WriteLog($out_summ, $inv_id, $crc);
    exit();
} else {
// perform some action (change order state to paid)
    // ���������� ���� MySQL
    $link_db=mysqli_connect($SysValue['connect']['host'], $SysValue['connect']['user_db'], $SysValue['connect']['pass_db']);
    mysqli_select_db($link_db,$SysValue['connect']['dbase']);

    $new_uid = UpdateNumOrder($inv_id);

    // ��������� ���. ������
    $sql = "select uid from " . $SysValue['base']['table_name1'] . " where uid='$new_uid'";
    $result = mysqli_query($link_db,$sql);
    $row = mysqli_fetch_array($result);
    $uid = $row['uid'];


    if ($uid == $new_uid) {
        // ���������� ������ � ����
        $sql = "INSERT INTO " . $SysValue['base']['table_name33'] . " VALUES 
('$inv_id','ROBOXchange Cash Register','$out_summ','" . date("U") . "')";
        $result = mysqli_query($link_db,$sql);
        WriteLog($out_summ, $inv_id, $crc);
        // print OK signature
        echo "OK$inv_id\n";
    } else {
        WriteLog($out_summ, $inv_id, $crc);
        echo "bad order num\n";
        exit();
    }
}
?>