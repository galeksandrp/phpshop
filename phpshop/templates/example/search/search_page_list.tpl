<h4 style="font-size: 15px;color: #000000">����������� �����</h4>

<div class="page_nava">
  <a href="/">�������</a> / ����������� �����
</div>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td colspan="2"><form method="post" name="forma_search" action="/search/">
        <table>
          <tr>
            <td> ������� �����:<br>
              <input style="width:300px" maxLength="100" name="words" value="@searchString@">
            </td>
            <td><br>
              <input type="submit" value="������">
            </td>
          </tr>
          <tr>
            <td colspan="2"> �������� �������:<br>
              @searchPageCategory@ </td>
          </tr>
          <tr>
            <td colspan="2" id="sort"><table cellpadding="0" cellspacing="0">
                <tr>@searchPageSort@</tr>
              </table></td>
          </tr>
          <tr>
            <td colspan="2"><b>������ ������:</b>
              <input type="Radio" value="1" name="set" @searchSetA@>
              � &nbsp;
              <input type="Radio" value="2" name="set" @searchSetB@ >
              ���
              &nbsp;&nbsp;&nbsp;/ &nbsp;&nbsp;<b>�������:</b>
              <input type="Radio" value="1" name="pole" @searchSetC@>
              ������������ &nbsp;
              <input type="Radio" value="2" name="pole" @searchSetD@ >
              ��������� ��� </td>
          </tr>
        </table>
      </FORM></td>
  </tr>
  <tr>
    <td><div style="padding: 7px"> @searchPageNav@ </div></td>
  </tr>
  <tr>
    <td>
  <!-- ����� [search/main_search_forma_2.tpl] -->
    @productPageDis@
  <!-- ����� [search/main_search_forma_2.tpl] -->
    </td>
  </tr>
  <tr>
    <td><div style="padding: 7px"> @searchPageNav@ </div></td>
  </tr>
</table>
