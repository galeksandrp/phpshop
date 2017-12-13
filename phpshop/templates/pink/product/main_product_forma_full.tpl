
<div align="center">
    <h1>@productName@</h1>
</div>
<div align="center" >
    <div class="price">
        <strong>@productPrice@</strong> @productValutaName@<br>
        @productPriceRub@
    </div>
</div>
<script type="text/javascript" src="java/highslide/highslide-p.js"></script>
<link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>

<script type="text/javascript">
    hs.registerOverlay({
        html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>',
        position: 'top right',
        fade: 2 // fading the semi-transparent overlay looks bad in IE
    });


    hs.graphicsDir = 'java/highslide/graphics/';
    hs.wrapperClassName = 'borderless';
</script>
<div id="allspec" align="center">
    <div id="fotoload" align="center">
        @productFotoList@
    </div>
</div>

<br>
<div class="pod_cart" align="center">
    @ComStart@
    @optionsDisp@
    <table width="100%" align="center">
        <tr>
            <td><strong>@productSklad@</strong>
	             <br>@oneclick@

            </td>
            <td>

                <!-- ���� ��������� -->
                @ComStartNotice@
                <img src="images/icon_email.gif" alt="" border="0" align="absmiddle">
                <A href="/users/notice.html?productId=@productId@" title="@productNotice@">@productNotice@</A>
                @ComEndNotice@
                <!-- ���� ��������� -->

                <!-- ���� ������� -->
                @ComStartCart@
                <img src="images/shop/basket_put.gif" alt="" border="0" align="absmiddle">
                <A href="javascript:AddToCart(@productId@)" title="@productSale@">@productSale@</A>
                @ComEndCart@
                <!-- ���� ������� -->

            </td>
            <td>
                <img src="images/shop/application_view_tile.gif" alt="��������" border="0" align="absmiddle">
                <A href="javascript:AddToCompare(@productUid@)" class=b  title="�������� @productName@">��������</A>
            </td>
            <td>
                <!-- ���� ������������ -->
                @ComStartCart@
                <img src="images/shop/comment.gif" alt="" border="0" align="absmiddle">
                <A href="/pricemail/UID_@productId@.html" title="������������ �� ����">������������ �� ����</A>
                @ComEndCart@
                <!-- ���� ������������ -->
            </td>
            <td><img src="images/shop/icon-setup2.gif" alt="" border="0" align="absmiddle">
                <A href="javascript:history.back(1)" title="@productBack@">@productBack@</A></td>

        </tr>
    </table>
    @ComEnd@
    @productParentList@
</div>
<div class="tab-pane" id="tabPane1" style="margin-top: 20px">
    <script type="text/javascript">
        tp1 = new WebFXTabPane(document.getElementById("tabPane1"));
    </script>
    <div class="tab-page" id="tabPage1">
        <h2 class="tab">��������</h2>

        <script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage1"));</script>

        @productDes@

    </div>
    <div class="tab-page" id="tabPage6">
        <h2 class="tab">�����</h2>

        <script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage6"));</script>

        @productFiles@

    </div>
    <div class="tab-page" id="tabPage2">
        <h2 class="tab">��������������</h2>

        <script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage2"));</script>

        @vendorDisp@

    </div>
    <div class="tab-page" id="tabPage5">
        <h2 class="tab">�������</h2>

        <script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage5"));</script>

        @ratingfull@

    </div>
    <div class="tab-page" id="tabPage3">
        <h2 class="tab">������</h2>

        <script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage3"));</script>

        <div id="bg_catalog_1" style="margin-top:10px">����������� �������������</div>
        <TEXTAREA id="message" style="WIDTH: 340px" rows="5" onkeyup="return countSymb();"></TEXTAREA>
<DIV style="FONT-SIZE: 10px; MARGIN-BOTTOM: 5px">������������ ���������� ��������: <SPAN id="count" style="WIDTH: 30px; COLOR: green; TEXT-ALIGN: center">0</SPAN>/&nbsp;&nbsp;&nbsp;500 </DIV>
<DIV style="padding: 5px">
<IMG onmouseover="this.style.cursor = 'hand';" title=������� onclick="emoticon(':-D');" alt=������� src="images/smiley/grin.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':)');" alt=��������� src="images/smiley/smile3.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':(');" alt=�������� src="images/smiley/sad.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title="� ����" onclick="emoticon(':shock:');" alt="� ����" src="images/smiley/shok.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=������������� onclick="emoticon(':cool:');" alt=������������� src="images/smiley/cool.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=���������� onclick="emoticon(':blush:');" alt=���������� src="images/smiley/blush2.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=������� onclick="emoticon(':dance:');" alt=������� src="images/smiley/dance.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':rad:');" alt=�������� src="images/smiley/happy.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title="��� ������" onclick="emoticon(':lol:');" alt="��� ������" src="images/smiley/lol.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title="� ��������������" onclick="emoticon(':huh:');" alt="� ��������������" src="images/smiley/huh.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=���������� onclick="emoticon(':rolly:');" alt=���������� src="images/smiley/rolleyes.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=���� onclick="emoticon(':thuf:');" alt=���� src="images/smiley/threaten.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title="���������� ����" onclick="emoticon(':tongue:');" alt="���������� ����" src="images/smiley/tongue.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':smart:');" alt=�������� src="images/smiley/umnik2.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':wacko:');" alt=��������� src="images/smiley/wacko.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=����������� onclick="emoticon(':yes:');" alt=����������� src="images/smiley/yes.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=��������� onclick="emoticon(':yahoo:');" alt=��������� src="images/smiley/yu.gif" border=0>

<IMG onmouseover="this.style.cursor = 'hand';" title=�������� onclick="emoticon(':sorry:');" alt=�������� src="images/smiley/sorry.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title="��� ���" onclick="emoticon(':nono:');" alt="��� ���" src="images/smiley/nono.gif" border=0> 
<IMG onmouseover="this.style.cursor = 'hand';" title="������ �� ������" onclick="emoticon(':dash:');" alt="������ �� ������" src="images/smiley/dash.gif" border=0>
<IMG onmouseover="this.style.cursor = 'hand';" title=������������ onclick="emoticon(':dry:');" alt=������������ src="images/smiley/dry.gif" border=0> </DIV>
<div style="padding:5px" id="commentButtonAdd">
<input type="button"  value="�������� �����������" onclick="commentList('@productUid@', 'add', 1)" >
</div>
<div  id="commentButtonEdit" style="padding:5px;visibility:hidden;display:none">
<input type="button"  value="�������� �����������" onclick="commentList('@productUid@', 'add', 1)" >
<input type="button"  value="������� �����������" onclick="commentList('@productUid@', 'edit_add', '1')" >
<input type="button"  value="�������" onclick="commentList('@productUid@', 'dell', '1')" >
<input type="hidden" id="commentEditId">
</div>
<div id="commentList" style="padding-top: 10px">
</div>
<script>
            setTimeout("commentList('@productUid@','list')", 500);
        </script>
		
	</div>
	<div class="tab-page" id="tabPage4">
		<h2 class="tab">������</h2>
		
		<script type="text/javascript">tp1.addTabPage(document.getElementById("tabPage4"));</script>
		
		@pagetemaDisp@
		
	</div>
	
</div>
<div style="float:right;"><a href="#up" style="color:AC8694"><img src="images/shop/2.gif" alt="" hspace="2" border="0" align="absmiddle">������</a></div>