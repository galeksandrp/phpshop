<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ���� ���������� ������             |
+-------------------------------------+
*/

// ������� �������
function Chek($stroka)// �������� �������� ����
{
    if (!ereg ("([0-9])", $stroka)) $stroka="0";
    return abs($stroka);
}

function Chek2($stroka)// �������� �������� ����
{
    if (!ereg ("([0-9])", $stroka)) $stroka="0";
    return number_format(abs($stroka),"2",".","");
}


// ������� �������
if(@$SysValue['nav']['query']['cart']=="clean") {
    unset($_SESSION['cart']);
}


function ReturnNum($cart) {
    while (list($key, $value) = @each($cart)) @$num+=$cart[$key]['num'];
    return @$num;
}

if(isset($_POST['id_edit']))// �������������� ���-��
{
    $_SESSION['cart'][Chek($id_edit)]['num']=abs($num_new);
}
if(isset($id_delet))// �������� ������
{
    unset($_SESSION['cart'][Chek(@$id_delet)]);
}
if(@$_SESSION['cart'][@$id_edit]['num']=="0")// �������� ������ � ������� ���-��
{
    unset($_SESSION['cart'][$id_edit]);
}


if(isset($_GET['xid']))// ������ � ������
{
    $xid=Chek($_GET['xid']);
    $sql="select * from ".$SysValue['base']['table_name2']." where id=$xid and enabled='1'";
    $result=mysql_query($sql);
    @$row = mysql_fetch_array(@$result);
    $name=$row['name'];
    $price=$row['price'];
    $price=($price+(($price*$LoadItems['System']['percent'])/100));
    $uid=$row['uid'];
    $id=$row['id'];
    $user=$row['user'];

// ������� �� ���� ������ ������� ����
    if(!empty($_SESSION['UsersStatus'])) {
        $GetUsersStatusPrice=GetUsersStatusPrice($_SESSION['UsersStatus']);
        if($GetUsersStatusPrice>1) {
            $pole="price".$GetUsersStatusPrice;
            $pricePersona=$row[$pole];
            if(!empty($pricePersona))
                $price=($pricePersona+(($pricePersona*$LoadItems['System']['percent'])/100));
        }
    }

    $num=@$_SESSION['cart'][$xid]['num']+$_num;
    $cart_new=array(
            "id"=>"$id",
            "name"=>"$name",
            "price"=>$price,
            "uid"=>"$uid",
            "num"=>1,
            "user"=>$user
    );
    $_SESSION['cart'][$xid]=$cart_new;
}


$option=unserialize($LoadItems['System']['admoption']);

if(count(@$_SESSION['cart'])>0)// ����� �������
{
    $cart=$_SESSION['cart'];
    $display_cart=null;
    if(is_array($cart))
        foreach($cart as $j=>$v) {
            $price_now=ReturnSummaNal($cart[$j]['price']*$cart[$j]['num'],0);
            $priceOrder=$cart[$j]['price']*$cart[$j]['num'];

            //$CatId=$LoadItems['Product'][$cart[$j]['id']]['category'];
            //$Catname=$LoadItems['Podcatalog'][$CatId]['name'];

            $display_cart.='
<tr>
	<td>
	<form method="post" action="./">
	<a href="/shop/UID_'.$cart[$j]['id'].'.html" title="'.$cart[$j]['name'].'">'.$cart[$j]['name'].'</a></td>
	<td><input type=text value='.$cart[$j]['num'].' size=3 maxlength=3 name="num_new"></td>
	<td>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
	<input type=hidden name="id_edit" value='.$cart[$j]['id'].'>
	<input type="submit" name="edit_num" value="���.">
</td>
	<td>
</form>
<form method="post" action="./">
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
	
	<input type="submit" name="edit_del" value="���.">
	<input type=hidden name="id_delet" value='.$cart[$j]['id'].'>
	</td>
</tr>
</table>
</form>
	</td>
</tr>
</table>
	</td>
	<td align=right class=red>'.$price_now.' '.GetValutaOrder().'</td>
	</td>
</tr>

 ';
            $sum+=$price_now;
            $sumOrder+=$priceOrder;
            $sum=number_format($sum,"2",".","");
            $num+=$cart[$j]['num'];

//����������� � ������������ ����
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




//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
    if ($zeroweight) {
        $weight=0;
        $we=' &ndash; �� ������';
    } else {
        $we='&nbsp;��.';
    }

    $GetDeliveryPrice=GetDeliveryPrice("",$sum,$weight);


    if(count(@$cart)>0) {
        $ChekDiscount=ChekDiscount($sumOrder);
        @$display='
<script language="JavaScript">
window.document.getElementById("num").innerHTML="'.$num.'";
window.document.getElementById("sum").innerHTML="'.$sum.'";
</script>
<table border=0 width=470 cellpadding=0 cellspacing=3 class=style1>
<tr>
	<td ><strong>������������</strong></td>
	<td width=50><strong>���-��</strong></td>
	<td width=50><strong>��������</strong></td>
	<td width=50 align="right" colspan=""><strong>����</strong></td>
</tr>
<tr>
	<td colspan="4">
	<img src="images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
'.$display_cart.'

<tr>
	<td colspan="4">
	<img src="images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
<tr style="padding-top:10">
   <td ><b>�����:</b></td>
   <td class=style2>
<strong>'.ReturnNum($cart).'</strong> (��.)
	</td>
	<td></td>
   <td class=red align="right">
   '.Chek2($sum).' '.GetValutaOrder().'<br>
</td>
</tr>
<tr>
	<td colspan="4">
	<img src="images/shop/break.gif" alt="" width="100%" height="1" border="0">
	</td>
</tr>
</table>
<table border=0  width=470 cellpadding=0 cellspacing=3 class=style1 align="center">
<tr style="padding-top:0">
   <td colspan="3" valign="top">������:</td>
   <td class=red align="right"><span id="SkiSumma">'.$ChekDiscount[0].'</span>&nbsp;%</td>
</tr>
<tr style="padding-top:0">
   <td colspan="3" valign="top">��� �������:</td>
   <td class=red align="right"><span id="WeightSumma">'.$weight.'</span>'.$we.'</td>
</tr>


<tr>
    <td>
  � ������ � ������ ������ (��� ��������):
	</td>
	<td class=style2>
	</td>
	<td colspan=2 align="right" class=red>
	<b><span id="TotalSumma">'.(ReturnSummaOrder($sum,$ChekDiscount[0])+$GetDeliveryPrice).'</span></b> '.GetValutaOrder().'</td>
</tr>
</table>
<input type="hidden" id="OrderSumma" name="OrderSumma"  value="'.ReturnSummaOrder($sum,$ChekDiscount[0]).'">
';
    }

// ������� ����� ������
    $sql="select uid from ".$SysValue['base']['table_name1']." order by uid desc LIMIT 0, 1";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $last=$row['uid'];
    $all_num=explode("-",$last);
    $ferst_num=$all_num[0];
    if($ferst_num<100) $ferst_num=100;
    $order_num = $ferst_num + 1;
    $order_num=$order_num."-".substr(abs(crc32(uniqid($sid))),0,2);


    $SysValue['other']['orderNum']= $order_num;
    $SysValue['other']['orderWeight']= ReturnNum($cart);
    $SysValue['other']['catalogCat']= "���������� ������";
    $SysValue['other']['catalogCategory']= "������";
    $SysValue['other']['orderContentCart']=@$display;
    $SysValue['other']['orderDate']=date("d-m-y");
    $SysValue['other']['orderDelivery']=GetDelivery(@$_GET['d']);
    $SysValue['other']['orderOplata']=GetOplataMetod();
    $SysValue['other']['deliveryId']= @$_GET['d'];


// ���� ������� ������ ����� ���������� ������
    if($option['cart_minimum'] < $sum) {

// ���������� ������
        $SysValue['other']['orderContent']=ParseTemplateReturn($SysValue['templates']['main_order_forma']);

    }else {

        // ���������� ���������
        $SysValue['other']['orderContent']="<FONT style=\"font-size:12px;color:red\">
<B>".$SysValue['lang']['cart_minimum']." ".$option['cart_minimum']." </B></FONT>
";


    }
    $SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['main_order_list']);


}

else {
    // ���������� ���������
    $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_cart_1']."</B></FONT><BR>".$SysValue['lang']['bad_order_mesage_2']."
<script language=\"JavaScript\">
if(window.document.getElementById('num')){
window.document.getElementById('num').innerHTML='0';
window.document.getElementById('sum').innerHTML='0';
}
</script>
";

    // ���������� ������
    $SysValue['other']['orderMesage']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage']);
// ���������� ���������
    $SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['order_forma_mesage_main']);

}

// ���������� ������ 
@ParseTemplate($SysValue['templates']['index']);
?>
