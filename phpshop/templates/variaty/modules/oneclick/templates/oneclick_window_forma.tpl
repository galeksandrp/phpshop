

<!-- ��������� ���� oneClickModal-->
<div class="modal hide fade" id="oneClickModal" style="width:auto !important;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>@leftMenuName@</h3>
    </div>
    <form role="form" method="post" name="user_forma" action="@ShopDir@/oneclick/">
        <div class="modal-body">

            <div class="form-group">
                <label>���</label>
                <input type="text" name="oneclick_mod_name" class="form-control" placeholder="���..." required="">
            </div>
            <div class="form-group">
                <label>�������</label>
                <input type="text" name="oneclick_mod_tel" class="form-control" placeholder="�������..." required="">
            </div>

        </div>
        <div class="modal-footer">
            <input type="hidden" name="oneclick_mod_product_id" value="@productUid@">
            <input type="hidden" name="oneclick_mod_send" value="1">
            <button type="button" class="btn btn-default" data-dismiss="modal">�������</button>
            <button type="submit" class="btn btn-primary">��������</button>
        </div>
    </form>
</div>

<a class="btn btn-success" href="#oneClickModal" data-toggle="modal">������ � 1 ����!</a>