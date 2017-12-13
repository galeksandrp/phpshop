<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <META name="description" content="@pageDesc@">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <META name="keywords" content="@pageKeyw@">@seourl_canonical@
        <META name="copyright" content="@pageReg@">
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <META name="domen-copyright" content="@pageDomen@">
        <META content="General" name="rating">
        <META name="ROBOTS" content="ALL">
        <LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="favicon.ico" type="image/x-icon">
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="java/tabpane.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
    </HEAD>
    <BODY onLoad="pressbutt_load('@thisCat@', '@pathTemplate@', 'false', 'false');
            NavActive('@NavActive@');
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
                    <map name="icon">
                        <area alt="�����" coords="18,0,30,13" href="/">
                        <area alt="����� �����" coords="75,0,93,15" href="/map/">
                        <area alt="�����" coords="131,-2,150,10" href="mailto:@adminMail@">
                    </map>
                    <table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td valign="top"><table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td height="98" valign="top" width="561" id="header_1"><table style="margin-top:35px;" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td><img class="icon" src="images/active_navi.gif"  alt="" width="199" height="11" border="0" usemap="#icon"> </td>

                                                </tr>
                                            </table>
                                        </td>
                                        <td valign="top"> @usersDisp@</td>
                                    </tr>
                                    <tr>
                                        <td valign="top" id="header_2" height="133"><div id="name_shop">@name@<div style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/big_basket.png')" ></div></div>
                                            <div id="slogan">@descrip@</div>
                                            <a id="demo_link" href="/">@serverName@</a></td>
                                        <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td valign="top" id="header_3" width="209" height="126">
                                                        <div style="padding:20px 0px 0px 20px ;">  <TABLE cellspacing="0" cellpadding="0">
                                                                <TR>
                                                                    <TD class="white2">������� � �������</TD>
                                                                    <td class="white2"><DIV class="style2" id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</DIV>&nbsp;��.</td>
                                                                </TR>
                                                            </TABLE>
                                                            <TABLE style="margin:5px 0px;" cellspacing="0" cellpadding="0">
                                                                <TR>
                                                                    <TD class="white2">����� ������ :&nbsp;&nbsp;</TD>
                                                                    <td width="88" height="21" style="background:url(images/cart_bg.gif) right center no-repeat; " ><DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold; color:#008ae1;padding-left:17px">@sum@</DIV> @productValutaName@</td>
                                                                </TR>
                                                            </TABLE>
                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td>@valutaDisp@</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>  <div id="order" style="display:@orderEnabled@"><A href="/order/"  style="color: white; font-weight: bold;"><img src="images/order_but.gif" alt="" width="102" height="26" vspace="3" border="0"> </A></div></td>
                                                                </tr>
                                                            </table></div>
                                                    </td>
                                                    <td valign="top" id="header_4" width="208" height="126">
                                                        <FORM method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
                                                            <table width="199" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td colspan="2" style="padding:23px 0px 0px 14px"><b class="zagb">����� �� ��������</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="padding:20px 0px 0px 14px"><input name="words" class="search" maxLength=30 onFocus="this.value = ''" ></td>

                                                                </tr>
                                                                <tr>
                                                                    <td style="padding:10px 0px 0px 14px"  valign="top"><a href="/search/" style="color:#007cd0; font-size:11px;text-transform:lowercase; white-space:nowrap">����������� �����</a> </td> <td  valign="top" style="padding:6px 0px 0px 0px"  ><input type="image" src="images/enter2.gif" hspace="0"  width="56" height="24"></td>
                                                                </tr>


                                                            </table> </FORM></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table></td>
                        </tr>
                        <tr>
                            <td valign="top"><table width="980" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td width="560" valign="top" style="padding-bottom:15px"><div id="header_5"><table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td id="index"><a href="/" class="navigation" >�������</a></td>
                                                        @topMenu@
                                                    </tr>
                                                </table></div>

                                            <div style="clear:both;"></div>
                                            <script type="text/javascript" src="java/highslide/highslide-p.js"></script>
                                    <link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>
                                    <script type="text/javascript">
        hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>', position: 'top right', fade: 2});
        hs.graphicsDir = 'java/highslide/graphics/';
        hs.wrapperClassName = 'borderless';
                                    </script>
                                    @DispShop@
                                    @banersDisp@
                            </td>
                            <td width="2"><img src="images/spacer.gif" alt="" width="2" height="1"></td>
                            <td width="207" valign="top">
                                <div id="bg_catalog_2">�������</div>
                                <div id="catal" >
                                    <div id="cat_in">   <ul class="catalog">
                                            @leftCatal@
                                        </ul></div></div>
                                <div style="clear:both"></div>
                                <div id="bg_catalog_3">���������</div>
                                <div style="margin-top:0px;padding-bottom:0px">

                                    <ul class="catalog2">
                                        <li class="catalog2" id="compare" style="display:@compareEnabled@"><a href="/compare/" title="��������� �������" style="font-weight: bold">��������� ������� (<span id="numcompare">@numcompare@</span> ��.)</a></li>
                                        <li class="catalog2"><a href="/price/" title="�����-����">�����-����</a></li>
                                        <li class="catalog2"><a href="/news/" title="�������">�������</a></li>
                                        <li class="catalog2"><a href="/gbook/" title="������">������</a></li>
                                    </ul>
                                    <ul class="catalog2">@pageCatal@</ul>
                                    <ul class="catalog2">
                                        <li class="catalog2"><a href="/links/" title="�������� ������">�������� ������</a></li>
                                        <li class="catalog2"><a href="/map/" title="����� �����">����� �����</a></li>
                                        <li class="catalog2"><a href="/forma/" title="����� �����">����� �����</a></li>
                                    </ul>

                                </div>
                                <div style="padding:10px 13px; text-align:justify"></div>
                                @calendar@ 
                                @oprosDisp@  
                                @cloud@
                                @leftMenu@
                            </td>
                            <td width="2"><img src="images/spacer.gif" alt="" width="2" height="1"></td>
                            <td width="207" valign="top">
                                @skinSelect@
                                <div id="bg_catalog_2">@specMainTitle@</div>
                                @specMainIcon@
                                @rightMenu@
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            <table id="footer" width="100%" border="0" cellspacing="0" cellpadding="10">
                <tbody><tr>
                        <td width="750" valign="top" >Copyright &copy; @pageReg@.<br>
                            ��� ����� ��������. ���. @telNum@<br><br>
                            <img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS" target="_blank">RSS</a> <span>|</span> 
                            <img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/map/">����� �����</a> </td>

                        <td valign="top" align="left">@button@</td>     </tr>
                </tbody></table>
        </tr>
    </table>