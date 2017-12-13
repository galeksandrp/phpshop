<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>@pageTitl@</TITLE>
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
        <LINK href="@pageCss@" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" type="text/javascript" src="java/phpshop.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>

    </HEAD>
    <BODY onload="default_load('false', 'false');
        NavActive('index');
        LoadPath('@ShopDir@');">
        <table width="1000" align="center" cellpadding="0" cellspacing="0" border="1">
            <tr>
                <td><table width="1000" height="120" cellpadding="10" cellspacing="0" border="1">
                        <tr>
                            <td width="34%">
                                <img src="@logo@" alt="@name@" border="0">
                            </td>
                            <td width="34%">
                                <div style="padding-bottom: 10px">������� � �������: <span id="num" style="font-weight:600">@num@</span> ��.</div>
                                <div style="padding-bottom: 10px">�� �����: <span id="sum" style="font-weight:600">@sum@</span> @productValutaName@</div>
                                <!-- ����� ����� ������ [main/valuta_forma.tpl] -->
                                @valutaDisp@
                                <!-- ����� ����� ������ -->
                                <div id="order" style="display:@orderEnabled@; padding-bottom: 10px"><a href="/order/" title="�������� �����">�������� �����</a></div>
                                <div id="compare" style="display:@compareEnabled@; padding-bottom: 10px"><a href="/compare/" title="��������� �������">���������: <span id="numcompare">@numcompare@</span> ��.</a></div>
                            </td>
                            <td width="34%">
                                <!-- ����� ����������� ������������ [main/users_forma.tpl, main/users_forma_enter.tpl] -->
                                @errorLogin@
                                @usersDisp@
                                <!-- ����� ����������� ������������ -->
                            </td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td><table width="1000" cellpadding="0" cellspacing="0" border="1">
                        <tr>
                            <td>
                                <table align="left" cellpadding="0" cellspacing="0" border="1" id="index">
                                    <tr>
                                        <td style="padding: 5px"><a href="/" title="�������">�������</a></td>
                                    </tr>
                                </table>
                                <!-- ����� �������� ���� ����� [main/top_menu.tpl] -->
                                @topMenu@
                                <!-- ����� �������� ���� ����� -->
                            </td>
                        </tr>
                    </table></td>
            </tr>
            <tr>
                <td><table width="1000" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td width="10" bgcolor="#f0f0f0">&nbsp;</td>
                            <td valign="top" width="215">
                                <!-- ����� ����� ������� [main/left_menu.tpl] -->
                                @skinSelect@
                                <!-- ����� ����� ������� -->
                                <h4 style="font-size: 15px;color: #000000">����� �� �����:</h4>
                                <form method="post" name="forma_search" action="/search/" onsubmit="return SearchChek()">
                                    <table cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td>
                                                <input name="words" maxLength="30" onfocus="this.value = ''" value="� ���..." style="margin-right: 6px; width: 120px">
                                            </td>
                                            <td>
                                                <input type="submit" value="������" name="submit">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div><a href="/search/">����������� �����</a></div>

                                <h4 style="font-size: 15px;color: #000000">������� �������</h4>

                                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                                    <!-- ����� �������� ������� [catalog/catalog_forma.tpl, catalog/catalog_forma_2.tpl, catalog/catalog_forma_3.tpl, catalog/podcatalog_forma.tpl] -->
                                    @leftCatal@
                                    <!-- ����� �������� ������� -->
                                </ul>

                                <h4 style="font-size: 15px;color: #000000">������� ������</h4>

                                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                                    <!-- ����� �������� ������ [catalog/catalog_page_forma.tpl, catalog/catalog_page_forma_2.tpl, catalog/podcatalog_page_forma.tpl] -->
                                    @pageCatal@
                                    <!-- ����� �������� ������ -->
                                </ul>

                                <h4 style="font-size: 15px;color: #000000">���������</h4>

                                <ul style="padding: 0px; margin: 0px; list-style-type: none;">
                                    <li><a href="/price/" title="�����-����">�����-����</a></li>
                                    <li><a href="/news/" title="�������">�������</a></li>
                                    <li><a href="/gbook/" title="�������">������</a></li>
                                    <li><a href="/opros/" title="�������">�����</a></li>
                                    <li><a href="/links/" title="�������� ������">�������� ������</a></li>
                                    <li><a href="/map/" title="����� �����">����� �����</a></li>
                                    <li><a href="/forma/" title="����� �����">����� �����</a></li>
                                </ul>

                                <!-- ����� ������ ���������� ����� [main/left_menu.tpl] -->
                                @leftMenu@
                                <!-- ����� ������ ���������� ����� -->

                                <!-- ����� ������ [opros/opros_forma.tpl, opros/opros_list.tpl] -->
                                @oprosDisp@
                                <!-- ����� ������ -->

                                <!-- ����� ������ ����� [main/left_menu.tpl] -->
                                @cloud@
                                <!-- ����� ������ ����� -->
                            </td>
                            <td width="15" bgcolor="#f0f0f0">&nbsp;</td>
                            <td valign="top" width="520">

                                <!-- ����� ����������� ����������� �������� -->
                                <script type="text/javascript" src="java/highslide/highslide-p.js"></script>
                        <link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>
                        <script type="text/javascript">
                            hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>', position: 'top right', fade: 2});
                            hs.graphicsDir = 'java/highslide/graphics/';
                            hs.wrapperClassName = 'borderless';
                        </script>
                        <!-- ����� ����������� ����������� �������� -->

                        <!-- ����� �������� ��������� �������� -->
                        <h4 style="font-size: 15px;color: #000000">@mainContentTitle@</h4>
                        <!-- ����� �������� ��������� �������� -->

                        <!-- ����� ����������� ��������� �������� -->
                        <div style="padding:10px">@mainContent@</div>
                        <!-- ����� ����������� ��������� �������� -->

                        <h4 style="font-size: 15px;color: #000000">������� ���������</h4>

                        <!-- ����� ��������� ��� ������� ������� �������� [catalog/catalog_table_forma.tpl] -->
                        @leftCatalTable@
                        <!-- ����� ��������� ��� ������� ������� �������� -->

                        <h4 style="font-size: 15px;color: #000000">������ ��������</h4>

                        <!-- ����� ������ ���������� ������� -->
                        @nowBuy@
                        <!-- ����� ������ ���������� ������� -->

                        <h4 style="font-size: 15px;color: #000000">���������������</h4>

                        <!-- ����� ��������������� [product/main_product_forma_1.tpl, product/main_product_forma_2.tpl, product/main_product_forma_3.tpl] -->
                        @specMain@
                        <!-- ����� ��������������� -->

                        <h4 style="font-size: 15px;color: #000000">��������� �������</h4>

                        <!-- ����� �������� [news/news_main_mini.tpl] -->
                        @miniNews@
                        <!-- ����� �������� -->

                        <!-- ����� ������� [banner/baner_list_forma.tpl] -->
                        @banersDisp@
                        <!-- ����� ������� -->

                </td>
                <td width="15" bgcolor="#f0f0f0">&nbsp;</td>
                <td valign="top" width="215">

                    <!-- ����� ��������� ������� -->
                    <h4 style="font-size: 15px;color: #000000">@specMainTitle@</h4>
                    <!-- ����� ��������� ������� -->

                    <!-- ����� ������� [product/main_spec_forma_icon.tpl] -->
                    @specMainIcon@
                    <!-- ����� ������� -->

                    <!-- ����� ������� [main/right_menu.tpl] -->
                    @rightMenu@
                    <!-- ����� ������� -->

                </td>
                <td width="10" bgcolor="#f0f0f0">&nbsp;</td>
            </tr>
        </table></td>
</tr>
<tr>
    <td><table width="1000" height="100" cellpadding="10" cellspacing="0" border="1">
            <tr>
                <td>
                    <p>
                        Copyright &copy; @pageReg@.<br>
                        �������: @telNum@<br>
                        <a href="/rss/" title="RSS">RSS</a> | 
                        <a href="/map/" title="MAP">����� �����</a>
                    </p>
                </td>
            </tr>
        </table></td>
</tr>
</table>
<div id="cartwindow" class="message">
    <div class="ico_add_to_card"><b>��������...</b><br>����� �������� � �������</div>
</div>
<div id="comparewindow" class="message">
    <div class="ico_add_to_compare"><b>��������...</b><br>����� �������� � ���������</div>
</div>
