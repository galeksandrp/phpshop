<?
if(isset($_POST['getopros'])){

// ���������� ���������
if(isset($_COOKIE['opros']))
Update_opros_base($_POST['getopros'],0);
else {
// ����� ����
setcookie("opros", $_POST['getopros'], time()+60*60*24*1, "/opros/", $SERVER_NAME, 0);
Update_opros_base($_POST['getopros'],1);
}}

$SysValue['other']['DispShop'] = Vivod_opros_result();
// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
?>
	