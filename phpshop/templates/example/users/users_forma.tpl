<font color="#FF0000">@usersError@</font>
<form method="post" name="user_forma">
  <table cellpadding="0" cellspacing="5" border="0">
    <tr>
      <td align="right"> �����: </td>
      <td><input type="text" name="login" value="@UserLogin@">
      </td>
      <td><a href="/users/register.html" title="�����������">�����������</a> </td>
    </tr>
    <tr>
      <td align="right"> ������: </td>
      <td><input class="user" name="password" value="@UserPassword@">
      </td>
      <td><input type="button" value="�����" onclick="ChekUserForma()">
      </td>
    </tr>
    <tr>
      <td></td>
      <td><a href="/users/sendpassword.html" title="������ ������?">������ ������?</a></td>
      <td><input type="checkbox" value="1" name="safe_users" @UserChecked@> <b>���������</b></td>
    </tr>
  </table>
  <input type="hidden" value="1" name="user_enter">
</form>
