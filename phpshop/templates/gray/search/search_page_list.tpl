<div class="plashka_center">
				<div class="plashka_zag" >����������� �����</div>
				
			</div>
			<div class="page_nava">
<div>
<a href="/">�������</a> / ����������� �����
</div></div>	


<div id="allspec" style="margin-top: 5px">

						<FORM method="post" name="forma_search" action="/search/">	
						<table cellpadding="0" cellspacing="0">
					
<tr>
	<td>
	������� �����:<br>
	<INPUT style="WIDTH:350px" maxLength="100" name="words" value="@searchString@">
	<input type="submit" value="������" class="ok">
	<br>
	�������� �������:<br>
	@searchPageCategory@
	</td>
</tr>
 <tr>
   <td colspan="3"><b>������ ������:</b>
<input type="Radio" value="1" name="set" @searchSetA@>� &nbsp;<input type="Radio" value="2" name="set" @searchSetB@ >���<br>
<b>������� ������:</b> <input type="Radio" value="1" name="pole" @searchSetC@>������������ &nbsp;<input type="Radio" value="2" name="pole" @searchSetD@ >��������� ���

</td>
</tr>  

</table>
</FORM></div>

<div class="page_nava" style="margin-top:3px;">
<div style="float:right;"><a href="#down" style="color:AC8694"><img src="images/shop/1.gif" alt="" width="15" height="16" border="0" align="absmiddle">����</a></div>
	<div>@searchPageNav@</div>
	
</div>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
@productPageDis@
</table>

<div class="page_nava" style="margin-top:3px;">
<div style="float:right;"><a href="#up" style="color:AC8694"><img src="images/shop/1.gif" alt="" width="15" height="16" border="0" align="absmiddle">�����</a></div>
	<div>@searchPageNav@</div>
	
</div>
