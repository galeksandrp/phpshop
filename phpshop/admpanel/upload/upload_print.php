<?php
$str = iconv('UTF-8', 'windows-1251',$_GET['value']);
echo $str."<br><br><a href=\"javascript:window.print();\">�����������!!!</a><br>";
//echo 111;
?>