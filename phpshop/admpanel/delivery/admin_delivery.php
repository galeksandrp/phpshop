<?

function Delivery()// ����� ��������
{
global $SysValue;

$_Return='
<!--����������� ���������-->
	 <form method="post" name="search">
	 <table width="100%" cellpadding="0" cellpadding="0" style="border: 1px;border-style: outset;">
<tr>
<td>

<table cellpadding="0" cellspacing="0">
<tr>
   <td width="5"></td>
    <td id="but23"  class="butoff"><img name="imgLang" src="icon/page_new.gif" alt="����� ��������" width="16" height="16" border="0" onmouseover="ButOn(23)" onmouseout="ButOff(23)" onclick="NewDelivery()">
    </td>
    <td width="3"></td>
	<td id="but1"  class="butoff"><img name="imgLang" src="icon/folder_add.gif" alt="����� �������" width="16" height="16" border="0" onmouseover="ButOn(1)" onmouseout="ButOff(1)" onclick="NewDeliveryCatalog()"></td>
<td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
	<td id="but37" class="butoff"><img name="imgLang" src="icon/folder_edit.gif" alt="������������� �������" width="16" height="16" border="0" onmouseover="ButOn(37)" onmouseout="ButOff(37)" onclick="EditCatalogDelivery()"></td>
   <td width="5"></td>
	<td width="1" bgcolor="#ffffff"></td>
	<td width="1" bgcolor="#808080"></td>
   <td width="10"></td>
   <td>
<!--   
   <select name="actionSelect" size="1" id="actionSelect" onchange="DoWithSelect(this.value,window.frame2.document.form_flag,1000)">
			<option SELECTED id=txtLang value=0>� �����������</option>
			<option value="30" id=txtLang>�������� �����</option>
			<option value="31" id=txtLang>��������� �����</option>
			<option value="39" id=txtLang>������� �� ����</option>
   </select>
-->
   </td>
</tr>
</table>
</form>
</td>
</td>
</tr>
</table>
'."
<!--�������� ����-->
<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">
<tr>
	<td id=pane align=center><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>��������</span></td>
<td rowspan=2 valign=\"top\">
<!--����� �������� �����-->
<iframe id=interfacesWin1 src=\"delivery/admin_delivery_content.php\" width=\"100%\" height=\"580\" name=\"frame2\" frameborder=\"0\" scrolling=\"Auto\" ></iframe>
<!--����� �������� �����-->
</td>
</tr>
<tr valign=\"top\">
	<td width=\"300px\">
<!--����� ��������-->
<iframe id=interfacesWin2 src=\"delivery/tree.php\" width=\"300px\" height=\"520\" scrolling=\"Auto\" name=\"frame1\"></iframe>
<!--����� ��������-->
<!--�������� � ����������� ���������-->
<div align=\"center\" style=\"padding:5\">
<table cellpadding=\"0\" cellspacing=\"0\">
  <tr>
  <td id=\"but50\"  class=\"butoff\"><img  name=imgLang src=\"icon/chart_organisation_add.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d4.openAll()\">
    </td>
   	<td width=\"10\"></td>
	<td width=\"1\" bgcolor=\"#ffffff\"></td>
	<td width=\"1\" bgcolor=\"#808080\"></td>
   <td width=\"5\"></td>
	<td id=\"but51\"  class=\"butoff\"><img name=imgLang src=\"icon/chart_organisation_delete.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\" onclick=\"window.frame1.d4.closeAll()\"></td>
  </tr>
</table>
</div>
<!--�������� � ����������� ���������-->
   </td>
</tr>
</table>
";
return $_Return;
}
?>