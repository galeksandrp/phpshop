<?
require("../connect.php");
@mysql_connect("$host", "$user_db", "$pass_db") or @die("���������� �������������� � ����");
mysql_select_db("$dbase") or @die("���������� �������������� � ����");
require("../enter_to_admin.php");
require("../language/russian/language.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>�������� ������ �������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������� ������ �������</span></b><br>

                    </td>
                    <td align="right">
                        <img src="../img/i_subscription_med[1].gif" border="0" hspace="10">
                    </td>
                </tr>
            </table>
            <br>
            <table class=mainpage4 cellpadding="5" cellspacing="0" border="0" align="center" width="100%">
                <tr>
                    <td>
                        <FIELDSET style="height:80px">
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�������</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="name_new"  style="width:200px"><br><br>

                                <span name=txtLang id=txtLang>������������</span> <select name="price_new">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option> 
                                    <option value="5">5</option> 
                                </select> <span name=txtLang id=txtLang>������� ���</span>.

                            </div>
                        </FIELDSET>
                    </td>
                    <td>
                        <FIELDSET style="height:80px">
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>�����</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="discount_new"  maxlength="3" value="<?= $discount ?>" style="width:30px;" > %
                            </div>
                        </FIELDSET>
                    </td>
                    <td>
                        <FIELDSET style="height:80px">
                            <LEGEND><span name=txtLang id=txtLang><u>�</u>��������</span></LEGEND>
                            <div style="padding:10">
                                <input type="radio" name="enabled_new" value="1" checked><span name=txtLang id=txtLang>��</span><br>
                                <input type="radio" name="enabled_new" value="0"><font color="#FF0000"><span name=txtLang id=txtLang>���</span></font>
                            </div>
                        </FIELDSET>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <FIELDSET>
                            <LEGEND><span name="txtLang" id="txtLang"><u>�</u>������������ ������</span> </LEGEND>
                            <div style="padding:10">
        
                                <label><input type="checkbox" name="cumulative_discount_check_new" <?=$cumulative_check?> > ������������� ������������� ������ <i>(��/���)</i></label><br><br>
                                <div class="sum-cumulative" id="sum-cumulative-1">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuve(1)">�������</button></div>
                                <div class="sum-cumulative" id="sum-cumulative-2">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuve(2)">�������</button></div>
                                <div id="add-block-sum-cumulative"></div>
                                <input type="hidden" name="cache-n" id="cache-n" value="1">
                                <button type="button" class="btn btn-success" onclick="addCumulatuve()">+ �������� ��������</button>
                            </div>
                            <script>
                            function addCumulatuve() {
                                var idd = document.getElementById('cache-n').value;
                                // �������-������
                                var list = document.getElementById('add-block-sum-cumulative');
                                // ����� �������
                                var div = document.createElement('div');
                                div.innerHTML = '<div class="sum-cumulative" id="sum-cumulative-new-'+idd+'">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuveNew('+idd+')">�������</button></div>';
                                // ���������� � �����
                                list.appendChild(div);
                                // ���������� ��������
                                var su = Number(idd)+1;
                                // ������ ������ �������� � hidden input
                                document.getElementById('cache-n').value = su;
                            }
                            function removeCumulatuve(id) {
                                if (confirm("�������� ������ ����� ������! �� �������?")) {
                                  var element = document.getElementById("sum-cumulative-"+id);
                                  element.parentNode.removeChild(element);
                                }
                            }
                            function removeCumulatuveNew(id) {
                                //if (confirm("�������� ������ ����� ������! �� �������?")) {
                                    var element = document.getElementById("sum-cumulative-new-"+id);
                                    element.parentNode.removeChild(element);
                                //}
                            }
                            </script>
                            <style>
                            #add-block-sum-cumulative {
                                margin-bottom: 10px;
                            }
                            .sum-cumulative {
                                margin-bottom: 3px;
                            }
                            .btn {
                                font-size: 10px;
                                margin-left: 15px;
                            }
                            .btn-danger {
                                color: #fff;
                                background: #d9534f;
                                border-color: #d43f3a;
                            }
                            .btn-success {
                                color: #fff;
                                background: #5cb85c;
                                border-color: #4cae4c;
                                margin-left: 0;
                                width: 150px;
                            }
                            .btn-danger:hover {
                                color: #fff;
                                background: #c9302c;
                                border-color: #ac2925;
                            }
                            .btn-success:hover {
                                color: #fff;
                                background: #449d44;
                                border-color: #398439;
                            }
                            </style>
                        </FIELDSET>
                    </td>
                </tr>
            </table>
            <hr>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" >
                <tr>
                    <td align="left" style="padding:10">
                        <BUTTON class="help" onclick="helpWinParent('shopusers_statusID')">�������</BUTTON></BUTTON>
                    </td>
                    <td align="right" style="padding:10">
                        <input type="submit" name="editID" value="OK" class=but>
                        <input type="reset" name="btnLang" name="delID" value="��������" class=but>
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and !empty($name_new)) {// ������ ��������������
            //������������� ������� (��/���)
            if($cumulative_discount_check_new=='on')
                $cumulative_discount_check = 1;

            //�������� ������� � ��������� ������������� ������
            foreach ($_POST['cumulative_sum_ot'] as $key => $value) {
                if($_POST['cumulative_discount'][$key]!=''):
                    $cumulative_array[$key]['cumulative_sum_ot'] = $value;
                    $cumulative_array[$key]['cumulative_sum_do'] = $_POST['cumulative_sum_do'][$key];
                    $cumulative_array[$key]['cumulative_discount'] = $_POST['cumulative_discount'][$key];
                endif;
            }
            //������������
            $cumulative_discount = serialize($cumulative_array);

            if (CheckedRules($UserStatus["discount"], 2) == 1) {
                $sql = "INSERT INTO " . $SysValue['base']['table_name28'] . "
VALUES ('','$name_new','$discount_new','$price_new','$enabled_new','".$cumulative_discount_check."','".$cumulative_discount."')";
                $result = mysql_query($sql) or @die("" . mysql_error() . "");
                echo"
	  <script>
DoReloadMainWindow('shopusers_status');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        ?>