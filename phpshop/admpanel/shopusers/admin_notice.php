<?

function GetproductInfo($n) {
    global $SysValue;
    $sql = "select name from " . $SysValue['base']['table_name2'] . " where id=".intval($n);
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row['name'];
}

function GetInfoUsers($n) {
    global $SysValue;
    $sql = "select name from " . $SysValue['base']['table_name27'] . " where id=".intval($n);
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row['name'];
}

function ShopUsersNotice($pole1, $pole2, $words) {// ����� 
    global $SysValue;

    if (empty($pole1))
        $pole1 = date("U") - 86400;
    else
        $pole1 = GetUnicTime($pole1) - 86400;
    if (empty($pole2))
        $pole2 = date("U");
    else
        $pole2 = GetUnicTime($pole2) + 86400;

    $now = date("U");

    if (!empty($words))
        $str = " and product_id='$words'";

    $sql = "select * from " . $SysValue['base']['table_name34'] . " where datas_start<'$pole2' and datas>'$pole1' " . @$str . " order by id desc";

    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $datas = $row['datas'];
        $datas_start = $row['datas_start'];
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];


        if (($row['enabled']) == "1") {
            $checked = "<img src=img/icon-activate.gif  width=\"16\" height=\"16\" alt=\"����������\">";
        } else {
            $checked = "<img src=img/icon-deactivate.gif  width=\"16\" height=\"16\" alt=\"��������\">";
        };

        @$display.="
	<tr id=\"r" . $id . "\" class=row>
        <td class=forma align=center>
	<input type=checkbox name='c" . $id . "' value=\"$id\">
	</td>
        <td align=center id=Nws class=Nws onmouseover=\"show_on('r" . $id . "')\" onmouseout=\"show_out('r" . $id . "')\" onclick=\"miniWin('./product/adm_productID.php?productID=$product_id',700,630)\">$checked</td>
	<td id=Nws class=Nws onmouseover=\"show_on('r" . $id . "')\" onmouseout=\"show_out('r" . $id . "')\" onclick=\"miniWin('./product/adm_productID.php?productID=$product_id',700,630)\">
	" . dataV($datas_start, "update") . " - " . dataV($datas, "update") . "
	</td>
	<td id=Nws class=Nws onmouseover=\"show_on('r" . $id . "')\" onmouseout=\"show_out('r" . $id . "')\" onclick=\"miniWin('./product/adm_productID.php?productID=$product_id',700,630)\">
	" . GetInfoUsers($user_id) . "
	</td>
	<td id=Nws class=Nws onmouseover=\"show_on('r" . $id . "')\" onmouseout=\"show_out('r" . $id . "')\" onclick=\"miniWin('./product/adm_productID.php?productID=$product_id',700,630)\">
	$product_id
	</td>
        <td id=Nws class=Nws onmouseover=\"show_on('r" . $id . "')\" onmouseout=\"show_out('r" . $id . "')\" onclick=\"miniWin('./product/adm_productID.php?productID=$product_id',700,630)\">
	" . GetproductInfo($product_id) . "
	</td>
    </tr>
	";
        @$i++;
    }
    if ($i > 20)
        $razmer = "height:600;";
    return "
<div id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;" . @$razmer . ";overflow:auto\"> 
<form name=\"form_flag\">
<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" class=\"sortable\" id=\"sort\">
<tr>
    <td width=\"25\" id=pane align=center style=\"padding:1px\">
	<input type=checkbox value=1 name=DoAll onclick=\"SelectAllBox(this,form_flag)\"></td>
    <td width=\"50\" id=pane align=center><img  src=\"icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\" align=left><span name=txtLang id=txtLang>������</span></td>
	<td id=pane align=center><span name=txtLang id=txtLang>������������</span></td>
	<td id=pane align=center><span name=txtLang id=txtLang>������������</span></td>
    <td width=\"50\" id=pane align=center><span name=txtLang id=txtLang>ID</span></td>
	<td id=pane align=center><span name=txtLang id=txtLang>��������</span></td>
</tr>

	" . $display . "

    </table>
	</form>
	</td>
</tr>
    </table>
	";
}

?>
