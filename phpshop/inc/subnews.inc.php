<?
function News_del($mail)// �������� �� ����
{
global $SysValue;
$sql="select mail from ".$SysValue['base']['table_name9'];
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$mail_to=$row['mail'];
	if($mail==$mail_to)
	  {
	  $sql="delete from ".$SysValue['base']['table_name9']."
      where mail='$mail'";
      $result=mysql_query($sql)or @die("���������� �������� ������");
	  return $disp=0;
	  exit;
	  }
	}
return $disp=1;
}

function News_write()
{
global $SysValue,$mail,$status;
$data=date("d.m.y");
$mail=TotalClean(@$mail,3);
if($mail!="")
 {
$do=News_del($mail);
  if($do==1 and @$status==1)
   {
$sql="INSERT INTO ".$SysValue['base']['table_name9']."
VALUES ('','$data','$mail')";
$result=mysql_query($sql)or @die("���������� �������� ������");

 // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['good_news_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_news_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
   
	}
	elseif(@$status==0)
	   {
	   // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_news_mesage_2']."</B></FONT><BR>".$SysValue['lang']['good_news_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
	   
	   }
	   elseif($do==0 and @$status==1)
	   {
	    // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_news_mesage_1']."</B></FONT><BR>".$SysValue['lang']['good_news_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
	   }
  }
  
  else
     {
	   // ���������� ���������
   $SysValue['other']['mesageText']= "<FONT style=\"font-size:14px;color:red\">
<B>".$SysValue['lang']['bad_news_mesage_3']."</B></FONT><BR>".$SysValue['lang']['good_news_mesage_2'];
   
   // ���������� ������
   @$dis=ParseTemplateReturn($SysValue['templates']['news_forma_mesage']);
	 }
return $dis;
}
?>
