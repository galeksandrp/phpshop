<!-- Product Filter Starts -->
<div class="mobile-filter">Фильтр</div>
<div class="big-filter-wrapper  filter-list">
<span class="close filter-close visible-xs"><i class="fal fa-times" aria-hidden="true"></i></span>
<div class="clearfix"></div>

<!-- Фасетный фильтр -->
    <div class="hide" id="faset-filter">
	        <div id="price-filter-body">
            <div class="faset-filter-block-wrapper">
                <h4>{Цена}</h4>
                <div>
                    <form method="get" id="price-filter-form">
                        <div class="row">
                            <div class="col-md-6 col-xs-6" id="price-filter-val-min">
                                
                                <input type="text" class="form-control-price form-control input-sm" name="min" value="@price_min@" > 
                            </div>
                            <div class="col-md-6 col-xs-6 " id="price-filter-val-max">
                                
                                <input type="text" class="form-control-price form-control input-sm pull-right" name="max" value="@price_max@"> 
                            </div>
                        </div>
                        <div id="slider-range" ></div>
                    </form>
                </div>
            </div>
        </div>
        <div id="faset-filter-body">{Загрузка}...</div>

        <a href="?" id="faset-filter-reset" data-toggle="tooltip" data-placement="top" title="{Сбросить фильтр}">{Сбросить фильтр}</a>
    </div>
	<div class="filter-btn-block">			
			<a href="?" class="faset-filter-reset filter-btn visible-xs  btn-default btn"  data-toggle="tooltip" data-placement="top" title="{Сбросить фильтр}">{Сбросить фильтр}</a>
			 <span class="filter-close oneclick-btn filter-btn visible-xs"  >{Применить}</span>
</div>
<!--/ Фасетный фильтр -->
</div>
<style type="text/css">.main-container  .row, section .row{margin:0}</style>
    <div class="product-filter hidden-xs" id="filter-well">
        <div class="row">
            <div class="col-md-6 hidden-xs">
                <div class="display" data-toggle="buttons">
                    <label class="btn btn-sm fal fa-bars btn-sort @gridSetAactive@" data-toggle="tooltip" data-placement="top" title="{Товары списком}">
                        <input type="radio" name="gridChange" value="1">
                    </label>
                    <label class="btn btn-sm fal fa-th btn-sort @gridSetBactive@" data-toggle="tooltip" data-placement="top" title="{Товары сеткой}">
                        <input type="radio" name="gridChange" value="2">
                    </label>
                </div>
            </div>
            <div class="col-md-6 filter-well-right-block col-xs-12">
                <div class="display">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-sm btn-sort fal fa-signal-4  @sSetCactive@" data-toggle="tooltip" data-placement="top" title="{По умолчанию}">
                            <input type="radio" name="s" value="3">
                        </label>
                        <label class="btn btn-sm btn-sort fal fa-sort-alpha-down @sSetAactive@" data-toggle="tooltip" data-placement="top" title="{Наименование}">
                            <input type="radio" name="s" value="1">
                        </label>
                        <label class="btn btn-sm btn-sort fal fa-sort-numeric-down @sSetBactive@" data-toggle="tooltip" data-placement="top" title="{Цена}">
                            <input type="radio" name="s" value="2">
                        </label>
                    </div>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-xs btn-sort fal fa-sort-amount-up @fSetAactive@" data-toggle="tooltip" data-placement="top" title="{По возрастанию}">
                            <input type="radio" name="f" value="1">
                        </label>
                        <label class="btn btn-xs btn-sort fal fa-sort-amount-down @fSetBactive@" data-toggle="tooltip" data-placement="top" title="{По убыванию}">
                            <input type="radio" name="f" value="2">
                        </label>
                    </div>
                </div>
            </div>
        </div> 
        <a ></a>
        <form method="post" action="/shop/CID_@productId@@nameLat@.html" name="sort" id="sorttable" class="hide">
            <table><tr>@vendorDisp@<td>@vendorSelectDisp@</td></tr></table>
        </form>                      
    </div>
<!-- Product Filter Ends -->
