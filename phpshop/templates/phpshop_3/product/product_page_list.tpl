
<p style="padding-top:15px">@DispCatNav@</p>
<div align="left">
    <span id="catalogContent">@catalogContent@</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>

        <td width="100%" bgcolor="#FAFAFA" id=allspec2 >
    <NOINDEX>
        <form method="post" action="./CID_@productId@.html" name="sort">
            <table  width="100%" cellpadding="0" cellspacing="10" >
                <tr>
                    <td class="black">
                        ���������� ��: <a href="./CID_@productId@_@productPageThis@.html?@productVendor@&f=@productSortNext@&s=@productSort@" title="�������� �����������"><img src="images/shop/@productSortImg@.gif" alt="�������� �����������" hspace="3" border="0" align="absmiddle"></a><a href="./CID_@productId@_@productPageThis@.html?@productVendor@&f=@productSortTo@&s=1" class="@productSortA@">��������</a> - <a href="./CID_@productId@_@productPageThis@.html?@productVendor@&f=@productSortTo@&s=2"  class="@productSortB@">����</a> - <a href="./CID_@productId@_@productPageThis@.html?@productVendor@&f=@productSortTo@&s=3"  class="@productSortC@">������������</a>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                @vendorDisp@
                                <td> @vendorSelectDisp@</td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td style="padding-left:10px;padding-top:5px">
                        @productPageNav@
                    </td>
                </tr>

            </table>
        </form>
    </NOINDEX>
</td>

</tr>
</table>
<div align="right" style="padding:10px">
    <img src="images/shop/page_excel.gif" alt="" border="0" align="absmiddle" hspace="5"><a href="/price/CAT_SORT_@pcatalogId@.html" title="�����-���� �������� @catalogCategory@">�����-���� ��������</a>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <!-- main_product_forma -->
                @productPageDis@
                <!-- main_product_forma-->
            </table>
        </td>
    </tr>
    <tr>
        <td width="100%" style=padding-left:10px class=style8 colspan="2">
            <div style="padding-top:15px;padding-bottom:15px" class=black>
                @productPageNav@
            </div>
        </td>
    </tr>
</table>