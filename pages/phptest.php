<?
// API ����������� PHP �����


// ����
@$SysValue['other']['pageTitl']= "�������� ������ php";


// PHP ������
// ������� �������� ������ ����� return!!!
function myFunction(){
global $SERVER_NAME;
$dis="��� �������: ".$SERVER_NAME;
return $dis;
}


// ��������
@$SysValue['other']['pageTitle']= "PHP TEST";

// ������������ php ������
$SysValue['other']['pageContent']= myFunction();

// ����������� ������� ������ �������
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['page_page_list']);

// ���������� ����� ������ 
@ParseTemplate($SysValue['templates']['shop']);
?>
	