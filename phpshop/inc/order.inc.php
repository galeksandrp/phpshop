<?
/*
+-------------------------------------+
|  PHP SHOP 2.1  Enterprise           |
|  ���� ������ ������                 |
+-------------------------------------+
*/

function GetValutaValue($n){
global $SysValue;
$sql="select $n from ".$SysValue['base']['table_name3'];
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row[$n];
}

function GetIsoValutaOrder(){
global $SysValue;
$sql="select code from ".$SysValue['base']['table_name24']." where 
id=".GetValutaValue("kurs");
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row['code'];
}

function ReturnSummaBeznal($sum,$disc){// �������� �� ����� ������
$kurs=GetKursOrderBeznal();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

function ReturnSummaNal($sum,$disc){ // �������� �� ����� ���������
global $LoadItems;
$formatPrice = unserialize($LoadItems['System']['admoption']);
$format=$formatPrice['price_znak'];

$kurs=GetKursOrderNal();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,$format,".","");
}


function ReturnSumma($sum,$disc){ // �������� �� �����
$kurs=GetKursOrder();
$sum*=$kurs;
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

function ReturnSummaOrder($sum,$disc){ // �������� �� �����
$sum=$sum-($sum*$disc/100);
return number_format($sum,"2",".","");
}

function GetUsersDiscount($n){
global $SysValue;
$sql="select discount from ".$SysValue['base']['table_name28']." where id='$n'";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
return $row['discount'];
}


function ChekDiscount($mysum)// ����� ������
{
global $SysValue,$_SESSION;
$maxsum=0;
$sql="select * from ".$SysValue['base']['table_name23']." where sum < '$mysum' and enabled='1'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){
     $sum=$row['sum'];
     if($sum>$maxsum){
	  $maxsum=$sum;
	  $maxdiscount=$row['discount'];
	  }
}
$userdiscount=GetUsersDiscount(@$_SESSION['UsersStatus']);
if($userdiscount>@$maxdiscount) @$maxdiscount=$userdiscount;
$sum=$mysum-($mysum*@$maxdiscount/100);
$array=array(0+@$maxdiscount,number_format($sum,"2",".",""));
return $array;
}

function GetPriceOrder($price,$format=2){ // ���� � ������ ������ ��������
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
$price*=$LoadItems['Valuta'][$valuta]['kurs'];
return number_format($price,$format,".","");
}

function GetPriceSort($price,$format=2){ // ���� � ������ ������ ��������
global $LoadItems,$_SESSION;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];
  
$price/=$LoadItems['Valuta'][$valuta]['kurs'];
return number_format($price,$format,".","");
}

function GetValutaOrder(){ // ������ ��������
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['code'];
}

function GetValutaIsoOrder(){ // ������ ��������
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['iso'];
}

function GetKursOrderBeznal(){ // ����
global $LoadItems;
$valuta=$LoadItems['System']['kurs_beznal'];
return  $LoadItems['Valuta'][$valuta]['kurs'];
}

function GetKursOrderNal(){ // ����
global $LoadItems;
$valuta=$LoadItems['System']['kurs'];
return  $LoadItems['Valuta'][$valuta]['kurs'];
}

function GetKursOrder(){ // ����
global $LoadItems;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];
  
return  $LoadItems['Valuta'][$valuta]['kurs'];
}



function GetPriceValuta($price,$formats=0,$baseinputvaluta=""){ // ���� � ������ ������
global $SysValue,$LoadItems,$_SESSION;
$formatPrice = unserialize($LoadItems['System']['admoption']);

$format=$formatPrice['price_znak'];

//�������� �������� ����
if ($baseinputvaluta) { //���� �������� ���. ������
	if ($baseinputvaluta!==$LoadItems['System']['dengi']) {//���� ���������� ������ ���������� �� �������
		$price=$price/$LoadItems['Valuta'][$baseinputvaluta]['kurs']; //�������� ���� � ������� ������
	}
} //���� �������� ���. ������
//�������� �������� ����

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];

$price=$price*$LoadItems['Valuta'][$valuta]['kurs'];
return number_format($price,$format,'.', ' ');
}

function GetValuta(){ // ������
global $LoadItems,$_SESSION;

if(isset($_SESSION['valuta'])) $valuta=$_SESSION['valuta'];
  else $valuta=$LoadItems['System']['dengi'];

return  $LoadItems['Valuta'][$valuta]['code'];
}


// ����� ������������ ������� ��� ���������� ������
class OrderWrite {
      var $MAS;
	  var $NUM;
	  
	  function OrderCart($cart,$LoadItems,$SysValue,$Delivery){
	  @$cid=array_keys(@$cart);
      for ($i=0,$n=1; $i<count($cid); $i++,$n++){
      $j=$cid[$i];
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
	  
	  $array=array(
	  "cart"=>$cart,
	  "num"=>@$num,
	  "sum"=>$sum,
	  "weight"=>@$weight,
	  "dostavka"=>$Delivery);
	  
	  $this->NUM = @$num;
	  
	  return $array;
	  }
	  
	  function CleanStr($str){
	  $str=str_replace("/","|",$str);
	  $str=str_replace("\\","|",$str);
	  $str=str_replace("\"","*",$str);
	  $str=str_replace("'","*",$str);
	  return htmlspecialchars(stripslashes($str));
	  }
	  
	  function OrderMas($VAR,$Discount,$UserId){
	  $array=array(
	  "ouid"=>$VAR['ouid'],
	  "data"=>date("U"),
	  "time"=>date("H:s a"),
	  "mail"=>$VAR['mail'],
	  "name_person"=>$this->CleanStr($VAR['name_person']),
      "org_name"=>$this->CleanStr($VAR['org_name']),
	  "org_inn"=>$this->CleanStr($VAR['org_inn']),
	  "org_kpp"=>$this->CleanStr($VAR['org_kpp']),
	  "tel_code"=>$this->CleanStr($VAR['tel_code']),
	  "tel_name"=>$this->CleanStr($VAR['tel_name']),
	  "adr_name"=>$this->CleanStr($VAR['adr_name']),
	  "dostavka_metod"=>$VAR['dostavka_metod'],
	  "discount"=>$Discount,
	  "user_id"=>$UserId,
	  "dos_ot"=>$this->CleanStr($VAR['dos_ot']),
	  "dos_do"=>$this->CleanStr($VAR['dos_do']),
	  "order_metod"=>$VAR['order_metod']);
	  return $array;
	  }
	  
	  function OrderWrite($CART,$VAR,$LoadItems,$SysValue,$Discount,$UserId,$Delivery){
	  $array=array(
	  "Cart"=>$this->OrderCart($CART,$LoadItems,$SysValue,$Delivery),
	  "Person"=>$this->OrderMas($VAR,$Discount,$UserId)
	  );
	  $this->MAS =  serialize($array);
	  }
	  
}

//$iw=new inwords; 
//$i=123456.78; 
//$s=$iw->get($i); 
//print($s);

class inwords { //����� ����������� �������� ������������� ����� � ���������

var $diw=Array(    0 =>    Array(    0  => Array( 0=> "����",    1=>1), 
                1  => Array( 0=> "",        1=>2), 
                2  => Array( 0=> "",        1=>3), 
                3  => Array( 0=> "���",        1=>0), 
                4  => Array( 0=> "������",    1=>0), 
                5  => Array( 0=> "����",    1=>1), 
                6  => Array( 0=> "�����",    1=>1), 
                7  => Array( 0=> "����",    1=>1), 
                8  => Array( 0=> "������",    1=>1), 
                9  => Array( 0=> "������",    1=>1), 
                10 => Array( 0=> "������",    1=>1), 
                11 => Array( 0=> "����������",    1=>1), 
                12 => Array( 0=> "����������",    1=>1), 
                13 => Array( 0=> "����������",    1=>1), 
                14 => Array( 0=> "������������",1=>1), 
                15 => Array( 0=> "����������",    1=>1), 
                16 => Array( 0=> "�����������",    1=>1), 
                17 => Array( 0=> "����������",    1=>1), 
                18 => Array( 0=> "������������",1=>1), 
                19 => Array( 0=> "������������",1=>1) 
            ), 
        1 =>    Array(    2  => Array( 0=> "��������",    1=>1), 
                3  => Array( 0=> "��������",    1=>1), 
                4  => Array( 0=> "�����",    1=>1), 
                5  => Array( 0=> "���������",    1=>1), 
                6  => Array( 0=> "����������",    1=>1), 
                7  => Array( 0=> "���������",    1=>1), 
                8  => Array( 0=> "�����������",    1=>1), 
                9  => Array( 0=> "���������",    1=>1)  
            ), 
        2 =>    Array(    1  => Array( 0=> "���",        1=>1), 
                2  => Array( 0=> "������",    1=>1), 
                3  => Array( 0=> "������",    1=>1), 
                4  => Array( 0=> "���������",    1=>1), 
                5  => Array( 0=> "�������",    1=>1), 
                6  => Array( 0=> "��������",    1=>1), 
                7  => Array( 0=> "�������",    1=>1), 
                8  => Array( 0=> "���������",    1=>1), 
                9  => Array( 0=> "���������",    1=>1) 
            ) 
); 

var $nom=Array(    0 => Array(0=>"�������",  1=>"������",    2=>"���� �������", 3=>"��� �������"), 
        1 => Array(0=>"�����",    1=>"������",    2=>"���� �����",   3=>"��� �����"), 
        2 => Array(0=>"������",   1=>"�����",     2=>"���� ������",  3=>"��� ������"), 
        3 => Array(0=>"��������", 1=>"���������", 2=>"���� �������", 3=>"��� ��������"), 
        4 => Array(0=>"���������",1=>"����������",2=>"���� ��������",3=>"��� ���������"), 
/* :))) */ 
        5 => Array(0=>"���������",1=>"����������",2=>"���� ��������",3=>"��� ���������") 
); 

var $out_rub; 

function get($summ){ 
 if($summ>=1) $this->out_rub=0; 
 else $this->out_rub=1; 
 $summ_rub= doubleval(sprintf("%0.0f",$summ)); 
 if(($summ_rub-$summ)>0) $summ_rub--; 
 $summ_kop= doubleval(sprintf("%0.2f",$summ-$summ_rub))*100; 
 $kop=$this->get_string($summ_kop,0); 
 $retval=""; 
 for($i=1;$i<6&&$summ_rub>=1;$i++): 
  $summ_tmp=$summ_rub/1000; 
  $summ_part=doubleval(sprintf("%0.3f",$summ_tmp-intval($summ_tmp)))*1000; 
  $summ_rub= doubleval(sprintf("%0.0f",$summ_tmp)); 
  if(($summ_rub-$summ_tmp)>0) $summ_rub--; 
  $retval=$this->get_string($summ_part,$i)." ".$retval; 
 endfor; 
 if(($this->out_rub)==0) $retval.=" ������"; 
 return $retval." ".$kop; 
} 

function get_string($summ,$nominal){ 
 $retval=""; 
 $nom=-1; 
 $summ=round($summ); 
 if(($nominal==0&&$summ<100)||($nominal>0&&$nominal<6&&$summ<1000)): 
  $s2=intval($summ/100); 
  if($s2>0): 
   $retval.=" ".$this->diw[2][$s2][0]; 
   $nom=$this->diw[2][$s2][1]; 
  endif; 
  $sx=doubleval(sprintf("%0.0f",$summ-$s2*100)); 
  if(($sx-($summ-$s2*100))>0) $sx--; 
  if(($sx<20&&$sx>0)||($sx==0&&$nominal==0)): 
   $retval.=" ".$this->diw[0][$sx][0]; 
   $nom=$this->diw[0][$sx][1]; 
  else: 
   $s1=doubleval(sprintf("%0.0f",$sx/10)); 
   if(($s1-$sx/10)>0)$s1--; 
   $s0=doubleval($summ-$s2*100-$s1*10); 
   if($s1>0): 
    $retval.=" ".$this->diw[1][$s1][0]; 
    $nom=$this->diw[1][$s1][1]; 
   endif; 
   if($s0>0): 
    $retval.=" ".$this->diw[0][$s0][0]; 
    $nom=$this->diw[0][$s0][1]; 
   endif; 
  endif; 
 endif; 
 if($nom>=0): 
  $retval.=" ".$this->nom[$nominal][$nom]; 
  if($nominal==1) $this->out_rub=1; 
 endif; 
 return trim($retval); 
} 

} 

?>
