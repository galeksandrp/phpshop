<div class="row">
<div class="breadcrumb">
  <div> <a href="/">�������</a> <span>�</span> ����������� ����� </div>
</div>
<h2>����������� �����</h2>

<FORM method="post" name="forma_search">
  <table>
    <tr class="hidden-phone">
      <td>������� �����:<br>
        <INPUT style="width: 550px; margin-bottom:0;"  class="form-control" maxLength="100" name="words" value="@searchString@" type="text">
      </td>
      <td><br>
        <input type="submit" value="������" class="ok">
      </td>
    </tr>
    <tr>
      <td colspan="2">�������� �������:<br>
        @searchPageCategory@ </td>
    </tr>
    <tr>
      <td colspan="2" id="sort"><table cellpadding="0" cellspacing="0">
          <tr>@searchPageSort@</tr>
        </table></td>
    </tr>
    <tr>
      <td colspan="2"><b>������� ������:</b>
        <input type="Radio" class="logic_radio" value="1" name="pole" @searchSetC@>
        ������������ &nbsp;
        <input type="Radio" class="logic_radio" value="2" name="pole" @searchSetD@ >
        ��������� ��� </td>
    </tr>
  </table>
</FORM>
<p><br>
</p>

  @productPageDis@

<div class="navi">@searchPageNav@</div>
</div>
