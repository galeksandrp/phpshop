<?
// ���������� ���������
if(@$error == "ok")
$SysValue['other']['Error']=" / <font color=\"red\"><strong>��� ����� �������...</strong></font>";


	 @$disp.=DispGbook().'
	 <div align="center" style="padding:20">
 <a href="/gbook_forma/">
 [�������� �����]</a>
 </div>
	 ';


$SysValue['other']['DispShop']=@$disp;
  
// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
	?>
