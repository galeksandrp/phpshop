<head>
    <title>����� ���������������� ������</title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <script>
        function NoFoto(obj){
            obj.height=1;
            obj.width=1;
        }
    </script>
   <link href="../style.css" type=text/css rel=stylesheet>
    <style media="print" type="text/css">
        <!--
        .nonprint {
            display: none;
            
        }
        -->
    </style>
</head>
<body onload="window.focus()" bgcolor="#FFFFFF" text="#000000" marginwidth=5 leftmargin=5 style="padding: 2px;">
    <div align="right" class="nonprint">
        <button onclick="window.print()">
            �����������
        </button> 
        <br><br>
    </div>
    <div align="center"><table align="center" width="100%">
            <tr>
                <td align="center"><img onerror=NoFoto(this) src="@logo@" alt="" border="0"></td>
                <td align="center"><h4 align=center>����� ���������������� ������ &nbsp;��&nbsp;@date@</h4></td>
            </tr>
        </table>
    </div>

    <table width=80% cellpadding=2 cellspacing=0 align=center>
        <tr class=tablerow>
            <td class=tablerow>�</td>
            <td width=50% class=tablerow>������������</td>
            <td class=tablerow>������� ���������&nbsp;</td>
            <td class=tablerow>����������</td>
            <td class=tablerow>����</td>
            <td class=tableright>�����</td>
        </tr>
        @cart@
        <tr>
            <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">������:</td>
            <td class=tableright nowrap><b>@discount@%</b></td>
        </tr>
        <tr>
            <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;">�����:</td>
            <td class=tableright nowrap><b>@total@</b></td>
        </tr>
        <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;"><p><b>����� ������������ @item@, �� ����� @total@ @currency@
            <br />
    @totaltext@
        </b></p>&nbsp;</td></tr>
    </table>
    
</body>
</html>