<div class="col-md-6 col-sm-6">
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
																<a class="btn btn-cart addToCartList @elementCartOptionHide@" href="/shop/UID_@productUid@.html" data-title="{�������}" data-placement="top" data-toggle="tooltip"><span class="icons-cart"></span>@productSale@</a>

				@ComStartCart@
				<button type="button" class="btn btn-cart addToCartList" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">{������}</button>
				@ComEndCart@

				@ComStartNotice@
				<a class="btn btn-cart" href="/users/notice.html?productId=@productUid@" title="@productNotice@">{���������}</a>                                   
				@ComEndNotice@ 

				<button class="btn btn-compare addToCompareList" data-uid="@productUid@"><i class="fa fa-sliders" aria-hidden="true"></i>{��������}</button>
				<button class="btn btn-wishlist addToWishList" data-uid="@productUid@"><i class="fa fa-heart-o" aria-hidden="true"></i>{��������}</button>

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