<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");


function ReturnSumma($sum,$disc){
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}


// ����� GZIP �����
function gzcompressfile($source,$level=false){ 
   $dest=$source.'.gz'; 
   $mode='wb'.$level; 
   $error=false; 
   if($fp_out=gzopen($dest,$mode)){ 
       if($fp_in=fopen($source,'rb')){ 
           while(!feof($fp_in)) 
               gzwrite($fp_out,fread($fp_in,1024*512)); 
           fclose($fp_in); 
           } 
         else $error=true; 
       gzclose($fp_out); 
	   unlink($source);
	   rename($dest, $source.'.bz2');
       } 
     else $error=true; 
   if($error) return false; 
     else return $dest; 
   } 

// ������ ����
function CleanOut($str){
$str = preg_replace('([\r\n\rn\t])', '', $str);
$str = @html_entity_decode($str);
return $str;
}

//��������� ����� ������������� � �� ����������
function getChars($allCharsArray,$categoryID) {
	global $SysValue;
	$sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$allCharsID=unserialize($row['sort']); //�������� ��� �������������� ��������

	foreach($allCharsID as $charID) {
		$sql2='select name from '.$SysValue['base']['table_name20'].' WHERE id='.$charID; //�������� �������� ���-�
		$result2=mysql_query($sql2);
		$row2 = mysql_fetch_array($result2);
		@$res.=CleanOut($row2['name']).';'; //��������� ���. ����� �������������
		$valuesArray=$allCharsArray[$charID]; //������ id �������� �������������
		$splitter=''; //��� ������ ������ ����������� - ����
		foreach ($valuesArray as $valueID) {
			$sql3='select name from '.$SysValue['base']['table_name21'].' WHERE id='.$valueID; //�������� �������� ��������
			$result3=mysql_query($sql3);
			$row3 = mysql_fetch_array($result3);
			@$res.=$splitter.CleanOut($row3['name']); //��������� ���. ����� �������������
			$splitter=' && '; //��� ���� ��������� �������� ������������� �����������
		}
		@$res.=';'; //������� ������ ����� ����� ��������
	}
	return $res;
}   

//��������� ���������� ������������� ��� ��������
function getCharsAmount($categoryID) {
	global $SysValue;
	$sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$allCharsID=unserialize($row['sort']); //�������� ��� �������������� ��������
	return count($allCharsID);
}

if(CheckedRules($UserStatus["csv"],1) == 1){

switch($DO){

    case("base"):// �������� ���� ����
$sql='select * from '.$SysValue['base']['table_name2'];
$result=mysql_query($sql);
$num=0;
$amo=0;
while($row = mysql_fetch_array($result)) {
    $id=$row['id'];
    $name=str_replace(";","|",trim($row['name']));
	$category=$row['category'];
	$content= CleanOut($row['content']);
	$description=CleanOut($row['description']);
	$price=$row['price'];
	$price2=trim($row['price2']);
	$price3=trim($row['price3']);
	$price4=trim($row['price4']);
	$price5=trim($row['price5']);
	$uid=trim($row['uid']);
	$enabled=$row['enabled'];
	$pic_small=$row['pic_small'];
	$pic_big=$row['pic_big'];
//	$vendor_array=$row['vendor_array'];
//print_r(unserialize($row['vendor_array']));
	$vendor_array=base64_encode($row['vendor_array']);
	$vendorArray=unserialize($row['vendor_array']);
	$num=$row['num'];
	$items=trim($row['items']);
	$weight=trim($row['weight']);
	@$csv.="$id;$name;$description;$pic_small;$content;$pic_big;$items;$price;$price2;$price3;$price4;$price5;$weight;$uid;$category";
	@$csv.=';'.getChars($vendorArray,$category);
	@$csv.="\n"; //����� ������

	$newamo=getCharsAmount($category);
	if ($newamo>$amo) {$amo=$newamo;}
}

for ($i=0; $i<$amo; $i++) { //������� � ��������� ����� ��� 
	@$charsFiller.=';��������������;��������';
}

$csv="��� ID;������������;������� ��������;��������� ��������;��������� ��������;������� ��������;�����;����1;����2;����3;����4;����5;���;�������;�a������� ID$charsFiller\n".$csv;

  $file="base_".date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  $sorce="../csv/".$file;
  }
//sleep(1);
//exit("../csv/".$file);
gzcompressfile($sorce);
header("Location: ../csv/".$file.".bz2");
//header("Location: ../csv/".$file."");
	break;

    case("stats1"):// �������� ����������
	$sql="select * from $table_name1 where datas<'$pole2' and datas>'$pole1' order by id desc";
$result=mysql_query($sql);
$num=0;
$csv="����;���-��;����� ".GetIsoValutaOrder()."\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $datas=dataV($row['datas']);
	$order=unserialize($row['orders']);
	$csv.="$datas;".$order['Cart']['num'].";".ReturnSumma($order['Cart']['sum'],$order['Person']['discount'])."\n";
	@$sum+=ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
	@$num+=$order['Cart']['num'];
	}
	$csv.="�����:;$num;$sum\n";
  $file=date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  }
//sleep(10);
header("Location: ../csv/".$file);

	break;

	// �������� ������
    default:
if($IDS=="all") $string="or id>'0'";
else{
$IdsArray=split(",",$IDS);
foreach ($IdsArray as $v) 
   @$string.="or id='$v' ";
   }
$sql="select * from $table_name2 where id='0' $string";
$result=mysql_query($sql);
$num=0;
$csv="��� ������;�������;������������;����1;����2;����3;����4;����5;�������;���������������;�����;���;����������\n";
while($row = mysql_fetch_array($result))
    {
    $id=$row['id'];
    $name=str_replace("|",";",trim($row['name']));
	$price=trim($row['price']);
	$price2=trim($row['price2']);
	$price3=trim($row['price3']);
	$price4=trim($row['price4']);
	$price5=trim($row['price5']);
	$uid=trim($row['uid']);
	$spec=trim($row['spec']);
	$items=trim($row['items']);
	$newtip=trim($row['newtip']);
	$num=trim($row['num']);
	$weight=trim($row['weight']);
$csv.="$id;$uid;$name;$price;$price2;$price3;$price4;$price5;$newtip;$spec;$items;$weight;$num\n";
	}
  $file=date("d_m_y_His").".csv";
  @$fp = fopen("../csv/".$file, "w+");
  if ($fp) {
  //stream_set_write_buffer($fp, 0);
  fputs($fp, $csv);
  fclose($fp);
  }
sleep(1);
//exit("../csv/".$file);
header("Location: ../csv/".$file);
}
}else $UserChek->BadUserFormaWindow();

?>