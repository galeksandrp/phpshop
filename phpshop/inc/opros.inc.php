<?

function Update_opros_base($valueID,$flag){// ������ ������
global $SysValue;
$valueID=TotalClean($valueID,1);

// ����� �����
if(@$flag==1){
$sql="select total from ".$SysValue['base']['table_name5']." where id=$valueID";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$total=$row['total']+1;
$sql="UPDATE ".$SysValue['base']['table_name5']."
SET
total = '$total'
where id='$valueID'";
$result=mysql_query($sql)or @die("".mysql_error()."");

// ���������� ���������
$SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_opros_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_opros_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
}
// ������ �����
else{
// ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_opros_mesage_1']."</B></FONT><BR>".$SysValue['lang']['bad_opros_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
	   
}
return $dis;
}

function Vivod_opros_result(){// ����� ����������� ������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name6']." where flag='1'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
// ���������� ���������
$SysValue['other']['oprosName']= $row['name'];
$SysValue['other']['oprosContent']= Vivod_opros_value($row['id'],"RESULT");

// ���������� ������
@$dis.=ParseTemplateReturn($SysValue['templates']['opros_page_list']);
}
return @$dis;
}

function Vivod_opros()// ����� ������
{
global $SysValue,$REQUEST_URI;
$sql="select * from ".$SysValue['base']['table_name6']." where flag='1'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
if(empty($row['dir'])){
// ���������� ���������
$SysValue['other']['oprosName']= $row['name'];
$SysValue['other']['oprosContent']= Vivod_opros_value($row['id'],"FORMA");
// ���������� ������
@$dis.=ParseTemplateReturn($SysValue['templates']['opros_list']);
}
else{
$dirs= explode(",",$row['dir']);
if(is_array($dirs))
foreach($dirs as $dir)
if(@strpos($REQUEST_URI, $dir) or $REQUEST_URI==$dir){
$SysValue['other']['oprosName']= $row['name'];
$SysValue['other']['oprosContent']= Vivod_opros_value($row['id'],"FORMA");
// ���������� ������
@$dis.=ParseTemplateReturn($SysValue['templates']['opros_list']);
}}

}
return @$dis;
}

function Get_sum_value($n){// �����
global $SysValue;
$sql="select SUM(total) as sum from ".$SysValue['base']['table_name5']." where category=$n";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
@$SysValue['sql']['num']++;
return $row['sum'];
}

function Vivod_opros_value($n,$flag){// ����� �������
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name5']." where category=$n order by num";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result)){

    $id=$row['id'];
	$name=$row['name'];
	if($row['total'] > 0) $total=$row['total'];
	 else $total="--";
	$category=$row['category'];
	
	// ���������� ���������
    $SysValue['other']['valueName']= $name;
    $SysValue['other']['valueId']= $id;
	
	// ���������� ������
	if($flag=="FORMA")
    @$dis.=ParseTemplateReturn($SysValue['templates']['opros_forma']);
	elseif($flag=="RESULT"){
	$sum=Get_sum_value($category);
	$pr=@number_format(($total*100)/$sum,"1",".","");
	
	// ���������� ���������
	$SysValue['other']['valueSum']= $total;
    $SysValue['other']['valueProc']= $pr;
	$SysValue['other']['valueWidth']= $pr*3+1;
	
	@$dis.=ParseTemplateReturn($SysValue['templates']['opros_page_forma']);
	}
}
@$SysValue['sql']['num']++;
return @$dis;
}

?>