<ol class="breadcrumb hidden-xs">
    @breadCrumbs@
</ol>
<div class="page-header ">
    <h2>@pageTitle@</h2>
</div>

@catContent@
<div class="@php if(isset($GLOBALS['SysValue']['other']['catContent'])) echo 'grid';  php@">
    @pageContent@
</div>
<div class="clearfix"></div>
<h3 class="@php __hide('pageLast'); php@  page-header last-header">Интересно почитать</h3>
<div class="@php if(!empty($GLOBALS['SysValue']['other']['pageLast'])) echo 'grid'; php@">@pageLast@</div>
<p>@odnotipDisp@</p>
