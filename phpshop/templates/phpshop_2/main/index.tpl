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
    <td valign="top" id="header_1"><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" width="225"><a href="/"><img src="images/hedaer_1.gif" alt="�����" width="225" height="159" border=""></a></td>
    <td valign="top" width="559"><table width="559" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">      <div id="name_shop">@name@</div>
      <div id="slogan">@descrip@</div>
<a id="demo_link" href="/">@serverName@</a></td>
    <td valign="top" align="right" id="tel">
	<span class="telefon">@telNum@</span><br>
��� ������� ��������<br>
�������������    </td>
  </tr>
</table>
</td>
    <td width="215" valign="top"><div style="padding:0px 0px 0px 0px ;"> 
    <div id="bg_catalog_2" style="padding-left:10px">�������</div> <TABLE style="border-bottom:1px solid #ececec" width="203" cellspacing="0" cellpadding="0">
   
       <TR>
         <TD class="white2" height="25" width="134">&nbsp;&nbsp;&nbsp;������� � �������</TD>
         <td class="white2"><DIV class="style2" id="num" style="DISPLAY: inline; FONT-WEIGHT: bold">@num@</DIV>&nbsp;��.</td>
      </TR>
      </TABLE>
          <TABLE style="border-bottom:1px solid #ececec;" width="203" cellspacing="0" cellpadding="0">
      <TR>
         <TD class="white2" height="25" width="134">&nbsp;&nbsp;&nbsp;����� ������ :</TD>
         <td  ><DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold; color:#0076c9;">@sum@ @productValutaName@</DIV></td>
      </TR>
   </TABLE>
    <table border="0" cellpadding="0" cellspacing="0">
<tr>
    <td valign="top" >@valutaDisp@</td>
    </tr>
    <tr>
    <td><div  id="order" style="display:@orderEnabled@" ><A href="/order/" >�������� �����</A></div></td>
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
    <td  width="559" id="header_2"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td id="index"><a href="/" class="navigation" >�������</a></td>
   @topMenu@
  </tr>
</table>
</td>
    <td valign="top" width="215">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"> <div id="bg_catalog_3">�������</div>
    @leftCatal@
    <div id="bg_catalog_3">���������</div>
    	   <ul class="catalog">
			   <li class="catalog"><a href="/price/" title="�����-����">�����-����</a>
			   <li class="catalog"><a href="/news/" title="�������">�������</a>
	             @pageCatal@
			   <li class="catalog"><a href="/links/" title="�������� ������">�������� ������</a>
			   <li class="catalog"><a href="/map/" title="����� �����">����� �����</a>
			   <li class="catalog"><a href="/users/message.html" title="����� �����">����� �����</a>
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
    <td><input name="words" class="search" maxLength=30 onFocus="this.value=''" value="� ���..."></td>
    <td width="80" align="right"><input type="image" value="" src="images/search_but.gif" width="66" height="26" ></td>
</tr>


</table></FORM></div>
  <div id="bg_catalog_1" style="background: none">@mainContentTitle@</div>
    <div id="about">@mainContent@</div>
	
	
	<div id="bg_catalog_1">������� ���������</div>
	<div id="about">@leftCatalTable@</div>
	
	
	@banersDisp@
	
	
    <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><b>���������������</b></td>
    <td><span id="plus_1">+</span><a href="/spec/">��� ���������������</a></td>
  </tr>
</table>

</div>

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
    @rightMenu@</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td valign="top" id="footer"><table width="999" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="225" valign="top" style="padding-left:18px;">Copyright &copy; @pageReg@.<br> ��� ����� ��������.  <br>
���. @telNum@<br><br>
<img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS">RSS</a> <span>|</span> 
<img src="images/shop/pda.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/pda/" title="PDA" target="_blank">PDA</a> <span>|</span> 
<img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/map/">����� �����</a> </td>
    <td width="774" valign="top" id="foot_nav"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td id="index"><a href="/" class="navigation" >�������</a></td>
   @topMenu@
  </tr>
</table></td>
  </tr>
</table>
 </td>
  </tr>
</table>
<map name="icon">
<area alt="�����" coords="38,14,50,27" href="/">
<area alt="����� �����" coords="92,12,110,27" href="/map/">
<area alt="�����" coords="150,13,169,25" href="mailto:@adminMail@">
</map>