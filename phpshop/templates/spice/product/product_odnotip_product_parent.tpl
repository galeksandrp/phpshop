<div class="form-group">
    <label class="control-label text-uppercase">�������� ����� �� ������</label>
    @parentList@
</div>
<div class="cart-button button-group cart-list-button-wrapper">
    <button type="button" class="btn btn-cart addToCartListParent" role="button" data-num="1" data-uid="@parentId@" data-parent="@productUid@">
        <i class="fa fa-shopping-cart"></i>                                 
            @productSale@
    </button>                                     
</div>
<div class="cart-button button-group compare-list-button-wrapper">
    <button type="button" class="btn btn-cart addToWishList" role="button" data-uid="@productUid@">
        <i class="fa fa-heart" aria-hidden="true"></i>                            
            ��������
    </button>                                   
</div>
<div class="cart-button button-group compare-list-button-wrapper">
    <button type="button" class="btn btn-cart addToCompareList" role="button" data-uid="@productUid@">
        <i class="fa fa-refresh" aria-hidden="true"></i>                            
            ��������
    </button>                                   
</div>
<input type="hidden" id="parentId" value="@parentCheckedId@"/>
