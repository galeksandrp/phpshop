<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ ���������� �������� 1�      |
+-------------------------------------+
*/


include("login.php");
include("mailer.php");

function OplataMetod($tip){
if($tip==1) return "���� � ����";
if($tip==2) return "���������";
if($tip==3) return "��������";
}



function ReturnSumma($sum,$disc){
$sum=$sum-($sum*$disc/100);
return $sum;
}


// ������� ������ ������������� ������
function CheckStatusReady(){
global $SysValue;
$sql="select id from ".$SysValue['base']['table_name32']." where id=100 limit 1";
@$result=mysql_query(@$sql);
$num=mysql_numrows($result);

// ������ ������ �������
if($num==0)
mysql_query("INSERT INTO ".$SysValue['base']['table_name32']." VALUES (100, '�������� � �����������', '#ffff33','')");


return 100;
}




switch($command){

      // ������� ������ ���� �������
	  // command=list&date1=123456&date2=24255
      case("list"):


$sql="select * from ".$SysValue['base']['table_name1']." where seller!='1' and datas<'$date2' and datas>'$date1' order by id desc  limit $num";
@$result=mysql_query(@$sql);

while($row = mysql_fetch_array($result)){
@$csv1="������ ������ ������\n";
@$csv2="������ ���������� �������\n";
    $id=$row['id'];
    $datas=$row['datas'];
	$uid=$row['uid'];
	
	if($n != 1) @$fileName=date("m-d-y"); 
	  else @$fileName=$row['uid'];
	
	$order=unserialize($row['orders']);
	$status=unserialize($row['status']);
	$num=$row['num'];
	$mail=$order['Person']['mail'];
	$name=$order['Person']['name_person'];
	$conpany=str_replace("*","\"",$order['Person']['org_name']);
	$inn=$order['Person']['org_inn'];
	$tel=$order['Person']['tel_code']." ".$order['Person']['tel_name'];
	$adres=str_replace("*","\"",$order['Person']['adr_name']);
	$oplata=OplataMetod($order['Person']['order_metod']);
	$sum=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	$discount=$order['Person']['discount'];
	if($discount>0) $discountStr="- ������ $discount%";
	else $discountStr="";
	$csv1.="$id;$uid;$datas;$mail;$name $discountStr;$conpany;$tel;$oplata;$sum;$discount;$inn;\n";

  foreach($order['Cart']['cart'] as $val){
  $id=$val['id'];
  $uid=$val['uid'];
  $num=$val['num'];
  $sum=ReturnSumma($val['price']*$num,$order['Person']['discount']);
  $csv2.="$id;$uid;$num;$sum\n";
  }

  @$csv.=$csv1.$csv2;
  }
  echo $csv;
       break;
	   
	   
	   
	 // ���������� ������� ������
	 // command=update&id=63&cid=12345
	 case("update"):
     $CheckStatusReady=CheckStatusReady();
	 $sql="UPDATE ".$SysValue['base']['table_name1']."
     SET
	 seller='1',
     statusi=$CheckStatusReady 
     where id=".$id;
     @$result=mysql_query(@$sql) or die("error");
     
     // ��������� ������ � ����
     $date=date("U");
     mysql_query("INSERT INTO ".$SysValue['base']['table_name9']." VALUES ('', $id, '$cid',$date,'')");
     
	 // ���� ��������� ������������
	 SendMailUser($id);
	 break;

      
     // ���-�� ����� �������
	 // command=new&date1=123456&date2=24255
	 case("new"):
     $sql="select id from ".$SysValue['base']['table_name1']." where seller!='1' and datas<'$date2' and datas>'$date1'";
     @$result=mysql_query(@$sql);
     $new_order=mysql_numrows($result);
     echo $new_order;
	 break;
	 
	 // �������� ��� ����-������
	 // command=check&date1=123456&date2=24255
	 case("check"):
	 $sql="select * from ".$SysValue['base']['table_name9']." where datas<'$date2' and datas>'$date1'";
     @$result=mysql_query(@$sql);
     while($row = mysql_fetch_array($result)){
	 $cid=$row['cid'];
	 @$csv.="$cid;";
	 }
	 echo $csv;
	 break;

     // ���������� ���� ��� ����-������
	 // command=update_f&cid=1234&date=123456
	 case("update_f"):
     $sql="UPDATE ".$SysValue['base']['table_name9']." 
     SET
	 datas_f=$date 
     where cid='$cid'";
     @$result=mysql_query(@$sql) or die("error");
	 // ���� ��������� ������������
	 SendMailUser($id,"invoice");
	 break;

     // �������� �������� ����-������
	 // command=check_f&cid=123
	 case("check_f"):
	 $sql="select datas_f from ".$SysValue['base']['table_name9']." where cid='$cid' limit 1";
     @$result=mysql_query(@$sql);
     $row = mysql_fetch_array($result);
	 $datas_f=$row['datas_f'];
	 echo $datas_f;
	 break;




}
?>
