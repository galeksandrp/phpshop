<?
/*
+-------------------------------------+
|  PHPShop 3.0 Enterprise             |
|  ������ Success Payment Url         |
+-------------------------------------+
*/


function UpdateNumOrder($uid) {
    $last_num = substr($uid, -2);
    $total=strlen($uid);
    $ferst_num = substr($uid,0,($total-2));
    return $ferst_num."-".$last_num;
}


// ������� ������ ������������� ������
function CheckStatusReady() {
    global $SysValue;
    $sql="select id from ".$SysValue['base']['table_name32']." where id=101 limit 1";
    $result=mysql_query($sql);
    $num=@mysql_numrows(@$result);

// ������ ������ �������
    if($num==0)
        mysql_query("INSERT INTO ".$SysValue['base']['table_name32']." VALUES (101, '�������� ���������� ���������', '#ccff00','')");

    return 101;
}

// �������� ������ ������ �� ����������
function Success($inv_id,$out_summ,$order_metod) {
    global $SysValue;
    
    if(!empty($out_summ)) mysql_query("INSERT INTO ".$SysValue['base']['table_name33']."
            VALUES ('$inv_id','$order_metod','$out_summ','".date("U")."')");

    $CheckStatusReady=CheckStatusReady();
    $sql="UPDATE ".$SysValue['base']['table_name1']."
     SET
     statusi=$CheckStatusReady 
     where uid='".UpdateNumOrder($inv_id)."'";
    mysql_query($sql);
}


// ���������� ����������� success.php �� /payment/
$path="payment/";
if(@$dh = opendir($path)) {
    while (($file = readdir($dh)) !== false) {
        if ($file != "." && $file != "..")
            if(is_dir($path.$file))
                if(file_exists($path.$file."/success.php"))
                    include_once($path.$file."/success.php");
    }
    closedir($dh);
}

if (strtoupper(@$my_crc) != strtoupper(@$crc)) {
    $SysValue['other']['orderNum']=TotalClean($inv_id,4);
    $SysValue['other']['mycrc']=$my_crc;
    $SysValue['other']['crc']=$crc;
    $SysValue['other']['DispShop']= ParseTemplateReturn("error/error_payment.tpl");
}
else {
    $inv_id=TotalClean($inv_id,4);
    $orderId=$inv_id;
    $inv_id=UpdateNumOrder($inv_id);

// ��������� ���. ������
    $sql="select uid from ".$SysValue['base']['table_name1']." where uid='$inv_id'";
    $result=mysql_query($sql);
    $num=mysql_num_rows($result);
    $row=mysql_fetch_array($result);
    $uid=$row['uid'];

    if($num>0) {

// ����� �������� �� ����
        $sql="select message,message_header from ".$SysValue['base']['table_name48']." where  path='$order_metod' and enabled='1'";
        $result=mysql_query(@$sql);
        $row = mysql_fetch_array(@$result);

        $message=$row['message'];
        $message_header=$row['message_header'];

        $SysValue['other']['numOrder']=$uid;


// ������� ������� ������ � ��������
        if($success_function==true)
            Success($orderId,$out_summ,$order_metod);


        $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$message_header."</B></FONT><BR>".$message;

        $SysValue['other']['orderMesage']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
        $SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);

// ������� �������
        session_unregister('cart');
    }
    else {
        $SysValue['other']['DispShop']= ParseTemplateReturn("error/error_payment.tpl");
    }
}

// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
?>
