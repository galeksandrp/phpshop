<?php

/**
 * �������� ������, ������� ��� �����
 * @package PHPShopTest
 * @return string
 */
function myTest(){
$PHPShopOrm=&new PHPShopOrm($GLOBALS['SysValue']['base']['table_name3']);
$row=$PHPShopOrm->select(array('name'));
$disp='
<p><br></p>
<div align="right">
<strong>��. �����:</strong><br>
<a href="/doc/license.html">&raquo; ������������ ����������</a><br>
<a href="/doc/design.html">&raquo; �������������� �������</a><br>
<a href="/skin/">&raquo; ���� ���������� �������� PHPShop</a><br>
<a href="/doc/test.html">&raquo; ����������� HTML ������</a><br>
<a href="/phptest/">&raquo; ����������� PHP ������</a><br>
<a href="/coretest/">&raquo; ����������� PHP ������ ����� API</a><br>
</div>
<h1>����������� PHP ������</h1>
<p>
�������� ����� ����� ���������� �� ������: /pages/phptest.php<br>
�������� ������������� ������ php.<br>
��� �����������  HTML ������ ����������� ����� � ����� <a href="/doc/test.html">/doc/test.html</a>
</p>
<p>������� � ������ 3.0 ���������� ����������� ������������� <a href="/doc/design.html#id8">PHP ������ � ��������</a> ����� ���������� ������.</p>
<p>
<p>������� � ������ 3.3 ���������� ����������� ������������ ��������� <a href="/coretest/">API PHPShop Core</a>,
������� ���������� ��������� ������� ������� � �������������� ���������� ������� � �������.</p>
<p>
<h1>��� ������ �����: "'.$row['name'].'"</h1>
�������� ������ PHPTEST:

<ul>
  <li>������� �������<br>
  <pre>
function <strong>myTest()</strong>{
return "Hellow world!";
}

��� ���������� ������������ ������ return, 
������� echo � print!!!
</pre>

   <li>������� Title<br>
      <pre>
$SysValue["other"]["pageTitl"] ="����������� PHP ������ - "
.$PHPShopSystem->getValue("name");
   </pre>
   <li>���������� ������������<br>
   <pre>
$SysValue[\'other\'][\'DispShop\']=myTest();
ParseTemplate($SysValue[\'templates\'][\'shop\']);
   </pre>
   
   <li>� ����� �������� ����� ��������� "Hellow world!" � ����� ������� �����.
</ul>

</p>
';
return $disp;
}

// Title
$SysValue['other']['pageTitl'] ="����������� PHP ������ - ".$PHPShopSystem->getValue('name');

// ���������� ������
$SysValue['other']['DispShop']=myTest();
ParseTemplate($SysValue['templates']['shop']);
?>