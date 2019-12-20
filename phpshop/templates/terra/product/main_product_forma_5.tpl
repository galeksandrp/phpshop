<div class="col-md-3 col-sm-6">
	<div class="product-col">

		<div class="image product-img-centr">
			<a href="/shop/UID_@productUid@.html" title="@productName@"> <img data-src="@productImg@" alt="@productName@" class="img-responsive img-center-sm" ></a>
		</div>

		<div class="rating">@rateCid@</div>
		
		<div class="caption">
			<h4><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></h4>
			<div class="price">
				<span class="price-new">@productPrice@ <span class="rubznak">@productValutaName@</span></span> 
				<span class="price-old">@productPriceOld@</span>
			</div>
			<div class="stock">
@ComStartNotice@
<div class="outStock">@productOutStock@</div>
@ComEndNotice@
</div>
			<div class="cart-button button-group">
				@ComStartCart@
				<button type="button" class="btn btn-cart addToCartList addToCartListMainPage" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">Купить</button>
				@ComEndCart@

				@ComStartNotice@
				<a class="btn btn-cart" href="/users/notice.html?productId=@productUid@" title="@productNotice@">Уведомить</a>                                   
				@ComEndNotice@ 

			</div>
		</div>
		<div class="sale-icon-content">
			@specIcon@
			@newtipIcon@
			@hitIcon@
			                @promotionsIcon@
		</div>
	</div>
</div>