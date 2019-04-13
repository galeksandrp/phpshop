<div class="col-md-3 col-sm-6 product-block-wrapper">
    <div class="product-col">
        <div class="image product-img-centr">
            <a href="/shop/UID_@productUid@.html" title="@productName@"> <img data-src="@productImg@" alt="@productName@"></a>
        </div>
        <div class="caption">
            <h4 class="product-name-fix"><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></h4>
            <div class="description product-description">
                <div class="description-content">
                    @productDes@
                </div>
                <div class="description-product-height-fix"></div>
            </div>
            <div class="price">
                <span class="price-new">@productPrice@ <span class="rubznak">@productValutaName@</span></span><br>
                <span class="price-old">@productPriceRub@</span>
            </div>
            <div class="cart-button button-group">
                <a class="btn btn-cart @elementCartOptionHide@" href="/shop/UID_@productUid@.html"  data-title="@productSale@" data-toggle="tooltip">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@productSale@</span>
                </a>
                <button type="button" class="btn btn-cart addToCartList @elementCartHide@" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@" data-title="@productSale@" data-toggle="tooltip">
                    <i class="fa fa-shopping-cart"></i>
                    <span>@productSale@</span>
                </button>
                <button class="btn btn-wishlist addToWishList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="fa fa-heart"></i></button>
                <button class="btn btn-wishlist addToCompareList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip"><i class="fa fa-bar-chart-o"></i></button>

                <a class="btn btn-cart @elementNoticeHide@" href="/users/notice.html?productId=@productUid@" title="@productNotice@"  data-title="@productNotice@" data-placement="top" data-toggle="tooltip">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>                            
                </a>                                   
         
            </div>
        </div>
    </div>
</div>