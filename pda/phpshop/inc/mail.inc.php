<?
function true_email($email) {
if(strlen($email)>100) return FALSE;
return preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$email);
}

function true_login($login) {
return ereg("^[a-zA-Z0-9_\.]{2,20}$",$login);
}

function true_passw($passw) {
return ereg("^[a-zA-Z0-9_]{4,20}$",$passw);
}


function TotalClean($str,$flag)// ������ 
/*
  1 - ��������� �������;
  2 - ����������� ��� � ��� html;
  3 - ��������� ����;
  4 - ��������� ���� � �����
  5 - �������� �����
*/
{
 if($flag==1)// �������
 {
   if (!ereg ("([0-9])", $str)) 
     {
     $str="0";
     }
     return abs($str);
   }
 elseif($flag==2)// ������� ����
      {
	  return htmlspecialchars(stripslashes($str));
	  }
 elseif($flag==3)// ��������� ������ �� ���� � ����
      {
	 //�������� �����
	  if(!preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$str))
        {
        $str="";
        }
	   return $str;
	  }
 elseif($flag==4)// ��������� ������ �� ����
      {
	  if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$str)) 
        {
        $str="";
         }
       return  htmlspecialchars(stripslashes($str));
	  }
 elseif($flag==5)// �������� �������� ����
      {
	  if (preg_match("/[^(0-9)|(\-)|(\.]/",$str)) 
       {
       $str="0";
       }
       return $str;
	  }
}

function OplataMetod($tip){
if($tip==1) return "����������� ������";
if($tip==2) return "��������� ���������";
if($tip==3) return "�������� ������";
else return "����������� ��������� �������";
}


function StatMoneyClient($sum){
global $SERVER_NAME;
$proxy=0;
$key="dennion";
$mdm=md5($sum.":".$SERVER_NAME.":".$key);

if($proxy==1)
$fp = fsockopen("192.168.0.1", 8080, $errno, $errstr);
else
$fp = fsockopen("www.phpshop.ru", 80, $errno, $errstr);

if (!$fp) {
   //echo "$errstr ($errno)<br/>\n";
   $error="ERROR";
} else {
   fputs($fp, "GET /statmoneyserver.php?sum=$sum&name=$SERVER_NAME&key=$mdm  HTTP/1.0\r\n"); 
   fputs($fp, "Host: www.phpshop.ru\r\n"); 
   fputs($fp, "Connection: close\r\n\r\n");
   fclose($fp); 
}
}



if(@$send_to_order and @$mail and @$name_person and @$tel_name and @$adr_name)
{
// ������ ������� � �������
if(is_array(@$cart))
foreach($cart as $j=>$i)
  {
  @$disCart.=$cart[$j]['name']." (".$cart[$j]['num']." ��. * ".ReturnSummaNal($cart[$j]['price'],0).") -- ".ReturnSummaNal($cart[$j]['price']*$cart[$j]['num'],0)." ".GetValutaOrder()."
";
  @$sum+=$cart[$j]['price']*$cart[$j]['num'];
  @$num+=$cart[$j]['num'];
//����������� � ������������ ����
 $goodid=$cart[$j]['id'];
 $goodnum=$cart[$j]['num'];
 $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
 $wresult=mysql_query($wsql);
 $wrow=mysql_fetch_array($wresult);
 $cweight=$wrow['weight']*$goodnum;
 if (!$cweight) {$zeroweight=1;} //���� �� ������� ����� ������� ���!
 $weight+=$cweight;

  }

//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {$weight=0;}


 @$sum=number_format($sum,"2",".","");
 $ChekDiscount=ChekDiscount($sum);
 $GetDeliveryPrice=GetDeliveryPrice($_POST['d'],$sum,$weight);
@$disCart.="
-------------------------------------------------------
����� -- ".ReturnSummaNal($sum,0)." ".GetValutaOrder()."
������ -- ".$ChekDiscount[0]."%
�������� -- ".$GetDeliveryPrice." ".GetValutaOrder()."
-------------------------------------------------------
� ������ � ������ ������: ".(GetPriceOrder($ChekDiscount[1])+$GetDeliveryPrice)." ".GetValutaOrder();

$content="������� �������!
--------------------------------------------------------
������� �� ������� � ����� ��������-�������� '".$LoadItems['System']['name']."'
���� ��������� �������� � ���� �� �����������, 
������������ � ����� ������.


����������� ������ � ".@$ouid." �� ".date("d-m-y")."
--------------------------------------------------------
���������� ����: ".@$name_person."
��������: ".@$org_name."
�������: ".$tel_code."-".@$tel_name."
����� � ���. ���: ".@$adr_name."
�������� ����� ��������: ".$dos_ot." - ".$dos_do."
���������������: ".GetDeliveryBase($dostavka_metod,'city')."
E-mail: ".@$mail."
��� ������: ".OplataMetod($order_metod)."

���������� ������
--------------------------------------------------------
".$disCart;
if(!isset($_SESSION['UsersId']))
$content.="

�� ������ ������ ��������� ������ ������, ����������� ��������� 
��������� ��-���� ����� '��� �����' ��� �� ������ http://".$SERVER_NAME.$SysValue['dir']['dir']."/clients/?mail=".@$mail."&order=".@$ouid."
E-mail: ".@$mail."
� ������: ".@$ouid."";
else
$content.="

�� ������ ������ ��������� ������ ������, ����������� ��������� 
��������� ��-���� ����� '������ �������' ��� �� ������ http://".$SERVER_NAME.$SysValue['dir']['dir']."/users/";

$content.="

---------------------------------------------------------
� ���������,
�������� ".$LoadItems['System']['company']."
".$LoadItems['System']['adminmail2']."
http://".$SERVER_NAME.$SysValue['dir']['dir'];

$codepage  = "windows-1251";              
$header  = "MIME-Version: 1.0\n";
$header .= "From:   <".$LoadItems['System']['adminmail2'].">\n";
$header .= "Content-Type: text/plain; charset=$codepage\n";
$header .= "X-Mailer: PHP/";
$zag=$LoadItems['System']['name']." - ��� ����� ".@$ouid."/".date("d-m-y")." ������� ��������";

  $content_adm="
������� �������!
--------------------------------------------------------

�������� ����� � ��������-�������� '".$LoadItems['System']['name']."'
��� �������������� ��������� ������ ��������� � ������
����������������� �������� http://$SERVER_NAME".$SysValue['dir']['dir']."/phpshop/admpanel/

���������� ������
---------------------------------------------------------
".$disCart."

����������� ������ � ".@$ouid."/".date("d-m-y")."
---------------------------------------------------------
���������� ����: ".@$name_person."
��������: ".@$org_name."
�������: ".@$tel_code."-".@$tel_name."
����� � ���. ���: ".@$adr_name."
�������� ����� ��������: ".$dos_ot." - ".$dos_do."
���������������: ".GetDeliveryBase($dostavka_metod,'city')."
E-mail: ".@$mail."
��� ������: ".OplataMetod($order_metod)."
����/�����: ".date("d-m-y H:i a")."
IP:".$REMOTE_ADDR."
REF: ".base64_decode(@$_COOKIE['ps_partner'])." 
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];


$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$LoadItems['System']['adminmail2'].">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." - �������� ����� �".@$ouid."/".date("d-m-y");

$datas=date("U");


// ����� ������ � ���� �������
$OrderWrite = new OrderWrite(@$cart,$_REQUEST,$LoadItems,$SysValue,$ChekDiscount[0],$_SESSION['UsersId'],
$GetDeliveryPrice);
$Content = $OrderWrite->MAS;
$NumInCart = $OrderWrite->NUM; // ���-�� ������� � �������

if($NumInCart>0){

// ���� �����
$Option=unserialize($LoadItems['System']['admoption']);
mail($LoadItems['System']['adminmail2'],$zag_adm, $content_adm, $header_adm);
mail($mail,$zag,$content,$header);

// �������� SMS
if($Option['sms_enabled'] == 1) {
$sum = GetPriceOrder($ChekDiscount[1])+$GetDeliveryPrice;
$msg="�������� ����� N$id �� ����� $sum ".GetValutaOrder();
$phone=$SysValue['sms']['phone'];
SendSMS($msg,$phone);
}



// ������� ������������ � ��������
if(@$_POST['mail_active'] == 1){
$sql="INSERT INTO ".$SysValue['base']['table_name9']."
   VALUES ('','$datas','$mail')";
   $result=mysql_query($sql);
}

$Status=array(
"maneger"=>"",
"time"=>""
);

// ��������
foreach($_SESSION['cart'] as $v)
@$seller.="i".$v['user']."i";

 $sql="INSERT INTO ".$SysValue['base']['table_name1']."
   VALUES ('','$datas','$ouid','$Content','".serialize($Status)."','".$_SESSION['UsersId']."','".@$seller."','0')";
   $result=mysql_query($sql);
//session_unregister('cart');

// ������� � ����� ���������� �������
if(!getenv("COMSPEC") and $SysValue['my']['money_stat'] == "true")
$Money = StatMoneyClient($sum);

}
}
?>
