<table width="168" height="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><DIV style="padding:10px 5px 10px 5px; ">
		<A href="/shop/UID_@productUid@.html" class="product_name"  title="@productName@">@productName@</A>
				</DIV></td>
  </tr>
  <tr>
    <td align="center" valign="top"><A href="/shop/UID_@productUid@.html" class="product_name"  title="@productName@"><img src="@productImg@" alt="@productName@" title="@productName@" lowsrc="images/shop/no_photo.gif"  onerror="NoFoto(this,'@pathTemplate@')"  border="0" ></A></td>
  </tr>
  <tr>
    <td valign="top" align="center">
    <TABLE   BORDER=0 CELLPADDING=0 CELLSPACING=0 width="100%" title="����: @productName@">
	<TR>
		<TD height="21" align="center"  >
		<strong class=price > @productPrice@ @productValutaName@</strong><br>
		<font class=black>@productPriceRub@</font><br>
		@productSklad@
		</TD>
	</TR>
</TABLE>
    <TABLE  cellpadding="0" border="0" cellspacing="0">
							    <tr>
								<TD valign="middle">@ComStartCart@<A href="javascript:AddToCart(@productUid@)" class=b  title="������ @productName@"><nobr>@productSale@</nobr></A>@ComEndCart@@ComStartNotice@<A href="/users/notice.html?productId=@productUid@" title="@productNotice@">@productNotice@</A>@ComEndNotice@
                                    </TD>
								   <TD >
								   @ComStartCart@
								<A href="javascript:AddToCart(@productUid@)" class=b  title="������ @productName@"><img hspace="5" src="images/shop/basket_put.gif" alt="� �������" border="0"></A>	@ComEndCart@ <!-- ���� ��������� -->
    @ComStartNotice@
    <img src="images/icon_email.gif" alt="" border="0" align="absmiddle">
	@ComEndNotice@
	<!-- ���� ��������� -->
									</TD>
									
								</tr>
							</TABLE></td>
  </tr>
</table>


