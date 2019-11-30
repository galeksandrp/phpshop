<div class="panel panel-default">
    <div class="panel-body">
        <div class="media">
            <span class="sale-icon-content">
                @specIcon@
                @newtipIcon@
                @hitIcon@
                @promotionsIcon@
            </span>
            <a class="media-left text-center" href="/shop/UID_@productUid@.html" title="@productName@" style="min-width:200px"><img data-src="@productImg@" alt="@productName@"></a>
            <div class="media-body">
                <h3 class="media-heading"><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></h3>
                <p>@productDes@</p>
            <h4 class="product-price">@productPrice@<span class="rubznak">@productValutaName@</span><sup class="text-muted">@productPriceOld@</sup></h4>
								<div class="stock">
@ComStartNotice@
<div class="outStock">@productOutStock@</div>
@ComEndNotice@
<span class="product-sklad-list-block">@productSklad@</span>
</div>
                <div class="pull-right">
                    <a class="btn btn-primary addToCartList @elementCartOptionHide@" href="/shop/UID_@productUid@.html">@productSale@</a>
                    <button class="btn btn-primary addToCartList @elementCartHide@" data-uid="@productUid@" role="button">@productSale@</button>
                    <button class="btn btn-default addToWishList" role="button" data-uid="@productUid@">{��������}</button>
                </div>
            </div>
        </div>
    </div>
</div>