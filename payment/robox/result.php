<?
/*
+-------------------------------------+
|  PHPShop 2.1 Enterprise             |
|  ������ ResultUrl ROBOXchange       |
+-------------------------------------+
*/

function WriteLog($out_summ,$inv_id,$crc){
global $mrh_pass2,$REQUEST_URI,$REMOTE_ADDR;
$handle = fopen("../paymentlog.log", "a+");
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));
$str="
  ROBOXchange Payment Start ------------------
  date=".date("F j, Y, g:i a")."
  out_summ=$out_summ
  inv_id=$inv_id
  crc=$crc
  my_crc=$my_crc
  REQUEST_URI=$REQUEST_URI
  IP=$REMOTE_ADDR
  ROBOXchange Payment End --------------------
  ";
fwrite($handle, $str);
fclose($handle);
}


// ��������� ������������ ����
$SysValue=parse_ini_file("../../phpshop/inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// as a part of ResultURL script
// your registration data
$mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
$mrh_pass2 = $SysValue['roboxchange']['mrh_pass2'];    // ������2

// HTTP parameters: $out_summ, $inv_id, $crc
$crc = strtoupper($crc);   // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

if (strtoupper($my_crc) != strtoupper($crc))
{
  echo "bad sign\n";
  WriteLog($out_summ,$inv_id,$crc);
  exit();
}
else {
// perform some action (change order state to paid)
// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");

// ��������� ���. ������
$sql="select uid from ".$SysValue['base']['table_name1']." where uid='$inv_id'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$uid=$row['uid'];

if($uid == $inv_id){
// ���������� ������ � ����
$sql="INSERT INTO ".$SysValue['base']['table_name33']." VALUES 
('$inv_id','ROBOXchange Cash Register','$out_summ','".date("U")."')";
$result=mysql_query($sql);
WriteLog($out_summ,$inv_id,$crc);
// print OK signature
echo "OK$inv_id\n";
}
else {
     WriteLog($out_summ,$inv_id,$crc);
     echo "bad order num\n";
     exit();
     }
}
?>
