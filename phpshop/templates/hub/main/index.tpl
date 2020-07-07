<!DOCTYPE html>
<html lang="@lang@">
    <head>
        <meta charset="@charset@">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@pageTitl@</title>
        <meta name="description" content="@pageDesc@">
        <meta name="keywords" content="@pageKeyw@">
        <meta name="copyright" content="@pageReg@">
        <link rel="apple-touch-icon" href="@icon@">
        <link rel="icon" href="@icon@" type="image/x-icon">
        <link rel="mask-icon" href="@icon@" >
        <link rel="icon" href="@icon@" type="image/x-icon">
        <link rel="mask-icon" href="@icon@" >

        <!-- Preload -->
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" as="style">
        <link rel="preload" href="@pageCss@" as="style">
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@hub_theme@.css" as="style">     
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css"  as="font" type="font/woff2" crossorigin>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css">
    </head>
    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">

        <!-- Template -->
        <link href="@pageCss@" rel="stylesheet">

        <!-- Theme -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@hub_theme@.css" rel="stylesheet">        

        <header>
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-8 top-mobile-fix">
                            <a class=" header-top-link header-link-contact header-link-color" href="tel:@telNum@">@telNum@</a><a class=" header-top-link header-link-contact header-link-color" href="tel:@telNum2@">@telNum2@</a> 
                            <span class="header-company-name header-link-color">
                                @name@
                            </span>
                            <span class="header-returncall-wrapper">
                                @returncall@
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-4 top-mobile-fix">
                            <div class="row">
                                <div class="header-top-dropdown hidden-xs hidden-sm">
                                    <!--
                                            <div style="display: none">
                                                    @valutaDisp@
                                            </div>
                                    -->
                                </div>
                                <div class="header-wishlist">
                                    <a class="header-link-color link" href="/compare/">
                                        <span> {��������} (<span id="numcompare">@numcompare@</span>)<span id="wishlist-total" ></span>
                                        </span>
                                    </a>
                                    @wishlist@
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-2 bottom-mobile-fix">
                            <div class="row">
                                <div id="logo">
                                    <a href="/">
                                        <img src="@logo@" alt="@name@" class="img-responsive" /></a>
                                </div>
                            </div>
                        </div>
                        <nav class="navbar-default hidden-md hidden-lg" role="navigation" id="navigation main-menu">
                            <div class="container nav-bar-menu-header">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>

                                </div>

                                <div id="navbar" class="navbar-collapse collapse hidden-md hidden-lg">
                                    <ul class="nav navbar-nav">
                                        <li class="active visible-lg"><a href="/" title="{�����}"><span class="glyphicon glyphicon-home"></span></a></li>

                                        <!-- dropdown catalog menu -->
                                        <li id="catalog-dropdown" class="visible-lg visible-md visible-sm">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{�������} <b class="caret"></b></a>        
                                            <ul class="dropdown-menu mega-menu">
                                                @leftCatal@
                                            </ul>
                                        </li>
                                        <!-- dropdown catalog menu mobile-->
                                        <li class="dropdown visible-xs">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{�������} <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                @menuCatal@
                                            </ul>
                                        </li>

                                        @topMenu@
                                        <li class="visible-xs"><a href="/users/wishlist.html">{���������� ������}</a></li>
                                        <li class="visible-xs"><a href="/news/">{�������}</a></li>
                                        <li class="visible-xs"><a href="/gbook/">{������}</a></li>
                                        <li class="visible-xs"><a href="/price/">{�����-����}</a></li>
                                        <li class="visible-xs"><a href="/map/">{����� �����}</a></li>
                                    </ul>

                                </div><!--/.nav-collapse -->
                            </div>
                        </nav>
                        <div class="col-md-8 hidden-xs hidden-sm header-menu-wrapper">
                            <div class="row">
                                <ul class="nav navbar-nav main-navbar-top">
                                    <li class="catalog-menu">
                                        <a id="nav-catalog-dropdown-link" class="nav-catalog-dropdown-link" aria-expanded="false">{�������}
                                        </a>
                                        <ul class="main-navbar-list-catalog-wrapper">
                                            @leftCatal@
                                        </ul>
                                    </li>
                                    @topBrands@
                                    @topcatMenu@
                                    @topMenu@
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-7 col-xs-12 col-md-2 hidden-xs hidden-sm header-text-right bottom-mobile-fix">
                            <div id="cart" class="btn-group ">
                                <a href="/order/" id="cartlink" type="button"  class="btn-cartlink " data-trigger="hover" data-container="body"  data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@'>
                                    <i class="iconz-cart"></i>
                                </a>
                                <div class="cart-number"  type="button" data-toggle="dropdown" class="btn-cartlink dropdown-toggle" data-trigger="click" data-container="body"  data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@'>
                                    <span id="num1">
                                        @num@
                                    </span>
                                </div>
                                @visualcart@
                            </div>
                            <div class="header-account">
                                @usersDisp@
                            </div>
                            <div class="search-open-button">
                                <i class="icons-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- Slider Section Starts -->
        <!-- Nested Container Starts -->
        <!-- Carousel Starts -->
        <div class="slider hidden-xs">
            <div class="container">
                <div class="row">
                    @imageSlider@
                </div>
            </div>
        </div>

        <div class="slider col-xs-12 hidden-lg hidden-md hidden-sm">
            <div class="container">
                <div class="banner text-center hidden-lg hidden-md hidden-sm">
                    @sticker_mobile_slider@
                </div>
            </div>

            <!-- Carousel Ends -->
            <!-- Nested Container Ends -->
        </div>
        <!-- Slider Section Ends -->
        
        
        <!-- jQuery -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

        <section class="catalog-table">
            <div class="container">
                <div class="row">
                    <div class="hidden-xs">
                        <h4 class="product-head page-header">{��� �������}</h4>
                    </div>
                    <div class="col-xs-3 hidden-sm hidden-xs @php __hide('productDay'); php@ product-day-wrap">
                        @productDay@
                    </div>
                    <div class="col-xs-9 catalog-table-wrapper">
                        @leftCatalTable@
                    </div>
                </div>
            </div>
        </section>
        <section class="new-arrivals @php __hide('specMainIcon'); php@">
            <div class="container">
                <div class="row">
                    <h4 class="product-head page-header"><a href="/newtip/" title="{��� �������}">{�������}</a></h4>
                    <div class="owl-carousel spec-main-icon">
                        @specMainIcon@
                    </div>
                </div>
            </div>
        </section>
       <section class="hidden-xs main-page-banner container ">
            <div class="top-col-banners row">@sticker_banner@</div>
        </section>
        <section class="special-offers @php __hide('specMain'); php@">
            <div class="container">
                <div class="row">
                    <h4 class="product-head page-header"><a href="/spec/" title="{��� ���������������}">{���������������}</a></h4>
                    <div class="owl-carousel spec-main">
                        @specMain@
                    </div>
                </div>
            </div>
        </section>
        <section class="main-page-news @php __hide('miniNews'); php@">
            <div class="container">
                <h4 class="product-head page-header"><a href="/news/" title="{��� ���������������}">{�������}</a></h4>
                <div class="row">
                    @miniNews@
                </div>
            </div>
        </section>
        <section class="main-description">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="shop-description">
                            <h2 class="product-head page-header">@mainContentTitle@</h2>
                            <div class="description-text">@mainContent@</div>
                            <i class="feather fa fa-angle-down show-shop-description"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="brands-slider @php __hide('topBrands'); php@">
            <div class="container">
                <div class="top-brands-wrapper">
                    <ul class="owl-carousel top-brands">

                        @brandsList@
                    </ul>
                </div>
            </div>
        </section>
        <section class="sticker-section hidden-xs hidden-sm">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-4 sticker-border">
                        <div class="sticker-block">
                            @sticker_one@
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 sticker-border">
                        <div class="sticker-block">
                            @sticker_two@
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="sticker-block">
                            @sticker_three@
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="nowBuyWrapper @php __hide('now_buying'); php@">
            <div class="container">
                <div class="row">
                    <h4 class="product-head page-header">@now_buying@</h4>
                    <div class="owl-carousel nowBuy">
                        @nowBuy@
                    </div>
                </div>
            </div>
        </section>
        <!-- toTop -->
        <div class="visible-lg visible-md">
            <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
        </div>
        <!--/ toTop -->
        <!-- Top brands -->

        <!-- Footer Section Starts -->
        <footer class="hidden-sm visible-md visible-lg" id="footer-field">
            <!-- Footer Links Starts -->
            <div class="footer-link">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Information Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{����������}</h5>
                        <ul>
                            @bottomMenu@

                        </ul>
                        </ul>
                        @sticker_socfooter@
                    </div>
                    <!-- Information Links Ends -->
                    <!-- My Account Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{������ �������}</h5>
                        <ul>
                            <li><a href="/users/">@UsersLogin@</a></li>
                            <li><a href="/users/order.html">{��������� �����}</a></li>
                            <li><a href="/users/notice.html">{����������� � �������}</a></li>
                            @php if($_SESSION['UsersId']) echo '<li><a href="/users/message.html">{����� � �����������}</a></li>
                            <li><a href="?logout=true">{�����}</a></li>'; php@
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
                            <li class="footer-map">@workingTime@</li>
                            <li class="footer-map">@telNum@</li>
                            <li class="footer-map">@telNum2@</li>
                            <li class="footer-email"><a href="mailto:@adminMail@">@adminMail@</a></li>                              
                        </ul>
                        <div class="form-group">
                            <form id="search_form" action="/search/" role="search" method="post" class="footer-search-form">
                                <input class="form-search-footer form-control input-lg" name="words" maxlength="50"  placeholder="{�����}..." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                                <button class="footer-search-button" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
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

        <div class="product-number-fix modal fade bs-example-modal-sm" id="modalProductView" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg fastViewContent"></div> 
        </div>

        @editor@

        <!-- Fixed mobile bar -->

        <div class=""> </div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab" role="navigation">
            <div class="container">
                <div class="nav-user">
                    @usersDisp@
                </div>
                <div class="search-fixed-block hidden-md hidden-lg">
                    <a class="tab-item" href="#" data-toggle="modal" data-target="#searchModal">
                        <span class="icon icon-search"></span>
                    </a>
                </div>
                <div class="wishlist-block">
                    @wishlist@
                </div>

                <div class="cart-block">
                    <a href="/order/">
                        <i class="icons-cart"></i>
                        <span class="text fix">{��� �������}</span>
                        <span id="num3" class="">@num@</span>
                        <span class="sum1-wrapper text">
                            <span id="sum2">@sum@</span>
                            <span class="rubznak">@productValutaName@</span>
                        </span>
                    </a>
                </div>
            </div>
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
            <div class="modal-dialog modal-sm auto-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�����������}</h4>
                        <span id="usersError" class="hide">@usersError@</span>
                    </div>
                    <form role="form" method="post" name="user_forma">
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="email" name="login" class="form-control" placeholder="Email" required="" value="@UserLogin@">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                                <br>

                                <input type="password" name="password" class="form-control" placeholder="{������}" required="" value="@UserPassword@">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>
                            <div class="flex-row">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="safe_users" @UserChecked@> {���������}
                                    </label>
                                </div>
                                <a href="/users/sendpassword.html" class="pass">{������ ������}</a>
                            </div>

                            @facebookAuth@ @twitterAuth@
                        </div>
                        <div class="modal-footer flex-row">

                            <input type="hidden" value="1" name="user_enter">
                            <button type="submit" class="btn btn-main">{�����}</button>
                            <a href="/users/register.html" >{������������������}</a>
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

        <div class="search-big-block">
            <form id="search_form_small" action="/search/" role="search" method="post" class="header-search-form">
                <input class="form-control input-lg" name="words" maxlength="50"  placeholder="{�����}..." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                <button class="header-search-button" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </form>
            <i class="search-close fa fa-times" aria-hidden="true"></i>
        </div>

        <!-- �������� �� ������������� cookie  -->
        <div class="cookie-message hide"><p></p><a href="#" class="btn btn-default btn-sm">Ok</a></div>

        <!-- jQuery Plugins  -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/owl.carousel.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/icon.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.lazyloadxt.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/hub.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>        
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/owl.carousel.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="java/jqfunc.js"></script>
        <script src="phpshop/locale/@php echo $_SESSION['lang']; php@/template.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        @visualcart_lib@