<table>
    <tr>
        <td ><br> @parentList@ <br></td>
    </tr>
    <tr>
        <td>
            <span class="input-append"><input class="span1" type="text" id="n@productUid@" name="n@productUid@" value="1" placeholder="1">
            <button onclick="AddToCartParent(@productUid@); return false;" class="btn btn-primary" rel="tooltip" data-original-title="� �������"><i class="icon-shopping-cart"></i> @productSale@</button></span>
            <button class="btn" onclick="addToWishList(@productUid@); return false;"  data-toggle="tooltip" rel="tooltip" data-original-title="��������" data-title="+ ��������"><i class="icon-heart"></i></button>
            <button onclick="AddToCompare(@productUid@); return false;" class="btn" data-toggle="tooltip" rel="tooltip" data-original-title="��������" data-title="�������� @productName@"><i class="icon-refresh"></i></button>
            <input type="hidden" id="parentId" value="@parentCheckedId@"/>
        </td>
    </tr>
</table>
