<?
//����������
$addimageurl=""; //�������������� ���� �� ������� � ���������, ���� ����
$my_limit=5; //���������� �������
//����������

function Chek($stroka)// �������� �������� ����
{
if (!ereg ("([0-9])", $stroka)) $stroka=$my_limit;
return abs($stroka);
}


if($limit<20 and !empty($limit)) 
$limit=Chek($limit);
  else $limit=$my_limit;
  

//�������������
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);
$SERVER=$SysValue['connect']['host']; 
$USERDB=$SysValue['connect']['user_db']; 
$PASS=$SysValue['connect']['pass_db']; 
$BASENTRG=$SysValue['connect']['dbase'];  //offline //������ ��� ������� � MYSQL
$server='http://'.$_SERVER['HTTP_HOST'].'/';
//�������������

//���������� � ����� ������
@mysql_connect($SERVER,$USERDB,$PASS) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ����������� � �������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CONNECT_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>'.mysql_errno().mysql_error());
@mysql_select_db ($BASENTRG) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CHOISE_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>');
@mysql_query( 'set names cp1251' );
//���������� � ����� ������

//�������� ������
$sql='SELECT * FROM '.$SysValue['base']['table_name24'].' WHERE enabled="1" and kurs="1"  LIMIT 1';
$result=mysql_query($sql);
$rows=mysql_num_rows($result);
$row=mysql_fetch_array($result);
$valuta=$row['code'];
//�������� ������

//�������� � ������� ������
$sql='SELECT * FROM `'.$SysValue['base']['table_name2'].'` WHERE (pic_small!="" AND enabled="1") ORDER BY RAND() LIMIT '.$limit;
$result=mysql_query($sql);
$rows=mysql_num_rows($result);

if(!empty($Psize)) $Psize=" width=".$Psize." ";
 
while ($row=mysql_fetch_array($result)) {
  $id=$row['id'];
  $name=$row['name'];
  $pic=$row['pic_small'];
  $price=$row['price'];

  //�����
  @$dis.='<A href="'.$server.'shop/UID_'.$id.'.html" title="'.$name.'"  target="_blank">'.$name.' - '.$price.$valuta.'<BR>
        <IMG TITLE="'.$name.'" '.$Psize.' BORDER=0 SRC="'.$server.$addimageurl.$pic.'"></A><BR><BR>
        ';
  //�����
}

// ������� ������
if(empty($color)) $style="0089C0";
if(empty($Fsize)) $Fsize="12";


echo "
<html>
<head>
	<title>Rotation</title>
<style>

body{
font-family: Tahoma;
}

a {
color: $color;
font-size: ".$Fsize."px;
text-decoration: underline;
}

a:hover{
text-decoration: none;
}
</style>
</head>

<body>
".$dis."
<div align=center><a href='/' target='_blank'>��� ������ &raquo;</a></div>"
;
?>