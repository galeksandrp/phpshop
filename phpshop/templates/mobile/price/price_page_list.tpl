<h4 style="font-size: 15px;color: #000000">�����-����</h4>

<p><form>
@searchPageCategory@	<input type="button" value="��������" onclick="DoPriceSort();" class="ok">
</form></p>


<table width="100%">
<tr>
	<td width="34%">
	<img src="images/shop/zoom.gif" alt="" border="0" align="absmiddle" hspace="5">
    <a href="/price/CAT_ALL.html" title="������� ��� �������">������� ��� �������</a>
	</td>
	<td width="34%">
	<img src="images/shop/layout_content.gif" alt="" border="0" align="absmiddle" hspace="5">
    <a href="javascript:GetAllForma('@PageCategory@')" title="����� � ���������">����� � ���������</a>
	</td>
	<td width="34%">
    <img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/action_print.gif">
	<a href="#" onclick="window.open('phpshop/forms/priceprint/print.html?catId=@PageCategory@')" title="�������� �����">�������� �����</a>
	</td>
</tr>
<tr>
	<td>
	<img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/action_save.gif">
	<a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@')" title="Excel �����">Excel �����</a>
	</td>
	<td >
	<img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/package.gif">
	<a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@&gzip=true')" title="Excel ����� GZIP">Excel ����� GZIP</a>
	</td>
	<td>
    <img border=0 align=absmiddle hspace=3 vspace=3 src="images/shop/basket_add.gif">
    <a href="/files/onlineprice/" target="_blank" title="������������� �����">������������� �����</a>
    </td>
</tr>
</table>

@productPageDis@					
												