<div class="breadcrumb">
    <div> <a href="/">�������</a> <span>�</span> @catalogCategory@ </div>
</div>
<h1>@catalogCategory@</h1>
<h2>@sortName@</h2>
<div align="left" style="padding:5px 0px"> @sortDes@ </div>
<div align="left" style="padding:5px 0px"> @DispCatNav@ </div>


<NOINDEX>
    <div class="productFilter clearfix">
        <div class="sortBy inline pull-left">
            <div class="sort"> ����������� ��
                <select onchange="location = this.value;">
                    <option value="?">���������</option>
                    <option value="?@productVendor@&f=1&s=1">������������ (����)</option>
                    <option value="?@productVendor@&f=2&s=1">������������ (����)</option>
                    <option value="?@productVendor@&f=1&s=2">���� (����)</option>
                    <option value="?@productVendor@&f=2&s=2">���� (����)</option>
                </select>
            </div>
        </div>
        <!--end sortBy-->
        <div class="displaytBy inline pull-right"> �����
            <div class="btn-group">
                <a href="?@productVendor@&f=@php echo $_GET['f']; php@&s=@php echo $_GET['s']; php@&gridChange=2" title="�����" class="btn @gridChange2@"><i class="icon-th"></i></a> 
                <a href="?@productVendor@&f=@php echo $_GET['f']; php@&s=@php echo $_GET['s']; php@&gridChange=1" title="������" class="btn @gridChange@"><i class="icon-list"></i></a>
            </div>
        </div>
        <!--end displaytBy-->
    </div>
    <br>
</NOINDEX>


<div style="overflow:hidden; margin-top:20px;">
    <ul class="hProductItems clearfix"  id="product-scroll">
        @productPageDis@
    </ul>
</div>

<div class="navi">@productPageNav@</div>
