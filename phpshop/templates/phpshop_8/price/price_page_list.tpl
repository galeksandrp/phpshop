<h1 class="HTitle4">�����-����</h1>
<div class="page_nava">
  <div ><a href="/">�������</a> / <span>�����-����</span></div>
</div>
<p>
<form>
  @searchPageCategory@
  <input type="button" value="��������" onclick="DoPriceSort();" class="ok">
</form>
</p>
<div class="pod_cart">
  <table class="standart">
    <tr>
      <td width="30%"> <a href="/price/CAT_ALL.html" title="������� ��� �������">������� ��� �������</a> </td>
      <td width="30%"> <a href="javascript:GetAllForma('@PageCategory@')" title="����� � ���������">����� � ���������</a> </td>
      <td width="30%"> <a href="#" onclick="window.open('phpshop/forms/priceprint/print.html?catId=@PageCategory@')" title="�������� �����">�������� �����</a> </td>
    </tr>
    <tr>
      <td> <a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@')" title="Excel �����">Excel �����</a> </td>
      <td> <a href="#" onclick="window.open('/files/priceSave.php?catId=@PageCategory@&gzip=true')" title="Excel ����� GZIP">Excel ����� GZIP</a> </td>
      <td> <a href="/files/onlineprice/" target="_blank" title="������������� �����">������������� �����</a> </td>
    </tr>
  </table>
</div>
<div class="productPageDisTable">@productPageDis@</div>
