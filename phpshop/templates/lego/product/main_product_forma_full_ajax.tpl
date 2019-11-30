<div class="modal-content">
  <div class="modal-body">
    <div class="row">
	<div class="col-md-12">
	        <div class="col-xs-12">
          <div class="row">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          </div>
        </div>
	</div></div>
	 <div class="row">
      <div class="col-md-6">
        <div id="fotoload" class="product-img-modal">
                <div class="sale-icon-content">
                    @newtipIcon@
                    @specIcon@
                </div>
            
            @productFotoList@</div>
      </div>
      <div class="col-md-6">
        <div class="col-xs-12">
            <div class="row">
			<div class="product-info-block">
                <h1 itemprop="name" class="page-header"><a href="/shop/UID_@productUid@.html">@productName@</a></h1></div>
               
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
			<div class="flex-block">
                <div class="product-page-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <span class="new-price" itemprop="price" content="@productSchemaPrice@">@productPrice@</span> 
                    <span class="new-price rubznak" itemprop="priceCurrency" content="RUB">@productValutaName@</span>
					<div class="old-price">@productPriceOld@ </div>
					@ComStartNotice@
					<div class="outStock">@productOutStock@</div>
					 @ComEndNotice@
                </div>
				<div class="product-block-btn">
 @ComStartNotice@
              
                    <a class="btn btn-circle" href="/users/notice.html?productId=@productUid@" title="@productNotice@" style="font-size:18px;"><span class="icons-mail"></span></a>
               
                @ComEndNotice@ 
              
                    <button class="btn btn-circle addToCompareList" role="button" data-uid="@productUid@"><span class="icons-compare"></span></button>
                
               
                    <button class="btn btn-circle addToWishList" role="button" data-uid="@productUid@"><span class="icons-like"></span></button>
               </div>
			   </div>
				 <p><br></p>
                <div class="product-page-raiting rating">
                    @rateUid@
                </div>
				 <p><br></p>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="prodict-page-description">
                    @productDes@
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <span class="product-art">@productArt@</span>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="product-promotions">
                    @promotionInfo@
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row modal-input-fix">
                <div class="product-page-option-wrapper">
                    @optionsDisp@
                </div>
                <div class="parrent-wrapper">
                    @productParentList@
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="product-page-button">
			  			<div class="@elementCartOptionHide@">
							<div class="input-group addToCart" >
								<div class="quant-main">
									<div class="quant input-group @elementCartOptionHide@">
										<span class="input-group-btn">
											<button type="button" class="btn btn btn-default btn-default_l btn-number"  data-type="minus" data-field="quant[2]">
												-
											</button>
										</span>
										<input type="text" name="quant[2]" class="form-control form-control_gr input-number" value="1" min="1" max="100">
										<span class="input-group-btn">
											<button type="button" class=" btn btn-default btn-default_r btn-number" data-type="plus" data-field="quant[2]">
												+
											</button>
										</span>
									</div>
								</div>
								<button class="btn btn-primary addToCartFull two" data-num="1" data-uid="@productUid@">@productSale@</button>
							<a href="/order/" class="cart"></a>
							</div>
						</div>
						<div class="@elementCartHide@">
							<div class="input-group addToCart">
								<div class="quant-main">
									<div class="quant input-group @elementCartHide@">
										<span class="input-group-btn">
											<button type="button" class="btn btn btn-default btn-default_l btn-number"  data-type="minus" data-field="quant[2]">
												-
											</button>
										</span>
										<input type="text" name="quant[2]" class="form-control form-control_gr input-number" value="1" min="1" max="100">
										<span class="input-group-btn">
											<button type="button" class=" btn btn-default btn-default_r btn-number" data-type="plus" data-field="quant[2]">
												+
											</button>
										</span>
									</div>
								</div>
								<button class="btn btn-primary addToCartFull one" data-num="1" data-uid="@productUid@">@productSale@</button>
							<a href="/order/" class="cart"></a>
							</div>
						</div>

                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>