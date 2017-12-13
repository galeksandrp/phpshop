<?
/*
+-------------------------------------+
|  ���: PHPShopString                 |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: �������� �� ��������   |
|  ������: 1.0                        |
|  ���: class                         |
|  �����������: ���                   |
|  �����: Function                    |
+-------------------------------------+
*/

class PHPShopString {


      // ��������� Win 1251 - UTF8
      function win_utf8 ($in_text){ 
      $output=""; 
      $other[1025]="�"; 
      $other[1105]="�"; 
      $other[1028]="�"; 
      $other[1108]="�"; 
      $other[1030]="I"; 
      $other[1110]="i"; 
      $other[1031]="�"; 
      $other[1111]="�"; 

      for ($i=0; $i<strlen($in_text); $i++){ 
      if (ord($in_text{$i})>191){ 
         $output.="&#".(ord($in_text{$i})+848).";"; 
      } else { 
           if (array_search($in_text{$i}, $other)===false){ 
             $output.=$in_text{$i}; 
           } else { 
               $output.="&#".array_search($in_text{$i}, $other).";"; 
                  } 
        } } 
      return $output; 
      } 

      // ������� � ��������
      function StrToLatin($str){
      $str=strtolower($str);
      $str=str_replace("/", "", $str);
      $str=str_replace("\\", "", $str);
      $str=str_replace("(", "", $str);
      $str=str_replace(")", "", $str);
      $str=str_replace(":", "", $str);
      $str=str_replace("-", "", $str);
      $str=str_replace(" ", "", $str);

$_Array=array("�"=>"a","�"=>"b","�"=>"v","�"=>"g","�"=>"d","�"=>"e","�"=>"e","�"=>"gh","�"=>"z","�"=>"i","�"=>"i","�"=>"k","�"=>"l","�"=>"m","�"=>"n","�"=>"o","�"=>"p","�"=>"r","�"=>"s","�"=>"t","�"=>"u","�"=>"f","�"=>"h","�"=>"c","�"=>"ch","�"=>"sh","�"=>"sh","�"=>"i","�"=>"yi","�"=>"i","�"=>"a","�"=>"u","�"=>"ya","�"=>"a","�"=>"b","�"=>"v","�"=>"g","�"=>"d","�"=>"e","�"=>"gh","�"=>"z","�"=>"i","�"=>"i","�"=>"k","�"=>"l","�"=>"m","�"=>"n","�"=>"o","�"=>"�","�"=>"r","�"=>"s","�"=>"t","�"=>"u","�"=>"f","�"=>"h","�"=>"c","�"=>"ch","�"=>"sh","�"=>"sh","�"=>"a","�"=>"u","�"=>"ya","."=>"_","$"=>"i","%"=>"i","&"=>"and");

      $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

      foreach($chars as $val)
            if(empty($_Array[$val])) @$new_str.=$val;

      return @$new_str;
      }
	  
	  // �������� �� �����
      function Substr($str,$a,$dot=false){
	  $T="";
      if(empty($str)) return $str;
      $str = htmlspecialchars(strip_tags($str));
      for ($i = 1; $i <= $a; $i++) {
	     if(!empty($str{$i}))
	     if($str{$i} == ".") $T=$i;
      }
      if($T<1) {
	         if($dot) return substr($str, 0, $a)."...";
			   else return substr($str, 0, $a);
	         }
        else return substr($str, 0, $T+1);
      }

}


?>
