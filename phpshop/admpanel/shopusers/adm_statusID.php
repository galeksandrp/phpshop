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
        <title>�������������� �������</title>
        <META http-equiv=Content-Type content="text/html; charset=<?= $SysValue['Lang']['System']['charset'] ?>">
        <LINK href="../skins/<?= $_SESSION['theme'] ?>/texts.css" type=text/css rel=stylesheet>
        <SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
    </head>
    <body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">
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
    function sumbitEdit() {
        if (confirm("��������! �� ������ ������������� ����� ���������� ���������� ������������ ������. �� �������?")) {
            document.getElementById("updateLoader").style.display = 'block';
            return true;
        }
        else {
            return false;
        }
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
    #updateLoader {
        display: none;
        width: 95%;
        font-style: 15px;
        color:#046b06;
        border: 1px solid #046b06;
        background: #b6d7b7;
        padding: 6px;
        text-align: center;
        margin: 1% 5% 3% 0;
    }
    </style>
        <?
// �������������� ������� 
        $sql = "select * from " . $SysValue['base']['table_name28'] . " where id=" . intval($_GET['id']);
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $id = $row['id'];
        $name = $row['name'];
        $discount = $row['discount'];
        $cumulative_discount = unserialize($row['cumulative_discount']);
        if ($row['enabled'] == 1) {
            $fl = "checked";
        } else {
            $fl2 = "checked";
        }
        // ������������� ������ (��/���)
        if ($row['cumulative_discount_check'] == 1) {
            $cumulative_check = 'checked="checked"';
        }

        $sel = "";
        ${"price_" . $row['price'] . ""} = "selected";
        ?>
        <form name="product_edit"  method=post>
            <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
                <tr bgcolor="#ffffff">
                    <td style="padding:10">
                        <b><span name=txtLang id=txtLang>�������������� �������</span> "<?= $name ?>"</b><br>

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
                                <input type="text" name="name_new"  value="<?= $name ?>" style="width:200px"><br><br>

                                <span name=txtLang id=txtLang>������������</span> <select name="price_new">
                                    <option value="1" <?= $price_1 ?>>1</option>
                                    <option value="2" <?= $price_2 ?>>2</option>
                                    <option value="3" <?= $price_3 ?>>3</option>
                                    <option value="4" <?= $price_4 ?>>4</option>
                                    <option value="5" <?= $price_5 ?>>5</option>
                                </select> <span name=txtLang id=txtLang>������� ���</span>.
                            </div>
                        </FIELDSET>
                    </td>
                    <td>
                        <FIELDSET style="height:80px">
                            <LEGEND><span name="txtLang" id="txtLang"><u>�</u>�����</span> </LEGEND>
                            <div style="padding:10">
                                <input type="text" name="discount_new"  maxlength="3" value="<?= $discount ?>" style="width:30px;" > %
                            </div>
                        </FIELDSET>
                    </td>
                    <td>
                        <FIELDSET style="height:80px">
                            <LEGEND><span name=txtLang id="txtLang"><u>�</u>��������</span></LEGEND>
                            <div style="padding:10">
                                <input type="radio" name="enabled_new" value="1" <?= @$fl ?>><span name=txtLang id="txtLang">��</span><br>
                                <input type="radio" name="enabled_new" value="0" <?= @$fl2 ?>><font color="#FF0000"><span name="txtLang" id="txtLang">���</span></font>
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
                                <?
                                foreach ($cumulative_discount as $key => $value) {
                                    $cumulative_html .= '<div class="sum-cumulative" id="sum-cumulative-'.$key.'">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]" value="'.$value['cumulative_sum_ot'].'"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]" value="'.$value['cumulative_sum_do'].'"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]" value="'.$value['cumulative_discount'].'"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuve('.$key.')">�������</button></div>';
                                }
                                echo $cumulative_html;
                                ?>
                                <? if($cumulative_html==''): ?>
                                <div class="sum-cumulative" id="sum-cumulative-1">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuve(1)">�������</button></div>
                                <div class="sum-cumulative" id="sum-cumulative-2">����� �� <input type="text" style="width:50px" name="cumulative_sum_ot[]"> �� <input type="text" style="width:50px" name="cumulative_sum_do[]"> C�����: <input type="text" style="width:30px" name="cumulative_discount[]"> % <button type="button" class="btn btn-danger" onclick="removeCumulatuve(2)">�������</button></div>
                                <? endif; ?>
                                <div id="add-block-sum-cumulative"></div>
                                <input type="hidden" name="cache-n" id="cache-n" value="1">
                                <button type="button" class="btn btn-success" onclick="addCumulatuve()">+ �������� ��������</button>
                            </div>
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
                        <input type="hidden" name="id" value="<?= $id ?>" >
                        <div id="updateLoader">���������� ������...</div>
                        <input type="submit" name="editID" value="OK" class=but onClick="sumbitEdit();">
                        <input type="button" name="btnLang" class=but value="�������" onClick="PromptThis();">
                        <input type="hidden" class=but  name="productDELETE" id="productDELETE">
                        <input type="button" name="btnLang" value="������" onClick="return onCancel();" class=but>
                    </td>
                </tr>
            </table>
        </form>
        <?
        if (isset($editID) and !empty($name_new)) {// ������ ��������������
            if (CheckedRules($UserStatus["discount"], 1) == 1) {

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


                $sql = "UPDATE " . $SysValue['base']['table_name28'] . "
SET
name='$name_new',
discount='$discount_new',
price='$price_new',
enabled='$enabled_new',
cumulative_discount_check='$cumulative_discount_check',
cumulative_discount='".$cumulative_discount."'
where id='$id'";
                $result = mysql_query($sql) or @die("" . mysql_error() . "");

                //���������� ������ ��� ������������� �� ������ ���������
                if($cumulative_discount_check_new=='on') {
                    //���� ������� �����, ���������� ���������� ������ ��� ���� ������������� � ������ ��������..
                    $sql_select = "SELECT * FROM `".$SysValue['base']['table_name27']."` WHERE `status` =".$id." ";
                    $query = mysql_query($sql_select);
                    $row = mysql_fetch_array($query);
                    if(isset($row)) {
                        do {
                            //������ �������
                            $sql_order = "SELECT ".$SysValue['base']['table_name1'].".* FROM `".$SysValue['base']['table_name1']."` 
                            LEFT JOIN `".$SysValue['base']['table_name32']."` ON ".$SysValue['base']['table_name1'].".statusi=".$SysValue['base']['table_name32'].".id 
                            WHERE ".$SysValue['base']['table_name1'].".user =  ".$row['id']." 
                            AND ".$SysValue['base']['table_name32'].".cumulative_action='1' ";
                            $query_order = mysql_query($sql_order);
                            $row_order = mysql_fetch_array($query_order);
                            $sum = '0'; //������� �����
                            do {
                                $orders = unserialize($row_order['orders']);
                                $sum += $orders['Cart']['sum'];
                            }
                            while ($row_order = mysql_fetch_array($query_order));
                            
                            //������ ������
                            $q_cumulative_discount = '0'; //������� ������
                            foreach ($cumulative_array as $key => $value) {
                                if($sum>=$value['cumulative_sum_ot'] and $sum<=$value['cumulative_sum_do']) {
                                    $q_cumulative_discount = $value['cumulative_discount'];
                                    break;
                                }
                            }
                            //��������� ������
                            $sql_update = "UPDATE  `".$SysValue['base']['table_name27']."` SET `cumulative_discount` =  '".$q_cumulative_discount."' WHERE `id` =".$row['id']." ";
                            mysql_query($sql_update);
                        }
                        while ($row = mysql_fetch_array($query));
                    }
                } else {
                    //���� ������� �����, �������� ������ � ������������� � ������ ��������..
                    //��������� ������
                    $sql_update = "UPDATE  `".$SysValue['base']['table_name27']."` SET `cumulative_discount` =  '0' WHERE `status` =".$id." ";
                    mysql_query($sql_update);
                }

                echo"
	  <script>
DoReloadMainWindow('shopusers_status');
</script>
	   ";
            }
            else
                $UserChek->BadUserFormaWindow();
        }
        if (@$productDELETE == "doIT") {// ��������
            if (CheckedRules($UserStatus["discount"], 1) == 1) {
                $sql = "delete from " . $SysValue['base']['table_name28'] . "
where id='$id'";
                $result = mysql_query($sql) or @die("���������� �������� ������");
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