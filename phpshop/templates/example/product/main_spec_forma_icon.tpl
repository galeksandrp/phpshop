<table cellpadding="5" cellspacing="0" border="1" width="100%" style="margin-bottom: 10px">
  <tr>
    <td>
      <a class="highslide" onclick="return hs.expand(this)" href="@productImgBigFoto@" target="_blank" getParams="null" title="@productName@"><img src="@productImg@" lowsrc="images/shop/no_photo.gif" onload="EditFoto(this,@productImgWidth@)" onerror="NoFoto(this,'@pathTemplate@')"  alt="@productName@" title="@productName@" border="0"></a><div class="highslide-caption">@productName@</div>
    </td>
  </tr>
  <tr>
	<td>
    
      <!-- ����� ����� ������ -->
      <div style="padding-bottom:6px"><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></div>
      <!-- ����� ����� ������ -->
      
      <!-- ����� �������� �������� ��� ������������ ������� -->
      @productDesOdnotip@
      <!-- ����� �������� �������� ��� ������������ ������� -->
      
    </td>
  </tr>
  <tr>
	<td>
    @ComStart@
    
      <!-- ����� ������ ���� -->
	  @productPriceRub@
      <!-- ����� ������ ���� -->
      
      <div style="padding-bottom:6px; padding-top:6px"> ����: <strong>@productPrice@</strong> @productValutaName@  </div>
      
      <!-- ����� ���������� �� ������ -->
	  @productSklad@
      <!-- ����� ���������� �� ������ -->
      
    @ComEnd@
    </td>
  </tr>
  <tr>
	<td align="center">
        <!-- ���� ��������� -->
        @ComStartNotice@ <img src="images/icon_email.gif" alt="" border="0" align="absmiddle" hspace="5">
        <a href="/users/notice.html?productId=@productUid@" title="@productNotice@">@productNotice@</a> @ComEndNotice@
        <!-- ���� ��������� -->

        <!-- ���� ������� -->
        @ComStartCart@ <img src="images/shop/basket_put.gif" alt="" border="0" align="absmiddle" hspace="5">
        <a href="javascript:AddToCart(@productUid@)" title="@productSale@">@productSale@</a> @ComEndCart@
        <!-- ���� ������� -->
    </td>
  </tr>
  <tr>
	<td align="center">
        <!-- ���� ��������  -->
        <img src="images/shop/information.gif" alt="@productInfo@" border="0" align="absmiddle" hspace="5">
        <a href="/shop/UID_@productUid@.html">@productInfo@</a>
        <!-- ���� �������� -->
    </td>
  </tr>
  <tr>
	<td align="center">
        <!-- ���� �������� -->
        <img src="images/shop/application_view_tile.gif" alt="��������" border="0" align="absmiddle" hspace="5">
        <a href="javascript:AddToCompare(@productUid@)" title="�������� @productName@">��������</a>
        <!-- ���� �������� -->
     </td>
  </tr>
</table>
