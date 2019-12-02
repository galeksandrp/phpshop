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
		<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <link rel="apple-touch-icon" href="@icon@">
    <link rel="icon" href="@icon@" type="image/x-icon">
	<link rel="mask-icon" href="@icon@" >

 <!-- Bootstrap -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/@lego_theme@.css" rel="stylesheet">

    </head>
    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">

        <!-- Template -->
        <link href="@pageCss@" type="text/css" rel="stylesheet">

        <!-- Solid Menu -->
        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/solid-menu.css"> 

        <!-- Menu -->
        <link rel="stylesheet" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/menu.css"> 

        <!-- Highslide -->
        <!--<link href="java/highslide/highslide.css" rel="stylesheet">-->

        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/swiper.min.css" rel="stylesheet">
        <!-- Suggestions -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/suggestions.min.css" rel="stylesheet">

        <!-- Bootstrap-select -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bootstrap-select.min.css" rel="stylesheet"> 

        <!-- UI -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery-ui.min.css" rel="stylesheet">

        <!-- Slider -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/jquery.bxslider.css" rel="stylesheet">

        <!-- Bar -->
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/bar.css" rel="stylesheet">
       <!-- <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/font-awesome.min.css" rel="stylesheet">-->

        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@css/fontawesome-light.css" rel="stylesheet">


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-1.11.0.min.js"></script>

        <script src="java/jqfunc.js"></script>


        <!-- Header -->
        @header@
        <!--/ Header -->

        <!-- Container -->
        @container@
        <!--/ Container -->

        <!-- toTop -->
        <div class="visible-lg visible-md">
            <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
        </div>
        <!--/ toTop -->


        <section class="spec @php __hide('specMain'); php@">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12 main">
                        <h2 class="product-head page-header">
                            <a href="/spec/" title="{���������������}">{���������������}</a>
                        </h2>
                        <div class="swiper-slider-wrapper">
                            <div class="swiper-button-prev-block">
                                <div class="swiper-button-prev btn-prev1">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-button-next-block">
                                <div class="swiper-button-next btn-next1">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-container spec-hit-slider">
                                <div class="swiper-wrapper">
                                    @specMain@
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="spec @php __hide('productlastview'); php@">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12 inner-nowbuy main">

                        <h2 class="product-head page-header">
                            <a href="" title="{������������� ������}">{������������� ������}</a>
                        </h2>

                        <div class="swiper-slider-wrapper">
                            <div class="swiper-button-prev-block">
                                <div class="swiper-button-prev btn-prev3">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-button-next-block">
                                <div class="swiper-button-next btn-next3">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-container last-slider">
                                <div class="swiper-wrapper">
                                    @productlastview@
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="brands @php __hide('brandsList'); php@">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12 main">

                        <div class="swiper-slider-wrapper">
                            <div class="swiper-button-prev-block">
                                <div class="swiper-button-prev btn-prev5">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-button-next-block">
                                <div class="swiper-button-next btn-next5">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="swiper-container brands-slider">
                                <div class="swiper-wrapper">
                                    @brandsList@
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
       
	    <section class="">

       

        <!-- Footer Section Starts -->
        @footer@
        <!-- Footer Section Ends -->


        <div class="modal product-number-fix fade bs-example-modal-sm" id="modalProductView" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg fastViewContent"></div>
        </div>
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
                                <input name="words" maxlength="50" class="form-control" placeholder="������.." required="" type="search">
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

        @editor@

        <div class="search-big-block">
            <form id="search_form_small" action="/search/" role="search" method="post" class="header-search-form">
                <input class="form-control input-lg" name="words" maxlength="50"  placeholder="{�����}..." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                <button class="header-search-button" type="submit">
                    <i class="icons-search"></i>
                </button>
            </form>
            <i class="search-close fa fa-times" aria-hidden="true"></i>
        </div>

        <!-- �������� �� ������������� cookie  -->
        <div class="cookie-message hide"><p></p><a href="#" class="btn btn-default btn-sm">��</a></div>

        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/swiper.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.elevatezoom.js"></script>
		<script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/sticky-sidebar.js"></script>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/fc-3.2.5/datatables.min.css"/>-->
         <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.lazyloadxt.min.js"></script>


<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/masonry.pkgd.min.js"></script>
<script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/flipclock.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/bootstrap-select.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.maskedinput.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/lego.js"></script>
		<script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/phpshop.js"></script>
	<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/fc-3.2.5/datatables.min.js"></script>-->
		
        <script src="java/highslide/highslide-p.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/js/jquery.cookie.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.waypoints.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/inview.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery-ui.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.bxslider.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.suggestions.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/jquery.ui.touch-punch.min.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@js/solid-menu.js"></script> 

        @visualcart_lib@
        <div class="visible-lg visible-md">
