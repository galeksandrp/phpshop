<ol class="breadcrumb hidden-xs">
    <li><a href="/" >{�������}</a></li>
    <li class="active">{�����-����}</li>
</ol>

<div class="page-header">
    <h2>{�����-����} @priceCatName@</h2>
</div>


<ul class="nav nav-pills price-panel">
    <li role="presentation"><div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                {������� ��������}
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                @searchPageCategoryDrop@
            </ul>
        </div></li>
    <li role="presentation"><a href="/shop/CID_@PageCategory@.html" id="price-form" data-uid="@PageCategory@">{����� � ���������}</a></li>
    <li role="presentation"><a href="phpshop/forms/priceprint/print.html?catId=@PageCategory@">{�������� �����}</a></li>
    <li role="presentation"><a href="/files/priceSave.php?catId=@PageCategory@">Excel {�����}</a></li>
    <li role="presentation" class="@onlinePrice@"><a href="/files/onlineprice/">{������������� �����}</a></li>
</ul>

<p>@productPageDis@</p>

