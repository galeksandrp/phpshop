
@Error@

<div class="col-xs-12">
    <div class="product-col list clearfix">
        <div class="image">
            <a href="/shop/UID_@productUid@.html" title="@productName@"><img src="@productImg@" alt="@productName@"></a>
        </div>
        <div class="caption">
            <h4><a href="/shop/UID_@productUid@.html" title="@productName@">@productName@</a></h4>
            <div class="description">
                @productDes@
            </div>
            <div class="price">
                <span class="price-new">@productPrice@ <span class="rubznak">@productValutaName@</span></span> 
                <span class="price-old">@productPriceRub@</span>
            </div>
           
        </div>
    </div>
</div>


<div class="page-header">
    <h2>������ ������</h2>
</div>

<form role="form" method="post" name="forma_message" class="template-sm">
    <div class="form-group">
        <label>������ �� ����� � ������� �����</label>
        <input type="text" name="link_to_page" value="@php  echo $_POST[link_to_page]; php@" class="form-control"  required="">
    </div>
    <div class="form-group">
        <label>���</label>
        <input type="text" name="name_person" value="@php  echo $_POST[name_person]; php@" class="form-control"  required="">
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="mail" value="@php  echo $_POST[mail]; php@" class="form-control" required="">
    </div>
    <div class="form-group">
        <label>�������</label>
        <input type="text" name="tel_name" value="@php  echo $_POST[tel_name]; php@" class="form-control">
    </div>
    <div class="form-group">
        <label>��������</label>
        <input type="text" name="org_name" value="@php  echo $_POST[org_name]; php@" class="form-control">
    </div>
    <div class="form-group">
        <label>�������������� ����������</label>
        <textarea name="adr_name" class="form-control">@php  echo $_POST[adr_name]; php@</textarea>
    </div>
    <div class="form-group">
        <span class="pull-right">
            <input type="hidden" name="send_price_link" value="ok">
            <button type="submit" class="btn btn-primary">������������ �� ����</button>
        </span>
        <img src="phpshop/captcha3.php" alt="" border="0" align="left" style="margin-right:10px"> <input type="text" name="key"  class="form-control" placeholder="��� � ��������..." style="width:150px" required="">

    </div>

</form>    
