<?php
session_start();

require_once "./lib/Subsys/JsHttpRequest/Php.php";
require_once "./lib/parser/parser.php";
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
@mysql_query("SET NAMES 'cp1251'");

// ����� ���-��
function NumFrom($from_base,$query) 
{
global $SysValue;
$sql="select COUNT('id') as count from ".$SysValue['base'][$from_base]." ".$query;
@$result=mysql_query(@$sql);
@$row = mysql_fetch_array(@$result);
@$num=@$row['count'];
return @$num;
}


function dataV($nowtime,$flag="true"){
$Months = array("01"=>"������","02"=>"�������","03"=>"�����", 
 "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
 "08"=>"�������","09"=>"��������",  "10"=>"�������",
 "11"=>"������","12"=>"�������");
 
$curDateM = date("m",$nowtime); 
if($flag=="true")
$t=date("d",$nowtime)." ".$Months[$curDateM]." ".date("Y",$nowtime).", ".date("H:s ",$nowtime); 
elseif($flag=="shot") $t=date("d",$nowtime).".".$curDateM.".".date("y",$nowtime); 
elseif($flag=="update") $t=date("d",$nowtime).".".$curDateM.".".date("y",$nowtime); 
else $t=date("d",$nowtime)." ".$Months[$curDateM]." ".date("Y",$nowtime)."�."; 
return $t;
}


function Page_comment($id)// �������� �������
{
global $SysValue,$_REQUEST;
$p=$_REQUEST['page']; if(@!$p) $p=1;
$num_row=10;
$num_ot=0;
$q=0;
while($q<$p)
  {
  $sql="select * from ".$SysValue['base']['table_name36']." where parent_id=$id and enabled='1'  order by id desc LIMIT $num_ot, $num_row";
  $q++;
  $num_ot=$num_ot+$num_row;
  }
return $sql;
}

function Nav_comment($id)// ��������� 
{
global $SysValue,$_REQUEST;
$p=$_REQUEST['page']; if(@!$p) $p=1;
$num_row=10;
$sql="select id from ".$SysValue['base']['table_name36']." where parent_id=$id";
@$result=mysql_query(@$sql);
$num_page=mysql_numrows(@$result);
$i=1;
$num=$num_page/$num_row;
while ($i<$num+1)
    {
	if($i!=$p){
	
	if($i==1) $pageOt=$i+@$pageDo;
	 else $pageOt=$i+@$pageDo-$i;
	 
	$pageDo=$i*$num_row;
	@$navigat.="
	     <a href=\"javascript:commentList($id,'list',$i);\">".$pageOt."-".$pageDo."</a> | ";
	}
	else{
	
     if($i==1) $pageOt=$i+@$pageDo;
	 else $pageOt=$i+@$pageDo-$i;
	 
	$pageDo=$i*$num_row;
	 @$navigat.="
	     <b>".$pageOt."-".$pageDo."</b> | ";
	}
	$i++;
	}
 if($num>1)
  {
 if($p>$num){$p_to=$i-1;}else{$p_to=$p+1;}
 $nava="
 <tr class=tip1><td>
 <table cellpadding=\"0\" cellpadding=\"0\" border=\"0\">
        <tr >
	     <td class=style5>
".$SysValue['lang']['page_now'].": 
<a href=\"javascript:commentList($id,'list',".($p-1).");\"><img src=\"images/shop/3.gif\" width=\"16\" height=\"15\" border=\"0\" align=\"absmiddle\"></a>
$navigat&nbsp<a href=\"javascript:commentList($id,'list',".$p_to.")\"><img src=\"images/shop/4.gif\" width=\"16\" height=\"15\" border=\"0\" align=\"absmiddle\" title=\"������\"></a>
		</td>
       </tr>
        </table>
</td></tr>
		";
	}
return @$nava;
}
 
// ������� ���������
function returnSmile($string){
global $SysValue;
$Smile=array(
':-D'=>'<img src="images/smiley/grin.gif" alt="�������" border="0">',
':\)'=>'<img src="images/smiley/smile3.gif" alt="���������" border="0">',
':\('=>'<img src="images/smiley/sad.gif" alt="��������" border="0">',
':shock:'=>'<img src="images/smiley/shok.gif" alt="� ����" border="0">',
':cool:'=>'<img src="images/smiley/cool.gif" alt="�������������" border="0">',
':blush:'=>'<img src="images/smiley/blush2.gif" alt="����������" border="0">',
':dance:'=>'<img src="images/smiley/dance.gif" alt="�������" border="0">',
':rad:'=>'<img src="images/smiley/happy.gif" alt="��������" border="0">',
':lol:'=>'<img src="images/smiley/lol.gif" alt="��� ������" border="0">',
':huh:'=>'<img src="images/smiley/huh.gif" alt="� ��������������" border="0">',
':rolly:'=>'<img src="images/smiley/rolleyes.gif" alt="����������" border="0">',
':thuf:'=>'<img src="images/smiley/threaten.gif" alt="����" border="0">',
':tongue:'=>'<img src="images/smiley/tongue.gif" alt="���������� ����" border="0">',
':smart:'=>'<img src="images/smiley/umnik2.gif" alt="��������" border="0">',
':wacko:'=>'<img src="images/smiley/wacko.gif" alt="���������" border="0">',
':yes:'=>'<img src="images/smiley/yes.gif" alt="�����������" border="0">',
':yahoo:'=>'<img src="images/smiley/yu.gif" alt="���������" border="0">',
':sorry:'=>'<img src="images/smiley/sorry.gif" alt="��������" border="0">',
':nono:'=>'<img src="images/smiley/nono.gif" alt="��� ���" border="0">',
':dash:'=>'<img src="images/smiley/dash.gif" alt="������ �� ������" border="0">',
':dry:'=>'<img src="images/smiley/dry.gif" alt="������������" border="0">',
);

foreach ($Smile as $key=>$val)
$string=eregi_replace($key,$val,$string);

return $string;
}
 
 
function DispComment($id)
{
global $SysValue,$LoadItems;
$sql=Page_comment($id);
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$user_id=$row['user_id'];
	
// ��������������
if($_SESSION['UsersId'] == $user_id)
$SysValue['other']['commentEdit']= '<a href="javascript:commentList('.$user_id.',\'edit\',1,'.$row['id'].');">�������</a>';
  else $SysValue['other']['commentEdit']="";
	
// ���������� ���������
$SysValue['other']['commentData']= dataV($row['datas'],"shot");
$SysValue['other']['commentName']= $row['name'];
$SysValue['other']['commentContent']= ParseT(returnSmile($row['content']));

// ���������� ������
@$dis.=ParseTemplateReturn("comment/main_comment_forma.tpl");


	}

// ���������� ���������
$SysValue['other']['producUid']= $SysValue['nav']['id'];
$SysValue['other']['UsersId']= $_SESSION['UsersId'];
$SysValue['other']['productPageThis']=$p;
$SysValue['other']['productPageNav']=ParseT(Nav_comment($id));
$SysValue['other']['productPageDis']=@$dis;

// ���������� ������
@$disp=ParseTemplateReturn("comment/comment_page_list.tpl");
return @$disp;
}

function GetNameUser($id){
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name27']." where id=$id";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
$name=$row['name'];
return $name;
}

function MessageClean($str){
return htmlspecialchars(strip_tags($str));
}


switch($_REQUEST['comand']){

    case("add"):
	$myMessage=MessageClean($_REQUEST['message']);
	if($_SESSION['UsersId']>0 and $myMessage!=""){
    $sql="
	INSERT INTO ".$SysValue['base']['table_name36']." 
	VALUES 
 ('','".date("U")."','".GetNameUser($_SESSION['UsersId'])."','".$_REQUEST['xid']."','".$myMessage."','".$_SESSION['UsersId']."','0')";
	mysql_query($sql);
	}else $error = "error";
    $interfaces =  DispComment($_REQUEST['xid']);
     break;

    case("list"):
	$interfaces =  DispComment($_REQUEST['xid']);
	break;
	
	case("edit"):
	$sql="select content from ".$SysValue['base']['table_name36']." where id=".$_REQUEST['cid']." and user_id=".$_SESSION['UsersId'];
	$result=mysql_query($sql);
    $row = mysql_fetch_array($result);
	$interfaces =  $row['content'];
	break;
	
	case("edit_add"):
	$myMessage=MessageClean($_REQUEST['message']);
	if($_SESSION['UsersId']>0 and $myMessage!=""){
	$sql="UPDATE ".$SysValue['base']['table_name36']." 
SET
datas='".date("U")."',
content='".$myMessage."' 
where id='".$_REQUEST['cid']."'";
	mysql_query($sql);
	}else $error = "error";
	$interfaces =  DispComment($_REQUEST['xid']);
	break;
	
	case("dell"):
	$sql="delete from ".$SysValue['base']['table_name36']." 
where id='".$_REQUEST['cid']."'";
	mysql_query($sql);
	$interfaces =  DispComment($_REQUEST['xid']);
	break;
}


$_RESULT = array(
  'comment' => $interfaces,
  'status' => @$error
); 
?>