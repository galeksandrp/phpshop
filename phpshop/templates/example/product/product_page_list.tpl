<h4 style="font-size: 15px;color: #000000">@catalogCat@ / @catalogCategory@</h4>

<div class="page_nava">
  @breadCrumbs@
</div>

<!-- ����� ��������� �� �������� -->
@DispCatNav@
<!-- ����� ��������� �� �������� -->

<!-- ����� �������� �������� -->
<div style="padding-top:10px;padding-bottom:10px"> @catalogContent@ </div>
<!-- ����� �������� �������� -->

<div id="allspec">
  <form method="post" action="/shop/CID_@productId@.html" name="sort">
    <div> ���������� ��: <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortNext@&s=@productSort@" title="�������� �����������"><img src="images/shop/@productSortImg@.gif" alt="�������� �����������" width="15" height="16" border="0" align="absmiddle"></a><a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=1" class="@productSortA@">��������</a> - <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=2"  class="@productSortB@">����</a> - <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=3"  class="@productSortC@">������������</a> </div>
    <div style="width: 100%">
      <div style="float:left;line-height: 17px;">���� ��:&nbsp;</div>
      <div style="float:left;">
        <input type="text" size="5" name="priceOT" value="@productRriceOT@">
      </div>
      <div style="float:left;line-height: 17px;">&nbsp;��:&nbsp;</div>
      <div style="float:left;">
        <input type="text" size="5" name="priceDO" value="@productRriceDO@">
      </div>
      <div>
        <input type="submit" value="���������" name="priceSearch" class="ok">
        <input type="hidden" value="@productSort@" name="s">
      </div>
    </div>
    
    <!-- ����� �������� �������� -->
    <table cellspacing="0" cellpadding="0" border="2" width="500">
      <tr> @vendorDisp@
        <td width="3%">@vendorSelectDisp@</td>
      </tr>
    </table>
    <div> @vendorDispTitle@ </div>
    <!-- ����� �������� �������� -->
    
  </form>
</div>
<div align="right" style="padding-top:5px"><img src="images/shop/page_excel.gif" alt="" border="0" align="absmiddle" hspace="5"><a href="/price/CAT_SORT_@pcatalogId@.html" title="�����-���� �������� @catalogCategory@">�����-���� ��������</a></div>

<!-- ����� ��������� �������� -->
<div style="padding:7px">@productPageNav@</div>
<!-- ����� ��������� �������� -->

<!-- ����� ������� -->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  @productPageDis@
</table>
<!-- ����� ������� -->

<!-- ����� ��������� �������� -->
<div style="padding:7px">@productPageNav@</div>
<!-- ����� ��������� �������� -->
