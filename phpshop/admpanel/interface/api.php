<?php

// ���������� ���������� ���������.
require_once "../../lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");

// �������� ������.
$q = @$_REQUEST['q'];
$xid = @$_REQUEST['xid'];
$p = @$_REQUEST['page'];
$var1 = @$_REQUEST['var1'];
$var2 = @$_REQUEST['var2'];
$var3 = @$_REQUEST['var3'];
$var4 = @$_REQUEST['var4'];
$tit = @$_REQUEST['tit'];


require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");


// �����
require("../language/russian/language.php");
$str = array(
    "time" => date("U"),
    "log" => $_SESSION['logPHPSHOP'],
    "pas" => $_SESSION['pasPHPSHOP']);
$str = serialize($str);
$code = base64_encode($str);
$code2 = str_replace("7", "!", $code);
$F = str_replace("O", "$", $code2);


// ������� ���������
switch ($p) {


    // ��������
    case("rating"):
        require("../rating/admin_rating.php");
        if (CheckedRules($UserStatus[$p], 0) == 1)
            $interface.=Rating();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // �����������
    case("comment"):
        require("../comment/admin_comment.php");
        $interface = '
	  <table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
<input type="text" style="width:80" value="';
        if (!$var1)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var1;
        $interface.='" name="pole1" onMouseMove="show(\'[' . $SysValue['Lang']['Help']['Help'] . ']\', \'' . $SysValue['Lang']['Help']['forma_1'] . '\')" onMouseOut="hide()" onfocus="hide()">

</td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.=date("d-m-Y");
        else {
            $interface.= @$var2;
        }
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	<input type=button value=�������� class="but small" onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
    <td>	
	<input type=text name="words" id="words" size=30 class=s onMouseMove="show(\'[ ' . $SysValue['Lang']['Help']['Help'] . ']\', \'' . $SysValue['Lang']['Help'][5] . '\')" onMouseOut="hide()" onfocus="hide()" value="' . $var3 . '">
	<input type=button value=����� class="but small" name="btnLang"  onclick="DoReload(\'comment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'words\').value)"></td>
<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED id=txtLang>� �����������</option>
			<option value="43" id=txtLang>�������������� �����</option>
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
        if (CheckedRules($UserStatus["gbook"], 0) == 1)
            $interface.=Comment($var1, $var2, $var3);
        else
            $interface = $UserChek->BadUserForma();
        break;


    // �����������
    case("shopusers_notice"):
        require("../shopusers/admin_notice.php");
        $interface = '
	  <table width="100%" cellpadding="0" cellspasing="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="' . @$var1 . '">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle"  class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.=date("d-m-Y");
        else
            $interface.=@$var2;
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	<input type=button value=�������� class="but small" onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach"  id="order_serach" size=30 value="' . $var3 . '">
	<input type=button value=����� class="but small" onclick="DoReload(\'shopusers_notice\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
        <td width="10"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
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
		<input type=button value="�������������� �����������" class="but long" onclick="miniWin(\'./window/adm_window.php?do=29\',300,300)">
	</td>
</tr>

</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=ShopUsersNotice($var1, $var2, $var3);
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ��������� �������������
    case("shopusers_messages"):
        require("../shopusers/admin_messages.php");
        if (CheckedRules($UserStatus["shopusers"], 0) == 1)
            $interface = Shopusers_messages();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ������� ������
    case("payment"):
        require("../payment/admin_payment.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=OrderPayment();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ����������� �������
    case("order_payment"):
        $interface = '
<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="' . @$var1 . '">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var2;
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	<input type=button id=btnShow value="��������" class="but small" onclick="DoReload(\'order_payment\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" id="order_serach" size=30  value="' . $var3 . '">
	<input type=button value=����� class="but small" onclick="DoReload(\'order_payment\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
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
        require("../payment/admin_webpayment.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=OrderPayment($var1, $var2, $var3);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ������� �������
    case("order_status"):
        require("../order/admin_status.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=OrderStatus($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;


    // �������
    case("servers"):
        require("../servers/admin_servers.php");
        if (CheckedRules($UserStatus["servers"], 0) == 1)
            $interface = Servers();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ��������
    case("delivery"):
        require("../delivery/admin_delivery.php");
        if (CheckedRules($UserStatus["discount"], 0) == 1)
            $interface = Delivery();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������
    case("valuta"):
        require("../valuta/admin_valuta.php");
        if (CheckedRules($UserStatus["valuta"], 0) == 1)
            $interface = Valuta();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������
    case("discount"):
        require("../discount/admin_discount.php");
        if (CheckedRules($UserStatus["discount"], 0) == 1)
            $interface = Discount();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // �������� ����
    case("csv1c"):
        if (CheckedRules($UserStatus["sql"], 1) == 1) {
            @$interface.='
	  <TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang id=txtLang>������ �������� �������� ���� 1�:�����������</span></h4></div>
<FIELDSET>

<FORM name=csv_upload action="" method=post encType=multipart/form-data>
<table cellpadding="10" align="center">
<tr>
	<td>
            <FIELDSET>
	<LEGEND>�������� ���� � ����������� *.csv</LEGEND>
	<INPUT type=file size=80 name="csv_file" id="csv_file" onchange="UpdateFileNameBase1C(this.value)" accept="text/plain">
        </FIELDSET>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase1C(this.form.csv_file,\'predload\')" type=button value=OK>
<input type="hidden" name="load" value="ok">
	</td>
</tr>
<tr>
   <td colspan="2">
    <FIELDSET>
	<LEGEND>��� �����</LEGEND>
	<div style="padding:10">
	<input type="hidden" id="1c_target_check" value="0">
	<input type="radio" name="filename" id="filenamebase" value="base" checked onclick="Option1c(1)"> ������ ������������
	<input type="radio" name="filename" id="filenametree" value="tree" onclick="Option1c(0)"> ������ �������� �����
	<input type="radio" name="filename" id="filenameuser" value="user" onclick="Option1c(2)"> ������ ������������
	</div>
	</FIELDSET>
   </td>
</tr>
   
<tr>
   <td colspan="2" id="pole_1c_option">
     <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����, ���������� �������� ����� ��������/���������</span></LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_1" checked> ������������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_2" > <span name=txtLang id=txtLang>������� ��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_3" > <span name=txtLang id=txtLang>��������� ��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_4" > <span name=txtLang id=txtLang>��������� ��������</span>&nbsp;&nbsp;<br>
<input type="checkbox" value="1" id="tip_5" > <span name=txtLang id=txtLang>������� ��������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_6" checked> <span name=txtLang id=txtLang>����1</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_7" checked> <span name=txtLang id=txtLang>����2</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_8" checked> <span name=txtLang id=txtLang>����3</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_9" checked> <span name=txtLang id=txtLang>����4</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_10" checked> <span name=txtLang id=txtLang>����5</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_11" checked> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;<br>
<input type="checkbox" value="1" id="tip_14" checked> <span name=txtLang id=txtLang>���������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_15" checked> <span name=txtLang id=txtLang>��������������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_12" checked disabled> <span name=txtLang id=txtLang>���</span>&nbsp;&nbsp;
</div>
</div>
</FIELDSET>
   </td>
</tr> 
<tr>
   <td colspan="2" id="pole_user_option" style="display:none">
     <FIELDSET id=fldLayout >
<LEGEND id=lgdLayout><span name=txtLang id=txtLang><u>�</u>�����, ���������� �������� ����� ��������/���������</span></LEGEND>
<div style="padding:10">
<input type="checkbox" value="1" id="tip_16" checked> ������������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_17" checked> <span name=txtLang id=txtLang>���</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_18" checked> <span name=txtLang id=txtLang>���</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_19" checked> <span name=txtLang id=txtLang>�����</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_20" checked> <span name=txtLang id=txtLang>�������</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_21" checked> <span name=txtLang id=txtLang>E-mail</span>&nbsp;&nbsp;
<input type="checkbox" value="1" id="tip_22" checked> <span name=txtLang id=txtLang>���������� ����</span>&nbsp;&nbsp;<br>
<input type="checkbox" value="1" id="tip_23"> <span name=txtLang id=txtLang>��������� ����� ������������� ����������� � ������������</span>&nbsp;&nbsp;
<!--- <select name="userAction">
<option value="add" SELECTED>�������</option>
<option value="update">��������</option>
</select> --->
</div>
</div>
</FIELDSET>
   </td>
</tr> 
</table>

</FIELDSET>


<div align="right" style="padding:10">
<BUTTON class="help" onclick="initSlide(0);loadhelp();">�������</BUTTON>
</div>
</TD></TR></TABLE>
	  ';
        }
        else
            $interface = $UserChek->BadUserForma();
        break;

    // �������� ����
    case("csv_base"):
        if (CheckedRules($UserStatus["sql"], 1) == 1)
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
        <FIELDSET>
	<LEGEND>�������� ���� � ����������� *.csv</LEGEND>
	<INPUT type="file" name="csv_file">
        </FIELDSET>
	</td>
	
	<td align="right">
	<INPUT class=but onclick="DoLoadBase(this.form.csv_file,\'predload\')" type=button value=OK>
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
<input type="checkbox" value="1" id="tip_17" checked> <span name=txtLang id=txtLang>���. ���������&nbsp;&nbsp;</span>
<input type="checkbox" value="1" id="tip_12" checked disabled> <span name=txtLang id=txtLang>���&nbsp;&nbsp;</span>
������: ' . ChoiceValuta() . ' 
</div>
</div>
</FIELDSET>
   </td>
</tr> 

</table>

</FIELDSET>
<p><br></p>
        <FIELDSET>
	<LEGEND>����������</LEGEND>
<ol>
    <li><BUTTON style="width: 20em; height: 2.2em; "  onclick="miniWin(\'./export/seamply_base.csv\',500,370)">
<img src="./img/action_save.gif" width="16" height="16" border="0" align="absmiddle" hspace="3">
������� ������ �����
</BUTTON>
	<li>������� ������� ����������� ����
	<li>������� ��������� � ������������� �����
	<li>��������� ���������� ��������
	<li>������� � ������ "������� - ����������� ������ - ���� Excel". ���� � ����� ��������� ������� ��������� ������, �� �� ���� ����� �������� ���������.
    <li>�������� ������� ������ � �������� ����� ��� �������� ������ "� ����������� - ��������� � �������". ���� ���������,  ��������� ��������������� ��������.
</ol>
        </FIELDSET>

<div align="right" style="padding:10">
<BUTTON class="help" onclick="initSlide(0);loadhelp();">�������</BUTTON>

</div>




</TD></TR></TABLE>

   ');
        else
            $interface = $UserChek->BadUserForma();
        break;


    // �������� ������
    case("csv"):
        if (CheckedRules($UserStatus["sql"], 1) == 1)
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
<legend>�������� ���� � �����������  *.csv</legend>
<FORM name=csv_upload method=post encType=multipart/form-data>
<table cellpadding="10">
<tr>
	<td>
	<span name=txtLang id=txtLang>
	<INPUT type=file name=csv_file>
	</td>
	<td align="right">
	<INPUT class=but onclick="DoLoad(this.form.csv_file,\'predload\',null,\'csv\')" type=button value=OK>
<input type="hidden" name="load" value="ok">
	</td>
</tr>
</table>
</FORM>
</FIELDSET>
<p><br></p>
<FIELDSET>
<legend>����������</legend>
<ol>
	<li>������� ������� ����������� �����-����
	<li>������� ��������� � ������������� ������
	<li>��������� ���������� ��������
</ol>
</FIELDSET>
 <div align="right">
<BUTTON class="help" onclick="initSlide(0);loadhelp();">�������</BUTTON>
</div>
 </td>
</tr>
</table>
</TD></TR></TABLE>


   ');
        else
            $interface = $UserChek->BadUserForma();
        break;

    // �������
    case("shopusers_status"):
        require("../shopusers/admin_status.php");
        if (CheckedRules($UserStatus["discount"], 0) == 1)
            $interface.= ShopUsersStatus();
        else
            $interface = $UserChek->BadUserForma();
        break;

    case("rssgraber_chanels"):

        $interface = '

<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
	
   <td>

   <table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td>
	&nbsp;
   </td>
	<td align="right">
	
	<select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>� �����������</option>
			<option value="rss1" id=txtLang>�������</option>
			<option value="rss2" id=txtLang>��������</option>
			<option value="rss3" id=txtLang>���������</option>
			<option value="rss4" id=txtLang>��������� � ������ ����</option>
   </select>

	</td>
	  
</td>
</tr>
</table>

   </td>
</tr>
</table>

	 ';


        require("../rssgraber/admin_chanels.php");
        if (CheckedRules($UserStatus["rsschanels"], 0) == 1)
            $interface.= RSSchanels();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ������
    case("stats1"):
        require("../report/admin_stats1.php");
        $a_button = 18;
        if (CheckedRules($UserStatus["stats1"], 0) == 1)
            $interface = Stats1($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // �������������� ������
    case("sort_group"):
        require("../sort/admin_sort.php");
        if (CheckedRules($UserStatus["cat_prod"], 0) == 1)
            $interface = SortsGroup();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ��������������
    case("sort"):
        require("../sort/admin_sort.php");
        if (CheckedRules($UserStatus["cat_prod"], 0) == 1)
            $interface = Sorts();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������ ������
    case("search_jurnal"):
        require("../report/admin_search_jurnal.php");
        $interface = '
	  <table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="' . @$var1 . '" onMouseMove="show(\'[' . $SysValue['Lang']['Help']['Help'] . ']\', \'' . $SysValue['Lang']['Help']['forma_1'] . '\')" onMouseOut="hide()" onfocus="hide()">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.=date("d-m-Y");
        else
            $interface.=@$var2;
        $interface.='" name="pole2" onMouseMove="show(\'[' . $SysValue['Lang']['Help']['Help'] . ']\', \'' . $SysValue['Lang']['Help']['forma_2'] . '\')" onMouseOut="hide()" onfocus="hide()">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
		<input type=button name="btnLang" value=�������� class=but3 onclick="DoReload(\'search_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED value="0">� �����������</option>
			<option value="15" id=txtLang>�������� � ��������� ����</option>
			<option value="16" id=txtLang>������� �� �������</option>
   </select>
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
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
        if (CheckedRules($UserStatus["users"], 0) == 1)
            $interface.=SearchJurnal($var1, $var2);
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������������� ������
    case("search_pre"):
        require("../report/admin_search_pre.php");
        $interface = '
	  <table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td id="but2" class="butoff"><img src="icon/page_add.gif" name="imgLang" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'report/adm_pre_new.php\',400,380)"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
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
	<td width="1" bgcolor="#808080" class="separator"></td>
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
        if (CheckedRules($UserStatus["stats1"], 0) == 1)
            $interface.=SearchPre();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������ ������
    case("users_jurnal_black"):
        require("../users/admin_users.php");
        if (CheckedRules($UserStatus["users"], 0) == 1)
            $interface.=UsersJurnalBlack();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ������ �����������
    case("users_jurnal"):
        require("../users/admin_users.php");
        $interface = '
	  <table width="100%" cellpadding="0" cellspacing="1" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><input type="text" style="width:80" name="pole1" value="' . @$var1 . '">
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.=date("d-m-Y");
        else {
            $interface.= @$var2;
        }
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" v>
	</td>
	<td>
	<input type=button name="btnLang" value=�������� class="but small" onclick="DoReload(\'users_jurnal\',calendar.pole1.value,calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="5"></td>
    <td class="butoff"><img src="icon/vcard_delete.gif" name="imgLang" title="������ ������" width="16" height="16" border="0" onclick="DoReload(\'users_jurnal_black\')"></td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	  ';
        if (CheckedRules($UserStatus["users"], 0) == 1)
            $interface.=UsersJurnal($var1, $var2);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ������
    case("opros"):
        require("../opros/admin_opros.php");
        if (CheckedRules($UserStatus[$p], 0) == 1)
            $interface.=Opros();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ��������������
    case("users"):
        require("../users/admin_users.php");
        if (CheckedRules($UserStatus[$p], 0) == 1)
            $interface.=Users();
        else
            $interface = $UserChek->BadUserForma();
        break;

    // �������������� ������������
    case("shopusers"):
        $interface = ('
<table width="100%" cellpadding="0" cellspacing="1" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td align="left" >	
	
	<table cellpadding="0" cellspacing="0">
<tr>
	<td >

	<input type=text name="words" id="words" size=50>
	<input type=button value=����� class="but small" name="btnLang"  onclick="DoReload(\'shopusers\',document.getElementById(\'words\').value)"></td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="5"></td>
	 <td id="but2" class="butoff"><img name="imgLang" src="icon/blank.gif" alt="" width="1" height="1" border="0"><img src="icon/group_add.gif" name="imgLang" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="miniWin(\'shopusers/adm_users_new.php\',500,570)"></td>
<td width="5"></td>
<td id="but39" class="butoff"><img src="icon/folder_key.gif" name="imgLang" title="������� �������������" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'shopusers_status\')"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
    <td width="5"></td>
	<td><span name=txtLang id=txtLang>������</span>: ' . GetUsersStatusForma($var2) . '</td>
    <td width="10"></td>
	</td>
</tr>
</table>

   <td align="right">
   <select name="action" size="1" onchange="DoWithSelect(this.value,form_flag,1000)">
			<option SELECTED value="0">� �����������</option>
			<option value="20" id=txtLang>�������������</option>
			<option value="21" id=txtLang>��������������</option>
			<option value="22" id=txtLang>������� �� ����</option>
			<option value="222" id=txtLang>��������� ���������</option>
   </select>
   </td>
   <td width="3">
  <td width="10" id=pane align=center style="padding:0px"><input type=checkbox value=1 name=DoAll onclick="SelectAllBox(this,form_flag)"></td>   
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
');
        require("../shopusers/admin_users.php");
        if (CheckedRules($UserStatus[$p], 0) == 1)
            $interface.=ShopUsers($var2, $var1);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ������� �������
    case("cat_prod"):
        $interface = '
	 <table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name="search">
<table cellpadding="0" cellspacing="0">
<tr>
<td><span name=txtLang id=txtLang>�����</span>: 
	<input type=text name="words" placeholder="' . $SysValue['Lang']['Help']['6'] . '" size=50 class=s  title="' . $SysValue['Lang']['Help'][6] . '">
	<input type=button value="��������" class="but small" onclick="SearchProducts(search.words.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="5"></td>
   
	<td id="but1"  class="butoff"><img src="icon/blank.gif" name="imgLang" title="" width="1" height="1" border="0"><img name="imgLang" src="icon/folder_add.gif" title="����� �������"  width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="NewProductCatalog();"></td>
   <td width="3"></td>
	<td id="but2" class="butoff"><img name="imgLang" src="icon/page_new.gif" title="����� �������" width="16" height="16" border="0" onmouseover="ButOn(2)" onmouseout="ButOff(2)" onclick="NewProduct()"></td>
	<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="5"></td>
   <td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" title="������������� ����������" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalog()"></td>
<td width="3"></td>
      <td id="but38" class="butoff"><img name="imgLang" src="icon/layout_content.gif" title="����� ���� �������" width="16" height="16" border="0" onmouseover="ButOn(38)" onmouseout="ButOff(38)" onclick="AllProducts()"></td>
  <td width="3"></td>
<td id="but39"  class="butoff"><img name="imgLang" src="icon/icon_component.gif" title="��������������" width="16" height="16" border="0" onmouseover="ButOn(39)" onmouseout="ButOff(39)" onclick="DoReload(\'sort\')"></td>
     <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
<select name="action" size="1"  onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)" id="actionSelect">
		<option id="txtLang" value="0" SELECTED>� �����������:</option>
		<optgroup id="txtLang" label="��������" STYLE="background: #C0D2EC;">
		<option id="txtLang" value="14" STYLE="background: #fff">��������� � �������</option>
		<option id="txtLang" value="9" STYLE="background: #fff">������� �����</option>
		<option id="txtLang" value="23" STYLE="background: #fff">������� �� ��������</option>
        <option id="txtLang" value="24" STYLE="background: #fff">������� � ���������������</option>
		<option id="txtLang" value="8" STYLE="background: #fff">������� � �����-���� Excel</option>
                <option id="txtLang" value="base" STYLE="background: #fff">������� � ���� Excel</option>
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
  <input type="radio" name="DoAll" value="1" onclick="SelectAll(this,window.frame2.document.form_flag)" id="DoAll"><span name=txtLang id=txtLang>�������� ���</span></input>
	</td>
	<td width="5"></td>
	<td>
<input type="radio" name="DoAll" value="2" onclick="SelectAll(this,window.frame2.document.form_flag)"><span name=txtLang id=txtLang>����� �������</span>  
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
        $a_button = 0;
        if (CheckedRules($UserStatus[$p], 0) == 1)
            $interface.=Catalog();
        else
            $interface = $UserChek->BadUserForma();
        break;


    // �� ������� ������ ������
    case("orders"):
        $a_button = 3;
        //${"list_".$var4.""}="SELECTED";
        $interface = '
<table width="100%" cellspacing="0" cellpadding="0" class="iconpane">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
<input type="text" style="width:80" value="';
        if (!$var1)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var1;
        $interface.='" name="pole1" title="' . $SysValue['Lang']['Help']['forma_1'] . '">

</td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80px" value="';
        if (!$var2)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var2;
        $interface.='" name="pole2" title="' . $SysValue['Lang']['Help']['forma_2'] . '">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	<input type=button value="��������" class="but small" onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value)">
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" class="separator"></td>
         <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
	<input type=text name="order_serach" placeholder="' . $SysValue['Lang']['Help']['forma_3'] . '" id="order_serach" size=50 class=s title="' . $SysValue['Lang']['Help']['forma_3'] . '" value="' . $var3 . '">
	<input type=button value="�����"  class="but small"   onclick="DoReload(\'orders\',calendar.pole1.value,calendar.pole2.value,document.getElementById(\'order_serach\').value)">
	</td>
</tr>
</table>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" class="separator"></td>
   <td width="10"></td>
   <td>
   <span name=txtLang id=txtLang>������</span>: ' . GetOrderStatusApi($var4) . '
   <input type=button id=btnStatus value="��������" class="but small" onclick="DoReload(\'orders\',calendar.pole1.value, calendar.pole2.value,\'\',document.getElementById(\'list\').value);">
   </td>
    <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" class="separator"></td>
         <td width="10"></td>
	    <td id="but30"  class="butoff"><img name="imgLang" src="icon/coins.gif" title="����������� �������" width="16" height="16" border="0" onmouseover="ButOn(30)" onmouseout="ButOff(30)" onclick="DoReload(\'order_payment\')"></td>
    <td width="3"></td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-both">
<tr>
	
   <td>
   <table cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td >
   <table cellpadding="0" cellspacing="0">
<tr>
    
	<td>
	<img name="iconLang" src="icon/plugin.gif" width="16" height="16" border="0"  align="absmiddle" hspace="1">
<a href="javascript:LoadAgent()" class="blue" title="�������� � �������������� ������� �  Windows" id="txtLoadExe">���������� Order Agent Windows</a>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" class="separator"></td>
   <td width="10"></td>
	<td>
		<img name="iconLang" src="icon/plugin_blue.gif" width="16" height="16" border="0"  align="absmiddle" hspace="1">
<a href="http://www.phpshop.ru/docs/mobileagent.html" target="_blank" class="blue" title="�������� ������� � ��������� ��������">���������� Order Agent Mobile</a>
	
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" class="separator"></td>
   <td width="10"></td>
	<td>
		<img name="iconLang" src="icon/plugin.gif" width="16" height="16" border="0"  align="absmiddle" hspace="1">
<a href="http://www.phpshop.ru/docs/vistagadget.html" target="_blank" class="blue" title="�������� ������� � ������� ������ Windows">���������� Order Gadget</a>
	
	</td>
	
</tr>
</table>

   	

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
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=Visitor($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ����� �� ��������
    case("orders_stat1"):
        $a_button = 3;
        //${"list_".$var4.""}="SELECTED";
        $interface = '
<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
<input type="text" style="width:80" value="';
        if (!$var1)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var1;
        $interface.='" name="pole1">

</td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var2;
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
            ' . GetOrderStat1Cats($var3) . '
	</td>
</tr>
</table>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <span name=txtLang id=txtLang>��� ����������</span>: ' . GetOrderStat1select($var4) . '
   <span name=txtLang id=txtLang>�����</span>:    <input type="text" id="items_search" name="items_search" style="width:150px" value="">
   <input type=button id=btnStatus value="��������" class="but small" onclick="DoReload(\'orders_stat1\',calendar.pole1.value, calendar.pole2.value,document.getElementById(\'order_serach\').value,document.getElementById(\'list\').value+\'|\'+document.getElementById(\'items_search\').value)";>
   </td>
    <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
    <td width="3"></td>
	    <td id="but30"  class="butoff"><a target="_blank" href="csv/orders_stat1_' . md5(date('y-m-d') . $_SESSION['pasPHPSHOP']) . '.csv"><img name="imgLang" src="icon/page_excel.gif" title="��������� � Excel" width="16" height="16" border="0" onmouseover="ButOn(30)" onmouseout="ButOff(30)"></a></td>
    <td width="3"></td>
	    <td id="but31"  class="butoff"><a href="#" onclick="showGraph();"><img name="imgLang" src="icon/chart_curve.gif" title="��������/������ ������" width="16" height="16" border="0" onmouseover="ButOn(31)" onmouseout="ButOff(31)"></a></td>
    <td width="3"></td>
	
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
        require("../order_stat/order_stat1.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=Visitor($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;

    // ����� �� �����������
    case("orders_stat2"):
        $a_button = 3;
        //${"list_".$var4.""}="SELECTED";
        $interface = '
<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
<input type="text" style="width:80" value="';
        if (!$var1)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var1;
        $interface.='" name="pole1">

</td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var2;
        $interface.='" name="pole2">
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
            ' . GetOrderStat1Cats($var3) . '
	</td>
</tr>
</table>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <input type=button id=btnStatus value="��������" class="but small" onclick="DoReload(\'orders_stat2\',calendar.pole1.value, calendar.pole2.value,document.getElementById(\'order_serach\').value,\'\');">
   </td>
   <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
    <td width="3"></td>
	    <td id="but30"  class="butoff"><a target="_blank" href="csv/orders_stat2_' . md5(date('y-m-d') . $_SESSION['pasPHPSHOP']) . '.csv"><img name="imgLang" src="icon/page_excel.gif" title="��������� � Excel" width="16" height="16" border="0" onmouseover="ButOn(30)" onmouseout="ButOff(30)"></a></td>
    <td width="3"></td>
	    <td id="but31"  class="butoff"><a href="#" onclick="showGraph();"><img name="imgLang" src="icon/chart_curve.gif" title="��������/������ ������" width="16" height="16" border="0" onmouseover="ButOn(31)" onmouseout="ButOff(31)"></a></td>
    <td width="3"></td>
    
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
        require("../order_stat/order_stat2.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=Visitor($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;


    // ����� �� ��������
    case("orders_stat3"):
        $a_button = 3;
        //${"list_".$var4.""}="SELECTED";
        $interface = '
<table width="100%" cellpadding="0" cellpadding="0" class="iconpane border-bottom">
<tr>
<td>
<form method="post" name=calendar>
<table cellpadding="0" cellspacing="0">
<tr>
	<td>
<input type="text" style="width:80" value="';
        if (!$var1)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var1;
        $interface.='" name="pole1">

</td>
	<td>
	<IMG onclick="popUpCalendar(this, calendar.pole1, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td><input type="text" style="width:80" value="';
        if (!$var2)
            $interface.= date("d-m-Y");
        else
            $interface.= @$var2;

        if (!$var4)
            $var4 = 30;

        $interface.='" name="pole2>
	</td>
	<td><IMG onclick="popUpCalendar(this, calendar.pole2, \'dd-mm-yyyy\');" height=16 hspace=3 src="icon/date.gif" width=16 border=0 align="absmiddle" class="icon">
	</td>
	<td>
	</td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
	<td>
	<table cellspacing="0" cellpadding="0" >
<tr>
    <td>
            ' . GetOrderStat1Cats($var3) . '
	</td>
</tr>
</table>
	</td>
        <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <span>��������: </span> <input type="text" name="list" id="list" value="' . $var4 . '" style="width:50px">%
   </td>
	<td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
   <td width="10"></td>
   <td>
   <input type=button id=btnStatus value="��������" class="but small" onclick="DoReload(\'orders_stat3\',calendar.pole1.value, calendar.pole2.value,document.getElementById(\'order_serach\').value,document.getElementById(\'list\').value);">
   </td>
    <td width="10"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080" class="separator"></td>
    <td width="3"></td>
	    <td id="but30"  class="butoff"><a target="_blank" href="csv/orders_stat3_' . md5(date('y-m-d') . $_SESSION['pasPHPSHOP']) . '.csv"><img name="imgLang" src="icon/page_excel.gif" title="��������� � Excel" width="16" height="16" border="0" onmouseover="ButOn(30)" onmouseout="ButOff(30)"></a></td>
    <td width="3"></td>
	    <td id="but31"  class="butoff"><a href="#" onclick="showGraph();"><img name="imgLang" src="icon/chart_curve.gif" title="��������/������ ������" width="16" height="16" border="0" onmouseover="ButOn(31)" onmouseout="ButOff(31)"></a></td>
    <td width="3"></td>   
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
	 ';
        require("../order_stat/order_stat3.php");
        if (CheckedRules($UserStatus["visitor"], 0) == 1)
            $interface.=Visitor($var1, $var2, $var3, $var4);
        else
            $interface = $UserChek->BadUserForma();
        break;

    default:

        if (!empty($p)) {

            $_classPath = './';

            if (empty($var1))
                $loader_file = "../$p/admin_$p.php";
            elseif ($var3 == 'core')
                $loader_file = "../$p/admin_$p.php";

            // ������
            elseif ($p == 'modules') {
                $_classPath = '../../';

                // �������������� ���������� � �������
                if (strpos($var4, '|')) {
                    $mod_var_array = explode("|", $_REQUEST['var4']);

                    for ($i = 0; $i < count($mod_var_array); $i++) {
                        $_REQUEST['var' . ($i + 4)] = $mod_var_array[$i];
                    }
                }

                if (empty($var2)) {
                    $var2 = $var1;
                } else {

                    // ��������� ������� CMS Free
                    parse_str(base64_decode($var2), $strArray);
                    if (is_array($strArray)) {

                        foreach ($strArray as $key => $var)
                            $_REQUEST[$key] = $var;


                        if (count($strArray) > 2)
                            $var2 = $var1;
                    }
                }

                $loader_file = "../../modules/$var1/admpanel/admin_$var2.php";
            } elseif (!empty($var3)) {
                $_classPath = '../../';
                $loader_file = "../../modules/$var1/admpanel/admin_$var3.php";
            } else {
                $_classPath = '../../';
                $loader_file = "../../modules/$var1/admpanel/admin_$var1.php";
            }

            $loader_function = 'actionStart';

            if (is_file($loader_file)) {
                include("../../class/obj.class.php");

                // �������������� ������ ���� �������������
                $old_priv = array(
                    'page' => 'page_site',
                    'banner' => 'baner',
                    'slider' => 'baner',
                    'modules' => 'page_site',
                    'menu' => 'page_menu',
                );

                if (!empty($old_priv[$p]))
                    $p = $old_priv[$p];

                require_once($loader_file);
                if (function_exists($loader_function)) {
                    $SysValue['Lang']['Title'][$p] = $TitlePage;
                    PHPShopObj::loadClass("system");
                    PHPShopObj::loadClass("admgui");
                    PHPShopObj::loadClass("orm");
                    PHPShopObj::loadClass("date");
                    PHPShopObj::loadClass("xml");
                    $PHPShopInterface = new PHPShopInterface();

                    if (CheckedRules($UserStatus[$p], 0) == 1) {
                        ob_start();
                        call_user_func($loader_function);
                        $interface = ob_get_clean();
                    }
                    else
                        $interface = $UserChek->BadUserForma();
                }
            }
        }
        break;
}



// ��������� ��������� 
$_RESULT = array(
    "q" => $q,
    "xid" => $interface,
    "tit" => $SysValue['Lang']['Title'][$p] . " -> " . $SysValue['Lang']['Title']['admpanel'] . " -> " . $ProductName,
    'js' => $addJS
);
?>