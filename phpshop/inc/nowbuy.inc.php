<?

function nowbuy() {
global $SysValue;

$i=1; //Стартовый номер
$limitpos=10; //Количество выводимых позиций
$limitorders=100; //Количество запрашиваемых заказов (лучше ввести чуть больше, т.к. дубли и отсутствующие товары отсекуться)

$query='SELECT orders FROM '.$SysValue['base']['table_name1'].' ORDER BY `id` DESC LIMIT 0,'.$limitorders;
$res = mysql_query($query);
$rows=mysql_num_rows($res);

while ($f=mysql_fetch_array($res)) {
	$order=unserialize($f['orders']);
	$cart=$order['Cart']['cart'];
	foreach ($cart as $num => $good) {
		if ($i>$limitpos) break;
		$gid=$good['id'];

		$querygood='SELECT id FROM '.$SysValue['base']['table_name2'].' WHERE id='.$gid;
// AND (enabled="0")
		$resgood = mysql_query($querygood);
		$rowsgood=mysql_num_rows($resgood);


		if ($rowsgood) {
			if (!(isset($arra[$gid])))  {
				@$disp.=$i.'. <A title="'.$good['name'].'" href="shop/UID_'.$gid.'.html">'.$good['name'].'</A><BR>';
				$i++;
				$arra[$gid]=1;
			}
		}
	}
	if ($i>$limitpos) break;
}



return $disp;

}//Конец функции


$SysValue['other']['nowBuy']=nowbuy();
?>