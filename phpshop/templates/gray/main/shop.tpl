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
<LINK rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<LINK rel="icon" href="/favicon.ico" type="image/x-icon">
<LINK href="@pageCss@" type="text/css" rel="stylesheet">
<SCRIPT language="JavaScript" type="text/javascript" src="java/java2.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="java/cartwindow.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="java/tabpane.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>

<!--[if lt IE 7]>
<![if gte IE 5.5]>
<script type="text/javascript" src="java/fixpng.js"></script>
<style type="text/css"> 
.iePNG, IMG { filter:expression(fixPNG(this)); } 
.iePNG A { position: relative; }/* ����� ��� ���������� ������ ������ � ��������� � PNG-����� */
</style>
<![endif]>
<![endif]-->

</HEAD>
<BODY onload="pressbutt_load('@thisCat@','@pathTemplate@','false','false');LoadPath('@ShopDir@');">
<table width="1004" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td>
<div id="cartwindow" style="position:absolute;left:0px;top:0px;bottom:0px;right:0px;visibility:hidden;"> 
<table width="100%" height="100%">
<tr>
    <td width="40" vAlign=center>
    <img src="images/shop/i_commercemanager_med.gif" alt="" width="32" height="32" border="0" align="absmiddle">
    </td>
    <td><b>��������...</b><br>����� �������� � �������</td>
</tr>
</table>
</div> 


<div id="comparewindow" style="position:absolute;left:0px;top:0px;bottom:0px;right:0px;visibility:hidden;"> 
<table width="100%" height="100%">
<tr>
    <td width="40" vAlign=center>
    <img src="images/shop/i_compare_med.gif" alt="" width="32" height="32" border="0" align="absmiddle">
    </td>
    <td><b>��������...</b><br>����� �������� � ���������</td>
</tr>
</table>
</div> 
	<div class="header_bg_2_up">
		<a href="/order/" title="���������� �������"><div class="header_bg_2_up_cart">	
		   <div>������� � �������:  <span id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</span> ��.</div>
		   </div></a>
		<div class="header_bg_2_up_sum">	
		   <div>�� �����: <span id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold">@sum@</span>
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
		    <div id="compare" style="display:@compareEnabled@" class="header_bg_2_up_compare"><a href="/compare/" title="��������� �������">��������� <span id="numcompare">@numcompare@</span> ��.</a></div>
		</div>
	</div>
	<div class="header_bg_2_bg_shop">
		<div class="header_bg_2_shop">
			<div style="padding-top:60px">
				<div class="header_phpshop_logo">
				<img src="images/phpshop_logo.png" alt="" width="182" height="54" border="0" class="iePNG"> 

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
							<input name="words" class="search" maxLength=30 onfocus="this.value=''" value="� ���...">
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
			@calendar@ 
			@oprosDisp@
			
			
			
		</div>
		<div id="center_block">	
		<a name="up"></a>
			
			@DispShop@
			
			@banersDisp@
		<a name="down"></a>
		</div>
		<div id="right_block">
		
		    @rightMenu@
			
			<div class="plashka">
				<div class="plashka_zag">@specMainTitle@</div>
			</div>
			
			@specMainIcon@
			
			
		</div>
	</div>
	<div id="footer_block">
	<div id="footer_tel">
	��� �������:
	<h3>@telNum@</h3>
	</div>
	<div id="footer_cart">
	</div>
	<div id="footer_copyright">
	<div style="height: 30px;"></div>
	Copyright &copy; @pageReg@.<br>
��� ����� ��������. ���. @telNum@<br>
<img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> | 
<img src="images/shop/pda.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/pda/" title="PDA" target="_blank">PDA</a> | 
<img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle">
<a href="/map/" title="����� �����">����� �����</a> 
	</div>
	</div>
</td>
</tr>
</table>