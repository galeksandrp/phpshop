<?
if(isset($timestamp)){
  $year=date("Y",$timestamp);
  $month=date("m",$timestamp);
  $day=date("d",$timestamp);
  $SysValue['other']['pageTitleDate']= "�� ".$day.'.'.$month.'.'.$year;
  @$disp=@News();
  }
  elseif($SysValue['nav']['nav']=="ID") @$disp=@NewsPodrob($SysValue['nav']['id']);
       else @$disp=@News();

		
// ���������� ���������
$SysValue['other']['NavActive']="news";
$SysValue['other']['DispShop']=@$disp;


$admoption=unserialize($LoadItems['System']['admoption']);
if($admoption['user_calendar'] == 1) $SysValue['other']['calendar']=calendar();
  

if($SysValue['other']['DispShop'] == 404){
header("HTTP/1.0 404 Not Found");
header("Status: 404 Not Found");
include("pages/error.php");
}
  
// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);

?>

