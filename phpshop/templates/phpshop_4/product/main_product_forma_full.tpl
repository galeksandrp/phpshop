
<div>
<h1>@productName@</h1>
</div>

<div id="allspec" align="center">
<div id="fotoload" align="center">
			@productFotoList@
</div>
</div>

			<br>
<div align="center">
@ComStart@
@optionsDisp@
<strong>@productSklad@</strong><br><br>
 <table width="100%" align="center" class="bg_product_forma_full">
<tr>
	<td>
			<div class="zag" style="padding-left:17px;">@ComStart@@productPrice@ @productValutaName@ @ComEnd@</div>
	</td>
	<td class="pad_9">
	<!-- ���� ��������� -->
    @ComStartNotice@
	<A href="/users/notice.html?productId=@productUid@" title="@productNotice@ @productName@"><img src="images/but_add_notice.gif" border="0"></A>
	@ComEndNotice@
	<!-- ���� ��������� -->
	
	<!-- ���� ������� -->
	@ComStartCart@
	<A href="javascript:AddToCart(@productUid@)" title="@productSale@ @productName@"><img src="images/but_add_cart.gif" border="0"></A>
	@ComEndCart@
	<!-- ���� ������� -->
	
	</td>
	<td class="pad_9">
	<A href="javascript:AddToCompare(@productUid@)" title="�������� @productName@"><img src="images/but_add_compare.gif" border="0"></A>
	</td>
	 <td class="pad_9">
	 <!-- ���� ������������ -->
	 @ComStartCart@
	  <A href="/pricemail/UID_@productId@.html" title="������������ �� ����"><img src="images/but_pricemail.gif" border="0"></A>
     @ComEndCart@
     <!-- ���� ������������ -->
	  </td>
	
</tr>
</table>
@ComEnd@
@productParentList@
</div>
<div class="tab-pane" id="tabPane1" style="margin-top: 20px">
<script type="text/javascript">
tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
</script>
<div class="tab-page" id="tabPage1">
		<h2 class="tab">
		<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">��������</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
		
		@productDes@
		
	</div>
   <div class="tab-page" id="tabPage6">
		<h2 class="tab">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">�����</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>		
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage6" ) );</script>
		
		@productFiles@
		
	</div>
	<div class="tab-page" id="tabPage2">
		<h2 class="tab">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">��������������</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
		
		@vendorDisp@
		
	</div>
	<div class="tab-page" id="tabPage5">
		<h2 class="tab">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">������ ������</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage5" ) );</script>
		
		@ratingfull@
		
	</div>
	<div class="tab-page" id="tabPage3">
		<h2 class="tab">
		<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">������</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage3" ) );</script>
		
		<div id="bg_catalog_1" style="margin-top:10px">����������� �������������</div>
<TEXTAREA id="message" style="WIDTH: 340px" rows="5" onkeyup="return countSymb();"></TEXTAREA>
<DIV style="FONT-SIZE: 10px; MARGIN-BOTTOM: 5px">������������ ���������� ��������: <SPAN id="count" style="WIDTH: 30px; COLOR: green; TEXT-ALIGN: center">0</SPAN>/&nbsp;&nbsp;&nbsp;500 </DIV>
<DIV style="padding: 5px">
<IMG onmouseover="this.style.cursor='hand';" title=������� onclick="emoticon(':-D');" alt=������� src="images/smiley/grin.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=��������� onclick="emoticon(':)');" alt=��������� src="images/smiley/smile3.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=�������� onclick="emoticon(':(');" alt=�������� src="images/smiley/sad.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title="� ����" onclick="emoticon(':shock:');" alt="� ����" src="images/smiley/shok.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=������������� onclick="emoticon(':cool:');" alt=������������� src="images/smiley/cool.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=���������� onclick="emoticon(':blush:');" alt=���������� src="images/smiley/blush2.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=������� onclick="emoticon(':dance:');" alt=������� src="images/smiley/dance.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=�������� onclick="emoticon(':rad:');" alt=�������� src="images/smiley/happy.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title="��� ������" onclick="emoticon(':lol:');" alt="��� ������" src="images/smiley/lol.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title="� ��������������" onclick="emoticon(':huh:');" alt="� ��������������" src="images/smiley/huh.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=���������� onclick="emoticon(':rolly:');" alt=���������� src="images/smiley/rolleyes.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=���� onclick="emoticon(':thuf:');" alt=���� src="images/smiley/threaten.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title="���������� ����" onclick="emoticon(':tongue:');" alt="���������� ����" src="images/smiley/tongue.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=�������� onclick="emoticon(':smart:');" alt=�������� src="images/smiley/umnik2.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=��������� onclick="emoticon(':wacko:');" alt=��������� src="images/smiley/wacko.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=����������� onclick="emoticon(':yes:');" alt=����������� src="images/smiley/yes.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=��������� onclick="emoticon(':yahoo:');" alt=��������� src="images/smiley/yu.gif" border=0>

<IMG onmouseover="this.style.cursor='hand';" title=�������� onclick="emoticon(':sorry:');" alt=�������� src="images/smiley/sorry.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title="��� ���" onclick="emoticon(':nono:');" alt="��� ���" src="images/smiley/nono.gif" border=0> 
<IMG onmouseover="this.style.cursor='hand';" title="������ �� ������" onclick="emoticon(':dash:');" alt="������ �� ������" src="images/smiley/dash.gif" border=0>
<IMG onmouseover="this.style.cursor='hand';" title=������������ onclick="emoticon(':dry:');" alt=������������ src="images/smiley/dry.gif" border=0> </DIV>
<div style="padding:5px" id="commentButtonAdd">
<input type="button"  value="�������� �����������" onclick="commentList('@productUid@','add',1)" >
</div>
<div  id="commentButtonEdit" style="padding:5px;visibility:hidden;display:none">
<input type="button"  value="�������� �����������" onclick="commentList('@productUid@','add',1)" >
<input type="button"  value="������� �����������" onclick="commentList('@productUid@','edit_add','1')" >
<input type="button"  value="�������" onclick="commentList('@productUid@','dell','1')" >
<input type="hidden" id="commentEditId">
</div>
<div id="commentList" style="padding-top: 10px">
</div>
<script>
setTimeout("commentList('@productUid@','list')",500);
</script>
		
	</div>
	<div class="tab-page" id="tabPage4">
		<h2 class="tab">
		<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_left" alt="" width="11" height="26" border="0" /></td>
    <td class="sel_center">������</td>
    <td width="11" height="26"><img src="images/spacer.gif" class="sel_right" alt="" width="11" height="26" border="0" /></td>
  </tr>
</table>
		</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage4" ) );</script>
		
		@pagetemaDisp@
		
	</div>
	
</div>