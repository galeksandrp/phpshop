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


// ����� ����� ������ �� ������� �������
function HitTradeMain(){
global $SysValue,$LoadItems;

$admoption=unserialize($LoadItems['System']['admoption']);

$Disp = new DispSpec();

$limitpos=10; //���������� ��������� �������
$limitorders=100; //���������� ������������� ������� (����� ������ ���� ������, �.�. ����� � ������������� ������ ����������)


// �������� ������ �� �������
$query='SELECT orders FROM '.$SysValue['base']['table_name1'].' ORDER BY id DESC LIMIT 0,'.$limitorders;
@$res = mysql_query(@$query);
@$rows=mysql_num_rows(@$res);
@$SysValue['sql']['num']++;
$disp='';
$sort='';
while ($f=mysql_fetch_array($res)) {
	$order=unserialize($f['orders']);
	$cart=$order['Cart']['cart'];
	if(is_array($cart))
	foreach ($cart as $num => $good) {
		if ($i>$limitpos) break;
		$sort.=" or id=".$good['id']."";
	}
}

$Disp->sql="select * from ".$SysValue['base']['table_name2']." where newtip='1' and  enabled='1' ".@$sort." order by  RAND() LIMIT 0, ".$LoadItems['System']['spec_num'];
$Disp->setka_num=$LoadItems['System']['num_vitrina'];
$Disp->setka_style="setka";
$Disp->template=$SysValue['templates']['main_product_forma_'.$Disp->setka_num];

$Disp->Engen();
$Return=$Disp->disp;
return $Return;
}



// ���������� ����� ������� ��������
if($SysValue['nav']['truepath'] == "/") $SysValue['other']['nowBuy']=nowbuy();

// ������� ����� ������� � ���������
//if($SysValue['nav']['truepath'] == "/")  $SysValue['other']['nowBuy']=HitTradeMain();
?>