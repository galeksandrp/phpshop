<?

if(@$error == "key")
$SysValue['other']['Error']="�������� ����, ��������� �� ��������!";

// ���������� ���������
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['gbook_forma_otsiv']);
 
// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
?>