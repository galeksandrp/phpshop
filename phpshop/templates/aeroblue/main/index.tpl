<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <META name="description" content="@pageDesc@">
        <META name="keywords" content="@pageKeyw@">
        <META name="copyright" content="@pageReg@">
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <META name="domen-copyright" content="@pageDomen@">
        <META content="General" name="rating">
        <META name="ROBOTS" content="ALL">
        <LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="favicon.ico" type="image/x-icon">
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" type="text/javascript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
    </HEAD>
    <BODY onload="default_load('false', 'false');
            LoadPath('@ShopDir@');">
        <table width="1004" cellpadding="0" cellspacing="0" align="center" class="body">
            <tr>
                <td>
                    <div id="cartwindow" class="message">
                        <div class="ico_add_to_card"><b>��������...</b><br>����� �������� � �������</div>
                    </div>
                    <div id="comparewindow" class="message">
                        <div class="ico_add_to_compare"><b>��������...</b><br>����� �������� � ���������</div>
                    </div>
                    <div class="header_bg_2_up radius_up">
                        <a href="/order/" title="���������� �������"><div class="header_bg_2_up_cart">	
                                <div>������� � �������:  <span id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</span> ��.</div>
                            </div></a>
                        <div class="header_bg_2_up_sum">	
                            <div>�� �����: <span id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold">@sum@ @productValutaName@</span>
                            </div>
                        </div>
                        <div class="header_bg_2_up_cur">
                            <div>@valutaDisp@</div>
                        </div>
                        <div >
                            <div id="order" style="display:@orderEnabled@" class="header_bg_2_up_order">
                                <A href="/order/">�������� �����</A></div>
                        </div>
                        <div>
                            <div id="compare" style="display:@compareEnabled@" class="header_bg_2_up_compare"><a href="/compare/" title="��������� �������">���������: <span id="numcompare">@numcompare@</span> ��.</a></div>
                        </div>
                    </div>
                    <div class="header_bg_2_bg_shop">
                        <div class="header_bg_2_shop">
                            <div style="padding-top:60px">
                                <div class="header_phpshop_logo">
                                    <img src="@logo@" alt="@name@" border="0" alt="@name@">

                                    <img class="icon" src="images/phpshop_logo_icon.png"  alt="" width="88" height="11" border="0" usemap="#icon">
                                    <map name="icon">
                                        <area alt="�����" coords="0,0,12,13" href="/">
                                        <area alt="����� �����" coords="32,0,50,15" href="/map/">
                                        <area alt="�����" coords="73,0,92,12" href="mailto:@adminMail@">
                                    </map> 
                                </div>
                                <div class="header_phpshop_slogan"><a href="/">@serverName@</a>
                                    <h1>@name@</h1>
                                    @descrip@
                                </div>
                                <div class="header_user_area">
                                    <img src="images/phpshop_user2.png" alt="" width="62" height="70" border="0"  align="absmiddle" class="iePNG">
                                </div>
                                <div class="header_user_area2">
                                    @errorLogin@
                                    @usersDisp@
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header_nav_bg">
                        <div class="header_nav"><a href="/">�������</a></div>
                        <div class="header_nav_line"></div>
                        @topMenu@
                    </div>
                    <div id="main">
                        <div id="left_block">

                            @skinSelect@
                            <div class="left_search_bg">
                                <div style="padding-top:7px">
                                    <FORM method="post" name="forma_search" action="/search/" onsubmit="return SearchChek()">
                                        <table cellspacing="0" >
                                            <tr>
                                                <td colspan="2"><img src="images/phpshop_search.png" alt="" width="11" height="13" border="0" hspace="5">����� �� �����:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>							
                                                    <input name="words" class="search" maxLength=30 onfocus="this.value = ''" value="� ���...">
                                                </td>
                                                <td style="padding-left: 5px">
                                                    <input type="image" src="images/but_search.jpg" width="63" height="21">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><a href="/search/" class="small">����������� �����</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </FORM>
                                </div>
                            </div>
                            <div style="margin-top:10px;padding-bottom:10px">

                                <ul class="catalog">
                                    @leftCatal@
                                </ul>
                                <ul class="catalog">
                                    <li class="catalog"><a href="/price/" title="�����-����">�����-����</a></li>
                                    <li class="catalog"><a href="/news/" title="�������">�������</a></li>
                                    <li class="catalog"><a href="/gbook/" title="�������">������</a></li>
                                </ul>
                                <ul class="catalog">@pageCatal@</ul>
                                <ul class="catalog">
                                    <li class="catalog"><a href="/links/" title="�������� ������">�������� ������</a></li>
                                    <li class="catalog"><a href="/map/" title="����� �����">����� �����</a></li>
                                    <li class="catalog"><a href="/forma/" title="����� �����">����� �����</a></li>
                                </ul>

                            </div>

                            @leftMenu@

                            @oprosDisp@
                            <p></p>
                            @cloud@



                        </div>
                        <div id="center_block">	

                            <div class="plashka_center">
                                <div class="plashka_zag">@mainContentTitle@</div>
                            </div>
                            <div style="padding-top:10px">@mainContent@</div>
                            <p style="clear:both"> </p>

                            <div class="plashka_center">
                                <div class="plashka_zag" style="float: left;">���������������</div>
                                <div style="float: right;line-height: 40px;padding-right:10px"><a href="/spec/" class="small">��� c��������������</a></div>
                            </div>
                            @specMain@
                            <p style="clear:both"> </p>

                            <div class="plashka_center">
                                <div class="plashka_zag">������ ��������</div>

                            </div>
                            @nowBuy@
                            <p style="clear:both"> </p>
                            <div class="plashka_center">
                                <div class="plashka_zag" style="float: left;">��������� �������</div>
                                <div style="float: right;line-height: 40px;padding-right:10px"><a href="/news/" class="small">��� �������</a></div>
                            </div>
                            @miniNews@


                            @banersDisp@

                        </div>
                        <div id="right_block">

                            @rightMenu@

                            <div class="plashka">
                                <div class="plashka_zag" style="float: left;">������� ��������</div>
                                <div style="float: right;line-height: 40px;padding-right:10px"><a href="/newtip/" class="small">��� �������</a></div>
                            </div>

                            @specMainIcon@


                        </div>
                    </div>
                    <div id="footer_block" class="radius_down">
                        <div id="footer_tel">
                            ��� �������:
                            <h3>@telNum@</h3>
                        </div>
                        <div id="footer_copyright">
                            <div style="height: 30px;"></div>
                            Copyright � @pageReg@.<br>
                            ��� ����� ��������. ���. @telNum@<br>
                            <img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> | 
                            <img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle">
                            <a href="/map/" title="����� �����">����� �����</a> 
                        </div>

                        <div id="footer_button">
                            @button@

                        </div>

                    </div>
                </td>
            </tr>
        </table>
