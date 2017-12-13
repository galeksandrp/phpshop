<?php
/**
 * ����� ���� ������
 * @package PHPShopDepricated
 * @param int $tip �� ������
 * @return string
 */
function OplataMetod($tip) {
    $GetPathOrdermetod=GetPathOrdermetod($tip);
    return $GetPathOrdermetod['name'];
}

// �������� ���������� ������
if(PHPShopSecurity::true_param($_POST['send_to_order'],$_POST['mail'],$_POST['name_person'],$_POST['tel_name'],$_POST['adr_name'])) {

    $cart=$_SESSION['cart'];
    $disCart=null;
    $sum=null;
    $num=null;

    // ������ ������� � �������
    if(is_array($cart))
        foreach($cart as $j=>$i) {
            $disCart.=$cart[$j]['uid']."  ".$cart[$j]['name']." (".$cart[$j]['num']." ��. * ".ReturnSummaNal($cart[$j]['price'],0).") -- ".ReturnSummaNal($cart[$j]['price']*$cart[$j]['num'],0)." ".GetValutaOrder()."
";
            $sum+=$cart[$j]['price']*$cart[$j]['num'];
            $num+=$cart[$j]['num'];

            // ����������� � ������������ ����
            $goodid=$cart[$j]['id'];
            $goodnum=$cart[$j]['num'];
            $wsql='select weight from '.$SysValue['base']['table_name2'].' where id=\''.$goodid.'\'';
            $wresult=mysql_query($wsql);
            $wrow=mysql_fetch_array($wresult);
            $cweight=$wrow['weight']*$goodnum;
            if (!$cweight) {
                $zeroweight=1;
            } //���� �� ������� ����� ������� ���!
            $weight+=$cweight;
        }

    // �������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
    if ($zeroweight) {
        $weight=0;
    }


    $sum=number_format($sum,"2",".","");
    $ChekDiscount=ChekDiscount($sum);
    $GetDeliveryPrice=GetDeliveryPrice($_POST['d'],$sum,$weight);
    $disCart.="
-------------------------------------------------------
����� -- ".ReturnSummaNal($sum,0)." ".GetValutaOrder()."
������ -- ".$ChekDiscount[0]."%
�������� -- ".$GetDeliveryPrice." ".GetValutaOrder()."
-------------------------------------------------------
� ������ � ������ ������: ".(GetPriceOrder($ChekDiscount[1])+$GetDeliveryPrice)." ".GetValutaOrder();

    $content="������� �������!
--------------------------------------------------------
������� �� ������� � ����� ��������-�������� '".$PHPShopSystem->getName()."'
���� ��������� �������� � ���� �� �����������, 
����������� � ����� ������.


����������� ������ � ".$_POST['ouid']." �� ".date("d-m-y")."
--------------------------------------------------------
���������� ����: ".$_POST['name_person'];

    if(!empty($_POST['org_name'])) {
        $content.="
��������: ".$_POST['org_name']."
���: ".$_POST['org_inn']."
���: ".$_POST['org_kpp'];
    }

    $content.="
�������: ".$_POST['tel_code']."-".$_POST['tel_name']."
����� � ���. ���: ".$_POST['adr_name']."
�������� ����� ��������: ".$_POST['dos_ot']." - ".$_POST['dos_do']."
���������������: ".GetDeliveryBase($_POST['dostavka_metod'],'city')."
E-mail: ".$_POST['mail']."
��� ������: ".OplataMetod($_POST['order_metod'])."

���������� ������
--------------------------------------------------------
".$disCart;
    if(empty($_SESSION['UsersId']))
        $content.="

�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� �� ������ http://".$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']."/clients/?mail=".$_POST['mail']."&order=".$_POST['ouid']."
E-mail: ".$_POST['mail']."
� ������: ".$_POST['ouid'];
    else
        $content.="

�� ������ ������ ��������� ������ ������, ��������� �����, ����������� ��������� 
��������� ��-���� ����� '������ �������' ��� �� ������ http://".$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']."/users/";

    $content.="

---------------------------------------------------------
� ���������,
�������� ".$LoadItems['System']['company']."
".$LoadItems['System']['adminmail2']."
http://".$_SERVER['SERVER_NAME'].$SysValue['dir']['dir'];

    $codepage  = "windows-1251";
    $header  = "MIME-Version: 1.0\n";
    $header .= "From:   <".$LoadItems['System']['adminmail2'].">\n";
    $header .= "Content-Type: text/plain; charset=$codepage\n";
    $header .= "X-Mailer: PHP/";
    $zag=$LoadItems['System']['name']." - ��� ����� ".$_POST['ouid']."/".date("d-m-y")." ������� ��������";

    $content_adm="
������� �������!
--------------------------------------------------------

�������� ����� � ��������-�������� '".$LoadItems['System']['name']."'
��� �������������� ��������� ������ ��������� � ������
����������������� �������� http://".$_SERVER['SERVER_NAME'].$SysValue['dir']['dir']."/phpshop/admpanel/

���������� ������
---------------------------------------------------------
".$disCart."

����������� ������ � ".$_POST['ouid']."/".date("d-m-y")."
---------------------------------------------------------
���������� ����: ".$_POST['name_person'];

    if(!empty($_POST['org_name'])) {
        $content_adm.="
��������: ".$_POST['org_name']."
���: ".$_POST['org_inn']."
���: ".$_POST['org_kpp'];
    }

    $content_adm.="
�������: ".$_POST['tel_code']."-".$_POST['tel_name']."
����� � ���. ���: ".$_POST['adr_name']."
�������� ����� ��������: ".$_POST['dos_ot']." - ".$_POST['dos_do']."
���������������: ".GetDeliveryBase($_POST['dostavka_metod'],'city')."
E-mail: ".$_POST['mail']."
��� ������: ".OplataMetod($_POST['order_metod'])."
����/�����: ".date("d-m-y H:i a")."
IP:".$_SERVER['REMOTE_ADDR']."
REF: ".base64_decode($_COOKIE['ps_partner'])." 
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];

    $codepage  = "windows-1251";
    $header_adm  = "MIME-Version: 1.0\n";
    $header_adm .= "From:   <".$LoadItems['System']['adminmail2'].">\n";
    $header_adm .= "Content-Type: text/plain; charset=$codepage\n";
    $header_adm .= "X-Mailer: PHP/";
    $zag_adm=$LoadItems['System']['name']." - �������� ����� �".$_POST['ouid']."/".date("d-m-y");
    $datas=date("U");

    // ������� ������ ������
    $OrderWrite = new OrderWrite($ChekDiscount[0],$GetDeliveryPrice);
    $Content = $OrderWrite->MAS;

    // ���-�� ������� � �������
    $NumInCart = $OrderWrite->NUM; 

    if($NumInCart>0) {

        // �������� �����
        $Option=unserialize($LoadItems['System']['admoption']);
        mail($LoadItems['System']['adminmail2'],$zag_adm, $content_adm, $header_adm);
        mail($mail,$zag,$content,$header);

        // �������� SMS
        if($Option['sms_enabled'] == 1) {
            $sum = GetPriceOrder($ChekDiscount[1])+$GetDeliveryPrice;
            $msg="�������� ����� N$id �� ����� $sum ".GetValutaOrder();
            $phone=$SysValue['sms']['phone'];

            include_once($SysValue['file']['sms']);
            SendSMS($msg,$phone);
        }

        // ������ ������
        $Status=array(
                "maneger"=>"",
                "time"=>""
        );

        // ������ ������ � ��
        $sql="INSERT INTO ".$SysValue['base']['table_name1']."
   VALUES ('','$datas','".$_POST['ouid']."','$Content','".serialize($Status)."','".$_SESSION['UsersId']."','','0')";
        $result=mysql_query($sql);
    }
}
?>