<?
@extract($_SESSION);
@extract($_REQUEST);
session_start();

// ���������� ���������� ���������.
require_once "./lib/Subsys/JsHttpRequest/Php.php";
// ������� ������� ������ ����������.
// ��������� ��������� �������� (�����������!).
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// ��������� ������������ ����
$SysValue=parse_ini_file("./inc/config.ini",1);
  while(list($section,$array)=each($SysValue))
                while(list($key,$value)=each($array))
$SysValue['other'][chr(73).chr(110).chr(105).ucfirst(strtolower($section)).ucfirst(strtolower($key))]=$value;

// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
@mysql_query("SET NAMES cp1251");

//���������� �������
function CleanStr($str){
	  $str=str_replace("/","",$str);
	  $str=str_replace("\"","",$str);
	  $str=str_replace("'","",$str);
	  return $str;
}
$idc = $_REQUEST['idc'];
$idgood = $_REQUEST['idgood'];
$rate = $_REQUEST['rate'];
$enabled = $_REQUEST['enabled'];

$idc = CleanStr($idc); //������� ���������� �� �����
$idgood = CleanStr($idgood) ;//������� ���������� �� �����
$rate = CleanStr($rate) ;//������� ���������� �� �����
$enabled = CleanStr($enabled) ;//������� ���������� �� �����
$id_user=$_SESSION['UsersId'];
$userip=$_SERVER['REMOTE_ADDR'];


if ($id_user) {
	$result=1;	
	$sql='select id_vote from '.$SysValue['base']['table_name52'].' where ((id_charact='.$idc.') AND (id_good='.$idgood.') AND (id_user='.$id_user.'))';
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	@$chars_amount=mysql_num_rows($result);

	if ($enabled) { //���� �������� �������, ������ ��� ������ ������ � ������ �� ������ ������� ������
		$result=7;		
//		$sql='UPDATE '.$SysValue['base']['table_name52'].' SET enabled="1" WHERE ((id_charact='.$idc.') AND (id_good='.$idgood.') AND (id_user='.$id_user.'));';
//		$result=mysql_query($sql);
	} else {

		if ($chars_amount) { //����� ������ ��� ����, ����� update
			$sql='UPDATE '.$SysValue['base']['table_name52'].' SET userip="'.$userip.'", rate="'.$rate.'", date="'.mktime().'" WHERE ((id_charact='.$idc.') AND (id_good='.$idgood.') AND (id_user='.$id_user.'));';
			$result=mysql_query($sql);
			$result=2;		
		} else { //������ ��� ���, ����� insert
			$sql='INSERT INTO '.$SysValue['base']['table_name52'].' (id_charact,id_good,id_user,userip,rate,date) VALUES ("'.$idc.'","'.$idgood.'","'.$id_user.'","'.$userip.'","'.$rate.'",'.mktime().');';
			$result=mysql_query($sql);

			//����� ������� ������ �������� - ���� �� �������� ��� ���
			//�������� ���������:
			$sql='select id_category from '.$SysValue['base']['table_name51'].' where (id_charact='.$idc.')';
			$result=mysql_query($sql);
			$row = mysql_fetch_array($result);

                        //�������� ��� ��������������:
			$sql='select id_charact from '.$SysValue['base']['table_name51'].' where (id_category='.$row['id_category'].')';
			$result=mysql_query($sql);
			@$chamount=mysql_num_rows($result); //�������� ���������� �������������

			while ($row = mysql_fetch_array($result)) {$ids.=','.$row['id_charact'];}
                        $ids=substr($ids,1); //������ id �������������
			$sql="select id_vote from ".$SysValue['base']['table_name52']." where ((id_charact IN (".$ids.")) AND (id_good=".$idgood.") AND (id_user=".$id_user."))";
			$result=mysql_query($sql);
			@$voteamount=mysql_num_rows($result); //�������� ���������� �������������� �������������			
			if ($voteamount==$chamount) {
				while ($row = mysql_fetch_array($result)) {
					$vote=$row['id_vote'];
					$sql2='UPDATE '.$SysValue['base']['table_name52'].' SET enabled="1" WHERE (id_vote='.$vote.');';
					$result2=mysql_query($sql2);

				}
			}
			$result=3;		
		}
	}
/*
	$result[]=$idgood;
	$result[]=$idc;
	$result[]=$id_user;
	$result[]=$userip;
//*/
} else {
	$result=0;	
}

$result=print_r($result, true);

$_RESULT = array(
  'result' => $result
); 
//http://phpshop96/phpshop/ratingvote.php
?>