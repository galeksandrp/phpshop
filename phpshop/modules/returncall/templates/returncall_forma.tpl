<script>
    function checkModReturnCallForma(){
        if(document.getElementById('returncall_mod_name').value == "" || document.getElementById('returncall_mod_tel').value == "")
            return false;
    }
</script>
<div style="padding:5px">
    <form action="@ShopDir@/returncall/" method="post" onsubmit="return checkModReturnCallForma();" >

        <table>
            <tr>
                <td><b>���</b>:</td>
                <td><input type="text" name="returncall_mod_name" id="returncall_mod_name" size="15"></td>
            </tr>
            <tr>
                <td><b>�������</b>:</td>
                <td><input type="text" name="returncall_mod_tel" id="returncall_mod_tel" size="15"> </td>
            </tr>
            <tr>
                <td>����� ������:</td>
                <td>�� <input type="text" name="returncall_mod_time_start" size="2"> �� 
                    <input type="text" name="returncall_mod_time_end" size="2"></td>
            </tr>
            <tr>
                <td>���������:</td>
                <td><textarea name="returncall_mod_message" cols="12" rows="3"></textarea></td>
            </tr>
            <!--
            <tr>
                <td colspan="2">@returncall_captcha@</td>
            </tr>
            -->
            <tr>
                <td></td>
                <td><input type="submit" name="returncall_mod_send" value="����������� ���" style="width:130px"></td>
            </tr>
        </table>
    </form>
</div>