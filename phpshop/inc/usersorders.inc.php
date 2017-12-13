<?php
/**
 * ����� ������� � ������ �������� ������������
 * @package PHPShopCoreDepricated
 * @param string $n �� ������
 * @param string $orderDate ���� ������
 * @return string
 */
function GetOrderDocsList($n,$orderDate) {
    global $SysValue,$LoadItems;

    $n=TotalClean($n,5);
    $sql="select * from ".$SysValue['base']['table_name9']." where uid=$n";
    $result=mysql_query($sql);
    @$row = mysql_fetch_array(@$result);
    @$num=mysql_num_rows(@$result);

    if(!empty($num)) {
        $id=$row['id'];
        $datas=$row['datas'];
        $datas_f=$row['datas_f'];

        if($LoadItems['System']['1c_load_accounts'] == 1)
            $dis="<tr>
  <td id=allspec><strong>���������������</strong></td>
  <td id=allspec>
  <strong>����</strong>
  </td>
   <td id=allspec colspan=2>
  <strong>��������</strong>
  </td>
</td>
</tr>
<tr>
  <td id=allspecwhite>
  <a class=b href=\"../files/docsSave.php?orderId=$n&list=accounts&datas=$orderDate\" title=\"��������� ���� �� ������\" target=\"_blank\">���� �� ������</a>
  </td>
  <td id=allspecwhite>
                    ".PHPShopDate::dataV($datas)."
  </td>
   <td id=allspecwhite colspan=2 align=center>
  <a class=b href=\"../files/docsSave.php?orderId=$n&list=accounts&tip=html&datas=$orderDate\" target=\"_blank\" title=\"������ Web\">HTM</a>&nbsp;&nbsp;&nbsp;
<a class=b href=\"../files/docsSave.php?orderId=$n&list=accounts&tip=doc&datas=$orderDate\" target=\"_blank\" title=\"������ Word\">DOC</a>&nbsp;&nbsp;&nbsp;
<a class=b href=\"../files/docsSave.php?orderId=$n&list=accounts&tip=xls&datas=$orderDate\" target=\"_blank\" title=\"������ Excel\">XLS</a>
  </td>
</td>
</tr>";

        // ����-�������
        if($datas_f>0 and $LoadItems['System']['1c_load_invoice'] == 1)
            $dis.="
<tr>
  <td id=allspecwhite>
  <a class=b href=\"../files/docsSave.php?orderId=$n&list=invoice&datas=$orderDate\" title=\"��������� ����-�������\" target=\"_blank\">����-�������</a>
  </td>
  <td id=allspecwhite>
                    ".PHPShopDate::dataV($datas)."
  </td>
  <td id=allspecwhite colspan=2 align=center>
  <a class=b href=\"../files/docsSave.php?orderId=$n&list=invoice&tip=html&datas=$orderDate\" target=\"_blank\" title=\"������ Web\">HTM</a>&nbsp;&nbsp;&nbsp;
<a class=b href=\"../files/docsSave.php?orderId=$n&list=invoice&tip=doc&datas=$orderDate\" target=\"_blank\" title=\"������ Word\">DOC</a>&nbsp;&nbsp;&nbsp;
<a class=b href=\"../files/docsSave.php?orderId=$n&list=invoice&tip=xls&datas=$orderDate\" target=\"_blank\" title=\"������ Excel\">XLS</a>
  </td>
</tr>";
        return $dis;
    }
}

/**
 * �������� ������� �������� ������
 * @package PHPShopDepricated
 * @return string 
 */
function GetOrderStatusArray() {
    global $SysValue;
    
    $sql="select * from ".$SysValue['base']['table_name32'];
    $result=mysql_query($sql);
    while(@$row = mysql_fetch_array(@$result)) {
        $array=array(
                "id"=>$row['id'],
                "name"=>$row['name'],
                "color"=>$row['color'],
                "sklad"=>$row['sklad_action']
        );
        $Status[$row['id']]=$array;
    }
    return $Status;
}


/**
 * ����� ������� � ������ ������� ������������
 * @package PHPShopCoreDepricated
 * @param int $n ����� ������
 * @param int $tip �������� ������
 * @return string 
 */
function GetUsersOrdersList($n,$tip) {
    global $SysValue;
    
    $n=TotalClean($n,5);
    $dis=null;
    if($tip==2) $sql="select * from ".$SysValue['base']['table_name1']." where uid='".htmlspecialchars($n)."'";
    if($tip==1) $sql="select * from ".$SysValue['base']['table_name1']." where user='$n' order by datas desc";
    
    $result=mysql_query($sql) or die("����������� ���������: <A href=\"mailto:support@phpshop.ru\">support@phpshop.ru</A>");
    while(@$row = mysql_fetch_array(@$result)) {
        $id=$row['id'];
        $datas=$row['datas'];
        $uid=$row['uid'];
        $order=unserialize($row['orders']);
        $status=unserialize($row['status']);
        $statusi=$row['statusi'];
        
        if($tip==1) $link="?orderId=$uid#PphpshopOrder";
        else $link="/users/register.html";

        $GetOrderStatusArray=GetOrderStatusArray();
        if($statusi==0) {
            $bg="C0D2EC";
            $status_name="����� �����";
        }
        else {
            $bg=$GetOrderStatusArray[$statusi]['color'];
            $status_name=$GetOrderStatusArray[$statusi]['name'];
        }

        $docsLink2='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/2/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_dialog.gif" alt="��������� ���������" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
        $docsLink1='<a href="javascript:void(0)"  onclick="miniWinFull(\'phpshop/forms/1/forma.html?orderId='.$id.'&tip='.$tip.'&datas='.$datas.'\',650,550);" ><img src="images/shop/interface_browser.gif" alt="���� � ����" width="16" height="16" border="0" hspace="1" align="absmiddle"></a>';
        if($order['Person']['order_metod']==3)  $docsLink="";

        // ����� ������
        $SummaOrder=ReturnSummaNal($order['Cart']['sum'],$order['Person']['discount']);

        $dis.='<tr>
	<td id=allspecwhite>
	<a href="'.$link.'" class="b" title="���������� � ������ � '.$uid.'"><img src="images/shop/icon-setup.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">'.$uid.'</a>
	</td>
	<td id=allspecwhite>
	'.PHPShopDate::dataV($datas).'
	</td>
	<td id=allspecwhite>
	'.(0+$order['Cart']['num']).'
	</td>
	<td id=allspecwhite>
	'.$order['Person']['discount'].'
	</td>
	<td id=allspecwhite>
	'.($SummaOrder+GetDeliveryPrice($order['Person']['dostavka_metod'],$SummaOrder,$order['Cart']['weight'])).' '.GetValutaOrder().'
	</td>
	<td  bgcolor="'.$bg.'">
	'.$status_name.'
	</td>';
    }
    $dis='
<table id=allspecwhite cellpadding=3 width="95%">
<tr>
	<td id=allspec>
	<b>� ������</b>
	</td>
	<td id=allspec>
	<b>����</b>
	</td>
	<td id=allspec>
	<b>���-��</b>
	</td>
	<td id=allspec>
	<b>������ %</b>
	</td>
	<td id=allspec>
	<b>�����</b>
	</td>
	<td id=allspec>
	<b>������</b>
	</td>
</tr>'.$dis.'</table>';
    
    return $dis;
}

/**
 * ���������� ������ �� �����
 * @package PHPShopDepricated
 * @param string $files ��� �����
 * @return string 
 */
function CloseUrlFile($files) {
    global $SysValue;
    
    $str=array(
            "files"=>$files,
            "time"=>(time("U")+($SysValue['my']['digital_time']*86400))
    );
    $str=serialize($str);
    $code=base64_encode($str);
    $code2=str_replace($SysValue['my']['digital_pass1'],"!",$code);
    $code2=str_replace($SysValue['my']['digital_pass2'],"$",$code2);
    
    return $code2;
}

/**
 * �������� ������������ �������
 * @package PHPShopDepricated
 * @param int $uid ����� ������
 * @return int 
 */
function CheckPayment($uid) {
    global $SysValue;

    $sql="select * from ".$SysValue['base']['table_name33']." where uid='$uid'";
    @$result=mysql_query($sql);
    $num = mysql_numrows(@$result);
    
    return $num;
}

/**
 * ����� ������ � ������ � ������ �������� ������������
 * @package PHPShopDepricated
 * @param int $n �� ������
 * @param int $num
 * @param bool $sklad ������� �� ������
 * @param int $uid ����� ������
 * @return string
 */
function CheckProductFiles($n,$num,$sklad,$uid) {
    global $SysValue,$LoadItems;

    $n=TotalClean($n,5);
    $file_list=null;
    $sql="select files from ".$SysValue['base']['table_name2']." where id=$n limit 1";
    $result=mysql_query($sql);
    $row = mysql_fetch_array(@$result);
    $files=unserialize($row['files']);
    $admoption=unserialize($LoadItems['System']['admoption']);

    // ���� ����� ������� ����������
    $CheckPayment=CheckPayment($uid);
    if(is_array($files) and ($sklad==1 or $CheckPayment>0) and $admoption['digital_product_enabled'] == 1) {

        foreach($files as $f) {
            $_Name=pathinfo($f);
            $F=CloseUrlFile($f);

            // ������
            @$fstat = @stat($DOCUMENT_ROOT.$f);

            $file_list.="<tr>
	<td id=allspecwhite><a href=\"../files/filesSave.php?F=$F\" class=b title=\"".$SysValue['lang']['load']." ".$_Name['basename']."\"><img src=\"images/shop/action_save.gif\"  width=16 height=16 border=0 align=\"absmiddle\" hspace=5>".$_Name['basename']."</a></td>
	<td id=allspecwhite>".round($fstat['size']/1000)." ��</td></tr>";
        }
        $file_list="<table>$file_list</table>";
    }

    return $file_list;
}

/**
 * ����� ���������� �� ������ � ������ �������� ������������
 * @package PHPShopDepricated
 * @param string $n ����� �������
 * @param int $tip �������� ������ ��������� ����������
 * @return string 
 */
function GetUsersOrdersInfo($n,$tip=1) {
    global $SysValue,$LoadItems;
    
    $n=TotalClean($n,5);
    $disCart=null;
    $num=null;
    $sum=null;
    
    $sql="select * from ".$SysValue['base']['table_name1']." where uid='$n'";
    $result=mysql_query($sql);
    $num=mysql_num_rows($result);
    $row = mysql_fetch_array(@$result);
    $id=$row['id'];
    $datas=$row['datas'];
    $uid=$row['uid'];
    $order=unserialize($row['orders']);
    $status=unserialize($row['status']);
    $statusi=$row['statusi'];
    
    // ������ �������� ������
    $GetOrderStatusArray=GetOrderStatusArray();
    
    if($statusi==0) {
        $bg="C0D2EC";
        $status_name="����� �����";
    }
    else {
        $bg=$GetOrderStatusArray[$statusi]['color'];
        $status_name=$GetOrderStatusArray[$statusi]['name'];
        $status_id=$GetOrderStatusArray[$statusi]['id'];
    }

    $cart=$order['Cart']['cart'];
    
    // ����� ������� ������
    if(sizeof($cart)!=0)
        foreach($cart as $val) {
            $disCart.="<tr>
  <td id=allspecwhite><a href=\"/shop/UID_".$val['id'].".html\" target=\"_blank\" class=b title=\"".$val['name']."\"><img src=\"images/shop/icon-setup.gif\"  width=16 height=16 border=0 align=\"absmiddle\" hspace=5>".$val['name']."</a>
".CheckProductFiles($val['id'],0,$GetOrderStatusArray[$statusi]['sklad'],$uid)."
</td>
  <td id=allspecwhite>".$val['num']."</td>
  <td id=allspecwhite>".ReturnSummaNal($val['price']*$val['num'],$order['Person']['discount'])." ".GetValutaOrder()."</td></tr>";
            $num+=$val['num'];
            $sum+=$val['price']*$val['num'];
        }

    // ��������
    $GetDeliveryPrice=GetDeliveryPrice($order['Person']['dostavka_metod'],$sum,$order['Cart']['weight']);

    // �������� �����
    $TotalSumOrder = ReturnSummaNal($sum,$order['Person']['discount'])+$GetDeliveryPrice;
    
    $disCart.="<tr>
  <td id=allspecwhite>�������� -  ".GetDeliveryBase($order['Person']['dostavka_metod'],"city")."</td>
  <td id=allspecwhite>1</td>
  <td id=allspecwhite>".$GetDeliveryPrice." ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite>����� � ������ ������ <b>".$order['Person']['discount']."</b>%</td>
  <td id=allspecwhite><b>".$num."</b> ��.</td>
  <td colspan=\"2\" id=allspecwhite><b>".$TotalSumOrder."</b> ".GetValutaOrder()."</td>
</tr>
<tr>
  <td id=allspecwhite><img src=\"images/shop/icon_clock.gif\" alt=\"����� ��������� ������� ������\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5>����� ��������� ������: ".$status['time']."</td>
  <td colspan=\"3\" bgcolor=".$bg.">".$status_name."</td>
</tr>
<tr>
  <td id=allspec><strong>������ ������</strong></td>
  <td colspan=\"3\" id=allspecwhite>";

    // ������ �� ��� ������
    $GetPathOrdermetod = GetPathOrdermetod($order['Person']['order_metod']);

    // ������ �� ������ � ���������
    switch($GetPathOrdermetod['path']) {
        
        case("message"):
            $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>";
            break;
        
        case("bank"):
            if($LoadItems['System']['1c_load_accounts']!=1) {
                $disCart.="<a href=\"phpshop/forms/1/forma.html?orderId=$id&tip=$tip&datas=$datas\" class=b title=\"".$GetPathOrdermetod['name']."\"  target=\"_blank\"><img src=\"images/shop/interface_browser.gif\" alt=\"".$GetPathOrdermetod['name']."\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" vspace=3  hspace=5>".$GetPathOrdermetod['name']."</a>";
            }else {
                $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>. �������� �����, ����� ���������� ��������� �� ������������� �������� � ������ ������� ������� ��������.";
            }
            break;

        case("sberbank"):
            $disCart.="
	<a href=\"phpshop/forms/2/forma.html?orderId=$id&tip=$tip&datas=$datas\"  class=b  title=\"".$GetPathOrdermetod['name']."\" target=\"_blank\" ><img src=\"images/shop/interface_dialog.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=5 alt=\"".$GetPathOrdermetod['name']."\">".$GetPathOrdermetod['name']."</a>";
            break;

        case("webmoney"):
            
            // ��������������� ����������
            $LMI_PAYEE_PURSE = $SysValue['webmoney']['LMI_PAYEE_PURSE'];    //�������
            $wmid = $SysValue['webmoney']['wmid'];    //��������

            //��������� ��������
            $mrh_ouid = explode("-", $uid);
            $inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

            //�������� �������
            $inv_desc  = "������ ������ $inv_id";
            $out_summ  = $TotalSumOrder*$SysValue['webmoney']['kurs']; //����� �������

            if($status_id == 101)
                $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>";
            else
                $disCart.="
	 <form id=pay name=paywebmoney method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\" name=\"paywebmoney\">
    <input type=hidden name=LMI_PAYMENT_AMOUNT value=\"$out_summ\">
	<input type=hidden name=LMI_PAYMENT_DESC value=\"$inv_desc\">
	<input type=hidden name=LMI_PAYMENT_NO value=\"$inv_id\">
	<input type=hidden name=LMI_PAYEE_PURSE value=\"$LMI_PAYEE_PURSE\">
	<input type=hidden name=LMI_SIM_MODE value=\"0\">
	<a href=\"javascript:void(0)\" class=b title=\"�������� ".$GetPathOrdermetod['name']."\" onclick=\"javascript:paywebmoney.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"�������� ".$GetPathOrdermetod['name']."\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>".$GetPathOrdermetod['name']."</a></form>";
            break;

        case("robox"):
            
            // ��������������� ����������
            $mrh_login = $SysValue['roboxchange']['mrh_login'];    //�����
            $mrh_pass1 = $SysValue['roboxchange']['mrh_pass1'];    // ������1

            // ��������� ��������
            $mrh_ouid = explode("-", $uid);
            $inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����

            // �������� �������
            $inv_desc  = "PHPShopPaymentService";
            $out_summ  = $TotalSumOrder*$SysValue['roboxchange']['mrh_kurs']; //����� �������
            $shp_item = 2;                //��� ������

            // ������������ �������
            $crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shp_item=$shp_item");

            if($status_id == 101)
                $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>";
            else
                $disCart.="<form action='https://www.roboxchange.com/ssl/calc.asp' method=POST name=\"payrobots\">
      <input type=hidden name=mrh value=$mrh_login>
      <input type=hidden name=out_summ value=$out_summ>
      <input type=hidden name=inv_id value=$inv_id>
      <input type=hidden name=inv_desc value=$inv_desc>
	<a href=\"javascript:void(0)\" class=b title=\"�������� ".$GetPathOrdermetod['name']."\" onclick=\"javascript:payrobots.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"�������� ".$GetPathOrdermetod['name']."\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>".$GetPathOrdermetod['name']."</a></form>";
            break;

        case("payonlinesystem"):

            // ��������������� ����������
            $PrivateSecurityKey=$SysValue['payonlinesystem']['PrivateSecurityKey'];
            $MerchantId=$SysValue['payonlinesystem']['MerchantId'];
            $mrh_ouid = explode("-", $uid);
            $inv_id = $mrh_ouid[0]."".$mrh_ouid[1];     //����� �����
            $OrderId=$inv_id;
            $Amount=number_format($TotalSumOrder,2,".","");
            $Currency="RUB";
            $SecurityKey=md5("MerchantId=$MerchantId&OrderId=$OrderId&Amount=$Amount&Currency=$Currency&PrivateSecurityKey=$PrivateSecurityKey");

            if($status_id == 101)
                $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>";
            else
                $disCart.="<form name=\"PaymentForm\" action=\"https://secure.payonlinesystem.com/ru/payment/\" method=\"get\" target=\"_top\" >
<input type=\"hidden\" name=\"OrderId\" id=\"OrderId\" value=\"$OrderId\">
<input type=\"hidden\" name=\"Amount\" id=\"Amount\" value=\"$Amount\">
<input type=\"hidden\" name=\"MerchantId\" value=\"$MerchantId\">
<input type=\"hidden\" name=\"Currency\" value=\"$Currency\">
<input type=\"hidden\" name=\"SecurityKey\" value=\"$SecurityKey\">
<a href=\"javascript:void(0)\" class=b title=\"�������� ".$GetPathOrdermetod['name']."\" onclick=\"javascript:PaymentForm.submit();\" ><img src=\"images/shop/coins.gif\" alt=\"�������� ".$GetPathOrdermetod['name']."\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\"  hspace=5>".$GetPathOrdermetod['name']."</a></form>";
            break;

        default:
            $disCart.="<strong>".$GetPathOrdermetod['name']."</strong>";
            break;
    }
    $disCart.="  </td></tr>";

    // �������� ����������
    $disCart.=GetOrderDocsList($id,$datas);
    $disCart='<table  id=allspecwhite cellpadding=3 width="95%"><tr>
  <td id=allspec><b>������������</b></td>
  <td id=allspec><b>���-��</b></td>
  <td id=allspec><b>�����</b></td></tr>'.$disCart.'</table>';

    if(!empty($status['maneger']))
        $disCart.='<div id=allspec>
<img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�������������� ����������</b>
</div><p><img src="images/shop/icon_user.gif" alt="��������" width="16" height="16" border="0" hspace="5" align="absmiddle"><a href="/users/message.html" title="����� � ����������" class="b">��������</a>: '.$status['maneger'].'</p>';

    if($num>0) return $disCart;
    else return "<font color=#FF0000>������������ ����� ������</font>";
}

/**
 * ����� ������� �������������
 * @package PHPShopCoreDepricated
 * @param int $UsersId �� ������������
 * @return string
 */
function UsersOrders($UsersId) {
    global $SysValue;
    
    $UsersId=TotalClean($UsersId,5);
    $dis='<div id=allspec><img src="images/shop/date.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>����� �������</b></div>
<p>'.GetUsersOrdersList($UsersId,1).'</p>';

    if(!empty($_GET['orderId']))
        $dis.='<div id=allspec>
<A id="PphpshopOrder"></A>
<img src="images/shop/icon_info.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>���������� �� ������ � '.TotalClean($_GET['orderId'],5).'</b>
</div><p>'.GetUsersOrdersInfo($_GET['orderId']).'</p>';

    return $dis;
}
?>