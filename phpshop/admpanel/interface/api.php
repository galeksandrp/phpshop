<?php
// ���������� ���������� ���������.
require_once "../../lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// �������� ������.
$q = @$_REQUEST['q'];
$xid = @$_REQUEST['xid'];
$p = @$_REQUEST['page'];
$var1 = @$_REQUEST['var1'];
$var2 = @$_REQUEST['var2'];
$var3 = @$_REQUEST['var3'];
$var4 = @$_REQUEST['var4'];
$xid = @$_REQUEST['tit'];


require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");


// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");

// ������� ���������

switch($p){

      // �����������
      case("comment"):
	  require("../comment/admin_comment.php");
	   $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	 else {$interface.= @$var2;}
	$interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button name="btnLang" value=�������� class=but3 onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
    <td>	
	<input type=text name="words" id="words" size=30 class=s onMouseMove="show(\'[ '.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][5].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=����� class=but3 name="btnLang"  onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'words\').value)"></td>
<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>� �����������</option>
			<option value="43" id=txtLang>������������� �����</option>
			<option value="44" id=txtLang>������������� �����</option>
			<option value="41" id=txtLang>������� �� ����</option>
   </select>
   </td>
	<td width="10"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["gbook"],0) == 1) $interface.=Comment($var1,$var2,$var3);
	  else  $interface = $UserChek->BadUserForma();
	  break;


      // �����������
	  case("shopusers_notice"):
      require("../shopusers/admin_notice.php");
	   $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	else $interface.=@$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
		<input type=button name="btnLang" value=�������� class=but3 onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=20 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][6].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=����� class=but3 id=btnSearch name="btnLang" onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="actionSelect" size="1" onchange="DoWithSelect(this.value,form_flag,form_flag.length)">
			<option SELECTED id=txtLang value="0" >� �����������</option>
			<option value="25" id=txtLang>��������� �����������</option>
			<option value="26" id=txtLang>������� �� ����</option>
   </select>
   </td>
   <td width="10"></td>
   <td>
		<input type=button name="btnLang" value="�������������� �����������" class=but3 onclick="miniWin(\'./window/adm_window.php?do=29\',300,300)">
	</td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=ShopUsersNotice($var1,$var2,$var3);
	  else $interface=$UserChek->BadUserForma();
	  break;


	  // ��������� �������������
	  case("shopusers_messages"):
      require("../shopusers/admin_messages.php");
	  if(CheckedRules($UserStatus["shopusers"],0) == 1) $interface= Shopusers_messages();
	  else $interface = $UserChek->BadUserForma();
      break;

       
	  // ����������� �������
	  case("order_payment"):
	  	 $interface='
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;" height="10">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.= date("d-m-Y");
	else $interface.= @$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button id=btnShow value="��������" class=but3 onclick="DoReload(\'order_payment\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=25 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_4'].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=����� class=but3 id=btnSearch  onclick="DoReload(\'order_payment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
      require("../payment/admin_payment.php");
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=OrderPayment($var1,$var2,$var3);
	  else $interface=$UserChek->BadUserForma();
	  break;
	   
	  // ������� �������
	  case("order_status"):
      require("../order/admin_status.php");
	  if(CheckedRules($UserStatus["visitor"],0) == 1)  
	  $interface.=OrderStatus($var1,$var2,$var3,$var4);
	  else $interface=$UserChek->BadUserForma();
	  break;
	   
	  // ��������
	  case("news_writer"):
      require("../mail/admin_news_writer.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= News_writer();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // �������
	  case("servers"):
      require("../servers/admin_servers.php");
	  if(CheckedRules($UserStatus["servers"],0) == 1) $interface= Servers();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // ��������
	  case("delivery"):
      require("../delivery/admin_delivery.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= Delivery();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // ������
	  case("valuta"):
      require("../system/adm_system_valuta.php");
	  if(CheckedRules($UserStatus["valuta"],0) == 1) $interface= Valuta();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // ������
	  case("discount"):
      require("../discount/admin_discount.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= Discount();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // �������� ����
	  case("csv1c"):
	  if(CheckedRules($UserStatus["sql"],1) == 1){
	  @$interface.='
	  <TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4>������ �������� �������� ���� 1�:�����������</h4></div>
<FIELDSET>

<FORM name=csv_upload action="" method=post encType=multipart/form-data>
<table cellpadding="10" align="center">
<tr>
	<td>
	�������� ���� � ����������� *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase1C(this.form.csv_file,\'predload\')" type=button value=OK><br>
<INPUT class=but type=reset value=�����> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>
<tr>
   <td colspan="2">
     <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><u>�</u>�����, ���������� �������� ����� ��������/���������</LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_1" checked> ������������&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_2" > ������� ��������&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_3" > ��������� ��������&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_4" > ��������� ��������&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_5" > ������� ��������&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_6" checked> ����1&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_7" checked> ����2&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_8" checked> ����3&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_9" checked> ����4&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_10" checked> ����5&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_11" checked> �����&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_12" checked disabled> ���&nbsp;&nbsp;
</div>
</div>
</FIELDSET>
   </td>
</tr> 
</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="100%" ><h4>��� ��������</h4>
<ol>
    <li><strong>��� 1</strong> - ��������� <a href="http://www.phpshop.ru/docs/1c.html" target="_blank">���������� ����� 1C-PHPShop</a> (7.7,8.0,8.1)
    <li><strong>��� 2</strong> - � ��������� 1�:����������� � ���� "���� -> �������" ������� ��������� ����������
    <li><strong>��� 3</strong> - ��������� �������� ���� �������� "���������"
	<li><strong>��� 4</strong> - ������� ������� ����������� ���� ���� � ����������� *.csv
	<li><strong>��� 5</strong> - ������� ��������� � ������������� �����
	<li><strong>��� 6</strong> - ��������� ���������� ��������
	<li><strong>��� 7</strong> - ������� � ������ "������� - ����������� ������ - 1�:�����������"
    <li><strong>��� 8</strong> - �������� ������� ������ � �������� ����� ��� �������� ������ "� ����������� - ��������� � �������". ���� ���������,  ��������� ��������������� ��������.
</ol></td>
</tr>
<tr>
   <td valign="top"><h4>��������!</h4>
����������� ���������� �������������� ����������� ������ �� ���������
 �������� �� ��������.</td>
</tr>
</table>
<div align="right" style="padding:10">';
if($SysValue['pro']['enabled'] == "true")
@$interface.='
<BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin(\'./1c/seamply_base_1c.csv\',500,370)">
<img src="./img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
������� ������ �����
</BUTTON>
</div>
</TD></TR></TABLE>
	  ';
	  }
	  else $interface = $UserChek->BadUserForma();
	  break;
	  
	 // �������� ����
	  case("csv_base"):
	  if(CheckedRules($UserStatus["sql"],1) == 1)
     @$interface.=('

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang id=txtLang>������ �������� �������� ���� Excel</span></h4></div>
<FIELDSET>

<FORM name=csv_upload  method=post encType=multipart/form-data>
<table cellpadding="10" align="center">
<tr>
	<td>
	<span name=txtLang id=txtLang>�������� ���� � �����������</span> *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase(this.form.csv_file,\'predload\')" type=button value=OK><br>
<INPUT class=but type=reset name="btnLang" value=�����> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>

<tr>
   <td colspan="2">
      <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����, ���������� �������� ����� ��������/���������</span></LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_1" checked> <span name=txtLang id=txtLang>������������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_2" checked> <span name=txtLang id=txtLang>������� ��������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_3" checked> <span name=txtLang id=txtLang>��������� ��������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_4" checked> <span name=txtLang id=txtLang>��������� ��������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_5" checked> <span name=txtLang id=txtLang>������� ��������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_6" checked> <span name=txtLang id=txtLang>����1&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_7" checked> <span name=txtLang id=txtLang>����2&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_8" checked> <span name=txtLang id=txtLang>����3&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_9" checked> <span name=txtLang id=txtLang>����4&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_10" checked> <span name=txtLang id=txtLang>����5&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_11" checked> <span name=txtLang id=txtLang>�����&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_13" checked> <span name=txtLang id=txtLang>�������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_14" checked> <span name=txtLang id=txtLang>���������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_15" checked> <span name=txtLang id=txtLang>��������������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_12" checked> <span name=txtLang id=txtLang>���&nbsp;&nbsp;</span>
</div>
</div>
</FIELDSET>
   </td>
</tr> 

</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="100%" ><h4><span name=txtLang id=txtLang>��� ��������</span></h4>
<ol>
    <li><span name=txtLang id=txtLang><strong>��� 1</strong> - ������� ������ ����� (��. ����)</span>
	<li><span name=txtLang id=txtLang><strong>��� 2</strong> - ������� ������� ����������� ����</span>
	<li><span name=txtLang id=txtLang><strong>��� 3</strong> - ������� ��������� � ������������� �����</span>
	<li><span name=txtLang id=txtLang><strong>��� 4</strong> - ��������� ���������� ��������</span>
	<li><span name=txtLang id=txtLang><strong>��� 5</strong> - ������� � ������ "������� - ����������� ������ - ���� Excel"</span>
    <li><span name=txtLang id=txtLang><strong>��� 6</strong> - �������� ������� ������ � �������� ����� ��� �������� ������ "� ����������� - ��������� � �������". ���� ���������,  ��������� ��������������� ��������.</span>
</ol></td>
</tr>
<tr>
   <td valign="top"><h4><span name=txtLang id=txtLang>��������!</span></h4>
<span name=txtLang id=txtLang>����������� ���������� �������������� ����������� ������ �� ���������
 �������� �� ��������</span>.</td>
</tr>
</table>
<div align="right" style="padding:10">
<BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin(\'./export/seamply_base.csv\',500,370)">
<img src="./img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
<span name=txtLang id=txtLang>������� ������ �����</span>
</BUTTON>
</div>




</TD></TR></TABLE>

   ');
      else $interface = $UserChek->BadUserForma();
      break;
	  
	   
	  // �������� ������
	  case("csv"):
	  if(CheckedRules($UserStatus["sql"],1) == 1)
     @$interface.=('

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>
<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang id=txtLang>������ �������� ������ Excel (������� ������)</span></h4>
<p><span name=txtLang id=txtLang>�������� ������ ���������� ������, ��� �������� ����� ������� <br>
�������������� ������� <a href="javascript:DoReload(\'csv_base\')"><img src="img/i_eraser[1].gif" title="" width="16" height="16" border="0" hspace="3" align="absmiddle">"�������� ���� Excel"</a>
</span></p>
</div>
<FIELDSET>
<table cellpadding="10" align="center">
<FORM name=csv_upload method=post encType=multipart/form-data>
<tr>
	<td>
	<span name=txtLang id=txtLang>�������� ���� � �����������</span> *.csv<br>
	<INPUT type=file size=80 name=csv_file>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoad(this.form.csv_file,\'predload\',null,\'csv\')" type=button value=OK><br>
<INPUT class=but name="btnLang" type=reset value=�����> 
<input type="hidden" name="load" value="ok">
	</td>
</tr>
</table>

</FIELDSET>
<p><br></p>
<table style="border: 1px;border-style: inset;" cellpadding="10">
<tr>
	<td width="350" ><h4><span name=txtLang id=txtLang>��� ��������</span></h4>
<ol>
	<li><span name=txtLang id=txtLang><strong>��� 1</strong> - ������� ������� ����������� �����</span>
	<li><span name=txtLang id=txtLang><strong>��� 2</strong> - ������� ��������� � ������������� ������</span>
	<li><span name=txtLang id=txtLang><strong>��� 3</strong> - ��������� ���������� ��������</span>
</ol></td>
    <td></td>
	<td valign="top"><h4><span name=txtLang id=txtLang>��������</span>!</h4>
<span name=txtLang id=txtLang>����������� ���������� �������������� ����������� ������ �� ���������
 �������� �������� ������</span>.</td>
</tr>
</table>
</TD></TR></TABLE>

   ');
      else $interface = $UserChek->BadUserForma();
      break;
	   
	  // �������
	  case("shopusers_status"):
	  require("../shopusers/admin_status.php");
	  if(CheckedRules($UserStatus["discount"],0) == 1) $interface= ShopUsersStatus();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // ������
      case("stats1"):
	  require("../report/admin_stats1.php");
	  $a_button=18;
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=Stats1($var1,$var2,$var3,$var4);
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // �������������� ����=���
      case("sort_group"):
	  require("../sort/admin_sort.php");
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=SortsGroup();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	   
	  // ��������������
      case("sort"):
	  require("../sort/admin_sort.php");
	  if(CheckedRules($UserStatus["cat_prod"],0) == 1) $interface=Sorts();
	  else $interface = $UserChek->BadUserForma();
      break;
	   
	  // �����
      case("page_menu"):
	  require("../menu/admin_menu.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface=Menu();
	  else $interface = $UserChek->BadUserForma();
      break;


      // ������
      case("baner"):
	  require("../baner/admin_baner.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface=Baner();
	  else $interface = $UserChek->BadUserForma();
      break;

      // �������
      case("news"):
	  require("../news/admin_news.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td><form name="data_list">
<table cellpadding="0" cellspacing="0">
<tr>
  <td width="5"></td>
	<td>
	 <table cellspacing="0" cellpadding="0" >
 
<tr>
	<td>
    <select class=s name="data_news" id="data_news">
	'.Ras_data().'
	</select>
	<input type=button name="btnLang" value=��������� class=but3 onclick="Ras(data_news.value,400,200)">
	<input type=hidden name=p value=news>
	</td>
</tr>
</table>

	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but2" class="butoff"><img src="icon/page_new.gif" name="imgLang" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'news/adm_news_new.php\',630,630)"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=News();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // ������ ������
      case("search_jurnal"):
	  require("../report/admin_search_jurnal.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	else $interface.=@$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
		<input type=button name="btnLang" value=�������� class=but3 onclick="DoReload(\'search_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>� �����������</option>
			<option value="15" id=txtLang>�������� � ��������� ����</option>
			<option value="16" id=txtLang>������� �� �������</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	   <td id="but2" class="butoff"><img src="icon/page_go.gif" name="imgLang" title="������������ ������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="DoReload(\'search_pre\')"></td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["users"],0) == 1) $interface.=SearchJurnal($var1,$var2);
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // ������������� ������
      case("search_pre"):
	  require("../report/admin_search_pre.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td id="but2" class="butoff"><img src="icon/page_add.gif" name="imgLang" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'report/adm_pre_new.php\',400,380)"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id="txtLang">� �����������</option>
			<option value="17" id="txtLang">������� �� ����</option>
			<option value="18" id="txtLang">�������������</option>
			<option value="19" id="txtLang">�������������</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	   <td id="but1" class="butoff"><img src="icon/page_find.gif" name="imgLang" title="������ ������" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="DoReload(\'search_jurnal\')"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["stats1"],0) == 1) $interface.=SearchPre();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // ������ ������
      case("users_jurnal_black"):
	  require("../users/admin_users.php");
	  if(CheckedRules($UserStatus["users"],0) == 1) $interface.=UsersJurnalBlack();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // ������ �����������
      case("users_jurnal"):
	  require("../users/admin_users.php");
	  $interface='
	  <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.=date("d-m-Y");
	 else {$interface.= @$var2;}
	$interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button name="btnLang" value=�������� class=but3 onclick="DoReload(\'users_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but23"  class="butoff"><img src="icon/vcard_delete.gif" name="imgLang" title="������ ������" width="16" height="16" border="0" onmouseover="ButOn(23)" onmouseout="ButOff(23)" onclick="DoReload(\'users_jurnal_black\')"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
	  if(CheckedRules($UserStatus["users"],0) == 1)   
	    $interface.=UsersJurnal($var1,$var2);
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // ������
      case("opros"):
	  require("../opros/admin_opros.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Opros();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // ������
      case("links"):
	  require("../link/admin_links.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Links();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
	  // ������
      case("gbook"):
	  require("../gbook/admin_gbook.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Gbook();
	  else  $interface = $UserChek->BadUserForma();
      break;
	  
	  
	  // ��������������
      case("users"):
	  require("../users/admin_users.php");
	  if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Users();
	  else $interface = $UserChek->BadUserForma();
      break;
	  
      // �������������� ������������
      case("shopusers"):
$interface=('
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>� �����������</option>
			<option value="20" id=txtLang>�������������</option>
			<option value="21" id=txtLang>��������������</option>
			<option value="22" id=txtLang>������� �� ����</option>
			<option value="222" id=txtLang>��������� ���������</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>	
	<input type=text name="words" id="words" size=30 class=s onMouseMove="show(\'[ '.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help'][5].'\')" onMouseOut="hide()" onfocus="hide()">
	<input type=button value=����� class=but3 name="btnLang"  onclick="DoReload(\'shopusers\',document.getElementById(\'words\').value)"></td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	 <td id="but2" class="butoff"><img name="imgLang" src="icon/blank.gif" alt="" width="1" height="1" border="0"><img src="icon/group_add.gif" name="imgLang" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'shopusers/adm_users_new.php\',500,560)"></td>
<td width="5"></td>
<td id="but39" class="butoff"><img src="icon/folder_key.gif" name="imgLang" title="������� �������������" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'shopusers_status\')"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
    <td width="5"></td>
	<td><span name=txtLang id=txtLang>������</span>: '.GetUsersStatusForma($var2).'</td>

	   
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
');
     require("../shopusers/admin_users.php");
	 if(CheckedRules($UserStatus[$p],0) == 1) $interface.=ShopUsers($var2,$var1);
	 else $interface=$UserChek->BadUserForma();
	 break;
	 
	 // ������� �������
	 case("cat_prod"):
	 $interface='
	 <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>
<form method="post" name="search">
<table cellpadding="0" cellspacing="0">
<tr>
<td width="7"></td>
<td><span name=txtLang id=txtLang>�����</span>: 
	<input type=text name="words" size=50 class=s  onMouseMove="show(\'[ ���������]\', \''.$SysValue['Lang']['Help'][6].'\')" onMouseOut="hide()" onfocus="hide()">
	<input type=button id=btnShow value=�������� class=but3 onclick="SearchProducts(search.words.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
   
	<td id="but1"  class="butoff"><img src="icon/blank.gif" name="imgLang" title="" width="1" height="1" border="0"><img name="imgLang" src="icon/folder_add.gif" title="����� �������"  width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="miniWin(\'catalog/adm_catalog_new.php\',650,630);return false;"></td>
   <td width="3"></td>
	<td id="but2" class="butoff"><img name="imgLang" src="icon/page_new.gif" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="NewProduct()"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
   <td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" title="������������� ����������" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalog()"></td>
<td width="3"></td>
      <td id="but38" class="butoff"><img name="imgLang" src="icon/layout_content.gif" title="����� ���� �������" width="16" height="16" border="0" onmouseover="ButOn(38)" onmouseout="ButOff(38)" onclick="AllProducts()"></td>
  <td width="3"></td>
<td id="but39"  class="butoff"><img name="imgLang" src="icon/icon_component.gif" title="��������������" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'sort\')"></td>
  <td width="3"></td>
  <td id="buttable_sort" class="butoff"><img name="imgLang" src="icon/table_sort.gif" title="����������� �������������" width="16" height="16" border="0" onmouseover="ButOn(\'table_sort\')" onmouseout="ButOff(\'table_sort\')" onclick="CalcSort()"></td>
     <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
<select name="action" size="1" onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)" id="actionSelect">
		<option id="txtLang" value="0" SELECTED>� �����������:</option>
		<optgroup id="txtLang" label="��������" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="14" STYLE="background: #fff">��������� � �������</option>
		<option id="txtLang" value="9" STYLE="background: #fff">������� �����</option>
		<option id="txtLang" value="23" STYLE="background: #fff">������� �� ��������</option>
        <option id="txtLang" value="24" STYLE="background: #fff">������� � ���������������</option>
		<option id="txtLang" value="8" STYLE="background: #fff">������� � Excel</option>
		</optgroup> 
		<optgroup id="txtLang" label="�������" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="10" STYLE="background: #fff">�������� � �������</option>
		<option id="txtLang" value="11" STYLE="background: #fff">������ �� �������</option>
		</optgroup> 
		<optgroup id="txtLang" label="���������������" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="2" STYLE="background: #fff">�������� � ���������������</option>
		<option id="txtLang" value="3" STYLE="background: #fff">������ �� ���������������</option>
		</optgroup>
		<optgroup id="txtLang" label="�����" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="27" STYLE="background: #fff">��� � �������</option>
		<option id="txtLang" value="28" STYLE="background: #fff">���� � �������</option>
		<option id="txtLang" value="4" STYLE="background: #fff">��������� �����</option>
		<option id="txtLang" value="5" STYLE="background: #fff">�������� �����</option>
		<option id="txtLang" value="1" STYLE="background: #fff">������� �� ����</option>
		</optgroup> 
		<optgroup id="txtLang" label="YML ������ ������" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="6" STYLE="background: #fff">������ �� YML ������</option>
		<option id="txtLang" value="7" STYLE="background: #fff">�������� � YML �����</option>
		</optgroup> 
		

</select>
	</td>
	<td width="5"></td>
	<td>
	<input type="radio" name="DoAll" value="1" onclick="SelectAll(this,window.frame2.document.form_flag,1000)" id="DoAll"><span name=txtLang id=txtLang>�������� ���</span></input>
	</td>
	<td width="5"></td>
	<td>
	<input type="radio" name="DoAll" value="2" onclick="SelectAll(this,window.frame2.document.form_flag,1000)"><span name=txtLang id=txtLang>����� �������</span>    
	</td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
	 require("../catalog/admin_catalog.php");
	 $a_button=0;
	 if(CheckedRules($UserStatus[$p],0) == 1) $interface.=Catalog();
	 else $interface=$UserChek->BadUserForma();
	 break;
	 

	 
	 // ��������
	 case("page_site_catalog"):
	 $interface='
	 <form method="post" name="search">
	 <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>

<table cellpadding="0" cellspacing="0">
<tr>
    <td width="10"></td>
<td><span name=txtLang id=txtLang>����� ��������</span>: 
	<input type=text name="words" size=50 class=s  onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['4'].'\')" onMouseOut="hide()" onfocus="hide()">
	<input name="btnLang" type=button value=�������� class=but3 onclick="SearchPage(search.words.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
    <td id="but23"  class="butoff"><img name="imgLang" src="icon/page_new.gif" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(23)" onmouseout="ButOff(23)" onclick="NewProductPage()">
    </td>
    <td width="3"></td>
	<td id="but1"  class="butoff"><img name="imgLang" src="icon/folder_add.gif" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="miniWin(\'page/adm_catalog_new.php\',\'500\',\'320\')"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	<td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" title="������������� ����������" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalogPage()"></td>
<td width="3"></td>
      <td id="but38" class="butoff"><img name="imgLang" src="icon/layout_content.gif" title="����� ���� �������" width="16" height="16" border="0" onmouseover="ButOn(38)" onmouseout="ButOff(38)" onclick="AllPage()"></td>
   <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   
   <select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>� �����������</option>
			<option value="30" id=txtLang>�������� �����</option>
			<option value="31" id=txtLang>��������� �����</option>
			<option value="32" id=txtLang>�������� �����������</option>
			<option value="33" id=txtLang>��������� �����������</option>
			<option value="34" id=txtLang>��������� � �������</option>
			<option value="35" id=txtLang>�������� ��������������� ������</option>
			<option value="39" id=txtLang>������� �� ����</option>
   </select>
   </td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>';
	 require("../page/admin_page_catalog.php");
	 if(CheckedRules($UserStatus["page_site"],0) == 1) $interface.=SiteCatalog();
	 else $interface=$UserChek->BadUserForma();
	 break;



	 

	 // �� ������� ������ ������
	 case("orders"):
	 $a_button=3;
	 //${"list_".$var4.""}="SELECTED";
	 $interface='
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;" height="10">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="'.@$var1.'" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_1'].'\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td><input type="text" style="width:80" value="';
	if(!$var2) $interface.= date("d-m-Y");
	else $interface.= @$var2;
	$interface.='" name="pole2" onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_2'].'\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle">
	</td>
	<td>
	<input type=button id=btnShow value="��������" class=but3 onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" size=50 class=s onMouseMove="show(\'['.$SysValue['Lang']['Help']['Help'].']\', \''.$SysValue['Lang']['Help']['forma_3'].'\')" onMouseOut="hide()" onfocus="hide()" value="'.$var3.'">
	<input type=button value=����� class=but3 id=btnSearch  onclick="DoReload(\'orders\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
   <span name=txtLang id=txtLang>������</span>: '.GetOrderStatusApi($var4).'
   <input type=button id=btnStatus value="��������" class=but3 onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value,\'\',list.value)">
   </td>
    <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
    <td width="3"></td>
	    <td id="but30"  class="butoff"><img name="imgLang" src="icon/coins.gif" title="����������� �������" width="16" height="16" border="0" onmouseover="ButOn(30)" onmouseout="ButOff(30)" onclick="DoReload(\'order_payment\')"></td>
    <td width="3"></td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
<table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
	
   <td>
   <table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>
   	<img name="iconLang" src="icon/plugin.gif" width="16" height="16" border="0"  align="absmiddle" hspace="1">
<a href="javascript:LoadAgent()" class="blue" title="�������� � �������������� ������� �� ������� ����� Windows" id="txtLoadExe">��������� Order Agent Windows</a>
   </td>
	<td align="right">
	<select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>� �����������</option>
			<option value="36" id=txtLang>������� �� ����</option>
			<option value="37" id=txtLang>�������� ������</option>
			<option value="38" id=txtLang>������� �����</option>
   </select>

	</td>
	  
</td>
</tr>
</table>
   </td>
</tr>
</table>

	 ';
	 require("../order/admin_visiter.php");
	 if(CheckedRules($UserStatus["visitor"],0) == 1) $interface.=Visitor($var1,$var2,$var3,$var4);
	 else $interface=$UserChek->BadUserForma();
	 break;
}



// ��������� ��������� 
$_RESULT = array(
  "q"     => $q,
  "xid"   => $interface,
  "tit"   => $ProductName." -> ".$SysValue['Lang']['Title']['admpanel']." -> ".$SysValue['Lang']['Title'][$p],
  'hello' => isset($_SESSION['hello'])? $_SESSION['hello'] : null
); 
?>