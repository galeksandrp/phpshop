<?

class PHPShopDate {

     function dataV($nowtime){
     $Months = array("01"=>"������","02"=>"�������","03"=>"�����", 
     "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
     "08"=>"�������","09"=>"��������",  "10"=>"�������",
     "11"=>"������","12"=>"�������");
     $curDateM = date("m",$nowtime); 
     $t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime)." ".date("H:s ",$nowtime); 
     return $t;
     }
     
	 function GetUnicTime($data){
     $array=explode("-",$data);
     return @mktime(12, 0, 0, $array[1], $array[0], $array[2]);
     }
	 
}


?>
