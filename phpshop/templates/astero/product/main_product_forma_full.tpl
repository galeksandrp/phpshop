<!-- Product -->
<div itemscope itemtype="http://schema.org/Product">
    <div class="row product-info product-page-wrapper" >
        <!-- Left Starts -->
        <div class="col-sm-5 images-block">
            <div id="fotoload">
                @productFotoList@
            </div>
        </div>
        <!-- Left Ends -->
        <!-- Right Starts -->
        <div class="col-sm-7 product-details">
            <!-- Product Name Starts -->
            <h1 itemprop="name">@productName@</h1>
            <!-- Product Name Ends -->
            <hr>
            <!-- Manufacturer Starts -->
            <ul class="list-unstyled manufacturer product-page-list">
                <li>
                    @productArt@
                </li>
                <li>
                    @productSklad@
                </li>
                <li>
                    <div class="rating">
                        <span>������� :</span>
                        @rateUid@
                    </div>
                </li>
                <li>@promotionInfo@</li>
                <li>@oneclick@</li>
                <li><a href="/pricemail/UID_@productUid@.html">@productBestPrice@</a></li>
            </ul>
            <!-- Manufacturer Ends -->
            <hr>
            <!-- Price Starts -->
            <div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <span class="price-head">{����}:</span>
                <span class="price-new" itemprop="price">@productPrice@</span> 
                <span class="price-new rubznak" itemprop="priceCurrency" content="RUB">@productValutaName@</span>
                <span class="price-old">@productPriceRub@</span>
            </div>
            <!-- Price Ends -->
            <hr>
            <!-- Available Options Starts -->

            <div class="options fix-wrapper">

                <div class="product-page-option-wrapper">
                    @optionsDisp@
                </div>
                @productParentList@



                <label class="control-label text-uppercase @elementCartHide@">{����������}</label>
                <div class="quant input-group @elementCartHide@">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default btn-default_l btn-number"  data-type="minus" data-field="quant[2]">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </span>
                    <input type="text" name="quant[2]" class="form-control form-control_gr input-number" value="1" min="1" max="100">
                    <span class="input-group-btn">
                        <button type="button" class=" btn btn-default btn-default_r btn-number" data-type="plus" data-field="quant[2]">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                </div>
                <p></p>
                <div class="cart-button button-group cart-list-button-wrapper @elementCartHide@">
                    <button type="button" class="btn btn-cart addToCartFull" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">
                        <i class="fa fa-shopping-cart"></i>                                 
                        <span>@productSale@</span>
                    </button>                                   
                </div>
               <div class="cart-button button-group cart-list-button-wrapper  @elementCartOptionHide@">
                    <button type="button" class="btn btn-cart addToCartFull" role="button" data-num="1" data-uid="@productUid@" data-cart="@productSaleReady@">
                        <i class="fa fa-shopping-cart"></i>                                 
                        <span>@productSale@</span>
                    </button>                                   
                </div>
                <div class="cart-button button-group compare-list-button-wrapper">
                    <button type="button" class="btn btn-cart addToWishList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip">
                        <i class="fa fa-heart" aria-hidden="true"></i>                            
                        {��������}
                    </button>                                   
                </div>
                <div class="cart-button button-group compare-list-button-wrapper">
                    <button type="button" class="btn btn-cart addToCompareList" role="button" data-uid="@productUid@" data-title="{��������}" data-placement="top" data-toggle="tooltip">
                        <i class="fa fa-refresh" aria-hidden="true"></i>                            
                        {��������}
                    </button>                                   
                </div>


                @ComStartNotice@
                <div class="cart-button button-group compare-list-button-wrapper">
                    <a class="btn btn-cart" href="/users/notice.html?productId=@productUid@" title="@productNotice@">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>                            
                        {���������}
                    </a>                                   
                </div>
                @ComEndNotice@ 

            </div>

        </div>
        <!-- Right Ends -->
    </div>
    <!-- product Info Ends -->

    <!-- Product Description Starts -->
    <div class="product-info-box">
        <h4 class="heading">{��������}</h4>
        <div class="content panel-smart" itemprop="description">
            @productDes@
        </div>
    </div>
    <!-- Product Description Ends -->

    <!-- Additional Information Starts -->
    <div class="product-info-box empty-check">
        <h4 class="heading">{��������������}</h4>
        <div class="content panel-smart">
            @vendorDisp@
        </div>
    </div>
    <!-- Additional Information Ends -->

    <!-- Reviews Information Starts -->
    <div class="product-info-box">
        <h4 class="heading">{������}</h4>
        <div class="content panel-smart">
            <div id="commentList"></div>
            <button role="button" class="btn btn-info btn-show-comment-add-block" onclick="$('#addComment').slideToggle();
                    $(this).hide();"><span class="glyphicon glyphicon-plus-sign"></span> {����� �����������}</button>
            <div id='addComment' class="well well-sm" style='display:none;margin-top:30px;'>
                <h3>{�������� ���� �����}</h3>
                <textarea id="message" class="commentTexttextarea form-control"></textarea>
                <input type="hidden" id="commentAuthFlag" name="commentAuthFlag" value="@php if($_SESSION['UsersId']) echo 1; else echo 0; php@">
                <br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-success btn-sm">
                        <input type="radio" name="rate" value="1"> +1
                    </label>
                    <label class="btn btn-success btn-sm">
                        <input type="radio" name="rate" value="2"> +2
                    </label>
                    <label class="btn btn-success btn-sm">
                        <input type="radio" name="rate" value="3"> +3
                    </label>
                    <label class="btn btn-success btn-sm">
                        <input type="radio" name="rate" value="4"> +4
                    </label>
                    <label class="btn btn-success btn-sm active">
                        <input type="radio" name="rate" value="5" checked> +5
                    </label>
                    <button role="button" class="btn btn-info btn-sm pull-right" onclick="commentList('@productUid@', 'add', 1);">{�������������}</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
                $(document).ready(function() {
                    commentList('@productUid@', 'list');
                });
        </script>
    </div>
    <!-- Reviews Information Ends -->

    <!-- Files Information Starts -->
    <div class="product-info-box empty-check">
        <h4 class="heading">{�����}</h4>
        <div class="content panel-smart">
            @productFiles@
        </div>
    </div>
    <!-- Files Information Ends -->

    <!-- Articles Information Starts -->
    <div class="product-info-box empty-check">
        <h4 class="heading">{������}</h4>
        <div class="content panel-smart">
            @pagetemaDisp@
        </div>
    </div>
    <!-- Articles Information Ends -->


    <!-- ��������� ���� ����������� -->
    <div class="modal bs-example-modal" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title" id="myModalLabel">@productName@</h4>
                </div>
                <div class="modal-body">
                    @productFotoListBig@

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{�������}</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ ��������� ���� ����������� -->
</div>