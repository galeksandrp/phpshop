<div class="plashka_center">@catalogCategory@</div>

<a name="up"></a>
<div class="page_nava">
    <div ><a href="/">�������</a>  /  @catalogCategory@</div>
</div>
<br>
<form method="post" action="/spec/" name="sort">
    <div id="allspec" class="bg_sort">

        <div class="allspec_pad">
            <b>������� ����</b><span class="pad_7"><b>�����������</b> ������ ��</span>
        </div>
        <div style="width: 100%" class="allspec_pad">
            <div style="float:left;line-height: 17px;"></div>
            <div style="float:left;"><input type="text" class="sort" name="priceOT" title="��" onfocus="this.value = ''" value="��"></div>
            <div style="float:left;line-height: 17px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div class="left"><input type="text" class="sort" title="��" onfocus="this.value = ''" name="priceDO" value="��"></div>
            <div class="pad_6"><span><a href="?f=@productSortTo@&s=1" class="@productSortA@">��������</a> - <a href="?f=@productSortTo@&s=2"  class="@productSortB@">����</a> - <a href="?f=@productSortTo@&s=3"  class="@productSortC@">������������</a></span></div>

        </div>

            <div id="product_cart_3" class="pad_8">
                <div><input type="submit" value="��������" name="priceSearch"></div>
                <input type="hidden" value="@productSort@">
            </div>
    </div>

    <div class="vendordisp">@vendorDisp@ @vendorSelectDisp@</div>
    <div class="pad_11">@vendorDispTitle@</div>


</form>
<div class="link_prise">
    <img src="images/shop/page_excel.gif" alt="" border="0" align="absmiddle" hspace="5"><a href="/price/CAT_SORT_@pcatalogId@.html" title="�����-���� �������� @catalogCategory@">�����-���� ��������</a>
</div>
<div class="page_nava" style="padding-bottom:10px;">
    <div class="page_nav">@productPageNav@</div>

</div>

<table cellpadding="0" cellspacing="0" border="0">
    @productPageDis@
</table>

<div class="page_nava" style="margin-top:20px;">
    <div class="page_nav">@productPageNav@</div>

</div>
<a name="down"></a>