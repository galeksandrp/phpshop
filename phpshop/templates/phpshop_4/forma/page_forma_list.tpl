<form method="post" name="forma_message">
    <table width="100%" cellpadding="5" class="forma_message">
        <tr>
            <td colspan="2"><strong  style="font-size:14px; color:#FF0000"> @Error@</strong>
                <p></p></td>
        </tr>
        <tr>
            <td width="30%">����:&nbsp;&nbsp;&nbsp; </td>
            <td><input type="text" name="tema" id="tema" style="width:290px"  value="@php echo $_REQUEST['tema']; php@">
                <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td>���������� ����:&nbsp;&nbsp;&nbsp; </td>
            <td><input type="text" name="name" id="name" style="width:290px"  value="@php echo $_REQUEST['name']; php@">
                <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td><input type="text" name="mail" id="mail" style="width:290px"  value="@php echo $_REQUEST['mail']; php@"></td>
        </tr>
        <tr>
            <td>�������: </td>
            <td><input type="text" name="tel" id="tel" style="width:290px"  value="@php echo $_REQUEST['tel']; php@"></td>
        </tr>
        <tr>
            <td>��������: </td>
            <td><input type="text" name="company" id="company" style="width:290px"  value="@php echo $_REQUEST['company']; php@"></td>
        </tr>
        <tr>
            <td>���������:</td>
            <td><textarea style="height:150px; width:290px;" name="content"  id="content1">@php echo $_REQUEST['content']; php@</textarea>
                <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"> </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td  width="30%" align="left"><img src="phpshop/captcha.php" id="captcha" alt="" border="0"><br>
                <a class=b  title="�������� ��������" href="javascript:CapReload();">�������� ��������</a></td>
            <td>������� ���, ��������� �� ��������<br>
                <input type="text" name="key" style="">
                <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
        </tr>
        <tr>
            <td colspan="2"><br>
                <div id=allspec><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>
                </div></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="reset" value="��������">
                <input type="hidden" name="send" value="1">
                <input type="button" value="��������� ���������" onclick="CheckOpenMessage()"></td>
        </tr>
    </table>
</form>
