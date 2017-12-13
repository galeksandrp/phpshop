<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("Невозможно подсоединиться к базе");
mysql_select_db("$dbase")or @die("Невозможно подсоединиться к базе");
require("../enter_to_admin.php");

// Языки
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");

function TestCat($n)// есть ли еще подкаталоги
{
global $SysValue;
$sql="select id from ".$SysValue['base']['table_name29']." where parent_to=$n";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return $num;
}


function Vivod_rekurs($n)// вывод подкаталогов рекурсом
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name29']." where parent_to='$n' order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$id=$row['id'];
$name=$row['name'];
$i=0;
$parent_to=$row['parent_to'];
$num=TestCat($id);

if($i<$num)// если есть еще каталоги
  {
   @$disp.="d4.add($id,$n,'$name','javascript:AdmCat($id,500,370);');
   ".Vivod_rekurs($id)."
";

  }
else// если нет каталогов
   {
   @$disp.="d4.add($id,$n,'$name (".Vivod_cat_all_num($id).")','admin_cat_content.php?pid=$id');";
   }

}
return @$disp;
}

function Delivery_Cat($PID=0) {
global $SysValue;

$sql='select * from '.$SysValue['base']['table_name30'].' where ((PID='.$PID.') AND (is_folder=1)) order by city';
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$PID=$row['PID'];
	$city='<FONT TITLE="Название доставки">'.$row['city'].'</FONT>';
	$enabled=$row['enabled'];
	$free_en=$row['price_null_enabled'];
	$free=$row['price_null'];
	$taxa=$row['taxa'];
	$price=$row['price'];
	if(($enabled)=="1"){$checked="";}else{$checked='<B style="color:ff0000;" TITLE="ДОСТАВКА ОТКЛЮЧЕНА!">[ОТКЛ!]</B>';};

	$sqlnums='select * from '.$SysValue['base']['table_name30'].' where PID='.$id.' order by city';
	$resultnums=mysql_query($sqlnums);
	@$nums=mysql_num_rows(@$resultnums);

	if ($nums) {$nums='<B TITLE="В этой папке есть '.$nums.' элемента">['.$nums.']</B';} else {$nums='';}
	if ($free_en) {$free='<FONT style="color:0000ff;" TITLE="Включена бесплатная доставка при сумме выше '.$free.'">[БД>'.$free.']</FONT>';} else {$free='';}
	if ($taxa) {$taxa='<FONT style="color:ff0000;" TITLE="Включена тарификация каждых доп. 0.5 кг">[Т='.$taxa.']</FONT>';} else {$taxa='';}
	if ($price && (!$nums)) {$price='<FONT TITLE="ЦЕНА доставки">&ndash; '.$price.'</FONT>';} else {$price='';}

	 @$display.="
	d4.add($id,$PID,'$checked $city $nums $price $free $taxa','admin_delivery_content.php?id=$id');
	".Delivery_Cat($id);
	}

return $display;

} //Конец Delivery_Cat



function Vivod_pot()// вывод каталогов
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name29']." where parent_to=0 order by num";
$result=mysql_query($sql);
$i=0;
$j=0;
while($row = mysql_fetch_array($result)) {
	$id=$row['id'];
	$name=$row['name'];
	if(TestCat($id)>0) {
		 @$dis.="
		d4.add($id,0,'$name','javascript:miniWin(\'./adm_catalogID.php?catalogID=$id\',500,320);');
		".Vivod_rekurs($id)."
		";
	} else {
		@$dis.="
		d4.add($id,0,'$name (".Vivod_cat_all_num($id).")','admin_cat_content.php?pid=$id');
		".Vivod_rekurs($id)."
		";
	}	
	$i++;
}

$dis="
<script type=\"text/javascript\">
		<!--
		d4 = new dTree('d4');
		d4.add(0,-1,'<b>Каталог доставок</b>');
        ".Delivery_Cat()."
		document.write(d4);
		//-->
	</script>
";
return $dis;
}

function Vivod_cat_all_num($n)// выбор кол-ва товаров из данного подкатолога
{
global $SysValue;
$sql="select id from ".$SysValue['base']['table_name11']." where category='$n'";
$result=mysql_query($sql);
@$num=mysql_num_rows(@$result);
if(empty($num)) $num=0;
return $num;
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/dtree.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="../java/dtree.js" type=text/javascript></SCRIPT>
</head>
<body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="#ffffff">
<div style="padding:10px">
<?echo Vivod_pot();?>
</div>
</body>
</html>

