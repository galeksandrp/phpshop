<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ������ ��������� �������           |
+-------------------------------------+
*/


function nowbuy() {
global $SysValue;

$i=1; //��������� �����
$limitpos=10; //���������� ��������� �������
$limitorders=100; //���������� ������������� ������� (����� ������ ���� ������, �.�. ����� � ������������� ������ ����������)

$query='SELECT orders FROM '.$SysValue['base']['table_name1'].' ORDER BY id DESC LIMIT 0,'.$limitorders;
@$res = mysql_query(@$query);
@$rows=mysql_num_rows(@$res);
@$SysValue['sql']['num']++;
$disp='';

while ($f=mysql_fetch_array($res)) {
	$order=unserialize($f['orders']);
	$cart=$order['Cart']['cart'];
	if(is_array($cart))
	foreach ($cart as $num => $good) {
		if ($i>$limitpos) break;
		$gid=$good['id'];

		$querygood='SELECT id FROM '.$SysValue['base']['table_name2'].' WHERE id='.$gid;
        @$SysValue['sql']['num']++;
		@$resgood = mysql_query(@$querygood);
		@$rowsgood=mysql_num_rows(@$resgood);


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

}//����� �������


if($SysValue['nav']['truepath'] == "/") $SysValue['other']['nowBuy']=nowbuy();
?>