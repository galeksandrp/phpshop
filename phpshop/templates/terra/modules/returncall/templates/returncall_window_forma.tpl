<!-- ��������� ���� returncall-->
        <div class="modal fade bs-example-modal-sm" id="returnCallModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">@leftMenuName@</h4>
                    </div>
                     <form method="post" name="user_forma" action="@ShopDir@/returncall/">
                    <div class="modal-body">
                       
                            <div class="form-group">
                                <input type="text" name="returncall_mod_name" class="form-control" placeholder="���..." required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="returncall_mod_tel" class="form-control" placeholder="�������..." required="">
                            </div>
                            <div class="form-group">
                                <input placeholder="����� ������:" class="form-control" type="text" name="returncall_mod_time_start">
                            </div>
                            <div class="form-group">
                                <textarea placeholder="���������" class="form-control" name="returncall_mod_message"></textarea>
                            </div>
                            @returncall_captcha@
                           
                       
                    </div>
                     <div class="modal-footer">
                                <input type="hidden" name="returncall_mod_send" value="1">
                                <button type="submit" class="btn btn-primary">�������� ������</button>
                     </div>
                     </form>
                </div>
            </div>
        </div>
<a href="#" data-toggle="modal" data-target="#returnCallModal"><i class="fa fa-phone" aria-hidden="true"></i> �������� ������</a>
