<div id="allspec">
    @user_error@
</div>

<form name="users_password" method="post">
    <table style="padding-top: 10px;padding-bottom: 10px">
        <tr>
            <td width="180">�����:</td>
            <td width="10"></td>
            <td><input type="text" name="login_new" value="@user_login@" style="width:250px;" ><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td>������:</td>
            <td width="10"></td>
            <td><input type="Password" name="password_new" style="width:250px;" value="@user_password@"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">
                <br><span id="password" style="display: none;"><input type="Password" name="password_new2" style="width:250px;" value=""> (��������� ������)</span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td width="10"></td>
            <td height="45"><input type="checkbox" id="password_chek" value="1" name="password_chek" onclick="DispPasDiv()"> �������� �����������&nbsp;&nbsp;&nbsp;
                <input type="hidden" value="1" name="update_password">
                <input type="button" value="��������" onclick="UpdateUserPassword()">
            </td>
        </tr>
    </table>
</form>
<form name="users_data" method="post">


    <table width="99%" cellpadding="5">
        <tr>
            <td width="180">������:&nbsp;&nbsp;&nbsp;
            </td>
            <td><b>@user_status@</b></td>
        </tr>
        <tr>
            <td width="180">������:&nbsp;&nbsp;&nbsp;
            </td>
            <td><b>@user_cumulative_discount@ %</b></td>
        </tr>
        <tr>
            <td width="180">���������� ����:&nbsp;&nbsp;&nbsp;
            </td>
            <td ><input type="text" name="name_new" value="@user_name@" style="width:250px"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td>E-mail:
            </td>
            <td><input type="text" name="mail_new" value="@user_mail@" style="width:250px"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td>��������: </td>
            <td><input type="text" name="company_new" style="width:250px;" value="@user_company@"></td>
        </tr>
        <tr>
            <td>���:</td>
            <td><input type="text" name="inn_new" style="width:250px;" value="@user_inn@"></td>
        </tr>
        <tr>
            <td>���:</td>
            <td><input type="text" name="kpp_new" style="width:250px;" value="@user_kpp@"></td>
        </tr>
        <tr>
            <td>�������:</td>
            <td><input type="text" name="tel_code_new" style="width:50px;" value="@user_tel_code@"> -
                <input type="text" name="tel_new" style="width:190px;" value="@user_tel@"></td>
        </tr>
        <tr>
            <td valign="top">�����:</td>
            <td><textarea style="width:250px; height:100px;" name="adres_new">@user_adres@</textarea>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="2">
                <br>
                <div id="allspec"><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>

                </div><br>
                <input type="hidden" value="1" name="update_user">
                <input type="button" value="�������� ������" onclick="UpdateUserForma()">
            </td>
        </tr>
    </table>
</form>