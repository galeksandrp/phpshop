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
           <link rel="apple-touch-icon" href="@icon@">
    <link rel="icon" href="@icon@" type="image/x-icon">
	<link rel="mask-icon" href="@icon@" >
	<link rel="icon" href="@icon@" type="image/x-icon">
<link rel="mask-icon" href="@icon@" >

        <!-- Preload -->
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" as="style">
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/swiper.min.css" as="style">
        <link rel="preload" href="@pageCss@" as="style">
        <link rel="preload" href="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@spice_theme@.css" as="style">
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/responsive.css" as="style">
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css"  as="font" type="font/woff2" crossorigin>

        <!-- Bootstrap -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-subpath="@php echo $GLOBALS['PHPShopNav']->objNav['name']; php@" data-token="@dadataToken@">

       
        <!-- Template -->
		 <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/swiper.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/animate.css" rel="stylesheet">
        <link href="@pageCss@" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/responsive.css" rel="stylesheet">

        <!-- Theme -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@spice_theme@.css" rel="stylesheet">

        <!-- Header Section Starts -->
        <header id="header-area">

            <!-- Header Top Starts -->
            <div class="header-top">
                <!-- Nested Container Starts -->
                <div class="container">
                    <!-- Row Starts -->
                    <div class="row">
                        <!-- Header Links Starts -->
                        <div class="col-sm-12 col-xs-12 col-md-8">
                            <div class="header-links">
                                <ul class="nav navbar-nav pull-left header-color">
                                    <li>
                                        <a class="hidden-xs hidden-sm link" href="/">
                                            <i class="fa fa-home" title="{�����}"></i>
                                            <span class="hidden-sm hidden-xs">
                                                {�����}
                                            </span>
                                        </a>                                       
                                    </li>
                                    @wishlist@
                                    <li>
                                        <a class="hidden-xs hidden-sm link" href="/compare/">
                                            <i class="fa fa-plus" title="{��������}"></i>
                                            <span class="hidden-sm hidden-xs">{��������} (<span id="numcompare">@numcompare@</span>)</span>
                                        </a>
                                        <a href="/compare/" class="btn btn-main btn-sm hidden-md hidden-lg">
                                            <i class="fa fa-plus" title="{��������}"></i>
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
                <!-- Nested Container Ends -->
            </div>
            <!-- Header Top Ends -->

            <div class="container">
                <!-- Main Header Starts -->
                <div class="main-header">
                    <!-- Row Starts -->
                    <div class="row">
                        <!-- Logo Starts -->
                        <div class="col-md-12 hidden-xs hidden-sm">
                            <div class="returncall-wrapper returncall-desctop header-links pull-right header-color">
                                @returncall@
                            </div>
                        </div>
                        <!-- Logo Starts -->
                        <div class="col-md-6 wrapper-fix">
                            <div id="logo">
                                <a href="/" title="@name@">
                                    <img src="@logo@" alt="@name@" class="img-responsive" /></a>
                            </div>
                            <div class="returncall-wrapper hidden-md hidden-lg header-color">
                                @returncall@
                            </div>
                        </div>
                        <!-- Logo Starts -->
                        <!-- Search Starts -->
                        <div class="col-md-3 hidden-xs">
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
                        <!-- Shopping Cart Starts -->
                        <div class="col-md-3 visible-md hidden-sm hidden-xs visible-lg">
                            <div id="cart" class="btn-group btn-block header-color">
                                <a href="/order/" id="cartlink"   class="btn btn-block btn-lg " data-trigger="click" data-container="body"  data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@'>
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>{�������}:</span> 
                                    <span id="cart-total"><span><span id="num">@num@</span>{��.} - </span><span id="sum"> @sum@</span> <span class="rubznak">@productValutaName@</span></span>
                                   
                                </a>
                                @visualcart@
                            </div>
                        </div>
                        <!-- Shopping Cart Ends -->
                    </div>
                    <!-- Row Ends -->
                </div>
                <!-- Main Header Ends -->
                <!-- Main Menu Starts -->
                <nav id="main-menu" class="navbar" role="navigation">
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
					<div class="row">
                        <ul class="nav navbar-nav main-navbar-top">
                            <li class="main-navbar-top-catalog">
                                <a href="javascript:void(0);" id="nav-catalog-dropdown-link" class="nav-catalog-dropdown-link" aria-expanded="false">{�������}
                                </a>
                                <ul class="main-navbar-list-catalog-wrapper fadeIn animated">
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
                    <!-- Navbar Cat collapse Ends -->
                </nav>
                <!-- Main Menu Ends -->
            </div>
        </header>
        <!-- Header Section Ends -->

        <!-- Main Container Starts -->
        <div class="main-container container">
            <!-- Nested Row Starts -->
            <div class="row">
                <div class="col-md-3 sidebar-right">
                    <div class="order-page-sidebar-user-block hidden-xs hidden-sm">
                        <h5 class="user-title">{��� �������}</h5>
                        <ul class="user-list">
                            <li><a href="/users/">@UsersLogin@</a></li>
                            <li><a href="/users/order.html">{��������� �����}</a></li>
                            <li><a href="/users/notice.html">{����������� � �������}</a></li>
                            <li><a href="/users/message.html">{����� � �����������}</a></li>
                            @php if($_SESSION['UsersId']) echo '<li><a href="?logout=true">{�����}</a></li>'; php@
                        </ul>
                    </div>
                    <!-- Categories Links Starts -->
                    <h3 class="side-heading hidden-xs hidden-sm @php if($GLOBALS['PHPShopNav']->objNav['path']!="shop") echo "hide"; php@">{���������}</h3>
                    <ul class="list-group sidebar-nav hidden-xs hidden-sm @php if($GLOBALS['PHPShopNav']->objNav['path']!="shop") echo "hide"; php@">
                        @leftCatal@
                    </ul>
                    <div class="banner-block">
                        @banersDisp@
                    </div>

                    <!-- Categories Links Ends -->
                    <!-- �������� ������ -->
                    <div class="hide" id="faset-filter">
                        <div class="side-heading filter-title">{������ ������� }<a href="?" id="faset-filter-reset" data-toggle="tooltip" data-placement="top" title="{�������� ������}"><span class="glyphicon glyphicon-remove"></span></a></div>                    
                        <div class="list-group filter-body-fix">
                            <div id="faset-filter-body">{��������}...</div>

                            <div id="price-filter-body">
                                <h4>{����}</h4>
                                <form method="get" id="price-filter-form">
                                    <div class="row">
                                        <div class="col-md-6" id="price-filter-val-min">
                                            <span>{��}</span>
                                            <input type="text" class="form-control input-sm" name="min" value="@price_min@" > 
                                        </div>
                                        <div class="col-md-6" id="price-filter-val-max">
                                            <span>{��}</span>
                                            <input type="text" class="form-control input-sm" name="max" value="@price_max@"> 
                                        </div>
                                    </div>
                                    <p></p>
                                    <div id="slider-range"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ �������� ������ -->
					                <!-- jQuery -->
                <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>
                <script src="java/jqfunc.js"></script>

                    <div class="sidebar-fix-block  product-day-wrap hidden-xs hidden-sm">
                        <!-- ����� ��� -->
                        @productDay@
                        <!-- ����� ��� -->
                        

                        <h3 class="side-heading">{�������� ����������}</h3>
                        <div class="list-group sidebar-nav">
                            @pageCatal@
                        </div>  

                        @rightMenu@
                         @leftMenu@
                         @oprosDisp@
                         <div class="panel panel-default  hidden-xs  hidden-sm @php __hide('productlastview'); php@">
  <div class="panel-heading">
    <div class="panel-title">{������������� ������}</div>
  </div>
  <div class="panel-body">
                    @productlastview@
                    
					</div>
					</div>


                    </div>

                </div>
                
                
                <!-- Primary Content Starts -->
                <div class="col-md-9 col-xs-12 middle-content-block">
                    @DispShop@
                    <div class="row">
	                    <hr>
             <div class="col-xs-12 @php __hide('now_buying'); php@">
                        <h2 class="page-header">@now_buying@</h2>
                        
                            @nowBuy@
                    </div>
                    </div>



                </div>
                <div class="col-xs-12">
                    <div class="banner-block">
                        @sticker_banner@
                    </div>
                </div>
                
                <!-- Primary Content Ends -->
                
                
                
                
                <!-- Sidebar Starts -->

                <!-- Sidebar Ends -->
            </div>
            <!-- Nested Row Ends -->
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
                            @bottomMenu@
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
                            <li class="footer-email">@adminMail@</li>                              
                        </ul>
                        <h4 class="lead">
                            {���}: <span>@telNum@</span>
                        </h4>
@sticker_socfooter@
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
        <div class="bar-padding-fix visible-xs"> </div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs visible-sm" role="navigation">
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
                               
                                <input type="email" name="login" class="form-control" placeholder="Email" required="">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                           <br>
                                
                                <input type="password" name="password" class="form-control" placeholder="{������}" required="">
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
                            <button type="submit" class="btn btn-primary">{�����}</button>
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

        <!-- �������� �� ������������� cookie  -->
        <div class="cookie-message hide"><p></p><a href="#" class="btn btn-default btn-sm">��</a></div>
        
        <!-- JQuery Plugins  -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.bxslider.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery-ui.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css" rel="stylesheet">
				<link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/flipclock.css">

		<script  src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/flipclock.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/swiper.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/spice.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.lazyloadxt.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.ui.touch-punch.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.bxslider.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.waypoints.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/inview.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.ui.touch-punch.min.js"></script>
        @visualcart_lib@