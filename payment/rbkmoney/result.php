<?php

/*
  +-------------------------------------+
  |  PHPShop Enterprise                 |
  |  ������ ResultUrl RBKMoney          |
  +-------------------------------------+
 */

function WriteLog($MY_LMI_HASH) {
    $handle = fopen("../paymentlog.log", "a+");
    $post = null;

    foreach ($_POST as $k => $v)
        $post.=$k . "=" . $v . "\r\n";

    $str = "
  RBK Payment Start ------------------
  date=" . date("F j, Y, g:i a") . "
  $post
  MY_LMI_HASH=$MY_LMI_HASH
  REQUEST_URI=" . $_SERVER['REQUEST_URI'] . "
  IP=" . $_SERVER['REMOTE_ADDR'] . "
  RBK Payment End --------------------
  ";
    fwrite($handle, $str);
    fclose($handle);
}

function UpdateNumOrder($uid) {
    $order_prefix_format = $GLOBALS['SysValue']['my']['order_prefix_format'];
    $last_num = substr($uid, -$order_prefix_format);
    $total = strlen($uid);
    $ferst_num = substr($uid, 0, ($total - $order_prefix_format));
    return $ferst_num . "-" . $last_num;
}

// ��������� ������������ ����
$SysValue = parse_ini_file("../../phpshop/inc/config.ini", 1);
while (list($section, $array) = each($SysValue))
    while (list($key, $value) = each($array))
        $SysValue['other'][chr(73) . chr(110) . chr(105) . ucfirst(strtolower($section)) . ucfirst(strtolower($key))] = $value;

// as a part of ResultURL script
// your registration data
$LMI_SECRET_KEY = $SysValue['rbk']['secretKey'];


// build own CRC
$HASH = $_POST['eshopId'] . "::" . $_POST['orderId'] . "::" . $_POST['serviceName'] . "::" . $_POST['eshopAccount'] . "::" . $_POST['recipientAmount'] . "::" . $_POST['recipientCurrency'] . "::" . $_POST['paymentStatus'] . "::" . $_POST['userName'] . "::" . $_POST['userEmail'] . "::" . $_POST['paymentData'] . "::" . $_POST['secretKey'];
$MY_LMI_HASH = md5("$HASH");

if ($MY_LMI_HASH != $_POST['hash']) {
    echo "bad sign\n";
    WriteLog($MY_LMI_HASH);
    exit();
} else {
// perform some action (change order state to paid)
// ���������� ���� MySQL
    $link_db=mysqli_connect($SysValue['connect']['host'], $SysValue['connect']['user_db'], $SysValue['connect']['pass_db']);
    mysqli_select_db($link_db,$SysValue['connect']['dbase']);

    $new_uid = UpdateNumOrder($_POST['LMI_PAYMENT_NO']);


    // ��������� ���. ������
    $sql = "select uid from " . $SysValue['base']['table_name1'] . " where uid='$new_uid'";
    $result = mysqli_query($link_db,$sql);
    $row = mysqli_fetch_array($result);
    $uid = $row['uid'];

    // ��������� ������������ ���������� ���� � ������ ������. ������� ��� ��������� =3, ��� ���������� ������� = 5
    if ($_POST['secretKey'] == $LMI_SECRET_KEY) {
        if ($_POST['paymentStatus'] == 5) {
            if ($uid == $new_uid) {


                // ���������� ������ � ����
                $sql = "INSERT INTO " . $SysValue['base']['table_name33'] . " VALUES ('$new_uid','RBKMoney','$LMI_PAYMENT_AMOUNT','" . date("U") . "')";
                $result = mysqli_query($link_db,$sql);

                $sql = "UPDATE " . $SysValue['base']['table_name1'] . " SET statusi=101 WHERE uid='$new_uid'";
                $result = mysqli_query($link_db,$sql);

                WriteLog($MY_LMI_HASH);

                // print OK signature
                echo "OK";
            } else {
                WriteLog($MY_LMI_HASH);
                echo "bad order num\n";
                exit();
            }
        }
    } else {
        WriteLog($MY_LMI_HASH);
        echo "bad secret key\n";
        exit();
    }
}
?>
