<TABLE  border="0" cellpadding="0" cellspacing="0" class="style1">
		
			<TD colspan="2">
				<h1>@productName@</h1>
		 <br>@promotionInfo@
			</TD>
		</TR>
		<TR>
			<TD>
			<div id="fotoload" align="center">
			@productFotoList@
			</div><br><br>
@ComStart@
@optionsDisp@
<TABLE>
								<TR>
								<td>
								<TABLE  BORDER=0 CELLPADDING=0 CELLSPACING=0>
		<TR>
		<TD  height="21" width="150">
		<strong class=price > @productPrice@ @productValutaName@</strong><br>
		<font class=black>@productPriceRub@</font><br>
		<b>@productSklad@</b>
		<br>@oneclick@
		</TD>
	</TR>
</TABLE>
								</td>
								<td style=padding-top:5>
<img src="images/shop/line3.gif" alt="" width="1" height="35" border="0">
								</td>
						<TD   height="35">
							<TABLE>
							    <tr>
								   <TD>
									<!-- ���� ������� -->
	@ComStartCart@
    <img src="images/shop/basket_put.gif" alt="" border="0" align="absmiddle">
	@ComEndCart@
	<!-- ���� ������� -->
	<!-- ���� ��������� -->
	@ComStartNotice@
    <img src="images/icon_email.gif" alt="" border="0" align="absmiddle">
	@ComEndNotice@
	<!-- ���� ��������� -->
									</TD>
									<TD valign="middle">
									
									<!-- ���� ������� -->
	@ComStartCart@
	<A href="javascript:AddToCart(@productId@)" class="b" title="@productSale@">@productSale@</A>
	@ComEndCart@
	<!-- ���� ������� -->
	<!-- ���� ��������� -->
	@ComStartNotice@
	<A href="/users/notice.html?productId=@productId@" class="b" title="@productNotice@">@productNotice@</A>
	@ComEndNotice@
	<!-- ���� ��������� -->

									</TD>
								</tr>
								<TR>
									<TD>
									<img src="images/shop/icon-setup2.gif" alt="" border="0">
									</TD>
									<TD valign="middle"><A href="javascript:history.back(1)" class=b >@productBack@</A>
									</TD>
								</TR>
							</TABLE>
</TD>
<td style=padding-top:5>
<img src="images/shop/line3.gif" alt="" width="1" height="35" border="0">
								</td>
								<td>
								
								<TABLE>
							    <tr>
								   <TD>
									<img src="images/shop/comment.gif" alt="" border="0">
									</TD>
									<TD valign="middle">
									<A href="/pricemail/UID_@productId@.html" class=b >������������ �� ����</A>
									</TD>
								</tr>
								<tr>
								   <TD >
								
<img src="images/shop/application_view_tile.gif" alt="��������" border="0">
    
									</TD>
									<TD valign="middle">
									<A href="javascript:AddToCompare(@productUid@)" class=b  title="�������� @productName@">��������</A>
                                    </TD>
								</tr>
							</TABLE>
								
								
								</td>
					</TR>
				</TABLE>
				@ComEnd@
				@productParentList@
			</TD>
		</TR>
	</TABLE>
	<div class="tab-pane" id="tabPane1" style="margin-top: 20px">
<script type="text/javascript">
tp1 = new WebFXTabPane( document.getElementById( "tabPane1" ) );
</script>
<div class="tab-page" id="tabPage1">
		<h2 class="tab">��������</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage1" ) );</script>
		
		@productDes@
		
	</div>
 <div class="tab-page" id="tabPage6">
		<h2 class="tab">�����</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage6" ) );</script>
		
		@productFiles@
		
	</div>
	<div class="tab-page" id="tabPage2">
		<h2 class="tab">��������������</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage2" ) );</script>
		
		@vendorDisp@
		
	</div>
		<div class="tab-page" id="tabPage5">
		<h2 class="tab">������ ������</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage5" ) );</script>
		
		@ratingfull@
		
	</div>
	<div class="tab-page" id="tabPage3">
		<h2 class="tab">������</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage3" ) );</script>
		
	
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
		<h2 class="tab">������</h2>
		
		<script type="text/javascript">tp1.addTabPage( document.getElementById( "tabPage4" ) );</script>
		
		@pagetemaDisp@
		
	</div>
	
</div>