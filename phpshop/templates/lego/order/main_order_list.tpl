<style>#catalog-menu, .sidebar-left-inner {display:none}</style>

<ol class="breadcrumb">
    <li><a href="/" >{Главная}</a></li>
    <li class="active">{Ваша корзина}</li>
</ol>
<div class="order">
<div class="main-cart-header">

    <h2>{Ваша корзина}</h2>
        
    <a href="?cart=clean" class="btn cart-clean"> {Очистить корзину}</a> 
   

</div>

<div class="img_fix">
    @orderContentCart@
</div>



@orderContent@ 
</div>