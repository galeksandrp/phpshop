<form method="post" name="forma_message">
  <table width="100%" cellpadding="5">
    <tr>
      <td colspan="2"><p><br>
        </p></td>
    </tr>
    <tr>
      <td>����:&nbsp;&nbsp;&nbsp; </td>
      <td><input type="text" name="tema" id="tema" style="width:300px" value="" class="borderForm">
        <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
      <td>���������� ����:&nbsp;&nbsp;&nbsp; </td>
      <td><input type="text" name="name" id="name" style="width:300px" value="" class="borderForm">
        <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
      <td>E-mail: </td>
      <td><input type="text" name="mail" id="mail" style="width:300px" value="" class="borderForm"></td>
    </tr>
    <tr>
      <td>�������: </td>
      <td><input type="text" name="tel" id="tel" style="width:300px;" value="" class="borderForm"></td>
    </tr>
    <tr>
      <td>��������: </td>
      <td><input type="text" name="company" id="company" style="width:300px;" value="" class="borderForm"></td>
    </tr>
    <tr>
      <td>���������:</td>
      <td><textarea style="width:300px; height:200px;" name="content" id="content" class="borderForm"></textarea>
        <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"> </td>
    </tr>
  </table>
  <table>
    <tr>
      <td align="center"><img src="phpshop/captcha.php" id="captcha" alt="" border="0"><br>
        <a class=b  title="�������� ��������" href="javascript:CapReload();">�������� ��������</a></td>
      <td>������� ���, ��������� �� ��������<br>
        <input type="text" name="key" style="width:220px;" class="borderForm">
        <img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
    </tr>
    <tr>
      <td colspan="2"><br>
        <div id=allspec><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>
          <font color="#FF0000"><strong>@Error@</strong></font> </div></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="reset" value="��������">
        <input type="hidden" name="send" value="1">
        <input type="button" value="��������� ���������" onclick="CheckOpenMessage()"></td>
    </tr>
  </table>
</form>
