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
        <meta content="General" name="rating">
        <meta name="ROBOTS" content="ALL">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        <link rel="icon" href="/favicon.ico"> 

        <!-- Bootstrap -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">

        <!-- Template -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/animate.css" rel="stylesheet">
        <link href="@pageCss@" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/responsive.css" rel="stylesheet">

        <!-- Theme -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@astero_theme@.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


        <!-- jQuery -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

        <!-- jQuery Plugins -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.bxslider.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery-ui.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">

        <!-- Header Section Starts -->
        <header id="header-area">
            <!-- Nested Container Starts -->
            <div class="container">
                <!-- Header Top Starts -->
                <div class="header-top">
                    <!-- Row Starts -->
                    <div class="row">
                        <!-- Header Links Starts -->
                        <div class="col-sm-12 col-xs-12 col-md-8">
                            <div class="header-links header-color">
                                <ul class="nav navbar-nav pull-left">
                                    @wishlist@
                                    <li>
                                        <a class="hidden-xs hidden-sm link" href="/compare/">                                    
                                            <span class="">{��������} (<span id="numcompare">@numcompare@</span>)</span>
                                        </a>
                                        <a href="/compare/" class="btn btn-main btn-sm hidden-md hidden-lg">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                            {��������} (<span id="numcompare">@numcompare@</span>)
                                        </a>
                                    </li>
                                    @usersDisp@
                                </ul>
                            </div>
                        </div>
                        <!-- Header Links Ends -->
                        <!-- Currency & Languages Starts -->
                        <div class="col-sm-4 col-md-4 hidden-xs hidden-sm">
                            <div class="pull-right">                           
                                <!-- Currency Starts -->
                                <div class="btn-group header-valuta-disp-wrapper header-color">
                                    <h4><i class="fa fa-phone-square" aria-hidden="true"></i> {���}: @telNumMobile@</h4>
                                </div>
                                <!-- Currency Ends -->                      
                            </div>
                        </div>
                        <!-- Currency & Languages Ends -->
                    </div>
                    <!-- Row Ends -->
                </div>
                <!-- Header Top Ends -->
                <!-- Main Header Starts -->
                <div class="main-header">
                    <!-- Row Starts -->
                    <div class="row">
                        <div class="col-md-12 hidden-xs hidden-sm">
                            <div class="returncall-wrapper returncall-desctop header-links pull-right header-color">
                                @returncall@
                            </div>
                        </div>
                        <!-- Search Starts -->
                        <div class="col-sm-3 hidden-xs">
                            <form id="search_form" action="/search/" role="search" method="post" class="header-color">
                                <div class="input-group">
                                    <input class="form-control input-lg" name="words" maxlength="50" id="search"  placeholder="{������}..." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-lg" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- Search Ends -->
                        <!-- Logo Starts -->
                        <div class="col-md-6 col-sm-5 col-xs-12">
                            <div id="logo">
                                <a href="/">
                                    <img src="@logo@" alt="@name@" class="img-responsive" /></a>
                            </div>
                            <div class="returncall-wrapper header-links hidden-md hidden-lg header-color">
                                @returncall@
                            </div>
                        </div>
                        <!-- Logo Starts -->
                        <!-- Shopping Cart Starts -->
                        <div class="col-md-3 col-sm-4 col-xs-12 hidden-xs">
                            <div id="cart" class="btn-group btn-block header-color">
                                <button id="cartlink" type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle" data-trigger="click" data-container="body"  data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@'>
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>{�������}:</span> 
                                    <span id="cart-total"><span><span id="num">@num@</span>{��.} - </span><span id="sum"> @sum@</span> <span class="rubznak">@productValutaName@</span></span>
                                </button>
                                @visualcart@
                            </div>
                        </div>
                        <!-- Shopping Cart Ends -->
                    </div>
                    <!-- Row Ends -->
                </div>
                <!-- Main Header Ends -->
            </div>
            <!-- Nested Container Ends -->

            <!-- Header Area Background Block Starts -->
            <div class="header-area-background-block"></div>
            <!-- Header Area Background Block Ends -->
        </header>
        <!-- Header Section Ends -->
        <!-- Main Menu Starts -->
        <nav id="main-menu" class="navbar" role="navigation">
            <!-- Nested Container Starts -->
            <div class="container">
                <!-- Nav Header Starts -->
                <div class="navbar-header">

                    <a class="navbar-brand visible-xs pull-right" href="tel:@telNumMobile@">
                        <span class="glyphicon glyphicon-phone"></span> @telNumMobile@
                    </a>

                    <button type="button" class="btn btn-navbar navbar-toggle main-menu-button" data-toggle="collapse" data-target=".navbar-cat-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- Nav Header Ends -->
                <!-- Navbar Cat collapse Starts -->
                <div class="collapse navbar-collapse navbar-cat-collapse">
                    <ul class="nav navbar-nav main-navbar-top">
                        <li class="main-navbar-top-catalog">
                            <a href="javascript:void(0);" id="nav-catalog-dropdown-link" class="nav-catalog-dropdown-link" aria-expanded="false">{�������}
                            </a>
                            <ul class="main-navbar-list-catalog-wrapper fadeIn animated">
                                @leftCatal@
                            </ul>
                        </li>
                        @topBrands@
                        @topMenu@
                        </li>
                    </ul>
                </div>
                <!-- Navbar Cat collapse Ends -->
            </div>
            <!-- Nested Container Ends -->
        </nav>
        <!-- Main Menu Ends -->
        <!-- Slider Section Starts -->
        <div class="slider container">
            <!-- Nested Container Starts -->
            <!-- Carousel Starts -->
            @imageSlider@
            <!-- Carousel Ends -->
            <!-- Nested Container Ends -->
        </div>
        <!-- Slider Section Ends -->
        <!-- Main Container Starts -->
        <div class="main-container container">

            <!-- Featured Products Starts -->
            <section class="products-list">
                <div class="page-header visible-lg visible-md product-head">
                    <h2>@mainContentTitle@</h2>
                </div>
                <div >@mainContent@</div>

                <!-- Heading Starts -->
                <h2 class="product-head page-header"><a href="/newtip/" title="{��� �������}">{�������}</a></h2>
                <!-- Heading Ends -->
                <!-- Products Row Starts -->
                <!-- Product Starts -->
                <div class="new-product-list">
                    @specMainIcon@
                </div>
                <!-- Product Ends -->
                <!-- Products Row Ends -->
            </section>
            <!-- Featured Products Ends -->
            <!-- Banners Starts -->
            <div class="top-col-banners">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-unstyled">
                            @banersDisp@
                        </ul>
                    </div>
                </div>

            </div>
            <!-- Banners Ends -->    
            <!-- Latest Products Starts -->
            <section class="products-list">         
                <div class="container">
                    <!-- Heading Starts -->
                    <h2 class="product-head page-header"><a href="/spec/" title="{��� ���������������}">{���������������}</a></h2>
                    <!-- Heading Ends -->
                    <!-- Products Row Starts -->
                    <div class="spec-main-list">
                        @specMain@
                    </div>
                    <!-- Products Row Ends -->
                </div>
            </section>
            <!-- Latest Products Ends -->

            <!-- News Starts -->
            <h2 class="product-head page-header"><a href="/news/" title="{��� �������}">{�������}</a></h2>
            <div class="news-list">
                <div class="row">
                    @miniNews@
                </div>                
            </div>
            <!-- News Ends -->

        </div>
        <!-- Main Container Ends -->


        <!-- toTop -->
        <div class="visible-lg visible-md">
            <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
        </div>
        <!--/ toTop -->

        <!-- Footer Section Starts -->
        <footer class="visible-sm visible-md visible-lg" id="footer-area">
            <!-- Footer Links Starts -->
            <div class="footer-links">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Information Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{����������}</h5>
                        <ul>
                            @topMenu@
                        </ul>
                    </div>
                    <!-- Information Links Ends -->
                    <!-- My Account Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{������ �������}</h5>
                        <ul>
                            <li><a href="/users/">@UsersLogin@</a></li>
                            <li><a href="/users/order.html">{��������� �����}</a></li>
                            <li><a href="/users/notice.html">{����������� � �������}</a></li>
                            <li><a href="/users/message.html">{����� � �����������}</a></li>
                            @php if($_SESSION['UsersId']) echo '<li><a href="?logout=true">{�����}</a></li>'; php@
                        </ul>
                    </div>
                    <!-- My Account Links Ends -->
                    <!-- Customer Service Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{���������}</h5>
                        <ul>
                            <li><a href="/price/" title="{�����-����}">{�����-����}</a></li>
                            <li><a href="/news/" title="{�������}">{�������}</a></li>
                            <li><a href="/gbook/" title="{������}">{������}</a></li>
                            <li><a href="/map/" title="{����� �����}">{����� �����}</a></li>
                            <li><a href="/forma/" title="{����� �����}">{����� �����}</a></li>
                        </ul>
                    </div>
                    <!-- Customer Service Links Ends -->
                    <!-- Contact Us Starts -->
                    <div class="col-md-3 col-sm-8 col-xs-12">
                        <h5>{��������}</h5>
                        <ul>
                            <li class="footer-map">@streetAddress@</li>
                            <li class="footer-email">@adminMail@</li>                              
                        </ul>
                        <h4 class="lead">
                            ���: <span>@telNum@</span>
                        </h4>

                        <div class="footer-social">

                            <!-- Social Button -->
                            <a class="social-button hidden-xs hidden-sm" href="#" title="{��������� �} Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a class="social-button hidden-xs hidden-sm" href="#" title="{��������� �} ��������"><i class="fa fa-vk" aria-hidden="true"></i></a>
                            <a class="social-button hidden-xs hidden-sm" href="#" title="{��������� �} �������������"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></a>
                            <!--/ Social Button -->

                        </div>
                    </div>
                    <!-- Contact Us Ends -->
                </div>
                <!-- Container Ends -->
            </div>
            <!-- Footer Links Ends -->
            <!-- Copyright Area Starts -->
            <div class="copyright">
                <!-- Container Starts -->
                <div class="container">
                    <div class="pull-right">@button@</div>
                    <p itemscope itemtype="http://schema.org/Organization">� <span itemprop="name">@company@</span> @year@, {���}: <span itemprop="telephone">@telNum@</span>, <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">{�����}: <span itemprop="streetAddress">@streetAddress@</span></span><span itemprop="email" class="hide">@adminMail@</span></p>
                </div>
                <!-- Container Ends -->
            </div>
            <!-- Copyright Area Ends -->
        </footer>
        <!-- Footer Section Ends -->

        @editor@

        <!-- Fixed mobile bar -->

        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs visible-sm" role="navigation">
            <a class="tab-item active" href="/">
                <span class="icon icon-home"></span>
                <span class="tab-label">{�����}</span>
            </a>
            <a class="tab-item @user_active@" @user_link@ data-target="#userModal">
                <span class="icon icon-person"></span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item @cart_active@" href="/order/" id="bar-cart">
                <span class="icon icon-download"></span>{ }<span class="badge badge-positive" id="mobilnum">@cart_active_num@</span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item" href="#" data-toggle="modal" data-target="#searchModal">
                <span class="icon icon-search"></span>
                <span class="tab-label">{�����}</span>
            </a>
        </nav>
        <!--/ Fixed mobile bar -->
        <!-- Notification -->
        <div id="notification" class="success-notification" style="display: none;">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <!-- ��������� ���� �����������-->
        <div class="modal fade bs-example-modal-sm" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
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
                            <button type="submit" class="btn btn-primary pull-left">{�����}</button>
                            <span class="pull-right"><a href="/users/sendpassword.html" class="btn btn-default">{������}?</a>
                            </span>
                            <input type="hidden" value="1" name="user_enter">
                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--/ ��������� ���� �����������-->

        <!-- ��������� ���� ���������� ������ -->
        <div class="modal fade bs-example-modal-sm" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
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

        <!-- ��������� ���� returncall-->
        <div class="modal fade bs-example-modal-sm" id="returnCallModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�������� ������}</h4>
                    </div>
                    <form role="form" method="post" name="user_forma" action="@ShopDir@/returncall/">
                        <div class="modal-body">

                            <div class="form-group">
                                <input type="text" name="returncall_mod_name" class="form-control" placeholder="{���}..." required="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="returncall_mod_tel" class="form-control" placeholder="{�������}..." required="">
                            </div>
                            <div class="form-group">
                                <input placeholder="{����� ������}" class="form-control" type="text" name="returncall_mod_time_start">
                            </div>
                            <div class="form-group">
                                <textarea placeholder="{���������}" class="form-control" name="returncall_mod_message"></textarea>
                            </div>
                            @returncall_captcha@


                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="returncall_mod_send" value="1">
                            <button type="submit" class="btn btn-primary">{�������� ������}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- JQuery Plugins  -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/astero.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="java/jqfunc.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        @visualcart_lib@
