<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");


// �������� �� ����� ���������
function TestNewMessage($UID){
global $SysValue;
$sql="select id from ".$SysValue['base']['table_name37']." where UID=$UID and enabled='0'";
$result=mysql_query($sql);
$num=mysql_numrows($result);
return $num;
}


function Delivery_Cat($PID=0) {

global $SysValue,$table_name19,$PHP_SELF,$systems,$page,$AdmUsers;
$sql='select * from '.$SysValue['base']['table_name27'].' where enabled="1" order by status';
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$login=$row['login'];
	$name=$row['name'];
	$mail=$row['mail'];
	
	// �������� �� ����� ���������
	$TestNewMessage=TestNewMessage($id);
	
	if($TestNewMessage>0)
	   @$display.="
	d4.add($id,0,'<strong>$login ($TestNewMessage �����.)</strong>','adm_messages_content.php?id=$id');
	"; 
	 else @$display.="
	d4.add($id,0,'$login','adm_messages_content.php?id=$id');
	";

	}


return $display;

} //����� Delivery_Cat



function Vivod_pot()// ����� ���������
{
global $SysValue;
$dis="
<script type=\"text/javascript\">
		<!--
		d4 = new dTree('d4');
		d4.add(0,-1,'<B>".$SysValue['Lang']['Category'][15]."</B>','adm_messages_content.php?id=ALL');
        ".Delivery_Cat()."
		document.write(d4);
		//-->
	</script>";
return $dis;
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../skins/<?=$_SESSION['theme']?>/dtree.css" type=text/css rel=stylesheet>
<SCRIPT language="JavaScript" src="../java/dtree.js" type=text/javascript></SCRIPT>
</head>
<body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="#ffffff">
<div style="padding:10px">
<?echo Vivod_pot();?>
</div>
</body>
</html>

