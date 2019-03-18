<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@pageTitl@</title>
        <meta name="description" content="@pageDesc@">
        <meta name="keywords" content="@pageKeyw@">
        <meta name="copyright" content="@pageReg@">
        <meta name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <meta name="domen-copyright" content="@pageDomen@">
        <meta content="General" name="rating">
        <meta name="ROBOTS" content="ALL">
        <link rel="apple-touch-icon" href="@icon@">

        <!-- Bootstrap -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@bootstrap_fluid_theme@.css" rel="stylesheet">
       
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">
          <!-- Template -->
        <link href="@pageCss@" type="text/css" rel="stylesheet">
        
        <!-- Solid Menu -->
        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/solid-menu.css"> 
        
        <!-- Menu -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/menu.css" rel="stylesheet">

        <!-- Highslide -->
        <link href="java/highslide/highslide.css" rel="stylesheet">

        <!-- Bootstrap-select -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet"> 
        
        <!-- Suggestions -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">

        <!-- UI -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery-ui.min.css" rel="stylesheet">
        
        <!-- Slider -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.bxslider.css" rel="stylesheet">
        
        <!-- Bar -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

        <script src="java/jqfunc.js"></script>

        <!-- Header -->
        <header class="container-fluid visible-lg visible-md">

            <div class="row vertical-align">
                <div class="col-md-3 text-center">
                    <div class="logo">
                    <a href="/" title="@name@"><img src="@logo@" alt="@name@"></a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills pull-right">
                                @usersDisp@
                                <li role="presentation">@wishlist@</li>
                                <li role="presentation"><a href="/compare/"><span class="glyphicon glyphicon-eye-open"></span> {��������} (<span id="numcompare">@numcompare@</span>)</a></li>
                                <li role="presentation" class="@cart_active@" id="order"><a href="/order/"><span class="glyphicon glyphicon-gift"></span> {�������� �����}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7"><h4>{���}: @telNumMobile@</h4></div>
                        <div class="col-md-5"><form action="/search/" role="search" method="post">
                                <div class="input-group">
                                    <input name="words" maxlength="50" id="search" class="form-control" placeholder="{������}.." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content=""><span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!--<div class="col-md-3">@valutaDisp@</div>-->
                    </div>    
                </div>
            </div>
        </header>
        <!--/ Header -->

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default" role="navigation" id="navigation">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand visible-xs" href="tel:@telNumMobile@">
                        <span class="glyphicon glyphicon-phone"></span> @telNumMobile@
                    </a>

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">{���������</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="visible-lg visible-lg"><a href="/" title="�����"><span class="glyphicon glyphicon-home"></span></a></li>
                        
                        <!-- dropdown catalog menu -->
                        <li>
                            <div class="solid-menus">
                                <nav class="navbar no-border-radius no-margin">
                                    <div id="navbar-inner-container">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle navbar-toggle-left" data-toggle="collapse" data-target="#solidMenu">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>                      
                                            </button>
                                        </div>

                                        <div class="collapse navbar-collapse" id="solidMenu">

                                            <ul class="nav navbar-nav">
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-title="{�������}">{�������} <i class="icon-caret-down m-marker"></i></a>
                                                    <ul class="dropdown-menu no-border-radius">
                                                        @leftCatal@
                                                        

                                                    </ul>
                                                </li>
                                                <li class="visible-xs"><a href="/users/wishlist.html">{���������� ������}</a></li>
                                                <li class="visible-xs"><a href="/price/">{�����-����}</a></li>
                                            </ul> 
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </li>
                        
                        
                        @topBrands@
                        @topMenu@

                        <li class="visible-xs"><a href="/news/">{�������}</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right visible-lg visible-md" class="list-group-item" >
                        <li><a id="cartlink" data-trigger="click" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@'><span class="glyphicon glyphicon-shopping-cart"></span> <span class="visible-lg-inline">{�������} <span id="num" class="label label-info">@num@</span> {��} </span><span id="sum" class="label label-info">@sum@</span> <span class="rubznak">@productValutaName@</span></a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- VisualCart Mod -->
        <div id="visualcart_tmp" class="hide">@visualcart@</div>
        <!-- Notification -->
        <div id="notification" class="success-notification" style="display: none;">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-3 sidebar col-xs-3 visible-lg visible-md">

                    <!-- ProductDay Mod -->
                    @productDay@
                    <!--/ ProductDay Mod -->

                    <div class="list-group ">
                        <span class="list-group-item active">{���������}</span>
                        @pageCatal@
                        <a href="/price/" class="list-group-item" title="{�����-����}">{�����-����}</a>
                        <a href="/news/" class="list-group-item" title="{�������}">{�������}</a>
                        <a href="/gbook/" class="list-group-item" title="{������}">{������}</a>
                        <a href="/links/" class="list-group-item" title="{�������� ������}">{�������� ������}</a>
                        <a href="/map/" class="list-group-item" title="{����� �����}">{����� �����}</a>
                        <a href="/forma/" class="list-group-item" title="{����� �����}">{����� �����}</a>

                    </div>

                    @leftMenu@
                    <div class="news-list">
                        @miniNews@
                    </div>
                    @oprosDisp@

                </div>
                <div class="bar-padding-top-fix visible-xs visible-sm"> </div>
                <div class="col-lg-8 col-md-9 col-xs-12 main"> 
                    @DispShop@
                    @getPhotos@
                </div>
                <div class="col-md-2 sidebar col-xs-3 visible-lg">

                    <!-- �������� ������ -->
                    <div class="panel panel-info hide" id="faset-filter">
                        <div class="panel-heading">
                            <span class="pull-right"><a href="?" id="faset-filter-reset"><span class="glyphicon glyphicon-remove"></span> {�����}</a></span>
                            <h3 class="panel-title">{������ �������}</h3>
                        </div>
                        <div class="panel-body">

                            <div id="faset-filter-body">{��������}...</div>

                            <div id="price-filter-body">
                                <h4>{����}</h4>
                                <form method="get" id="price-filter-form">
                                    <div class="row">
                                        <div class="col-md-6" id="price-filter-val-min">
                                            {��} <input type="text" class="form-control input-sm" name="min" value="@price_min@" > 
                                        </div>
                                        <div class="col-md-6" id="price-filter-val-max">
                                            {��} <input type="text" class="form-control input-sm" name="max" value="@price_max@"> 
                                        </div>
                                    </div>
                                </form>
                                <div id="slider-range"></div>
                            </div>
                        </div>
                    </div>
                    <!--/ �������� ������ -->

                    @rightMenu@

                    <div class="page-header visible-lg visible-md">
                        <h3>@specMainTitle@</h3>
                    </div>
                    <div>@specMainIcon@</div>
                </div>


            </div>

            <div class="visible-lg banner">@banersDisp@<br></div>

            <!-- toTop -->
            <div class="visible-lg visible-md">
                <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
            </div>
            <!--/ toTop -->

            <footer class="footer well visible-lg visible-md">
                <div class="pull-right">@button@</div>
                <p itemscope itemtype="http://schema.org/Organization">&copy; <span itemprop="name">@company@</span> @year@, {���}: <span itemprop="telephone">@telNum@</span>, <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">�����: <span itemprop="streetAddress">@streetAddress@</span></span><span itemprop="email" class="hide">@adminMail@</span></p>
            </footer>
        </div>

        <!-- ��������� ���� ���������� ������ -->
        <div class="modal fade bs-example-modal-sm" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�����}</h4>
                    </div>
                    <div class="modal-body">
                        <form  action="/search/" role="search" method="post">
                            <div class="input-group">
                                <input name="words" maxlength="50" class="form-control" placeholder="{������}.." required="" type="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ���������� ������ -->

        <!-- ��������� ���� �����������-->
        <div class="modal fade bs-example-modal-sm" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�����������}</h4>
                        <span id="usersError" class="hide">@usersError@</span>
                    </div>
                    <form role="form" method="post" name="user_forma">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="login" class="form-control" placeholder="Email..." required="">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>

                            <div class="form-group">
                                <label>{������}</label>
                                <input type="password" name="password" class="form-control" placeholder="{������}..." required="">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="safe_users" @UserChecked@> {���������}
                                </label>
                            </div>

                            @facebookAuth@ @twitterAuth@
                        </div>
                        <div class="modal-footer">
                            <span class="pull-left"><a href="/users/sendpassword.html" class="btn btn-default">{������}?</a>
                            </span>
                            <input type="hidden" value="1" name="user_enter">
                            <button type="submit" class="btn btn-primary">{�����}</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--/ ��������� ���� �����������-->
        
        @editor@

        <!-- Fixed mobile bar -->
        <div class="bar-padding-fix visible-xs"> </div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs" role="navigation">
            <a class="tab-item" href="/">
                <span class="icon icon-home"></span>
                <span class="tab-label">{�����}</span>
            </a>
            <a class="tab-item @user_active@" @user_link@ data-target="#userModal">
                <span class="icon icon-person"></span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item @cart_active@" href="/order/" id="bar-cart">
                <span class="icon icon-download"></span> <span class="badge badge-positive" id="mobilnum">@cart_active_num@</span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item" href="#" data-toggle="modal" data-target="#searchModal">
                <span class="icon icon-search"></span>
                <span class="tab-label">{�����}</span>
            </a>
            <a class="tab-item non-responsive-switch" href="#" data-skin="non-responsive">
                <span class="icon icon-pages"></span>
                <span class="tab-label">{���}</span>
            </a>
        </nav>
        <!--/ Fixed mobile bar -->

        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="java/highslide/highslide-p.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.waypoints.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/inview.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.bxslider.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.ui.touch-punch.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/solid-menu.js"></script> 

        @visualcart_lib@
        <div class="visible-lg visible-md">
