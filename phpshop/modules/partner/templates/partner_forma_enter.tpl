<form method="post" name="user_forma" action="@ShopDir@/partner/" class="template-sm">
    <table cellspacing="5" cellpadding="5" class="table table-striped">
        <tr>
            <td align="right">	�����:
            </td>
            <td>
                <b>@userName@</b>
            </td>
        </tr>
        <tr>
            <td align="right">	ID:
            </td>
            <td>
                <b>@partnerId@</b>
            </td>
        </tr>
        <tr>
            <td align="right">	������:
            </td>
            <td>
                @userMoney@
            </td>
        </tr>
        <tr>
            <td align="right">	�����������:
            </td>
            <td>
                <b>@userDate@</b>
            </td>
        </tr>
        <tr>
            <td align="right">	E-mail:
            </td>
            <td>
                <input type="text" name="mail" value="@userMail@" size="25">
            </td>
        </tr>
        @userContent@
        <tr>
            <td align="right">	����� ������:
            </td>
            <td>
                <input  type="password" name="password" value="@userPassword@" size="25">
            </td>
        </tr>

        <tr>
            <td align="right">
                <input type="submit" name="exit_user" value="�����">
            </td>
            <td >
                <input type="submit" name="update_user" value="�������� ������"> @userMessage@
            </td>
        </tr>
    </table>
</form>