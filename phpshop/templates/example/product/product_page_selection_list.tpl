<h4 style="font-size: 15px;color: #000000">������ �� ����������</h4>

<div class="page_nava">
  <a href="/">�������</a> / ������ �� ����������
</div>

<div id="allspec" style="margin-top: 5px">
<form method="post" action="/shop/CID_@productId@.html" name="sort">
   <div>
   ���������� ��: <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortNext@&s=@productSort@" title="�������� �����������"><img src="images/shop/@productSortImg@.gif" alt="�������� �����������" width="15" height="16" border="0" align="absmiddle"></a><a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=1" class="@productSortA@">��������</a> - <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=2"  class="@productSortB@">����</a> - <a href="./CID_@productId@_@productPageThis@.html?v=@productVendor@&f=@productSortTo@&s=3"  class="@productSortC@">������������</a>
   </div>
   <div style="width: 100%">
     <div style="float:left;line-height: 17px;">���� ��:&nbsp;</div>
	 <div style="float:left;"><input type="text" size="5" name="priceOT" value="@productRriceOT@"></div>
     <div style="float:left;line-height: 17px;">&nbsp;��:&nbsp;</div>
	 <div style="float:left;"><input type="text" size="5" name="priceDO" value="@productRriceDO@"></div>
     <div>
	 <input type="submit" value="���������" name="priceSearch" class="ok">
	 <input type="hidden" value="@productSort@" name="s">
	 </div>
   </div>


   </form>
</div>

<div style="padding:7px">@productPageNav@</div>

<!-- ����� ������� -->
<table cellpadding="0" cellspacing="0" border="0" width="100%">
@productPageDis@
</table>
<!-- ����� ������� -->

<div style="padding:7px">@productPageNav@</div>
