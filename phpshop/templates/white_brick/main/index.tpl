<!DOCTYPE html>
<html>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <META name="description" content="@pageDesc@">
        <META name="keywords" content="@pageKeyw@">
        <META name="copyright" content="@pageReg@">
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <META name="domen-copyright" content="@pageDomen@">
        <META content="General" name="rating">
        <META name="ROBOTS" content="ALL">
        <LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="favicon.ico" type="image/x-icon">
        <SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/js.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="java/swfobject.js"></SCRIPT>
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@bootstrap.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@stylesheet.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@mobile.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@ui.totop.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@tipTip.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@slideshow.css" media="screen">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@carousel.css" media="screen">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@flexslider.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@elastic_slideshow.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@camera.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@cloud-zoom.css">
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@dcaccordion.css">
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/javascript/widgets.js" id="twitter-wjs"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/lc_dropdown.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.dcjqaccordion.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.elastislide.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.bxSlider.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/camera.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/custom.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/nivo_slider.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jCarousel.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.jqzoom-core.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jqfunc.js"></script>
        <SCRIPT language="JavaScript" type="text/javascript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="java/jqfunc.js"></SCRIPT>
        <script> document.createElement('header');
            document.createElement('section');
            document.createElement('article');
            document.createElement('aside');
            document.createElement('nav');
            document.createElement('footer');</script>
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,700italic,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]> 
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script> 
        <![endif]-->
        <!--[if IE 8]>
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@ie8.css" />
        <![endif]-->
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@ie7.css" />
        <![endif]-->
        <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@ie6.css" />
        <![endif]-->
    </HEAD>
    <BODY onLoad="default_load('false', 'false');
                NavActive('index');
                LoadPath('@ShopDir@');"  class="bod" style="float:none;margin:0">
        @oldBrowserMessage@
        <div id="notification"></div>
        <div class="black_overlay" id="fade"></div>
        <div id="light" class="white_content">
            <div style="position:relative;" class="usbg">
                <form method="post" name="user_forma" action="/users/">
                    <table width="210" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td valign="top" ><table style="margin-top:30px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><h2>�����������</h2></td>
                                        <td align="right" valign="top"><div class="closeX"><a href="javascript:void(0)" onClick="document.getElementById('light').style.display = 'none';
                document.getElementById('fade').style.display = 'none'">�������</a></div></td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td valign="top" height="40" ><input type="text" onFocus="" name="login" value="@UserLogin@" placeholder="E-mail">
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" height="37" ><input type="password" name="password" onFocus="" value="@UserPassword@"  placeholder="������" >
                            </td>
                        </tr>
                        <tr>
                            <td  ><table style="margin-top:10px" width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td  ><table  border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="22"><input id="zap" type="checkbox" value="1" name="safe_users" @UserChecked@></td>
                                                    <td><label for="zap">���������</label></td>
                                                </tr>
                                            </table></td>
                                        <td  align="right"><a href="/users/sendpassword.html" class="forg2" >������ ������?</a> </td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="50%" height="40" > @facebookAuth@ @twitterAuth@ </td>
                                        <td width="50%" align="right"><input name="button" type="submit"  onclick="ChekUserForma()" value="    �����    "   >
                                            <input type="hidden" value="1" name="user_enter"></td>
                                    </tr>
                                </table></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="wrapper">
            <header id="header">
                <div class="container">
                    <div id="t-header" class="row">
                        <div id="logo"><a title="@name@" href="/"><img src="@logo@" alt="@name@"></a></div>
                        <div id="lc_dropdown">

                            <div id="currency" class="dropdown_l"> @valutaDisp@</div>
                        </div>
                        <div class="links"> @usersDisp@ @wishlist@ <a href="/order/">�������� �����</a></div>
                        <div id="cart">
                            <div class="heading"> <a href="/order/"><span id="cart-total"><b id="num">@num@</b> ������� - <b id="sum">@sum@</b> @productValutaName@</span></a></div>
                            <div class="content">
                                <div>@visualcart@</div>
                            </div>
                        </div>
                        <div id="search" class="span4">
                            <div class="button-search" onClick="return SearchChek()"></div>
                            <form method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
                                <input class="search" name="words" maxLength="30" placeholder="�����" value="�����" onFocus="this.value = ''">
                            </form>
                        </div>
                    </div>
                    <div class="navbar visible-phone">
                        <div class="navbar-inner">
                            <div class="container"> <a class="btn btn-navbar brand" data-toggle="collapse" data-target=".nav-collapse"> ��������� <img src="images/dropdown.png" title="���������" alt="���������"> </a>
                                <div class="nav-collapse">
                                    <ul class="nav">
                                        <li class="dropdown">
                                            <div id="homepage"><a href="/"><img src="images/homepage.png" title="�� �������" alt="�� �������"></a></div>
                                            <ul class="dropdown-menu">
                                                @leftCatalTable@
                                                <div class="menu_links"> <a href="/news/" title="�������">�������</a> </div>
                                                @topMenu@
                                                @pageCatal@
                                                @php

                                                if($_SESSION['UsersId']) echo '
                                                <li>
                                                    <div class="menu_links"> <a href="/users/" >��� �������</a> </div>
                                                    <div>
                                                        <ul>
                                                            <li><a href="/users/">@UsersLogin@</a></li>
                                                            <li><a href="/users/order.html">��������� �����</a></li>
                                                            <li><a href="/users/notice.html">����������� � �������</a></li>
                                                            <li><a href="/users/message.html">����� � �����������</a></li>
                                                            <li><a href="javascript:UserLogOut();">�����</a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                ';  php@
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav id="menu" class="row hidden-phone">
                        <div id="homepage"><a href="/"><img src="images/main.gif" alt="�������"></a></div>
                        <div id="menu-category-wall">
                            <ul>
                                <li><a>�������</a>
                                    <div class="span10"> @leftCatal@ </div>
                                </li>
                            </ul>
                        </div>
                        @topBrands@<div class="sep-menu-link"><img src="images/separator.gif" width="1" height="20" alt=""></div>
                        <div class="menu_links"> <a href="/news/" target="_self"> <span>�������</span> </a> </div>
                        <div id="menu_informations">
                            <ul>
                                <li><a>������</a>
                                    <div>
                                        <ul>
                                            <li>
                                                <div class="span3">
                                                    <ul>
                                                        @pageCatal@
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div><div class="sep-menu-link"><img src="images/separator.gif" width="1" height="20" alt=""></div>
                        @topMenu@ </nav>
                </div>

                <div id="notification">
                    <div class="success-notification" style="display: none;">
                        <span class="notification-alert">
                        </span>
                        <img src="images/close.png" alt="" class="close">
                    </div></div>
            </header>
            <section id="midsection" class="container">
                <div class="row">
                    <div id="content-home" class="span12">
                        @imageSlider@
                        <div class="welcome">@mainContentTitle@</div>
                        <div class="welcome-content"> @mainContent@ </div>
                        <section id="featured" class="featured span">
                            <div class="header_rel">
                                <h2><a href="/spec/">���������������</a></h2>
                            </div>
                            <div id="carousel-featured-0" class="es-carousel-wrapper">
                                <div class="es-carousel"><ul>@specMain@</ul></div>
                            </div>
                        </section>
                        <script type="text/javascript">
            $('#carousel-featured-0').elastislide({
                speed: 450, // animation speed
                easing: '', // animation easing effect
                // the minimum number of items to show.
                minItems: 1
            });
            //Fix to adjust on windows resize
            $(window).triggerHandler('resize.elastislide');
                        </script>
                        <section id="latest" class="latest span">
                            <div class="header_rel">
                                <h2><a href="/newtip/">�������</a></h2></div>
                            <div id="carousel-latest-0" class="es-carousel-wrapper">
                                <div class="es-carousel"><ul>@specMainIcon@</ul></div>
                            </div>
                        </section>
                        <script type="text/javascript">

                            $('#carousel-latest-0').elastislide({
                                speed: 450, // animation speed
                                easing: '', // animation easing effect


                                // the minimum number of items to show. 
                                minItems: 1
                            });

                            //Fix to adjust on windows resize
                            $(window).triggerHandler('resize.elastislide');

                        </script>

                        <section id="news" class="span">
                            <div class="header_rel">
                                <h2><a href="/news/">�������</a></h2></div>

                            @miniNews@

                        </section>
                        <section id="news" class="span">
                            <div class="header_rel">
                                <h2>������ ��������</h2>
                            </div>
                            <div id="carousel-nowBuy-0" class="es-carousel-wrapper">
                                <div class="es-carousel"><ul>@nowBuy@</ul></div>
                            </div>
                        </section>
                        <script type="text/javascript">

                            $('#carousel-nowBuy-0').elastislide({
                                speed: 450, // animation speed
                                easing: '', // animation easing effect


                                // the minimum number of items to show. 
                                minItems: 1
                            });

                            //Fix to adjust on windows resize
                            $(window).triggerHandler('resize.elastislide');

                        </script>

                        @calendar@
                        @cloud@
                        @banersDisp@ </div>
                </div>
            </section>
            <footer id="footer">

                <div id="footer_info" class="hidden-phone">
                    <div class="container">
                        <div id="footer_info_content" class="row">
                            <div class="span3">
                                <h3>����</h3>
                                <div class="navi_footer_fix"> @topMenu@ </div>
                            </div>
                            <div class="span3">
                                <h3>���������</h3>
                                <ul>
                                    <li><a href="/price/" title="�����-����">�����-����</a></li>
                                    <li><a href="/news/" title="�������">�������</a></li>
                                    <li><a href="/gbook/" title="������">������</a></li>
                                    <li><a href="/links/" title="�������� ������">�������� ������</a></li>
                                    <li><a href="/map/" title="����� �����">����� �����</a></li>
                                    <li><a href="/forma/" title="����� �����">����� �����</a></li>
                                </ul>
                            </div>
                            <div class="span3">
                                <h3>������� ������</h3>
                                <ul>
                                    @pageCatal@
                                </ul>
                            </div>
                            <div class="span3">
                                <h3>��� �������</h3>
                                <ul>
                                    <li><a href="/users/">@UsersLogin@</a></li>
                                    <li><a href="/users/order.html">��������� �����</a></li>
                                    <li><a href="/users/notice.html">����������� � �������</a></li>
                                    <li><a href="/users/message.html">����� � �����������</a></li>
                                   @php if($_SESSION['UsersId']) echo '<li><a href="javascript:UserLogOut();">�����</a></li>'; php@
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="footer_info_phone" class="row visible-phone">
                    <div class="container">
                        <div id="footer_info_phone_content">
                            <div class="span3 subnav">
                                <ul class="nav nav-pills">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">����</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="navi_footer_fix"> @topMenu@ </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="span3 subnav">
                                <ul class="nav nav-pills">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">���������</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/price/" title="�����-����">�����-����</a></li>
                                            <li><a href="/news/" title="�������">�������</a></li>
                                            <li><a href="/gbook/" title="������">������</a></li>
                                            <li><a href="/links/" title="�������� ������">�������� ������</a></li>
                                            <li><a href="/map/" title="����� �����">����� �����</a></li>
                                            <li><a href="/forma/" title="����� �����">����� �����</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="span3 subnav">
                                <ul class="nav nav-pills">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">������� ������</a>
                                        <ul class="dropdown-menu">
                                            @pageCatal@
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="span3 subnav">
                                <ul class="nav nav-pills">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#">��� �������</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/users/">@UsersLogin@</a></li>
                                            <li><a href="/users/order.html">��������� �����</a></li>
                                            <li><a href="/users/notice.html">����������� � �������</a></li>
                                            <li><a href="/users/message.html">����� � �����������</a></li>
                                            <li><a href="javascript:UserLogOut();">�����</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="footer_cr"><div style="padding-right:10px;" align="right">@button@</div>
                    <div class="container">
                        <div id="footer_cr_content" class="row">
                            <script type="text/javascript">
                                $(function() {
                                    $(".tiptip").tipTip();
                                });
                            </script>

                        </div>
                    </div>
                </div>

            </footer>
        </div>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/cloud-zoom.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.tipTip.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/jquery.ui.totop.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                /*
                 var defaults = {
                 containerID: 'toTop', // fading element id
                 containerHoverID: 'toTopHover', // fading element hover id
                 scrollSpeed: 1200,
                 easingType: 'linear' 
                 };
                 */
                $().UItoTop({easingType: 'easeOutQuart'});
            });
        </script>


