<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
        <script>

            function fixWord()
{




    var str=document.getElementById('content1').value;
    str=String(str).replace(/<\\?\?xml[^>]*>/g,"");
    str=String(str).replace(/<\/?o:p[^>]*>/g,"");
    str=String(str).replace(/<\/?v:[^>]*>/g,"");
    str=String(str).replace(/<\/?o:[^>]*>/g,"");
    str=String(str).replace(/<\/?st1:[^>]*>/g,"");

    //FF Fix
    str=String(str).replace(/<\/?meta[^>]*>/g,"");
    str=String(str).replace(/<\/?link[^>]*>/g,"");
    //str=String(str).replace(/<\/?!-[^>]*->/g,"");
    str=String(str).replace(/!--/g,"comment content='");
    str=String(str).replace(/--/g,"'/");
    str=String(str).replace(/<\/?comment[^>]*>/g,"");

    str=String(str).replace(/&nbsp;/g,"");//<p>&nbsp;</p>

    str=String(str).replace(/<\/?SPAN[^>]*>/g,"");
    str=String(str).replace(/<\/?FONT[^>]*>/g,"");
    str=String(str).replace(/<\/?STRONG[^>]*>/g,"");

    str=String(str).replace(/<\/?H1[^>]*>/g,"");
    str=String(str).replace(/<\/?H2[^>]*>/g,"");
    str=String(str).replace(/<\/?H3[^>]*>/g,"");
    str=String(str).replace(/<\/?H4[^>]*>/g,"");
    str=String(str).replace(/<\/?H5[^>]*>/g,"");
    str=String(str).replace(/<\/?H6[^>]*>/g,"");

    str=String(str).replace(/<\/?P[^>]*><\/P>/g,"");
    document.getElementById('content2').value=str
    return str;
    }
            </script>
</head>

<body>



</body>
<textarea name="test" rows="10" id="content1" cols="100">
<meta  content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta content="Word.Document" name="ProgId" />
<meta content="Microsoft Word 12" name="Generator" />
<meta content="Microsoft Word 12" name="Originator" />
<link href="file:///C:%5CUsers%5CDennion%5CAppData%5CLocal%5CTemp%5Cmsohtmlclip1%5C01%5Cclip_filelist.xml" rel="File-List" />
<link href="file:///C:%5CUsers%5CDennion%5CAppData%5CLocal%5CTemp%5Cmsohtmlclip1%5C01%5Cclip_themedata.thmx" rel="themeData" />
<link href="file:///C:%5CUsers%5CDennion%5CAppData%5CLocal%5CTemp%5Cmsohtmlclip1%5C01%5Cclip_colorschememapping.xml" rel="colorSchemeMapping" />
<!--[if gte mso 9]&gt;&lt;xml&gt;<br> &lt;w:WordDocument&gt;<br> &lt;w:View&gt;Normal&lt;/w:View&gt;<br> &lt;w:Zoom&gt;0&lt;/w:Zoom&gt;<br> &lt;w:TrackMoves/&gt;<br> &lt;w:TrackFormatting/&gt;<br> &lt;w:PunctuationKerning/&gt;<br> &lt;w:ValidateAgainstSchemas/&gt;<br> &lt;w:SaveIfXMLInvalid&gt;false&lt;/w:SaveIfXMLInvalid&gt;<br> &lt;w:IgnoreMixedContent&gt;false&lt;/w:IgnoreMixedContent&gt;<br> &lt;w:AlwaysShowPlaceholderText&gt;false&lt;/w:AlwaysShowPlaceholderText&gt;<br> &lt;w:DoNotPromoteQF/&gt;<br> &lt;w:LidThemeOther&gt;RU&lt;/w:LidThemeOther&gt;<br> &lt;w:LidThemeAsian&gt;X-NONE&lt;/w:LidThemeAsian&gt;<br> &lt;w:LidThemeComplexScript&gt;X-NONE&lt;/w:LidThemeComplexScript&gt;<br> &lt;w:Compatibility&gt;<br> &lt;w:BreakWrappedTables/&gt;<br> &lt;w:SnapToGridInCell/&gt;<br> &lt;w:WrapTextWithPunct/&gt;<br> &lt;w:UseAsianBreakRules/&gt;<br> &lt;w:DontGrowAutofit/&gt;<br> &lt;w:SplitPgBreakAndParaMark/&gt;<br> &lt;w:DontVertAlignCellWithSp/&gt;<br> &lt;w:DontBreakConstrainedForcedTables/&gt;<br> &lt;w:DontVertAlignInTxbx/&gt;<br> &lt;w:Word11KerningPairs/&gt;<br> &lt;w:CachedColBalance/&gt;<br> &lt;/w:Compatibility&gt;<br> &lt;w:BrowserLevel&gt;MicrosoftInternetExplorer4&lt;/w:BrowserLevel&gt;<br> &lt;m:mathPr&gt;<br> &lt;m:mathFont m:val="Cambria Math"/&gt;<br> &lt;m:brkBin m:val="before"/&gt;<br> &lt;m:brkBinSub m:val="&amp;#45;-"/&gt;<br> &lt;m:smallFrac m:val="off"/&gt;<br> &lt;m:dispDef/&gt;<br> &lt;m:lMargin m:val="0"/&gt;<br> &lt;m:rMargin m:val="0"/&gt;<br> &lt;m:defJc m:val="centerGroup"/&gt;<br> &lt;m:wrapIndent m:val="1440"/&gt;<br> &lt;m:intLim m:val="subSup"/&gt;<br> &lt;m:naryLim m:val="undOvr"/&gt;<br> &lt;/m:mathPr&gt;&lt;/w:WordDocument&gt;<br> &lt;/xml&gt;&lt;![endif]-->
<!--[if gte mso 9]&gt;&lt;xml&gt;<br> &lt;w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="true"<br> DefSemiHidden="true" DefQFormat="false" DefPriority="99"<br> LatentStyleCount="267"&gt;<br> &lt;w:LsdException Locked="false" Priority="0" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Normal"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="heading 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 7"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 8"/&gt;<br> &lt;w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 9"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 7"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 8"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" Name="toc 9"/&gt;<br> &lt;w:LsdException Locked="false" Priority="35" QFormat="true" Name="caption"/&gt;<br> &lt;w:LsdException Locked="false" Priority="10" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Title"/&gt;<br> &lt;w:LsdException Locked="false" Priority="1" Name="Default Paragraph Font"/&gt;<br> &lt;w:LsdException Locked="false" Priority="11" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Subtitle"/&gt;<br> &lt;w:LsdException Locked="false" Priority="22" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Strong"/&gt;<br> &lt;w:LsdException Locked="false" Priority="20" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Emphasis"/&gt;<br> &lt;w:LsdException Locked="false" Priority="59" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Table Grid"/&gt;<br> &lt;w:LsdException Locked="false" UnhideWhenUsed="false" Name="Placeholder Text"/&gt;<br> &lt;w:LsdException Locked="false" Priority="1" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="No Spacing"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" UnhideWhenUsed="false" Name="Revision"/&gt;<br> &lt;w:LsdException Locked="false" Priority="34" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="List Paragraph"/&gt;<br> &lt;w:LsdException Locked="false" Priority="29" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Quote"/&gt;<br> &lt;w:LsdException Locked="false" Priority="30" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Intense Quote"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 1"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 2"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 3"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 4"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 5"/&gt;<br> &lt;w:LsdException Locked="false" Priority="60" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Shading Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="61" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light List Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="62" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Light Grid Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="63" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 1 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="64" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Shading 2 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="65" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 1 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="66" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium List 2 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="67" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 1 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="68" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 2 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="69" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Medium Grid 3 Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="70" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Dark List Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="71" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Shading Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="72" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful List Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="73" SemiHidden="false"<br> UnhideWhenUsed="false" Name="Colorful Grid Accent 6"/&gt;<br> &lt;w:LsdException Locked="false" Priority="19" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Subtle Emphasis"/&gt;<br> &lt;w:LsdException Locked="false" Priority="21" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Intense Emphasis"/&gt;<br> &lt;w:LsdException Locked="false" Priority="31" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Subtle Reference"/&gt;<br> &lt;w:LsdException Locked="false" Priority="32" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Intense Reference"/&gt;<br> &lt;w:LsdException Locked="false" Priority="33" SemiHidden="false"<br> UnhideWhenUsed="false" QFormat="true" Name="Book Title"/&gt;<br> &lt;w:LsdException Locked="false" Priority="37" Name="Bibliography"/&gt;<br> &lt;w:LsdException Locked="false" Priority="39" QFormat="true" Name="TOC Heading"/&gt;<br> &lt;/w:LatentStyles&gt;<br> &lt;/xml&gt;&lt;![endif]-->

<style> &lt;!-- /* Font Definitions */ @font-face {font-family:"Cambria Math"; panose-1:2 4 5 3 5 4 6 3 2 4; mso-font-charset:204; mso-generic-font-family:roman; mso-font-pitch:variable; mso-font-signature:-1610611985 1107304683 0 0 159 0;} @font-face {font-family:Calibri; panose-1:2 15 5 2 2 2 4 3 2 4; mso-font-charset:204; mso-generic-font-family:swiss; mso-font-pitch:variable; mso-font-signature:-1610611985 1073750139 0 0 159 0;} /* Style Definitions */ p.MsoNormal, li.MsoNormal, div.MsoNormal {mso-style-unhide:no; mso-style-qformat:yes; mso-style-parent:""; margin-top:0cm; margin-right:0cm; margin-bottom:10.0pt; margin-left:0cm; line-height:115%; mso-pagination:widow-orphan; font-size:11.0pt; font-family:"Calibri","sans-serif"; mso-ascii-font-family:Calibri; mso-ascii-theme-font:minor-latin; mso-fareast-font-family:Calibri; mso-fareast-theme-font:minor-latin; mso-hansi-font-family:Calibri; mso-hansi-theme-font:minor-latin; mso-bidi-font-family:"Times New Roman"; mso-bidi-theme-font:minor-bidi; mso-fareast-language:EN-US;} .MsoChpDefault {mso-style-type:export-only; mso-default-props:yes; mso-ascii-font-family:Calibri; mso-ascii-theme-font:minor-latin; mso-fareast-font-family:Calibri; mso-fareast-theme-font:minor-latin; mso-hansi-font-family:Calibri; mso-hansi-theme-font:minor-latin; mso-bidi-font-family:"Times New Roman"; mso-bidi-theme-font:minor-bidi; mso-fareast-language:EN-US;} .MsoPapDefault {mso-style-type:export-only; margin-bottom:10.0pt; line-height:115%;} @page Section1 {size:612.0pt 792.0pt; margin:2.0cm 42.5pt 2.0cm 3.0cm; mso-header-margin:36.0pt; mso-footer-margin:36.0pt; mso-paper-source:0;} div.Section1 {page:Section1;} --> </style>
<!--[if gte mso 10]&gt;<br> &lt;style&gt;<br> /* Style Definitions */<br> table.MsoNormalTable<br> {mso-style-name:"������� �������";<br> mso-tstyle-rowband-size:0;<br> mso-tstyle-colband-size:0;<br> mso-style-noshow:yes;<br> mso-style-priority:99;<br> mso-style-qformat:yes;<br> mso-style-parent:"";<br> mso-padding-alt:0cm 5.4pt 0cm 5.4pt;<br> mso-para-margin-top:0cm;<br> mso-para-margin-right:0cm;<br> mso-para-margin-bottom:10.0pt;<br> mso-para-margin-left:0cm;<br> line-height:115%;<br> mso-pagination:widow-orphan;<br> font-size:11.0pt;<br> font-family:"Calibri","sans-serif";<br> mso-ascii-font-family:Calibri;<br> mso-ascii-theme-font:minor-latin;<br> mso-fareast-font-family:"Times New Roman";<br> mso-fareast-theme-font:minor-fareast;<br> mso-hansi-font-family:Calibri;<br> mso-hansi-theme-font:minor-latin;}<br> &lt;/style&gt;<br> &lt;![endif]-->

<p>������ ����.</p>
<H1>fdgdgdg</H1>
<div>
  <p>&nbsp;</p>
  <p>��������������</p>
  <p>��</p>
  <p>��</p>
  <p>��</p>
  <p>�</p> </div> <br />
</textarea>
<textarea name="test" rows="10" id="content2" cols="100">

</textarea>
<input type="button" value="��" onclick="fixWord()">
</html>
