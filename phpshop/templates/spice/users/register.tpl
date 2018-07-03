<section class="registration-area">
    <div class="col-sm-12">
        <!-- Registration Block Starts -->
            <div class="panel panel-smart">
                <div class="panel-heading">
                    <h3 class="panel-title">������������ ����������</h3>
                </div>
                <div class="panel-body">
                    <!-- Registration Form Starts -->
                        <form role="form" method="post" name="user_forma_register" class="form-horizontal">
                            <span id="user_error">@user_error@</span>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">���</label>
                                <div class="col-sm-9">
                                    <input type="text"  name="name_new" value="@php echo $_POST['name_new']; php@"  class="form-control" required="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-mail</label>
                                <div class="col-sm-9">
                                    <input type="email" name="login_new" value="@php echo $_POST['login_new']; php@" class="form-control" required="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">������</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_new"  class="form-control"  required="" >
                                </div>
                            </div>
                            <div class="form-group" id="check_pass">
                                <label class="col-sm-3 control-label">��������� ������</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password_new2"  class="form-control" required="">
                                    <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <img src="phpshop/captcha3.php" alt="" border="0" align="left" style="margin-right:10px"> <input type="text" name="key"   class="form-control" id="exampleInputEmail1" placeholder="��� � ��������..." style="width:150px" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <input type="hidden" value="1" name="add_user">
                                    <button type="reset" class="btn btn-main">��������</button>
                                    <button type="submit" class="btn btn-main">����������� ������������</button>
                                </div>
                            </div>
                        </form>
                    <!-- Registration Form Starts -->
                </div>
            </div>
        <!-- Registration Block Ends -->
    </div>
</section>