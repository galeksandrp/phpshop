<table >
<form method="post" name="user_forma">
<tr>
	<td>�����:</td>
	<td><input type="text" name="login" value="@UserLogin@" style="width:100px"></td>
	<td><a href="/users/register.html" class=b>�����������</a></td>
</tr>
<tr>
	<td>������:</td>
	<td><input type="password" name="password" value="@UserPassword@" style="width:100px"></td>
	<td><a href="/users/sendpassword.html" class=b>������ ������?</a></td>
</tr>
<tr>
	<td colspan="3" >
	<input type="checkbox" value="1" name="safe_users" @UserChecked@>��������� ������&nbsp;&nbsp;&nbsp;
	<input type="button" value="�����" onclick="ChekUserForma()" class="but">
	<input type="hidden" value="1" name="user_enter">
	</td>
</tr>
</form>
</table>