<?$myFile = file_get_contents("./index.php"); $BIN = explode("ENDscript",$myFile); 
if(eregi('escape', $BIN[1]) or eregi('<iframe>', $BIN[1])) exit("<h1>����������� ���� ���������!</h1>�� ��������� ��������� ������� ���������� � ������ ����������� ���������: <a href=\"http://help.phpshop.ru\" target=\"_blank\">help.phpshop.ru</a><hr>".date("D M j G:i:s T Y"));?>
