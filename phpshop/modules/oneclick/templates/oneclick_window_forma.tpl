<script>
    function checkModOneClickForma(){
        if(document.getElementById('oneclick_mod_name').value == "" || document.getElementById('oneclick_mod_tel').value == "")
            return false;
    }
</script>
<a href="javascript:void(0)" onclick="document.getElementById('mod_oneclick_forma').style.display='block';">������� �����</a>
<div style="position:relative">
    <div id="mod_oneclick_forma" style="display: none;width:200px;position:absolute;">
        <div>
            <div style="position:relative; border:1px solid #ccc; background:#ebf1f6 ">
                <form action="@ShopDir@/oneclick/" method="post" onsubmit="return checkModOneClickForma();" >
                    <table style="margin:0px 8px 0px 9px" border="0" cellpadding="2" cellspacing="0">
                        <tbody>
                            <tr>
                                <td colspan="2" style=" padding:10px;" align="right"><a style="padding:0px; font-size:11px;margin:0px 0px 0px 5px;color:#086ebd" href="javascript:void(0)" onclick="document.getElementById('mod_oneclick_forma').style.display='none';">�������</a></td>
                            </tr>
                            <tr>
                                <td><b>���</b>:</td>
                                <td><input type="text" name="oneclick_mod_name" id="oneclick_mod_name" size="15"></td>
                            </tr>
                            <tr>
                                <td><b>�������</b>:</td>
                                <td><input type="text" name="oneclick_mod_tel" id="oneclick_mod_tel" size="15"> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="hidden" name="oneclick_mod_product_id" value="@productUid@">
                                    <input type="submit" name="oneclick_mod_send" value="������� �����"></td>
                            </tr>

                        </tbody>
                    </table>

                </form>
            </div>

        </div>

    </div>

</div>