<div class="breadcrumb">
  <div> @breadCrumbs@ </div>
</div>
<div class="header_rel" style="padding-right:0px">
  <h1>@catalogCategory@</h1>
  <a href="/price/CAT_SORT_@pcatalogId@.html" title="�����-���� �������� @catalogCategory@" class="abs_link">�����-���� ��������</a> </div>
<div class="category-info" id="banfx"> @catalogContent@ </div>
<NOINDEX>
  <form method="post" action="/shop/CID_@productId@@nameLat@.html" name="sort">
    <div class="product-filter">
      <div class="display">����� �������:&nbsp;&nbsp; <a href="/shop/CID_@productId@@nameLat@.html?@productVendor@&f=@php echo $_GET['f']; php@&s=@php echo $_GET['s']; php@&gridChange=1"><img src="images/icon_list.png" alt="������" title="������" /></a>&nbsp; <a href="/shop/CID_@productId@@nameLat@.html?@productVendor@&f=@php echo $_GET['f']; php@&s=@php echo $_GET['s']; php@&gridChange=2"><img src="images/icon_grid.png" alt="�����" title="�����" /></a> </div>
      <div class="product-compare" style="display:@compare Enabled@; "><a href="/compare/" id="compare-total">�������� ������ (<span id="numcompare">@numcompare@</span> ��.)</a></div>
      <div class="sort"> ����������� ��
        <select onchange="location = this.value;">
          <option value="?">���������</option>
          <option value="?@productVendor@&f=1&s=1">������������ (����)</option>
          <option value="?@productVendor@&f=2&s=1">������������ (����)</option>
          <option value="?@productVendor@&f=1&s=2">���� (����)</option>
          <option value="?@productVendor@&f=2&s=2">���� (����)</option>
        </select>
      </div>
      <div style="clear:both"></div>
      <table cellpadding="0" cellspacing="0" border="0" class="vendorDisp" >
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="0">
              <tr> @vendorDisp@ </tr>
            </table></td>
          
        </tr>
		<tr><td >@vendorSelectDisp@</td></tr>
      </table>
    </div>
  </form>
</NOINDEX>
<div class="product-grid">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    @productPageDis@
  </table>
</div>
<div class="navi">@productPageNav@</div>
