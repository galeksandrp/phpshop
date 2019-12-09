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

        <!-- Preload -->
        <link rel="preload"  href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@bootstrap_theme@.css" as="style">
        <link rel="preload" href="@pageCss@" as="style">
        <link rel="preload" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css"  as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap&subset=cyrillic,cyrillic-ext"  as="font" type="font/woff2" crossorigin>

        <!-- Bootstrap -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@bootstrap_theme@.css" rel="stylesheet">

    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">

        <!-- Template -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
        <link href="@pageCss@" type="text/css" rel="stylesheet">

        <!-- Header -->
        <header class="container-fluid ">
            <div class="row">
                <div class="col-md-12 hidden-xs">
                    <ul class="nav nav-pills pull-right">
                        @usersDisp@
                        <li role="presentation">@wishlist@</li>
                        <li role="presentation"><a href="/compare/"><span class="glyphicon glyphicon-eye-open"></span> {��������} (<span id="numcompare">@numcompare@</span>)</a></li>
                    </ul>
                </div>
            </div>
            <div class="row vertical-align">
                <div class="col-md-3 col-sm-3 col-xs-12 text-center">
                    <div class="logo">
                        <a href="/"><img src="@logo@" alt="@name@"></a>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12 col-sm-9">
                    <div class="row">
                        <div class="col-md-7 col-sm-5  col-xs-12"><h4 class="header-tel"><a class="header-phone" href="tel:@telNumMobile@"><i class="fa fa-phone" aria-hidden="true"></i> @telNumMobile@</a> </h4> @returncall@</div>
                        <div class="col-md-5 col-sm-7  hidden-xs"><form action="/search/" role="search" method="post">
                                <div class="input-group">
                                    <input name="words" maxlength="50" id="search" class="form-control" placeholder="{������}.." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!--<div class="col-md-3">@valutaDisp@</div>-->
                    </div>    
                </div>
                <div class="visible-xs col-xs-12 text-center">@sticker_social@</div>
            </div>
        </header>
        <!--/ Header -->

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default" role="navigation" id="navigation">
            <div class="container-fluid">
                <div class="navbar-header">

                    <form action="/search/" role="search" method="post" class="visible-xs col-xs-9 mobile-search">
                        <div class="input-group">
                            <input name="words" maxlength="50" id="search" class="form-control" placeholder="{������}.." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <div class=" header-menu-wrapper col-md-9 col-sm-9">
                        <div class="row">
                            <ul class="nav navbar-nav main-navbar-top">
                                <li class="active visible-lg"><a href="/" title="�����"><span class="glyphicon glyphicon-home"></span></a></li>

                                <!-- dropdown catalog menu -->
                                <li >
                                    <div class="solid-menus">
                                        <nav class="navbar no-margin">
                                            <div id="navbar-inner-container">
                                                <div class="collapse navbar-collapse" id="solidMenu">

                                                    <ul class="nav navbar-nav">
                                                        <li class="dropdown">
                                                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-title="{�������}">{�������} <i class="icon-caret-down m-marker"></i></a>
                                                            <ul class="dropdown-menu ">
                                                                @leftCatal@


                                                            </ul>
                                                        </li>
                                                        <!-- dropdown brand menu mobile-->
                                                        <li class="dropdown visible-xs">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{������} <span class="caret"></span></a>
                                                            <ul class="dropdown-menu" role="menu">
                                                                @brandsListMobile@
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
                                <li class="visible-xs">                                                    <ul class="mobile-menu">
                                        @leftCatal@


                                    </ul></li>
                                @topBrands@
                                @topcatMenu@
                                @topMenu@

                                <li class="visible-xs"><a href="/news/">{�������}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <ul class="nav navbar-nav navbar-right visible-lg visible-md visible-sm" id="cart">

                            <li><a id="cartlink" data-trigger="hover" data-container="#cart" data-toggle="popover" data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@' href="/order/"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="visible-lg-inline">{�������} <span id="num" class="label label-info">@num@</span> {��} </span><span id="sum" class="label label-info">@sum@</span> <span class="rubznak">@productValutaName@</span></a>
                                <div id="visualcart_tmp" class="hide">@visualcart@</div>
                            </li>
                        </ul>
                    </div>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- VisualCart Mod -->
        <!-- <div id="visualcart_tmp" class="hide">@visualcart@</div>-->

        <!-- Notification -->
        <div id="notification" class="success-notification" style="display:none">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <div class="container-fluid main-container">

            <div class="row">
                <div class="col-lg-3 col-md-3 sidebar col-xs-3 visible-lg visible-md">

                    <!-- ProductDay Mod -->
                    @productDay@
                    <!--/ ProductDay Mod -->

                    <div class="list-group left-block hidden-xs @php __hide('pageCatal'); php@"> 
                        <span class="list-group-item active">{��� ���������}</span>
                        <ul class="left-block-list">
                            @pageCatal@
                        </ul>
                    </div>

                    @leftMenu@
                    <div class="visible-lg visible-md text-center banner">@banersDisp@</div>

                    @oprosDisp@


                    <div class="page-header visible-lg visible-md">
                        <h3>@specMainTitle@</h3>
                    </div>
                    <div>@specMainIcon@</div>


                </div>                


                <div class="col-lg-7 col-md-9 col-xs-12 main"> 
                    <div class="template-slider ">
                        <!-- Slider Section Starts -->
                        <!-- Nested Container Starts -->
                        <!-- Carousel Starts -->
                        <div class="template-slider hidden-xs">

                            @imageSlider@
                        </div>

                        <div class="slider col-xs-12 hidden-lg hidden-md hidden-sm">
                            <div class="text-center">
                                @sticker_mobile_slider@
                            </div>

                            <!-- Carousel Ends -->
                            <!-- Nested Container Ends -->
                        </div>
                        <!-- Slider Section Ends -->

                    </div>
                    <div class="bar-padding-top-fix visible-lg"> </div>

                    <div class="page-header ">
                        <h1>@mainContentTitle@</h1>
                    </div>
                    <div >@mainContent@</div>

                    <div class="page-header hidden-xs @php __hide('specMain'); php@">
                        <span class="pull-right"><a href="/spec/" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-bell"></span> {���������������}</a> <a href="/newtip/" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-bullhorn"></span> {�������}</a> <a href="/newprice/" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-certificate"></span> {����������}</a></span>
                        <h3>{���������������}</h3>
                    </div>
                    <div class="bar-padding-top-fix visible-xs visible-sm"> </div>
                    <div>@specMain@</div>
                    <div>@leftCatalTable@</div>

                </div>


                <div class="col-md-2 sidebar col-xs-3 visible-lg">
                    @rightMenu@
                    <div class="page-header hidden-xs @php __hide('miniNews'); php@">
                        <h2>{�������}</h2>

                    </div>
                    <div class="news-list row">
                        @miniNews@
                    </div>


                </div>
            </div>


            <div class="visible-lg visible-md text-center banner">@sticker_banner@<br></div>

            <!-- toTop -->
            <div class="visible-lg visible-md">
                <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
            </div>
            <!--/ toTop -->

            <footer class="footer well ">
                <div class="row">
                    <!-- My Account Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h4>@sticker_socfooter@</h4>
                        <h5>� @company@, @year@</h5>
                        <ul>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> @adminMail@</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> @telNum@</li>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> @streetAddress@</li>
                            <li>@button@</li>
                        </ul>


                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{������ �������}</h5>

                        <ul>
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
                    <!-- Information Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{����������}</h5>
                        <ul>
                            @bottomMenu@

                        </ul>
                    </div>
                    <!-- Information Links Ends -->

                </div>

            </footer>        </div>
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
                                <input name="words" maxlength="50" class="form-control" placeholder="{������..}" required="" type="search">
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

        <!-- jQuery -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>
        @editor@

        <!-- Fixed mobile bar -->
        <div class="bar-padding-fix visible-xs"></div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs" role="navigation">
            <a class="tab-item active" href="/">
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

        <!-- �������� �� ������������� cookie  -->
        <div class="cookie-message hide"><p></p><a href="#" class="btn btn-default btn-sm">��</a></div>

        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/solid-menu.css"> 
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/menu.css" rel="stylesheet">
        <link href="java/highslide/highslide.css" rel="stylesheet">
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet"> 
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.lazyloadxt.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
        <script src="java/jqfunc.js"></script>
        <script  src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/flipclock.min.js"></script>	
        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/flipclock.css">
        <script src="java/highslide/highslide-p.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.waypoints.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/solid-menu.js"></script> 
        @visualcart_lib@
        <div class="visible-lg visible-md">

