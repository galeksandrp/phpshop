

<table  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="150"><div id=allspec><img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�����������</b>
</div></td>
    <td><div>  @facebookAuth@
		@twitterAuth@</div></td>
  </tr>
</table>

<form name="users_data" method="post">

    <table>
        <tr>
            <td>�����:</td>
            <td width="10"></td>
            <td><input type="text" name="login_new" style="width:250px;" value='@php echo $_POST["login_new"]; php@'><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><br>(�� ����� 4 ������)</td>
            <td rowspan="2" valign="top" style="padding-left:10px">
            </td>
        </tr>
        <tr>
            <td>������:</td>
            <td width="10"></td>
            <td><input type="Password" name="password_new" style="width:250px;" value='@php echo $_POST["password_new"]; php@'><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><br>(�� ����� 6 ������)</td>
        </tr>
        <tr>
            <td>��������� ������:</td>
            <td width="10"></td>
            <td><input type="Password" name="password_new2" style="width:250px;" value=""><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
    </table>

<div id=allspec>
    <img src="images/shop/icon_user.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������ ������</b>
</div>
<table width="99%" cellpadding="5">
    <tr>
        <td colspan="2"><p><br></p></td>
    </tr>
    <tr>
        <td>���������� ����:&nbsp;&nbsp;&nbsp;
        </td>
        <td><input type="text" name="name_new" style="width:300px" value='@php echo $_POST["name_new"]; php@'><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
        <td>E-mail:
        </td>
        <td><input type="text" name="mail_new" style="width:300px" value='@php echo $_POST["mail_new"]; php@'><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
        <td>��������: </td>
        <td><input type="text" name="company_new" style="width:300px;" value='@php echo $_POST["company_new"]; php@'></td>
    </tr>
    <tr>
        <td>���:</td>
        <td><input type="text" name="inn_new" style="width:300px;" value='@php echo $_POST["inn_new"]; php@'></td>
    </tr>
    <tr>
        <td>���:</td>
        <td><input type="text" name="kpp_new" style="width:300px;" value='@php echo $_POST["kpp_new"]; php@'></td>
    </tr>
    <tr>
        <td>�������:</td>
        <td><input type="text" name="tel_code_new" style="width:50px;" value='@php echo $_POST["tel_code_new"]; php@'> -
            <input type="text" name="tel_new" style="width:240px;" value='@php echo $_POST["tel_new"]; php@'></td>
    </tr>
    <tr>
        <td>�����:</td>
        <td><textarea style="width:300px; height:100px;" name="adres_new">@php echo $_POST["adres_new"]; php@</textarea>

        </td>
    </tr>
</table>
<table>
    <tr>
        <td align="center"><img src="phpshop/captcha.php" id="captcha" alt="" border="0"><br>
            <a class=b  title="�������� ��������" href="javascript:CapReload();">�������� ��������</a></td>
        <td>������� ���, ��������� �� ��������<br><input type="text" name="key" style="width:220px;"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
        <td colspan="2">	<br>
            <div id=allspec><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>
                @user_error@
            </div>
            <br></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input type="hidden" value="1" name="add_user">
            <input type="button" value="����������� ������������" onclick="CheckNewUserForma()"></td>
    </tr>
</table>
</form>
