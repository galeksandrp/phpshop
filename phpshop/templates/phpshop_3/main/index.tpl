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
<SCRIPT language="JavaScript" src="java/java2.js"></SCRIPT>
<SCRIPT language="JavaScript" src="java/cartwindow.js"></SCRIPT>
<SCRIPT language="JavaScript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
</HEAD>
<BODY onLoad="default_load('false','false');NavActive('index');LoadPath('@ShopDir@');">
<table width="1004" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td>
<span id="cartwindow"> 
<table width="100%" height="100%">
<tr>
    <td width="40" vAlign=center>
    <img src="images/shop/i_commercemanager_med.gif" alt="" width="32" height="32" border="0" align="absmiddle">
    </td>
    <td><b>��������...</b><br>����� �������� � �������</td>
</tr>
</table>
</span> 
<table align="center" width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" id="header_1" ><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"  width="431" height="138"><div id="name_shop">@name@</div>
	  <div id="slogan">@descrip@</div>
<a id="demo_link" href="/">@serverName@</a></td>
    <td valign="top" id="tel" width="295"><div><b>������� �����</b><br>
    <img src="images/phone.gif" alt="" vspace="5" width="158" height="21"><br>
��� ������� ��������<br>
�������������</div></td>
   
    <td valign="top" id="basket_bg" width="273"><div style="padding:15px 0px 0px 89px ;"> 
    <b >���� �������</b> <TABLE style=" margin:10px 0px 7px 0px;"  cellspacing="0" cellpadding="0">
   
       <TR>
            <td class="white2"><DIV class="style2" id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</DIV></td>
         <TD nowrap class="white2" >&nbsp;������� �� �����:&nbsp;</TD>
         <td  ><DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold; color:#686868;">@sum@ @productValutaName@</DIV></td>
    
      </TR>
      </TABLE>
          <table border="0" cellpadding="0" cellspacing="0">
<tr>
    <td valign="top" style="padding-bottom:10px;" >@valutaDisp@</td>
    </tr>
    <tr>
    <td><div  id="order" style="display:@orderEnabled@"  ><A href="/order/"  >�������� �����</A></div></td>
</tr>
</table></div></td>
  </tr>
  <tr>
    <td valign="top" colspan="3"  ><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td id="index"><a href="/" class="navigation" >�������</a></td>
@topMenu@
  </tr>
</table>
</td>
    <td width="203"><img src="images/active_navi.gif" alt="" width="203" height="46" border="0" usemap="#icon"></td>
  </tr>
</table>
</td>
  
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td valign="top" ><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="230">@skinSelect@<div style="padding-left:20px; padding-top:14px"><div id="bg_catalog_2">�������</div>
    @leftCatal@
    <div id="bg_catalog_2">���������</div>
    	   <ul class="catalog">
			   <li class="catalog"><a href="/price/" title="�����-����">�����-����</a>
			   <li class="catalog"><a href="/news/" title="�������">�������</a>
	             @pageCatal@
			   <li class="catalog"><a href="/links/" title="�������� ������">�������� ������</a>
			   <li class="catalog"><a href="/map/" title="����� �����">����� �����</a>
			   <li class="catalog"><a href="/users/message.html" title="����� �����">����� �����</a>
			   </ul></div>
               @leftMenu@
			   <div style="padding-left:20px"><div id="bg_catalog_2">�����</div><div style="padding-top:5px;">
 <FORM method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
            
<table >
           
<tr>
    <td><input name="words" class="search" maxLength=30 onFocus="this.value=''" value="� ���..."></td>
    <td><input type="submit" value="������" width="64" height="25"></td>
</tr>
<tr>
   <td colspan="2">
<a href="/search/" id="search_adv">����������� �����</a>
   </td>
</tr>

</table>
</FORM>
</div>
@oprosDisp@</div>
</td>
    <td valign="top" width="9"><img src="images/spacer.gif" alt="" width="9" height="1"></td>
    <td valign="top" width="529"><div><a href="/spec/"><img src="images/product_spec.jpg" alt="" width="529" height="180" border="0"></a></div>
	 <div id="bg_catalog_1" style="background: none">@mainContentTitle@</div>
    <div id="about">@mainContent@</div>
	@banersDisp@
	    <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><b>���������������</b></td>
    <td><a href="/spec/"><img src="images/all_spec.gif" alt="" width="135" height="23" hspace="16" border="0"></a></td>
  </tr>
</table>

</div>
 <div style="padding:0px 12px 20px;">@specMain@</div>
 <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-right:35px;"><b>�������</b></td>
      <td style="padding-right:5px;"><img src="images/rss.gif" alt="" width="12" height="12"></td>
     <td><a href="/rss/">RSS</a></td>
	 <td><a href="/news/"><img src="images/news_archive.gif" alt="" width="105" height="23" hspace="16" border="0"></a></td>

  </tr>
</table></div>

    @miniNews@</td>
    <td valign="top" width="5"><img src="images/spacer.gif" alt="" width="5" height="1"></td>
    <td valign="top" width="226" style="padding-top:14px">@usersDisp@<div id="bg_catalog_1" style="margin-top:15px;">������� ��������</div>@specMainIcon@
    @rightMenu@</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td valign="top" ><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" id="footer">Copyright &copy; @pageReg@. ��� ����� ��������.  <br>
���. @telNum@<br><br>
<img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> <span>|</span> 
<img src="images/shop/pda.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/pda/" title="PDA" target="_blank">PDA</a> <span>|</span> 
<img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/map/">����� �����</a> </td>
    
  </tr>
</table></td>
  </tr>
</table>
<map name="icon">
<area alt="�����" coords="16,16,28,29" href="/">
<area alt="����� �����" coords="70,14,88,29" href="/map/">
<area alt="�����" coords="129,16,148,28" href="mailto:@adminMail@">
</map>