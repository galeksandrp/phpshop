@activationNotice@
<form method="post" name="user_forma" action="@ShopDir@/partner/" class="template-sm">
    <table cellspacing="5" class="table table-striped">
        <tr>
            <td align="right">	�����:
            </td>
            <td>
                <input type="text" name="plogin"  size="20">
            </td>
        </tr>
        <tr>
            <td align="right">	������:
            </td>
            <td>
                <input  type="password" name="ppassword" size="20">
            </td>
        </tr>
        <tr>
            <td align="right">
            </td>
            <td >
                <input  type="submit" name="send" value="�����������">
            </td>
        </tr>
    </table>
    <input type="hidden" value="1" name="enter_user">
</form>
<p>
    <a href="@ShopDir@/partner/register_user.html" title="�����������">�����������</a><br>
    <a href="@ShopDir@/partner/sendpassword_user.html"  title="������ ������?">������ ������?</a><br>
    <a href="@ShopDir@/rulepartner/"  title="������� � ������� ���������� ���������">������� � ������� ���������� ���������</a><br>
</p>
