            <div class="col-md-3 col-sm-3 product-block-wrapper">
	            <span class="sale-icon-content">
                @specIcon@
			@newtipIcon@
			@hitIcon@
			@promotionsIcon@
            </span>
                 <div class="product-col">
                     <div class="image product-img-centr">
                       <a href="/shop/UID_@productUid@.html" title="@productName@"> <img data-src="@productImg@" alt="@productName@" class="img-responsive img-center-sm" ></a>
                     </div>
                     <div class="caption">
                         <div class="description">
                         <h4><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></h4>
                           <!-- productDes@ -->
                         </div>
                         <div class="price">
                             <span class="price-new">@productPrice@<span class="rubznak">@productValutaName@</span></span> 
                             <span class="price-old">@productPriceOld@</span>
                         </div>
<div class="stock">
@ComStartNotice@
<div class="outStock">@productOutStock@</div>
@ComEndNotice@
<span class="product-sklad-list-block">@productSklad@</span>
</div>                         <div class="cart-button button-group">
                            @ComStartCart@
                             <button type="button" class="btn btn-cart addToCartList addToCartListMainPage" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">
                                 <i class="icon-basket"></i>                     
                                 <span>@productSale@</span>
                             </button>
                             @ComEndCart@                             
                         </div>
                     </div>
                 </div>
             </div>