<h1 class="HTitle4">@catalogCat@ / @catalogCategory@</h1>
<div class="page_nava">
  <div ><a href="/">�������</a> / <A href="/shop/CID_@catalogId@.html" title="@catalogCat@">@catalogCat@</A> / <span>@catalogCategory@</span></div>
</div>
<div> @catalogContent@ </div>
<form method="post" action="/shop/CID_@productId@.html" name="sort">
<div id="allspec_page_list">
	<div class="priceLink"><a href="/price/CAT_SORT_@pcatalogId@.html" title="�����-���� �������� @catalogCategory@" class="link">�����-���� ��������</a></div>
    <div style="width: 100%">
     <div style="float:left;line-height: 17px;">���� ��:&nbsp;</div>
	 <div style="float:left;"><input type="text" size="5" name="priceOT" value="@productRriceOT@" class="input_page_list"></div>
     <div style="float:left;line-height: 17px;">&nbsp;��:&nbsp;</div>
	 <div style="float:left;"><input type="text" size="5" name="priceDO" value="@productRriceDO@" class="input_page_list"></div>
     <div>
	 <input type="submit" value="��������" name="priceSearch" class="ok">
	 <input type="hidden" value="@productSort@" name="s">
	 </div>
   </div>
    <table cellspacing="0" cellpadding="0" class="vendorDispClass">
      <tr> @vendorDisp@
        <td> @vendorSelectDisp@</td>
      </tr>
    </table>
    <div> @vendorDispTitle@ </div>
</div>
<table cellpadding="0" cellspacing="0" border="0" class="catalogOptionTable1">
	<tbody>
		<tr>
		  <td align="left" valign="middle" class="catOptionTD"><div class="page_nav_top">@productPageNav@</div></td>
		  <td align="right" valign="middle"><div class="divSortPageList">����: &nbsp; <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=2&amp;s=2"><img src="images/furniture_24.gif" align="absmiddle" border="0"></a> <span class="spanSortPageList"><a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=2&amp;s=2">����</a> <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=1&amp;s=2"><img src="images/furniture_25.gif" align="absmiddle" border="0"></a> <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=1&amp;s=2">����</a></span></div></td>
		</tr>
	</tbody>
</table>
</form>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
  @productPageDis@
</table>

<form method="post" action="/shop/CID_@productId@.html" name="sort">
<table cellpadding="0" cellspacing="0" border="0" class="catalogOptionTable2">
	<tbody>
		<tr>
		  <td align="left" valign="middle" class="catOptionTD"><div class="page_nav_bot">@productPageNav@</div></td>
          <td align="right" valign="middle"><div class="divSortPageList">����: &nbsp; <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=2&amp;s=2"><img src="images/furniture_24.gif" align="absmiddle" border="0"></a> <span class="spanSortPageList"><a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=2&amp;s=2">����</a> <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=1&amp;s=2"><img src="images/furniture_25.gif" align="absmiddle" border="0"></a> <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=1&amp;s=2">����</a></span></div></td>
		</tr>
	</tbody>
</table>
</form>