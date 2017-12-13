<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <META name="description" content="@pageDesc@">
        <META name="keywords" content="@pageKeyw@">@seourl_canonical@
        <META name="copyright" content="@pageReg@">
        <META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
        <META name="domen-copyright" content="@pageDomen@">
        <META content="General" name="rating">
        <META name="ROBOTS" content="ALL">
        <LINK rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <LINK rel="icon" href="/favicon.ico" type="image/x-icon">
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" type="text/javascript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/js.js"></SCRIPT>
    </HEAD>
    <BODY onload="pressbutt_load('@thisCat@', '@pathTemplate@', 'false', 'false');
            LoadPath('@ShopDir@');">
        <table cellpadding="0" cellspacing="0" border="0" id="TRoot" align="center">
            <tbody>
                <tr>
                    <td class="leftLine"><div class="rightLine">
                            <div id="cartwindow" class="message">
                                <div class="ico_add_to_card"><b>��������...</b><br>����� �������� � �������</div>
                            </div>
                            <div id="comparewindow" class="message">
                                <div class="ico_add_to_compare"><b>��������...</b><br>����� �������� � ���������</div>
                            </div>
                            <table cellpadding="0" cellspacing="0" border="0" class="topMenu">
                                <tr>
                                    <td><div class="space2"></div></td>
                                    <td align="right" valign="middle" width="100%">@topMenu@</td>
                                    <td><div class="space2"></div></td>
                                </tr>
                            </table>
                            <div class="r">
                                <table cellpadding="0" cellspacing="0" border="0" id="THeader">
                                    <tbody>
                                        <tr>
                                            <td valign="top" width="42%"><div id="logoName"><a href="http://@serverName@" title="@name@">@name@</a></div>
                                                <div id="logoServer"><a href="http://@serverName@" title="@serverName@">@serverName@</a></div>
                                                <div id="logoDescrip"><a href="http://@serverName@" title="@descrip@">@descrip@</a></div></td>
                                            <td valign="top" width="58%"><div id="HeaderDiv">
                                                    <div class="enter"></div>
                                                    <div class="divider"><img src="images/furniture_08.gif"></div>
                                                    <div class="currency"><div style="position:absolute">@valutaDisp@</div></div>
                                                    <div class="divider"><img src="images/furniture_08.gif"></div>
                                                    <div id="compare" style="display:@compareEnabled@">
                                                        <div class="purchase2"><span class="linkNone"><a href="/compare/">��������� (<span id="numcompare">@numcompare@</span>)</a></span></div>
                                                        <div class="divider"><img src="images/furniture_08.gif"></div>
                                                    </div>
                                                    <div class="purchase2"><span class="linkNone"><a href="/order/">(<span id="num">@num@</span>) �� </a></span><span class="linkNone"><a href="/order/">(<span id="sum">@sum@</span>) �����</a></span></div>
                                                    <div class="purchase" id="order" style="display:@orderEnabled@"><a href="/order/" title="�������� �����"><img src="images/furniture_07.gif" border="0"></a></div>
                                                </div>
                                                @errorLogin@
                                                @usersDisp@
                                                <form class="Search" method="post" name="forma_search" action="/search/" onsubmit="return SearchChek()">
                                                    <div class="Search1R">
                                                        <input type="image" src="images/furniture_10.gif">
                                                    </div>
                                                    <div class="Search2R">
                                                        <div class="Search3R">
                                                            <input type="text" class="search" name="words" maxLength="30" onfocus="this.value = ''" value="� ���...">
                                                        </div>
                                                    </div>
                                                </form></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table cellpadding="0" cellspacing="0" border="0" id="TMenu">
                                    <tbody>
                                        <tr>
                                            <td><div class="space2"></div></td>
                                            <td align="left" valign="middle" class="topCat">@leftCatal@</td>
                                            <td><div class="space1"></div></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <script type="text/javascript">catalogAktiv('divCatId@thisCat@');</script>
                                <script type="text/javascript" src="java/highslide/highslide-p.js"></script>
                                <link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>
                                <script type="text/javascript">
                                    hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>', position: 'top right', fade: 2});
                                    hs.graphicsDir = 'java/highslide/graphics/';
                                    hs.wrapperClassName = 'borderless';
                                </script>
                                <table cellpadding="0" cellspacing="0" border="0" id="TContent">
                                    <tbody>
                                        <tr>
                                            <td><div class="space2"></div></td>
                                            <td align="left" valign="top" width="100%">@DispShop@@rightMenu@@banersDisp@
                                                <div class="spaceH20"></div></td>
                                            <td><div class="space3"></div></td>
                                            <td align="left" valign="top" class="rightCat"><div class="space4">
                                                    <script type="text/javascript">catalogAktiv('divCatIdBot@thisCat@');</script>
                                                    @calendar@
                                                    @skinSelect@
                                                    @leftMenu@
                                                    <div class="spaceH20"></div>
                                                    <h1 class="HTitle2-1">@specMainTitle@</h1>
                                                    @specMainIcon@
                                                    <div class="spaceH20"></div>
                                                    <h1 class="HTitle2-1">���������</h1>
                                                    <div class="divNavigationA"><a href="/price/">�����-����</a></div>
                                                    <div class="divNavigationA"><a href="/news/">�������</a></div>
                                                    @pageCatal@
                                                    <div class="divNavigationA"><a href="/links/">�������� ������</a></div>
                                                    <div class="divNavigationA"><a href="/gbook/">������</a></div>
                                                    <div class="divNavigationA"><a href="/map/">����� �����</a></div>
                                                    <div class="divNavigationA"><a href="/forma/">����� �����</a></div>
                                                    @oprosDisp@
                                                    @cloud@
                                                    <div class="spaceH30"></div>
                                                </div></td>
                                            <td><div class="space2"></div></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div id="DBotoom-t"><div id="DBotoom-b">
                                        <p class="PBotoom">Copyright &copy; ��������-������� �@pageReg@� ���: @telNum@<span></span>��� ����� ��������.</p>
                                    </div>
                                    <img src="images/spacer.gif" height="1" width="996"></div></div>
                        </div></td>
                </tr>
            </tbody>
        </table><br><div align="center">@button@</div>