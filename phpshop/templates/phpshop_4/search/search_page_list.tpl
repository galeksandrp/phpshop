<div class="plashka_center">����������� �����</div>

<div class="page_nava">
<div>
<a href="/">�������</a> /  ����������� �����
</div></div>
<br>
<TABLE cellpadding="0" cellspacing="0" width="512" class="text_1">
					<TR>
						<TD colspan="2">	
						<FORM method="post" name="forma_search" action="/search/">	
						<table>
					
<tr>
	<td>
	������� �����:<br>
	<INPUT style="WIDTH:400px" maxLength="100" name="words" value="@searchString@">
	</td>
	<td>
	<br>
	<input type="submit" value="������">
	
	</td>
</tr>
<tr>
	<td colspan="2">
	�������� �������:<br>
	@searchPageCategory@
	</td>
	
</tr>
<tr>
	<td colspan="2" id="sort">
	<table cellpadding="0" cellspacing="0"><tr>@searchPageSort@</tr></table>
	</td>
	
</tr>
 <tr>
   <td colspan="2"><b>������ ������:</b>
<input type="Radio" value="1" name="set" @searchSetA@>� &nbsp;<input type="Radio" value="2" name="set" @searchSetB@ >���
&nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;<b>�������:</b> <input type="Radio" value="1" name="pole" @searchSetC@>������������ &nbsp;<input type="Radio" value="2" name="pole" @searchSetD@ >��������� ���

</td>
</tr>  

</table></FORM>
						</TD>
					</TR>
					<TR>
						<TD class="page_nav">@searchPageNav@
						</TD>
					</TR>
					<TR>
						<TD>	@productPageDis@
						</TD>
					</TR>
					
					<TR>
						<TD width="100%">
							<DIV class="page_nav"> @searchPageNav@
							</DIV>
						</TD>
					</TR>
				</TABLE>