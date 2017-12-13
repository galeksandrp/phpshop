<?php
/**
 * ���������� ������ ������ ����� RBS
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopPayment
 */

if(empty($GLOBALS['SysValue'])) exit(header("Location: /"));

// ��������������� ����������
$MERCHANTNUMBER = $SysValue['rbs']['MERCHANTNUMBER'];    //�������
$MERCHANTPASSWD = $SysValue['rbs']['MERCHANTPASSWD']; 
$KEY=$SysValue['rbs']['KEY']; 

//��������� ��������
$mrh_ouid = explode("-", $_POST['ouid']);
$inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

//�������� �������
$inv_desc  = "$inv_id";
$out_summ  = $GLOBALS['SysValue']['other']['total']*$SysValue['rbs']['kurs']; //����� �������


$HASH=$MERCHANTNUMBER.$MERCHANTPASSWD.$inv_id.$KEY;
$LMI_HASH = substr(strtoupper(md5("$HASH")),0,10);
$MY_BACKURL=base64_encode("id=$inv_id&h=$LMI_HASH&s=$out_summ");
$url="/bpcservlet/Merchant2Rbs?MERCHANTNUMBER=$MERCHANTNUMBER&ORDERNUMBER=$inv_id&AMOUNT=$out_summ&BACKURL=http://$SERVER_NAME/payment/rbs/result.php?my=$MY_BACKURL&\$ORDERDESCRIPTION=$inv_desc&LANGUAGE=RU&DEPOSITFLAG=0&MERCHANTPASSWD=$MERCHANTPASSWD";
$fp = fsockopen("engine.paymentgate.ru", 80, $errno, $errstr);
if (!$fp) {
   return exit("������ ���������� � �������� PHPShop");
} else {
   fputs($fp, "GET $url HTTP/1.0\r\n"); 
   fputs($fp, "Host: engine.paymentgate.ru\r\n"); 
   fputs($fp, "Connection: close\r\n\r\n");
    $i=0;
    $mdOrder = "";
    $srch = "NAME=MDORDER VALUE=";
   while (!feof ($fp)) {
        $i++;
        $line = fgets ($fp, 1024);
        $i1 = strpos($line, $srch);
        if (is_integer($i1)) {
                $i1 = $i1+strlen($srch);
                $mdOrder = substr($line, $i1, strpos($line, ">",$i1)-$i1);
        }
    }
fclose($fp);
}


// ����� HTML �������� � ������� ��� ������
$disp= "
<div align=\"center\">

 <p><br></p>
 
 <img src=\"phpshop/lib/templates/icon/bank/visa.gif\" border=\"0\" hspace=5>
  <img src=\"phpshop/lib/templates/icon/bank/mastercard.gif\" border=\"0\" hspace=5>
   <img src=\"phpshop/lib/templates/icon/bank/set.gif\" border=\"0\" hspace=5>
  <p><br></p>

<form name=PaymentForm action=\"https://engine.paymentgate.ru/bpcservlet/BPC/AcceptPayment.jsp\"> 
    <INPUT TYPE=Hidden NAME=MDORDER VALUE=\"$mdOrder\"> 
	<table>
<tr>
	<td><img src=\"images/shop/icon-client-new.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" align=\"left\">
	<a href=\"javascript:PaymentForm.submit();\">�������� ����� ��������� �������</a></td>
</tr>
</table>
</form> 
</div>";

?>