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
<SCRIPT language="JavaScript" src="java/java2.js"></SCRIPT>
<SCRIPT language="JavaScript" src="java/cartwindow.js"></SCRIPT>
<SCRIPT language="JavaScript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<SCRIPT language="JavaScript" src="java/swfobject.js"></SCRIPT>
</HEAD>
<BODY onLoad="default_load('false','false');NavActive('index');LoadPath('@ShopDir@');">
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
<table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="98" valign="top" width="561" id="header_1"><table style="margin-top:35px;" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img class="icon" src="images/active_navi.gif"  alt="" width="199" height="11" border="0" usemap="#icon"> </td>
    <td><a id="start" onClick="this.style.behavior='url(#default#homepage)'; this.setHomePage('http://@serverName@');" href="#">������� ���������</a></td>
    <td width="10"></td>
    <td><a id="start"  href="/pda/" target="_blank" title="PDA ������">PDA</a></td>
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
         <td width="88" height="21" style="background:url(images/cart_bg.gif) right center no-repeat; " ><DIV class="style2" id="sum" style="DISPLAY: inline; FONT-WEIGHT: bold; color:#008ae1;padding-left:17px">@sum@ @productValutaName@</DIV></td>
      </TR>
   </TABLE>
    <table border="0" cellpadding="0" cellspacing="0">
<tr>
    <td>@valutaDisp@</td>
    </tr>
    <tr>
    <td>  <div id="order" style="display:@orderEnabled@"><A href="/order/" style="color: white; font-weight: bold;"><img src="images/order_but.gif" alt="" width="102" height="26" vspace="3" border="0"> </A></div></td>
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
              <td colspan="2" style="padding:20px 0px 0px 14px"><input name="words" class="search" maxLength=30 onFocus="this.value=''" ></td>
             
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


<div id="flashban" style="padding-top:10px;" align="center">�������� ����...</div>
<script type="text/javascript">
var dd=new Date(); 
var so = new SWFObject("/stockgallery/banner.swf?rnd="+dd.getTime(), "banner", "550", "150", "9", "#EEEEEE");
so.addParam("flashvars", "itempath=/stockgallery/item.swf&xmlpath=/stockgallery/banner.xml.php");
so.addParam("quality", "best");
so.addParam("scale", "noscale");
so.addParam("wmode", "opaque");
so.write("flashban");
</script>





  <div id="bg_catalog_1">@mainContentTitle@</div>
    <div style="color:#5e5e5e; padding-right:10px;">@mainContent@</div>
	
	<div id="bg_catalog_1">
	<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><b>������� ���������</b></td>
    <td><span>//</span><a href="/map/">����� �����</a></td>
  </tr>
</table>
	
	</div>
	@leftCatalTable@
	
	<div id="bg_catalog_1">������ ��������</div>
	@nowBuy@
	@newtipMain@
	
	
	@banersDisp@
	
	
      <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><b>���������������</b></td>
    <td><span>//</span><a href="/spec/">��� ���������������</a></td>
  </tr>
</table>
 </div>
 <div style="padding-right:3px;">@specMain@</div>

  <div id="bg_catalog_1"><table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-right:20px;"><b>�������</b></td>
    <td><span>//</span></td>
      <td style="padding-right:5px;"><img src="images/rss.gif" alt="" width="12" height="12"></td>
     <td><a href="/rss/">RSS</a><span>//</span><a href="/news/">����� ��������</a></td>

  </tr>
</table></div>

    @miniNews@
   
</td>
<td width="2"><img src="images/spacer.gif" alt="" width="2" height="1"></td>
    <td width="207" valign="top">
<div id="bg_catalog_2">�������</div>
    <div id="catal"  >
    <div id="cat_in">   <ul class="catalog">
	             @leftCatal@
			   </ul></div></div>
               <div style="clear:both"></div>
               <div id="bg_catalog_3">���������</div>
               <div style="margin-top:0px;padding-bottom:0px">
			  
			   <ul class="catalog2">
			   <li class="catalog2" id="compare" style="display:@compareEnabled@"><a href="/compare/" title="��������� �������" style="font-weight: bold">��������� ������� (<span id="numcompare">@numcompare@</span> ��.)</a>
			   <li class="catalog2"><a href="/price/" title="�����-����">�����-����</a>
			   <li class="catalog2"><a href="/news/" title="�������">�������</a>
			   <li class="catalog2"><a href="/gbook/" title="������">������</a>
	             @pageCatal@
			   <li class="catalog2"><a href="/links/" title="�������� ������">�������� ������</a>
			   <li class="catalog2"><a href="/map/" title="����� �����">����� �����</a>
			   <li class="catalog2"><a href="/forma/" title="����� �����">����� �����</a>
			   </ul>
                  
			</div>

               
           @oprosDisp@
		   @cloud@
           @leftMenu@ 
		  
		  



		   
               
              </td>
    <td width="2"><img src="images/spacer.gif" alt="" width="2" height="1"></td>
    <td width="207" valign="top">
	@skinSelect@
	<div id="bg_catalog_2">������� ��������</div>@specMainIcon@
    @rightMenu@	</td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td valign="top" id="footer">Copyright &copy; @pageReg@.<br>
��� ����� ��������. ���. @telNum@<br><br>
<img src="images/feed.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/rss/" title="RSS" target="_blank">RSS</a> <span>|</span> 
<img src="images/shop/pda.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/pda/" title="PDA" target="_blank">PDA</a> <span>|</span> 
<img src="images/shop/sitemap.gif" alt="" width="16" height="16" border="0" align="absmiddle"> <a href="/map/">����� �����</a> </td>
  </tr>
</table>
<map name="icon">
<area alt="�����" coords="18,0,30,13" href="/">
<area alt="����� �����" coords="75,0,93,15" href="/map/">
<area alt="�����" coords="131,-2,150,10" href="mailto:@adminMail@">
</map>
