<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>@pageTitl@</TITLE>
<META http-equiv="Content-Type" content="text-html; charset=windows-1251">
<META name="description" content="@pageDesc@">
<META name="keywords" content="@pageKeyw@">
<META name="copyright" content="@pageReg@">
<style type="text/css">
<!--
body {
	font-family: Tahoma;
}
P {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	word-spacing: normal;
	white-space: normal;
	margin: 5px 5px 5px 5px;
	letter-spacing : normal;
}
TABLE {
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
}
.sort_name_bg {
	background-color: #F0F1F1;
}
.sort_table {
	margin-top: 10px;
	background-color: White;
	BORDER-RIGHT: #d3d3d3 1px dashed;
	PADDING-RIGHT: 5px;
	BORDER-TOP: #d3d3d3 1px dashed;
	PADDING-LEFT: 5px;
	PADDING-BOTTOM: 5px;
	BORDER-LEFT: #d3d3d3 1px dashed;
	PADDING-TOP: 5px;
	BORDER-BOTTOM: #d3d3d3 1px dashed;
}
.nonprint {
	display: none;
}
-->
</style>
</HEAD>
<BODY>
<table border="0" cellpadding="5" cellspacing="5" width="100%">
  <tr>
    <td><a href="http://@serverShop@"><IMG src="http://@serverShop@@logoShop@" alt="@nameShop@" border="0"></a> </td>
    <td><H4>@nameShop@</H4>
      @descripShop@ </td>
  </tr>
</table>
<table border="0" cellpadding="5" cellspacing="5" width="100%">
  <tr>
    <td colspan="2"><HR>
    </td>
  </tr>
  <tr>
    <td><div align="center" class="nonprint"><a href="#" onclick="window.print();return false;" style="color: #0078BD;"><img border=0 align=absmiddle hspace=3 vspace=3 src="http://@serverShop@images/shop/action_print.gif" >�����������</a> | <a href="#" onclick="document.execCommand('SaveAs');return false;" style="color: #0078BD;">��������� �� ����<img border=0 align=absmiddle hspace=3 vspace=3 src="http://@serverShop@images/shop/action_save.gif"></a><br>
        <br>
      </div>
      <a href="http://@serverShop@/shop/UID_@productId@.html"><IMG src="http://@serverShop@@productImg@" alt="@productName@" title="@productName@" border="0" hspace="10"></a> </td>
    <td valign="top"><a href="http://@serverShop@/shop/UID_@productId@.html" style="text-decoration:none;color:black" title="@productName@">
      <H4>@productName@ / @productPrice@ @productValutaName@</H4>
      </a><br>
      <div class="nonprint"> ������: <a href="http://@serverShop@/shop/UID_@productId@.html" title="������� �� ������: @productName@">http://@serverShop@/shop/UID_@productId@.html</a> </div>
      @vendorDisp@ </td>
  </tr>
  <tr>
    <td style="TEXT-ALIGN: justify" colspan="2"><BR>
      <BR>
      <B>�������������:</B>
      <P>@productDes@</P>
      <P><BR>
      </P></td>
  </tr>
</table>
<HR>
</BODY>
</HTML>
