<?
error_reporting(0);

// ��������� ������������ ����
$SysValue=parse_ini_file("../phpshop/inc/config.ini",1);

// ����� �����
function GetFile(){
$dir="./";
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "sql")
		  return $file;
        }
        closedir($dh);
    }
return "base.sql";
}

// ��������
if(ini_get('register_globals') == 1) $register_globals="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $register_globals="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// ����
if(eregi('Apache', $_SERVER['SERVER_SOFTWARE'])) $API="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $API="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// ������ PHP
$phpversion=substr(phpversion(),0,1);
if($phpversion >= 4) $php="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $php="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";



// ������ MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
@mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");

if(@mysql_get_server_info()){
$mysqlversion=substr(@mysql_get_server_info(),0,1);
if($mysqlversion >= 4) $mysql="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $mysql="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
}else $mysql="...............?";

// Rewrite
$path_parts = pathinfo($PHP_SELF);
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/test.html";
if (@fopen($filename,"r")) $rewrite="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else $rewrite="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// ������ Zend
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/rewritemodtest.php";
$html = implode('', file ($filename));
if (eregi('Zend Optimizer', $html)) $zend="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
   else $zend="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//GD Support
$GD=gd_info();
if($GD['GD Version']!="")
 $gd_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
 
//FreeType Support
if($GD['FreeType Support'] === true)
 $gd_freetype_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_freetype_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//FreeType Linkage
if($GD['FreeType Linkage'] == "with freetype")
 $gd_freetype_linkage="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
  else  $gd_freetype_linkage="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?= $SysValue['license']['product_name']?> - > ���������</title>
<META http-equiv=Content-Type content="text-html; charset=windows-1251">
<style>
.ok{
color: green;
font-weight: bold;
}
.error{
color: red;
font-weight: bold;
}
BODY, li, a {
	FONT-SIZE: 12px;
	COLOR: #000000;
	FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif;
}
pre.{
	COLOR: #000000;
}
td.{
	COLOR: #000000;
	FONT-SIZE: 12px;
}
a{
	COLOR: #0066cc;
}
a:hover{
	COLOR: CC6600;
}
textarea{
	border-style: dashed;
	border-color: Gray;
	border-width: 1px;
 }
li.red{
 color: red;
}
</style>
<script>
function miniWin(url,w,h)
{
window.open(url,"_blank","left=300,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
}
</script>
</head>
<body>
<h1><?= $SysValue['license']['product_name']?></h1>
<table width="100%">
<tr>
    <td width="150" bgcolor="D4E3F7" valign="top" style="padding:10">
	<b style="color:#1054AF">����������</b><br><br>
<FONT face=wingdings>1</FONT> <a href="#id1">����������</a><br>
<FONT face=wingdings>1</FONT> <a href="#id2">��������� Denwer</a><br>
<FONT face=wingdings>1</FONT> <a href="#id3">���������</a><br>
<FONT face=wingdings>1</FONT> <a href="#id4">��������</a><br>
<FONT face=wingdings>1</FONT> <a href="#error">���� ������</a><br>
<FONT face=wingdings>1</FONT> <a href="#id5">������������</a><br>
<FONT face=wingdings>1</FONT> <a href="#id7">����������</a><br>
<FONT face=wingdings>1</FONT> <a href="#id8">API</a><br>
<FONT face=wingdings>1</FONT> <a href="#id9">�������������</a><br>

	</td>
	<td width="10"></td>
	<td bgcolor="ffffff">
<p>
<a name="id1"></a>
<h4>1. ���� ��������� ����������</h4>
<ol>
<li> Apache => 1.3.*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$API?>
<li> MySQL => 4.* <?=$mysql?>
<li> PHP => 4.* &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$php?>
<li> ZendOptimizer => 2.1.5.3 &nbsp;&nbsp;&nbsp;&nbsp;<?=$zend?>
<li> RewriteEngine ON ��� Apache&nbsp;&nbsp;&nbsp;<?=$rewrite?>
<li> Register Globals ON ��� PHP &nbsp;&nbsp;&nbsp;<?=$register_globals?>
<li>GD Support ��� PHP <?=$gd_support?>
<li>FreeType Support ��� PHP <?=$gd_freetype_support?>
<li>FreeType Linkage ��� PHP <?=$gd_freetype_linkage?>
</p>
�����������: <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle> <b class='ok'>Ok</b> - ���� �������, 
<img src="rewritemodtest/errormessage.gif"  border=0 align=absmiddle> <b class='error'>Error</b> - ���� �� ������� (�������� �������� ��� ������ �������, ���������� � ������������ ������� ��� ��������� � ��������������� �������)<br>
<img src="rewritemodtest/php.png" border=0 align=absmiddle> <a href="rewritemodtest/rewritemodtest.php" target="_blank">�������� ���������� � PHP</a>
</ol>

<p>
<a name="id2"></a>
<h4>2. ��������� �� ��������� ������ Denwer</h4> 
<ol>
<li>���������� <a href="http://www.phpshop.ru/loads/ThLHDegJUj/Denwer.exe" target="_blank">
Denwer 
</a>- ����� �������������, ������������ Web-�������������� (�������������� � �����������) ��� ������� ������ �� ��������� (���������) Windows-������ ��� ������������� ������ � ��������.
<li>���������� <a href="http://www.phpshop.ru/loads/ThLHDegJUj/ZendOptimizer-2.6.2-Windows-i386.exe" target="_blank">ZendOptimizer</a> � ��� �� �������, ��� ����������� Denwer (<a href="http://www.phpshop.ru/gbook/ID_70.html" target="_blank">��������� ��������</a>)
<li>���������� PHPShop � ����� ���������� �� �������, �������� � demo.ru. (� ��������� ������ ����� �������������� ���������� demo.ru/www/)
<li>��������� web-������, ���������������� ������� "Run Server" � ���� "���������" 
</ol>
</p>
<p>
<a name="id3"></a>
<h4>3. ��������� � ���������� ��� ���� ��������</h4>
<ol>
<li>�������� ����� ���� MySQL �� ����� �������.
<li>

�������������� ���� ����� � ����� MySQL "config.ini", ������� � ����� "���_����/phpshop/inc/config.ini".
<pre>
[connect]
host="localhost";             # ��� ������ �����
user_db="Enterprise";         # ��� ������ ������������
pass_db="dennion";            # ������ ����� ����
dbase="Enterprise";           # ��� ����� ����
</pre>
</li>
<li>
<a name="id3_2"></a>
�������������� ���������� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('install.php',550,570)">�������������</a> ��� ��������� ���� ��� ��������� ����� ���� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="<?=GetFile()?>"><?=GetFile()?></a> ����� ��������� <b>phpMyAdmin</b> (�������� ��������).<br><br>
</li>
<li>���������� ����� CMOD 777 (UNIX �������) ��� ����� (������������� ����� ������������ ������� ��):
<br><br>
<ol >
<li class=red>UserFiles/Image
<li class=red>files/price
<li class=red>phpshop/admpanel/csv
<li class=red>phpshop/admpanel/dumper/backup
</ol>
<br><br>
<li>��� ����� � <a href="../phpshop/admpanel/">���������������� ������</a> ������� F12.<br> 
��� ��������� ������������ � ������ �� ��������� <strong>root</strong>.<br>
��������, ������������ ������������� ������� ��������� ������.<br>
����� ����� ������ ��������� ���������� ��������.
<br><br>
<li><strong>����������</strong> ����������� �� ����������</a>
<br><br>
<ol >
<li>������� ����� /old/ ��������� ���� ��� ����� �� �������� ���������� www
<li>��������� � ��������� ���������� www ����� ����� �� ������ ����� ������
<li>�� ������� ����� config.ini ����� ��������� ����������� � ���� ������ (������ 5 �����) � ��������� � ����� ������ (/phpshop/inc/config.ini)
<li>��������� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('update/install.php',550,550)">�������� ��� ������</a> (���_����/install/update/), �������� ������� ������, ���� �� ��� ���, �� ��������� ���� �� �����. ������� ����� /install/
<li>�� ����� /old/ �������� ����� /UserFiles �� ������� ���������� � ����������� ������ � ���� �����
<li>�� ������������� �������� ������ ������ /phpshop/templates/, �� � ������ ��� � ��� ����� ���� ������� ��������� ��� ����� ������ (�������� � ����������)
</ol>
<br><br>
<li>��� �������� (��������) �� ������� ShopScript ��������� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="./migration/" target="_blank">���������  �������� ShopScript -&gt; PHPShop</a>. �������� ����, ��������, ������� ����� ��������� ��� ������ PHPShop.

</ol>
</p>
<p>
<a name="id4"></a>
<h4>4. ��������</h4>
<ol>
<li> <b>������������ ����������</b><br><br>
<textarea style="width:100%;height:300">
��������� ������������ ���������� (�����, ����������) �������� ��������� ����� ���� � ��������� �PHPShop� (�����, �����). ���������� ��������� �� ���� ����������� ���������������� ������� � ������������ ������������ �������� PHPShop. 

1. ����������� ������� PHPShop (�����, �������) ������������ ����� ��� ��������� �������� ��������, ���������������� � ������ ��� �� ������, ������� ����������� ��� ������������� ������������, � ����� ����� ������� ����������. 

2. ������� �������� ��������������� � ���, ��� �� ������������ � ����������� ����������, ���������� ��� ���������, � ������ ������������ ������� �� �������� ������� ����������. 

3. ���������� �������� � �������� ���� ��������������� � ������ ������� ��������, �.�. ��������� ���� �������� ����������� ����������� ������� �������� ������ ���� �� ���������� ���������, �� ���������� ������. 

4. ��� ��������� ����� �� ������� ����������� ������. ������� � ����� ��� �� ����������� �������� �������� ���������� ����� � �������� ������ �������� ����������� � �������������� ���������������� �� ��������� ������������� � ��������������� ����������� ��������� ��� ��� "PHPShop" � 2006614274. ����� ��������� �� ����� ����� ��������� ���������� �������� ������(*) � ��������� ���������� ����� �� �����, ��� ������������ �������. ������������� �������� � ���������� ������� ������� ����������, �������� ���������� ������� �� ��������� �����, � ����� �������������� � ������������ � ����������� �����������������. ����� �� ���������� �������� ������ � ��������� ���������� ����� �������� ���������� ���������� � ������������ ������� � �������������� ����������� ��������� �������. 

5. ������� ������������ �� �������� "��� ����" ("AS IS") ��� �������������� �������� ������������������, ������������� �����������, ����������� ������, � ����� ���� ���� ���������� ��� �������������� ��������. ����� �� ����� �����-���� ��������������� �� ���������� ��� ����������� ���������� ����� ���, ����� ���������� ��� ������ ������� ���������� ������������� ��� ������������� ������������� ��������. 

6. ������ ���������� ���� ��� ����� �� ������������� ���������������(**) ���������� ����� �������� �� ����� web-������� � �������� 
������ ������(***). ��� ������ ����� ��������� �������� �� ������ ����� web-������� ������ ���� ����������� ��������� ��������. ����� ��������������� �������� ��� ���������������� �������� ������, ������� ��������������, �������� ���������� ������� ���������� � ������ ��������������� �������� ������������ ����������������. ����������� ����������� �������� � ������������� ���� �������������� ����� �������� ������������� � ����� ������������ ��� �������� ��������� � �������� ���, ��� �������, ��� ����� ����� �� ����� �������� ������� �����. 

7. �� ������ ������� ����� ��������� � �������� ��� �������� �� ������ ����������. ��� ���� ����������� ������������� �������� ������ �������������� � ������������ � ������ ����������� � ��� ������� ���������� ���� ��������� ����. ����� �� ����� ��������������� �� ����������������� �������� � ������ �������� ���� ����� �� �� �� ���� ���������. 

8. ����� �� ����� ���������������, ��������� � ������������ ��� � ���������������� ��� ��������� ��������������� �� ������������� �������� � ��������������� ����� (�������, �� �� �������������, �������� ����� �������� ������� ��������, ������� �� ������� ��� ������� ���������� �����, ��������������� ��� ���������� ���������� ��� ��������������� ������; � �.�.). 

9. ����������� �������� ������� ���������� ����������� � ������ �������� ���� ���� ���������� ������ � ������������, � ��� �� �� �����. ����������� �������� ������� ���������� �� ��������� ������ ���������� ��������, ����������� ���� �� ������������ ��������. 

���������:

* ��� ������ � ���������� ������ �������� �������, ��� ������ �� ��������� ���������. � ����� ���������� ������������ � ������������ �������� �������� ��������� ����� ������ (�������� ���������). ��� ����������� ��������� �������� ������� �������� ��� ���������� ������. ������ � ����� ������ ����������� � ������������ � ������� ���������� � ������� ��� ��� ����� ������ �������� �����. �������� ��� ���������� ������ �������������� ��������, ��������� ����� �������� ����������� �����������.

** ������ ������ Enterprise � Enterprise Pro ������������ ���������� � ���������� ����������. ������ Start � Catalog, Catalog Pro ������������ ���������� ������ � �������� ����� ��� ���������. 

*** ������� � ���� ���������� � �������� ������ ������ seamply.ru. �������� ��������� ���������� ���� seamply.ru/market1/, seamply.ru/market2/ � �.�.
���������� ���� market1.seamply.ru � �.�. ������� ������� ��������� ��������. ����������� ��������� ���������������� ������ �� ���� ����� ��������, ������������ ���������� ��� ����������� ��������� � �������� ����������. ��� ������� ������ ���������� �������� ��������� ������� ����� ����������� ���������.


</textarea><br><br>
<li> ��� <b>��������� ��������</b> ���������� ���� � ��������� (���_������.lic) � ����� /license. ������ ��� ������ �������� � ���� �����. ��� ����� �������� �������� ������������ ���� � ���� �����. � ����� ������ ������ ������ ���� ��������!<br><br>
</ol>
</p>
<a name="error"></a>
<p><h4>5. ���� ������</h4>
<ol>
<li><b>101 ������ ����������� � ����</b><br><br>
<ul>
<li>��������� ��������� ����������� � ���� ������: <b>host, user_db, pass_db, dbase</b>.
<li>�������� ���� phpshop/inc/config.ini � �������������� ������������� ���������� ��� ���� ����.<br>
<pre>
[connect]
host="localhost";             # ��� �����
user_db="Enterprise";         # ��� ������������
pass_db="dennion";            # ������ ����
dbase="Enterprise";           # ��� ����
</pre>
</ul>
<li><b>102 �� ����������� ����</b><br><br>
<ul><li>��������� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="javascript:miniWin('install.php',550,550)">����������</a> ��� ��������� ��.
</ul><br>
<li><b>103 ������ ������������ ����� � �������</b><br><br>
<ul><li>��������� ��������� � ������������ ����� <strong>dafault_page_dir</strong>.
</ul><br>
<li><b>104 ������ ������������ ����� � ��������� ������� (�����)</b><br><br>
<ul>
<li>�� �������� ����� Register Globals ON 
<li>��������� ������������� ����� � ��������� ��������: <strong>phpshop/templates/���_�������</strong>.
<li>����� <img src="../phpshop/admpanel/img/icon-setup.gif" alt=""  border="0" align="absmiddle" hspace="5"><a href="../phpshop/admpanel/" target="_blank">������ �����������������</a> (<b>����� "�������"</b>) �������� ������������ ������.
<li>��� ������� ������ ��������� � ������ ����� (��. ����)
</ul><br>
<li><b>105 ������ ������������� ����� install.php</b><br><br>
<ul>
<li>� ����� ������������ ������� ���� <b>install/install.php</b> � ����� <strong>/install/update</strong>
<li>��� ���������� ���� �������� �������� �������� ���������� check_install="false"; � ������������ ����� config.ini (��. ����)
</ul>
</ol>
<a name="id5"></a>
<p><h4>6. ������������</h4>
����� � ��������� ����������� �� ������: <strong>phpshop/templates/���_�������/</strong><br>
��� �������� ������� ����� ������ �� ������� ������� F9 ���������� ��� � ������� ����� �������� ���������������� �����. ����� ��������� �� ����� HTML. � ������ �������� ��������� ������: @���������@ ���������� �� ��������� ������ ������� � ������������� � ����. ������ �������� ��������� ���������� <a href="#id7">����</a>.
<pre style="padding:10">
main/index.tpl - ������ �������� <strong>(�������� ������)</strong>
main/shop.tpl -  ��� ��������� �������� <strong>(�������� ������)</strong>
main/left_menu.tpl -  ������ ������ ���������� �����    
main/right_menu.tpl -  ������ ������� ���������� �����
<br><br>
product/main_product_forma.tpl - ������ ����� ��������
product/product_page_list.tpl -  ������ �������� �������� �������� ��������� 
product/product_page_full.tpl -  ������ ���������� �������� ���������
product/main_product_forma_full.tpl - ������ ����� �������� ��������
product/product_page_full.tpl -  ������ ���������� ������ �������� ��������
product/main_spec_forma.tpl -  ������ ����� ��������������� �� ������� ��������
product/main_spec_forma_icon.tpl - ������ ����� ��������������� ������� ������� (������)
product/main_odnotip_forma_icon.tpl -  ������ ����� ���������� �������
product/main_product_odnotip_list.tpl - ������ ��� ���������� �������
<br><br>
serach/search_page_list.tpl -  ������ ������ ������ ���������
search/main_search_forma_2.tpl -  ������ ����� ������ ������� � ������
<br><br>
news/news_page_list.tpl -  ������ �������� �������� ������
news/news_page_full.tpl - ������ �������� �������� ��������
news/main_news_forma.tpl -  ������ ����� �������� ������
news/main_news_forma_full.tpl - ������ ����� �������� ��������
<br><br>
gbook/gbook_page_list.tpl - ������ ������ �������     
gbook/main_gbook_forma.tpl - ������ ����� �������  
gbook/gbook_forma_otsiv.tpl - ������ ����� ���������� ������   
<br><br>
map/map_page_list.tpl -  ������ ������ ����� �����
<br><br>
links/links_page_list.tpl -  ������ ������ ������
links/main_links_forma.tpl -  ������ ����� ������
<br><br>
page/page_page_list.tpl -  ������ ����� ������ �������
<br><br>
order/main_order_forma.tpl - ������ ����� ��� ���������� �������
order/main_order_list.tpl - ������ ������ ��� ���������� ������� (��������)
<br><br>
price/main_price_forma.tpl -  ������ ����� ������
price/price_page_list.tpl -  ������ �������� ������  
price/main_price_forma_tip.tpl - ������ ����� ������ ��������
<br><br>
error/error_page_forma.tpl -  ����� 404 ������
<br><br>
order/order_forma_mesage.tpl - ������ ����� ��������� ��� ������
order/order_forma_mesage_main.tpl -  ������ ����� ��������� ��� ������
<br><br>
news/news_main_mini.tpl -  ������ ��������� ������� ������
<br><br>
banner/baner_list_forma.tpl -  ������ �������� ����
<br><br>
catalog/catalog_forma.tpl -  ������ ��������
catalog/podcatalog_forma.tpl -  ������ �����������
</pre>
<a name="id7"></a>
<p><h4>7. ���������� �������������</h4>
����� � ��������� ����������� �� ������: phpshop/templates/���_�������/
<ol>
<li><b>������� � ��������� �������� (���_�������/main)</b><br><br>

<ul>
<li>@pageTitl@ - ���� ��������
<li>@pageDesc@ - �������� ��������
<li>@pageKeyw@ - �������� �����
<li>@pageMeta@ - ���� ��������
<li>@pageReg@ - ��������
<li>@pageProduct@ - ������ �����
<li>@pageDomen@ - �������� �� �����
<li>@pageCss@ - ���� � ������ �������
<li>@leftCatal@ - ����� ���� ����� ���������
<li>@leftMenu@ - ����� ����� ����� ��������� ����������
<li>@rightMenu@ - ����� ����� ������ ��������� ����������
<li>@mainContentTitle@ - ��������� ��������� ������� �� ������� ��������
<li>@mainContent@ - ���������� ��������� ������� �� ������� �������� 
<li>@DispShop@ - ����� �������������� ������� (�������� ��������, �������, �������.)
<li>@miniNews@ - ����� ��������� ��������
<li>@banersDisp@ - ����� �������� ����
<li>@pageReg@ - ��������
<li>@usersDisp@ - ����� ����� ����������
<li>@name@ - ����� ����� �����
<li>@descrip@ - ����� �������� �����
<li>@serverName@ - ����� ����� �������
<li>@num@ - ����� ���-�� ������� � �������
<li>@sum@ - ����� ����� ������
<li>@productValutaName@ -  ����� ����� ������ � �������
<li>@valutaDisp@ - ����� ����� ������ ��� �����
<li>@topMenu@ - ������� ������������� ����
<li>@specMain@ - ����� ���������������
<li>@pageCatal@ - ����� �������� ������ (�������)
<li>@oprosDisp@ - ����� �������
<li>@skinSelect@ - ����� ����� �������
<li>@specMainIcon@ - ����� ������� �������� � �������
<li>@telNum@ - ��� �������� ��������
<li>@leftMenuName@ - �������� ���������� �����
<li>@leftMenuContent@ - ���������� ���������� �����
<li>@topMenuLink@ - ������ �� �������� �������� ����
<li>@topMenuName@ - ��� �������� �������� ���� 
<li>@topMenuName@
</ul><br>
<li><b>�������� (���_�������/page)</b><br><br>
<ul>
<li>@pageTitle@ - �������� ��������
<li>@pageContent@ - ������� ��������
<li>@pageNav@ - ����� ��������� �� ���������, ���������� ���� �������� � ���� ��� "HR"
<li>@pageName@ - ��� ��������
<li>@catName@ - ��� �������� ������
<li>@podcatalogName@ - ��� ����������� ������
</ul><br>
<li><b>������� (���_�������/catalog)</b><br><br>
<ul>
<li>@catalogName@ - �������� ��������
<li>@catalogPodcatalog@ - �������� ������, ����������� �� ���� �������
<li>@catalogUid@ - ID ��������
<li>@catalogd@ - ID ��������
<li>@catalogCat@ - ��� �������� ��������
<li>@parentName@ - ��� �������� ��������
<li>@catalogList@ - ����� ������ ������������
<li>@podcatalogName@ - ��� �����������
<li>@podcatalogContent@ - �������� ����������
<li>@thisCatSort@ - ����� �������� ��������
</ul><br>
<li><b>������ (���_�������/product)</b><br><br>
<ul>
<li>@productSale@ - ����: � �������
<li>@productInfo@ - ����: ��������
<li>@productName@ - ������������ ������
<li>@productArt@ - ������� ������
<li>@productDes@ - �������� ������
<li>@productPrice@ - ��������� ������ � ������
<li>@productPriceRub@ - ������ ��������� ������
<li>@productId@ - ������������� ����������� ������
<li>@productCat@ (@productCatnav@) - ������������� �������� ��� ������
<li>@productPageThis@ - ������� ��������
<li>@productUid@ - ������������� ������
<li>@catalog@ - ����: �������
<li>@vendorDisp@ - ������������� ������
<li>@catalogCat@ - ��� ��������
<li>@catalogCategory@ - ��� �����������
<li>@producFound@ - ����: ������� �������
<li>@productPodcat@ - ������������� �����������
<li>@productNum@ - ���-�� ������� � �����������
<li>@productNumOnPage@ - ����: ������� �� ��������
<li>@productNumRow@ - �������� ���-�� ������� �� �������
<li>@productPage@ - ����: �� ��������
<li>@productPageNav@ - ��������� (HTML)
<li>@productPageDis@ - ������ ��������� ������� (HTML)
<li>@productImg@ - ������������ ��������
<li>@productOdnotipList@ - ���������� ������ (HTML)
<li>@productOdnotip@ - ����: ������ ��� ���������� �������
<li>@vendorDispTitle@ - ������ ������ ������� � ��������
<li>@vendorDisp@ - ����� ��������
<li>@vendorSelectDisp@ - ����� ��������
<li>@productFotoList@ - ����� ������� ����������� � ������
<li>@ComStart@ - ������ ������������
<li>@ComEnd@ - ����� ������������
<li>@productValutaName@ - ����� ������� ������
<li>@productSklad@ - ����� ���-�� �� ������
<li>@productNotice@ - ����: ���������
<li>@productParentList@ - ����� ����� ������ ����������� �������
<li>@pagetemaDisp@ - ����� ������������ ������
</ul><br>
<li><b>�������� ����(���_�������/baner)</b><br><br>
<ul>
<li>@banerContent@ - ������� ������
</ul><br>
<li><b>������ (���_�������/gbook)</b><br><br>
<ul>
<li>@producFound@ - ����: ������� �������
<li>@productNum@ - ���-�� �������
<li>@productNumOnPage@ - ����: ���-�� �� ��������
<li>@productNumRow@ - ���-�� �� ��������
<li>@productPage@ - ����: ������� ��������
<li>@productPageThis@ - ������� ��������
<li>@productPageNav@ - ����� ���������
<li>@productPageDis@ - ����� ��������
<li>@gbookData@ - ���� ������
<li>@gbookMail@ - ����� ������
<li>@gbookTema@ - ���� ���������
<li>@gbookOtsiv@ - �����
<li>@gbookOtvet@ - ����� �������������
</ul><br>
<li><b>�������� (������) (���_�������/links)</b><br><br>
<ul>
<li>@producFound@ - ����: ������� �������
<li>@productNum@ - ���-�� �������
<li>@productNumOnPage@ - ����: ���-�� �� ��������
<li>@productNumRow@ - ���-�� �� ��������
<li>@productPage@ - ����: ������� ��������
<li>@productPageThis@ - ������� ��������
<li>@productPageNav@ - ����� ���������
<li>@productPageDis@ - ����� ��������
<li>@linksImage - ������ ������
<li>@linksName@ - �������� ������
<li>@linksOpis@ - ������� ������
</ul><br>
<li><b>������� (���_�������/news)</b><br><br>
<ul>
<li>@producFound@ - ����: ������� �������
<li>@productNum@ - ���-�� �������
<li>@productNumOnPage@ - ����: ���-�� �� ��������
<li>@productNumRow@ - ���-�� �� ��������
<li>@productPage@ - ����: ������� ��������
<li>@productPageThis@ - ������� ��������
<li>@productPageNav@ - ����� ���������
<li>@productPageDis@ - ����� ��������
<li>@newsData@ - ���� ����������
<li>@newsZag@ - �������� �������
<li>@newsKratko@ - ������� ������� �������
<li>@newsAll@ - ������ �� �����������
<li>@newsPodrob@ - ��������� ������� �������
<li>@mesageText@ - ��������� ��� ��������
</ul><br>
<li><b>����� (���_�������/search)</b><br><br>
<ul>
<li>@productNum@ - ������� �������
<li>@productSite@ - �������� �����
<li>@productName@ - �������� ��������� ��������
<li>@productDes@ - ������� �������� ��������
</ol>
<a name="id8"></a>
<p><h4>8. API ����������� �������� ������</h4>
��� ��������������� ��������� �������� ������ ������ ����� [autoload] ������������� ����� ( ����� ������������� config.ini)<br><br>
������ ����������� �������� ������ ������ �������� <b>Linkexchanger 0.7</b>:
<ol>
<li>������ ��� � ���� ������ ������:
<pre>
[autoload]
linkexchanger="phpshop/modules/linkexchanger";
</pre>

<li>������� ���� pages/���_������.php. ��� ����� ������ ����� ��������� � ��� ������� ������� (?nav=���_������). ���������� ��� � ��� ����:
<pre>
// ���������� ���������
$SysValue['other']['DispShop']=Linkexchanger(); 
// ����������� ����� �������, ������� ��������� �� ���������� ������ "phpshop/modules/linkexchanger"
// ��� ������ ������� ������ ������������ ������� <b>return $var</b>;
// ����� ������� ������������� ���������� $SysValue['other']['DispShop']
// � ������� �� � �������� ����� �� ������� @DispShop@

// ���������� ������ 
@ParseTemplate($SysValue['templates']['shop']);
</pre>
</ul>
</ol></p>
<a name="id9"></a>
<p><h4>9. �������������</h4>
<ol>
<li><b>������� ��������</b> �� ��� ������ <a href="http://www.denwer.ru">Denwer.ru</a>, � ���������� �� ����� � ������ �� PHP.<br>
<li><b>�����</b> �� ������ � ���������� �������.
<li><b>��������� �����</b> �� ������ � ���������� �������.
<li><b>����������� �����</b> �� ������ � ���������� �������.
</ol></p>
<div align="right">
<a href="#id1">�� ����</a>
</div>
</td>
</tr>
</table>
</body>
</html>
