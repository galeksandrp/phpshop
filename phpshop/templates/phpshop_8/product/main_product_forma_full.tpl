<table cellpadding="0" cellspacing="0" border="0" class="cartTable">
    <tbody>
        <tr>
            <td valign="top" class="cartTableTd1"><div id="fotoload" align="center">@productFotoList@</div></td>
            <td valign="top" class="cartTableTd2">&nbsp;</td>
            <td valign="top" class="cartTableTd3"><h1 class="cartName">@productName@</h1>
                @ComStart@
                <div class="optionsDispSelect">@optionsDisp@</div>
                <span class="productPriceRub">@productPriceRub@</span> @ComStartCart@
                <div class="productPrice"><span>����:</span> @productPrice@ @productValutaName@</div>
                @ComEndCart@ <span class="productSklad">@productSklad@</span><br>@oneclick@
                <div class="productBay-1">
                    <div class="productBay-2">
                        <!-- ���� ��������� -->
                        @ComStartNotice@ <a href="/users/notice.html?productId=@productId@" title="@productNotice@"><img src="images/furniture_29.gif" border="0"></a> @ComEndNotice@
                        <!-- ���� ��������� -->
                        <!-- ���� ������� -->
                        @ComStartCart@ <a href="javascript:AddToCart(@productId@)" title="@productSale@"><img src="images/furniture_28.gif" border="0"></a> @ComEndCart@
                        <!-- ���� ������� -->
                    </div>
                    
                </div>
                <div class="productCompare"><a href="javascript:AddToCompare(@productUid@)" title="�������� @productName@"><img src="images/furniture_30.gif" border="0"></a></div>
                @ComEnd@@productParentList@
                <br>@promotionInfo@
                </td>
        </tr>
    </tbody>
</table>
<table cellpadding="0" cellspacing="0" border="0" class="tabTable">
    <tbody>
        <tr>
            <td valign="top" class="tabTD"><div id="tabPanel1" class="tabPanel1_on" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '1', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '1');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '1');">��������</div>
                <div id="tabPanel2" class="tabPanel2_off" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '2', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '2');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '2');">�����</div>
                <div id="tabPanel3" class="tabPanel3_off" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '3', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '3');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '3');">��������������</div>
                <div id="tabPanel4" class="tabPanel4_off" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '4', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '4');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '4');">�������</div>
                <div id="tabPanel5" class="tabPanel5_off" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '5', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '5');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '5');">������</div>
                <div id="tabPanel6" class="tabPanel6_off" onClick="tabPaneClick('tabPanel', 'tabPanelSlect', '6', '6');" onMouseOver="tabPaneOver('tabPanel', 'tabPanelSlect', '6');" onMouseOut="tabPaneOut('tabPanel', 'tabPanelSlect', '6');">������</div></td>
        </tr>
    </tbody>
</table>
<div class="tabPanelSect_on" id="tabPanelSlect1"> @productDes@ </div>
<div class="tabPanelSect_off" id="tabPanelSlect2"> @productFiles@ </div>
<div class="tabPanelSect_off" id="tabPanelSlect3"> @vendorDisp@ </div>
<div class="tabPanelSect_off" id="tabPanelSlect4"> @ratingfull@ </div>
<div class="tabPanelSect_off" id="tabPanelSlect5">
    <div id="bg_catalog_1" style="margin-top:10px">����������� �������������</div>
    <TEXTAREA id="message" style="WIDTH: 340px" rows="5" onkeyup="return countSymb();" class="borderForm"></TEXTAREA>
  <DIV style="FONT-SIZE: 10px; MARGIN-BOTTOM: 5px">������������ ���������� ��������: <SPAN id="count" style="WIDTH: 30px; COLOR: green; TEXT-ALIGN: center">0</SPAN>/&nbsp;&nbsp;&nbsp;500 </DIV>
  <DIV style="padding: 5px"> <IMG onmouseover="this.style.cursor = 'hand';" title=������� onclick="emoticon(':-D');" alt=������� src="images/smiley/grin.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':)');" alt=��������� src="images/smiley/smile3.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':(');" alt=�������� src="images/smiley/sad.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="� ����" onclick="emoticon(':shock:');" alt="� ����" src="images/smiley/shok.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=������������� onclick="emoticon(':cool:');" alt=������������� src="images/smiley/cool.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=���������� onclick="emoticon(':blush:');" alt=���������� src="images/smiley/blush2.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=������� onclick="emoticon(':dance:');" alt=������� src="images/smiley/dance.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':rad:');" alt=�������� src="images/smiley/happy.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="��� ������" onclick="emoticon(':lol:');" alt="��� ������" src="images/smiley/lol.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="� ��������������" onclick="emoticon(':huh:');" alt="� ��������������" src="images/smiley/huh.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=���������� onclick="emoticon(':rolly:');" alt=���������� src="images/smiley/rolleyes.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=���� onclick="emoticon(':thuf:');" alt=���� src="images/smiley/threaten.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="���������� ����" onclick="emoticon(':tongue:');" alt="���������� ����" src="images/smiley/tongue.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':smart:');" alt=�������� src="images/smiley/umnik2.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':wacko:');" alt=��������� src="images/smiley/wacko.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=����������� onclick="emoticon(':yes:');" alt=����������� src="images/smiley/yes.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':yahoo:');" alt=��������� src="images/smiley/yu.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':sorry:');" alt=�������� src="images/smiley/sorry.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="��� ���" onclick="emoticon(':nono:');" alt="��� ���" src="images/smiley/nono.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title="������ �� ������" onclick="emoticon(':dash:');" alt="������ �� ������" src="images/smiley/dash.gif" border=0> <IMG onmouseover="this.style.cursor = 'hand';" title=������������ onclick="emoticon(':dry:');" alt=������������ src="images/smiley/dry.gif" border=0> </DIV>
  <div style="padding:5px" id="commentButtonAdd">
    <input type="button"  value="�������� �����������" onclick="commentList('@productUid@', 'add', 1)" >
  </div>
  <div  id="commentButtonEdit" style="padding:5px;visibility:hidden;display:none">
    <input type="button"  value="�������� �����������" onclick="commentList('@productUid@', 'add', 1)" >
    <input type="button"  value="������� �����������" onclick="commentList('@productUid@', 'edit_add', '1')" >
    <input type="button"  value="�������" onclick="commentList('@productUid@', 'dell', '1')" >
    <input type="hidden" id="commentEditId">
  </div>
  <div id="commentList" style="padding-top: 10px"> </div>
  <script>
            setTimeout("commentList('@productUid@','list')", 500);
  </script>
</div>
<div class="tabPanelSect_off" id="tabPanelSlect6"> @pagetemaDisp@ </div>
