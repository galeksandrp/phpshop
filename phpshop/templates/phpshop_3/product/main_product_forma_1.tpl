	<TABLE  border="0" cellpadding="0" cellspacing="10" >
	   <TR>
			<TD width="110">
				<A href="/shop/UID_@productUid@.html" class="product_name"  title="@productName@"><img src="@productImg@" lowsrc="images/shop/no_photo.gif"  onerror="NoFoto(this,'@pathTemplate@')"  alt="@productName@" title="@productName@" border="0" align="left" hspace="5"></A>
			</TD>
		
			<TD width="340">
				<DIV>
		<A href="/shop/UID_@productUid@.html" class="product_name"  title="@productName@">@productName@</A><br>
        <br>
@productDes@
				</DIV>
			</TD>
	 
		<TD valign="middle" width="130">
		
		
		<!-- ���� ��������� -->
    @ComStartNotice@
    <img src="images/icon_email.gif" alt="" border="0" align="absmiddle">
	<A href="/users/notice.html?productId=@productUid@" title="@productNotice@">@productNotice@</A>
	@ComEndNotice@
	<!-- ���� ��������� -->
	
	<!-- ���� ������� -->
	@ComStartCart@
    <nobr>
   <A href="javascript:AddToCart(@productUid@)" class="b"  title="@productSale@"> <img src="images/shop/basket_put.gif" alt="" border="0" align="absmiddle"></A>
	<A href="javascript:AddToCart(@productUid@)" class="b"  title="@productSale@">@productSale@</A>
    </nobr>
	@ComEndCart@
    <br />

@ComStart@
		<strong class=price >   <nobr>@productPrice@ @productValutaName@  </nobr></strong><br>
		<font class=black>@productPriceRub@</font>
		@productSklad@
		@ComEnd@
	<!-- ���� ������� -->


									</TD>
		</TR>
		
	</TABLE>
