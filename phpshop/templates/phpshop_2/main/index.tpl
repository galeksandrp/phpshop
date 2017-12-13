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
        <LINK rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="/favicon.ico" type="image/x-icon">
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
    </HEAD>
    <BODY onLoad="default_load('false', 'false');
            NavActive('index');
            LoadPath('@ShopDir@');">
        <table width="1004" cellpadding="0" cellspacing="0" align="center" class="body">
            <tr>
                <td>

                    <map name="icon">
                        <area alt="�����" coords="38,14,50,27" href="/">
                        <area alt="����� �����" coords="92,12,110,27" href="/map/">
                        <area alt="�����" coords="150,13,169,25" href="mailto:@adminMail@">
                    </map>
                    <div id="cartwindow" class="message">
                        <div class="ico_add_to_card"><b>��������...</b><br>����� �������� � �������</div>
                    </div>
                    <div id="comparewindow" class="message">
                        <div class="ico_add_to_compare"><b>��������...</b><br>����� �������� � ���������</div>
                    </div>
                    <table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td valign="top" id="header_1">
                                <table width="999" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="225" align="center"><img src="@logo@" alt="@name@" border="0" alt="@name@"></td>
                                        <td valign="top" width="559"><table width="559" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td valign="top">      <div id="name_shop">@name@</div>
                                                        <div id="slogan">@descrip@</div>
                                                        <a id="demo_link" href="/">@serverName@</a></td>
                                                    <td valign="top" align="right" id="tel">
                                                        <span class="telefon">@telNum@</span><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="215" valign="top"><div style="padding:0px 0px 0px 0px ;"> 
                                                <TABLE id="bg_catalog_2">
                                                    <tr>
                                                        <td>�������</td>
                                                        <td><div id="order" style="display:@orderEnabled@" ><A href="/order/" >�������� �����</A></div></td>
                                                    </tr>
                                                </TABLE>
                                                <TABLE style="border-bottom:1px solid #ececec" width="203" cellspacing="0" cellpadding="0">

                                                    <TR>
                                                        <TD class="white2" height="25" width="134">&nbsp;&nbsp;&nbsp;������� � �������</TD>
                                                        <td class="white2"><DIV class="style2" id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</DIV>&nbsp;��.</td>
                                                    </TR>
                                                </TABLE>
                                                <TABLE style="border-bottom:1px solid #ececec;" width="203" cellspacing="0" cellpadding="0">
                                                    <TR>
                                                        <TD class="white2" height="25" width="134">&nbsp;&nbsp;&nbsp;����� ������ :</TD>
                                                        <td  ><DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold; color:#0076c9;">@sum@ </DIV> @productValutaName@</td>
                                                    </TR>
                                                </TABLE>
                                                <table border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td valign="top" >@valutaDisp@</td>
                                                    </tr>

                                                </table></div></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"><table width="999" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td valign="top" width="225" ><img src="images/active_navi.gif" alt="" width="225" height="38" border="0" usemap="#icon"></td>
                                        <td  width="559" id="header_2">
                                            <a href="/" class="navigation" >�������</a> @topMenu@

                                        </td>
                                        <td valign="top" width="215">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td valign="top"> <div id="bg_catalog_3">�������</div>
                                            @leftCatal@
                                            <div id="bg_catalog_3">���������</div>
                                            <ul class="catalog">
                                                <li id="compare" style="display:@compareEnabled@" class="catalog"><a href="/compare/" title="��������� �������" style="font-weight: bold">��������� ������� (<span id="numcompare">@numcompare@</span> ��.)</a></li>
                                                <li class="catalog"><a href="/price/" title="�����-����">�����-����</a></li>
                                                <li class="catalog"><a href="/news/" title="�������">�������</a></li>
                                                <li class="catalog"><a href="/gbook/" title="������">������</a></li>
                                            </ul>
                                            <ul class="catalog">@pageCatal@</ul>
                                            <ul class="catalog">
                                                <li class="catalog"><a href="/links/" title="�������� ������">�������� ������</a></li>
                                                <li class="catalog"><a href="/map/" title="����� �����">����� �����</a></li>
                                                <li class="catalog"><a href="/forma/" title="����� �����">����� �����</a></li>
                                            </ul>

                                            @oprosDisp@
                                            @leftMenu@
                                        </td>
                                        <td valign="top" style="padding-bottom:15px;"><div id="search_bg">
                                                <FORM method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
                                                    <table style="margin-left:20px;" >

                                                        <tr>
                                                            <td colspan="2" style="color:#fff; padding:15px 0px 10px 0px" ><b class="zagb">����� �� �����</b>&nbsp;&nbsp;&nbsp;+ <a href="/search/" id="search_link">����������� �����</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input name="words" class="search" maxLength=30 onFocus="this.value = ''" value="� ���..."></td>
                                                            <td width="80" align="right"><input type="image" value="" src="images/search_but.gif" width="66" height="26" ></td>
                                                        </tr>


                                                    </table></FORM></div>



                                            <div id="bg_catalog_1" style="background: none">@mainContentTitle@</div>
                                            <div id="about">@mainContent@</div>


                                            <div id="bg_catalog_1">������ ��������</div>
                                            <div id="about">@nowBuy@</div>


                                            @banersDisp@


                                            <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><b>���������������</b></td>
                                                        <td><span id="plus_1">+</span><a href="/spec/">��� ���������������</a></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <script type="text/javascript" src="java/highslide/highslide-p.js"></script>
                                    <link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>
                                    <script type="text/javascript">
        hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>', position: 'top right', fade: 2});
        hs.graphicsDir = 'java/highslide/graphics/';
        hs.wrapperClassName = 'borderless';
                                    </script>
                                    <div style="padding:0px 12px 20px;">@specMain@</div>
                                    <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding-right:270px;"><b>�������</b></td>
                                                <td style="padding-right:5px;"><img src="images/rss.gif" alt="" width="12" height="12"></td>
                                                <td><a href="/rss/">RSS</a><span id="plus_2">+</span><a href="/news/">����� ��������</a></td>

                                            </tr>
                                        </table></div>

                                    @miniNews@
                            </td>
                            <td valign="top">
                                @usersDisp@
                                @skinSelect@
                                <div id="bg_catalog_3">������� ��������</div>@specMainIcon@
                                @cloud@
                                @rightMenu@</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" id="footer">

                    <table width="999" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="225" valign="top" style="padding-left:18px;">Copyright &copy; @pageReg@.<br> ��� ����� ��������.  <br>
                                ���. @telNum@<br><br>
                                <img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> <span>|</span> 

                                <img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/map/">����� �����</a> </td>
                            <td width="774" valign="top" id="foot_nav"><table border="0" cellspacing="0" cellpadding="0">

                                    <a href="/" class="navigation" >�������</a>
                                    @topMenu@
                                    <div id="footer_button">@button@</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>