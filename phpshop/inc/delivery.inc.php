<?
// ����� ������� ��������
function GetDelivery($deliveryID){
global $SysValue,$_SESSION;


//� ����������� �� ���� ������ ������� - engine ��� delivery
if (empty($SysValue['nav'])) { 
	$pathTemplate='/'.chr(47).$SysValue['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); // ���� �� �������
} else {
	$pathTemplate='';
}
//� ����������� �� ���� ������ ������� - engine ��� delivery

$table=$SysValue['base']['table_name30'];

if($deliveryID>0){//���� �������� �������������, �� 
	$sql="select * from ".$table." where (enabled='1' and id='".$deliveryID."') order by city";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	$isfolder=$row['is_folder']; //�������� �� ������������� ������
	$PID=$row['PID'];
	$sqlvariants="select * from ".$table." where (enabled='1' and PID='".$row['PID']."') order by city";

	if ($isfolder) { //���� �������� �����, �� �������� ����� ������� �����
		$sqlvariants="select * from ".$table." where (enabled='1' and PID='".$deliveryID."') order by city";
		$PIDpr=$deliveryID; //��������� ������, ��� ����������� 
		$stop=0;
	} else { //���� �������� �������, �� �������� ����� ������
		$sqlvariants="select * from ".$table." where (enabled='1' and PID='".$row['PID']."') order by city";
		$PIDpr=$row['PID']; //��������� ������, ��� ����������� 
		$stop=1;
	}
} else { //���� �� ��������, ������ ��������� ����� ��� �������� ��������
	$stop=0;
	$isfolder=1; //���� �� �������� ID, ������ �������� 0 �������������, ������� �������� ������ ��������
	$PID=false;
	$deliveryID=0; //����������� ������� �������������, ���� ������ �� ��������
	$sqlvariants="select * from ".$table." where (enabled='1' and PID='0') order by city";
}
$resultvariants=mysql_query($sqlvariants);// ��������� ��������
$varamount=mysql_num_rows($resultvariants);

//���� ������ �������������, �� �������� ����� ������� ����������� �� ������� �����. 
/////////////���� ������������ ��������� �� ������ ����
if ($PID!==false) { //���� ���� ������, ��������� ���������
	$pred='';
	$ii=0;
	$num=0;
	while ($PIDpr!=0) {//������ ���� �� ������ �� ������ �������� ������
		$num++;
		//�������� ������� ������
		$sqlpr="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and id='".$PIDpr."') order by city";
		$resultpr=mysql_query($sqlpr);
		$rowpr = mysql_fetch_array($resultpr);

		$PIDpr=$rowpr['PID']; //������ ������������� ������. �� ������� ����
		$city=$rowpr['city'];
		$predok=$rowpr['city'].' > '.$predok; //�������, ������� ����� ���������� ������� ��������

		//�������� ���������� ������� � ������������.
		$sqlprr="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$PIDpr."') order by city";
		$resultprr=mysql_query($sqlprr);
		$ii=0;
		while ($rowsos = mysql_fetch_array($resultprr)) {
			$sqlsosed="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$rowsos['id']."') order by city";
			$resultsosed=mysql_query($sqlsosed);
			$sosed=mysql_num_rows($resultsosed);
			$sosfolder=$rowsos['is_folder'];
			if ($sosfolder) {
				if ($sosed) {$ii++;}
			} else {
				$ii++;
			}
		}

		//���� ((���� ������, �.�. �� ������� ������ ����� ������� ���-�� ������)
		// � (������� �������� ������ �������)), �� ���������� ����������� ������� �� ������� ����
		if (($ii>1) && ($num>0)) { //���������� ������ "�����" ���� ������ 1 ������� ������ � �������� � (���� ���� ������� ���� ������� �������� ������ �������)
			$pred='�������: '.$city.' <A href="javascript:UpdateDelivery('.$PIDpr.')" title="������� ������ ������ ��������"><img src="../'.$pathTemplate.'/images/shop/icon-activate.gif" alt=""  border="0" align="absmiddle">����� �����</A> <BR> '.$pred;
		}
	}
	if (strlen($pred)) {$br='<BR>';} else {$br='';} //���� ���� ���� ����������� ����, �� ���������� �������� ������, 
} //���� ���� ������, ��������� ���������
/////////////���� ������������ ��������� �� ������ ����

/////////////���� ���������� ��������� ��������
$varamount=0;
while($row = mysql_fetch_array($resultvariants)){
     if(!empty($deliveryID)){
       if($row['id'] == $deliveryID) {$chk="selected";} else {$chk="";}
     } else{
       if($row['flag']==1) {$chk="selected";} else {$chk="";}
     }

	//�������� ���������� ������� � ������������.
	$sqlpot="select * from ".$SysValue['base']['table_name30']." where (enabled='1' and PID='".$row['id']."') order by city";
	$resultpot=mysql_query($sqlpot);
	$pot=mysql_num_rows($resultpot);


	$city=$row['city'];
	if ((!$row['is_folder'])||($pot)) {
		@$disp.='<OPTION value='.$row['id'].' '.$chk.'>'.$predok.$city.'</OPTION>';
		$varamount++;
		$curid=	$row['id'];
	}

}
/////////////���� ���������� ��������� ��������


if ($varamount===0) {
	$makechoise='<OPTION value=0>[�������� �� ���������]</OPTION>'; 
	$alldone='<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
	$deliveryID=0;
	$curid=$deliveryID;
//	$waytodo='<IMG onload="UpdateDelivery('.$curid.');" SRC="/'.$pathTemplate.'/images/shop/flag_green.gif">';

}elseif ($varamount>1) {
	$makechoise='<OPTION value="'.$deliveryID.'" id="makeyourchoise">�������� ��������</OPTION>'; 
	$alldone='';
} else {
	$alldone='<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
}


if ($varamount==1) {                                                                          
	if (!(($curid==$deliveryID))) $waytodo='<IMG onload="UpdateDelivery('.$curid.');" SRC="../'.$pathTemplate.'/images/shop/flag_green.gif">';
}
if ($stop) {
	$makechoise='';
	$alldone='<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
}

//��������� ���������� �������� �����, �������� � ����� �� �����
$disp='<DIV id="seldelivery">'.$pred.$br.$my.'
<SELECT onchange="UpdateDelivery(this.value)" name="dostavka_metod" id="dostavka_metod">
'.$makechoise.'
'.$disp.'
</SELECT>'.$alldone.$waytodo.'</DIV>
';


return $disp;
}

?>